<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use setasign\Fpdi\Fpdi;

final class PdfOptimizerService
{
    /**
     * Optimize PDF to fit on a single page
     * 
     * @param string $filePath Full path to the PDF file
     * @return string|false Optimized file path or false on failure
     */
    public function optimizeToSinglePage(string $filePath): string|false
    {
        try {
            // First, try using Ghostscript if available (best option)
            if ($this->isGhostscriptAvailable()) {
                return $this->optimizeWithGhostscript($filePath);
            }
            
            // Fallback: Use FPDI to check page count and optimize
            return $this->optimizeWithFpdi($filePath);
            
        } catch (\Exception $e) {
            Log::error('PDF optimization failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Check if Ghostscript is available on the system
     */
    private function isGhostscriptAvailable(): bool
    {
        $output = [];
        $returnVar = 0;
        @exec('gs --version 2>&1', $output, $returnVar);
        return $returnVar === 0;
    }

    /**
     * Optimize PDF using Ghostscript
     */
    private function optimizeWithGhostscript(string $filePath): string|false
    {
        try {
            $outputPath = $filePath . '.optimized';
            
            // Use Ghostscript to compress and optimize PDF
            // -dPDFSETTINGS=/screen: lower quality, smaller file
            // -dPDFSETTINGS=/ebook: medium quality
            // -dPDFSETTINGS=/prepress: high quality
            // We'll use /ebook for a balance
            $command = sprintf(
                'gs -sDEVICE=pdfwrite -dCompatibilityLevel=1.4 -dPDFSETTINGS=/ebook -dNOPAUSE -dQUIET -dBATCH -sOutputFile=%s %s 2>&1',
                escapeshellarg($outputPath),
                escapeshellarg($filePath)
            );
            
            $output = [];
            $returnVar = 0;
            exec($command, $output, $returnVar);
            
            if ($returnVar === 0 && file_exists($outputPath)) {
                // Replace original with optimized version
                if (copy($outputPath, $filePath)) {
                    @unlink($outputPath);
                    return $filePath;
                }
            }
            
            Log::warning('Ghostscript optimization failed', ['output' => implode("\n", $output)]);
            return false;
            
        } catch (\Exception $e) {
            Log::error('Ghostscript optimization error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Optimize PDF using FPDI (fallback method)
     * This method checks page count and attempts basic optimization
     */
    private function optimizeWithFpdi(string $filePath): string|false
    {
        try {
            $pdf = new Fpdi();
            
            // Get page count
            $pageCount = $pdf->setSourceFile($filePath);
            
            // If already 1 page or less, no optimization needed
            if ($pageCount <= 1) {
                return $filePath;
            }
            
            // For multi-page PDFs, we'll use Ghostscript-like compression
            // Since FPDI can't easily compress, we'll just return false
            // and let the user know optimization isn't available
            Log::warning('FPDI cannot compress multi-page PDFs. Ghostscript recommended for better results.');
            return false;
            
        } catch (\Exception $e) {
            Log::error('FPDI optimization error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Get page count of PDF
     */
    public function getPageCount(string $filePath): int
    {
        try {
            $pdf = new Fpdi();
            return $pdf->setSourceFile($filePath);
        } catch (\Exception $e) {
            Log::error('Failed to get PDF page count: ' . $e->getMessage());
            return 0;
        }
    }
}


<!-- Experience Section-->
<section class="container pt-4" id="">
    <!-- Titel en sectie header -->
    <div class="text-center mb-5">
        <h2 class="text-gradient fw-bolder mb-3">{{ __('messages.experience') }}</h2>
        <div class="section-divider mx-auto mb-4"></div>
        
        <!-- Download Button - Nu in het midden -->
        <div class="download-button-container mt-4">
            <button class="btn btn-download px-4 py-3" id="downloadResumeBtn">
                <div class="btn-download-content">
                    <div class="d-inline-block bi bi-download me-2"></div>
                    <span>{{ __('messages.download_cv') }}</span>
                </div>
                <span id="resumeProtectedBadge" class="badge bg-warning ms-2" style="display: none;">
                    <i class="bi bi-lock-fill"></i>
                </span>
            </button>
        </div>
    </div>

    <div id="experienceInside" class="experience-timeline"></div>

</section>

<!-- Download Password Modal -->
<div class="modal fade" id="downloadPasswordModal" tabindex="-1" aria-labelledby="downloadPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header">
                <h5 class="modal-title" id="downloadPasswordModalLabel">
                    <i class="bi bi-lock-fill me-2"></i>{{ __('messages.password_required') }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="text-center mb-4">
                    <div class="modal-icon mb-3">
                        <i class="bi bi-file-earmark-lock"></i>
                    </div>
                    <h4 class="mb-3">{{ __('messages.protected_document') }}</h4>
                    <p class="text-muted">{{ __('messages.protected_document_desc') }}</p>
                </div>
                
                <div id="passwordError" class="alert alert-danger" style="display: none;">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <span id="passwordErrorMessage">{{ __('messages.incorrect_password') }}</span>
                </div>
                
                <form id="downloadPasswordForm">
                    <div class="mb-3">
                        <label for="download_password" class="form-label">
                            <i class="bi bi-key me-1"></i>{{ __('messages.password') }}
                        </label>
                        <div class="input-group password-input-group">
                            <input type="password" class="form-control" id="download_password" name="password" required autofocus>
                            <button class="btn btn-outline-toggle" type="button" id="toggleDownloadPassword">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        <div class="form-text">{{ __('messages.enter_password_hint') }}</div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i>{{ __('messages.cancel') }}
                </button>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-info" id="confirmPreviewBtn" style="display: none;">
                        <i class="bi bi-eye me-1"></i>Preview
                    </button>
                    <button type="button" class="btn btn-primary" id="confirmDownloadBtn">
                        <i class="bi bi-download me-1"></i>Download
                    </button>
                    <button type="button" class="btn btn-success" id="confirmPrintBtn">
                        <i class="bi bi-printer me-1"></i>Print
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Experience Timeline Styling */
    .section-divider {
        height: 3px;
        width: 60px;
        background: linear-gradient(90deg, var(--color-primary), var(--color-primary-alt));
        border-radius: 2px;
    }
    
    .experience-timeline {
        position: relative;
    }
    
    .experience-timeline::before {
        content: '';
        position: absolute;
        left: 20px;
        top: 0;
        height: 100%;
        width: 2px;
        background: linear-gradient(to bottom, var(--color-primary) 0%, var(--color-primary-alt) 100%);
        opacity: 0.3;
        border-radius: 1px;
        display: none;
    }
    
    @media (min-width: 992px) {
        .experience-timeline::before {
            display: block;
        }
    }
    
    /* Download Button Styling */
    .download-button-container {
        display: flex;
        justify-content: center;
        margin-bottom: 1.5rem;
    }
    
    .btn-download {
        background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-alt) 100%);
        color: #fff;
        border: none;
        border-radius: 12px;
        font-weight: 500;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(var(--color-primary-rgb, 95, 46, 234), 0.2);
    }
    
    .btn-download:hover, .btn-download:focus {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(var(--color-primary-rgb, 95, 46, 234), 0.3);
        color: #fff;
    }
    
    .btn-download:active {
        transform: translateY(0);
    }
    
    .btn-download::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, 
            rgba(255,255,255,0) 0%, 
            rgba(255,255,255,0.2) 50%, 
            rgba(255,255,255,0) 100%);
        transition: all 0.6s;
    }
    
    .btn-download:hover::before {
        left: 100%;
    }
    
    /* Modal Styling */
    .modal-content {
        border-radius: 16px;
        background: var(--color-card-bg);
        color: var(--color-text);
        box-shadow: var(--color-card-shadow);
    }
    
    .modal-header {
        background: var(--color-primary);
        color: #fff;
        border-radius: 16px 16px 0 0;
        border-bottom: none;
    }
    
    .modal-footer {
        border-top: 1px solid rgba(var(--color-text-rgb, 34, 34, 34), 0.1);
        background: var(--color-card-bg);
        border-radius: 0 0 16px 16px;
    }
    
    .modal-icon {
        font-size: 3rem;
        color: var(--color-primary);
        display: inline-block;
        background: rgba(var(--color-primary-rgb, 95, 46, 234), 0.1);
        width: 80px;
        height: 80px;
        line-height: 80px;
        border-radius: 50%;
    }
    
    .password-input-group .form-control {
        border-radius: 10px 0 0 10px;
        background: var(--color-bg-alt);
        border-color: rgba(var(--color-text-rgb, 34, 34, 34), 0.1);
        color: var(--color-text);
    }
    
    .btn-outline-toggle {
        border-radius: 0 10px 10px 0;
        border: 1px solid rgba(var(--color-text-rgb, 34, 34, 34), 0.1);
        border-left: none;
        background: var(--color-bg-alt);
        color: var(--color-text);
    }
    
    .btn-outline-toggle:hover, .btn-outline-toggle:focus {
        background: var(--color-primary);
        color: #fff;
    }
    
    /* Card styling for experience items */
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        overflow: hidden;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 24px rgba(var(--color-primary-rgb, 95, 46, 234), 0.15) !important;
    }
    
    .experience-meta {
        background: var(--color-bg-alt);
        transition: background-color var(--transition-speed);
    }
    
    .experience-details {
        color: var(--color-text);
    }
    
    /* Animation for cards */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .card {
        animation: fadeInUp 0.6s ease-out;
        animation-fill-mode: both;
    }
    
    .card:nth-child(2) {
        animation-delay: 0.2s;
    }
    
    .card:nth-child(3) {
        animation-delay: 0.4s;
    }
    
    .card:nth-child(4) {
        animation-delay: 0.6s;
    }
    
    .card:nth-child(5) {
        animation-delay: 0.8s;
    }
    
    /* Pulse animation for modal */
    @keyframes pulse {
        0% { transform: scale(0.95); opacity: 0.7; }
        50% { transform: scale(1.05); opacity: 1; }
        100% { transform: scale(1); opacity: 1; }
    }
    
    .modal.show .modal-dialog {
        animation: pulse 0.3s;
    }
    
    /* Dark mode specifieke stijlen voor Bootstrap componenten */
    [data-bs-theme="dark"] .modal-content,
    body.darkmode .modal-content {
        background-color: var(--color-card-bg);
        color: var(--color-text);
    }
    
    [data-bs-theme="dark"] .modal-header,
    body.darkmode .modal-header {
        background-color: var(--color-primary);
        color: #fff;
        border-bottom: none;
    }
    
    [data-bs-theme="dark"] .modal-footer,
    body.darkmode .modal-footer {
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        background-color: var(--color-card-bg);
    }
    
    [data-bs-theme="dark"] .form-control,
    body.darkmode .form-control {
        background-color: var(--color-bg-alt);
        border-color: rgba(255, 255, 255, 0.1);
        color: var(--color-text);
    }
    
    [data-bs-theme="dark"] .btn-close,
    body.darkmode .btn-close {
        filter: invert(1) grayscale(100%) brightness(200%);
    }
</style>

<script>
    const getAllExperience1 = async () =>{
        document.getElementById('loading-div').classList.remove('d-none');
        const allExperience = await axios.get('/getExperienceDetails');
        document.getElementById('loading-div').classList.add('d-none');
        if(allExperience.status === 200){
            allExperience.data.forEach((singleItem, index) => {
                const singleExperienceCard = `<div class="card shadow border-0 rounded-4 mb-5" style="animation-delay: ${index * 0.2}s">
        <div class="card-body p-5">
            <div class="row align-items-center gx-5">
                <div class="col text-center text-lg-start mb-4 mb-lg-0">
                    <div class="experience-meta p-4 rounded-4">
                        <div class="text-primary fw-bolder mb-2">${singleItem.duration}</div>
                        <div class="small fw-bolder">${singleItem.title}</div>
                        <div class="small text-muted">${singleItem.designation}</div>
                    </div>
                </div>
                <div class="col-lg-8"><div class="experience-details">
${singleItem.details}
</div></div>
            </div>
        </div>
    </div>`;
                document.getElementById('experienceInside').innerHTML += singleExperienceCard;
            })
        }
    }
    getAllExperience1();

    // Resume download functionality
    let currentResumeInfo = null;

    const getResumeInfo = async () => {
        try {
            const response = await axios.get('/getResumeInfo');
            if (response.status === 200) {
                currentResumeInfo = response.data;
                updateDownloadButton();
            }
        } catch (error) {
            console.log('Geen resume info beschikbaar');
        }
    };

    const updateDownloadButton = () => {
        const downloadBtn = document.getElementById('downloadResumeBtn');
        const resumeProtectedBadge = document.getElementById('resumeProtectedBadge');
        
        if (currentResumeInfo && currentResumeInfo.has_file) {
            // Controleer of er een wachtwoord is ingesteld
            if (!currentResumeInfo.has_password) {
                // Geen wachtwoord ingesteld - disable download button
                downloadBtn.disabled = true;
                downloadBtn.innerHTML = `<div class="btn-download-content">
                    <div class="d-inline-block bi bi-lock me-2"></div>
                    <span>CV niet beschikbaar (wachtwoord vereist)</span>
                </div>`;
                resumeProtectedBadge.style.display = 'none';
                return;
            }
            
            // Update hoofdknop - wachtwoord is altijd vereist
            downloadBtn.disabled = false;
            
            let btnContent = `<div class="btn-download-content">
                <div class="d-inline-block bi bi-download me-2"></div>
                <span>{{ __('messages.download_cv') }}</span>
            </div>`;
            
            // Toon altijd badge omdat wachtwoord verplicht is
            resumeProtectedBadge.style.display = 'inline-block';
            
            downloadBtn.innerHTML = btnContent;
        } else {
            // Geen CV beschikbaar
            downloadBtn.disabled = true;
            downloadBtn.innerHTML = `<div class="btn-download-content">
                <div class="d-inline-block bi bi-download me-2"></div>
                <span>{{ __('messages.no_cv_available') }}</span>
            </div>`;
            resumeProtectedBadge.style.display = 'none';
        }
    };
    
    document.getElementById('downloadResumeBtn').addEventListener('click', async function() {
        if (!currentResumeInfo || !currentResumeInfo.has_file) {
            alert('{{ __('messages.no_cv_file_available') }}');
            return;
        }

        // WACHTWOORD IS ALTIJD VERPLICHT - geen uitzonderingen
        // Controleer of er een wachtwoord is ingesteld
        if (!currentResumeInfo.has_password) {
            alert('CV is niet beschikbaar voor download. Wachtwoord is verplicht en moet eerst worden ingesteld in het dashboard.');
            return;
        }

        // Toon ALTIJD wachtwoord modal - wachtwoord is verplicht
        const passwordModal = new bootstrap.Modal(document.getElementById('downloadPasswordModal'));
        
        // Toon/verberg Preview knop op basis van bestandstype
        const previewBtn = document.getElementById('confirmPreviewBtn');
        if (currentResumeInfo.file_type && currentResumeInfo.file_type.toLowerCase() === 'pdf') {
            previewBtn.style.display = 'inline-block';
        } else {
            previewBtn.style.display = 'none';
        }
        
        passwordModal.show();
    });

    document.getElementById('confirmDownloadBtn').addEventListener('click', function() {
        const password = document.getElementById('download_password').value;
        if (!password) {
            showPasswordError('{{ __('messages.enter_password') }}');
            return;
        }
        downloadResume(password);
    });

    document.getElementById('confirmPreviewBtn').addEventListener('click', function() {
        const password = document.getElementById('download_password').value;
        if (!password) {
            showPasswordError('{{ __('messages.enter_password') }}');
            return;
        }
        previewResume(password);
    });

    document.getElementById('confirmPrintBtn').addEventListener('click', function() {
        const password = document.getElementById('download_password').value;
        if (!password) {
            showPasswordError('{{ __('messages.enter_password') }}');
            return;
        }
        printResume(password);
    });
    
    // Enter toets in wachtwoord veld
    document.getElementById('download_password').addEventListener('keyup', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            document.getElementById('confirmDownloadBtn').click();
        }
    });
    
    // Wachtwoord tonen/verbergen
    document.getElementById('toggleDownloadPassword').addEventListener('click', function() {
        const passwordInput = document.getElementById('download_password');
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        
        // Verander het icon
        const icon = this.querySelector('i');
        icon.className = type === 'password' ? 'bi bi-eye' : 'bi bi-eye-slash';
    });
    
    // Reset modal wanneer deze wordt gesloten
    document.getElementById('downloadPasswordModal').addEventListener('hidden.bs.modal', function() {
        document.getElementById('download_password').value = '';
        hidePasswordError();
        // Reset button states
        const confirmBtn = document.getElementById('confirmDownloadBtn');
        const previewBtn = document.getElementById('confirmPreviewBtn');
        const printBtn = document.getElementById('confirmPrintBtn');
        confirmBtn.disabled = false;
        confirmBtn.innerHTML = '<i class="bi bi-download me-1"></i>Download';
        if (previewBtn) {
            previewBtn.disabled = false;
            previewBtn.innerHTML = '<i class="bi bi-eye me-1"></i>Preview';
        }
        if (printBtn) {
            printBtn.disabled = false;
            printBtn.innerHTML = '<i class="bi bi-printer me-1"></i>Print';
        }
    });
    
    // Toon foutmelding in de modal
    function showPasswordError(message) {
        const errorDiv = document.getElementById('passwordError');
        const errorMessage = document.getElementById('passwordErrorMessage');
        errorMessage.textContent = message;
        errorDiv.style.display = 'block';
    }
    
    // Verberg foutmelding in de modal
    function hidePasswordError() {
        const errorDiv = document.getElementById('passwordError');
        errorDiv.style.display = 'none';
    }

    const downloadResume = async (password = null) => {
        // Wachtwoord is altijd verplicht
        if (!password || password.trim().length === 0) {
            showPasswordError('{{ __('messages.enter_password') }}');
            return;
        }
        
        try {
            const formData = new FormData();
            formData.append('password', password);

            // Toon laad-indicator
            const confirmBtn = document.getElementById('confirmDownloadBtn');
            const originalBtnContent = confirmBtn.innerHTML;
            confirmBtn.disabled = true;
            confirmBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>{{ __('messages.loading') }}';
            
            hidePasswordError();

            const response = await axios.post('/downloadResume', formData, {
                responseType: 'blob'
            });

            // Maak download link
            const url = window.URL.createObjectURL(new Blob([response.data]));
            const link = document.createElement('a');
            link.href = url;
            link.setAttribute('download', currentResumeInfo.filename || 'resume.pdf');
            document.body.appendChild(link);
            link.click();
            link.remove();
            window.URL.revokeObjectURL(url);

            // Sluit modal als die open is
            const passwordModal = bootstrap.Modal.getInstance(document.getElementById('downloadPasswordModal'));
            if (passwordModal) {
                passwordModal.hide();
            }
            document.getElementById('download_password').value = '';

        } catch (error) {
            if (error.response?.status === 401) {
                showPasswordError('{{ __('messages.incorrect_password_try_again') }}');
            } else if (error.response?.status === 403) {
                showPasswordError('CV is niet beschikbaar voor download. Wachtwoord is verplicht.');
            } else {
                showPasswordError('{{ __('messages.download_error') }}: ' + (error.message || '{{ __('messages.unknown_error') }}'));
            }
        } finally {
            // Herstel de knop
            const confirmBtn = document.getElementById('confirmDownloadBtn');
            confirmBtn.disabled = false;
            confirmBtn.innerHTML = '<i class="bi bi-download me-1"></i>Download';
        }
    };

    const previewResume = async (password = null) => {
        // Wachtwoord is altijd verplicht
        if (!password || password.trim().length === 0) {
            showPasswordError('{{ __('messages.enter_password') }}');
            return;
        }
        
        try {
            const formData = new FormData();
            formData.append('password', password);

            // Toon laad-indicator
            const previewBtn = document.getElementById('confirmPreviewBtn');
            const originalBtnContent = previewBtn.innerHTML;
            previewBtn.disabled = true;
            previewBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Loading...';
            
            hidePasswordError();

            const response = await axios.post('/previewResume', formData, {
                responseType: 'blob'
            });

            // Maak blob URL en open in nieuwe tab
            const url = window.URL.createObjectURL(new Blob([response.data], { type: 'application/pdf' }));
            const previewWindow = window.open(url, '_blank');
            
            if (!previewWindow) {
                // Popup geblokkeerd, toon foutmelding
                showPasswordError('Popup is geblokkeerd. Sta popups toe om preview te bekijken.');
                window.URL.revokeObjectURL(url);
                return;
            }

            // Sluit modal na succesvolle preview
            const passwordModal = bootstrap.Modal.getInstance(document.getElementById('downloadPasswordModal'));
            if (passwordModal) {
                passwordModal.hide();
            }
            document.getElementById('download_password').value = '';

            // Cleanup URL na een tijdje (wanneer window sluit)
            previewWindow.addEventListener('beforeunload', () => {
                window.URL.revokeObjectURL(url);
            });

        } catch (error) {
            if (error.response?.status === 401) {
                showPasswordError('{{ __('messages.incorrect_password_try_again') }}');
            } else if (error.response?.status === 403) {
                showPasswordError('CV is niet beschikbaar voor preview. Wachtwoord is verplicht.');
            } else if (error.response?.status === 400) {
                showPasswordError('Preview is alleen beschikbaar voor PDF bestanden. Gebruik download voor andere bestandstypen.');
            } else {
                showPasswordError('Preview fout: ' + (error.message || '{{ __('messages.unknown_error') }}'));
            }
        } finally {
            // Herstel de knop
            const previewBtn = document.getElementById('confirmPreviewBtn');
            previewBtn.disabled = false;
            previewBtn.innerHTML = '<i class="bi bi-eye me-1"></i>Preview';
        }
    };

    const printResume = async (password = null) => {
        // Wachtwoord is altijd verplicht
        if (!password || password.trim().length === 0) {
            showPasswordError('{{ __('messages.enter_password') }}');
            return;
        }
        
        try {
            const formData = new FormData();
            formData.append('password', password);

            // Toon laad-indicator
            const printBtn = document.getElementById('confirmPrintBtn');
            const originalBtnContent = printBtn.innerHTML;
            printBtn.disabled = true;
            printBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Loading...';
            
            hidePasswordError();

            const response = await axios.post('/downloadResume', formData, {
                responseType: 'blob'
            });

            // Maak blob URL
            const url = window.URL.createObjectURL(new Blob([response.data]));
            
            // Voor PDF: open in nieuwe tab en print
            if (currentResumeInfo.file_type && currentResumeInfo.file_type.toLowerCase() === 'pdf') {
                const printWindow = window.open(url, '_blank');
                if (printWindow) {
                    printWindow.addEventListener('load', function() {
                        printWindow.print();
                    });
                } else {
                    // Popup geblokkeerd, download en toon instructies
                    const link = document.createElement('a');
                    link.href = url;
                    link.setAttribute('download', currentResumeInfo.filename || 'resume.pdf');
                    document.body.appendChild(link);
                    link.click();
                    link.remove();
                    alert('Bestand gedownload. Open het bestand en druk op Ctrl+P (of Cmd+P op Mac) om te printen.');
                }
            } else {
                // Voor andere bestandstypen: download en toon instructies
                const link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', currentResumeInfo.filename || 'resume.pdf');
                document.body.appendChild(link);
                link.click();
                link.remove();
                alert('Bestand gedownload. Open het bestand en druk op Ctrl+P (of Cmd+P op Mac) om te printen.');
            }

            // Sluit modal na succesvolle actie
            const passwordModal = bootstrap.Modal.getInstance(document.getElementById('downloadPasswordModal'));
            if (passwordModal) {
                passwordModal.hide();
            }
            document.getElementById('download_password').value = '';

        } catch (error) {
            if (error.response?.status === 401) {
                showPasswordError('{{ __('messages.incorrect_password_try_again') }}');
            } else if (error.response?.status === 403) {
                showPasswordError('CV is niet beschikbaar voor printen. Wachtwoord is verplicht.');
            } else {
                showPasswordError('Print fout: ' + (error.message || '{{ __('messages.unknown_error') }}'));
            }
        } finally {
            // Herstel de knop
            const printBtn = document.getElementById('confirmPrintBtn');
            printBtn.disabled = false;
            printBtn.innerHTML = '<i class="bi bi-printer me-1"></i>Print';
        }
    };

    // Initialize
    getResumeInfo();
    
    // Zorg ervoor dat de dark mode ook wordt toegepast op de modal
    document.addEventListener('DOMContentLoaded', function() {
        // Check of er een dark mode instelling is
        const isDarkMode = document.body.classList.contains('darkmode');
        
        // Update CSS variabelen voor betere dark mode ondersteuning
        if (isDarkMode) {
            document.documentElement.style.setProperty('--color-primary-rgb', '162, 89, 201');
        } else {
            document.documentElement.style.setProperty('--color-primary-rgb', '95, 46, 234');
        }
        
        // Luister naar dark mode veranderingen
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.attributeName === 'class') {
                    const isDarkMode = document.body.classList.contains('darkmode');
                    if (isDarkMode) {
                        document.documentElement.style.setProperty('--color-primary-rgb', '162, 89, 201');
                    } else {
                        document.documentElement.style.setProperty('--color-primary-rgb', '95, 46, 234');
                    }
                }
            });
        });
        
        observer.observe(document.body, { attributes: true });
    });
</script>

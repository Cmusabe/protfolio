<!-- Modern About Section -->
<section class="modern-about-section">
    <div class="about-container">
        <!-- Main Content Row -->
        <div class="about-main-content">
            <!-- Photo Card (Left) -->
            <div class="photo-card">
                <div class="photo-card-content">
                    <h2 class="photo-name" id="aboutName">Musabe Coucou</h2>
                    <p class="photo-role" id="aboutRole">Analyst Software Developer</p>
                    <div class="accent-line"></div>
                    <div class="photo-container">
                        <img src="{{ asset('assets/m12.png') }}" alt="Musabe Coucou" class="profile-photo">
                    </div>
                </div>
            </div>

            <!-- Bio Section (Right) -->
            <div class="bio-section">
                <div class="spinning-icon">
                    <img src="{{ asset('assets/circle.png') }}" alt="Spinning Icon" class="spinning-icon-img">
                </div>
                <h1 class="bio-title" id="aboutTitle">IK BEN MUSABE COUCOU, EEN ERVAREN ANALYST SOFTWARE DEVELOPER.</h1>
                <div class="bio-content">
                    <p class="bio-text" id="aboutDescription1">Ik houd van het maken van slimme software die werk makkelijker en efficiënter maakt.</p>
                    <p class="bio-text" id="aboutDescription2">Ik heb ervaring met verschillende programmeertalen en frameworks, waaronder Java, React, Node.js, Laravel, en meer.</p>
                    <p class="bio-text" id="aboutDescription3">Ik ben een echte teamspeler en ik hou van samenwerken met anderen om complexe problemen op te lossen.</p>
                </div>
            </div>
        </div>

        <!-- Tools Section -->
        <div class="tools-section">
            <div class="tools-divider"></div>
            <div class="tools-bar">
                <div class="tool-icon" title="Java">
                    <img src="{{ asset('assets/java.png') }}" alt="Java" class="tool-icon-img">
                </div>
                <div class="tool-icon" title="CSS3">
                    <img src="{{ asset('assets/css3.png') }}" alt="CSS3" class="tool-icon-img">
                </div>
                <div class="tool-icon" title="HTML5">
                    <img src="{{ asset('assets/html5.png') }}" alt="HTML5" class="tool-icon-img">
                </div>
                <div class="tool-icon" title="React">
                    <img src="{{ asset('assets/react.png') }}" alt="React" class="tool-icon-img">
                </div>
                <div class="tool-icon" title="Laravel">
                    <img src="{{ asset('assets/Laravel.png') }}" alt="Laravel" class="tool-icon-img">
                </div>
                <div class="tool-icon" title="Figma">
                    <img src="{{ asset('assets/figma.png') }}" alt="Figma" class="tool-icon-img">
                </div>
                <div class="tool-icon" title="Shopify">
                    <img src="{{ asset('assets/shopify.png') }}" alt="Shopify" class="tool-icon-img">
                </div>
                <div class="tool-icon" title="WordPress">
                    <img src="{{ asset('assets/wordpress.png') }}" alt="WordPress" class="tool-icon-img">
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    const getHeroAboutMeProp = async () => {
        try {
            const allProperties = await axios.get('/getAaboutDetails');
            if (allProperties.status === 200 && allProperties.data.length > 0) {
                const data = allProperties.data[0];
                
                // Update photo card elements
                if (document.getElementById('aboutName')) {
                    document.getElementById('aboutName').innerText = data.name || 'Musabe Coucou';
                }
                if (document.getElementById('aboutRole')) {
                    document.getElementById('aboutRole').innerText = data.role || 'Analyst Software Developer';
                }
                
                // Update bio section elements
                if (document.getElementById('aboutTitle')) {
                    document.getElementById('aboutTitle').innerText = data.title || 'IK BEN MUSABE COUCOU, EEN ERVAREN ANALYST SOFTWARE DEVELOPER.';
                }
                if (document.getElementById('aboutDescription1')) {
                    document.getElementById('aboutDescription1').innerText = data.description1 || 'Ik houd van het maken van slimme software die werk makkelijker en efficiënter maakt.';
                }
                if (document.getElementById('aboutDescription2')) {
                    document.getElementById('aboutDescription2').innerText = data.description2 || 'Ik heb ervaring met verschillende programmeertalen en frameworks, waaronder Java, React, Node.js, Laravel, en meer.';
                }
                if (document.getElementById('aboutDescription3')) {
                    document.getElementById('aboutDescription3').innerText = data.description3 || 'Ik ben een echte teamspeler en ik hou van samenwerken met anderen om complexe problemen op te lossen.';
                }
            }
        } catch (error) {
            console.error('Error loading about details:', error);
        }
    };

    // Initialize the about section
    document.addEventListener('DOMContentLoaded', function() {
        getHeroAboutMeProp();
    });

    // Add smooth scroll behavior for better UX
    document.documentElement.style.scrollBehavior = 'smooth';
</script>

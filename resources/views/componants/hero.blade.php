<!-- Header-->
<header class="py-5">
    <div class="container px-5 pb-5">
        <div class="row gx-5 align-items-center">
            <div class="col-xxl-5">
                <!-- Header text content-->
                <div class="text-center text-xxl-start">
                    <div class="badge bg-gradient-primary-to-secondary text-white mb-4"><div class="text-uppercase" id="keyLine">{{ __('messages.design_dev_marketing') }}</div></div>
                    <div class="fs-3 fw-light text-muted" id="title">{{ __('messages.welcome_portfolio') }}</div>
                    <h1 class="display-3 fw-bolder mb-5"><span class="text-gradient d-inline" id="short_title">Musabe Coucou</span></h1>
                    <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xxl-start mb-3 hero-buttons">
                        <a class="btn hero-btn hero-btn-primary" href="{{url('/resume')}}">
                            <i class="bi bi-file-earmark-person me-2"></i>
                            <span>{{ __('messages.cv') }}</span>
                            <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                        <a class="btn hero-btn hero-btn-secondary" href="{{url('/projects')}}">
                            <i class="bi bi-folder2-open me-2"></i>
                            <span>{{ __('messages.projects') }}</span>
                            <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                    
                    <!-- Technology Icons Section -->
                    <div class="hero-tech-icons">
                        <div class="tech-icons-container">
                            <div class="tech-icon" title="Java">
                                <img src="{{ asset('assets/java.png') }}" alt="Java" class="tech-icon-img">
                            </div>
                            <div class="tech-icon" title="CSS3">
                                <img src="{{ asset('assets/css3.png') }}" alt="CSS3" class="tech-icon-img">
                            </div>
                            <div class="tech-icon" title="HTML5">
                                <img src="{{ asset('assets/html5.png') }}" alt="HTML5" class="tech-icon-img">
                            </div>
                            <div class="tech-icon" title="React">
                                <img src="{{ asset('assets/react.png') }}" alt="React" class="tech-icon-img">
                            </div>
                            <div class="tech-icon" title="Laravel">
                                <img src="{{ asset('assets/Laravel.png') }}" alt="Laravel" class="tech-icon-img">
                            </div>
                            <div class="tech-icon" title="Figma">
                                <img src="{{ asset('assets/figma.png') }}" alt="Figma" class="tech-icon-img">
                            </div>
                            <div class="tech-icon" title="Shopify">
                                <img src="{{ asset('assets/shopify.png') }}" alt="Shopify" class="tech-icon-img">
                            </div>
                            <div class="tech-icon" title="WordPress">
                                <img src="{{ asset('assets/wordpress.png') }}" alt="WordPress" class="tech-icon-img">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-7">
                <div class="d-flex justify-content-center mt-5 mt-xxl-0">
                    <div class="profile">
                        <img class="profile-img" id="imgProfile" src="{{asset('assets/linkedin.png')}}" alt="..." />
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    const getHeroProperties = async () =>{
        const allProperties = await axios.get('getHeroproperties');
        if(allProperties.status === 200){
            document.getElementById('keyLine').innerText = allProperties.data[0].keyLine;
            document.getElementById('short_title').innerText = allProperties.data[0].short_title;
            document.getElementById('title').innerText = allProperties.data[0].title;
            document.getElementById('imgProfile').setAttribute('src', allProperties.data[0].img);
        }
    }

    getHeroProperties();
</script>

<style>
/* Hero Buttons Styling */
.hero-buttons {
    gap: 1rem !important;
    position: relative;
    z-index: 1;
}

.hero-btn {
    position: relative;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 1rem 2rem;
    font-size: 1.1rem;
    font-weight: 600;
    border-radius: 16px;
    text-decoration: none;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border: none;
    overflow: hidden;
    min-height: 56px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
    backdrop-filter: blur(10px);
}

.hero-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.hero-btn:hover::before {
    left: 100%;
}

.hero-btn-primary {
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-alt) 100%);
    color: white;
    border: 2px solid transparent;
}

.hero-btn-primary:hover {
    transform: translateY(-3px) scale(1.02);
    box-shadow: 0 8px 32px rgba(95, 46, 234, 0.3);
    color: white;
    text-decoration: none;
}

.hero-btn-primary:active {
    transform: translateY(-1px) scale(1.01);
}

.hero-btn-secondary {
    background: var(--color-card-bg);
    color: var(--color-text);
    border: 2px solid rgba(95, 46, 234, 0.2);
    backdrop-filter: blur(20px);
}

.hero-btn-secondary:hover {
    transform: translateY(-3px) scale(1.02);
    box-shadow: 0 8px 32px rgba(95, 46, 234, 0.2);
    border-color: var(--color-primary);
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-alt) 100%);
    color: white;
    text-decoration: none;
}

.hero-btn-secondary:active {
    transform: translateY(-1px) scale(1.01);
}

.hero-btn i {
    transition: transform 0.3s ease;
}

.hero-btn:hover i:last-child {
    transform: translateX(4px);
}

.hero-btn:hover i:first-child {
    transform: scale(1.1);
}

/* Mobile Optimizations */
@media (max-width: 768px) {
    .hero-buttons {
        flex-direction: column;
        gap: 0.75rem !important;
        width: 100%;
    }
    
    .hero-btn {
        width: 100%;
        padding: 1.25rem 1.5rem;
        font-size: 1rem;
        min-height: 60px;
        border-radius: 20px;
    }
    
    .hero-btn i {
        font-size: 1.1rem;
    }
}

@media (max-width: 576px) {
    .hero-btn {
        padding: 1rem 1.25rem;
        font-size: 0.95rem;
        min-height: 56px;
        border-radius: 16px;
    }
    
    .hero-btn i {
        font-size: 1rem;
    }
}

/* Dark Mode Adjustments */
body.darkmode .hero-btn-secondary {
    background: var(--color-card-bg);
    color: var(--color-text);
    border-color: rgba(162, 89, 201, 0.3);
}

body.darkmode .hero-btn-secondary:hover {
    border-color: var(--color-primary);
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-alt) 100%);
    color: white;
}

body.darkmode .hero-btn-primary {
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-alt) 100%);
}

body.darkmode .hero-btn-primary:hover {
    box-shadow: 0 8px 32px rgba(162, 89, 201, 0.3);
}

/* Animation for button entrance */
.hero-btn {
    animation: slideInUp 0.6s ease-out;
}

.hero-btn:nth-child(2) {
    animation-delay: 0.1s;
}

@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Focus states for accessibility */
.hero-btn:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(95, 46, 234, 0.3);
}

body.darkmode .hero-btn:focus {
    box-shadow: 0 0 0 3px rgba(162, 89, 201, 0.3);
}

/* Hero Technology Icons */
.hero-tech-icons {
    margin-top: 2rem;
    display: flex;
    justify-content: center;
}

@media (min-width: 1200px) {
    .hero-tech-icons {
        justify-content: flex-start;
    }
}

.tech-icons-container {
    display: flex;
    gap: 0.75rem;
    flex-wrap: nowrap;
    justify-content: center;
    align-items: center;
    padding: 0.5rem 0;
}

.tech-icon {
    width: 45px;
    height: 45px;
    background-color: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: pointer;
    position: relative;
    backdrop-filter: blur(10px);
    flex-shrink: 0;
}

.tech-icon:hover {
    transform: translateY(-3px) scale(1.1) rotate(360deg);
    background-color: rgba(95, 46, 234, 0.2);
    border-color: var(--color-primary);
    box-shadow: 0 8px 24px rgba(95, 46, 234, 0.3);
}

.tech-icon-img {
    width: 24px;
    height: 24px;
    object-fit: contain;
    transition: inherit;
}

/* Dark mode tech icons */
body.darkmode .tech-icon {
    background-color: rgba(255, 255, 255, 0.05);
    border-color: rgba(255, 255, 255, 0.1);
}

body.darkmode .tech-icon:hover {
    background-color: rgba(162, 89, 201, 0.2);
    border-color: var(--color-primary);
    box-shadow: 0 8px 24px rgba(162, 89, 201, 0.3);
}

/* Light mode tech icons */
body:not(.darkmode) .tech-icon {
    background-color: rgba(0, 0, 0, 0.05);
    border-color: rgba(0, 0, 0, 0.1);
}

body:not(.darkmode) .tech-icon:hover {
    background-color: rgba(95, 46, 234, 0.1);
    border-color: var(--color-primary);
    box-shadow: 0 8px 24px rgba(95, 46, 234, 0.2);
}

/* Tooltip styling for hero tech icons */
.tech-icon::before {
    content: attr(title);
    position: absolute;
    bottom: -40px;
    left: 50%;
    transform: translateX(-50%);
    background-color: #212529;
    color: #ffffff;
    padding: 6px 10px;
    border-radius: 6px;
    font-size: 0.8rem;
    font-weight: 500;
    white-space: nowrap;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    z-index: 1000;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
}

.tech-icon::after {
    content: '';
    position: absolute;
    bottom: -32px;
    left: 50%;
    transform: translateX(-50%);
    border: 5px solid transparent;
    border-bottom-color: #212529;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    z-index: 1000;
}

.tech-icon:hover::before,
.tech-icon:hover::after {
    opacity: 1;
    visibility: visible;
}

/* Light mode tooltips */
body:not(.darkmode) .tech-icon::before {
    background-color: #ffffff;
    color: #212529;
    border: 1px solid #e9ecef;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

body:not(.darkmode) .tech-icon::after {
    border-bottom-color: #ffffff;
}

/* Mobile responsive */
@media (max-width: 768px) {
    .tech-icons-container {
        gap: 0.5rem;
        padding: 0.25rem 0;
    }
    
    .tech-icon {
        width: 40px;
        height: 40px;
    }
    
    .tech-icon-img {
        width: 20px;
        height: 20px;
    }
}

@media (max-width: 576px) {
    .tech-icons-container {
        gap: 0.4rem;
        padding: 0.25rem 0;
    }
    
    .tech-icon {
        width: 36px;
        height: 36px;
    }
    
    .tech-icon-img {
        width: 18px;
        height: 18px;
    }
}
</style>

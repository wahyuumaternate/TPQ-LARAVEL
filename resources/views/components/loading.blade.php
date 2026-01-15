<div id="preloader" class="preloader">
    <div class="preloader-content">
        <div class="logo-container">
            <img src="{{ asset('images/logo-tpq-2.png') }}" alt="TPQ Khairunnisa" class="logo-animate">
        </div>
        <div class="loading-text">
            <h3>TPQ Khairunnisa</h3>
            <p>Memuat halaman...</p>
        </div>
        <div class="spinner">
            <div class="spinner-ring"></div>
            <div class="spinner-ring"></div>
            <div class="spinner-ring"></div>
        </div>
    </div>
</div>

<style>
    .preloader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        transition: opacity 0.5s ease, visibility 0.5s ease;
    }

    .preloader.hide {
        opacity: 0;
        visibility: hidden;
    }

    .preloader-content {
        text-align: center;
        position: relative;
    }

    .logo-container {
        margin-bottom: 30px;
        animation: logoFadeIn 1s ease-in-out;
    }

    .logo-animate {
        width: 120px;
        height: auto;
        animation: logoPulse 2s ease-in-out infinite;
        filter: drop-shadow(0 10px 30px rgba(37, 99, 235, 0.2));
    }

    .loading-text {
        margin-bottom: 30px;
        animation: textFadeIn 1s ease-in-out 0.3s both;
    }

    .loading-text h3 {
        font-size: 24px;
        font-weight: 700;
        color: #2563eb;
        margin-bottom: 8px;
        font-family: 'Poppins', sans-serif;
    }

    .loading-text p {
        font-size: 14px;
        color: #6b7280;
        margin: 0;
    }

    .spinner {
        position: relative;
        width: 80px;
        height: 80px;
        margin: 0 auto;
    }

    .spinner-ring {
        position: absolute;
        width: 100%;
        height: 100%;
        border: 4px solid transparent;
        border-top-color: #2563eb;
        border-radius: 50%;
        animation: spin 1.5s cubic-bezier(0.68, -0.55, 0.265, 1.55) infinite;
    }

    .spinner-ring:nth-child(2) {
        width: 70px;
        height: 70px;
        top: 5px;
        left: 5px;
        border-top-color: #60a5fa;
        animation-delay: -0.4s;
    }

    .spinner-ring:nth-child(3) {
        width: 60px;
        height: 60px;
        top: 10px;
        left: 10px;
        border-top-color: #93c5fd;
        animation-delay: -0.8s;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    @keyframes logoPulse {

        0%,
        100% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.05);
        }
    }

    @keyframes logoFadeIn {
        0% {
            opacity: 0;
            transform: translateY(-20px);
        }

        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes textFadeIn {
        0% {
            opacity: 0;
            transform: translateY(10px);
        }

        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Shimmer effect */
    .logo-animate::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg,
                transparent,
                rgba(255, 255, 255, 0.8),
                transparent);
        animation: shimmer 3s infinite;
    }

    @keyframes shimmer {
        0% {
            left: -100%;
        }

        100% {
            left: 100%;
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .logo-animate {
            width: 100px;
        }

        .loading-text h3 {
            font-size: 20px;
        }

        .loading-text p {
            font-size: 13px;
        }

        .spinner {
            width: 60px;
            height: 60px;
        }

        .spinner-ring:nth-child(2) {
            width: 50px;
            height: 50px;
            top: 5px;
            left: 5px;
        }

        .spinner-ring:nth-child(3) {
            width: 40px;
            height: 40px;
            top: 10px;
            left: 10px;
        }
    }
</style>

<script>
    // Hide preloader when page is fully loaded
    window.addEventListener('load', function() {
        const preloader = document.getElementById('preloader');
        if (preloader) {
            setTimeout(function() {
                preloader.classList.add('hide');
                // Remove from DOM after transition
                setTimeout(function() {
                    preloader.remove();
                }, 500);
            }, 500); // Delay sedikit agar animasi terlihat
        }
    });

    // Show preloader on navigation (optional)
    document.addEventListener('DOMContentLoaded', function() {
        const links = document.querySelectorAll('a:not([target="_blank"]):not([href^="#"])');

        links.forEach(link => {
            link.addEventListener('click', function(e) {
                // Skip for logout and external links
                if (this.href.includes('logout') || this.href.startsWith('javascript:')) {
                    return;
                }

                // Show preloader
                const preloader = document.getElementById('preloader');
                if (preloader && preloader.classList.contains('hide')) {
                    preloader.classList.remove('hide');
                }
            });
        });
    });
</script>

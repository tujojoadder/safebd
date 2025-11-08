<!-- Blade Component -->
<section class="hero-section">
    <div class="container">
        <div class="hero-wrapper">
            <div class="hero-content">
                <h1 class="hero-title">রক্তদান জীবনদান</h1>
                <p class="hero-subtitle">
                    মানবতার সেবায় নিবেদিত - একটি রক্তদান একটি জীবন বাঁচায়
                </p>
                <div class="hero-buttons">
                    <button class="btn btn-light btn-lg px-5 py-3 rounded-pill">
                        <i class="fas fa-tint me-2"></i>রক্ত খুঁজুন
                    </button>
                    <button class="btn btn-outline-light btn-lg px-5 py-3 rounded-pill">
                        <i class="fas fa-hand-holding-heart me-2"></i>রক্তদাতা হন
                    </button>
                </div>
                <div class="hero-stats">
                    <div class="stat-item">
                        <span class="stat-number">500+</span>
                        <span class="stat-label">রক্তদাতা</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">1200+</span>
                        <span class="stat-label">জীবন বাঁচানো হয়েছে</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">8</span>
                        <span class="stat-label">রক্তের গ্রুপ</span>
                    </div>
                </div>
            </div>
            <div class="hero-image">
                <div class="image-slider">
                    <div class="slider-track">
                        <img src="{{ asset('frontend/safebd/normal/5.jpg') }}" alt="Blood Donation 1"
                            class="slider-image active">
                        <img src="{{ asset('frontend/safebd/normal/48.jpg') }}" alt="Blood Donation 2"
                            class="slider-image">
                        <img src="{{ asset('frontend/safebd/normal/16.jpg') }}" alt="Blood Donation 3"
                            class="slider-image">
                        <img src="{{ asset('frontend/safebd/normal/22.jpg') }}" alt="Blood Donation 4"
                            class="slider-image">
                        <img src="{{ asset('frontend/safebd/normal/23.jpg') }}" alt="Blood Donation 5"
                            class="slider-image">
                        <img src="{{ asset('frontend/safebd/normal/4.jpg') }}" alt="Blood Donation 6"
                            class="slider-image">
                    </div>
                    <div class="slider-dots">
                        <span class="dot active" data-slide="0"></span>
                        <span class="dot" data-slide="1"></span>
                        <span class="dot" data-slide="2"></span>
                        <span class="dot" data-slide="3"></span>
                        <span class="dot" data-slide="4"></span>
                        <span class="dot" data-slide="5"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Hero Section */
    .hero-section {
        position: relative;
        min-height: 600px;
        background: linear-gradient(135deg,
                rgba(16, 185, 129, 0.95),
                rgba(4, 120, 87, 0.95)),
            url("https://images.unsplash.com/photo-1615461066841-6116e61058f4?w=1920") center/cover;
        display: flex;
        align-items: center;
        color: white;
        overflow: hidden;
        padding: 80px 0;
    }

    .hero-section::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at 20% 50%,
                rgba(255, 255, 255, 0.1) 0%,
                transparent 60%);
    }

    .hero-wrapper {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 60px;
        align-items: center;
        position: relative;
        z-index: 2;
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero-title {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 20px;
        text-shadow: 2px 4px 8px rgba(0, 0, 0, 0.2);
        line-height: 1.2;
    }

    .hero-subtitle {
        font-size: 1.25rem;
        margin-bottom: 35px;
        opacity: 0.95;
        line-height: 1.6;
    }

    .hero-buttons {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        margin-bottom: 40px;
    }

    .hero-stats {
        display: flex;
        gap: 40px;
        flex-wrap: wrap;
    }

    .stat-item {
        text-align: center;
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        display: block;
        line-height: 1;
        margin-bottom: 5px;
    }

    .stat-label {
        font-size: 0.95rem;
        opacity: 0.9;
    }

    /* Image Slider */
    .hero-image {
        position: relative;
        z-index: 2;
    }

    .image-slider {
        position: relative;
        width: 100%;
        overflow: hidden;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
        border: 4px solid rgba(255, 255, 255, 0.2);
    }

    .slider-track {
        position: relative;
        width: 100%;
        height: 400px;
    }

    .slider-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0;
        transition: opacity 0.8s ease-in-out;
        filter: brightness(0.8) contrast(1.1) saturate(1.2);
    }

    .slider-image.active {
        opacity: 1;
    }

    .slider-dots {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 10px;
        z-index: 3;
    }

    .dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.5);
        cursor: pointer;
        transition: all 0.3s ease;
        border: 2px solid rgba(255, 255, 255, 0.8);
    }

    .dot:hover {
        background: rgba(255, 255, 255, 0.8);
        transform: scale(1.1);
    }

    .dot.active {
        background: white;
        width: 32px;
        border-radius: 6px;
    }

    /* Responsive Design */
    @media (max-width: 992px) {
        .hero-wrapper {
            grid-template-columns: 1fr;
            gap: 40px;
        }

        .hero-title {
            font-size: 2.5rem;
        }

        .hero-subtitle {
            font-size: 1.1rem;
        }

        .hero-image {
            order: -1;
        }

        .slider-track {
            height: 350px;
        }
    }

    @media (max-width: 768px) {
        .hero-section {
            padding: 60px 0;
            min-height: auto;
        }

        .hero-title {
            font-size: 2rem;
        }

        .hero-subtitle {
            font-size: 1rem;
        }

        .hero-buttons {
            flex-direction: column;
        }

        .hero-buttons .btn {
            width: 100%;
        }

        .hero-stats {
            gap: 30px;
            justify-content: space-around;
        }

        .stat-number {
            font-size: 2rem;
        }

        .stat-label {
            font-size: 0.85rem;
        }

        .slider-track {
            height: 300px;
        }
    }

    @media (max-width: 576px) {
        .hero-stats {
            gap: 20px;
        }

        .stat-item {
            flex: 1;
            min-width: 80px;
        }

        .slider-track {
            height: 250px;
        }

        .dot {
            width: 10px;
            height: 10px;
        }

        .dot.active {
            width: 24px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const images = document.querySelectorAll('.slider-image');
        const dots = document.querySelectorAll('.dot');
        let currentSlide = 0;
        const slideInterval = 3000; // 3 seconds

        function showSlide(index) {
            // Remove active class from all
            images.forEach(img => img.classList.remove('active'));
            dots.forEach(dot => dot.classList.remove('active'));

            // Add active class to current
            images[index].classList.add('active');
            dots[index].classList.add('active');
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % images.length;
            showSlide(currentSlide);
        }

        // Auto slide
        let autoSlide = setInterval(nextSlide, slideInterval);

        // Dot click handlers
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                currentSlide = index;
                showSlide(currentSlide);

                // Reset auto slide
                clearInterval(autoSlide);
                autoSlide = setInterval(nextSlide, slideInterval);
            });
        });

        // Pause on hover
        const slider = document.querySelector('.image-slider');
        slider.addEventListener('mouseenter', () => {
            clearInterval(autoSlide);
        });

        slider.addEventListener('mouseleave', () => {
            autoSlide = setInterval(nextSlide, slideInterval);
        });
    });
</script>

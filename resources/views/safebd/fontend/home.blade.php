@extends('safebd.fontend.layouts.app')

@section('title', 'হোম - সেফ বাংলাদেশ ফাউন্ডেশন')

@push('styles')
<style>
    /* Hero Section */
    .hero-section {
        position: relative;
        min-height: 600px;
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.95), rgba(4, 120, 87, 0.95)),
            url("https://images.unsplash.com/photo-1615461066841-6116e61058f4?w=1920") center/cover;
        display: flex;
        align-items: center;
        color: white;
        overflow: hidden;
    }

    .hero-section::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 60%);
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero-title {
        font-size: 4rem;
        font-weight: 700;
        margin-bottom: 20px;
        text-shadow: 2px 4px 8px rgba(0, 0, 0, 0.2);
        line-height: 1.2;
    }

    .hero-subtitle {
        font-size: 1.4rem;
        margin-bottom: 35px;
        opacity: 0.95;
    }

    .hero-stats {
        display: flex;
        gap: 40px;
        margin-top: 40px;
    }

    .stat-item {
        text-align: center;
    }

    .stat-number {
        font-size: 3rem;
        font-weight: 700;
        display: block;
    }

    .stat-label {
        font-size: 1rem;
        opacity: 0.9;
    }

    /* Blood Bank Cards */
    .blood-section {
        padding: 80px 0;
        background: var(--light);
    }

    .section-header {
        text-align: center;
        margin-bottom: 60px;
    }

    .section-title {
        font-size: 2.8rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 15px;
        position: relative;
        display: inline-block;
    }

    .section-title::after {
        content: "";
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: linear-gradient(90deg, var(--accent-orange), var(--primary-green));
        border-radius: 2px;
    }

    .blood-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 25px;
        margin-bottom: 60px;
    }

    .blood-card {
        background: white;
        border-radius: 20px;
        padding: 30px 20px;
        text-align: center;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.06);
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
    }

    .blood-card::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--blood-red), #dc2626);
        transform: scaleX(0);
        transition: transform 0.4s ease;
    }

    .blood-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
    }

    .blood-card:hover::before {
        transform: scaleX(1);
    }

    .blood-drop {
        width: 70px;
        height: 70px;
        margin: 0 auto 20px;
        filter: drop-shadow(0 5px 15px rgba(239, 68, 68, 0.3));
        transition: transform 0.4s ease;
    }

    .blood-card:hover .blood-drop {
        transform: scale(1.1) rotate(10deg);
    }

    .blood-group {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 10px;
    }

    .blood-count {
        font-size: 2.2rem;
        font-weight: 700;
        color: var(--blood-red);
    }

    .count-label {
        font-size: 0.85rem;
        color: #6b7280;
        margin-top: 5px;
    }

    /* Search Section */
    .search-section {
        background: white;
        border-radius: 30px;
        padding: 50px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
        position: relative;
        overflow: hidden;
    }

    .search-section::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(90deg, var(--primary-green), var(--accent-orange));
    }

    .search-title {
        font-size: 2rem;
        font-weight: 700;
        color: var(--dark);
        text-align: center;
        margin-bottom: 40px;
    }

    .search-title i {
        color: var(--primary-green);
        margin-right: 10px;
    }

    .form-label {
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 10px;
        font-size: 0.95rem;
    }

    .form-select, .form-control {
        border: 2px solid #e5e7eb;
        border-radius: 15px;
        padding: 14px 18px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #f9fafb;
    }

    .form-select:focus, .form-control:focus {
        border-color: var(--primary-green);
        box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
        background: white;
    }

    .btn-search {
        background: linear-gradient(135deg, var(--primary-green), var(--dark-green));
        color: white;
        border: none;
        padding: 16px 50px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
    }

    .btn-search:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(16, 185, 129, 0.4);
    }

    /* Info Cards */
    .info-section {
        padding: 80px 0;
        background: white;
    }

    .info-card {
        background: white;
        border-radius: 25px;
        padding: 40px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.06);
        height: 100%;
        transition: all 0.4s ease;
        border: 1px solid #f3f4f6;
    }

    .info-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.12);
    }

    .info-image {
        width: 100%;
        height: 280px;
        object-fit: cover;
        border-radius: 20px;
        margin-bottom: 25px;
        transition: transform 0.4s ease;
    }

    .info-card:hover .info-image {
        transform: scale(1.05);
    }

    .info-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 20px;
    }

    .info-title i {
        color: var(--primary-green);
        margin-right: 10px;
    }

    .info-text {
        color: #4b5563;
        line-height: 1.8;
        font-size: 1.05rem;
    }

    /* Profile Section */
    .profile-section {
        padding: 80px 0;
        background: linear-gradient(135deg, #f0fdf4 0%, #ecfdf5 100%);
    }

    .profile-card {
        background: white;
        border-radius: 25px;
        padding: 40px;
        text-align: center;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        transition: all 0.4s ease;
    }

    .profile-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    }

    .profile-img {
        width: 180px;
        height: 180px;
        border-radius: 25px;
        object-fit: cover;
        margin: 0 auto 25px;
        border: 5px solid var(--primary-green);
        box-shadow: 0 10px 30px rgba(16, 185, 129, 0.3);
    }

    .profile-name {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 10px;
    }

    .profile-role {
        color: var(--primary-green);
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 20px;
    }

    .btn-more {
        background: var(--primary-green);
        color: white;
        padding: 12px 35px;
        border-radius: 50px;
        font-weight: 600;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-more:hover {
        background: var(--dark-green);
        transform: scale(1.05);
    }

    /* Gallery Section */
    .gallery-section {
        padding: 80px 0;
        background: white;
    }

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        margin-top: 50px;
    }

    .gallery-item {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        height: 280px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        transition: all 0.4s ease;
    }

    .gallery-item:hover {
        transform: scale(1.05);
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.15);
    }

    .gallery-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem;
        }
        .section-title {
            font-size: 2rem;
        }
        .blood-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .search-section {
            padding: 30px 20px;
        }
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="hero-content">
            <h1 class="hero-title">রক্তদান জীবনদান</h1>
            <p class="hero-subtitle">
                মানবতার সেবায় নিবেদিত - একটি রক্তদান একটি জীবন বাঁচায়
            </p>
            <div class="d-flex gap-3 flex-wrap">
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
    </div>
</section>

<!-- Blood Bank Section -->
<section class="blood-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">সেফ ব্লাড ব্যাংক</h2>
            <p class="text-muted">উপলব্ধ রক্তদাতাদের তালিকা</p>
        </div>

        <div class="blood-grid">
            @foreach([
                ['group' => 'A+', 'count' => 7],
                ['group' => 'A-', 'count' => 1],
                ['group' => 'AB+', 'count' => 3],
                ['group' => 'AB-', 'count' => 0],
                ['group' => 'B+', 'count' => 8],
                ['group' => 'B-', 'count' => 1],
                ['group' => 'O+', 'count' => 7],
                ['group' => 'O-', 'count' => 0]
            ] as $blood)
            <div class="blood-card">
                <img src="https://cdn-icons-png.flaticon.com/512/2913/2913133.png" alt="Blood" class="blood-drop" />
                <div class="blood-group">{{ $blood['group'] }}</div>
                <div class="blood-count">{{ $blood['count'] }}</div>
                <div class="count-label">দাতা উপলব্ধ</div>
            </div>
            @endforeach
        </div>

        <!-- Search Section -->
        <div class="search-section">
            <h3 class="search-title">
                <i class="fas fa-search"></i>রক্তের সন্ধান করুন
            </h3>
            <form action="" method="POST">
                @csrf
                <div class="row g-4">
                    <div class="col-md-3">
                        <label class="form-label">রক্তের গ্রুপ</label>
                        <select name="blood_group" class="form-select" required>
                            <option value="">নির্বাচন করুন</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">বিভাগ</label>
                        <select name="division" class="form-select" required>
                            <option value="">বিভাগ নির্বাচন করুন</option>
                            <option value="ঢাকা">ঢাকা</option>
                            <option value="চট্টগ্রাম">চট্টগ্রাম</option>
                            <option value="রাজশাহী">রাজশাহী</option>
                            <option value="খুলনা">খুলনা</option>
                            <option value="সিলেট">সিলেট</option>
                            <option value="বরিশাল">বরিশাল</option>
                            <option value="রংপুর">রংপুর</option>
                            <option value="ময়মনসিংহ">ময়মনসিংহ</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">জেলা</label>
                        <select name="district" class="form-select" required>
                            <option value="">জেলা নির্বাচন করুন</option>
                            <option value="কিশোরগঞ্জ">কিশোরগঞ্জ</option>
                            <option value="নরসিংদী">নরসিংদী</option>
                            <option value="গাজীপুর">গাজীপুর</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">থানা/উপজেলা</label>
                        <select name="thana" class="form-select">
                            <option value="">থানা নির্বাচন করুন</option>
                            <option value="ভৈরব">ভৈরব</option>
                            <option value="কুলিয়ারচর">কুলিয়ারচর</option>
                            <option value="হোসেনপুর">হোসেনপুর</option>
                        </select>
                    </div>
                    <div class="col-12 text-center mt-4">
                        <button type="submit" class="btn-search">
                            <i class="fas fa-search me-2"></i>অনুসন্ধান করুন
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Info Section -->
<section class="info-section">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="info-card">
                    <img src="https://images.unsplash.com/photo-1615461066159-fea0960485d5?w=800&q=80" alt="Blood Donation" class="info-image" />
                    <h3 class="info-title">
                        <i class="fas fa-info-circle"></i>ই-ব্লাড ব্যাংক সম্পর্কে
                    </h3>
                    <p class="info-text">
                        সেফ বাংলাদেশ ফাউন্ডেশন একটি অরাজনৈতিক, অলাভজনক স্বেচ্ছাসেবী প্রতিষ্ঠান। রক্তদান মাধ্যমে মানুষের পাশে দাঁড়ানো এবং জীবন বাঁচানোই আমাদের মূল লক্ষ্য। আমরা বিশ্বাস করি, একটি রক্তদান একটি জীবন বাঁচাতে পারে। আমাদের এই ডিজিটাল প্ল্যাটফর্মের মাধ্যমে রক্তদাতা এবং রক্তগ্রহীতাদের মধ্যে সহজ যোগাযোগ স্থাপন করা সম্ভব হচ্ছে।
                    </p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="info-card">
                    <img src="https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?w=800&q=80" alt="Registration" class="info-image" />
                    <h3 class="info-title">
                        <i class="fas fa-user-plus"></i>ডোনার রেজিস্ট্রেশন
                    </h3>
                    <p class="info-text">
                        রক্তদান করে আপনিও হতে পারেন একজন জীবনদাতা। আমাদের সাথে নিবন্ধন করুন এবং প্রয়োজনের সময় রক্তদানের মাধ্যমে অসহায় মানুষের পাশে দাঁড়ান। রেজিস্ট্রেশন প্রক্রিয়া অত্যন্ত সহজ এবং আপনার তথ্য সম্পূর্ণ নিরাপদ থাকবে। প্রতিটি রক্তদান একটি মহৎ কাজ এবং আপনি হতে পারেন কারো জীবন রক্ষাকারী।
                    </p>
                    <div class="mt-4 p-4 bg-light rounded-4">
                        <h5 class="text-center mb-0" style="color: var(--primary-green)">
                            <i class="fas fa-award"></i> রেজিস্ট্রেশন নং: এস-১২১২৯/২০১৫
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Profile Section -->
<section class="profile-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">আমাদের নেতৃত্ব</h2>
            <p class="text-muted">যারা সংগঠনকে নেতৃত্ব দিচ্ছেন</p>
        </div>
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="profile-card">
                    <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?w=400&q=80" alt="Leader" class="profile-img" />
                    <h3 class="profile-name">আঃ মাসুদ করিম</h3>
                    <p class="profile-role">চেয়ারম্যান</p>
                    <p class="text-muted mb-3">সেফ বাংলাদেশ ফাউন্ডেশন</p>
                    <button class="btn-more">
                        <i class="fas fa-arrow-right me-2"></i>বিস্তারিত দেখুন
                    </button>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="info-card">
                    <h3 class="info-title">
                        <i class="fas fa-bullseye"></i>উদ্দেশ্য ও লক্ষ্য
                    </h3>
                    <p class="info-text">
                        সেফ বাংলাদেশ ফাউন্ডেশন একটি অরাজনৈতিক, অলাভজনক স্বেচ্ছাসেবী বেসরকারী সংস্থা। দেশীয় ও আন্তর্জাতিক বিধিবিধান ও আইনের শর্তাদি মেনে প্রয়োজনীয় সমস্ত কাজ প্রস্তাব, পরিকল্পনা, অধ্যয়ন ও গৃহীত সিদ্ধান্ত বাস্তবায়ন ও মূল্যায়নের মাধ্যমে এ ধরণের সব ধরনের কার্যাবলী সম্পাদন করতে পারবে।
                    </p>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-start mb-3">
                                <div class="me-3" style="color: var(--primary-green); font-size: 1.5rem">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div>
                                    <h5>মানবসেবা</h5>
                                    <p class="text-muted mb-0">অসহায় মানুষের পাশে দাঁড়ানো</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-start mb-3">
                                <div class="me-3" style="color: var(--primary-green); font-size: 1.5rem">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div>
                                    <h5>রক্তদান সেবা</h5>
                                    <p class="text-muted mb-0">সহজে রক্তদাতা খুঁজে পাওয়া</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-start mb-3">
                                <div class="me-3" style="color: var(--primary-green); font-size: 1.5rem">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div>
                                    <h5>সচেতনতা বৃদ্ধি</h5>
                                    <p class="text-muted mb-0">রক্তদান সম্পর্কে জনসচেতনতা</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-start mb-3">
                                <div class="me-3" style="color: var(--primary-green); font-size: 1.5rem">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div>
                                    <h5>ডিজিটাল সেবা</h5>
                                    <p class="text-muted mb-0">অনলাইন রক্ত ব্যাংক ব্যবস্থা</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section class="gallery-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">ছবি গ্যালারি</h2>
            <p class="text-muted">আমাদের কার্যক্রমের ছবি</p>
        </div>
        <div class="gallery-grid">
            @foreach([
                'https://images.unsplash.com/photo-1615461065929-4f8ffed6c0af?w=600&q=80',
                'https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?w=600&q=80',
                'https://images.unsplash.com/photo-1631815589968-fdb09a223b1e?w=600&q=80',
                'https://images.unsplash.com/photo-1615461066841-6116e61058f4?w=600&q=80',
                'https://images.unsplash.com/photo-1631815588090-d4bfec5b1ccb?w=600&q=80',
                'https://images.unsplash.com/photo-1516841273335-e39b37888115?w=600&q=80'
            ] as $index => $image)
            <div class="gallery-item">
                <img src="{{ $image }}" alt="Gallery Image {{ $index + 1 }}" class="gallery-img" />
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: "0px 0px -100px 0px",
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = "1";
                entry.target.style.transform = "translateY(0)";
            }
        });
    }, observerOptions);

    document.querySelectorAll(".blood-card, .info-card, .profile-card, .gallery-item").forEach((el) => {
        el.style.opacity = "0";
        el.style.transform = "translateY(30px)";
        el.style.transition = "all 0.6s ease";
        observer.observe(el);
    });
</script>
@endpush
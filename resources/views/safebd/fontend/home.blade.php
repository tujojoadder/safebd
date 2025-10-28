@extends('safebd.fontend.layouts.app')

@section('title', 'হোম - সেফ বাংলাদেশ ফাউন্ডেশন')

@push('styles')
 <link rel="stylesheet" href="{{ asset('css/home.css') }}">
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
                @foreach ([['group' => 'A+', 'count' => $members->where('blood', 1)->count() ?? 0], ['group' => 'A-', 'count' => $members->where('blood', 2)->count() ?? 0], ['group' => 'AB+', 'count' => $members->where('blood', 3)->count() ?? 0], ['group' => 'AB-', 'count' => $members->where('blood', 4)->count() ?? 0], ['group' => 'B+', 'count' => $members->where('blood', 5)->count() ?? 0], ['group' => 'B-', 'count' => $members->where('blood', 6)->count() ?? 0], ['group' => 'O+', 'count' => $members->where('blood', 7)->count() ?? 0], ['group' => 'O-', 'count' => $members->where('blood', 8)->count() ?? 0]] as $blood)
                    <div class="blood-card">
                        <i class="fas fa-tint blood-drop"></i>
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
                        <img src="https://images.unsplash.com/photo-1615461066159-fea0960485d5?w=800&q=80"
                            alt="Blood Donation" class="info-image" />
                        <h3 class="info-title">
                            <i class="fas fa-info-circle"></i>ই-ব্লাড ব্যাংক সম্পর্কে
                        </h3>
                        <p class="info-text">
                            সেফ বাংলাদেশ ফাউন্ডেশন একটি অরাজনৈতিক, অলাভজনক স্বেচ্ছাসেবী প্রতিষ্ঠান। রক্তদান মাধ্যমে মানুষের
                            পাশে দাঁড়ানো এবং জীবন বাঁচানোই আমাদের মূল লক্ষ্য। আমরা বিশ্বাস করি, একটি রক্তদান একটি জীবন
                            বাঁচাতে পারে। আমাদের এই ডিজিটাল প্ল্যাটফর্মের মাধ্যমে রক্তদাতা এবং রক্তগ্রহীতাদের মধ্যে সহজ
                            যোগাযোগ স্থাপন করা সম্ভব হচ্ছে।
                        </p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="info-card">
                        <img src="https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?w=800&q=80"
                            alt="Registration" class="info-image" />
                        <h3 class="info-title">
                            <i class="fas fa-user-plus"></i>ডোনার রেজিস্ট্রেশন
                        </h3>
                        <p class="info-text">
                            রক্তদান করে আপনিও হতে পারেন একজন জীবনদাতা। আমাদের সাথে নিবন্ধন করুন এবং প্রয়োজনের সময়
                            রক্তদানের মাধ্যমে অসহায় মানুষের পাশে দাঁড়ান। রেজিস্ট্রেশন প্রক্রিয়া অত্যন্ত সহজ এবং আপনার
                            তথ্য সম্পূর্ণ নিরাপদ থাকবে। প্রতিটি রক্তদান একটি মহৎ কাজ এবং আপনি হতে পারেন কারো জীবন রক্ষাকারী।
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
                        <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?w=400&q=80" alt="Leader"
                            class="profile-img" />
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
                            সেফ বাংলাদেশ ফাউন্ডেশন একটি অরাজনৈতিক, অলাভজনক স্বেচ্ছাসেবী বেসরকারী সংস্থা। দেশীয় ও
                            আন্তর্জাতিক বিধিবিধান ও আইনের শর্তাদি মেনে প্রয়োজনীয় সমস্ত কাজ প্রস্তাব, পরিকল্পনা, অধ্যয়ন ও
                            গৃহীত সিদ্ধান্ত বাস্তবায়ন ও মূল্যায়নের মাধ্যমে এ ধরণের সব ধরনের কার্যাবলী সম্পাদন করতে পারবে।
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
                @foreach (['https://images.unsplash.com/photo-1615461065929-4f8ffed6c0af?w=600&q=80', 'https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?w=600&q=80', 'https://images.unsplash.com/photo-1631815589968-fdb09a223b1e?w=600&q=80', 'https://images.unsplash.com/photo-1615461066841-6116e61058f4?w=600&q=80', 'https://images.unsplash.com/photo-1631815588090-d4bfec5b1ccb?w=600&q=80', 'https://images.unsplash.com/photo-1516841273335-e39b37888115?w=600&q=80'] as $index => $image)
                    <div class="gallery-item">
                        <img src="{{ $image }}" alt="Gallery Image {{ $index + 1 }}" class="gallery-img" />
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@push('scripts')
  <script src="{{ asset('js/home.js') }}"></script>
@endpush

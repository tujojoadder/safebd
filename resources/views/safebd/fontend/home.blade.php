@extends('safebd.fontend.layouts.app')

@section('title', 'হোম - সেফ বাংলাদেশ ফাউন্ডেশন')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('content')
    <!-- Hero Section -->
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
                    <img src="{{ asset('frontend/safebd/normal/head.jpg') }}" alt="Blood Donation"
                        class="img-fluid">
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
                @foreach ([['id' => 1, 'group' => 'A+', 'count' => $members->where('blood', 1)->count() ?? 0], ['id' => 2, 'group' => 'A-', 'count' => $members->where('blood', 2)->count() ?? 0], ['id' => 3, 'group' => 'AB+', 'count' => $members->where('blood', 3)->count() ?? 0], ['id' => 4, 'group' => 'AB-', 'count' => $members->where('blood', 4)->count() ?? 0], ['id' => 5, 'group' => 'B+', 'count' => $members->where('blood', 5)->count() ?? 0], ['id' => 6, 'group' => 'B-', 'count' => $members->where('blood', 6)->count() ?? 0], ['id' => 7, 'group' => 'O+', 'count' => $members->where('blood', 7)->count() ?? 0], ['id' => 8, 'group' => 'O-', 'count' => $members->where('blood', 8)->count() ?? 0]] as $blood)
                    <a href="{{ url('/SearchBlood?blood=' . $blood['id']) }}" class="blood-card-link">
                        <div class="blood-card">
                            <!-- Use image for blood group -->
                            <img src="{{ asset('bloodicons/' . urlencode(strtolower($blood['group'])) . '.png') }}"
                                alt="{{ $blood['group'] }}" class="blood-drop" />

                            <div class="blood-count">{{ $blood['count'] }}</div>
                            <div class="count-label">দাতা উপলব্ধ</div>
                        </div>
                    </a>
                @endforeach
            </div>


            <!-- Search Section -->
            <div class="search-section">
                <h3 class="search-title">
                    <i class="fas fa-search"></i>রক্তের সন্ধান করুন
                </h3>
                <form action="{{ route('blood.filter.results') }}" method="GET">
                    <div class="row g-4">
                        <div class="col-md-3">
                            <label class="form-label">রক্তের গ্রুপ</label>
                            <select name="blood" id="blood" class="form-select" required>
                                <option value="">নির্বাচন করুন</option>
                                <option value="1">A+</option>
                                <option value="2">A-</option>
                                <option value="3">AB+</option>
                                <option value="4">AB-</option>
                                <option value="5">B+</option>
                                <option value="6">B-</option>
                                <option value="7">O+</option>
                                <option value="8">O-</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">বিভাগ</label>
                            <select name="division_id" id="division_id" class="form-select">
                                <option value="">বিভাগ নির্বাচন করুন</option>
                                @foreach ($divisions as $division)
                                    <option value="{{ $division->id }}">{{ $division->name_bn }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">জেলা</label>
                            <select name="district_id" id="district_id" class="form-select">
                                <option value="">প্রথমে বিভাগ নির্বাচন করুন</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">থানা/উপজেলা</label>
                            <select name="upazila_id" id="upazila_id" class="form-select">
                                <option value="">প্রথমে জেলা নির্বাচন করুন</option>
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
                        <img src="{{ asset('frontend/safebd/normal/1.jpeg') }}" alt="Blood Donation" class="info-image" />
                        <h3 class="info-title">
                            <i class="fas fa-info-circle"></i>ই-ব্লাড ব্যাংক সম্পর্কে
                        </h3>
                        <p class="info-text">
                            রক্তদান সেবা সমসাময়িক চিকিৎসা ও স্বাস্থ্য পরিচর্যার একটি অপরিহার্য অংশ। ব্লাড ম্যানেজমেন্ট একটি
                            চ্যালেঞ্জিং কাজ হিসাবে স্বীকৃত হয়েছে এবং এটি জীবনকেও বাঁচায়। তথ্য ও কম্পিউটার প্রযুক্তির
                            উন্নয়নের মাধ্যমে এ ধরনের বড় চ্যালেঞ্জ যথেষ্ট উপশম হয়েছে। ই-ব্লাড ব্যাঙ্ক হল একটি সমন্বিত
                            ব্লাড ব্যাঙ্ক অটোমেশন সিস্টেম। এই ওয়েব ভিত্তিক মেকানিজম দেশের সকল রক্তদাতাকে একক নেটওয়ার্কে
                            সংযুক্ত করতে সক্ষম। এই ই-ব্লাড ব্যাংকের ডাটাবেজটি জনসাধারণকে আঙুলের ডগায় রক্তের প্রাপ্যতার
                            অবস্থা সহজে অ্যাক্সেস করতে সাহায্য করবে; যাতে তিনি একটি নির্দিষ্ট ব্লাড গ্রুপের জন্য নিকটবর্তী
                            ব্লাড ডোনারকে খুঁজে পেতে সাহায্য করবে এবং একটি মূল্যবান জীবন বাঁচাতে ভুমিকা রাখতে পারেন।
                        </p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="info-card">
                        <img src="{{ asset('frontend/safebd/normal/2.jpeg') }}" alt="Registration" class="info-image" />
                        <h3 class="info-title">
                            <i class="fas fa-user-plus"></i>ডোনার রেজিস্ট্রেশন
                        </h3>
                        <p class="info-text">
                            রক্ত দিন জীবন বাঁচান। এই স্লোগানকে সামনে রেখে আপনিও এখানে রেজিষ্ট্রেশনের মাধ্যমে আমাদের ই-ব্লাড
                            ব্যাংক এর ডাটাবেজে নিজের তথ্য রাখতে পারবেন। আপনার এক ব্যাগ রক্তদান একজন মানুষের জীবনে বিশেষ
                            ভুমিকা রাখতে পারে। বিনিময়ে আপনি পেতে পারেন একটি পরিবারের মুখে হাসি ফোটাবার অনাবিল আনন্দ।
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
                <!-- Leader 1 -->
                <!-- Leader 1 -->
                <div class="col-lg-3 col-md-6">
                    <div class="info-card text-center">
                        <img src="{{ asset('frontend/safebd/leaders/chirmen.jpg') }}"
                            class="card-img-top mx-auto mt-3" alt="Leader"
                             style="width: 120px;  object-fit: cover; border-radius: 25px; border: 5px solid var(--primary-green); box-shadow: 0 10px 30px rgba(16, 185, 129, 0.3);">
                        <div class="card-body mt-3">
                            <h5 class="card-title fw-bold mb-1">অ্যাড: মাসুদ করিম</h5>
                            <p class="text-primary mb-1">চেয়ারম্যান</p>
                            <p class="text-muted small">সেফ বাংলাদেশ ফাউন্ডেশন</p>
                            <button class="btn-more">
                                <i class="fas fa-arrow-right me-2"></i>বিস্তারিত দেখুন
                            </button>
                        </div>
                    </div>
                </div>a

                <!-- Leader 2 -->
                <div class="col-lg-3 col-md-6">
                    <div class="info-card text-center">
                            <img src="{{ asset('frontend/safebd/leaders/1984.jpg') }}"
                                class=" card-img-top   mx-auto mt-3" alt="Leader"
                                style="width: 120px; object-fit: cover; border-radius: 25px; border: 5px solid var(--primary-green); box-shadow: 0 10px 30px rgba(16, 185, 129, 0.3);">
                       
                        <div class="card-body mt-3">
                            <h5 class="card-title fw-bold mb-1">মো : ফিরোজ হোসেন</h5>
                            <h6> (সফ্টওয়্যার ইঞ্জিনিয়ার)</h6>
                            <p class="text-primary mb-1">সহ-সচিব</p>
                            <p class="text-muted small">সেফ বাংলাদেশ ফাউন্ডেশন</p>
                            <button class="btn-more">
                                <i class="fas fa-arrow-right me-2"></i>বিস্তারিত দেখুন
                            </button>
                        </div>
                    </div>
                </div>


                <!-- Mission & Vision -->
                <div class="col-lg-6">
                    <div class="info-card  ">
                        <div class="card-body">
                            <h4 class="fw-bold text-primary mb-3">
                                <i class="fas fa-bullseye me-2"></i>লক্ষ্য ও উদ্দেশ্যে
                            </h4>
                            <p class="text-muted">
                                সেফ বাংলাদেশ ফাউন্ডেশন একটি অরাজনৈতিক, অলাভজনক স্বেচ্ছাসেবী বেসরকারী সংস্থা। দেশীয় ও
                                আন্তর্জাতিক
                                বিধিবিধান ও আইনের শর্তাদি মেনে প্রয়োজনীয় সমস্ত কাজ প্রস্তাব, পরিকল্পনা, অধ্যয়ন ও গৃহীত
                                সিদ্ধান্ত
                                বাস্তবায়ন ও মূল্যায়নের মাধ্যমে এ ধরণের সব ধরনের কার্যাবলী সম্পাদন করতে পারবে।
                            </p>

                            <div class="row">
                                <div class="col-md-6 mb-3 d-flex">
                                    <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                    <div>
                                        <h6 class="fw-bold mb-1">মানবসেবা</h6>
                                        <p class="text-muted small mb-0">অসহায় মানুষের পাশে দাঁড়ানো</p>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 d-flex">
                                    <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                    <div>
                                        <h6 class="fw-bold mb-1">রক্তদান সেবা</h6>
                                        <p class="text-muted small mb-0">সহজে রক্তদাতা খুঁজে পাওয়া</p>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 d-flex">
                                    <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                    <div>
                                        <h6 class="fw-bold mb-1">সচেতনতা বৃদ্ধি</h6>
                                        <p class="text-muted small mb-0">রক্তদান সম্পর্কে জনসচেতনতা</p>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 d-flex">
                                    <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                    <div>
                                        <h6 class="fw-bold mb-1">ডিজিটাল সেবা</h6>
                                        <p class="text-muted small mb-0">অনলাইন রক্ত ব্যাংক ব্যবস্থা</p>
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
                @foreach (['frontend/safebd/normal/16.jpg', 'frontend/safebd/normal/48.jpg', 'frontend/safebd/normal/22.jpg', 'frontend/safebd/normal/5.jpg', 'frontend/safebd/normal/1.jpg', 'frontend/safebd/normal/8.jpg', 'frontend/safebd/normal/18.jpg'] as $index => $image)
                    <div class="gallery-item">
                        <img src="{{ asset($image) }}" alt="Gallery Image {{ $index + 1 }}" class="gallery-img" />
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('js/home.js') }}"></script>
@endpush

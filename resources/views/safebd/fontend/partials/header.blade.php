<!-- Top Header -->
<style>
   @media (min-width: 992px) and (max-width: 1400px) {
    .navbar-nav .nav-link i {
        display: none;
    }
}


</style>
<header class="top-header d-none d-lg-block">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6">
                {{-- logo --}}
                <div class="logo-wrapper" style="height: 60px;">
                    <a href="{{ url('/') }}" style="display: inline-block;">
                        <img src="{{ asset($settings['site_logo']) }}" alt="Safe Bangladesh Foundation"
                            style="max-height: 60px; width: auto; cursor: pointer;">
                    </a>
                </div>

            </div>
            <div class="col-lg-6 col-md-6">
                <div class="header-actions">
                    <div class="social-links d-none d-lg-flex">
                        <a href="#" class="social-icon facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon linkedin">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="social-icon youtube">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                    <div class="reg-badge">
                        <i class="fas fa-certificate"></i> এস-১২১২৯/২০১৫
                    </div>
                    <a href="{{ route('safeBd.create') }}" class="btn-register text-decoration-none">
                        <i class="fas fa-user-plus"></i> সদস্য নিবন্ধন
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg main-nav">
    <div class="container">
        <button class="navbar-toggler my-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            style="background: white">
            <span class="navbar-toggler-icon"></span>
        </button>
        {{-- Mobile Logo --}}
        <div class="mobile-logo d-lg-none text-center py-1">
            <a href="{{ url('/') }}" class="text-decoration-none">
                <div class="text-white fw-bold" style="font-size: 18px; line-height: 1.2;">
                    সেফ বাংলাদেশ ফাউন্ডেশন
                </div>
                <div class="text-white" style="font-size: 12px;">
                    মানবতার সেবায় নিয়োজিত একটি স্বেচ্ছাসেবী প্রতিষ্ঠান
                </div>
            </a>
        </div>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ route('safeBd') }}">
                        <i class="fas fa-home"></i> হোম
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('safeBd.create') ? 'active' : '' }}"
                        href="{{ route('safeBd.create') }}">
                        <i class="fas fa-users"></i> সদস্য নিবন্ধন
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('safebd.ourGoal') ? 'active' : '' }}"
                        href="{{ route('safebd.ourGoal') }}">
                        <i class="fas fa-bullseye"></i> উদ্দেশ্য ও লক্ষ্য
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('safebd.documents') ? 'active' : '' }}"
                        href="{{ route('safebd.documents') }}">
                        <i class="fas fa-file-alt"></i> প্রযোজনীয় কাগজ
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('safebd.donate') ? 'active' : '' }}"
                        href="{{ route('safebd.donate') }}">
                        <i class="fas fa-donate"></i> দান-অনুদান
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('safebd.nirbahiComity') ? 'active' : '' }}"
                        href="{{ route('safebd.nirbahiComity') }}">
                        <i class="fas fa-users"></i> নির্বাহী কমীটি
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('safebd.photos') ? 'active' : '' }}"
                        href="{{ route('safebd.photos') }}">
                        <i class="fas fa-images"></i> ছবি
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('safebd.others') ? 'active' : '' }}"
                        href="{{ route('safebd.others') }}">
                        <i class="fas fa-th"></i> বিবিধ
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('contact') ? 'active' : '' }}"
                        href="{{ route('safebd.contact') }}">
                        <i class="fas fa-phone"></i> যোগাযোগ
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>

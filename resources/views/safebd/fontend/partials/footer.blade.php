<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4">
                <h4 class="footer-title">সম্পর্কে</h4>
                <p class="text-light mb-4">
                    সেফ বাংলাদেশ ফাউন্ডেশন একটি অরাজনৈতিক, অলাভজনক স্বেচ্ছাসেবী বেসরকারী সংস্থা। মানবতার সেবায় আমরা
                    নিবেদিত।
                </p>
                <div class="social-links">
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
            </div>
            <div class="col-lg-4 mb-4">
                <h4 class="footer-title">দ্রুত লিঙ্ক</h4>
                <ul class="footer-links">
                    <li>
                        <a href="#">
                            <i class="fas fa-angle-right me-2"></i>হোম
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-angle-right me-2"></i>সদস্য নিবন্ধন
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-angle-right me-2"></i>উদ্দেশ্য ও লক্ষ্য
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-angle-right me-2"></i>রক্তদান
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-angle-right me-2"></i>যোগাযোগ
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-4 mb-4">
                <h4 class="footer-title">যোগাযোগ</h4>
                <ul class="footer-links">
                    @if (!empty($settings['business_address']))
                        <li>
                            <i class="fas fa-map-marker-alt me-2"></i>{{ $settings['business_address'] }}
                        </li>
                    @endif
                    
                   {{--  <li>
                        <i class="fas fa-phone me-2"></i>+৮৮০ ১৭XX XXX XXX
                    </li>
                    <li>
                        <i class="fas fa-envelope me-2"></i>info@safebdf.org
                    </li> --}}
                    <li>
                        <i class="fas fa-certificate me-2"></i>রেজি নং: এস-১২১২৯/২০১৫
                    </li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p class="mb-0">
                &copy; {{ date('Y') }} সেফ বাংলাদেশ ফাউন্ডেশন। সর্বস্বত্ব সংরক্ষিত।
            </p>
            <p class="mb-0 mt-2">
                Made with <i class="fas fa-heart" style="color: var(--blood-red)"></i> for Humanity
            </p>
        </div>
    </div>
</footer>

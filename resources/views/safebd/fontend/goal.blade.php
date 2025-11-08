@extends('safebd.fontend.layouts.app')

@section('content')


<!-- Main Content Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9">
                
                <!-- Mission Statement Card -->
                <div class="card border-0 shadow-lg mb-5">
                    <div class="card-body p-4 p-lg-5">
                        
                        <!-- Icon Header -->
                        <div class="text-center mb-4">
                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px; background: linear-gradient(135deg, #0BA976 0%, #089968 100%);">
                                <i class="fas fa-hands-helping fa-2x text-white"></i>
                            </div>
                            <h2 class="h3 fw-bold mb-0">আমাদের উদ্দেশ্য</h2>
                        </div>

                        <!-- Content Description -->
                        <div class="mb-4">
                            <p class="fs-6 lh-lg text-dark mb-4" style="text-align: justify;">
                                সেফ বাংলাদেশ ফাউন্ডেশন একটি <span class="fw-bold" style="color: #0BA976;">অরাজনৈতিক, অলাভজনক স্বেচ্ছাসেবী বেসরকারী সংস্থা</span>। দেশব্যাপী সেল্ফ মোটিভেশনের মাধ্যমে সমাজ কল্যাণ, মানবসম্পদ উন্নয়ন এবং বাংলাদেশের জেলা, মহানগর, থানা, ইউনিয়ন ও গ্রাম পর্যায়ে স্বেচ্ছাসেবী সদস্য, উপকারভোগী সদস্য/কর্মী সৃষ্টি করে অসহায়, দুঃস্থ, দরিদ্র, এতিম, পরিত্যক্ত, প্রবঞ্চিত, অবহেলিত, অত্যাচারিত, অনুন্নত, বেকার ও সুবিধা বঞ্চিত জনগোষ্ঠীর জীবনধারা উন্নয়ন তথা সুস্থ ও সমৃদ্ধশালী হিসেবে গড়ে তুলতে বা সহায়তা করতে সেবা, শিক্ষা, প্রশিক্ষণ, সেমিনার, কর্মশালা, গবেষনা অথবা অন্য কোনো বৈধ পদ্ধতি অবলম্বনের মাধ্যমে বিভিন্ন কর্মসূচী গ্রহণ ও বাস্তবায়ন করা।
                            </p>

                            <!-- Quote Box -->
                            <div class="bg-light border-start border-4 p-4 rounded" style="border-color: #0BA976 !important;">
                                <div class="d-flex align-items-start">
                                    <i class="fas fa-quote-left fa-2x me-3 opacity-50" style="color: #0BA976;"></i>
                                    <div>
                                        <p class="fs-6 lh-lg text-dark mb-0" style="text-align: justify;">
                                            আমরা আশা করি, দেশে <span class="fw-bold" style="color: #0BA976;">"স্বেচ্ছাসেবক"</span> সৃষ্টি করার লক্ষ্যে আমাদের এ প্রয়াস জনগণের মধ্যে ব্যাপক সাড়া জাগাতে সক্ষম হবে। আপনার স্বেচ্ছাভিত্তিক অংশগ্রহণ ও সহযোগিতা আমাদের একান্ত কাম্য।
                                        </p>
                                    </div>
                                    <i class="fas fa-quote-right fa-2x ms-3 opacity-50" style="color: #0BA976;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

               
                <!-- Images Section -->
                <div class="row g-4 mb-5">
                    @for($i = 1; $i <= 5; $i++)
                    <div class="col-12">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body p-0">
                                <img src="{{ asset('frontend/safebd/goal/' . $i . '.jpg') }}" 
                                     class="img-fluid w-100" 
                                     alt="সংবিধি পৃষ্ঠা {{ $i }}" 
                                     title="সংবিধি পৃষ্ঠা {{ $i }}">
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>

               
            </div>
        </div>
    </div>
</section>


@endsection
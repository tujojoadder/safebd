@extends('safebd.fontend.layouts.app')

@section('content')
    <!-- Main Content Section -->
  <section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">

            <!-- Icon Header -->
            <div class="text-center mb-4 col-12">
                <h2 class="h3 fw-bold mb-0">বিবিধ</h2>
            </div>

            <!-- Images Section -->
            <div class="col-12 col-lg-6"> <!-- Center column -->
                <div class="row g-4 mb-5">
                   
                        <div class="col-12">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body p-0">
                                    <img src="{{ asset('frontend/safebd/others/1.jpg') }}"
                                        class="img-fluid w-100" alt="বিবিধ"
                                        title="বিবিধ">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body p-0">
                                    <img src="{{ asset('frontend/safebd/others/2.jpg') }}"
                                        class="img-fluid w-100" alt="বিবিধ"
                                        title="বিবিধ">
                                </div>
                            </div>
                        </div>
                  
                </div>
            </div>

        </div>
    </div>
</section>

@endsection

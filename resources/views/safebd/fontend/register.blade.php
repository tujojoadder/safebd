@extends('safebd.fontend.layouts.app')

@section('content')
    <div class="register-page">
        <div class="register-container">
            <div class="register-card">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!-- Header -->
                <div class="register-header">
                    <div class="icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="8.5" cy="7" r="4"></circle>
                            <polyline points="17 11 19 13 23 9"></polyline>
                        </svg>
                    </div>
                    <h1 class="page-title">সদস্য নিবন্ধন</h1>
                </div>

                <!-- Registration Form -->
                <form action="{{ route('safeBd.store') }}" method="POST" class="register-form">
                    @csrf

                    <div class="form-row">
                        <!-- পূর্ণ নাম -->
                        <div class="form-group">
                            <label for="fullname">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                পূর্ণ নাম
                            </label>
                            <input type="text" id="fullname" name="fullname" placeholder="আপনার পূর্ণ নাম লিখুন"
                                value="{{ old('fullname') }}" required>
                            @error('fullname')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- মোবাইল নম্বর -->
                        <div class="form-group">
                            <label for="phone">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path
                                        d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                    </path>
                                </svg>
                                মোবাইল নম্বর
                            </label>
                            <input type="tel" id="phone" name="phone" placeholder="01XXXXXXXXX"
                                value="{{ old('phone') }}" required>
                            @error('phone')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <!-- জন্ম তারিখ -->
                        <div class="form-group">
                            <label for="dateOfBirth">জন্ম তারিখ</label>
                            <input type="text" id="dateOfBirth" name="dateOfBirth" placeholder="তারিখ নির্বাচন করুন"
                                value="{{ old('dateOfBirth') }}" required autocomplete="off">
                            @error('dateOfBirth')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- রক্তের গ্রুপ -->
                        <div class="form-group">
                            <label for="blood">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path
                                        d="M20.42 4.58a5.4 5.4 0 0 0-7.65 0l-.77.78-.77-.78a5.4 5.4 0 0 0-7.65 0C1.46 6.7 1.33 10.28 4 13l8 8 8-8c2.67-2.72 2.54-6.3.42-8.42z">
                                    </path>
                                </svg>
                                রক্তের গ্রুপ
                            </label>
                            <select id="blood" name="blood" required>
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
                            @error('blood')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <!-- বিভাগ -->
                        <div class="form-group">
                            <label for="division_id">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                                বিভাগ
                            </label>
                            <select id="division_id" name="division_id" required>
                                <option value="">বিভাগ নির্বাচন করুন</option>
                                @foreach ($divisions as $division)
                                    <option value="{{ $division->id }}"
                                        {{ old('division_id') == $division->id ? 'selected' : '' }}>
                                        {{ $division->name_bn }}
                                    </option>
                                @endforeach
                            </select>
                            @error('division_id')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- জেলা -->
                        <div class="form-group">
                            <label for="district_id">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                                জেলা
                            </label>
                            <select id="district_id" name="district_id" required>
                                <option value="">প্রথমে বিভাগ নির্বাচন করুন</option>
                            </select>
                            @error('district_id')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- থানা/উপজেলা -->
                    <div class="form-group">
                        <label for="upazila_id">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                            থানা/উপজেলা
                        </label>
                        <select id="upazila_id" name="upazila_id" required>
                            <option value="">প্রথমে জেলা নির্বাচন করুন</option>
                        </select>
                        @error('upazila_id')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="submit-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="8.5" cy="7" r="4"></circle>
                            <polyline points="17 11 19 13 23 9"></polyline>
                        </svg>
                        নিবন্ধন সম্পন্ন করুন
                    </button>

                 
                </form>
            </div>
        </div>
    </div>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .register-page {
            min-height: 100vh;
            padding: 40px 20px;
            font-family: 'SolaimanLipi', 'Kalpurush', 'Nikosh', sans-serif;
        }

        .register-container {
            max-width: 900px;
            margin: 0 auto;
        }

        .register-card {
            background: white;
            border-radius: 20px;
            padding: 50px;
            box-shadow: 0 7px 15px rgba(0, 0, 0, 0.15);
        }

        /* Header */
        .register-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .icon-circle {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 5px 20px rgba(16, 185, 129, 0.3);
        }

        .icon-circle svg {
            color: white;
        }

        .page-title {
            font-size: 36px;
            color: #1f2937;
            margin-bottom: 10px;
            font-weight: 700;
        }

        /* Form */
        .register-form {
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .form-group label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
            color: #374151;
            font-size: 15px;
        }

        .form-group label svg {
            color: #10b981;
        }

        .form-group input,
        .form-group select {
            padding: 14px 18px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 16px;
            font-family: inherit;
            transition: all 0.3s ease;
            background: #f9fafb;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #10b981;
            background: white;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
        }

        .form-group input::placeholder {
            color: #9ca3af;
        }

        .error-text {
            color: #ef4444;
            font-size: 13px;
            margin-top: -5px;
        }

        /* Submit Button */
        .submit-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            padding: 18px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        /* Login Link */
        .login-link {
            text-align: center;
            margin-top: 20px;
        }

        .login-link p {
            color: #6b7280;
            font-size: 15px;
        }

        .login-link a {
            color: #10b981;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .register-card {
                padding: 30px 25px;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .page-title {
                font-size: 28px;
            }
        }

        @media (max-width: 576px) {
            .register-page {
                padding: 20px 15px;
            }

            .register-card {
                padding: 25px 20px;
            }

            .icon-circle {
                width: 80px;
                height: 80px;
            }

            .icon-circle svg {
                width: 35px;
                height: 35px;
            }
        }
    </style>
@endsection

@push('scripts')
    <!-- jQuery & jQuery UI CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-datepicker/1.13.2/i18n/datepicker-bn.js"></script>


    <script>
        $(function() {
            // jQuery Datepicker initialization
            $("#dateOfBirth").datepicker({
                 dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true,
        yearRange: "1950:2025",

            });

            // AJAX - Load Districts when Division is selected
            $('#division_id').on('change', function() {
                const divisionId = $(this).val();
                const districtSelect = $('#district_id');
                const upazilaSelect = $('#upazila_id');

                // Reset district and upazila
                districtSelect.html('<option value="">লোড হচ্ছে...</option>');
                upazilaSelect.html('<option value="">প্রথমে জেলা নির্বাচন করুন</option>');

                if (divisionId) {
                    $.ajax({
                        url: `/safebd/get-districts/${divisionId}`,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            districtSelect.html('<option value="">জেলা নির্বাচন করুন</option>');
                            $.each(data, function(key, district) {
                                districtSelect.append(
                                    `<option value="${district.id}">${district.name_bn}</option>`
                                );
                            });
                        },
                        error: function() {
                            districtSelect.html(
                                '<option value="">জেলা লোড করতে ব্যর্থ</option>');
                        }
                    });
                } else {
                    districtSelect.html('<option value="">প্রথমে বিভাগ নির্বাচন করুন</option>');
                }
            });

            // AJAX - Load Upazilas when District is selected
            $('#district_id').on('change', function() {
                const districtId = $(this).val();
                const upazilaSelect = $('#upazila_id');

                // Reset upazila
                upazilaSelect.html('<option value="">লোড হচ্ছে...</option>');

                if (districtId) {
                    $.ajax({
                        url: `/safebd/get-upazilas/${districtId}`,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            upazilaSelect.html(
                                '<option value="">থানা/উপজেলা নির্বাচন করুন</option>');
                            $.each(data, function(key, upazila) {
                                upazilaSelect.append(
                                    `<option value="${upazila.id}">${upazila.name_bn}</option>`
                                );
                            });
                        },
                        error: function() {
                            upazilaSelect.html(
                                '<option value="">উপজেলা লোড করতে ব্যর্থ</option>');
                        }
                    });
                } else {
                    upazilaSelect.html('<option value="">প্রথমে জেলা নির্বাচন করুন</option>');
                }
            });
        });
    </script>
@endpush

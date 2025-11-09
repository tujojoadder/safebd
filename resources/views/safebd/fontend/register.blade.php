@extends('safebd.fontend.layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endpush
@section('content')

    <div class="register-page">
        <div class="register-container">
            <div class="register-card " style="border-top: #0ba172 5px solid">
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
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
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
                                pattern="[0-9]{11}" value="{{ old('phone') }}" required>
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
                                        {{ $division->name_en }} {{ $division->bn_name }}
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

@endsection

@push('scripts')
    <script src="{{ asset('js/home.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#dateOfBirth").datepicker({
                dateFormat: "yy-mm-dd",
                changeMonth: true,
                changeYear: true,
                yearRange: "-100:+0",
            });
        });
    </script>
@endpush

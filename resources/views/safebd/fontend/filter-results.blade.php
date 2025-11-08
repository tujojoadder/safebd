@extends('safebd.fontend.layouts.app')

@section('title', 'অনুসন্ধান ফলাফল - Blood Search')

@push('styles')
    <style>
        .donor-count {
            color: #0d6efd;
            font-size: 1.1rem;
            font-weight: 500;
        }

        .blood-type-badge {
            background: #dc3545;
            color: white;
            padding: 4px 12px;
            border-radius: 15px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .phone-link {
            color: #198754;
            text-decoration: none;
            font-weight: 500;
        }

        .phone-link:hover {
            color: #157347;
            text-decoration: underline;
        }
    </style>
@endpush

@section('content')
    <div class="bg-light py-4 mb-4">
        <div class="container text-center">
            <span class="badge bg-danger fs-2 px-4 py-2 rounded-pill">{{ $bloodGroup }}</span>
            <h2 class="mt-3 mb-2">অনুসন্ধান ফলাফল</h2>
            <p class="donor-count mb-0">
                <i class="fas fa-users me-2"></i>মোট দাতা: {{ $members->count() }} জন
            </p>
        </div>
    </div>

    <div class="container mb-5">
        <div class="card shadow">
            <div class="card-body p-4">
                @if ($members->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-primary">
                                <tr>
                                    <th class="text-center"><i class="fas fa-hashtag me-2"></i>ক্রমিক</th>
                                    <th><i class="fas fa-user me-2"></i>নাম</th>
                                    <th class="text-center"><i class="fas fa-tint me-2 "></i>রক্তের গ্রুপ</th>
                                    <th><i class="fas fa-phone me-2"></i>মোবাইল</th>
                                    <th><i class="fas fa-map-marked-alt me-2"></i>বিভাগ</th>
                                    <th><i class="fas fa-map-marker-alt me-2"></i>জেলা</th>
                                    <th><i class="fas fa-location-dot me-2"></i>থানা</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($members as $index => $member)
                                    <tr>
                                        <td class="fw-bold text-center text-primary ক্রমিক">{{ $index + 1 }}</td>
                                        <td class="fw-bold">{{ $member->fullname ?? '' }}</td>
                                        <td class="text-center"><span class="blood-type-badge ">{{ $bloodGroup }}</span>
                                        </td>
                                        <td>{{ $member->phone ?? '' }}</td>
                                        <td>{{ $member->division->bn_name ?? '' }}</td>
                                        <td>{{ $member->district->bn_name ?? '' }}</td>
                                        <td>{{ $member->upazila->bn_name ?? '' }}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-user-slash fa-4x text-danger mb-3 opacity-50"></i>
                        <h4 class="text-secondary">দুঃখিত! আপনার অনুসন্ধান অনুযায়ী কোন দাতা পাওয়া যায়নি।</h4>
                        <p class="text-muted">অনুগ্রহ করে ভিন্ন ফিল্টার দিয়ে চেষ্টা করুন।</p>
                    </div>
                @endif

                <div class="text-center mt-4">
                    <button onclick="history.back()" class="btn btn-primary btn-lg">
                        <i class="fas fa-arrow-left me-2"></i>ফিরে যান
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

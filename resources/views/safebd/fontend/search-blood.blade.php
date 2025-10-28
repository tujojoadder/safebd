@extends('safebd.fontend.layouts.app')

@section('title', 'রক্তের দাতা - Blood Search')

@section('content')
    <div class="bg-light py-4 mb-4">
        <div class="container text-center">
            <!-- Blood group badge -->
            <span class="badge bg-danger fs-2 px-4 py-2 rounded-pill">{{ $bloodGroup }}</span>

            <h2 class="mt-3 mb-2">রক্তের দাতাদের তালিকা</h2>
            <p class="text-primary fw-medium mb-0">
                <i class="fas fa-users me-2"></i>মোট দাতা: {{ $members->count() }} জন
            </p>
        </div>
    </div>

    <div class="container mb-5">
        <div class="card shadow border-top " style="border-top-color: #09a372;">
            <div class="card-body p-4">
                @if ($members->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col" class="text-center"><i class="fas fa-hashtag me-2"></i>ক্রমিক</th>
                                    <th scope="col"><i class="fas fa-user me-2"></i>নাম</th>
                                    <th scope="col" class="text-center"><i class="fas fa-tint me-2"></i>রক্তের গ্রুপ</th>
                                    <th scope="col"><i class="fas fa-phone me-2"></i>মোবাইল</th>
                                    <th scope="col"><i class="fas fa-map-marked-alt me-2"></i>বিভাগ</th>
                                    <th scope="col"><i class="fas fa-map-marker-alt me-2"></i>জেলা</th>
                                    <th scope="col"><i class="fas fa-location-dot me-2"></i>থানা</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($members as $index => $member)
                                    <tr>
                                        <td class="fw-bold text-primary text-center">{{ $index + 1 }}</td>
                                        <td class="fw-bold">{{ $member->fullname }}</td>
                                        <td class="text-center"><span class="badge bg-danger rounded-pill">{{ $bloodGroup }}</span></td>
                                        <td>{{ $member->phone ?? '' }}</td>
                                        <td>{{ $member->division->name_bn ?? '' }}</td>
                                        <td>{{ $member->district->name_bn ?? '' }}</td>
                                        <td>{{ $member->upazila->name_bn ?? '' }}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5 text-secondary">
                        <i class="fas fa-user-slash fa-4x text-danger mb-3 opacity-50"></i>
                        <h4>দুঃখিত! এই রক্তের গ্রুপের কোন দাতা পাওয়া যায়নি।</h4>
                        <p class="text-muted">অনুগ্রহ করে পরে আবার চেষ্টা করুন।</p>
                    </div>
                @endif

                <div class="text-center mt-4">
                    <a href="{{ url()->previous() }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-arrow-left me-2"></i>ফিরে যান
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('safebd.fontend.layouts.app')

@section('content')
    <section class="gallery-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">ছবি গ্যালারি</h2>
                <p class="text-muted">আমাদের কার্যক্রমের ছবি</p>
            </div>
            <div class="gallery-grid">
                @foreach ([
                    'frontend/safebd/normal/1.jpg',
                    'frontend/safebd/normal/3.jpg',
                 'frontend/safebd/normal/4.jpg',
                  'frontend/safebd/normal/5.jpg',
                  'frontend/safebd/normal/7.jpg',
                  'frontend/safebd/normal/8.jpg',
                  'frontend/safebd/normal/9.jpg',
                  'frontend/safebd/normal/12.jpg',
                  'frontend/safebd/normal/16.jpg',
                  'frontend/safebd/normal/18.jpg',
                  'frontend/safebd/normal/22.jpg',
                   'frontend/safebd/normal/23.jpg',
                    'frontend/safebd/normal/36.jpg',
                     'frontend/safebd/normal/47.jpg',
                      'frontend/safebd/normal/48.jpg'] as $index => $image)
                    <div class="gallery-item">
                        <img src="{{ asset($image) }}" alt="Gallery Image {{ $index + 1 }}" class="gallery-img" />
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

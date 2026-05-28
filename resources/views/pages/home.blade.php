@extends('layouts.app')

@section('title', 'Fun Aquatic Competition')

@section('content')
<section class="home-hero">
    <div class="home-grid">
        <div>
            <p class="clean-kicker">Kompetisi Renang Anak</p>
            <h1 class="home-title">Fun Aquatic <span>Series II</span></h1>
            <div class="home-meta">
                <p class="home-date">Sabtu, 25 Juli 2026</p>
                <p>Ajang renang yang ramah anak untuk membangun keberanian, sportivitas, dan pengalaman lomba yang menyenangkan.</p>
            </div>
            <div class="action-row-clean">
                <a class="primary-button" href="{{ route('registrations.rules') }}">Daftar Sekarang</a>
                <a class="secondary-button" href="{{ route('results') }}">Lihat Hasil</a>
            </div>
        </div>

        <div class="hero-media">
            <video autoplay muted loop playsinline preload="metadata">
                <source src="{{ asset('assets/videos/preview-event.mp4') }}" type="video/mp4">
            </video>
        </div>
    </div>
</section>
@endsection

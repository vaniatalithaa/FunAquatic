@extends('layouts.app')

@section('title', 'Fun Aquatic Competition')

@section('content')
<section class="home-hero">
    <div class="home-grid">
        <div>
            <h1 class="home-title">Fun Aquatic <span>Series II</span></h1>
            <div class="home-meta">
                <p class="home-date">Sabtu, 25 Juli 2026</p>
                <p>by Fun Aquatic Swimschool X Pakuwon Golf & family club managed by westin hotels & resorts</p>
            </div>
            <div class="action-row-clean">
                <a class="primary-button" href="{{ route('registrations.rules') }}">Daftar Sekarang & Ketentuan</a>
                <a class="secondary-button" href="{{ route('results') }}">Lihat Hasil</a>
            </div>
        </div>

        
    </div>
</section>
@endsection

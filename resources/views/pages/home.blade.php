@extends('layouts.app')

@section('title', 'Fun Aquatic Competition')

@section('content')
<section class="hero">
    <div class="hero-content">
        <h1>FUN AQUATIC COMPETITION <span>SERIES II</span></h1>
        <div class="event-meta">
            <p class="event-date">SABTU, 25 JULI 2026</p>
            <p>by Fun Aquatic Swimschool X Pakuwon Golf & Family Club managed by Westin Hotels & Resorts</p>
        </div>
        <div class="action-row">
            <a class="button button-light" href="{{ route('registrations.rules') }}">Daftar Sekarang & Ketentuan</a>
            <a class="button button-light" href="{{ route('results') }}">Hasil Lomba</a>
        </div>
    </div>
</section>
@endsection

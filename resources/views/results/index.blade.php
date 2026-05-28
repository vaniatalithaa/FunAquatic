@extends('layouts.app')

@section('title', 'Hasil Lomba - Fun Aquatic')

@section('content')
<main class="clean-page">
    <div class="clean-container">
        <div class="clean-heading">
            <p class="clean-kicker">Live Result</p>
            <h1 class="clean-title">Hasil Lomba</h1>
            <p class="clean-copy">Hasil perlombaan ditampilkan melalui Google Spreadsheet dan diperbarui oleh panitia pertandingan.</p>
        </div>

        <div class="mb-4 flex justify-end">
            <a class="secondary-button" href="https://docs.google.com/spreadsheets/d/1a8ImTTFBZZMPvB5ejuvYLDnpQvWo-x1GilVc1P8DbYw/edit?usp=sharing" target="_blank" rel="noopener">Buka Spreadsheet</a>
        </div>

        <div class="clean-card embed-panel">
            <iframe src="https://docs.google.com/spreadsheets/d/1a8ImTTFBZZMPvB5ejuvYLDnpQvWo-x1GilVc1P8DbYw/edit?usp=sharing" title="Live Competition Result"></iframe>
        </div>
    </div>
</main>
@endsection

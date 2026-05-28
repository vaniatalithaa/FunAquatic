@extends('layouts.app')

@section('title', 'Hasil Lomba - Fun Aquatic')

@section('content')
<main class="page-band">
    <div class="container wide">
        <div class="section-heading">
            <h1>Hasil Lomba</h1>
            <p>Hasil perlombaan ditampilkan melalui Google Spreadsheet dan diperbarui oleh panitia pertandingan.</p>
        </div>

        <div class="toolbar">
            <a class="button button-light" href="https://docs.google.com/spreadsheets/d/1a8ImTTFBZZMPvB5ejuvYLDnpQvWo-x1GilVc1P8DbYw/edit?usp=sharing" target="_blank" rel="noopener">Buka Spreadsheet</a>
        </div>

        <div class="embed-frame">
            <iframe src="https://docs.google.com/spreadsheets/d/1a8ImTTFBZZMPvB5ejuvYLDnpQvWo-x1GilVc1P8DbYw/edit?usp=sharing" title="Live Competition Result"></iframe>
        </div>
    </div>
</main>
@endsection

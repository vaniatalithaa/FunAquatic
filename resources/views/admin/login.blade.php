@extends('layouts.app')

@section('title', 'Login Admin - Fun Aquatic')

@section('content')
<main class="registration-page">
    <form class="registration-card registration-form mx-auto w-full max-w-md" method="POST" action="{{ route('admin.login.submit') }}">
        @csrf
        <div class="text-center">
            <p class="registration-kicker !text-cyan-700">Admin</p>
            <h1 class="mt-2 text-3xl font-black uppercase text-slate-950">Login Admin</h1>
        </div>

        @error('email')
            <div class="error-alert">{{ $message }}</div>
        @enderror

        <label class="form-field">Username atau Email
            <input class="form-control" type="text" name="email" value="{{ old('email') }}" required autofocus>
        </label>
        <label class="form-field">Password
            <input class="form-control" type="password" name="password" required>
        </label>
        <button class="primary-button w-full" type="submit">Masuk</button>
        <a class="text-center text-sm font-extrabold text-cyan-800 hover:text-cyan-900" href="{{ route('registrations.rules') }}">Kembali ke Pendaftaran</a>
    </form>
</main>
@endsection

@extends('layouts.app')

@section('title', 'Login Admin - Fun Aquatic')

@section('content')
<main class="login-page">
    <form class="login-box" method="POST" action="{{ route('admin.login.submit') }}">
        @csrf
        <h1>Login Admin</h1>

        @error('email')
            <div class="alert alert-error">{{ $message }}</div>
        @enderror

        <label>Username atau Email
            <input type="text" name="email" value="{{ old('email') }}" required autofocus>
        </label>
        <label>Password
            <input type="password" name="password" required>
        </label>
        <button class="button button-primary full" type="submit">Masuk</button>
        <a class="muted-link login-back-link" href="{{ route('registrations.rules') }}">Kembali ke Pendaftaran</a>
    </form>
</main>
@endsection

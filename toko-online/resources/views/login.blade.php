@extends('layout')

@section('title', 'Login')

@section('content')
    <div class="card">
        <h1>Login</h1>

        <form action="{{ route('login.store') }}" method="POST">
            @csrf

            <label>Username</label>
            <input type="text" name="username"
                   value="{{ old('username') }}" required>

            @error('username')
                <p class="error">{{ $message }}</p>
            @enderror

            <label>Password</label>
            <input type="password" name="password" required>

            @error('password')
                <p class="error">{{ $message }}</p>
            @enderror

            <button type="submit">Login</button>
        </form>

        <p>Belum punya akun?
            <a href="{{ route('register') }}">Daftar</a>
        </p>
    </div>
@endsection
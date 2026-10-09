@extends('layout')

@section('content')
    <h2>Login</h2>

    <form action="{{ route('login.store') }}" method="POST">
        @csrf

        <div style="margin-bottom: 15px;">
            <label>Username</label><br>
            <input type="text" name="username" value="{{ old('username') }}" required
                style="width: 100%; padding: 10px; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Password</label><br>
            <input type="password" name="password" required
                style="width: 100%; padding: 10px; box-sizing: border-box;">
        </div>

        @error('username')
            <p style="color: red;">{{ $message }}</p>
        @enderror

        <button type="submit">Login</button>
    </form>

    <p>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
@endsection
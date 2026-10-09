@extends('layout')

@section('title', 'Daftar Akun')

@section('content')
    <div class="card">
        <h1>Daftar Akun</h1>

        <form action="{{ route('register.store') }}" method="POST">
            @csrf

            <label>Nama Lengkap</label>
            <input type="text" name="nama_lengkap"
                   value="{{ old('nama_lengkap') }}" required>
            @error('nama_lengkap')
                <p class="error">{{ $message }}</p>
            @enderror

            <label>Email</label>
            <input type="email" name="email"
                   value="{{ old('email') }}" required>
            @error('email')
                <p class="error">{{ $message }}</p>
            @enderror

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

            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" required>

            <label>Nomor HP</label>
            <input type="text" name="no_hp" value="{{ old('no_hp') }}">

            <label>Alamat</label>
            <textarea name="alamat" required>{{ old('alamat') }}</textarea>
            @error('alamat')
                <p class="error">{{ $message }}</p>
            @enderror

            <button type="submit">Daftar</button>
        </form>

        <p>Sudah punya akun?
            <a href="{{ route('login') }}">Login</a>
        </p>
    </div>
@endsection
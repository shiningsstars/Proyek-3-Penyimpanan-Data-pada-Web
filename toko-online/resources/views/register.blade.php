@extends('layout')

@section('content')
    <h2>Daftar Akun</h2>

    <form action="{{ route('register.store') }}" method="POST">
        @csrf

        <div style="margin-bottom: 15px;">
            <label>Nama Lengkap</label><br>
            <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required
                style="width: 100%; padding: 10px; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Email</label><br>
            <input type="email" name="email" value="{{ old('email') }}" required
                style="width: 100%; padding: 10px; box-sizing: border-box;">
        </div>

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

        <div style="margin-bottom: 15px;">
            <label>Konfirmasi Password</label><br>
            <input type="password" name="password_confirmation" required
                style="width: 100%; padding: 10px; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Nomor HP</label><br>
            <input type="text" name="no_hp" value="{{ old('no_hp') }}"
                style="width: 100%; padding: 10px; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Alamat</label><br>
            <textarea name="alamat" required
                style="width: 100%; padding: 10px; box-sizing: border-box;">{{ old('alamat') }}</textarea>
        </div>

        @if ($errors->any())
            <ul style="color: red;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <button type="submit">Daftar</button>
    </form>

    <p>Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></p>
@endsection
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: white;
            color: black;
        }

        nav {
            padding: 10px 0;
            border-bottom: 1px solid #ccc;
            margin-bottom: 20px;
        }

        nav a {
            margin-right: 15px;
            color: blue;
        }

        .produk {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 15px;
            width: 250px;
        }

        .produk img {
            width: 150px;
            height: 150px;
            object-fit: cover;
        }

        input, textarea, button {
            margin: 5px 0;
            padding: 7px;
        }

        .pesan {
            color: green;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>

    
<nav style="display: flex; align-items: center; gap: 18px; flex-wrap: wrap;">
    <a href="{{ route('products.index') }}">Beranda</a>

    @auth
        <span>Halo, {{ Auth::user()->nama_lengkap }}</span>

        <a href="{{ route('cart.index') }}">Keranjang</a>

        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
            @csrf
            <button type="submit">Logout</button>
        </form>
    @else
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}">Daftar</a>
    @endauth
</nav>


    @if(session('success'))
        <p class="pesan">{{ session('success') }}</p>
    @endif

    @yield('content')

</body>
</html>

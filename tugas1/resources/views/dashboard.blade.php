<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1>Dashboard</h1>

        <form action="/logout" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>

    <h2>Selamat datang, {{ Auth::user()->nama_lengkap }}!</h2>

    <p>Halaman ini hanya bisa dibuka setelah login.</p>

    <p>Username: {{ Auth::user()->username }}</p>
</body>
</html>
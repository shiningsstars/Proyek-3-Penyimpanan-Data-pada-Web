<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Role User</title>
</head>
<body>
    <h1>Kelola Role User</h1>
    <a href="{{ route('products.index') }}">Kembali ke Beranda</a>
    <p>Login sebagai: {{ Auth::user()->nama_lengkap }} ({{ Auth::user()->role }})</p>

    @if (session('success'))
        <p style="color: green;">{{ session('status') }}</p>
    @endif

    @if ($errors->any())
        <ul style="color: red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID</th><th>Nama</th><th>Username</th><th>Role saat ini</th><th>Ubah ke</th>
        </tr>
        @foreach ($users as $u)
            <tr>
                <td>{{ $u->id_user }}</td>
                <td>{{ $u->nama_lengkap }}</td>
                <td>{{ $u->username }}</td>
                <td>{{ $u->role }}</td>
                <td>
                    <form action="{{ route('admin.users.role.update', $u->id_user) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <select name="role">
                            <option value="customer">customer</option>
                            <option value="staff">staff</option>
                        </select>
                        <button type="submit">Simpan</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</body>
</html>
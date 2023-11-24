@extends('layouts.main')
@section('content')
 <h1>Daftar Alumni</h1>

    <a href="{{ route('alumni.create') }}">Tambah Alumni</a>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
 <form action="{{ route('alumni.index') }}" method="GET">
        <label for="search">Cari Nama/NIM Alumni:</label>
        <input type="text" name="search" value="{{ request('search') }}">
        <button type="submit">Cari</button>
    </form>
    <table border="1">
        <thead>
            <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Jurusan</th>
                <th>Tanggal Lahir</th>
                <th>Alamat Lengkap</th>
                <th>Pekerjaan</th>
                <th>IPK</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($alumni as $alumnus)
                <tr>
                    <td>{{ $alumnus->nim }}</td>
                    <td>{{ $alumnus->nama }}</td>
                    <td>{{ $alumnus->major->jurusan }}</td>
                    <td>{{ $alumnus->tanggal_lahir }}</td>
                    <td>{{ $alumnus->alamat_lengkap }}</td>
                    <td>{{ $alumnus->pekerjaan }}</td>
                    <td>{{ $alumnus->ipk }}</td>
                    <td>
                        <a href="{{ route('alumni.show', $alumnus->nim) }}">Lihat</a> |
                        <a href="{{ route('alumni.edit', $alumnus->nim) }}">Edit</a> |
                        <form action="{{ route('alumni.destroy', $alumnus->nim) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
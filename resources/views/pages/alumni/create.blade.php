@extends('layouts.main')
@section('content')
<h1>Tambah Alumni</h1>

<a href="{{ route('alumni.index') }}">Kembali ke Daftar</a>

@if($errors->any())
    <ul style="color: red;">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('alumni.store') }}" method="POST">
    @csrf
    <label for="nim">NIM:</label>
    <input type="text" name="nim" required>

    <label for="nama">Nama:</label>
    <input type="text" name="nama" required>

    <label for="jurusan">Jurusan:</label>
    <select name="jurusan" required>
        @foreach($majors as $major)
            <option value="{{ $major->kode_jurusan }}">{{ $major->jurusan }}</option>
        @endforeach
    </select>

    <label for="tempat_lahir">Tempat Lahir:</label>
    <input type="text" name="tempat_lahir" required>

    <label for="tanggal_lahir">Tanggal Lahir:</label>
    <input type="date" name="tanggal_lahir" required>

    <label for="alamat_lengkap">Alamat Lengkap:</label>
    <input type="text" name="alamat_lengkap" required>

    <label for="pekerjaan">Pekerjaan:</label>
    <input type="text" name="pekerjaan" required>

    <label for="ipk">IPK:</label>
    <input type="number" name="ipk" step="0.01" required>

    <button type="submit">Tambah</button>
</form>
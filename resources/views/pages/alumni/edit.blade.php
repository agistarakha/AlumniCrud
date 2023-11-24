@extends('layouts.main')
@section('content')
<h1>Edit Alumni</h1>

<a href="{{ route('alumni.index') }}">Kembali ke Daftar</a>

@if($errors->any())
    <ul style="color: red;">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('alumni.update', $alumnus->nim) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="nim">NIM:</label>
    <input type="text" name="nim" value="{{ $alumnus->nim }}" required readonly>

    <label for="nama">Nama:</label>
    <input type="text" name="nama" value="{{ $alumnus->nama }}" required>

    <label for="jurusan">Jurusan:</label>
    <select name="jurusan" required>
        @foreach($majors as $major)
            <option value="{{ $major->kode_jurusan }}" @if($alumnus->major->kode_jurusan == $major->kode_jurusan) selected @endif>{{ $major->jurusan }}</option>
        @endforeach
    </select>

    <label for="tempat_lahir">Tempat Lahir:</label>
    <input type="text" name="tempat_lahir" value="{{ $alumnus->tempat_lahir }}" required>

    <label for="tanggal_lahir">Tanggal Lahir:</label>
    <input type="date" name="tanggal_lahir" value="{{ $alumnus->tanggal_lahir }}" required>

    <label for="alamat_lengkap">Alamat Lengkap:</label>
    <input type="text" name="alamat_lengkap" value="{{ $alumnus->alamat_lengkap }}" required>

    <label for="pekerjaan">Pekerjaan:</label>
    <input type="text" name="pekerjaan" value="{{ $alumnus->pekerjaan }}" required>

    <label for="ipk">IPK:</label>
    <input type="number" name="ipk" step="0.01" value="{{ $alumnus->ipk }}" required>

    <button type="submit">Simpan</button>
</form>
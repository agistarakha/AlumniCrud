@extends('layouts.main')

@section('content')
    <h1 class="text-4xl font-bold mb-6">Edit Alumni</h1>

    <a href="{{ route('alumni.index') }}" class="text-blue-500 hover:underline">Kembali ke Daftar</a>

    @if($errors->any())
        <ul class="text-red-500">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('alumni.update', $alumnus->nim) }}" method="POST" class="mt-4">
        @csrf
        @method('PUT')

        <label for="nim" class="block mb-2">NIM:</label>
        <input type="text" name="nim" value="{{ $alumnus->nim }}" class="border p-2 rounded w-full" required readonly>

        <label for="nama" class="block mt-4 mb-2">Nama:</label>
        <input type="text" name="nama" value="{{ $alumnus->nama }}" class="border p-2 rounded w-full" required>

        <label for="jurusan" class="block mt-4 mb-2">Jurusan:</label>
        <select name="jurusan" class="border p-2 rounded w-full" required>
            @foreach($majors as $major)
                <option value="{{ $major->kode_jurusan }}" @if($alumnus->major->kode_jurusan == $major->kode_jurusan) selected @endif>{{ $major->jurusan }}</option>
            @endforeach
        </select>

        <label for="tempat_lahir" class="block mt-4 mb-2">Tempat Lahir:</label>
        <input type="text" name="tempat_lahir" value="{{ $alumnus->tempat_lahir }}" class="border p-2 rounded w-full" required>

        <label for="tanggal_lahir" class="block mt-4 mb-2">Tanggal Lahir:</label>
        <input type="date" name="tanggal_lahir" value="{{ $alumnus->tanggal_lahir }}" class="border p-2 rounded w-full" required>

        <label for="alamat_lengkap" class="block mt-4 mb-2">Alamat Lengkap:</label>
        <input type="text" name="alamat_lengkap" value="{{ $alumnus->alamat_lengkap }}" class="border p-2 rounded w-full" required>

        <label for="pekerjaan" class="block mt-4 mb-2">Pekerjaan:</label>
        <input type="text" name="pekerjaan" value="{{ $alumnus->pekerjaan }}" class="border p-2 rounded w-full" required>

        <label for="ipk" class="block mt-4 mb-2">IPK:</label>
        <input type="number" name="ipk" step="0.01" value="{{ $alumnus->ipk }}" class="border p-2 rounded w-full" required>

        <button type="submit" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">Simpan</button>
    </form>
@endsection

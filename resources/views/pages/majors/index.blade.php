@extends('layouts.main')
@section('content')
<h1>Daftar Jurusan</h1>

<h2>Tambah Jurusan</h2>
<form action="{{ route('majors.store') }}" method="POST">
    @csrf
    <label for="kode_jurusan">Kode:</label>
    <input type="text" name="kode_jurusan" required>

    <label for="jurusan">Nama:</label>
    <input type="text" name="jurusan" required>

    <button type="submit">Tambah</button>
</form>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<table border="1">
    <thead>
        <tr>
            <th>Kode</th>
            <th>Nama</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($majors as $major)
            <tr>
                <td>{{ $major->kode_jurusan }}</td>
                <td>
                    <span id="nama_{{ $major->kode_jurusan }}">{{ $major->jurusan }}</span>
                    <form id="editForm_{{ $major->kode_jurusan }}" action="{{ route('majors.update', $major->kode_jurusan) }}" method="POST" style="display: none;">
                        @csrf
                        @method('PUT')
                        <input type="text" name="jurusan" value="{{ $major->jurusan }}">
                        <button type="submit">Simpan</button>
                    </form>
                </td>
                <td>
                    <a href="{{ route('majors.show', $major->kode_jurusan) }}">Lihat</a> |
                    <button onclick="toggleEdit('{{ $major->kode_jurusan }}')">Edit</button> |
                    <form action="{{ route('majors.destroy', $major->kode_jurusan) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<script>
    function toggleEdit(kodeJurusan) {
        const spanElement = document.getElementById(`nama_${kodeJurusan}`);
        const editForm = document.getElementById(`editForm_${kodeJurusan}`);

        if (spanElement.style.display === 'none') {
            spanElement.style.display = 'inline';
            editForm.style.display = 'none';
        } else {
            spanElement.style.display = 'none';
            editForm.style.display = 'inline';
        }
    }
</script>
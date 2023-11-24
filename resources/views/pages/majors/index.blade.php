@extends('layouts.main')

@section('content')
    <div id="majorsContent" hx-target="#majorsContent" hx-swap="outerHTML">

        <h1 class="text-4xl font-bold mb-6">Daftar Jurusan</h1>
        <h2 class="text-2xl mb-4">Tambah Jurusan</h2>
        <form hx-post="{{ route('majors.store') }}" hx-target="#majorsContent" hx-swap="outerHTML" class="mb-4">
            @csrf
            <div class="mb-4">
                <label for="kode_jurusan" class="block">Kode:</label>
                <input type="text" name="kode_jurusan" class="border p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label for="jurusan" class="block">Nama:</label>
                <input type="text" name="jurusan" class="border p-2 rounded" required>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Tambah</button>
        </form>

        @if(isset($success))
            <p class="text-green-500">{{ $success }}</p>
        @endif
        @if(session('success'))
            <p class="text-green-500">{{ session('success') }}</p>
        @endif

        <table class="border-collapse border border-black w-full">
            <thead>
                <tr>
                    <th class="border border-black px-4 py-2">Kode</th>
                    <th class="border border-black px-4 py-2">Nama</th>
                    <th class="border border-black px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($majors as $major)
                    <tr>
                        <td class="border border-black px-4 py-2">{{ $major->kode_jurusan }}</td>
                        <td class="border border-black px-4 py-2">
                            <span id="nama_{{ $major->kode_jurusan }}">{{ $major->jurusan }}</span>
                            <form id="editForm_{{ $major->kode_jurusan }}" action="{{ route('majors.update', $major->kode_jurusan) }}" method="POST" style="display: none;">
                                @csrf
                                @method('PUT')
                                <input type="text" name="jurusan" value="{{ $major->jurusan }}" class="border p-2 rounded">
                                <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-700">Simpan</button>
                            </form>
                        </td>
                        <td class="border border-black px-4 py-2">
                            <a href="{{ route('majors.show', $major->kode_jurusan) }}" class="text-blue-500 hover:underline">Lihat</a> |
                            <button onclick="toggleEdit('{{ $major->kode_jurusan }}')" class="text-blue-500 hover:underline">Edit</button> |
                            <form hx-delete="{{ route('majors.destroy', $major->kode_jurusan) }}" hx-confirm="Are you sure?" hx-target="#majorsContent" hx-swap="outerHTML" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
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
@endsection

@extends('layouts.main')

@section('content')
    <h1 class="text-4xl font-bold mb-6">Daftar Alumni</h1>

    <a href="{{ route('alumni.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah Alumni</a>

    @if(session('success'))
        <p class="text-green-500">{{ session('success') }}</p>
    @endif

    <div class="mt-4">
        <label for="search" class="block text-sm font-medium text-gray-700">Cari Nama/NIM Alumni:</label>
        <input type="text" id="search" name="search" value="{{ request('search') }}" class="mt-1 p-2 border rounded-md">
    </div>

    <table id="alumni-table" class="mt-4 w-full border-collapse border border-black">
        <thead>
            <tr>
                <th class="border border-black px-4 py-2">NIM</th>
                <th class="border border-black px-4 py-2">Nama</th>
                <th class="border border-black px-4 py-2">Jurusan</th>
                <th class="border border-black px-4 py-2">Tanggal Lahir</th>
                <th class="border border-black px-4 py-2">Alamat Lengkap</th>
                <th class="border border-black px-4 py-2">Pekerjaan</th>
                <th class="border border-black px-4 py-2">IPK</th>
                <th class="border border-black px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($alumni as $alumnus)
                <tr>
                    <td class="border border-black px-4 py-2">{{ $alumnus->nim }}</td>
                    <td class="border border-black px-4 py-2">{{ $alumnus->nama }}</td>
                    <td class="border border-black px-4 py-2">{{ $alumnus->major->jurusan }}</td>
                    <td class="border border-black px-4 py-2">{{ $alumnus->tanggal_lahir }}</td>
                    <td class="border border-black px-4 py-2">{{ $alumnus->alamat_lengkap }}</td>
                    <td class="border border-black px-4 py-2">{{ $alumnus->pekerjaan }}</td>
                    <td class="border border-black px-4 py-2">{{ $alumnus->ipk }}</td>
                    <td class="px-4 py-2 flex gap-1 ">
    <a href="{{ route('alumni.edit', $alumnus->nim) }}" class="text-blue-500 px-2 py-1 border border-blue-500 rounded hover:bg-blue-500 hover:text-white">Edit</a>
    <form action="{{ route('alumni.destroy', $alumnus->nim) }}" method="POST" class="inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-red-500 px-2 py-1 border border-red-500 rounded hover:bg-red-500 hover:text-white">Hapus</button>
    </form>
</td>

                </tr>
            @endforeach
        </tbody>
    </table>


    <script>
        // Active search using JavaScript
        let searchTimeout;

        document.getElementById('search').addEventListener('input', function () {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(function () {
                performSearch();
            }, 1000); // Set the delay in milliseconds
        });

        function performSearch() {
            const searchValue = document.getElementById('search').value;

            fetch(`{{ route('alumni.index') }}?search=${searchValue}`, {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log(data)
                updateTable(data.alumni)
            });
        }

        function updateTable(alumni) {
let rowsHTML = '';

alumni.forEach(alumnus => {
    rowsHTML += `
        <tr>
            <td class="border border-black px-4 py-2">${alumnus.nim}</td>
            <td class="border border-black px-4 py-2">${alumnus.nama}</td>
            <td class="border border-black px-4 py-2">${alumnus.major.jurusan}</td>
            <td class="border border-black px-4 py-2">${alumnus.tanggal_lahir}</td>
            <td class="border border-black px-4 py-2">${alumnus.alamat_lengkap}</td>
            <td class="border border-black px-4 py-2">${alumnus.pekerjaan}</td>
            <td class="border border-black px-4 py-2">${alumnus.ipk}</td>
            <td class="px-4 py-2 flex gap-1">
                <a href="{{ route('alumni.edit', '') }}/${alumnus.nim}" class="text-blue-500 px-2 py-1 border border-blue-500 rounded hover:bg-blue-500 hover:text-white">Edit</a>
                <form action="{{ route('alumni.destroy', '') }}/${alumnus.nim}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 px-2 py-1 border border-red-500 rounded hover:bg-red-500 hover:text-white">Hapus</button>
                </form>
            </td>
        </tr>`;
});

// Now you can append rowsHTML to your table body
const tableBody = document.getElementById('alumni-table').getElementsByTagName('tbody')[0];
tableBody.innerHTML = rowsHTML;
        }
    </script>
@endsection
@extends('layouts.main')
@section('content')
 <h1>Daftar Alumni</h1>

    <a href="{{ route('alumni.create') }}">Tambah Alumni</a>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    <div>
        <label for="search">Cari Nama/NIM Alumni:</label>
        <input type="text" id='search' name="search" value="{{ request('search') }}">
    </div>
    <table border="1" id="alumni-table" >
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
            const tableBody = document.getElementById('alumni-table').getElementsByTagName('tbody')[0];
            tableBody.innerHTML = '';

            alumni.forEach(alumnus => {
                const row = tableBody.insertRow();
                row.insertCell(0).innerText = alumnus.nim;
                row.insertCell(1).innerText = alumnus.nama;
                row.insertCell(2).innerText = alumnus.major.jurusan;
                row.insertCell(3).innerText = alumnus.tanggal_lahir;
                row.insertCell(4).innerText = alumnus.alamat_lengkap;
                row.insertCell(5).innerText = alumnus.pekerjaan;
                row.insertCell(6).innerText = alumnus.ipk;
                row.insertCell(7).innerHTML = `
                    <a href="{{ route('alumni.edit', '') }}/${alumnus.nim}">Edit</a> |
                    <form action="{{ route('alumni.destroy', '') }}/${alumnus.nim}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Hapus</button>
                    </form>`;
            });
        }
    </script>
@endsection
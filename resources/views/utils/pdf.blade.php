<!DOCTYPE html>
<html>

<head>
    <title>PDF Document</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>
    <h1 style="text-align: center">LIST CALON SISWA</h1>

    @foreach ($ruangan->groupBy('kelas_id') as $kelasId => $ruangans)
        <div>
            <h2>Nama Kelas: {{ $ruangans->first()->kelas->nama }}</h2>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>Telepon</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ruangans as $index => $r)
                        <tr>
                            <td>{{ $loop->iteration }}</td> <!-- Bisa diganti dengan indeks urut -->
                            <td>{{ $r->siswa->nama_lengkap }}</td>
                            @if ($r->siswa->jenis_kelamin === 'laki_laki')
                                <td>Laki</td>
                            @else
                                <td>Perempuan</td>
                            @endif
                            <td>{{ $r->siswa->alamat }}</td>
                            <td>{{ $r->siswa->telepon }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endforeach
</body>

</html>

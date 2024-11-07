<!-- resources/views/export/pelapor_table_pdf.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Pelapor PDF Export</title>
    <style>
        /* Include minimal inline styling if needed, e.g., for table borders */
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }
        th { background-color: #f3f4f6; }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Nama Petugas</th>
                <th>Email</th>
                <th>No. HP</th>
                <th>Nama Pelapor</th>
                <th>Nama Aplikasi</th>
                <th>Laporan Error</th>
                <th>Status</th>
                <th>Keterangan</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pelapors as $pelapor)
                <tr>
                    <td>{{ Auth::user()->name }}</td>
                    <td>{{ $pelapor->email }}</td>
                    <td>{{ $pelapor->nohp }}</td>
                    <td>{{ $pelapor->npelapor }}</td>
                    <td>{{ $pelapor->pengaduan->naplikasi ?? 'data-tidak-ditemukan' }}</td>
                    <td>{{ $pelapor->pengaduan->laporan ?? 'data-tidak-ditemukan' }}</td>
                    <td>{{ $pelapor->pengaduan->status->name ?? 'data-tidak-ditemukan' }}</td>
                    <td>{{ $pelapor->pengaduan->keterangan ?? 'data-tidak-ditemukan' }}</td>
                    <td>{{ $pelapor->pengaduan->created_at ?? 'data-tidak-ditemukan' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

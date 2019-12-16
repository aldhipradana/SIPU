<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Export PDF</title>
</head>
<body>
    <table border="1">
        <thead>
            <tr>
                <th>IdPinjaman</th>
                <th>Nama</th>
                <th>Bunga</th>
                <th>Jumlah Pinjaman</th>
                <th>Sisa Pinjaman</th>
                <th>Status Pinjaman</th>
            </tr>    
        </thead>
        <tbody>
            @foreach ($pinjamans as $i => $pinjaman)
                <tr>
                    <td> {{ $pinjaman->idPinjaman }} </td>
                    <td> {{ $pinjaman->nasabahs->firstname }} </td>
                    <td> {{ $pinjaman->bunga }} </td>
                    <td> {{ $pinjaman->jmlPinjam }} </td>
                    <td> {{ $pinjaman->sisaPinjam }} </td>
                    <td> {{ $pinjaman->status }} </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
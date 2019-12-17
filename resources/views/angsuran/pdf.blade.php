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
                <th>Id Angsuran</th>
                <th>Id Pinjaman</th>
                <th>Bunga</th>
                <th>Jumlah Pinjaman</th>
                <th>Sisa Pinjaman</th>
                <th>keterangan</th>
            </tr>    
        </thead>
        <tbody>
            @foreach ($angsurans as $i => $angsuran)
                <tr>
                    <td> {{ $angsuran->idAngsuran }} </td>
                    <td> {{ $angsuran->idPinjaman }} </td>
                    <td> {{ $angsuran->jmlAngsuran }} </td>
                    <td> {{ $angsuran->pinjamans->sisaPinjam }} </td>
                    <td> {{ $angsuran->keterangan }} </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
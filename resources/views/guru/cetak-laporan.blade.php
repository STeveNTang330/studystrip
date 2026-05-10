<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        /* Styling ringkas untuk Excel */
        .header { text-align: center; font-weight: bold; font-size: 16pt; }
        table { border-collapse: collapse; width: 100%; }
        th { background-color: #F9A826; color: #ffffff; border: 1px solid #000000; padding: 5px; }
        td { border: 1px solid #000000; padding: 5px; }
        .text-center { text-align: center; }
    </style>
</head>
<body>

    <table>
        <thead>
            <tr>
                <th colspan="5" class="header" style="background: none; color: #000; border: none;">
                    LAPORAN PERINGKAT SISWA - STUDYSTRIP
                </th>
            </tr>
            <tr>
                <th colspan="5" style="background: none; color: #000; border: none;">
                    Tarikh Cetak: {{ date('d-m-Y H:i') }}
                </th>
            </tr>
            <tr>
                <th style="width: 50px;">No</th>
                <th style="width: 250px;">Nama Siswa</th>
                <th style="width: 250px;">Email</th>
                <th style="width: 150px;">Total EXP</th>
                <th style="width: 150px;">Koin Aktif</th>
            </tr>
        </thead>
        <tbody>
            @foreach($siswa as $index => $s)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $s->name }}</td>
                <td>{{ $s->email }}</td>
                <td class="text-center">{{ $s->exp }}</td>
                <td class="text-center">{{ $s->coins }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
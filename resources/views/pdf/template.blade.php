<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Kerusakan Fasilitas Rusunawa Brawijaya</title>
    <style>
        .title,
        .date {
            text-align: center;
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: center;
            padding: 8px;
        }

        td.desc {
            text-align: center;
        }

        /* tr:nth-child(even) {
            background-color: #dddddd;
        } */
    </style>
</head>

<body>

<h2 class="title">Laporan Kerusakan Fasilitas Rusunawa Brawijaya</h2>
@if (count($months) == 1)
    <p class="date">Bulan {{ DateTime::createFromFormat('!m', $months[0])->format('F') }} Tahun {{ $year }}
    </p>
@elseif (count($months) > 1)
    <p class="date">Bulan {{ DateTime::createFromFormat('!m', $months[0])->format('F') }} -
        {{ DateTime::createFromFormat('!m', $months[count($months) - 1])->format('F') }} Tahun {{ $year }}</p>
@else
    <p class="date">Tahun {{ $year }}</p>
@endif
<table>
    <tr>
        <th style="width: 10%">Nomor</th>
        <th style="width: 20%">Nama</th>
        <th style="width: 15%">Kamar</th>
        <th style="width: 15%">Judul</th>
        <th>Deskripsi</th>
        <th style="width: 15%">Status</th>
    </tr>
    @foreach ($reports as $report)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $report->user->name }}</td>
            <td>{{ $report->room->name }}</td>
            <td>{{ $report->title }}</td>
            <td class="desc">{{ $report->description }}</td>
            @if ($report->status === 'pending')
                <td>Pending</td>
            @elseif ($report->status === 'success')
                <td>Selesai</td>
            @elseif($report->status === 'closed')
                <td>Ditutup</td>
            @else
                <td>Diterima</td>
            @endif
        </tr>
    @endforeach
</table>
</body>

</html>

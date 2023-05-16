<!DOCTYPE html>
<html>
<head>
    <title>Jadwal</title>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <style>
        * {
            -webkit-print-color-adjust: exact !important; /*Chrome, Safari, Edge*/
            color-adjust: exact !important; /*Firefox*/
        }

        body {
            background-color: white !important;
            -webkit-print-color-adjust: exact !important; /*Chrome, Safari, Edge*/
            color-adjust: exact !important; /*Firefox*/
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th {
            text-align: left;
            padding: 8px;
            background-color: black;
            color: white;
        }

        td {
            text-align: left;
            padding: 8px;
            border-bottom: 1px solid black;
        }
    </style>
</head>
<body>
<center>
    <h4>Jadwal</h4>
</center>
<small>{{$startDate}} - {{$endDate}}</small>
<table class="table">
    <thead>
    <tr>
        <th></th>
        <th>Mon</th>
        <th>Tue</th>
        <th>Wed</th>
        <th>Thu</th>
        <th>Fri</th>
        <th>Sat</th>
        <th>Sun</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $jadwal)
        <tr>
            <td>{{ $jadwal->day }}, {{ \Illuminate\Support\Carbon::parse($jadwal->tgl)->format('d-m-Y') }}</td>
            <td>{{ \Illuminate\Support\Carbon::parse($jadwal->tgl)->isMonday() ? $jadwal->title : '' }}</td>
            <td>{{ \Illuminate\Support\Carbon::parse($jadwal->tgl)->isTuesday() ? $jadwal->title : '' }}</td>
            <td>{{ \Illuminate\Support\Carbon::parse($jadwal->tgl)->isWednesday() ? $jadwal->title : '' }}</td>
            <td>{{ \Illuminate\Support\Carbon::parse($jadwal->tgl)->isThursday() ? $jadwal->title : '' }}</td>
            <td>{{ \Illuminate\Support\Carbon::parse($jadwal->tgl)->isFriday() ? $jadwal->title : '' }}</td>
            <td>{{ \Illuminate\Support\Carbon::parse($jadwal->tgl)->isSaturday() ? $jadwal->title : '' }}</td>
            <td>{{ \Illuminate\Support\Carbon::parse($jadwal->tgl)->isSunday() ? $jadwal->title : '' }}</td>
        </tr>
    @endforeach

    </tbody>
</table>


</body>
</html>

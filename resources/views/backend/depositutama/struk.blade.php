<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Member Card</title>
    <style>
        .card {
            width: 21.5cm;
            height: 7.398cm;
            padding: 0.5cm;
            text-align: left;
            background: #f8f8f8;
            border: 1px solid #ddd;
            padding: 10px;
            box-sizing: border-box;
        }

        margin-top: 0;
        }

        .card p {
            margin: 0;
        }

    </style>
</head>
<body>
<div class="card">
    <table>
        <tr>
            <th style="text-align: left; width: 585px;"><p>GoFit</p></th>
            <th style="text-align: left;"><p>No Struk : {{ $data->nomor_struk }}</p></th>
        </tr>
        <tr>
            <th style="text-align: left;"><p>Jl. Centralpark No. 10 Yogyakarta</p></th>
            <th style="text-align: left;"><p>Tanggal : {{ $data->created_at }}</p></th>
        </tr>
    </table>
    <hr>
    <br>
    <table>
        <tr>
            <th style="text-align: left; width: 200px;"><p>Member</p></th>
            <th style="text-align: left;"><p> : </p></th>
            <th style="text-align: left;"><p> {{ $data->format_id_member }} / {{ $data->first_name }} {{ $data->middle_name }} {{ $data->last_name }} </p></th>
        </tr>
        <tr>
            <th style="text-align: left;"><p>Deposit</p></th>
            <th style="text-align: left;"><p> : </p></th>
            <th style="text-align: left;"><p> {{ $data->nominal_deposit }} </p></th>
        </tr>
        <tr>
            <th style="text-align: left;"><p>Bonus Deposit</p></th>
            <th style="text-align: left;"><p> : </p></th>
            <th style="text-align: left;"><p> {{ $data->bonus_deposit }} </p></th>
        </tr>
        <tr>
            <th style="text-align: left;"><p>Total Deposit</p></th>
            <th style="text-align: left;"><p> : </p></th>
            <th style="text-align: left;"><p> {{ $data->total_deposit }} </p></th>
        </tr>
    </table>
    <br>
    <hr>
    <table>
        <tr>
            <th style="text-align: left; width: 520px;"><p></p></th>
            <th style="text-align: left;"><p>Kasir : P{{ $data->id_kasir }}/{{ $data->first_name_kasir }} {{ $data->middle_name_kasir }} {{ $data->last_name_kasir }}</p></th>
        </tr>
    </table>
</div>
</body>
</html>

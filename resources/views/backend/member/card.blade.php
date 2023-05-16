<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Member Card</title>
    <style>
        .card {
            width: 8.56cm;
            height: 5.398cm;
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
    <h1>GoFit</h1>
    <p>Jl. Centralpark No. 10 Yogyakarta</p>
    <hr>
    <p>Member ID: {{ $data->format_id_member }}</p>
    <p>Nama: {{ $data->first_name }} {{ $data->middle_name }} {{ $data->last_name }}</p>
    <p>Alamat: {{ $data->alamat }}</p>
    <p>Telpon: {{ $data->no_telpon }}</p>
</div>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laravel Generate Barcode Examples</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <style>
        body {
          background: rgb(255, 255, 255);
        }

        div {
          position: absolute;
          left: 50%;
          top: 50%;
          transform: translate(-50%, -50%);
          width: 40%;
          height: 50%;
          text-align: center;
        }
      </style>
</head>
<body>

    <div>
        <h1>Toko : {{$store->name}}</h1>
        {!! DNS2D::getBarcodeHTML(url('/toko?name='. $store->slug), 'QRCODE') !!}
    </div>
</body>
</html>

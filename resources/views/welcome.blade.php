<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aplikasi Pembayaran Listrik Pascabayar - PLN</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container {
            text-align: center;
            color: white;
            max-width: 600px;
            padding: 2rem;
        }
        .logo {
            font-size: 4rem;
            margin-bottom: 1rem;
        }
        .title {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        .subtitle {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }
        .buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }
        .btn {
            background: white;
            color: #1e3a8a;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(0,0,0,0.15);
        }
        .btn-admin {
            background: #dc2626;
            color: white;
        }
        .btn-admin:hover {
            background: #b91c1c;
        }
        .footer {
            margin-top: 3rem;
            font-size: 0.9rem;
            opacity: 0.7;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo"></div>
        <h1 class="title">Aplikasi Pembayaran Listrik Pascabayar</h1>
        <p class="subtitle">Sistem pembayaran listrik PLN yang mudah dan cepat untuk pelanggan dan petugas</p>

        <div class="buttons">
            @if (Route::has('login'))
                <a href="{{ route('login') }}" class="btn">Login sebagai Admin/Petugas</a>
                <a href="{{ route('pelanggan.login.form') }}" class="btn btn-admin">Login sebagai Pelanggan</a>
            @endif
        </div>

        <div class="footer">
            <p> 2024 PLN - Perusahaan Listrik Negara</p>
            <p>Bayar listrik lebih mudah dengan sistem digital</p>
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .content {
            background: #ffffff;
            padding: 30px;
            border: 1px solid #e0e0e0;
        }
        .footer {
            background: #f5f5f5;
            padding: 20px;
            text-align: center;
            border-radius: 0 0 10px 10px;
            font-size: 12px;
            color: #666;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Test Email dari BiomediHub</h1>
    </div>
    <div class="content">
        <h2>Halo!</h2>
        <p>Ini adalah email test dari sistem BiomediHub - Platform Manajemen Pembelajaran.</p>

        <p>Email ini dikirim untuk memverifikasi bahwa sistem email bekerja dengan baik.</p>

        <p><strong>Informasi:</strong></p>
        <ul>
            <li>Waktu pengiriman: {{ $timestamp }}</li>
            <li>Sistem: BiomediHub</li>
            <li>Environment: {{ $environment }}</li>
        </ul>

        <p>Jika Anda menerima email ini, berarti konfigurasi email sudah berfungsi dengan baik.</p>

        <a href="{{ $appUrl }}" class="button">Kunjungi BiomediHub</a>
    </div>
    <div class="footer">
        <p>&copy; {{ date('Y') }} BiomediHub. All rights reserved.</p>
        <p>Email ini dikirim secara otomatis, mohon tidak membalas email ini.</p>
    </div>
</body>
</html>

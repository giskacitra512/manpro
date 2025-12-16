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
            background-color: #f5f5f5;
        }
        .container {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 30px;
        }
        .info-box {
            background: #f8f9fa;
            border-left: 4px solid #667eea;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .info-box strong {
            color: #667eea;
            display: block;
            margin-bottom: 5px;
        }
        .message-box {
            background: #fff;
            border: 1px solid #e0e0e0;
            padding: 20px;
            margin: 20px 0;
            border-radius: 8px;
        }
        .message-box h3 {
            margin-top: 0;
            color: #333;
            font-size: 18px;
            border-bottom: 2px solid #667eea;
            padding-bottom: 10px;
        }
        .footer {
            background: #f5f5f5;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
        .badge {
            display: inline-block;
            padding: 5px 10px;
            background: #667eea;
            color: white;
            border-radius: 4px;
            font-size: 12px;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📧 Pesan Baru dari BiomediHub</h1>
        </div>

        <div class="content">
            <span class="badge">PESAN KONTAK</span>

            <p>Anda menerima pesan baru dari form kontak BiomediHub:</p>

            <div class="info-box">
                <strong>Dari:</strong>
                {{ $name }}
            </div>

            <div class="info-box">
                <strong>Email:</strong>
                <a href="mailto:{{ $email }}" style="color: #667eea; text-decoration: none;">{{ $email }}</a>
            </div>

            <div class="info-box">
                <strong>Subjek:</strong>
                {{ $subject }}
            </div>

            <div class="info-box">
                <strong>Waktu:</strong>
                {{ $timestamp }}
            </div>

            <div class="message-box">
                <h3>Isi Pesan:</h3>
                <p style="white-space: pre-wrap; margin: 0;">{{ $messageContent }}</p>
            </div>

            <hr style="border: none; border-top: 1px solid #e0e0e0; margin: 30px 0;">

            <p style="font-size: 14px; color: #666;">
                <strong>💡 Tips:</strong> Anda dapat membalas pesan ini langsung dengan mengklik tombol reply di email client Anda. Email akan otomatis terkirim ke {{ $email }}.
            </p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} BiomediHub. All rights reserved.</p>
            <p>Email ini dikirim secara otomatis dari form kontak website.</p>
        </div>
    </div>
</body>
</html>

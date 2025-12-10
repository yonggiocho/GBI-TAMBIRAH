<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Dikunci</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: #f9f9f9;
            font-family: Arial, sans-serif;
        }
        .card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        h2 { color: #e74c3c; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Login Dikunci</h2>
        <p>Terlalu banyak percobaan login gagal.</p>
        <p>Silakan coba lagi dalam <strong>{{ $minutes }} menit</strong>.</p>
    </div>
</body>
</html>

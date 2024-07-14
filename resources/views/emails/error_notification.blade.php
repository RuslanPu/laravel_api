<!-- resources/views/emails/error_notification.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #ff6b6b;
            padding: 10px;
            border-radius: 5px 5px 0 0;
            color: #fff;
            text-align: center;
        }
        .content {
            padding: 20px;
        }
        .footer {
            background-color: #f4f4f4;
            padding: 10px;
            border-radius: 0 0 5px 5px;
            text-align: center;
            color: #777;
            font-size: 12px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>{{ $title }}</h1>
    </div>
    <div class="content">
        <p><strong>Error Class:</strong> {{ $class }}</p>
        <p><strong>Error Content:</strong> {{ $content }}</p>
    </div>
    <div class="footer">
        <p>This is an automated message, please do not reply.</p>
    </div>
</div>
</body>
</html>

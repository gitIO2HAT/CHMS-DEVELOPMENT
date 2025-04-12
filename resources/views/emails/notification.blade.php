<!DOCTYPE html>
<html>
<head>
    <title>{{ $notification->name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .email-header {
            background: #4CAF50;
            color: white;
            text-align: center;
            padding: 20px;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
        }
        .email-body {
            padding: 20px;
            line-height: 1.6;
        }
        .email-body p {
            margin: 10px 0;
        }
        .email-body .highlight {
            font-weight: bold;
            color: #4CAF50;
        }
        .email-footer {
            background: #f4f4f4;
            text-align: center;
            padding: 10px;
            font-size: 14px;
            color: #888;
        }
        .email-footer a {
            color: #4CAF50;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            <h1>{{ $notification->name }}</h1>
        </div>

        <!-- Body -->
        <div class="email-body" style="font-family: Arial, sans-serif; line-height: 1.6;">
            <h2 style="color: #2563eb;">{{ $notification->name }}</h2>
            <p><strong>Date & Time:</strong> {{ $notification->date_time ?? 'N/A' }}</p>
            <p><strong>Message:</strong></p>
            <p>{{ $notification->message }}</p>
            <p>Thank you,</p>
            <p>{{ config('app.name') }}</p>
            </div>

        <!-- Footer -->
        <div class="email-footer">
            <p>Need assistance? <a href="mailto:kelwalker0143@gmail.com">Contact Support</a></p>
        </div>
    </div>
</body>
</html>

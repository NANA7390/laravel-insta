<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            padding: 20px;
        }
      
        p {
            margin: 10px 0;
            color: #1500ff;
        }
    </style>
</head>
<body>
    {{-- from details variables of registration controller --}}
    <p>Welcome, {{ $name }}!</p>
    <p>Thank you for registering.</p>
    <p>To start, visit us <a href="{{ $app_url }}">here</a>.</p>
    <p>Thank you!</p>
    
</body>
</html>
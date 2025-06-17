<!-- resources/views/documents/pdf.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Document PDF</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }
        .title {
            font-size: 24px;
            font-weight: bold;
        }
        .description {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="description">{{ $description }}</div>
</body>
</html>

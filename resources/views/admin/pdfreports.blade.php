<html>
<head>
    <style>
        /* Add your CSS styles for the PDF here */
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h1>{{ $title }}</h1>
    <p>Date: {{ $date }}</p>
    <img src="{{ $logo }}" alt="Logo" style="width: 100px;" />
    <table>
        <thead>
            <tr>
                <th>Gender</th>
                <th>Age Group</th>
                <th>Total Visitors</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($visitors as $visitor)
                <tr>
                    <td>{{ $visitor->gender }}</td>
                    <td>{{ $visitor->age_group }}</td>
                    <td>{{ $visitor->total }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

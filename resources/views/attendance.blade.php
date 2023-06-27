<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body {
            background: linear-gradient(to bottom, #192f2f, #000000);
            color: #ffffff;
            background-repeat: no-repeat;
            height: 100vh;
        }

        .table {
            border: 1px solid #dee2e6;
            background: linear-gradient(to bottom, #192f2f, #000000);
            color: #ffffff;
        }

        .table thead th {
            border-bottom: 1px solid #dee2e6;
            background-color: #192f2f;
            border-color: #192f2f;
            color: #ffffff;
        }

    </style>
</head>

<body>
<div class="container">
    <h1 class="mt-4 mb-4">Attendance</h1>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Name</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Total Working Hours</th>
            </tr>
            </thead>
            <tbody>
            @foreach($attendance as $att)
                <tr>
                    <td>{{$att->GetEmployee->name}}</td>
                    <td>{{$att->check_in}}</td>
                    <td>{{$att->check_out}}</td>
                    <td>{{\Carbon\Carbon::parse($att->check_out)->diffInHours(\Carbon\Carbon::parse($att->check_in))}}</td>
                </tr>
            @endforeach

            <!-- Add more table rows here -->
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
<script>
    $('.table').DataTable();
</script>
</body>

</html>

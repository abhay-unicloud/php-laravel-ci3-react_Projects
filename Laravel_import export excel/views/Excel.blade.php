<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Data to Excel</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            background-color: #fff;
            margin-top: 20px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #007bff;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .btn-export {
            width: 100%;
        }
    </style>
</head>
<body>

<div class="container">
    <h1> Export Data to Excel File in Laravel</h1>
    <br>
    <div class="form-group">
        <a href="{{ route('exportXlsx') }}" class="btn btn-success btn-export">Export to .xlsx</a>
        <br>
        <br>
        <a href="{{ route('exportXls') }}" class="btn btn-primary btn-export">Export to .xls</a>
    </div>
     <!-- Import form -->
     <form action="{{ route('import') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="file">Import from Excel:</label>
            <input type="file" name="file" accept=".xlsx, .xls" class="form-control">
        </div>
        <button type="submit" class="btn btn-info btn-import">Import</button>
    </form>
    <!-- form end -->
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Class</th>
                <th>Section</th>
                <th>Address</th>
                <th>Gender</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stud as $studentdetail)
            <tr>
                <td>{{ $studentdetail->id }}</td>
                <td>{{ $studentdetail->name }}</td>
                <td>{{ $studentdetail->email }}</td>
                <td>{{ $studentdetail->class }}</td>
                <td>{{ $studentdetail->section }}</td>
                <td>{{ $studentdetail->address }}</td>
                <td>{{ $studentdetail->gender }}</td>
                <td>{{ $studentdetail->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $stud->links() }}
</div>

<!-- Bootstrap JS (optional, you may not need it for this example) -->
<!-- Bootstrap JS (optional, you may not need it for this example) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
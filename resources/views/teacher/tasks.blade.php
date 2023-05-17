<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
</head>
<body>
    @extends('layouts.app')

    @section('content')
    <table id="tasks-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Student Name</th>
            <th>Set ID</th>
            <th>Task Number</th>
            <th>Result</th>
            <th>Submitted</th>
            <th>Is correct</th>
            <th>Points</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tasks as $task)
        <tr>
            <td>{{ $task->id }}</td>
            <td>{{ $task->student_name }}</td>
            <td>{{ $task->set_id }}</td>
            <td>{{ $task->task_number }}</td>
            <td>{{ $task->result }}</td>
            <td>{{ $task->submitted }}</td>
            <td>{{ $task->task_status }}</td>
            <td>{{ $task->points }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
    @endsection

    @section('scripts')
        <!-- Include the jQuery library -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Include the DataTables JavaScript -->
        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

        <!-- Include the DataTables Buttons extension -->
        <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#tasks-table').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'csv'
                    ]
                });
            });
        </script>
    @endsection

    @yield('scripts')
</body>
</html>
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
            <th>Student</th>
            <th>Task</th>
            <th>Generated At</th>
            <th>Submitted At</th>
            <th>Submitted Result</th>
            <th>Is Result Correct</th>
            <th>Points Obtained</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tasks as $task)
        <tr>
            <td>{{ $task->student->name }}</td>
            <td>{{ $task->task->task_name }}</td>
            <td>{{ $task->generated_at }}</td>
            <td>{{ $task->submitted_at ?? 0 }}</td>
            <td>{{ $task->submitted_result ?? 0 }}</td>
            <td>{{ $task->is_result_correct ? 'Yes' : 'No' }}</td>
            <td>{{ $task->point_obtained ?? 0 }}</td>
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
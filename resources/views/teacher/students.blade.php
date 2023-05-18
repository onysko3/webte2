<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
</head>
<body>
    @extends('layouts.app')

    @section('content')
        <table id="students-table">
            <thead>
                <tr>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Total Generated') }}</th>
                    <th>{{ __('Total Submitted') }}</th>
                    <th>{{ __('Total Points') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                    <tr>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->total_generated }}</td>
                        <td>{{ $student->total_submitted }}</td>
                        <td>{{ $student->total_points }}</td>
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
                $('#students-table').DataTable({
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

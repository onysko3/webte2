<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
</head>
<body>
    @extends('layouts.app')

    @section('content')
        <table id="students-table" style="width: 700px; margin: auto;" class="table table-striped">
            <thead>
                <tr style="background-color: black; color: white;">
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
        <div class="text-center mt-3">
        <button class="btn btn-secondary" type="button" onclick="exportTableToCSV('students.csv')">Export</button>
        </div>
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
            function exportTableToCSV(filename) {
                var csv = [];
                var rows = document.querySelectorAll('table tr');

                for (var i = 0; i < rows.length; i++) {
                    var row = [], cols = rows[i].querySelectorAll('td, th');

                    for (var j = 0; j < cols.length; j++) {
                        row.push(cols[j].innerText);
                    }

                    csv.push(row.join(','));
                }

                // Download CSV file
                var csvContent = 'data:text/csv;charset=utf-8,' + csv.join('\n');
                var encodedUri = encodeURI(csvContent);
                var link = document.createElement('a');
                link.setAttribute('href', encodedUri);
                link.setAttribute('download', filename);
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }

        </script>
    @endsection

    @yield('scripts')
</body>
</html>

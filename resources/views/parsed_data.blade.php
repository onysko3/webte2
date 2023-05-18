<!-- resources/views/parsed_data.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parsed LaTeX Data</title>
</head>
<body>
<h1>{{ __('Parsed LaTeX Data') }}</h1>
<table>
    <thead>
    <tr>
        <th>{{ __('Task Code') }}</th>
        <th>{{ __('Task Description') }}</th>
        <th>{{ __('Image Path') }}</th>
        <th>{{ __('Equation') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
                <tr>
                    <td>{{ $task['task_code'] }}</td>
                    <td>{!! $task['task_description'] !!}</td>
                    <td>{!! $task['image_path'] !!}</td>
                    <td>{!! $task['solution_equation'] !!}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

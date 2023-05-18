<table>
    <thead>
        <tr>
            <th>{{ __('ID') }}</th>
            <th>{{ __('Student Name') }}</th>
            <th>{{ __('Set ID') }}</th>
            <th>{{ __('Task Number') }}</th>
            <th>{{ __('Result') }}</th>
            <th>{{ __('Submitted') }}</th>
            <th>{{ __('Points') }}</th>
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
            <td>{{ $task->points }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

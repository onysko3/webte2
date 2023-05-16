<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Student Name</th>
            <th>Set ID</th>
            <th>Task Number</th>
            <th>Result</th>
            <th>Submitted</th>
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
            <td>{{ $task->points }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
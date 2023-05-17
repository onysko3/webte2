<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        #mainDiv {
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
</head>

<body>
    @extends('layouts.app')

    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                        <h3 class="mt-3 d-flex justify-content-center">Teacher admin panel</h3>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('teacher.students') }}" class="btn btn-primary mx-2">Table of Students</a>
                            <a href="{{ route('teacher.tasks') }}" class="btn btn-primary mx-2">Table of Tasks</a>
                            <a href="{{ route('instructions') }}" class="btn btn-primary mx-2">View Instructions</a>
                        </div>
                        <div>
                            <h2 class="mt-3 d-flex justify-content-center">Max points for Set</h2>
                            @foreach ($sets as $set)
                            <form action="{{ route('sets.update', $set->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="d-flex p-2 column justify-content-around">
                                    <p>Set ID: {{ $set->id }}</p>
                                    <p>File Name: {{ $set->file_name }}</p>

                                    <label for="points">Points:</label>
                                    <input type="text" name="points" value="{{ $set->points }}">

                                    <button class="btn btn-primary" type="submit">Update</button>
                                </div>
                            </form>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
</body>
</html>
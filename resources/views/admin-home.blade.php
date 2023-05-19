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
                        @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif
                            <h3 class="mt-3 d-flex justify-content-center">{{ __('Teacher admin panel') }}</h3>
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('teacher.students') }}" class="btn btn-primary mx-2">{{ __('Table of Students') }}</a>
                                <a href="{{ route('teacher.tasks') }}" class="btn btn-primary mx-2">{{ __('Table of Tasks') }}</a>
                                <a href="{{ route('instructions') }}" class="btn btn-primary mx-2">{{ __('View Instructions') }}</a>
                            </div>
                            <div>
                                <h2 class="mt-3 d-flex justify-content-center">{{ __('Max points for Set') }}</h2>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">{{ __('ID') }}:</th>
                                        <th scope="col">{{ __('File Name') }}:</th>
                                        <th scope="col">{{ __('Points') }}</th>
                                        <th scope="col">{{ __('Available to generate') }}</th>
                                        <th scope="col">{{ __('Available from') }}</th>
                                        <th scope="col">{{ __('Available to') }}</th>
                                        <th scope="col">{{ __('Action') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                        @foreach ($sets as $set)
                            <tr>
                                <form action="{{ route('sets.update', $set->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                <td>{{ $set->id }}</td>
                                <td>{{ $set->file_name }}</td>
                                <td><input class="form-control" type="text" name="points" value="{{ $set->points }}" style="width:40px;"></td>
                                    <td><input type="checkbox" name="available_to_generate" value="1" {{ $set->available_to_generate ? 'checked' : '' }}></td>
                                    <td><input style="width: 170px;" class="form-control" type="datetime-local" name="available_from" value="{{ $set->available_from ? (new DateTime($set->available_from))->format('Y-m-d\TH:i:s') : '' }}"></td>
                                    <td><input style="width: 170px;" class="form-control" type="datetime-local" name="available_to" value="{{ $set->available_to ? (new DateTime($set->available_to))->format('Y-m-d\TH:i:s') : '' }}"></td>
                                    <td><button class="btn btn-primary" type="submit">{{ __('Update') }}</button></td>
                                </form>
                            </tr>

                            @endforeach
                                    </tbody>
                                </table>
                            <div>
                            <form action="{{ route('upload.file') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <input type="file" class="form-control" name="file" id="file">
                                    </div>
                                    <div class="d-flex p-2 column justify-content-around">
                                    <button type="submit" class="btn btn-primary">{{ __('Upload') }}</button>
                                    </div>
                                </form>
                            </div>
                            <div>
                            <form action="{{ route('upload.image') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label class="ms-auto me-auto" for="file">Add Image if needed</label>
                                        <input type="file" class="form-control" name="file" id="file">
                                    </div>
                                    <div class="d-flex p-2 column justify-content-around">
                                    <button type="submit" class="btn btn-primary">{{ __('Upload') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
</body>

</html>

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
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        <h3 class="mt-3 d-flex justify-content-center">{{ __('Student admin panel') }}</h3>
                        <div class="mt-3 d-flex justify-content-center">
                            <a href="{{ route('instructions') }}" class="btn btn-primary">{{ __('View Instructions') }}</a>
                        </div>
                        <div id="sets_gen">
                            <h5>{{ __('Avaliable task sets') }}</h5>
                            @if(count($sets) == 0)
                                <p>{{ __('No sets are avaliable') }}</p>
                            @else
                                <form action="{{ route('student.generate') }}" method="POST">
                                    @csrf
                                    <div id="form-check">
                                        @foreach ($sets as $set)
                                            <div class="check-div">
                                                <input type="checkbox" class="checkBoxes form-check-input" onclick="ischecked()" name="sets[]" value="{{ $set->id }}">
                                                <label class="form-check-label">{{ $set->file_name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button type="submit" class="btn btn-secondary" id="generate-btn">{{ __('Generate tasks') }}</button>
                                </form>
                            @endif
                        </div>
                            <div class="container ml-4 mp-4 mt-4 mb-4">
                                <h2>{{ __('Your tasks') }}</h2>
                                <table id="table" class="hover row-border" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>{{ __('ID') }}</th>
                                        <th>{{ __('Set') }}</th>
                                        <th>{{ __('Task') }}</th>
                                        <th>{{ __('Generated') }}</th>
                                        <th>{{ __('Passed') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.overview = {!! json_encode($overview) !!};
    </script>
    <script>
        var routeEditor = '{{ route('student.editor', 1) }}';
    </script>
    <script
        src="https://code.jquery.com/jquery-3.6.4.js"
        integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
        crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('scripts/student/home.js') }}"></script>

@endsection

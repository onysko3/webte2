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
                        <h3 class="mt-3 d-flex justify-content-center">Student admin panel</h3>
                    <div class="mt-3 d-flex justify-content-center">
                    <a href="{{ route('instructions') }}" class="btn btn-primary">View Instructions</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

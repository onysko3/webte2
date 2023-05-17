<!DOCTYPE html>
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
    @extends('layouts.app')

    @section('content')
    <div id="mainDiv">
        <div class="text-center">
            <h3 class="mb-5 fw-bold">Instructions</h3>
        </div>
        <div class="text-center">
            <h2 class="mb-4 fw-bold">For Teacher</h2>
            <p>.............</p>
        </div>
        <div class="text-center">
            <h2 class="mb-4 fw-bold">For Student</h2>
            <p>.............</p>
        </div>
        <div class="text-center">
        <form method="POST" action="{{ route('view-pdf') }}">
            @csrf
            <button type="submit" class="btn btn-primary">Download PDF</button>
        </form>
    </div>
    </div>

    @endsection
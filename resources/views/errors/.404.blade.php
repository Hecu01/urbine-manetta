@extends('layouts.app')


@section('section-principal')
    <div class="mx-5" style="height: 50vh; display; grid; place-content:center; align-items:center">
        <div class="">
            <h1>404 - Page Not Found</h1>
            <p>The page you are looking for could not be found.</p>
            @if(isset($exception))
                <p>Error Code: {{ $exception->getCode() }}</p>
            @endif
        </div>
    </div>
@endsection
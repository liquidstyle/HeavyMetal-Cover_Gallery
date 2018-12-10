@extends('layouts.manager')

@section('content')
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="container">
        <h3>Title Details</h3>
    </div>

    @php
        echo '<pre>'.print_r($title->toArray(),TRUE).'</pre>';
    @endphp

@endsection

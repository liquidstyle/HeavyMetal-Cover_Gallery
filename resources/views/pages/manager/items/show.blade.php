@extends('layouts.manager')

@section('content')
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="container">
        <h3>Item Details</h3>
    </div>

    @php
        echo '<pre>'.print_r($item->toArray(),TRUE).'</pre>';
    @endphp

@endsection

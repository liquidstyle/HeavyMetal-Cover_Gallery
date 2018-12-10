@extends('layouts.manager')

@section('content')
    <div class="container">
        <h3>User Details</h3>
    </div>
    @php
        echo '<pre>'.print_r($user->toArray(),TRUE).'</pre>';
    @endphp
@endsection

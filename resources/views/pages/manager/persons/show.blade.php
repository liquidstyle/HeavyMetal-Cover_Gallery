@extends('layouts.manager')

@section('content')
    <div class="container">
        <h3>Person Details</h3>
    </div>

    @php
        echo '<pre>'.print_r($person->toArray(),TRUE).'</pre>';
    @endphp
@endsection

@extends('layouts.manager')

@section('content')
    <div class="container">
        <h3>Author Details</h3>
    </div>

    @php
        echo '<pre>'.print_r($author->toArray(),TRUE).'</pre>';
    @endphp
@endsection

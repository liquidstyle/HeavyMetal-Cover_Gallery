@extends('layouts.app')

@section('content')

<h1>Person Details</h1>

@php
    dd($person->toArray());
@endphp

@endsection
@extends('layouts.app')

@section('content')

<h1>Title Details</h1>

@php
    dd($title->toArray());
@endphp

@endsection
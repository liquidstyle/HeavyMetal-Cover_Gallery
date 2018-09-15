@extends('layouts.app')

@section('content')

<h1>Author Details</h1>

@php
    dd($author->toArray());
@endphp

@endsection
@extends('layouts.app')

@section('content')

<h1>Item Details</h1>

@php
    dd($item->toArray());
@endphp

@endsection
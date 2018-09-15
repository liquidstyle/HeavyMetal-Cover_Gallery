@extends('layouts.app')

@section('content')

<h1>User Profile</h1>

@php
    dd($user->toArray());
@endphp

@endsection
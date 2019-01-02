@extends('layouts.app')

@section('content')

<h1>{{ $item->name }}</h1>
<div>Special Issue: {{ $item->special_issue }}</div>
<div>Cover Variant {{ $item->cover_variant }}</div>

@endsection
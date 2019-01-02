@extends('layouts.app')

@section('content')
    <div id="app">
        <covers></covers>
    </div>
@endsection

@section('scripts')
    <script>
        window.auth_user = {!! json_encode($auth_user); !!};
    </script>
@endsection
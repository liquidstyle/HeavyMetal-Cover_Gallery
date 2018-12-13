@extends('layouts.manager')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Data Manager</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div>Total Items: {{ number_format($items) }}</div>
                    <div>Total Persons: {{ number_format($persons) }}</div>
                    <div>Total Users: {{ number_format($users) }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<h1>All Titles</h1>

@if(count($titles) > 0)

    <div class="float-left">
        {{ $titles->links() }}
    </div>
    <table class="table table-hover table-bordered table-striped">
        <col width="10%">
        <col width="90%">
        <thead>
            <tr>
                <th>
                    Issue
                </th>
                <th>
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach( $titles as $idx => $title)
                <tr>
                    <td class="text-center">
                         <img src="{{ $title->front_cover_path }}" width="150">
                    </td>
                    <td>
                        <div><h3><a href="/titles/{{ $title->id }}">{{ $title->name }}</a></h3></div>
                        <div><h5>{{ $title->special_issue }}</h5></div>
                        <div>Cover Variant: {{ $title->variant_cover }}</div>
                        <div>Front Cover: {{ $title->front_cover_author }} <em>"{{ $title->front_cover_name }} "</em></div>
                        <div>Back Cover: {{ $title->back_cover_author }} <em>"{{ $title->back_cover_name }} "</em></div>
                     </td>
                </tr>
            @endforeach
        <tbody>
        <tfoot>
        </tfoot>
    </table>
    {{ $titles->links() }}
@else
    <p>No Titles Found
@endif
@endsection
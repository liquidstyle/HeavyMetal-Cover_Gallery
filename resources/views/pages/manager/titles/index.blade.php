@extends('layouts.manager')

@section('content')
    <div class="container">
        <h3>Titles</h3>
    </div>

    @if(count($titles) > 0)
        <div class="float-left">
            {{ $titles->links() }}
        </div>
        <div class="float-right">
            <a href="/manager/titles/create" class="btn btn-primary">Add Title</a>
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
                            <div><h3><a href="/manager/titles/{{ $title->id }}">{{ $title->name }}</a></h3></div>
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

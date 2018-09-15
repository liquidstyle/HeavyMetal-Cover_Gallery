@extends('layouts.app')

@section('content')
<h1>All Authors</h1>

@if(count($authors) > 0)

    <div class="float-left">
        {{ $authors->links() }}
    </div>
    <table class="table table-hover table-bordered table-striped">
        <col width="10%">
        <col width="90%">
        <thead>
            <tr>
                <th>
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach( $authors as $idx => $author)
                <tr>
                    <td>
                        <a href="/authors/{{ $author->id }}">{{ $author->name }}</a>
                     </td>
                </tr>
            @endforeach
        <tbody>
        <tfoot>
        </tfoot>
    </table>
    {{ $authors->links() }}
@else
    <p>No Authors Found
@endif
@endsection
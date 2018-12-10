@extends('layouts.manager')

@section('content')
    <div class="container">
        <h3>Authors</h3>
    </div>
    @if(count($authors) > 0)

        <div class="float-left">
            {{ $authors->links() }}
        </div>
        <div class="float-right">
            <a href="/manager/authors/create" class="btn btn-primary">Add Author</a>
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
                            <a href="/manager/authors/{{ $author->id }}">{{ $author->name }}</a>
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

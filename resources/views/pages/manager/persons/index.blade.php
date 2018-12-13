@extends('layouts.manager')

@section('content')
    <div class="container">
        <h3>Persons</h3>
    </div>
    @if(count($persons) > 0)

        <div class="float-left">
            {{ $persons->links() }}
        </div>
        <div class="float-right">
            <a href="/manager/persons/create" class="btn btn-primary">Add Person</a>
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
                @foreach( $persons as $idx => $person)
                    <tr>
                        <td>
                            <a href="/manager/persons/{{ $person->id }}">{{ $person->name }}</a>
                        </td>
                    </tr>
                @endforeach
            <tbody>
            <tfoot>
            </tfoot>
        </table>
        {{ $persons->links() }}
    @else
        <p>No Persons Found
    @endif
@endsection

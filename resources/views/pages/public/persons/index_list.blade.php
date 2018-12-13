@extends('layouts.app')

@section('content')
<h1>All Persons</h1>

@if(count($persons) > 0)

    <div class="float-left">
        {{ $persons->links() }}
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
                        <a href="/persons/{{ $person->id }}">{{ $person->name }}</a>
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
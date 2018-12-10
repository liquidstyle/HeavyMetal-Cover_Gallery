@extends('layouts.manager')

@section('content')
    <div class="container">
        <h3>Users</h3>
    </div>
    @if(count($users) > 0)

        <div class="float-left">
            {{ $users->links() }}
        </div>
        <table class="table table-hover table-bordered table-striped">
            <col width="10%">
            <col width="90%">
            <thead>
                <tr>
                    <th>
                        Name
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach( $users as $idx => $user)
                    <tr>
                        <td>
                            @if ($user->admin == 1)
                                ADMIN : 
                            @endif
                            <a href="/manager/users/{{ $user->id }}">{{ $user->name }}</a>
                        </td>
                    </tr>
                @endforeach
            <tbody>
            <tfoot>
            </tfoot>
        </table>
        {{ $users->links() }}
    @else
        <p>No Users Found
    @endif
@endsection

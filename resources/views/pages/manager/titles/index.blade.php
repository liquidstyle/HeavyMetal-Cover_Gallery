@extends('layouts.manager')

@section('content')
    <div class="container">
        <h3>Items</h3>
    </div>

    @if(count($items) > 0)
        <div class="float-left">
            {{ $items->links() }}
        </div>
        <div class="float-right">
            <a href="/manager/items/create" class="btn btn-primary">Add Item</a>
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
                @foreach( $items as $idx => $item)
                    <tr>
                        <td class="text-center">
                            <img src="{{ $item->front_cover_path }}" width="150">
                        </td>
                        <td>
                            <div><h3><a href="/manager/items/{{ $item->id }}">{{ $item->name }}</a></h3></div>
                            <div><h5>{{ $item->special_issue }}</h5></div>
                            <div>Cover Variant: {{ $item->variant_cover }}</div>
                            <div>Front Cover: {{ $item->front_cover_person }} <em>"{{ $item->front_cover_name }} "</em></div>
                            <div>Back Cover: {{ $item->back_cover_person }} <em>"{{ $item->back_cover_name }} "</em></div>
                        </td>
                    </tr>
                @endforeach
            <tbody>
            <tfoot>
            </tfoot>
        </table>
        {{ $items->links() }}
    @else
        <p>No Items Found
    @endif
@endsection

@extends('layouts.app')

@section('content')

<h1>All Items</h1>

@if(count($items) > 0)

    <div class="float-left">
        {{ $items->links() }}
    </div>
    <table class="table table-hover table-bordered table-striped">
        <col width="10%">
        <col width="80%">
        <col width="10%">
        <thead>
            <tr>
                <th colspan="2">
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
                         <img src="{{ $item->front_cover() }}" width="150">
                    </td>
                    <td>
                        <div><h3><a href="/items/{{ $item->id }}">{{ $item->name }}</a></h3></div>
                        <div><h5>{{ $item->special_issue }}</h5></div>
                        <div>Cover Variant: {{ $item->variant_cover }}</div>
                        <div>Front Cover: {{ $item->front_cover_person }} <em>"{{ $item->front_cover_name }} "</em></div>
                        <div>Back Cover: {{ $item->back_cover_person }} <em>"{{ $item->back_cover_name }} "</em></div>
                     </td>
                     <td>
                         <item-like></item-like>
                         <item-favorite></item-favorite>
                         <item-wishlist></item-wishlist>
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
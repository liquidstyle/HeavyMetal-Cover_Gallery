<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Item;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::orderBy('yearmonth','asc')->paginate(25);

        return view('pages.manager.items.index')->with('items',$items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.manager.items.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $params = $request->input();

        if(strlen($params['year']) && strlen($params['month']))
        {
            $params['yearmonth'] = $params['year'].$params['month'];
        }

        if(count($params['front_cover_persons']))
        {
            $params['front_cover_persons'] = json_encode($params['front_cover_persons']);
        }

        if(count($params['back_cover_persons']))
        {
            $params['back_cover_persons'] = json_encode($params['back_cover_persons']);
        }

        if(count($params['signed_by']))
        {
            $params['signed_by'] = json_encode($params['signed_by']);
        }
        
        $item = Item::create($params);
        return redirect()->action(
            'Manager\ItemsController@show', ['id' => $item->id]
        )->with('message','Item Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('pages.manager.items.show')->with('item',Item::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

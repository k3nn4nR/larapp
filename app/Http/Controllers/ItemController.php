<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Code;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ItemStoreRequest;
use App\Http\Resources\ItemResource;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ItemResource::collection(Item::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $item = Item::create([
                'item' => mb_strtoupper($request->input('item')),
                'item_family_id' => $request->input('item_family_id'),
            ]);
            DB::commit();
            return response()->json(['item' => $item], 200);
        } catch(\Exception $e) {
            DB::rollBack();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
    }

    public function dashboard()
    {
        $total = Item::get()->count();
        $item_count = Item::orderBy('created_at')->get()->groupBy(function($item) {
            return $item->created_at->format('Y-m');
        })->map(function ($item, $key) {
            return $item->count();
        })->values();
        $item_keys = Item::orderBy('created_at')->get()->groupBy(function($item) {
            return $item->created_at->format('Y-m');
        })->keys();
        return compact('total','item_count','item_keys');
    }
}

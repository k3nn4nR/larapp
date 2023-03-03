<?php

namespace App\Http\Controllers;

use App\Models\ItemFamily;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ItemFamilyStoreRequest;
use App\Http\Resources\ItemFamilyResource;

class ItemFamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ItemFamilyResource::collection(ItemFamily::all());
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
    public function store(ItemFamilyStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $item = ItemFamily::create([
                'item_family' => mb_strtoupper($request->input('item_family')),
            ]);
            DB::commit();
            return redirect()->back()->with('message', 'Item family registered');
        } catch(\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('message', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ItemFamily  $itemFamily
     * @return \Illuminate\Http\Response
     */
    public function show(ItemFamily $itemFamily)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ItemFamily  $itemFamily
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemFamily $itemFamily)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ItemFamily  $itemFamily
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemFamily $itemFamily)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemFamily  $itemFamily
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemFamily $itemFamily)
    {
        //
    }
}

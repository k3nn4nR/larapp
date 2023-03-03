<?php

namespace App\Http\Controllers;

use App\Models\Code;
use App\Models\Payment;
use App\Models\Item;
use App\Models\Brand;
use App\Http\Resources\PaymentResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $brand = Brand::create([
                'brand' => mb_strtoupper($request->input('brand')),
            ]);
            DB::commit();
            return redirect()->back()->with('message', 'Brand registered');
        } catch(\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('message', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Code  $Code
     * @return \Illuminate\Http\Response
     */
    public function show(Code $Code)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Code  $Code
     * @return \Illuminate\Http\Response
     */
    public function edit(Code $Code)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Code  $Code
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Code $Code)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Code  $Code
     * @return \Illuminate\Http\Response
     */
    public function destroy(Code $Code)
    {
        //
    }

    public function test()
    {
        return PaymentResource::collection(Payment::all());
    }
}

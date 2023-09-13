<?php

namespace App\Http\Controllers;

use App\Models\Postt;
use Illuminate\Http\Request;

class PosttController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
           'postts' =>Postt::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $postt = new Postt;
        $postt->title = $request->title;
        $postt->description = $request->description;
        $postt->save();
        return response()->json([
            'message'=> 'Post Create',
            'status'=>'success',
            'data'=> $postt

        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Postt  $postt
     * @return \Illuminate\Http\Response
     */
    public function show(Postt $postt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Postt  $postt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Postt $postt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Postt  $postt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Postt $postt)
    {
        //
    }
}

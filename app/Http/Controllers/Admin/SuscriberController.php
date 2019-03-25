<?php

namespace App\Http\Controllers\Admin;

use App\Suscriber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SuscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suscribers=Suscriber::with('devis')->get();
        return view('admin.suscriber.index',compact(['suscribers']));
    }

    public function suscriber0()
    {
        $suscribers=Suscriber::with('devis')->where('theme', "!=",'')->get();
        return view('admin.suscriber0.index',compact(['suscribers']));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function destroy(Suscriber $suscriber)
    {
        $suscriber->delete();
        return redirect()->back();
    }
}

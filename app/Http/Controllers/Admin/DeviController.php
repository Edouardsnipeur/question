<?php

namespace App\Http\Controllers\Admin;

use App\Devi;
use App\Mail\Command;
use App\Mail\SendDevi;
use App\Suscriber;
use Faker\Calculator\Iban;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class DeviController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $devis=Devi::with('suscriber')->where('command',false)->orderByDesc('created_at')->get();
        return view('admin.devi.index',compact(['devis']));
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
    public function show(Devi $devi)
    {
        $suscriber=Suscriber::where('id',$devi->suscriber_id)->first();
        return view('admin.devi.show',compact(['suscriber','devi']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Devi $devi)
    {
        return view('admin.devi.edit',compact(['devi']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Devi $devi)
    {
        //dd($request->all());
        $this->validate($request,[
            'text' => 'required',
            'status' => 'required'
        ]);

        $devi->text=$request->text;
        $devi->command= ($request->status=='commander')?true:false;
        $devi->update();
        $suscriber=Suscriber::find($devi->suscriber_id);
        if ($devi->command)
        {
            Mail::to($suscriber)->send(new Command($suscriber,$devi));
        } else{
            Mail::to($suscriber)->send(new SendDevi($suscriber,$devi));
        }
        return redirect()->route('admin.devi.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Devi $devi)
    {
        $devi->delete();
        return redirect()->back();
    }
}

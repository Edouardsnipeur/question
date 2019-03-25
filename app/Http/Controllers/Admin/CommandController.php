<?php

namespace App\Http\Controllers\Admin;

use App\Devi;
use App\Mail\Command;
use App\Mail\SendDevi;
use App\Suscriber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class CommandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commands=Devi::with('suscriber')->where('command',true)->orderByDesc('created_at')->get();
        return view('admin.command.index',compact(['commands']));
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
        $devi=Devi::find($id);
        $suscriber=Suscriber::where('id',$devi->suscriber_id)->first();
        return view('admin.command.show',compact(['suscriber','devi']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $devi=Devi::find($id);
        return view('admin.command.edit',compact(['devi']));
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
        $devi=Devi::find($id);
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
        return redirect()->route('admin.command.index');
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

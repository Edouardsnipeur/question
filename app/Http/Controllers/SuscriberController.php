<?php

namespace App\Http\Controllers;

use App\Suscriber;
use Illuminate\Http\Request;

class SuscriberController extends Controller
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
        $this->validate($request,[
            'nom'=> 'required',
            'prenom'=>'required',
            'email'=> 'required|email|unique:suscribers',
            'telephone'=>'required|numeric',
            'residence'=> 'required',
            'sexe'=>'required',
        ]);
        $suscriber=new Suscriber();
        $suscriber->sexe=($request->sexe=='homme')?'H':'F';

        $request->session()->put('prenom',$request->prenom);
        $request->session()->put('sexe',$suscriber->sexe);
        $request->session()->put('email',$request->email);

        $suscriber=new Suscriber();
        $suscriber->sexe=($request->sexe=='homme')?'H':'F';


        $clair=$request->prenom.$suscriber->sexe.$request->email;

        $suscriber->hash=bcrypt($clair);
        $suscriber->nom=$request->nom;
        $suscriber->prenon=$request->prenom;
        $suscriber->email=$request->email;
        $suscriber->theme="";
        $suscriber->telephone=$request->telephone;
        $suscriber->residence=$request->residence;

        $suscriber->save();
        return redirect()->route('section');

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
    
}

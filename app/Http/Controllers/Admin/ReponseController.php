<?php

namespace App\Http\Controllers\Admin;

use App\Question;
use App\Reponse;
use App\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reponses = Reponse::with('question')->with('section')->get();
        return view('admin.reponse.index',compact(['reponses']));
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
    public function createReponseFromQuestion(Question $question)
    {
        //dd(old('text')[0]);
        return view('admin.reponse.create',compact(['question']));
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
            'question'=> 'required',
            'text.*'=>'required',
            'prix.*'=>'required',
            'image'=>'required',
            'image.*'=>'mimes:jpg,png,jpeg,bmp',

        ]);
        $images = $request->file('image');
        $ordre=1;
        $texts=$request->text;
        $prixs=$request->prix;
        $user=Auth::user()->id;
        $question=$request->question;
        $section=Question::with('section')->where('id',$question)->first()->section;

        foreach ($texts as $k => $v){
            $reponse=new Reponse();
            $slug=str_slug($v);
            $reponse->text=$v;
            $reponse->user_id=$user;
            $reponse->prix=$prixs[$k];
            $reponse->ordre=$ordre;
            $reponse->question_id=$question;
            $reponse->section_id=$section->id;
            if ($name=$this->resizePlaylistImage('image/reponse/'.$section->text,$images[$k],$slug)){
                $reponse->image=$name;
                //self::DeleteTemp($reponse->image);
            }
            $reponse->save();
        }

        //permet de redimensionner l'image. Cette fonction se trouve dans le controlleur principal


        //Toastr::success('Playlist sauvergarder avec success', 'success', ["positionClass" => "toast-bottom-left"]);
        return redirect()->route('admin.reponse.index');
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
    public function destroy(Reponse $reponse)
    {
        $t=Section::find($reponse->section_id)->text;
        if (Storage::disk('public')->exists('/image/reponse/'.$t.'/'.$reponse->image)){
            Storage::disk('public')->delete('/image/reponse/'.$t.'/'.$reponse->image);
        }
        $reponse->delete();
        return redirect()->back();
    }
}

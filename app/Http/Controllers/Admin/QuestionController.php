<?php

namespace App\Http\Controllers\Admin;

use App\Question;
use App\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $questions = Question::with('reponses')->with('section')->get();
        return view('admin.question.index',compact(['questions']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.question.create');
    }

    //Permet de creer des questions appaertenant une section tout en
    //cliquant sur un bouton qui se trouve sur cette section
    public function createQuestionFromSection(Section $section)
    {
        return view('admin.question.create',compact(['section']));
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
            'text'=> 'required',
            'section'=>'required',

        ]);
        //dd($request->all());
        $user=Auth::user()->id;
        $section=$request->section;
        $ordre=1;
        $pph=true;

        foreach ($request->text as $k => $text){

            if ($text!=null){
                $question = new Question();
                $question->user_id=$user;
                $question->ordre=$ordre;
                $question->pph=$pph;
                $question->text=$text;
                $question->section_id=$section;
                if ($request->qcm.$k=='oui'){
                    $question->qcm=true;
                }else{
                    $question->qcm=false;
                }
                $question->save();

            }

        };
        return redirect()->route('admin.section.index');
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
    public function edit(Question $question)
    {
        return view('admin.question.edit',compact(['question']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $this->validate($request,[
            'text'=> 'required',
        ]);

        foreach ($request->text as $text){
            if ($text!=null){
                $question->text=$text;
                if ($request->qcm=='oui'){
                    $question->qcm=true;
                }else{
                    $question->qcm=false;
                }
                $question->save();

            }
        };
        return redirect()->route('admin.question.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route('admin.question.index');
    }
}

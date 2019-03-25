<?php

namespace App\Http\Controllers\Admin;

use App\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $sections = Section::with('questions')->get();
        return view('admin.section.index',compact(['sections']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.section.create');
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
        'image'=>'mimes:jpg,png,jpeg,bmp',
    ]);
        $image = $request->file('image');
        $slug = str_slug($request->text);
        $section=new Section();

        //permet de redimensionner l'image. Cette fonction se trouve dans le controlleur principal
        if ($name=$this->resizePlaylistImage('image/section',$image,$slug)){
            $section->image=$name;
            self::DeleteTemp($section->image);
        }
        $section->text=$request->text;
        $section->slug=$slug;
        $section->user_id=Auth::user()->id;
        $section->save();
        //Toastr::success('Playlist sauvergarder avec success', 'success', ["positionClass" => "toast-bottom-left"]);
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
    public function edit(Section $section)
    {
        return view('admin.section.create',compact(['section']));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Section $section)
    {
        $this->validate($request,[
            'text'=> 'required',
            'image'=>'mimes:jpg,png,jpeg,bmp',
        ]);
        $image = $request->file('image');
        $slug = str_slug($request->text);


        //permet de redimensionner l'image. Cette fonction se trouve dans le controlleur principal
        if ($name=$this->resizePlaylistImage('image/section',$image,$slug)){
            self::DeleteUpdate($section->image);
            $section->text=$name;
            self::DeleteTemp($name);
        }
        $section->text=$request->text;
        $section->slug=$slug;
        $section->user_id=Auth::user()->id;
        $section->save();
        //Toastr::success('Playlist sauvergarder avec success', 'success', ["positionClass" => "toast-bottom-left"]);
        return redirect()->route('admin.section.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        $section->delete();
        return redirect()->route('admin.section.index');
    }
}

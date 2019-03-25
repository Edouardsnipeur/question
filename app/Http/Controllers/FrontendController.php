<?php

namespace App\Http\Controllers;

use App\Devi;
use App\Mail\Command;
use App\Mail\SendDevi;
use App\Notifications\DeviNotify;
use App\Notifications\CommandNotify;
use App\Question;
use App\Section;
use App\Suscriber;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Mailjet\LaravelMailjet\Facades\Mailjet;
use Mailjet\Resources;

class FrontendController extends Controller
{
    public function index()
    {
        //dd(session()->all());
        return view('frontend.root');
    }
    public function end()
    {
        //dd(session()->all());
        return view('frontend.fin');
    }
    public function categories()
    {
        $sections=Section::all();
        return view('frontend.section',compact(['sections']));
    }

    public function confirm(Devi $devi,$mail, $hash,Request $request)
    {

        $suscriber=Suscriber::all()->where('email',$mail)->first();
        if (Hash::check($hash.$mail,$suscriber->hash)){
            $request->session()->put('prenom',$suscriber->prenon);
            $request->session()->put('sexe',$suscriber->sexe);
            $request->session()->put('email',$suscriber->email);

            if ($suscriber->id==$devi->suscriber_id){
                $devi->command=true;
                $devi->update();
                $users=User::all();
                Notification::send($users, New CommandNotify($devi,$suscriber));
                return redirect()->route('command',$devi);
            }
            return redirect()->route('root');
        }
        return redirect()->route('root');
    }

    public function show(Request $request,Section $section)

    {
        $suscriber = Suscriber::all()->where('email',$request->session()->get('email'))->first();
        $suscriber->theme=$request->theme;
        $suscriber->update();
        $questions=Question::with('reponses')->where('section_id',$section->id)->get();
        //dd($questions);
        return view('frontend.question',compact(['questions','section']));
    }

    public function store(Request $request)

    {
        //dd($request->all());
        $suscriber = Suscriber::all()->where('email',$request->session()->get('email'))->first();
        $devi= new  Devi();
        $devi->suscriber_id=$suscriber->id;
        $devi->text=$request->text;
        $users=User::all();
        if ($request->command=='true'){
            $devi->command=true;
            $devi->save();
            Notification::send($users, New CommandNotify($devi,$suscriber));
            return redirect()->route('command',$devi);
        }
        $devi->command=false;
        $devi->save();
        Notification::send($users, New DeviNotify($devi,$suscriber));
        return redirect()->route('senddevi',$devi);
    }
    //permet d'envoyer un mail a u utilisateur qui a commander un projet
    public function command(Devi $devi)
    {
        $suscriber = Suscriber::all()->where('id',$devi->suscriber_id)->first();
        //return  new SendDevi($suscriber,$devi);
        //dd($suscriber);


        //$response = $mailjet->post(Resources::$Email, ['body' => $body]);

//        $rep=Mailjet::post(Resources::$Email,['body'=>$body]);
        //dd($response);
        Mail::to($suscriber)->send(new Command($suscriber,$devi));

//        Mail::send('email.senddevi',compact(['suscriber','devi']),function ($message){

//        });
        return redirect()->route('fin');
    }
    public function sendDevi(Devi $devi)
    {
        $suscriber = Suscriber::all()->where('id',$devi->suscriber_id)->first();
        //return  new SendDevi($suscriber,$devi);
        //dd($suscriber);
        Mail::to($suscriber)->send(new SendDevi($suscriber,$devi));
//        Mail::send('email.senddevi',compact(['suscriber','devi']),function ($message){

//        });
        return redirect()->route('fin');
    }
}

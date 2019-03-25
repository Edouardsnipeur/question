@extends('layouts.backend.app')
@section('title','Affiche un devi')
@section('content')

   <section class="content">
       <div class="row clearfix">
           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
               <div class="card">
                   <div class="body">
                       <h3>Abonne:</h3>
                       <p class="m-b-30">
                           <b>Nom: </b> {{$suscriber->nom}}</br>
                           <b>Prenom: </b> {{$suscriber->prenon}}</br>
                           <b>Email: </b> {{$suscriber->email}}</br>
                           <b>Telephone: </b> {{$suscriber->telephone}}</br>
                           <b>Statut du devis: </b> @if($devi->command==true) Commander @else Non commander @endif
                       </p>

                       <h2>Devis</h2>
                       {!! $devi->text !!}
                   </div>
               </div>
           </div>
       </div>
   </section>
@endsection


@extends('layouts.frontend.app')

@push('css')
<link rel="stylesheet" href="{{asset('frontend/css/bootstrap/css/bootstrap.min.css')}}">
<style>
    *{
        font-family: Sans-Serif;
    }
    h1,span{
        color: rgb(181, 218, 33);
        font-weight: bold;
    }
    h1{
        font-size: 2em;
    }
    ul{
        list-style-type: none;
        font-size: 1.2em;
    }
    .total{
        font-size: 2em;
    }

</style>
@endpush

<?php
    $message->to($suscriber->email);
    $message->subject('Devis professionnel');
?>
@section('content')
<h1>Bonjour @if($suscriber->sexe=='H') Monsieur @else Madame @endif {{$suscriber->prenon}}</h1>
<h3>Nous vous remercions d'avoir choisit la solution triooti pour votre projet!</h3>
<p>Dans les lignes qui suivent nous vous presentons votre devis.</p>
<p>
    {!! $devi->text !!}
</p>
<div>
    <a type="button" href="{{route('confirm',[$devi,$suscriber->email,$suscriber->prenon.$suscriber->sexe])}}" class="btn btn-primay" style="color: white; display: block; background-color: rgb(181, 218, 33); padding: 20px 10px; font-size: 1.5em; margin:20px auto;width: 300px">Commander mon projet</a>
</div>

@endsection
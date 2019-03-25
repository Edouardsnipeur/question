
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
<h1>Felicitation @if($suscriber->sexe=='H') Monsieur @else Madame @endif {{$suscriber->prenon}}</h1>
<h3>Nous vous remercions d'avoir commander votre projet chez triooti!</h3>
<p>Notre service commercial vous contactera dans 5 minuite.
    Dans les lignes qui suivent nous vous presentons votre devis.</p>
<p>
    {!! $devi->text !!}
</p>

@endsection
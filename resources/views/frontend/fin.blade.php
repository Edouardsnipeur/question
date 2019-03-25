@extends('layouts.frontend.app')

@push('css')
<link rel="stylesheet" href="{{asset('frontend/css/intl/css/intlTelInput.css')}}">
<link rel="stylesheet" href="{{asset('frontend/css/bootstrap/css/bootstrap.min.css')}}">
@endpush

@section('content')
    <section class="section initial">
        <img class="intro-image" src="{{asset('frontend/image/triooti.png')}}" alt="">
        <h1 class="title fonts-loaded"> Felicitation! Vous avez terminer la redaction de votre devis avec<strong> succes</strong>. Veuillez verifier vos emails SVP!!</h1>

        @if(session('email')==null)
            @else
            <p class="subtitle fonts-loaded">Veuillez cliquer sur le button ci dessous pour procedez a nouveau a la redaction de <span>votre devis</span>.</p>

            <a  href="{{route('section')}}" class="submit" style="color: white; margin-top: 30px">Procedons</a>

        @endif
    </section>


@endsection

@push('js')
<script src="{{asset('frontend/css/intl/js/intlTelInput.js')}}"></script>
<script>
    var input = document.querySelector("#phone");
    window.intlTelInput(input);
</script>
@endpush
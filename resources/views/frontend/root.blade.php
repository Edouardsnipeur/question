@extends('layouts.frontend.app')

@push('css')
<link rel="stylesheet" href="{{asset('frontend/css/intl/css/intlTelInput.css')}}">
<link rel="stylesheet" href="{{asset('frontend/css/bootstrap/css/bootstrap.min.css')}}">
@endpush

@section('content')
    <section class="section initial">
        <img class="intro-image" src="{{asset('frontend/image/triooti.png')}}" alt="">
        <h1 class="title fonts-loaded">Travailler <strong>sur un projet a triooti</strong>, petit questionnaire pour vous!</h1>

        @if(session('email')==null)
        <p class="subtitle fonts-loaded">Veuillez remplir le formulaire ci dessous pour nous donner quelques un de vos
            informations confidentielles visible uniquement par nous qui nous permettront de vous joindre rapidement!!!</p>
        <div class="form-container col-xs-12 col-lg-8 ">
            <form action="{{route('suscriber.store')}}" method="post">
                {{csrf_field()}}
                <div class="col-xs-12 col-sm-6">

                    <div class="form-group"><input name="nom" class="form-control" type="text" placeholder="Nom" value="{{old('nom')}}"></div>
                    <div class="form-group"><input name="prenom" class="form-control" type="text" placeholder="Prenom" value="{{old('prenom')}}"></div>
                    <div class="form-group"><input name="email" class="form-control" type="email" placeholder="Email" value="{{old('email')}}"></div>

                </div>
                <div class="col-xs-12 col-sm-6">

                    <div class="form-group" style="margin-bottom: 30px"><input name="telephone" class="form-control" type="text" value="{{old('telephone')}}" id="phone" ></div>
                    <div class="form-group"><input name="residence" value="{{old('residence')}}" class="form-control" type="text" placeholder="Residence"></div>
                    <div class="form-group" style="margin-top: 40px">
                        <label style="margin-right: 30px; color: white; font-size: 1.2em">
                            Sexe:
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="sexe" value="homme" checked>Home
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="sexe" value="femme">Femme
                        </label>
                    </div>
                </div>

                <div class="col-sm-12">
                    <input type="submit" class="submit" value="Procedons">
                </div>
            </form>

        </div>
            @else
            <p class="subtitle fonts-loaded">Veuillez cliquer sur le button ci dessous pour procedez au a la redaction de <span>votre devis</span>.</p>

            <a  href="{{route('section')}}" class="submit" style="color: white; margin-top: 30px">Procedons</a>


        @endif
    </section>


@endsection

@push('js')
<script src="{{asset('frontend/css/intl/js/intlTelInput.js')}}"></script>
<script src="{{asset('frontend/css/intl/js/utils.js')}}"></script>
<script>
    var input = document.querySelector("#phone");
    window.intlTelInput(input,({
        autoHideDialCode: true,
        autoPlaceholder: "polite",
        formatOnDisplay: true,
        preferredCountries: [ "tg", "bj","gh","fr" ],
    }));
</script>
@endpush
@extends('layouts.frontend.app')

@push('css')
<link rel="stylesheet" href="{{asset('frontend/css/bootstrap/css/bootstrap.min.css')}}">
@endpush

@section('content')
    <section class="section initial" data-question-id="1" data-pph="false" >
        <h2 class="question-title fonts-loaded">{{((session('sexe')=="H")?'Bonjour M. ':'Bonjour Mme ').session('prenom')}} de <span>quel</span> type de projet avez-vous besoin ?</h2>
        @foreach($sections->chunk(4) as $chunk)
            <div class="answer-group row-of-{{(count($chunk)<2)?2:count($chunk)}}">
            @foreach($chunk as $section)
                <div class="col" >
                    <div class="answer answer-qcm" onclick="send_show({{$section->id}})">
                        <img class="answer-image js--answer-image" src="{{Storage::disk('public')->url('image/section/'.$section->image)}}" alt="Site sur mesure">
                        <span class="answer-text">{{$section->text}}</span>
                    </div>
                </div>
                <form action="{{route('section.show',$section)}}" method="post" id="form-show-{{$section->id}}">{{csrf_field()}}
                    <input type="hidden" value="{{$section->text}}" name="theme">
                </form>
            @endforeach
            </div>
        @endforeach
    </section>
@endsection

@push('js')
    <script>
        function send_show(id) {
            document.getElementById('form-show-'+id).submit();
        }
    </script>
@endpush
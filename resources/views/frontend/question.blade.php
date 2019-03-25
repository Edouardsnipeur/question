@extends('layouts.frontend.app')

@push('css')
<link rel="stylesheet" href="{{asset('frontend/css/bootstrap/css/bootstrap.min.css')}}">
@endpush

@section('content')
    @foreach($questions as $k=> $question)
        <section class="section question" data-question-id="{{$k+1}}" data-qcm="{{($question->qcm == 1)? 'true' : 'false'}}" data-pph="{{($question->pph==1)?'true':'false'}}"  style="{{$k==0?"":"display:none"}}">
            <h2 class="question-title fonts-loaded">{{$question->text}}</h2>

            {{--{{$totalR = $question->reponses->count()}}--}}
            @if(($question->reponses->count()%4==0) || ($question->reponses->count()%4==3))
                @foreach($question->reponses->chunk(4) as $chunk)
                    @component('component.reponse',['chunk'=> $chunk,'section'=>$section])
                    @endcomponent
                @endforeach
            @endif

            @if(($question->reponses->count() % 4==1) || ($question->reponses->count() % 4==2))
                @if($question->reponses->count()<=5 ||$question->reponses->count()==6)
                    @foreach($question->reponses->chunk(3) as $chunk)
                        @component('component.reponse',['chunk'=> $chunk,'section'=>$section])
                        @endcomponent
                    @endforeach
                @endif
                @if($question->reponses->count()>6)
                    {{$tableaux=$question->reponses->chunk($question->reponses->count()-6)}}
                    @foreach($tableaux[0]->chunk(4) as $chunk)
                        @component('component.reponse',['chunk'=> $chunk,'section'=>$section])
                        @endcomponent
                    @endforeach
                    @foreach($tableaux[1]->chunk(3) as $chunk)
                        @component('component.reponse',['chunk'=> $chunk,'section'=>$section])
                        @endcomponent
                    @endforeach
                @endif

            @endif

            @if($question->qcm==1)
                <div class="suivant js--suivant"> Suivant > </div>
            @endif
            <span class="text-bold question-progress">{{($k+1).'/'.(count($questions))}}</span>
            @if($k!=0)
                <span class="text-bold price-progress js--price-progress">-</span>
                <span class="link question-previous js--previous">← Précédent</span>
            @endif
        </section>
    @endforeach

    @include('frontend.partial.total')
    <form id="devis" style="display: none" method="post" action="{{route('section.store')}}">
        {{csrf_field()}}
        <input class="formulaire" type="text" name="text" value="">
        <input class="command" type="text" name="command" value="">
    </form>
@endsection

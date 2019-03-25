@foreach($debut->chunk(4) as $chunk)
    <div class="answer-group row-of-{{(count($chunk)<2)?2:count($chunk)}}">
        @foreach($chunk as $h => $reponse)
            <div class="col" >
                <div class="answer answer-qcm js--answer"  data-answer-id="{{$h+1}}" data-answer-weight="{{$reponse->prix}}">
                    <img class="answer-image js--answer-image" src="{{Storage::disk('public')->url('image/reponse/'.$section->text.'/'.$reponse->image)}}" alt="Site sur mesure">
                    <span class="answer-text">{{$reponse->text}}</span>
                </div>
            </div>
        @endforeach
    </div>
@endforeach
@extends('layouts.backend.app')
@section('title','Creer une section')
@push('js')
<script src="{{asset('backend/plugins/tinymce/tinymce.js')}}"></script>
@endpush
@push('jsBefore')
<script src="{{asset('backend/js/pages/forms/editors.js')}}"></script>
@endpush
@section('content')

   <section class="content">
       <div class="row clearfix">
           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
               <div class="card">
                   <div class="header">
                       <h2>
                           Modifier une Commande
                           <small>Courage</small>
                       </h2>
                   </div>

                   <div class="body">
                       <form id="form_validation"  method="post" action="{{route('admin.command.update', $devi)}}">
                           {{csrf_field()}}
                           <input type="hidden" name="_method" value="PUT">
                           <div class="demo-radio-button">
                               <label>Status du devi</label>
                               <input name="status" @if($devi->command==true) checked="checked"   @endif value="commander" type="radio" class="with-gap" id="radio_3" />
                               <label for="radio_3">Commander</label>
                               <input name="status" @if($devi->command==false) checked="checked"   @endif value="non-commander" type="radio" id="radio_4" class="with-gap" />
                               <label for="radio_4">Non commander</label>
                           </div>
                            <textarea name="text" id="tinymce">
                                {{$devi->text}}
                            </textarea>
                           <a href="{{route('admin.command.index')}}" style="margin-right: 30px" type="button" class="btn btn-danger m-t-15 waves-effect">Retour</a>
                           <input type="submit" class="btn btn-primary m-t-15 waves-effect" value="Enregistrer"/>
                       </form>
                   </div>
               </div>
           </div>
       </div>
   </section>
@endsection

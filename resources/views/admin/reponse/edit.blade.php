@extends('layouts.backend.app')
@section('title','Creer une section')
@push('js')
<script src="{{asset('backend/plugins/jquery-validation/jquery.validate.js')}}"></script>
<script src="{{asset('backend/js/pages/forms/form-validation.js')}}"></script>


@endpush
@section('content')

   <section class="content">
       <div class="row clearfix">
           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
               <div class="card">
                   <div class="header">
                       <h2>
                           Ajouter une question
                       </h2>
                   </div>
                   <div class="body">
                       <form id="form_validation"  method="post" action="{{route('admin.question.update', $question)}}">
                           {{csrf_field()}}
                           <input type="hidden" name="_method" value="PUT">
                           <input type="hidden" name="section" value="{{$question->section_id}}">
                           <div class="field_wrapper">
                               <div class="form-group form-float">
                                   <div class="form-line">
                                       <input type="text" id="name" class="form-control" name="text[]" value="{{$question->text}}" required>
                                       <label class="form-label">Inserer la question </label>
                                   </div>
                               </div>
                               <div class="demo-radio-button" style="margin-bottom: 20px">
                                   <label style="margin-right: 30px">Question a choix multiple</label>
                                   <input name="qcm" value="oui"type="radio" id="oui" {{($question->qcm==true)?'checked':''}} />
                                   <label for="oui">Oui</label>
                                   <input name="qcm" value="non" type="radio" id="non" {{($question->qcm==false)?'checked':''}} />
                                   <label for="non">Non</label>
                               </div>
                           </div>
                           <a href="{{route('admin.section.index')}}" style="margin-right: 30px" type="button" class="btn btn-danger m-t-15 waves-effect">Retour</a>
                           <input type="submit" class="btn btn-primary m-t-15 waves-effect" value="Enregistrer"/>
                       </form>
                   </div>
               </div>
           </div>
       </div>
   </section>
@endsection

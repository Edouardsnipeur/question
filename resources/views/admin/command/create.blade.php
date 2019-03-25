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
                           Ajouter une section
                       </h2>
                   </div>
                   <div class="body">
                       <form id="form_validation" enctype="multipart/form-data"  method="post" action="{{isset($section)?route('admin.section.update',$section):route('admin.section.store')}}">
                           {{csrf_field()}}
                           @if(isset($section))
                               <input type="hidden" name="_method" value="PUT">
                           @endif
                           <div class="form-group form-float">
                               <div class="form-line">
                                   <input type="text" id="name" class="form-control" name="text" value="{{isset($section->text)?$section->text : old('text')}}" required>
                                   <label class="form-label">Nom de la section </label>
                               </div>
                           </div>
                           <div class="form-group form-float">
                               <div class="form-line">
                                   <label for="image">Image de la section</label>
                                   <input type="file" id="image" class="form-control" name="image" >
                               </div>
                           </div>
                           <a href="{{route('admin.section.index')}}" type="button" class="btn btn-danger m-t-15 waves-effect">Retour</a>
                           <button type="submit" class="btn btn-primary m-t-15 waves-effect">Enregistrer</button>
                       </form>
                   </div>
               </div>
           </div>
       </div>
   </section>
@endsection

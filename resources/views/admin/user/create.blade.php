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
                           Ajouter un utilisateur
                       </h2>
                   </div>
                   <div class="body">
                       <form id="form_validation"  method="post" action="{{route('admin.user.store')}}">
                           {{csrf_field()}}
                           <div class="field_wrapper">
                               <div class="form-group form-float">
                                   <div class="form-line">
                                       <input type="text" id="name" class="form-control" name="name" value="{{old('name')}}" required>
                                       <label class="form-label">Saisir le nom d'utilisateur </label>
                                   </div>
                               </div>
                               <div class="form-group form-float">
                                   <div class="form-line">
                                       <input type="email" id="email" class="form-control" name="email" value="{{old('email')}}" required>
                                       <label class="form-label">Saisir l'adresse E-mail</label>
                                   </div>
                               </div>
                               <div class="form-group form-float">
                                   <div class="form-line">
                                       <input type="password" id="pass" class="form-control" name="password" value="{{old('password')}}" required>
                                       <label class="form-label">Saisir le mot de pass</label>
                                   </div>
                               </div>

                           </div>
                           <a href="{{route('admin.user.index')}}" style="margin-right: 30px" type="button" class="btn btn-danger m-t-15 waves-effect">Retour</a>
                           <input type="submit" class="btn btn-primary m-t-15 waves-effect" value="Enregistrer"/>
                       </form>
                   </div>
               </div>
           </div>
       </div>
   </section>
@endsection

@extends('layouts.backend.app')
@section('title','Creer une section')
@push('js')
<script src="{{asset('backend/plugins/jquery-validation/jquery.validate.js')}}"></script>
<script src="{{asset('backend/js/pages/forms/form-validation.js')}}"></script>

<script>
        $(document).ready(function(){
            var maxField = 10; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper
            var x = 1; //Initial field counter is 1
            var fieldHTML ;  //New input field html

            fieldHTML=function (ide) {
                return '<div class="form-group form-float"> ' +
                    '<div class="form-line"> ' +
                    '<input type="text" id="name" class="form-control" name="text[]" value="" placeholder="Inserer la reponse" required> ' +
                    '</div> ' +
                    '</div> ' +
                    '<div class="form-group form-float"> ' +
                    '<div class="form-line"> ' +
                    '<input type="text" id="name" class="form-control" name="prix[]" value="" placeholder="Inserer le prix" required> ' +
                    '</div> ' +
                    '</div> ' +
                    '<div class="form-group form-float"> ' +
                    '<div class="form-line"> ' +
                    '<input type="file" id="image" class="form-control" name="image[]" required> ' +
                    '</div> ' +
                    '</div>';
            }

            //Once add button is clicked
            $(addButton).click(function(){
                //Check maximum number of input fields
                if(x < maxField){
                    $(wrapper).append(fieldHTML(x)); //Add field html
                    x++; //Increment field counter

                }
                return
            });


            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e){
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
                x--; //Decrement field counter
            });
        });
</script>

@endpush
@section('content')

   <section class="content">
       <div class="row clearfix">
           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
               <div class="card">
                   <div class="header">
                       <h2>
                           Ajouter une reponse
                       </h2>
                   </div>
                   <div class="body">
                       <form id="form_validation"  method="post" action="{{route('admin.reponse.store')}}" enctype="multipart/form-data">
                           {{csrf_field()}}
                           <input type="hidden" name="question" value="{{$question->id}}">
                           <div class="field_wrapper">
                               <div class="form-group form-float">
                                   <div class="form-line">
                                       <input type="text" id="name" class="form-control" name="text[]" value="{{old('text')[0]}}" required>
                                       <label class="form-label">Inserer la reponse </label>
                                   </div>
                               </div>

                               <div class="form-group form-float">
                                   <div class="form-line">
                                       <input type="text" id="name" class="form-control" name="prix[]" value="{{old('prix')[0]}}" required>
                                       <label class="form-label">Inserer le prix </label>
                                   </div>
                               </div>

                               <div class="form-group form-float">
                                   <div class="form-line">
                                       <label for="image">Image de la reponse</label>
                                       <input type="file" id="image" class="form-control" name="image[]" required >
                                   </div>
                               </div>


                           </div>
                           <a href="{{route('admin.section.index')}}" style="margin-right: 30px" type="button" class="btn btn-danger m-t-15 waves-effect">Retour</a>
                           <input type="submit" class="btn btn-primary m-t-15 waves-effect" value="Enregistrer"/>
                           <button type="button" class="btn btn-success m-t-15 waves-effect add_button" style="float: right">
                               <i class="material-icons">add</i>Ajouter</button>
                       </form>
                   </div>
               </div>
           </div>
       </div>
   </section>
@endsection

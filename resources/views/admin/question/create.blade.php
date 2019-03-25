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
                return '<div class="form-group form-float"><div class="form-line"> ' +
                    '<input type="text" id="name" class="form-control" name="text[]" required> ' +
                    '<label class="form-label"> </label> ' +
                    '</div> ' +
                    '</div>' +
                    '<div class="demo-radio-button" style="margin-bottom: 20px"> ' +
                    '<label style="margin-right: 30px">Question a choix multiple</label> ' +
                    '<input name="qcm'+ide+'" value="oui"type="radio" id="oui'+ide+'" checked /> ' +
                    '<label for="oui'+ide+'">Oui</label> ' +
                    '<input name="qcm'+ide+'" value="non" type="radio" id="non'+ide+'" /> ' +
                    '<label for="non'+ide+'">Non</label> ' +
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
                           Ajouter une question
                       </h2>
                   </div>
                   <div class="body">
                       <form id="form_validation"  method="post" action="{{route('admin.question.store')}}">
                           {{csrf_field()}}
                           <input type="hidden" name="section" value="{{$section->id}}">
                           <div class="field_wrapper">
                               <div class="form-group form-float">
                                   <div class="form-line">
                                       <input type="text" id="name" class="form-control" name="text[]" value="{{old('text')}}" required>
                                       <label class="form-label">Inserer la question </label>
                                   </div>
                               </div>
                               <div class="demo-radio-button" style="margin-bottom: 20px">
                                   <label style="margin-right: 30px">Question a choix multiple</label>
                                   <input name="qcm0" value="oui"type="radio" id="oui" checked />
                                   <label for="oui">Oui</label>
                                   <input name="qcm0" value="non" type="radio" id="non" />
                                   <label for="non">Non</label>
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

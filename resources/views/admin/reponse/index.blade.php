@extends('layouts.backend.app')
@section('title','reponse')



@push('css')
<!-- JQuery DataTable Css -->
<link href="{{asset('backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
<link href="{{asset('backend/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet" />
@endpush

@section('content')


    <section class="content">
        <div class="container-fluid">
            <div class="block-header">

                <!-- Exportable Table -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    Reponse<span class="badge bg-blue">{{$reponses->count()}}</span>
                                </h2>
                                <ul class="header-dropdown m-r--5">
                                </ul>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover dataTable js-exportable js-sweetalert">
                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Section</th>
                                            <th>Question</th>
                                            <th>Reponse</th>
                                            <th>Prix</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th>Id</th>
                                            <th>Section</th>
                                            <th>Question</th>
                                            <th>Reponse</th>
                                            <th>Prix</th>
                                            <th>Action</th>
                                        </tr>
                                        </tfoot>
                                        <tbody>
                                        @foreach($reponses as $k => $v)
                                            <tr>
                                                <td>{{$k+1}}</td>
                                                <td>{{str_limit($v->section->text,20)}}</td>
                                                <td>{{str_limit($v->text,30)}}</td>
                                                <td>{{str_limit($v->text,45)}}</td>
                                                <td>{{$v->prix}}</td>
                                                <td class="text-center">
                                                    <a class="btn btn-primary" href="{{route('admin.reponse.edit',$v)}}">
                                                        <i class="material-icons">edit</i>
                                                    </a>
                                                    <button class="btn btn-danger" onclick="deleteTag({{$v->id}})">

                                                        <i class="material-icons" >delete</i>
                                                    </button>


                                                    <form action="{{route('admin.reponse.destroy',$v)}}" id="form-data-{{$v->id}}" method="post">
                                                        {{csrf_field()}}
                                                        <input type="hidden" name="_method" value="DELETE">
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Exportable Table -->
            </div>

        </div>
    </section>

@endsection
@push('js')
<script src="{{asset('backend/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
<script src="{{asset('backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
<script src="{{asset('backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js')}}"></script>
<script src="{{asset('backend/plugins/jquery-datatable/extensions/export/jszip.min.js')}}"></script>
<script src="{{asset('backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js')}}"></script>
<script src="{{asset('backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js')}}"></script>
<script src="{{asset('backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js')}}"></script>
<script src="{{asset('backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js')}}"></script>
<script src="{{asset('backend/js/pages/tables/jquery-datatable.js')}}"></script>
<!-- SweetAlert Plugin Js -->
<script src="{{asset('backend/js/sweetalert2.all.js')}}"></script>
<script>
    function deleteTag($id) {
        const swalWithBootstrapButtons = swal.mixin({
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
        })

        swalWithBootstrapButtons({
            title: 'Etes vous sure?',
            text: "Cette action est irreversible!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Oui, Supprimer le!',
            cancelButtonText: 'Non, Annuler!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
            document.getElementById('form-data-'+$id).submit();

        } else if (
            // Read more about handling dismissals
        result.dismiss === swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons(
                'Cancelled',
                'Your imaginary file is safe :)',
                'error'
            )
        }
    })
    }

</script>

@endpush
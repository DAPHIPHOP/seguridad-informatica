@extends('layouts.main')

@section('content')
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
        rel="stylesheet">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Nuevo Perfil
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('user.store') }}" method="POST">
                    <div class="modal-body">
                        <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}" />
                        <div class="form-group">
                            <label>DNI</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                name="dni">
                        </div>
                        <div class="form-group">
                            <label>Nombres</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                name="name">
                        </div>
                        <div class="form-group">
                            <label>Apellidos</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                name="last_name">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Email </label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                placeholder="Enter email" name="email">

                        </div>


                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-primary btn-block">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Perfils</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Estado</th>
                            <th>Fecha de creacion</th>
                            <th>Fecha de actualizacion</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>


                        @foreach ($perfiles as $perfil)
                            <tr>
                                <td>{{ $perfil->name }}</td>

                                <td>
                                    @php
                                    $checked='';
                                        if($perfil->status=='Activo'){
                                            $checked='checked';
                                        }
                                    @endphp

                                    <input type="checkbox" {{$checked}} data-toggle="toggle" data-on="Activo" data-off="Inactivo"
                                        data-onstyle="success" data-offstyle="danger" onchange="updateState('{{route('update.stateProfile',['id'=>$perfil])}}')">
                                </td>
                                <td>{{ $perfil->created_at }}</td>
                                <td>{{ $perfil->updated_at }}</td>
                                <td>
                                    <a class="btn btn-danger btn-circle"
                                        onclick="destroy('{{ route('perfil.destroy', ['perfil' => $perfil]) }}',this)">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <a href="{{ route('perfil.edit', ['perfil' => $perfil]) }}" class="btn btn-success btn-circle">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                </td>

                            </tr>
                        @endforeach




                    </tbody>
                </table>
            </div>
        </div>
    </div>



@endsection


@section('script')

    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script>
        function destroy(url,el) {
            let td=$(el).parent().parent();


            Swal.fire({
                title: 'Desea eliminar el Perfil',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si'
            }).then((result) => {
                let token=$('#token').val();
                $.ajax({
                    // la URL para la petición
                    url :url,

                    // la información a enviar
                    // (también es posible utilizar una cadena de datos)
                    data : { _method : 'DELETE' ,_token:token},

                    // especifica si será una petición POST o GET
                    type : 'Post',

                    // el tipo de información que se espera de respuesta
                    dataType : 'json',

                    // código a ejecutar si la petición es satisfactoria;
                    // la respuesta es pasada como argumento a la función
                    success : function(json) {
                        Swal.fire(json.message)
                        td.remove();
                    },

                    // código a ejecutar si la petición falla;
                    // son pasados como argumentos a la función
                    // el objeto de la petición en crudo y código de estatus de la petición
                    error : function(xhr, status) {

                    },

                    // código a ejecutar sin importar si la petición falló o no
                    complete : function(xhr, status) {

                    }
                });
            })
        }


        function updateState(url){



            $.ajax({
                // la URL para la petición
                url :url,

                // la información a enviar
                // (también es posible utilizar una cadena de datos)
                data : { id : 123 },

                // especifica si será una petición POST o GET
                type : 'GET',

                // el tipo de información que se espera de respuesta
                dataType : 'json',

                // código a ejecutar si la petición es satisfactoria;
                // la respuesta es pasada como argumento a la función
                success : function(json) {
                    Swal.fire(json.message)
                    td.destroy();
                },

                // código a ejecutar si la petición falla;
                // son pasados como argumentos a la función
                // el objeto de la petición en crudo y código de estatus de la petición
                error : function(xhr, status) {

                },

                // código a ejecutar sin importar si la petición falló o no
                complete : function(xhr, status) {

                }
            });

        }

        @if (Session::has('destroyed'))
            Swal.fire('Perfil eliminado')
        @endif

        @if (Session::has('created'))
            Swal.fire('Perfil creado')
        @endif

        @if (Session::has('updated'))
            Swal.fire('Perfil actualizado')
        @endif
    </script>
@endsection

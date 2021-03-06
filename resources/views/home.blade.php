@extends('layouts.main')

@section('content')
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
        rel="stylesheet">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Nuevo usuario
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
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
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
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Perfil</label>
                            <select class="form-control" id="exampleFormControlSelect2" name="rol">
                                <option></option>
                            @foreach ($roles as $rol)
                            <option value="{{$rol->name}}">{{$rol->name}}</option>
                            @endforeach
                            </select>
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
            <h6 class="m-0 font-weight-bold text-primary">Usuarios</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th> Email</th>
                            <th>Perfil</th>
                            <th>Estado</th>
                            <th>Fecha de creacion</th>
                            <th>Acciones</th>

                        </tr>
                    </thead>

                    <tbody>


                        @foreach ($usuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->name }}</td>
                                <td>{{ $usuario->last_name }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>
                                    @foreach ($usuario->getRoleNames() as $rol)
                                        <li>{{ $rol }}</li>
                                    @endforeach
                                </td>
                                <td>
                                    @php
                                    $checked='';
                                        if($usuario->state=='Activo'){
                                            $checked='checked';
                                        }
                                    @endphp

                                    <input type="checkbox" {{$checked}} data-toggle="toggle" data-on="Activo" data-off="Inactivo"
                                        data-onstyle="success" data-offstyle="danger" onchange="updateState('{{route('update.state',['id'=>$usuario])}}')">
                                </td>
                                <td>{{ $usuario->created_at }}</td>
                                <td>
                                    <a class="btn btn-danger btn-circle"
                                        onclick="destroy('{{ route('user.destroy', ['id' => $usuario]) }}')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <a href="{{ route('user.edit', ['id' => $usuario]) }}" class="btn btn-success btn-circle">
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
        function destroy(url) {
            Swal.fire({
                title: 'Desea eliminar el usuario',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.replace(url);
                }
            })
        }


        function updateState(url){

            $.ajax({
                // la URL para la petici??n
                url :url,

                // la informaci??n a enviar
                // (tambi??n es posible utilizar una cadena de datos)
                data : { id : 123 },

                // especifica si ser?? una petici??n POST o GET
                type : 'GET',

                // el tipo de informaci??n que se espera de respuesta
                dataType : 'json',

                // c??digo a ejecutar si la petici??n es satisfactoria;
                // la respuesta es pasada como argumento a la funci??n
                success : function(json) {
                    Swal.fire(json.message)
                },

                // c??digo a ejecutar si la petici??n falla;
                // son pasados como argumentos a la funci??n
                // el objeto de la petici??n en crudo y c??digo de estatus de la petici??n
                error : function(xhr, status) {

                },

                // c??digo a ejecutar sin importar si la petici??n fall?? o no
                complete : function(xhr, status) {

                }
            });

        }

        @if (Session::has('destroyed'))
            Swal.fire('Usuario eliminado')
        @endif

        @if (Session::has('created'))
            Swal.fire('Usuario creado')
        @endif

        @if (Session::has('updated'))
            Swal.fire('Usuario actualizado')
        @endif
    </script>
@endsection

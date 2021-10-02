@extends('layouts.main')

@section('content')




        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ediat usuario</h5>

                </div>
                <form action="{{route('user.update',['id'=>$user])}}" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="form-group">
                            <label>DNI</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="dni" value="{{$user->dni}}">
                        </div>
                        <div class="form-group">
                            <label>Nombres</label>
                            <input type="text" class="form-control" name="name" value="{{$user->name}}">
                        </div>
                        <div class="form-group">
                            <label>Apellidos</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="last_name" value="{{$user->last_name}}">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Email </label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                placeholder="Enter email" name="email" value="{{$user->email}}">

                        </div>


                </div>
                <div class="modal-footer">

                    <button type="submit" class="btn btn-primary btn-block">Actualizar datos</button>
                </div>
            </form>
            </div>
        </div>





@endsection

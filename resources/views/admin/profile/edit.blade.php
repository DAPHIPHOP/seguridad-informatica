@extends('layouts.main')

@section('content')




        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ediat usuario</h5>

                </div>
                <form action="{{route('perfil.update',['perfil'=>$rol])}}" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                     <input type="hidden" name="_method"  value="PUT">
                        <div class="form-group">
                            <label>Nombres</label>
                            <input type="text" class="form-control" name="name" value="{{$rol->name}}">
                        </div>



                </div>
                <div class="modal-footer">

                    <button type="submit" class="btn btn-primary btn-block">Actualizar datos</button>
                </div>
            </form>
            </div>
        </div>





@endsection

@extends('layouts.main')

@section('content')
    <link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">{{ $message }}</h1>

    <style>
        input {
            border-radius: 5px;
            border: 1px solid #ccc;
            padding: 4px;
            font-family: 'Lato';
            width: 300px;
            margin-top: 10px;
        }

        label {
            width: 300px;
            font-weight: bold;
            display: inline-block;
            margin-top: 20px;
        }

        label span {
            font-size: 1rem;
        }

        label.error {
            color: red;
            font-size: 1rem;
            display: block;
            margin-top: 5px;
        }

        input.error {
            border: 1px dashed red;
            font-weight: 100;
            color: red;
        }

    </style>

    <div class="modal-dialog" role="document">
        <div class="modal-content " style="margin:100px 0;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cambio de contraseña</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('update.password') }}" method="POST" id="form">
                <div class="modal-body">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="form-group">
                        <label>Contraseña</label>
                        <input type="text" class="form-control" id="password" name="password">
                    </div>
                    <div class="form-group">
                        <label>Repita Contraseña</label>
                        <input type="text" class="form-control" id="password2" name="password2">
                    </div>


                </div>
                <div class="modal-footer">

                    <button type="submit" class="btn btn-primary btn-block">Guardar</button>
                </div>
            </form>
        </div>
    </div>








@endsection


@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"
        integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.min.js" integrity="sha512-XZEy8UQ9rngkxQVugAdOuBRDmJ5N4vCuNXCh8KlniZgDKTvf7zl75QBtaVG1lEhMFe2a2DuA22nZYY+qsI2/xA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.min.js" integrity="sha512-XZEy8UQ9rngkxQVugAdOuBRDmJ5N4vCuNXCh8KlniZgDKTvf7zl75QBtaVG1lEhMFe2a2DuA22nZYY+qsI2/xA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/localization/messages_es_PE.min.js" integrity="sha512-FTLASM/gqDlSKn2uDblTVPSn6c6fMTLlnAP7sBek5M4n9v3ZLcWvkdwfzVWLACsIZHKsxlC1iHSyBiKk09kfcA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>

        // just for the demos, avoids form submit
        $.validator.addMethod("passwordcheck", function(value) {


            return /^[a-zA-Z0-9]/.test(value)
            && /[a-z]/.test(value) // has a lowercase letter
            && /\d/.test(value)//has a digit
            && /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/.test(value)// has a special character
          },"La contraseña debe contener de 8 a 15 carácteres alfanuméricos (a-z A-Z), contener mínimo un dígito (0-9) y un carácter especial (_-=)."
          );


        $("#form").validate({
            rules: {
                password: {
                    required: true,
                    minlength: 8,
                    maxlength:15,
                   passwordcheck:true
                },
                password2: {
                    required: true,
                    minlength: 8,
                    maxlength:15,
                   passwordcheck:true,
                    equalTo: "#password"
                }
            }
        });
    </script>
@endsection

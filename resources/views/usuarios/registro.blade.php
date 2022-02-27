<!DOCTYPE html>
<html lang="en">

<head>
    <title>Registro</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="loginn/images/icons/favicon.ico" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="loginn/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="loginn/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="loginn/vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="loginn/vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="loginn/vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" type="text/css" href="loginn/vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="loginn/vendor/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="loginn/css/util.css">
    <link rel="stylesheet" type="text/css" href="loginn/css/main.css">
</head>

<body>

    <div class="limiter">
        <div class="container-login100" style="background-image: url('loginn/images/bg-01.jpg');">
            <div class="wrap-login100 p-t-30 p-b-50">
                <span class="login100-form-title p-b-41">
                    Registro
                </span>
                <div class="row" id="alertError" style="display: none;">
                    <div class="col-12">
                        <div class="alert alert-danger" role="alert">
                            <p>Whoops! Ocurrieron algunos errores</p>
                            <ul id="listaErrores">
                                @error('user_name')
                                    <li>{{ $message }}</li>
                                @enderror
                                @error('user_password')
                                    <li>{{ $message }}</li>
                                @enderror
                            </ul>
                        </div>
                    </div>
                </div>
                <form class="login100-form validate-form p-b-33 p-t-5" id="frmRegistro">
                    @csrf
                    <div class="wrap-input100">
                        <input class="input100 @error('user_name') is-invalid @enderror" type="text" name="user_name"
                            id="user_name" placeholder="Usuario">
                        <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                    </div>

                    <div class="wrap-input100">
                        <input class="input100 @error('user_password') is-invalid @enderror" type="password"
                            name="user_password" id="user_password" placeholder="Contraseña">
                        <span class="focus-input100" data-placeholder="&#xe80f;"></span>
                    </div>

                    <div class="wrap-input100">
                        <select class="input100" id="role_id" name="role_id">
                            <option value="0">Seleccione rol ...</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->role_id }}">{{ $role->role_description }}</option>
                            @endforeach
                        </select>
                        <span class="focus-input100" data-placeholder="&#xe82b;"></span>
                    </div>

                    <div class="container-login100-form-btn m-t-32">
                        <button type="submit" class="login100-form-btn">
                            Registrar
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="loginn/vendor/animsition/js/animsition.min.js"></script>
    <script src="loginn/vendor/select2/select2.min.js"></script>
    <script src="loginn/vendor/daterangepicker/moment.min.js"></script>
    <script src="loginn/vendor/daterangepicker/daterangepicker.js"></script>
    <script src="loginn/vendor/countdowntime/countdowntime.js"></script>
    <script src="loginn/js/main.js"></script>

    <script>
        $(function() {
            enviarRegistro();
        });

        var enviarRegistro = function() {
            $("#frmRegistro").on("submit", function(e) {
                e.preventDefault();

                $.ajax({
                    url: '{{ route('registro.verificar') }}',
                    method: 'POST',
                    dataType: 'json',
                    data: new FormData($("#frmRegistro")[0]),
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $("#alertError").hide();
                        console.log("Enviando...");
                    },
                    success: function(data) {
                        let mensaje = data.mensaje;
                        let usuario = data.user_name;
                        $("#frmRegistro")[0].reset();
                        Swal.fire(
                            'Registro Exitoso!',
                            mensaje,
                            'success'
                        )
                    },
                    error: function(data) {
                        let errores = data.responseJSON.errors;
                        let msjError = '';
                        Object.values(errores).forEach(function(valor) {
                            msjError += '<li>' + valor[0] + '</li>';
                        });
                        $("#listaErrores").html(msjError);
                        $("#alertError").show();
                    },
                    complete: function() {
                        console.log("COMPLETADO");
                    },
                });
            });
        }
    </script>

</body>

</html>

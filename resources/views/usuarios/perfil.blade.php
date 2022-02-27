@extends('layout.template')

@section('title')
    <title>ZeroGRUPS | Perfil</title>
@endsection

@section('titulo')
    Perfil de Usuario
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('bienvenido.index') }}">Bienvenido</a></li>
    <li class="breadcrumb-item active">Perfil</li>
@endsection

@section('contenido')
    <div class="card-header">
        <h3 class="card-title">Mi Perfíl</h3>
    </div>
    <div class="card-body">
        <form id="frmActualizarPerfil">
            @method('put')
            @csrf
            <div class="row">

                <div class="col-md-4">
                    <div class="card card-user">
                        <div class="image">
                            <img src="tim/assets/img/damir-bosnjak.jpg" alt="...">
                        </div>
                        <div class="card-body">
                            <div class="author">
                                <img class="avatar border-gray" style="cursor: pointer;" id="photo_perfil"
                                    src="{{ $usuario->upro_image }}" alt="..." data-toggle="modal"
                                    data-target="#update_photo">

                                <div class="modal fade" id="update_photo">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-default">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Actualizar Foto de Perfil</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">Imagen</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                id="exampleInputFile" name="upro_image">
                                                            <label class="custom-file-label"
                                                                for="exampleInputFile">Seleccione imagen</label>
                                                        </div>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Upload</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <img src="{{ $usuario->upro_image }}" id="photo_modal" width="213px"
                                                        height="220px" alt="Avatar" style="display:block; margin:auto;"
                                                        title="Change the avatar">
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success">Actualizar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#">
                                    <h5 class="title">{{ $usuario->usuario->user_name }}</h5>
                                </a>


                                <p class="description">
                                    @chetfaker
                                </p>
                            </div>
                            <p class="description text-center" id="about_me">
                                {{ $usuario->upro_aboutMe }}
                            </p>
                        </div>
                        <div class="card-footer">
                            <hr>
                            <div class="button-container">
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 col-6 ml-auto">
                                        <h5>12<br><small>Files</small></h5>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-6 ml-auto mr-auto">
                                        <h5>2GB<br><small>Used</small></h5>
                                    </div>
                                    <div class="col-lg-3 mr-auto">
                                        <h5>24,6$<br><small>Spent</small></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Cambiar Contraseña (*)</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="user_password"
                                            id="user_password" placeholder="Ingrese nueva contraseña">
                                    </div>
                                    <div class="form-group">
                                        <p style="color:red;">(*) Dejar en blanco si no se desea cambiar la contraseña!!!
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-8">
                    <div class="card card-user">
                        <div class="card-header">
                            <h5 class="card-title">Editar Perfil</h5>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-5 pr-1">
                                    <div class="form-group">
                                        <label>Company (disabled)</label>
                                        <input type="text" class="form-control" name="upro_company" id="upro_company"
                                            disabled="" placeholder="Company" value="{{ $usuario->upro_company }}">
                                    </div>
                                </div>
                                <div class="col-md-3 px-1">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" class="form-control" name="user_name" id="user_name"
                                            placeholder="Username" value="{{ $usuario->usuario->user_name }}">
                                    </div>
                                </div>
                                <div class="col-md-4 pl-1">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" class="form-control" name="upro_email" id="upro_email"
                                            placeholder="Email" value="{{ $usuario->upro_email }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" name="upro_firstName" id="upro_firstName"
                                            placeholder="Company" value="{{ $usuario->upro_firstName }}">
                                    </div>
                                </div>
                                <div class="col-md-6 pl-1">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control" name="upro_lastName" id="upro_lastName"
                                            placeholder="Last Name" value="{{ $usuario->upro_lastName }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" class="form-control" name="upro_address" id="upro_address"
                                            placeholder="Home Address" value="{{ $usuario->upro_address }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 pr-1">
                                    <div class="form-group">
                                        <label>City</label>
                                        <input type="text" class="form-control" name="upro_city" id="upro_city"
                                            placeholder="City" value="{{ $usuario->upro_city }}">
                                    </div>
                                </div>
                                <div class="col-md-4 px-1">
                                    <div class="form-group">
                                        <label>Country</label>
                                        <input type="text" class="form-control" name="upro_country" id="upro_country"
                                            placeholder="Country" value="{{ $usuario->upro_country }}">
                                    </div>
                                </div>
                                <div class="col-md-4 pl-1">
                                    <div class="form-group">
                                        <label>Postal Code</label>
                                        <input type="number" class="form-control" name="upro_postalCode"
                                            id="upro_postalCode" placeholder="ZIP Code"
                                            value="{{ $usuario->upro_postalCode }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>About Me</label>
                                        <textarea class="form-control textarea" name="upro_aboutMe"
                                            id="upro_aboutMe">{{ $usuario->upro_aboutMe }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="update ml-auto mr-auto">
                                    <button type="submit" class="btn btn-outline-success btn-round ">Actualizar
                                        Perfil</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
    <div class="card-footer">

    </div>
@endsection

@section('js')
    <script src="adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) { //Revisamos que el input tenga contenido
                var reader = new FileReader(); //Leemos el contenido

                reader.onload = function(e) {
                    $('#photo_modal').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }

        }

        $("#exampleInputFile").change(
            function() { //Cuando el input cambie (se cargue un nuevo archivo) se va a ejecutar de nuevo el cambio de imagen y se verá reflejado.
                readURL(this);
            });
    </script>

    <script>
        $("#frmActualizarPerfil").submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('profiles.update', auth()->user()->user_id) }}',
                method: 'POST',
                dataType: 'json',
                data: new FormData($("#frmActualizarPerfil")[0]),
                contentType: false,
                processData: false,
                success: function(data) {
                    let mensaje = data.mensaje;
                    let aboutme = data.aboutme;
                    let photo = data.photo;
                    document.getElementById("about_me").innerHTML = aboutme;
                    toastr.success(mensaje, 'Actualización Existosa', {
                        timeOut: 3000
                    });
                    document.getElementById("photo_modal").src = photo;
                    document.getElementById("photo_perfil").src = photo;
                    document.getElementById("photo_sidebar").src = photo;
                    document.getElementById("photo_navbar").src = photo;
                    $('#update_photo').modal('hide');
                },
            });
        });
    </script>
@endsection

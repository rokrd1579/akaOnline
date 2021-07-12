@extends('layouts.app_frontend')

@section('content')
@if(isset($cookie))
<input type="hidden" id="cookie" value="{{$cookie}}">
@endif

@if(Session::has('msj'))
<input type="hidden" id="icon" value="{{Session::get('icon')}}">
<input type="hidden" id="msjPerfil" value="{{Session::get('msj')}}">
@endif
<main>
    <div class="container margin_30">
        <div class="breadcrumbs">
            <ul>
                <li><a href="{{route('index.sitio.web')}}">Inicio</a></li>
                <li>Mi perfil</li>
            </ul>
        </div>
    </div>

    <div class="container margin_30">
        <div class="row">
            <aside class="col-lg-3" id="sidebar_fixed">
                <form action=#>
                    <div class="filter_col">
                        <div class="inner_bt"><a href="#" class="open_filters"><i class="ti-close"></i></a></div>
                        <div class="filter_type version_2">
                            <h4><a href="#filter_1" data-toggle="collapse" class="opened">Sus Datos</a></h4>
                            <div class="collapse show" id="filter_1">
                                <ul>
                                    <li>
                                        <a href="#" id="ifo_basic" onclick="vista1()">Información básica</a>
                                    </li>
                                    <li>
                                        <a href="#" id="change_name" onclick="vista2()">Cambiar nombre de usuario</a>
                                    </li>
                                    <li>
                                        <a href="#" id="segurity" onclick="vista3()">Inicio de sesión y seguridad</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Cerrar sesión') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                </form>
            </aside>

            <div class="col-lg-9 contenedor">
                @foreach($users as $user)
                @if($user->id == Auth::user()->id)

                <div id="basic" style="display: inline">
                    @php($control = 0)
                    @foreach ($profiles as $profile)
                    @if($profile->name_profile != null)
                    @php($control = 1)
                    @include('includes.app-frontend.form_profile_update')
                    @endif
                    @endforeach

                    @if($control != 1)
                    <div class="container-md shadow p-3 mb-5 bg-body rounded" style="background-color:rgb(255, 255, 255);">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 style="text-align: center;">Su información personal</h4>
                                <p style="text-align: center;">Información de facturación</p>
                                <form action="{{route('profile_store')}}" method="POST">
                                    {{csrf_field()}}
                                    <div class="row mt-3">
                                        <div class="col-md-4">
                                            <label> Nombre completo </label>
                                            <input class="form-control" type="text" name="name" placeholder="Tu Nombre" minlength="4" maxlength="50" onkeypress="return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32)" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label> No. Celular 1 </label>
                                            <input class="form-control" type="tel" name="primary_phone" placeholder="Ejemplo: 744001100" minlength="10" maxlength="10" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label> No. Celular 2 </label>
                                            <input class="form-control" type="tel" name="secondary_phone" placeholder="Ejemplo: 744001100" minlength="10" maxlength="10" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-4">
                                            <label> Género </label>
                                            <div class="custom-select-form">
                                                <select class="wide" name="gender">
                                                    <option value="Hombre">Hombre</option>
                                                    <option value="Mujer">Mujer</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <h4 style="text-align: center;">Su dirección</h4>
                                    <p style="text-align: center;">Dirección de entrega de pedidos</p>
                                    <div class="row mt-3">
                                        <div class="col-md-4">
                                            <label> Calle: </label>
                                            <input class="form-control" type="text" name="street_name" placeholder="Nombre de su calle" minlength="4" maxlength="50" onkeypress="return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32) ||  (event.charCode >= 48 && event.charCode <= 57) " required>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Número exterior </label>
                                            <input class="form-control" type="text" name="number_home" placeholder="Número de casa" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" minlength="1" maxlength="3" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Código postal: </label>
                                            <input class="form-control" type="text" name="postal_code" placeholder="Código postal" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" pattern="[0-9]{5}" maxlength="5" required>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-4">
                                            <label>Colonia: </label>
                                            <input class="form-control" type="tex" name="suburb" placeholder="Colonia" minlength="4" maxlength="50" onkeypress="return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32)" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Referencias: </label>
                                            <input class="form-control" type="text" name="references" placeholder="Ejemplo: Entre la calle 1 y 2" minlength="5" maxlength="100" onkeypress="return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32) || (event.charCode >= 48 && event.charCode <= 57)">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Ciudad: </label>
                                            <input class="form-control" type="text" name="city" placeholder="Acapulco de Juarez" minlength="5" maxlength="40" onkeypress="return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32)" required>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-4">
                                            <label>Estado: </label>
                                            <input class="form-control" type="text" name="state" placeholder="Guerrero" value="Guerrero" readonly onkeypress="return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32)" required>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-4">
                                        </div>
                                        <div class="col-md-4">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="submit" class="btn_1" value="Guardar">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>


                <div id="div_usuario" style="display: none">
                    <div class="container-md shadow p-3 mb-5 bg-body rounded" style=" background-color:rgb(255, 255, 255);">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Configuración de usuario</h4>
                                <p>Por seguridad para validar cambios, ingrese su contraseña</p><br>
                                <form action="{{route('user_update')}}">
                                    <div class="row mt-3">
                                        <div class="col-md-4">
                                            <label> Nombre de usuario: </label>
                                            <input class="form-control" type="text" name="name" placeholder="" required value="{{$user->name}}" minlength="4" maxlength="25" onkeypress="return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32)" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label> Contraseña: </label>
                                            <input class="form-control" id="password" type="password" name="password" placeholder="Contraseña" minlength="8" required>
                                        </div>
                                        <div class="col-md-2 p-4">
                                            <input type="submit" class="btn_1" value="Actualizar">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="div_contra" style="display: none">
                    <div class="container-md shadow p-3 mb-5 bg-body rounded" style=" background-color:rgb(255, 255, 255);">
                        <div class="filter_type version_2">
                            <h4><a href="#filter_2" data-toggle="collapse" class="opened"><b>Cambiar correo</b></a></h4>
                            <div class="collapse show" id="filter_2">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>Por seguridad para validar cambios, ingrese su contraseña</p><br>
                                        <form action="{{route('email_update')}}">
                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <label><b> Correo actual: </b></label>
                                                    <input class="form-control" type="email" name="email" value="{{$user->email}}" readonly required>
                                                </div>
                                                <div class="col-md-4">
                                                    <label><b> Nuevo Correo: </b></label>
                                                    <input class="form-control" type="email" name="email" placeholder="Nuevo correo" required>
                                                </div>
                                                <div class="col-md-4">
                                                    <label><b> Contraseña: </b></label>
                                                    <input class="form-control" type="password" name="password" placeholder="Contraseña" minlength="8" maxlength="30" required>
                                                </div>
                                                <div class="col-md-2 p-4">
                                                    <input type="submit" class="btn_1" value="Guardar">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="filter_type version_2 ">
                            <h4><a href="#filter_3" data-toggle="collapse" class="opened"><b>Cambiar contraseña</b></a></h4>
                            <div class="collapse show" id="filter_3">
                                <div class="row">
                                    <div class="col-md-12 ">
                                        <p>Por seguridad para validar cambios, ingrese su contraseña</p><br>
                                        <form action="{{route('password_update')}}">
                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <label><b> Nueva Contraseña: </b></label>
                                                    <input class="form-control" type="password" name="new_password" placeholder="Nueva contraseña" required>
                                                </div>
                                                <div class="col-md-4">
                                                    <label><b> Confirmar contraseña: </b></label>
                                                    <input class="form-control" type="password" name="new_password_confir" placeholder="Confirmar contraseña" required>
                                                </div>
                                                <div class="col-md-4">
                                                    <label><b> Contraseña actual:</b></label>
                                                    <input class="form-control" type="password" name="password" placeholder="Contraseña actual" required>
                                                </div>
                                                <div class="col-md-2 p-4">
                                                    <input type="submit" class="btn_1" value="Guardar">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</main>
@endsection

@push('js')
<script src="{{ asset('js/manual/profile.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    try {
        var infoPerfil = document.getElementById('msjPerfil').value;
        var icon = document.getElementById('icon').value;
        if (infoPerfil != null) {
            Swal.fire(
                'Información',
                infoPerfil,
                icon,
            )
        }
    } catch (error) {}

    try {
        var cookie = document.getElementById('cookie').value;
        var profileEmpty = document.getElementById('nombre').value;

        if (cookie > 0 && profileEmpty != "") {
            Swal.fire({
                title: 'Hay una compra incompleta',
                text: '¿Deseas continuar con el pago?',
                icon: 'warning',
                showCancelButton: true,
                allowOutsideClick: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si',
                cancelButtonText: 'No, cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/checkout';
                } else {
                    Swal.fire(
                        '¡Orden cancelada!',
                        'Tu orden se ha cancelado.',
                        'success'
                    )
                    window.location.href = '/checkout/clear';
                }
            })
        }
    } catch (error) {}
</script>
@endpush
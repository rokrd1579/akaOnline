@extends('layouts.app')

@section('content')
<div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block">
                                <img src="{{asset('img/AcaOnline.png')}}" width="500" height="500" alt="">
                            </div>
                            <div class="col-lg-6">
                                <br>
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Iniciar sesión</h1>
                                    </div>
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                
                                        <div class="form-group">
                                            <!--<label for="email" class="col-md-4 col-form-label text-md-right">E-mail</label>-->
                
                                            
                                                <input id="email" type="email" aria-describedby="emailHelp" class="form-control rounded-pill @error('email') is-invalid @enderror" name="email" placeholder="Correo electrónico..." required autocomplete="email" autofocus>
                
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            
                                        </div>
                
                                        <div class="form-group">
                                            <!--<label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>-->
                
                                            
                                                <!-- <input id="password" type="password" class="form-control rounded-pill @error('password') is-invalid @enderror" name="password" placeholder="Contraseña" required autocomplete="current-password"> -->
                                                <div class="input-group">
                                                <input ID="txtPassword" type="password" class="form-control py-2 rounded-pill mr-1 pr-5 @error('password') is-invalid @enderror" name="password" placeholder="Contraseña"  required autocomplete="current-password">
                                                    <span class="input-group-append">
                                                    <button id="show_password" class="btn rounded-pill border-0 ml-n5" type="button" onclick="mostrarPassword()"><span class="fa fa-eye-slash icon"></span> </button>
                                                    </span>
                                                </div>
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            
                                        </div>
                <br>
                                        <div class="form-group">
                                            <div class="">
                                                <button type="submit" class="btn btn-primary form-control rounded-pill">
                                                    Acceder
                                                </button>
                                            </div>
                                            <p></p>
                                            <div class="form-group text-center">
                                                @if (Route::has('password.request'))
                                                    <a class="" href="{{ route('password.request') }}">
                                                        ¿Olvidaste tu contraseña?
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="{{ route('register') }}">Crear una cuenta</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <script>
        function mostrarPassword(){
            var cambio = document.getElementById("txtPassword");
            if(cambio.type == "password"){
                cambio.type = "text";
                $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
            }else{
                cambio.type = "password";
                $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
            }
        } 
    </script>
@endsection

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
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Restablecer contraseña</h1>
                            <p class="mb-4">

                            </p>
                            <p class="mb-4"></p>
                        </div>
                        
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
    
                            <input type="hidden" name="token" value="{{ $token }}">
    
                            <div class="form-group">
                                <!--<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>-->
    
                                <div class="">
                                    <input id="email" type="email" class="form-control rounded-pill @error('email') is-invalid @enderror" placeholder="Dirección de correo electrónico" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group">
                                <!--<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>-->
    
                                <div class="">
                                    <!-- <input id="password" type="password" class="form-control rounded-pill @error('password') is-invalid @enderror" placeholder="Nueva contraseña" name="password" required autocomplete="new-password"> -->
                                    <div class="input-group">
                                    <input ID="txtPassword" type="password" class="form-control py-2 rounded-pill mr-1 pr-5 @error('password') is-invalid @enderror" name="password" placeholder="Nueva contraseña" required autocomplete="new-password">
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
                            </div>
    
                            <div class="form-group">
                                <!--<label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>-->
    
                                <div class="">
                                    <input id="password-confirm" type="password" class="form-control rounded-pill" name="password_confirmation" placeholder="Confirmar contraseña" required autocomplete="new-password">
                                </div>
                            </div>
    
                            <div class="form-group">
                                <div class="">
                                    <button type="submit" class="btn btn-primary form-control rounded-pill">
                                        Restablecer contraseña
                                    </button>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="register.html">¡Crear una cuenta!</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="login.html">¿Ya tienes una cuenta? ¡Accesa!</a>
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

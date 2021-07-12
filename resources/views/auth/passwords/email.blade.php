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
                <div class="col-lg-6 d-none d-lg-block ">
                    <img src="{{asset('img/AcaOnline.png')}}" width="500" height="500" alt="">
                </div>
                <div class="col-lg-6">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-2">¿Has olvidado tu contraseña?</h1>
                            <p class="mb-4">Lo entendemos, pasan cosas. Sólo tienes que introducir tu dirección de correo electrónico a continuación
                                 ¡y le enviaremos un enlace para restablecer su contraseña!</p>
                        </div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
        
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
        
                                <div class="form-group">
                                    <!--<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>-->
        
                                    <div class="">
                                        <input id="email" type="email" class="form-control rounded-pill @error('email') is-invalid @enderror" placeholder="Dirección de correo electrónico" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="form-group">
                                    <div class="">
                                        <button type="submit" class="btn btn-primary form-control rounded-pill">
                                            Enviar enlace
                                        </button>
                                    </div>
                                </div>
                            </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="{{ route('register') }}">Crear cuenta</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="{{ route('login') }}">¿Ya tienes una cuenta? ¡Accesa!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

</div>

</div>
</div>
@endsection

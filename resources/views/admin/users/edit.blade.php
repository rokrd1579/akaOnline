@extends('mainindex.maintemplate')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
@endsection

@section('seccion')
                                <div class="container-fluid">
                                    <!-- Page Heading -->
                                    <h1 class="h1 mb-2 text-gray-800">Usuarios <i class="fa fa-users"></i></h1>

                                    <!-- DataTales Example -->
                                    <div class="card shadow mb-4 ">
                                        <div>
                                            <div class="card-header d-sm-flex py-3 justify-content-between bg-primary">
                                                <h4 class="m-0 font-weight-bold text-white">Editar usuario</h4>
                                            </div>
                                                <div class="card-body">
                                                        <form action="{{route('admin.users.update', $user->id)}}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class=" text-center text-primary bg-white"><h6><strong> <i class="fa fa-user-circle"></i>  Datos del perfil y contacto de usuario</strong></h6></div>
                                                            <hr class="shadow-sm rounded-pill">
                                                            <div class="form-row">
                                                                <div class="form-group col-md-4">
                                                                    <label for="">Nombre de usuario</label>
                                                                    <input type="text"minlength="4" maxlength="80" class="@error('name') is-invalid @enderror form-control rounded-pill" name="name" placeholder="Nombre" value="{{$user->name}}">
                                                                    @error('name')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="">Nombre de perfil</label>
                                                                    <input type="text"minlength="4" maxlength="80" class="@error('name_profile') is-invalid @enderror form-control rounded-pill" name="name_profile" value="{{$user->profile->name_profile}}">
                                                                    @error('name_profile')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="exampleFormControlInput1">Dirección de correo electrónico</label>
                                                                    <input type="email"maxlength="200" class="form-control @error('email') is-invalid @enderror rounded-pill" name="email" placeholder="name@example.com" value="{{$user->email}}">
                                                                    @error('email')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group col-md-3">
                                                                    <label for="password" class="">Contraseña</label>
                                                                    <div class="input-group">
                                                                    <input ID="txtPassword" minlength="8" type="password" class="@error('password') is-invalid @enderror form-control py-2 rounded-pill mr-1 pr-5 @error('password') is-invalid @enderror" name="password" autocomplete="new-password" placeholder="Contraseña">
                                                                        <span class="input-group-append">
                                                                        <button id="show_password" class="btn rounded-pill border-0 ml-n5" type="button" onclick="mostrarPassword()"><span class="fa fa-eye-slash icon"></span> </button>
                                                                        </span>
                                                                        @error('password')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-3">
                                                                    <label for="password-confirm" class="">Cinfirmar contraseña</label>
                                                                    <input id="password-confirm" type="password" class="@error('password_confirmation') is-invalid @enderror form-control rounded-pill" name="password_confirmation" placeholder="Contraseña" autocomplete="new-password"> 
                                                                    @error('password_confirmation')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group col-md-3">
                                                                    <label for="formGroupExampleInput">Teléfono </label>
                                                                    <input class="@error('primary_phone') is-invalid @enderror form-control rounded-pill" step="any" id="num" type="number" name="primary_phone" value="{{$user->profile->primary_phone}}">
                                                                    @error('primary_phone')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group col-md-3">
                                                                    <label for="formGroupExampleInput">Teléfono secundario</label>
                                                                    <input class="form-control rounded-pill" step="any" id="num2" type="number" name="secondary_phone" value="{{$user->profile->secondary_phone}}">
                                                                </div>
                                                            </div>
                                                            <div class=" text-center text-primary bg-white"><h6><strong> <i class="fa fa-map-marker bg-white"></i>  Datos de la dirección de empresa</strong></h6></div>
                                                            <hr class="shadow-sm rounded-pill">
                                                            <div class="form-row">
                                                                <div class="form-group col-md-4">
                                                                    <label for="formGroupExampleInput">Estado</label>
                                                                    @foreach ($user->profile->addresses as $item)
                                                                        <input type="text"minlength="5" maxlength="80" class="@error('state') is-invalid @enderror form-control rounded-pill" name="state" value="{{$item->state}}">
                                                                    @endforeach
                                                                    @error('state')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="formGroupExampleInput">Ciudad</label>
                                                                    @foreach ($user->profile->addresses as $item)
                                                                        <input type="text"minlength="5" maxlength="80" class="@error('city') is-invalid @enderror form-control rounded-pill" id="formGroupExampleInput" name="city" value="{{$item->city}}">
                                                                    @endforeach
                                                                    @error('city')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="formGroupExampleInput">Colonia</label>
                                                                    @foreach ($user->profile->addresses as $item)
                                                                    <input type="text"minlength="8" maxlength="100" class="@error('suburb') is-invalid @enderror form-control rounded-pill" id="formGroupExampleInput" name="suburb" value="{{$item->suburb}}">
                                                                    @endforeach
                                                                    @error('suburb')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group col-md-3">
                                                                    <label for="formGroupExampleInput">Calle</label>
                                                                    @foreach ($user->profile->addresses as $item)
                                                                        <input type="text"minlength="5" maxlength="100" class="@error('street_name') is-invalid @enderror form-control rounded-pill" id="formGroupExampleInput" name="street_name" value="{{$item->street_name}}">
                                                                    @endforeach
                                                                    @error('street_name')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                </div>
                                                                <div class="form-group col-md-3">
                                                                    <label for="formGroupExampleInput">Referencias</label>
                                                                    @foreach ($user->profile->addresses as $item)
                                                                        <input type="text"minlength="10" maxlength="100" class="@error('references') is-invalid @enderror form-control rounded-pill" id="formGroupExampleInput" name="references" value="{{$item->references}}">
                                                                    @endforeach
                                                                    @error('references')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                </div>
                                                                <div class="form-group col-md-3">
                                                                    <label for="formGroupExampleInput">Número exterior</label>
                                                                    @foreach ($user->profile->addresses as $item)
                                                                        <input type="number"minlength="4" id="num3" class="@error('number_home') is-invalid @enderror form-control rounded-pill" pattern="^[0-9]+" step="any" id="formGroupExampleInput" name="number_home" value="{{$item->number_home}}">
                                                                    @endforeach
                                                                    @error('number_home')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                </div>
                                                                <div class="form-group col-md-3">
                                                                    <label for="formGroupExampleInput">Código postal</label>
                                                                    @foreach ($user->profile->addresses as $item)
                                                                        <input type="number" class="@error('number_home') is-invalid @enderror form-control rounded-pill" id="num4" pattern="^[0-9]+" step="any" id="formGroupExampleInput" name="postal_code" value="{{$item->postal_code}}">
                                                                    @endforeach
                                                                    @error('postal_code')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-gorup col-md-6">
                                                                    <label for="formGroupExampleInput">Asignar rol</label>
                                                                    <div class="form-group">
                                                                        @foreach($roles as $role)
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="@error('roles') is-invalid @enderror form-check-input" type="radio"  id="inlineRadio1" name="roles" value="{{$role->name}}"{{$user->hasRole($role->id)?'checked':''}}>
                                                                                <label class="form-check-label" for="inlineRadio3">{{$role->name}}</label>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col">
                                                                    <label for="formGroupExampleInput">Género</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="radio"  id="inlineRadio1" name="gender" value="F"
                                                                            @if($user->profile->gender=='F')        
                                                                                checked
                                                                            @endif
                                                                            >
                                                                            <label class="form-check-label" for="inlineRadio1">Femenino</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="radio"  id="inlineRadio2" name="gender" value="M"
                                                                            @if($user->profile->gender=='M')        
                                                                                checked
                                                                            @endif
                                                                            >
                                                                            <label class="form-check-label" for="inlineRadio2">Masculino</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group custom-control custom-switch">
                                                                <input type="checkbox" class="custom-control-input" id="customSwitch1" id="active" name="active"
                                                                @if($user->active==1)        
                                                                    checked
                                                                @endif
                                                                >
                                                                <label class="custom-control-label" for="customSwitch1">Activo</label>
                                                                </div>
                                                            <div class="modal-footer">
                                                                <a href="{{route('admin.users.index')}}" class="btn btn-danger rounded-pill shadow-sm" data-dismiss="modal">Cerrar</a>
                                                                <button type="submit" class="btn btn-primary rounded-pill shadow-sm">Guardar</button>
                                                            </div>
                                                        </form>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    var input=  document.getElementById('num');
                                    input.addEventListener('input',function(){
                                    if (this.value.length >10) 
                                        this.value = this.value.slice(0,10);
                                    })
                                </script>
                                <script>
                                    var input=  document.getElementById('num2');
                                    input.addEventListener('input',function(){
                                    if (this.value.length >10) 
                                        this.value = this.value.slice(0,10);
                                    })
                                </script>
                                <script>
                                    var input=  document.getElementById('num3');
                                    input.addEventListener('input',function(){
                                    if (this.value.length >10) 
                                        this.value = this.value.slice(0,10);
                                    })
                                </script>
                                <script>
                                    var input=  document.getElementById('num4');
                                    input.addEventListener('input',function(){
                                    if (this.value.length >10) 
                                        this.value = this.value.slice(0,10);
                                    })
                                </script>
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
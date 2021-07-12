@extends('mainindex.maintemplate')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
@endsection

@section('seccion')
                                <div class="container-fluid">
                                    <!-- Page Heading -->
                                    <h1 class="h1 mb-2 text-gray-800">Usuarios <i class="fa fa-users"></i></h1>

                                    @if($errors->any())
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        @foreach ($errors->all() as $error)
                                            <li>{{$error}}</li>
                                            @endforeach
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                    <!-- DataTales Example -->
                                    <div class="card shadow mb-4 ">
                                        <div>
                                            <div class="card-header d-sm-flex py-3 justify-content-between bg-primary">
                                                <h4 class="m-0 font-weight-bold text-white">Detalle de usuario: {{$user->name}}</h4>
                                            </div>
                                                <div class="card-body">
                                                        <form action="{{route('admin.business.update', $user->id)}}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="row">
                                                                <div class="col-md-4 text-center ">
                                                                    <img src="{{asset('img/AcaOnline.png')}}" class="shadow-sm rounded-circle" width="250" height="250"alt="">
                                                                    <br>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <div class="form-row">
                                                                        <div class="form-group col">
                                                                            <div class=" text-center text-primary bg-white"><h6><strong> <i class="fa fa-user-circle"></i>  Datos del perfil y contacto de la empresa</strong></h6></div>
                                                                            <hr class="shadow-sm rounded-pill">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-6">
                                                                            <label for=""><strong>Nombre de perfil</strong></label>
                                                                            <input type="text" disabled class="form-control rounded-pill" name="name_profile" value="{{$user->profile->name_profile}}">
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label for="exampleFormControlInput1"><strong>Dirección de correo electrónico</strong></label>
                                                                            <input type="email" disabled class="form-control @error('email') is-invalid @enderror rounded-pill" name="email" value="{{$user->email}}">
                                                                            @error('email')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-4">
                                                                            <label for="exampleFormControlSelect2"><strong>Rol</strong></label>
                                                                            @foreach($user->roles as $item)
                                                                            <input type="text" disabled class="form-control rounded-pill" name="" value="{{$item->name}}">
                                                                            @endforeach
                                                                        </div>
                                                                        <div class="form-group col-md-4">
                                                                            <label for="formGroupExampleInput"><strong>Teléfono </strong></label>
                                                                            <input class="form-control rounded-pill" disabled step="any" id="num" data-inputmask="'mask': '(999) 999-9999'" data-mask type="text" name="primary_phone" value="{{$user->profile->primary_phone}}">
                                                                        </div>
                                                                        <div class="form-group col-md-4">
                                                                            <label for="formGroupExampleInput"><strong>Teléfono secundario</strong></label>
                                                                            <input class="form-control rounded-pill" disabled step="any" id="num2" data-inputmask="'mask': '(999) 999-9999'" data-mask type="text" name="secondary_phone" value="{{$user->profile->secondary_phone}}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class=" text-center text-primary bg-white"><h6><strong> <i class="fa fa-map-marker bg-white"></i>  Datos de la dirección de empresa</strong></h6></div>
                                                            <hr class="shadow-sm rounded-pill">
                                                            <div class="form-row">
                                                                <div class="form-group col-md-4">
                                                                    <label for="formGroupExampleInput"><strong>Estado</strong></label>
                                                                    @foreach ($user->profile->addresses as $item)
                                                                        <input type="text"disabled class="form-control rounded-pill" name="state" value="{{$item->state}}">
                                                                    @endforeach
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="formGroupExampleInput"><strong>Ciudad</strong></label>
                                                                    @foreach ($user->profile->addresses as $item)
                                                                        <input type="text" disabled class="form-control rounded-pill" id="formGroupExampleInput" name="city" value="{{$item->city}}">
                                                                    @endforeach
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="formGroupExampleInput"><strong>Colonia</strong></label>
                                                                    @foreach ($user->profile->addresses as $item)
                                                                    <input type="text" disabled class="form-control rounded-pill" id="formGroupExampleInput" name="suburb" value="{{$item->suburb}}">
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group col-md-3">
                                                                    <label for="formGroupExampleInput"><strong>Calle</strong></label>
                                                                    @foreach ($user->profile->addresses as $item)
                                                                        <input type="text" disabled class="form-control rounded-pill" id="formGroupExampleInput" name="street_name" value="{{$item->street_name}}">
                                                                    @endforeach
                                                                </div>
                                                                <div class="form-group col-md-3">
                                                                    <label for="formGroupExampleInput"><strong>Referencias</strong></label>
                                                                    @foreach ($user->profile->addresses as $item)
                                                                        <input type="text" disabled class="form-control rounded-pill" id="formGroupExampleInput" name="references" value="{{$item->references}}">
                                                                    @endforeach
                                                                </div>
                                                                <div class="form-group col-md-3">
                                                                    <label for="formGroupExampleInput"><strong>Número de casa</strong></label>
                                                                    @foreach ($user->profile->addresses as $item)
                                                                        <input type="text" disabled class="form-control rounded-pill" pattern="^[0-9]+" step="any" id="formGroupExampleInput" name="number_home" value="{{$item->number_home}}">
                                                                    @endforeach
                                                                </div>
                                                                <div class="form-group col-md-3">
                                                                    <label for="formGroupExampleInput"><strong>Código postal</strong></label>
                                                                    @foreach ($user->profile->addresses as $item)
                                                                        <input type="text" disabled class="form-control rounded-pill" pattern="^[0-9]+" step="any" id="formGroupExampleInput" name="postal_code" value="{{$item->postal_code}}">
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            <label for="formGroupExampleInput"><strong>Género</strong></label>
                                                            <div class="form-group">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" disabled type="radio"  id="inlineRadio1" name="gender" value="F"
                                                                    @if($user->profile->gender=='F')        
                                                                        checked
                                                                    @endif
                                                                    >
                                                                    <label class="form-check-label" for="inlineRadio1"><strong>Femenino</strong></label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" disabled type="radio"  id="inlineRadio2" name="gender" value="M"
                                                                    @if($user->profile->gender=='M')        
                                                                        checked
                                                                    @endif
                                                                    >
                                                                    <label class="form-check-label" for="inlineRadio2"><strong>Masculino</strong></label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col">
                                                                <label for="formGroupExampleInput"><strong>Activo</strong></label>
                                                                @if($user->active==1) 
                                                                    <div class="d-inline p-2 bg-success text-white shadow-sm rounded-pill justify-content-center">
                                                                        <i class="fa fa-check-circle"></i>  <strong>Si</strong>
                                                                    </div>
                                                                @else
                                                                    <div class="d-inline p-2 bg-danger text-white shadow-sm rounded-pill align-middle">
                                                                        <i class="fa fa-times-circle""></i>  <strong>No</strong>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="modal-footer">
                                                                <a href="{{route('admin.users.index')}}" class="btn btn-danger rounded-pill shadow-sm" data-dismiss="modal">Cerrar</a>
                                                            </div>
                                                        </form>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Input Mask -->
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/4.0.9/jquery.inputmask.bundle.min.js" integrity="sha512-VpQwrlvKqJHKtIvpL8Zv6819FkTJyE1DoVNH0L2RLn8hUPjRjkS/bCYurZs0DX9Ybwu9oHRHdBZR9fESaq8Z8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
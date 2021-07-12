@extends('mainindex.maintemplate')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
@endsection

@section('seccion')
                                <div class="container-fluid">
                                    <!-- Page Heading -->
                                    @if(auth()->user()->hasRole('seller'))
                                    @else
                                    <h1 class="h1 mb-2 text-gray-800">Empresas <i class="fa fa-building"></i></h1>
                                    @endif
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
                                            @if(auth()->user()->hasRole('seller'))
                                                <h4 class="m-0 font-weight-bold text-white">Editar datos del perfil</h4>
                                            @else
                                                <h4 class="m-0 font-weight-bold text-white">Editar datos de empresa</h4>
                                            @endif
                                            </div>
                                                <div class="card-body">
                                                        <form action="{{route('admin.business.update', $business->id)}}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class=" text-center text-primary bg-white"><h6><strong> <i class="fa fa-building"></i>  Datos de la empresa</strong></h6></div>
                                                            <hr class="shadow-sm rounded-pill">
                                                            <div class="form-row">
                                                                <div class="form-group col-md-4">
                                                                    <label for="">Nombre de empresa</label>
                                                                    <input type="text" minlength="4" maxlength="80" class="@error('name') is-invalid @enderror form-control rounded-pill" name="name" placeholder="Empresa" value="{{$business->name}}">
                                                                    @error('name')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="">Razón social</label>
                                                                    <input type="text" minlength="4" maxlength="80" class="@error('name_business') is-invalid @enderror form-control rounded-pill" name="name_business" placeholder="Razón social" value="{{$business->name_business}}">
                                                                    @error('name_business')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="exampleFormControlInput1">Dirección de correo electrónico</label>
                                                                    <input type="email" maxlength="200" class="form-control @error('email') is-invalid @enderror rounded-pill" name="email" placeholder="name@example.com" value="{{$business->email}}">
                                                                    @error('email')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group col-md-3">
                                                                    <label for="">Teléfono</label>
                                                                    <input type="text" class="@error('phone') is-invalid @enderror form-control rounded-pill" name="phone" id="num" placeholder="Teléfono" value="{{$business->phone}}">
                                                                    @error('phone')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group col-md-3">
                                                                    <label for="">RFC</label>
                                                                    <input type="text" minlength="12" maxlength="13" class="@error('rfc') is-invalid @enderror form-control rounded-pill" name="rfc" placeholder="RFC" value="{{$business->rfc}}">
                                                                    @error('rfc')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="">Descripción</label>
                                                                    <input type="text" minlength="15" maxlength="100" class="@error('description') is-invalid @enderror form-control rounded-pill" name="description" placeholder="Descripción" value="{{$business->description}}">
                                                                    @error('description')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class=" text-center text-primary bg-white"><h6><strong> <i class="fa fa-map-marker bg-white"></i>  Datos de la dirección de la empresa</strong></h6></div>
                                                            <hr class="shadow-sm rounded-pill">
                                                            <div class="form-row">
                                                                <div class="form-group col-md-4">
                                                                    <label for="formGroupExampleInput">Estado</label>
                                                                    <input type="text" minlength="5" maxlength="80" class="@error('state') is-invalid @enderror form-control rounded-pill" id="formGroupExampleInput" name="state" placeholder="Estado" value="{{$business->address->state}}">
                                                                    @error('state')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="formGroupExampleInput">Ciudad</label>
                                                                    <input type="text" minlength="5" maxlength="80" class="@error('city') is-invalid @enderror form-control rounded-pill" id="formGroupExampleInput" name="city" placeholder="Ciudad" value="{{$business->address->city}}">
                                                                    @error('city')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="formGroupExampleInput">Colonia</label>
                                                                    <input type="text" minlength="8" maxlength="100" class="@error('suburb') is-invalid @enderror form-control rounded-pill" id="formGroupExampleInput" name="suburb" placeholder="Colonia" value="{{$business->address->suburb}}">
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
                                                                    <input type="text" minlength="5" maxlength="100" class="@error('street_name') is-invalid @enderror form-control rounded-pill" id="formGroupExampleInput" name="street_name" placeholder="Calle" value="{{$business->address->street_name}}">
                                                                    @error('street_name')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group col-md-3">
                                                                    <label for="formGroupExampleInput">Referencias</label>
                                                                    <input type="text" minlength="10" maxlength="100" class="@error('references') is-invalid @enderror form-control rounded-pill" id="formGroupExampleInput" name="references" placeholder="Referfencias" value="{{$business->address->references}}">
                                                                    @error('references')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group col-md-3">
                                                                    <label for="formGroupExampleInput">Número exterior</label>
                                                                    <input type="number" id="num2" class="@error('number_home') is-invalid @enderror form-control rounded-pill" pattern="^[0-9]+" step="any" id="formGroupExampleInput" name="number_home" placeholder="23..." value="{{$business->address->number_home}}">
                                                                    @error('number_home')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group col-md-3">
                                                                    <label for="formGroupExampleInput">Código postal</label>
                                                                    <input type="number" id="num3" class="@error('postal_code') is-invalid @enderror form-control rounded-pill" pattern="^[0-9]+" step="any" id="formGroupExampleInput" name="postal_code" placeholder="Código postal" value="{{$business->address->postal_code}}">
                                                                    @error('postal_code')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <a href="{{route('admin.business.index')}}" class="btn btn-danger rounded-pill shadow-sm" data-dismiss="modal">Cerrar</a>
                                                                <button type="submit" class="btn btn-primary rounded-pill shadow-sm">Guardar</button>
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
                                    var input=  document.getElementById('num3');
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
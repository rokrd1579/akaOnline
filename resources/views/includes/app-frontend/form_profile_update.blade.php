 <div class="container-md shadow  p-3 mb-5 bg-body rounded" style=" background-color:rgb(255, 255, 255);">
     <div class="filter_type version_2">
         <h4><a href="#filter_4" data-toggle="collapse" class="opened"><b>Modificar su información personal</b></a></h4>
         <div class="collapse show" id="filter_4">
             <div class="row">
                 <div class="col-md-12">
                     <p>Información de facturación</p><br>
                     <form action="{{route('profile_update')}}">
                         {{csrf_field()}}
                         <div class="row mt-3">
                             <div class="col-md-4">
                                 <label><b> Nombre completo: </b></label>
                                 <input class="form-control" id="nombre" type="text" name="name_profile" placeholder="Tu Nombre" minlength="4" maxlength="50" value="{{$profile->name_profile}}" onkeypress="return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32)" required>
                             </div>
                             <div class="col-md-4">
                                 <label><b> No. de celular 1: </b></label>
                                 <input class="form-control" type="tel" name="primary_phone" placeholder="Ejemplo: 744001100" minlength="10" maxlength="10" value="{{$profile->primary_phone}}" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" required>
                             </div>
                             <div class="col-md-4">
                                 <label><b> No. de celular 2: </b></label>
                                 <input class="form-control" type="tel" name="secondary_phone" placeholder="Ejemplo: 744001100" minlength="10" maxlength="10" value="{{$profile->secondary_phone}}" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)">
                             </div>
                         </div>
                         <div class="row mt-3">
                             <div class="col-md-4">
                                 <label><b> Género </b></label>
                                 <input class="form-control" name="gender" placeholder="Ejemplo: Hombre" value="{{$profile->gender}}" readonly required>
                             </div>
                         </div>
                         <div class="row mt-3">
                             <div class="col-md-4">
                             </div>
                             <div class="col-md-4">
                             </div>
                             <div class="col-md-4">
                                 <input type="submit" class="btn_1" value="Actualizar">
                             </div>
                         </div>
                     </form><br>
                 </div>
             </div>
         </div>
     </div>

     @php($control = 0)
     @foreach($addresses as $address)
     <div class="filter_type version_2 ">
         @if($control == 0)
         <h4><a href="#filter_5" data-toggle="collapse" class="opened"><b>Modificar mi dirección principal</b></a></h4>
         <div class="collapse show" id="filter_5">
             @endif
             @if($control == 1)
             <h4><a href="#filter_6" data-toggle="collapse" class="opened"><b>Modificar mi segunda dirección</b></a></h4>
             <div class="collapse show" id="filter_6">
                 @endif
                 @if($control == 2)
                 <h4><a href="#filter_7" data-toggle="collapse" class="opened"><b>Modificar mi tercera dirección</b></a></h4>
                 <div class="collapse show" id="filter_7">
                     @endif
                     <div class="row">
                         <div class="col-md-12 ">
                             <p>Dirección de entrega</p><br>
                             <form action="{{route('address_update')}}">
                                 <input type="hidden" name="id" value="{{$address->id}}">
                                 <div class="row mt-3">
                                     <div class="col-md-4">
                                         <label><b>Calle:</b></label>
                                         <input class="form-control" type="text" name="street_name" placeholder="Nombre de su calle" minlength="4" maxlength="100" value="{{$address->street_name}}" onkeypress="return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32) || (event.charCode >= 48 && event.charCode <= 57)" required>
                                     </div>
                                     <div class="col-md-4">
                                         <label><b> Número exterior: </b></label>
                                         <input class="form-control" type="text" name="number_home" placeholder="Número de casa" value="{{$address->number_home}}" onkeypress="return (event.charCode >= 49 && event.charCode <= 57)" minlength="1" maxlength="3" required>
                                     </div>
                                     <div class="col-md-4">
                                         <label><b> Código postal: </b></label>
                                         <input class="form-control" type="text" name="postal_code" placeholder="Código postal" value="{{$address->postal_code}}" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" pattern="[0-9]{5}" maxlength="5" required>
                                     </div>
                                 </div>
                                 <div class="row mt-3">
                                     <div class="col-md-4">
                                         <label><b> Colonia: </b></label>
                                         <input class="form-control" type="tex" name="suburb" placeholder="Colonia" minlength="4" maxlength="50" value="{{$address->suburb}}" onkeypress="return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32)" required>
                                     </div>
                                     <div class="col-md-4">
                                         <label><b> Referencias: </b></label>
                                         <input class="form-control" type="text" name="references" placeholder="Ejemplo: Entre la calle 1 y 2" minlength="8" maxlength="100" value="{{$address->references}}" onkeypress="return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32) || (event.charCode >= 48 && event.charCode <= 57)">
                                     </div>
                                     <div class="col-md-4">
                                         <label><b> Ciudad: </b></label>
                                         <input class="form-control" type="text" name="city" placeholder="Acapulco de Juarez" minlength="4" maxlength="40" value="{{$address->city}}" onkeypress="return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32)" required>
                                     </div>
                                 </div>
                                 <div class="row mt-3">
                                     <div class="col-md-4">
                                         <label><b>Estado:</b></label>
                                         <input class="form-control" type="text" name="state" placeholder="Guerrero" minlength="4" maxlength="30" value="{{$address->state}}" readonly onkeypress="return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32)" required>
                                     </div>
                                 </div>
                                 <div class="row mt-3">
                                     <div class="col-md-4">
                                     </div>
                                     <div class="col-md-4">
                                     </div>
                                     <div class="col-md-4">
                                         <input type="submit" class="btn_1" value="Actualizar">
                                     </div>
                                 </div>
                             </form><br>
                         </div>
                     </div>
                 </div>
             </div>
             @php($control = $control + 1)
             @endforeach

             @if($control <= 2) <a style="color: white;" id="btn_agregar" class="btn_1" value="Agregar" textcolor="white" onclick="add_address_2()">Agregar otra dirección</a>
                 @endif


                 <div id="address_2" style="display: none">
                     <div class="filter_type version_2">
                         @if($control == 1)
                         <h4><a href="#filter_8" data-toggle="collapse" class="opened"><b>Agregar dirección 2</b></a></h4>
                         @endif
                         @if($control == 2)
                         <h4><a href="#filter_8" data-toggle="collapse" class="opened"><b>Agregar dirección 3</b></a></h4>
                         @endif
                         <div class="collapse show" id="filter_8">
                             <div class="row">
                                 <div class="col-md-12 ">
                                     <p>Dirección principal de entrega</p><br>
                                     <form action="{{route('address_store')}}">
                                         <div class="row mt-3">
                                             <div class="col-md-4">
                                                 <label><b> Calle: </b></label>
                                                 <input class="form-control" type="text" name="street_name" placeholder="Nombre de su calle" minlength="4" maxlength="100" value="" onkeypress="return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32) || (event.charCode >= 48 && event.charCode <= 57)" required>
                                             </div>
                                             <div class="col-md-4">
                                                 <label><b> Número exterior: </b></label>
                                                 <input class="form-control" type="text" name="number_home" placeholder="Número de casa" value="" onkeypress="return (event.charCode >= 49 && event.charCode <= 57)" minlength="1" maxlength="3" required>
                                             </div>
                                             <div class="col-md-4">
                                                 <label><b> Código postal: </b></label>
                                                 <input class="form-control" type="text" name="postal_code" placeholder="Código postal" value="" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" pattern="[0-9]{5}" maxlength="5" required>
                                             </div>
                                         </div>
                                         <div class="row mt-3">
                                             <div class="col-md-4">
                                                 <label><b> Colonia: </b></label>
                                                 <input class="form-control" type="tex" name="suburb" placeholder="Colonia" minlength="4" maxlength="50" value="" onkeypress="return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32)" required>
                                             </div>
                                             <div class="col-md-4">
                                                 <label><b> Referencias: </b></label>
                                                 <input class="form-control" type="text" name="references" placeholder="Ejemplo: Entre la calle 1 y 2" minlength="5" maxlength="100" value="" onkeypress="return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32) || (event.charCode >= 48 && event.charCode <= 57)">
                                             </div>
                                             <div class="col-md-4">
                                                 <label><b> Ciudad: </b></label>
                                                 <input class="form-control" type="text" name="city" placeholder="Acapulco de Juarez" minlength="4" maxlength="40" value="" onkeypress="return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32)" required>
                                             </div>
                                         </div>
                                         <div class="row mt-3">
                                             <div class="col-md-4">
                                                 <label><b> Estado: </b></label>
                                                 <input class="form-control" type="text" name="state" placeholder="Guerrero" minlength="4" maxlength="30" value="Guerrero" readonly onkeypress="return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32)" required>
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
                                     </form><br>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
         </div>
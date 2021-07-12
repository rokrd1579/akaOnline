@extends('layouts.app_frontend')

@section('content')

@if(Session::has('msj'))
<input type="hidden" id="msjConfirmationReturns" value="{{Session::get('msj')}}">
@endif
<main>
    <div class="container margin_30 ">
        <div class="col-lg-9">
            <div class="breadcrumbs">
                <ul>
                    <li><a href="{{route('index.sitio.web')}}">Inicio</a></li>
                    <li>Historial</li>
                </ul>
            </div>
        </div>

        <div class="container">
            @if(count($orderHasProducts) > 0)
            
            <h4 style="text-align:center; margin-bottom: 15px"><b>Tu historial de compras</b></h4>
            <br>
            
                @foreach($orderHasProducts->unique('order_id') as $dato)
               
                    @php
                        $suma = $orderHasProducts->where('order_id',$dato->order_id)->unique('id')->count('quantity');
                        $sumasubtotal = $orderHasProducts->where('order_id',$dato->order_id)->unique('id')->sum('stotal');
                        $sumatotal = $orderHasProducts->where('order_id',$dato->order_id)->unique('id')->sum('total');
                    @endphp
                    
                    <div class="shadow filter_type version_2 pt-2">
                        <h4><a href="#filter_{{$dato->order_id}}" data-toggle="collapse" class="closed">No. de orden: {{$dato->order_id}}  - Productos: {{$suma}} - @if($dato->status == "approved") Compra realizada: {{date_format($dato->created_at,"d/m/Y")}} @elseif($dato->status == "pending") Compra pendiente: {{date_format($dato->created_at,"d/m/Y")}} @endif  @if($dato->status == "cancelled") {{ " - ".$dato->description}} el {{date_format($dato->updated_at,"d/m/Y")}} @endif </a></h4>
                        
                        <div class="collapse" id="filter_{{$dato->order_id}}">
                            
                            @foreach($orderHasProducts->where('order_id',$dato->order_id)->unique('oid') as $order)
                             
                                @foreach($productos->where('id',$order->product_id) as $producto)
                               
                                    <div class="row p-3 bg-white rounded">
                                        
                                        <div class="col-md-2" style="display: flex; align-items: center;">
                                            <figure>
                                                <img src="{{$producto->images->first()->url}}" width="70" height="60" >
                                            </figure>
                                            
                                        </div>
                                        <div class="col-md-10">
                                            <a href="{{route('show', ['slug' => $producto->pslug])}}">
                                                <h5><b> {{ $producto->pname}}</b></h5>
                                            </a> 
                                            <br>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <p> <b>Precio: </b> ${{number_format(($order->stotal / $order->quantity),2)}} MXN</p>
                                                    <p> <b>Cantidad:</b> {{$order->quantity}}</p> 
                                                </div>
                                                <div class="col-md-5">
                                                    <p><b>Fecha de entrega:</b>  </p> 
                                                    @foreach ($businesses as $item)
                                                    <p> <b>Empresa:</b> {{$item->name_business}}</p>
                                                    @endforeach 
                                                    @foreach ($selleraddress->where('user_id',$producto->user_id) as $item)
                                                        <p><b>Vendedor: </b>{{$item->name_profile}}</p>
                                                    @endforeach
                                                </div>
                                                @php   $amoun_review = 0;  @endphp                                          
                                                @foreach($review as $item)
                                                @if($order->product_id===$item->product_id &&  auth()->user()->id === $item->user_id)
                                               
                                                @php   $amoun_review = 1;  @endphp                                          
                                                @endif
                                                @endforeach



                                               
                                                <div class="col-md-2">
                                                    @if($dato->status != "cancelled")
                                                    @if($dato->status != "pending")
                                                        @if($amoun_review==0)
                                                            <form action="{{ route('review') }}" method="POST">                                                                
                                                                @csrf
                                                                <input type="hidden" value="{{ $order->product_id }}" name="product_id"> 
                                                                <input type="hidden" value="{{ $producto->pname }}"  name="product_name">                                  
                                                                <input class="btn_1" type="submit" value="Hacer reseña" style="margin:10px">
                                                            </form> 

                                                            @else 
                                                            <form action="{{ route('reviewdelete') }}" class="formdelete" method="POST" >                                                                
                                                                @csrf
                                                                <input type="hidden" value="{{ $order->product_id }}" name="product_id"> 
                                                                <input type="hidden" value="{{ $producto->pname }}"  name="product_name">                                  
                                                                <input class="btn_1" type="submit" value="Borrar reseña" style="margin:10px">
                                                            </form> 
                                                        @endif
                                                    @endif    
                                                           
                                                    
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
                            <div class="row p-3 bg-white rounded">
                                <div class="col-sm-3">
                                    @switch($dato->status)
                                    @case('approved')
                                    <form action="{{ route('receipts') }}" method="POST" target="_blank">
                                        {{ csrf_field() }}
                                        <input type="hidden" value="{{ $order->created_at }}" name="created_at">
                                        <input type="hidden" value="${{number_format($sumatotal,2)}}" name="total">
                                        <input type="hidden" name="subtotal" value="${{number_format($sumasubtotal,2)}}">
                                        <input type="hidden" value="{{ $dato->order_id}}" id="ordenid" name="ordenid">
                                        <input type="hidden" name="envio" value="${{number_format($sumatotal - $sumasubtotal,2)}}">
                                        <input type="hidden" name="fecha" value=" {{date_format($dato->created_at,"d/m/Y")}}">
                                        <input type="hidden" name="direccion" value="{{$dato->oadid}}">
                                        <input class="btn_1" type="submit" value="ver recibo" style="margin:10px">
                                    </form>
                                    @break
                                    @case('pending')
                                    @break
                                    @case('cancelled')
                                    @break
                                    @endswitch
                                </div>
                                
                                @php
                                    $diferencia = $dato->created_at->diff($date);
                                @endphp
                                    
                                @if($diferencia->days <= 30)
                                    <div class="col-sm-3">
                                        @if($dato->status == "approved")
                                            <form action="{{ route('returns') }}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="proc" value="refund">
                                                <input type="hidden" name="idOrden" value="{{$dato->order_id}}">
                                                <input type="hidden" name="idMP" value="{{encrypt($dato->payment_method_id)}}">
                                                <input type="hidden" value="${{number_format($sumatotal,2)}}" name="total">
                                                <input type="hidden" name="direccion" value="{{$dato->oadid}}">
                                                <input type="hidden" name="fecha" value=" {{date_format($dato->created_at,"d/m/Y")}}">
                                                <input class="btn_1" type="submit" value="Devolver" style="margin:10px;">
                                            </form>
                                        @elseif($dato->status == "pending")
                                            <form action="{{ route('returns') }}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="proc" value="cancel">
                                                <input type="hidden" name="idOrden" value="{{$dato->order_id}}">
                                                <input type="hidden" name="idMP" value="{{encrypt($dato->payment_method_id)}}">
                                                <input type="hidden" value="${{number_format($sumatotal,2)}}" name="total">
                                                <input type="hidden" name="direccion" value="{{$dato->oadid}}">
                                                <input type="hidden" name="fecha" value=" {{date_format($dato->created_at,"d/m/Y")}}">
                                                <input class="btn_1" type="submit" value="Cancelar orden" style="margin:10px">
                                            </form>
                                        
                                    
                                        @elseif($dato->status == "cancelled")
                                                    <form action="{{ route('returns') }}" method="post">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="proc" value="refund">
                                                        <input type="hidden" name="idOrden" value="{{$dato->order_id}}">
                                                        <input type="hidden" name="idMP" value="{{encrypt($dato->payment_method_id)}}">
                                                        <input type="hidden" value="${{number_format($sumatotal,2)}}" name="total">
                                                        <input type="hidden" name="direccion" value="{{$dato->oadid}}">
                                                        <input type="hidden" name="fecha" value=" {{date_format($dato->created_at,"d/m/Y")}}">
                                                        <input class="btn_1" type="submit" value="Ver estado de orden" style="margin:10px;">
                                                    </form>
                                        @endif
                                    </div>
                                @endif
                                @foreach ($address->where('id',$dato->oadid) as $item)
                                    <div class="col-sm-6">
                                        <p><b>Dirección de entrega: </b>{{$item->street_name}},{{$item->number_home}} <b>en </b>{{$item->city}},{{$item->state}}</p>
                                        <p><b>Código Postal: </b> {{$item->postal_code}} <b>Total: ${{number_format($sumatotal,2)}} MXN</b></p>
                                    </div>
                                @endforeach
                                
                                
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="container mt-5 mb-5">
                    <h4 style="text-align: center">No tienes compras hechas aún</h4>
                    <center>     <font color="gray">¿No sabes qu&eacute; comprar? ¡Miles de productos te esperan! </font> </center>
                </div>
            @endif
        </div>
    </div>

</main>
@endsection
@push('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('eliminar')=='ok')
<script>
Swal.fire(
      'Reseña eliminada correctamente',
      'El proceso ha sido exitoso!!',
      'success'
    )
</script>
@endif
<script>

$('.formdelete').submit(function(e)
{
e.preventDefault();
Swal.fire({
  title: '¿Estas seguro?',
  text: "Estas a punto de eliminar la reseña",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, eliminar',
  cancelButtonText:   'Cancelar'
}).then((result) => {
  if (result.isConfirmed) {
   /* Swal.fire(
      'Reseña eliminada correctamente',
      'El proceso ha sido exitoso!!',
      'success'
    )*/
    this.submit();
  }
})
});
</script>
@if (session('review')=='ok')
<script>
Swal.fire(
    'Reseña creada correctamente',
    'El proceso ha sido exitoso!!',
    'success'
    )
</script>    
@endif
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11">
</script>
<script>    
    try {
        var infoReturns = document.getElementById('msjConfirmationReturns').value;
        if(infoReturns != null){
            Swal.fire(
                'Información',
                infoReturns,
                'success'
            )
        }
    } catch (error) {}
</script>

@endpush
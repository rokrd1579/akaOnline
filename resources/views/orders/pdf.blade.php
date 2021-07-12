<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Recibo</title>
        <style>
        h2{
        text-align: center;
        color: rgba(0, 47, 255, 0.842);
        
        }
        img{
        width: 180px;
        height: 90px;
        }
        .contenido{
        font-size: 20px;
        }
        #primero{
        background-color: rgb(255, 255, 255);
        font-size: 15px;
        font-family: "sans-serif";
        line-height: 0.5;
        
        }
        #segundo{
            font-size: 15px;
            line-height: 1;
        }
        #tercero{
        text-decoration:line-through;
        }
        table, th, td {
        
        font-size: 15px;
        font-family: "sans-serif";
        font-weight: bold;
        width:200px
        }
        th, td {
            padding: 10px;
            text-align: center
        }
    </style>
    </head>
    <body>
        <img src="../public/img/logo_pdf.jpg">
                
            
            <h2>Detalles finales de la compra: {{$ordenId}}</h2>
            <hr>
            <div class="contenido">
                <p id="primero"><b>Pedido realizado:</b>  {{$fecha}} </p>
                <p id="primero"><b>Número de pedido de AcaOnline.mx:</b> {{$ordenId}}</p>
                <p id="primero"><b>Total del pedido:</b> {{$total}}</p>
            </div>
            <br>
            <br>
            <div class="contenido">
                <h5>Productos comprados</h5>
                <table style="margin-left: auto; margin-right: auto;">
                    <tr>
                        <th >Producto</th>
                        <th >Cantidad:</th>
                        <th >Precio:</th>
                    </tr>
                    @foreach ($orderProducts->unique('id') as $item)
                    <tr>
                        <td>{{$item->product}}</td>
                        <td>{{$item->quantity}}</td>
                        <td>${{number_format(($item->sub_total),2)}} MXN</td>
                    </tr>    
                    @endforeach
                </table>
                    
            </div>
            <br>
            <br>
            <div class="contenido">
                @foreach ($address as $item)
                    <p id="primero"><b>Dirección de envío:</b></p>
                    <p id="primero"><b>Calle y número:</b> {{$item->street_name}}, {{$item->number_home}} </p>
                    <p id="primero"><b>Colonia:</b> {{$item->suburb}}</p>
                    <p id="primero"><b>Ciudad:</b> {{$item->city}},{{$item->state}}</p>
                    <p id="primero"><b>Código Postal:</b> {{$item->postal_code}}</p>
                    <p id="primero"><b>Referencias:</b> {{$item->references}}</p>
                @endforeach
                
            <hr>
                <h2>Información de pago</h2>
                <br>
                <p id="primero" style="text-align: right;"><b>Sub total:</b>{{$subtotal}}</p>
                <p id="primero" style="text-align: right;"><b>Envío:</b> {{$envio}}</p>
                <p id="primero" style="text-align: right;"><b>Total (IVA incluido):</b> {{$total}}</p>
            </div>

    </body>
</html>
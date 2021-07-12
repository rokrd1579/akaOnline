
<br>
<head>
    <style>
        h2{
        text-align: center;
        color: rgba(0, 47, 255, 0.842);
        
        }
        img{
        width: 180px;
        height: 100px;
        }
        table{
        font-size: 15px;
        font-family: "sans-serif";
        font-weight: bold;
        }
        th, td {
            padding: 10px;
            text-align: center
        }
    </style>
</head>
<body style="text-align: center">
    <p style="font-family: Arial, Helvetica, sans-serif">Gracias por tu compra en AcaOnline.</p>
    <img src="{{asset("/img/Logo_email.jpg")}}">
    <div class="col-md-5 m-0 vh-50 row justify-content-center align-items-center border border-1">
        <div class="shadow p-3 mb-5 bg-white rounded">
            <h3 style="font-family: Arial, Helvetica, sans-serif">Resumen de la compra</h3>
            @if(isset($title))
                <table style="margin: auto">
                    <thead>
                        <tr>
                            <th width="auto" style="font-family: Arial, Helvetica, sans-serif">Producto</td>
                            <th style="font-family: Arial, Helvetica, sans-serif">Cantidad</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td width="auto" style="font-family: Arial, Helvetica, sans-serif">{{$title}}</td>
                            <td style="font-family: Arial, Helvetica, sans-serif">{{$quantity}}</td>
                        </tr>
                    </tbody>
                </table>
                <h3 style="font-family: Arial, Helvetica, sans-serif">Total:$ {{number_format($price,2)}}</h3>
                <p style="font-family: Arial, Helvetica, sans-serif">Pagado con {{$payment_type}}</p>
            @else
                <table style="margin: auto">
                    <thead>
                        <tr>
                            <th width="auto" style="font-family: Arial, Helvetica, sans-serif">Producto</td>
                            <th style="font-family: Arial, Helvetica, sans-serif">Cantidad</td>
                        </tr>
                    </thead>
                    @foreach ($cart as $item)
                    <tbody>
                        <tr>
                            <td width="auto" style="font-family: Arial, Helvetica, sans-serif">{{$item->name}}</td>
                            <td style="font-family: Arial, Helvetica, sans-serif">{{$item->quantity}}</td>
                        </tr>   
                    </tbody>
                    @endforeach
                </table>
                <h3 style="font-family: Arial, Helvetica, sans-serif;">Total:$ {{number_format($cartTotal,2)}}</h3>
                <p name="primero" style="font-family: Arial, Helvetica, sans-serif">Pagado con {{$payment_type}}</p>
            @endif
            <div>
                <p name="primero" style="font-family: Arial, Helvetica, sans-serif">Entrega en: {{$k}}</p>
                <p style="font-family: Arial, Helvetica, sans-serif"><i>Esta orden está pendiente de pago, se acreditará una vez el status sea aprobado por MercadoPago.</i></p>
            </div>
        </div>
    </div>
    <br>
    <p style="font-family: Arial, Helvetica, sans-serif">¡Disfruta tu compra!</p>
    <p style="font-family: Arial, Helvetica, sans-serif">Consigue más productos en <a href="{{$link}}">{{$link}}</a></p>
</body>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="Ansonika">
<title>@yield('title')</title>

<!-- Favicons-->
<link rel="shortcut icon" href="{{ asset('img/Logo_carrito.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="{{ asset('img/Logo_carrito.ico') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="{{ asset('img/Logo_carrito.ico') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="{{ asset('img/Logo_carrito.ico') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="{{ asset('img/Logo_carrito.ico') }}">

<!-- GOOGLE WEB FONT -->
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet">

<!-- estilos para el boton de actualizar y borrar-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- BASE CSS -->
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/bootstrap.custom.min.css') }}">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- SPECIFIC CSS -->
<link rel="stylesheet" href="{{ asset('css/about.css') }}">
<link rel="stylesheet" href="{{ asset('css/account.css') }}">
<link rel="stylesheet" href="{{ asset('css/bootstrap.custom.css') }}">
<link rel="stylesheet" href="{{ asset('css/cart.css') }}">
<link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
<link rel="stylesheet" href="{{ asset('css/error_track.css') }}">
<link rel="stylesheet" href="{{ asset('css/faq.css') }}">
<link rel="stylesheet" href="{{ asset('css/home_1.css') }}">
<link rel="stylesheet" href="{{ asset('css/jquery.mmenu.all.css') }}">
<link rel="stylesheet" href="{{ asset('css/leave_review.css') }}">
<link rel="stylesheet" href="{{ asset('css/listing.css') }}">
<link rel="stylesheet" href="{{ asset('css/product_page.css') }}">
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
<link rel="stylesheet" href="{{ asset('css/manual/sliderNotific.css') }}">

@stack('css')

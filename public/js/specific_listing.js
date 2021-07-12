// Prevent close dropdown filters
$('.filters_listing_1 .dropdown-menu .filter_type ul').on('click',function(e) {
	e.stopPropagation();
});

//Filters version 2 mobile
$('a.open_filters').on("click", function () {
	$('.filter_col').toggleClass('show');
	$('main').toggleClass('freeze');
	$('.layer').toggleClass('layer-is-visible');
});

//Filters collapse
var $headingFilters = $('.filter_type h4 a');
$headingFilters.on('click', function () {
	$(this).toggleClass('opened');
})
$headingFilters.on('click', function () {
	$(this).toggleClass('closed');
});

function validar() {
    //obteniendo el valor que se puso en el campo text del formulario
    miCampoTexto = document.getElementById("search").value;
    //la condición
    if (miCampoTexto.length == 0 || /^\s+$/.test(miCampoTexto)) {
        return false;
    }
    return true;
}

function carrito(){
	var idCarrito = new Array();
    var quantityCarrito = new Array();

	var idCart = document.getElementsByClassName('collection'),
	idItems = [].map.call(idCart, function(dataCart){
		idCarrito.push(dataCart.value);
	});
    var itemsCart = document.getElementsByClassName('qty2'),
	quantityItems = [].map.call(itemsCart, function(dataCart){
		quantityCarrito.push(dataCart.value);
	});

    window.location.href = "/cart/update" + "?v1=" + idCarrito + "&v2=" + quantityCarrito;
}
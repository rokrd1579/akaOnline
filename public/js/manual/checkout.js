function validarEnvios(){
    if($('input:radio[name=entrega]:checked').val() !== undefined){
        return true;
      }else{
        Swal.fire(
          '¡No has seleccionado una dirección de entrega!',
          'Selecciona una opción.',
          'warning'
          )
         
          return false;
      }
}

$(document).ready(function(){
    var countAddress = document.getElementById('countAddress').value;
    if(countAddress == 0){
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: 'btn btn-success',
              cancelButton: 'btn btn-danger'
            },
            buttonsStyling: true
          })
          
          swalWithBootstrapButtons.fire({
            title: '¡No existe una dirección de entrega en perfil!',
            text: "Da clic en el siguiente botón para agregar una dirección",
            icon: 'warning',
            showCancelButton: false,
            allowOutsideClick: false,
            confirmButtonText: 'Ir a mi perfil',
            reverseButtons: false
          }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "/profile"; 
                document.querySelector('#entrega').setAttribute('disabled','');
            } 
          })
    }

    
    
});

try {
  var verif = document.getElementById('msgVerificador').value;
		
		if(verif != null){
			Swal.fire(
			'¡Stock máximo disponible alcanzado!',
			verif+', se colocará el stock máximo a pagar.',
			'warning'
			)
      location.reload();
		}
} catch (error) {
  
}

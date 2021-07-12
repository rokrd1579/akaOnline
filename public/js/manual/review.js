
function datos(){
    if($('input:radio[name=rating]:checked').val() !== undefined){
      document.querySelector('#btn').setAttribute('disabled','');
        return true;
      }else{
      
Swal.fire({
          icon: 'error',
          title: 'Campo incompleto',
          text: 'No haz definido la calificacion del producto',
        
        })
		
          return false;
      }



      


      
}



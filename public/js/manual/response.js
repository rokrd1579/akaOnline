$(document).ready(function(){
   
    var click=0;
    var actualcid=0;
        $(".comment-container").delegate(".reply","click",function(){
      if ($(this).attr("cid")!=actualcid){click=0;}
        if (click==0){click++;
              var well = $(this).parent().parent();
              var cid = $(this).attr("cid");
              actualcid=cid;
              var name = $(this).attr('name_a');
              var token = $(this).attr('token');
              var form = '<form method="post" action="/response"><input type="hidden" name="_token" value="'+token+'"><input  type="hidden" name="question_id" value="'+ cid +'"><input type="hidden" name="name" value="'+name+'"><div class="form-group"><input type="text" class="form-control" name="reply" placeholder="Introduce tu respuesta" maxlength="190" required>  </div> <div id="container"><button id="btn" href="" class="btn_1"  >respuesta</button> </div></form>';
            
              let counter = 0;

function countingClicks() {
  counter++;
  if(counter > 1){
    document.getElementById('btn').disabled=true;
  }
  
}
              well.find(".reply-form").append(form);
        }
      });
}); 
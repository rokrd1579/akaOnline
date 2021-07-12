var i=0;
function read(){
    if(!i){
        document.getElementById("more").style.display = "inline";
        document.getElementById("read").innerHTML = "Ver menos categorías";
        i = 1;
    }else{
        document.getElementById("more").style.display = "none";
        document.getElementById("read").innerHTML = "Ver más categorías";
        i = 0;
    }
}
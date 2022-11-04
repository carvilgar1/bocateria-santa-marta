var imagen = document.getElementById("gallery2");
var i = 0;
        
function next(){
    i++;
    if(i>2){
        i=0;
    }
    imagen.setAttribute("src", "images/galeria/imagen"+i+".png");
}

function preview(){
    i--;
    if(i<0){
        i=2;
    }
    imagen.setAttribute("src", "images/galeria/imagen"+i+".png");
}
/**
 * Funciones auxiliares de javascripts 
 */

var x;
x=$(document);
x.ready(inicializarEventos);

function inicializarEventos(){
	var x;
	x=$("td");
	x.hover(entramouse,outmouse);
}
function entramouse(){
	$(this).css("background-color","#ff0");
}

function outmouse(){
	$(this).css("background-color","#e8edff");
}



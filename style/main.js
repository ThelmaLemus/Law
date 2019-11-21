$(document).ready(main);

var contador = 1;
var x = screen.height;

function main () {
	$('.menu_bar').click(function(){
		if (contador == 1){
			$('nav').animate({
				left: '0'
			});
			contador = 0;
		} else {
			contador = 1;
			$('nav').animate({
				left: '-100%'
			});
		}
	});

	//Mostramos y ocultamos submenus
	if(x < 800){
		$('.submenu').click(function(){
			$(this).children('.children').slideToggle();
		});
	}
}
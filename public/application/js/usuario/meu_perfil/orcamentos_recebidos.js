$('.ui.accordion').accordion();
$('.ui.dropdown').dropdown();
var $indice = 2;
$(document).ready(function() {
	EventoScrollCaixaDeEntrada();
	//AjaxCaixaDeEntrada();
});
function AjaxCaixaDeEntrada() {
	$.ajax({
		method: "GET",
		url: "/usuario/meu-perfil/orcamentos-recebidos/caixa-de-entrada/",
		async: false,
		data: { 
			indice : $indice
		}
	}).done(function(data) {
		$('#div_orcamentos').append(data);
		$('.ui.accordion').accordion();
		$indice += 1;
		EventoScrollCaixaDeEntrada();
	});
}
function EventoScrollCaixaDeEntrada() {
	$(window).scroll(function() {
	    if(($(window).scrollTop() + $(window).height() + 20) >= $(document).height() - (($(document).height() / 100) * 25)) {
	    	$(window).unbind('scroll');
	    	AjaxCaixaDeEntrada();
	    }
	});
}
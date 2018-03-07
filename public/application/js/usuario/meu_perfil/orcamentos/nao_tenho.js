var $indice = 2;
$(document).ready(function() {
	EventoScrollNaoTenho();
});
function AjaxNaoTenho() {
	$.ajax({
		method: "GET",
		url: "/usuario/meu-perfil/orcamentos/nao-tenho/ajax/",
		async: false,
		data: { 
			indice : $indice
		}
	}).done(function(data) {
		if (data != '' && data != null) {
			$('#div_orcamentos').append(data);
			$('#div_orcamentos .ui.accordion').accordion();
			$indice += 1;
			EventoScrollNaoTenho();
		}
	});
}
function EventoScrollNaoTenho() {
	$(window).scroll(function() {
	    if(($(window).scrollTop() + $(window).height() + 20) >= $(document).height() - (($(document).height() / 100) * 25)) {
	    	$(window).unbind('scroll');
	    	AjaxNaoTenho();
	    }
	});
}
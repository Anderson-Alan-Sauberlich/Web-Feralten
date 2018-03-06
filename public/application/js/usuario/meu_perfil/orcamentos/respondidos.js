var $indice = 2;
$(document).ready(function() {
	EventoScrollRespondidos();
});
function AjaxRespondidos() {
	$.ajax({
		method: "GET",
		url: "/usuario/meu-perfil/orcamentos/respondidos/ajax/",
		async: false,
		data: { 
			indice : $indice
		}
	}).done(function(data) {
		if (data != '' && data != null) {
			$('#div_orcamentos').append(data);
			$('.ui.accordion').accordion();
			$indice += 1;
			EventoScrollRespondidos();
		}
	});
}
function EventoScrollRespondidos() {
	$(window).scroll(function() {
	    if(($(window).scrollTop() + $(window).height() + 20) >= $(document).height() - (($(document).height() / 100) * 25)) {
	    	$(window).unbind('scroll');
	    	AjaxRespondidos();
	    }
	});
}
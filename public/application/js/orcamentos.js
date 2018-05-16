var $indice = 2;
$(document).ready(function() {
	EventoScrollOrcamentos();
});
function AjaxOrcamentos() {
	$.ajax({
		method: "GET",
		url: "/orcamentos/ajax/",
		async: false,
		data: { 
			indice : $indice
		}
	}).done(function(data) {
		if (data != '' && data != null) {
			$('#div_orcamentos').append(data);
			$('#div_orcamentos .ui.accordion').accordion();
			$indice += 1;
			EventoScrollOrcamentos();
		}
	});
}
function EventoScrollOrcamentos() {
	$(window).scroll(function() {
	    if(($(window).scrollTop() + $(window).height() + 20) >= $(document).height() - (($(document).height() / 100) * 25)) {
	    	$(window).unbind('scroll');
	    	AjaxOrcamentos();
	    }
	});
}
$(window).on('load', function(e) {
	$('#header_logo_fundo').transition('pulse');
});
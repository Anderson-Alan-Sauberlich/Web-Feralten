function abrir_menu() {
	$('.ui.sidebar').sidebar('toggle');
}
$(document).ready(function() {
	var url = window.location.pathname;
	if (url.indexOf('/cmmv/') !== -1) {
		$('#nome_pagina').html('GERENCIAR - CMMV');
	} else if (url.indexOf('/compatibilidade/') !== -1) {
		$('#nome_pagina').html('GERENCIAR - COMPATIBILIDADES');
	} else if (url.indexOf('/anos/') !== -1) {
		$('#nome_pagina').html('GERENCIAR - ANOS DE FABRICAÇÃO');
	}
});
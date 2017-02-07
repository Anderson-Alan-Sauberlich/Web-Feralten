function abrir_menu() {
	$('.ui.sidebar').sidebar('toggle');
}
$(document).ready(function() {
	var url = window.location.pathname;
	if (url.indexOf('/cmmv/cadastrar/') !== -1) {
		$('#nome_pagina').html('CADASTRAR - CMMV');
	} else if (url.indexOf('/cmmv/alterar/') !== -1) {
		$('#nome_pagina').html('ALTERAR - CMMV');
	} else if (url.indexOf('/cmmv/deletar/') !== -1) {
		$('#nome_pagina').html('DELETAR - CMMV');
	}
});
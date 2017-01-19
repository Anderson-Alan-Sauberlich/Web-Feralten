function Controlar_Classes() {
	var scre = $("body").width();
	
	if (scre <= 767) {
		$("#menu_filtro").addClass("sidebar");
		$("#menu_filtro").removeClass("fluid sombra_painel");
	}
	if (scre >= 768 && scre <= 991) {
		$("#menu_filtro").removeClass("sidebar");
		$("#menu_filtro").addClass("fluid sombra_painel");
	}
	if (scre >= 992 && scre <= 1199) {
		$("#menu_filtro").removeClass("sidebar");
		$("#menu_filtro").addClass("fluid sombra_painel");
	}
	if (scre >= 1200) {
		$("#menu_filtro").removeClass("sidebar");
		$("#menu_filtro").addClass("fluid sombra_painel");
	}
}
$(document).ready(function () {
	Controlar_Classes();
});
$(window).resize(function() {
	Controlar_Classes();
});
$(document).ready(function() {
	$('.ui.dropdown').dropdown();
});
$(document).ready(function() {
	$('.ui.checkbox').checkbox();
});
$(document).ready(function() {
	$('.ui.radio.checkbox').checkbox();
});
function abrirFiltro() {
	$('#menu_filtro').sidebar('toggle');
}
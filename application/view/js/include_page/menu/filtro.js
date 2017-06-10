$('.ui.dropdown').dropdown();
$('.ui.checkbox').checkbox();
$('.ui.radio.checkbox').checkbox({uncheckable: true});
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
	$('select[name=estado]').change(function(){
    	$('select[name=cidade]').html('<option value="0">Carregando...</option>');
        $.get('/menu-filtro/cidades/', 
        {estado:$(this).val()},
        function(valor){
        	$('select[name=cidade]').html(valor);
        });
   });
});
function abrirFiltro() {
	$('#menu_filtro').sidebar('toggle');
}
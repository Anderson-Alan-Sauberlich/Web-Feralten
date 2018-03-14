$('#menu_filtro .ui.dropdown').dropdown();
$('#menu_filtro .ui.checkbox').checkbox();
$('#menu_filtro .ui.radio.checkbox').checkbox({uncheckable: true});
function ControlarClassesFiltro() {
	var scren = $("body").width();
	
	if (scren <= 767) {
		$("#menu_filtro").addClass("sidebar");
		$("#menu_filtro").removeClass("fluid sombra_painel");
		$('#menu_filtro').sidebar('attach events', '.toggle.button');
	}
	if (scren >= 768 && scren <= 991) {
		$("#menu_filtro").removeClass("sidebar");
		$("#menu_filtro").addClass("fluid sombra_painel");
	}
	if (scren >= 992 && scren <= 1199) {
		$("#menu_filtro").removeClass("sidebar");
		$("#menu_filtro").addClass("fluid sombra_painel");
	}
	if (scren >= 1200) {
		$("#menu_filtro").removeClass("sidebar");
		$("#menu_filtro").addClass("fluid sombra_painel");
	}
}
$(document).ready(function () {
	ControlarClassesFiltro();
});
$(window).resize(function() {
	ControlarClassesFiltro();
});
$(document).ready(function() {
	$('#menu_filtro #estado').change(function(){
    	$('#menu_filtro #cidade').html('<option value="0">Carregando...</option>');
        $.get('/layout/menu/filtro/cidades/', 
        {estado:$(this).val()},
        function(valor){
        	$('#menu_filtro #cidade').html(valor);
        });
   });
});
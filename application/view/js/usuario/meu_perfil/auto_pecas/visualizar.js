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
	$('.ui.sidebar').sidebar('toggle');
}
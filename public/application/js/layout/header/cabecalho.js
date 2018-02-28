$('.ui.accordion').accordion();
$('#drop_meu_feralten').dropdown();
Controlar_Classes();
$(document).ready(function () {
	Controlar_Classes();
	$('#m_header_menu').sidebar();
});
$('#comprar_item').click(function() {
	$('#comprar_item').popup({
		popup : '#popup_comprar',
		hoverable : true
	}).popup('toggle');
});
$('#vender_item').click(function() {
	$('#vender_item').popup({
		popup : '#popup_vender',
		hoverable : true
	}).popup('toggle');
});
function Controlar_Classes() {
	var scren = $("body").width();
	if (scren <= 767) {
		$("#pc_header").addClass("hidden");
		$("#m_header").removeClass("hidden");
	} else {
		$("#pc_header").removeClass("hidden");
		$("#m_header").addClass("hidden");
	}
}
$(window).resize(function() {
	Controlar_Classes();
});
function AbrirMobileHeaderSidebar() {
	$('#m_header_menu').sidebar('toggle');
}
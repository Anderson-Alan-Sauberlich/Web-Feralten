$('#comprar_item').popup({
    hoverable: true,
    position : 'bottom left',
    popup: $('.comprar.popup')
});
$('#vender_item').popup({
    hoverable: true,
    position : 'bottom left',
    popup: $('.vender.popup')
});
$('#drop_meu_feralten').dropdown();
Controlar_Classes();
function Controlar_Classes() {
	var scren = $("body").width();
	if (scren <= 767) {
		$("#header_esquerda").addClass("hidden");
		$("#header_direita").addClass("hidden");
		$("#btn_controle_header").removeClass("hidden");
	} else {
		$("#header_esquerda").removeClass("hidden");
		$("#header_direita").removeClass("hidden");
		$("#btn_controle_header").addClass("hidden");
	}
}
$(document).ready(function () {
	Controlar_Classes();
});
$(window).resize(function() {
	Controlar_Classes();
});
function ControlaItems() {
	if ($('#header_esquerda').hasClass('hidden')) {
		$("#header_esquerda").removeClass("hidden");
	} else {
		$("#header_esquerda").addClass("hidden");
	}
	if ($('#header_direita').hasClass('hidden')) {
		$("#header_direita").removeClass("hidden");
	} else {
		$("#header_direita").addClass("hidden");
	}
}
$(document).ready(function() {
	$('.menu .item').tab();
	$('.ui.accordion').accordion();
});
function MudarTabPerfil() {
	$(this).tab('change tab', 'perfil');
    $('.menu .item').removeClass('active');
    $('#perfil').addClass('active');
}
function MudarTabDados() {
	$(this).tab('change tab', 'dados');
    $('.menu .item').removeClass('active');
    $('#dados').addClass('active');
}
function MudarTabPecas() {
	$(this).tab('change tab', 'pecas');
    $('.menu .item').removeClass('active');
    $('#pecas').addClass('active');
}
function MudarTabFinanceiro() {
	$(this).tab('change tab', 'financeiro');
    $('.menu .item').removeClass('active');
    $('#financeiro').addClass('active');
}
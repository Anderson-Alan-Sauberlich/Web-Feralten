$(document).ready(function() {
	$('#senha').attr('type', 'password');
	$('.ui.checkbox').checkbox();
	$('[data-toggle="popover"]').popover();
});
function MostrarSenha() {
	var passwordField = $('#senha');
	var passwordFieldType = passwordField.attr('type');
	if(passwordFieldType == 'password'){
    	passwordField.attr('type', 'text');
	} else {
    	passwordField.attr('type', 'password');
	}
}
var onloadCallback = function() { grecaptcha.render('recaptcha', { 'sitekey' : '6LeGszcUAAAAAJe8rA1Id_3ecGcA5GvceGO572jQ', 'size' : tamanhoTela() }); };
function tamanhoTela() {
	var scren = $("body").width();
	
	if (scren <= 767) {
		return 'compact';
	} else {
		return 'normal';
	}
};
function BtnCadastrarLoading() {
	$('#btn_cadastrar').addClass('loading');
}
$('#senha').attr('type', 'password');
$('.ui.checkbox.passCheck').checkbox();
$('[data-toggle="popover"]').popover();
SetarMascarasUsuario();
function SetarMascarasUsuario() {
	var maskBehavior = function(val) {
		  return val.replace(/\D/g, '').length === 11 ? '(00) 000-000-000' : '(00) 0000-00009';
		},
		options = {onChange: function(val, e, field, options) {
		        field.mask(maskBehavior.apply({}, arguments), options);
		    }
		};
		
	$('#telefone').mask(maskBehavior, options);
}
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
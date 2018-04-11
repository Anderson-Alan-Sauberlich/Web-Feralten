$(document).ready(function() {
	$('#ui_mostrar').checkbox();
});
function MostrarSenha() {
	var passwordField = $('#password');
	var passwordFieldType = passwordField.attr('type');
	if(passwordFieldType == 'password'){
    	passwordField.attr('type', 'text');
	} else {
    	passwordField.attr('type', 'password');
	}
}
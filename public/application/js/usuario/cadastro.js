$(document).ready(function() {
	$('#senha').attr('type', 'password');
	$('.ui.checkbox').checkbox();
	$(document).ready(function(){ $('[data-toggle="popover"]').popover(); });
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
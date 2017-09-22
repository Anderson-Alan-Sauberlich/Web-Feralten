function Mostrar_Senha_Antiga() {
   	var passwordField = $('#senha_antiga');
   	var passwordFieldType = passwordField.attr('type');
   	if(passwordFieldType == 'password'){
       	passwordField.attr('type', 'text');
   	} else {
       	passwordField.attr('type', 'password');
   	}
}
function Mostrar_Senha_Nova() {
   	var passwordField = $('#senha_nova');
   	var passwordFieldType = passwordField.attr('type');
   	if(passwordFieldType == 'password'){
       	passwordField.attr('type', 'text');
   	} else {
       	passwordField.attr('type', 'password');
   	}
}
function Mostrar_Senha_ConfNova() {
   	var passwordField = $('#senha_confnova');
   	var passwordFieldType = passwordField.attr('type');
   	if(passwordFieldType == 'password'){
       	passwordField.attr('type', 'text');
   	} else {
       	passwordField.attr('type', 'password');
   	}
}
$(document).ready(function() {
	$('.ui.checkbox').checkbox();
});
$(document).ready(function() {
	$('[data-toggle="popover"]').popover();
});
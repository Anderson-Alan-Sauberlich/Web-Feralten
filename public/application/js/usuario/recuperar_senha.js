$(document).ready(function() {
	$('.ui.checkbox').checkbox();
	$('[data-toggle="popover"]').popover();
});
function Enviar() {
	$('#sgm_recuperar_senha').addClass('loading');
	$('#div_email').removeClass('error');
	
	var $email = $('#email').val();
	var $erros = "";
	
	if ($email == '' || $email == null) {
		$erros += "<p>Informe seu E-Mail</p>";
		$('#div_email').addClass('error');
	}
	
	if ($erros === "") {
		$.ajax({
			method: "POST",
			url: "/usuario/recuperar-senha/enviar/",
			
			data: { email:$email }
		}).done(function(valor) {
			var $valor = JSON.parse(valor);
			
			$('#mdl_header').html($valor.header);
			$('#mdl_content').html($valor.content);
			
			if ($valor.campos.email === 'erro') {
				$('#div_email').addClass('error');
			} else {
				$('#email').val('');
				$('#btn_enviar').addClass('disabled');
			}
			
			$('#sgm_recuperar_senha').removeClass('loading');
			$('#mdl_enviar').modal('show');
		});
	} else {
		$('#mdl_header').html('<h3>Erro!</h3>');
		$('#mdl_content').html($erros);
		$('#sgm_recuperar_senha').removeClass('loading');
		$('#mdl_enviar').modal('show');
	}
}
function Salvar($codigo) {
	$('#sgm_recuperar_senha').addClass('loading');
	$('#div_senha_nova').removeClass('has-error has-feedback');
	$('#div_senha_confnova').removeClass('has-error has-feedback');
	
	var $senha_nova = $('#senha_nova').val();
	var $senha_confnova = $('#senha_confnova').val();
	var $erros = "";
	
	if ($senha_nova == '' || $senha_nova == null) {
		$erros += "<p>Informe a Nova Senha</p>";
		$('#div_senha_nova').addClass('has-error has-feedback');
	}
	
	if ($senha_confnova == '' || $senha_confnova == null) {
		$erros += "<p>Confirme a Nova Senha</p>";
		$('#div_senha_confnova').addClass('has-error has-feedback');
	}
	
	if ($erros === "") {
		$.ajax({
			method: "POST",
			url: "/usuario/recuperar-senha/salvar/",
			async: false,
			data: { codigo:$codigo, senha_nova:$senha_nova, senha_confnova:$senha_confnova }
		}).done(function(valor) {
			var $valor = JSON.parse(valor);
			
			if ($valor.status === 'certo') {
				window.location.href = '/usuario/meu-perfil/';
			} else {
				$('#mdl_header').html($valor.header);
				$('#mdl_content').html($valor.content);
				
				if ($valor.campos.senha_nova === 'erro') {
					$('#div_senha_nova').addClass('has-error has-feedback');
				}
				
				if ($valor.campos.senha_confnova === 'erro') {
					$('#div_senha_confnova').addClass('has-error has-feedback');
				}
				
				$('#mdl_enviar').modal('show');
			}
		});
	} else {
		$('#mdl_header').html('<h3>Erro!</h3>');
		$('#mdl_content').html($erros);
		$('#mdl_enviar').modal('show');
	}
	
	$('#sgm_recuperar_senha').removeClass('loading');
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
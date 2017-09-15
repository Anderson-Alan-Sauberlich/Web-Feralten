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
			url: "/usuario/recuperar-senha/",
			async: false,
			data: { email:$email }
		}).done(function(valor) {
			var $valor = JSON.parse(valor);
			
			$('#mdl_header').html($valor.header);
			$('#mdl_content').html($valor.content);
			
			if ($valor.campos.email === 'erro') {
				$('#div_email').addClass('error');
			}
		});
	} else {
		$('#mdl_header').html('<h3>Erro!</h3>');
		$('#mdl_content').html($erros);
	}
	
	$('#sgm_recuperar_senha').removeClass('loading');
	$('#mdl_enviar').modal('show');
}
$('#ui_whatsapp').checkbox();
$('#msg_contato').on('click', function() {
	$(this).closest('.message').transition('fade');
});
if (($('#nome').val() == "" || $('#nome').val() == null) && localStorage.getItem("usuario_nome")) {
	$('#nome').val(localStorage.getItem("usuario_nome"));
}
if (($('#email').val() == "" || $('#email').val() == null) && localStorage.getItem("usuario_email")) {
	$('#email').val(localStorage.getItem("usuario_email"));
}
if (($('#telefone').val() == "" || $('#telefone').val() == null) && localStorage.getItem("usuario_telefone")) {
	$('#telefone').val(localStorage.getItem("usuario_telefone"));
}
$(document).ready(function() {
	var maskBehavior = function (val) {
		  return val.replace(/\D/g, '').length === 11 ? '(00) 000-000-000' : '(00) 0000-00009';
		},
		options = {onKeyPress: function(val, e, field, options) {
		        field.mask(maskBehavior.apply({}, arguments), options);
		    }
		};

	$('#telefone').mask(maskBehavior, options);
});
function Enviar() {
	$('#div_contato').addClass('loading');
	$('#btn_submit').addClass('loading');
	
	$('#msg_contato').removeClass('visible');
	$('#msg_contato').addClass('hidden');
	
	$('#div_nome').removeClass('error');
	$('#div_email').removeClass('error');
	$('#div_telefone').removeClass('error');
	$('#div_whatsapp').removeClass('error');
	$('#div_assunto').removeClass('error');
	$('#div_mensagem').removeClass('error');
	
	var $nome = $('#nome').val();
	var $email = $('#email').val();
	var $telefone = $('#telefone').val();
	var $whatsapp = $('#whatsapp').val();
	var $assunto = $('#assunto').val();
	var $mensagem = $('#mensagem').val();
	var $erros = "";
	
	if ($nome == '' || $nome == null) {
		$erros += "<li>Informe seu Nome</li>";
		$('#div_nome').addClass('error');
	}
	
	if ($email == '' || $email == null) {
		$erros += "<li>Informe seu E-Mail</li>";
		$('#div_email').addClass('error');
	}
	
	if ($telefone == '' || $telefone == null) {
		$erros += "<li>Informe seu Telefone</li>";
		$('#div_telefone').addClass('error');
	}
	
	if ($assunto == '' || $assunto == null) {
		$erros += "<li>Informe o Assunto</li>";
		$('#div_assunto').addClass('error');
	}
	
	if ($mensagem == '' || $mensagem == null) {
		$erros += "<li>Digite sua Mensagem</li>";
		$('#div_mensagem').addClass('error');
	}
	
	if ($erros === "") {
		$.ajax({
			method: "POST",
			url: "/layout/form/contato/",
			data: { nome:$nome, email:$email, telefone:$telefone, whatsapp:$whatsapp, assunto:$assunto, mensagem:$mensagem }
		}).done(function(valor) {
			var $valor = JSON.parse(valor);
			
			$('#ul_contato').html($valor.html);
			
			if ($valor.status === 'certo') {
				$('#msg_contato').removeClass('error');
				$('#msg_contato').addClass('success');
			} else if ($valor.status === 'erro') {
				$('#msg_contato').addClass('error');
				$('#msg_contato').removeClass('success');
			}
			
			if ($valor.campos.nome === 'erro') {
				$('#div_nome').addClass('error');
			}
			
			if ($valor.campos.email === 'erro') {
				$('#div_email').addClass('error');
			}
			
			if ($valor.campos.telefone === 'erro') {
				$('#div_telefone').addClass('error');
			}
			
			if ($valor.campos.whatsapp === 'erro') {
				$('#div_whatsapp').addClass('error');
			}
			
			if ($valor.campos.assunto === 'erro') {
				$('#div_assunto').addClass('error');
			} else {
				$('#assunto').val('');
			}
			
			if ($valor.campos.mensagem === 'erro') {
				$('#div_mensagem').addClass('error');
			} else {
				$('#mensagem').val('');
			}
			
			$('#msg_contato').removeClass('hidden');
			$('#msg_contato').addClass('visible');
			$('#btn_submit').removeClass('loading');
			$('#div_contato').removeClass('loading');
		});
		
		localStorage.setItem("usuario_nome", $nome);
		localStorage.setItem("usuario_email", $email);
		localStorage.setItem("usuario_telefone", $telefone);
	} else {
		$('#ul_contato').html($erros);
		$('#msg_contato').addClass('error');
		$('#msg_contato').removeClass('success');
		$('#msg_contato').removeClass('hidden');
		$('#msg_contato').addClass('visible');
		$('#btn_submit').removeClass('loading');
		$('#div_contato').removeClass('loading');
	}
}
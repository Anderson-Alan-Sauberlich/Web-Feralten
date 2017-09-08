$('.ui.checkbox').checkbox();
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
function Submit() {
	$('#div_cnt_anc').addClass('loading');
	$('#btn_submit').addClass('loading');
	
	var $nome = $('#nome').val();
	var $email = $('#email').val();
	var $telefone = $('#telefone').val();
	var $whatsapp = $('#whatsapp').val();
	var $mensagem = $('#mensagem').val();
	var $erros = "";
	
	if ($nome == '' || $nome == null) {
		$erros += "<li>Informe seu Nome</li>";
	}
	
	if ($email == '' || $email == null) {
		$erros += "<li>Informe seu E-Mail</li>";
	}
	
	if ($telefone == '' || $telefone == null) {
		$erros += "<li>Informe seu Telefone</li>";
	}
	
	if ($mensagem == '' || $mensagem == null) {
		$erros += "<li>Digite sua Mensagem</li>";
	}
	
	if ($erros === "") {
		$.ajax({
			method: "POST",
			url: "/contato-anunciante/",
			async: false,
			data: { nome:$nome, email:$email, telefone:$telefone, whatsapp:$whatsapp, mensagem:$mensagem }
		}).done(function(valor) {
			var $valor = JSON.parse(valor);
			
			$('#ul_cnt_anc').html($valor.html);
			
			if ($valor.status === 'certo') {
				$('#msg_cnt_anc').removeClass('error');
				$('#msg_cnt_anc').addClass('success');
			} else if ($valor.status === 'erro') {
				$('#msg_cnt_anc').addClass('error');
				$('#msg_cnt_anc').removeClass('success');
			}
			
			$('#msg_cnt_anc').removeClass('hidden');
		});
	} else {
		$('#ul_cnt_anc').html($erros);
		$('#msg_cnt_anc').addClass('error');
		$('#msg_cnt_anc').removeClass('success');
		$('#msg_cnt_anc').removeClass('hidden');
	}
	
	$('#btn_submit').removeClass('loading');
	$('#div_cnt_anc').removeClass('loading');
}
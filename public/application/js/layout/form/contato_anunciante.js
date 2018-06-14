$('#ui_whatsapp').checkbox();
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
function Submit($peca_id) {
	$('#div_cnt_anc').addClass('loading');
	$('#btn_submit').addClass('loading');
	
	$('#msg_cnt_anc').removeClass('visible');
	$('#msg_cnt_anc').addClass('hidden');
	
	$('#div_nome').removeClass('error');
	$('#div_email').removeClass('error');
	$('#div_telefone').removeClass('error');
	$('#div_whatsapp').removeClass('error');
	
	var $nome = $('#nome').val();
	var $email = $('#email').val();
	var $telefone = $('#telefone').val();
	var $whatsapp = $('#whatsapp').val();
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
	
	if ($mensagem == '' || $mensagem == null) {
		$erros += "<li>Digite sua Mensagem</li>";
		$('#div_mensagem').addClass('error');
	}
	
	if ($peca_id == '' || $peca_id == null) {
		$erros += "<li>Codigo da Peça não identificado</li>";
		$('div_').addClass('error');
	}
	
	if ($erros === "") {
		$.ajax({
			method: "POST",
			url: "/layout/form/contato-anunciante/",
			data: { nome:$nome, email:$email, telefone:$telefone, whatsapp:$whatsapp, mensagem:$mensagem, peca_id:$peca_id }
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
			
			if ($valor.campos.mensagem === 'erro') {
				$('#div_mensagem').addClass('error');
			} else {
				$('#mensagem').val('');
			}
			
			$('#msg_cnt_anc').removeClass('hidden');
			$('#msg_cnt_anc').addClass('visible');
			$('#btn_submit').removeClass('loading');
			$('#div_cnt_anc').removeClass('loading');
		});
		
		localStorage.setItem("usuario_nome", $nome);
		localStorage.setItem("usuario_email", $email);
		localStorage.setItem("usuario_telefone", $telefone);
	} else {
		$('#ul_cnt_anc').html($erros);
		$('#msg_cnt_anc').addClass('error');
		$('#msg_cnt_anc').removeClass('success');
		$('#msg_cnt_anc').removeClass('hidden');
		$('#msg_cnt_anc').addClass('visible');
		$('#btn_submit').removeClass('loading');
		$('#div_cnt_anc').removeClass('loading');
	}
}
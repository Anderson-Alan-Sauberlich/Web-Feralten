$(document).ready(function () {
	$('#usuario_nome').popup();
	$('#usuario_sobrenome').popup();
	$('#usuario_email').popup();
	$('#usuario_email_alternativo').popup();
	$('#usuario_fone').popup();
	$('#usuario_fone_alternativo').popup();
});
$('#usuario_msg').on('click', function() {
	$(this).closest('.message').transition('fade');
});
SetarMascarasUsuario();
function SetarMascarasUsuario() {
	var maskBehavior = function(val) {
		  return val.replace(/\D/g, '').length === 11 ? '(00) 000-000-000' : '(00) 0000-00009';
		},
		options = {onChange: function(val, e, field, options) {
		        field.mask(maskBehavior.apply({}, arguments), options);
		    }
		};
		
	$('#usuario_fone').mask(maskBehavior, options);
	$('#usuario_fone_alternativo').mask(maskBehavior, options);
}
function SalvarUsuario() {
	$('#form_usuario').addClass('loading');
	$('#div_usuario_nome').removeClass('error');
	$('#div_usuario_sobrenome').removeClass('error');
	$('#div_usuario_email').removeClass('error');
	$('#div_usuario_email_alternativo').removeClass('error');
	$('#div_usuario_fone').removeClass('error');
	$('#div_usuario_fone_alternativo').removeClass('error');
	var $nome = $('#usuario_nome').val();
	var $sobrenome = $('#usuario_sobrenome').val();
	var $fone = $('#usuario_fone').val();
	var $fone_alternativo = $('#usuario_fone_alternativo').val();
	var $email = $('#usuario_email').val();
	var $email_alternativo = $('#usuario_email_alternativo').val();
	$.ajax({
		method: "POST",
		url: "/usuario/meu-perfil/meus-dados/editar-dados/usuario/",
		async: false,
		data: { 
			nome : $nome,
			sobrenome : $sobrenome,
			fone : $fone,
			fone_alternativo : $fone_alternativo,
			email : $email,
			email_alternativo : $email_alternativo
		}
	}).done(function(data) {
		var $data = JSON.parse(data);
		if ($data.sucessos.length > 0) {
			$('#usuario_msg').removeClass('error');
			$('#usuario_msg').addClass('success');
			$('#usuario_msg_header').html('Dados salvos com sucesso! :)');
			$('#usuario_msg_list').html($data.sucessos);
			$('#usuario_msg').addClass('visible');
			$('#usuario_msg').removeClass('hidden');
		} else if ($data.erros.length > 0) {
			$('#usuario_msg').addClass('error');
			$('#usuario_msg').removeClass('success');
			$('#usuario_msg_header').html('Ops! Algo deu errado! :(');
			$('#usuario_msg_list').html($data.erros);
			$('#usuario_msg').addClass('visible');
			$('#usuario_msg').removeClass('hidden');
			if ($data.campos.nome == 'erro') {
				$('#div_usuario_nome').addClass('error');
			}
			if ($data.campos.sobrenome == 'erro') {
				$('#div_usuario_sobrenome').addClass('error');
			}
			if ($data.campos.email == 'erro') {
				$('#div_usuario_email').addClass('error');
			}
			if ($data.campos.email_alternativo == 'erro') {
				$('#div_usuario_email_alternativo').addClass('error');
			}
			if ($data.campos.fone == 'erro') {
				$('#div_usuario_fone').addClass('error');
			}
			if ($data.campos.fone_alternativo == 'erro') {
				$('#div_usuario_fone_alternativo').addClass('error');
			}
		}
	});
	$('#form_usuario').removeClass('loading');
}
function RestaurarUsuario() {
	$('#form_usuario').addClass('loading');
	$.ajax({
		method: "GET",
		url: "/usuario/meu-perfil/meus-dados/editar-dados/usuario/",
		async: false
	}).done(function(data) {
		var $data = JSON.parse(data);
		$('#usuario_nome').val($data.nome);
		$('#usuario_sobrenome').val($data.sobrenome);
		$('#usuario_fone').val($data.fone).trigger('input');
		$('#usuario_fone_alternativo').val($data.fone_alternativo).trigger('input');
		$('#usuario_email').val($data.email);
		$('#usuario_email_alternativo').val($data.email_alternativo);
	});
	$('#form_usuario').removeClass('loading');
}
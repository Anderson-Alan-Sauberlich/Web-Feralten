function SalvarDados() {
	$('#form_usuario').addClass('loading');
	$('#form_entidade').addClass('loading');
	$('#form_endereco').addClass('loading');
	$('#usuario_msg').removeClass('visible').addClass('hidden');
	$('#entidade_msg').removeClass('visible').addClass('hidden');
	$('#endereco_msg').removeClass('visible').addClass('hidden');
	$('#div_usuario_nome').removeClass('error');
	$('#div_usuario_sobrenome').removeClass('error');
	$('#div_usuario_email').removeClass('error');
	$('#div_usuario_email_alternativo').removeClass('error');
	$('#div_usuario_fone').removeClass('error');
	$('#div_usuario_fone_alternativo').removeClass('error');
	$('#div_entidade_cpf_cnpj').removeClass('error');
	$('#div_entidade_nome_comercial').removeClass('error');
	$('#div_entidade_site').removeClass('error');
	$('#div_endereco_cep').removeClass('error');
	$('#div_endereco_estado').removeClass('error');
	$('#div_endereco_cidade').removeClass('error');
	$('#div_endereco_bairro').removeClass('error');
	$('#div_endereco_rua').removeClass('error');
	$('#div_endereco_numero').removeClass('error');
	$('#div_endereco_complemento').removeClass('error');
	var $nome = $('#usuario_nome').val();
	var $sobrenome = $('#usuario_sobrenome').val();
	var $fone = $('#usuario_fone').val();
	var $fone_alternativo = $('#usuario_fone_alternativo').val();
	var $email = $('#usuario_email').val();
	var $email_alternativo = $('#usuario_email_alternativo').val();
	var $cpf_cnpj = $('#entidade_cpf_cnpj').val();
	var $nome_comercial = $('#entidade_nome_comercial').val();
	var $site = $('#entidade_site').val();
	var $cep = $('#endereco_cep').val();
	var $estado = $('#endereco_estado').dropdown('get value');
	var $cidade = $('#endereco_cidade').dropdown('get value');
	var $bairro = $('#endereco_bairro').val();
	var $rua = $('#endereco_rua').val();
	var $numero = $('#endereco_numero').val();
	var $complemento = $('#endereco_complemento').val();
	$.ajax({
		method: "POST",
		url: "/usuario/meu-perfil/meus-dados/editar-dados/",
		async: false,
		data: { 
			nome : $nome,
			sobrenome : $sobrenome,
			fone : $fone,
			fone_alternativo : $fone_alternativo,
			email : $email,
			email_alternativo : $email_alternativo,
			cpf_cnpj : $cpf_cnpj,
			nome_comercial : $nome_comercial,
			site : $site,
			cep : $cep,
			estado : $estado,
			cidade : $cidade,
			bairro : $bairro,
			rua : $rua,
			numero : $numero,
			complemento : $complemento
		}
	}).done(function(data) {
		var $data = JSON.parse(data);
		if ($data.usuario.erros.length == 0 && $data.entidade.erros.length == 0 && $data.endereco.erros.length == 0) {
			window.location.replace("/usuario/meu-perfil/financeiro/meu-plano/");
		} else {
			if ($data.usuario.erros.length > 0) {
				$('#usuario_msg').addClass('error');
				$('#usuario_msg').removeClass('success');
				$('#usuario_msg_header').html('Ops! Algo deu errado! :(');
				$('#usuario_msg_list').html($data.usuario.erros);
				$('#usuario_msg').addClass('visible');
				$('#usuario_msg').removeClass('hidden');
				if ($data.usuario.campos.nome == 'erro') {
					$('#div_usuario_nome').addClass('error');
				}
				if ($data.usuario.campos.sobrenome == 'erro') {
					$('#div_usuario_sobrenome').addClass('error');
				}
				if ($data.usuario.campos.email == 'erro') {
					$('#div_usuario_email').addClass('error');
				}
				if ($data.usuario.campos.email_alternativo == 'erro') {
					$('#div_usuario_email_alternativo').addClass('error');
				}
				if ($data.usuario.campos.fone == 'erro') {
					$('#div_usuario_fone').addClass('error');
				}
				if ($data.usuario.campos.fone_alternativo == 'erro') {
					$('#div_usuario_fone_alternativo').addClass('error');
				}
			}
			if ($data.entidade.erros.length > 0) {
				$('#entidade_msg').addClass('error');
				$('#entidade_msg').removeClass('success');
				$('#entidade_msg_header').html('Ops! Algo deu errado! :(');
				$('#entidade_msg_list').html($data.entidade.erros);
				$('#entidade_msg').addClass('visible');
				$('#entidade_msg').removeClass('hidden');
				if ($data.entidade.campos.cpf_cnpj == 'erro') {
					$('#div_entidade_cpf_cnpj').addClass('error');
				}
				if ($data.entidade.campos.nome_comercial == 'erro') {
					$('#div_entidade_nome_comercial').addClass('error');
				}
				if ($data.entidade.campos.site == 'erro') {
					$('#div_entidade_site').addClass('error');
				}
			}
			if ($data.endereco.erros.length > 0) {
				$('#endereco_msg').addClass('error');
				$('#endereco_msg').removeClass('success');
				$('#endereco_msg_header').html('Ops! Algo deu errado! :(');
				$('#endereco_msg_list').html($data.endereco.erros);
				$('#endereco_msg').addClass('visible');
				$('#endereco_msg').removeClass('hidden');
				if ($data.endereco.campos.cep == 'erro') {
					$('#div_endereco_cep').addClass('error');
				}
				if ($data.endereco.campos.estado == 'erro') {
					$('#div_endereco_estado').addClass('error');
				}
				if ($data.endereco.campos.cidade == 'erro') {
					$('#div_endereco_cidade').addClass('error');
				}
				if ($data.endereco.campos.bairro == 'erro') {
					$('#div_endereco_bairro').addClass('error');
				}
				if ($data.endereco.campos.rua == 'erro') {
					$('#div_endereco_rua').addClass('error');
				}
				if ($data.endereco.campos.numero == 'erro') {
					$('#div_endereco_numero').addClass('error');
				}
				if ($data.endereco.campos.complemento == 'erro') {
					$('#div_endereco_complemento').addClass('error');
				}
			}
		}
	});
	$('#form_usuario').removeClass('loading');
	$('#form_entidade').removeClass('loading');
	$('#form_endereco').removeClass('loading');
}
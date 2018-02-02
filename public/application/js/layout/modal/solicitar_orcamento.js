$('.ui.checkbox').checkbox();
$('.message .close').on('click', function() {
	$(this).closest('.message').transition('fade');
});
var onloadCallback = function() { grecaptcha.render('recaptcha', { 'sitekey' : '6LeGszcUAAAAAJe8rA1Id_3ecGcA5GvceGO572jQ', 'size' : tamanhoTela() }); };
function tamanhoTela() {
	var scren = $("body").width();
	
	if (scren <= 767) {
		return 'compact';
	} else {
		return 'normal';
	}
};
function abrirModal() {
	var categoria = $("input[name='categoria']:checked").val();
	var marca = $("#marca").find("option:selected").val();
	var modelo = $("#modelo").find("option:selected").val();
	var versao = $("#versao").find("option:selected").val();
	var ano_de = $("#ano_de").val();
	var ano_ate = $("#ano_ate").val();
	var peca = $("#peca").val();
	var estado_uso = $("#estado_uso").find("option:selected").val();
	var preferencia_entrega = $("#preferencia_entrega").find("option:selected").val();
	var erro = '';
	if (categoria == 0 || categoria == "" || categoria == undefined) {
		erro += '<li><h4>Categoria</h4></li>';
	}
	if (marca == 0 || marca == "" || marca == undefined) {
		erro += '<li><h4>Marca</h4></li>';
	}
	if (modelo == 0 || modelo == "" || modelo == undefined) {
		erro += '<li><h4>Modelo</h4></li>';
	}
	if (versao == 0 || versao == "" || versao == undefined) {
		erro += '<li><h4>Versão</h4></li>';
	}
	if ((ano_de == 0 || ano_de == "" || ano_de == undefined) && (ano_ate == 0 || ano_ate == "" || ano_ate == undefined)) {
		erro += '<li><h4>Selecione um Ano</h4></li>';
	}
	if (peca == 0 || peca == "" || peca == undefined) {
		erro += '<li><h4>Informe o nome  da peça</h4></li>';
	}
	if (erro != '') {
		$('#mdl_content').html(erro);
		$('#mdl_enviar').modal('show');
	} else {
		$('#div_text_orc').html('<h3>'+$("input[name='categoria']:checked").data('nome')+', '+$("#marca").find("option:selected").text()+', '+$("#modelo").find("option:selected").text()+', '+$("#versao").find("option:selected").text()+'</h3>');
		$('#div_text_orc').append('<h3>Nome da Peça: '+peca+'</h3>');
		$('#div_text_orc').append('<h3>Ano: de '+ano_de+' até '+ano_ate+'</h3>');
		if (preferencia_entrega != 0) {
			$('#div_text_orc').append('<h4>Preferência de Entrega: '+$("#preferencia_entrega").find("option:selected").text()+'</h4>');
		}
		if (estado_uso != 0) {
			$('#div_text_orc').append('<h4>Estado de Conservação: '+$("#estado_uso").find("option:selected").text()+'</h4>');
		}
		$('.ui.large.long.modal').modal('show');
	}
}
function criarOrcamento() {
	$('#div_orcamento').addClass('loading');
	var categoria = $("input[name='categoria']:checked").val();
	var marca = $("#marca").find("option:selected").val();
	var modelo = $("#modelo").find("option:selected").val();
	var versao = $("#versao").find("option:selected").val();
	var ano_de = $("#ano_de").val();
	var ano_ate = $("#ano_ate").val();
	var peca = $("#peca").val();
	var estado_uso = $("#estado_uso").find("option:selected").val();
	var preferencia_entrega = $("#preferencia_entrega").find("option:selected").val();
	var descricao = $('#descricao').val();
	var $data = '';
	$.ajax({
		method: "POST",
		url: "/layout/modal/solicitar-orcamento/",
		async: false,
		data: { 
			categoria_id : categoria,
			marca_id : marca,
			modelo_id : modelo,
			versao_id : versao,
			ano_de : ano_de,
			ano_ate : ano_ate,
			nome  : peca,
			descricao : descricao,
			estado_uso : estado_uso,
			preferencia_entrega : preferencia_entrega
		}
	}).done(function(data) {
		$data = JSON.parse(data);
		if ($data.status == 'certo') {
			window.location.replace("/usuario/meu-perfil/meus-orcamentos/");
		} else if ($data.status == 'erro') {
			$('#div_msg').addClass('error');
			$('#div_msg').removeClass('success');
			$('#msg_header').html('Ops! Algo deu errado! :(');
			$('#msg_list').html($data.content);
			$('#div_msg').addClass('visible');
			$('#div_msg').removeClass('hidden');
		}
	});
	$('#div_orcamento').removeClass('loading');
}
function cadastrarUsuario() {
	$('#form_cadastro').addClass('loading');
	var nome = $('#cadastro_nome').val();
	var sobrenome = $('#cadastro_sobrenome').val();
	var email = $('#cadastro_email').val();
	var senha = $('#cadastro_senha').val();
	var token = $("#g-recaptcha-response").val();
	var erro = '';
	if (nome == 0 || nome == "" || nome == undefined) {
		erro += '<li>Digite seu Nome</li>';
	}
	if (sobrenome == 0 || sobrenome == "" || sobrenome == undefined) {
		erro += '<li>Digite seu sobrenome</li>';
	}
	if (email == 0 || email == "" || email == undefined) {
		erro += '<li>Digite seu E-mail</li>';
	}
	if (senha == 0 || senha == "" || senha == undefined) {
		erro += '<li>Digite sua senha</li>';
	}
	if (erro != '') {
		$('#cadastro_msg').addClass('error');
		$('#cadastro_msg').removeClass('success');
		$('#cadastro_msg_header').html('Ops! Algo deu errado! :(');
		$('#cadastro_msg_list').html(erro);
		$('#cadastro_msg').addClass('visible');
		$('#cadastro_msg').removeClass('hidden');
	} else {
		$.ajax({
			method: "POST",
			url: "/usuario/cadastro/ajax/",
			async: false,
			data: { 
				nome : nome,
				sobrenome : sobrenome,
				email : email,
				senha : senha,
				token : token
			}
		}).done(function(data) {
			$data = JSON.parse(data);
			if ($data.status == 'certo') {
				$('#div_autenticacao').addClass('hidden');
				$('#div_orcamento').removeClass('hidden');
			} else if ($data.status == 'erro') {
				$('#cadastro_msg').addClass('error');
				$('#cadastro_msg').removeClass('success');
				$('#cadastro_msg_header').html('Ops! Algo deu errado! :(');
				$('#cadastro_msg_list').html($data.content);
				$('#cadastro_msg').addClass('visible');
				$('#cadastro_msg').removeClass('hidden');
			}
		});
	}
	$('#form_cadastro').removeClass('loading');
}
function logarUsuario() {
	$('#form_login').addClass('loading');
	var email = $('#login_email').val();
	var senha = $('#login_senha').val();
	var manter = $('#login_manter').val();
	var erro = '';
	if (email == 0 || email == "" || email == undefined) {
		erro += '<li>Digite seu E-mail</li>';
	}
	if (senha == 0 || senha == "" || senha == undefined) {
		erro += '<li>Digite sua senha</li>';
	}
	if (erro != '') {
		$('#login_msg').addClass('error');
		$('#login_msg').removeClass('success');
		$('#login_msg_header').html('Ops! Algo deu errado! :(');
		$('#login_msg_list').html(erro);
		$('#login_msg').addClass('visible');
		$('#login_msg').removeClass('hidden');
	} else {
		$.ajax({
			method: "POST",
			url: "/usuario/login/ajax/",
			async: false,
			data: { 
				email : email,
				senha : senha,
				manter : manter
			}
		}).done(function(data) {
			$data = JSON.parse(data);
			if ($data.status == 'certo') {
				$('#div_autenticacao').addClass('hidden');
				$('#div_orcamento').removeClass('hidden');
			} else if ($data.status == 'erro') {
				$('#login_msg').addClass('error');
				$('#login_msg').removeClass('success');
				$('#login_msg_header').html('Ops! Algo deu errado! :(');
				$('#login_msg_list').html($data.content);
				$('#login_msg').addClass('visible');
				$('#login_msg').removeClass('hidden');
			}
		});
	}
	$('#form_login').removeClass('loading');
}
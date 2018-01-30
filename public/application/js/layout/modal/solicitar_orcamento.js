$('.ui.checkbox').checkbox();
$('.message .close').on('click', function() {
	$(this).closest('.message').transition('fade');
});
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
		$('#div_text_orc').html('<h3>Categoria: '+$("input[name='categoria']:checked").data('nome')+', Marca: '+$("#marca").find("option:selected").text()+', Modelo: '+$("#modelo").find("option:selected").text()+', Versão: '+$("#versao").find("option:selected").text()+'</h3>');
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
	$('#div_autenticacao').addClass('hidden');
	$('#div_orcamento').removeClass('hidden');
}
function logarUsuario() {
	$('#div_autenticacao').addClass('hidden');
	$('#div_orcamento').removeClass('hidden');
}
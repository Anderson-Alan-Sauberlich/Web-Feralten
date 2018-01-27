$('.ui.checkbox').checkbox();
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
	var estado = $("#estado").find("option:selected").val();
	var cidade = $("#cidade").find("option:selected").val();
	var erro = '';
	
	if (categoria == 0 || categoria == "" || categoria == undefined) {
		erro += '<h4>Selecione uma Categoria</h4>';
	}
	
	if (marca == 0 || marca == "" || marca == undefined) {
		erro += '<h4>Selecione uma Marca</h4>';
	}
	
	if (modelo == 0 || modelo == "" || modelo == undefined) {
		erro += '<h4>Selecione um Modelo</h4>';
	}
	
	if (versao == 0 || versao == "" || versao == undefined) {
		erro += '<h4>Selecione uma Versão</h4>';
	}
	
	if ((ano_de == 0 || ano_de == "" || ano_de == undefined) && (ano_ate == 0 || ano_ate == "" || ano_ate == undefined)) {
		erro += '<h4>Selecione um Ano</h4>';
	}
	
	if (peca == 0 || peca == "" || peca == undefined) {
		erro += '<h4>Informe o nome  da peça</h4>';
	}
	
	if (erro != '') {
		$('#mdl_content').html(erro);
		$('#mdl_enviar').modal('show');
	} else {
		$('#div_text_orc').html('<h3>Categoria: '+$("input[name='categoria']:checked").data('nome')+', Marca: '+$("#marca").find("option:selected").text()+', Modelo: '+$("#modelo").find("option:selected").text()+', Versão: '+$("#versao").find("option:selected").text()+'</h3>');
		$('#div_text_orc').append('<h3>Nome da Peça: '+peca+'</h3>');
		$('#div_text_orc').append('<h3>Ano: '+ano_de+' '+ano_ate+'</h3>');
		if (preferencia_entrega != 0) {
			$('#div_text_orc').append('<h4>Preferência de Entrega: '+$("#preferencia_entrega").find("option:selected").text()+'</h4>');
		}
		if (estado_uso != 0) {
			$('#div_text_orc').append('<h4>Estado de Conservação: '+$("#estado_uso").find("option:selected").text()+'</h4>');
		}
		if (estado != 0) {
			if (cidade != 0) {
				$('#div_text_orc').append('<h4>Estado: '+$("#estado").find("option:selected").text()+', Cidade: '+$("#cidade").find("option:selected").text()+'</h4>');
			} else {
				$('#div_text_orc').append('<h4>Estado: '+$("#estado").find("option:selected").text()+'</h4>');
			}
		}
		$('.ui.fullscreen.modal').modal('show');
	}
}
function cadastrarUsuario() {
	$('#div_autenticacao').addClass('hidden');
	$('#div_orcamento').removeClass('hidden');
}
function logarUsuario() {
	$('#div_autenticacao').addClass('hidden');
	$('#div_orcamento').removeClass('hidden');
}
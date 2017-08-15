function Alt_Reset() {
	Alt_Recarregar_Categoria();
	$("#alt_categoria").dropdown('set value', '0');
	$("#alt_categoria").dropdown('set text', 'Categoria');
	Alt_Reset_Categoria();
	Alt_Reset_Marca();
	Alt_Reset_Modelo();
	Alt_Reset_Versao();
}
function Alt_Reset_Categoria() {
	if ($("#alt_categoria").val() != 0 && $("#alt_categoria").val() != null) {
		Alt_Recarregar_Marcas();
		$("#alt_modelo").html('<option value="0">Modelo</option>');
       	$("#alt_versao").html('<option value="0">Versão</option>');
       	$('#alt_marca').dropdown('set value', '0');
       	$('#alt_modelo').dropdown('set value', '0');
       	$('#alt_versao').dropdown('set value', '0');
       	$('#alt_marca').dropdown('set text', 'Marca');
       	$('#alt_modelo').dropdown('set text', 'Modelo');
       	$('#alt_versao').dropdown('set text', 'Versão');
       	$("#alt_lb_item").html('Categoria');
       	Alt_Sincronizar_Categoria();
	} else {
		$("#alt_marca").html('<option value="0">Marca</option>');
		$("#alt_modelo").html('<option value="0">Modelo</option>');
       	$("#alt_versao").html('<option value="0">Versão</option>');
       	$('#alt_marca').dropdown('set value', '0');
       	$('#alt_modelo').dropdown('set value', '0');
       	$('#alt_versao').dropdown('set value', '0');
       	$('#alt_marca').dropdown('set text', 'Marca');
       	$('#alt_modelo').dropdown('set text', 'Modelo');
       	$('#alt_versao').dropdown('set text', 'Versão');
       	$("#alt_lb_item").html('Nada');
       	$("#alt_nome").val("");
	   	$("#alt_url").val("");
	}
}
function Alt_Reset_Marca() {
	if ($("#alt_marca").val() != 0 && $("#alt_marca").val() != null) {
		Alt_Recarregar_Modelos();
        $("#alt_versao").html('<option value="0">Versão</option>');
        $('#alt_modelo').dropdown('set value', '0');
       	$('#alt_versao').dropdown('set value', '0');
       	$('#alt_modelo').dropdown('set text', 'Modelo');
       	$('#alt_versao').dropdown('set text', 'Versão');
       	$("#alt_lb_item").html('Marca');
       	Alt_Sincronizar_Marca();
	} else if ($("#alt_categoria").val() != 0 && $("#alt_categoria").val() != null) {
		$("#alt_modelo").html('<option value="0">Modelo</option>');
		$("#alt_versao").html('<option value="0">Versão</option>');
		$('#alt_modelo').dropdown('set value', '0');
       	$('#alt_versao').dropdown('set value', '0');
       	$('#alt_modelo').dropdown('set text', 'Modelo');
       	$('#alt_versao').dropdown('set text', 'Versão');
       	$("#alt_lb_item").html('Categoria');
       	Alt_Sincronizar_Categoria();
	}
}
function Alt_Reset_Modelo() {
	if ($("#alt_modelo").val() != 0 && $("#alt_modelo").val() != null) {
		Alt_Recarregar_Versoes();
		$('#alt_versao').dropdown('set value', '0');
       	$('#alt_versao').dropdown('set text', 'Versão');
       	$("#alt_lb_item").html('Modelo');
       	Alt_Sincronizar_Modelo();
	} else if ($("#alt_marca").val() != 0 && $("#alt_marca").val() != null) {
		$("#alt_versao").html('<option value="0">Versão</option>');
		$('#alt_versao').dropdown('set value', '0');
       	$('#alt_versao').dropdown('set text', 'Versão');
       	$("#alt_lb_item").html('Marca');
       	Alt_Sincronizar_Marca();
	}
}
function Alt_Reset_Versao() {
	if ($("#alt_versao").val() != 0 && $("#alt_versao").val() != null) {
        $("#alt_lb_item").html('Versão');
        Alt_Sincronizar_Versao();
	} else if ($("#alt_modelo").val() != 0 && $("#alt_modelo").val() != null) {
       	$("#alt_lb_item").html('Modelo');
       	Alt_Sincronizar_Modelo();
	}
}
$("#alt_categoria").change(function() {
	Alt_Reset_Categoria();
});
$("#alt_marca").change(function() {
	Alt_Reset_Marca();
});
$("#alt_modelo").change(function() {
	Alt_Reset_Modelo();
});
$("#alt_versao").change(function() {
	Alt_Reset_Versao();
});
function Alt_Recarregar_Categoria() {
	var id = $('#alt_categoria').dropdown('get value');
	$("#alt_categoria").html('<option>Carregando...</option>');
	$.ajax({
		type: "GET",
		url: "/admin/controle/base-de-conhecimento/cmmv/alterar/categorias/",
		async: false,
	}).done(function(valor) {
		$("#alt_categoria").html(valor);
		$('#alt_categoria').dropdown('set value', id);
		$('#alt_categoria').dropdown('set text', $("#alt_nome").val());
	});
}
function Alt_Recarregar_Marcas() {
	var id = $('#alt_marca').dropdown('get value');
	$("#alt_marca").html('<option>Carregando...</option>');
	$.ajax({
		type: "GET",
		url: "/admin/controle/base-de-conhecimento/cmmv/alterar/marcas/",
		async: false,
		data: {
		    categoria:$("#alt_categoria").val()
		}
	}).done(function(valor) {
		$("#alt_marca").html(valor);
		$('#alt_marca').dropdown('set value', id);
		$('#alt_marca').dropdown('set text', $("#alt_nome").val());
	});
}
function Alt_Recarregar_Modelos() {
	var id = $('#alt_modelo').dropdown('get value');
	$("#alt_modelo").html('<option>Carregando...</option>');
	$.ajax({
		type: "GET",
		url: "/admin/controle/base-de-conhecimento/cmmv/alterar/modelos/",
		async: false,
		data: {
			marca:$("#alt_marca").val()
		}
	}).done(function(valor) {
		$("#alt_modelo").html(valor);
		$('#alt_modelo').dropdown('set value', id);
		$('#alt_modelo').dropdown('set text', $("#alt_nome").val());
	});
}
function Alt_Recarregar_Versoes() {
	var id = $('#alt_versao').dropdown('get value');
	$("#alt_versao").html('<option>Carregando...</option>');
	$.ajax({
		type: "GET",
		url: "/admin/controle/base-de-conhecimento/cmmv/alterar/versoes/",
		async: false,
		data: {
			modelo:$("#alt_modelo").val()
		}
	}).done(function(valor) {
		$("#alt_versao").html(valor);
		$('#alt_versao').dropdown('set value', id);
		$('#alt_versao').dropdown('set text', $("#alt_nome").val());
	});
}
$(document).ready(function( ) {
	$("#alt_nome").keyup(function() {
		$("#alt_url").val(alt_retira_acentos($("#alt_nome").val()));
	});
});
function Alt_Sincronizar_Categoria() {
	$.get('/admin/controle/base-de-conhecimento/cmmv/alterar/categoria/', 
	{categoria:$("#alt_categoria").val()},
	function(valor) {
		var categoria = JSON.parse(valor);
	   	$("#alt_nome").val(categoria.nome);
	   	$("#alt_url").val(categoria.url);
	});
}
function Alt_Sincronizar_Marca() {
	$.get('/admin/controle/base-de-conhecimento/cmmv/alterar/marca/', 
	{marca:$("#alt_marca").val()},
	function(valor) {
		var marca = JSON.parse(valor);
	   	$("#alt_nome").val(marca.nome);
	   	$("#alt_url").val(marca.url);
	});
}
function Alt_Sincronizar_Modelo() {
	$.get('/admin/controle/base-de-conhecimento/cmmv/alterar/modelo/', 
	{modelo:$("#alt_modelo").val()},
	function(valor) {
		var modelo = JSON.parse(valor);
	   	$("#alt_nome").val(modelo.nome);
	   	$("#alt_url").val(modelo.url);
	});
}
function Alt_Sincronizar_Versao() {
	$.get('/admin/controle/base-de-conhecimento/cmmv/alterar/versao/', 
	{versao:$("#alt_versao").val()},
	function(valor) {
		var versao = JSON.parse(valor);
	   	$("#alt_nome").val(versao.nome);
	   	$("#alt_url").val(versao.url);
	});
}
function alt_retira_acentos(palavra) {
	com_acento = '/.,áàãâäéèêëíìîïóòõôöúùûüẃẁŵẅýỳŷỹÿǵĝĉçÁÀÃÂÄÉÈÊËÍÌÎÏÓÒÕÖÔÚÙÛÜẂẀŴẄÝỲŶỸŸǴĜĈÇ &';
	sem_acento = '---aaaaaeeeeiiiiooooouuuuwwwwyyyyyggccaaaaaeeeeiiiiooooouuuuwwwwyyyyyggcc-e';
	nova = '';
	for(i=0;i<palavra.length;i++) {
		if (com_acento.search(palavra.substr(i,1))>=0) {
			nova+=sem_acento.substr(com_acento.search(palavra.substr(i,1)),1);
		}
		else {
			nova+=palavra.substr(i,1);
		}
	}
	return nova.toLowerCase();
}
function SalvarAlterar() {
	$("#alt_salvar").addClass("disabled loading");
	$.ajax({
		type: "POST",
		url: "/admin/controle/base-de-conhecimento/cmmv/alterar/",
		async: false,
		data: {
		    categoria:$("#alt_categoria").val(),
		    marca:$("#alt_marca").val(),
		    modelo:$("#alt_modelo").val(),
		    versao:$("#alt_versao").val(),
		    nome:$("#alt_nome").val(),
		    url:$("#alt_url").val()
		}
	}).done(function(valor) {
		$("#alt_div_msg").html(valor);
	});
	var item = $("#alt_lb_item").html();
	if (item == 'Categoria') {
		Alt_Recarregar_Categoria();
	} else if (item == 'Marca') {
		Alt_Recarregar_Marcas();
	} else if (item == 'Modelo') {
		Alt_Recarregar_Modelos();
	} else if (item == 'Versão') {
		Alt_Recarregar_Versoes();
	}
	$( "#alt_salvar" ).removeClass("disabled loading");
}
function Del_Reset() {
	Del_Recarregar_Categoria();
	$("#del_categoria").dropdown('set value', '0');
	$("#del_categoria").dropdown('set text', 'Categoria');
	Del_Reset_Categoria();
	Del_Reset_Marca();
	Del_Reset_Modelo();
	Del_Reset_Versao();
}
function Del_Reset_Categoria() {
	if ($("#del_categoria").val() != 0 && $("#del_categoria").val() != null) {
		Del_Recarregar_Marcas();
		$("#del_modelo").html('<option value="0">Modelo</option>');
       	$("#del_versao").html('<option value="0">Versão</option>');
       	$('#del_marca').dropdown('set value', '0');
       	$('#del_modelo').dropdown('set value', '0');
       	$('#del_versao').dropdown('set value', '0');
       	$('#del_marca').dropdown('set text', 'Marca');
       	$('#del_modelo').dropdown('set text', 'Modelo');
       	$('#del_versao').dropdown('set text', 'Versão');
       	$("#del_lb_item").html('Categoria');
       	Del_Sincronizar_Categoria();
	} else if (true) {
		$("#del_marca").html('<option value="0">Marca</option>');
		$("#del_modelo").html('<option value="0">Modelo</option>');
       	$("#del_versao").html('<option value="0">Versão</option>');
       	$('#del_marca').dropdown('set value', '0');
       	$('#del_modelo').dropdown('set value', '0');
       	$('#del_versao').dropdown('set value', '0');
       	$('#del_marca').dropdown('set text', 'Marca');
       	$('#del_modelo').dropdown('set text', 'Modelo');
       	$('#del_versao').dropdown('set text', 'Versão');
       	$("#del_lb_item").html('Nada');
       	$("#del_nome").val("");
	   	$("#del_url").val("");
	}
}
function Del_Reset_Marca() {
	if ($("#del_marca").val() != 0 && $("#del_marca").val() != null) {
		Del_Recarregar_Modelos();
        $("#del_versao").html('<option value="0">Versão</option>');
        $('#del_modelo').dropdown('set value', '0');
       	$('#del_versao').dropdown('set value', '0');
       	$('#del_modelo').dropdown('set text', 'Modelo');
       	$('#del_versao').dropdown('set text', 'Versão');
       	$("#del_lb_item").html('Marca');
       	Del_Sincronizar_Marca();
	} else if ($("#del_categoria").val() != 0 && $("#del_categoria").val() != null) {
		$("#del_modelo").html('<option value="0">Modelo</option>');
		$("#del_versao").html('<option value="0">Versão</option>');
		$('#del_modelo').dropdown('set value', '0');
       	$('#del_versao').dropdown('set value', '0');
       	$('#del_modelo').dropdown('set text', 'Modelo');
       	$('#del_versao').dropdown('set text', 'Versão');
       	$("#del_lb_item").html('Categoria');
       	Del_Sincronizar_Categoria();
	}
}
function Del_Reset_Modelo() {
	if ($("#del_modelo").val() != 0 && $("#del_modelo").val() != null) {
		Del_Recarregar_Versoes();
		$('#del_versao').dropdown('set value', '0');
       	$('#del_versao').dropdown('set text', 'Versão');
       	$("#del_lb_item").html('Modelo');
       	Del_Sincronizar_Modelo();
	} else if ($("#del_marca").val() != 0 && $("#del_marca").val() != null) {
		$("#del_versao").html('<option value="0">Versão</option>');
		$('#del_versao').dropdown('set value', '0');
       	$('#del_versao').dropdown('set text', 'Versão');
       	$("#del_lb_item").html('Marca');
       	Del_Sincronizar_Marca();
	}
}
function Del_Reset_Versao() {
	if ($("#del_versao").val() != 0 && $("#del_versao").val() != null) {
        $("#del_lb_item").html('Versão');
        Del_Sincronizar_Versao();
	} else if ($("#del_modelo").val() != 0 && $("#del_modelo").val() != null) {
       	$("#del_lb_item").html('Modelo');
       	Del_Sincronizar_Modelo();
	}
}
$("#del_categoria").change(function() {
	Del_Reset_Categoria();
});
$("#del_marca").change(function() {
	Del_Reset_Marca();
});
$("#del_modelo").change(function() {
	Del_Reset_Modelo();
});
$("#del_versao").change(function() {
	Del_Reset_Versao();
});
function Del_Recarregar_Categoria() {
	$("#del_categoria").html('<option>Carregando...</option>');
	$.ajax({
		type: "GET",
		url: "/admin/controle/base-de-conhecimento/cmmv/deletar/categorias/",
		async: false,
	}).done(function(valor) {
		$("#del_categoria").html(valor);
		$('#del_categoria').dropdown('set value', '0');
		$('#del_categoria').dropdown('set text', 'Categoria');
		$("#del_lb_item").html('Nada');
		$("#del_nome").val("");
	   	$("#del_url").val("");
	});
}
function Del_Recarregar_Marcas() {
	$("#del_marca").html('<option>Carregando...</option>');
	$.ajax({
		type: "GET",
		url: "/admin/controle/base-de-conhecimento/cmmv/deletar/marcas/",
		async: false,
		data: {
		    categoria:$("#del_categoria").val()
		}
	}).done(function(valor) {
		$("#del_marca").html(valor);
		$('#del_marca').dropdown('set value', '0');
		$('#del_marca').dropdown('set text', 'Marca');
		$("#del_lb_item").html('Categoria');
		Del_Sincronizar_Categoria();
	});
}
function Del_Recarregar_Modelos() {
	$("#del_modelo").html('<option>Carregando...</option>');
	$.ajax({
		type: "GET",
		url: "/admin/controle/base-de-conhecimento/cmmv/deletar/modelos/",
		async: false,
		data: {
			marca:$("#del_marca").val()
		}
	}).done(function(valor) {
		$("#del_modelo").html(valor);
		$('#del_modelo').dropdown('set value', '0');
		$('#del_modelo').dropdown('set text', 'Modelo');
		$("#del_lb_item").html('Marca');
		Del_Sincronizar_Marca()
	});
}
function Del_Recarregar_Versoes() {
	$("#del_versao").html('<option>Carregando...</option>');
	$.ajax({
		type: "GET",
		url: "/admin/controle/base-de-conhecimento/cmmv/deletar/versoes/",
		async: false,
		data: {
			modelo:$("#del_modelo").val()
		}
	}).done(function(valor) {
		$("#del_versao").html(valor);
		$('#del_versao').dropdown('set value', '0');
		$('#del_versao').dropdown('set text', 'Versão');
		$("#del_lb_item").html('Modelo');
		Del_Sincronizar_Modelo();
	});
}
$(document).ready(function( ) {
	$("#del_nome").keyup(function() {
		$("#del_url").val(del_retira_acentos($("#del_nome").val()));
	});
});
function Del_Sincronizar_Categoria() {
	$.get('/admin/controle/base-de-conhecimento/cmmv/deletar/categoria/', 
	{categoria:$("#del_categoria").val()},
	function(valor) {
		var categoria = JSON.parse(valor);
	   	$("#del_nome").val(categoria.nome);
	   	$("#del_url").val(categoria.url);
	});
}
function Del_Sincronizar_Marca() {
	$.get('/admin/controle/base-de-conhecimento/cmmv/deletar/marca/', 
	{marca:$("#del_marca").val()},
	function(valor) {
		var marca = JSON.parse(valor);
	   	$("#del_nome").val(marca.nome);
	   	$("#del_url").val(marca.url);
	});
}
function Del_Sincronizar_Modelo() {
	$.get('/admin/controle/base-de-conhecimento/cmmv/deletar/modelo/', 
	{modelo:$("#del_modelo").val()},
	function(valor) {
		var modelo = JSON.parse(valor);
	   	$("#del_nome").val(modelo.nome);
	   	$("#del_url").val(modelo.url);
	});
}
function Del_Sincronizar_Versao() {
	$.get('/admin/controle/base-de-conhecimento/cmmv/deletar/versao/', 
	{versao:$("#del_versao").val()},
	function(valor) {
		var versao = JSON.parse(valor);
	   	$("#del_nome").val(versao.nome);
	   	$("#del_url").val(versao.url);
	});
}
function del_retira_acentos(palavra) {
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
function SalvarDeletar() {
	$("#del_salvar").addClass("disabled loading");
	$.ajax({
		url: "/admin/controle/base-de-conhecimento/cmmv/deletar/",
		type: "POST",
		async: false,
		data: {
		    categoria:$("#del_categoria").val(),
		    marca:$("#del_marca").val(),
		    modelo:$("#del_modelo").val(),
		    versao:$("#del_versao").val(),
		    nome:$("#del_nome").val(),
		    url:$("#del_url").val()
		}
	}).done(function(valor) {
		$("#del_div_msg").html(valor);
	});
	var item = $("#del_lb_item").html();
	if (item == 'Categoria') {
		Del_Recarregar_Categoria();
	} else if (item == 'Marca') {
		Del_Recarregar_Marcas();
	} else if (item == 'Modelo') {
		Del_Recarregar_Modelos();
	} else if (item == 'Versão') {
		Del_Recarregar_Versoes();
	}
	$( "#del_salvar" ).removeClass("disabled loading");
}
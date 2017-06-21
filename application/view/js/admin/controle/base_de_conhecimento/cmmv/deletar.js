$('.ui.dropdown').dropdown();
$(document).ready(function( ) {
	$("#categoria").change(function() {
		if ($("#categoria").val() != 0 && $("#categoria").val() != null) {
			Recarregar_Marcas();
			$("#modelo").html('<option value="0">Modelo</option>');
	       	$("#versao").html('<option value="0">Versão</option>');
	       	$('#marca').dropdown('set value', '0');
	       	$('#modelo').dropdown('set value', '0');
	       	$('#versao').dropdown('set value', '0');
	       	$('#marca').dropdown('set text', 'Marca');
	       	$('#modelo').dropdown('set text', 'Modelo');
	       	$('#versao').dropdown('set text', 'Versão');
	       	$("#lb_item").html('Categoria');
		    Sincronizar_Categoria();
		} else if (true) {
			$("#marca").html('<option value="0">Marca</option>');
			$("#modelo").html('<option value="0">Modelo</option>');
	       	$("#versao").html('<option value="0">Versão</option>');
	       	$('#marca').dropdown('set value', '0');
	       	$('#modelo').dropdown('set value', '0');
	       	$('#versao').dropdown('set value', '0');
	       	$('#marca').dropdown('set text', 'Marca');
	       	$('#modelo').dropdown('set text', 'Modelo');
	       	$('#versao').dropdown('set text', 'Versão');
	       	$("#lb_item").html('Nada');
	       	$("#nome").val("");
		   	$("#url").val("");
		}
	});
	$("#marca").change(function() {
		if ($("#marca").val() != 0 && $("#marca").val() != null) {
			Recarregar_Modelos();
	        $("#versao").html('<option value="0">Versão</option>');
	        $('#modelo').dropdown('set value', '0');
        	$('#versao').dropdown('set value', '0');
        	$('#modelo').dropdown('set text', 'Modelo');
        	$('#versao').dropdown('set text', 'Versão');
        	$("#lb_item").html('Marca');
	        Sincronizar_Marca();
		} else if ($("#categoria").val() != 0 && $("#categoria").val() != null) {
			$("#modelo").html('<option value="0">Modelo</option>');
			$("#versao").html('<option value="0">Versão</option>');
			$('#modelo').dropdown('set value', '0');
        	$('#versao').dropdown('set value', '0');
        	$('#modelo').dropdown('set text', 'Modelo');
        	$('#versao').dropdown('set text', 'Versão');
        	$("#lb_item").html('Categoria');
        	Sincronizar_Categoria();
		}
	});
	$("#modelo").change(function() {
		if ($("#modelo").val() != 0 && $("#modelo").val() != null) {
			Recarregar_Versoes();
			$('#versao').dropdown('set value', '0');
        	$('#versao').dropdown('set text', 'Versão');
        	$("#lb_item").html('Modelo');
	        Sincronizar_Modelo();
		} else if ($("#marca").val() != 0 && $("#marca").val() != null) {
			$("#versao").html('<option value="0">Versão</option>');
			$('#versao').dropdown('set value', '0');
        	$('#versao').dropdown('set text', 'Versão');
        	$("#lb_item").html('Marca');
        	Sincronizar_Marca();
		}
	});
	$("#versao").change(function() {
		if ($("#versao").val() != 0 && $("#versao").val() != null) {
	        $("#lb_item").html('Versão');
	        Sincronizar_Versao();
		} else if ($("#modelo").val() != 0 && $("#modelo").val() != null) {
        	$("#lb_item").html('Modelo');
        	Sincronizar_Modelo();
		}
	});
});
function Recarregar_Categoria() {
	$("#categoria").html('<option>Carregando...</option>');
	$.ajax({
		type: "GET",
		url: "/admin/controle/base-de-conhecimento/cmmv/deletar/categorias/",
		async: false,
	}).done(function(valor) {
		$("#categoria").html(valor);
		$('#categoria').dropdown('set value', '0');
		$('#categoria').dropdown('set text', 'Categoria');
		$("#lb_item").html('Nada');
		$("#nome").val("");
	   	$("#url").val("");
	});
}
function Recarregar_Marcas() {
	$("#marca").html('<option>Carregando...</option>');
	$.ajax({
		type: "GET",
		url: "/admin/controle/base-de-conhecimento/cmmv/deletar/marcas/",
		async: false,
		data: {
		    categoria:$("#categoria").val(),
		}
	}).done(function(valor) {
		$("#marca").html(valor);
		$('#marca').dropdown('set value', '0');
		$('#marca').dropdown('set text', 'Marca');
		$("#lb_item").html('Categoria');
		Sincronizar_Categoria();
	});
}
function Recarregar_Modelos() {
	$("#modelo").html('<option>Carregando...</option>');
	$.ajax({
		type: "GET",
		url: "/admin/controle/base-de-conhecimento/cmmv/deletar/modelos/",
		async: false,
		data: {
			marca:$("#marca").val()
		}
	}).done(function(valor) {
		$("#modelo").html(valor);
		$('#modelo').dropdown('set value', '0');
		$('#modelo').dropdown('set text', 'Modelo');
		$("#lb_item").html('Marca');
		Sincronizar_Marca()
	});
}
function Recarregar_Versoes() {
	$("#versao").html('<option>Carregando...</option>');
	$.ajax({
		type: "GET",
		url: "/admin/controle/base-de-conhecimento/cmmv/deletar/versoes/",
		async: false,
		data: {
			modelo:$("#modelo").val()
		}
	}).done(function(valor) {
		$("#versao").html(valor);
		$('#versao').dropdown('set value', '0');
		$('#versao').dropdown('set text', 'Versão');
		$("#lb_item").html('Modelo');
		Sincronizar_Modelo();
	});
}
$(document).ready(function( ) {
	$("#nome").keyup(function() {
		$("#url").val(retira_acentos($("#nome").val()));
	});
});
function Sincronizar_Categoria() {
	$.get('/admin/controle/base-de-conhecimento/cmmv/deletar/categoria/', 
	{categoria:$("#categoria").val()},
	function(valor) {
		var categoria = JSON.parse(valor);
	   	$("#nome").val(categoria.nome);
	   	$("#url").val(categoria.url);
	});
}
function Sincronizar_Marca() {
	$.get('/admin/controle/base-de-conhecimento/cmmv/deletar/marca/', 
	{marca:$("#marca").val()},
	function(valor) {
		var marca = JSON.parse(valor);
	   	$("#nome").val(marca.nome);
	   	$("#url").val(marca.url);
	});
}
function Sincronizar_Modelo() {
	$.get('/admin/controle/base-de-conhecimento/cmmv/deletar/modelo/', 
	{modelo:$("#modelo").val()},
	function(valor) {
		var modelo = JSON.parse(valor);
	   	$("#nome").val(modelo.nome);
	   	$("#url").val(modelo.url);
	});
}
function Sincronizar_Versao() {
	$.get('/admin/controle/base-de-conhecimento/cmmv/deletar/versao/', 
	{versao:$("#versao").val()},
	function(valor) {
		var versao = JSON.parse(valor);
	   	$("#nome").val(versao.nome);
	   	$("#url").val(versao.url);
	});
}
function retira_acentos(palavra) {
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
	$("#salvar").addClass("disabled loading");
	$.ajax({
		url: "/admin/controle/base-de-conhecimento/cmmv/deletar/",
		type: "POST",
		async: false,
		data: {
		    categoria:$("#categoria").val(),
		    marca:$("#marca").val(),
		    modelo:$("#modelo").val(),
		    versao:$("#versao").val(),
		    nome:$("#nome").val(),
		    url:$("#url").val()
		}
	}).done(function(valor) {
		$("#div_msg").html(valor);
	});
	var item = $("#lb_item").html();
	if (item == 'Categoria') {
		Recarregar_Categoria();
	} else if (item == 'Marca') {
		Recarregar_Marcas();
	} else if (item == 'Modelo') {
		Recarregar_Modelos();
	} else if (item == 'Versão') {
		Recarregar_Versoes();
	}
	$( "#salvar" ).removeClass("disabled loading");
}
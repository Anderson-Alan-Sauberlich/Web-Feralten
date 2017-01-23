$(document).ready(function() {
	$('.ui.dropdown').dropdown('save defaults');
});
$(document).ready(function( ) {
	$("#categoria").change(function() {
		if ($("#categoria").val() != 0 && $("#categoria").val() != null) {
			Recarregar_Marcas();
			$("#modelo").html('<option value="0">Modelo</option>');
	       	$("#versao").html('<option value="0">Versão</option>');
	       	$('#marca').dropdown('restore default value');
	       	$('#modelo').dropdown('restore default value');
	       	$('#versao').dropdown('restore default value');
	       	$('#marca').dropdown('restore default text');
	       	$('#modelo').dropdown('restore default text');
	       	$('#versao').dropdown('restore default text');
	       	$("#lb_item").html('Categoria');
		    Sincronizar_Categoria();
		} else if (true) {
			$("#marca").html('<option value="0">Marca</option>');
			$("#modelo").html('<option value="0">Modelo</option>');
	       	$("#versao").html('<option value="0">Versão</option>');
	       	$('#marca').dropdown('restore default value');
	       	$('#modelo').dropdown('restore default value');
	       	$('#versao').dropdown('restore default value');
	       	$('#marca').dropdown('restore default text');
	       	$('#modelo').dropdown('restore default text');
	       	$('#versao').dropdown('restore default text');
	       	$("#lb_item").html('Nada');
	       	$("#nome").val("");
		   	$("#url").val("");
		}
	});
	$("#marca").change(function() {
		if ($("#marca").val() != 0 && $("#marca").val() != null) {
			Recarregar_Modelos();
	        $("#versao").html('<option value="0">Versão</option>');
        	$('#modelo').dropdown('restore default value');
        	$('#versao').dropdown('restore default value');
        	$('#modelo').dropdown('restore default text');
        	$('#versao').dropdown('restore default text');
        	$("#lb_item").html('Marca');
	        Sincronizar_Marca();
		} else if ($("#categoria").val() != 0 && $("#categoria").val() != null) {
			$("#modelo").html('<option value="0">Modelo</option>');
			$("#versao").html('<option value="0">Versão</option>');
        	$('#modelo').dropdown('restore default value');
        	$('#versao').dropdown('restore default value');
        	$('#modelo').dropdown('restore default text');
        	$('#versao').dropdown('restore default text');
        	$("#lb_item").html('Categoria');
        	Sincronizar_Categoria();
		}
	});
	$("#modelo").change(function() {
		if ($("#modelo").val() != 0 && $("#modelo").val() != null) {
			Recarregar_Versoes();
			$('#versao').dropdown('restore default value');
        	$('#versao').dropdown('restore default text');
        	$("#lb_item").html('Modelo');
	        Sincronizar_Modelo();
		} else if ($("#marca").val() != 0 && $("#marca").val() != null) {
			$("#versao").html('<option value="0">Versão</option>');
        	$('#versao').dropdown('restore default value');
        	$('#versao').dropdown('restore default text');
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
	$.get('/admin/controle/base-de-conhecimento/cmmv/alterar/categorias/', 
	function(valor) {        	
		$("#categoria").html(valor);
	});
}
function Recarregar_Marcas() {
	$("#marca").html('<option>Carregando...</option>');
	$.get('/admin/controle/base-de-conhecimento/cmmv/alterar/marcas/', 
	{categoria:$("#categoria").val()},
	function(valor) {
		$("#marca").html(valor);
	});
}
function Recarregar_Modelos() {
	$("#modelo").html('<option>Carregando...</option>');
	$.get('/admin/controle/base-de-conhecimento/cmmv/alterar/modelos/', 
	{marca:$("#marca").val()},
	function(valor) {
		$("#modelo").html(valor);
	});
}
function Recarregar_Versoes() {
	$("#versao").html('<option>Carregando...</option>');
	$.get('/admin/controle/base-de-conhecimento/cmmv/alterar/versoes/', 
	{modelo:$("#modelo").val()},
	function(valor) {
		$("#versao").html(valor);
	});
}
$(document).ready(function( ) {
	$("#nome").keyup(function() {
		$("#url").val(retira_acentos($("#nome").val()));
	});
});
function Sincronizar_Categoria() {
	$.get('/admin/controle/base-de-conhecimento/cmmv/alterar/categoria/', 
	{categoria:$("#categoria").val()},
	function(valor) {
		var categoria = JSON.parse(valor);
	   	$("#nome").val(categoria.nome);
	   	$("#url").val(categoria.url);
	});
}
function Sincronizar_Marca() {
	$.get('/admin/controle/base-de-conhecimento/cmmv/alterar/marca/', 
	{marca:$("#marca").val()},
	function(valor) {
		var marca = JSON.parse(valor);
	   	$("#nome").val(marca.nome);
	   	$("#url").val(marca.url);
	});
}
function Sincronizar_Modelo() {
	$.get('/admin/controle/base-de-conhecimento/cmmv/alterar/modelo/', 
	{modelo:$("#modelo").val()},
	function(valor) {
		var modelo = JSON.parse(valor);
	   	$("#nome").val(modelo.nome);
	   	$("#url").val(modelo.url);
	});
}
function Sincronizar_Versao() {
	$.get('/admin/controle/base-de-conhecimento/cmmv/alterar/versao/', 
	{versao:$("#versao").val()},
	function(valor) {
		var versao = JSON.parse(valor);
	   	$("#nome").val(versao.nome);
	   	$("#url").val(versao.url);
	});
}
function retira_acentos(palavra) {
	com_acento = '/.áàãâäéèêëíìîïóòõôöúùûüçÁÀÃÂÄÉÈÊËÍÌÎÏÓÒÕÖÔÚÙÛÜÇ ';
	sem_acento = '--aaaaaeeeeiiiiooooouuuucAAAAAEEEEIIIIOOOOOUUUUC-';
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
	$("#salvar").addClass("disabled loading");
	$.ajax({
		type: "POST",
		url: "/admin/controle/base-de-conhecimento/cmmv/alterar/",
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
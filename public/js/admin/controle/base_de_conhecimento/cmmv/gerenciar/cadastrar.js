function Cad_Reset() {
	Cad_Recarregar_Categoria();
	$("#cad_categoria").dropdown('set value', '0');
	$("#cad_categoria").dropdown('set text', 'Categoria');
	Cad_Reset_Categoria();
	Cad_Reset_Marca();
	Cad_Reset_Modelo();
}
function Cad_Reset_Categoria() {
	if ($("#cad_categoria").val() != 0 && $("#cad_categoria").val() != null) {
		Cad_Recarregar_Marcas();
	    $("#cad_modelo").html('<option value="0">Modelo</option>');
       	$("#cad_versao").html('<option value="0">Versão</option>');
       	$('#cad_marca').dropdown('set value', '0');
       	$('#cad_modelo').dropdown('set value', '0');
       	$('#cad_versao').dropdown('set value', '0');
       	$('#cad_marca').dropdown('set text', 'Marca');
       	$('#cad_modelo').dropdown('set text', 'Modelo');
       	$('#cad_versao').dropdown('set text', 'Versão');
       	$("#cad_lb_item").html('Marca');
	} else {
		$("#cad_marca").html('<option value="0">Marca</option>');
		$("#cad_modelo").html('<option value="0">Modelo</option>');
       	$("#cad_versao").html('<option value="0">Versão</option>');
       	$('#cad_marca').dropdown('set value', '0');
       	$('#cad_modelo').dropdown('set value', '0');
       	$('#cad_versao').dropdown('set value', '0');
       	$('#cad_marca').dropdown('set text', 'Marca');
       	$('#cad_modelo').dropdown('set text', 'Modelo');
       	$('#cad_versao').dropdown('set text', 'Versão');
       	$("#cad_lb_item").html('Categoria');
	}
}
function Cad_Reset_Marca() {
	if ($("#cad_marca").val() != 0 && $("#cad_marca").val() != null) {
		Cad_Recarregar_Modelos();
        $("#cad_versao").html('<option value="0">Versão</option>');
       	$('#cad_modelo').dropdown('set value', '0');
       	$('#cad_versao').dropdown('set value', '0');
       	$('#cad_modelo').dropdown('set text', 'Modelo');
       	$('#cad_versao').dropdown('set text', 'Versão');
       	$("#cad_lb_item").html('Modelo');
	} else if ($("#cad_categoria").val() != 0 && $("#cad_categoria").val() != null) {
		$("#cad_modelo").html('<option value="0">Modelo</option>');
		$("#cad_versao").html('<option value="0">Versão</option>');
       	$('#cad_modelo').dropdown('set value', '0');
       	$('#cad_versao').dropdown('set value', '0');
       	$('#cad_modelo').dropdown('set text', 'Modelo');
       	$('#cad_versao').dropdown('set text', 'Versão');
       	$("#cad_lb_item").html('Marca');
	}
}
function Cad_Reset_Modelo() {
	if ($("#cad_modelo").val() != 0 && $("#cad_modelo").val() != null) {
		Cad_Recarregar_Versoes();
        $('#cad_versao').dropdown('set value', '0');
       	$('#cad_versao').dropdown('set text', 'Versão');
       	$("#cad_lb_item").html('Versão');
	} else if ($("#cad_marca").val() != 0 && $("#cad_marca").val() != null) {
		$("#cad_versao").html('<option value="0">Versão</option>');
       	$('#cad_versao').dropdown('set value', '0');
       	$('#cad_versao').dropdown('set text', 'Versão');
       	$("#cad_lb_item").html('Modelo');
	}
}
$("#cad_categoria").change(function() {
	Cad_Reset_Categoria();
});
$("#cad_marca").change(function() {
	Cad_Reset_Marca();
});
$("#cad_modelo").change(function() {
	Cad_Reset_Modelo();
});
function Cad_Recarregar_Categoria() {
	$("#cad_categoria").html('<option>Carregando...</option>');
	$.ajax({
		type: "GET",
		url: "/admin/controle/base-de-conhecimento/cmmv/cadastrar/categorias/",
		async: false,
	}).done(function(valor) {
		$("#cad_categoria").html(valor);
	});
}
function Cad_Recarregar_Marcas() {
	$("#cad_marca").html('<option>Carregando...</option>');
	$.ajax({
		type: "GET",
		url: "/admin/controle/base-de-conhecimento/cmmv/cadastrar/marcas/",
		async: false,
		data: {
		    categoria:$("#cad_categoria").val()
		}
	}).done(function(valor) {
		$("#cad_marca").html(valor);
	});
}
function Cad_Recarregar_Modelos() {
	$("#cad_modelo").html('<option>Carregando...</option>');
	$.ajax({
		type: "GET",
		url: "/admin/controle/base-de-conhecimento/cmmv/cadastrar/modelos/",
		async: false,
		data: {
			marca:$("#cad_marca").val()
		}
	}).done(function(valor) {
		$("#cad_modelo").html(valor);
	});
}
function Cad_Recarregar_Versoes() {
	$("#cad_versao").html('<option>Carregando...</option>');
	$.ajax({
		type: "GET",
		url: "/admin/controle/base-de-conhecimento/cmmv/cadastrar/versoes/",
		async: false,
		data: {
			modelo:$("#cad_modelo").val()
		}
	}).done(function(valor) {
		$("#cad_versao").html(valor);
	});
}
$(document).ready(function( ) {
	$("#cad_nome").keyup(function() {
		$("#cad_url").val(cad_retira_acentos($("#cad_nome").val()));
	});
});
function cad_retira_acentos(palavra) {
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
function SalvarCadastrar() {
	$("#cad_salvar").addClass("disabled loading");
	$.ajax({
		type: "POST",
		url: "/admin/controle/base-de-conhecimento/cmmv/cadastrar/",
		async: false,
		data: {
		    categoria:$("#cad_categoria").val(),
		    marca:$("#cad_marca").val(),
		    modelo:$("#cad_modelo").val(),
		    versao:$("#cad_versao").val(),
		    nome:$("#cad_nome").val(),
		    url:$("#cad_url").val()
		}
	}).done(function(valor) {
		$("#cad_div_msg").html(valor);
	});
	var item = $("#cad_lb_item").html();
	if (item == 'Categoria') {
		Cad_Recarregar_Categoria();
	} else if (item == 'Marca') {
		Cad_Recarregar_Marcas();
	} else if (item == 'Modelo') {
		Cad_Recarregar_Modelos();
	} else if (item == 'Versão') {
		Cad_Recarregar_Versoes();
	}
	$( "#cad_salvar" ).removeClass("disabled loading");
}
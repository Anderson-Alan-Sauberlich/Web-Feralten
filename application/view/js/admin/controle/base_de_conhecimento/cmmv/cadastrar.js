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
	       	$("#lb_item").html('Marca');
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
	       	$("#lb_item").html('Categoria');
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
        	$("#lb_item").html('Modelo');
		} else if ($("#categoria").val() != 0 && $("#categoria").val() != null) {
			$("#modelo").html('<option value="0">Modelo</option>');
			$("#versao").html('<option value="0">Versão</option>');
        	$('#modelo').dropdown('restore default value');
        	$('#versao').dropdown('restore default value');
        	$('#modelo').dropdown('restore default text');
        	$('#versao').dropdown('restore default text');
        	$("#lb_item").html('Marca');
		}
	});
	$("#modelo").change(function() {
		if ($("#modelo").val() != 0 && $("#modelo").val() != null) {
			Recarregar_Versoes();
	        $('#versao').dropdown('restore default value');
        	$('#versao').dropdown('restore default text');
        	$("#lb_item").html('Versão');
		} else if ($("#marca").val() != 0 && $("#marca").val() != null) {
			$("#versao").html('<option value="0">Versão</option>');
        	$('#versao').dropdown('restore default value');
        	$('#versao').dropdown('restore default text');
        	$("#lb_item").html('Modelo');
		}
	});
});
function Recarregar_Categoria() {
	$("#categoria").html('<option>Carregando...</option>');
	$.ajax({
		type: "GET",
		url: "/admin/controle/base-de-conhecimento/cmmv/cadastrar/categorias/",
		async: false,
	}).done(function(valor) {
		$("#categoria").html(valor);
	});
}
function Recarregar_Marcas() {
	$("#marca").html('<option>Carregando...</option>');
	$.ajax({
		type: "GET",
		url: "/admin/controle/base-de-conhecimento/cmmv/cadastrar/marcas/",
		async: false,
		data: {
		    categoria:$("#categoria").val(),
		}
	}).done(function(valor) {
		$("#marca").html(valor);
	});
}
function Recarregar_Modelos() {
	$("#modelo").html('<option>Carregando...</option>');
	$.ajax({
		type: "GET",
		url: "/admin/controle/base-de-conhecimento/cmmv/cadastrar/modelos/",
		async: false,
		data: {
			marca:$("#marca").val()
		}
	}).done(function(valor) {
		$("#modelo").html(valor);
	});
}
function Recarregar_Versoes() {
	$("#versao").html('<option>Carregando...</option>');
	$.ajax({
		type: "GET",
		url: "/admin/controle/base-de-conhecimento/cmmv/cadastrar/versoes/",
		async: false,
		data: {
			modelo:$("#modelo").val()
		}
	}).done(function(valor) {
		$("#versao").html(valor);
	});
}
$(document).ready(function( ) {
	$("#nome").keyup(function() {
		$("#url").val(retira_acentos($("#nome").val()));
	});
});
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
function SalvarCadastrar() {
	$("#salvar").addClass("disabled loading");
	$.ajax({
		type: "POST",
		url: "/admin/controle/base-de-conhecimento/cmmv/cadastrar/",
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
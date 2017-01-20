$(document).ready(function() {
	$('.ui.dropdown').dropdown('save defaults');
});
$(document).ready(function( ) {
	$("#categoria").change(function() {
		if ($("#categoria").val() != 0 && $("#categoria").val() != null) {
			$("#marca").html('<option>Carregando...</option>');
		    $.get('/admin/controle/base-de-conhecimento/cmmv/deletar/marcas/', 
		    {categoria:$("#categoria").val()},
		    function(valor) {        	
		       	$("#marca").html(valor);
		       	$("#modelo").html('<option value="0">Modelo</option>');
		       	$("#versao").html('<option value="0">Versão</option>');
		       	$('#marca').dropdown('restore default value');
		       	$('#modelo').dropdown('restore default value');
		       	$('#versao').dropdown('restore default value');
		       	$('#marca').dropdown('restore default text');
		       	$('#modelo').dropdown('restore default text');
		       	$('#versao').dropdown('restore default text');
		       	$("#lb_item").html('Categoria');
		    });
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
			$("#modelo").html('<option>Carregando...</option>');
	        $.get('/admin/controle/base-de-conhecimento/cmmv/deletar/modelos/', 
	        {marca:$("#marca").val()},
	        function(valor) {
	        	$("#modelo").html(valor);
	        	$("#versao").html('<option value="0">Versão</option>');
	        	$('#modelo').dropdown('restore default value');
	        	$('#versao').dropdown('restore default value');
	        	$('#modelo').dropdown('restore default text');
	        	$('#versao').dropdown('restore default text');
	        	$("#lb_item").html('Marca');
	        });
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
	    	$("#versao").html('<option>Carregando...</option>');
	        $.get('/admin/controle/base-de-conhecimento/cmmv/deletar/versoes/', 
	        {modelo:$("#modelo").val()},
	        function(valor) {
	        	$("#versao").html(valor);
	        	$('#versao').dropdown('restore default value');
	        	$('#versao').dropdown('restore default text');
	        	$("#lb_item").html('Modelo');
	        });
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
function SalvarDeletar() {
	$("#salvar").addClass("disabled loading");
	$.ajax({
		type: "POST",
		url: "/admin/controle/base-de-conhecimento/cmmv/deletar/",
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
	$( "#salvar" ).removeClass("disabled loading");
}
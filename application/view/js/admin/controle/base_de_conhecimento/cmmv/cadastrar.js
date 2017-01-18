$(document).ready(function() {
	$('.ui.dropdown').dropdown('save defaults');
});
$(document).ready(function( ) {
	$("#categoria").change(function() {
		if ($("#categoria").val() != 0 && $("#marca").val() != null) {
			$("#marca").html('<option>Carregando...</option>');
		    $.get('/admin/controle/base-de-conhecimento/cmmv/cadastrar/marcas/', 
		    {categoria:$(this).val()},
		    function(valor) {        	
		       	$("#marca").html(valor);
		       	$("#modelo").html('<option value="0">Modelo</option>');
		       	$("#versao").html('<option value="0">Versão</option>');
		       	$('#marca').dropdown('restore defaults');
		       	$('#modelo').dropdown('restore defaults');
		       	$('#versao').dropdown('restore defaults');
		    });
		} else {
			$("#marca").html('<option value="0">Marca</option>');
			$("#modelo").html('<option value="0">Modelo</option>');
	       	$("#versao").html('<option value="0">Versão</option>');
	       	$('#marca').dropdown('restore defaults');
	       	$('#modelo').dropdown('restore defaults');
	       	$('#versao').dropdown('restore defaults');
		}
	});
	$("#marca").change(function() {
		if ($("#marca").val() != 0 && $("#marca").val() != null) {
			$("#modelo").html('<option>Carregando...</option>');
	        $.get('/admin/controle/base-de-conhecimento/cmmv/cadastrar/modelos/', 
	        {marca:$("#marca").val()},
	        function(valor) {
	        	$("#modelo").html(valor);
	        	$("#versao").html('<option value="0">Versão</option>');
	        	$('#modelo').dropdown('restore defaults');
	        	$('#versao').dropdown('restore defaults');
	        });
		} else {
			$("#modelo").html('<option value="0">Modelo</option>');
			$("#versao").html('<option value="0">Versão</option>');
        	$('#modelo').dropdown('restore defaults');
        	$('#versao').dropdown('restore defaults');
		}
	});
	$("#modelo").change(function() {
		if ($("#modelo").val() != 0 && $("#modelo").val() != null) {
	    	$("#versao").html('<option>Carregando...</option>');
	        $.get('/admin/controle/base-de-conhecimento/cmmv/cadastrar/versoes/', 
	        {modelo:$("#modelo").val()},
	        function(valor) {
	        	$("#versao").html(valor);
	        	$('#versao').dropdown('restore defaults');
	        });
		} else {
			$("#versao").html('<option value="0">Versão</option>');
        	$('#versao').dropdown('restore defaults');
		}
		
		VerificarStatusItem();
	});
});
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
function VerificarStatusItem() {
	if ($("#categoria").val() == 0) {
    	$("#lb_item").html('<h3>Categoria</h3>');
    } else if ($("#marca").val() == 0) {
    	$("#lb_item").html('<h3>Marca</h3>');
    } else if ($("#modelo").val() == 0) {
    	$("#lb_item").html('<h3>Modelo</h3>');
    } else {
    	$("#lb_item").html('<h3>Versão</h3>');
    }
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
	$( "#salvar" ).removeClass("disabled loading");
}
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
	        
	    VerificarStatusItem();
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
		
		VerificarStatusItem();
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
function VerificarStatusItem() {
	if ($("#categoria").val() == 0) {
    	$("#lb_item").html('Categoria');
    } else if ($("#marca").val() == 0) {
    	$("#lb_item").html('Marca');
    } else if ($("#modelo").val() == 0) {
    	$("#lb_item").html('Modelo');
    } else {
    	$("#lb_item").html('Versão');
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
	});
	
	$( "#salvar" ).removeClass("disabled loading");
}
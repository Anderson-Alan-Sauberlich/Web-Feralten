$(document).ready(function() {
	$('.ui.dropdown').dropdown('save defaults');
});
$(document).ready(function( ) {
	$("#categoria").change(function() {
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
        
        VerificarStatusItem();
	});
	$("#marca").change(function() {
		$("#modelo").html('<option>Carregando...</option>');
        $.get('/admin/controle/base-de-conhecimento/cmmv/cadastrar/modelos/', 
        {marca:$(this).val()},
        function(valor) {
        	$("#modelo").html(valor);
        	$("#versao").html('<option value="0">Versão</option>');
        	$('#modelo').dropdown('restore defaults');
        	$('#versao').dropdown('restore defaults');
        });
        
        VerificarStatusItem();
	});
	$("#modelo").change(function() {
    	$("#versao").html('<option>Carregando...</option>');
        $.get('/admin/controle/base-de-conhecimento/cmmv/cadastrar/versoes/', 
        {modelo:$(this).val()},
        function(valor) {
        	$("#versao").html(valor);
        	$('#versao').dropdown('restore defaults');
        });
        
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
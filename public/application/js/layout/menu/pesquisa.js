$('#categoria').accordion();
$('#content_categoria .ui.checkbox').checkbox({uncheckable: true});
$('#marca').dropdown({message: {noResults: "Nenhum Resultado..."}});
$('#modelo').dropdown({message: {noResults: "Nenhum Resultado..."}});
$('#versao').dropdown({fullTextSearch: true, message: {noResults: "Nenhum Resultado..."}});
$('#ano_de').dropdown({message: {noResults: "Nenhum Resultado..."}});
$('#ano_ate').dropdown({message: {noResults: "Nenhum Resultado..."}});
function Carregar_Categoria(ca) {
	var $input_ctg = $("input[name='categoria']:checked").val();
	if ($(ca).val() != 0 && $(ca).val() != null && $(ca).val() != undefined && $input_ctg != 0 && $input_ctg != null && $input_ctg != undefined) {
	    $("#marca").html('<option>Carregando...</option>');
	    $.get('/layout/menu/pesquisa/marca/', 
	    {categoria:$(ca).val()},
	    function(valor) {
	        $("#marca").html(valor);
	        $("#modelo").html('<option value="0">Modelo</option>');
	        $("#versao").html('<option value="0">Versão</option>');
	        $('#marca').dropdown('set text', 'Marca');
	        $('#modelo').dropdown('set text', 'Modelo');
	       	$('#versao').dropdown('set text', 'Versão');
	       	$('#marca').dropdown('set value', '0');
	        $('#modelo').dropdown('set value', '0');
	       	$('#versao').dropdown('set value', '0');
	       	$('#categoria').accordion('close', 0);
	    });
	} else {
		$("#marca").html('<option value="0">Marca</option>');
		$("#modelo").html('<option value="0">Modelo</option>');
        $("#versao").html('<option value="0">Versão</option>');
        $('#marca').dropdown('set text', 'Marca');
        $('#modelo').dropdown('set text', 'Modelo');
       	$('#versao').dropdown('set text', 'Versão');
       	$('#marca').dropdown('set value', '0');
        $('#modelo').dropdown('set value', '0');
       	$('#versao').dropdown('set value', '0');
	}
}
$(document).ready(function( ) {
	$("#marca").change(function() {
		if ($(this).val() != 0 && $(this).val() != null && $(this).val() != undefined) {
	    	$("#modelo").html('<option>Carregando...</option>');
	        $.get('/layout/menu/pesquisa/modelo/', 
	        {marca:$(this).val()},
	        function(valor) {
	        	$("#modelo").html(valor);
	        	$("#versao").html('<option value="0">Versão</option>');
	        	$('#modelo').dropdown('set text', 'Modelo');
	           	$('#versao').dropdown('set text', 'Versão');
	            $('#modelo').dropdown('set value', '0');
	           	$('#versao').dropdown('set value', '0');
	        });
		} else {
			$("#modelo").html('<option value="0">Modelo</option>');
			$("#versao").html('<option value="0">Versão</option>');
        	$('#modelo').dropdown('set text', 'Modelo');
           	$('#versao').dropdown('set text', 'Versão');
            $('#modelo').dropdown('set value', '0');
           	$('#versao').dropdown('set value', '0');
		}
   });
});
$(document).ready(function() {
	$("#modelo").change(function() {
		if ($(this).val() != 0 && $(this).val() != null && $(this).val() != undefined) {
	    	$("#versao").html('<option>Carregando...</option>');
	        $.get('/layout/menu/pesquisa/versao/', 
	        {modelo:$(this).val()},
	        function(valor) {
	        	$("#versao").html(valor);
	        	$('#versao').dropdown('set text', 'Versão');
	           	$('#versao').dropdown('set value', '0');
	        });
		} else {
			$('#versao').dropdown('set text', 'Versão');
           	$('#versao').dropdown('set value', '0');
		}
   });
});
function Pesquisar($bool_p) {
	var base_url = $("#searschform").attr("action");
	var categoria = $("input[name='categoria']:checked").data('url');
	var ano_de = $("#ano_de").val();
	var ano_ate = $("#ano_ate").val();
	var peca = $("#peca").val();
	var ordem_preco = $("#ordem_preco").val();
	var ordem_data = $("#ordem_data").val();
	var estado_uso = $("#estado_uso").find("option:selected").val();
	var status_peca = $("#status_peca").find("option:selected").val();
	var preferencia_entrega = $("#preferencia_entrega").find("option:selected").val();
	var estado = $("#estado").find("option:selected").data('url');
	var cidade = $("#cidade").find("option:selected").data('url');
	
	if (estado != 0 && estado != "" && estado != undefined) {
		base_url = base_url + "em/" + estado + "/";
		
		if (cidade != 0 && cidade != "" && cidade != undefined) {
			base_url = base_url + cidade + "/";
		} else {
			base_url = base_url + "estoque/";
		}
	}
	
	if (categoria != 0 && categoria != "" && categoria != undefined) {
		$("input[name='categoria']:checked").prop('disabled', true);
		$("input[name='categoria']:checked").prop('readonly', true);
		
		base_url = base_url + categoria + "/";
		
		var marca = $("#marca").find("option:selected").data('url');
		
		if (marca != 0 && marca != "" && marca != undefined) {
			base_url = base_url + marca + "/"
			
			var modelo = $("#modelo").find("option:selected").data('url');
			
			if (modelo != 0 && modelo != "" && modelo != undefined) {
				base_url = base_url + modelo + "/"
				
				var versao = $("#versao").find("option:selected").data('url');
				
				if (versao != 0 && versao != "" && versao != undefined) {
					base_url = base_url + versao + "/"
				}
			}
		}
	}
	
	$("#estado").prop('disabled', true);
	$("#estado").prop('readonly', true);
	
	$("#cidade").prop('disabled', true);
	$("#cidade").prop('readonly', true);
	
	$("#recaptcha").remove();
	
	if (ano_de == 0 || ano_de == "" || ano_de == undefined) {
		$("#ano_de").prop('disabled', true);
		$("#ano_de").prop('readonly', true);
	}
	
	if (ano_ate == 0 || ano_ate == "" || ano_ate == undefined) {
		$("#ano_ate").prop('disabled', true);
		$("#ano_ate").prop('readonly', true);
	}
	
	if (peca == 0 || peca == "" || peca == undefined) {
		$("#peca").prop('disabled', true);
		$("#peca").prop('readonly', true);
	}
	
	if (ordem_preco == 0 || ordem_preco == "" || ordem_preco == undefined) {
		$("#ordem_preco").prop('disabled', true);
		$("#ordem_preco").prop('readonly', true);
	}
	
	if (ordem_data == 0 || ordem_data == "" || ordem_data == undefined) {
		$("#ordem_data").prop('disabled', true);
		$("#ordem_data").prop('readonly', true);
	}
	
	if (estado_uso == 0 || estado_uso == "" || estado_uso == undefined) {
		$("#estado_uso").prop('disabled', true);
		$("#estado_uso").prop('readonly', true);
	}
	
	if (status_peca == 0 || status_peca == "" || status_peca == undefined) {
		$("#status_peca").prop('disabled', true);
		$("#status_peca").prop('readonly', true);
	}
	
	if (preferencia_entrega == 0 || preferencia_entrega == "" || preferencia_entrega == undefined) {
		$("#preferencia_entrega").prop('disabled', true);
		$("#preferencia_entrega").prop('readonly', true);
	}
	
	if ($bool_p) {
		var url_p = window.location.search;
		
		if (url_p.indexOf("pagina=") != -1) {
			var p = url_p.split("pagina=")[1];
			
			$("#searschform").append("<input type='hidden' name='pagina' value='"+p+"' />");
		}
	}
	
	$('input[name*=status]').prop('disabled', true);
	$('input[name*=status]').prop('readonly', true);
	
	$('input[name*=deletar]').prop('disabled', true);
	$('input[name*=deletar]').prop('readonly', true);
	
	$('#descricao').prop('disabled', true);
	$('#descricao').prop('readonly', true);
	
	$("#searschform").attr("action", base_url);
	
	$("#searschform").submit();
}
$('.ui.accordion').accordion();
$('.ui.checkbox').checkbox();
$('.ui.dropdown').dropdown({message: {noResults: "Nenhum Resultado..."}});
$(document).ready(function() {
	Accordion_Categoria();
});
function Accordion_Categoria() {
	$('#title_categoria').addClass('active');
	$('#content_categoria').addClass('active');
}
function Carregar_Categoria(ca) {
	if ($(ca).val() != 0 && $(ca).val() != null) {
	    $("#marca").html('<option>Carregando...</option>');
	    $.get('/menu-pesquisa/marca/', 
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
		if ($(this).val() != 0 && $(this).val() != null) {
	    	$("#modelo").html('<option>Carregando...</option>');
	        $.get('/menu-pesquisa/modelo/', 
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
		if ($(this).val() != 0 && $(this).val() != null) {
	    	$("#versao").html('<option>Carregando...</option>');
	        $.get('/menu-pesquisa/versao/', 
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
function Pesquisar() {
	var base_url = $("#searschform").attr("action");
	var categoria = $("input[name='categoria']:checked").data('url');
	var ano_de = $("#ano_de").val();
	var ano_ate = $("#ano_ate").val();
	var peca = $("#peca").val();
	var ordem_preco = $("#ordem_preco").val();
	var ordem_data = $("#ordem_data").val();
	var status = $("#status").val();
	var preferencia_entrega = $("#preferencia_entrega").val();
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
	
	if (status == 0 || status == "" || status == undefined) {
		$("#status").prop('disabled', true);
		$("#status").prop('readonly', true);
	}
	
	if (preferencia_entrega == 0 || preferencia_entrega == "" || preferencia_entrega == undefined) {
		$("#preferencia_entrega").prop('disabled', true);
		$("#preferencia_entrega").prop('readonly', true);
	}
	
	$("#searschform").attr("action", base_url);
	
	$("#searschform").submit();
}
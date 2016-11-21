function Carregar_Categoria(ca) {
    $("#marca").html('<option>Carregando...</option>');
    $.get('/menu-pesquisa/marca/', 
    {categoria:$(ca).val()},
    function(valor) {
        $("#marca").html(valor);
        $("#modelo").html('<option value="0">Modelo</option>');
        $("#versao").html('<option value="0">Versão</option>');
    });
}
$(document).ready(function( ) {
	$("#marca").change(function() {
    	$("#modelo").html('<option>Carregando...</option>');
        $.get('/menu-pesquisa/modelo/', 
        {marca:$(this).val()},
        function(valor) {
        	$("#modelo").html(valor);
        	$("#versao").html('<option value="0">Versão</option>');
        });
   });
});
$(document).ready(function() {
	$("#modelo").change(function() {
    	$("#versao").html('<option>Carregando...</option>');
        $.get('/menu-pesquisa/versao/', 
        {modelo:$(this).val()},
        function(valor) {
        	$("#versao").html(valor);
        });
   });
});
$(document).ready(function() {
	$('.ui.accordion').accordion();
	$('.ui.checkbox').checkbox();
	$('.ui.dropdown').dropdown();
});
function Pesquisar() {
	var base_url = $("#searschform").attr("action");
	var categoria = $("input[name='categoria']:checked").val();
	var ano_de = $("#ano_de").val();
	var ano_ate = $("#ano_ate").val();
	var peca = $("#peca").val();
	
	if (categoria != 0 && categoria != "" && categoria != undefined) {
		$("input[name='categoria']:checked").prop('disabled', true);
		$("input[name='categoria']:checked").prop('readonly', true);
		
		base_url = base_url + categoria + "/";
		
		var marca = $("#marca").val();
		
		if (marca != 0 && marca != "" && marca != undefined) {
			base_url = base_url + marca + "/"
			
			var modelo = $("#modelo").val();
			
			if (modelo != 0 && modelo != "" && modelo != undefined) {
				base_url = base_url + modelo + "/"
				
				var versao = $("#versao").val();
				
				if (versao != 0 && versao != "" && versao != undefined) {
					base_url = base_url + versao + "/"
				}
			}
		}
	}
	
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
	
	$("#searschform").attr("action", base_url);
	
	$("#searschform").submit();
}
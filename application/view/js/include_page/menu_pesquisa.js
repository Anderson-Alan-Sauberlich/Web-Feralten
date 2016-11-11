$(document).ready(function() {
	$("#categoria").change(function() {
    	$("#marca").html('<option>Carregando...</option>');
        $.get('/menu-pesquisa/marca/', 
        {categoria:$(this).val()},
        function(valor) {
        	$("#marca").html(valor);
        });
   });
});
$(document).ready(function( ) {
	$("#marca").change(function() {
    	$("#modelo").html('<option>Carregando...</option>');
        $.get('/menu-pesquisa/modelo/', 
        {marca:$(this).val()},
        function(valor) {
        	$("#modelo").html(valor);
        });
   });
});
$(document).ready(function() {
	$('.ui.accordion').accordion();
	$('.ui.checkbox').checkbox();
	$('.ui.dropdown').dropdown();
});
function Pesquisar() {
	if ($("#categoria").val() != 0 && $("#categoria").val() != "") {
		$("#searschform").attr("action", $("#searschform").attr("action") + $("#categoria").val() + "/");
		
		if ($("#marca").val() != 0 && $("#marca").val() != "") {
			$("#searschform").attr("action", $("#searschform").attr("action") + $("#marca").val() + "/");
			
			if ($("#modelo").val() != 0 && $("#modelo").val() != "") {
				$("#searschform").attr("action", $("#searschform").attr("action") + $("#modelo").val() + "/");
			}
		}
	}
	
	if ($("#ano_de").val() != 0 && $("#ano_de").val() != "") {
		$("#searschform").attr("action", $("#searschform").attr("action") + "de-" + $("#ano_de").val() + "/");
	}
	
	if ($("#ano_ate").val() != 0 && $("#ano_ate").val() != "") {
		$("#searschform").attr("action", $("#searschform").attr("action") + "ate-" + $("#ano_ate").val() + "/");
	}
	
	if ($("#peca").val() != 0 && $("#peca").val() != "") {
		$("#searschform").attr("action", $("#searschform").attr("action") + $("#peca").val() + "/");
	}
	
	$("#searschform").submit();
}
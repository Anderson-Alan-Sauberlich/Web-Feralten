$(document).ready(function(){
	$("#categoria").change(function(){
    	$("#marca").html('<option>Carregando...</option>');
        $.get('/menu_pesquisa/', 
        {categoria:$(this).val()},
        function(valor){
        	$("#marca").html(valor);
        });
   });
});
$(document).ready(function(){
	$("#marca").change(function(){
    	$("#modelo").html('<option>Carregando...</option>');
        $.get('/menu_pesquisa/', 
        {marca:$(this).val()},
        function(valor){
        	$("#modelo").html(valor);
        });
   });
});
$(document).ready(function() {
	$('.ui.dropdown').dropdown();
});
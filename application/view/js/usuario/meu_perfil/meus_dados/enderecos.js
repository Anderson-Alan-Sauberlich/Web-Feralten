$(document).ready(function() {
	$('select[name=estado]').change(function(){
    	$('select[name=cidade]').html('<option value="0">Carregando...</option>');
        $.get('/usuario/meu-perfil/meus-dados/enderecos/cidades/', 
        {estado:$(this).val()},
        function(valor){
        	$('select[name=cidade]').html(valor);
        });
   });
});
$(document).ready(function() {
	$('[data-toggle="popover"]').popover();
});
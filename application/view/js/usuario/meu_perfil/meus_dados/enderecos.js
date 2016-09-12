$(document).ready(function() {
	$('select[name=estado]').change(function(){
    	$('select[name=cidade]').html('<option value="0">Carregando...</option>');
        $.post('/application/view/usuario/meu_perfil/meus_dados/enderecos.php', 
        {estado:$(this).val()},
        function(valor){
        	$('select[name=cidade]').html(valor);
        });
   });
});
$(document).ready(function() {
	$('[data-toggle="popover"]').popover();
});
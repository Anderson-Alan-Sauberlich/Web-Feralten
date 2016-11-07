$(document).ready(function(){
	$('select[name=estado]').change(function(){
    	$('select[name=cidade]').html('<option value="0">Carregando...</option>');
        $.get('/usuario/meu-perfil/meus-dados/concluir/cidades/', 
        {estado:$(this).val()},
        function(valor){
        	$('select[name=cidade]').html(valor);
        });
   });
});
var loadFile = function(event) {
	if (event.target.files.length = 1) {
		var imagem = event.target.files[0];
		
		if (imagem != null && imagem.type.match('image.*')) {
			$("#div_img").addClass("active");
			var data1 = new FormData();
			data1.append('imagem',imagem);
			$.ajax({
				url:'/usuario/meu-perfil/meus-dados/concluir/imagem/',
				data:data1,
				processData:false,
				contentType:false,
				async: false,
				type:'POST',
				success:function(valor) {
					document.getElementById('foto').src = valor;
					$("#div_img").removeClass("active");
				}
			});
		} else {
			$("#div_img").removeClass("active");
		}
	}
	
	document.getElementById("imagens").value = "";
};
function limparCampoFile() {
	$("#div_img").addClass("active");
	$.ajax({
		method: "DELETE",
		url: "/usuario/meu-perfil/meus-dados/concluir/imagem/",
	}).done(function() {
		document.getElementById("imagem").value = "";
		document.getElementById("foto").src = "/application/view/resources/img/imagem_indisponivel.png";
		$("#div_img").removeClass("active");
	});
}
$(document).ready(function() {
	$('[data-toggle="popover"]').popover();
});
function MostImgErr($ths) {
	$ths.src='/application/view/resources/img/imagem_indisponivel.png';
}
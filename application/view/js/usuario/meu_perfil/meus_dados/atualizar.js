var loadFile = function(event) {
	if (event.target.files.length <= 3) {
		var imagem1 = event.target.files[0];
		
		if (imagem1 != null && imagem1.type.match('image.*')) {
			$("#div_img").addClass("active");
			var data1 = new FormData();
			data1.append('imagem1',imagem1);
			$.ajax({
				url:'/application/view/usuario/meu_perfil/meus_dados/atualizar.php',
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
	} else {
		alert("Selecione no Maximo Uma Imagem");
	}
	
	document.getElementById("imagens").value = "";
};
function limparCampoFile() {
	$("#div_img").addClass("active");
	$.post("/application/view/usuario/meu_perfil/meus_dados/atualizar.php",
	{del_img:true}).done(function() {
	document.getElementById("imagem").value = "";
	document.getElementById("foto").src = "/resources/img/imagem_Indisponivel.png";
	$("#div_img").removeClass("active");
	});
}
$(document).ready(function() {
	$('#mostrar').on('click', function() {
    	var passwordField = $('#senha');
    	var passwordFieldType = passwordField.attr('type');
    	if(passwordFieldType == 'password'){
        	passwordField.attr('type', 'text');
    	} else {
        	passwordField.attr('type', 'password');
    	}
  	});
});
$(document).ready(function() {
  	$('#mostrarconf').on('click', function() {
    	var passwordField = $('#confsenha');
    	var passwordFieldType = passwordField.attr('type');
    	if(passwordFieldType == 'password'){
        	passwordField.attr('type', 'text');
    	} else {
        	passwordField.attr('type', 'password');
    	}
  	});
});
$(document).ready(function() {
	$('[data-toggle="popover"]').popover();
});
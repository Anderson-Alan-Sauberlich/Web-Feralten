$(document).ready(function() {
	$('.ui.checkbox').checkbox();
	$('.ui.dropdown').dropdown();
	$('#preco').mask('#.##0,00', {reverse: true});
});
function Carregar_Categoria(ca) {
	$.ajax({
		method: "GET",
		url: "/usuario/meu-perfil/pecas/atualizar/compatibilidade/",
		async: false,
		data: { categoria:$(ca).val() }
	}).done(function(valor) {
        $("#div_categoria").html(valor);
        $('#div_categoria .ui.checkbox').checkbox();
	});
	$("#div_marca").html('Carregando...');
	$.ajax({
		method: "GET",
		url: "/usuario/meu-perfil/pecas/atualizar/compatibilidade/",
		async: false,
		data: { categoria:"verificar" }
	}).done(function(valor) {
        $("#div_marca").html(valor);
        $('#div_marca .ui.checkbox').checkbox();
	});
	$("#div_modelo").html('Carregando...');
	$.ajax({
		method: "GET",
		url: "/usuario/meu-perfil/pecas/atualizar/compatibilidade/",
		async: false,
		data: { marca:"verificar" }
	}).done(function(valor) {
        $("#div_modelo").html(valor);
        $('#div_modelo .ui.checkbox').checkbox();
	});
	$("#div_versao").html('Carregando...');
	$.ajax({
		method: "GET",
		url: "/usuario/meu-perfil/pecas/atualizar/compatibilidade/",
		async: false,
		data: { modelo:"verificar" }
	}).done(function(valor) {
        $("#div_versao").html(valor);
        $('#div_versao .ui.checkbox').checkbox();
	});
	$("#div_ano").html('Carregando...');
	$.ajax({
		method: "GET",
		url: "/usuario/meu-perfil/pecas/atualizar/compatibilidade/",
		async: false,
		data: { versao:"verificar" }
	}).done(function(valor) {
		$("#div_ano").html(valor);
		$('.ui.dropdown').dropdown();
	});
}
function Carregar_Marca(ma) {
	$.ajax({
		method: "GET",
		url: "/usuario/meu-perfil/pecas/atualizar/compatibilidade/",
		async: false,
		data: { marca:$(ma).val() }
	}).done(function(valor) {
		$("#div_marca").html(valor);
    	$('#div_marca .ui.checkbox').checkbox();
	});
	$("#div_modelo").html('Carregando...');
	$.ajax({
		method: "GET",
		url: "/usuario/meu-perfil/pecas/atualizar/compatibilidade/",
		async: false,
		data: { marca:"verificar" }
	}).done(function(valor) {
		$("#div_modelo").html(valor);
        $('#div_modelo .ui.checkbox').checkbox();
	});
	$("#div_versao").html('Carregando...');
	$.ajax({
		method: "GET",
		url: "/usuario/meu-perfil/pecas/atualizar/compatibilidade/",
		async: false,
		data: { modelo:"verificar" }
	}).done(function(valor) {
		$("#div_versao").html(valor);
        $('#div_versao .ui.checkbox').checkbox();
	});
	$("#div_ano").html('Carregando...');
	$.ajax({
		method: "GET",
		url: "/usuario/meu-perfil/pecas/atualizar/compatibilidade/",
		async: false,
		data: { versao:"verificar" }
	}).done(function(valor) {
		$("#div_ano").html(valor);
		$('.ui.dropdown').dropdown();
	});
}
function Carregar_Modelo(mo) {
	$.ajax({
		method: "GET",
		url: "/usuario/meu-perfil/pecas/atualizar/compatibilidade/",
		async: false,
		data: { modelo:$(mo).val() }
	}).done(function(valor) {
		$("#div_modelo").html(valor);
    	$('#div_modelo .ui.checkbox').checkbox();
	});
	$("#div_versao").html('Carregando...');
	$.ajax({
		method: "GET",
		url: "/usuario/meu-perfil/pecas/atualizar/compatibilidade/",
		async: false,
		data: { modelo:"verificar" }
	}).done(function(valor) {
		$("#div_versao").html(valor);
        $('#div_versao .ui.checkbox').checkbox();
	});
	$("#div_ano").html('Carregando...');
	$.ajax({
		method: "GET",
		url: "/usuario/meu-perfil/pecas/atualizar/compatibilidade/",
		async: false,
		data: { versao:"verificar" }
	}).done(function(valor) {
		$("#div_ano").html(valor);
		$('.ui.dropdown').dropdown();
	});
}
function Carregar_Versao(vs) {
	$.ajax({
		method: "GET",
		url: "/usuario/meu-perfil/pecas/atualizar/compatibilidade/",
		async: false,
		data: { versao:$(vs).val() }
	}).done(function(valor) {
		$("#div_versao").html(valor);
        $('#div_versao .ui.checkbox').checkbox();
	});
	$("#div_ano").html('Carregando...');
	$.ajax({
		method: "GET",
		url: "/usuario/meu-perfil/pecas/atualizar/compatibilidade/",
		async: false,
		data: { versao:"verificar" }
	}).done(function(valor) {
		$("#div_ano").html(valor);
		$('.ui.dropdown').dropdown();
	});
}
function limparCampoFile(img) {
	if (img == 1) {
		$("#img1").addClass("active");
		$.ajax({
			method: "DELETE",
			url: "/usuario/meu-perfil/pecas/atualizar/imagem/1",
		}).done(function() {
			document.getElementById("foto1").src = document.getElementById("foto2").src;
			document.getElementById("foto2").src = document.getElementById("foto3").src;
			document.getElementById("foto3").src = "/resources/img/imagem_indisponivel.png";
			$("#img1").removeClass("active");
		});
	} else if (img == 2) {
		$("#img2").addClass("active");
		$.ajax({
			method: "DELETE",
			url: "/usuario/meu-perfil/pecas/atualizar/imagem/2",
		}).done(function() {
			document.getElementById("foto2").src = document.getElementById("foto3").src;
			document.getElementById("foto3").src = "/resources/img/imagem_indisponivel.png";
			$("#img2").removeClass("active");
		});
	} else if (img == 3) {
		$("#img3").addClass("active");
		$.ajax({
			method: "DELETE",
			url: "/usuario/meu-perfil/pecas/atualizar/imagem/3",
		}).done(function() {
			document.getElementById("foto3").src = "/resources/img/imagem_indisponivel.png";
			$("#img3").removeClass("active");
		});
	} else if (img == 123) {
		$("#img1").addClass("active");
		$("#img2").addClass("active");
		$("#img3").addClass("active");
		document.getElementById("imagens").value = "";
		$.ajax({
			method: "DELETE",
			url: "/usuario/meu-perfil/pecas/atualizar/imagem/123",
		}).done(function() {
			document.getElementById("foto1").src = "/resources/img/imagem_indisponivel.png";
			document.getElementById("foto2").src = "/resources/img/imagem_indisponivel.png";
			document.getElementById("foto3").src = "/resources/img/imagem_indisponivel.png";
			$("#img1").removeClass("active");
		    $("#img2").removeClass("active");
			$("#img3").removeClass("active");
		});
	}
}
$(document).ready(function() {
	function handleFileSelect(evt) {
		if (evt.target.files.length <= 3) {
			var imagem1 = null;
			var imagem2 = null;
			var imagem3 = null;
			
			if (document.getElementById('foto1').src.indexOf("/resources/img/imagem_indisponivel.png") != -1) {
				var imagem1 = evt.target.files[0];
				var imagem2 = evt.target.files[1];
				var imagem3 = evt.target.files[2];
			} else if (document.getElementById('foto2').src.indexOf("/resources/img/imagem_indisponivel.png") != -1) {
				var imagem2 = evt.target.files[0];
				var imagem3 = evt.target.files[1];
			} else if (document.getElementById('foto3').src.indexOf("/resources/img/imagem_indisponivel.png") != -1) {
				var imagem3 = evt.target.files[0];
			}
			
			if (imagem1 != null && imagem1.type.match('image.*')) {
				$("#img1").addClass("active");
				var data1 = new FormData();
				data1.append('imagem1',imagem1);
				$.ajax({
					url:'/usuario/meu-perfil/pecas/atualizar/imagem/',
					data:data1,
					processData:false,
					contentType:false,
					type:'POST',
					success:function(valor) {
						document.getElementById('foto1').src = valor;
						$("#img1").removeClass("active");
					}
				});
			} else {
				$("#img1").removeClass("active");
			}
			
			if (imagem2 != null &&imagem2.type.match('image.*')) {
				$("#img2").addClass("active");
				var data2 = new FormData();
				data2.append('imagem2',imagem2);
				$.ajax({
					url:'/usuario/meu-perfil/pecas/atualizar/imagem/',
					data:data2,
					processData:false,
					contentType:false,
					type:'POST',
					success:function(valor) {
						document.getElementById('foto2').src = valor;
						$("#img2").removeClass("active");
					}
				});
			} else {
				$("#img2").removeClass("active");
			}
			
			if (imagem3 != null && imagem3.type.match('image.*')) {
				$("#img3").addClass("active");
				var data3 = new FormData();
				data3.append('imagem3',imagem3);
				$.ajax({
					url:'/usuario/meu-perfil/pecas/atualizar/imagem/',
					data:data3,
					processData:false,
					contentType:false,
					type:'POST',
					success:function(valor) {
						document.getElementById('foto3').src = valor;
						$("#img3").removeClass("active");
					}
				});
			} else {
				$("#img3").removeClass("active");
			}
		} else {
			alert("Selecione no Maximo 3 Imagens");
		}
		
		document.getElementById("imagens").value = "";
	}
	
	document.getElementById('imagens').addEventListener('change', handleFileSelect, false);
});
function MostImgErr($ths) {
	$ths.src='/resources/img/imagem_indisponivel.png';
}
$('#entidade_cpf_cnpj').popup();
$('#entidade_nome_comercial').popup();
$('#entidade_site').popup();
$('#entidade_msg').on('click', function() {
	$(this).closest('.message').transition('fade');
});
SetarMascarasEntidade();
function SetarMascarasEntidade() {
	var maskBehavior = function (val) {
		  return val.replace(/\D/g, '').length > 11 ? '00.000.000/0000-00' : '000.000.000-00###';
		},
		options = {onKeyPress: function(val, e, field, options) {
		        field.mask(maskBehavior.apply({}, arguments), options);
		    }
		};

	$('#entidade_cpf_cnpj').mask(maskBehavior, options);
}
function MostImgErr($this) {
	$this.src='/resources/img/imagem_indisponivel.png';
}
var loadFile = function(event) {
	if (event.target.files.length = 1) {
		var imagem = event.target.files[0];
		
		if (imagem != null && imagem.type.match('image.*')) {
			$("#div_img").addClass("active");
			var data1 = new FormData();
			data1.append('imagem',imagem);
			$.ajax({
				url:'/usuario/meu-perfil/meus-dados/editar-dados/entidade/imagem/',
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
		url: "/usuario/meu-perfil/meus-dados/editar-dados/entidade/imagem/",
	}).done(function() {
		document.getElementById("imagem").value = "";
		document.getElementById("foto").src = "/resources/img/imagem_indisponivel.png";
		$("#div_img").removeClass("active");
	});
}
function SalvarEntidade() {
	$('#form_entidade').addClass('loading');
	$('#div_entidade_cpf_cnpj').removeClass('error');
	$('#div_entidade_nome_comercial').removeClass('error');
	$('#div_entidade_site').removeClass('error');
	var $nome_comercial = $('#entidade_nome_comercial').val();
	var $site = $('#entidade_site').val();
	$.ajax({
		method: "POST",
		url: "/usuario/meu-perfil/meus-dados/editar-dados/entidade/",
		async: false,
		data: { 
			nome_comercial : $nome_comercial,
			site : $site
		}
	}).done(function(data) {
		var $data = JSON.parse(data);
		if ($data.sucessos.length > 0) {
			$('#entidade_msg').removeClass('error');
			$('#entidade_msg').addClass('success');
			$('#entidade_msg_header').html('Dados salvos com sucesso! :)');
			$('#entidade_msg_list').html($data.sucessos);
			$('#entidade_msg').addClass('visible');
			$('#entidade_msg').removeClass('hidden');
		} else if ($data.erros.length > 0) {
			$('#entidade_msg').addClass('error');
			$('#entidade_msg').removeClass('success');
			$('#entidade_msg_header').html('Ops! Algo deu errado! :(');
			$('#entidade_msg_list').html($data.erros);
			$('#entidade_msg').addClass('visible');
			$('#entidade_msg').removeClass('hidden');
			if ($data.campos.cpf_cnpj == 'erro') {
				$('#div_entidade_cpf_cnpj').addClass('error');
			}
			if ($data.campos.nome_comercial == 'erro') {
				$('#div_entidade_nome_comercial').addClass('error');
			}
			if ($data.campos.site == 'erro') {
				$('#div_entidade_site').addClass('error');
			}
		}
	});
	$('#form_entidade').removeClass('loading');
}
function RestaurarEntidade() {
	$('#form_entidade').addClass('loading');
	$.ajax({
		method: "GET",
		url: "/usuario/meu-perfil/meus-dados/editar-dados/entidade/",
		async: false
	}).done(function(data) {
		var $data = JSON.parse(data);
		$('#entidade_cpf_cnpj').val($data.cpf_cnpj).trigger('input');
		$('#entidade_nome_comercial').val($data.nome_comercial);
		$('#entidade_site').val($data.site);
	});
	$('#form_entidade').removeClass('loading');
}
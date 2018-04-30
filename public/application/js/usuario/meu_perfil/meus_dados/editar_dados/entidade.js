$(document).ready(function () {
	$('#entidade_cpf_cnpj').popup();
	$('#entidade_nome_comercial').popup();
	$('#entidade_site').popup();
});
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
	$('#div_img').addClass('active');
	if (event.target.files.length = 1) {
		var imagem = event.target.files[0];
		if (imagem != null && imagem.type.match('image.*')) {
			resizeImage({
			    file: imagem,
			    maxSize: 1024
			}).then(function (resizedImage) {
			    console.log("upload resized image");
			    var fd = new FormData();
				fd.append('imagem', resizedImage);
				$.ajax({
					url : '/usuario/meu-perfil/meus-dados/editar-dados/entidade/imagem/',
					data : fd,
					processData : false,
					cache: false,
					contentType : false,
					type : 'POST',
					success:function(valor) {
						$('#foto').attr('src', valor);
						$('#div_img').removeClass('active');
					}
				});
			}).catch(function (err) {
			    console.error(err);
			    $('#div_img').removeClass('active');
			});
		} else {
			$('#div_img').removeClass('active');
		}
	}
};
function limparCampoFile() {
	$('#div_img').addClass('active');
	$.ajax({
		method: "DELETE",
		url: "/usuario/meu-perfil/meus-dados/editar-dados/entidade/imagem/",
	}).done(function() {
		$('#imagem').val = "";
		$('#foto').attr('src', '/resources/img/imagem_indisponivel.png');
		$('#div_img').removeClass('active');
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
		$('#form_entidade').removeClass('loading');
	});
}
function RestaurarEntidade() {
	$('#form_entidade').addClass('loading');
	$.ajax({
		method: "GET",
		url: "/usuario/meu-perfil/meus-dados/editar-dados/entidade/"
	}).done(function(data) {
		var $data = JSON.parse(data);
		$('#entidade_cpf_cnpj').val($data.cpf_cnpj).trigger('input');
		$('#entidade_nome_comercial').val($data.nome_comercial);
		$('#entidade_site').val($data.site);
		$('#entidade_msg').removeClass('visible');
		$('#entidade_msg').addClass('hidden');
		$('#div_entidade_cpf_cnpj').removeClass('error');
		$('#div_entidade_nome_comercial').removeClass('error');
		$('#div_entidade_site').removeClass('error');
		$('#form_entidade').removeClass('loading');
	});
}
//----------------------------------
var resizeImage = function (settings) {
    var file = settings.file;
    var maxSize = settings.maxSize;
    var reader = new FileReader();
    var image = new Image();
    var canvas = document.createElement('canvas');
    var dataURItoBlob = function (dataURI) {
        var bytes = dataURI.split(',')[0].indexOf('base64') >= 0 ?
            atob(dataURI.split(',')[1]) :
            unescape(dataURI.split(',')[1]);
        var mime = dataURI.split(',')[0].split(':')[1].split(';')[0];
        var max = bytes.length;
        var ia = new Uint8Array(max);
        for (var i = 0; i < max; i++)
            ia[i] = bytes.charCodeAt(i);
        return new Blob([ia], { type: mime });
    };
    var resize = function () {
        var width = image.width;
        var height = image.height;
        if (width > height) {
            if (width > maxSize) {
                height *= maxSize / width;
                width = maxSize;
            }
        } else {
            if (height > maxSize) {
                width *= maxSize / height;
                height = maxSize;
            }
        }
        canvas.width = width;
        canvas.height = height;
        canvas.getContext('2d').drawImage(image, 0, 0, width, height);
        var dataUrl = canvas.toDataURL('image/jpeg');
        return dataURItoBlob(dataUrl);
    };
    return new Promise(function (ok, no) {
        if (!file.type.match(/image.*/)) {
            no(new Error("Not an image"));
            return;
        }
        reader.onload = function (readerEvent) {
            image.onload = function () { return ok(resize()); };
            image.src = readerEvent.target.result;
        };
        reader.readAsDataURL(file);
    });
};
$(document).ready(function () {
	$('#endereco_cep').popup();
	$('#endereco_estado').popup();
	$('#endereco_cidade').popup();
	$('#endereco_bairro').popup();
	$('#endereco_rua').popup();
	$('#endereco_numero').popup();
	$('#endereco_complemento').popup();
	$('#endereco_estado').dropdown();
	$('#endereco_cidade').dropdown();
});
$('#endereco_cep').mask('00.000-000');
$('#endereco_msg').on('click', function() {
	$(this).closest('.message').transition('fade');
});
$(document).ready(function() {
	$('#endereco_estado').change(function() {
		var $estado = $('#endereco_estado').dropdown('get value');
		$.ajax({
			method: "GET",
			url: "/usuario/meu-perfil/meus-dados/editar-dados/endereco/cidades/",
			async: false,
			data: { 
				estado : $estado
			}
		}).done(function(data) {
			$('#endereco_cidade_menu').html(data);
		});
   });
});
$("#endereco_cep").blur(function() {
	$('#form_endereco').addClass('loading');
    var cep = $(this).val().replace(/\D/g, '');
    if (cep != "") {
        var validacep = /^[0-9]{8}$/;
        if(validacep.test(cep)) {
            $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {
            	if (!("erro" in dados)) {
            		$('#endereco_estado').dropdown('set value', $('#'+dados.uf).data('value'));
                	$('#endereco_estado').dropdown('set text', $('#'+dados.uf).data('text'));
                	
                	$("#endereco_rua").val(dados.logradouro.replace('Rua ', ''));
                	$("#endereco_bairro").val(dados.bairro);
                	
                	$("#endereco_cidade").dropdown('set text', $('div[data-text*="'+dados.localidade+'"]').data('text'));
                	$("#endereco_cidade").dropdown('set value', $('div[data-text*="'+dados.localidade+'"]').data('value'));
                 
                	$('#form_endereco').removeClass('loading');
            	} else {
            		$('#form_endereco').removeClass('loading');
            	}
            });
        } else {
        	$('#form_endereco').removeClass('loading');
        }
    } else {
    	$('#form_endereco').removeClass('loading');
    }
});
function SalvarEndereco() {
	$('#form_endereco').addClass('loading');
	$('#div_endereco_cep').removeClass('error');
	$('#div_endereco_estado').removeClass('error');
	$('#div_endereco_cidade').removeClass('error');
	$('#div_endereco_bairro').removeClass('error');
	$('#div_endereco_rua').removeClass('error');
	$('#div_endereco_numero').removeClass('error');
	$('#div_endereco_complemento').removeClass('error');
	var $cep = $('#endereco_cep').val();
	var $estado = $('#endereco_estado').dropdown('get value');
	var $cidade = $('#endereco_cidade').dropdown('get value');
	var $bairro = $('#endereco_bairro').val();
	var $rua = $('#endereco_rua').val();
	var $numero = $('#endereco_numero').val();
	var $complemento = $('#endereco_complemento').val();
	$.ajax({
		method: "POST",
		url: "/usuario/meu-perfil/meus-dados/editar-dados/endereco/",
		data: {
			cep : $cep,
			estado : $estado,
			cidade : $cidade,
			bairro : $bairro,
			rua : $rua,
			numero : $numero,
			complemento : $complemento
		}
	}).done(function(data) {
		var $data = JSON.parse(data);
		if ($data.sucessos.length > 0) {
			$('#endereco_msg').removeClass('error');
			$('#endereco_msg').addClass('success');
			$('#endereco_msg_header').html('Dados salvos com sucesso! :)');
			$('#endereco_msg_list').html($data.sucessos);
			$('#endereco_msg').addClass('visible');
			$('#endereco_msg').removeClass('hidden');
		} else if ($data.erros.length > 0) {
			$('#endereco_msg').addClass('error');
			$('#endereco_msg').removeClass('success');
			$('#endereco_msg_header').html('Ops! Algo deu errado! :(');
			$('#endereco_msg_list').html($data.erros);
			$('#endereco_msg').addClass('visible');
			$('#endereco_msg').removeClass('hidden');
			if ($data.campos.cep == 'erro') {
				$('#div_endereco_cep').addClass('error');
			}
			if ($data.campos.estado == 'erro') {
				$('#div_endereco_estado').addClass('error');
			}
			if ($data.campos.cidade == 'erro') {
				$('#div_endereco_cidade').addClass('error');
			}
			if ($data.campos.bairro == 'erro') {
				$('#div_endereco_bairro').addClass('error');
			}
			if ($data.campos.rua == 'erro') {
				$('#div_endereco_rua').addClass('error');
			}
			if ($data.campos.numero == 'erro') {
				$('#div_endereco_numero').addClass('error');
			}
			if ($data.campos.complemento == 'erro') {
				$('#div_endereco_complemento').addClass('error');
			}
		}
		$('#form_endereco').removeClass('loading');
	});
}
function RestaurarEndereco() {
	$('#form_endereco').addClass('loading');
	$.ajax({
		method: "GET",
		url: "/usuario/meu-perfil/meus-dados/editar-dados/endereco/"
	}).done(function(data) {
		var $data = JSON.parse(data);
		$('#endereco_cep').val($data.cep).trigger('input');
		$('#endereco_estado').dropdown('set value', $('#'+$data.estado).data('value'));
    	$('#endereco_estado').dropdown('set text', $('#'+$data.estado).data('text'));
		$('#endereco_bairro').val($data.bairro);
		$('#endereco_rua').val($data.rua);
		$('#endereco_numero').val($data.numero);
		$('#endereco_complemento').val($data.complemento);
		$('#endereco_cidade').dropdown('set value', $('#item_'+$data.cidade).data('value'));
    	$('#endereco_cidade').dropdown('set text', $('#item_'+$data.cidade).data('text'));
    	$('#endereco_msg').removeClass('visible');
		$('#endereco_msg').addClass('hidden');
    	$('#div_endereco_cep').removeClass('error');
    	$('#div_endereco_estado').removeClass('error');
    	$('#div_endereco_cidade').removeClass('error');
    	$('#div_endereco_bairro').removeClass('error');
    	$('#div_endereco_rua').removeClass('error');
    	$('#div_endereco_numero').removeClass('error');
    	$('#div_endereco_complemento').removeClass('error');
    	$('#form_endereco').removeClass('loading');
	});
}
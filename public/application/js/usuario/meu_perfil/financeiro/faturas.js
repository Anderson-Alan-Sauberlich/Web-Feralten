$('#accordion_fatura_fechada').accordion({animateChildren: false});
$('#accordion_fatura_aberta').accordion();
$('#accordion_fatura_fechada .menu .item').tab();
$('#validade_mes').dropdown({message: {noResults: "Nenhum Resultado..."}});
$('#validade_ano').dropdown({message: {noResults: "Nenhum Resultado..."}});
$('#nascimento_dia').dropdown({message: {noResults: "Nenhum Resultado..."}});
$('#nascimento_mes').dropdown({message: {noResults: "Nenhum Resultado..."}});
$('#nascimento_ano').dropdown({message: {noResults: "Nenhum Resultado..."}});
$('#credito_msg').on('click', function() {
	$(this).closest('.message').transition('fade');
});
$('#boleto_msg').on('click', function() {
	$(this).closest('.message').transition('fade');
});
SetarMascaras();
function SetarMascaras() {
	var maskBehavior = function (val) {
		  return val.replace(/\D/g, '').length > 11 ? '00.000.000/0000-00' : '000.000.000-00###';
		},
		options = {onKeyPress: function(val, e, field, options) {
		        field.mask(maskBehavior.apply({}, arguments), options);
		    }
		};

	$('#cpf_cnpj').mask(maskBehavior, options);
	$('#numero').mask('0000 0000 0000 0000');
	$('#cvv').mask('0000');
}
function PagarComCredito() {
	$('#form_credito').addClass('loading');
	var $hash = PagSeguroDirectPayment.getSenderHash();
	var $numero = $('#numero').val().replace(/[^\d]+/g,'');
	var $brand = $('#brand').val();
	var $cvv = $('#cvv').val();
	var $validade_mes = $('#validade_mes').val();
	var $validade_ano = $('#validade_ano').val();
	var $nome = $('#nome').val();
	var $cpf_cnpj = $('#cpf_cnpj').val().replace(/[^\d]+/g,'');
	var $nascimento = $('#nascimento_dia').val()+'/'+$('#nascimento_mes').val()+'/'+$('#nascimento_ano').val();
	
	var $param = {
		cardNumber: $numero,
		brand: $brand,
		cvv: $cvv,
		expirationMonth: $validade_mes,
		expirationYear: $validade_ano,
		success: function(response) {
			$('#form_credito').addClass('loading');
			$.ajax({
				method: 'POST',
				url: '/usuario/meu-perfil/financeiro/faturas/pagseguro/credito/',
				async: false,
				data: { 
					token : response.card.token,
					hash : $hash,
					nome : $nome,
					cpf_cnpj : $cpf_cnpj,
					nascimento : $nascimento
				}
			}).done(function(data) {
				var $data = JSON.parse(data);
				if ($data.sucessos.length > 0) {
					$('#credito_msg').removeClass('error');
					$('#credito_msg').addClass('success');
					$('#credito_msg_header').html('Sucesso! :)');
					$('#credito_msg_list').html($data.sucessos);
					$('#credito_msg').addClass('visible');
					$('#credito_msg').removeClass('hidden');
					window.location.replace('/usuario/meu-perfil/financeiro/faturas/');
				} else if ($data.erros.length > 0) {
					$('#credito_msg').addClass('error');
					$('#credito_msg').removeClass('success');
					$('#credito_msg_header').html('Ops! Algo deu errado! :(');
					$('#credito_msg_list').html($data.erros);
					$('#credito_msg').addClass('visible');
					$('#credito_msg').removeClass('hidden');
					if ($data.campos.token == 'erro') {
						$('#div_numero').addClass('error');
						$('#div_cvv').addClass('error');
						$('#div_validade_mes').addClass('error');
						$('#div_validade_ano').addClass('error');
					}
					if ($data.campos.nome == 'erro') {
						$('#div_nome').addClass('error');
					}
					if ($data.campos.cpf_cnpj == 'erro') {
						$('#div_cpf_cnpj').addClass('error');
					}
					if ($data.campos.nascimento == 'erro') {
						$('#div_nascimento').addClass('error');
					}
				}
				$('#form_credito').removeClass('loading');
			});
		},
		error: function(response) {
			$('#credito_msg').addClass('error');
			$('#credito_msg').removeClass('success');
			$('#credito_msg_header').html('Ops! Algo deu errado! :(');
			$('#credito_msg_list').html(JSON.stringify(response.errors));
			$('#credito_msg').addClass('visible');
			$('#credito_msg').removeClass('hidden');
			
			$('#div_numero').addClass('error');
			$('#div_cvv').addClass('error');
			$('#div_validade').addClass('error');
		},
		complete: function(response) {
			$('#form_credito').removeClass('loading');
		}
	}
	
	PagSeguroDirectPayment.createCardToken($param);
}
$("#numero").blur(function() {
	retornaBrandCard()
});
function retornaBrandCard() {
	var numcard = $('#numero').val().replace(/[^\d]+/g,'');
	var bin = numcard.substr(0,6);

	PagSeguroDirectPayment.getBrand({
	    cardBin: bin,
	    success: function(response) {
	    	$('#brand').val(response.brand.name);
	    },
	    error: function(response) {
	        
	    },
	    complete: function(response) {
	        
	    }
	});
}
function PagarComBoleto() {
	$('#gerar_boleto').addClass('loading');
	var $hash = PagSeguroDirectPayment.getSenderHash();
	$.ajax({
		method: 'POST',
		url: '/usuario/meu-perfil/financeiro/faturas/pagseguro/boleto/',
		async: false,
		data: { 
			hash : $hash
		}
	}).done(function(data) {
		var $data = JSON.parse(data);
		if ($data.sucessos.length > 0) {
			$('#boleto_msg').removeClass('error');
			$('#boleto_msg').addClass('success');
			$('#boleto_msg_header').html('Sucesso! :)');
			$('#boleto_msg_list').html($data.sucessos);
			$('#boleto_msg').addClass('visible');
			$('#boleto_msg').removeClass('hidden');
			window.open($data.link_boleto, '_blank');
			window.location.replace('/usuario/meu-perfil/financeiro/faturas/');
		} else if ($data.erros.length > 0) {
			$('#boleto_msg').addClass('error');
			$('#boleto_msg').removeClass('success');
			$('#boleto_msg_header').html('Ops! Algo deu errado! :(');
			$('#boleto_msg_list').html($data.erros);
			$('#boleto_msg').addClass('visible');
			$('#boleto_msg').removeClass('hidden');
		}
	});
	$('#gerar_boleto').removeClass('loading');
}
$('#accordion_fatura_fechada').accordion({animateChildren: false});
$('#accordion_fatura_aberta').accordion();
$('#accordion_fatura_fechada .menu .item').tab();
$('#cpf').mask('000.000.000-00');
$('#numero').mask('0000 0000 0000 0000');
$('#codigo').mask('0000');
$('#validade_mes').dropdown({message: {noResults: "Nenhum Resultado..."}});
$('#validade_ano').dropdown({message: {noResults: "Nenhum Resultado..."}});
$('#nascimento_dia').dropdown({message: {noResults: "Nenhum Resultado..."}});
$('#nascimento_mes').dropdown({message: {noResults: "Nenhum Resultado..."}});
$('#nascimento_ano').dropdown({message: {noResults: "Nenhum Resultado..."}});
$('#credito_msg').on('click', function() {
	$(this).closest('.message').transition('fade');
});
function PagarComCredito() {
	$('#form_credito').addClass('loading');
	var $hash = PagSeguroDirectPayment.getSenderHash();
	var $numero = $('#numero').val().replace(/[^\d]+/g,'');
	var $brand = $('#brand').val();
	var $codigo = $('#codigo').val();
	var $validade_mes = $('#validade_mes').val();
	var $validade_ano = $('#validade_ano').val();
	var $nome = $('#nome').val();
	var $cpf = $('#cpf').val().replace(/[^\d]+/g,'');
	var $nascimento = $('#nascimento_dia').val()+'/'+$('#nascimento_mes').val()+'/'+$('#nascimento_ano').val();
	
	var $param = {
		cardNumber: $numero,
		brand: $brand,
		cvv: $codigo,
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
					hash :  $hash,
					nome : $nome,
					cpf : $cpf,
					nascimento : $nascimento
				}
			}).done(function(data) {
				var $data = JSON.parse(data);
				if ($data.sucessos.length > 0) {
					$('#credito_msg').removeClass('error');
					$('#credito_msg').addClass('success');
					$('#credito_msg_header').html('Dados salvos com sucesso! :)');
					$('#credito_msg_list').html($data.sucessos);
					$('#credito_msg').addClass('visible');
					$('#credito_msg').removeClass('hidden');
				} else if ($data.erros.length > 0) {
					$('#credito_msg').addClass('error');
					$('#credito_msg').removeClass('success');
					$('#credito_msg_header').html('Ops! Algo deu errado! :(');
					$('#credito_msg_list').html($data.erros);
					$('#credito_msg').addClass('visible');
					$('#credito_msg').removeClass('hidden');
					if ($data.campos.token == 'erro') {
						$('#div_numero').addClass('error');
						$('#div_codigo').addClass('error');
						$('#div_validade').addClass('error');
					}
					if ($data.campos.nome == 'erro') {
						$('#div_nome').addClass('error');
					}
					if ($data.campos.cpf == 'erro') {
						$('#div_cpf').addClass('error');
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
			$('#div_codigo').addClass('error');
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
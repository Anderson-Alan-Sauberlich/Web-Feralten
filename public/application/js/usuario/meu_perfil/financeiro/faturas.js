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
	var $SenderHash = PagSeguroDirectPayment.getSenderHash();
	
	var $param = {
		cardNumber: $('#numero').val(),
		brand: 'visa',
		cvv: $('#codigo').val(),
		expirationMonth: $('#validade_mes').val(),
		expirationYear: $('#validade_ano').val(),
		success: function(response) {
			$('#form_credito').addClass('loading');
			$.ajax({
				method: 'POST',
				url: '/usuario/meu-perfil/financeiro/faturas/pagseguro/credito/',
				async: false,
				data: { json_card_token : response }
			}).done(function(valor) {
				//var $valor = JSON.parse(valor);
				
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
		},
		complete: function(response) {
			$('#form_credito').removeClass('loading');
		}
	}
	
	PagSeguroDirectPayment.createCardToken($param);
}
function retornaBrandCard() {
	var numcard = $('#numero').val();
	var bin = numcard.substr(0,6);

	var brand;
	PagSeguroDirectPayment.getBrand({
	    cardBin: bin,
	    success: function(response) {
	        brand = response.name;
	    },
	    error: function(response) {
	        
	    },
	    complete: function(response) {
	        
	    }
	});
	
	return brand;
}
function bnt_plano($bnt) {
	$('#bnt_plano_'+$bnt).addClass('loading');
	if ($bnt >= 1 && $bnt <= 6) {
		$.ajax({
			method: "POST",
			url: "/usuario/meu-perfil/financeiro/meu-plano/",
			async: false,
			data: { plano:$bnt }
		}).done(function(valor) {
			var $valor = JSON.parse(valor);
			
			if ($valor.status == 'certo') {
				window.location.replace('/usuario/meu-perfil/financeiro/fatura/');
			} else if ($valor.status == 'erro') {
				$('#msg_content').html($valor.erros);
				
				$('#mdl_msg').modal('show');
			}
		});
	}
	$('#bnt_plano_'+$bnt).removeClass('loading');
}
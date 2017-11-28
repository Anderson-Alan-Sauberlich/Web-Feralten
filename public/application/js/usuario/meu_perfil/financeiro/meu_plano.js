function bnt_plano($btn) {
	$('#bnt_plano_'+$btn).addClass('loading');
	if ($btn >= 1 && $btn <= 6) {
		$('#msg_content').html("<p>Deseja mesmo contratar este plano?</p>");
		$('#mdl_msg').modal({
			allowMultiple: true,
			closable  : false,
			onApprove : function() { alterarPlano($btn); }
			}).modal('show');
	}
	$('#bnt_plano_'+$btn).removeClass('loading');
}
function alterarPlano($planoID) {
	$('#bnt_plano_'+$planoID).addClass('loading');
	$.ajax({
		method: "POST",
		url: "/usuario/meu-perfil/financeiro/meu-plano/",
		async: false,
		data: { plano:$planoID }
	}).done(function(valor) {
		var $valor = JSON.parse(valor);
		if ($valor.status == 'certo') {
			window.location.replace('/usuario/meu-perfil/financeiro/fatura/');
		} else if ($valor.status == 'erro') {
			$('#erro_content').html($valor.erros);
			$('#mdl_erro').modal('show');
		}
	});
	$('#bnt_plano_'+$planoID).removeClass('loading');
}
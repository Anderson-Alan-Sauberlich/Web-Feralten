$('#ui_mostrar').checkbox();
$('#msg_mdl_confirmacao').on('click', function() {
	$(this).closest('.message').transition('fade');
});
function btn_plano($btn) {
	$('#btn_plano_'+$btn).addClass('loading');
	if ($btn >= 1 && $btn <= 6) {
		$('#msg_content').html("<p>Deseja mesmo contratar este plano?</p>");
		$('#mdl_msg').modal({
			allowMultiple: true,
			closable  : false,
			onApprove : function() { alterarPlano($btn); }
		}).modal('show');
	}
	$('#btn_plano_'+$btn).removeClass('loading');
}
function alterarPlano($planoID) {
	$('#btn_plano_'+$planoID).addClass('loading');
	$.ajax({
		method: "POST",
		url: "/usuario/meu-perfil/financeiro/meu-plano/",
		async: false,
		data: { plano : $planoID }
	}).done(function(valor) {
		var $valor = JSON.parse(valor);
		if ($valor.status == 'certo') {
			window.location.replace('/usuario/meu-perfil/financeiro/faturas/');
		} else if ($valor.status == 'erro') {
			$('#erro_content').html($valor.erros);
			$('#mdl_erro').modal('show');
		}
	});
	$('#btn_plano_'+$planoID).removeClass('loading');
}
function btn_cancelar_contratacao() {
	$('#btn_cancelar_contratacao').addClass('loading');
	$('#msg_content').html('<p>Ao aceitar, todas as suas <b>Peças</b> serão <b>Deletadas</b>, suas faturas serão canceladas e será ativado o plano gratuito.</p><p><b>Dica:</b> Em vez disso, você pode ativar um plano inferior, talvez você só precise remover algumas peças.</p><p>Cuidado! Aceitar este processo é <b>Irreversível!</b></p>');
	$('#mdl_msg').modal({
		allowMultiple: true,
		closable  : false,
		onApprove : function() {
			$('#mdl_confirmacao').modal('show');
		}
	}).modal('show');
	$('#btn_cancelar_contratacao').removeClass('loading');
}
function cancelarContratacao() {
	$('#btn_continuar').addClass('loading');
	$('#msg_mdl_confirmacao').addClass('hidden');
	$('#msg_mdl_confirmacao').removeClass('visible');
	var $senha_usuario = $('#senha_usuario').val();
	if ($senha_usuario != '' && $senha_usuario != null) {
		$.ajax({
			method: "POST",
			url: "/usuario/meu-perfil/financeiro/meu-plano/cancelar-contratacao/",
			async: false,
			data: { senha_usuario : $senha_usuario }
		}).done(function(valor) {
			var $valor = JSON.parse(valor);
			if ($valor.status == 'certo') {
				window.location.replace('/usuario/meu-perfil/financeiro/meu-plano/');
			} else if ($valor.status == 'erro') {
				$('#msg_mdl_confirmacao').removeClass('hidden');
				$('#msg_mdl_confirmacao').addClass('visible');
				$('#header_msg_mdl_confirmacao').html($valor.erros);
			}
		});
	} else {
		$('#msg_mdl_confirmacao').removeClass('hidden');
		$('#msg_mdl_confirmacao').addClass('visible');
		$('#header_msg_mdl_confirmacao').html('<p>Erro: Senha não informada</p>');
	}
	$('#btn_continuar').removeClass('loading');
}
function MostrarSenha() {
	var passwordField = $('#senha_usuario');
	var passwordFieldType = passwordField.attr('type');
	if(passwordFieldType == 'password'){
    	passwordField.attr('type', 'text');
	} else {
    	passwordField.attr('type', 'password');
	}
}
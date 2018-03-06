$('#div_orcamentos .ui.accordion').accordion();
function NaoTenho($id_orcamento) {
	$('#div_orcamento_'+$id_orcamento).remove();
	$.ajax({
		method: "POST",
		url: "/layout/elemento/orcamento/",
		async: false,
		data: { 
			id_orcamento : $id_orcamento
		}
	}).done(function(data) {
		AtualizarNumeros();
		if ($('#div_orcamentos div').length < 40) {
			try {
				AjaxCaixaDeEntrada();
			} catch($e) {
				
			}
			try {
				AjaxRespondidos();
			} catch($e) {
				
			}
		}
	});
}
function SimTenho($id_orcamento) {
	window.location.href = "/usuario/meu-perfil/pecas/cadastrar/no-orcamento/"+$id_orcamento+"/";
}
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
		AjaxCaixaDeEntrada();
		AtualizarNumeros();
	});
}
function SimTenho($id_orcamento) {
	
}
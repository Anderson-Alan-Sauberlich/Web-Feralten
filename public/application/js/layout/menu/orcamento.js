function AtualizarNumeros() {
	$.ajax({
		method: "GET",
		url: "/layout/menu/orcamento/numeros/"
	}).done(function(data) {
		$data = JSON.parse(data);
		$('#label_meus_orcamentos').html($data.meus_orcamentos);
		$('#label_caixa_de_entrada').html($data.caixa_de_entrada);
		$('#label_respondidos').html($data.respondidos);
		$('#label_nao_tenho').html($data.nao_tenho);
	});
}
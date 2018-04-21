$(document).ready(function() {
	$('.card .ui.checkbox').checkbox();
	$('.card .ui.dropdown').dropdown();
	$('.card .ui.radio.checkbox').checkbox();
});
function Mostrar_Modal($id_peca) {
	$('#modal_'+$id_peca).modal('show');
}
function Change_Checkbox($id_peca) {
	if ($('#deletar_'+$id_peca).is(":checked")) {
		$('#visivel_'+$id_peca).addClass('disabled');
		$('#visivel_'+$id_peca).attr('disabled="disabled"');
		$('#div_visivel_'+$id_peca).addClass('disabled');
		$('#desativada_'+$id_peca).addClass('disabled');
		$('#desativada_'+$id_peca).attr('disabled="disabled"');
		$('#div_desativada_'+$id_peca).addClass('disabled');
		$('#invisivel_'+$id_peca).addClass('disabled');
		$('#invisivel_'+$id_peca).attr('disabled="disabled"');
		$('#div_invisivel_'+$id_peca).addClass('disabled');
	} else {
		$('#visivel_'+$id_peca).removeClass('disabled');
		$('#visivel_'+$id_peca).removeAttr('disabled="disabled"');
		$('#div_visivel_'+$id_peca).removeClass('disabled');
		$('#desativada_'+$id_peca).removeClass('disabled');
		$('#desativada_'+$id_peca).removeAttr('disabled="disabled"');
		$('#div_desativada_'+$id_peca).removeClass('disabled');
		$('#invisivel_'+$id_peca).removeClass('disabled');
		$('#invisivel_'+$id_peca).removeAttr('disabled="disabled"');
		$('#div_invisivel_'+$id_peca).removeClass('disabled');
	}
}
function Salvar_Opcoes_Peca($peca) {
	var $deletar = null;
	var $status = null;
	if ($('#deletar_'+$peca).is(':checked')) {
		$deletar = 'deletar';
	}
	if ($('#visivel_'+$peca).is(':checked')) {
		$status = 'visivel';
	} else if ($('#desativada_'+$peca).is(':checked')) {
		$status = 'desativada';
	} else if ($('#invisivel_'+$peca).is(':checked')) {
		$status = 'invisivel';
	}
	$.post('/layout/elemento/card-peca/opcoes/',
	{
		deletar : $deletar,
		status : $status,
		peca : $peca},
	function(valor){
		Pesquisar(true);
	});
}
function Cancelar_Opcoes_Peca() {
	
}
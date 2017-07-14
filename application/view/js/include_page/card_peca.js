$(document).ready(function() {
	$('.ui.checkbox').checkbox();
	$('.ui.dropdown').dropdown();
	$('.ui.radio.checkbox').checkbox({uncheckable: true});
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
	} else {
		$('#visivel_'+$id_peca).removeClass('disabled');
		$('#visivel_'+$id_peca).removeAttr('disabled="disabled"');
		$('#div_visivel_'+$id_peca).removeClass('disabled');
		$('#desativada_'+$id_peca).removeClass('disabled');
		$('#desativada_'+$id_peca).removeAttr('disabled="disabled"');
		$('#div_desativada_'+$id_peca).removeClass('disabled');
	}
}
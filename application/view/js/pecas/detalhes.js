$('.carousel').carousel({interval: false});
function abrirModal($numero) {
	if ($numero == 1) {
		$('#ol_indice0').removeClass('active');
		$('#ol_indice1').removeClass('active');
		$('#ol_indice2').removeClass('active');
		$('#ol_indice0').addClass('active');
		
		$('#item_indice0').removeClass('active');
		$('#item_indice1').removeClass('active');
		$('#item_indice2').removeClass('active');
		$('#item_indice0').addClass('active');
	} else if ($numero == 2) {
		$('#ol_indice0').removeClass('active');
		$('#ol_indice1').removeClass('active');
		$('#ol_indice2').removeClass('active');
		$('#ol_indice1').addClass('active');
		
		$('#item_indice0').removeClass('active');
		$('#item_indice1').removeClass('active');
		$('#item_indice2').removeClass('active');
		$('#item_indice1').addClass('active');
	} else if ($numero == 3) {
		$('#ol_indice0').removeClass('active');
		$('#ol_indice1').removeClass('active');
		$('#ol_indice2').removeClass('active');
		$('#ol_indice2').addClass('active');
		
		$('#item_indice0').removeClass('active');
		$('#item_indice1').removeClass('active');
		$('#item_indice2').removeClass('active');
		$('#item_indice2').addClass('active');
	}
	
	$('.ui.basic.modal').modal('show');
}
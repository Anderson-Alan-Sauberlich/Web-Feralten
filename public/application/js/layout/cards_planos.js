function bnt_radio($bnt) {
	if ($bnt == 1) {
		$('#bnt_plano_1').text('Ativo').addClass('inverted green active');
		$('#bnt_plano_2').text('Contratar').removeClass('inverted green active');
		$('#bnt_plano_3').text('Contratar').removeClass('inverted green active');
		$('#bnt_plano_4').text('Contratar').removeClass('inverted green active');
		$('#bnt_plano_5').text('Contratar').removeClass('inverted green active');
		$('#bnt_plano_6').text('Contratar').removeClass('inverted green active');
	} else if ($bnt == 2) {
		$('#bnt_plano_1').text('Contratar').removeClass('inverted green active');
		$('#bnt_plano_2').text('Ativo').addClass('inverted green active');
		$('#bnt_plano_3').text('Contratar').removeClass('inverted green active');
		$('#bnt_plano_4').text('Contratar').removeClass('inverted green active');
		$('#bnt_plano_5').text('Contratar').removeClass('inverted green active');
		$('#bnt_plano_6').text('Contratar').removeClass('inverted green active');
	} else if ($bnt == 3) {
		$('#bnt_plano_1').text('Contratar').removeClass('inverted green active');
		$('#bnt_plano_2').text('Contratar').removeClass('inverted green active');
		$('#bnt_plano_3').text('Ativo').addClass('inverted green active');
		$('#bnt_plano_4').text('Contratar').removeClass('inverted green active');
		$('#bnt_plano_5').text('Contratar').removeClass('inverted green active');
		$('#bnt_plano_6').text('Contratar').removeClass('inverted green active');
	} else if ($bnt == 4) {
		$('#bnt_plano_1').text('Contratar').removeClass('inverted green active');
		$('#bnt_plano_2').text('Contratar').removeClass('inverted green active');
		$('#bnt_plano_3').text('Contratar').removeClass('inverted green active');
		$('#bnt_plano_4').text('Ativo').addClass('inverted green active');
		$('#bnt_plano_5').text('Contratar').removeClass('inverted green active');
		$('#bnt_plano_6').text('Contratar').removeClass('inverted green active');
	} else if ($bnt == 5) {
		$('#bnt_plano_1').text('Contratar').removeClass('inverted green active');
		$('#bnt_plano_2').text('Contratar').removeClass('inverted green active');
		$('#bnt_plano_3').text('Contratar').removeClass('inverted green active');
		$('#bnt_plano_4').text('Contratar').removeClass('inverted green active');
		$('#bnt_plano_5').text('Ativo').addClass('inverted green active');
		$('#bnt_plano_6').text('Contratar').removeClass('inverted green active');
	} else if ($bnt == 6) {
		$('#bnt_plano_1').text('Contratar').removeClass('inverted green active');
		$('#bnt_plano_2').text('Contratar').removeClass('inverted green active');
		$('#bnt_plano_3').text('Contratar').removeClass('inverted green active');
		$('#bnt_plano_4').text('Contratar').removeClass('inverted green active');
		$('#bnt_plano_5').text('Contratar').removeClass('inverted green active');
		$('#bnt_plano_6').text('Ativo').addClass('inverted green active');
	}
}
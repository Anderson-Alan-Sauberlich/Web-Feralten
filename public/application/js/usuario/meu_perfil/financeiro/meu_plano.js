function bnt_plano($bnt) {
	if ($bnt == 1) {
		$('#bnt_plano_1').addClass('loading');
		if (verificarDados(1)) {
			salvarDados(1);
		}
		$('#bnt_plano_1').removeClass('loading');
	} else if ($bnt == 2) {
		$('#bnt_plano_2').addClass('loading');
		if (verificarDados(2)) {
			salvarDados(2);
		}
		$('#bnt_plano_2').removeClass('loading');
	} else if ($bnt == 3) {
		$('#bnt_plano_3').addClass('loading');
		if (verificarDados(3)) {
			salvarDados(3);
		}
		$('#bnt_plano_3').removeClass('loading');
	} else if ($bnt == 4) {
		$('#bnt_plano_4').addClass('loading');
		if (verificarDados(4)) {
			salvarDados(4);
		}
		$('#bnt_plano_4').removeClass('loading');
	} else if ($bnt == 5) {
		$('#bnt_plano_5').addClass('loading');
		if (verificarDados(5)) {
			salvarDados(5);
		}
		$('#bnt_plano_5').removeClass('loading');
	} else if ($bnt == 6) {
		$('#bnt_plano_6').addClass('loading');
		if (verificarDados(6)) {
			salvarDados(6);
		}
		$('#bnt_plano_6').removeClass('loading');
	}
}
function verificarDados($pln) {
	
}
function salvarDados($pln) {
	
}
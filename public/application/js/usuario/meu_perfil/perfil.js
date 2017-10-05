$(document).ready(function() {
	$('#div_visualizado').addClass('loading');
	
	var $valor = null;
	
	$.ajax({
		method: "GET",
		url: "/usuario/meu-perfil/perfil/visualizado/",
		async: false
	}).done(function(valor) {
		$valor = JSON.parse(valor);
	});
	
	if ($valor != null) {
		var ctx = $("#crt_visualizado");
		var crt_visualizado = new Chart(ctx, {
		    type: 'line',
		    data: {
		        labels: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
		        datasets: [{
		            label: 'Visualizados - 2017',
		            data: [$valor.jan, $valor.fev, $valor.mar, $valor.abr, $valor.mai, $valor.jun, $valor.jul, $valor.ago, $valor.set, $valor.out, $valor.nov, $valor.dez]
		        }]
		    },
		    options: {
		        scales: {
		            yAxes: [{
		            	stacked: true
		            }]
		        }
		    }
		});
	}
	
	$('#div_visualizado').removeClass('loading');
});
$(document).ready(function() {
	$('#div_adicionado').addClass('loading');
	
	var $valor = null;
	
	$.ajax({
		method: "GET",
		url: "/usuario/meu-perfil/perfil/adicionado/",
		async: false
	}).done(function(valor) {
		$valor = JSON.parse(valor);
	});
	
	if ($valor != null) {
		var ctx = $("#crt_adicionado");
		var crt_adicionado = new Chart(ctx, {
		    type: 'line',
		    data: {
		        labels: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
		        datasets: [{
		            label: 'Adicionados - 2017',
		            data: [$valor.jan, $valor.fev, $valor.mar, $valor.abr, $valor.mai, $valor.jun, $valor.jul, $valor.ago, $valor.set, $valor.out, $valor.nov, $valor.dez]
		        }]
		    },
		    options: {
		        scales: {
		            yAxes: [{
		            	stacked: true
		            }]
		        }
		    }
		});
	}
	
	$('#div_adicionado').removeClass('loading');
});
$(document).ready(function() {
	$('#div_removido').addClass('loading');
	
	var $valor = null;
	
	$.ajax({
		method: "GET",
		url: "/usuario/meu-perfil/perfil/removido/",
		async: false
	}).done(function(valor) {
		$valor = JSON.parse(valor);
	});
	
	if ($valor != null) {
		var ctx = $("#crt_removido");
		var crt_removido = new Chart(ctx, {
		    type: 'line',
		    data: {
		        labels: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
		        datasets: [{
		            label: 'Removidos - 2017',
		            data: [$valor.jan, $valor.fev, $valor.mar, $valor.abr, $valor.mai, $valor.jun, $valor.jul, $valor.ago, $valor.set, $valor.out, $valor.nov, $valor.dez]
		        }]
		    },
		    options: {
		        scales: {
		            yAxes: [{
		            	stacked: true
		            }]
		        }
		    }
		});
	}
	
	$('#div_removido').removeClass('loading');
});
$(document).ready(function() {
	$('#div_visualizacoes').addClass('loading');
	
	var $valor = null;
	
	$.ajax({
		method: "GET",
		url: "/usuario/meu-perfil/perfil/",
		async: false
	}).done(function(valor) {
		$valor = JSON.parse(valor);
	});
	
	if ($valor != null) {
		var ctx = $("#crt_visualizacoes");
		var crt_visualizacoes = new Chart(ctx, {
		    type: 'line',
		    data: {
		        labels: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
		        datasets: [{
		            label: 'Visualizações - 2017',
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
	
	$('#div_visualizacoes').removeClass('loading');
});
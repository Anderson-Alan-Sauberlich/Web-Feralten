$(document).ready(function() {
	$('#div_visualizado').addClass('loading');
	
	var $jan = 0;
	var $fev = 0;
	var $mar = 0;
	var $abr = 0;
	var $mai = 0;
	var $jun = 0;
	var $jul = 0;
	var $ago = 0;
	var $set = 0;
	var $out = 0;
	var $nov = 0;
	var $dez = 0;
	
	$.ajax({
		method: "GET",
		url: "/usuario/meu-perfil/perfil/visualizado/",
		async: false
	}).done(function(valor) {
		if (valor != false) {
			valor = JSON.parse(valor);
			
			$jan = valor.jan;
			$fev = valor.fev;
			$mar = valor.mar;
			$abr = valor.abr;
			$mai = valor.mai;
			$jun = valor.jun;
			$jul = valor.jul;
			$ago = valor.ago;
			$set = valor.set;
			$out = valor.out;
			$nov = valor.nov;
			$dez = valor.dez;
		}
	});
	
	var ctx = $("#crt_visualizado");
	var crt_visualizado = new Chart(ctx, {
	    type: 'line',
	    data: {
	        labels: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
	        datasets: [{
	            label: 'Visualizados - 2018',
	            data: [$jan, $fev, $mar, $abr, $mai, $jun, $jul, $ago, $set, $out, $nov, $dez],
	            borderColor: '#0E6EB8'
	        }]
	    },
	    options: {
	        scales: {
	            yAxes: [{
	            	stacked:true,
	            	ticks: {
	                    beginAtZero:true
	                }
	            }]
	        }
	    }
	});
	
	$('#div_visualizado').removeClass('loading');
});
$(document).ready(function() {
	$('#div_adicionado').addClass('loading');
	
	var $jan = 0;
	var $fev = 0;
	var $mar = 0;
	var $abr = 0;
	var $mai = 0;
	var $jun = 0;
	var $jul = 0;
	var $ago = 0;
	var $set = 0;
	var $out = 0;
	var $nov = 0;
	var $dez = 0;
	
	$.ajax({
		method: "GET",
		url: "/usuario/meu-perfil/perfil/adicionado/",
		async: false
	}).done(function(valor) {
		if (valor != false) {
			valor = JSON.parse(valor);
			
			$jan = valor.jan;
			$fev = valor.fev;
			$mar = valor.mar;
			$abr = valor.abr;
			$mai = valor.mai;
			$jun = valor.jun;
			$jul = valor.jul;
			$ago = valor.ago;
			$set = valor.set;
			$out = valor.out;
			$nov = valor.nov;
			$dez = valor.dez;
		}
	});
	
	var ctx = $("#crt_adicionado");
	var crt_adicionado = new Chart(ctx, {
	    type: 'line',
	    data: {
	        labels: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
	        datasets: [{
	            label: 'Adicionados - 2018',
	            data: [$jan, $fev, $mar, $abr, $mai, $jun, $jul, $ago, $set, $out, $nov, $dez],
	            borderColor: '#016936'
	        }]
	    },
	    options: {
	        scales: {
	            yAxes: [{
	            	stacked:true,
	            	ticks: {
	                    beginAtZero:true
	                }
	            }]
	        }
	    }
	});
	
	$('#div_adicionado').removeClass('loading');
});
$(document).ready(function() {
	$('#div_removido').addClass('loading');
	
	var $jan = 0;
	var $fev = 0;
	var $mar = 0;
	var $abr = 0;
	var $mai = 0;
	var $jun = 0;
	var $jul = 0;
	var $ago = 0;
	var $set = 0;
	var $out = 0;
	var $nov = 0;
	var $dez = 0;
	
	$.ajax({
		method: "GET",
		url: "/usuario/meu-perfil/perfil/removido/",
		async: false
	}).done(function(valor) {
		if (valor != false) {
			valor = JSON.parse(valor);
			
			$jan = valor.jan;
			$fev = valor.fev;
			$mar = valor.mar;
			$abr = valor.abr;
			$mai = valor.mai;
			$jun = valor.jun;
			$jul = valor.jul;
			$ago = valor.ago;
			$set = valor.set;
			$out = valor.out;
			$nov = valor.nov;
			$dez = valor.dez;
		}
	});
	
	var ctx = $("#crt_removido");
	var crt_removido = new Chart(ctx, {
	    type: 'line',
	    data: {
	        labels: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
	        datasets: [{
	            label: 'Removidos - 2018',
	            data: [$jan, $fev, $mar, $abr, $mai, $jun, $jul, $ago, $set, $out, $nov, $dez],
	            borderColor: '#B03060'
	        }]
	    },
	    options: {
	        scales: {
	            yAxes: [{
	            	stacked:true,
	            	ticks: {
	                    beginAtZero:true
	                }
	            }]
	        }
	    }
	});
	
	$('#div_removido').removeClass('loading');
});
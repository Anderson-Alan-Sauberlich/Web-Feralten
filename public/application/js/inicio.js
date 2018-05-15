ControlarClassesFundoHeader();
function ControlarClassesFundoHeader() {
	var scren = $("body").width();
	if (scren <= 767) {
		$("#logo_header_fundo").addClass("hidden");
		$("#logo_header_fundo").addClass("mini");
		$("#logo_header_fundo").removeClass("medium");
		$("#logo_header_fundo").removeClass("large");
	}
	if (scren >= 768 && scren <= 991) {
		$("#logo_header_fundo").removeClass("mini");
		$("#logo_header_fundo").addClass("medium");
		$("#logo_header_fundo").removeClass("large");
	}
	if (scren >= 992 && scren <= 1199) {
		$("#logo_header_fundo").removeClass("mini");
		$("#logo_header_fundo").addClass("medium");
		$("#logo_header_fundo").removeClass("large");
	}
	if (scren >= 1200) {
		$("#logo_header_fundo").removeClass("mini");
		$("#logo_header_fundo").removeClass("medium");
		$("#logo_header_fundo").addClass("large");
	}
}
$(window).resize(function() {
	ControlarClassesFundoHeader();
});
$(window).on('load', function(e) {
	var scren = $("body").width();
	if (scren > 767) {
		$('#logo_header_fundo').transition('fly right');
	}
});
$('.ui.dropdown').dropdown();
$('.ui.accordion').accordion();
Controlar_Classes();
$(document).ready(function () {
	Controlar_Classes();
	$('#m_menu_usuario_sidebar').sidebar();
});
function Controlar_Classes() {
	var scren = $("body").width();
	if (scren <= 767) {
		$("#pc_menu_usuario").addClass("hidden");
		$("#m_menu_usuario").removeClass("hidden");
	} else {
		$("#pc_menu_usuario").removeClass("hidden");
		$("#m_menu_usuario").addClass("hidden");
	}
}
$(window).resize(function() {
	Controlar_Classes();
});
function AbrirMobileMenuUsuarioSidebar() {
	$('#m_menu_usuario_sidebar').sidebar('toggle');
}
function MostImgErr($this) {
	$this.src='/resources/img/imagem_indisponivel.png';
}
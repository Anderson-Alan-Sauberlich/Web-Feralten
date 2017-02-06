$(document).ready(function() {
	var url = window.location.href;
	
	if (url.indexOf('/?') !== -1) {
		if (url.indexOf('pagina') !== -1) {
			url = url + '&pagina=';
		} else {
			url = url + '&pagina=';
		}
	} else {
		url = url + '?pagina=';
	}
	
	alert(url);
});
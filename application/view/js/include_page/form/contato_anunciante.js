$('.ui.checkbox').checkbox();
$(document).ready(function() {
	var maskBehavior = function (val) {
		  return val.replace(/\D/g, '').length === 11 ? '(00) 000-000-000' : '(00) 0000-00009';
		},
		options = {onKeyPress: function(val, e, field, options) {
		        field.mask(maskBehavior.apply({}, arguments), options);
		    }
		};

	$('#telefone').mask(maskBehavior, options);
});
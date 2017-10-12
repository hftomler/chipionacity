$(function(){
	$('#modalLogin').click(function(evento) {
		evento.preventDefault();
		$('#modalLoginContent').modal('show')
			.find('#modalContent')
			.load($(this).attr('value'));
	});
	$('#login-form').submit(function(evento) {
		evento.preventDefault();
		alert("HOLA");
	});
});
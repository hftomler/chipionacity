$(function(){
	$('#modalLogin').click(function(evento) {
		evento.preventDefault();
		$('#modalLoginContent').modal('show')
			.find('#modalContent')
			.load($(this).attr('value'));
	});
});
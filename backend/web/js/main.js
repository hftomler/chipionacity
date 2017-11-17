$(function(){

	// Cambiar idioma
	$('.language').click(function() {
		var lang = $(this).attr('id');

		$.post('index.php?r=site/language', {'lang':lang}, function(data) {
			location.reload();
		});
	});

	$('#modalLogin').click(function(evento) {
		evento.preventDefault();
		$('#modalLoginContent').modal('show')
			.find('#modalContent')
			.load($(this).attr('value'));
	});

	$('#profile-pais_id').change(function(e) {
		$.post( "index.php?r=profile/listaprov&id=" + $(this).val(), function ( data ) {
			$( "select#profile-provincia_id" ).html( data );
			$('#profile-provincia_id').trigger( "change" );
		});
	});

	$('#profile-provincia_id').change(function(e) {
		$.post( "index.php?r=profile/listamuni&id=" + $(this).val(), function ( data ) {
			$( "select#profile-municipio_id" ).html( data );
		});
	});

	$('.imgWrap').hover(
		function() {
		  	$(this).children('i').css("visibility", 'visible');
			$(this).children('img').css({
				"border": "1px solid #111",
				"filter": "drop-shadow(2px 2px 3px #000)"
			})
		}, function() {
			$(this).children('i').css("visibility", 'hidden');
			$(this).children('img').css({
				"border": "1px solid #555",
				"filter": "drop-shadow(4px 4px 6px #666)"
			})
  	});

	$('.imgWrap > i[name^="u"]').click(function () {
		var id = $(this).attr('name').substr(1);
		$.post('index.php?r=imgprofile/update&id=' + id, function(data) {
			location.reload();
		});
	});

	$('.imgWrap > i[name^="d"]').click(function () {
		var id = $(this).attr('name').substr(1);
		$.post('index.php?r=imgprofile/delete&id=' + id, function(data) {
			location.reload();
		});
	});

	//Mapear el click de la imagen de perfil hacia el botón de fileUpload que está oculto en Create y Update profile
	$("#swImgPerfil").click(function () {
		if ( $("#checkAvatar").is(':checked')) {
			abrirpopup('index.php?r=profile/avatar','800','600');
		} else {
			$("#btImgPerfil").trigger('click');
		}
    });

	$("#btImgPerfil").change(function(){
		cambiarImgPerfil(this);
	})

	function cambiarImgPerfil(input) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();

	        reader.onload = function (e) {
	            $('#swImgPerfil').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}

	// Función auxiliar para abrir nueva ventana galería avatar
	function abrirpopup(url,ancho,alto){
			//Ajustar horizontalmente
		var x=(screen.width/2)-(ancho/2);
		//Ajustar verticalmente
		var y=(screen.height/2)-(alto/2);
		window.open(url, 'popup', 'width=' + ancho + ', height=' + alto + ', left=' + x + ', top=' + y +'');
	}

	$("#valueAvatar").change(function () {
		$('#swImgPerfil').attr('src', $(this).val());
	});

});

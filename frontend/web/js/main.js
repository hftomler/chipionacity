$(function(){

	// Cambiar idioma
	$('.language').click(function() {
		var lang = $(this).attr('id');

		$.post('index.php?r=site/language', {'lang':lang}, function(data) {
			location.reload();
		});
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
		$(this).parents("#balloon1").remove();
		if ( $("#checkAvatar").is(':checked')) {
			abrirpopup('index.php?r=profile/avatar','800','600');
		} else {
			$("#btImgPerfil").trigger('click');
		}
    });

	$("#checkAvatar").click(function () {
		$("#balloon2").remove();
	})

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

	// FUNCIONES MANEJO MODAL LOGIN
	$('#modalLogin').click(function(evento) {
		evento.preventDefault();
		$('#modalLoginContent').modal('show')
		.find('#modalContentLogin')
		.load($(this).attr('value'));
	});

	$('#modalSignup').click(function(evento) {
		evento.preventDefault();
		$('#modalSignupContent').modal('show')
		.find('#modalContentSignup')
		.load($(this).attr('value'));
	});

	jQuery.balloon.init();
	setTimeout(function(){
	  	$("#balloon1").showBalloon();
  	},1000);
    setTimeout(function(){
	  	$("#balloon2").showBalloon();
  	},7000);

	$(document).ready( function () {
		$('#list').click(function(event){
			event.preventDefault();
			$('#products .item')
				.removeClass('col-xs-4 col-xs-6')
				.addClass('list-group-item col-xs-12');
		});
		$('#big').click(function(event){
			event.preventDefault();$
			('#products .item')
				.removeClass('list-group-item col-xs-4')
				.addClass('col-xs-6');
		});
		$('#grid').click(function(event){
			event.preventDefault();
			$('#products .item')
				.removeClass('col-xs-6 list-group-item')
				.addClass('col-xs-4');
		});
		$('#products figure').mouseover(function (){
			elem = $(this);
			var id = elem.children(":first").attr('id').substr(4);
			array = [];
			var currentImage = -1;
			$.post('index.php?r=servicio/listaurls&id=' + id)
			 	.done (function(data) {
					array = jQuery.parseJSON(data);
				});
			cambiaImagen();

			slideImages = setInterval(cambiaImagen, 2500);

			function cambiaImagen() {
			   currentImage++;
			   if (currentImage > array.length - 1) { currentImage = 0; }
				   elem.children(":first").fadeOut(150, function() {
						   elem.children(":first").attr("src", array[currentImage]);
						   elem.children(":first").fadeIn();
						   // Muchas veces se queda la imagen en display:none
						   // Como si no le diera tiempo a hacer el fadeIn() porque me salgo
			   		});
		   }

		});

		$('#products figure').mouseout(function (){
			elem = $(this);
			clearInterval(slideImages);
			setTimeout(array.splice(0,array.length), 1000);
		});

		$('.select2-selection__arrow').remove();
	});
});

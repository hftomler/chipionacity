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
		$(".weather").weatherFeed({relativeTimeZone:true});
		$('.listServ').click(function(event){
			var th = $(this);
			event.preventDefault();
			th.parent().parent().siblings('.products').children('.item')
				.removeClass('col-md-3 col-md-4 col-md-6')
				.addClass('list-group-item col-md-12');
		});
		$('.bigServ').click(function(event){
			var th = $(this);
			event.preventDefault();$
			th.parent().parent().siblings('.products').children('.item')
				.removeClass('list-group-item col-md-12 col-md-3 col-md-4')
				.addClass('col-md-6');
		});
		$('.gridServ').click(function(event){
			var th = $(this);
			event.preventDefault();
			th.parent().parent().siblings('.products').children('.item')
				.removeClass('col-md-6 col-md-3 list-group-item col-md-12')
				.addClass('col-md-4');
		});
		$('.gridSmallServ').click(function(event){
			var th = $(this);
			event.preventDefault();
			th.parent().parent().siblings('.products').children('.item')
				.removeClass('col-md-6 col-md-4 list-group-item col-md-12')
				.addClass('col-md-3');
		});

		/* Creación de la vista detallada del servicio */
		$('.products figure').click(function () {
			var img = $(this).children(":first");
			var id = img.attr('id').substr(4);
			// Pido los datos del servicio y monto la ficha
			var urlImg = img.attr('src');
			var servicio = "";//var array = {};// Array para guardar el objeto JSON que me devuelve el $.post
			// Pido por AJax el registro que me interesa = id;
			$.post('index.php?r=servicio/servdetalle&id=' + id, function(data) {
				servicio = jQuery.parseJSON(data);
				// CONSTRUYO LA FICHA
				var el = $('#servDetalle');
				el.empty();
				el.fadeOut(100).fadeIn(600);
				var estrellas = "";
				for (i=0; i<Math.trunc(servicio.media_punt); i++) {
					estrellas += "<i class='fa fa-star' aria-hidden='true'></i>";
				}
				if (servicio.media_punt%1 >=0.5) {
					estrellas += "<i class='fa fa-star-half-o' aria-hidden='true'></i>";
					for (i = 0; i< 5-(Math.trunc(servicio.media_punt)+1); i++) {
						estrellas += "<i class='fa fa-star-o' aria-hidden='true'></i>";
					}
				} else {
					for (i = 0; i< 5-(Math.trunc(servicio.media_punt)); i++) {
						estrellas += "<i class='fa fa-star-o' aria-hidden='true'></i>";
					}
				}
				imgServicio = "";
				for (i = 0; i<servicio.imgs.length; i++) {
					imgServicio += "<img src='" + servicio.imgs[i] + "' class='imgServicio-sm img-thumbnail col-xs-3' />";
				}
				cmtr = "\"" + servicio.comentario.comentario + "\"<p class='userComent'>@" + servicio.comentario.autor + " (" + servicio.comentario.fecha + ")</p>";
				el.append("<div class='col-xs-12'>"+
							"<h4 class='col-xs-12 titUpdate well'>"+
								"<i class='col-xs-1 fa fa-info-circle' aria-hidden='true'></i>"+
								"<span class='col-xs-10'>" + servicio.descripcion + "</span>"+
								"<i class='fa fa-picture-o' aria-hidden='true'></i>"+
							"</h4>"+
							"<div class='col-xs-12 col-md-6 separate'>"+
						    	"<img id='imgDetPrinc' src='"+ urlImg + "' class='imgDet'/></div>"+
							"<div class='col-xs-12 col-md-6'>"+
							"<p class='col-xs-12 textDetalle'>\"" + servicio.descripcion_lg + "\"<p>"+
							"<p class='col-xs-8 estreDetalle'>" + servicio.puntuacion + " puntos ("+ estrellas + ")</p>"+
							"<a class='col-xs-3 col-xs-offset-1 btn btn-success unoycuarto'"+
								"href='/index.php?r=venta/addCart&id=" + servicio.id + " title='Añadir al pedido: " + servicio.descripcion + "'>"+
								servicio.precio + " € <i class='fa fa-cart-plus unoycuarto' aria-hidden='true'> </i></a>"+
							"<p class='col-xs-12 textComent'>" + cmtr + "<p>"+
							"<p class='col-xs-12 textAdicServ'>" +
									"<i class='fa fa-clock-o' aria-hidden='true'></i>"+
									" Este servicio tiene una duración aproximada de " + servicio.duracion + " " +
									 ((servicio.duracion>1) ? servicio.plural : servicio.singular) +
									 ((servicio.activo) ? " y <span class='text-success'>actualmente está disponible</span> su reserva" :
									  					  ", lamentablemente <span class='text-danger'>no está disponible</span> para su reserva en la actualidad.") + "</p>"+
							"</div>"+
							"<div id='imgsDetalle' class='col-xs-12 col-md-12'>"+
								imgServicio +
							"</div>"+
						  "</div>"
				);
				// Creo las escuchas para los clics en las miniaturas
				$('#imgsDetalle > img').click( function () {
					$('#imgDetPrinc').attr('src', $(this).attr('src'));
				});

				// MUESTRO LA IMAGEN
				$('html, body').stop().animate({
					 'scrollTop': el.offset().top
				}, 900, 'swing');
			});
		});

		/*$('.products figure').mouseover(function (){
			elem = $(this);
			var id = elem.children(":first").attr('id').substr(4);
			array = [];
			var currentImage = -1;
			$.post('index.php?r=servicio/listaurls&id=' + id)
			 	.done (function(data) {
					array = jQuery.parseJSON(data);
				});
			cambiaImagen();

			if (array.length > 1) { slideImages = setInterval(cambiaImagen, 2500);}

			function cambiaImagen() {
			   currentImage++;
			   if (currentImage > array.length - 1) { currentImage = 0; }
			   elem.children(":first").fadeOut(150, function() {
					   elem.children(":first").attr("src", array[currentImage]);
					   elem.children(":first").fadeIn();
					   // Muchas veces se queda la imagen en display:none
					   // Como si no le diera tiempo a hacer el fadeIn() porque
					   // me salgo del elemento
		   		});
		   }

		});

		$('#products figure').mouseout(function (){
			elem = $(this);
			clearInterval(slideImages);
			setTimeout(array.splice(0,array.length), 1000);
		});*/

		$('.select2-selection__arrow').remove();
	});
});

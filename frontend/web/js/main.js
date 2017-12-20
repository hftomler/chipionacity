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


		$('#modalContact').click(function(evento) {
			evento.preventDefault();
			$('#modalContactContent').modal('show')
			.find('#modalContentContact')
			.load($(this).attr('value'));
		});

	jQuery.balloon.init();
	setTimeout(function(){
	  	$("#balloon1").showBalloon();
  	},1000);
    setTimeout(function(){
	  	$("#balloon2").showBalloon();
  	},7000);
	setTimeout(function(){
	  	$("#balloonSelect2").showBalloon();
  	},25000);



	$(document).ready( function () {
		// Creo el balloon botón "Voy a tener suerte"
		$('.input-group.input-group-md.group-servicios-id.select2-bootstrap-prepend.select2-bootstrap-append').wrap("<div id='balloonSelect2' class='opener box'" +
			    "data-addoverlay='false'"+
			    "data-css='balloon-large'"+
			    "data-highlight='false'"+
			    "data-overlaycolor='linear-gradient(135deg, #337ab7 0%, #ff7e00 100%)'"+
			    "data-overlayopacity='.10'"+
			    "data-bgcolor='#337ab7'"+
			    "data-forceposition='left'"+
			    "data-balloon= '<p class=\"text-center\">Clic en <span class=\"tenerSuerte\"><i class=\"fa fa-lightbulb-o\" aria-hidden=\"true\"></i></span>"+
			    " y llévate</br>una experiencia con un exclusivo </br><span class=\"descuentoBalloon text-center\">¡ 10 <i class=\"fa fa-percent\" aria-hidden=\"true\"></i> descuento!</span></p>'"+
			    "data-timer='6000'"+
			    "data-onlyonce='true'"+
			    "style=''>"+
		"</div>");

		// Bombilla de "Recomiéndame un servicio" & give me "Un descuento"
		$('#tenerSuerte').parent().click(function () {
			var slct = $('.input-group.input-group-md.group-servicios-id.select2-bootstrap-prepend.select2-bootstrap-append');
			if (slct.parent().is( "#balloonSelect2")) { slct.unwrap(); $('#balloonSelect2').remove();}
			$.post('index.php?r=servicio/tenersuerte&promo=' + false, function(data) {
				servicio = jQuery.parseJSON(data);
				cargaDetalle(servicio.id);
			});
		})
		$('#servicios-id').on('select2:opening', function (e) {
			// Animación logo
			var slct = $('.input-group.input-group-md.group-servicios-id.select2-bootstrap-prepend.select2-bootstrap-append');
			if (slct.parent().is( "#balloonSelect2")) { slct.unwrap(); $('#balloonSelect2').remove();}
			if ($('#logo').hasClass('invisible')) {
				$("#logoInicio").next().removeClass().addClass('col-xs-12 titular text-center').prependTo('.site-index');
				$("#logoInicio").remove();
				$('.jumbotron').slideUp('slow').remove();
				$('#logo').css({
					opacity: '0',
					height: '0',
					opacity: '0'});
				$('#logo').removeClass('invisible').animate({
					height: '60px',
					opacity: '1'
				}, 300);
			}
		});
		$('#servicios-id').on('select2:select', function (e) {
			var data = e.params.data;
			cargaDetalle(data.id);
			$(this).val(null).trigger('change'); //Vacío la selección del select2
			//Elimino la opción insertada en el select oculto que está debajo del select2
			$(this).children(':last').remove();
		});
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
			// Llamo a la función de creación del detalle.
			cargaDetalle(id);
		});

		function cargaDetalle(id) {
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
					imgServicio += "<img itemprop='image' src='" + servicio.imgs[i]['url'] + "' class='imgServicio-sm img-thumbnail col-xs-2' alt='" + servicio.imgs[i]['descripcion'] + "' title='" + servicio.imgs[i]['descripcion'] + "'/>";
				}
				cmtr = "\"" + servicio.comentario.comentario + "\"<p itemscope itemtype='http://schema.org/Review' data-id='" +
				 			  servicio.comentario.profile_id + "' class='userComent tooltip_elemento'>@<span itemprop='author'>" + servicio.comentario.autor + "</span> (<span itemprop='dateCreated'>" + servicio.comentario.fecha + "</span>)</p>";
				el.append("<div class='col-xs-12' itemscope itemtype='http://schema.org/Service'>"+
							"<h4 class='col-xs-12 titUpdate well'>"+
								"<i class='col-xs-1 fa fa-info-circle' aria-hidden='true'></i>"+
								"<span class='col-xs-10' itemprop='name'>" + servicio.descripcion + "</span>"+
								"<i class='fa fa-picture-o' aria-hidden='true'></i>"+
							"</h4>"+
							"<div class='col-xs-12 col-md-6 separate'>"+
								"<div class='captionImgDet captionImgDetHij'>"+
									"<p>" + servicio.imgs[0]['descripcion'] + "</p>"+
								"</div>"+
								"<img id='imgDetPrinc' itemprop='image' src='"+ servicio.imgs[0]['url'] + "' class='imgDet'/></div>"+
							"<div class='col-xs-12 col-md-6'>"+
							"<p class='col-xs-12 textDetalle' itemprop='description'>\"" + servicio.descripcion_lg + "\"<p>"+
							"<p class='col-xs-8 estreDetalle' itemprop='aggregateRating' title='Puntuación media: " + servicio.media_punt + " puntos'>" + servicio.puntuacion +
							" puntos (<span itemscope itemtype='http://schema.org/AggregateRating'><meta itemprop='ratingValue' content='" + servicio.media_punt + "'></span>" + estrellas + ")</p>"+
							"<a class='col-xs-3 col-xs-offset-1 btn btn-success unoycuarto'"+
								" itemscope itemtype='http://schema.org/PriceSpecification' href='/index.php?r=ventas/addcart&id_servicio=" + servicio.id + "' title='Añadir al pedido: " + servicio.descripcion + "'><span itemprop='minimumPaymentDue'>"+
								servicio.precio + " €</span> <i class='fa fa-cart-plus unoycuarto' aria-hidden='true'> </i></a>"+
							"<p class='col-xs-12 textComent' itemprop='review'>" + cmtr + "</p>"+
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
				// Creo las escuchas para los clics en las miniaturas y el cambio de imagen principal
				$('#imgsDetalle > img').click( function () {
					$url = $(this).attr('src'); // Url de la miniaturas
					$urlPrinc = $("#imgDetPrinc").attr('src'); // Url de la imagen Principal
					$title = $(this).attr('title');
					if ($url != $urlPrinc) {
						$("#imgDetPrinc")
						.fadeOut(400, function() {
							$("#imgDetPrinc").attr('src', $url);
							$(".captionImgDet p:first-child").html($title);
						})
						.fadeIn(400);
					}
				});

				$('#imgDetPrinc').hover( function () {
					$('.captionImgDet').addClass('captImgDetHovHij');
				}, function() {
					$('.captionImgDet').removeClass('captImgDetHovHij');
				});

				$('.userComent').hover( function (e) {
					var idProfData = $(this).attr('data-id');
					$.post('index.php?r=profile/datosprofile&id=' + idProfData, function(data) {
						profData = jQuery.parseJSON(data);
						var aut = (profData.gender == 'Mujer') ? 'Autora' : 'Autor';
						textoTooltip = "<div class='col-xs-4'><img src='" + profData.img + "' class='imgPerfil-sm img-circle img-thumbnail' /></div>" +
									   "<div class='col-xs-8 middle'><p class='unoycuarto'>" + aut + " del comentario</p><p>" + profData.nombreFull + "<br/>" + profData.gender + " (" + profData.pais + ")</p></div>";
					    $('.userComent').append('<div class="tooltiptext">' + textoTooltip + '</div>').children('.tooltip').show();
				    });
				}, function() {
					$('.tooltiptext').remove();
				});

				// MUESTRO LA IMAGEN
				$('html, body').stop().animate({
					 'scrollTop': el.offset().top
				}, 900, 'swing');
			});
		}

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

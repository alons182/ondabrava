(function($){
	var menu 		= $('.menu'),
		btnMobile 	= $('#btn_nav');

	// NAV MOBILE
    btnMobile.click(function(){
        menu.toggle();

    });


		window.soundManager = new SoundManager();

		// Configure soundManager
		soundManager.setup({
			debugMode: false,
			flashLoadTimeout: 0,
			flashVersion: 9,
			preferFlash: false,
			url: "/radio/swf/",
			useHighPerformance: true,
			waitForWindowLoad: false,
			onready: function() {
				soundManager.createSound({
					id: "webradio",
					url: [{
						type: "audio/mpeg",
						url: "http://moon.wavestreamer.com:3040/;"
					}],
					autoLoad: true,
					autoPlay: true,
					multiShot: false,
					onconnect: function( bConnect ) {
						setButtonStop(); 					},
					onfailure: function() {
						setButtonError(); 					},
					onload: function( bSuccess ) {
						if( bSuccess == true ) {
							setButtonStop(); 						} else {
							setButtonError(); 						}
					},
					onplay: function() {
						setButtonPreloader();											}
				});
			},
			ontimeout: function() {
								 //setButtonError();
							}
		});

		// Define the buttons
		function setButtonError() {
			$( "#sm-button" ).attr( "src", "http://cdn.radiosfm.org/images/error.png" ).attr( "alt", "Error" );
			ga( "send", "event", { eventCategory: "Player", eventAction: "Error" } );
			// logStreamError( "46592", "desktop" );
		}
		function setButtonFlash() {
			$( "#sm-button" ).attr( "src", "http://cdn.radiosfm.org/images/button-get-flash-player.png" ).attr( "alt", "Flash" ).attr( "style", "width:160px !important; height:41px !important;" );
		}
		function setButtonPlay() {
			$( "#sm-button" ).attr( "src", "/img/play.jpg" ).attr( "alt", "Sonar" );
		}
		function setButtonPreloader() {
			$( "#sm-button" ).attr( "src", "/img/preloader.gif" ).attr( "alt", "Cargando..." );
		}
		function setButtonStop() {
			$( "#sm-button" ).attr( "src", "/img/stop.jpg" ).attr( "alt", "Parar" );
		}

		// Set the controls
		$( "#sm-button" ).bind( "click", function() {
			if ( $( this ).attr( "alt" ) == "Flash" ) {
				window.open( 'http://www.adobe.com/go/getflashplayer' );
			} else if ( $( this ).attr( "alt" ) == "Sonar" ) {
				setButtonStop();
				( "desktop" != "desktop" ) ? soundManager.play( "webradio" ) : soundManager.unmute( "webradio" );
			} else if ( $( this ).attr( "alt" ) == "Inicio" ) {
				setButtonPreloader();
				( "desktop" != "desktop" ) ? soundManager.play( "webradio" ) : '';
			} else if ( $( this ).attr( "alt" ) == "Parar" ) {
				setButtonPlay();
				( "desktop" != "desktop" ) ? soundManager.unload( "webradio" ) : soundManager.mute( "webradio" );
			}
		});

		// Kick-start the SoundManager init process?
		if ( "" == "1" && typeof( detectFlash ) === "function" && !detectFlash() ) {
			setButtonFlash();
		} else {
			soundManager.beginDelayedInit();
		}


		$('.contact-link').magnificPopup({

				type:'inline',
				midClick: true, // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
				removalDelay: 500, //delay removal by X to allow out-animation
				callbacks: {
						beforeOpen: function() {

								this.st.mainClass = this.st.el.attr('data-effect');
						}

				}
		});

		//VALIDATE

		$("form[data-remote]").validate({
			submitHandler: function(form) {

				var form = $(form);
				var method = form.find('input[name="_method"]').val() || 'POST';
				var url = form.prop('action');

				$.ajax({
						type: method,
						url: url,
						data: form.serialize(),
						success: function(){
								var message = form.data('remote-success-message');

								if(message)
								{

										$('.message').removeClass('message-error').addClass('message-success').html(message).fadeIn(300).delay(2500).fadeOut(300);
								}
						},
						error:function(){
								$('.message').removeClass('message-success').addClass('message-error').html('Upss, Parece que ha ocurrido un error.').fadeIn(300).delay(2500).fadeOut(300);

						}
				});

				limpiaForm(form);
			}
		});



		$('input[data-confirm], button[data-confirm]').on('click', function(e){
			var input = $(this);

				input.prop('disabled','disabled');

				if(! confirm(input.data('confirm'))){
						e.preventDefault();
				}
		});

		function limpiaForm(miForm) {

				// recorremos todos los campos que tiene el formulario
				$(":input", miForm).each(function() {
						var type = this.type;
						var tag = this.tagName.toLowerCase();
						//limpiamos los valores de los campos…
						if (type == 'text' || type == 'password'  || type == 'email' || tag == 'textarea')
								this.value = "";
						// excepto de los checkboxes y radios, le quitamos el checked
						// pero su valor no debe ser cambiado
						else if (type == 'checkbox' || type == 'radio')
								this.checked = false;
						// los selects le ponesmos el indice a -
						else if (tag == 'select')
								this.selectedIndex = -1;
				});
		}

		getVideos();

		function getVideos(){

			var resultSemana = $('.videos-semana > div');
			var result90s = $('.videos-90s > div');
			var result80s = $('.videos-80s > div');
			var resultConcierto = $('.videos-concierto > div');

			$.ajax({
					type: 'GET',
					url: '/admin/videoteca.json',
					dataType:'json',
					success: function(data){



							var videosSemana =  $.map(data ,function(obj, index){

								if(obj.category === "semana")
										return obj;

            	});
							var videosConciertoArtistaPelicula =  $.map(data ,function(obj, index){

								if(obj.category === "concierto" || obj.category === "artista" || obj.category === "pelicula" )
										return obj;

            	});
							var videos80s=  $.map(data ,function(obj, index){

								if(obj.category === "80s")
										return obj;

            	});
							var videos90s =  $.map(data ,function(obj, index){

								if(obj.category === "90s")
										return obj;

            	});



							var source = $.trim( $('#videoTemplate').html() );


							var template = Handlebars.compile( source );



							resultSemana.html( template(videosSemana) );
							result90s.html( template(videos90s) );
							result80s.html( template(videos80s) );
							resultConcierto.html( template(videosConciertoArtistaPelicula) );

					},
					error:function(){


					}
			});

		}





})(jQuery);

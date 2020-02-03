//ACA SE VA A CREAR TODA LA FUNCIONALIDAD DE LA APLICACION, SUPEEERRRRRRRR MODALLLLL!!! SIIIII!! WUUUJUUU

$(document).ready(function () {

	var current_fs, next_fs, previous_fs; //variables donde voy a guardar a los elementos que voy a manejar. (actual,padre siguiente, padre anterior)
	var animating; //variable sobre la cual voy a realizar la animacion 
	//---------------(Vectores)-----------------------
	var sfb = new Array();//array donde se va a guardar los datos obtenidos en el formulario por parte del (usuario)
	var vector = new Array();//array que donde se va a guardar los datos obtenidos en el formulario por parte del (usuario) y luego mandar por POST
	var tabla = new Array();
	//------------------------------------------------
	var bandera = 0;//se va a utilizar para ...


	//BOTON PARA EMPEZAR EL FORMULARIO  (Bton Nuevo)
	$("#btnNuevo").click(function (e) {
		e.preventDefault();

		sessionStorage.clear();

		$.ajax({
			type: "POST",
			dataType: 'json',
			url: "formulario2.php",
			success: function (data) {
				$('#contenido').html(data[0]['resultado']);
			},
			error: function (data) {
				console.log(data);
			}
		});
		return false;
	});

	//------------------------------------------- BOTONES PARA AVANZAR EN LA APLICACION -------------------------------------------------------

	//Boton NEXT donde selecciono alguna de las opciones y envio el valor al formulario2.php, 
	//para no perder la informacion que luego se va a guardar en la BD. y muestro el contenido en el div(Contenido).
	$(".next").click(function () {
		bandera++;
		if ($('#tool-1').prop('checked')) {
			var tool = $('#tool-1').val();
			var contador = 1;
		}
		if ($('#tool-2').prop('checked')) {
			var tool = $('#tool-2').val();
			var contador = 1;
		}
		if ($('#tool-3').prop('checked')) {
			var tool = $('#tool-3').val();
			var contador = 1;
		}
		if ($('#tool-4').prop('checked')) {
			var tool = $('#tool-4').val();
			var contador = 2;
		}
		if ($('#tool-5').prop('checked')) {
			var tool = $('#tool-5').val();
			var contador = 2;
		}
		if ($('#tool-6').prop('checked')) {
			var tool = $('#tool-6').val();
			var contador = 2;
		}
		if ($('#tool-7').prop('checked')) {
			var tool = $('#tool-7').val();
			var contador = 3;
		}
		if ($('#tool-8').prop('checked')) {
			var tool = $('#tool-8').val();
			var contador = 3;
		}
		if ($('#tool-9').prop('checked')) {
			var tool = $('#tool-9').val();
			var contador = 3;
		}

		if (tool != null) {

			var i = 0;
			var e = 0;
			sfb.push(tool)

			if (bandera < 4) {
				//PERMITE AGREGAR VALORES A LA SESION
				sessionStorage.setItem(contador, sfb);

				if (bandera == 3) {
					//PERMITE RECORRER LA SESION Y MOSTRARLA POR CONSOLA
					for (i = 0; i <= sessionStorage.length; i++) {

						vector.push(sessionStorage.getItem(i));
					}
				}
			}
			// console.log(sfb);
			$.ajax({
				type: "POST",
				url: "./formulario2.php",
				data: {
					tool: tool,
				},
				success: function (data) {
					$('#contenido2').html(data[0]['resultado']);
				},
				error: function (data) {
				}
			});

			current_fs = $(this).parent();//me dsessioevuelve el padre del elemento actual(button)
			next_fs = $(this).parent().next();//me devuelve el siguiente padre del elemento actual (button)
			ant_fs = $(this).parent().prev();//me devuelve el padre anterior del elemento actual (button)

			$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");//de acuerdo al indice del fielset donde me encuentro parado mueve progressbar y lo activa mediante el addClass "Active" que se encuentra en el formulario.css 
			$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

			$('#btnNuevo').hide();

			switch (contador) {
				case 1:
					next_fs.show();
					break;
				case 2:
					next_fs.show();
					break;
				case 3:
					next_fs.show();
					break;
			}
			// next_fs.show();//muestra el siguiente padre del elemento actual (button)

			// ocultar el conjunto de campos actual con estilo
			current_fs.animate({ opacity: 0 }, {
				step: function (now, mx) {

					scale = 1 - (1 - now) * 0.2;
					//2. bring next_fs from the right(50%)
					left = (now * 50) + "%";
					//3. increase opacity of next_fs to 1 as it moves in
					opacity = 1 - now;
					current_fs.css({ 'transform': 'scale(' + scale + ')' });
					next_fs.css({ 'left': left, 'opacity': opacity });
				},
				duration: 800,
				complete: function () {
					current_fs.hide();
				},
				//this comes from the custom easing plugin
				easing: 'easeInOutBack'

			});
		} else {
			var div = "<br> <script>alertify.warning('No selecciono ninguna opción');</script> <br>";
			$("#contenido2").html(div);
		}

	});

	//PERMITE ABRIR EL MODAL
	$('#contenido').on('click', '#aplicaciones', function () {

		$("#mdAplicacion").modal({});
		return false;

	});


	//ME VA A PERMITIR VOLVER UN PASO ATRAS PARA CAMBIAR ALGO EN EL FORMULARIO
	$(".previous").click(function () {

		if (animating) return false;
		animating = true;

		current_fs = $(this).parent();
		previous_fs = $(this).parent().prev();

		//de-activate current step on progressbar
		$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
		$("#progressbar li").eq($("fieldset").index(previous_fs)).addClass("active");//de acuerdo al indice del fielset donde me encuentro parado mueve progressbar y lo activa mediante el addClass "Active" que se encuentra en el formulario.css 
		//show the previous fieldset
		previous_fs.show();
		//hide the current fieldset with style
		current_fs.animate({ opacity: 0 }, {
			step: function (now, mx) {
				//as the opacity of current_fs reduces to 0 - stored in "now"
				//1. scale previous_fs from 80% to 100%
				scale = 0.8 + (1 - now) * 0.2;
				//2. take current_fs to the right(50%) - from 0%
				left = ((1 - now) * 50) + "%";
				//3. increase opacity of previous_fs to 1 as it moves in
				opacity = 1 - now;
				current_fs.css({ 'left': left });
				previous_fs.css({ 'transform': 'scale(' + scale + ')', 'opacity': opacity });
			},
			duration: 800,
			complete: function () {
				current_fs.hide();
				animating = false;
				estado = null;
			},
			//this comes from the custom easing plugin
			easing: 'easeInOutBack'
		});
	});

	//ME VA A PERMITIR VOLVER UN PASO ATRAS PARA CAMBIAR ALGO EN EL FORMULARIO
	$(".previous1").click(function () {

		var estado = 2;

		$.ajax({
			type: "POST",
			dataType: 'json',
			url: "./formulario2.php",
			data: { estado: estado },
			success: function (data) {
				$('#contenido').html(data[0]['resultado']);
			},
			error: function (data) {
			}
		});

		if (animating) return false;
		animating = true;

		current_fs = $(this).parent();
		previous_fs = $(document.getElementById('servicio')).parent();

		//de-activate current step on progressbar
		$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
		$("#progressbar li").eq($("fieldset").index(previous_fs)).addClass("active");//de acuerdo al indice del fielset donde me encuentro parado mueve progressbar y lo activa mediante el addClass "Active" que se encuentra en el formulario.css 
		//show the previous fieldset
		previous_fs.show();
		//hide the current fieldset with style
		current_fs.animate({ opacity: 0 }, {
			step: function (now, mx) {
				//as the opacity of current_fs reduces to 0 - stored in "now"
				//1. scale previous_fs from 80% to 100%
				scale = 0.8 + (1 - now) * 0.2;
				//2. take current_fs to the right(50%) - from 0%
				left = ((1 - now) * 50) + "%";
				//3. increase opacity of previous_fs to 1 as it moves in
				opacity = 1 - now;
				current_fs.css({ 'left': left });
				previous_fs.css({ 'transform': 'scale(' + scale + ')', 'opacity': opacity });
			},
			duration: 800,
			complete: function () {
				current_fs.hide();
				animating = false;
				estado = null;
			},
			//this comes from the custom easing plugin
			easing: 'easeInOutBack'
		});
	});


	$('.next1').click(function () {
		//rrecorro la sesion para ir sacando la informacion y guardarla en un array(tabla)
		for (i = 0; i <= sessionStorage.length; i++) {

			tabla.push(sessionStorage.getItem(i));

		}
		//envio por metodo POST, al php "altaFormulario.php", el array tabla.
		$.post('./altaFormulario.php', {
			tabla: tabla,
		}, function (data) {
			console.log(tabla);
		});

		current_fs = $(this).parent();//me dsessioevuelve el padre del elemento actual(button)
		next_fs = $(this).parent().next();//me devuelve el siguiente padre del elemento actual (button)
		ant_fs = $(this).parent().prev();//me devuelve el padre anterior del elemento actual (button)

		$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");//de acuerdo al indice del fielset donde me encuentro parado mueve progressbar y lo activa mediante el addClass "Active" que se encuentra en el formulario.css 
		$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

		next_fs.show();

		// ocultar el conjunto de campos actual con estilo
		current_fs.animate({ opacity: 0 }, {
			step: function (now, mx) {
				scale = 1 - (1 - now) * 0.2;
				left = (now * 50) + "%";
				opacity = 1 - now;
				current_fs.css({ 'transform': 'scale(' + scale + ')' });
				next_fs.css({ 'left': left, 'opacity': opacity });
			},
			duration: 800,
			complete: function () {
				current_fs.hide();
			},
			easing: 'easeInOutBack'

		});

		setTimeout(function () {
			$('.holu').fadeOut('fast');
			location.reload();
		}, 1800);
	});


});



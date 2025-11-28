
	<!DOCTYPE html>
	<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv='cache-control' content='no-cache'>
		<meta http-equiv='expires' content='0'>
		<meta http-equiv='pragma' content='no-cache'>
		<title>Cuestionario de Satisfación IKEA</title>
		<!-- Bootstrap -->
		<link href="../css/bootstrap.css" rel="stylesheet">
		<link href="../css/esfocc.css" rel="stylesheet">
		<link href="../css/esfocc.css" rel="stylesheet">

		<script src="../js/jquery-1.10.2.js"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>
		<script src="../js/jquery.validate.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>

	</head>

	<style type="text/css">

		@media (max-width: 1000px) {
		
			#preguntacuadro {
				width: 100%;
				left: 0;
			}

			#cuadrogeneral {
				margin-left: 0 !important;
			}

			#logoikea, #logoesfocc {
				text-align: center !important;
			}

		}

	</style>


<?


    include_once('../functions/funciones.php');
    $id_mat = $_GET[id_mat];
    $id_alu = $_GET[id_alu];

    if ( isset($id_mat) && isset($id_alu) ) {

	    $q = 'SELECT * FROM matriculas m, acciones a, grupos_acciones ga, centros c
	    WHERE m.id_accion = a.id
	    AND m.id_grupo = ga.id
	    AND m.centro = c.id
	    AND m.id = '.$id_mat;
	    // echo $q;
	    $q = mysqli_query($link, $q) or die("error: " . mysqli_error($link));

	    $row = mysqli_fetch_array($q);
	    $denominacion = $row[denominacion];
	    $centro = $row[nombrecentro];

	}
    
?>
	

	<form class="formularioevaluacion form-horizontal" id="formulario" role="form" action="" method="post">
	<div style="margin-top: 30px" class="container">
	
	<div style="display:none" id="confirmacion" class="alert alert-success">Encuesta guardada correctamente.</div>
	<!-- <div style="display:none" id="error" class="alert alert-danger">El Nº de Documento introducido ya existe en la base de datos.</div> -->

	<div class="col-md-3">	
		<div id="logoesfocc" style="margin: 30px 0 30px 0; text-align: right">
			<img style="width: 215px; " src="http://gestion.esfocc.com/app/documentacion/guias/img/esfocclogo.png" alt="">
    	</div>
	</div>

	<div class="col-md-6" style="text-align: center; margin-top: 30px">
		<h2 style="margin-top: -5px">Cuestionario de Satisfacción</h2>
		<h4>Curso: <? echo ucwords(mb_strtolower($denominacion,'UTF-8')) ?></h4>
		<h4>Lugar: <? echo ucwords($centro) ?></h4>
	</div>

	<div class="col-md-3">	
		<div id="logoikea" style="margin: 35px 0 30px 0px; text-align: left">
			<img style="width: 215px;" src="http://gestion.esfocc.com/app/img/ikealogo.png" alt="">
    	</div>
	</div>
	
	<div class="clearfix"></div>

	<hr>

<!-- 	<div class="form-group">
    	<div class="col-md-2" style="margin-top: 20px;">
		   	<label class="control-label" for="cifnif">CIF/NIF:</label></div>
	    	<div class="col-md-3" style="margin-top: 20px;">
    	    	<input type="text" id="cifnif" name="cifnif" class="form-control"/>
    		</div>
	</div>
	
	<p style="margin-top: 15px;">Le solicitamos dos minutos de su tiempo para realizar este pequeño cuestionario, debiendo evaluar las preguntas del 1 al 10, siendo “1” el de menor satisfacción y “10” el de mayor satisfacción.</p>

	<p style="margin-bottom: 30px;">La pregunta para todos los ítems a realizar sería ¿Cuál es su grado de satisfacción con...?</p>

	
	<div class="col-md-2 pull-right">
		Alta Satisfacción
	</div>
	<div class="col-md-2 pull-right">
		Media Satisfacción
	</div>
	<div class="col-md-2 pull-right">
		Baja Satisfacción
	</div>
 -->
	<div class="clearfix"></div>


	<div id="cuadrogeneral" style="margin-left: 100px;">
		
		<div style="text-align:left; margin-top: 20px" class="col-md-push-2 col-md-8" id="preguntacuadro">
			<div class="col-md-12">
				<h4>¿Cuál es tu opinión general de esta acción formativa?</h4><br>
			</div>
		    <div class="form-group">
		    	<div class="col-md-10" style="margin-left: 15px;">
				   	<label class="control-label" for="pregunta1">1. La formación, ¿cubrió tus expectativas?</label>
				   	<select style="" name="pregunta1" id="pregunta1" class="required form-control">
					    	<option value="">Selecciona tu respuesta</option>
					    	<option value="0">No estoy nada satisfecho con el curso</option>
					    	<option value="5">Estoy satisfecho</option>
					    	<option value="10">Estoy muy satisfecho con el curso</option>
					</select>
				</div>
			</div>
		</div>

		<div class="clearfix"></div>

		<div style="text-align:left; margin-top: 20px" class="col-md-push-2 col-md-8" id="preguntacuadro">
			<div class="form-group">
			  	<div class="col-md-10" style="margin-left: 15px;">
				   	<label class="control-label" for="pregunta2">2. Esta acción formativa, ¿es aplicable a tu trabajo diario?</label>
				   	<select style="" name="pregunta2" id="pregunta2" class="required form-control">
				    	<option value="">Selecciona tu respuesta</option>
				    	<option value="0">No es aplicable a mi trabajo diario</option>
				    	<option value="5">Es aplicable</option>
				    	<option value="10">Es aplicable y mejora mi trabajo diario</option>
					</select>
				</div>
			</div>
		</div>

		<div class="clearfix"></div>

		<div style="text-align:left; margin-top: 50px" class="col-md-push-2 col-md-8" id="preguntacuadro">
			<div class="col-md-12">
				<h4>Sobre el formador...</h4><br>
				<p style="font-weight:bold">3. ¿Cuál es tu opinión sobre su...?</p>
			</div>
		    <div class="form-group">
		    	<div class="col-md-10" style="margin-left: 15px;">
				   	<label class="control-label" for="pregunta31">Conocimiento de la materia tratada</label>
				   	<select style="" name="pregunta31" id="pregunta31" class="required form-control">
					    	<option value="">Selecciona tu respuesta</option>
					    	<option value="0">No estoy nada satisfecho con el curso</option>
					    	<option value="5">Estoy satisfecho</option>
					    	<option value="10">Estoy muy satisfecho con el curso</option>
					</select>
				</div>
			</div>

			<div class="form-group">
		    	<div class="col-md-10" style="margin-left: 15px;">
				   	<label class="control-label" for="pregunta32">Claridad en sus explicaciones</label>
				   	<select style="" name="pregunta32" id="pregunta32" class="required form-control">
					    	<option value="">Selecciona tu respuesta</option>
					    	<option value="0">No estoy nada satisfecho con el curso</option>
					    	<option value="5">Estoy satisfecho</option>
					    	<option value="10">Estoy muy satisfecho con el curso</option>
					</select>
				</div>
			</div>

			<div class="form-group">
		    	<div class="col-md-10" style="margin-left: 15px;">
				   	<label class="control-label" for="pregunta33">Conocimiento de la aplicación del contenido a la realidad de la tienda</label>
				   	<select style="" name="pregunta33" id="pregunta33" class="required form-control">
					    	<option value="">Selecciona tu respuesta</option>
					    	<option value="0">No estoy nada satisfecho con el curso</option>
					    	<option value="5">Estoy satisfecho</option>
					    	<option value="10">Estoy muy satisfecho con el curso</option>
					</select>
				</div>
			</div>

			<div class="form-group">
		    	<div class="col-md-10" style="margin-left: 15px;">
				   	<label class="control-label" for="pregunta34">Conocimiento de los asistentes y sus necesidades</label>
				   	<select style="" name="pregunta34" id="pregunta34" class="required form-control">
					    	<option value="">Selecciona tu respuesta</option>
					    	<option value="0">No estoy nada satisfecho con el curso</option>
					    	<option value="5">Estoy satisfecho</option>
					    	<option value="10">Estoy muy satisfecho con el curso</option>
					</select>
				</div>
			</div>

		</div>

		<div class="clearfix"></div>

		<div style="text-align:left; margin-top: 50px" class="col-md-push-2 col-md-8" id="preguntacuadro">
			<div class="col-md-12">
				<h4>Sobre los detalles que afectan al desarrollo del curso...</h4><br>
				<p style="font-weight:bold">4. ¿Podrías valorar la comunicación realizada antes del encuentro respecto a...?</p>
			</div>
		    <div class="form-group">
		    	<div class="col-md-10" style="margin-left: 15px;">
				   	<label class="control-label" for="pregunta41">La fecha de realización del curso</label>
				   	<select style="" name="pregunta41" id="pregunta41" class="required form-control">
					    	<option value="">Selecciona tu respuesta</option>
					    	<option value="0">No estoy nada satisfecho con el curso</option>
					    	<option value="5">Estoy satisfecho</option>
					    	<option value="10">Estoy muy satisfecho con el curso</option>
					</select>
				</div>
			</div>

			<div class="form-group">
		    	<div class="col-md-10" style="margin-left: 15px;">
				   	<label class="control-label" for="pregunta42">Objetivos y contenidos del curso</label>
				   	<select style="" name="pregunta42" id="pregunta42" class="required form-control">
					    	<option value="">Selecciona tu respuesta</option>
					    	<option value="0">No estoy nada satisfecho con el curso</option>
					    	<option value="5">Estoy satisfecho</option>
					    	<option value="10">Estoy muy satisfecho con el curso</option>
					</select>
				</div>
			</div>

			<div class="form-group">
		    	<div class="col-md-10" style="margin-left: 15px;">
				   	<label class="control-label" for="pregunta43">Horarios y duración de la acción formativa</label>
				   	<select style="" name="pregunta43" id="pregunta43" class="required form-control">
					    	<option value="">Selecciona tu respuesta</option>
					    	<option value="0">No estoy nada satisfecho con el curso</option>
					    	<option value="5">Estoy satisfecho</option>
					    	<option value="10">Estoy muy satisfecho con el curso</option>
					</select>
				</div>
			</div>

			<div class="form-group">
		    	<div class="col-md-10" style="margin-left: 15px;">
				   	<label class="control-label" for="pregunta44">Lugar de celebración</label>
				   	<select style="" name="pregunta44" id="pregunta44" class="required form-control">
					    	<option value="">Selecciona tu respuesta</option>
					    	<option value="0">No estoy nada satisfecho con el curso</option>
					    	<option value="5">Estoy satisfecho</option>
					    	<option value="10">Estoy muy satisfecho con el curso</option>
					</select>
				</div>
			</div>

			<div class="clearfix"></div>

				<div class="col-md-12" style="margin-top: 20px;min-height:20px;">
					<p style="font-weight:bold;">5. ¿Cuál es tu opinión sobre los recursos que facilitan el desarrollo de la formación?</p>
				</div>
				<div class="form-group">
				  	<div class="col-md-10" style="margin-left: 15px;">
					   	<label class="control-label" for="pregunta51">Sala</label>
					   	<select style="" name="pregunta51" id="pregunta51" class="required form-control">
					    	<option value="">Selecciona tu respuesta</option>
					    	<option value="0">No es aplicable a mi trabajo diario</option>
					    	<option value="5">Es aplicable</option>
					    	<option value="10">Es aplicable y mejora mi trabajo diario</option>
						</select>
					</div>
				</div>

				<div class="form-group">
		    	<div class="col-md-10" style="margin-left: 15px;">
				   	<label class="control-label" for="pregunta52">Material</label>
				   	<select style="" name="pregunta52" id="pregunta52" class="required form-control">
					    	<option value="">Selecciona tu respuesta</option>
					    	<option value="0">No estoy nada satisfecho con el curso</option>
					    	<option value="5">Estoy satisfecho</option>
					    	<option value="10">Estoy muy satisfecho con el curso</option>
					</select>
				</div>
				</div>


			<div class="clearfix"></div>

				<div class="form-group">
				  	<div class="col-md-10" style="margin: 20px 0 0 15px;">
					   	<label class="control-label" for="pregunta6">6. El tiempo previsto para la realización del curso, fue...</label>
					   	<select style="" name="pregunta6" id="pregunta6" class="required form-control">
					    	<option value="">Selecciona tu respuesta</option>
					    	<option value="0">Inadecuado: faltó / sobró tiempo</option>
					    	<option value="5">Inadecuado: pudimos ver todo el contenido, pero no hubo tiempo para reflexionar y/o hacer descansos</option>
					    	<option value="10">Adecuado: dio tiempo a ver todo el contenido, a reflexionar sobre el mismo y hace descansos</option>
						</select>
					</div>
				</div>

				<div class="clearfix"></div>

					<div class="form-group">
					  	<div class="col-md-10" style="margin: 20px 0 0 15px;">
						   	<label class="control-label" for="pregunta7">7. ¿Cuál es tu opinión sobre el grupo de asistentes a la formación:</label>
						   	<select style="" name="pregunta7" id="pregunta7" class="required form-control">
						    	<option value="">Selecciona tu respuesta</option>
						    	<option value="0">Inadecuado: demasiado grande</option>
						    	<option value="5">Inadecuado: había diferentes necesidades que dificultaron el desarrollo del curso</option>
						    	<option value="10">Adecuado: dio tiempo a ver todo el contenido, a reflexionar sobre el mismo y hace descansos</option>
							</select>
						</div>
					</div>

			<div class="clearfix"></div>

		
		</div>

		<div style="text-align:left; margin-top: 50px" class="col-md-push-2 col-md-8" id="preguntacuadro">
			<div class="col-md-12">
				<h4>Posibles mejoras</h4>
			</div>
		    <div class="form-group">
		    	<div class="col-md-10" style="margin-left: 15px;">
				   	<label class="control-label" for="mejora1">8. ¿Qué crees que podemos mejorar?</label>
				   	<textarea class="form-control" name="mejora1" id="mejora1" cols="30" rows="5"></textarea>
				</div>
			</div>

			<div class="form-group">
		    	<div class="col-md-10" style="margin-left: 15px;">
				   	<label class="control-label" for="mejora1">9. ¿Qué otras formaciones te gustaría que se desarrollasen?</label>
				   	<textarea class="form-control" name="mejora2" id="mejora2" cols="30" rows="5"></textarea>
				</div>
			</div>

		</div>



		</div>

		<div class="clearfix"></div>

	<!--     <div class="form-group">
	    	<div class="col-md-6">
			   	<label class="control-label" for="pregunta10">10. Como conoció el servicio que presta ESFOCC:</label></div>
		    	<div class="col-md-6">
			    	<select name="pregunta10" id="pregunta10" class="required form-control">
				    	<option value="0">Indica cómo nos conociste</option>
				    	<option value="Internet">Internet</option>
				    	<option value="Comerciales">Comerciales</option>
				    	<option value="Conocidos">Conocidos</option>
				    	<option value="Asociaciones">Asociaciones</option>
				    	<option value="Otros">Otros</option>
				    </select>
				</div>
	    </div>

	    </div>  


		<div class="clearfix"></div>
		<div class="form-group">
			<div class="col-md-12" style="margin-top: 20px;">
				<label class="control-label" for="observaciones">Observaciones y Áreas de Mejora (Anotar cualquier aspecto que el cliente quiera resaltar como aspectos positivos, negativos o áreas de mejora):</label>
				<textarea id="observaciones" name="observaciones" class="form-control" rows="3"></textarea>
			</div>
		</div>
	 --> 	<div class="clearfix"></div>
	   	
	   	</div>
	   	<input type="hidden" id="id_matricula" name="id_matricula" value="<? echo $id_mat ?>">
	   	<input type="hidden" id="id_alumno" name="id_alumno" value="<? echo $id_alu ?>">
		<input name="tabla" type="hidden" id="tabla" value="cuestionario_ikea" />
		<p style="text-align: center; margin-top: 30px;">
		  <a id="guardacuestionarioikea" class="btn btn-primary btn-lg">Enviar Cuestionario</a>
		</p>

	</form>

		<div class="modal fade" id="confirmar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
								&times;
							</button>
							<h3 class="modal-title" id="myModalLabel">Confirmación</h3>
						</div>
						<div class="modal-body">
							<br>
							<p style="text-align:center; font-size: 16px;">¿ Estás seguro de que quieres guardar los cambios ?</p>
							<p id="otromensaje" style="text-align:center; font-size: 16px;"></p>
						</div>
						<div class="modal-footer">
							<button id="aceptacambios" type="button" class="btn btn-success" >
								Sí
							</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal">
								No
							</button>
						</div>
					</div>
				</div>
	</div>
	</div>


<script>
	

		$(document).on("click", "a#guardacuestionarioikea", function(event){

			var values = $('.formularioevaluacion').find("input[type='hidden'], :input:not(:hidden)").serialize();
			
			// if ( $('#cifnif').val().length != 9 ) {
			// 	alert("Introduce un CIF/NIF correcto.");
			// 	return false;
			// }
			
			if ( $('select[id^=pregunta]').val() == "" ) {
				alert("Contesta todas las preguntas.");
				return false;
			}

			// alert("ok");
			// alert(values);

			// var n = $( "input:checked" ).length;

			// if ( n!= 9 ) {
			// 	alert("Contesta todas las preguntas.");
			// 	return false;
			// }

			$.ajax({
				cache: false,
				type: 'POST',
				url: '../functions/funciones.php',
				data: values+'&guardacuestionarioikea=1',
				success: function(data) 
				{
					if (data == 'error')
			        	alert("error");
			        else {
			        	$('body, html').animate({ scrollTop: $(".formularioevaluacion").offset().top }, 1000);
			        	$('#confirmacion').show(500).delay(2000).hide('slow');
			        	setTimeout(function(){location.reload();},2200);
			        }
				} 
			}); ajax.abort();


		});


</script>


</html>

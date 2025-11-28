
	<!DOCTYPE html>
	<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv='cache-control' content='no-cache'>
		<meta http-equiv='expires' content='0'>
		<meta http-equiv='pragma' content='no-cache'>
		<!-- Bootstrap -->
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/esfocc.css" rel="stylesheet">

		<script src="js/jquery-1.10.2.js"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>
		<script src="js/jquery.validate.min.js"></script>
		<script src="js/bootstrap.min.js"></script>

	</head>

<?
	$baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
    include_once($baseurl.'functions/funciones.php');
    
?>
	
	
	<form class="formularioevaluacion form-horizontal" id="formulario" role="form" action="" method="post">
	<div style="margin-top: 30px" class="container">
	
	<div style="display:none" id="confirmacion" class="alert alert-success">Encuesta guardada correctamente.</div>
	<!-- <div style="display:none" id="error" class="alert alert-danger">El Nº de Documento introducido ya existe en la base de datos.</div> -->

	<div class="col-md-4">	
		<div style="margin: 30px 0 30px 50px">
			<img style="width: 200px" src="http://gestion.esfocc.com/app/documentacion/guias/img/esfocclogo.png" alt="">
    	</div>
	</div>

	<div class="col-md-8 pull-right" style="text-align: center; margin-top: 30px">
		<h1>Cuestionario de Satisfacción Empresa</h1>
	</div>
	<div class="clearfix"></div>

	<div class="form-group">
    	<div class="col-md-1" style="margin-top: 20px;">
		   	<label class="control-label" for="cif">CIF:</label></div>
	    	<div class="col-md-3" style="margin-top: 20px;">
    	    	<input type="text" id="cif" name="cif" class="form-control"/>
    		</div>
    	<div class="col-md-2" style="margin-top: 20px;">
		   	<label class="control-label" for="servicio">Servicio:</label></div>
	    	<div class="col-md-5" style="margin-top: 20px;">
    	    	<input type="text" id="servicio" name="servicio" class="form-control"/>
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

	<div class="clearfix"></div>

    <div class="form-group">
    	<div class="col-md-6">
		   	<label class="control-label" for="pregunta1">1. Calidad en la atención telefónica y presencial:</label></div>
	    	<div class="col-md-6">
		    	<label class="radio-inline">
					<input type="radio" name="pregunta1" id="pregunta1" value="1">					
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta1" id="pregunta1" value="2">					
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta1" id="pregunta1" value="3">
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta1" id="pregunta1" value="4">
				</label>
		    	<label class="radio-inline" style="margin-left: 80px">
					<input type="radio" name="pregunta1" id="pregunta1" value="5">					
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta1" id="pregunta1" value="6">					
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta1" id="pregunta1" value="7">
				</label>
				<label class="radio-inline" style="margin-left: 100px">
					<input type="radio" name="pregunta1" id="pregunta1" value="8">
				</label>
		    	<label class="radio-inline">
					<input type="radio" name="pregunta1" id="pregunta1" value="9">					
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta1" id="pregunta1" value="10">					
				</label>
			</div>
			<div class="col-md-6 pull-right" style="margin-top: -15px">
				<div style="float:left; margin-left: 0px;">1</div><div style="float:left; margin-left:28px;">2</div><div style="float:left; margin-left:28px;">3</div><div style="float:left; margin-left:28px;">4</div>
				<div style="float:left; margin-left: 92px;">5</div><div style="float:left; margin-left: 28px;">6</div><div style="float:left; margin-left: 28px;">7</div><div style="float:left; margin-left: 113px;">8</div>
				<div style="float:left; margin-left: 27px;">9</div><div style="float:left; margin-left: 24px;">10</div>
			</div>
    </div>  	

    <div class="form-group">
    	<div class="col-md-6">
		   	<label class="control-label" for="pregunta2">2. Profesionalidad y conocimientos de los comerciales de ESFOCC:</label></div>
	    	<div class="col-md-6">
		    	<label class="radio-inline">
					<input type="radio" name="pregunta2" id="pregunta2" value="1">					
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta2" id="pregunta2" value="2">					
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta2" id="pregunta2" value="3">
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta2" id="pregunta2" value="4">
				</label>
		    	<label class="radio-inline" style="margin-left: 80px">
					<input type="radio" name="pregunta2" id="pregunta2" value="5">					
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta2" id="pregunta2" value="6">					
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta2" id="pregunta2" value="7">
				</label>
				<label class="radio-inline" style="margin-left: 100px">
					<input type="radio" name="pregunta2" id="pregunta2" value="8">
				</label>
		    	<label class="radio-inline">
					<input type="radio" name="pregunta2" id="pregunta2" value="9">					
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta2" id="pregunta2" value="10">					
				</label>
			</div>
			<div class="col-md-6 pull-right" style="margin-top: -15px">
				<div style="float:left; margin-left: 0px;">1</div><div style="float:left; margin-left:28px;">2</div><div style="float:left; margin-left:28px;">3</div><div style="float:left; margin-left:28px;">4</div>
				<div style="float:left; margin-left: 92px;">5</div><div style="float:left; margin-left: 28px;">6</div><div style="float:left; margin-left: 28px;">7</div><div style="float:left; margin-left: 113px;">8</div>
				<div style="float:left; margin-left: 27px;">9</div><div style="float:left; margin-left: 24px;">10</div>
			</div>
    </div>  

    <div class="form-group">
    	<div class="col-md-6">
		   	<label class="control-label" for="pregunta3">3. Rapidez y eficacia de las gestiones y documentación:</label></div>
	    	<div class="col-md-6">
		    	<label class="radio-inline">
					<input type="radio" name="pregunta3" id="pregunta3" value="1">					
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta3" id="pregunta3" value="2">					
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta3" id="pregunta3" value="3">
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta3" id="pregunta3" value="4">
				</label>
		    	<label class="radio-inline" style="margin-left: 80px">
					<input type="radio" name="pregunta3" id="pregunta3" value="5">					
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta3" id="pregunta3" value="6">					
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta3" id="pregunta3" value="7">
				</label>
				<label class="radio-inline" style="margin-left: 100px">
					<input type="radio" name="pregunta3" id="pregunta3" value="8">
				</label>
		    	<label class="radio-inline">
					<input type="radio" name="pregunta3" id="pregunta3" value="9">					
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta3" id="pregunta3" value="10">					
				</label>
			</div>
			<div class="col-md-6 pull-right" style="margin-top: -15px">
				<div style="float:left; margin-left: 0px;">1</div><div style="float:left; margin-left:28px;">2</div><div style="float:left; margin-left:28px;">3</div><div style="float:left; margin-left:28px;">4</div>
				<div style="float:left; margin-left: 92px;">5</div><div style="float:left; margin-left: 28px;">6</div><div style="float:left; margin-left: 28px;">7</div><div style="float:left; margin-left: 113px;">8</div>
				<div style="float:left; margin-left: 27px;">9</div><div style="float:left; margin-left: 24px;">10</div>
			</div>
    </div>  

    <div class="form-group">
    	<div class="col-md-6">
		   	<label class="control-label" for="pregunta4">4. Claridad y Comprensión de la información recibida del personal de ESFOCC:</label></div>
	    	<div class="col-md-6">
		    	<label class="radio-inline">
					<input type="radio" name="pregunta4" id="pregunta4" value="1">					
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta4" id="pregunta4" value="2">					
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta4" id="pregunta4" value="3">
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta4" id="pregunta4" value="4">
				</label>
		    	<label class="radio-inline" style="margin-left: 80px">
					<input type="radio" name="pregunta4" id="pregunta4" value="5">					
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta4" id="pregunta4" value="6">					
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta4" id="pregunta4" value="7">
				</label>
				<label class="radio-inline" style="margin-left: 100px">
					<input type="radio" name="pregunta4" id="pregunta4" value="8">
				</label>
		    	<label class="radio-inline">
					<input type="radio" name="pregunta4" id="pregunta4" value="9">					
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta4" id="pregunta4" value="10">					
				</label>
			</div>
			<div class="col-md-6 pull-right" style="margin-top: -15px">
				<div style="float:left; margin-left: 0px;">1</div><div style="float:left; margin-left:28px;">2</div><div style="float:left; margin-left:28px;">3</div><div style="float:left; margin-left:28px;">4</div>
				<div style="float:left; margin-left: 92px;">5</div><div style="float:left; margin-left: 28px;">6</div><div style="float:left; margin-left: 28px;">7</div><div style="float:left; margin-left: 113px;">8</div>
				<div style="float:left; margin-left: 27px;">9</div><div style="float:left; margin-left: 24px;">10</div>
			</div>
    </div>  

    <div class="form-group">
    	<div class="col-md-6">
		   	<label class="control-label" for="pregunta5">5. Calidad de los materiales recibidos para la formación del trabajador:</label></div>
	    	<div class="col-md-6">
		    	<label class="radio-inline">
					<input type="radio" name="pregunta5" id="pregunta5" value="1">					
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta5" id="pregunta5" value="2">					
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta5" id="pregunta5" value="3">
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta5" id="pregunta5" value="4">
				</label>
		    	<label class="radio-inline" style="margin-left: 80px">
					<input type="radio" name="pregunta5" id="pregunta5" value="5">					
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta5" id="pregunta5" value="6">					
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta5" id="pregunta5" value="7">
				</label>
				<label class="radio-inline" style="margin-left: 100px">
					<input type="radio" name="pregunta5" id="pregunta5" value="8">
				</label>
		    	<label class="radio-inline">
					<input type="radio" name="pregunta5" id="pregunta5" value="9">					
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta5" id="pregunta5" value="10">					
				</label>
			</div>
			<div class="col-md-6 pull-right" style="margin-top: -15px">
				<div style="float:left; margin-left: 0px;">1</div><div style="float:left; margin-left:28px;">2</div><div style="float:left; margin-left:28px;">3</div><div style="float:left; margin-left:28px;">4</div>
				<div style="float:left; margin-left: 92px;">5</div><div style="float:left; margin-left: 28px;">6</div><div style="float:left; margin-left: 28px;">7</div><div style="float:left; margin-left: 113px;">8</div>
				<div style="float:left; margin-left: 27px;">9</div><div style="float:left; margin-left: 24px;">10</div>
			</div>
    </div>  

    <div class="form-group">
    	<div class="col-md-6">
		   	<label class="control-label" for="pregunta6">6. Eficacia de los seguimientos realizados al trabajador:</label></div>
	    	<div class="col-md-6">
		    	<label class="radio-inline">
					<input type="radio" name="pregunta6" id="pregunta6" value="1">					
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta6" id="pregunta6" value="2">					
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta6" id="pregunta6" value="3">
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta6" id="pregunta6" value="4">
				</label>
		    	<label class="radio-inline" style="margin-left: 80px">
					<input type="radio" name="pregunta6" id="pregunta6" value="5">					
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta6" id="pregunta6" value="6">					
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta6" id="pregunta6" value="7">
				</label>
				<label class="radio-inline" style="margin-left: 100px">
					<input type="radio" name="pregunta6" id="pregunta6" value="8">
				</label>
		    	<label class="radio-inline">
					<input type="radio" name="pregunta6" id="pregunta6" value="9">					
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta6" id="pregunta6" value="10">					
				</label>
			</div>
			<div class="col-md-6 pull-right" style="margin-top: -15px">
				<div style="float:left; margin-left: 0px;">1</div><div style="float:left; margin-left:28px;">2</div><div style="float:left; margin-left:28px;">3</div><div style="float:left; margin-left:28px;">4</div>
				<div style="float:left; margin-left: 92px;">5</div><div style="float:left; margin-left: 28px;">6</div><div style="float:left; margin-left: 28px;">7</div><div style="float:left; margin-left: 113px;">8</div>
				<div style="float:left; margin-left: 27px;">9</div><div style="float:left; margin-left: 24px;">10</div>
			</div>
    </div>  

    <div class="form-group">
    	<div class="col-md-6">
		   	<label class="control-label" for="pregunta7">7. Grado de comprensión de los informes de seguimiento del trabajador:</label></div>
	    	<div class="col-md-6">
		    	<label class="radio-inline">
					<input type="radio" name="pregunta7" id="pregunta7" value="1">					
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta7" id="pregunta7" value="2">					
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta7" id="pregunta7" value="3">
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta7" id="pregunta7" value="4">
				</label>
		    	<label class="radio-inline" style="margin-left: 80px">
					<input type="radio" name="pregunta7" id="pregunta7" value="5">					
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta7" id="pregunta7" value="6">					
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta7" id="pregunta7" value="7">
				</label>
				<label class="radio-inline" style="margin-left: 100px">
					<input type="radio" name="pregunta7" id="pregunta7" value="8">
				</label>
		    	<label class="radio-inline">
					<input type="radio" name="pregunta7" id="pregunta7" value="9">					
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta7" id="pregunta7" value="10">					
				</label>
			</div>
			<div class="col-md-6 pull-right" style="margin-top: -15px">
				<div style="float:left; margin-left: 0px;">1</div><div style="float:left; margin-left:28px;">2</div><div style="float:left; margin-left:28px;">3</div><div style="float:left; margin-left:28px;">4</div>
				<div style="float:left; margin-left: 92px;">5</div><div style="float:left; margin-left: 28px;">6</div><div style="float:left; margin-left: 28px;">7</div><div style="float:left; margin-left: 113px;">8</div>
				<div style="float:left; margin-left: 27px;">9</div><div style="float:left; margin-left: 24px;">10</div>
			</div>
    </div>  

    <div class="form-group">
    	<div class="col-md-6">
		   	<label class="control-label" for="pregunta8">8. Grado de cumplimiento de las expectativas iniciales:</label></div>
	    	<div class="col-md-6">
		    	<label class="radio-inline">
					<input type="radio" name="pregunta8" id="pregunta8" value="1">					
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta8" id="pregunta8" value="2">					
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta8" id="pregunta8" value="3">
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta8" id="pregunta8" value="4">
				</label>
		    	<label class="radio-inline" style="margin-left: 80px">
					<input type="radio" name="pregunta8" id="pregunta8" value="5">					
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta8" id="pregunta8" value="6">					
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta8" id="pregunta8" value="7">
				</label>
				<label class="radio-inline" style="margin-left: 100px">
					<input type="radio" name="pregunta8" id="pregunta8" value="8">
				</label>
		    	<label class="radio-inline">
					<input type="radio" name="pregunta8" id="pregunta8" value="9">					
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta8" id="pregunta8" value="10">					
				</label>
			</div>
			<div class="col-md-6 pull-right" style="margin-top: -15px">
				<div style="float:left; margin-left: 0px;">1</div><div style="float:left; margin-left:28px;">2</div><div style="float:left; margin-left:28px;">3</div><div style="float:left; margin-left:28px;">4</div>
				<div style="float:left; margin-left: 92px;">5</div><div style="float:left; margin-left: 28px;">6</div><div style="float:left; margin-left: 28px;">7</div><div style="float:left; margin-left: 113px;">8</div>
				<div style="float:left; margin-left: 27px;">9</div><div style="float:left; margin-left: 24px;">10</div>
			</div>
    </div>  

    <div class="form-group">
    	<div class="col-md-6">
		   	<label class="control-label" for="pregunta9">9. Solución de quejas o reclamaciones originadas durante el servicio:</label></div>
	    	<div class="col-md-6">
		    	<label class="radio-inline">
					<input type="radio" name="pregunta9" id="pregunta9" value="1">					
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta9" id="pregunta9" value="2">					
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta9" id="pregunta9" value="3">
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta9" id="pregunta9" value="4">
				</label>
		    	<label class="radio-inline" style="margin-left: 80px">
					<input type="radio" name="pregunta9" id="pregunta9" value="5">					
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta9" id="pregunta9" value="6">					
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta9" id="pregunta9" value="7">
				</label>
				<label class="radio-inline" style="margin-left: 100px">
					<input type="radio" name="pregunta9" id="pregunta9" value="8">
				</label>
		    	<label class="radio-inline">
					<input type="radio" name="pregunta9" id="pregunta9" value="9">					
				</label>
				<label class="radio-inline">
					<input type="radio" name="pregunta9" id="pregunta9" value="10">					
				</label>
			</div>
			<div class="col-md-6 pull-right" style="margin-top: -15px">
				<div style="float:left; margin-left: 0px;">1</div><div style="float:left; margin-left:28px;">2</div><div style="float:left; margin-left:28px;">3</div><div style="float:left; margin-left:28px;">4</div>
				<div style="float:left; margin-left: 92px;">5</div><div style="float:left; margin-left: 28px;">6</div><div style="float:left; margin-left: 28px;">7</div><div style="float:left; margin-left: 113px;">8</div>
				<div style="float:left; margin-left: 27px;">9</div><div style="float:left; margin-left: 24px;">10</div>
			</div>
    </div>  

    <div class="form-group">
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


	
	<div class="form-group">
		<div class="col-md-12" style="margin-top: 20px;">
			<label class="control-label" for="observaciones">Observaciones y Áreas de Mejora (Anotar cualquier aspecto que el cliente quiera resaltar como aspectos positivos, negativos o áreas de mejora):</label>
			<textarea id="observaciones" name="observaciones" class="form-control" rows="3"></textarea>
		</div>
	</div>
 	<div class="clearfix"></div>
   	
   	</div>
	<input name="tabla" type="hidden" id="tabla" value="cuestionariosempresa_evaluacion" />
	<p style="text-align: center; margin-top: 30px;">
	  <a id="guardacuestionario" class="btn btn-primary btn-lg">Enviar Encuesta</a>
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


<script>
	

		$(document).on("click", "a#guardacuestionarioempresa", function(event){

			var values = $('.formularioevaluacion').find("input[type='hidden'], :input:not(:hidden)").serialize();
			// alert(values);


			if ( $('#cif').val().length != 9 ) {
				alert("Introduce un CIF/NIF correcto.");
				return false;
			}

			if ( $('#servicio').val().length != 1 ) {
				alert("Introduce el servicio recibido.");
				return false;
			}	
			
			if ( $('select[id^=pregunta]').val() == 0 ) {
				alert("Indica cómo nos conociste.");
				return false;
			}

			var n = $( "input:checked" ).length;

			if ( n!= 9 ) {
				alert("Contesta todas las preguntas.");
				return false;
			}

			$.ajax({
				cache: false,
				type: 'POST',
				url: 'functions/funciones.php',
				data: values+'&guardacuestionarioempresa=1',
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

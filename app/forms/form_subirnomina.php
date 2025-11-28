<div style="margin-top: 45px; margin-bottom: 45px;" class="container">

	<input name="matricula" type="hidden" id="matricula" value="" />
	<input name="id_matricula" type="hidden" id="id_matricula" value="" />
	<input name="id_accion" type="hidden" id="id_accion" value="" />
    <input name="id_alumno" type="hidden" id="id_alumno" value="" />
<!--     <div style="display:none" id="confirmacion" class="inv alert alert-success">Progreso guardado. Acuérdate de ir actualizándolo a medida que el alumno va avanzando en la formación.</div>
    <div style="display:none" id="error" class="alert alert-danger">Error.</div> -->


	<ol class="breadcrumb">
      <li>Nóminas</li>
      <li class="active">Subir Nóminas</li>
	</ol>

	<div class="col-md-4" style="margin-bottom: 15px">
    	<div class="form-group">
        	<label class="control-label" for="personalp">Seleccionar personal:</label>
        	<select id="personalp" name="personalp" class="form-control" >
        		<option value="">...</option>
				<?

        		$q = 'SELECT nombre, dni
			    FROM nominas_usuarios
			    WHERE tipo="Personal" AND activo=1 ORDER BY nombre ASC';
			    $q = mysqli_query($link, $q);

			    while ( $row = mysqli_fetch_array($q) ) {

			    	echo '<option value="'.$row[dni].'">'.$row[nombre].'</option>';

			    }

			    ?>

			</select>
        </div>
  	</div>

  	<div class="col-md-4" style="margin-bottom: 15px">
    	<div class="form-group">
        	<label class="control-label" for="personald">Seleccionar docente:</label>
        	<select id="personald" name="personald" class="form-control" >
        		<option value="">...</option>
				<?

        		$q = 'SELECT nombre, dni
			    FROM nominas_usuarios
			    WHERE tipo="Docente"
			    ORDER BY nombre ASC';
			    $q = mysqli_query($link, $q);

			    while ( $row = mysqli_fetch_array($q) ) {

			    	echo '<option value="'.$row[dni].'">'.$row[nombre].'</option>';

			    }

			    ?>

			</select>
        </div>
  	</div>

	<div class="clearfix"></div>


		<?

		$gestion = devuelveAnio();

		$meses = array("",
		"Enero",
		"Febrero",
		"Marzo",
		"Abril",
		"Mayo",
		"Junio",
		"Julio",
		"Agosto",
		"Septiembre",
		"Octubre",
		"Noviembre",
		"Diciembre" );

		for ($i=1; $i <= 12; $i++) { ?>

			<form id="pdfnominas" action="" method="post" enctype="multipart/form-data">

				<div class="col-md-12" style="margin-top: 15px">

					<label>Nómina <? echo $meses[$i].' '.$gestion ?>: </label>
					<br>
					<input style="float:left" type="file" name="empfile<? echo $i ?>" id="empfile<? echo $i ?>" class="btn btn-default"/>

					<? if ( $_SESSION[user] == 'asociado_basefis' || $_SESSION[user] == 'cmunoz' || $_SESSION[user] == 'sdaluz' || $_SESSION[user] == 'root' ) { ?>
					<a id="subirpdfnomina<? echo $i ?>" iden="<? echo $i ?>" fecha="<? echo $meses[$i].$gestion ?>" class="boton btn btn-primary">
					<span class="glyphicon glyphicon-open"></span> Subir PDF </a>
					<? } ?>

					<a id="mostrarpdfnomina<? echo $i ?>" iden="<? echo $i ?>" fecha="<? echo $meses[$i].$gestion ?>" style="" class="boton btn btn-success">
					<span class="glyphicon glyphicon-save"></span> Mostrar PDF </a>

					<div id="esta<? echo $i ?>">
						<span style="margin-top: 10px; margin-left: 5px; color: red;" class="glyphicon glyphicon-ok-circle"></span>
					</div>

				</div>

				<div class="clearfix"></div>

			</form>

		<? } ?>





</div>


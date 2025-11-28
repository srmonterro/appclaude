<style>

	.back {
	    overflow: auto;
	    display: block;
	    width: 100%;
	    height: 100%;
	}

	.contenidotxt {
	    width: 860px;
	    height: 560px;
	    margin: 100px 0px 0px 100px;
	}

</style>

<div style="margin-top: 45px" class="container">

	<ol class="breadcrumb">
      <li>Online-Distancia</li>
      <li>Matrículas Grupales</li>
      <li class="active">Documentación</li>
	</ol>

	<input name="matricula" type="hidden" id="matricula" value="1" />
	<input name="id_matricula" type="hidden" id="id_matricula" value="" />
	<input name="id_accion" type="hidden" id="id_accion" value="" />
	<input name="fuente" type="hidden" id="fuente" value="" />

	<form class="formularionline_doc" id="formulario" role="form" action="" method="post">

	    <div class="col-md-8 " style="text-align: left;min-height:70px;">
	        <a id="abrebusqueda" name="matriculas" data-toggle=modal class="btn btn-lg btn-primary">Seleccionar Curso</a>
	    </div>

	    <!-- INCLUIR TAMBIEN A VICENTE -->
	    <div id="informesss" class="col-md-4 pull-right" style="display:none; text-align: right;">
	    	<a id="btnsubidas" style="float:left;margin-right: 5px" class="btn btn-warning"><span class="glyphicon glyphicon-open"></span> Notificaciones</a>
	    <? if ( $_SESSION['user'] == 'rmedina' || $_SESSION['user'] == 'cmunoz' || $_SESSION['user'] == 'root' ) {
				echo'
	                <a id="informempresa" style="float:left" class="btn btn-warning"><span class="glyphicon glyphicon-eye-open"></span> Costes Facturación</a>

	            ';
	        } ?>
		</div><div class="clearfix"></div>
	    <div id="datosaccion" style="display:none">

	            <div class="col-md-2">
	                <div class="form-group">
	                    <label class="control-label" for="numeroaccion">Acción Formativa:</label>
	                    <input type="text" id="numeroaccion" name="numeroaccion" class="form-control" readonly/>
	                </div>
	            </div>
	            <div class="col-md-4">
	                <div class="form-group">
	                    <label class="control-label" for="denominacion">Denominación Acción Formativa:</label>
	                    <input style="font-size:12px" type="text" id="denominacion" name="denominacion" class="form-control" readonly />
	                </div>
	            </div>

	            <div class="col-md-2">
	                <div class="form-group">
	                    <label class="control-label" for="fechaini">Fecha Inicio:</label>
	                    <input type="date" id="fechaini" name="fechaini" class="form-control" readonly/>
	                </div>
	            </div>
	            <div class="col-md-2">
	                <div class="form-group">
	                    <label class="control-label" for="fechafin">Fecha Fin:</label>
	                    <input type="date" id="fechafin" name="fechafin" class="form-control" readonly/>
	                </div>
	            </div>
	            <div class="col-md-2">
	                <div class="form-group">
	                    <label class="control-label" for="modalidad">Modalidad:</label>
	                    <input type="text" id="modalidad" name="modalidad" class="form-control" readonly/>
	                </div>
	            </div>

	    </div>


	</form>

	<div class="clearfix"></div>

	<div class="col-md-12">

	    <form style="display: none" id="excel" action="" method="post" enctype="multipart/form-data">
	    <fieldset class="fieldbonif">
	        <legend>Bonificado</legend>
	        <input style="float:left" type="file" name="afile" id="afile" class="btn btn-default" />
 	        <!-- <a id="subirexcel" class="btn btn-primary"><span class="glyphicon glyphicon-open"></span> Subir Excel</a>
	        <a id="leerexcel" style="" class="btn btn-success"><span class="glyphicon glyphicon-list-alt"></span> Leer Excel</a> -->
 
        	<a id="subirexcel" class="btn btn-primary"><span class="glyphicon glyphicon-open"></span> Subir Excel</a>
        	<a id="leerexcel" style="" class="btn btn-success"><span class="glyphicon glyphicon-list-alt"></span> Leer Excel</a>
        	<a id="cargardatos" style="" class="boton btn btn-success"><span class="glyphicon glyphicon-save"></span> Cargar Datos</a>
 			<a id="guiadelalumnogrupo" style="display:none" class="btn btn-success"><span class="glyphicon glyphicon-file"></span> Documentación</a>
 			<a id="diplomasalumnogrupo" style="display:inline-block" class="btn btn-success"><span class="glyphicon glyphicon-bookmark"></span> Diplomas</a>
	        <a id="diploma_bonif" style="display:none" class="btn btn-success"><span class="glyphicon glyphicon-bookmark"></span> Anverso</a>
	        <a id="diploma_bonif_atras" style="display:none" class="btn btn-success"><span class="glyphicon glyphicon-bookmark"></span> Reverso</a>
	        <a id="diploma_empresa" style="display:none;" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-bookmark"></span> Por Empresa</a>
	        <a id="justifcerts" style="display:none;" class="btn btn-success"><span class="glyphicon glyphicon-bookmark"></span> Justificantes Cert.</a>
			<a id="guiadidactica" style="" class="btn btn-success"><span class="glyphicon glyphicon-file"></span> Guía Didáctica </a>
	        <a id="xmlfin_grupo" style="display:none" class="boton btn btn-sm btn-info"> XML Fin</a>

	    </form>
	    </fieldset>
	</div>

	<div class="clearfix"></div>

	<div style="overflow: auto; margin-top: 20px; margin-bottom: 30px;" id="matricula_fin">

	</div>

	<div style="margin-top: 30px;" class="col-md-12">

	    <form style="display: none" id="excel_privado" action="" method="post" enctype="multipart/form-data">
	    <fieldset>
	        <legend>Privado</legend>
	        <input style="float:left" type="file" name="apfile" id="apfile" class="btn btn-default" />
	        <!-- <a id="subirexcel_privado" class="btn btn-primary"><span class="glyphicon glyphicon-open"></span> Subir Excel</a>
	        <a id="leerexcel_privado" style="" class="btn btn-success"><span class="glyphicon glyphicon-list-alt"></span> Leer Excel</a> -->
	        <a id="subirexcel_privado" class="btn btn-primary"><span class="glyphicon glyphicon-open"></span> Subir Excel</a>
        	<a id="leerexcel_privado" style="" class="btn btn-success"><span class="glyphicon glyphicon-list-alt"></span> Leer Excel</a>
        	<a id="cargardatos_fin_privado" style="" class="boton btn btn-success"><span class="glyphicon glyphicon-save"></span> Cargar Datos</a>
	        <a id="guiadelalumnogrupo_privado" style="display:none" class="btn btn-success"><span class="glyphicon glyphicon-file"></span> Documentación</a>
 			<a id="diplomasalumnogrupop" style="display:inline-block" class="btn btn-success"><span class="glyphicon glyphicon-bookmark"></span> Diplomas</a>
	        <a id="justifcertsp" style="display:none;" class="btn btn-success"><span class="glyphicon glyphicon-bookmark"></span> Justificantes Cert.</a>
	        <a id="diploma_nobonif" style="display:none" class="btn btn-success"><span class="glyphicon glyphicon-bookmark"></span> Anverso</a>
	        <a id="diploma_bonif_atrasp" style="display:none" class="btn btn-success"><span class="glyphicon glyphicon-bookmark"></span> Reverso</a>
	        <a id="diploma_empresap" style="display:none;" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-bookmark"></span> Por Empresa</a>
	        <a id="vin" style="display:none;" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-bookmark"></span> Certificado Impartición</a>
	    </form>
	    </fieldset>
	</div>

	<div class="clearfix"></div>

	<div style="overflow: auto; margin-top: 20px; margin-bottom: 30px;" id="matricula_fin_privado">

	</div>


</div>

	<div class="back" style="visibility: hidden;">
	    <div class="contenidotxt">
	    	<div id="contentdiv"></div>
	    </div>
	</div>


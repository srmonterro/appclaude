<?
include './funciones.php';
?>

<div style="margin-top: 30px" class="container">

<form class="formularioaccion" id="formulario" role="form" action="" method="post">

    <div class="col-md-12 " style="text-align: left;min-height:70px;">
    	<input name="tabla" type="hidden" id="tabla" value="matriculas" />
		<input name="id" type="hidden" id="id" value="" />

        <a id="abrebusqueda" href="#" data-toggle=modal class="btn btn-lg btn-primary">Seleccionar Acción</a>
    </div>

    <span id="contenido"></span>

    <div id="datosaccion" class="col-md-12 " style="display:none">

    	<div class="col-md-2">
	    	<div class="form-group">
			    <label class="control-label" for="numeroaccion">Número Acción:</label>
			    <input disabled placeholder="<? echo $naccion ?>" type="text" id="numeroaccion" name="numeroaccion" class="form-control" />
			    <input type="hidden" id="id" name="id" class="form-control" />
		    </div>
		</div>

		<div class="col-md-6">
	    	<div class="form-group">
			    <label class="control-label" for="denominacion">Nombre Acción:</label>
			    <input disabled type="text" id="denominacion" name="denominacion" class="form-control" />
		    </div>
		</div>

		<div class="col-md-2">
	    	<div class="form-group">
			    <label class="control-label" for="fechainicio">Fecha Inicio:</label>
			    <input disabled type="text" id="fechainicio" name="fechainicio" class="form-control" />
		    </div>
		</div>

		<div class="col-md-2">
	    	<div class="form-group">
			    <label class="control-label" for="fechafin">Fecha Fin:</label>
			    <input disabled type="text" id="fechafin" name="fechafin" class="form-control" />
		    </div>
		</div>

		<div class="clearfix"></div>

		<div id="listado-facturas" class="col-md-12" style="display:none">
			
		</div>
    </div>

</form>

<!-- <div class="col-md-12">
		
	<input name="tabla" type="hidden" id="tabla" value="acciones" />
	<input name="id" type="hidden" id="id" value="" />  si hay value es que es UPDATE !

	<p style="text-align: center; margin-top: 30px;">
		<a id="abrebusqueda" href="#" data-toggle=modal class="btn btn-lg btn-primary">Mostrar Acciones</a><br>
	</p>

</div> -->
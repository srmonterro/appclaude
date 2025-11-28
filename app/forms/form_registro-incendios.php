<div style="margin-top: 45px" class="container">

	<input name="matricula" type="hidden" id="matricula" value="" />
	<input name="id_matricula" type="hidden" id="id_matricula" value="" />
	<input name="id_accion" type="hidden" id="id_accion" value="" />
    <input name="id_alumno" type="hidden" id="id_alumno" value="" />
    <div style="display:none" id="confirmacion" class="inv alert alert-success">Progreso guardado. Acuérdate de ir actualizándolo a medida que el alumno va avanzando en la formación.</div>
    <div style="display:none" id="error" class="alert alert-danger">Error.</div>


	<ol class="breadcrumb">
      <li>Seguimiento</li>
      <li class="active">Registro Contra Incendios</li>
	</ol>


	<div style="overflow:auto; text-align: center;" class="col-md-12">
		<a id="registro_general" class="btn btn-lg btn-danger"><span class="glyphicon glyphicon-fire"></span> Registro General</a>
		<a style="margin-left: 15px;" id="registro_dias" class="btn btn-lg btn-danger"><span class="glyphicon glyphicon-fire"></span> Registro Por Días</a>
		<a style="margin-left: 15px;" id="certificados" name="matriculas" class="abrebusqueda btn btn-lg btn-danger"><span class="glyphicon glyphicon-fire"></span> Certificados</a>
	</div>

	<div class="col-md-12" style="margin-top: 20px; font-size: 12px" id="registro">

	</div>
	<a id="imprimirRegistro" onclick="javascript:printDiv('registro')" style="margin-bottom: 30px; margin-right: 15px; display: none" class="pull-right btn btn-primary btn-default"><span class="glyphicon glyphicon-print"></span> Imprimir</a>

</div>

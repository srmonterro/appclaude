<div style="margin-top: 45px" class="container">

	<ol class="breadcrumb">
      <li>Online-Distancia</li>
      <li>Matrículas Grupales</li>
      <li class="active">Finalización</li>
	</ol>

<input name="matricula" type="hidden" id="matricula" value="1" />
<input name="id_matricula" type="hidden" id="id_matricula" value="" />
<input name="id_accion" type="hidden" id="id_accion" value="" />

<form class="formularionline_fin" id="formulario" role="form" action="" method="post">

    <div class="col-md-12 btnmatriculas " style="text-align: left;min-height:70px;">
        <a id="abrebusqueda" href="#" name="matriculas" data-toggle=modal class="btn btn-lg btn-primary">Seleccionar Curso</a>
    </div>

    <div id="datosaccion" style="display:none">

            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label" for="numeroaccion">Acción Formativa:</label>
                    <input type="text" id="numeroaccion" name="numeroaccion" class="form-control" readonly/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label" for="denominacion">Denominación Acción Formativa:</label>
                    <input type="text" id="denominacion" name="denominacion" class="form-control" readonly />
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

    </div>


</form>

<div class="clearfix"></div>

<div class="col-md-12">

    <form style="display: none" id="excel" action="" method="post" enctype="multipart/form-data">
    <fieldset class="fieldbonif">
        <legend>Bonificado</legend>
        <input style="float:left" type="file" name="afile" id="afile" class="btn btn-default" />
        <a id="subirexcel_fin" href="#" class="btn btn-primary"><span class="glyphicon glyphicon-open"></span> Subir Excel</a>
        <a id="leerexcel_fin" style="display:none" class="btn btn-success"><span class="glyphicon glyphicon-list-alt"></span> Leer Excel</a>
        <a id="cargardatos" style="" class="btn btn-success"><span class="glyphicon glyphicon-save"></span> Cargar Datos</a>
        <a id="xmlfinprepost" style="display:none" class="btn btn-info"> XML Fin</a>
        <? if ( $_SESSION['user'] == 'root' || $_SESSION['user'] == 'amanda' || $_SESSION['user'] == 'alago' ) { ?>
        <a name="" id="descargar_excel" href="#" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-save"></span> Excel Doc</a>
        <a name="" id="descargar_excelfin" href="#" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-save"></span> Excel Fin</a><? } ?>
    </fieldset>
    </form>

</div>

<div class="clearfix"></div>

<div style="overflow: auto; margin-top: 20px; margin-bottom: 30px;" id="matricula_fin">

</div>


<div class="col-md-12">

    <form style="display:none" id="excel_privado" action="" method="post" enctype="multipart/form-data">
    <fieldset>
        <legend>Privado</legend>
        <input style="float:left" type="file" name="apfile" id="apfile" class="btn btn-default" />
        <a id="subirexcel_fin_privado" href="#" class="btn btn-primary"><span class="glyphicon glyphicon-open"></span> Subir Excel</a>
        <a id="leerexcel_fin_privado" style="display:none" class="btn btn-success"><span class="glyphicon glyphicon-list-alt"></span> Leer Excel</a>
        <a id="cargardatos_fin_privado" style="" class="btn btn-success"><span class="glyphicon glyphicon-save"></span> Cargar Datos</a>
        <a name="" id="descargar_excelp" href="#" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-save"></span> Excel Doc</a>
        <a name="" id="descargar_excelfinp" href="#" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-save"></span> Excel Fin</a>

    </fieldset>
    </form>

</div>

<div class="clearfix"></div>

<div style="overflow: auto; margin-top: 20px; margin-bottom: 30px;" id="matricula_fin_privado">

</div>

<div id="cobservacionesfin" style="margin-top: 20px; display:none" class="ta col-md-9">
        <div class="form-group">
            <label class="control-label" for="observacionesfin">Observaciones Finalización (Para Facturar):</label>
            <textarea name="observacionesfin" id="observacionesfin" class="form-control" rows="3"></textarea>
        </div>
        <div class="clearfix"></div>
            <div style="margin-top: 10px">
            <a id="guardarobservacionesfin" style="" class="btn btn-success"> Guardar Observaciones</a>
            </div>
        <div class="clearfix"></div>
    </div>

    <div id="ctipofra" style="margin-top: 20px; display:none" class="col-md-3">
        <div class="form-group">
            <label class="control-label" for="tipofra">Tipo Factura:</label>
            <select class="form-control" id="tipofra">
                <option value="">Seleciona el tipo de factura</option>
                <option value="Formacion">Formación</option>
                <option value="Gestionpre">Gestión Pre RD</option>
                <option value="Gestionpost">Gestión Post RD</option>
                <option value="Costesind">Costes Indirectos</option>
            </select>
        </div>
        <div class="clearfix"></div>
            <div style="margin-top: 10px">
            <a id="guardartipofra" style="" class="btn btn-success"> Guardar</a>
            </div>
        <div class="clearfix"></div>

    </div>

    <div id="divaf_factura" style="margin-top: 20px; display:none" class="ta col-md-9">
        <div class="form-group">
            <label class="control-label" for="af_factura">Acción / Grupo distinto (Para Facturar):</label>
            <input type="text" name="af_factura" id="af_factura" class="form-control" rows="3"></textarea>
        </div>
        <div class="clearfix"></div>
            <div style="margin-top: 10px">
            <a id="guardaraf_factura" style="" class="btn btn-success"> Guardar AF</a>
            </div>
        <div class="clearfix"></div>

    </div>
<? if ( $_SESSION[user] == 'root' || $_SESSION[user] == 'amanda' ) { ?>
<div class="clearfix"></div>
<div id="cobservacionesfinamanda" style="margin-top: 20px; display:none" class="ta col-md-9">
    <div class="form-group">
        <label class="control-label" for="observacionesfinamanda">Observaciones Finalización (Amanda):</label>
        <textarea name="observacionesfinamanda" id="observacionesfinamanda" class="form-control" rows="3"></textarea>
    </div>
    <div class="clearfix"></div>
        <div style="margin-top: 10px">
        <a id="guardarobservacionesfinamanda" style="" class="btn btn-success"> Guardar Observaciones</a>
        </div>
    <div class="clearfix"></div>
</div>
<? } ?>

<div id="cincidenciasfinamanda" style="margin-top: 20px; display:none" class="ta col-md-9">
    <div class="form-group">
        <label class="control-label" for="incidenciasfinamanda">Incidencias Finalización (Amanda):</label>
        <textarea name="incidenciasfinamanda" id="incidenciasfinamanda" class="form-control" rows="3"></textarea>
    </div>
    <div class="clearfix"></div>
        <div style="margin-top: 10px">
        <a id="guardarincidenciasfinamanda" style="" class="btn btn-success"> Guardar Incidencias</a>
        </div>
    <div class="clearfix"></div>
</div>


</div>

</div>
</form>
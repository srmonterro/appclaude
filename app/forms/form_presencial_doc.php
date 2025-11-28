
<div style="margin-top: 45px" class="container">
<ol class="breadcrumb">
      <li>Presencial-Mixto</li>
      <li class="active">Documentación</li>
</ol>

<input name="matricula" type="hidden" id="matricula" value="1" />
<input name="id_matricula" type="hidden" id="id_matricula" value="" />
<input name="id_accion" type="hidden" id="id_accion" value="" />

<form class="formulariopresencial_doc" id="formulario" role="form" action="" method="post">

    <div class="col-md-6 " style="text-align: left;min-height:70px;">
        <a id="abrebusqueda" name="matriculas" data-toggle=modal class="btn btn-lg btn-primary">Seleccionar Curso</a>
    </div>

    <!-- INCLUIR TAMBIEN A VICENTE -->
    <?
    echo '<div id="informecuadro" class="col-md-6 pull-right" style="display:none;">';
            echo '<a id="btnsubidas" style="margin-right: 5px;" class="btn btn-warning"><span class="glyphicon glyphicon-open"></span> Notificaciones</a>';
            if ( $_SESSION['user'] == 'rmedina' || $_SESSION['user'] == 'cmunoz' || $_SESSION['user'] == 'root' || $_SESSION['user'] == 'javier' ) {
                echo '
                 <a style="margin-right: 5px;" id="informempresa" class="btn btn-warning"><span class="glyphicon glyphicon-eye-open"></span> Costes Facturación</a>'; }
                echo '<a id="preacuerdo" class="btn btn-warning"><span class="glyphicon glyphicon-list-alt"></span> Acuerdo Colaboración</a>
          </div>
                <div class="clearfix"></div>';
    ?>

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
        <a id="subirexcel" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-open"></span> Subir Excel</a>
        <a id="leerexcel" style="" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-list-alt"></span> Leer Excel</a>
        <a id="docurellena" style="display:none" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-file"></span> Documentación</a>
        <a id="docublanco" style="" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-inbox"></span> En Blanco</a>
        <a id="diploma_bonif" style="display:none" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-bookmark"></span> Anverso</a>
        <a id="diploma_bonif_atras" style="display:none" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-bookmark"></span> Reverso</a>
        <a id="diploma_empresa" style="display:none;" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-bookmark"></span> Por Empresa</a>
        <a name="" id="descargar_excel" href="#" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-save"></span> Excel Doc</a>
    </form>
    </fieldset>
</div>

<div class="clearfix"></div>

<div style="margin-top: 30px;" class="col-md-12">

    <form style="display: none" id="excel_privado" action="" method="post" enctype="multipart/form-data">
    <fieldset>
        <legend>Privado</legend>
        <input style="float:left" type="file" name="apfile" id="apfile" class="btn btn-default" />
        <a id="subirexcel_privado" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-open"></span> Subir Excel</a>
        <a id="leerexcel_privado" style="" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-list-alt"></span> Leer Excel</a>
        <a id="docurellena_privado" style="display:none" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-file"></span> Documentación</a>
        <a id="docublanco_privado" style="" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-inbox"></span> En Blanco</a>
        <a id="diploma_nobonif" style="display:none" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-bookmark"></span> Anverso</a>
        <a id="diploma_bonif_atrasp" style="display:none" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-bookmark"></span> Reverso</a>
        <a id="diploma_empresap" style="display:none;" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-bookmark"></span> Por Empresa</a>
        <a id="cuestionario" style="" class="btn btn-sm btn-success boton"><span class="glyphicon glyphicon-question-sign"></span> Cuestionario</a>
        <a name="" id="descargar_excelp" href="#" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-save"></span> Excel Doc</a>
    </form>
    </fieldset>
</div>


</div>


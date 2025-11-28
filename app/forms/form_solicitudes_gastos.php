
<div style="margin-top: 30px" class="container" id="peticiones_gastos">


<div style="display:none" id="confirmacion" class="alert alert-success">Petición realizada correctamente.</div>
<div style="display:none" id="error" class="alert alert-danger"></div>


    <ol class="breadcrumb">
      <li>Comerciales</li>
      <li class="active">Solicitudes Gastos</li>
    </ol>

    <div class="col-md-2 col-xs-12" style="margin-bottom: 25px">
    <div class="form-group">
        <label class="control-label" for="tiposolgastos">Tipo de Solicitud:</label>
        <select id="tiposolgastos" name="tiposolgastos" class="form-control">
            <option value="SF">Fungibles</option>
            <option value="SV">Viajes/Traslados</option>
            <option value="SA">Alojamiento</option>
            <option value="SN">Nota de gastos</option>
        </select>
    </div>
    </div>


<div class="clearfix"></div>

<?

    if ( $_SESSION['user'] == 'cmunoz' || $_SESSION['user'] == 'sdaluz' || $_SESSION['user'] == 'root' )
        $perms = '';
    else
        $perms = 'disabled';

?>


<div class="bloquefungible activo">

<form class="formulariofungible" id="formulario" action="" method="post">

    <input name="fecha" type="hidden" id="fecha" value="<? echo date('Y-m-d') ?>" />
    <input name="tabla" type="hidden" id="tabla" value="peticiones_gastos" />
    <input name="tiposol" type="hidden" id="tiposol" value="SF" />
    <!-- <input type="hidden" id="id_accion" name="id_accion" class="form-control" /> -->
    <!-- <input type="hidden" id="id_comercial" name="id_comercial" class="form-control" /> -->
    <input name="id" type="hidden" id="id" value="" /> <!-- si hay value es que es UPDATE !-->


    <div class="clearfix"></div>


    <div class="col-md-2 col-xs-12">
        <div class="form-group">
            <label class="control-label" for="numero">Nº Solicitud:</label>
            <?
                $q = 'SELECT numero as maximo
                FROM peticiones_gastos
                ORDER BY id DESC';
                $q = mysqli_query($link, $q);

                $row = mysqli_fetch_array($q);
                $max = $row[maximo]+1;
            ?>
            <div class="input-group">
                <span class="input-group-addon">SF</span>
                    <input type="text" id="numero" value="<? echo str_pad($max, 4, '0', STR_PAD_LEFT) ?>" name="numero" class="form-control" readonly />
            </div>

        </div>
    </div>

    <div style="display:none" class="col-md-2 pull-right" style="">
        <a id="imprimirsm" style="width:100%;" href="#" class="btn btn-sm btn-success">Imprimir SN</a>
    </div>



    <div class="col-md-2 col-xs-12">
            <div class="form-group">
            <label class="control-label" for="estado">Estado:</label>
            <select id="estado" name="estado" class="form-control" >
                <option value="Pendiente">Pendiente</option>
                <option <? echo $perms; ?> value="Aceptada">Aceptada</option>
                <option <? echo $perms; ?> value="Rechazada">Rechazada</option>
                <option value="Anulada">Anulada</option>
            </select>
        </div>
    </div>



    <div class="col-md-2 col-xs-12">
    <div class="form-group">
            <label class="control-label" for="usuario">Usuario:</label>
            <?

                    $q = 'SELECT u.id
                    FROM usuarios u
                    WHERE user = "'.$_SESSION[user].'"';

                    $q = mysqli_query($link, $q);

                    $row = mysqli_fetch_array($q);
                    $id = $row[id];

                ?>
                <select name="usuario" id="usuario" class="form-control" readonly>
                    <option value="<? echo $_SESSION[user] ?>"><? echo $_SESSION[user] ?></option>
                </select>

                <input type="hidden" id="id_usuario" name="id_usuario" value="<? echo $id ?>" class="form-control" />


        </div>
    </div>


    <div class="clearfix"></div>

<!--     <div class="col-md-2 col-xs-12" style="">
        <a id="anadirfungiblesol" style="width:100%;" href="#" class="btn btn-sm btn-success">Anadir Fungible <span class="glyphicon glyphicon-plus"></span></a>
    </div>
 -->
    <div class="clearfix"></div>

    <? devuelveDatosFungibles($link); ?>
    <div class="zonafungibles">


    </div>

    <div class="clearfix"></div>

    <hr>

    <div class="col-md-4 col-xs-12">
            <div class="form-group">
            <label class="control-label" for="motivo">Motivo:</label>
            <select id="motivogasto" name="motivogasto" class="form-control" >
                <option value="">Selecciona</option>
                <option value="Consumo Oficina">Consumo Oficina</option>
                <option value="Material Curso">Material Curso</option>
            </select>
        </div>
    </div>

    <div class="col-md-8 col-xs-12" style="margin-bottom: 15px">
        <div class="form-group">
            <label class="control-label" for="observaciones">Observaciones:</label>
            <textarea name="observaciones" id="observaciones" class="form-control" rows="5"></textarea>
        </div>
        <!-- <input type="hidden" id="observgestor" name="observgestor" class="form-control" value="0" /> -->
    </div>

    <div class="clearfix"></div>

    <p style="text-align: center; margin-top: 30px;">
    <input type="submit" name="submitx" value="Enviar Solicitud" class="btn btn-primary btn-lg">
    <a id="abrebusqueda" href="#" data-toggle=modal class="btn btn-lg btn-primary">Mostrar Solicitud</a><br>
    <a id="xmlaccion" style="float:none; display:none; margin-top: 10px; margin-left:5px;" href="#" name="matriculas" data-toggle=modal class="btn btn-sm btn-warning">XML Acción</a>
    </p>

</form>


</div>



<div class="bloqueviaje" style="display:none">

    <form class="formularioviaje" id="formulario" action="" method="post">

    <input name="fecha" type="hidden" id="fecha" value="<? echo date('Y-m-d') ?>" />
    <input name="tabla" type="hidden" id="tabla" value="peticiones_gastos" />
    <input name="tiposol" type="hidden" id="tiposol" value="SV" />
    <!-- <input type="hidden" id="id_comercial" name="id_comercial" class="form-control" /> -->
    <input name="id" type="hidden" id="id" value="" /> <!-- si hay value es que es UPDATE !-->


    <div class="clearfix"></div>


    <div class="col-md-2 col-xs-12">
        <div class="form-group">
            <label class="control-label" for="numero">Nº Solicitud:</label>
            <?
                $q = 'SELECT numero as maximo
                FROM peticiones_gastos
                ORDER BY id DESC';
                $q = mysqli_query($link, $q);

                $row = mysqli_fetch_array($q);
                $max = $row[maximo]+1;
            ?>
            <div class="input-group">
                <span class="input-group-addon">SV</span>
                    <input type="text" id="numero" value="<? echo str_pad($max, 4, '0', STR_PAD_LEFT) ?>" name="numero" class="form-control" readonly />
            </div>

        </div>
    </div>

    <div style="display:none" class="col-md-2 pull-right" style="">
        <a id="imprimirsn" style="width:100%;" href="#" class="btn btn-sm btn-success">Imprimir SN</a>
    </div>

    <div class="col-md-2 col-xs-12">
            <div class="form-group">
            <label class="control-label" for="estado">Estado:</label>
            <select id="estado" name="estado" class="form-control" >
                <option value="Pendiente">Pendiente</option>
                <option <? echo $perms; ?> value="Aceptada">Aceptada</option>
                <option <? echo $perms; ?> value="Rechazada">Rechazada</option>
                <option value="Anulada">Anulada</option>
            </select>
        </div>
    </div>

    <div class="col-md-2 col-xs-12">
    <div class="form-group">
            <label class="control-label" for="usuario">Usuario:</label>
            <?

                    $q = 'SELECT u.id
                    FROM usuarios u
                    WHERE user = "'.$_SESSION[user].'"';

                    $q = mysqli_query($link, $q);

                    $row = mysqli_fetch_array($q);
                    $id = $row[id];
                    if ( $_SESSION[user] == 'nmesa' ){
                        $id = 79;
                    }

                ?>
                <select name="usuario" id="usuario" class="form-control" readonly>
                    <option value="<? echo $_SESSION[user] ?>"><? echo $_SESSION[user] ?></option>
                </select>

                <input type="hidden" id="id_usuario" name="id_usuario" value="<? echo $id ?>" class="form-control" />


        </div>
    </div>


    <div class="clearfix"></div>

    <div class="nuevoviaje">

    </div>

    <div style="" class="col-md-2 pull-right" style="">
        <a id="anadeviaje" style="width:100%;" href="#" class="btn btn-sm btn-success">Añadir trayecto</a>
        <input type="hidden" id="anadeviajeflag" name="anadeviajeflag" value="" class="form-control" />
    </div>

    <div class="clearfix"></div>

    <div class="col-md-4 col-xs-12 motivoinput">
            <div class="form-group">
            <label class="control-label" for="motivo">Motivo:</label>
            <select id="motivogasto" name="motivogasto" class="form-control" >
                <option value="">Selecciona</option>
                <option value="Visita">Visita</option>
                <option value="Docente">Docente</option>
            </select>
        </div>
    </div>

    <div class="col-md-8 col-xs-12" style="margin-bottom: 15px">
        <div class="form-group">
            <label class="control-label" for="observaciones">Observaciones:</label>
            <textarea name="observaciones" id="observaciones" class="form-control" rows="5"></textarea>
        </div>
        <!-- <input type="hidden" id="observgestor" name="observgestor" class="form-control" value="0" /> -->
    </div>

    <div class="clearfix"></div>

    <p style="text-align: center; margin-top: 30px;">
    <input type="submit" name="submity" value="Enviar Solicitud" class="btn btn-primary btn-lg">
    <a id="abrebusqueda" href="#" data-toggle=modal class="btn btn-lg btn-primary">Mostrar Solicitud</a>
    </p>

    </form>


</div>


<div class="clearfix"></div>


<div class="bloquealojamiento" style="display:none">

    <form class="formularioalojamiento" id="formulario" action="" method="post">

    <input name="fecha" type="hidden" id="fecha" value="<? echo date('Y-m-d') ?>" />
    <input name="tabla" type="hidden" id="tabla" value="peticiones_gastos" />
    <input name="tiposol" type="hidden" id="tiposol" value="SA" />
    <!-- <input type="hidden" id="id_comercial" name="id_comercial" class="form-control" /> -->
    <input name="id" type="hidden" id="id" value="" /> <!-- si hay value es que es UPDATE !-->


    <div class="clearfix"></div>


    <div class="col-md-2 col-xs-12">
        <div class="form-group">
            <label class="control-label" for="numero">Nº Solicitud:</label>
            <?
                $q = 'SELECT numero as maximo
                FROM peticiones_gastos
                ORDER BY id DESC';
                $q = mysqli_query($link, $q);

                $row = mysqli_fetch_array($q);
                $max = $row[maximo]+1;
            ?>
            <div class="input-group">
                <span class="input-group-addon">SA</span>
                    <input type="text" id="numero" value="<? echo str_pad($max, 4, '0', STR_PAD_LEFT) ?>" name="numero" class="form-control" readonly />
            </div>

        </div>
    </div>

    <div style="display:none" class="col-md-2 pull-right" style="">
        <a id="imprimirsn" style="width:100%;" href="#" class="btn btn-sm btn-success">Imprimir SN</a>
    </div>

    <div class="col-md-2 col-xs-12">
            <div class="form-group">
            <label class="control-label" for="estado">Estado:</label>
            <select id="estado" name="estado" class="form-control" >
                <option value="Pendiente">Pendiente</option>
                <option <? echo $perms; ?> value="Aceptada">Aceptada</option>
                <option <? echo $perms; ?> value="Rechazada">Rechazada</option>
                <option value="Anulada">Anulada</option>
            </select>
        </div>
    </div>

    <div class="col-md-2 col-xs-12">
    <div class="form-group">
            <label class="control-label" for="usuario">Usuario:</label>
            <?
                    $q = 'SELECT u.id
                    FROM usuarios u
                    WHERE user = "'.$_SESSION[user].'"';

                    $q = mysqli_query($link, $q);

                    $row = mysqli_fetch_array($q);
                    $id = $row[id];

                ?>
                <select name="usuario" id="usuario" class="form-control" readonly>
                    <option value="<? echo $_SESSION[user] ?>"><? echo $_SESSION[user] ?></option>
                </select>

                <input type="hidden" id="id_usuario" name="id_usuario" value="<? echo $id ?>" class="form-control" />


        </div>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-4 col-xs-12">
        <div class="form-group">
            <label class="control-label" for="lugar">Lugar:</label>
            <input type="text" id="lugar" name="lugar" style="" class="sum form-control" />
        </div>
    </div>

    <div class="col-md-2 col-xs-12">
        <div class="form-group">
            <label class="control-label" for="fechaini">Fecha Inicio:</label>
            <input type="date" id="fechaini" name="fechaini" style="" class="sum form-control" />
        </div>
    </div>
    <div class="col-md-2 col-xs-12">
        <div class="form-group">
            <label class="control-label" for="fechafin">Fecha Fin:</label>
            <input type="date" id="fechafin" name="fechafin" style="" class="sum form-control" />
        </div>
    </div>

    <div class="col-md-2 col-xs-12">
        <div class="form-group">
            <label class="control-label" for="personas">Nº Personas:</label>
            <input type="text" id="personas" name="personas" style="" class="sum form-control" />
        </div>
    </div>
    <div class="col-md-2 col-xs-12">
        <div class="form-group">
            <label class="control-label" for="importealojamiento">Importe Alojamiento:</label>
            <input type="text" id="importealojamiento" name="importealojamiento" style="" class="sum form-control" />
        </div>
    </div>


    <div class="clearfix"></div>

    <div class="col-md-4 col-xs-12 motivoinput">
            <div class="form-group">
            <label class="control-label" for="motivo">Motivo:</label>
            <select id="motivogasto" name="motivogasto" class="form-control" >
                <option value="">Selecciona</option>
                <option value="Visita">Visita</option>
                <option value="Docente">Docente</option>
            </select>
        </div>
    </div>

    <div class="col-md-8 col-xs-12" style="margin-bottom: 15px">
        <div class="form-group">
            <label class="control-label" for="observaciones">Observaciones:</label>
            <textarea name="observaciones" id="observaciones" class="form-control" rows="5"></textarea>
        </div>
        <!-- <input type="hidden" id="observgestor" name="observgestor" class="form-control" value="0" /> -->
    </div>

    <div class="clearfix"></div>


    <p style="text-align: center; margin-top: 30px;">
    <input type="submit" name="submitz" value="Enviar Solicitud" class="btn btn-primary btn-lg">
    <a id="abrebusqueda" href="#" data-toggle=modal class="btn btn-lg btn-primary">Mostrar Solicitud</a><br>
    <a id="xmlaccion" style="float:none; display:none; margin-top: 10px; margin-left:5px;" href="#" name="matriculas" data-toggle=modal class="btn btn-sm btn-warning">XML Acción</a>
    </p>

</form>


</div>

<div class="clearfix"></div>


<div class="bloquenotagastos" style="display:none">

    <form class="formularionotagastos" id="formulario" action="" method="post">

    <input name="fecha" type="hidden" id="fecha" value="<? echo date('Y-m-d') ?>" />
    <input name="tabla" type="hidden" id="tabla" value="peticiones_gastos" />
    <input name="tiposol" type="hidden" id="tiposol" value="SN" />
    <!-- <input type="hidden" id="id_comercial" name="id_comercial" class="form-control" /> -->
    <input name="id" type="hidden" id="id" value="" /> <!-- si hay value es que es UPDATE !-->


    <div class="clearfix"></div>


    <div class="col-md-2 col-xs-12">
        <div class="form-group">
            <label class="control-label" for="numero">Nº Solicitud:</label>
            <?
                $q = 'SELECT numero as maximo
                FROM peticiones_gastos
                ORDER BY id DESC';
                $q = mysqli_query($link, $q);

                $row = mysqli_fetch_array($q);
                $max = $row[maximo]+1;
            ?>
            <div class="input-group">
                <span class="input-group-addon">SN</span>
                    <input type="text" id="numero" value="<? echo str_pad($max, 4, '0', STR_PAD_LEFT) ?>" name="numero" class="form-control" readonly />
            </div>

        </div>
    </div>

    <div class="col-md-2 pull-right" style="">
        <a id="imprimirsn" style="width:100%;" href="#" class="btn btn-sm btn-success">Imprimir SN</a>
    </div>

    <div class="col-md-2 col-xs-12">
            <div class="form-group">
            <label class="control-label" for="estado">Estado:</label>
            <select id="estado" name="estado" class="form-control" >
                <option value="Pendiente">Pendiente</option>
                <option <? echo $perms; ?> value="Aceptada">Aceptada</option>
                <option <? echo $perms; ?> value="Rechazada">Rechazada</option>
                <option <? echo $perms; ?> value="Pagado">Pagado</option>
                <option value="Anulada">Anulada</option>
            </select>
        </div>
    </div>

    <div class="col-md-2 col-xs-12">
    <div class="form-group">
            <label class="control-label" for="usuario">Usuario:</label>
            <?
                    $q = 'SELECT u.id
                    FROM usuarios u
                    WHERE user = "'.$_SESSION[user].'"';

                    $q = mysqli_query($link, $q);

                    $row = mysqli_fetch_array($q);
                    $id = $row[id];

                ?>
                <select name="usuario" id="usuario" class="form-control" readonly>
                    <option value="<? echo $_SESSION[user] ?>"><? echo $_SESSION[user] ?></option>
                </select>

                <input type="hidden" id="id_usuario" name="id_usuario" value="<? echo $id ?>" class="form-control" />


        </div>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-3 col-xs-12">
        <div class="form-group">
            <label class="control-label" for="dieta">Dietas:</label>
            <input value="Dietas" type="text" id="dieta" name="dieta" style="" class="sum form-control" disabled />
        </div>
    </div>

    <div class="col-md-3 col-xs-12">
        <div class="form-group">
            <label class="control-label" for="importedietas">Importe Total:</label>
            <input type="text" id="importedietas" name="importedietas" style="" class="sum form-control" />
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-3 col-xs-12">
        <div class="form-group">
            <label class="control-label" for="materiales">Materiales:</label>
            <input value="Materiales" type="text" id="materiales" name="materiales" style="" class="sum form-control" disabled />
        </div>
    </div>

    <div class="col-md-3 col-xs-12">
        <div class="form-group">
            <label class="control-label" for="importemateriales">Importe Total:</label>
            <input type="text" id="importemateriales" name="importemateriales" style="" class="sum form-control" />
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-3 col-xs-12">
        <div class="form-group">
            <label class="control-label" for="gasolina">Gasolina:</label>
            <input value="Gasolina" type="text" id="gasolina" name="gasolina" style="" class="sum form-control" disabled />
        </div>
    </div>

    <div class="col-md-3 col-xs-12">
        <div class="form-group">
            <label class="control-label" for="importegasolina">Importe Total:</label>
            <input type="text" id="importegasolina" name="importegasolina" style="" class="sum form-control" />
        </div>
    </div>
    <div class="col-md-6 col-xs-12">
        <div class="form-group">
            <label class="control-label" for="trayecto">Trayectos:</label>
            <input type="text" id="trayecto" name="trayecto" style="" class="sum form-control" />
        </div>
    </div>

    <div class="clearfix"></div>


    <div class="col-md-4 col-xs-12">
            <div class="form-group">
            <label class="control-label" for="metodopago">Método de Pago:</label>
            <select id="metodopago" name="metodopago" class="form-control" >
            <option value="Medios propios">Medios propios</option>
                <option value="Medios de la empresa">Medios de la empresa</option>
            </select>
        </div>
    </div>

    <div class="col-md-8 col-xs-12" style="margin-bottom: 15px">
        <div class="form-group">
            <label class="control-label" for="observaciones">Observaciones/Motivo Gastos:</label>
            <textarea name="observaciones" id="observaciones" class="form-control" rows="5"></textarea>
        </div>
        <!-- <input type="hidden" id="observgestor" name="observgestor" class="form-control" value="0" /> -->
    </div>

    <input name="tickets" type="hidden" id="tickets" value="" />

    <div class="clearfix"></div>


    <p style="text-align: center; margin-top: 30px;">
    <input type="submit" name="submitz" value="Enviar Solicitud" class="btn btn-primary btn-lg">
    <a id="abrebusqueda" href="#" data-toggle=modal class="btn btn-lg btn-primary">Mostrar Solicitud</a><br>
    <a id="xmlaccion" style="float:none; display:none; margin-top: 10px; margin-left:5px;" href="#" name="matriculas" data-toggle=modal class="btn btn-sm btn-warning">XML Acción</a>
    </p>

</form>

<div class="clearfix"></div>
<div class="col-md-6 col-xs-push-3" style="margin: 20px 0 20px 0">
<form id="formnotagastos" action="" method="post" enctype="multipart/form-data">
    <label> Subir Tickets/Facturas: </label><br>
    <input style="float:left" type="file" name="notagastos" id="notagastos" class="btn btn-default">
    <a numero="<? echo str_pad($max, 4, '0', STR_PAD_LEFT) ?>" id="subirnotagastos" class="boton btn btn-primary"><span class="glyphicon glyphicon-open"></span> Subir  </a>
    <a numero="<? echo str_pad($max, 4, '0', STR_PAD_LEFT) ?>" id="mostrarnotagastos" style="" class="boton btn btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar </a><span id="estanotagasto" style="margin-top: 10px; margin-left: 5px; color: red;" class="glyphicon glyphicon-ok-circle"></span>
</form>
</div>


</div>




<div  class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">Escoge Grupo Formativo</h4>
            </div>
            <div class="modal-body listagrupos">


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>





<!-- <div id="uploaderapp" class="col-md-1 col-xs-122" style="text-align:center; display:none; margin-top:20px ">


    <div class="clearfix"></div>
    <div class="col-md-8 col-xs-12 col-md-o col-xs-12ffset-2" style="margin-bottom: 15px">
    <form id="formparticipantessol" action="" method="post" enctype="multipart/form-data">
        <label> Tabla de participantes: </label><br>
        <input style="float:left" type="file" name="participantesol" id="participantesol" class="btn btn-default">
        <a id="subirtablasol" class="boton btn btn-primary"><span class="glyphicon glyphicon-open"></span> Subir Excel </a>
        <a id="mostrartablasol" style="" class="boton btn btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a><span id="estatabla" style="margin-top: 10px; margin-left: 5px; color: red;" class="glyphicon glyphicon-ok-circle"></span>
    </form>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-8 col-xs-12 col-md-o col-xs-12ffset-2" style="margin-bottom: 15px">
    <form id="formaxenosol" action="" method="post" enctype="multipart/form-data">
        <label> Anexo: </label><br>
        <input style="float:left" type="file" name="anexosol" id="anexosol" class="btn btn-default">
        <a id="subiranexosol" class="boton btn btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a>
        <a id="mostraranexosol" style="" class="boton btn btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a><span id="estaanexo" style="margin-top: 10px; margin-left: 5px; color: red;" class="glyphicon glyphicon-ok-circle"></span>
    </form>
    </div>


    <div class="clearfix"></div>

    <div class="col-md-8 col-xs-12 col-md-o col-xs-12ffset-2" style="margin-bottom: 15px">
    <form id="formmatriculasol" action="" method="post" enctype="multipart/form-data">
        <label> Matrícula: </label><br>
        <input style="float:left" type="file" name="matriculasol" id="matriculasol" class="btn btn-default">
        <a id="subirmatsol" class="boton btn btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a>
        <a id="mostrarmatsol" style="" class="boton btn btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a><span id="estamat" style="margin-top: 10px; margin-left: 5px; color: red;" class="glyphicon glyphicon-ok-circle"></span>
    </form>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-6 col-xs-12 col-md-o col-xs-12ffset-3" style="text-align:center">
    <a style=" margin-top: 10px " id="modeloexcel" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Plantilla Excel </a>
    </div>


</div>
 -->


</div>


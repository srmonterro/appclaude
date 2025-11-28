
<?

$baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
include_once($baseurl.'functions/funciones.php');
$anio = devuelveAnioReal();

?>

<div style="margin-top: 45px" class="container">

    <input name="matricula" type="hidden" id="matricula" value="" />
    <input name="id_matricula" type="hidden" id="id_matricula" value="" />
    <input name="id_accion" type="hidden" id="id_accion" value="" />
    <input name="id_alumno" type="hidden" id="id_alumno" value="" />
<!--     <div style="display:none" id="confirmacion" class="inv alert alert-success">Progreso guardado. Acuérdate de ir actualizándolo a medida que el alumno va avanzando en la formación.</div>
    <div style="display:none" id="error" class="alert alert-danger">Error.</div> -->

    <ol class="breadcrumb">
      <li>Facturación</li>
      <li class="active">Seguimiento Facturación Acreedores</li>
    </ol>



    <form role="form" action="" method="post" id="form-seguimiento">

        <!-- <div id="opcionFacturacion" style="display:initial;"> -->
            <div class="col-md-3" style="margin-bottom:15px;">
                <div class="form-group">
                    <label class="control-label">Tipo de facturacion</label>
                    <select id="opcionFacturacionSeleccionada" class="form-control">
                        <option value="">-</option>
                        <option value="Acreedor">Acreedor</option>
                        <option value="Docente">Docente</option>
                    </select>
                </div>
            </div>
        <!-- </div> -->
        <div class="clearfix"></div>

        <div id="factura" style="display:none;">
            <div class="col-md-1">
                <div class="form-group">
                    <label class="control-label" for="numero">Nº:</label>
                    <input type="text" id="numero" name="numero" class="form-control" />
                </div>
            </div>
            <div class="col-md-2">
                 <div class="form-group">
                        <label class="control-label" for="tipo">Tipo Acreedor:</label>
                        <select id="tipo" name="tipo" class="form-control" >
                            <option value="">Cualquiera</option>
                            <option value="Docente">Docente</option>
                            <option value="Acreedor">Acreedor</option>
                            <option value="Proveedor">Proveedor</option>
                        </select>
                    </div>
            </div>
            <div class="col-md-4">
                <div class="cp form-group">
                <label class="control-label" for="acreedor">Acreedor:</label>
                <div class="input-group">
                    <input type="text" id="acreedor" name="acreedor" class="form-control" />
                    <span class="input-group-btn">
                        <a id="buscaracreedor" name="buscaracreedor" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></a>
                    </span>
                </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label" for="fechaini">Fecha Inicio:</label>
                    <input type="date" id="fechaini" name="fechaini" class="form-control" value= <? echo $anio.'-01-01' ?> />
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label" for="fechafin">Fecha Fin:</label>
                    <input type="date" id="fechafin" name="fechafin" class="form-control" value= <? echo $anio.'-12-31' ?> />
                </div>
            </div>
            <div class="col-md-1">
                <a style="margin-top: 24px; width:100%;" id="restablecer-c" class="btn btn-default"><span class="glyphicon glyphicon-repeat"></span></a>
            </div>

            <div class="clearfix"></div>
            <div class="col-md-12" style="height: 15px;"></div>
            <div class="clearfix"></div>


            <div class="col-md-1">
                <div class="form-group">
                        <label class="control-label" for="acumulado">Anual</label>
                        <select id="acumulado" name="acumulado" class="form-control" >
                            <option value="">No</option>
                            <option value="Si">Si</option>
                        </select>
                    </div>
            </div>
            <div class="col-md-3">
                 <div class="form-group">
                        <label class="control-label" for="mes_vencimiento">Mes Vencimiento:</label>
                        <select id="mes_vencimiento" name="mes_vencimiento" class="form-control" >
                            <option value="">Cualquiera</option>
                            <option value="1">Enero</option>
                            <option value="2">Febrero</option>
                            <option value="3">Marzo</option>
                            <option value="4">Abril</option>
                            <option value="5">Mayo</option>
                            <option value="6">Junio</option>
                            <option value="7">Julio</option>
                            <option value="8">Agosto</option>
                            <option value="9">Septiembre</option>
                            <option value="10">Octubre</option>
                            <option value="11">Noviembre</option>
                            <option value="12">Diciembre</option>
                        </select>
                    </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                   <label class="control-label" for="estado">Estado:</label>
                        <select id="estado" name="estado" class="form-control">
                            <option value="">Cualquiera</option>
                            <option value="Pendiente">Pendiente de Pago</option>
                            <option value="Pagada">Pagada</option>
                            <option value="Anulada">Anulada</option>
                        </select>
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label" for="total_factura">Importe:</label>
                    <input type="text" id="importe" name="importe" class="form-control" />
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label" for="importe_a_abonar">Pendiente:</label>
                    <input type="text" id="pendiente" name="pendiente" class="form-control" />
                </div>
            </div>

            <!-- <div class="clearfix"></div>
            <div class="col-md-12" style="height: 15px;"></div>
            <div class="clearfix"></div> -->

            <div class="col-md-1">
                <a style="margin-top: 24px; width:100%;" id="busqueda-seguimientofacre" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></a>
            </div>
        </div>

        <div id="nomina" style="display:none;">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label" for="id_docente">Docente:</label>
                    <select id="id_docente" name="id_docente" class="form-control">';
                    <?php
                    $resultado = mysqli_query($link, "SELECT u.id_docente, nu.nombre FROM nominas_usuarios nu
                                                        INNER JOIN usuarios u
                                                        ON nu.usuario = u.id
                                                        INNER JOIN docentes d
                                                        ON u.id_docente = d.id
                                                        ORDER BY nu.nombre ASC");
                    echo '<option value="">Cualquiera</option>';
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        echo '<option value="'.$fila['id_docente'].'">'.$fila['nombre'].'</option>';
                    }
                    ?>
                    </select>
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label" for="fecha_inicio">Fecha inicio</label>
                    <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control">
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label" for="fecha_fin">Fecha fin</label>
                    <input type="date" id="fecha_fin" name="fecha_fin" class="form-control">
                </div>
            </div>

            <div class="col-md-1">
                <a style="margin-top: 24px; width:100%;" id="busqueda-nominadocente" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></a>
            </div>

            <!-- <div class="col-md-1">
                <a style="margin-top: 24px; width:100%;" id="busqueda-seguimientofacre" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></a>
            </div> -->
        </div>

    </form>

    <div class="clearfix"></div>

    </div>
    <div id="listado-seguimiento" style="">

    </div>
    <form id="lala" action="functions/exportarexcel_seguimientoe.php" method="post" target="_blank">

        <a id="imprimirSeguimientoc" onclick="printDiv('listado-seguimiento')" style="margin-top: -120px; display: none" class="pull-left btn btn-primary btn-default"><span class="glyphicon glyphicon-print"></span> Imprimir</a>

        <a id="listadoExcelAcre" style="margin-top: -120px; margin-left: 100px; display: none" class="pull-left btn btn-primary btn-default"><span class="glyphicon glyphicon-list-alt"></span> Exportar a Excel</a>

        <input type="hidden" id="datatodisplay" name="datatodisplay" />
    </form>




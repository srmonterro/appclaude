<div style="margin-top: 45px" class="container">
    
    <input name="matricula" type="hidden" id="matricula" value="" />
    <input name="id_matricula" type="hidden" id="id_matricula" value="" />  
    <input name="id_accion" type="hidden" id="id_accion" value="" />
    <input name="id_alumno" type="hidden" id="id_alumno" value="" />
<!--     <div style="display:none" id="confirmacion" class="inv alert alert-success">Progreso guardado. Acuérdate de ir actualizándolo a medida que el alumno va avanzando en la formación.</div>
    <div style="display:none" id="error" class="alert alert-danger">Error.</div> -->


    <ol class="breadcrumb">
      <li>Facturación</li>
      <li class="active">Seguimiento Facturación</li>
    </ol>

    <form role="form" action="" method="post" id="form-seguimiento">


        <div class="col-md-2">
            <div class="form-group">
               <label class="control-label" for="bonificado">Tipo:</label>
                    <select id="bonificado" name="bonificado" class="form-control">
                        <option value="Cualquiera">Cualquiera</option>
                        <option value="bonificado">Bonificado</option>
                        <option value="privado">Privado</option>
                        <option value="rectificativa">Rectificativa</option>
                    </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label" for="numeroaccion">Acción Formativa:</label>
                <input type="text" id="numeroaccion" name="numeroaccion" class="form-control" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label" for="denominacion">Denominación Acción Formativa:</label>
                <input type="text" id="denominacion" name="denominacion" class="form-control"  />
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label" for="fechaini">Fecha Inicio:</label>
                <input type="date" id="fechaini" name="fechaini" class="form-control" value="2014-01-01"/>
            </div>
        </div> 
        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label" for="fechafin">Fecha Fin:</label>
                <input type="date" id="fechafin" name="fechafin" class="form-control" value="2014-12-31"/>
            </div>
        </div>
        <div class="col-md-1">
            <a style="margin-top: 24px; width:100%;" id="restablecer-c" class="btn btn-default"><span class="glyphicon glyphicon-repeat"></span></a>
        </div>

        <div class="clearfix"></div>
        <div class="col-md-12" style="height: 15px;"></div>
        <div class="clearfix"></div>

        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label" for="numero">Número Factura:</label>
                <input type="text" id="numero" name="numero" class="form-control" />
            </div>
        </div>
        <div class="col-md-4">
            <div class="cp form-group">
            <label class="control-label" for="razonsocial">Empresa:</label>
            <div class="input-group">
                <input type="text" id="razonsocial" name="razonsocial" class="form-control" />
                <span class="input-group-btn">
                    <button id="buscarempresa" name="buscarempresa" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                </span>
            </div>
            </div>
        </div>
<!--         <div class="col-md-3" style="margin-top: 20px;">
            <div class="checkbox">
            <label>
              <input type="checkbox"> Facturado a otra empresa
            </label>
          </div>
        </div> -->

        <div class="col-md-3">
            <div class="form-group">
                    <label class="control-label" for="facturar_a">¿ Facturado a otra empresa ?</label>
                    <select id="facturar_a" name="facturar_a" class="form-control" >
                        <option value="">No</option>
                        <option value="Si">Sí</option>
                    </select>
                </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                    <label class="control-label" for="mes_fin">Mes Finalización:</label>
                    <select id="mes_fin" name="mes_fin" class="form-control" >
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


        <div class="clearfix"></div>
        <div class="col-md-12" style="height: 15px;"></div>
        <div class="clearfix"></div>

        <div class="col-md-2">
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
               <label class="control-label" for="formapago">Forma Pago:</label>
                    <select id="formapago" name="formapago" class="form-control">
                        <option value="">Cualquiera</option>
                        <option value="Transferencia">Transferencia</option>
                        <option value="Remesa">Remesa</option>
                        <option value="Cheque">Cheque</option>
                        <option value="Efectivo">Efectivo</option>
                    </select>
            </div>
        </div>

        <div class="col-md-2">
        <div class="form-group">
            <label class="control-label" for="comercial">Comercial:</label>
            <select id="comercial" name="comercial" class="form-control">
                <? 

                    if ( $_SESSION['user'] == 'isabel' ) 
                        $q = 'SELECT id,nombre,apellido,apellido2 
                        FROM comerciales 
                        WHERE id IN(3,10,7)
                        ORDER by id ASC';
                    else if ( $_SESSION['user'] == 'efrencomercial' ) 
                        $q = 'SELECT id,nombre,apellido,apellido2 
                        FROM comerciales 
                        WHERE id IN(4)
                        ORDER by id ASC';
                    else if ( $_SESSION['user'] == 'oscar' ) 
                        $q = 'SELECT id,nombre,apellido,apellido2 
                        FROM comerciales 
                        WHERE id IN(3,10,7)
                        ORDER by id ASC';
                    else {
                        $q = 'SELECT id,nombre,apellido,apellido2 
                        FROM comerciales 
                        WHERE id NOT IN(1,8,9)
                        ORDER by id ASC';
                        echo '<option value="">Cualquiera</option>';
                    }
                    $q = mysqli_query($link,$q);
                    
                    
                    while ($row = mysqli_fetch_array($q))
                        echo '<option value="'.$row['id'].'">'.$row['nombre'].' '.$row['apellido'].' '.$row['apellido2'].'</option>';
                ?>
            </select>
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            <label class="control-label" for="grupoempresa">Grupo:</label>
            <select id="grupoempresa" name="grupoempresa" class="form-control">
                <? 
                    $q = 'SELECT id, grupo
                    FROM grupos_empresas ORDER by id ASC';
                    $q = mysqli_query($link,$q);
                    echo '<option value="">Cualquiera</option>';
                    while ($row = mysqli_fetch_array($q))
                        echo '<option value="'.$row['id'].'">'.$row['grupo'].'</option>';
                ?>
            </select>
        </div>
        </div>
        <div class="col-md-1">
            <a style="margin-top: 24px; width:100%;" id="busqueda-seguimientof" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></a>
        </div>

    </form> 

    <div class="clearfix"></div>
    <div class="col-md-12" style="height: 15px;"></div>
    <div class="clearfix"></div>

    <!-- </div> -->

    <div class="col-md-6">
        <table id="leyenda" style="display:none">
            <tr>
                <td class="text-warning">Pendiente de pago</td>
                <td> | </td>
                <td class="text-info">Pagada parcialmente</td>                
                <td> | </td>
                <td class="text-success">Pagada</td>
                <td> | </td>
                <td class="text-danger">Rectificada</td>            
            </tr>
        </table>
    </div>
    <div class="col-md-6 pull-right">
        <a id="imprimirSeguimientoc" onclick="printDiv('listado-seguimiento')" style="display: none" class="pull-right btn btn-primary btn-default"><span class="glyphicon glyphicon-print"></span> Imprimir</a>

        <a id="listadoExcel" style=" margin-left: 20px;display: none" class="pull-right btn btn-primary btn-default"><span class="glyphicon glyphicon-list-alt"></span> Exportar a Excel</a>
    </div></div>
    <div class="clearfix"></div>
    <div id="listado-seguimiento" style="">

    </div>
    <form id="lala" action="functions/exportarexcel_seguimientoe.php" method="post" target="_blank">

<!--         <a id="imprimirSeguimientoc" onclick="printDiv('listado-seguimiento')" style="overflow:auto; margin-top: -180px; display: none" class="pull-left btn btn-primary btn-default"><span class="glyphicon glyphicon-print"></span> Imprimir</a>

        <a id="listadoExcel" style="overflow:auto; margin-top: -180px; margin-left: 100px; display: none" class="pull-left btn btn-primary btn-default"><span class="glyphicon glyphicon-list-alt"></span> Exportar a Excel</a>
 -->
        <input type="hidden" id="datatodisplay" name="datatodisplay" />
    </form>




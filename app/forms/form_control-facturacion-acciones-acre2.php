<?
include './funciones.php';

if ( isset($_POST['id_matricula']) ){
	$id_matricula = $_POST['id_matricula'];
	$bisible = '';
	echo $id_matricula;
} else
{
	$bisible = 'style="display:none"';
}


?>

<div style="margin-top: 30px" class="container">

<form class="formularioaccion" id="formulario" role="form" action="" method="post">

    <div class="col-md-12 " style="text-align: left;min-height:70px;">
    	<input name="tabla" type="hidden" id="tabla" value="matriculas" />
		<input name="id" type="hidden" id="id" value="" />

        <a id="abrebusqueda" href="#" data-toggle=modal class="btn btn-lg btn-primary">Seleccionar Acción</a>
    </div>

    <span id="contenido"></span>

    <!-- <div id="datosaccion" class="col-md-12 " <? $bisible ?> /> -->
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

		<!-- <div id="listado-facturas" class="col-md-12"  <? $bisible ?> /> -->

<?

	$sec = basename($_SERVER['HTTP_REFERER'], ".php");

    if ( $sec  == 'index.php?form_control-facturacion-acciones-acre' ) {
        $tipo = "acreedor";
    }else if ( $sec  == 'index.php?form_control-facturacion-acciones-cli' ){
        $tipo = "cliente";
    }

    $qmatricula = "SELECT estado FROM matriculas WHERE id = ".$id_matricula;
    
    $qmatricula = mysqli_query($link, $qmatricula) or die(" error Buscar Matrícula:" .mysqli_error($link));
    
    $row = mysqli_fetch_array($qmatricula);

    if ( ( $row[estado] == "Facturada" ) || ( $row[estado] == "Liquidada" ) ){

        if ( $tipo == "acreedor" ) {

            $q = "SELECT acre.razonsocial,
                f.fecha,
                f.importe,
                f.porcentaje,
                acre.razonsocial
                FROM facturacion_matriculas_acre AS f
                INNER JOIN matriculas AS m ON f.id_matricula = m.id
                INNER JOIN acciones AS a ON m.id_accion = a.id
                INNER JOIN facturacion_acreedores AS fa ON f.id_factura = fa.id
                INNER JOIN acreedores AS acre ON fa.acreedor = acre.id
                WHERE m.id = ".$id_matricula;

        } else if ( $tipo == "cliente" ) {

            $q = "SELECT
                e.razonsocial,
                total_factura as importe,
                fecha,
                estado,
                numero
                FROM facturacion_bonificada AS f
                LEFT JOIN empresas AS e ON f.empresa = e.id
                WHERE matricula = ".$id_matricula."
                UNION
                SELECT
                e.razonsocial,
                total_factura as importe,
                fecha,
                estado,
                numero
                FROM facturacion_privada AS f
                LEFT JOIN empresas AS e ON f.empresa = e.id
                WHERE matricula = ".$id_matricula;

        }

        if ( $_SESSION['user'] == 'root' ){
            // echo "<br>".$q;
        }

        $q = mysqli_query($link, $q) or die(" error Buscar Facturas Accion:" .mysqli_error($link));

        $numregistros = mysqli_num_rows($q);

        if ( $numregistros > 0 ) {
            echo '<div class="col-md-12">';
            echo '<h3>Facturas Asociadas:</h3>';
            echo '<table style="margin-top: 15px;" class="table">
                        <thead>
                            <tr>';
                            if ( $tipo == "acreedor" ) {
                                echo '<th style="text-align:center">Acreedor</th>';
                            } else {
                                echo '<th style="text-align:center">Cliente</th>';
                            }
                            echo '<th style="text-align:center">Numero Fractura</th>';
                            echo '<th style="text-align:center">Fecha</th>';
                            echo '<th style="text-align:center">Importe</th>';
                            if ( $tipo == "acreedor" ) {
                            echo '<th style="text-align:center">Porcentaje</th>';
                            }
                            echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';

            while ($row = mysqli_fetch_array($q)) {
                        echo '<tr>';
                        echo '<td>';
                        echo($row[razonsocial]);
                        echo "</td>";
                        echo "<td style='text-align:center'>";
                        echo($row[numero]);
                        echo "</td>";
                        echo "<td style='text-align:center'>";
                        echo(formateaFecha($row[fecha]));
                        echo "</td>";
                        echo "<td style='text-align:center'>";
                        echo(number_format($row[importe], 2));
                        echo "</td>";
                        if ( $tipo == "acreedor" ) {
                        echo "<td style='text-align:center'>";
                        echo(number_format($row[porcentaje], 2));
                        echo "</td>";
                        }
                    }
            echo '      </tbody>
                    </table>
                </div>';

        }

    } else {

        $q2 = "SELECT
            mc.costes_imparticion,
            mc.costes_salariales,
            mc.maximo_bonificable,
            mc.costes_indirectos,
            mc.costes_organizacion,
            mc.importe_a_bonificar,
            e.razonsocial
            FROM mat_costes AS mc
            LEFT JOIN empresas AS e ON mc.id_empresa = e.id
            WHERE mc.id_matricula = ".$id_matricula;

        if ( $_SESSION['user'] == 'root' ){
            // echo "<br>".$q2;
        }

        $q2 = mysqli_query($link, $q2) or die("error BuscarFacturasAccion:" .mysqli_error($link));

        $numregistros2 = mysqli_num_rows($q2);

        if ( $_SESSION['user'] == 'root' ){
            // echo "Numregistro: ".$numregistros2;
        }

        if ( $numregistros2 > 0 ) {
            echo '<div class="col-md-12">';
            echo '<h3>Costes Asociados:</h3>';
            echo '<table style="margin-top: 15px;" class="table">
                        <thead>
                            <tr>
                                <th style="text-align:center">Empresa</th>
                                <th style="text-align:center">Costes Impartición</th>
                                <th style="text-align:center">Costes Salariales</th>
                                <th style="text-align:center">Máximo Bonificable</th>
                                <th style="text-align:center">Costes Indirectos</th>
                                <th style="text-align:center">Costes Organizacion</th>
                                <th style="text-align:center">Importe a Bonificar</th>
                            </tr>
                        </thead>
                        <tbody>';

            while ($row = mysqli_fetch_array($q2)) {
                        echo '<tr>';
                        echo '<td>';
                        echo($row[razonsocial]);
                        echo "</td>";
                        echo "<td style='text-align:center'>";
                        echo(number_format($row[costes_imparticion], 2));
                        echo "</td>";
                        echo "<td style='text-align:center'>";
                        echo(number_format($row[costes_salariales], 2));
                        echo "</td>";
                        echo "<td style='text-align:center'>";
                        echo(number_format($row[maximo_bonificable], 2));
                        echo "</td>";
                        echo "<td style='text-align:center'>";
                        echo(number_format($row[costes_indirectos], 2));
                        echo "</td>";
                        echo "<td style='text-align:center'>";
                        echo(number_format($row[costes_organizacion], 2));
                        echo "</td>";
                        echo "<td style='text-align:center'>";
                        echo(number_format($row[importe_a_bonificar], 2));
                        echo "</td>";
                    }
            echo '      </tbody>
                    </table>
                </div>';
        }

    }

    $q3 = "SELECT
        cr.costeaula,
        cr.costedocente,
        cr.fungibledidac,
        cr.administracion,
        cr.otrosgastos,
        cr.precioventamat,
        cr.alumnosestimados,
        cr.totalingresos,
        cr.totalcostes,
        cr.margenbeneficio,
        cr.porcentajeventas,
        cr.ventasrequerido,
        cr.nalumnosnecesario
        FROM costes_rentabilidad AS cr
        WHERE cr.id_matricula = ".$id_matricula;


    if ( $_SESSION['user'] == 'root' ){
        // echo "<br>".$q3;
    }

    $q3 = mysqli_query($link, $q3) or die("error BuscarFacturasAccion:" .mysqli_error($link));

    $numregistros3 = mysqli_num_rows($q3);

    if ( $_SESSION['user'] == 'root' ){
        // echo "Numregistro: ".$numregistros2;
    }

    if ( $numregistros3 > 0 ) {
        echo '<div class="col-md-12">';
        echo '<h3>Detalle de Rentabilidad:</h3>';
        echo '<table style="margin-top: 15px;" class="table">
                    <thead>
                        <tr>
                            <th style="text-align:center">Coste Aula</th>
                            <th style="text-align:center">Coste Docente</th>
                            <th style="text-align:center">Fungibles Didáctico</th>
                            <th style="text-align:center">Administración</th>
                            <th style="text-align:center">Otros Gastos</th>
                            <th style="text-align:center">Precio Venta</th>
                            <th style="text-align:center">Alumnos Estimados</th>
                            <th style="text-align:center">Total Ingresos</th>
                            <th style="text-align:center">Total Costes</th>
                            <th style="text-align:center">Margen Beneficios</th>
                            <th style="text-align:center">% Ventas</th>
                            <th style="text-align:center">% Ventas Requerido</th>
                            <th style="text-align:center">Nº Alumnos Necesarios</th>
                        </tr>
                    </thead>
                    <tbody>';

        while ($row = mysqli_fetch_array($q3)) {
                    echo '<tr>';
                    echo "<td style='text-align:center'>";
                    echo(number_format($row[costeaula], 2));
                    echo "</td>";
                    echo "<td style='text-align:center'>";
                    echo(number_format($row[costedocente], 2));
                    echo "</td>";
                    echo "<td style='text-align:center'>";
                    echo(number_format($row[fungibledidac], 2));
                    echo "</td>";
                    echo "<td style='text-align:center'>";
                    echo(number_format($row[administracion], 2));
                    echo "</td>";
                    echo "<td style='text-align:center'>";
                    echo(number_format($row[otrosgastos], 2));
                    echo "</td>";
                    echo "<td style='text-align:center'>";
                    echo(number_format($row[precioventamat], 2));
                    echo "</td>";
                    echo "<td style='text-align:center'>";
                    echo($row[alumnosestimados]);
                    echo "</td>";
                    echo "<td style='text-align:center'>";
                    echo(number_format($row[totalingresos], 2));
                    echo "</td>";
                    echo "<td style='text-align:center'>";
                    echo(number_format($row[totalcostes], 2));
                    echo "</td>";
                    echo "<td style='text-align:center'>";
                    echo(number_format($row[margenbeneficio], 2));
                    echo "</td>";
                    echo "<td style='text-align:center'>";
                    echo(number_format($row[porcentajeventas], 2));
                    echo "</td>";
                    echo "<td style='text-align:center'>";
                    echo(number_format($row[ventasrequerido], 2));
                    echo "</td>";
                    echo "<td style='text-align:center'>";
                    echo($row[nalumnosnecesario]);
                    echo "</td>";
                }
        echo '      </tbody>
                </table>
            </div>';
    }

    
    $q4 = "SELECT mig.*, ig.item, round(mig.cantidad * ig.precio, 2) AS importe_item 
        FROM mat_items_gastos AS mig INNER JOIN items_gastos AS ig ON mig.id_item = ig.id
        WHERE ig.tipo = 0 AND mig.id_mat = ".$id_matricula;
 
 
    if ( $_SESSION['user'] == 'root' ){
        // echo "<br>".$q4;
    }
 
    $q4 = mysqli_query($link, $q4) or die("error BuscarItemsFungible:" .mysqli_error($link));
 
    $numregistros4 = mysqli_num_rows($q4);
    $totalfungibles = 0;
 
    if ( $_SESSION['user'] == 'root' ){
        // echo "Numregistro: ".$numregistros2;
    }
 
    if ( $numregistros4 > 0 ) {
        echo '<div class="col-md-7">';
        echo '<h3>Detalle de Fungibles:</h3>';
        echo '<table style="margin-top: 15px;" class="table">
                    <thead>
                        <tr>
                            <th style="text-align:center">Item</th>
                            <th style="text-align:center">Cantidad</th>
                            <th style="text-align:center">Importe</th>
                        </tr>
                    </thead>
                    <tbody>';
 
        while ($row = mysqli_fetch_array($q4)) {
                    echo '<tr>';
                    echo "<td style='text-align:left'>";
                    echo($row[item]);
                    echo "</td>";
                    echo "<td style='text-align:center'>";
                    echo(number_format($row[cantidad], 0));
                    echo "</td>";
                    echo "<td style='text-align:center'>";
                    echo(number_format($row[importe_item], 2));
                    echo "</td>";
                    echo '</tr>';
                    $totalfungibles += $row[importe_item];
                }
        echo '      <tr><td style="text-align:right" colspan=3><h4>Total Fungibles: '.$totalfungibles.'</h4></td></tr>';
        echo '      </tbody>
                </table>
            </div>';
    }
 
    $q5 = "SELECT mig.*, ig.item, round(mig.cantidad * ig.precio, 2) AS importe_item 
        FROM mat_items_gastos AS mig INNER JOIN items_gastos AS ig ON mig.id_item = ig.id
        WHERE ig.tipo = 1 AND mig.id_mat = ".$id_matricula;
 
 
    if ( $_SESSION['user'] == 'root' ){
        // echo "<br>".$q5;
    }
 
    $q5 = mysqli_query($link, $q5) or die("error BuscarItemsOtrosGastos:" .mysqli_error($link));
 
    $numregistros5 = mysqli_num_rows($q5);
    $totalotrosgastos = 0;
 
    if ( $_SESSION['user'] = 'root' ){
        // echo "Numregistro: ".$numregistros2;
    }
 
    if ( $numregistros5 > 0 ) {
        echo '<div class="col-md-7">';
        echo '<h3>Detalle de Otros Gastos:</h3>';
        echo '<table style="margin-top: 15px;" class="table">
                    <thead>
                        <tr>
                            <th style="text-align:center">Item</th>
                            <th style="text-align:center">Cantidad</th>
                            <th style="text-align:center">Importe</th>
                        </tr>
                    </thead>
                    <tbody>';
 
        while ($row = mysqli_fetch_array($q5)) {
                    echo '<tr>';
                    echo "<td style='text-align:left'>";
                    echo($row[item]);
                    echo "</td>";
                    echo "<td style='text-align:center'>";
                    echo(number_format($row[cantidad], 0));
                    echo "</td>";
                    echo "<td style='text-align:center'>";
                    echo(number_format($row[importe_item], 2));
                    echo "</td>";
                    echo '</tr>';
                    $totalotrosgastos += $row[importe_item];
                }
        echo '      <tr><td style="text-align:right" colspan=3><h4>Total Otros Gastos: '.$totalotrosgastos.'</h4></td></tr>';
        echo '      </tbody>
                </table>
            </div>';

    }

?>
    </div>

</form>

<!-- <div class="col-md-12">
		
	<input name="tabla" type="hidden" id="tabla" value="acciones" />
	<input name="id" type="hidden" id="id" value="" />  si hay value es que es UPDATE !

	<p style="text-align: center; margin-top: 30px;">
		<a id="abrebusqueda" href="#" data-toggle=modal class="btn btn-lg btn-primary">Mostrar Acciones</a><br>
	</p>

</div> -->
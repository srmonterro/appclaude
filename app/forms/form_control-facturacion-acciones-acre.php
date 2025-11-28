<?
include './funciones.php';

if ( isset($_GET['id_matricula']) ){
	$id_matricula = $_GET['id_matricula'];
	$id_empresa = $_GET['id_empresa'];
} else {
	$id_matricula = '';
	$id_empresa = '';
}

echo '<div style="margin-top: 30px" class="container">';
echo '<form class="formularioaccion" id="formulario" role="form" action="" method="post">';
echo '	<span id="contenido"></span>';
echo '	<div id="datosaccion" class="col-md-12 " >';
	
$hayDatos = 0;

if ( $id_matricula != ''){
	$q1 = "SELECT concat(a.numeroaccion, '/', ga.ngrupo) AS accion,
		a.denominacion,
		m.fechaini,
		m.fechafin,
		m.estado
		FROM matriculas AS m 
		INNER JOIN acciones AS a ON m.id_accion = a.id
		INNER JOIN grupos_acciones AS ga ON m.id_grupo = ga.id
		WHERE m.id = ".$id_matricula ;

	$q1 = mysqli_query($link, $q1) or die(" error Buscar Facturas Accion:" .mysqli_error($link));

	$row = mysqli_fetch_array($q1);

	$naccion = $row['accion'];
	$denominacion = $row['denominacion'];
	$fechaini = $row['fechaini'];
	$fechafin = $row['fechafin'];
    $estado = $row['estado'];
    $totalFinalGastos = 0;
    $totalFinalIngresos = 0;
}

// DATOS DE LA MATRÍCULA
$bloqueCabecera = '';
$bloqueCabecera .= '    	<div class="col-md-2">';
$bloqueCabecera .= '	    	<div class="form-group">';
$bloqueCabecera .= '			    <label class="control-label" for="numeroaccion">Número Acción:</label>';
$bloqueCabecera .= '			    <input disabled placeholder="'.$naccion.'" type="text" id="numeroaccion" name="numeroaccion" class="form-control" />';
$bloqueCabecera .= '			    <input type="hidden" id="id" name="id" class="form-control" />';
$bloqueCabecera .= '		    </div>';
$bloqueCabecera .= '		</div>';
$bloqueCabecera .= '		<div class="col-md-4">';
$bloqueCabecera .= '	    	<div class="form-group">';
$bloqueCabecera .= '			    <label class="control-label" for="denominacion">Nombre Acción:</label>';
$bloqueCabecera .= '			    <input disabled type="text" id="denominacion" name="denominacion" class="form-control" value="'.$denominacion.'"/>';
$bloqueCabecera .= '		    </div>';
$bloqueCabecera .= '		</div>';
$bloqueCabecera .= '        <div class="col-md-2">';
$bloqueCabecera .= '            <div class="form-group">';
$bloqueCabecera .= '                <label class="control-label" for="estado">Estado:</label>';
$bloqueCabecera .= '                <input disabled type="text" id="estado" name="estado" class="form-control" value="'.$estado.'"/>';
$bloqueCabecera .= '            </div>';
$bloqueCabecera .= '        </div>';
$bloqueCabecera .= '		<div class="col-md-2">';
$bloqueCabecera .= '	    	<div class="form-group">';
$bloqueCabecera .= '			    <label class="control-label" for="fechainicio">Fecha Inicio:</label>';
$bloqueCabecera .= '			    <input disabled type="text" id="fechainicio" name="fechainicio" class="form-control" value="'.formateaFecha($fechaini).'"/>';
$bloqueCabecera .= '		    </div>';
$bloqueCabecera .= '		</div>';
$bloqueCabecera .= '		<div class="col-md-2">';
$bloqueCabecera .= '	    	<div class="form-group">';
$bloqueCabecera .= '			    <label class="control-label" for="fechafin">Fecha Fin:</label>';
$bloqueCabecera .= '			    <input disabled type="text" id="fechafin" name="fechafin" class="form-control" value="'.formateaFecha($fechafin).'" />';
$bloqueCabecera .= '		    </div>';
$bloqueCabecera .= '		</div>';
$bloqueCabecera .= '	</div>';
$bloqueCabecera .= '	<div class="clearfix"></div>';
$bloqueCabecera .= '	<div id="listado-facturas" class="col-md-12" />';

$sec = basename($_SERVER['HTTP_REFERER'], ".php");

// DATOS DE LAS FACTURAS DE ACREEDORES ASOCIADAS
$qAcreedores = "SELECT acre.razonsocial,
        f.fecha,
        f.importe,
        f.porcentaje,
        acre.razonsocial,
        fa.numero
        FROM facturacion_matriculas_acre AS f
        INNER JOIN matriculas AS m ON f.id_matricula = m.id
        INNER JOIN acciones AS a ON m.id_accion = a.id
        INNER JOIN facturacion_acreedores AS fa ON f.id_factura = fa.id
        INNER JOIN acreedores AS acre ON fa.acreedor = acre.id
        WHERE m.id = ".$id_matricula;

if ( isRoot() ){
    // echo "<br>".$qAcreedores;
}

$qAcreedores = mysqli_query($link, $qAcreedores) or die(" error Buscar Facturas Accion:" .mysqli_error($link));

$numregistros = mysqli_num_rows($qAcreedores);

if ( $numregistros > 0 ) {

    $hayDatos = 1;

	$totalImporteAcreedores = 0;

    $bloqueAcreedores = '';
    $bloqueAcreedores .= '<div class="col-md-12">';
    $bloqueAcreedores .= '<h3>Facturas Acreedores Asociadas:</h3>';
    $bloqueAcreedores .= '<table style="margin-top: 15px;" class="table table-bordered table-striped">
                <thead>
                    <tr>';
    $bloqueAcreedores .= '<th style="text-align:center">Acreedor</th>';                          
    $bloqueAcreedores .= '<th style="text-align:center">Numero Fractura</th>';
    $bloqueAcreedores .= '<th style="text-align:center">Fecha</th>';
    $bloqueAcreedores .= '<th style="text-align:center">Importe</th>';
    $bloqueAcreedores .= '<th style="text-align:center">Porcentaje</th>';
    $bloqueAcreedores .= '</tr>';
    $bloqueAcreedores .= '</thead>';
    $bloqueAcreedores .= '<tbody>';

    while ($rowAcreedores = mysqli_fetch_array($qAcreedores)) {
        $bloqueAcreedores .= '<tr>';
        $bloqueAcreedores .= '<td>';
        $bloqueAcreedores .= ''.$rowAcreedores[razonsocial].'';
        $bloqueAcreedores .= '</td>';
        $bloqueAcreedores .= '<td style="text-align:center">';
        $bloqueAcreedores .= ''.$rowAcreedores[numero].'';
        $bloqueAcreedores .= '</td>';
        $bloqueAcreedores .= '<td style="text-align:center">';
        $bloqueAcreedores .= ''.formateaFecha($rowAcreedores[fecha]).'';
        $bloqueAcreedores .= '</td>';
        $bloqueAcreedores .= '<td style="text-align:center">';
        $bloqueAcreedores .= ''.number_format($rowAcreedores[importe], 2).'';
        $totalImporteAcreedores += $rowAcreedores[importe];
        $bloqueAcreedores .= ' </td>';
        $bloqueAcreedores .= ' <td style="text-align:center">';
        $bloqueAcreedores .= ''.number_format($rowAcreedores[porcentaje], 2).'';
        $bloqueAcreedores .= ' </td>';
    }
    $bloqueAcreedores .= '      <tr><td style="text-align:right" colspan=5><h4>Total Facturas de Acreeodes Asociadas: '.number_format($totalImporteAcreedores,2).'</h4></td></tr>';
    $bloqueAcreedores .= '      </tbody>
            </table>
        </div>';
    
    $totalFinalGastos += $totalImporteAcreedores;

}

// DATOS DE LAS FACTURAS DE CLIENTES ASOCIADAS
$qClientes = "SELECT
        e.razonsocial,
        total_factura as importe,
        fecha,
        estado,
        numero
        FROM facturacion_bonificada AS f
        LEFT JOIN empresas AS e ON f.empresa = e.id
        WHERE matricula = ".$id_matricula." AND e.id = ".$id_empresa."
        UNION
        SELECT
        e.razonsocial,
        total_factura as importe,
        fecha,
        estado,
        numero
        FROM facturacion_privada AS f
        LEFT JOIN empresas AS e ON f.empresa = e.id
        WHERE matricula = ".$id_matricula." AND e.id = ".$id_empresa;

if ( isRoot() ){
//	echo "<br>".$qClientes;
}

$qClientes = mysqli_query($link, $qClientes) or die(" error Buscar Facturas Clientes:" .mysqli_error($link));

$numregistros = mysqli_num_rows($qClientes);

if ( $numregistros > 0 ) {

    $hayDatos = 1;

	$totalImporteClientes = 0;
    $bloqueClientes = '';
    $bloqueClientes .= '<div class="col-md-12">';
    $bloqueClientes .= '<h3>Facturas Clientes Asociadas:</h3>';
    $bloqueClientes .= '<table style="margin-top: 15px;" class="table table-bordered table-striped">
                <thead>
                    <tr>';
    $bloqueClientes .= '<th style="text-align:center">Cliente</th>';
    $bloqueClientes .= '<th style="text-align:center">Numero Fractura</th>';
    $bloqueClientes .= '<th style="text-align:center">Fecha</th>';
    $bloqueClientes .= '<th style="text-align:center">Importe</th>';
    $bloqueClientes .= '</tr>';
    $bloqueClientes .= '</thead>';
    $bloqueClientes .= '<tbody>';

    while ($rowClientes = mysqli_fetch_array($qClientes)) {
        $bloqueClientes .= '<tr>';
        $bloqueClientes .= '<td>';
        $bloqueClientes .= $rowClientes[razonsocial];
        $bloqueClientes .= '</td>';
        $bloqueClientes .= '<td style="text-align:center">';
        $bloqueClientes .= $rowClientes[numero];
        $bloqueClientes .= '</td>';
        $bloqueClientes .= '<td style="text-align:center">';
        $bloqueClientes .= formateaFecha($rowClientes[fecha]);
        $bloqueClientes .= '</td>';
        $bloqueClientes .= '<td style="text-align:center">';
        $bloqueClientes .= number_format($rowClientes[importe], 2);
        $totalImporteClientes += $rowClientes[importe];
        $bloqueClientes .= '</td>';
    }
    $bloqueClientes .= '      <tr><td style="text-align:right" colspan=4><h4>Total Facturas de Clientes Asociadas: '.number_format($totalImporteClientes,2).'</h4></td></tr>';
    $bloqueClientes .= '      </tbody>
            </table>
        </div>';

    $totalFinalIngresos += $totalImporteClientes;

}

// SI NO ESTÁ FACTURADA O LIQUIDADA
// SACAMOS LOS DATOS DE MATRÍCULAS COSTES
$qCostes = "SELECT
    mc.costes_imparticion,
    mc.costes_salariales,
    mc.maximo_bonificable,
    mc.costes_indirectos,
    mc.costes_organizacion,
    mc.importe_a_bonificar,
    e.razonsocial
    FROM mat_costes AS mc
    LEFT JOIN empresas AS e ON mc.id_empresa = e.id
    WHERE mc.id_matricula = ".$id_matricula." AND e.id = ".$id_empresa;

if ( isRoot() ){
//     echo "<br>".$qCostes;
}

$qCostes = mysqli_query($link, $qCostes) or die("error Buscar Costes:" .mysqli_error($link));

$numregistros2 = mysqli_num_rows($qCostes);

if ( isRoot() ){
    // echo "Numregistro: ".$numregistros2;
}

if ( $numregistros2 > 0 ) {

    $hayDatos = 1;

	$totalCosteImparticion = 0;
	$totalCostesSalariales = 0;
	$totalMaximoBonificable = 0;
	$totalCostesIndirectos = 0;
	$totalCostesOrganizacion = 0;
	$totalImporteBonificar = 0;
    $bloqueCoste = '';

    $bloqueCoste .= '<div class="col-md-12">';
    $bloqueCoste .= '<h3>Costes Asociados:</h3>';
    $bloqueCoste .= '<table style="margin-top: 15px;" class="table table-bordered table-striped">
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

    while ($rowCostes = mysqli_fetch_array($qCostes)) {
        $bloqueCoste .= '<tr>';
        $bloqueCoste .= '<td>';
        $bloqueCoste .=($rowCostes[razonsocial]);
        $bloqueCoste .= "</td>";
        $bloqueCoste .= "<td style='text-align:center'>";
        $bloqueCoste .=(number_format($rowCostes[costes_imparticion], 2));
        $totalCosteImparticion += $rowCostes[costes_imparticion];

        $bloqueCoste .= "</td>";
        $bloqueCoste .= "<td style='text-align:center'>";
        $bloqueCoste .=(number_format($rowCostes[costes_salariales], 2));
        $totalCostesSalariales += $rowCostes[costes_salariales];

        $bloqueCoste .= "</td>";
        $bloqueCoste .= "<td style='text-align:center'>";
        $bloqueCoste .=(number_format($rowCostes[maximo_bonificable], 2));
        $totalMaximoBonificable += $rowCostes[maximo_bonificable];

        $bloqueCoste .= "</td>";
        $bloqueCoste .= "<td style='text-align:center'>";
        $bloqueCoste .=(number_format($rowCostes[costes_indirectos], 2));
        $totalCostesIndirectos += $rowCostes[costes_indirectos];

        $bloqueCoste .= "</td>";
        $bloqueCoste .= "<td style='text-align:center'>";
        $bloqueCoste .=(number_format($rowCostes[costes_organizacion], 2));
        $totalCostesOrganizacion += $rowCostes[costes_organizacion];

        $bloqueCoste .= "</td>";
        $bloqueCoste .= "<td style='text-align:center'>";
        $bloqueCoste .=(number_format($rowCostes[importe_a_bonificar], 2));
        $totalImporteBonificar += $rowCostes[importe_a_bonificar];
        $bloqueCoste .= "</td>";
    }
    $bloqueCoste .= "      <tr><td style='text-align:right'></td>";
    $bloqueCoste .= "		<td style='text-align:center'><h4>".number_format($totalCosteImparticion,2)."</h4></td>";
    $bloqueCoste .= "		<td style='text-align:center'><h4>".number_format($totalCostesSalariales,2)."</h4></td>";
    $bloqueCoste .= "		<td style='text-align:center'><h4>".number_format($totalMaximoBonificable,2)."</h4></td>";
    $bloqueCoste .= "		<td style='text-align:center'><h4>".number_format($totalCostesIndirectos,2)."</h4></td>";
    $bloqueCoste .= "		<td style='text-align:center'><h4>".number_format($totalCostesOrganizacion,2)."</h4></td>";
    $bloqueCoste .= "		<td style='text-align:center'><h4>".number_format($totalImporteBonificar,2)."</h4></td>";
    $bloqueCoste .= "		</tr>";
    $bloqueCoste .= '      </tbody>
            </table>
        </div>';

    $totalFinalGastos += $totalCosteImparticion;
    $totalFinalGastos += $totalCostesSalariales;
    $totalFinalGastos += $totalMaximoBonificable;
    $totalFinalGastos += $totalCostesIndirectos;
    $totalFinalGastos += $totalCostesOrganizacion;
    // $totalFinalGastos += $totalImporteBonificar;
}

// DATOS DE COSTES DE RENTABILIDAD
$qRentabilidad = "SELECT
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


if ( isRoot() ){
    // echo "<br>".$q3;
}

$qRentabilidad = mysqli_query($link, $qRentabilidad) or die("error Buscar Costes Rentabilidad:" .mysqli_error($link));

$numregistros3 = mysqli_num_rows($qRentabilidad);

if ( isRoot() ){
    // echo "Numregistro: ".$numregistros2;
}

if ( $numregistros3 > 0 ) {
    
    $hayDatos = 1;

	$totalCosteAula = 0;
	$totalCosteDocente = 0;
	$totalFungiblesDidacticos = 0;
	$totalAdminsitracion = 0;
	$totalOtrosGastos = 0;
	$totalPrecioVenta = 0;
	$totalAlumnosEstimados = 0;
	$totalIngresos = 0;
	$totalGastos = 0;
	$totalMargenBeneficio = 0;

    $bloqueRentabilidad = '';

    $bloqueRentabilidad .= '<div class="col-md-12">';
    $bloqueRentabilidad .= '<h3>Detalle de Rentabilidad Previsto:</h3>';
    $bloqueRentabilidad .= '<table style="margin-top: 15px;" class="table table-bordered table-striped">
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

    while ($rowRentabilidad = mysqli_fetch_array($qRentabilidad)) {
        $bloqueRentabilidad .= '<tr>';
        $bloqueRentabilidad .= '<td style="text-align:center">';
        $bloqueRentabilidad .= ''.number_format($rowRentabilidad[costeaula], 2).'';
        $totalCosteAula += $rowRentabilidad[costeaula];

        $bloqueRentabilidad .= '</td>';
        $bloqueRentabilidad .= '<td style="text-align:center">';
        $bloqueRentabilidad .= ''.number_format($rowRentabilidad[costedocente], 2).'';
        $totalCosteDocente += $rowRentabilidad[costedocente];

        $bloqueRentabilidad .= '</td>';
        $bloqueRentabilidad .= '<td style="text-align:center">';
        $bloqueRentabilidad .= ''.number_format($rowRentabilidad[fungibledidac], 2).'';
        $totalFungiblesDidacticos += $rowRentabilidad[fungibledidac];

        $bloqueRentabilidad .= '</td>';
        $bloqueRentabilidad .= '<td style="text-align:center">';
        $bloqueRentabilidad .= ''.number_format($rowRentabilidad[administracion], 2).'';
        $totalAdminsitracion += $rowRentabilidad[administracion];
        
        $bloqueRentabilidad .= '</td>';
        $bloqueRentabilidad .= '<td style="text-align:center">';
        $bloqueRentabilidad .= ''.number_format($rowRentabilidad[otrosgastos], 2).'';
        $totalOtrosGastos += $rowRentabilidad[otrosgastos];

        $bloqueRentabilidad .= '</td>';
        $bloqueRentabilidad .= '<td style="text-align:center">';
        $bloqueRentabilidad .= ''.number_format($rowRentabilidad[precioventamat], 2).'';
        $totalPrecioVenta += $rowRentabilidad[precioventamat];

        $bloqueRentabilidad .= '</td>';
        $bloqueRentabilidad .= '<td style="text-align:center">';
        $bloqueRentabilidad .= ''.$rowRentabilidad[alumnosestimados].'';
        $totalAlumnosEstimados += $rowRentabilidad[alumnosestimados];

        $bloqueRentabilidad .= '</td>';
        $bloqueRentabilidad .= '<td style="text-align:center">';
        $bloqueRentabilidad .= ''.number_format($rowRentabilidad[totalingresos], 2).'';
        $totalIngresos += $rowRentabilidad[totalingresos];

        $bloqueRentabilidad .= '</td>';
        $bloqueRentabilidad .= '<td style="text-align:center">';
        $bloqueRentabilidad .= ''.number_format($rowRentabilidad[totalcostes], 2).'';
        $totalGastos += $rowRentabilidad[totalcostes];
        $bloqueRentabilidad .= '</td>';
        $bloqueRentabilidad .= '<td style="text-align:center">';
        $bloqueRentabilidad .= ''.number_format($rowRentabilidad[margenbeneficio], 2).'';
        $totalMargenBeneficio += $rowRentabilidad[margenbeneficio];
        $bloqueRentabilidad .= '</td>';
        $bloqueRentabilidad .= '<td style="text-align:center">';
        $bloqueRentabilidad .= ''.number_format($rowRentabilidad[porcentajeventas], 2).'';
        $bloqueRentabilidad .= '</td>';
        $bloqueRentabilidad .= '<td style="text-align:center">';
        $bloqueRentabilidad .= ''.number_format($rowRentabilidad[ventasrequerido], 2).'';
        $bloqueRentabilidad .= '</td>';
        $bloqueRentabilidad .= '<td style="text-align:center">';
        $bloqueRentabilidad .= ''.$rowRentabilidad[nalumnosnecesario].'';
        $bloqueRentabilidad .= '</td>';
    }
    $bloqueRentabilidad .= '      </tbody>
            </table>
        </div>';

    $totalFinalGastos += $totalCosteAula;
    $totalFinalGastos += $totalCosteDocente;
    //$totalFinalGastos += $totalFungiblesDidacticos;
    $totalFinalGastos += $totalAdminsitracion;
    //$totalFinalGastos += $totalOtrosGastos;
    $totalFinalGastos += $totalPrecioVenta;
}

// DATOS DE FUNGIBLES
$qItemsFungibles = "SELECT mig.*, ig.item, round(mig.cantidad * ig.precio, 2) AS importe_item 
    FROM mat_items_gastos AS mig INNER JOIN items_gastos AS ig ON mig.id_item = ig.id
    WHERE ig.tipo = 0 AND mig.id_mat = ".$id_matricula;

if ( isRoot() ){
    // echo "<br>".$q4;
}

$qItemsFungibles = mysqli_query($link, $qItemsFungibles) or die("error Buscar Items Fungible:" .mysqli_error($link));

$numregistros4 = mysqli_num_rows($qItemsFungibles);
$totalfungibles = 0;
$bloqueFungibles = '';

if ( isRoot() ){
    // echo "Numregistro: ".$numregistros2;
}

if ( $numregistros4 > 0 ) {

    $hayDatos = 1;

    $bloqueFungibles .= '<div class="col-md-7">';
    $bloqueFungibles .= '<h3>Detalle de Fungibles:</h3>';
    $bloqueFungibles .= '<table style="margin-top: 15px;" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="text-align:center">Item</th>
                        <th style="text-align:center">Cantidad</th>
                        <th style="text-align:center">Importe</th>
                    </tr>
                </thead>
                <tbody>';

    while ($rowItemsFungibles = mysqli_fetch_array($qItemsFungibles)) {
        $bloqueFungibles .= '<tr>';
        $bloqueFungibles .= '<td style="text-align:left">';
        $bloqueFungibles .= $rowItemsFungibles[item];
        $bloqueFungibles .= '</td>';
        $bloqueFungibles .= '<td style="text-align:center">';
        $bloqueFungibles .= number_format($rowItemsFungibles[cantidad], 0);
        $bloqueFungibles .= '</td>';
        $bloqueFungibles .= '<td style="text-align:center">';
        $bloqueFungibles .= number_format($rowItemsFungibles[importe_item], 2);
        $bloqueFungibles .= '</td>';
        $bloqueFungibles .= '</tr>';
        $totalfungibles += $rowItemsFungibles[importe_item];
    }
    $bloqueFungibles .= '      <tr><td style="text-align:right" colspan=3><h4>Total Fungibles: '.$totalfungibles.'</h4></td></tr>';
    $bloqueFungibles .= '      </tbody>
            </table>
        </div>';

    $totalFinalGastos += $totalfungibles;
}

// DATOS DE OTROS GASTOS
$qItemsOtros = "SELECT mig.*, ig.item, round(mig.cantidad * ig.precio, 2) AS importe_item 
    FROM mat_items_gastos AS mig INNER JOIN items_gastos AS ig ON mig.id_item = ig.id
    WHERE ig.tipo = 1 AND mig.id_mat = ".$id_matricula;


if ( isRoot() ){
    // echo "<br>".$q5;
}

$qItemsOtros = mysqli_query($link, $qItemsOtros) or die("error Buscar Items Otros Gastos:" .mysqli_error($link));

$numregistros5 = mysqli_num_rows($qItemsOtros);
$totalotrosgastos = 0;
$bloqueOtrosGastos = '';

if ( isRoot() ){
    // echo "Numregistro: ".$numregistros2;
}

if ( $numregistros5 > 0 ) {

    $hayDatos = 1;

    $bloqueOtrosGastos .= '<div class="col-md-7">';
    $bloqueOtrosGastos .= '<h3>Detalle de Otros Gastos:</h3>';
    $bloqueOtrosGastos .= '<table style="margin-top: 15px;" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="text-align:center">Item</th>
                        <th style="text-align:center">Cantidad</th>
                        <th style="text-align:center">Importe</th>
                    </tr>
                </thead>
                <tbody>';

    while ($rowItemsOtros = mysqli_fetch_array($qItemsOtros)) {
        $bloqueOtrosGastos .= '<tr>';
        $bloqueOtrosGastos .= '<td style="text-align:left">';
        $bloqueOtrosGastos .=  $rowItemsOtros[item];
        $bloqueOtrosGastos .= '</td>';
        $bloqueOtrosGastos .= '<td style="text-align:center">';
        $bloqueOtrosGastos .= number_format($rowItemsOtros[cantidad], 0);
        $bloqueOtrosGastos .= '</td>';
        $bloqueOtrosGastos .= '<td style="text-align:center">';
        $bloqueOtrosGastos .= number_format($rowItemsOtros[importe_item], 2);
        $bloqueOtrosGastos .= '</td>';
        $bloqueOtrosGastos .= '</tr>';
        $totalotrosgastos += $rowItemsOtros[importe_item];
    }
    $bloqueOtrosGastos .= '      <tr><td style="text-align:right" colspan=3><h4>Total Otros Gastos: '.$totalotrosgastos.'</h4></td></tr>';
    $bloqueOtrosGastos .= '      </tbody>
            </table>
        </div>';

    $totalFinalGastos += $totalotrosgastos;

}

// RESUMEN TOTAL 
$bloqueResumenTotal = '';
$bloqueResumenTotal .= '<div class="clearfix"></div>';
$bloqueResumenTotal .= '<div class="col-md-12">';
$bloqueResumenTotal .= '<h3>Resumen:</h3>';
$bloqueResumenTotal .= '<table style="margin-top: 15px;" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th style="text-align:center">Gastos Previstos</th>
                    <th style="text-align:center">Ingresos Previstos</th>
                    <th style="text-align:center">Ganancia Prevista</th>
                    <th style="text-align:center">% Ganancia Prevista</th>
                    <th style="text-align:center">Gastos Reales</th>
                    <th style="text-align:center">Ingresos Reales</th>
                    <th style="text-align:center">Ganancia Real</th>
                    <th style="text-align:center">% Ganancia Real</th>
                </tr>
            </thead>
            <tbody>';

$bloqueResumenTotal .= '          <tr>';
$bloqueResumenTotal .= '              <td style="text-align:center">';
$bloqueResumenTotal .=(number_format($totalGastos, 2));
$bloqueResumenTotal .= '              </td>';
$bloqueResumenTotal .= '              <td style="text-align:center">';
$bloqueResumenTotal .=(number_format($totalIngresos, 2));
$bloqueResumenTotal .= '              </td>';
$bloqueResumenTotal .= '              <td style="text-align:center">';
$bloqueResumenTotal .=(number_format($totalMargenBeneficio, 2));
$bloqueResumenTotal .= '              </td>';
$bloqueResumenTotal .= '              <td style="text-align:center">';
//echo(number_format($totalFinalGastos, 2));
$bloqueResumenTotal .= '              </td>';
$bloqueResumenTotal .= '              <td style="text-align:center">';
$bloqueResumenTotal .=(number_format($totalFinalGastos, 2));
$bloqueResumenTotal .= '              </td>';
$bloqueResumenTotal .= '              <td style="text-align:center">';
$bloqueResumenTotal .=(number_format($totalFinalIngresos, 2));
$bloqueResumenTotal .= '              </td>';
$bloqueResumenTotal .= '              <td style="text-align:center">';
$bloqueResumenTotal .=(number_format($totalFinalGastos, 2) - number_format($totalFinalIngresos, 2));
$bloqueResumenTotal .= '              </td>';
$bloqueResumenTotal .= '              <td style="text-align:center">';
//echo(number_format($totalFinalGastos, 2) - number_format($totalFinalIngresos, 2));
$bloqueResumenTotal .= '              </td>';
$bloqueResumenTotal .= '          </tr>';
$bloqueResumenTotal .= '      </tbody>
        </table>
    </div>';

//IMPRESIÓN DE LOS BLOQUES QUE CORRESPONDAN SEGÚN EL ESTADO DE LA MATRÍCULA
if ($hayDatos == 1) {
    echo $bloqueCabecera;

    if ( ( $row[estado] == "Facturada" ) || ( $row[estado] == "Liquidada" ) ){

        echo $bloqueAcreedores;
        echo $bloqueClientes;

    } else {

        echo $bloqueCoste;
        echo $bloqueRentabilidad;

    }

    echo $bloqueFungibles;
    echo $bloqueOtrosGastos;
    echo $bloqueResumenTotal;    
} else {
    echo '<div class="col-md-12" style="text-align:center"><h3>No hay datos para la <strong>MATRÍCULA</strong> seleccionada.</h3></div>';
}

echo '		</div>';
echo '    </div>';
echo '</form>';
?>
<!-- <div class="col-md-12">
		
	<input name="tabla" type="hidden" id="tabla" value="acciones" />
	<input name="id" type="hidden" id="id" value="" />  si hay value es que es UPDATE !

	<p style="text-align: center; margin-top: 30px;">
		<a id="abrebusqueda" href="#" data-toggle=modal class="btn btn-lg btn-primary">Mostrar Acciones</a><br>
	</p>

</div> -->
<?



include_once './funciones.php';

$id = $_POST['id'];



// print_r($_POST);

// session_start();

$gestion = devuelveAnio();



if ( $_POST['devolvermatfac'] == '1' )

    devolverDatosMatriculaFac($id, $resulhtml, $link);

else if ($_POST['facturaboni'] == '1') {

    generarFactura($id, $link);

} else if ($_POST['compruebafactura'] == '1') {

    compruebaFactura($_POST[emp], $_POST[mat], $_POST[tipo], $_POST[idfac], $link);

} else if ($_POST['detallefactura'] == '1') {

    detalleFactura($_POST['id_fac'], $_POST[tabla], $link);

} else if ($_POST['actualizaestado'] == '1') {

    actualizaEstado($_POST[idfac], $_POST[estado], $_POST[tabla], $_POST[idmat], $link);

} else if ($_POST['actualizadetallefactura'] == '1') {

    actualizaDetalleFactura($_POST[idfac], $_POST[estado], $_POST[pendiente], $_POST[cobrado], $_POST[total_factura], $_POST[tabla], $link);

} else if ($_POST['actualizarvencimiento'] == '1' || $_POST['actualizarvencimientofaca'] == '1') {

    actualizarVencimiento($_POST[idfac], $_POST[vencimiento], $_POST[fecha], $_POST[idemp], $_POST[tabla], $_POST[observacionesfra], $link);

} else if ($_POST['rectificafactura'] == '1') {

    rectificaFactura($_POST['id_fac'], $_POST[tabla], $link);

} else if ($_POST['facturartodo'] == '1') {

    facturarTodo($_POST['idmat'], $link);

} else if ($_POST['guardarconciliar'] == '1') {

    guardarConciliar($_POST['idfac'], $_POST['fecha'], $_POST['cobrado'], $_POST['total'], $_POST['pendiente'], $_POST['tabla'], $_POST['observaciones'], $_POST['tipo'], $link);

} else if ($_POST['guardarconciliar'] == '2') {

    guardarConciliarAcre($_POST['idfac'], $_POST['fecha'], $_POST['pagado'], $_POST['total'], $_POST['pendiente'], $_POST['observaciones'], $link);

} else if ($_POST['guardardevolucion'] == '1') {

    //echo "Llega llamada función";

    guardarDevolucion($_POST['idfac'], $_POST['fecha'], $_POST['devolucion'], $_POST['gastodevolucion'], $_POST['cobrado'], $_POST['total'], $_POST['pendiente'], $_POST['tabla'], $_POST['observaciones'], $_POST['tipo'], $_POST['email_facturas'], $_POST['numerofra'], $link);

} else if ($_POST['actualizardevolucion'] == '1') {

    actualizarDevolucion($_POST['idfac'], $_POST['iddevol'], $_POST['fecha'], $_POST['devolucion'], $_POST['gastodevolucion'], $_POST['cobrado'], $_POST['total'], $_POST['pendiente'], $_POST['tabla'], $_POST['observaciones'], $_POST['tipo'], $link);

} else if ($_POST['actualizarconciliar'] == '1') {

    actualizarConciliar($_POST['idfac'], $_POST['idcon'], $_POST['fecha'], $_POST['cobrado'], $_POST['total'], $_POST['pendiente'], $_POST['tabla'], $_POST['observaciones'], $_POST['tipo'], $link);

} else if ($_POST['actualizarconciliar'] == '2') {

    actualizarConciliarAcre($_POST['idfac'], $_POST['idcon'], $_POST['fecha'], $_POST['pagado'],$_POST['total'], $_POST['pendiente'], $_POST['observaciones'], $link);

} else if ($_POST['anadirconciliar'] == '1') {

    anadirConciliar($_POST['idfac'], $link);

} else if ($_POST['anadirconciliar'] == '2') {

    anadirConciliarAcre($_POST['idfac'], $link);

} else if ($_POST['anadirdevolucion'] == '1') {

    anadirDevolucion($_POST['idfac'], $link);

} else if ($_POST['anadirapuntefac'] == '1') {

    anadirApunteFac($link);

} else if ($_POST['anadirnomina'] == '1') {

    anadirNomina($link);

} else if ($_POST['guardarnomina'] == '1' || $_POST['guardaracreedorfac'] == '1') {

    guardarAcreedorFac2($_POST['acreedor'], $_POST['numero'], $_POST['fecha'], $_POST['importe'], $_POST['bruto'], $_POST['retencionpor'], $_POST['retencion'], $_POST['impuestospor'], $_POST['impuestos'], $_POST['vencimiento'], $_POST['observaciones'], $_POST['id_docente'], $_POST['tipo'], $_POST['fecha_inicio'], $_POST['fecha_fin'], $link);

} /*else if ($_POST['guardaracreedorfac'] == '1') {

    guardarAcreedorFac($_POST['acreedor'], $_POST['numero'], $_POST['fecha'], $_POST['importe'], $_POST['bruto'], $_POST['retencionpor'], $_POST['retencion'], $_POST['impuestospor'], $_POST['impuestos'], $_POST['vencimiento'], $_POST['observaciones'], $link);

}*/ else if ($_POST['detallefacturaacre'] == '1' || $_POST['detallenomina'] == '1') {

    detalleFacturaAcrePrueba($_POST['id_fac'], $link, $_POST['tipo']);

} else if ($_POST['actualizardetalleacre'] == '1') {

    actualizarDetalleAcre($_POST, $link);

} else if ($_POST['devolvermatfacikea'] == '1') {

    devolverDatosMatriculaFacIKEA($_POST['id'], $link);

} else if ($_POST['borrarfacturaacre'] == '1') {

    borrarFacturaAcre($_POST[id], $link);

} else if ($_POST['anadirmatacrefra'] == '1') {

    anadirMatAcreFra($_POST['idfra'], $link, $_POST['existe']);

} else if ($_POST['guardarmatacrefra'] == '1') {

    guardarMatAcreFra($_POST['id_factura'], $_POST['id_matricula'], $_POST['importe'], $_POST['porcentaje'], $_POST['tipogasto'], $_POST['gastoformacion'], $_POST['id_comercial'], $_POST['id_facre'], $link);

} else if ($_POST['nuevoitemrentabilidad'] == '1') {

    anadirItemRentabilidad($_POST['tipoGasto'], $link);

} else if ($_POST['guardaritemrentabilidad'] == '1' ) {

    guardarItemRentabilidad($_POST['tipoGasto'], $_POST['itemdescripcion'], $_POST['itemprecio'], $link);

} else if ($_POST['detalleSeguimientoFacturacion'] == '1' ) {

    mostrarDetalleSeguimientoFac($_POST['id_matricula'], $_POST['id_empresa'], $link);

} else if($_POST['liquidar'] == '1'){

    liquidar($_POST['matricula'], $link);

}
// } else if ($_POST['nuevoitemdatosfungibles'] == '1') {

//     anadirItemRentabilidad(0, $link);

// } else if ($_POST['guardaritemdatosfungibles'] == '1' ) {

//     guardarItemDatosFungibles($_POST['itemdescripcion'], $_POST['itemprecio'], $link);

// }





function borrarFacturaAcre($id, $link) {



    $q= 'DELETE FROM facturacion_acreedores WHERE id = "'.$id.'"';

    echo $q;

    mysqli_query($link, $q) or die("error borrando " . mysqli_error($link));



}



// function comprobarFactura($numero, $importe, $fecha, $link) {



//     $q = 'SELECT numero

//     FROM facturacion_acreedores

//     WHERE numero = "'.$numero.'"

//     AND importe = "'.$importe.'"

//     AND fecha = "'.$fecha.'"';

//     $q = mysqli_query($link, $q);



//     if (mysqli_num_rows($q) > 0)

//         echo "esta";

//     else

//         echo "no";



// }





function actualizarVencimiento($idfac, $vencimiento, $fecha, $idemp, $tabla, $observaciones, $link) {





    $q1 = 'UPDATE empresas SET vencimiento = '.$vencimiento.' WHERE id = '.$idemp;

    $q1 = mysqli_query($link, $q1);



    $fecha = date('Y-m-d', strtotime(str_replace('/','-', $fecha)));

    $fecha_vencimiento = date('Y-m-d', strtotime($fecha. ' + '.$vencimiento.' days'));



    $observaciones = ', observacionesfra = "'.addslashes($observaciones).'" ';



    $q1 = 'UPDATE '.$tabla.' SET fecha_vencimiento = "'.$fecha_vencimiento.'", vencimiento = "'.$vencimiento.'" '.$observaciones.' WHERE id = '.$idfac;

    // echo $q1;

    $q1 = mysqli_query($link, $q1) or die("error update ".mysqli_error($link));





    echo $fecha_vencimiento;



}



function guardarDevolucion($idfac, $fecha, $devuelto, $gastodevolucion, $cobrado, $total, $pendiente, $tabla, $observaciones, $tipo, $email, $numerofra, $link) {



    $q = 'INSERT INTO conciliaciones_devolu (fecha, devolucion, gasto_devolucion, factura, observaciones, tipo)

    VALUES("'.$fecha.'", "'.round($devuelto,2).'", "'.round($gastodevolucion,2).'", "'.$idfac.'", "'.addslashes($observaciones).'", "'.$tipo.'")';

    $resul = mysqli_query($link, $q) or die('error');

    // echo $q.' - ';



    // CALCULO EL NUEVO COBRADO, RESTANDO LO DEVUELTO

    $cobrado = round($cobrado,2);

    $nuevocobrado = $cobrado-$devuelto;



    $total = round($total,2);

    // $pendiente = $total-$cobrado;

    // CALCULO EL NUEVO PENDIENTE, SUMANDO LOS GASTOS DE DEVOLUCION

    $nuevopendiente = $gastodevolucion+$devuelto+$pendiente;



    if ( $nuevopendiente == 0 )

        $estado = ' , estado = "Pagada" ';

    else $estado = ' , estado = "Pendiente" ';



    // echo $estado;

    $q = 'UPDATE '.$tabla.' SET importe_a_abonar = "'.$nuevopendiente.'", cobrado = "'.$nuevocobrado.'"'.$estado.'WHERE id = '.$idfac;

    $q = mysqli_query($link, $q);



    $resultado[0] = $nuevocobrado;

    $resultado[1] = $nuevopendiente;

    // print_r($resul);

    $baseurl = $_SERVER['DOCUMENT_ROOT'].'/app';
    require_once($baseurl.'/plugins/PHPMailer/PHPMailerAutoload.php');

    $q = 'SELECT *
    FROM '.$tabla.'
    WHERE id = "'.$idfac.'"';
    $q = mysqli_query($link, $q) or die("error select : " .mysqli_error($link));

    $row = mysqli_fetch_assoc($q);


    $mail = new PHPMailer();
    $mail->From = 'soporte@eduka-te.com';
    $mail->FromName = 'Gestión';
    // $mail->addBCC('aperojo@eduka-te.com');
    $mail->addAddress('margarita.mitkova@eduka-te.com');
    $mail->addAddress('shirley.gonzalez@eduka-te.com');
    $mail->addAddress('ana.alves@eduka-te.com');
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Subject = "[EDUKA-TE] Aviso de devolución en factura";
    $mail->Body = "Estimado cliente,<br><br>
    Nos ponemos en contacto con Ud. en referencia a la <b>Factura Nº ".$row['numero']."</b> emitida el pasado
    día <b>".formateaFecha($row['fecha'])."</b>, por importe de <b>".$row['total_factura']." euros</b>.<br><br>
    El motivo de la comunicación es que hemos recibido la devolución del pago de dicha factura, generando unos gastos de devolución de <b>".$gastodevolucion." euros</b>, por lo que necesitamos que procedan a regularizar la situación lo antes posible.<br>";

    if(!$mail->send()) {
        $resultado['resul'] = 'Error. Email no enviado: ' . $mail->ErrorInfo;
    } else {
        $resultado['resul'] = 'Email enviado con éxito.';
    }

    echo json_encode($resultado);




}



function actualizarDevolucion($idfac, $iddevol, $fecha, $devuelto, $gastodevolucion, $cobrado, $total, $pendiente, $tabla, $observaciones, $tipo, $link) {



    // echo $q.' - ';



    $q = 'SELECT devolucion, gasto_devolucion

    FROM conciliaciones_devolu

    WHERE id = "'.$iddevol.'"';

    // echo $q;

    $q = mysqli_query($link, $q);

    $row = mysqli_fetch_array($q);



    $devueltoant = round($row[devolucion],2);

    $gastoant = round($row[gasto_devolucion],2);

    // echo $devueltoant.' - '.$gastoant;



    //CALCULO EL ANTERIOR COBRADO, SUMANDO LO DEVUELTO

    $cobrado = round($cobrado,2);

    $anteriorcobrado = $cobrado+$devueltoant;

    // echo $anteriorcobrado.' - ';

    $nuevocobrado = $anteriorcobrado-$devuelto;



    $total = round($total,2);

    $anteriorpendiente = round($pendiente,2)-($devueltoant+$gastoant);

    // echo $anteriorpendiente.' - ';

    // $pendiente = $total-$cobrado;

    // CALCULO EL NUEVO PENDIENTE, SUMANDO LOS GASTOS DE DEVOLUCION

    $nuevopendiente = $gastodevolucion+$devuelto+$anteriorpendiente;



    $q = 'UPDATE conciliaciones_devolu SET fecha = "'.$fecha.'", devolucion = "'.round($devuelto,2).'", gasto_devolucion = "'.round($gastodevolucion,2).'", observaciones = "'.addslashes($observaciones).'" WHERE id = "'.$iddevol.'" AND tipo = "'.$tipo.'"';

    // echo $q;

    $resul = mysqli_query($link, $q) or die('error');





    if ( $nuevopendiente == 0 )

        $estado = ' , estado = "Pagada" ';

    else $estado = ' , estado = "Pendiente" ';



    // echo $estado;

    $q = 'UPDATE '.$tabla.' SET importe_a_abonar = "'.$nuevopendiente.'", cobrado = "'.$nuevocobrado.'"'.$estado.'WHERE id = '.$idfac;

    $q = mysqli_query($link, $q);



    // array_push($resul, $nuevocobrado);

    // array_push($resul, $nuevopendiente);

    $resultado[0] = $nuevocobrado;

    $resultado[1] = $nuevopendiente;

    // print_r($resul);

    echo json_encode($resultado);





}



function anadirDevolucion($idfac, $link) {



    $random = rand();



    echo '

    <div style="overflow:auto; margin-bottom: 10px;">

        <div class="col-md-2">

            <div class="form-group">

                <label class="control-label" for="fechadevolucion">Fecha:</label>

                <input type="date" id="fechadevolucion'.$random.'" value="'.date('Y-m-d').'" name="fechadevolucion" class="form-control"/>

            </div>

        </div>

        <div class="col-md-2">

            <div class="form-group">

                <label class="control-label" for="devolucionconcilio">Devolución:</label>

                <input value="" type="text" id="devolucionconcilio'.$random.'" name="devolucionconcilio" class="form-control"/>

            </div>

        </div>

        <div class="col-md-2">

            <div class="form-group">

                <label class="control-label" for="gastodevolucion">Gasto Devolución:</label>

                <input value="" type="text" id="gastodevolucion'.$random.'" name="gastodevolucion" class="form-control"/>

            </div>

        </div>

        <div class="col-md-4">

            <div class="form-group">

                <label class="control-label" for="observaciones">Observaciones:</label>

                <textarea name="observaciones" id="observaciones'.$random.'" class="form-control" rows="1"></textarea>

            </div>

        </div>

        <div class="col-md-2" style="margin-top: 25px;">

            <a id="guardardevolucion" id_fac="'.$idfac.'" id_concilio="" nuevo="'.$random.'" style="float:left;width: 100%; margin-top: 0px;" class="btn btn-success"> Guardar</a>

        </div>

    </div>

    <div style="" class="clearfix"></div>';



}


//FUNCION HECHA POR OCTAVIO 17/05/2017

//ESTA NO VA
function detalleNomina($idDoc, $link){

    $consulta = "SELECT CONCAT(d.nombre, ' ', d.apellido, ' ', d.apellido2) AS nombre, f.mes, f.anio
    FROM facturacion_acreedores f, docentes d
    WHERE d.id = f.id_docente AND f.id = ".$idDoc;

    $consulta = mysqli_query($link, $consulta);

    while ($fila = mysqli_fetch_assoc($consulta)) {

        echo '
        <div class="contenedorNomina">
            <div style="margin: 15px 0 15px 0; overflow: auto;">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Nombre</label>
                        <input type="text" id="nombreDocente" value="'.$fila['nombre'].'" class="form-control" disabled>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label">Mes</label>
                        <input type="text" id="mesNomina" value="'.$fila['mes'].'" class="form-control" disabled>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label">Año</label>
                        <input type="text" id="anioNomina" value="'.$fila['anio'].'" class="form-control" disabled>
                    </div>
                </div>
            </div>
        </div>';

    }

}
//

function detalleFacturaAcrePrueba($idfac, $link, $tipo) {
    // session_start();

    $gestion = devuelveAnio();

    if ($tipo == 'factura') {

        $q = 'SELECT a.*, f.*, f.id as idfac
        FROM acreedores a, facturacion_acreedores f
        WHERE f.acreedor = a.id
        AND f.id = '.$idfac;

        $subirpdf = 'subirpdfapuntefac';
        $mostrarpdf = 'mostrarpdfapuntefac';
        $rutapdf = 'apuntefac';

    }else{

        $q = "SELECT CONCAT(d.nombre, ' ', d.apellido, ' ', d.apellido2) AS nombre, d.id AS iddoc, f.*, f.id AS idfac
        FROM facturacion_acreedores f
        INNER JOIN docentes d ON d.id = f.id_docente
        WHERE f.id = ".$idfac;

        $subirpdf = 'subirpdfdocentenomina';
        $mostrarpdf = 'mostrarpdfdocentenomina';
        $rutapdf = 'apuntenomina';

    }

    if( isRoot() )
     echo $q;

    $q = mysqli_query($link, $q) or die("error abriendo detalle ". mysqli_error($link));

    while ( $row = mysqli_fetch_array($q) ) {

        $numero = str_replace('/', '-', $row['numero']);
        $acreedorpdf = 'facturacion'.$gestion.'/acreedores/'.$numero.'-'.quitaTildesConComas($row['razonsocial']).'.pdf';
        $pendiente = $row[importe_a_abonar];

        echo '

        <input type="hidden" id="id" name="id" value="'.$row[idfac].'">
        <input type="hidden" id="docente" name="docente" value="'.$row[iddoc].'">
        <input type="hidden" id="id_mat" name="id_matricula" value="'.$row[mat].'" >
        <div class="contenidofra">
            <div style="margin: 15px 0 15px 0">';
            if ($tipo == 'factura') {
                echo'<div class="col-md-2">
                    <div class="form-group">
                        <label class="control-label" for="numero">Nº Factura:</label>
                        <input type="text" id="numero" value="'.$row[numero].'" name="numero" class="form-control" />
                    </div>
                </div>';
            }
            echo '<div class="col-md-2">
                    <div class="form-group">
                        <label class="control-label" for="fecha">Fecha:</label>
                        <input type="date" id="fecha" value="'.$row[fecha].'" name="fecha" class="form-control" />
                    </div>
                </div>';
                if ($tipo == 'factura') {
                    $vencimiento = 2;
                    $importe = 3;
                    $pagado = 3;
                    $estado = 2;
                    $pendiente = 3;
                    $extraEstado = 'pull-right';

                    echo '
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label" for="acreedor">Acreedor:</label>
                            <input type="text" id="acreedor" value="'.$row[razonsocial].'" name="acreedor" class="form-control" disabled/>
                        </div>
                    </div>';
                }
                if($tipo == 'nomina'){
                    $vencimiento = 2;
                    $importe = 2;
                    $pagado = 2;
                    $estado = 2;
                    $pendiente = 2;

                    echo '
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label" for="docente">Docente:</label>
                            <input type="text" id="docente" value="'.$row[nombre].'" name="docente" class="form-control" disabled/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label" for="fechainicio">Fecha Inicio:</label>
                            <input type="text" id="fechainicio" value="'.formateaFecha($row[fecha_inicio]).'" fecha="'.$row[fecha_inicio].'" name="fechainicio" class="form-control" disabled/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label" for="fechafin">Fecha Fin:</label>
                            <input type="text" id="fechafin" value="'.formateaFecha($row[fecha_fin]).'" fecha="'.$row[fecha_fin].'" name="fechafin" class="form-control" disabled/>
                        </div>
                    </div>

                    <div class="clearfix"></div>';
                    }
                echo'
                <div style="margin: 15px 0 15px 0">
                    <div class="col-md-'.$vencimiento.'">
                        <div class="form-group">
                            <label class="control-label" for="vencimiento">Vencimiento:</label>
                            <input type="text" id="vencimiento" value="'.$row[vencimiento].'" name="vencimiento" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-'.$estado.' '.$extraEstado.'">
                        <div class="form-group">
                            <label class="control-label" for="estado">Estado Factura:</label>
                            <select id="estado" name="estado" class="form-control">
                                <option value="Pendiente"'; if($row[estado] == "Pendiente") echo "selected"; echo '>Pendiente de Pago</option>
                                <option value="Pagada"'; if ($row[estado] == "Pagada") echo "selected"; echo '>Pagada</option>
                                <option value="Anulada"'; if ($row[estado] == "Anulada") echo "selected"; echo '>Anulada</option>
                                <option value="Rectificada"'; if ($row[estado] == "Rectificada") echo "selected"; echo '>Rectificada</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>';

            if ($tipo == 'factura') {
                echo '<div class="clearfix"></div>';
            }

            echo '<div style="margin: 15px 0 15px 0">
                <div class="col-md-'.$importe.'">
                    <div class="form-group">
                        <label class="control-label" for="importe">Importe Neto:</label>
                        <input type="text" id="importe" value="'.$row[importe].'" name="importe" class="form-control" />
                    </div>
                </div>
                <div class="col-md-'.$importe.'">
                    <div class="form-group">
                        <label class="control-label" for="bruto">Importe Bruto:</label>
                        <input type="text" id="bruto" value="'.$row[bruto].'" name="bruto" class="form-control" />
                    </div>
                </div>
                <div class="col-md-'.$pagado.'">
                    <div class="form-group">
                        <label class="control-label" for="pagado">Pagado:</label>
                        <input type="text" id="pagado" value="'.$row[pagado].'" name="pagado" class="form-control" />
                    </div>
                </div>
                <div class="col-md-'.$pendiente.'">
                    <div class="form-group">
                        <label class="control-label" for="pendiente">Pendiente:</label>
                        <input type="text" id="pendiente" value="'.$row[pendiente].'" name="pendiente" class="form-control" />
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

            <div style="margin: 15px 0 15px 0">
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="control-label" for="retencionpor">Retención (%):</label>
                        <input type="text" id="retencionpor" value="'.$row[retencionpor].'% " name="retencionpor" class="form-control" />
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="control-label" for="retencion">Retención:</label>
                        <input type="text" id="retencion" value="'.$row[retencion].'" name="retencion" class="form-control" />
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="control-label" for="impuestospor">Impuestos (%):</label>
                        <input type="text" id="impuestospor" value="'.$row[impuestospor].'% " name="impuestospor" class="form-control" />
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="control-label" for="impuestos">Impuestos:</label>
                        <input type="text" id="impuestos" value="'.$row[impuestos].'" name="impuestos" class="form-control" />
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="control-label" for="fecha_vencimiento">Fecha Vencimiento:</label>
                        <input type="date" id="fecha_vencimiento" value="'.$row[fecha_vencimiento].'" name="fecha_vencimiento" class="form-control" />
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="col-md-12" style="margin-top: 15px;">
                <div class="form-group">
                    <label class="control-label" for="observaciones">Observaciones:</label>
                    <textarea name="observaciones" id="observaciones" class="form-control" rows="2">'.$row[observaciones].'</textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>';

    if ( $_SESSION['user'] != 'manolo' ) {
        echo '<div class="col-md-2" style="margin-top: 10px;">
        <a id="actualizardetalleacre" id_fac="'.$idfac.'" style="float:left;width: 100%; margin-top: 0px;" class="btn btn-success btn-sm">Actualizar</a>
        </div>
        <div class="col-md-2" style="margin-top: 10px;">
        <a id="anadirmatacrefra" id_fac="'.$idfac.'" id_fra="'.$idfac.'" existe=1 style="float:left;width: 100%; margin-top: 0px;" class="btn btn-success btn-sm">Añadir gasto</a>
    </div>

    <div class="clearfix"></div>

    <div style="margin-top:10px;margin-left: 15px;" class="col-md-12">
        <form id="formapuntefac" action="" method="post" enctype="multipart/form-data">
            <label> PDF Factura: </label><br>
            <input style="float:left" type="file" name="'.$rutapdf.'" id="'.$rutapdf.'" class="btn btn-default"/>
            <a id="'.$subirpdf.'" class="boton btn btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a>
            <a id="'.$mostrarpdf.'" style="" class="boton btn btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a>
        </form>
    </div>

    <div class="clearfix"></div>';

    }

    echo '<div class="clearfix"></div>';

    if ( $_SESSION['user'] != 'manolo' ) {

        echo anadirMatAcreFra($idfac, $link);
        echo'
        <div class="col-md-2" style="margin-top: 35px;">
            <a id="anadirconciliaracre" id_fac="'.$idfac.'" style="float:left;width: 100%; margin-top: 0px;" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Conciliar</a>
        </div>';
    }

    echo '
    <div class="col-md-2 pull-right" style="margin-top: 35px;">
        <a id="verfactura" target="_blank" href="'.$baseurl.$acreedorpdf.'" style="float:left;width: 100%; margin-top: 0px;" class="btn btn-warning"><span class="glyphicon glyphicon-list-alt"></span> Ver Factura</a>
    </div>

    <div style="" class="clearfix"></div>

    <div class="cuadroconciliar">
        <hr>
        <span id="marca_concilio"></span>';

        $q2 = 'SELECT c.*
        FROM conciliaciones_acre c
        WHERE factura = '.$idfac.'
        ORDER BY fecha DESC';
         // echo $q2;

        $q2 = mysqli_query($link, $q2);

        $sumacobrado = 0;

        while ( $r = mysqli_fetch_array($q2) ) {
            // $sumacobrado += $r[cobrado];
            echo '
            <div style="overflow:auto; margin-bottom: 10px;">
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="control-label" for="fechaconcilio">Fecha:</label>
                        <input type="date" id="fechaconcilio'.$r[id].'" value="'.$r[fecha].'" name="fechaconcilio" class="form-control"/>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="control-label" for="pagadoconcilio">Pagado:</label>
                        <input value="'.$r[pagado].'" type="text" id="pagadoconcilio'.$r[id].'" class="form-control"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label" for="observaciones">Observaciones:</label>
                        <textarea name="observaciones" id="observaciones'.$r[id].'" class="form-control" rows="1">'.$r[observaciones].'</textarea>
                    </div>
                </div>';

                if ( $_SESSION['user'] != 'manolo' ) {

                    echo '<div class="col-md-2" style="margin-top: 25px;">

                    <a id="actualizarconciliaracre" id_fac="'.$idfac.'" id_concilio="'.$r[id].'" style="float:left;width: 100%; margin-top: 0px;" class="btn btn-success"> Guardar</a>

                    </div>';

                }
                echo'</div>
                <div style="" class="clearfix"></div>';
        }
        echo '</div>
        <div style="" class="clearfix"></div>';

    }

}

//TERMINA FUNCION



function detalleFacturaAcre($idfac, $link) {



    // session_start();

    $gestion = devuelveAnio();

    $q = 'SELECT a.*, f.*, f.id as idfac

    FROM acreedores a, facturacion_acreedores f

    WHERE f.acreedor = a.id

    AND f.id = '.$idfac;


    if ( isRoot() )
    echo $q;

    $q = mysqli_query($link, $q) or die("error abriendo detalle ". mysqli_error($link));



    while ( $row = mysqli_fetch_array($q) ) {



        $numero = str_replace('/', '-', $row['numero']);

        $acreedorpdf = 'facturacion'.$gestion.'/acreedores/'.$numero.'-'.quitaTildesConComas($row['razonsocial']).'.pdf';

        $pendiente = $row[importe_a_abonar];



        echo '

        <input type="hidden" id="id" name="id" value="'.$row[idfac].'">

        <input type="hidden" id="id_mat" name="id_matricula" value="'.$row[mat].'" >

        <div class="contenidofra">

            <div style="margin: 15px 0 15px 0">

                <div class="col-md-2">

                    <div class="form-group">

                        <label class="control-label" for="numero">Nº Factura:</label>

                        <input type="text" id="numero" value="'.$row[numero].'" name="numero" class="form-control" />

                    </div>

                </div>

                <div class="col-md-2">

                    <div class="form-group">

                        <label class="control-label" for="fecha">Fecha:</label>

                        <input type="date" id="fecha" value="'.$row[fecha].'" name="fecha" class="form-control" />

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="form-group">

                        <label class="control-label" for="acreedor">Acreedor:</label>

                        <input type="text" id="acreedor" value="'.$row[razonsocial].'" name="acreedor" class="form-control" disabled/>

                    </div>

                </div>

                <div class="col-md-2">

                    <div class="form-group">

                        <label class="control-label" for="vencimiento">Vencimiento:</label>

                        <input type="text" id="vencimiento" value="'.$row[vencimiento].'" name="vencimiento" class="form-control" />

                    </div>

                </div>

                <div class="col-md-2 pull-right">

                    <div class="form-group">

                        <label class="control-label" for="estado">Estado Factura:</label>

                        <select id="estado" name="estado" class="form-control">

                            <option value="Pendiente"'; if($row[estado] == "Pendiente") echo "selected"; echo '>Pendiente de Pago</option>

                            <option value="Pagada"'; if ($row[estado] == "Pagada") echo "selected"; echo '>Pagada</option>

                            <option value="Anulada"'; if ($row[estado] == "Anulada") echo "selected"; echo '>Anulada</option>

                            <option value="Rectificada"'; if ($row[estado] == "Rectificada") echo "selected"; echo '>Rectificada</option>

                        </select>

                    </div>

                </div>

            </div>

            <div class="clearfix"></div>

            <div style="margin: 15px 0 15px 0">

                <div class="col-md-3">

                    <div class="form-group">

                        <label class="control-label" for="importe">Importe Neto:</label>

                        <input type="text" id="importe" value="'.$row[importe].'" name="importe" class="form-control" />

                    </div>

                </div>

                <div class="col-md-3">

                    <div class="form-group">

                        <label class="control-label" for="bruto">Importe Bruto:</label>

                        <input type="text" id="bruto" value="'.$row[bruto].'" name="bruto" class="form-control" />

                    </div>

                </div>

                <div class="col-md-3">

                    <div class="form-group">

                        <label class="control-label" for="pagado">Pagado:</label>

                        <input type="text" id="pagado" value="'.$row[pagado].'" name="pagado" class="form-control" readonly/>

                    </div>

                </div>



                <div class="col-md-3">

                    <div class="form-group">

                        <label class="control-label" for="pendiente">Pendiente:</label>

                        <input type="text" id="pendiente" value="'.$row[pendiente].'" name="pendiente" class="form-control" />

                    </div>

                </div>

            </div>

            <div class="clearfix"></div>

            <div style="margin: 15px 0 15px 0">

                <div class="col-md-2">

                    <div class="form-group">

                        <label class="control-label" for="retencionpor">Retención (%):</label>

                        <input type="text" id="retencionpor" value="'.$row[retencionpor].'% " name="retencionpor" class="form-control" />

                    </div>

                </div>

                <div class="col-md-2">

                    <div class="form-group">

                        <label class="control-label" for="retencion">Retención:</label>

                        <input type="text" id="retencion" value="'.$row[retencion].'" name="retencion" class="form-control" />

                    </div>

                </div>

                <div class="col-md-2">

                    <div class="form-group">

                        <label class="control-label" for="impuestospor">Impuestos (%):</label>

                        <input type="text" id="impuestospor" value="'.$row[impuestospor].'% " name="impuestospor" class="form-control" />

                    </div>

                </div>

                <div class="col-md-2">

                    <div class="form-group">

                        <label class="control-label" for="impuestos">Impuestos:</label>

                        <input type="text" id="impuestos" value="'.$row[impuestos].'" name="impuestos" class="form-control" />

                    </div>

                </div>

                <div class="col-md-2">

                    <div class="form-group">

                        <label class="control-label" for="fecha_vencimiento">Fecha Vencimiento:</label>

                        <input type="date" id="fecha_vencimiento" value="'.$row[fecha_vencimiento].'" name="fecha_vencimiento" class="form-control" />

                    </div>

                </div>

            </div>

            <div class="clearfix"></div>

            <div class="col-md-12" style="margin-top: 15px;">

                <div class="form-group">

                    <label class="control-label" for="observaciones">Observaciones:</label>

                    <textarea name="observaciones" id="observaciones" class="form-control" rows="2">'.$row[observaciones].'</textarea>

                </div>

            </div>

        </div>

    </div>

    <div class="clearfix"></div>';



    if ( $_SESSION['user'] != 'manolo' ) {

        echo '<div class="col-md-2" style="margin-top: 10px;">

        <a id="actualizardetalleacre" id_fac="'.$idfac.'" style="float:left;width: 100%; margin-top: 0px;" class="btn btn-success btn-sm">Actualizar</a>

    </div>

    <div class="clearfix"></div>

    <div style="margin-top:10px;margin-left: 15px;" class="col-md-12">

        <form id="formapuntefac" action="" method="post" enctype="multipart/form-data">

            <label> PDF Factura: </label><br>

            <input style="float:left" type="file" name="apuntefac" id="apuntefac" class="btn btn-default"/>

            <a id="subirpdfapuntefac" class="boton btn btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a>

            <a id="mostrarpdfapuntefac" style="" class="boton btn btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a>



        </form>

    </div>



    <div class="clearfix"></div>';

}



echo '<div class="clearfix"></div>';





if ( $_SESSION['user'] != 'manolo' ) {

    echo anadirMatAcreFra($idfac, $link);

    echo'

    <div class="col-md-2" style="margin-top: 35px;">

        <a id="anadirconciliaracre" id_fac="'.$idfac.'" style="float:left;width: 100%; margin-top: 0px;" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Conciliar</a>

    </div>'; }

    echo '

    <div class="col-md-2 pull-right" style="margin-top: 35px;">

        <a id="verfactura" target="_blank" href="'.$baseurl.$acreedorpdf.'" style="float:left;width: 100%; margin-top: 0px;" class="btn btn-warning"><span class="glyphicon glyphicon-list-alt"></span> Ver Factura</a>

    </div>



    <div style="" class="clearfix"></div>

    <div class="cuadroconciliar">

        <hr>

        <span id="marca_concilio"></span>';



        $q2 = 'SELECT c.*

        FROM conciliaciones_acre c

        WHERE factura = '.$idfac.'

        ORDER BY fecha DESC';

         //echo $q2;

        $q2 = mysqli_query($link, $q2);

        $sumacobrado = 0;

        while ( $r = mysqli_fetch_array($q2) ) {

            // $sumacobrado += $r[cobrado];

            echo '

            <div style="overflow:auto; margin-bottom: 10px;">

                <div class="col-md-2">

                    <div class="form-group">

                        <label class="control-label" for="fechaconcilio">Fecha:</label>

                        <input type="date" id="fechaconcilio'.$r[id].'" value="'.$r[fecha].'" name="fechaconcilio" class="form-control"/>

                    </div>

                </div>

                <div class="col-md-2">

                    <div class="form-group">

                        <label class="control-label" for="pagadoconcilio">Pagado:</label>

                        <input value="'.$r[pagado].'" type="text" id="pagadoconcilio'.$r[id].'" class="form-control"/>

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="form-group">

                        <label class="control-label" for="observaciones">Observaciones:</label>

                        <textarea name="observaciones" id="observaciones'.$r[id].'" class="form-control" rows="1">'.$r[observaciones].'</textarea>

                    </div>

                </div>';



                if ( $_SESSION['user'] != 'manolo' ) {

                    echo '<div class="col-md-2" style="margin-top: 25px;">

                    <a id="actualizarconciliaracre" id_fac="'.$idfac.'" id_concilio="'.$r[id].'" style="float:left;width: 100%; margin-top: 0px;" class="btn btn-success"> Guardar</a>

                </div>'; }



                echo'

            </div>

            <div style="" class="clearfix"></div>';



        }





        echo '</div>

        <div style="" class="clearfix"></div>';





    }



}



function actualizarDetalleAcre($values, $link) {



    $gestion = devuelveAnio();


    $id = $values[id_fac];

    $fecha_vencimiento = date('Y-m-d', strtotime($values[fecha]. ' + '.$values[vencimiento].' days'));

    $query = 'UPDATE facturacion_acreedores SET ';

    $sep = '';

    // $id = $values['id'];



    unset($values['id_fac']);

    unset($values['actualizardetalleacre']);

    $values[retencionpor] = substr($values[retencionpor], 0,-2);

    $values[impuestospor] = substr($values[impuestospor], 0,-2);



    $q = 'SELECT numero, razonsocial FROM facturacion_acreedores f, acreedores a

    WHERE f.id = '.$id.'

    AND a.id = f.acreedor';

    $q = mysqli_query($link, $q) or die ('error:'.mysqli_error($link));



    $row = mysqli_fetch_array($q);

    $numero = $row[numero];

    $acreedor = $row[razonsocial];



    $numero = str_replace('/', '-', $numero);

    $acreedorpdf = $numero.'-'.quitaTildesConComas($acreedor);



    foreach($values as $key=>$value) {

        $query .= $sep.$key.' = "'.$value.'"';

        $sep = ', ';

    }

    $query .= ' WHERE `id` = "'.$id.'"';

    echo $query;

    $query = mysqli_query($link, $query) or die ('error:'.mysqli_error($link) );







    $rutaacreedor = dirname(__DIR__).'/facturacion'.$gestion.'/acreedores/';



    // echo $rutaacreedor.$acreedorpdf.'.pdf';



    if ( file_exists($rutaacreedor.$acreedorpdf.'.pdf') ) {



        // echo "entra";

        $numeron = str_replace('/', '-', $values['numero']);

        $acreedorpdfn = $numeron.'-'.quitaTildesConComas($acreedor);

        // echo $rutaacreedor.$acreedorpdf.'.pdf // '.$rutaacreedor.$acreedorpdfn.'.pdf';



        if ( is_writable($rutaacreedor.$acreedorpdf.'.pdf') ) {

            // echo "es writable";

            if ( !rename($rutaacreedor.$acreedorpdf.'.pdf', $rutaacreedor.$acreedorpdfn.'.pdf') )

                echo "error renombrando factura";

        }



        // echo $resul;



    }







}




//FUNCIONANDO CORRECTAMENTE DIA 11/5/2017
/*function guardarAcreedorFac($acreedor, $numero, $fecha, $importe, $bruto, $retencionpor, $retencion, $impuestospor, $impuestos, $vencimiento, $observaciones, $link) {



    $fecha_vencimiento = date('Y-m-d', strtotime($fecha. ' + '.$vencimiento.' days'));

    $q = 'INSERT INTO `facturacion_acreedores`(`numero`, `fecha`, `importe`, `vencimiento`, `acreedor`, `pendiente`, `fecha_vencimiento`, `bruto`, `retencionpor`, `retencion`, `impuestospor`, `impuestos`, `observaciones`, `estado`)

    VALUES ("'.$numero.'", "'.$fecha.'","'.$importe.'","'.$vencimiento.'","'.$acreedor.'","'.$importe.'","'.$fecha_vencimiento.'", "'.$bruto.'", "'.$retencionpor.'", "'.$retencion.'", "'.$impuestospor.'", "'.$impuestos.'", "'.addslashes($observaciones).'", "Pendiente")';

    // echo $q;

    //if ( $_SESSION[user] != 'root') {
    $q = mysqli_query($link, $q) or die('error:'. mysqli_error($link));
    // } else {
    //     echo $q;
    // }

    if ( $_SESSION[user] == 'root') {
        $ultimoInsertado =  mysqli_insert_id($link);

        if ( $ultimoInsertado ) {
            echo $ultimoInsertado;
        }
    }


}*/
//


//NUEVA FUNCION A IMPLEMENTAR
function guardarAcreedorFac2($acreedor, $numero, $fecha, $importe, $bruto, $retencionpor, $retencion, $impuestospor, $impuestos, $vencimiento, $observaciones, $idDocente, $tipo, $fechaInicio, $fechaFin, $link) {

    if ($tipo == 'Factura') {
        $idDocente = 0;
    }else if ($tipo == 'Nomina'){
        $mes = '';
        $anio = '';
    }

    /*echo $idDocente;*/

    $fecha_vencimiento = date('Y-m-d', strtotime($fecha. ' + '.$vencimiento.' days'));

    $q = 'INSERT INTO `facturacion_acreedores`(`numero`, `fecha`, `importe`, `vencimiento`, `acreedor`, `pendiente`, `fecha_vencimiento`, `bruto`, `retencionpor`, `retencion`, `impuestospor`, `impuestos`, `observaciones`, `estado`, `id_docente`, `tipo`, `fecha_inicio`, `fecha_fin`)

    VALUES ("'.$numero.'", "'.$fecha.'","'.$importe.'","'.$vencimiento.'","'.$acreedor.'","'.$importe.'","'.$fecha_vencimiento.'", "'.$bruto.'", "'.$retencionpor.'", "'.$retencion.'", "'.$impuestospor.'", "'.$impuestos.'", "'.addslashes($observaciones).'", "Pendiente", '.$idDocente.', "'.$tipo.'", "'.$fechaInicio.'", "'.$fechaFin.'")';

    /*echo $q;*/

    //if ( $_SESSION[user] != 'root') {
    $q = mysqli_query($link, $q) or die('error:'. mysqli_error($link));
    // } else {
    //     echo $q;
    // }

    // if ( $_SESSION[user] == 'root') {
        $ultimoInsertado =  mysqli_insert_id($link);

        if ( $ultimoInsertado ) {
            echo $ultimoInsertado;
        }
    // }


}



function anadirApuntefac($link) {



    echo '

    <input type="hidden" id="id_acreedor" name="id_acreedor" value="">


    <div class="col-md-12" style="overflow: auto;">

        <div class="col-md-5">

            <div class="form-group">

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

                <label class="control-label" for="numero">Nº Factura:</label>

                <input type="text" id="numero" value="" name="numero" class="form-control" />

            </div>

        </div>

        <div class="col-md-3">

            <div class="form-group">

                <label class="control-label" for="fecha">Fecha:</label>

                <input type="date" id="fecha" value="'.date("Y-m-d").'" name="fecha" class="form-control" />

            </div>

        </div>



        <div class="col-md-2">

            <div class="form-group">

                <label class="control-label" for="vencimiento">Vencimiento:</label>

                <input value="" type="text" id="vencimiento" name="vencimiento" class="form-control"  />

            </div>

        </div>

    </div>



    <div class="col-md-12" style="margin-top:15px;overflow:auto">

        <div class="col-md-2">

            <div class="form-group">

                <label class="control-label" for="importe">Importe Neto:</label>

                <input value="" type="text" id="importe" name="importe" class="form-control"  />

            </div>

        </div>

        <div class="col-md-2">

            <div class="form-group">

                <label class="control-label" for="bruto">Importe Bruto:</label>

                <input value="" type="text" id="bruto" name="bruto" class="form-control"  />

            </div>

        </div>

        <div class="col-md-2">

            <div class="form-group">

                <label class="control-label" for="retencionpor">Retención (%):</label>

                <input value="" type="text" id="retencionpor" name="retencionpor" class="form-control"  />

            </div>

        </div>

        <div class="col-md-2">

            <div class="form-group">

                <label class="control-label" for="retencion">Retención:</label>

                <input value="" type="text" id="retencion" name="retencion" class="form-control"  />

            </div>

        </div>

        <div class="col-md-2">

            <div class="form-group">

                <label class="control-label" for="impuestospor">Impuestos (%):</label>

                <input value="" type="text" id="impuestospor" name="impuestospor" class="form-control"  />

            </div>

        </div>

        <div class="col-md-2">

            <div class="form-group">

                <label class="control-label" for="impuestos">Impuestos:</label>

                <input value="" type="text" id="impuestos" name="impuestos" class="form-control"  />

            </div>

        </div>

    </div>

    <div class="col-md-12" style="margin-top:15px;">

        <div class="col-md-12">

            <div class="form-group">

                <label class="control-label" for="observaciones">Observaciones:</label>

                <textarea name="observaciones" id="observaciones" class="form-control" rows="2"></textarea>

            </div>

        </div>

    </div>



    <div class="clearfix"></div>

    <div style="margin-top:10px;margin-left: 15px;" class="col-md-12">

        <form id="formapuntefac" action="" method="post" enctype="multipart/form-data">

            <label> PDF Factura: </label><br>

            <input style="float:left" type="file" name="apuntefac" id="apuntefac" class="btn btn-default"/>

            <a id="subirpdfapuntefac" class="boton btn btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a>

            <a id="mostrarpdfapuntefac" style="" class="boton btn btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a>

            <span id="compmailfac" style="float:left; margin-top: 10px; margin-left: 10px; color: red;" class="glyphicon glyphicon-ok-circle"></span>



        </form>

    </div>



    <div class="clearfix"></div>



    <div class="col-md-3" style="margin: 15px 0 0 15px;">

        <a id="guardaracreedorfac" style="float:left; margin-top: 0px;" class="btn btn-success"> Guardar</a>

    </div>



</div>';

    //if ( $_SESSION[user] == 'root' ){
echo '

<div class="clearfix"></div>

<div id="divmatacrefra" class="col-md-3" style="margin: 15px 0 0 15px; display: none">

    <a id="anadirmatacrefra" id_fra="'.$idfra.'" style="float:left; margin-top: 0px;" class="btn btn-success"> Añadir Matricula</a>

</div>

';
    //}

}

//FUNCION HECHA POR OCTAVIO 11/5/2017

function anadirNomina($link){

    echo '

        <input type="hidden" id="id_acreedor" name="id_acreedor" value="">


        <div class="col-md-12" style="overflow: auto;">

            <div class="col-md-4">

                <div class="form-group">

                    <label class="control-label" for="docente">Docente:</label>

                    <select id="docente" class="form-control">';

                    $resultado = mysqli_query($link, "SELECT u.id_docente, nu.nombre FROM nominas_usuarios nu
                                                        INNER JOIN usuarios u
                                                        ON nu.usuario = u.id
                                                        INNER JOIN docentes d
                                                        ON u.id_docente = d.id
                                                        ORDER BY nu.nombre ASC");
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        echo '<option iden="'.$fila['id_docente'].'" value="'.$fila['nombre'].'">'.$fila['nombre'].'</option>';
                    }
                    echo '</select>

                </div>

            </div>

            <div class="col-md-3">

                <div class="form-group">

                    <label class="control-label" for="fechainicio">Fecha inicio:</label>

                    <input type="date" id="fechainicio" value="'.date("Y-m-d").'" name="fechainicio" class="form-control" />

                </div>

            </div>

            <div class="col-md-3">

                <div class="form-group">

                    <label class="control-label" for="fechafin">Fecha fin:</label>

                    <input type="date" id="fechafin" value="'.date("Y-m-d").'" name="fechafin" class="form-control" />

                </div>

            </div>';

            /*<div class="col-md-2">

                <div class="form-group">

                    <label class="control-label" for="mes">Mes:</label>

                    <select id="mes" name="mes" class="form-control">';

                    $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

                    foreach ($meses as $mes) {
                        echo '<option value="'.$mes.'">'.$mes.'</option>';
                    }

                    echo '</select>

                </div>

            </div>

            <div class="col-md-2">

                <div class="form-group">

                    <label class="control-label" for="anio">Año:</label>

                    <select id="anio" name="anio" class="form-control">';

                    foreach(range('2014', date('Y')) as $anio){
                        echo '<option value="'.$anio.'">'.$anio.'</option>';
                    }

                    echo '</select>

                </div>

            </div>*/

            echo '<div class="col-md-2">

                <div class="form-group">

                    <label class="control-label" for="vencimiento">Vencimiento:</label>

                    <input value="" type="text" id="vencimiento" name="vencimiento" class="form-control"  />

                </div>

            </div>

        </div>



        <div class="col-md-12" style="margin-top:15px;overflow:auto">

            <div class="col-md-2">

                <div class="form-group">

                    <label class="control-label" for="importe">Importe Neto:</label>

                    <input value="" type="text" id="importe" name="importe" class="form-control"  />

                </div>

            </div>

            <div class="col-md-2">

                <div class="form-group">

                    <label class="control-label" for="bruto">Importe Bruto:</label>

                    <input value="" type="text" id="bruto" name="bruto" class="form-control"  />

                </div>

            </div>

            <div class="col-md-2">

                <div class="form-group">

                    <label class="control-label" for="retencionpor">Retención (%):</label>

                    <input value="" type="text" id="retencionpor" name="retencionpor" class="form-control"  />

                </div>

            </div>

            <div class="col-md-2">

                <div class="form-group">

                    <label class="control-label" for="retencion">Retención:</label>

                    <input value="" type="text" id="retencion" name="retencion" class="form-control"  />

                </div>

            </div>

            <div class="col-md-2">

                <div class="form-group">

                    <label class="control-label" for="impuestospor">Impuestos (%):</label>

                    <input value="" type="text" id="impuestospor" name="impuestospor" class="form-control"  />

                </div>

            </div>

            <div class="col-md-2">

                <div class="form-group">

                    <label class="control-label" for="impuestos">Impuestos:</label>

                    <input value="" type="text" id="impuestos" name="impuestos" class="form-control"  />

                </div>

            </div>

        </div>

        <div class="col-md-12" style="margin-top:15px;">

            <div class="col-md-12">

                <div class="form-group">

                    <label class="control-label" for="observaciones">Observaciones:</label>

                    <textarea name="observaciones" id="observaciones" class="form-control" rows="3" style="resize:none;"></textarea>

                </div>

            </div>

        </div>



        <div class="clearfix"></div>

        <div style="margin-top:10px;margin-left: 15px;" class="col-md-12">

            <form id="formnomina" action="" method="post" enctype="multipart/form-data">

                <label> Subir PDF: </label><br>

                <input style="float:left" type="file" name="apuntenomina" id="apuntenomina" class="btn btn-default"/>

                <a id="subirpdfdocentenomina" class="boton btn btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a>

                <a id="mostrarpdfdocentenomina" style="" class="boton btn btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a>

                <span id="compmailfac" style="float:left; margin-top: 10px; margin-left: 10px; color: red;" class="glyphicon glyphicon-ok-circle"></span>



            </form>

        </div>



        <div class="clearfix"></div>



        <div class="col-md-3" style="margin: 15px 0 0 15px;">

            <a id="guardarnomina" style="float:left; margin-top: 0px;" class="btn btn-success"> Guardar</a>

        </div>



    </div>';

        //if ( $_SESSION[user] == 'root' ){
    echo '

    <div class="clearfix"></div>

    <div id="divmatacrefra" class="col-md-3" style="margin: 15px 0 0 15px; display: none">

        <a id="anadirmatacrefra" id_fra="'.$idfra.'" style="float:left; margin-top: 0px;" class="btn btn-success"> Añadir Matricula</a>

    </div>

    ';

}

//TERMINA FUNCION







function anadirConciliar($idfac, $link) {



    $random = rand();



    echo '

    <div style="overflow:auto; margin-bottom: 10px;">

        <div class="col-md-2">

            <div class="form-group">

                <label class="control-label" for="fechaconcilio">Fecha:</label>

                <input type="date" id="fechaconcilio'.$random.'" value="'.date('Y-m-d').'" name="fechaconcilio" class="form-control"/>

            </div>

        </div>

        <div class="col-md-2">

            <div class="form-group">

                <label class="control-label" for="cobradoconcilio">Cobrado:</label>

                <input value="" type="text" id="cobradoconcilio'.$random.'" name="cobradoconcilio" class="form-control"/>

            </div>

        </div>

        <div class="col-md-6">

            <div class="form-group">

                <label class="control-label" for="observaciones">Observaciones:</label>

                <textarea name="observaciones" id="observaciones'.$random.'" class="form-control" rows="1"></textarea>

            </div>

        </div>

        <div class="col-md-2" style="margin-top: 25px;">

            <a id="guardarconciliar" id_fac="'.$idfac.'" id_concilio="" nuevo="'.$random.'" style="float:left;width: 100%; margin-top: 0px;" class="btn btn-success"> Guardar</a>

        </div>



    </div>

    <div style="" class="clearfix"></div>';



}



function anadirConciliarAcre($idfac, $link) {



    $random = rand();



    echo '

    <div style="overflow:auto; margin-bottom: 10px;">

        <div class="col-md-2">

            <div class="form-group">

                <label class="control-label" for="fechaconcilio">Fecha:</label>

                <input type="date" id="fechaconcilio'.$random.'" value="'.date('Y-m-d').'" name="fechaconcilio" class="form-control"/>

            </div>

        </div>

        <div class="col-md-2">

            <div class="form-group">

                <label class="control-label" for="pagadoconcilio">Pagado:</label>

                <input value="" type="text" id="pagadoconcilio'.$random.'" name="pagadoconcilio" class="form-control"/>

            </div>

        </div>

        <div class="col-md-6">

            <div class="form-group">

                <label class="control-label" for="observaciones">Observaciones:</label>

                <textarea name="observaciones" id="observaciones'.$random.'" class="form-control" rows="1"></textarea>

            </div>

        </div>

        <div class="col-md-2" style="margin-top: 25px;">

            <a id="guardarconciliaracre" id_fac="'.$idfac.'" id_concilio="" nuevo="'.$random.'" style="float:left;width: 100%; margin-top: 0px;" class="btn btn-success"> Guardar</a>

        </div>



    </div>

    <div style="" class="clearfix"></div>';

// <a id="modificarconciliar" id_fac="'.$idfac.'" id_concilio="" style="float:left;width: 100%; margin-top: 0px;" class="btn btn-success"> Modificar</a>

//             </div>

}




function guardarConciliar($idfac, $fecha, $cobrado, $total, $pendiente, $tabla, $observaciones, $tipo, $link) {

    if ($tipo == 'B') {$idfac = $idfac-1;}#parche 2025

    $q = 'INSERT INTO conciliaciones (fecha, cobrado, factura, observaciones, tipo)

    VALUES("'.$fecha.'", "'.round($cobrado,2).'", "'.$idfac.'", "'.addslashes($observaciones).'", "'.$tipo.'")';



    $resul = mysqli_query($link, $q) or die('error');



    $q = 'SELECT SUM(cobrado) as cobrado

    FROM conciliaciones

    WHERE factura = '.$idfac.'

    AND tipo = "'.$tipo.'"';

    // echo $q;

    $q = mysqli_query($link, $q);



    $row = mysqli_fetch_array($q);

    $cobradobd = round($row[cobrado],2);

    // echo "cobradobd: ".$cobradobd;



    $total = round($total,2);

    $cobrado = round($cobrado,2);

    // echo $cobradobd.' - '.$total;

    if ( $cobradobd >= $total )

        $estado = ' , estado = "Pagada" ';

    else $estado = " ";



    $cobrado = round($cobrado,2);

    $pendiente = $pendiente-$cobrado;

    // echo "<br>pendiente: ".$pendiente.'-'.$cobrado;



    if ( $pendiente <= 0 ) $estado = ' , estado = "Pagada" '; else $estado = " ";

    // echo $estado;

    $q = 'UPDATE '.$tabla.' SET importe_a_abonar = "'.$pendiente.'", cobrado = "'.$cobradobd.'"'.$estado.'WHERE id = '.$idfac;

    $q = mysqli_query($link, $q);



    $resultado[0] = $cobradobd;

    $resultado[1] = $pendiente;

    // print_r($resul);

    echo json_encode($resultado);





}



function guardarConciliarAcre($idfac, $fecha, $pagado, $total, $pendiente, $observaciones, $link) {



    $q = 'INSERT INTO conciliaciones_acre (fecha, pagado, factura, observaciones)

    VALUES("'.$fecha.'", "'.round($pagado,2).'", "'.$idfac.'", "'.addslashes($observaciones).'")';


    //echo $q;

    $resul = mysqli_query($link, $q) or die('error');

    $q = 'SELECT SUM(pagado) as pagado

    FROM conciliaciones_acre

    WHERE factura = '.$idfac;

    // echo $q;

    $q = mysqli_query($link, $q);

    $row = mysqli_fetch_array($q);

    $pagadobd = round($row[pagado],2);

    $total = round($total,2);

    // echo $pagadobd.' - '.$total;

    if ( $pagadobd >= $total )

        $estado = ' , estado = "Pagada" ';

    else $estado = " ";

    $pagado = round($pagado,2);

    // echo "<br>Pendiente antes conciliar: ".$pendiente;

    $pendiente = $pendiente-$pagado;

    // $pendiente = $total-$pagadobd;

    // echo $estado;

    // echo "<br>Estado: ".$estado;
    // echo "<br>Pendiente después conciliar: ".$pendiente;
    // echo "<br>Pagado: ".$pagado;
    // echo "<br>Total: ".$total;

    $q = 'UPDATE facturacion_acreedores SET pendiente = "'.$pendiente.'", pagado = "'.$pagadobd.'"'.$estado.'WHERE id = '.$idfac;

    //echo "<br>SQL: ".$q;

    $q = mysqli_query($link, $q);



    $resultado[0] = $pagadobd;

    $resultado[1] = $pendiente;

    // print_r($resul);

    echo json_encode($resultado);







}





function actualizarConciliar($idfac, $idcon, $fecha, $cobrado, $total, $pendiente, $tabla, $observaciones, $tipo, $link) {

    // $q = 'SELECT SUM(cobrado) as cobrado

    // FROM conciliaciones

    // WHERE factura = '.$idfac.'

    // AND tipo = "'.$tipo.'"';

    // $q = mysqli_query($link, $q);



    // $row = mysqli_fetch_array($q);

    // $cobradobd = round($row[cobrado],2);



    // $q = 'SELECT cobrado

    // FROM conciliaciones

    // WHERE id = '.$idcon.'

    // AND tipo = "'.$tipo.'"';

    // $q = mysqli_query($link, $q);



    // $row = mysqli_fetch_array($q);

    // $cobradoant = $cobradobd-$row[cobrado];

    // $pendienteant = $pendiente+$row[cobrado];

    $q = 'UPDATE conciliaciones SET fecha = "'.$fecha.'", cobrado = "'.round($cobrado,2).'", observaciones = "'.addslashes($observaciones).'"
    WHERE id = '.$idcon.' AND tipo = "'.$tipo.'"';

    $resul = mysqli_query($link, $q) or die('error');

//     $cobradonuevo = $cobradoant+$cobrado;

//     // if ( $cobradonuevo == $total ) $estado = ' , estado = "Pagada" '; else $estado = " ";

// // echo $cobradonuevo.' - '.$total;

//     $pendientenuevo = $pendienteant-$cobrado;

//     if ( $pendientenuevo <= 0 ) $estado = ' , estado = "Pagada" '; else $estado = " ";

//     $q = 'UPDATE '.$tabla.' SET importe_a_abonar = "'.$pendientenuevo.'", cobrado = "'.$cobradonuevo.'"'.$estado.'WHERE id = '.$idfac;

//     // echo $q;

//     $q = mysqli_query($link, $q);

//     $resultado[0] = $cobradonuevo;

//     $resultado[1] = $pendientenuevo;

//     // print_r($resul);

    echo json_encode($resultado);

}





function actualizarConciliarAcre($idfac, $idcon, $fecha, $pagado, $total, $pendiente, $observaciones, $link) {





    // $q = 'SELECT SUM(pagado) as pagado

    // FROM conciliaciones_acre

    // WHERE factura = '.$idfac;

    // $q = mysqli_query($link, $q);



    // $row = mysqli_fetch_array($q) or die("error1".mysqli_error($link));

    // $pagadobd = round($row[pagado],2);





    // $q2 = 'SELECT pagado

    // FROM conciliaciones_acre

    // WHERE id = '.$idcon;

    // $q2 = mysqli_query($link, $q2) or die("error2".mysqli_error($link));





    // $rowx = mysqli_fetch_array($q2);

    // // echo $rowx[pagado]."<br>";

    // $pagadoant = $pagadobd-$rowx[pagado];

    // $pendienteant = $pendiente+$rowx[pagado];

    // // echo $pendienteant."<br>";



    $q = 'UPDATE conciliaciones_acre SET fecha = "'.$fecha.'", pagado = "'.round($pagado,2).'", observaciones = "'.addslashes($observaciones).'"

    WHERE id = '.$idcon;

        // echo $q;

    $resul = mysqli_query($link, $q) or die('error');



    // $pagadonuevo = $pagadoant+$pagado;

    // if ( $pagadonuevo >= $total ) $estado = ' , estado = "Pagada" '; else $estado = " ";



    // $pendientenuevo = $pendienteant-$pagado;

    // // echo $pendientenuevo;



    // $q = 'UPDATE facturacion_acreedores SET pendiente = "'.$pendientenuevo.'", pagado = "'.$pagadonuevo.'"'.$estado.'WHERE id = '.$idfac;

    // $q = mysqli_query($link, $q);



    // $resultado[0] = $pagadonuevo;

    // $resultado[1] = $pendientenuevo;

    // print_r($resul);

    echo json_encode($resultado);







}





function rectificaFactura($idfac, $tabla, $link) {



    // if ($tabla == 'facturacion_privada') $facturar_a = ', facturar_a ';

    $q = 'SELECT @idmat:=m.id as mat, ac.modalidad, e.razonsocial, ac.numeroaccion, ga.ngrupo, m.fechaini, m.fechafin, ac.denominacion, f.*, f.id as idfac, c.nombre, c.apellido, e.id as emp

    FROM acciones ac, empresas e, grupos_acciones ga, matriculas m, mat_alu_cta_emp ma, '.$tabla.' f, comerciales c

    WHERE e.comercial = c.id

    AND ac.id = m.id_accion

    AND e.id = ma.id_empresa

    AND ga.id = m.id_grupo

    AND m.id = ma.id_matricula

    AND ma.id_empresa = e.id

    AND f.matricula = m.id

    AND f.empresa = e.id

    AND f.id = '.$idfac.'

    GROUP BY e.id, m.id';

    if ( $_SESSION['user'] == 'root' ){
        // echo $q;
    }

    $q = mysqli_query($link, $q);



    while ( $row = mysqli_fetch_array($q) ) {



        $prefijo = $row[prefijo];

        if ( $prefijo == 'R') $rectificativa = ' rectificativa '; else $rectificativa = ' ';

        $numero = $row[numero];

        $numerof = $prefijo.$numero;

        $empresa = quitaTildesConComas($row[razonsocial]);

        $nombreFichero = 'facturacion'.$gestion.'/facturas/'.$numerof.'_'.$empresa.'_'.$row[numeroaccion].'-'.$row[ngrupo].'.pdf';

        $nombreFicheroMail = 'facturas/'.$numerof.'_'.$empresa.'_'.$row[numeroaccion].'-'.$row[ngrupo].'.pdf';



        $titulo = 'Factura'.$rectificativa.'acción formativa '.$row[numeroaccion].'/'.$row[ngrupo].' - '.$row[razonsocial].' - '.$row[modalidad];

        if ( compruebaEnvioEmail($titulo, $link) === 1 ) $esta = 'green'; else $esta = 'red';



        echo '

        <input type="hidden" id="idfac" name="idfac" value="'.$row[idfac].'">

        <div style="margin: 15px 0 15px 0">

            <div class="col-md-2">

                <div class="form-group">

                    <label class="control-label" for="numero">Nº Factura:</label>

                    <input type="text" id="numero" value="'.$numerof.'" name="numero" class="form-control" disabled/>

                </div>

            </div>

            <div class="col-md-2">

                <div class="form-group">

                    <label class="control-label" for="fecha">Fecha:</label>

                    <input type="text" id="fecha" value="'.formateaFecha($row[fecha]).'" name="fecha" class="form-control" disabled/>

                </div>

            </div>

            <div class="col-md-4">

                <div class="form-group">

                    <label class="control-label" for="razonsocial">Empresa:</label>

                    <input type="text" id="razonsocial" value="'.$row[razonsocial].'" name="razonsocial" class="form-control" disabled/>

                </div>

            </div>

            <div class="col-md-2">

                <div class="form-group">

                    <label class="control-label" for="comercial">Comercial:</label>

                    <input type="text" id="comercial" value="'.$row[nombre].' '.$row[apellido].'" name="comercial" class="form-control" disabled/>

                </div>

            </div>

            <div class="col-md-2 pull-right">

                <div class="form-group">

                    <label class="control-label" for="estadofac">Estado Factura:</label>

                    <select id="estadofac'.$r[id_emp].'" name="estadofac" class="form-control">

                        <option value="Pendiente"'; if($row[estado] == "Pendiente") echo "selected"; echo '>Pendiente de Pago</option>

                        <option value="Pagada"'; if ($row[estado] == "Pagada") echo "selected"; echo '>Pagada</option>

                        <option value="Anulada"'; if ($row[estado] == "Anulada") echo "selected"; echo '>Anulada</option>

                        <option value="Rectificada"'; if ($row[estado] == "Rectificada") echo "selected"; echo '>Rectificada</option>

                    </select>

                </div>

            </div>

        </div>

        <div class="clearfix"></div>

        <div style="margin: 15px 0 15px 0">

            <div class="col-md-2">

                <div class="form-group">

                    <label class="control-label" for="numeroaccion">Acción Formativa:</label>

                    <input value="'. $row[numeroaccion] .'/'. $row[ngrupo] . '" type="text" id="numeroaccion" name="numeroaccion" class="form-control" disabled/>

                </div>

            </div>

            <div class="col-md-6">

                <div class="form-group">

                    <label class="control-label" for="denominacion">Denominación Acción Formativa:</label>

                    <input value="'. $row[denominacion] .'" type="text" id="denominacion" name="denominacion" class="form-control" disabled />

                </div>

            </div>



            <div class="col-md-2">

                <div class="form-group">

                    <label class="control-label" for="fechaini">Fecha Inicio:</label>

                    <input value="'. $row[fechaini] .'" type="date" id="fechaini" name="fechaini" class="form-control" disabled />

                </div>

            </div>

            <div class="col-md-2">

                <div class="form-group">

                    <label class="control-label" for="fechafin">Fecha Fin:</label>

                    <input value="'. $row[fechafin] .'" type="date" id="fechafin" name="fechafin" class="form-control" disabled />

                </div>

            </div>

        </div>

        <div style="" class="clearfix"></div>

        <div style="margin: 15px 0 15px 0">';



            if ( $row[facturar_a] != 0 ) {



                $q4 = 'SELECT e.razonsocial as razonsocialfac, e.cif as ciffac, e.domiciliofiscal, e.domiciliosocial, e.codigopostal, e.poblacion, e.provincia, email_facturas, c.nombre, e.email, e.email_facturas, e.vencimiento, e.id as id_emp

                FROM empresas e, comerciales c

                WHERE e.comercial = c.id

                AND e.id = '.$row[facturar_a];

            // echo $q4;

                $q4 = mysqli_query($link, $q4);

                $r4 = mysqli_fetch_array($q4);



                $empresa = quitaTildesConComas($r4[razonsocialfac]);

                $nombreFichero = 'facturacion'.$gestion.'/facturas/'.$numerof.'_'.$empresa.'_'.$row[numeroaccion].'-'.$row[ngrupo].'.pdf';

                $nombreFicheroMail = 'facturas/'.$numerof.'_'.$empresa.'_'.$row[numeroaccion].'-'.$row[ngrupo].'.pdf';



                if ( $r4[email_facturas] == "" ) $email = $r4[email];

                else $email = $r4[email_facturas];



                echo '

                <h4 style="margin: 30px 0 -10px 15px">Facturado a:</h4>

                <hr>

                <div class="col-md-4">

                    <div class="form-group">

                        <label class="control-label" for="razonsocialfac">Empresa:</label>

                        <input type="text" id="razonsocialfac" value="'.$r4[razonsocialfac].'" name="razonsocialfac" class="form-control" readonly/>

                    </div>

                </div>

                <div class="col-md-2">

                    <div class="form-group">

                        <label class="control-label" for="comercial">Comercial:</label>

                        <input type="text" id="comercial" value="'.$r4[nombre].'" name="comercial" class="form-control" disabled/>

                    </div>

                </div>

                <div class="col-md-2">

                    <div class="form-group">

                        <label class="control-label" for="vencimiento">Fecha Vencimiento:</label>

                        <input value="'. $row[fecha_vencimiento] .'" type="date" id="fecha_vencimientofaca" name="vencimiento" class="form-control" disabled />

                    </div>

                </div>

                <div class="col-md-2">

                    <div class="form-group">

                        <label class="control-label" for="vencimiento">Vencimiento:</label>

                        <input value="'. $r4[vencimiento] .'" type="text" id="vencimientofaca" name="vencimiento" class="form-control" />

                    </div>

                </div>

                <div class="col-md-2">

                    <a id="actualizarvencimientofaca" id_fac = "'.$idfac.'" id_emp = "'.$r4[id_emp].'" target="_blank" href="#" style="float:left;width: 100%; margin-top: 25px;" class="btn btn-success"> Actualizar</a>

                </div>

                <div style="" class="clearfix"></div>

                <div style="margin: 15px 0 15px 0">';



                }



                echo '

                <div class="col-md-3">

                    <div class="form-group">

                        <label class="control-label" for="cobrado">Cobrado:</label>

                        <input value="'. $row[cobrado] . '" type="text" id="cobrado" name="cobrado" class="form-control" disabled/>

                    </div>

                </div>

                <div class="col-md-3">

                    <div class="form-group">

                        <label class="control-label" for="total_factura">Total:</label>

                        <input value="'. $row[total_factura] .'" type="text" id="total_factura" name="total_factura" class="form-control" disabled />

                    </div>

                </div>

                <div class="col-md-3">

                    <div class="form-group">

                        <label class="control-label" for="importe_a_abonar">Importe a Abonar:</label>

                        <input value="'. $row[importe_a_abonar] .'" type="text" id="importe_a_abonar" name="importe_a_abonar" class="form-control" disabled />

                    </div>

                </div>

                <div style="" class="clearfix"></div>

                <div style="margin: 15px 0 15px 0">';



                    echo'

                    <form action="facturacion/factura_rectificativa.php" target="_blank" name="pdf" id="rectificativa" method="POST">

                        <input type="hidden" name="mat" id="mat" value="'.$row[mat].'">

                        <input type="hidden" name="emp" id="emp" value="'.$row[emp].'">

                        <input type="hidden" id="idfac" name="idfac" value="'.$row[idfac].'">

                        <input type="hidden" id="tabla" name="tabla" value="'.$tabla.'">

                        <input type="hidden" id="nuevoimporte" name="nuevoimporte" value="">

                        <input type="hidden" id="motivoform" name="motivoform" value="">

                        <input type="hidden" id="nfacturaorig" name="nfacturaorig" value="'.$numerof.'">

                        <input type="hidden" id="fechaorig" name="fechaorig" value="'.formateaFecha($row[fecha]).'">

                        <input type="hidden" id="fechaform" name="fechaform" value="">

                        <input type="hidden" id="empfacturar" name="empfacturar" value="'.$row[facturar_a].'">

                        <input type="hidden" id="genera" name="genera" value="">

                    </form>

                    <hr>

                    <div class="col-md-12">

                        <div class="form-group">

                            <label class="control-label" for="motivo">Motivo de la rectificación:</label>

                            <textarea name="motivo" id="motivo" class="form-control" rows="3">El motivo de la rectificación es </textarea>

                        </div>

                    </div>

                </div>

                <div style="" class="clearfix"></div>

                <div class="col-md-3">

                    <div class="form-group">

                        <label class="control-label" for="fechafacturar">Fecha:</label>

                        <input type="date" id="fechafacturar" value="'.date('Y-m-d').'" name="fechafacturar" class="form-control" />

                    </div>

                </div>

                <div class="col-md-3">

                    <div class="form-group">

                        <label class="control-label" for="importe_rectificar">Nuevo importe:</label>

                        <input type="text" id="importe_rectificar" name="importe_rectificar" class="form-control" />

                    </div>

                </div>



                <div class="col-md-3" style="margin-top: 25px;">

                   <a id="previsualizarfacturar" id_fac="'.$idfac.'" tabla="'.$tabla.'" style="float:left;width: 100%;" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Previsualizar Factura</a>

               </div>

           </div>

           <div class="col-md-2" style="margin-top: 10px">

               <a id="generarfacturar" id_fac="'.$idfac.'" tabla="'.$tabla.'" style="float:left;width: 100%;" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span> Rectificar Factura</a>

           </div>

       </div>

   </div>

   <div style="" class="clearfix"></div>



   <div class="col-md-3" style="margin-top: 15px;">

       <a id="verfactura" target="_blank" href="'.$baseurl.$nombreFichero.'" style="float:left;width: 100%; margin-top: 0px;" class="btn btn-success"><span class="glyphicon glyphicon-list-alt"></span> Ver Factura Original</a>

   </div>

   <div style="" class="clearfix"></div>';



}



}





function actualizaEstado($idfac, $estado, $tabla, $idmat = NULL, $link) {



    if ( $estado == "Rectificada" ) {



        $importe = ', importe_a_abonar = 0 ';

        $q1 = 'UPDATE matriculas SET estado = "Finalizada" WHERE id = '.$idmat;

        $q1 = mysqli_query($link, $q1) or die("error");



    } else $importe = ' ';



    $q = 'UPDATE '.$tabla.' SET estado="'.$estado.'" '.$importe.' WHERE id = '.$idfac;

    // echo $q;

    $q = mysqli_query($link, $q) or die("error");





    echo "ok";



}





function actualizaDetalleFactura($idfac, $estado, $pendiente, $cobrado, $total, $tabla, $link) {



    // $devuelve = 1;

    // if ( $total == $cobrado ) {

    //     $estado = ' , estado = "Pagada" ';

    //     $devuelve = 2; // devuelve con estado "Pagada" para actualizarlo.

    // } else {

    //     $estado = ' , estado = "Pendiente" ';

    // }


    $q = 'UPDATE '.$tabla.' SET total_factura = "'.$total.'", cobrado = "'.$cobrado.'", importe_a_abonar="'.$pendiente.'", estado = "'.$estado.'" WHERE id = '.$idfac;

    // echo $q;
//
    $q = mysqli_query($link, $q) or die("error");

    echo 1;



}





function detalleFactura($idfac, $tabla, $link) {

     //echo "entra";

                // print_r($_SESSION);



    $facs = array(182,174,163,165,149,147,186,187,188,189,190,191);



    if ( $tabla == 'facturacion_privada' && in_array($idfac, $facs) ) {



        $q = 'SELECT @idmat:=m.id as mat, ac.modalidad, e.razonsocial, ac.numeroaccion, ga.ngrupo, m.fechaini, m.fechafin, ac.denominacion,

        f.*, f.id as idfac, c.nombre, c.apellido, e.email_facturas, e.email, e.id as idemp, m.id_solicitudikea, ma.numerocuenta, observacionesfra, f.facturar_a

        FROM acciones ac, empresas e, grupos_acciones ga, matriculas m, mat_alu_cta_emp ma, '.$tabla.' f, comerciales c

        WHERE e.comercial = c.id

        AND ac.id = m.id_accion

        AND ga.id = m.id_grupo

        AND f.matricula = m.id

        AND f.empresa = e.id

        AND f.id = '.$idfac.'

        GROUP BY e.id, m.id';



    } else {

 //echo "entra 2";

        $q = 'SELECT @idmat:=m.id as mat, ac.modalidad, e.razonsocial, ac.numeroaccion, ga.ngrupo, m.fechaini, m.fechafin, ac.denominacion,

        f.*, f.id as idfac, c.nombre, c.apellido, e.email_facturas, e.email, e.id as idemp, m.id_solicitudikea, ma.numerocuenta, observacionesfra, f.facturar_a

        FROM acciones ac, empresas e, grupos_acciones ga, matriculas m, mat_alu_cta_emp ma, '.$tabla.' f, comerciales c

        WHERE e.comercial = c.id

        AND ac.id = m.id_accion

        AND e.id = ma.id_empresa

        AND ga.id = m.id_grupo

        AND m.id = ma.id_matricula

        AND ma.id_empresa = e.id

        AND f.matricula = m.id

        AND f.empresa = e.id

        AND f.id = '.$idfac.'

        GROUP BY e.id, m.id';

    }

        // echo $q;

    $q = mysqli_query($link, $q) or die("error abriendo detalle ". mysqli_error($link));



    while ( $row = mysqli_fetch_array($q) ) {



        $prefijo = $row[prefijo];

        // if ( $prefijo == "" ) $prefijo = 'B';

        if ( $prefijo == 'R') $rectificativa = ' rectificativa '; else $rectificativa = ' ';

        $numero = $row[numero];

        $numerof = $prefijo.$numero;

        $empresa = quitaTildesConComas($row[razonsocial]);
         //echo $empresa;

        $nombreFichero = 'facturacion'.$gestion.'/facturas/'.$numerof.'_'.$empresa.'_'.$row[numeroaccion].'-'.$row[ngrupo].'.pdf';

        $nombreFicheroMail = 'facturas/'.$numerof.'_'.$empresa.'_'.$row[numeroaccion].'-'.$row[ngrupo].'.pdf';



        if ( $row[facturar_a] != 0 ) {



            // echo "ey";

            $q4 = 'SELECT e.id as idemp, e.razonsocial as razonsocialfac, e.cif as ciffac, e.agente, e.domiciliofiscal, e.domiciliosocial, e.codigopostal, e.poblacion, e.provincia, email_facturas, e.email as emailnormal, c.nombre, c.email as email_comercial

            FROM empresas e, comerciales c

            WHERE e.comercial = c.id

            AND e.id = '.$row[facturar_a];

            // echo $q4;

            $q4 = mysqli_query($link, $q4);

            $r4 = mysqli_fetch_array($q4);





            $numerof = $prefijo.$numero;

            $empresa = quitaTildesConComas($r4[razonsocial]);

            // $nombreFicheroMail = 'facturas/'.$numerof.'_'.$empresa.'_'.$row[numeroaccion].'-'.$row[ngrupo].'.pdf';



            $titulo = 'Factura'.$rectificativa.'acción formativa '.$row[numeroaccion].'/'.$row[ngrupo].' - '.$r4[razonsocialfac].' - '.$row[modalidad];

            // echo $titulo;



        } else



        $titulo = 'Factura'.$rectificativa.'acción formativa '.$row[numeroaccion].'/'.$row[ngrupo].' - '.$row[razonsocial].' - '.$row[modalidad];


        $fechamail = compruebaEnvioEmailFac($titulo, $link);



        if ( $fechamail != 0 ) {

            $esta = 'green';

            $fechamail = explode(" ", $fechamail);

            $fecha = "Enviada el: ".formateaFecha($fechamail[0]).' - '.substr($fechamail[1], 0,-3);

        } else $esta = 'red';





        $pendiente = $row[importe_a_abonar];



        if ( $row[id_solicitudikea] != 0 ) {



            // $row[numerocuenta] = substr($row[numerocuenta], 0, 9);



            $qx = 'SELECT email

            FROM ikea_solicitudes i, usuarios u

            WHERE u.user = i.usuario

            AND i.id = '.$row[id_solicitudikea];

            $qx = mysqli_query($link, $qx) or die("error select : " .mysqli_error($link));



            $rowx = mysqli_fetch_assoc($qx);

            $emails[] = $rowx[email];


            $email = implode(',', $emails);

            if ( $email != "" )

                $email .= ',laura.garcia@woden.es';

            else

                $email = 'laura.garcia@woden.es';





        } else {

            if ( $row[email_facturas] == "" ) $email = $row[email];

            else $email = $row[email_facturas];

        }







        echo '

        <input type="hidden" id="idfac" name="idfac" value="'.$row[idfac].'">

        <input type="hidden" id="tabla" name="tabla" value="'.$tabla.'">

        <input type="hidden" id="id_mat" name="id_matricula" value="'.$row[mat].'" >

        <div style="margin: 15px 0 15px 0">

            <div class="col-md-2">

                <div class="form-group">

                    <label class="control-label" for="numero">Nº Factura:</label>

                    <input type="text" id="numero" value="'.$numerof.'" name="numero" class="form-control" disabled/>

                </div>

            </div>

            <div class="col-md-2">

                <div class="form-group">

                    <label class="control-label" for="fecha">Fecha:</label>

                    <input type="text" id="fecha" value="'.formateaFecha($row[fecha]).'" name="fecha" class="form-control" disabled/>

                </div>

            </div>

            <div class="col-md-4">

                <div class="form-group">

                    <label class="control-label" for="razonsocial">Empresa:</label>

                    <input type="text" id="razonsocial" value="'.$row[razonsocial].'" name="razonsocial" class="form-control" disabled/>

                </div>

            </div>

            <div class="col-md-2">

                <div class="form-group">

                    <label class="control-label" for="comercial">Comercial:</label>

                    <input type="text" id="comercial" value="'.$row[nombre].' '.$row[apellido].'" name="comercial" class="form-control" disabled/>

                </div>

            </div>

            <div class="col-md-2 pull-right">

                <div class="form-group">

                    <label class="control-label" for="estadofac">Estado Factura:</label>

                    <select id="estadofac" name="estadofac" class="form-control">

                        <option value="Pendiente"'; if($row[estado] == "Pendiente") echo "selected"; echo '>Pendiente de Pago</option>

                        <option value="Pagada"'; if ($row[estado] == "Pagada") echo "selected"; echo '>Pagada</option>

                        <option value="Anulada"'; if ($row[estado] == "Anulada") echo "selected"; echo '>Anulada</option>

                        <option value="Rectificada"'; if ($row[estado] == "Rectificada") echo "selected"; echo '>Rectificada</option>

                    </select>

                </div>

            </div>

        </div>

        <div class="clearfix"></div>

        <div style="margin: 15px 0 15px 0">

            <div class="col-md-2">

                <div class="form-group">

                    <label class="control-label" for="numeroaccion">Acción Formativa:</label>

                    <input value="'. $row[numeroaccion] .'/'. $row[ngrupo] . '" type="text" id="numeroaccion" name="numeroaccion" class="form-control" disabled/>

                </div>

            </div>

            <div class="col-md-6">

                <div class="form-group">

                    <label class="control-label" for="denominacion">Denominación Acción Formativa:</label>

                    <input value="'. $row[denominacion] .'" type="text" id="denominacion" name="denominacion" class="form-control" disabled />

                </div>

            </div>



            <div class="col-md-2">

                <div class="form-group">

                    <label class="control-label" for="fechaini">Fecha Inicio:</label>

                    <input value="'. $row[fechaini] .'" type="date" id="fechaini" name="fechaini" class="form-control" disabled />

                </div>

            </div>

            <div class="col-md-2">

                <div class="form-group">

                    <label class="control-label" for="fechafin">Fecha Fin:</label>

                    <input value="'. $row[fechafin] .'" type="date" id="fechafin" name="fechafin" class="form-control" disabled />

                </div>

            </div>

        </div>

        <div style="" class="clearfix"></div>

        <div style="margin: 15px 0 15px 0">

            <div class="col-md-2">

                <div class="form-group">

                    <label class="control-label" for="total_factura">Total:</label>

                    <input value="'. $row[total_factura] .'" type="text" id="total_factura" name="total_factura" class="form-control"  />

                </div>

            </div>

            <div class="col-md-2">

                <div class="form-group">

                    <label class="control-label" for="cobrado">Cobrado:</label>

                    <input value="'. $row[cobrado] . '" type="text" id="cobrado" name="cobrado" class="form-control" />

                </div>

            </div>

            <div class="col-md-2">

                <div class="form-group">

                    <label class="control-label" for="pendiente">Pendiente:</label>

                    <input value="'.$pendiente.'" type="text" id="pendiente" name="pendiente" class="form-control"  />

                </div>

            </div>';



            if ( $row[facturar_a] == 0 ) {



                echo '

                <div class="col-md-2">

                    <div class="form-group">

                        <label class="control-label" for="fecha_vencimiento">Fecha Vencimiento:</label>

                        <input value="'. $row[fecha_vencimiento] .'" type="date" id="fecha_vencimiento" name="vencimiento" class="form-control" disabled />

                    </div>

                </div>

                <div class="col-md-2">

                    <div class="form-group">

                        <label class="control-label" for="vencimiento">Vencimiento:</label>

                        <input value="'. $row[vencimiento] .'" type="text" id="vencimiento" name="vencimiento" class="form-control" />

                    </div>

                </div>';

                if ( $_SESSION['user'] != 'manolo' && strpos($_SESSION['user'], 'ext_') === FALSE ) { echo'

                    <div class="col-md-2">

                        <a id="guardardetallefactura" id_fac = "'.$idfac.'" id_emp = "'.$row[idemp].'" href="#" style="float:left;width: 100%; margin-top: 25px;" class="btn btn-success"> Actualizar</a>

                    </div>'; }



                }





                echo '

            </div>

            <div style="" class="clearfix"></div>';

            echo '<div class="col-md-12" style="margin-top:15px;">

            <div class="form-group">

                <label class="control-label" for="observacionesfra">Observaciones:</label>

                <textarea name="observacionesfra" id="observacionesfra" class="form-control" rows="2">'.$row[observacionesfra].'</textarea>

            </div>

        </div>';

        echo '<div class="clearfix"></div>';





        if ( $row[facturar_a] != 0 ) {



            $q4 = 'SELECT e.razonsocial as razonsocialfac, e.cif as ciffac, e.domiciliofiscal, e.domiciliosocial, e.codigopostal, e.poblacion, e.provincia, email_facturas, c.nombre, e.email, e.email_facturas, e.vencimiento, e.id as id_emp

            FROM empresas e, comerciales c

            WHERE e.comercial = c.id

            AND e.id = '.$row[facturar_a];

            // echo $q4;

            $q4 = mysqli_query($link, $q4);

            $r4 = mysqli_fetch_array($q4);



            $empresa = quitaTildesConComas($r4[razonsocialfac]);

            $nombreFichero = 'facturacion'.$gestion.'/facturas/'.$numerof.'_'.$empresa.'_'.$row[numeroaccion].'-'.$row[ngrupo].'.pdf';

            $nombreFicheroMail = 'facturas/'.$numerof.'_'.$empresa.'_'.$row[numeroaccion].'-'.$row[ngrupo].'.pdf';



            if ( $r4[email_facturas] == "" ) $email = $r4[email];

            else $email = $r4[email_facturas];



            echo '

            <h4 style="margin: 30px 0 -10px 15px">Facturado a:</h4>

            <hr>

            <div class="col-md-4">

                <div class="form-group">

                    <label class="control-label" for="razonsocialfac">Empresa:</label>

                    <input type="text" id="razonsocialfac" value="'.$r4[razonsocialfac].'" name="razonsocialfac" class="form-control" disabled/>

                </div>

            </div>

            <div class="col-md-2">

                <div class="form-group">

                    <label class="control-label" for="comercial">Comercial:</label>

                    <input type="text" id="comercial" value="'.$r4[nombre].'" name="comercial" class="form-control" disabled/>

                </div>

            </div>

            <div class="col-md-2">

                <div class="form-group">

                    <label class="control-label" for="vencimiento">Fecha Vencimiento:</label>

                    <input value="'. $row[fecha_vencimiento] .'" type="date" id="fecha_vencimientofaca" name="vencimiento" class="form-control" disabled />

                </div>

            </div>

            <div class="col-md-2">

                <div class="form-group">

                    <label class="control-label" for="vencimiento">Vencimiento:</label>

                    <input value="'. $r4[vencimiento] .'" type="text" id="vencimientofaca" name="vencimiento" class="form-control" />

                </div>

            </div>';



            if ( $_SESSION['user'] != 'manolo' && strpos($_SESSION['user'], 'ext_') === FALSE ) { echo '

                <div class="col-md-2">

                    <a id="actualizarvencimientofaca" id_fac = "'.$idfac.'" id_emp = "'.$r4[id_emp].'" target="_blank" href="#" style="float:left;width: 100%; margin-top: 25px;" class="btn btn-success"> Actualizar</a>

                </div>'; }

                echo '

                <div class="clearfix"></div>';





            }



            if ( $prefijo == 'R' ) {



                $qr = 'SELECT *

                FROM facturacion_rectificativa

                WHERE id = '.$idfac;

                $qr = mysqli_query($link, $qr);



                $rr = mysqli_fetch_array($qr);



                echo '

                <div style="margin: 15px 0 15px 0">

                    <div class="col-md-12">

                        <div class="form-group">

                            <label class="control-label" for="motivo">Motivo de la rectificación:</label>

                            <textarea disabled name="motivo" id="motivo" class="form-control" rows="3">'. $rr[motivo] .'</textarea>

                        </div>

                    </div>

                </div>



                <div style="" class="clearfix"></div>

                <div style="margin: 15px 0 15px 0">

                    <div class="col-md-5">

                        <div class="form-group">

                            <label class="control-label" for="email_facturas">Email Contabilidad:</label>

                            <input value="'. $email . '" type="text" id="email_facturas" name="email_facturas" class="form-control" />

                        </div>

                    </div>

                    <div class="col-md-2" style="margin-top: 25px">



                       <a id="emailfactura" id_fac="'.$idfac.'" tabla="'.$tabla.'" style="float:left; width: 100%; margin-top: 0px; display:none" class="btn btn-success"><span class="glyphicon glyphicon-envelope"></span> Enviar Factura</a>



                   </div>

                   <div class="col-md-3" style="margin-top: 25px">

                    <span id="compmailfac" style="float:left; margin-top: 10px; margin-left: 0px; display: none; color: '.$esta.';" class="glyphicon glyphicon-ok-circle"></span>

                    <span style="float:left; margin: 8px;"><strong>'.$fecha.'</strong></span>



                </div>

                <div class="col-md-2 pull-right" style="margin-top: 35px;">

                    <a id="verfactura" target="_blank" href="'.$baseurl.$nombreFichero.'" style="float:left;width: 100%; margin-top: 0px;" class="btn btn-success"><span class="glyphicon glyphicon-list-alt"></span> Ver Factura</a>

                </div>



            </div>

            <div class="clearfix"></div>';



        } else {

            echo '

            <div class="clearfix"></div>

            <div style="margin: 15px 0 15px 0">

                <div class="col-md-5">

                    <div class="form-group">

                        <label class="control-label" for="email_facturas">Email Contabilidad:</label>

                        <input value="'. $email . '" type="text" id="email_facturas" name="email_facturas" class="form-control" />

                    </div>

                </div>';



                if ( $_SESSION['user'] != 'manolo' && strpos($_SESSION['user'], 'ext_') === FALSE ) { echo '

                    <div class="col-md-2" style="margin-top: 25px">



                       <a id="emailfactura" id_fac="'.$idfac.'" tabla="'.$tabla.'" style="float:left; width: 100%; display: none; margin-top: 0px;" class="btn btn-success"><span class="glyphicon glyphicon-envelope"></span> Enviar Factura</a>



                   </div>'; }

                   echo '

                   <div class="col-md-3" style="margin-top: 25px">

                    <span id="compmailfac" style="float:left; margin-top: 10px; margin-left: 0px; display: none; color: '.$esta.';" class="glyphicon glyphicon-ok-circle"></span>

                    <span style="float:left; margin: 8px;"><strong>'.$fecha.'</strong></span>



                </div>



            </div>

            <div class="clearfix"></div>';







            echo '<div class="clearfix"></div>';



            if ( $_SESSION['user'] != 'manolo' && strpos($_SESSION['user'], 'ext_') === FALSE ) { echo '

                <div class="col-md-2" style="margin-top: 35px;">

                    <a id="anadirconciliar" id_fac="'.$idfac.'" tabla="'.$tabla.'" style="float:left;width: 100%; margin-top: 0px;" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Conciliar</a>

                </div>

                <div class="col-md-2" style="margin-top: 35px;">

                    <a id="anadirdevolucion" id_fac="'.$idfac.'" tabla="'.$tabla.'" style="float:left;width: 100%; margin-top: 0px;" class="btn btn-danger"><span class="glyphicon glyphicon-plus-sign"></span> Devolución</a>

                </div>'; }



                echo '

                <div class="col-md-2 pull-right" style="margin-top: 35px">

                    <a style="width:100%" id="informe" name="'.$row[idemp].'" class="btn btn-warning"><span class="glyphicon glyphicon-list-alt"></span> Empresa</a>

                </div>';

                if ( strpos($_SESSION['user'], 'ext_') === FALSE ) {

                    echo '<div class="col-md-2 pull-right" style="margin-top: 35px">

                    <a style="width:100%" id="mostrarpdffin" name="'.$row[idemp].'" class="btn btn-warning"><span class="glyphicon glyphicon-list-alt"></span> Finalización</a>

                </div>'; }

                echo '

                <div class="col-md-2 pull-right" style="margin-top: 35px;">

                    <a id="verfactura" target="_blank" href="'.$baseurl.$nombreFichero.'" style="float:left;width: 100%; margin-top: 0px;" class="btn btn-success"><span class="glyphicon glyphicon-list-alt"></span> Ver Factura</a>

                </div>



                <div style="" class="clearfix"></div>

                <div class="cuadroconciliar">

                    <hr>

                    <span id="marca_concilio"></span>';



                    if ( $prefijo != 'P' && $prefijo != 'R' ) $prefijo = 'B';

                    $idfac =$idfac-1;#parche 2025

                    if ( $prefijo == 'P') {$idfac =$idfac+1;}#parche 2025
                    
                    $q2 = 'SELECT c.*

                    FROM conciliaciones c

                    WHERE factura = '.$idfac.'

                    AND tipo = "'.$prefijo.'"

                    ORDER BY fecha DESC';

        // echo $q2;

                    $q2 = mysqli_query($link, $q2);

                    $sumacobrado = 0;

                    while ( $r = mysqli_fetch_array($q2) ) {

            // $sumacobrado += $r[cobrado];

                        echo '

                        <div style="overflow:auto; margin-bottom: 10px;">

                            <div class="col-md-2">

                                <div class="form-group">

                                    <label class="control-label" for="fechaconcilio">Fecha:</label>

                                    <input type="date" id="fechaconcilio'.$r[id].'" value="'.$r[fecha].'" name="fechaconcilio" class="form-control"/>

                                </div>

                            </div>

                            <div class="col-md-2">

                                <div class="form-group">

                                    <label class="control-label" for="cobradoconcilio">Cobrado:</label>

                                    <input value="'.$r[cobrado].'" type="text" id="cobradoconcilio'.$r[id].'" class="form-control"/>

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label class="control-label" for="observaciones">Observaciones:</label>

                                    <textarea name="observaciones" id="observaciones'.$r[id].'" class="form-control" rows="1">'.$r[observaciones].'</textarea>

                                </div>

                            </div>';



                            if ( $_SESSION['user'] != 'manolo' && strpos($_SESSION['user'], 'ext_') === FALSE ) { echo '

                                <div class="col-md-2" style="margin-top: 25px;">

                                    <a id="actualizarconciliar" id_fac="'.$idfac.'" id_concilio="'.$r[id].'" style="float:left;width: 100%; margin-top: 0px;" class="btn btn-success"> Guardar</a>

                                </div>'; }

                                echo '

                            </div>

                            <div style="" class="clearfix"></div>';



                        }



                        $q2 = 'SELECT c.*

                        FROM conciliaciones_devolu c

                        WHERE factura = '.$idfac.'

                        AND tipo = "'.$prefijo.'"

                        ORDER BY fecha DESC';

        // echo $q2;

                        $q2 = mysqli_query($link, $q2);

                        $sumacobrado = 0;

                        while ( $r = mysqli_fetch_array($q2) ) {

            // $sumacobrado += $r[cobrado];

                            echo '

                            <div style="overflow:auto; margin-bottom: 10px;">

                                <div class="col-md-2">

                                    <div class="form-group">

                                        <label class="control-label" for="fechaconcilio">Fecha:</label>

                                        <input type="date" id="fechadevolucion'.$r[id].'" value="'.$r[fecha].'" name="fechaconcilio" class="form-control"/>

                                    </div>

                                </div>

                                <div class="col-md-2">

                                    <div class="form-group">

                                        <label class="control-label" for="devolucionconcilio">Devolución:</label>

                                        <input value="'.$r[devolucion].'" type="text" id="devolucionconcilio'.$r[id].'" class="form-control"/>

                                    </div>

                                </div>

                                <div class="col-md-2">

                                    <div class="form-group">

                                        <label class="control-label" for="gastodevolucion">Gastos Devolución:</label>

                                        <input value="'.$r[gasto_devolucion].'" type="text" id="gastodevolucion'.$r[id].'" class="form-control"/>

                                    </div>

                                </div>

                                <div class="col-md-4">

                                    <div class="form-group">

                                        <label class="control-label" for="observaciones">Observaciones:</label>

                                        <textarea name="observaciones" id="observaciones'.$r[id].'" class="form-control" rows="1">'.$r[observaciones].'</textarea>

                                    </div>

                                </div>';

                                if ( $_SESSION['user'] != 'manolo' && strpos($_SESSION['user'], 'ext_') === FALSE ) { echo '

                                    <div class="col-md-2" style="margin-top: 25px;">

                                        <a id="actualizardevolucion" id_fac="'.$idfac.'" id_concilio="'.$r[id].'" style="float:left;width: 100%; margin-top: 0px;" class="btn btn-success"> Guardar</a>

                                    </div>'; }



                                    echo '

                                </div>

                                <div style="" class="clearfix"></div>';



                            }





                            echo '</div>

                            <div style="" class="clearfix"></div>';

                        }





                    }



                }





                function compruebaFactura($emp, $mat, $tipo, $facturaorig = NULL, $link) {



                    if ( $tipo == 'privado' ) $tabla = 'facturacion_privada';

                    else if ( $tipo == 'bonif' ) $tabla = 'facturacion_bonificada';

                    else {

                        $tabla = 'facturacion_rectificativa';

                        $rectificativa = ' AND factura_rectificada = '.$facturaorig;

                    }



                    $q = 'SELECT numero

                    FROM '.$tabla.'

                    WHERE empresa = '.$emp.'

                    AND matricula = '.$mat.$rectificativa;

    // echo $q;

                    $q = mysqli_query($link, $q);



                    if ( mysqli_num_rows($q) > 0 ) echo "existe";

                    else echo "no";



                }







        function facturarTodo($idmat, $link) {



                    $ids = explode(",", $idmat);

    // print_r($ids);

                    $resulhtml = "";

                    for ($i=0; $i < count($ids); $i++) {

                        $resulthtml .= devolverDatosMatriculaFac($ids[$i],$resulhtml, $link);

                    }

                    echo $resulhtml;





                }





    function devolverDatosMatriculaFacIKEA($id, $link ) {



        $q1 = 'SELECT DISTINCT ga.ngrupo, ga.id_accion, m.id, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, a.horastotales, a.modalidad, m.estado,

        m.horariomini, m.horariomfin, m.horariotini, m.horariotfin, m.diascheck, m.id as idmat, c.nombre, c.apellido, m.observacionesfin, m.tipofra, tipo_docente

        FROM acciones a, matriculas m, grupos_acciones ga, comerciales c, empresas e, mat_alu_cta_emp ma

        WHERE m.id_accion = a.id

        AND ma.id_empresa = e.id

        AND ma.id_matricula = m.id

        AND e.comercial = c.id

        AND m.id_grupo = ga.id

        AND m.id = '.$id.'

        LIMIT 0,1';



    // echo $q1;

    $q1 = mysqli_query($link,$q1) or die ("error select fra ikea:" . mysqli_error($link));

    $rows = array();

    while($r = mysqli_fetch_assoc($q1)) {

        $naccion = $r[numeroaccion];

        $ngrupo = $r[ngrupo];

        $observacionesfin = $r[observacionesfin];

        $formador = $r[formador];

        $tipofac = $r[tipofra];

        $tipodoc = $r[tipo_docente];



        if ( strpos($r[ngrupo], 'p') || $naccion >= 5000 )

            $tipofra = "Privado";

        else

            $tipofra = "Bonificado";



        // echo $tipofra;

        // if ( strpos($formador, 'ESFOCC') === false ) {

        //     $tipofra = 'gestion';

        //     $tabla = 'facturacion_privada';

        //     $prefijo = 'P';

        // } else {

        //     $tipofra = 'formacion';

        //     $tabla = 'facturacion_bonificada';

        //     $prefijo = '';

        // }

        if ( ($naccion == 83 && $ngrupo == 1) ) {
            $tipofra = "Privado";
        }


        $resulhtml.= '

        <input type="hidden" id="tipofra" value="'.$tipofra.'" disabled/>

        <div class="col-md-2 pull-right" style="margin-top: -55px; margin-bottom: -20px">

            <a id="mostrarpdffin" target="_blank" style="float:left;width: 100%; margin-top: 0px;" class="btn btn-warning"><span class="glyphicon glyphicon-list-alt"></span> Finalización</a>

        </div>

        <div class="clearfix"></div>



        <hr class="style-three">

        <div style="overflow:auto; margin-top: 50px">

            <input type="hidden" id="id_matricula" value="'.$r[idmat].'">

            <div class="col-md-2">

                <div class="form-group">

                    <label class="control-label" for="numeroaccion">AF:</label>

                    <input value="'. $r[numeroaccion] .'/'. $r[ngrupo] . '" type="text" id="numeroaccion" name="numeroaccion" class="form-control" readonly/>

                </div>

            </div>

            <div class="col-md-4">

                <div class="form-group">

                    <label class="control-label" for="denominacion">Denominación Acción Formativa:</label>

                    <input style="font-size: 12px" value="'. $r[denominacion] .'" type="text" id="denominacion" name="denominacion" class="form-control" readonly />

                </div>

            </div>



            <div class="col-md-2">

                <div class="form-group">

                    <label class="control-label" for="fechaini">Fecha Inicio:</label>

                    <input value="'. $r[fechaini] .'" type="date" id="fechaini" name="fechaini" class="form-control" />

                </div>

            </div>

            <div class="col-md-2">

                <div class="form-group">

                    <label class="control-label" for="fechafin">Fecha Fin:</label>

                    <input value="'. $r[fechafin] .'" type="date" id="fechafin" name="fechafin" class="form-control" />

                </div>

            </div>

            <div class="col-md-2">

                <div class="form-group">

                    <label class="control-label" for="comercial">Comercial:</label>

                    <input style="font-size: 12px" value="'. $r[nombre]. ' '.$r[apellido] .'" type="text" id="comercial" name="comercial" class="form-control" readonly />

                </div>

            </div>

        </div>

        <div style="margin-bottom:25px" class="clearfix"></div>';



    }

    // if ($naccion == 5024 && $ngrupo == '1p' || $naccion == 5002 && $ngrupo == '1p') $tipofra = "Privado";

    if ( $naccion >= 5000 && ($naccion != 5024 && $ngrupo != '1p') && ($naccion != 5002 && $ngrupo != '1p') ) {

        $q = 'SELECT DISTINCT @emp:=e.id, @mat:=mp.id_matricula, mp.id_matricula as id_mat, e.id as id_emp, factura, e.razonsocial, e.cif, e.formapago, mc.costes_imparticion, mc.igic, mp.id_matricula,e.vencimiento, @ncuenta:=mp.numerocuenta as cuentacot, (SELECT count(*) FROM mat_alu_cta_emp mp WHERE mp.id_empresa = @emp AND mp.numerocuenta=@ncuenta AND mp.id_matricula = @mat AND mp.finalizado = 1 ) as numalumnos, (SELECT count(*) FROM mat_alu_cta_emp mp WHERE mp.id_empresa = @emp AND mp.id_matricula = @mat AND mp.finalizado = 1 ) as numalumnostotal, mc.costes_indirectos,mc.costes_organizacion, mc.importe_a_bonificar

        FROM mat_alu_cta_emp mp, empresas e, mat_costes mc

        WHERE e.id = mp.id_empresa

        AND mp.id_empresa = mc.id_empresa

        AND mc.id_matricula = mp.id_matricula

        AND mp.finalizado = 1

        AND mp.tipo = ""

        AND mc.mes_bonificable <> ""

        AND mp.id_matricula = '.$id;



    } else if ( ($tipofra == "Privado")  ) {



        $q = 'SELECT DISTINCT @emp:=e.id, @mat:=mp.id_matricula, mp.id_matricula as id_mat, e.id as id_emp, factura, e.razonsocial, e.cif, e.formapago, mc.costes_imparticion, mc.igic, mp.id_matricula,e.vencimiento, @ncuenta:=mp.numerocuenta as cuentacot, (SELECT count(*) FROM mat_alu_cta_emp mp WHERE mp.id_empresa = @emp AND mp.numerocuenta=@ncuenta AND mp.id_matricula = @mat AND mp.finalizado = 1 ) as numalumnos, (SELECT count(*) FROM mat_alu_cta_emp mp WHERE mp.id_empresa = @emp AND mp.id_matricula = @mat AND mp.finalizado = 1 ) as numalumnostotal, mc.costes_indirectos,mc.costes_organizacion, mc.importe_a_bonificar

        FROM mat_alu_cta_emp mp, empresas e, mat_costes mc

        WHERE e.id = mp.id_empresa

        AND mp.id_empresa = mc.id_empresa

        AND mc.id_matricula = mp.id_matricula

        AND mp.finalizado = 1

        AND mp.tipo = "Privado"

        AND mp.id_matricula = '.$id;



    } else {



        $q = 'SELECT DISTINCT @emp:=e.id, @mat:=mp.id_matricula, mp.id_matricula as id_mat, e.id as id_emp, factura, e.razonsocial, e.cif, e.formapago, mc.costes_imparticion, mc.igic, mp.id_matricula,e.vencimiento, @ncuenta:=mp.numerocuenta as cuentacot, (SELECT count(*) FROM mat_alu_cta_emp mp WHERE mp.id_empresa = @emp AND mp.numerocuenta=@ncuenta AND mp.id_matricula = @mat AND mp.finalizado = 1 ) as numalumnos, (SELECT count(*) FROM mat_alu_cta_emp mp WHERE mp.id_empresa = @emp AND mp.id_matricula = @mat AND mp.finalizado = 1 ) as numalumnostotal, mc.costes_indirectos,mc.costes_organizacion, mc.importe_a_bonificar

        FROM mat_alu_cta_emp mp, empresas e, mat_costes mc

        WHERE e.id = mp.id_empresa

        AND mp.id_empresa = mc.id_empresa

        AND mc.id_matricula = mp.id_matricula

        AND mp.finalizado = 1

        AND mp.tipo = ""

        AND mc.mes_bonificable <> ""

        AND mp.id_matricula = '.$id;



    }





    // if ( isRoot() ) echo $q;

    $q = mysqli_query($link, $q) or die("error fieldset ");



    if ( mysqli_num_rows($q) > 0 )

        $resulhtml .= '<fieldset style="margin-top: -15px"><legend>'.$tipofra.'</legend>';





    $prefijo = '';

    $q1 = 'SELECT MAX(numero) as numero FROM '.$tabla.' LIMIT 0,1';

    $q1 = mysqli_query($link, $q1);

    $row = mysqli_fetch_array($q1);

    $numerobonif = $row[numero]+1;

    // $numerobonif1 = $prefijo.$numerobonif;





    $z = 0;

    while($r = mysqli_fetch_assoc($q)) {


        // echo "ee";
        // $z++;



        $qc = 'SELECT id,numero, total_factura, costes_organizacion, costes_indirectos, prefijo, fecha

        FROM facturacion_bonificada

        WHERE matricula = '.$r[id_mat].'

        AND empresa = '.$r[id_emp].'

        AND cuentacotizacion = "'.$r[cuentacot].'"

        UNION

        SELECT id,numero, total_factura, costes_organizacion, costes_indirectos, prefijo, fecha

        FROM facturacion_privada

        WHERE matricula = '.$r[id_mat].'

        AND empresa = '.$r[id_emp].'

        AND cuentacotizacion = "'.$r[cuentacot].'"';

        // if ( isRoot() ) echo $qc;

        $qc = mysqli_query($link, $qc) or die("error cuenta cot:" .mysqli_error($link));





        if ( mysqli_num_rows($qc) ) {



            $rowc = mysqli_fetch_array($qc);



            $fechafra = $rowc[fecha];

            $esta = ' green ';

            $numerobonif = $rowc[prefijo].$rowc[numero];



            $empresa = quitaTildesConComas($r[razonsocial]);

            $nombreFichero = 'facturacion'.$gestion.'/facturas/'.$numerobonif.'_'.$empresa.'_'.$naccion.'-'.$ngrupo.'.pdf';

            $total_factura = $rowc[total_factura];

            $disabled = 'disabled';

            $idfac = $rowc[id];



            if ( $rowc[prefijo] == 'P' )

                $tabla = 'facturacion_privada';

            else

                $tabla = 'facturacion_bonificada';



        } else {

            $esta = 'red';

            $numerobonif++;

            $fechafra = date('Y-m-d');

        }


        // $esta = 'red';
        // if ( $r[factura] != 0 ) {



        //     $q1 = 'SELECT id, numero, prefijo, total_factura, observaciones

        //     FROM '.$tabla.'

        //     WHERE id = '.$r[factura].'

        //     AND estado <> "Rectificada"';

        //     $q1 = mysqli_query($link, $q1);



        //     $row = mysqli_fetch_array($q1);



        //     $prefijo = $row[prefijo];

        //     if ( $prefijo == 'R') $rectificativa = ' rectificativa '; else $rectificativa = ' ';

        //     $idfac = $row[id];

        //     $numerobonif = $row[numero];



        //     $observaciones = $row[observaciones];

        //     $numerof = $prefijo.$numerobonif;

        //     $empresa = quitaTildesConComas($r[razonsocial]);

        //     $nombreFichero = 'facturacion'.$gestion.'/facturas/'.$numerof.'_'.$empresa.'_'.$naccion.'-'.$ngrupo.'.pdf';



        //     // $titulo = 'Factura'.$rectificativa.'acción formativa '.$r[numeroaccion].'/'.$row[ngrupo].' - '.$r[razonsocial].' - '.$row[modalidad];

        //     $total_factura = $row[total_factura];

        //     $esta = 'green';

        //     $disabled = 'disabled';



        // } else {

            // $esta = 'red';

            // $numerobonif++;



        // }



        $costeporalu = $r[costes_imparticion]/$r[numalumnostotal];

      // echo $r[costes_organizacion];

        $costeindporalu = round(($r[costes_indirectos]/$r[numalumnostotal])*$r[numalumnos],2);

        $costegestporalu = round(($r[costes_organizacion]/$r[numalumnostotal])*$r[numalumnos],2);

        $importebonif = round(($r[importe_a_bonificar]/$r[numalumnostotal])*$r[numalumnos],2);
      // echo "importe a bonif : ".$importebonif."<br>";


        if ( $r['igic'] != "" && $r['igic'] != 0 ) {
            $igic = round(($r['igic']/$r['numalumnostotal'])*$r['numalumnos'],2);
        }


        $resulhtml .= '<div style="overflow:auto; margin-bottom:-30px">';



        if ( $esta == 'green' ) {



            $resulhtml .=

            '<div class="col-md-2">

            <div class="form-group">

                <label class="control-label" for="numero">Nº Factura:</label>

                <div class="input-group">

                    <span class="input-group-addon">'.$prefijo.'</span>

                    <input type="text" value="'.$numerobonif.'" id="numero'.$r[cuentacot].'" name="numero" class="form-control" readonly />

                </div>

            </div>

        </div>';



    }



    $resulhtml .=

    '<div class="col-md-4">

    <input id="id" type="hidden" value="'.$r[id].'">

    <div class="form-group">

        <label class="control-label" for="razonsocial">Empresa:</label>

        <input type="text" value="'.$r[razonsocial].'" id="razonsocial" name="razonsocial" class="form-control" disabled />

    </div>

</div>

<div class="col-md-2">

    <div class="form-group">

        <label class="control-label" for="cif">CIF:</label>

        <input type="text" value='.$r[cif].' id="cif" name="cif" class="form-control" disabled />

    </div>

</div>

<div class="col-md-2">

    <div class="form-group">

        <label class="control-label" for="cuentacotizacion">Cuenta Cotización:</label>

        <input type="text" disabled value="'.$r[cuentacot].'" id="cuentacotizacion'.$r[cuentacot].'" name="cuentacotizacion" class="form-control" />

    </div>

</div>

<div class="col-md-2">

    <div class="form-group">

        <label class="control-label" for="costes_imparticion">Costes Impartición:</label>

        <input type="text" value='.$r[costes_imparticion].' id="costes_imparticion'.$r[cuentacot].'" name="costes_imparticion" class="form-control" disabled />

    </div>

</div>

<div class="col-md-2">

    <div class="form-group">

        <label class="control-label" for="importe_factura">Importe a facturar:</label>';

                            // echo $tipofac;

        if ( $esta == 'green' ) {

                                // echo "aqui1";
            $resulhtml.= '<input type="text" value="'.$total_factura.'" id="importe_factura'.$r[cuentacot].'" name="importe_factura" class="form-control" />';

        } else {



            if ( $r[cuentacot] == $cuentacot_ant && $z != 1 ) {


                $resulhtml.= '<input type="text" value="'.$r[costes_imparticion].'" id="importe_factura'.$r[cuentacot].'" name="importe_factura" class="form-control" />';

                                    // echo "ee";
                                    // $igic = $row['igic'];

            } else {

                $z = 0;



                if ( $tipofac == 'Gestionpre' )

                    $resulhtml.= '<input type="text" alut="'.$r[numalumnostotal].'" alue="'.$r[numalumnos].'" value="'.round($costeporalu*$r[numalumnos]*0.05,2).'" id="importe_factura'.$r[cuentacot].'" name="importe_factura" class="form-control" />';

                else if ( $tipofac == 'Gestionpost' ) {

                    $resulhtml.= '<input type="text" value="'.round($costeporalu*$r[numalumnos],2).'" id="importe_factura'.$r[cuentacot].'" name="importe_factura" class="form-control" />';

                                        // $igic = round($igic*$r[numalumnos],2);

                } else if ( $tipofac == 'Costesind' )

                $resulhtml.= '<input type="text" value="'.$r[costes_indirectos].'" id="importe_factura'.$r[cuentacot].'" name="importe_factura" class="form-control" />';

                else {

                                        // echo "entra aki";
                    $resulhtml.= '<input type="text" value="'.round(($costeporalu*$r[numalumnos])+$costeindporalu+$costegestporalu,2).'" id="importe_factura'.$r[cuentacot].'" name="importe_factura" class="form-control" />';

                    $importeabonif = round(($importebonif*$r[numalumnos]),2);

                                        // echo "yy";

                                        // $resulhtml.= '<input type="text" value="'.round(($importebonif*$r[numalumnos]),2).'" id="importe_a_bonificar'.$r[cuentacot].'" name="importe_a_bonificar" class="form-control" />';

                }

            }

        }



        $resulhtml.= '</div>

    </div>

    <div class="col-md-2">

        <div class="form-group">

            <label class="control-label" for="fecha_factura">Fecha de Factura:</label>

            <input value="'. $fechafra .'" type="date" id="fecha_factura'.$r[cuentacot].'" name="fecha_factura" class="form-control" />

        </div>

    </div>

    <div class="col-md-2">

        <div class="form-group">

            <label class="control-label" for="importe_a_bonificar">Importe a Bonificar:</label>

            <input type="text" value='.$importebonif.' id="importe_a_bonificar'.$r[cuentacot].'" name="importe_a_bonificar" class="form-control"  />

        </div>

    </div>

    <div class="col-md-2">

        <div class="form-group">

            <label class="control-label" for="vencimiento">Vencimiento:</label>

            <input type="text" value='.$r[vencimiento].' id="vencimiento'.$r[cuentacot].'" name="vencimiento" class="form-control" />

        </div>

    </div>

    <div class="col-md-2">

        <div class="form-group">

            <label class="control-label" for="anticipo">Anticipo:</label>

            <input type="text" value="" id="anticipo'.$r[cuentacot].'" name="anticipo" class="form-control" />

        </div>

    </div>';





    $resulhtml .= '

    <div class="col-md-2">

        <div class="form-group">

            <label class="control-label" for="formapago">Forma de Pago:</label>

            <select id="formapago'.$r[cuentacot].'" name="formapago" class="form-control">';

                if ($r[formapago] == "Transferencia")

                    $resulhtml.= '<option selected value="Transferencia">Transferencia</option>';

                else

                    $resulhtml.= '<option value="Transferencia">Transferencia</option>';



                if ($r[formapago] == "Cheque")

                    $resulhtml .= '<option selected value="Cheque">Cheque</option>';

                else

                    $resulhtml .= '<option value="Cheque">Cheque</option>';

                if ($r[formapago] == "Remesa")

                    $resulhtml .= '<option selected value="Remesa">Remesa</option>';

                else

                    $resulhtml .= '<option value="Remesa">Remesa</option>';

                if ($r[formapago] == "Efectivo")

                    $resulhtml.= '<option selected value="Efectivo">Efectivo</option>';

                else

                    $resulhtml.= '<option value="Efectivo">Efectivo</option>';

                if ($r[formapago] == "Domiciliación")

                    $resulhtml.= '<option selected value="Domciliación">Domciliación</option>';

                else

                    $resulhtml.= '<option value="Domciliación">Domciliación</option>';

                $resulhtml.='</select>

            </div>

        </div>

        <div class="col-md-2">

            <div class="form-group">

                <label class="control-label" for="numalumnos">Nº Alumnos:</label>

                <input type="text" disabled value="'.$r[numalumnos].'" id="numalumnos'.$r[cuentacot].'" name="numalumnos" class="form-control" />

            </div>

        </div>

        <div class="col-md-2" style="">

            <div class="form-group">

                <label class="control-label" for="tipofac">Tipo Factura:</label>

                <select id="tipofac" name="tipofac" class="form-control" readonly>';

                    if ($tipofac == "Formacion")

                        $resulhtml.= '<option selected value="Formacion">Formación</option>';

                    else

                        $resulhtml.= '<option value="Formacion">Formación</option>';



                    if ($tipofac == "Gestionpre")

                        $resulhtml .= '<option selected value="Gestionpre">Gestión Pre RD</option>';

                    else

                        $resulhtml .= '<option value="Gestionpre">Gestión Pre RD</option>';

                    if ($tipofac == "Gestionpost")

                        $resulhtml .= '<option selected value="Gestionpost">Gestión Post RD</option>';

                    else

                        $resulhtml .= '<option value="Gestionpost">Gestión Post RD</option>';

                    if ($tipofac == "Costesind")

                        $resulhtml .= '<option selected value="Costesind">Costes Indirectos</option>';

                    else

                        $resulhtml .= '<option value="Costesind">Costes Indirectos</option>';

                    $resulhtml.='</select>

                </div>

            </div>

            <div class="clearfix"></div>

            <div class="col-md-12">

                <div class="form-group">

                    <label class="control-label" for="observaciones">Observaciones para la factura:</label>

                    <textarea name="observaciones" id="observaciones'.$r[cuentacot].'" class="form-control" rows="2">'.$observaciones.'</textarea>

                </div>

            </div>

            <div class="col-md-2">

                <div class="form-group">

                    <label class="control-label" for="costes_indirectos">Costes Indirectos:</label>

                    <input type="text" value="'.$costeindporalu.'" id="costes_indirectos'.$r[cuentacot].'" name="costes_indirectos" class="form-control" />

                </div>

            </div>

            <div class="col-md-2">

                <div class="form-group">

                    <label class="control-label" for="costes_organizacion">Costes Gestión:</label>

                    <input type="text" value="'.$costegestporalu.'" id="costes_organizacion'.$r[cuentacot].'" name="costes_organizacion" class="form-control" />

                </div>

            </div>';


            if ( $igic != "" && $igic != 0 ) {

                $resulhtml.='
                <div class="col-md-2">

                    <div class="form-group">

                        <label class="control-label" for="igic">IGIC:</label>

                        <input type="text" value="'.$igic.'" id="igic'.$r[cuentacot].'" name="igic" class="form-control" />

                    </div>

                </div>';


            }


            $resulhtml .= '<div class="clearfix"></div>';


            if ( $observacionesfin != "" && $observacionesfin != "undefined" ) {

               $resulhtml .= '<div class="col-md-12">

               <div class="form-group">

                <label class="control-label" for="observacionesfin">Observaciones de finalización:</label>

                <textarea disabled name="observacionesfin" id="observacionesfin" class="form-control" rows="2">'.$observacionesfin.'</textarea>

            </div>

        </div>

        <div class="clearfix"></div>'; }



        if ( $esta == 'red' ) {



            $resulhtml.= '

            <div style="display:none" class="col-md-2" id="huecoDetalle'.$r[cuentacot].'"></div>

            <div class="col-md-3">

               <a id="previsualizarfacturaikea'.$r[cuentacot].'" empresa="'.$r[id_emp].'" emp="'.$r[cuentacot].'" mat="'.$r[id_matricula].'" style="width: 100%; margin-top: 0px;" class="btn btn-warning"><span class="glyphicon glyphicon-list-alt"></span> Previsualizar Factura</a>

           </div>

           <div class="col-md-2">

               <a id="generarfacturaikea" empresa="'.$r[id_emp].'" emp="'.$r[cuentacot].'" mat="'.$r[id_matricula].'" style="float:left;width: 100%; margin-top: 0px;" class="btn btn-success"><span class="glyphicon glyphicon-list-alt"></span> Generar Factura</a>

           </div>

           <div class="col-md-2">

              <a id="modificarfacturaikea" idfac="'.$idfac.'" empresa="'.$r[id_emp].'" emp="'.$r[cuentacot].'" mat="'.$r[id_matricula].'" style="float:left;width: 100%; margin-top: 0px;" class="btn btn-success"><span class="glyphicon glyphicon-list-alt"></span> Modificar Factura</a>

          </div>';


      } else {



        $resulhtml.= '

        <div class="col-md-2">

            <a style="width:100%" style="display:none" id="detalleFacturaFac" tabla="'.$tabla.'" idfac="'.$idfac.'" class="btn btn-primary"><span class="glyphicon glyphicon-list-alt"></span> Detalle</a>

        </div>

        <div class="col-md-2">

           <a id="verfactura" style="display:none" target="_blank" href="'.$baseurl.$nombreFichero.'" style="'.$css.' float:left;width: 100%; margin-top: 0px;" class="btn btn-success"><span class="glyphicon glyphicon-list-alt"></span> Ver Factura</a>

       </div>

       <div class="col-md-2">

          <a id="modificarfacturaikea" idfac="'.$idfac.'" empresa="'.$r[id_emp].'" emp="'.$r[cuentacot].'" mat="'.$r[id_matricula].'" style="float:left;width: 100%; margin-top: 0px;" class="btn btn-success"><span class="glyphicon glyphicon-list-alt"></span> Modificar Factura</a>

      </div>';



  }



  $resulhtml.= '

  <div class="col-md-1">

      <span id="compmailfac'.$r[cuentacot].'" style="float:left; margin-top: 10px; margin-left: -20px; color: '.$esta.';" class="glyphicon glyphicon-ok-circle"></span>

  </div>

</div>

<div style="margin-bottom:0px" class="clearfix"></div>';

$cuentacot_ant = $r[cuentacot];



}

$resulhtml .= '</fieldset>';

echo $resulhtml;





}





function devolverDatosMatriculaFac($id, $resulhtml=NULL, $link) {



    // datos de la accion - matricula: tabla: matriculas

    $q1 = 'SELECT DISTINCT ga.ngrupo, ga.id_accion, m.id, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, a.horastotales, a.modalidad, m.estado,

    m.horariomini, m.horariomfin, m.horariotini, m.horariotfin, m.diascheck, m.id as idmat, c.nombre, c.apellido, m.observacionesfin

    FROM acciones a, matriculas m, grupos_acciones ga, comerciales c, empresas e, mat_alu_cta_emp ma

    WHERE m.id_accion = a.id

    AND ma.id_empresa = e.id

    AND ma.id_matricula = m.id

    AND e.comercial = c.id

    AND m.id_grupo = ga.id

    AND m.id = '.$id.'

    LIMIT 0,1';



    // echo $q1;

    $q1 = mysqli_query($link,$q1) or die("error select: " . mysqli_error($link));

    $rows = array();

    while($r = mysqli_fetch_assoc($q1)) {

        $naccion = $r[numeroaccion];

        $ngrupo = $r[ngrupo];

        $observacionesfin = $r[observacionesfin];



        $resulhtml.= '

        <div class="col-md-2 pull-right" style="margin-top: -55px; margin-bottom: -20px">

            <a id="mostrarpdffin" target="_blank" style="float:left;width: 100%; margin-top: 0px;" class="btn btn-warning"><span class="glyphicon glyphicon-list-alt"></span> Finalización</a>

        </div>

        <div class="clearfix"></div>



        <hr class="style-three">

        <div style="overflow:auto; margin-top: 50px">

            <input type="hidden" id="id_matricula" value="'.$r[idmat].'">

            <div class="col-md-2">

                <div class="form-group">

                    <label class="control-label" for="numeroaccion">AF:</label>

                    <input value="'. $r[numeroaccion] .'/'. $r[ngrupo] . '" type="text" id="numeroaccion" name="numeroaccion" class="form-control" readonly/>

                </div>

            </div>

            <div class="col-md-4">

                <div class="form-group">

                    <label class="control-label" for="denominacion">Denominación Acción Formativa:</label>

                    <input style="font-size: 12px" value="'. $r[denominacion] .'" type="text" id="denominacion" name="denominacion" class="form-control" readonly />

                </div>

            </div>



            <div class="col-md-2">

                <div class="form-group">

                    <label class="control-label" for="fechaini">Fecha Inicio:</label>

                    <input value="'. $r[fechaini] .'" type="date" id="fechaini" name="fechaini" class="form-control" />

                </div>

            </div>

            <div class="col-md-2">

                <div class="form-group">

                    <label class="control-label" for="fechafin">Fecha Fin:</label>

                    <input value="'. $r[fechafin] .'" type="date" id="fechafin" name="fechafin" class="form-control" />

                </div>

            </div>

            <div class="col-md-2">

                <div class="form-group">

                    <label class="control-label" for="comercial">Comercial:</label>

                    <input style="font-size: 12px" value="'. $r[nombre]. ' '.$r[apellido] .'" type="text" id="comercial" name="comercial" class="form-control" readonly />

                </div>

            </div>

        </div>

        <div style="margin-bottom:25px" class="clearfix"></div>';



    }



    $q = 'SELECT DISTINCT e.id as id_emp, factura, e.razonsocial, e.cif, e.formapago, mc.costes_imparticion, mp.id_matricula,e.vencimiento,mc.costes_indirectos,mc.costes_organizacion,mc.igic

    FROM mat_alu_cta_emp mp, empresas e, mat_costes mc

    WHERE e.id = mp.id_empresa

    AND mp.id_empresa = mc.id_empresa

    AND mc.id_matricula = mp.id_matricula

    AND mp.tipo = ""

    AND mc.mes_bonificable <> ""

    AND mp.id_matricula = '.$id;

     // echo $q;

    $q = mysqli_query($link, $q) or die("error empresa/costes ". mysqli_error($link));



    if ( mysqli_num_rows($q) > 0 )

        $resulhtml .= '<fieldset style="margin-top: -15px"><legend>Bonificado</legend>';





    $prefijo = '';

    $q1 = 'SELECT MAX(numero) as numero FROM facturacion_bonificada LIMIT 0,1';

    $q1 = mysqli_query($link, $q1);

    $row = mysqli_fetch_array($q1);

    $numerobonif = $row[numero]+1;

    // $numerobonif1 = $prefijo.$numerobonif;



    while($r = mysqli_fetch_assoc($q)) {


        if ( $r['igic'] != "" && $r['igic'] != 0 ) {
            $igic = round($r['igic'],2);
        } else {
            $igic = 0;
        }

        $total_factura = $r[costes_imparticion]+$r[costes_organizacion]+$r[costes_indirectos]+$igic;


        // if ( $r['igic'] != "" && $r['igic'] != 0 ) {
        //     $igic = round(($r['igic']/$r['numalumnostotal'])*$r['numalumnos'],2);
        // }

        // if ( $r[factura] != 0 ) {



        //     $q1 = 'SELECT id, numero, prefijo, total_factura, observaciones

        //     FROM facturacion_bonificada

        //     WHERE id = '.$r[factura].'

        //     AND estado <> "Rectificada"';

        //     $q1 = mysqli_query($link, $q1);



        // if ( mysqli_num_rows($q1) > 0 ) {



        //     $row = mysqli_fetch_array($q1);



        //     $prefijo = $row[prefijo];

        //     if ( $prefijo == 'R') $rectificativa = ' rectificativa '; else $rectificativa = ' ';

        //     $idfac = $row[id];

        //     $numerobonif = $row[numero];



        //     $observaciones = $row[observaciones];

        //     $numerof = $prefijo.$numerobonif;

        //     $empresa = quitaTildesConComas($r[razonsocial]);

        //     $nombreFichero = 'facturacion'.$gestion.'/facturas/'.$numerof.'_'.$empresa.'_'.$naccion.'-'.$ngrupo.'.pdf';



        //     // $titulo = 'Factura'.$rectificativa.'acción formativa '.$r[numeroaccion].'/'.$row[ngrupo].' - '.$r[razonsocial].' - '.$row[modalidad];

        //     $total_factura = $row[total_factura];

        //     $esta = 'green';

        //     $disabled = 'disabled';



        // } else {

        //     $esta = 'red';

        //     $numerobonif++;



        // }





        // COMPROBACION EXTRA PARA LA SQUE VIENEN DEL EXCEL



        $q5 = 'SELECT numero,id, fecha

        FROM facturacion_bonificada

        WHERE empresa = '.$r[id_emp].'

        AND matricula = '.$id.'

        AND estado <> "Rectificada"';

        $q5 = mysqli_query($link, $q5);



        if ( mysqli_num_rows($q5) > 0 ) {



            $r5 = mysqli_fetch_array($q5);

            $esta = 'green';

            $numero = $r5[numero];

            $idfac = $r5[id];

            $fechafra = $r5[fecha];

            // if ( $r[factura] == 0) {

            $css = ' background-color: #ccc; pointer-events: none; border-color: #ccc; ';

            $nombreFichero = '#';



            // }



        } else { $esta = 'red'; }







        $resulhtml .= '<div style="overflow:auto; margin-bottom:-30px">';



        if ( $esta == 'green' ) {



            $resulhtml .=

            '<div class="col-md-2">

            <div class="form-group">

                <label class="control-label" for="numero">Nº Factura:</label>

                <div class="input-group">

                    <span class="input-group-addon"></span>

                    <input type="text" value="'.$numero.'" id="numero'.$r[id_emp].'" name="numero" class="form-control" readonly />

                </div>

            </div>

        </div>';



    }



    $resulhtml .=

    '<div class="col-md-4">

    <input id="id" type="hidden" value="'.$r[id].'">

    <div class="form-group">

        <label class="control-label" for="razonsocial">Empresa:</label>

        <input type="text" value="'.$r[razonsocial].'" id="razonsocial" name="razonsocial" class="form-control" disabled />

    </div>

</div>

<div class="col-md-2">

    <div class="form-group">

        <label class="control-label" for="cif">CIF:</label>

        <input type="text" value='.$r[cif].' id="cif" name="cif" class="form-control" disabled />

    </div>

</div>

<div class="col-md-2">

    <div class="form-group">

        <label class="control-label" for="costes_imparticion">Costes Impartición:</label>

        <input type="text" value='.$r[costes_imparticion].' id="costes_imparticion'.$r[id_emp].'" name="costes_imparticion" class="form-control" readonly />

    </div>

</div>

<div class="col-md-2">

    <div class="form-group">

        <label class="control-label" for="importe_factura">Importe a facturar:</label>';

        $resulhtml.= '<input type="text" value="'.$total_factura.'" id="importe_factura'.$r[id_emp].'" name="importe_factura" class="form-control" />';



        $resulhtml.= '</div>

    </div>';



    if ( $esta == 'green' ) {

        $resulhtml .= '

        <div class="col-md-2">

            <div class="form-group">

                <label class="control-label" for="fecha_factura">Fecha de Factura:</label>

                <input value="'. ($fechafra) .'" type="date" id="fecha_factura'.$r[id_emp].'" name="fecha_factura" class="form-control" />

            </div>

        </div>';

    } else {

        $resulhtml .= '

        <div class="col-md-2">

            <div class="form-group">

                <label class="control-label" for="fecha_factura">Fecha de Factura:</label>

                <input value="'. date('Y-m-d') .'" type="date" id="fecha_factura'.$r[id_emp].'" name="fecha_factura" class="form-control" />

            </div>

        </div>'; }

        $resulhtml .= '

        <div class="col-md-2">

            <div class="form-group">

                <label class="control-label" for="vencimiento">Vencimiento:</label>

                <input type="text" value='.$r[vencimiento].' id="vencimiento'.$r[id_emp].'" name="vencimiento" class="form-control" />

            </div>

        </div>

        <div class="col-md-2">

            <div class="form-group">

                <label class="control-label" for="anticipo">Anticipo:</label>

                <input type="text" value="" id="anticipo'.$r[id_emp].'" name="anticipo" class="form-control" />

            </div>

        </div>

        <div class="col-md-2">

            <div class="form-group">

                <label class="control-label" for="impuesto">Impuestos:</label>

                <input type="text" value="" id="impuesto'.$r[id_emp].'" name="impuesto" class="form-control" />

            </div>

        </div>

        <div class="col-md-2">

            <div class="form-group">

                <label class="control-label" for="otro">Otros:</label>

                <input type="text" value="" id="otro'.$r[id_emp].'" name="otro" class="form-control" />

            </div>

        </div>

        <div class="col-md-2">

            <div class="form-group">

                <label class="control-label" for="formapago">Forma de Pago:</label>

                <select id="formapago'.$r[id_emp].'" name="formapago" class="form-control">';

                    if ($r[formapago] == "Transferencia")

                        $resulhtml.= '<option selected value="Transferencia">Transferencia</option>';

                    else

                        $resulhtml.= '<option value="Transferencia">Transferencia</option>';



                    if ($r[formapago] == "Cheque")

                        $resulhtml .= '<option selected value="Cheque">Cheque</option>';

                    else

                        $resulhtml .= '<option value="Cheque">Cheque</option>';

                    if ($r[formapago] == "Remesa")

                        $resulhtml .= '<option selected value="Remesa">Remesa</option>';

                    else

                        $resulhtml .= '<option value="Remesa">Remesa</option>';

                    if ($r[formapago] == "Efectivo")

                        $resulhtml.= '<option selected value="Efectivo">Efectivo</option>';

                    else

                        $resulhtml.= '<option value="Efectivo">Efectivo</option>';

                    if ($r[formapago] == "Domciliación")

                        $resulhtml.= '<option selected value="Domciliación">Domciliación</option>';

                    else

                        $resulhtml.= '<option value="Domciliación">Domciliación</option>';

                    $resulhtml.='</select>

                </div>

            </div>



            <div class="clearfix"></div>



            <div class="col-md-2">

                <div class="form-group">

                    <label class="control-label" for="costes_indirectos">Costes Indirectos:</label>

                    <input type="text" value="'.$r[costes_indirectos].'" id="costes_indirectos'.$r[id_emp].'" name="costes_indirectos" class="form-control" />

                </div>

            </div>

            <div class="col-md-2">

                <div class="form-group">

                    <label class="control-label" for="costes_organizacion">Costes Gestión:</label>

                    <input type="text" value="'.$r[costes_organizacion].'" id="costes_organizacion'.$r[id_emp].'" name="costes_organizacion" class="form-control" />

                </div>

            </div>

            <div class="col-md-2">

                <div class="form-group">

                    <label class="control-label" for="igic">IGIC:</label>

                    <input type="text" value="'.$igic.'" id="igic'.$r[id_emp].'" name="igic" class="form-control" />

                </div>

            </div>



            <div class="clearfix"></div>

            <div class="col-md-12">

                <div class="form-group">

                    <label class="control-label" for="observaciones">Observaciones para la factura:</label>

                    <textarea name="observaciones" id="observaciones'.$r[id_emp].'" class="form-control" rows="2">'.$observaciones.'</textarea>

                </div>

            </div>';



            if ( $observacionesfin != "" && $observacionesfin != "undefined" ) {

               $resulhtml .= '<div class="col-md-12">

               <div class="form-group">

                <label class="control-label" for="observacionesfin">Observaciones de finalización:</label>

                <textarea disabled name="observacionesfin" id="observacionesfin" class="form-control" rows="2">'.$observacionesfin.'</textarea>

            </div>

        </div>

        <div class="clearfix"></div>'; }



        if ( $esta == 'red' ) {



            $resulhtml.= '

            <div style="display:none" class="col-md-2" id="huecoDetalle'.$r[id_emp].'"></div>

            <div class="col-md-3">

               <a id="previsualizarfactura'.$r[id_emp].'" emp="'.$r[id_emp].'" mat="'.$r[id_matricula].'" style="width: 100%; margin-top: 0px;" class="btn btn-warning"><span class="glyphicon glyphicon-list-alt"></span> Previsualizar Factura</a>

           </div>

           <div class="col-md-2">

               <a id="generarfactura" emp="'.$r[id_emp].'" mat="'.$r[id_matricula].'" style="float:left;width: 100%; margin-top: 0px;" class="btn btn-success"><span class="glyphicon glyphicon-list-alt"></span> Generar Factura</a>

           </div>';



       } else {



        $resulhtml.= '

        <div class="col-md-2">

            <a style="width:100%" id="detalleFacturaFac" tabla="facturacion_bonificada" idfac="'.$idfac.'" class="btn btn-primary"><span class="glyphicon glyphicon-list-alt"></span> Detalle</a>

        </div>

        <div class="col-md-2">

           <a id="verfactura" target="_blank" href="'.$baseurl.$nombreFichero.'" style="'.$css.' float:left;width: 100%; margin-top: 0px;" class="btn btn-success"><span class="glyphicon glyphicon-list-alt"></span> Ver Factura</a>

       </div>

       <div class="col-md-2">

           <a id="modificarfactura" idfac="'.$idfac.'" emp="'.$r[id_emp].'" mat="'.$r[id_matricula].'" style="float:left;width: 100%; margin-top: 0px;" class="btn btn-success"><span class="glyphicon glyphicon-list-alt"></span> Modificar Factura</a>

       </div>';

   }



   $resulhtml.= '

   <div class="col-md-1">

      <span id="compmailfac'.$r[id_emp].'" style="float:left; margin-top: 10px; margin-left: -20px; color: '.$esta.';" class="glyphicon glyphicon-ok-circle"></span>

  </div>

</div>

<div style="margin-bottom:0px" class="clearfix"></div>';



}

$resulhtml .= '</fieldset>';



$q = 'SELECT DISTINCT e.id as id_emp, factura, e.razonsocial, e.cif, e.formapago, mc.costes_imparticion, mp.id_matricula,e.vencimiento

FROM mat_alu_cta_emp mp, empresas e, mat_costes mc

WHERE e.id = mp.id_empresa

AND mp.id_empresa = mc.id_empresa

AND mc.id_matricula = mp.id_matricula

AND mp.tipo = "Privado"

AND mc.mes_bonificable = ""

AND mp.id_matricula = '.$id.'

ORDER by costes_imparticion DESC';

     // echo $q;

$q = mysqli_query($link, $q) or die("error empresa/costes privado ". mysqli_error($link));;



if ( mysqli_num_rows($q) > 0 )

    $resulhtml .= '<fieldset style="margin-top: -15px"><legend>Privado</legend>';





$prefijo = 'P';

$q2 = 'SELECT MAX(numero) as numero FROM facturacion_privada LIMIT 0,1';

$q2 = mysqli_query($link, $q2);

$row = mysqli_fetch_array($q2);

$numeroprivado = $row[numero]+1;

    // $numeroprivado1 = $prefijo.$numeroprivado;



while($r = mysqli_fetch_assoc($q)) {



  if ( $r[factura] != 0 ) {



    $q1 = 'SELECT id, numero, prefijo, facturar_a, observaciones, fecha

    FROM facturacion_privada

    WHERE id = '.$r[factura].'

    AND estado <> "Rectificada"';

    $q1 = mysqli_query($link, $q1);



    $row = mysqli_fetch_array($q1);



    $prefijo = $row[prefijo];

    if ( $prefijo == 'R') $rectificativa = ' rectificativa '; else $rectificativa = ' ';

    $idfac = $row[id];

    $observaciones = $row[observaciones];

    $numeroprivado = $row[numero];

    $numerof = $prefijo.$numeroprivado;





    if ( $row[facturar_a] != 0 ) {



        $q4 = 'SELECT e.razonsocial as razonsocialfac, e.cif as ciffac, e.domiciliofiscal, e.domiciliosocial, e.codigopostal, e.poblacion, e.provincia, email_facturas, c.nombre, e.email, e.email_facturas

        FROM empresas e, comerciales c

        WHERE e.comercial = c.id

        AND e.id = '.$row[facturar_a];

                // echo $q4;

        $q4 = mysqli_query($link, $q4);

        $r4 = mysqli_fetch_array($q4);



        $empresa = quitaTildesConComas($r4[razonsocialfac]);



        $nombreFichero = 'facturacion'.$gestion.'/facturas/'.$numerof.'_'.$empresa.'_'.$naccion.'-'.$ngrupo.'.pdf';



    } else {



        $empresa = quitaTildesConComas($r[razonsocial]);

        $nombreFichero = 'facturacion'.$gestion.'/facturas/'.$numerof.'_'.$empresa.'_'.$naccion.'-'.$ngrupo.'.pdf';



    }



            // $titulo = 'Factura'.$rectificativa.'acción formativa '.$r[numeroaccion].'/'.$row[ngrupo].' - '.$r[razonsocial].' - '.$row[modalidad];



    $esta = 'green';

    $disabled = 'disabled';



} else {

    $esta = 'red';

    $numeroprivado++;



}





        // COMPROBACION EXTRA PARA LA SQUE VIENEN DEL EXCEL



$q5 = 'SELECT numero,id

FROM facturacion_privada

WHERE empresa = '.$r[id_emp].'

AND matricula = '.$id.'

AND estado <> "Rectificada"';

$q5 = mysqli_query($link, $q5);



if ( mysqli_num_rows($q5) > 0 ) {



    $r5 = mysqli_fetch_array($q5);

    $esta = 'green';

    $numeroprivado = $r5[numero];

    $idfac = $r5[id];

    if ( $r[factura] == 0) {

        $css = ' background-color: #ccc; pointer-events: none; border-color: #ccc; ';

        $nombreFichero = '#';

    }



} else { $esta = 'red'; }





$resulhtml .= '<div style="overflow:auto; ">';



if ( $r[costes_imparticion] != 0 && $esta == 'green') {



    $resulhtml .=

    '<div class="col-md-2">

    <div class="form-group">

        <label class="control-label" for="numero">Nº Factura:</label>

        <div class="input-group">

            <span class="input-group-addon">P</span>

            <input type="text" value="'.$numeroprivado.'" id="numero'.$r[id_emp].'" name="numero" class="form-control" readonly />

        </div>

    </div>

</div>';

}

$resulhtml .=

'<div class="col-md-4">

<input id="id" type="hidden" value="'.$r[id].'">

<div class="form-group">

    <label class="control-label" for="razonsocial">Empresa:</label>

    <input type="text" value="'.$r[razonsocial].'" id="razonsocial" name="razonsocial" class="form-control" disabled />

</div>

</div>

<div class="col-md-2">

    <div class="form-group">

        <label class="control-label" for="cif">CIF:</label>

        <input type="text" value='.$r[cif].' id="cif" name="cif" class="form-control" disabled />

    </div>

</div>

<div class="col-md-2">

    <div class="form-group">

        <label class="control-label" for="costes_imparticion">Costes Impartición:</label>

        <input type="text" value='.$r[costes_imparticion].' id="costes_imparticion" name="costes_imparticion" class="form-control" disabled />

    </div>

</div>';



if ( $r[costes_imparticion] != 0 ) {



    $resulhtml .=

    '<div class="col-md-2">

    <div class="form-group">

        <label class="control-label" for="importe_factura">Importe a facturar:</label>

        <input type="text" value='.$r[costes_imparticion].' id="importe_factura'.$r[id_emp].'" name="importe_factura" class="form-control" />

    </div>

</div>';



if ( $esta == 'green' ) {



   $resulhtml .= '

   <div class="col-md-2">

    <div class="form-group">

        <label class="control-label" for="fecha_factura">Fecha de Factura:</label>

        <input value="'. $row[fecha] .'" type="date" id="fecha_factura'.$r[id_emp].'" name="fecha_factura" class="form-control" />

    </div>

</div>';



} else {



    $resulhtml .= '

    <div class="col-md-2">

        <div class="form-group">

            <label class="control-label" for="fecha_factura">Fecha de Factura:</label>

            <input value="'. date('Y-m-d') .'" type="date" id="fecha_factura'.$r[id_emp].'" name="fecha_factura" class="form-control" />

        </div>

    </div>';



}



$resulhtml .= '

<div class="col-md-2">

    <div class="form-group">

        <label class="control-label" for="vencimiento">Vencimiento:</label>

        <input type="text" value='.$r[vencimiento].' id="vencimiento'.$r[id_emp].'" name="vencimiento" class="form-control" />

    </div>

</div>

<div class="col-md-2">

    <div class="form-group">

        <label class="control-label" for="anticipo">Anticipo:</label>

        <input type="text" value="" id="anticipo'.$r[id_emp].'" name="anticipo" class="form-control" />

    </div>

</div>

<div class="col-md-2">

    <div class="form-group">

        <label class="control-label" for="otro">Otros:</label>

        <input type="text" value="" id="otro'.$r[id_emp].'" name="otro" class="form-control" />

    </div>

</div>



<div class="col-md-2">

    <div class="form-group">

        <label class="control-label" for="formapago">Forma de Pago:</label>

        <select id="formapago'.$r[id_emp].'" name="formapago" class="form-control">';

            if ($r[formapago] == "Transferencia")

                $resulhtml.= '<option selected value="Transferencia">Transferencia</option>';

            else

                $resulhtml.= '<option value="Transferencia">Transferencia</option>';



            if ($r[formapago] == "Cheque")

                $resulhtml .= '<option selected value="Cheque">Cheque</option>';

            else

                $resulhtml .= '<option value="Cheque">Cheque</option>';

            if ($r[formapago] == "Remesa")

                $resulhtml .= '<option selected value="Remesa">Remesa</option>';

            else

                $resulhtml .= '<option value="Remesa">Remesa</option>';

            if ($r[formapago] == "Efectivo")

                $resulhtml.= '<option selected value="Efectivo">Efectivo</option>';

            else

                $resulhtml.= '<option value="Efectivo">Efectivo</option>';

            if ($r[formapago] == "Domciliación")

                $resulhtml.= '<option selected value="Domciliación">Domciliación</option>';

            else

                $resulhtml.= '<option value="Domciliación">Domciliación</option>';

            $resulhtml.='</select>

        </div>

    </div>

    <input type="hidden" id="empfacturar'.$r[id_emp].'" name="empfacturar">

    <div class="col-md-4">

        <div class="form-group">

            <label class="control-label" for="facturar_a">Facturar a:</label>

            <div class="input-group">

                <input placeholder="Busca empresa" id_emp="'.$r[id_emp].'" id="facturar_a'.$r[id_emp].'" name="facturar_a" class="form-control">

                <span class="input-group-btn">

                    <button data-toggle="modal" id_emp="'.$r[id_emp].'" data-target="#myModal" name="buscarempresa" id="buscarempresafac" class="btn btn-default"><span id="buscarempresafac" class="glyphicon glyphicon-search"></span></button>

                </span>

            </div>

        </div>

    </div>

    <div class="clearfix"></div>

    <div class="col-md-12">

        <div class="form-group">

            <label class="control-label" for="observaciones">Observaciones para la factura:</label>

            <textarea name="observaciones" id="observaciones'.$r[id_emp].'" class="form-control" rows="2">'.$observaciones.'</textarea>

        </div>

    </div>';



    if ( $observacionesfin != "" && $observacionesfin != "undefined" ) {

        $resulhtml .= '

        <div class="col-md-12">

            <div class="form-group">

                <label class="control-label" for="observacionesfin">Observaciones de finalización:</label>

                <textarea disabled name="observacionesfin" id="observacionesfin" class="form-control" rows="2">'.$observacionesfin.'</textarea>

            </div>

        </div>

        <div class="clearfix"></div>'; }





        if ( $esta == 'red' ) {



            $resulhtml.= '

            <div style="display:none" class="col-md-2" id="huecoDetalle'.$r[id_emp].'"></div>

            <div class="col-md-3">

               <a id="previsualizarfacturap'.$r[id_emp].'" emp="'.$r[id_emp].'" mat="'.$r[id_matricula].'" style="width: 100%; margin-top: 0px;" class="btn btn-warning"><span class="glyphicon glyphicon-list-alt"></span> Previsualizar Factura</a>

           </div>

           <div class="col-md-2">

               <a id="generarfacturap" emp="'.$r[id_emp].'" mat="'.$r[id_matricula].'" style="float:left;width: 100%; margin-top: 0px;" class="btn btn-success"><span class="glyphicon glyphicon-list-alt"></span> Generar Factura</a>

           </div>';



       } else {



           $resulhtml.= '

           <div class="col-md-2">

            <a style="width:100%" id="detalleFacturaFac" tabla="facturacion_privada" idfac="'.$idfac.'" class="btn btn-primary"><span class="glyphicon glyphicon-list-alt"></span> Detalle</a>

        </div>



        <div class="col-md-2">

           <a id="verfactura" target="_blank" href="'.$baseurl.$nombreFichero.'" style="'.$css.' float:left;width: 100%; margin-top: 0px;" class="btn btn-success"><span class="glyphicon glyphicon-list-alt"></span> Ver Factura</a>

       </div>

       <div class="col-md-2">

           <a id="modificarfacturap" idfac="'.$idfac.'" emp="'.$r[id_emp].'" mat="'.$r[id_matricula].'" style="float:left;width: 100%; margin-top: 0px;" class="btn btn-success"><span class="glyphicon glyphicon-list-alt"></span> Modificar Factura</a>

       </div>';

   }



   $resulhtml.= '

   <div class="col-md-1">

      <span id="compmailfac'.$r[id_emp].'" style="float:left; margin-top: 10px; margin-left: -20px; color: '.$esta.';" class="glyphicon glyphicon-ok-circle"></span>

  </div></div>

  <div style="margin-bottom:0px" class="clearfix"></div>';



} else {

    if ( $observacionesfin != "" && $observacionesfin != "undefined" ) {

        $resulhtml .= '

        <div class="col-md-12">

            <div class="form-group">

                <label class="control-label" for="observacionesfin">Observaciones de finalización:</label>

                <textarea disabled name="observacionesfin" id="observacionesfin" class="form-control" rows="2">'.$observacionesfin.'</textarea>

            </div>

        </div>

        <div class="clearfix"></div>'; } }





    }

    $resulhtml .= '</fieldset>';

    echo $resulhtml;

    // return $resulhtml;

}

//**************************************************//
// Autor:       cgutierrez                          //
// Fecha:       03/10/2016                          //
// Descripción: Muestra una nueva línea para añadir //
//              la matrícula y los importes a       //
//              computar de la factura              //
//**************************************************//
function anadirMatAcreFra($idfra, $link, $existe = NULL) {

    $random = rand();

    if ( $existe === NULL ) {

        $q = 'SELECT f.*, m.id as id_matricula, a.numeroaccion, ga.ngrupo, f.id as id_facre
        FROM facturacion_matriculas_acre f
        LEFT JOIN matriculas m ON f.id_matricula = m.id
        LEFT JOIN acciones a ON m.id_accion = a.id
        LEFT JOIN grupos_acciones ga ON m.id_grupo = ga.id
        WHERE f.id_factura = "'.$idfra.'"';
        // echo $q;
        $q = mysqli_query($link, $q) or die("error select : " .mysqli_error($link));

    }

    if ( mysqli_num_rows($q) == 0 ) {

        echo '

        <div class="clearfix"></div>

        <div class="col-md-12" style="margin-top: 15px;">

            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label" for="id_matricula">Matrícula:</label>
                    <div class="input-group">';
            if ( $row['tipogasto'] == "Formación") {
                echo '          <input value="'.$row['numeroaccion'].'/'.$row['ngrupo'].'" type="text" id="numeroaccion'.$random.'" name="numeroaccion" class="form-control"/>';
            } else {
                echo '          <input value="" type="text" id="numeroaccion'.$random.'" name="numeroaccion" class="form-control"/>';
            }
        echo '          <span class="input-group-btn">
                            <button id="buscarmatricula" name="buscarmatricula" class="btn btn-default" nuevo="'.$random.'"><span class="glyphicon glyphicon-search"></span></button>

                        <input type="hidden" value="'.$row['id_matricula'].'" id="id_matricula'.$random.'" name="id_matricula" class="form-control"/>
                        </span>
                    </div>
                </div>

            </div>

            <div class="col-md-2">

                <div class="form-group">

                    <label class="control-label" for="importe">Importe:</label>

                    <input value="'.$row['importe'].'" type="text" id="importe'.$random.'" name="importe" class="form-control" />

                </div>

            </div>

            <div class="col-md-2">

                <div class="form-group">

                    <label class="control-label" for="porcentaje">Porcentaje:</label>

                    <input value="'.$row['porcentaje'].'" type="text" id="porcentaje'.$random.'" name="porcentaje" class="form-control" />

                </div>

            </div>

            <div class="col-md-2" id="grupoTipoGasto'.$random.'">

                <div class="form-group">

                    <label class="control-label" for="tipogasto">Tipo de Gasto:</label>

                    <select id="tipogasto'.$random.'" name="tipogasto" class="form-control" >
                        <option value="">Selecciona</option>
                        <option '; echo ($row['tipogasto'] == "Administración" ? "selected" : "" ) ; echo ' value="Administración">Administración</option>
                        <option '; echo ($row['tipogasto'] == "Contratos" ? "selected" : "" ) ; echo ' value="Contratos">Contratos</option>
                        <option '; echo ($row['tipogasto'] == "Comercial" ? "selected" : "" ) ; echo ' value="Comercial">Comercial</option>
                        <option '; echo ($row['tipogasto'] == "Logística" ? "selected" : "" ) ; echo ' value="Logística">Logística</option>
                        <option '; echo ($row['tipogasto'] == "Agencia Contratación" ? "selected" : "" ) ; echo ' value="Agencia Contratación">Agencia Contratación</option>
                        <option '; echo ($row['tipogasto'] == "Marketing" ? "selected" : "" ) ; echo ' value="Marketing">Marketing</option>
                        <option '; echo ($row['tipogasto'] == "Formación" ? "selected" : "" ) ; echo ' value="Formación">Formación</option>
                        <option '; echo ($row['tipogasto'] == "Formación SCE" ? "selected" : "" ) ; echo ' value="Formación SCE">Formación SCE</option>
                    </select>

                </div>

            </div>';

            if ( $row['tipogasto'] == 'Formación' ) {

                $display = 'display:inline-block';
                echo '<div style="'.$display.'" class="col-md-2" id="grupoTipoGastoFormacion" name="grupoTipoGastoFormacion">

                    <div class="form-group">

                        <label class="control-label" for="gastoformacion">Gasto Formación:</label>

                        <select id="gastoformacion'.$random.'" name="gastoformacion" class="form-control" >
                            <option value="">Selecciona</option>
                            <option '; echo ($row['gastoformacion'] == "Alojamiento" ? "selected" : "" ) ; echo ' value="Alojamiento">Alojamiento</option>
                            <option '; echo ($row['gastoformacion'] == "Traslado" ? "selected" : "" ) ; echo ' value="Traslado">Traslado</option>
                            <option '; echo ($row['gastoformacion'] == "Docente" ? "selected" : "" ) ; echo ' value="Docente">Docente</option>
                            <option '; echo ($row['gastoformacion'] == "Aula" ? "selected" : "" ) ; echo ' value="Aula">Aula</option>
                            <option '; echo ($row['gastoformacion'] == "Fungible" ? "selected" : "" ) ; echo ' value="Fungible">Fungible</option>
                            <option '; echo ($row['gastoformacion'] == "Dieta" ? "selected" : "" ) ; echo ' value="Dieta">Dieta</option>
                            <option '; echo ($row['gastoformacion'] == "Material Didáctico" ? "selected" : "" ) ; echo ' value="Material Didáctico">Material Didáctico</option>
                            <option '; echo ($row['gastoformacion'] == "Otros" ? "selected" : "" ) ; echo ' value="Otros">Otros</option>
                        </select>

                    </div>

                </div>';

            }

            if ( $row['tipogasto'] == 'Comercial' ) {
                $display = 'display:inline-block';
            } else {
                $display = 'display:none';
            }



            echo '
            <div style="'.$display.'" class="col-md-2 tipogastocomercial">
                <div class="cp form-group">
                    <label class="control-label" for="id_comercial">Comercial:</label>
                    <select id="id_comercial'.$random.'" name="id_comercial" class="form-control">';

                        devuelveComerciales($link, $row['id_comercial']);

                        echo' </select>
                    </div>
                </div>

                <div class="col-md-1" style="margin-top: 25px;">

                    <a id="guardarmatacrefra" id_fra="'.$idfra.'" id_facre="'.$row['id_facre'].'" id_concilio="" nuevo="'.$random.'" style="float:left;width: 100%; margin-top: 0px;" class="btn btn-success"><span class="glyphicon glyphicon-floppy-disk"></a>

                </div>

            </div>

            <div style="" class="clearfix"></div>';

    } else {

        echo '<div class="divmatacrefra">';
        while ( $row = mysqli_fetch_assoc($q) ) {

        // if ( count($row) > 0 )
        echo '

        <div class="clearfix"></div>

        <div class="col-md-12" style="margin-top: 15px;">

            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label" for="id_matricula">Matrícula:</label>
                    <div class="input-group">';
            if ( $row['tipogasto'] == "Formación") {
                echo '          <input value="'.$row['numeroaccion'].'/'.$row['ngrupo'].'" type="text" id="numeroaccion'.$row['id_facre'].'" name="numeroaccion" class="form-control"/>';
            } else {
                echo '          <input value="" type="text" id="numeroaccion'.$row['id_facre'].'" name="numeroaccion" class="form-control"/>';
            }
        echo '          <span class="input-group-btn">
                            <button id="buscarmatricula" name="buscarmatricula" class="btn btn-default" nuevo="'.$row['id_facre'].'"><span class="glyphicon glyphicon-search"></span></button>

                        <input type="hidden" value="'.$row['id_matricula'].'" id="id_matricula'.$row['id_facre'].'" name="id_matricula" class="form-control"/>
                        </span>
                    </div>
                </div>

            </div>

            <div class="col-md-2">

                <div class="form-group">

                    <label class="control-label" for="importe">Importe:</label>

                    <input value="'.$row['importe'].'" type="text" id="importe'.$row['id_facre'].'" name="importe" class="form-control" />

                </div>

            </div>

            <div class="col-md-2">

                <div class="form-group">

                    <label class="control-label" for="porcentaje">Porcentaje:</label>

                    <input value="'.$row['porcentaje'].'" type="text" id="porcentaje'.$row['id_facre'].'" name="porcentaje" class="form-control" />

                </div>

            </div>

            <div class="col-md-2" id="grupoTipoGasto'.$row['id_facre'].'">

                <div class="form-group">

                    <label class="control-label" for="tipogasto">Tipo de Gasto:</label>

                    <select id="tipogasto'.$row['id_facre'].'" name="tipogasto" class="form-control" >
                        <option value="">Selecciona</option>
                        <option '; echo ($row['tipogasto'] == "Administración" ? "selected" : "" ) ; echo ' value="Administración">Administración</option>
                        <option '; echo ($row['tipogasto'] == "Contratos" ? "selected" : "" ) ; echo ' value="Contratos">Contratos</option>
                        <option '; echo ($row['tipogasto'] == "Comercial" ? "selected" : "" ) ; echo ' value="Comercial">Comercial</option>
                        <option '; echo ($row['tipogasto'] == "Logística" ? "selected" : "" ) ; echo ' value="Logística">Logística</option>
                        <option '; echo ($row['tipogasto'] == "Agencia Contratación" ? "selected" : "" ) ; echo ' value="Agencia Contratación">Agencia Contratación</option>
                        <option '; echo ($row['tipogasto'] == "Marketing" ? "selected" : "" ) ; echo ' value="Marketing">Marketing</option>
                        <option '; echo ($row['tipogasto'] == "Formación" ? "selected" : "" ) ; echo ' value="Formación">Formación</option>
                        <option '; echo ($row['tipogasto'] == "Formación SCE" ? "selected" : "" ) ; echo ' value="Formación SCE">Formación SCE</option>
                    </select>

                </div>

            </div>';

            if ( $row['tipogasto'] == 'Formación' ) {

                $display = 'display:inline-block';
                echo '<div style="'.$display.'" class="col-md-2" id="grupoTipoGastoFormacion" name="grupoTipoGastoFormacion">

                    <div class="form-group">

                        <label class="control-label" for="gastoformacion">Gasto Formación:</label>

                        <select id="gastoformacion'.$row['id_facre'].'" name="gastoformacion" class="form-control" >
                            <option value="">Selecciona</option>
                            <option '; echo ($row['gastoformacion'] == "Alojamiento" ? "selected" : "" ) ; echo ' value="Alojamiento">Alojamiento</option>
                            <option '; echo ($row['gastoformacion'] == "Traslado" ? "selected" : "" ) ; echo ' value="Traslado">Traslado</option>
                            <option '; echo ($row['gastoformacion'] == "Docente" ? "selected" : "" ) ; echo ' value="Docente">Docente</option>
                            <option '; echo ($row['gastoformacion'] == "Aula" ? "selected" : "" ) ; echo ' value="Aula">Aula</option>
                            <option '; echo ($row['gastoformacion'] == "Fungible" ? "selected" : "" ) ; echo ' value="Fungible">Fungible</option>
                            <option '; echo ($row['gastoformacion'] == "Dieta" ? "selected" : "" ) ; echo ' value="Dieta">Dieta</option>
                            <option '; echo ($row['gastoformacion'] == "Material Didáctico" ? "selected" : "" ) ; echo ' value="Material Didáctico">Material Didáctico</option>
                            <option '; echo ($row['gastoformacion'] == "Otros" ? "selected" : "" ) ; echo ' value="Otros">Otros</option>
                        </select>

                    </div>

                </div>';

            }

            if ( $row['tipogasto'] == 'Comercial' ) {
                $display = 'display:inline-block';
            } else {
                $display = 'display:none';
            }

            echo '
            <div style="'.$display.'" class="col-md-2 tipogastocomercial">
                <div class="cp form-group">
                    <label class="control-label" for="id_comercial">Comercial:</label>
                    <select id="id_comercial'.$row['id_facre'].'" name="id_comercial" class="form-control">';

                        devuelveComerciales($link, $row['id_comercial']);

                        echo' </select>
                    </div>
                </div>

                <div class="col-md-1" style="margin-top: 25px;">

                    <a id="guardarmatacrefra" id_fra="'.$idfra.'" id_facre="'.$row['id_facre'].'" id_concilio="" nuevo="'.$row['id_facre'].'" style="float:left;width: 100%; margin-top: 0px;" class="btn btn-success"><span class="glyphicon glyphicon-floppy-disk"></span></a>

                </div>

                <div class="col-md-1" style="margin-top: 25px;">

                    <a id="borrarmatacrefra" id_fra="'.$idfra.'" id_facre="'.$row['id_facre'].'" id_concilio="" nuevo="'.$random.'" style="float:left;width: 100%; margin-top: 0px;" class="btn btn-danger"><span class="glyphicon glyphicon-remove-sign"></a>

                </div>


            </div>

            <div style="" class="clearfix"></div>';
        }

    }        echo "</div>";


}


//**************************************************//
//**************************************************//
// Autor:       cgutierrez                          //
// Fecha:       06/10/2016                          //
// Descripción: Guarda las matrículas asociadas a   //
//              una factura de acreedor             //
//**************************************************//
//**************************************************//
    function guardarMatAcreFra($id_factura, $id_matricula, $importe, $porcentaje, $tipogasto, $gastoformacion, $id_comercial, $id_facre, $link) {


        // echo "eee";
        //$qFacturacion = 'select bruto as importe, pagado, pendiente from facturacion_acreedores where id ='.$id_factura;//COMENTADO POR OCTAVIO

    // echo $qFacturacion;

        //$qFacturacion = mysqli_query($link, $qFacturacion) or die ('error select primer fra:'.mysqli_error($link));//COMENTADO POR OCTAVIO

        //$rowFacturacion = mysqli_fetch_array($qFacturacion);//COMENTADO POR OCTAVIO

        //$importe_TotalFactua = $rowFacturacion[importe];//COMENTADO POR OCTAVIO

    // En función de si se ha cumplimentado el importe o el porcentaje
    // calculamos el otro campo para así guardarlos ambos en DB
        // if ( isset( $porcentaje ) && ( $porcentaje > 0 ) ) {

        //     $importe = (( $importe_TotalFactua * $porcentaje ) / 100 );

        // // echo "<br>Importe calculado: ".$importe;

        // } else if ( isset( $importe ) && ( $importe > 0 ) ) {

        //     $porcentaje = ( ( $importe * 100 ) / $importe_TotalFactua );

        // }

    // echo "<br>Importe factura: ".$rowFacturacion[importe]."<br>";

        //$qFraMatAcre ='select sum(importe) as importe_asignado from facturacion_matriculas_acre where id_factura = '.$id_factura.' group by id_factura';//COMENTADO POR OCTAVIO

    //echo "<br>".$qFraMatAcre."<br>";

        //$qFraMatAcre = mysqli_query($link, $qFraMatAcre) or die ('error select fra:'.mysqli_error($link));//COMENTADO POR OCTAVIO

        //$rowFraMatAcre = mysqli_fetch_array($qFraMatAcre);//COMENTADO POR OCTAVIO

        //$importe_TotalAsignado = $rowFraMatAcre[importe_asignado];//COMENTADO POR OCTAVIO

    //echo "<br>Importe asignado: ".$rowFraMatAcre[importe_asignado]."<br>";

        //$restoPorAsignar = ( $importe_TotalFactua - $importe_TotalAsignado );//COMENTADO POR OCTAVIO

        /*if  ( $importe_TotalFactua < $importe ) {

        // En caso de superar el tope de la factura
        //echo "<br>Entra importe.<br>";
            if ( $id_facre == '')
                die ('aviso: Superado Importe Factura');

        } else if ( ($restoPorAsignar < $importe) && ($id_facre == ""))  {

        // En caso de haber asignado a acreedores el total de la factura
        //echo "<br>Entra importe asignado.";
            //echo ("aviso: ".$id_factura );
            if ( $id_facre == '')
                die (' aviso: Superado Importe Asignado a la Factura');


        } else {*/

        // El importe a insertar es inferior o igual al total de la factura y al total de las matrículas asignadas a esa factua

            if ( $id_facre != "" ) {

                $q = 'UPDATE `facturacion_matriculas_acre` SET `id_factura` = "'.$id_factura.'", `id_matricula` = "'.$id_matricula.'", `importe` = "'.$importe.'", `porcentaje` = "'.$porcentaje.'", `fecha` = "'.date('Y-m-d').'", `tipogasto` = "'.$tipogasto.'", `gastoformacion` = "'.$gastoformacion.'", `id_comercial` = "'.$id_comercial.'" WHERE id = "'.$id_facre.'"';

            } else {

                $q = 'INSERT IGNORE INTO `facturacion_matriculas_acre`(`id_factura`, `id_matricula`, `importe`, `porcentaje`, `fecha`, `tipogasto`, `gastoformacion`, `id_comercial`)
                VALUES ("'.$id_factura.'", "'.$id_matricula.'","'.$importe.'","'.$porcentaje.'", "'.date('Y-m-d').'", "'.$tipogasto.'", "'.$gastoformacion.'", "'.$id_comercial.'")';
            }
        //}
        // echo "<br>".$q."<br>";

        $q = mysqli_query($link, $q) or die('error insertar mat_acre:'. mysqli_error($link));

        $resultado[0] = $importe;

        $resultado[1] = $porcentaje;

        echo json_encode($resultado);
    /*}*/

}

//**************************************************//
// Autor:       cgutierrez                          //
// Fecha:       07/11/2016                          //
// Descripción: Muestra una nueva línea para añadir //
//              un nuevo Item de Otros Gastos       //
//**************************************************//
function anadirItemRentabilidad($tipoGasto, $link) {

    echo '

    <div class="clearfix"></div>

    <div class="col-md-6" style="margin-top: 15px;">

        <div class="form-group">

            <label class="control-label" for="itemdescripcion">Nuevo Item:</label>

            <input value"" type="text" id="itemdescripcion" name="itemdescripcion" class="form-control"/>

        </div>

    </div>

    <div class="col-md-2" style="margin-top: 15px;">

        <div class="form-group">

            <label class="control-label" for="itemprecio">Precio:</label>

            <input value="" type="text" id="itemprecio" name="itemprecio" class="form-control" />

        </div>

    </div>

    <div class="col-md-2" style="margin-top: 40px;">

        <a id="guardaritemrentabilidad" tipoGasto="'.$tipoGasto.'" style="float:left;width: 100%; margin-top: 0px;" class="btn btn-primary"> Guardar</a>

    </div>

    <div style="" class="clearfix"></div>';

}

//**************************************************//
//**************************************************//
// Autor:       cgutierrez                          //
// Fecha:       07/11/2016                          //
// Descripción: Guarda nuevos Items de Gastos       //
//**************************************************//
//**************************************************//
function guardarItemRentabilidad($tipoGasto, $itemdescripcion, $itemprecio, $link) {

    $q = 'INSERT INTO `items_gastos`(`item`, `precio`, `tipo`)

    VALUES ("'.$itemdescripcion.'", "'.str_replace(",", ".", $itemprecio).'","'.$tipoGasto.'")';

    echo "<br>".$q."<br>";

    $q = mysqli_query($link, $q) or die('error:'. mysqli_error($link));

    // if ( $tipoGasto == 0 ) {
    //     $select = '#listafun';
    // } else if ( $tipoGasto == 1 ) {
    //     //$funcionCarga = 'tipoGasto='+$tipoGasto+'&cargarSelectDatosFungibles=1';
    //     $select = '#listaotros';
    // }

    // $.ajax({
    //     cache: false,
    //     type: 'POST',
    //     url: './funciones.php',
    //     data: 'tipoGasto='+$tipoGasto+'&cargarSelectRentabilidad=1',
    //     success: function(data)
    //     {
    //         $($select).html(data);
    //     }
    // }); ajax.abort();

}

//**************************************************//
// Autor:       cgutierrez                          //
// Fecha:       07/11/2016                          //
// Descripción: Muestra una nueva línea para añadir //
//              un nuevo Item de Fungibles          //
//**************************************************//
function anadirItemDatosFungibles($link) {

    echo '

    <div class="clearfix"></div>

    <div class="col-md-6" style="margin-top: 15px;">

        <div class="form-group">

            <label class="control-label" for="itemdescripcion">Nuevo Item:</label>

            <input value"" type="text" id="itemdescripcion" name="itemdescripcion" class="form-control"/>

        </div>

    </div>

    <div class="col-md-2" style="margin-top: 15px;">

        <div class="form-group">

            <label class="control-label" for="itemprecio">Precio:</label>

            <input value="" type="text" id="itemprecio" name="itemprecio" class="form-control" />

        </div>

    </div>

    <div class="col-md-2" style="margin-top: 40px;">

        <a id="guardaritemdatosfungibles" style="float:left;width: 100%; margin-top: 0px;" class="btn btn-primary"> Guardar</a>

    </div>

    <div style="" class="clearfix"></div>';

}

//**************************************************//
//**************************************************//
// Autor:       cgutierrez                          //
// Fecha:       07/11/2016                          //
// Descripción: Guarda nuevos Items de Fungibles    //
//**************************************************//
//**************************************************//
function guardarItemDatosFungibles($itemdescripcion, $itemprecio, $link) {

    $q = 'INSERT INTO `items_gastos`(`item`, `precio`, `tipo`)

    VALUES ("'.$itemdescripcion.'", "'.str_replace(",", ".", $itemprecio).'","0")';

    echo "<br>".$q."<br>";

    $q = mysqli_query($link, $q) or die('error:'. mysqli_error($link));

}

//FUNCION HECHA POR OCTAVIO 23/5/2017

function liquidar($id, $link){

    $q = "UPDATE matriculas SET estado = 'Liquidada' WHERE id = ".$id;

    /*echo $q;*/

    mysqli_query($link, $q) or die('error:'.mysqli_error($link));

}

//TERMINA FUNCION

//**************************************************//
//**************************************************//
// Autor:       cgutierrez                          //
// Fecha:       20/01/2017                          //
// Descripción: Muestra detalles de seguimiento     //
//              de facturacion                      //
//**************************************************//
//**************************************************//
function mostrarDetalleSeguimientoFac($id_matricula, $id_empresa, $link){

    echo '<div style="margin-top: 30px" class="container">';
    echo '<form class="formularioaccion" id="formulario" role="form" action="" method="post">';
    echo '  <span id="contenido"></span>';
    echo '  <div id="datosaccion" class="col-md-12 " >';

    $hayDatos = 0;

    if ( $id_matricula != ''){
        $q1 = "SELECT concat(a.numeroaccion, '/', ga.ngrupo) AS accion,
            a.denominacion,
            m.fechaini,
            m.fechafin,
            m.estado,
            e.razonsocial,
            CONCAT(c.nombre, ' ', c.apellido, ' ', c.apellido2) AS comercial,
            CONCAT(d.nombre, ' ', d.apellido, ' ', d.apellido2) AS docente,
            ce.nombrecentro
            FROM matriculas AS m
            INNER JOIN acciones AS a ON m.id_accion = a.id
            INNER JOIN grupos_acciones AS ga ON m.id_grupo = ga.id
            INNER JOIN mat_alu_cta_emp AS ma ON m.id = ma.id_matricula
            INNER JOIN empresas AS e ON ma.id_empresa  = e.id
            INNER JOIN comerciales AS c ON e.comercial = c.id
            INNER JOIN mat_doc AS md ON m.id = md.id_matricula
            INNER JOIN centros AS ce ON ce.id_matricula = m.id
            INNER JOIN docentes AS d ON md.id_docente = d.id
            WHERE m.id = ".$id_matricula.' AND e.id = '.$id_empresa;

        //echo $q1;

        $q1 = mysqli_query($link, $q1) or die(" error Buscar Facturas Accion:" .mysqli_error($link));

        $row = mysqli_fetch_array($q1);

        $naccion = $row['accion'];
        $denominacion = $row['denominacion'];
        $fechaini = $row['fechaini'];
        $fechafin = $row['fechafin'];
        $estado = $row['estado'];
        $empresa = $row['razonsocial'];
        $comercial = $row['comercial'];
        $docente = $row['docente'];
        $totalFinalGastos = 0;
        $totalFinalIngresos = 0;
    }

    // DATOS DE LA MATRÍCULA
    $bloqueCabecera = '';
    $bloqueCabecera .= '        <div class="col-md-2">';
    $bloqueCabecera .= '            <div class="form-group">';
    $bloqueCabecera .= '                <label class="control-label" for="numeroaccion">Número Acción:</label>';
    $bloqueCabecera .= '                <input readonly value="'.$naccion.'" type="text" id="numeroaccion" name="numeroaccion" class="form-control" />';
    $bloqueCabecera .= '                <input type="hidden" id="id" name="id" class="form-control" />';
    $bloqueCabecera .= '            </div>';
    $bloqueCabecera .= '        </div>';
    $bloqueCabecera .= '        <div class="col-md-4">';
    $bloqueCabecera .= '            <div class="form-group">';
    $bloqueCabecera .= '                <label class="control-label" for="denominacion">Nombre Acción:</label>';
    $bloqueCabecera .= '                <input readonly type="text" id="denominacion" name="denominacion" class="form-control" value="'.$denominacion.'"/>';
    $bloqueCabecera .= '            </div>';
    $bloqueCabecera .= '        </div>';
    $bloqueCabecera .= '        <div class="col-md-2">';
    $bloqueCabecera .= '            <div class="form-group">';
    $bloqueCabecera .= '                <label class="control-label" for="estado">Estado:</label>';
    $bloqueCabecera .= '                <input readonly type="text" id="estado" name="estado" class="form-control" value="'.$estado.'"/>';
    $bloqueCabecera .= '            </div>';
    $bloqueCabecera .= '        </div>';
    $bloqueCabecera .= '        <div class="col-md-2">';
    $bloqueCabecera .= '            <div class="form-group">';
    $bloqueCabecera .= '                <label class="control-label" for="fechainicio">Fecha Inicio:</label>';
    $bloqueCabecera .= '                <input readonly type="text" id="fechainicio" name="fechainicio" class="form-control" value="'.formateaFecha($fechaini).'"/>';
    $bloqueCabecera .= '            </div>';
    $bloqueCabecera .= '        </div>';
    $bloqueCabecera .= '        <div class="col-md-2">';
    $bloqueCabecera .= '            <div class="form-group">';
    $bloqueCabecera .= '                <label class="control-label" for="fechafin">Fecha Fin:</label>';
    $bloqueCabecera .= '                <input readonly type="text" id="fechafin" name="fechafin" class="form-control" value="'.formateaFecha($fechafin).'" />';
    $bloqueCabecera .= '            </div>';
    $bloqueCabecera .= '        </div>';

    $bloqueCabecera .= '        <div class="col-md-3">';
    $bloqueCabecera .= '            <div class="form-group">';
    $bloqueCabecera .= '                <label class="control-label" for="numeroaccion">Lugar:</label>';
    $bloqueCabecera .= '                <input readonly value="'.$row['nombrecentro'].'" type="text" id="numeroaccion" name="numeroaccion" class="form-control" />';
    $bloqueCabecera .= '                <input type="hidden" id="id" name="id" class="form-control" />';
    $bloqueCabecera .= '            </div>';
    $bloqueCabecera .= '        </div>';
    $bloqueCabecera .= '        <div class="col-md-3">';
    $bloqueCabecera .= '            <div class="form-group">';
    $bloqueCabecera .= '                <label class="control-label" for="numeroaccion">Empresa:</label>';
    $bloqueCabecera .= '                <input readonly value="'.$empresa.'" type="text" id="numeroaccion" name="numeroaccion" class="form-control" />';
    $bloqueCabecera .= '                <input type="hidden" id="id" name="id" class="form-control" />';
    $bloqueCabecera .= '            </div>';
    $bloqueCabecera .= '        </div>';
    $bloqueCabecera .= '        <div class="col-md-3">';
    $bloqueCabecera .= '            <div class="form-group">';
    $bloqueCabecera .= '                <label class="control-label" for="numeroaccion">Docente:</label>';
    $bloqueCabecera .= '                <input readonly value="'.$docente.'" type="text" id="numeroaccion" name="numeroaccion" class="form-control" />';
    $bloqueCabecera .= '                <input type="hidden" id="id" name="id" class="form-control" />';
    $bloqueCabecera .= '            </div>';
    $bloqueCabecera .= '        </div>';
    $bloqueCabecera .= '        <div class="col-md-3">';
    $bloqueCabecera .= '            <div class="form-group">';
    $bloqueCabecera .= '                <label class="control-label" for="numeroaccion">Comercial:</label>';
    $bloqueCabecera .= '                <input readonly value="'.$comercial.'" type="text" id="numeroaccion" name="numeroaccion" class="form-control" />';
    $bloqueCabecera .= '                <input type="hidden" id="id" name="id" class="form-control" />';
    $bloqueCabecera .= '            </div>';
    $bloqueCabecera .= '        </div>';
    $bloqueCabecera .= '    <div class="col-md-3">';
    $bloqueCabecera .= '        <button id="btnLiquidar" id_mat="'.$id_matricula.'" class="btn btn-success">Liquidar</button>';
    $bloqueCabecera .= '    </div>';
    $bloqueCabecera .= '    </div>';


    $sec = basename($_SERVER['HTTP_REFERER'], ".php");

    // DATOS DE LAS FACTURAS DE ACREEDORES ASOCIADAS
    $qAcreedores = "SELECT acre.razonsocial,
    f.fecha,
    f.importe,
    f.porcentaje,
    f.gastoformacion,
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

    $qAcreedores = mysqli_query($link, $qAcreedores) or die(" error Buscar Facturas Matriculas:" .mysqli_error($link));

    $numregistros = mysqli_num_rows($qAcreedores);

    if ( $numregistros > 0 ) {

        $hayDatos = 1;

        $totalImporteAcreedores = 0;

        $bloqueAcreedores = '';
        $bloqueAcreedores .= '<div class="clearfix"></div>';
        $bloqueAcreedores .= '<div id="listado-facturas" class="">';
        $bloqueAcreedores .= '<div class="col-md-12">';
        $bloqueAcreedores .= '<strong>Facturas Acreedores Asociadas:</strong>';
        $bloqueAcreedores .= '<table style="margin-top: 15px;" class="table table-bordered table-striped">
        <thead>
            <tr>';
                $bloqueAcreedores .= '<th style="text-align:center">Acreedor</th>';
                $bloqueAcreedores .= '<th style="text-align:center">Gasto Formacion</th>';
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
                    $bloqueAcreedores .= '<td>';
                    $bloqueAcreedores .= ''.$rowAcreedores[gastoformacion].'';
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
                    $bloqueAcreedores .= ''.number_format($rowAcreedores[porcentaje], 2).' %';
                    $bloqueAcreedores .= ' </td>';
                }
                $bloqueAcreedores .= '      <tr><td style="text-align:right" colspan=5>Total Facturas de Acreeodes Asociadas: '.number_format($totalImporteAcreedores,2).'</td></tr>';
                $bloqueAcreedores .= '      </tbody>
            </table>
        </div>';

        $totalFinalGastos += $totalImporteAcreedores;
        // echo "total importe acreedores ".$totalImporteAcreedores;

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
    //  echo "<br>".$qClientes;
    }

    $qClientes = mysqli_query($link, $qClientes) or die(" error Buscar Facturas Clientes:" .mysqli_error($link));

    $numregistros = mysqli_num_rows($qClientes);

    if ( $numregistros > 0 ) {

        $hayDatos = 1;

        $totalImporteClientes = 0;
        $bloqueClientes = '';
        $bloqueClientes .= '<div class="clearfix"></div>';
        $bloqueClientes .= '<div id="listado-facturas" class="" />';
        $bloqueClientes .= '<div class="col-md-12">';
        $bloqueClientes .= '<strong>Facturas Clientes Asociadas:</strong>';
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
                $bloqueClientes .= '      <tr><td style="text-align:right" colspan=4><strong>Total Facturas de Clientes Asociadas: '.number_format($totalImporteClientes,2).'</strong></td></tr>';
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
        $bloqueCoste .= '<strong>Costes Asociados:</strong>';
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
            $bloqueCoste .= "       <td style='text-align:center'>".number_format($totalCosteImparticion,2)."</td>";
            $bloqueCoste .= "       <td style='text-align:center'>".number_format($totalCostesSalariales,2)."</td>";
            $bloqueCoste .= "       <td style='text-align:center'>".number_format($totalMaximoBonificable,2)."</td>";
            $bloqueCoste .= "       <td style='text-align:center'>".number_format($totalCostesIndirectos,2)."</td>";
            $bloqueCoste .= "       <td style='text-align:center'>".number_format($totalCostesOrganizacion,2)."</td>";
            $bloqueCoste .= "       <td style='text-align:center'>".number_format($totalImporteBonificar,2)."</td>";
            $bloqueCoste .= "       </tr>";
            $bloqueCoste .= '      </tbody>
        </table>
    </div>';

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
    $totalAdministracion = 0;
    $totalOtrosGastos = 0;
    $totalPrecioVenta = 0;
    $totalAlumnosEstimados = 0;
    $totalIngresos = 0;
    $totalGastos = 0;
    $totalMargenBeneficio = 0;

    $bloqueRentabilidad = '';

    $bloqueRentabilidad .= '<div class="col-md-12">';
    $bloqueRentabilidad .= '<strong>Detalle de Rentabilidad Previsto:</strong>';
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
            $totalAdministracion += $rowRentabilidad[administracion];
            $totalGastos += $rowRentabilidad[administracion];

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
            $bloqueRentabilidad .= ''.number_format($rowRentabilidad[porcentajeventas], 2).'%';
            $bloqueRentabilidad .= '</td>';
            $bloqueRentabilidad .= '<td style="text-align:center">';
            $bloqueRentabilidad .= ''.number_format($rowRentabilidad[ventasrequerido], 2).'%';
            $bloqueRentabilidad .= '</td>';
            $bloqueRentabilidad .= '<td style="text-align:center">';
            $bloqueRentabilidad .= ''.$rowRentabilidad[nalumnosnecesario].'';
            $bloqueRentabilidad .= '</td>';
        }

        // $bloqueRentabilidad .= '      <tr>';
        // $bloqueRentabilidad .= '        <td style="text-align:center">'.number_format($totalCosteAula,2).'</td>';
        // $bloqueRentabilidad .= '        <td style="text-align:center">'.number_format($totalCosteDocente,2).'</td>';
        // $bloqueRentabilidad .= '        <td style="text-align:center">'.number_format($totalFungiblesDidacticos,2).'</td>';
        // $bloqueRentabilidad .= '        <td style="text-align:center">'.number_format($totalAdministracion,2).'</td>';
        // $bloqueRentabilidad .= '        <td style="text-align:center">'.number_format($totalOtrosGastos,2).'</td>';
        // $bloqueRentabilidad .= '        <td style="text-align:center">'.number_format($totalPrecioVenta,2).'</td>';
        // $bloqueRentabilidad .= '        <td style="text-align:center">'.number_format($totalAlumnosEstimados,2).'</td>';
        // $bloqueRentabilidad .= '        <td style="text-align:center">'.number_format($totalIngresos,2).'</td>';
        // $bloqueRentabilidad .= '        <td style="text-align:center">'.number_format($totalGastos,2).'</td>';
        // $bloqueRentabilidad .= '        <td style="text-align:center">'.number_format($totalMargenBeneficio,2).'</h4></td>';
        // $bloqueRentabilidad .= '        <td colspan=3></td>';
        // $bloqueRentabilidad .= '        </tr>';
        $bloqueRentabilidad .= '      </tbody>
    </table>
</div>';

if ( ( $row['estado'] != "Facturada" ) && ( $row['estado'] != "Liquidada" ) ){

    $totalFinalGastos += $totalCosteDocente;
    $totalFinalGastos += $totalCosteAula;

}

// se suma SIEMPRE y son 312
$totalFinalGastos += $totalAdministracion;


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
    $bloqueFungibles .= '<strong>Detalle de Fungibles:</strong>';
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
        $bloqueFungibles .= '      <tr><td style="text-align:right" colspan=3><strong>Total Fungibles: '.number_format($totalfungibles, 2).'</strong></td></tr>';
        $bloqueFungibles .= '      </tbody>
    </table>
</div>';

// sumar solo si no hay factura
if (  ($row['estado'] != "Facturada" ) && ( $row['estado'] != "Liquidada" ) ) {
    $totalFinalGastos += $totalfungibles;
}

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
    $bloqueOtrosGastos .= '<strong>Detalle de Otros Gastos:</strong>';
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
            $bloqueOtrosGastos .= '      <tr><td style="text-align:right" colspan=3><strong>Total Otros Gastos: '.number_format($totalotrosgastos, 2).'</strong></td></tr>';
            $bloqueOtrosGastos .= '      </tbody>
        </table>
    </div>';

    if (  ($row['estado'] != "Facturada" ) && ( $row['estado'] != "Liquidada" ) ) {
        $totalFinalGastos += $totalotrosgastos;
    }

}

// BLOQUE DOCENTES
$qDocentes = "SELECT
    CONCAT(d.nombre, ' ', d.apellido, ' ', d.apellido2) as docente,
    md.numhorasdoc,
    d.preciohora,
    (md.numhorasdoc * d.preciohora) as total,
    d.situacionlaboral
    FROM mat_doc AS md
    INNER JOIN docentes AS d ON md.id_docente = d.id
    WHERE id_matricula = ".$id_matricula." AND situacionlaboral NOT IN ('Nomina','Generar')";

$qDocentes = mysqli_query($link, $qDocentes) or die("error Buscar Docentes:" .mysqli_error($link));

$numregistros6 = mysqli_num_rows($qDocentes);

if ( isRoot() ){
        // echo "Numregistro: ".$numregistros2;
}

if ( $numregistros6 > 0 ) {
    $bloqueDocentes = '';
    $bloqueDocentes .= '<div class="clearfix"></div>';
    $bloqueDocentes .= '<div class="col-md-12">';
    $bloqueDocentes .= '<strong>Coste de Docentes:</strong>';
    $bloqueDocentes .= '<table style="margin-top: 15px;" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th style="text-align:center">Docente</th>
            <th style="text-align:center">Precio Hora</th>
            <th style="text-align:center">Horas</th>
            <th style="text-align:center">Total</th>
        </tr>
    </thead>
    <tbody>';

    while ($rowDocentes = mysqli_fetch_array($qDocentes)) {
        $bloqueDocentes .= '          <tr>';
        $bloqueDocentes .= '              <td style="text-align:left">';
        $bloqueDocentes .= $rowDocentes['docente'];
        $bloqueDocentes .= '              </td>';
        $bloqueDocentes .= '              <td style="text-align:center">';
        $bloqueDocentes .= number_format($rowDocentes['preciohora'], 2);
        $bloqueDocentes .= '              </td>';
        $bloqueDocentes .= '              <td style="text-align:center">';
        $bloqueDocentes .= number_format($rowDocentes['numhorasdoc'], 2);
        $bloqueDocentes .= '              </td>';
        $bloqueDocentes .= '              <td style="text-align:center">';
        $bloqueDocentes .= number_format($rowDocentes['total'],2);
        $bloqueDocentes .= '              </td>';
        $bloqueDocentes .= '          </tr>';
        $totalDocentes += $rowDocentes['total'];
    }
    $bloqueDocentes .= '      <tr><td style="text-align:right" colspan=4><strong>Total Docentes: '.number_format($totalDocentes, 2).'</strong></td></tr>';

    $bloqueDocentes .= '      </tbody>
    </table>
    </div>';
}


// RESUMEN TOTAL
$bloqueResumenTotal = '';
$bloqueResumenTotal .= '<div class="clearfix"></div>';
$bloqueResumenTotal .= '<h3>Resumen:</h3>';
$bloqueResumenTotal .= '<div class="col-md-12">';
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
    echo $bloqueResumenTotal;
    echo "<hr>";

    if ( ( $row['estado'] == "Facturada" ) || ( $row['estado'] == "Liquidada" ) ){

        echo '<h3 style="margin-bottom: 35px">Rentabilidad Estimada</h3>';
        echo $bloqueRentabilidad;
        echo $bloqueFungibles;
        echo $bloqueOtrosGastos;
        echo '<div class="clearfix"></div>';
        echo "<hr>";
        echo '<h3 style="margin-bottom: 35px">Rentabilidad Real</h3>';
        echo $bloqueAcreedores;
        echo $bloqueClientes;
        echo $bloqueDocentes;

    } else {

        echo '<h3 style="margin-bottom: 35px">Rentabilidad Estimada</h3>';
        echo $bloqueRentabilidad;
        echo $bloqueFungibles;
        echo $bloqueOtrosGastos;
        echo '<div class="clearfix"></div>';
        echo "<hr>";
        echo '<h3 style="margin-bottom: 35px">Rentabilidad Real</h3>';
        echo $bloqueAcreedores;
        echo $bloqueCoste;
        echo $bloqueDocentes;

    }




} else {
    echo '<div class="col-md-12" style="text-align:center">No hay datos para la <strong>MATRÍCULA</strong> seleccionada.</div>';
}



echo '      </div>';
echo '    </div>';

// echo '<a id="imprimirDatosAccion" onclick="';
// //printDiv('datosaccion');
// echo '" style="margin-right: 32px;" class="pull-right btn btn-primary btn-default"><span class="glyphicon glyphicon-print"></span> Imprimir</a>';
echo '</form>';

}
?>
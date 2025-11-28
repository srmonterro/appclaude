<?

include './funciones.php';


$facturado_a = ' AND f.empresa = e.id ';
    $i = 0;

    // arrayText($_POST);
 foreach ($_POST as $key => $value) {

    // echo $key[bonificado];

    $comercial = ' AND e.comercial = c.id';
    // $costes = ' (SELECT SUM(DISTINCT mc.costes_imparticion)
    // FROM mat_costes mc where mc.id_matricula = @idmat) AS coste ';
    $costesemp1 = '';
    $costesemp2 = '';
    $grupo = '';


        if ( $value != "" ) {

            // if ($i>=3)
            //     $and = ' AND ';
            // $i++;

            // echo $key;
            // echo $i;
            if ($key == 'facturar_a') {
                // echo "entra";
                $facturado_a = ' AND f.facturar_a = e.id ';
                $fechas = '';
                // $in = ''; $like = ''; $fechas = ''; $grupo = '';
            }

            if ($key == 'bonificado') {

                    if ( $value == 'Cualquiera' ) {

                        $tabla = 'facturacion_bonificada';
                        $tabla1 = 'facturacion_privada';
                        $tabla2 = 'facturacion_rectificativa';
                        $todo = 1;
                        $camporectificar = '<th>Rectificar</th>';
                        $btnrectificar = '<a id="rectificarFactura" tabla="'.$tabla.'" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-edit"></span> </a>';

                    } else {

                        $camporectificar = '<th>Rectificar</th>';

                        if ( $value == 'bonificado' ) {
                            $tabla = 'facturacion_bonificada';
                        } else if ( $value == 'privado' ) {
                            $tabla = 'facturacion_privada';
                        } else {
                            $tabla = 'facturacion_rectificativa';
                            $btnrectificar = '';
                            $camporectificar = '';
                    }
                }

                $in = '';
                $like = ''; $fechas = ''; $grupo = '';
            }

            if ($key == 'numeroaccion') {

                $grupot = split("/", $value);
                $value = $grupot[0];
                if ($grupot[1] != "")
                    $grupo = ' AND ngrupo = '.$grupot[1];

                $in = ' AND '.$key.' IN '."('".$value."')";
                $like = '';
                $fechas = '';

            }

            // $_SESSION['anio']
            if ( $key == 'mes_fin' ) {
                $in = ' AND fechafin >= "'.$_SESSION['anio'].'-'.$value.'-01'.'" AND fechafin <= "'.$_SESSION['anio'].'-'.$value.'-'.date('t', strtotime($_SESSION['anio'].'/'.$value.'/01')).'"';
                // $in = ' AND fechafin >= "'.date('Y').'-'.$value.'-01'.'" AND fechafin <= "'.date('Y').'-'.$value.'-'.date('t', strtotime(date('Y').'/'.$value.'/01')).'"';
                $like = '';
                $fechas = '';
            }

            if ( $key == 'acumulado' ) {
                $mes = '01';
                $in = '';
                $like = '';
                $fechas = '';
                $grupo = '';
            }


            if ( $key == 'mes_vencimiento' ) {

                    // echo $mes;
                //if ( $ano == "" ) $ano = date('Y');
                if ( $ano == "" ) $ano = $_SESSION['anio'];
                if ($mes != '01') $mes = $value;
                $in = ' AND fecha_vencimiento >= "'.$ano.'-'.$mes.'-01'.'" AND fecha_vencimiento <= "'.$ano.'-'.$value.'-'.date('t', strtotime($ano.'/'.$value.'/01')).'"';

                $like = '';
                $fechas = '';
                $grupo = '';
            }

            if ( $key == 'anio_vencimiento' ) {
                // echo "ENTRA";
                $ano = $value;
                $in = '';
                $like = '';
                $fechas = '';
                $grupo = '';
            }


            if ( $key == 'estado' ) {
                // if ( $value == "Pendiente" )
                //     $in = ' AND f.'.$key.' IN '.'("'.$value.'")';
                // else
                    $in = ' AND f.'.$key.' IN '.'("'.$value.'")';
                $like = '';
                $fechas = '';
            }

            if ($key == 'denominacion') {
                $like = ' AND '.$key.' LIKE '."'%".$value."%'";
                $in = ''; $grupo = '';
                $fechas = '';
            }

            if ($key == 'razonsocial') {
                $like = ' AND '.$key.' LIKE '."'%".$value."%'";
                $in = ''; $grupo = '';
                $fechas = '';
            }

            if ($key == 'fechaini') {
                $fechas = ' AND f.fecha >= "'.$value.'"';
                $in = ''; $like = '';
                $grupo = ''; $value = '';
            }

            if ($key == 'fechafin') {
                $fechas = ' AND f.fecha <= "'.$value.'"';
                $in = ''; $like = '';
                $grupo = '';
                $value = '';
            }
            if ($key == 'numero') {

                $todo = 2;
                if ( strpos($value, 'P') !== FALSE ) {
                    $value = substr($value, 1);
                    $tabla = 'facturacion_privada';
                } else if ( strpos($value, 'R') !== FALSE ) {
                    $value = substr($value, 1);
                    $tabla = 'facturacion_rectificativa';
                } else {
                    $tabla = 'facturacion_bonificada';
                }

                $fechas = '';
                $in = ' AND f.'.$key.' IN '."('".$value."')";
                $like = '';
            }

            if ($key == 'grupoempresa') {

                $in = ' AND e.grupo IN '."('".$value."') AND e.grupo = g.id";
                $like = '';
                $fechas = '';
                $grupo = '';

            }
            if ($key == 'comercial') {

                // if ( $_SESSION['user'] == 'isabel' )
                    // $in = ' c.id IN '."('".$value."')";
                // else
                $in = ' AND c.id IN '."('".$value."')";
                $comercial = ' AND e.comercial = c.id ';
                $like = '';
                $fechas = '';
                $grupo = '';
            }

            if ($key == 'agente') {

                // if ( $_SESSION['user'] == 'isabel' )
                    // $in = ' c.id IN '."('".$value."')";
                // else
                $in = ' AND '.$key.' IN '."('".$value."')";
                $comercial = ' ';
                $like = '';
                $fechas = '';
                $grupo = '';
            }

            if ($key == 'formapago') {

                $in = ' AND e.formapago IN '."('".$value."')";
                $like = '';
                $fechas = '';
                $grupo = '';
            }

            // if ($key == 'formapago') {

            //     $in = ' AND e.formapago IN '."('".$value."')";
            //     $like = '';
            //     $fechas = '';
            //     $grupo = '';
            // }

            if ($key == 'modalidad') {

                if ($value == 'Presencial') $value = 'Presencial","Mixta';
                $in = ' AND '.$key.' IN ("'.$value.'")';
                $like = '';
                $fechas = '';
                $grupo = '';
            }

            if ($key == 'modalidad') {

                if ($value == 'Presencial') $value = 'Presencial","Mixta';
                $in = ' AND '.$key.' IN ("'.$value.'")';
                $like = '';
                $fechas = '';
                $grupo = '';
            }

            // if ($key == 'importe_a_abonar') {

            //     $in = ' AND '.$key.' IN ("'.$value.'")';
            //     $like = '';
            //     $fechas = '';
            //     $grupo = '';
            // }

            // if ($key == 'total_factura') {

            //     $in = ' AND '.$key.' IN ("'.$value.'")';
            //     $like = '';
            //     $fechas = '';
            //     $grupo = '';
            // }
            if ($key == 'importe_a_abonar') {

                $in = ' AND '.$key.' LIKE '.str_replace(",", ".", $value).'';
                $like = '';
                $fechas = '';
                $grupo = '';
            }

            if ($key == 'total_factura') {

                $in = ' AND '.$key.' LIKE '.str_replace(",", ".", $value).'';
                $like = '';
                $fechas = '';
                $grupo = '';
            }

            if ( $key == 'mes_factura' ) {
                //$in = ' AND fecha >= "'.date('Y').'-'.$value.'-01'.'" AND fecha <= "'.date('Y').'-'.$value.'-'.date('t', strtotime(date('Y').'/'.$value.'/01')).'"';

                $in = ' AND fecha >= "'.$_SESSION['anio'].'-'.$value.'-01'.'" AND fecha <= "'.$_SESSION['anio'].'-'.$value.'-'.date('t', strtotime($_SESSION['anio'].'/'.$value.'/01')).'"';
                $like = '';
                $fechas = '';
            }


            $campos .= $and.$fechas.$like.$in.$grupo;

        }


    }

    if ( isset($_SESSION[grupo]) )
        $campos .= ' AND e.grupo IN ("'.$_SESSION[grupo].'")';

    if ($todo == 1)

        $union = ' UNION
                        SELECT @idmat:=m.id as mat, ac.modalidad, e.razonsocial, ac.numeroaccion, ga.ngrupo, m.fechaini, m.fechafin, ac.denominacion, e.cif, e.iban,
                        f.cobrado, f.base_facturacion, f.igic, f.total_factura, f.importe_a_abonar, f.estado, f.prefijo, f.numero, f.fecha, f.id as idfac, f.fecha_vencimiento, c.nombre as nombrecomercial, f.facturar_a, e.formapago, f.IKEA, f.observacionesfra, f.costes_organizacion
                        FROM acciones ac, empresas e, grupos_acciones ga, matriculas m, '.$tabla1.' f, comerciales c, grupos_empresas g
                        WHERE ac.id = m.id_accion
                        '.$comercial.'
                        AND ga.id = m.id_grupo
                        AND f.matricula = m.id
                        '.$facturado_a.'
                        '.$campos.'
                        GROUP BY e.id,m.id,numero
                         UNION
                         SELECT @idmat:=m.id as mat, ac.modalidad, e.razonsocial, ac.numeroaccion, ga.ngrupo, m.fechaini, m.fechafin, ac.denominacion, e.cif, e.iban,
                        f.cobrado, f.base_facturacion, f.igic, f.total_factura, f.importe_a_abonar, f.estado, f.prefijo, f.numero, f.fecha, f.id as idfac, f.fecha_vencimiento, c.nombre as nombrecomercial, f.facturar_a, e.formapago, f.IKEA, f.observacionesfra, f.costes_organizacion
                        FROM acciones ac, empresas e, grupos_acciones ga, matriculas m, '.$tabla1.' f, comerciales c, grupos_empresas g
                        WHERE ac.id = m.id_accion
                        '.$comercial.'
                        AND ga.id = m.id_grupo
                        AND f.matricula = 0
                        '.$facturado_a.'
                        '.$campos.'
                        GROUP BY e.id,m.id,numero
                         UNION
                        SELECT @idmat:=m.id as mat, ac.modalidad, e.razonsocial, ac.numeroaccion, ga.ngrupo, m.fechaini, m.fechafin, ac.denominacion, e.cif, e.iban,
                        f.cobrado, f.base_facturacion, f.igic, f.total_factura, f.importe_a_abonar, f.estado, f.prefijo, f.numero, f.fecha, f.id as idfac, f.fecha_vencimiento, c.nombre as nombrecomercial, f.facturar_a, e.formapago, f.IKEA, f.observacionesfra, "" as costes_organizacion
                        FROM acciones ac, empresas e, grupos_acciones ga, matriculas m, '.$tabla2.' f, comerciales c, grupos_empresas g
                        WHERE ac.id = m.id_accion
                        '.$comercial.'
                        AND ga.id = m.id_grupo
                        AND f.matricula = m.id
                        '.$facturado_a.'
                        '.$campos.'
                        GROUP BY e.id,m.id,numero';

    if($tabla != 'facturacion_rectificativa'){
        $q = 'SELECT @idmat:=m.id as mat, ac.modalidad, e.razonsocial, ac.numeroaccion, ga.ngrupo, m.fechaini, m.fechafin, ac.denominacion, e.cif, e.iban,
            f.cobrado, f.base_facturacion, f.igic, f.total_factura, f.importe_a_abonar, f.estado, f.prefijo, f.numero, f.fecha, f.id as idfac, f.fecha_vencimiento, c.nombre as nombrecomercial, f.facturar_a, e.formapago, f.IKEA, f.observacionesfra, f.costes_organizacion
            FROM acciones ac, empresas e, grupos_acciones ga, matriculas m, '.$tabla.' f, comerciales c, grupos_empresas g
            WHERE ac.id = m.id_accion
            '.$comercial.'
            AND ga.id = m.id_grupo
            AND f.matricula = m.id
            '.$facturado_a.'
            '.$campos.'
            GROUP BY e.id,m.id,numero'
            .$union.'
            ORDER BY numero DESC';
    }else{
        $q = 'SELECT @idmat:=m.id as mat, ac.modalidad, e.razonsocial, ac.numeroaccion, ga.ngrupo, m.fechaini, m.fechafin, ac.denominacion, e.cif, e.iban,
            f.cobrado, f.base_facturacion, f.igic, f.total_factura, f.importe_a_abonar, f.estado, f.prefijo, f.numero, f.fecha, f.id as idfac, f.fecha_vencimiento, c.nombre as nombrecomercial, f.facturar_a, e.formapago, f.IKEA, f.observacionesfra, "" as costes_organizacion
            FROM acciones ac, empresas e, grupos_acciones ga, matriculas m, '.$tabla.' f, comerciales c, grupos_empresas g
            WHERE ac.id = m.id_accion
            '.$comercial.'
            AND ga.id = m.id_grupo
            AND f.matricula = m.id
            '.$facturado_a.'
            '.$campos.'
            GROUP BY e.id,m.id,numero'
            .$union.'
            ORDER BY numero DESC';
    }


    if ( $_SESSION['user'] == 'isabel' ) {

        if ($todo == 1)

        $union = ' UNION
                        SELECT @idmat:=m.id as mat, ac.modalidad, e.razonsocial, ac.numeroaccion, ga.ngrupo, m.fechaini, m.fechafin, ac.denominacion, e.cif, e.iban,
                        f.cobrado, f.base_facturacion, f.igic, f.total_factura, f.importe_a_abonar, f.estado, f.prefijo, f.numero, f.fecha, f.id as idfac, f.fecha_vencimiento, c.nombre as nombrecomercial, f.facturar_a, e.formapago, f.IKEA, f.observacionesfra, f.costes_organizacion
                        FROM acciones ac, empresas e, grupos_acciones ga, matriculas m, '.$tabla1.' f, comerciales c, grupos_empresas g
                        WHERE ac.id = m.id_accion
                        '.$comercial.'
                        AND c.id IN (3,10,7,12,11)
                        AND ga.id = m.id_grupo
                        AND f.matricula = m.id
                        '.$facturado_a.'
                        '.$campos.'
                        GROUP BY e.id,m.id
                         UNION
                        SELECT @idmat:=m.id as mat, ac.modalidad, e.razonsocial, ac.numeroaccion, ga.ngrupo, m.fechaini, m.fechafin, ac.denominacion, e.cif, e.iban,
                        f.cobrado, f.base_facturacion, f.igic, f.total_factura, f.importe_a_abonar, f.estado, f.prefijo, f.numero, f.fecha, f.id as idfac, f.fecha_vencimiento, c.nombre as nombrecomercial, f.facturar_a, e.formapago, f.IKEA, f.observacionesfra, "" as costes_organizacion
                        FROM acciones ac, empresas e, grupos_acciones ga, matriculas m, '.$tabla2.' f, comerciales c
                        WHERE ac.id = m.id_accion
                        '.$comercial.'
                        AND c.id IN (3,10,7,12,11)
                        AND ga.id = m.id_grupo
                        AND f.matricula = m.id
                        '.$facturado_a.'
                        '.$campos.'
                        GROUP BY e.id,m.id';

        if($tabla != 'facturacion_rectificativa'){
            $q = 'SELECT @idmat:=m.id as mat, ac.modalidad, e.razonsocial, ac.numeroaccion, ga.ngrupo, m.fechaini, m.fechafin, ac.denominacion, e.cif, e.iban,
                f.cobrado, f.base_facturacion, f.igic, f.total_factura, f.importe_a_abonar, f.estado, f.prefijo, f.numero, f.fecha, f.id as idfac, f.fecha_vencimiento, c.nombre as nombrecomercial, f.facturar_a, e.formapago, f.IKEA, f.observacionesfra, f.costes_organizacion
                FROM acciones ac, empresas e, grupos_acciones ga, matriculas m, '.$tabla.' f, comerciales c
                WHERE ac.id = m.id_accion
                '.$comercial.'
                AND c.id IN (3,10,7,12,11)
                AND ga.id = m.id_grupo
                AND f.matricula = m.id
                '.$facturado_a.'
                '.$campos.'
                GROUP BY e.id,m.id'
                .$union.'
                ORDER BY numero DESC';
        }else{
            $q = 'SELECT @idmat:=m.id as mat, ac.modalidad, e.razonsocial, ac.numeroaccion, ga.ngrupo, m.fechaini, m.fechafin, ac.denominacion, e.cif, e.iban,
            f.cobrado, f.base_facturacion, f.igic, f.total_factura, f.importe_a_abonar, f.estado, f.prefijo, f.numero, f.fecha, f.id as idfac, f.fecha_vencimiento, c.nombre as nombrecomercial, f.facturar_a, e.formapago, f.IKEA, f.observacionesfra, "" as costes_organizacion
            FROM acciones ac, empresas e, grupos_acciones ga, matriculas m, '.$tabla.' f, comerciales c
            WHERE ac.id = m.id_accion
            '.$comercial.'
            AND c.id IN (3,10,7,12,11)
            AND ga.id = m.id_grupo
            AND f.matricula = m.id
            '.$facturado_a.'
            '.$campos.'
            GROUP BY e.id,m.id'
            .$union.'
            ORDER BY numero DESC';
        }

    }

    if ( isRoot() ) {
        
        //echo $q;
    }

    // echo '<span style="display:none" id="sql">'.$q.'</span>';

    $q = mysqli_query($link, $q) or die("error: ".mysqli_error($link) );


    echo '<table style="margin-top: 15px;" class="table">
                <thead>
                    <tr>
                        <th style="text-align:center">Nº</th>
                        <th style="text-align:center">Fecha</th>
                        <th style="text-align:center">Grupo</th>
                        <th style="text-align:center">Denominación</th>
                        <th style="text-align:center">Empresa</th>
                        <th style="text-align:center">CIF</th>
                        <th style="text-align:center">Base Imponible</th>
                        <th style="text-align:center">I.G.I.C</th>
                        <th style="text-align:center">Total</th>
                        <th style="text-align:center">Cobrado</th>
                        <th style="text-align:center">Pendiente</th>
                        <th style="text-align:center">Vencimiento</th>
                        <th style="text-align:center">Pago</th>
                        <th style="text-align:center">Fecha de Cobro</th>
                        <th style="text-align:center">Observ.Cobro</th>
                        <th style="text-align:center">Detalle</th>'
                        .$camporectificar.'
                    </tr>
                </thead>
                <tbody>';

    $i=0;
    while ( $row = mysqli_fetch_assoc($q) ) {


        // arrayText($row);

        // if ( $row[IKEA] != 1 ) {
        $readmore = '...<br><a id="obscuest" href="#" obs="'.$row[observacionesfra].'">Leer más</a>';

        $id_total_facturas = 'total_facturas';
        $id_pendiente = 'pendiente';
        $id_comision = 'comision';
        $prefijo = $row[prefijo];

        // if ( $prefijo == 'R' ) $id_total_facturas = '';

        if ( $row[estado] == 'Rectificada' || $prefijo == 'R' ) {
            $id_total_facturas = '';
            $id_pendiente = '';
            $id_comision = '';
        }

        if ( $prefijo == 'R') $rectificativa = ' rectificativa '; else $rectificativa = ' ';
        $numero = $row[numero];
        $numerof = $prefijo.$numero;
        $empresa = quitaTildesConComas($row[razonsocial]);
        $nombreFichero = 'facturacion'.$gestion.'/facturas/'.$numerof.'_'.$empresa.'_'.$row[numeroaccion].'-'.$row[ngrupo].'.pdf';
        $nombreFicheroMail = 'facturas/'.$numerof.'_'.$empresa.'_'.$row[numeroaccion].'-'.$row[ngrupo].'.pdf';

        // $titulo = 'Factura'.$rectificativa.'acción formativa '.$row[numeroaccion].'/'.$row[ngrupo].' - '.$row[razonsocial].' - '.$row[modalidad];


        if ( $row[cobrado] > 0 && $row[importe_a_abonar] > 0 ) $row[estado] = 'PendienteAlgo';
        else if ( $row[importe_a_abonar] < 0 ) $row[estado] = 'CobradoMas';

        $color = colorFacturas($row[estado]);
        echo '<tr style="font-size:10px" class="'.$color.'">';
        echo '<td id="id" style="display:none">'.$row[idfac].'</td>';
        echo '<td id="numero">'.$row[prefijo].$row[numero].'</td>';
        echo '<td id="fecha">'.formateaFecha($row[fecha]).'</td>';
        echo '<td id="grupo">'.$row[numeroaccion].'/'.$row[ngrupo].'</td>';
        echo '<td id="mat">'.$row[denominacion].'</td>';

        if ($row[facturar_a] != 0) {
            $q4 = 'SELECT e.razonsocial as razonsocialfac, e.cif as ciffac, e.domiciliofiscal, e.domiciliosocial, e.codigopostal, e.poblacion, e.provincia, email_facturas, c.nombre
            FROM empresas e, comerciales c
            WHERE e.comercial = c.id
            AND e.id = '.$row[facturar_a];
            $q4 = mysqli_query($link, $q4);
            $r4 = mysqli_fetch_array($q4);

            $titulo = 'Factura'.$rectificativa.'acción formativa '.$row[numeroaccion].'/'.$row[ngrupo].' - '.$r4[razonsocialfac].' - '.$row[modalidad];
            echo '<td style="text-align: center">'.$r4[razonsocialfac].'</td>';
            echo '<td style="text-align: center">'.$r4[ciffac].'</td>';
            //echo '<td style="text-align: center" id="comercial">'.$r4[nombre].'</td>';
        } else {
            $titulo = 'Factura'.$rectificativa.'acción formativa '.$row[numeroaccion].'/'.$row[ngrupo].' - '.$row[razonsocial].' - '.$row[modalidad];
            echo '<td style="text-align: center">'.$row[razonsocial].'</td>';
            echo '<td style="text-align: center">'.$row[cif].'</td>';
            //echo '<td style="text-align: center" id="comercial">'.$row[nombrecomercial].'</td>';
            echo '<td id="basefra" style="text-align: center">'.number_format($row[base_facturacion],2,',','').'</td>';
            echo '<td id="igic" style="text-align: center">'.number_format($row[igic],2,',','').'</td>';
        }

        $fechamail = compruebaEnvioEmailFac($titulo, $link);

        if ( $fechamail != 0 )
            $esta = 'green';
        else $esta = 'red';

        // if($row[costes_organizacion]>0){
        //     echo '<td id="'.$id_total_facturas.'" style="text-align: center"></td>';
        // }else{
            echo '<td id="'.$id_total_facturas.'" style="text-align: center">'.number_format($row[total_factura],2,',','').'</td>';
        //}
        echo '<td id="cobrado" style="text-align: center">'.number_format($row[cobrado],2,',','').'</td>';
        echo '<td id="'.$id_pendiente.'" style="text-align: center">'.number_format($row[importe_a_abonar],2,',','').'</td>';
        echo '<td id="vencimiento" style="text-align: center">'.formateaFecha($row[fecha_vencimiento]).'</td>';
        echo '<td id="formapago" style="text-align: center">'.$row[formapago].'</td>';
        if ($row[cobrado] != 0) {
            $numeroFactura = (int)$row['numero'];
$prefijo = strtoupper(trim($row['prefijo']));
if ($prefijo == '') {
    $prefijo = 'B'; // Bonificadas no tienen prefijo en listado, pero sí en conciliaciones
}

$q5 = 'SELECT cc.fecha, cc.observaciones
       FROM conciliaciones cc
       WHERE cc.factura = '.$numeroFactura.' AND cc.tipo = "'.$prefijo.'"';


$q5 = mysqli_query($link, $q5);
$r5 = mysqli_fetch_array($q5);

        echo '<td id="numcuenta" style="text-align: center">'.formateaFecha($r5[fecha]).'</td>';
        echo '<td id="formapago" style="width: 10px; font-size: 8px; text-align: center ">'.$r5[observaciones].'</td>';
        } else {
        echo '<td id="numcuenta" style="text-align: center"></td>';
        echo '<td id="compmailfac" style="text-align: center"></td>';
        }

        if ( $prefijo == 'R' ) $tabla = 'facturacion_rectificativa';
        else if ( $prefijo == 'P' ) $tabla = 'facturacion_privada';
        else $tabla = 'facturacion_bonificada';
        // if ( $_SESSION[user] != manolo ) {
            echo '<td style="text-align: center"><a id="detalleFactura" tabla="'.$tabla.'" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-list-alt"></span> </a></td>';
        // }

        //echo '<td style="text-align: center"><span id="compmailfac" style=" font-size: 14px; color: '.$esta.';" class="glyphicon glyphicon-ok-circle"></span></td>';
        echo '<td style="text-align: center">';
        $btnrectificar = '<a id="rectificarFactura" tabla="'.$tabla.'" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-edit"></span> </a>';

        if ( $row[prefijo] != 'R' ) {

            if ( $_SESSION[user] != agamez ) {
                echo $btnrectificar;
            }

        }
        echo '</td>';
        echo '</tr>';

        // }

    }
    echo '</tbody>
        </table>';

?>


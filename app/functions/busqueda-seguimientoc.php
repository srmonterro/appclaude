<?

include './funciones.php';



    $i = 0;
 foreach ($_POST as $key => $value) {

    $comercial = '( (m.comercial = c.id AND m.comercial <> 0) OR (e.comercial = c.id) )';
    $costes = ' (SELECT SUM(DISTINCT mc.costes_imparticion)
    FROM mat_costes mc where mc.id_matricula = @idmat) AS coste ';
    $costesemp1 = '';
    $costesemp2 = '';
    $grupo = '';


        if ( $value != "" ) {

            if ($i>=1)
                $and = ' AND ';
            $i++;

            if ($key == 'nombre') {
                $like = 'co.nombre LIKE '."'%".$value."%'";
                $in = ''; $grupo = '';
                $fechas = '';
            }

            if ($key == 'razonsocial') {
                $like = $key.' LIKE '."'%".$value."%'";
                $costes = ' (SELECT DISTINCT mc.costes_imparticion
                FROM mat_costes mc, mat_alu_cta_emp ma, empresas e, acciones a, matriculas m
                WHERE ma.id_matricula = mc.id_matricula
                AND m.id = ma.id_matricula
                AND a.id = m.id_accion
                AND e.id = ma.id_empresa
                AND mc.id_matricula = @idmat
                AND mc.id_empresa = @idemp) as coste ';
                $costesemp1 = ' @idemp:=e.id, ';
                $costesemp2 = ', @idemp:=e.id ';
                $costesemp3 = ', @idemp:=e.id ';
                $in = ''; $grupo = '';
                $fechas = '';
            }

            if ($key == 'comercial') {
                $in = ' c.id IN '."('".$value."')";
                $comercial = '( (m.comercial = c.id AND '.$in.') OR (e.comercial = c.id AND m.comercial IN ("0") ) ) ';
                $like = '';
                $fechas = '';
                $grupo = '';
            }

            if ($key == 'fechafin') {
                $in = ' '.$key.' <= '."'".$value."'";
                $like = ''; $grupo = '';
                $fechas = '';
            }

            // if ($key == 'numeroaccion') {

            //     $grupot = split("/", $value);
            //     $value = $grupot[0];
            //     if ($grupot[1] != "")
            //         $grupo = ' AND ngrupo = '.$grupot[1];

            //     $in = ' '.$key.' IN '."('".$value."')";
            //     $like = '';
            //     $fechas = '';

            // }

            // if ($key == 'docente') {
            //     $key = 'id_docente';
            //     $in = ' '.$key.' IN '."('".$value."')";
            //     $like = '';
            //     $fechas = '';
            // }

            // if ($key == 'progreso') {
            //     $progre = split("-", $value);
            //     $in = ' '.$key.' BETWEEN '.$progre[0].' AND '.$progre[1];
            //     $like = '';
            //     $fechas = '';
            // }

            // if ($key == 'fechaini') {
            //     $fechas = ' '.$key.' > "'.$value.'"';
            //     $in = ''; $like = '';
            //     $value = '';
            // }

            // if ($key == 'fechafin') {
            //     $fechas = ' '.$key.' < "'.$value.'"';
            //     $in = ''; $like = '';
            //     $value = '';
            // }

            // if ($key == 'bonificado') {

            //     $key = 'ngrupo';
            //     if ( $value == 'bonificado' )
            //         $in = ' '.$key.' NOT LIKE "%p%"';
            //     else if ( $value == 'privado' )
            //         $in = ' '.$key.' LIKE "%p%"';

            //     $fechas = ''; $like = '';
            // }

            $campos .= $and.$fechas.$like.$in.$grupo;

        }

    }


        $q = 'SELECT DISTINCT ac.numeroaccion, ac.modalidad, ga.ngrupo, ac.denominacion, m.fechaini, m.fechafin, e.razonsocial, c.nombre as comercial, mc.costes_imparticion as coste, m.estado as estadomat, f.estado as estadofac, e.agente, e.iban, e.formapago, mc.costes_imparticion as costet, co.*, co.nombre as comisionistanombre
        FROM alumnos a, acciones ac, matriculas m, mat_alu_cta_emp ma, empresas e, grupos_acciones ga, comerciales c, mat_costes mc, comisionistas co, facturacion_privada f
        WHERE m.id = ma.id_matricula
        AND f.matricula = m.id
        AND f.empresa = e.id
        AND e.comercial = c.id
        AND ma.id_alumno = a.id
        AND m.id_grupo = ga.id
        AND m.id_accion = ac.id
        AND ma.id_empresa = e.id
        AND mc.id_matricula = ma.id_matricula
        AND co.id = e.comisionista
        AND mc.id_empresa = ma.id_empresa
        AND ma.tipo = "Privado"
        AND mc.mes_bonificable = 0
        AND m.estado IN ("Finalizada", "Facturada","Liquidada")
        AND '.$campos.'
        UNION
        SELECT DISTINCT ac.numeroaccion, ac.modalidad, ga.ngrupo, ac.denominacion, m.fechaini, m.fechafin, e.razonsocial, c.nombre as comercial, mc.costes_imparticion as coste, m.estado as estadomat, f.estado as estadofac, e.agente, e.iban, e.formapago, mc.costes_imparticion as costet, co.*, co.nombre as comisionistanombre
        FROM alumnos a, acciones ac, matriculas m, mat_alu_cta_emp ma, empresas e, grupos_acciones ga, comerciales c, mat_costes mc, comisionistas co, facturacion_bonificada f
        WHERE m.id = ma.id_matricula
        AND f.matricula = m.id
        AND f.empresa = e.id
        AND e.comercial = c.id
        AND ma.id_alumno = a.id
        AND m.id_grupo = ga.id
        AND m.id_accion = ac.id
        AND ma.id_empresa = e.id
        AND mc.id_matricula = ma.id_matricula
        AND co.id = e.comisionista
        AND mc.id_empresa = ma.id_empresa
        AND m.estado IN ("Finalizada", "Facturada","Liquidada")
        AND ma.tipo = ""
        AND mc.mes_bonificable <> 0
        AND '.$campos.'
        ORDER BY numeroaccion, ngrupo';


    if ( isRoot() ) {
    //    echo $q;
    }

    $q = mysqli_query($link, $q) or die("error" . mysqli_error($link));


    echo '<table style="margin-top: 15px;" class="table">
                <thead>
                    <tr>
                        <th>Nº</th>
                        <th>Comisionista</th>
                        <th>Acción</th>
                        <th>Denominación</th>
                        <th>Empresa</th>
                        <th>Comercial</th>
                        <th>Importe</th>
                        <th>%Comisión</th>
                        <th>Comisión</th>
                        <th>Estado<br>Factura</th>
                    </tr>
                </thead>
                <tbody>';

    $i=0;
    $total=0;
    while ( $row = mysqli_fetch_assoc($q) ) {


        $color = colorFacturas($row[estadofac]);
        echo '<tr style="font-size:11px" class="'.$color.'">';
        echo '<td>'. ++$i .'</td>';
        echo '<td>'.$row[comisionistanombre].'</td>';
        echo '<td>'.$row[numeroaccion].'/'.$row[ngrupo].'</td>';
        echo '<td>'.$row[denominacion].'</td>';
        echo '<td>'.$row[razonsocial].'</td>';
        echo '<td>'.$row[nombre].' '.$row[apellido].'</td>';
        echo "<td>".$row[coste]."</td>";
        // echo '<td style="width:10%">'.number_format($row[coste],2,',','.'). ' €</td>';

        echo '<td id="porcentajecomision">';
        echo $row[porcentajeformacion].' %';
        // if ($row[porcentajeformacion] == 0) {
        //     if ($row[importeformacion] != 0)
        //         echo round( (($row[importeformacion]*100)/$row[coste]), 2 ).' %';
        //     else
        //         echo "- €";
        // } else echo $row[importeformacion].' €';
        echo '</td>';

        echo '<td id="importecomision">';
        // echo '<td>'.number_format($row[coste],2,'.','').'</td>';
        echo round((number_format($row[coste],2,'.',''))*(($row[porcentajeformacion])/100),2) .' €</td> ';

        echo '</td>';
        echo "<td>$row[estadofac]</td>";
        echo '</tr>';

        if ( $row[estadofac] != 'Pendiente' )
            $total += round((number_format($row[coste],2,'.',''))*(($row[porcentajeformacion])/100),2);

    }
    echo '</tbody>
        <tr><td colspan="7"></td><td class="success">Total: </td><td colspan="2" style="text-align:center; font-size: 16px" class="success"><strong>'.$total.' €</strong></td></tr>
        </table>';



?>


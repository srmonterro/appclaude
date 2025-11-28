<?
include_once './funciones.php';
include_once './costes.php';

$gestion = devuelveAnio();


if ($_POST['devolvermatpre'] == '1')  {
    devolverDatosMatriculaPre($_POST['id'], $_POST['tabla'], $link);
} else if ($_POST['grupo'] != '') {
    devuelvoGrupoEmpresa($_POST['grupo'], $_POST['tipo'], $gestion, $link);
} else if ($_POST['verempresaspre'] == '1') {
    mostrarEmpresasPre($_POST['id'], $link);
} else if ($_POST['verempresaspre'] == '2') {
    mostrarEmpresasPreIK($_POST['id'], $link);
} else if ($_POST['mostraralumnosemppre'] == '1') {
    mostrarAlumnosEmpPre($_POST['id_matricula'], $_POST['id_empresa'], $_POST['tipo'], $link);
} else if ($_POST['mostraralumnosemppre'] == '2') {
    mostrarAlumnosEmpPrePrivado($_POST['id_matricula'], $_POST['id_empresa'], $_POST['tipo'], $link);
} else if ($_POST['mostrarcostesemp'] == '1') {
    mostrarCostesEmp($_POST['id_matricula'], $_POST['id_empresa'], $link);
} else if ($_POST['mostrarfinpresencial'] == '1') {
    mostrarEmpresasPreFin($_POST['id_matricula'], $link);
} else if ($_POST['mostrarfinpresencial'] == '2') {
    mostrarEmpresasPreFinPrivado($_POST['id_matricula'], $link);
} else if ($_POST['verdocentespre'] == '1') {
    mostrarDocentesPre($_POST['id'], $link);
} else if ($_POST['devuelvefechasex'] == '1') {
    devuelveFechasExcluir($_POST['id_matricula'], $_POST[tipo], $link);
} else if ($_POST['devuelvefechasex'] == '2') {
    devuelveFechasExcluir($_POST['id_matricula'], $_POST[tipo], $link);
} else if ($_POST['fechasexcluir'] == '1') {
    guardarFechasExcluir($_POST['id_matricula'], $_POST[tipo], $link);
} else if ($_POST['actualizarfechasex'] == '1') {
    actualizarFechasExcluir($_POST['id_fecha'], $_POST['fecha'], $link);
} else if ($_POST['verdocentesmix'] == '1') {
    mostrarDocentesMix($_POST['id'], $_POST['tipo'], $link);
} else if ($_POST['diploma_empresa'] == '1') {
    devuelveListaDiplomasEmpresa($_POST, $link);
} else if ($_POST['datosempresa'] == '1') {
    devuelveDatosEmpresa($_POST['id_matricula'], $link);
} else if ($_POST['eliminaralumnopre'] == '1') {
    eliminarAlumnoDeMatriculaPre($_POST['id_matricula'], $_POST['id_alumno'], $link);
} else  if ($_POST['eliminardematriculapre'] == '1') {

    if ($_POST['id_docente'] != "")
        eliminarDocenteDeMatriculaPre($_POST, $link);
    else if ($_POST['id_empresa'] != "")
        eliminarEmpresaDeMatriculaPre($_POST, $link);

} else  if ($_POST['eliminardematriculagrup'] == '1') {
    eliminarEmpresaDeMatriculaGrup($_POST, $link);
} else  if ($_POST['eliminardematriculapre'] == '1') {
    eliminarEmpresaDeMatriculaPre($_POST, $link);
} else  if ($_POST['partesdiploma'] == '1') {
    diplomaPorPartes($_POST, $link);
} else  if ($_POST['partesdiplomanv'] == '1') {
    diplomaPorPartesAnversos($_POST, $link);
} else if ($_POST['devuelvefechasin'] == '1') {
    devuelveFechasIncluir($_POST['id_matricula'], $_POST['tipo'], $_POST['sec'], $link);
} else if ($_POST['actualizarfechasinc'] == '1') {
    actualizarFechasIncluir($_POST['id_fecha'], $_POST['dia'], $_POST['horariomini'], $_POST['horariomfin'], $_POST['horariotini'], $_POST['horariotfin'], $_POST['tipo'], $_POST['sec'], $link);
} else if ($_POST['guardarobservacionesfin'] == '1') {
    guardarObservacionesFin($_POST['idmat'], $_POST['observacionesfin'], $link);
} else if ($_POST['guardarobservacionesfinamanda'] == '1') {
    guardarObservacionesFinAmanda($_POST['idmat'], $_POST['observacionesfin'], $link);
} else if ($_POST['guardarincidenciasfinamanda'] == '1') {
    guardarIncidenciasFinAmanda($_POST['idmat'], $_POST['incidenciasfin'], $link);
} else if ($_POST['borrarempresaik'] == '1') {
    borrarEmpresaIK($_POST[idsol],$_POST[idemp],$link);
} else if ($_POST['matguardarcuenta'] == '1') {
    matGuardarCuenta($_POST['id_alu'], $_POST['id_mat'], $_POST['numerocuenta'], $link);
} else
    matricular_presencial($_POST, $link);



function matGuardarCuenta($idalu, $idmat, $numerocuenta, $link) {

    $q = 'UPDATE mat_alu_cta_emp SET id_empresa = "'.$numerocuenta.'"
    WHERE id_matricula = "'.$idmat.'" AND id_alumno = "'.$idalu.'"';
    echo $q;
    $q = mysqli_query($link, $q) or die ("error ".mysqli_error($link));

}

function devuelveFechasIncluir($id_matricula, $tipo, $sec = NULL, $link) {

    if ( $sec == 'tpc' ) {
        $q = 'SELECT c.fecha as dia, c.*
        FROM cursos_tpc_horarios c
        WHERE c.id_curso = "'.$id_matricula.'"';
    } else {
        $q = 'SELECT id, dia, horariomini, horariomfin, horariotini, horariotfin
        FROM fechas_incluir
        WHERE id_matricula = '.$id_matricula.' AND tipo = "'.$tipo.'"';
    }


    // echo $q;
    $q = mysqli_query($link, $q);
    $r = mysqli_num_rows($q);
    while ( $row = mysqli_fetch_array($q) ) {
        echo '
            <div id="fechasincluir" style="margin-top: 15px; overflow: auto;">
                    <div style="margin-bottom: 15px" class="col-md-5">
                        <div class="form-group">
                            <label class="control-label" for="fechasinc">Fecha a incluir:</label><input value="'.$row[dia].'" type="date" id="dia'.$row[id].'" name="dia" class="form-control"/>
                        </div>
                    </div>
                    <div class="clearfix">
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label" for="horariomini">Horario Mañana (inicio):</label><input value="'.$row[horariomini].'" type="text" id="horariomini'.$row[id].'" name="horariomini" class="form-control"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label" for="horariomfin">Horario Mañana (fin):</label><input value="'.$row[horariomfin].'" type="text" id="horariomfin'.$row[id].'" name="horariomfin" class="form-control"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label" for="horariotini">Horario Tarde (inicio):</label><input value="'.$row[horariotini].'" type="text" id="horariotini'.$row[id].'" name="horariotini" class="form-control"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label" for="horariotfin">Horario Tarde (fin):</label><input value="'.$row[horariotfin].'" type="text" id="horariotfin'.$row[id].'" name="horariotfin" class="form-control"/>
                        </div>
                    </div>
                    <div style=" width: 100%; margin-top: 5px; margin-bottom: 10px;" class="col-md-1">
                        ';
                        if ( $tipo == 'p' )
                            echo '<a id="actualizarfechasinc" valor="'.$row[id].'" class="btn btn-xs btn-success pull-left">Actualizar</a>';
                        else
                            echo '<a id="actualizarfechasincod" valor="'.$row[id].'" class="btn btn-xs btn-success pull-left">Actualizar</a>';
                    echo '</div>
                </div>
            </div>';
    }
    if ( $r > 0 )
        echo ' <span class="fin_fecha_ex"></span>';

}

function actualizarFechasIncluir($id_fecha, $dia, $horariomini, $horariomfin, $horariotini, $horariotfin, $tipo, $sec = NULL, $link) {

    if ( $sec == 'tpc' ) {
        $q = 'UPDATE cursos_tpc_horarios SET fecha = "'.$dia.'", horariomini = "'.$horariomini.'", horariomfin = "'.$horariomfin.'",
        horariotini = "'.$horariotini.'", horariotfin = "'.$horariotfin.'"
        WHERE id = '.$id_fecha;
    } else {
        $q = 'UPDATE fechas_incluir SET dia = "'.$dia.'", horariomini = "'.$horariomini.'", horariomfin = "'.$horariomfin.'",
        horariotini = "'.$horariotini.'", horariotfin = "'.$horariotfin.'"
        WHERE id = '.$id_fecha. ' AND tipo = "'.$tipo.'"';
    }
    // echo $q;
    mysqli_query($link, $q) or die ("error".mysqli_error($link));
}

function diplomaPorPartesAnversos($valores, $link) {

    $id_matricula = $valores[id_mat];

    $sec = explode("?",$_SERVER['HTTP_REFERER']);
    if ($sec[1] == 'form_matricula_doc' || $sec[1] == 'form_matricula_doc#')
        $grupal = 1;

    $q = 'SELECT m.estado
    FROM matriculas m
    WHERE m.id = '.$id_matricula;
    $q = mysqli_query($link, $q);
    $row = mysqli_fetch_row($q);
    $estado = $row[0];

    if ( $estado == 'Finalizada' || $estado == 'Facturada' || $estado == 'Gratuita' || $grupal == 1 ) {
        if ( $valores[tipo] == 'bonif' ) {

            $q = 'SELECT DISTINCT count(id_alumno) as ndiplomas
            FROM mat_alu_cta_emp ma, empresas e, alumnos a
            WHERE ma.id_alumno = a.id
            -- AND ma.finalizado = 1
            AND ma.id_empresa = e.id
            AND ma.tipo = ""
            AND ma.id_matricula = '.$id_matricula;
            // $botondiploma = "genera_diploma_anverso_nobonif";
        } else {
            $q = 'SELECT DISTINCT count(id_alumno) as ndiplomas
            FROM mat_alu_cta_emp ma, empresas e, alumnos a
            WHERE ma.id_alumno = a.id
            -- AND ma.finalizado = 1
            AND ma.id_empresa = e.id
            AND ma.tipo = "Privado"
            AND ma.id_matricula = '.$id_matricula;
            // $botondiploma = "genera_diploma_anverso";
        }
    } else {

        if ( $valores[tipo] == 'privado' ) {

            $tablasbonifono = "temp_alumnosp a, temp_empresasp e";
            // $botondiploma = "genera_diploma_anverso_nobonif";

        } else {

            $tablasbonifono = "temp_alumnos a, temp_empresas e";
            // $botondiploma = "genera_diploma_anverso";
        }

        $q = 'SELECT count(*) as ndiplomas
        FROM '.$tablasbonifono.'
        WHERE a.id_empresa = e.id
        AND e.id_matricula = '.$id_matricula.'
        AND e.id_matricula = a.id_matricula';
    }

    // echo $q;
    $q = mysqli_query($link, $q);
    $ndiplomas = mysqli_fetch_row($q);
    $ndiplomas = $ndiplomas[0];

    $nbotones = intval($ndiplomas / 10);

    $resto = $ndiplomas % 10;
    // echo $resto;

    if ( $resto != 0 ) $nbotones++;

    echo '<div style="text-align:center; margin: 15px 0 5px 0" class="col-md-12">
    <p><strong>Nº Diplomas: </strong>'.$ndiplomas.'</p>';

    for ($i=1; $i < $nbotones+1; $i++) {
        echo '<a style="margin: 5px" href="#" id="diplomanverso'.$i.'" tipo="'. $valores[tipo] .'" total="'. $nbotones .'" id_mat="'. $valores[id_mat] .'" resto="'. $resto .'" class="btn btn-danger">Diplomas Parte '.$i.'/'.$nbotones.'</a>';
    }
    echo '</div>';

}


function diplomaPorPartes($valores, $link) {

    $ndiplomas = $valores[ndiplomas];

    $nbotones = intval($ndiplomas / 10);
    $resto = $ndiplomas % 10;
    if ( $resto != 0 ) $nbotones++;

    echo '<div style="text-align:center; margin: 15px 0 5px 0" class="col-md-12">';
    for ($i=1; $i < $nbotones+1; $i++) {
        echo '<a style="margin: 5px" href="#" id="botondiploma'.$i.'" tipo="'. $valores[tipo] .'" total="'. $nbotones .'" id_mat="'. $valores[id_mat] .'" id_emp="'. $valores[id_emp] .'" resto="'. $resto .'" class="btn btn-danger">Diplomas Parte '.$i.'/'.$nbotones.'</a>';
    }
    echo '</div>';

}

function devuelveDatosEmpresa($id_matricula, $link)  {

    $q = 'SELECT DISTINCT @id_emp:=e.id, e.razonsocial, e.cif, e.id, c.nombre, a.numeroaccion, ga.ngrupo, c.nombre, c.apellido,

    ( SELECT DISTINCT TRUNCATE(mc.costes_imparticion,2) FROM mat_costes mc
      WHERE mc.id_empresa = @id_emp
      AND mc.mes_bonificable <> 0
      AND mc.id_matricula = '.$id_matricula.') as costes_imparticion,

    (SELECT DISTINCT count(*)
    FROM mat_alu_cta_emp ma, empresas e, alumnos a
    WHERE e.id = ma.id_empresa
    AND a.id = ma.id_alumno
    AND ma.id_matricula = '.$id_matricula.'
    AND ma.id_empresa = @id_emp
    AND ma.tipo IN("")) as nalumnos
    FROM empresas e, mat_alu_cta_emp ma, mat_costes mc, comerciales c, acciones a, grupos_acciones ga, matriculas m
    WHERE ma.id_empresa = e.id
    AND m.id = ma.id_matricula
    AND m.id_accion = a.id
    AND m.id_grupo = ga.id
    AND ( (m.comercial = c.id AND m.comercial <> 0) OR (e.comercial = c.id) )
    AND mc.id_matricula = ma.id_matricula
    AND ma.id_matricula = '.$id_matricula.'
    AND ma.tipo = ""
    GROUP BY ma.id_empresa';
    // echo $q;
    $q = mysqli_query($link, $q);

    if ( mysqli_num_rows($q) > 0 ) {
    echo '<div class="col-md-12"><h3>Bonificado</h3></div>';

    while ( $row = mysqli_fetch_array($q) ) {

        $comercial = $row[nombre].' '.$row[apellido];

        $fich = $row[numeroaccion].'-'.$row[ngrupo].'fin.xlsx';
        echo '
        <div style="margin: 15px 0px 20px 0px; font-size: 12px; overflow: auto" class="col-md-12">
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label" for="razonsocial">Empresa:</label>
                    <input style="font-size: 11px;" value="'. $row[razonsocial] .'" type="text" id="razonsocial" name="razonsocial" class="form-control" disabled />
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label" for="cif">CIF:</label>
                    <input style="font-size: 11px;" value="'. $row[cif] .'" type="text" id="cif" name="cif" class="form-control" disabled />
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <label class="control-label" for="nalumnos">NºAlu:</label>
                    <input style="font-size: 10px;" value="'. $row[nalumnos] .'" type="text" id="nalumnos" name="nalumnos" class="form-control" disabled />
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label" for="costes_imparticion">Coste:</label>
                    <input value="'. round($row[costes_imparticion],2) .'" type="text" id="costes_imparticion" name="costes_imparticion" class="form-control" disabled />
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label" for="comercial">Comercial:</label>
                    <input style="font-size: 11px;" value="'. $row[nombre] .'" type="text" id="comercial" name="comercial" class="form-control" disabled />
                </div>
            </div>
            <div class="col-md-2" style="margin-top: 25px">
                <a style="width:100%" id="informe" name="'.$row[id].'" class="btn btn-warning"><span class="glyphicon glyphicon-list-alt"></span> Informe </a>
            </div>
        </div>';

    } echo '<div class="pull-right col-md-3" style="margin-top: 5px; margin-right: 15px;">
                <a style="width:100%" id="descargaexcelb" name="'.$fich.'" class="btn btn-success"><span class="glyphicon glyphicon-folder-close"></span> Excel Bonificado</a>
            </div><div class="clearfix"></div>';

    }


    $q = 'SELECT DISTINCT @id_emp:=e.id, e.razonsocial, e.cif, a.numeroaccion, ga.ngrupo, c.nombre, c.apellido,
    ( SELECT DISTINCT TRUNCATE(mc.costes_imparticion,2) FROM mat_costes mc
      WHERE mc.id_empresa = @id_emp
      AND mc.mes_bonificable = 0
      AND mc.id_matricula = '.$id_matricula.') as costes_imparticion,

    (SELECT DISTINCT count(*)
    FROM mat_alu_cta_emp ma, empresas e, alumnos a
    WHERE e.id = ma.id_empresa
    AND a.id = ma.id_alumno
    AND ma.id_matricula = '.$id_matricula.'
    AND ma.id_empresa = @id_emp
    AND ma.tipo IN("Privado")) as nalumnos
    FROM empresas e, mat_alu_cta_emp ma, mat_costes mc, acciones a, grupos_acciones ga, matriculas m, comerciales c
    WHERE ma.id_empresa = e.id
    AND m.id = ma.id_matricula
    AND m.id_accion = a.id
    AND m.id_grupo = ga.id
    AND ( (m.comercial = c.id AND m.comercial <> 0) OR (e.comercial = c.id) )
    AND mc.id_matricula = ma.id_matricula
    AND ma.id_matricula = '.$id_matricula.'
    AND ma.tipo = "Privado"
    GROUP BY ma.id_empresa';
    // echo $q;
    $q = mysqli_query($link, $q);

    if ( mysqli_num_rows($q) > 0 ) {
    echo '<div style="" class="col-md-12"><h3>Privado</h3></div>';

    while ( $row = mysqli_fetch_array($q) ) {

        $comercial = $row[nombre].' '.$row[apellido];

        if(strpos($row[ngrupo], 'p')) $row[ngrupo] = substr($row[ngrupo], 0, -1);

        $fich = $row[numeroaccion].'-'.$row[ngrupo].'finp.xlsx';
        echo '
        <div style="margin: 15px 0px 20px 0px; overflow: auto" class="col-md-12">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label" for="razonsocial">Empresa:</label>
                    <input value="'. $row[razonsocial] .'" type="text" id="razonsocial" name="razonsocial" class="form-control" disabled />
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label" for="cif">CIF:</label>
                    <input value="'. $row[cif] .'" type="text" id="cif" name="cif" class="form-control" disabled />
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label" for="nalumnos">Nº Alumnos:</label>
                    <input value="'. $row[nalumnos] .'" type="text" id="nalumnos" name="nalumnos" class="form-control" disabled />
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label" for="costes_imparticion">Coste:</label>
                    <input value="'. round($row[costes_imparticion],1) .'" type="text" id="costes_imparticion" name="costes_imparticion" class="form-control" disabled />
                </div>
            </div>
        </div>';

    } echo '<div class="pull-right col-md-3" style="margin-top: 5px; margin-right: 15px;">
                <a style="width:100%" id="descargaexcelb" name="'.$fich.'" class="btn btn-success"><span class="glyphicon glyphicon-folder-close"></span> Excel Privado</a>
            </div><div class="clearfix"></div>';
    }

    $q = 'SELECT m.observacionesfin
    FROM matriculas m
    WHERE m.id = '.$id_matricula;
    $q = mysqli_query($link, $q);

    $row = mysqli_fetch_array($q);
    $observacionesfin = $row[observacionesfin];
    echo '<div style="" id="observacionescuadro" class="ta col-md-12">
        <div class="form-group">
            <label class="control-label" for="observaciones">Observaciones:</label>
            <textarea name="observaciones" id="observaciones" class="form-control" rows="3">'.$observacionesfin.'</textarea>
        </div>
    </div>';

    echo '<div class="col-md-3" style="overflow:auto; margin-top: 10px;">
            <div class="form-group">
            <label class="control-label" for="comercial">Comercial:</label>
            <input type="text" value="'.$comercial.'" id="comercial" name="comercial" class="form-control" disabled/>
        </div>
    </div>
    </div><div class="clearfix"></div>';
}

function devuelveListaDiplomasEmpresa($valores, $link) {

    // print_r($valores);

    $sec = explode("?",$_SERVER['HTTP_REFERER']);
    if ($sec[1] == 'form_matricula_doc' || $sec[1] == 'form_matricula_doc#')
        $grupal = 1;

    $q = 'SELECT m.estado
    FROM matriculas m
    WHERE m.id = '.$valores[id_matricula];
    $q = mysqli_query($link, $q);
    $row = mysqli_fetch_row($q);
    $estado = $row[0];

    if ( $estado == 'Finalizada' || $estado == 'Facturada' || $estado == 'Gratuita' || $grupal == 1 ) {
        if ( $valores[bonif] == 0 ) {

            $q = 'SELECT DISTINCT e.id, e.razonsocial, count(id_alumno) as ndiplomas
            FROM mat_alu_cta_emp ma, empresas e, alumnos a
            WHERE ma.id_alumno = a.id
            AND ma.id_empresa = e.id
            AND ma.tipo = "Privado"
            AND ma.finalizado = 1
            AND ma.id_matricula = '.$valores[id_matricula].'
            GROUP BY e.id';
            $botondiploma = "genera_diploma_empresa_nobonif";
        } else {
            $q = 'SELECT DISTINCT e.id, e.razonsocial, count(id_alumno) as ndiplomas
            FROM mat_alu_cta_emp ma, empresas e, alumnos a
            WHERE ma.id_alumno = a.id
            AND ma.id_empresa = e.id
            AND ma.tipo = ""
            AND ma.finalizado = 1
            AND ma.id_matricula = '.$valores[id_matricula].'
            GROUP BY e.id';
            $botondiploma = "genera_diploma_empresa";
        }
    } else {
        if ( $valores[bonif] == 0 ) {
            $tablasbonifono = "temp_alumnosp a, temp_empresasp e";

            $botondiploma = "genera_diploma_empresa_nobonif";

        } else {

            $tablasbonifono = "temp_alumnos a, temp_empresas e";

            $botondiploma = "genera_diploma_empresa";
        }
        $q = 'SELECT e.id, e.razonsocial, count(*) as ndiplomas
        FROM '.$tablasbonifono.'
        WHERE a.id_empresa = e.id
        AND e.id_matricula = a.id_matricula
        AND e.id_matricula = '.$valores[id_matricula].'
        GROUP BY e.id';
    }

    // echo $q;
    $q = mysqli_query($link, $q);
    while ( $row = mysqli_fetch_array($q) ) {
        echo '
        <div style="margin: 15px 0px 20px 0px; overflow: auto" class="col-md-12">
            <div class="col-md-8">
                <div class="form-group">
                    <label class="control-label" for="razonsocial">Empresa:</label>
                    <input value="'. $row[razonsocial] .'" type="text" id="razonsocial" name="razonsocial" class="form-control" disabled />
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label" for="ndiplomas">Nº Diplomas:</label>
                    <input value="'. $row[ndiplomas] .'" type="text" id="ndiplomas" name="ndiplomas" class="form-control" disabled />
                </div>
            </div>
            <div style="margin-top: 25px" class="col-md-2">
                <a style="width: 100%" id="'. $botondiploma .'" ndip="'. $row[ndiplomas] .'" name="'. $row[id] .'" class="btn btn-danger"><span class="glyphicon glyphicon-bookmark"></span> Diplomas</a>
            </div>
        </div>';
    }
}

function actualizarFechasExcluir($id_fecha, $fecha, $link) {
    $q = 'UPDATE fechas_excluir SET fecha = "'.$fecha.'" WHERE id = '.$id_fecha;
    //echo $q;
    mysqli_query($link, $q);
}


function devuelveFechasExcluir($id_matricula, $tipo=NULL, $link) {
    $q = 'SELECT id, fecha FROM fechas_excluir
    WHERE id_matricula = '.$id_matricula.'
    AND tipo = "'.$tipo.'"';
    // echo $q;
    $q = mysqli_query($link, $q);
    $r = mysqli_num_rows($q);
    while ( $row = mysqli_fetch_array($q) ) {

        if ($tipo == 'p') {
        echo '
            <div style="margin-top: 15px">
              <input id="id_fecha" type="hidden" value="'.$row[id].'">
              <div style="margin-bottom: 15px" class="col-md-10 col-md-push-1">
                <div class="form-group">
                  <label class="control-label" for="fechasex">
                    Fecha A Excluir:
                  </label>
                  <input value="'.$row[fecha].'" type="date" id="fechasex'.$row[id].'" name="fechasex[]" class="form-control" />
                </div>
              </div>
              <div style="margin-top: -10px; margin-bottom: 10px;" class="col-md-3 col-md-push-1">
                <a id="actualizarfechasex" valor="'.$row[id].'" class="btn btn-xs btn-success pull-right">Actualizar</a>
              </div>

              </span>
            </div>';
        } else {
            echo '
            <div style="margin-top: 15px">
              <input id="id_fecha" type="hidden" value="'.$row[id].'">
              <div style="margin-bottom: 15px" class="col-md-10 col-md-push-1">
                <div class="form-group">
                  <label class="control-label" for="fechasexod">
                    Fecha A Excluir:
                  </label>
                  <input value="'.$row[fecha].'" type="date" id="fechasexod'.$row[id].'" name="fechasexod[]" class="form-control" />
                </div>
              </div>
              <div style="margin-top: -10px; margin-bottom: 10px;" class="col-md-3 col-md-push-1">
                <a id="actualizarfechasexod" valor="'.$row[id].'" class="btn btn-xs btn-success pull-right">Actualizar</a>
              </div>

              </span>
            </div>';

        }
    }
    if ( $r > 0 )
        echo ' <span class="fin_fecha_ex"></span>';
}

function guardarFechasExcluir($valores, $link) {
    // print_r($valores);
    $i = 0;

    if ( count($valores[fechasex]) > 0 ) {
        foreach ($valores[fechasex] as $key => $value) {
            $campos .= '("'.$valores[id_matricula].'","'.$value.'", "p")';
            if ( ++$i < sizeof($valores[fechasex]) ) $campos .= ', ';
        }

        $q = 'INSERT IGNORE INTO fechas_excluir
        (id_matricula, fecha, tipo)
        VALUES '. $campos;
        $q = mysqli_query($link, $q) or die("error fechas exc" . mysqli_error($link));
    }

    $i = 0;

    if ( count($valores[fechasexod]) > 0 ) {
        foreach ($valores[fechasexod] as $key => $value) {
            $campos .= '("'.$valores[id_matricula].'","'.$value.'", "od")';
            if ( ++$i < sizeof($valores[fechasexod]) ) $campos .= ', ';
        }

        $q = 'INSERT IGNORE INTO fechas_excluir
        (id_matricula, fecha, tipo)
        VALUES '. $campos;
        $q = mysqli_query($link, $q) or die("error fechas exc" . mysqli_error($link));
    }

}

function devuelvoGrupoEmpresa($grupo, $tipo, $gestion, $link) {


    $rutaempresasanex = dirname(__DIR__).'/pdf_tripartita'.$gestion.'/anexos/';

    // echo $rutaempresasanex;
    $q = 'SELECT DISTINCT *
    FROM empresas
    WHERE grupo = '.$grupo;
    // echo $q;
    $q = mysqli_query($link, $q);

    $empresas = array();
    // $nemp = mysqli_num_rows($q);
    while ($r = mysqli_fetch_assoc($q)) {

        // echo $rutaempresasanex.$r[cif].'-anexoenc_esfocc.pdf';
        // arrayText($r);
        $msg = "";


        if ( $r['asignado'] == 0 || $r['asignado'] == "" ) {
            $empresas['credito'] = 'no';
            $msg .= "La empresa ".$r[razonsocial]." no dispone de crédito.\n";
        } else {
            $empresas['credito'] = 'si';
        }

        if (file_exists($rutaempresasanex.$r[cif].'-anexoenc_esfocc.pdf')) {
            $empresas[aesfocc] = "1";
        }
        else {
            $msg .= "La empresa ".$r[razonsocial]." no dispone de anexo ESFOCC.\n";
            $empresas[aesfocc] = "1";
        }

        if (file_exists($rutaempresasanex.$r[cif].'-anexoenc_estrateg.pdf')) {
            $empresas[aestra] = "1";
        } else {
            $msg .= "La empresa ".$r[razonsocial]." no dispone de anexo ESTRATEGIAS.\n";
            $empresas[aestra] = "1";
        }

        if ( (($empresas[aesfocc] == 1 && $empresas[aestra] == 1 ) ) && $empresas['credito'] != "no"
             || $tipo == "Privado" ) {

            $empresas[empresas] .= '<div class="clearfix">
            </div>
            <div id="emp'.$i.'">
            <input name="id_empresa[]" type="hidden" id="id_empresa" value="'.$r['id'].'"/>
            <div class="col-md-8">
              <div class="form-group">
                <label class="control-label" for="razonsocial">
                  Empresa:
                </label>
                <input value="'. $r['razonsocial'] .'" type="text" id="razonsocial" name="razonsocial" class=" form-control" readonly/>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label class="control-label" for="cif">
                  CIF:
                </label>
                <input value="'. $r['cif'] .'" type="text" id="cif" name="cif" class=" form-control" readonly/>
              </div>
            </div>
            <div styl class="col-md-1">
              <a href="#" id="eliminaremp'.$i.'" class="eliminaremp btn btn-xs btn-danger">
                <span class="glyphicon glyphicon-remove">
                </span>

              </a>
            </div>
            </div>';
            $i++;

        } else {
            $empresas[nope] .= $msg;
        }
    }
    echo json_encode($empresas);

}

function mostrarCostesEmp ($id_matricula, $id_empresa, $link) {
    $q = 'SELECT e.id, e.razonsocial, e.porcentajecof
    FROM mat_alu_cta_emp ma, empresas e
    WHERE e.id = ma.id_empresa
    AND ma.finalizado = 1
    AND ma.id_matricula = '.$id_matricula.'
    AND ma.id_empresa = '.$id_empresa;
    // echo $q;
    $q = mysqli_query($link, $q);
    while($r = mysqli_fetch_assoc($q)) {
        // $id_emp = $r['id_empresa'];
        $razonsocial = $r['razonsocial'];
        $porcentajecof = $r['porcentajecof'];
    }

    $q = 'SELECT mc.*
    FROM mat_costes mc, empresas e
    WHERE mc.id_empresa = e.id
    AND mc.id_empresa = '.$id_empresa.'
    AND mc.id_matricula = '.$id_matricula;
    // echo $q;
    $q = mysqli_query($link, $q);

    if (mysqli_num_rows($q) > 0) {

        while($r = mysqli_fetch_assoc($q)) {
        echo '
        <input type="hidden" name="id_coste" id="id_coste" value="'.$r['id'].'" />
        <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label" for="empresacostes">Empresa:</label>
                    <input value="'.$razonsocial.'" type="text" id="empresacostes" name="empresacostes" class="form-control" disabled/>
                </div>
        </div>
        <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label" for="costes_imparticion">Costes Impartición:</label>
                    <input value="'.$r['costes_imparticion'].'" type="text" id="costes_imparticion" name="costes_imparticion" class="form-control" />
                </div>
        </div>
        <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label" for="porcentaje_cof">% Cofinanciación:</label>
                    <input value="'.$porcentajecof.'" type="text" id="porcentaje_cof" name="porcentaje_cof" class="form-control" disabled/>
                </div>
        </div>
        <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label" for="metodo">Método Cálculo:</label>
                    <select id="metodo" name="metodo" class="form-control" >
                        <option value="m1">Salario mínimo</option>
                        <option value="m2">Salarios medios</option>
                    </select>
                </div>
        </div>
        <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label" for="costes_salariales">Costes Salariales:</label>
                    <input value="'.$r['costes_salariales'].'" type="text" id="costes_salariales" name="costes_salariales" class="form-control" />
                </div>
        </div>
        <div class="col-md-3">
        <div class="cp form-group">
            <label class="control-label" for="maximo_bonificable">Máximo Bonificable:</label>
            <div class="input-group">
                <input value="'.$r['maximo_bonificable'].'" type="text" id="maximo_bonificable" name="maximo_bonificable" class="form-control" readonly>
                <span class="input-group-btn">
                    <a id="btnCalculoMax" name="btnCalculoMax" class="btn btn-default"><span class="glyphicon glyphicon-euro"></span></a>
                </span>
            </div>
        </div>
        </div>
        <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label" for="mes_bonificable">Meses Bonificables:</label>
                    <select id="mes_bonificable" name="mes_bonificable" class="form-control" >
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
        <a id="guardarcostes" style="margin-left: 15px;" href="#" class="btn btn-sm btn-success"> Guardar Costes</a>';
        }

    } else {

        $max_bonificable['maximo_bonificable'] = calculoMaximoBonificablePre($id_matricula, $link);

        $q = 'SELECT fechafin FROM matriculas m
        WHERE m.id = '.$id_mat;
        $q = mysqli_query($link, $q);

        $row = mysqli_fetch_row($q);
        $fecha = explode("-", $row[0]);
        $mes = $fecha[1];
        if ( $mes[0] == "0" )
            $mes = $mes[1];
        $mmes['mes_bonificable'] = $mes;
        // $rows[] = $mmes;
        echo "mes: ".$mmes['mes_bonificable'];

        print_r($rows);
         echo '
        <div class="cuadro_costes" style="overflow:hidden; margin-top: 15px">
        <input type="hidden" name="id_coste" id="id_coste" value="0" />
        <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label" for="empresacostes">Empresa:</label>
                    <input value="'.$razonsocial.'" type="text" id="empresacostes" name="empresacostes" class="form-control" disabled/>
                </div>
        </div>
        <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label" for="costes_imparticion">Costes Impartición:</label>
                    <input value="" type="text" id="costes_imparticion" name="costes_imparticion" class="form-control" />
                </div>
        </div>
        <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label" for="porcentaje_cof">% Cofinanciación:</label>
                    <input value="'.$porcentajecof.'" type="text" id="porcentaje_cof" name="porcentaje_cof" class="form-control" disabled/>
                </div>
        </div>
        <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label" for="metodo">Método Cálculo:</label>
                    <select id="metodo" name="metodo" class="form-control" >
                        <option value="m1">Salario mínimo</option>
                        <option value="m2">Salarios medios</option>
                    </select>
                </div>
        </div>
        <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label" for="costes_salariales">Costes Salariales:</label>
                    <input value="" type="text" id="costes_salariales" name="costes_salariales" class="form-control" />
                </div>
        </div>
        <div class="col-md-3">
        <div class="cp form-group">
            <label class="control-label" for="maximo_bonificable">Máximo Bonificable:</label>
            <div class="input-group">
                <input value="'. $max_bonificable['maximo_bonificable'] .'" type="text" id="maximo_bonificable" name="maximo_bonificable" class="form-control" readonly>
                <span class="input-group-btn">
                    <a id="btnCalculoMax" name="btnCalculoMax" class="btn btn-default"><span class="glyphicon glyphicon-euro"></span></a>
                </span>
            </div>
        </div>
        </div>
        <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label" for="mes_bonificable">Meses Bonificables:</label>
                    <select id="mes_bonificable" name="mes_bonificable" class="form-control" >
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
        <a id="guardarcostes" style="margin-left: 15px;" href="#" class="btn btn-sm btn-success"> Guardar Costes</a>
        </div>';
    }
}

function mostrarAlumnosEmpPre ($id_matricula, $id_empresa, $tipo=NULL, $link) {

    $sec = explode("?",$_SERVER['HTTP_REFERER']);
    if ($sec[1] == 'form_matricula_doc' || $sec[1] == 'form_matricula_doc#')
        $finalizado = ' ';
    else
        $finalizado = ' AND mp.finalizado = 1 ';

    if ( $tipo == 'undefined' || $tipo == 'fin' || $tipo == NULL ) {

        $q = 'SELECT ac.url, a.id as id_alu, a.nombre, a.apellido, a.apellido2, a.documento, a.niss, m.id as id_mat, e.id as id_emp, e.grupo as grupo_emp, m.solicitud, a.email as email_alumno, ga.ngrupo, ac.denominacionsystem, mp.numerocuenta, m.*
        FROM mat_alu_cta_emp mp, empresas e, alumnos a, acciones ac, matriculas m, grupos_acciones ga
        WHERE mp.id_empresa = e.id
        AND mp.id_alumno = a.id
        AND ga.id = m.id_grupo
        AND m.id = mp.id_matricula
        AND m.id_accion = ac.id
        '.$finalizado.'
        AND mp.id_matricula = '.$id_matricula.' AND mp.id_empresa = '.$id_empresa.'
        AND mp.tipo = ""';

    } else {

        $q = 'SELECT *, e.razonsocial as empresa FROM temp_alumnos a, temp_empresas te, empresas e
          WHERE a.id_empresa = te.id
          AND e.cif = te.cif
          AND te.id_matricula = '.$id_matricula.'
          AND te.id_matricula = a.id_matricula';

    }

    // echo $q;
    $q = mysqli_query($link, $q) or die("error");
    $i = 0;


    ?>

    <div class="modal-body mostrartabla">

        <table style="font-size: 12px" class="table table-striped">
            <thead>
                <tr>
                    <th style="display:none;">ID</th>
                    <th>Nº</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>2º Apellido</th>
                    <th>Empresa</th>
                    <th>Documento</th>
                    <th>Tipo</th>
                    <?

                    //if ($sec[1] == 'form_matricula_doc' || $sec[1] == 'form_matricula_doc#') ?>
                    <!--<th>Plataforma</th> -->
                    <th></th>
                </tr>
            </thead>
            <tbody>
        <?


        while ($row = mysqli_fetch_array($q)) {
            $i++;

            if ( $i == 1 ) {
                if ( $row[representacionlegal] == 1 && ( strpos($row[solicitud], "IK") !== false ) )
                    print('<a target="_blank" href="http://gestion.eduka-te.com/app/documentacion/ikea_doc_online.php?id_mat='.$row[id_mat].'&tipo=G&id_emp='.$row[id_emp].'">DOCUMENTACIÓN IKEA</a> ');
            }

            echo '<tr><td id="id" style="display:none;">';
            echo($row[id_alu]);
            echo "</td>";
            echo '<td>'.$i.'</td>';
            echo "<td>";
            echo($row[nombre]);
            echo "</td>";
            echo "<td>";
            print($row[apellido]);
            echo "</td>";
            echo "<td>";
            print($row[apellido2]);
            echo "</td>";
            echo "<td>";
            
            //echo('<input type="text" id="numerocuenta" id_alu="'.$row['id_alu'].'" value="'.$row['id_emp'].'">');
            // Menú desplegable con opciones de empresas
            echo '<select id="numerocuenta" id_alu="'.$row['id_alu'].'">';
            echo '<option value="0" '.($row['id_emp'] == '5847' ? 'selected' : '').'>-------------</option>';
            echo '<option value="5847" '.($row['id_emp'] == '5847' ? 'selected' : '').'>OFICINA</option>';
            echo '<option value="10341" '.($row['id_emp'] == '10341' ? 'selected' : '').'>JARDINES DEL SOL</option>';
            echo '<option value="10350" '.($row['id_emp'] == '10350' ? 'selected' : '').'>CLUB DEL CARMEN</option>';
            echo '<option value="10616" '.($row['id_emp'] == '10616' ? 'selected' : '').'>SANTA BARBARA-OFICINA</option>';
            echo '<option value="10255" '.($row['id_emp'] == '10255' ? 'selected' : '').'>SANTA BARBARA</option>';
            echo '<option value="10256" '.($row['id_emp'] == '10256' ? 'selected' : '').'>SUNSET HARBOUR</option>';
            echo '<option value="10257" '.($row['id_emp'] == '10257' ? 'selected' : '').'>SUNSET BAY</option>';
            echo '<option value="10285" '.($row['id_emp'] == '10285' ? 'selected' : '').'>SUNSET VIEW</option>';
            echo '<option value="10286" '.($row['id_emp'] == '10286' ? 'selected' : '').'>ROYAL TENERIFE COUNTRY CLUB</option>';
            echo '<option value="10287" '.($row['id_emp'] == '10287' ? 'selected' : '').'>ROYAL SUNSET BEACH CLUB</option>';
            echo '<option value="10292" '.($row['id_emp'] == '10292' ? 'selected' : '').'>CALA BLANCA</option>';
            echo '<option value="10730" '.($row['id_emp'] == '10730' ? 'selected' : '').'>Sahara Sunset Club</option>';
            echo '</select>';
       
            echo "</td>";
            echo '<td>';
            print($row[documento]);
            echo "</td>";
            echo '<td>';
            print('Bonificado');
            echo "</td>";


                //$tutor = '1806';
                //$plataforma = 'System';
                //$pass = normaliza($row[nombre][0]).trim(normaliza($row[apellido])).substr($row[documento], 4,4);
                //$row[denominacion] = "Prevenci%F3n%20de%20riesgos%20laborales%20en%20comercio%20al%20por%20menor%20o%20establecimientos%20no%20especializados";
				// INDIVIDUALES;
                // echo "<td>".date("d",strtotime($row[fechaini]))."</td>";
                //$megaurl = 'http://www.plataformateleformacion.com/Profesor/procesos/alumadd.php?Nombre='.rawurlencode(($row[nombre])).'&Apellidos='.rawurlencode(($row[apellido])).' '.rawurlencode(($row[apellido2])).'&Direccion='.$row[direccion].'&Poblacion='.$row[poblacion].'&Provincia='.$row[provincia].'&CP='.$row[codpostal].'&Telefono=&Email='.trim($row[email_alumno]).'&Pais=&Empresa=&Cif=B38238788&Pass='.$pass.'&Pass2='.$pass.'&Accion=185&Grupo='.$row[ngrupo].'&EmailProfesor=prodriguez@eduka-te.com&Dia_FechaInicio='. intval(date("d",strtotime($row[fechaini]))-1) .'&Mes_FechaInicio='.date("m",strtotime($row[fechaini])).'&Ano_FechaInicio='.date("Y",strtotime($row[fechaini])).'&Dia_FechaTermino='.date("d",strtotime($row[fechafin])).'&Mes_FechaTermino='.date("m",strtotime($row[fechafin])).'&Ano_FechaTermino='.date("Y",strtotime($row[fechafin])).'&Expediente= B176204AA&RazonSocialEO=ORGANIZADORA&RazonSocialEI=Escuela%20Sup%20de%20Formacion%20y%20Cualificacion%20SLU&Tipo=T&MandarCuest=0&Cursos%5B%5D='.$row[denominacionsystem].'&Horas%5B%5D='.$row[horastotales].'&NumTema%5B%5D=99&Tutorizacion=NO&NoRestarBonos=1&NoRestarAlumnos=1';

                //$evento = '#';
                //$url = explode('.com/', $row[url]);
                //if ( $url[1][0] != 'a'  ) { // MOODLE

                 //   $evento = 'anadirAlumnoMoodle';
                   // $plataforma = 'Moodle';
                    //$megaurl = '';
                    //$user = 'alum';
                    //$anio = strftime('%y', strtotime($row[fechaini]));
                    //$mes = strftime('%m', strtotime($row[fechaini]));
                    //$user .= $anio.$mes.substr($row[documento], 1,4);
                    //$pass = strtoupper(normaliza($row[nombre][0])).trim(normaliza($row[apellido])).substr($row[documento], 4,4);
                //}

        //echo( '<td><a target="_blank" href="'.$megaurl.'" id_mat="'.$row['id_mat'].'" id_alu="'.$row['id_alu'].'" id="'.$evento.'" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-share"></span> '. $plataforma .' </a></td>');
            $empresa=$row['grupo_emp'];    
            if ( ($_SESSION['user'] == 'root' || $_SESSION['user'] == 'amanda' || $_SESSION['user'] == 'alago' ) && $empresa=='39')
            echo '<td><a id="matguardarcuenta" name="matriculas" numerocuenta="'.$row['id_emp'].'" id_mat="'.$row['id_mat'].'" id_alu="'.$row['id_alu'].'" href="#" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> </a></td></tr>';
        } ?>
            </tbody>
        </table>
    </div> <?
}

function mostrarAlumnosEmpPrePrivado ($id_matricula, $id_empresa, $tipo=NULL, $link) {

    $sec = explode("?",$_SERVER['HTTP_REFERER']);
    if ($sec[1] == 'form_matricula_doc' || $sec[1] == 'form_matricula_doc#')
        $finalizado = ' ';
    else
        $finalizado = ' AND mp.finalizado = 1 ';

    if ( $tipo == 'undefined' || $tipo == 'fin' || $tipo == NULL ) {

        $q = 'SELECT ac.url, a.id as id_alu, a.nombre, a.apellido, a.apellido2, a.documento, a.niss, mp.tipo as tipof, ga.ngrupo, a.email as email_alumno, m.fechaini, ac.denominacionsystem
        FROM mat_alu_cta_emp mp, empresas e, alumnos a, acciones ac, matriculas m, grupos_acciones ga
        WHERE mp.id_empresa = e.id
        AND mp.id_alumno = a.id
        AND m.id = mp.id_matricula
        AND m.id_grupo = ga.id
        AND m.id_accion = ac.id
        '.$finalizado.'
        AND mp.id_matricula = '.$id_matricula.' AND mp.id_empresa = '.$id_empresa.'
        AND mp.tipo IN ("Privado", "Gratuito")';

    } else {

        $q = 'SELECT *, e.razonsocial as empresa FROM temp_alumnosp a, temp_empresasp te, empresas e
          WHERE a.id_empresa = te.id
          AND e.cif = te.cif
          AND te.id_matricula = '.$id_matricula.'
          AND te.id_matricula = a.id_matricula';

    }

    // echo $q;
    $q = mysqli_query($link, $q) or die("error" . mysqli_error($link));
    $i = 0; ?>
    <div class="modal-body mostrartabla">

        <table style="font-size: 12px" class="table table-striped">
            <thead>
                <tr>
                    <th style="display:none;">ID</th>
                    <th>Nº</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>2º Apellido</th>
                    <th>Nº SS</th>
                    <th>Documento</th>
                    <th>Tipo</th>
                    <?
                    $sec = explode("?",$_SERVER['HTTP_REFERER']);
                    if ($sec[1] == 'form_matricula_doc' || $sec[1] == 'form_matricula_doc#') ?>
                        <th>Plataforma</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
        <?


        while ($row = mysqli_fetch_array($q)) {
            $i++;
            echo '<tr><td id="id" style="display:none;">';
            echo($row[id]);
            echo "</td>";
            echo '<td>'.$i.'</td>';
            echo "<td>";
            echo($row[nombre]);
            echo "</td>";
            echo "<td>";
            print($row[apellido]);
            echo "</td>";
            echo "<td>";
            print($row[apellido2]);
            echo "</td>";
            echo "<td>";
            print($row[niss]);
            echo "</td>";
            echo '<td>';
            print($row[documento]);
            echo "</td>";
            echo '<td>';
            print($row[tipof]);
            echo "</td>";

                // tutor privado : 1807
                $tutor = '1807';
                $plataforma = 'System';
                $pass = normaliza($row[nombre][0].($row[apellido]).substr($row[documento], 4,4));
                // $row[denominacion] = "Prevenci%F3n%20de%20Riesgos%20Laborales%20B%E1sico%20B";


                $megaurl = 'http://www.plataformateleformacion.com/Profesor/procesos/alumadd.php?Nombre='.rawurlencode(($row[nombre])).'&Apellidos='.rawurlencode(($row[apellido])).' '.rawurlencode(($row[apellido2])).'&Direccion='.$row[direccion].'&Poblacion='.$row[poblacion].'&Provincia='.$row[provincia].'&CP='.$row[codpostal].'&Telefono=&Email='.trim($row[email_alumno]).'&Pais=&Empresa=&Cif=&Pass='.$pass.'&Pass2='.$pass.'&Accion='.$row[numeroaccion].'&Grupo='.$row[ngrupo].'&Tutor='.$tutor.'&Dia_FechaInicio='.date("d",strtotime($row[fechaini])).'&Mes_FechaInicio='.date("m",strtotime($row[fechaini])).'&Ano_FechaInicio='.date("Y",strtotime($row[fechaini])).'&Dia_FechaTermino='.date("d",strtotime($row[fechafin])).'&Mes_FechaTermino='.date("m",strtotime($row[fechafin])).'&Ano_FechaTermino='.date("Y",strtotime($row[fechafin])).'&Tipo=T&MandarCuest=0&Cursos%5B%5D='.$row[denominacionsystem].'&Horas%5B%5D='.$row[horastotales].'&NumTema%5B%5D=99&Tutorizacion=NO&NoRestarBonos=1&NoRestarAlumnos=1';

                $evento = '#';
                // echo $row[url];
                $url = explode('.com/', $row[url]);

                if ( $url[1][0] != 'a'  ) { // MOODLE

                    $plataforma = 'Moodle';
                    $evento = 'anadirAlumnoMoodle';
                    $megaurl = '';
                    $user = 'alum';
                    $anio = strftime('%y', strtotime($row[fechaini]));
                    $mes = strftime('%m', strtotime($row[fechaini]));
                    $user .= $anio.$mes.substr($row[documento], 1,4);
                    $pass = strtoupper(normaliza($row[nombre][0])).trim(normaliza($row[apellido])).substr($row[documento], 4,4);

                }

                echo( '<td><a target="_blank" href="'.$megaurl.'" id="'.$evento.'" id_alu="'.$row[id_alu].'" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-share"></span> '. $plataforma .' </a></td>');

            echo '<td><a id="matpreborraralumnomat" name="matriculas" href="#" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span> </a></td></tr>';
        } ?>
            </tbody>
        </table>
    </div> <?
}

function mostrarEmpresasPreFin($id_matricula, $link) {

    $q = 'SELECT DISTINCT e.id, e.razonsocial, e.cif
    FROM mat_alu_cta_emp mp, empresas e
    WHERE e.id = mp.id_empresa
    AND id_matricula = '.$id_matricula.'
    AND mp.tipo NOT IN("Privado", "Gratuito")';
    // echo $q;
    $q = mysqli_query($link, $q);

    while($r = mysqli_fetch_assoc($q)) {

      echo '<div style="overflow: auto; margin-top: 10px;">
            <div class="col-md-6">
            <input id="id" type="hidden" value="'.$r[id].'">
            <div class="form-group">
                    <label class="control-label" for="razonsocial">Empresa:</label>
                    <input type="text" value="'.$r[razonsocial].'" id="razonsocial" name="razonsocial" class="form-control" readonly />
            </div>
            </div>
            <div class="col-md-2">
                    <div class="form-group">
                            <label class="control-label" for="cif">CIF:</label>
                            <input type="text" value='.$r[cif].' id="cif" name="cif" class="form-control" readonly />
                    </div>
           </div>
           <div class="col-md-2">
                <a href="#" name="'.$r[id].'" style="width: 100%; margin-top: 25px;" id="mostrarAlumnosEmpPre" class="btn btn-default"><span class="glyphicon glyphicon-user"></span> Alumnos</a>
           </div>
           <div class="col-md-2">
                <a href="#" name="'.$r[id].'" style="width: 100%; margin-top: 25px;" id="mostrarCostesPre" class="btn btn-default"><span class="glyphicon glyphicon-plus-sign"></span> Costes</a>
           </div></div>';

    }

}

function mostrarEmpresasPreFinPrivado($id_matricula, $link) {

    $q = 'SELECT DISTINCT e.id, e.razonsocial, e.cif
    FROM mat_alu_cta_emp mp, empresas e
    WHERE e.id = mp.id_empresa
    AND id_matricula = '.$id_matricula.'
    AND mp.tipo IN("Privado")';
    // echo $q;
    $q = mysqli_query($link, $q);

    while($r = mysqli_fetch_assoc($q)) {

      echo '<div style="overflow: auto; margin-top: 10px;">
            <div class="col-md-6">
            <input id="id" type="hidden" value="'.$r[id].'">
            <div class="form-group">
                    <label class="control-label" for="razonsocial">Empresa:</label>
                    <input type="text" value="'.$r[razonsocial].'" id="razonsocial" name="razonsocial" class="form-control" readonly />
            </div>
            </div>
            <div class="col-md-2">
                    <div class="form-group">
                            <label class="control-label" for="cif">CIF:</label>
                            <input type="text" value='.$r[cif].' id="cif" name="cif" class="form-control" readonly />
                    </div>
           </div>
           <div class="col-md-2">
                <a href="#" name="'.$r[id].'" style="width: 100%; margin-top: 25px;" id="mostrarAlumnosEmpPrePrivado" class="btn btn-default"><span class="glyphicon glyphicon-user"></span> Alumnos</a>
           </div>
           <div class="col-md-2">
                <a href="#" name="'.$r[id].'" style="width: 100%; margin-top: 25px;" id="mostrarCostesPrePrivado" class="btn btn-default"><span class="glyphicon glyphicon-plus-sign"></span> Costes</a>
           </div>
           </div>';

    }

}

function eliminarAlumnoDeMatriculaPre($id_mat, $id_alu, $link) {

    $q = 'DELETE FROM mat_alu_cta_emp
    WHERE id_matricula = '.$id_mat.' AND id_alumno = '.$id_alu;
    echo $q;
    $q = mysqli_query($link, $q) or die("error");
}

function eliminarEmpresaDeMatriculaPre($valores, $link) {

    $q = 'DELETE FROM ptemp_mat_emp
    WHERE id_matricula = '.$valores['id_matricula'].' AND id_empresa = '.$valores['id_empresa'];
    echo $q;
    $q = mysqli_query($link, $q);
    //CORREO AVISO ELIMINACION

    enviarMailNotif($valores['id_matricula'], $valores['id_empresa'], 'empresa-eliminada', $link, $_SESSION[user]);
}

function eliminarEmpresaDeMatriculaGrup($valores, $link) {

    $q = 'DELETE FROM otemp_mat_emp
    WHERE id_matricula = '.$valores['id_matricula'].' AND id_empresa = '.$valores['id_empresa'];
    echo $q;
    $q = mysqli_query($link, $q);
}

function eliminarDocenteDeMatriculaPre($valores, $link) {

    $q1 = 'SELECT m.id, a.numeroaccion, ga.ngrupo, a.modalidad
    FROM matriculas m, acciones a, grupos_acciones ga
    WHERE m.id_accion = a.id
    AND m.id_grupo = ga.id
    AND m.id = '.$valores['id_matricula'];
    $q1 = mysqli_query($link, $q1);
    $row = mysqli_fetch_array($q1);

    enviarMailNotif($row[numeroaccion],$row[ngrupo], 'pm-alta-anu', $link, $valores['id_matricula'].'-'.$valores['id_docente']);


    $q = 'DELETE FROM mat_doc
    WHERE id_matricula = '.$valores['id_matricula'].' AND id_docente = '.$valores['id_docente'];
    // echo $q;
    $q = mysqli_query($link, $q);


}

function mostrarDocentesPre($id, $link) {

    $q = 'SELECT d.*, pm.*, d.id as id_docente
    FROM mat_doc pm, docentes d
    WHERE d.id = pm.id_docente
    AND pm.id_matricula = '.$id;
    // echo $q;
    $q = mysqli_query($link, $q);

    ?>

    <div class="modal-body mostrartabla">

        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="display:none;">ID</th>
                    <th>Nombre</th>
                    <th>Documento</th>
                    <th>Fecha<br>Inicio</th>
                    <th>Fecha<br>Fin</th>
                    <th>Horario</th>
                    <th>Horas</th>
                    <th>Proveedor</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
        <?


        while ($row = mysqli_fetch_array($q)) {
            echo '<tr><td id="id" style="display:none;">';
            echo($row[id_docente]);
            echo "</td>";

            if ( $row['tipodoc'] == "Persona" || $row['tipodoc'] == "" ) {

                echo "<td>";
                echo($row[nombre].' '.$row[apellido]);
                echo "</td>";
                echo "<td>";
                print($row[documento]);
                echo "</td>";
                echo '<td>';
                print(formateaFecha($row[fechadocini]));
                echo "</td>";
                echo '<td>';
                print(formateaFecha($row[fechadocfin]));
                echo "</td>";
                echo '<td>';
                print($row[horariodoc]);
                echo "</td>";
                echo '<td>';
                print($row[numhorasdoc]);
                echo "</td>";
                echo '<td id="proveedor">';
                echo('');
                echo "</td>";

            } else if ( $row['tipodoc'] == "Empresa" ) {

                echo "<td>";
                echo($row[nombredocente].' '.$row[apellidodocente]);
                echo "</td>";
                echo "<td>";
                print($row[documentodocente]);
                echo "</td>";
                echo '<td>';
                print(formateaFecha($row[fechadocini]));
                echo "</td>";
                echo '<td>';
                print(formateaFecha($row[fechadocfin]));
                echo "</td>";
                echo '<td>';
                print($row[horariodoc]);
                echo "</td>";
                echo '<td>';
                print($row[numhorasdoc]);
                echo "</td>";
                echo '<td id="proveedor">';
                echo($row[nombre].' - '.$row[documento]);
                echo "</td>";

            }

            echo '<td><a id="matpborrardocentemat" name="matriculas" href="#" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span> </a></td></tr>';
        } ?>
            </tbody>
        </table>
    </div>

    <?

}

function mostrarDocentesMix($id, $tipo, $link) {

    $q = 'SELECT d.*, pm.*, d.id as id_docente
    FROM mat_doc pm, docentes d
    WHERE d.id = pm.id_docente
    AND pm.mixto = "'.$tipo.'"
    AND pm.id_matricula = '.$id;
    // echo $q;
    $q = mysqli_query($link, $q);

    ?>

    <div class="modal-body mostrartabla">

        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="display:none;">ID</th>
                    <th>Nombre</th>
                    <th>Documento</th>
                    <th>Fecha<br>Inicio</th>
                    <th>Fecha<br>Fin</th>
                    <th>Horario</th>
                    <th>Horas</th>
                    <th>Proveedor</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
        <?


        while ($row = mysqli_fetch_array($q)) {
            echo '<tr><td id="id" style="display:none;">';
            echo($row[id_docente]);
            echo "</td>";

            if ( $row['tipodoc'] == "Persona" || $row['tipodoc'] == "" ) {

                echo "<td>";
                echo($row[nombre].' '.$row[apellido]);
                echo "</td>";
                echo "<td>";
                print($row[documento]);
                echo "</td>";
                echo '<td>';
                print(formateaFecha($row[fechadocini]));
                echo "</td>";
                echo '<td>';
                print(formateaFecha($row[fechadocfin]));
                echo "</td>";
                echo '<td>';
                print($row[horariodoc]);
                echo "</td>";
                echo '<td>';
                print($row[numhorasdoc]);
                echo "</td>";
                echo '<td id="proveedor">';
                echo('');
                echo "</td>";

            } else if ( $row['tipodoc'] == "Empresa" ) {

                echo "<td>";
                echo($row[nombredocente].' '.$row[apellidodocente]);
                echo "</td>";
                echo "<td>";
                print($row[documentodocente]);
                echo "</td>";
                echo '<td>';
                print(formateaFecha($row[fechadocini]));
                echo "</td>";
                echo '<td>';
                print(formateaFecha($row[fechadocfin]));
                echo "</td>";
                echo '<td>';
                print($row[horariodoc]);
                echo "</td>";
                echo '<td>';
                print($row[numhorasdoc]);
                echo "</td>";
                echo '<td id="proveedor">';
                echo($row[nombre].' - '.$row[documento]);
                echo "</td>";

            }

            echo '<td><a id="matpborrardocentemat" name="matriculas" href="#" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span> </a></td></tr>';
        } ?>
            </tbody>
        </table>
    </div>

    <?

}

function mostrarEmpresasPre($id, $link) {

    $q = 'SELECT e.id, e.razonsocial, e.cif, e.representacionlegal
    FROM ptemp_mat_emp pm, empresas e
    WHERE e.id = pm.id_empresa
    AND pm.id_matricula = '.$id;
    // echo $q;
    $q = mysqli_query($link, $q) or die("error" . mysqli_error($link));

    ?>

    <div class="modal-body mostrartabla">

        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="display:none;">ID</th>
                    <th>Empresa</th>
                    <th>CIF</th>
                    <th>RLT</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
        <?

        while ($row = mysqli_fetch_array($q)) {
            echo '<tr><td id="id" style="display:none;">';
            echo($row[id]);
            echo "</td>";
            echo "<td>";
            echo($row[razonsocial]);
            echo "</td>";
            echo "<td>";
            print($row[cif]);
            echo "</td>";
            echo "<td>";
            if ( $row[representacionlegal] == 1)
            print('<a target="_blank" href="http://gestion.eduka-te.com/app/documentacion/rltpremix.php?id_mat='.$id.'&tipo=P&id_emp='.$row[id].'">RLT</a>');
            echo "</td>";
            echo '<td><a id="matpborraralumnomat" name="matriculas" href="#" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span> </a></td></tr>';
        } ?>
            </tbody>
        </table>
    </div>

    <?

}

function borrarEmpresaIK($idsol,$idemp, $link) {

    $q = 'DELETE FROM temp_empresas_ikea WHERE id_solicitud = "'.$idsol.'" AND id_empresa = "'.$idemp.'"';
    // echo $q;
    $q = mysqli_query($link, $q) or die("error" . mysqli_error($link));
}


function mostrarEmpresasPreIK($id, $link) {

    $q = 'SELECT e.id, e.razonsocial, e.cif, e.representacionlegal, pm.nalus
    FROM temp_empresas_ikea pm, empresas e
    WHERE e.id = pm.id_empresa
    AND pm.id_solicitud = '.$id;
    // echo $q;
    $q = mysqli_query($link, $q) or die("error" . mysqli_error($link));

    ?>

    <div class="modal-body mostrartabla">

        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="display:none;">ID</th>
                    <th>Empresa</th>
                    <th>Participantes</th>
                    <th>CIF</th>
                    <th></th>
                    <!-- <th></th> -->
                </tr>
            </thead>
            <tbody>
        <?

        while ($row = mysqli_fetch_array($q)) {
            echo '<tr><td id="id" style="display:none;">';
            echo($row[id]);
            echo "</td>";
            echo "<td>";
            echo($row[razonsocial]);
            echo "</td>";
            echo "<td>";
            echo($row[nalus]);
            echo "</td>";
            echo "<td>";
            print($row[cif]);
            echo "</td>";
            echo '<td><a id="borrarEmpresaIK" idsol="'.$id.'" idemp="'.$row[id].'" name="" href="#" class="btn btn-xs btn-danger">
            <span class="glyphicon glyphicon-remove"></span> </a>
            </td>';
        } ?>
            </tbody>
        </table>
    </div>

    <?

}



function mostrarTablaPresenciales ($tabla,$link) {

    if ($tabla == 'matriculas')
        $q1 = 'SELECT DISTINCT m.id, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado
        FROM matriculas m, acciones a, grupos_acciones ga
        WHERE m.id_accion = a.id
        AND ga.id = m.id_grupo
        AND a.modalidad = "Presencial"
        ORDER BY m.id DESC';

    $q1 = mysqli_query($link,$q1);

    switch ($tabla) {
    case 'matriculas':
        ?>
        <div class="modal-header camposbusqueda">
            <form role="form" action="" method="post" id="form-modal">
            <input name="tabla" type="hidden" id="tabla" value="matriculas" />
            <input name="matricula" type="hidden" id="matricula" value="<? echo($mat); ?>" />
            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label" for="numeroaccion">Acción:</label>
                    <input type="text" id="numeroaccion" name="numeroaccion" class="required form-control" />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label" for="denominacion">Denominación:</label>
                    <input type="text" id="denominacion" name="denominacion" class="required form-control" />
                </div>
            </div>
            <div class="col-md-3">
            <div class="form-group">
                <label class="control-label" for="fechaini">Fecha Inicio:</label>
                <input type="date" id="fechaini" name="fechaini" class="form-control" />
            </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label" for="fechafin">Fecha Fin:</label>
                    <input type="date" id="fechafin" name="fechafin" class="form-control" />
                </div>
            </div>
            <div class="col-md-1">
                <a style="margin-top: 24px;" id="busqueda" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></a>
            </div>

            <div class="clearfix"></div>

            <div style="margin-top: 10px;">

            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label" for="fechacreacion">Fecha Creación:</label>
                    <input type="date" id="fechacreacion" name="fechacreacion" class="form-control" />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label" for="fechacomunicacion">Fecha Comunicación:</label>
                    <input type="date" id="fechacomunicacion" name="fechacomunicacion" class="form-control" />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label" for="fechafinalizacion">Fecha Finalización:</label>
                    <input type="date" id="fechafinalizacion" name="fechafinalizacion" class="form-control" />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label" for="estado">Estado:</label>
                        <select id="estado" name="estado" class="form-control" >
                            <option value="">Cualquiera</option>
                            <option value="Creada">Creada</option>
                            <option value="Comunicada">Comunicada</option>
                            <option value="Finalizada">Finalizada</option>
                            <option value="Cerrada">Cerrada</option>
                        </select>
                </div>
            </div>
            </form>
            </div>
        </div>
        <div class="modal-body mostrartabla">

        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="display:none;">ID</th>
                    <th>Acción</th>
                    <th>Denominación</th>
                    <th>Estado</th>
                    <th>Inicio</th>
                    <th>Fin</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
        <?


        while ($row = mysqli_fetch_array($q1)) {
            echo '<tr><td id="id" style="display:none;">';
            echo($row[id]);
            echo "</td>";
            echo "<td>";
            echo($row[numeroaccion].'/'.$row[ngrupo]);
            echo "</td>";
            echo "<td>";
            print($row[denominacion]);
            echo "</td>";
            echo "<td>";
            print($row[estado]);
            echo "</td>";
            echo "<td>";
            print(date("d-m-Y", strtotime($row[fechaini])));
            echo "</td>";
            echo '<td>';
            print(date("d-m-Y", strtotime($row[fechafin])));
            echo "</td>";
            echo '<td><a id="matpseleccionarmat" name="matriculas" href="#" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span> </a></td></tr>';
        } ?>
            </tbody>
        </table> <?
        break;

    }
}

function devolverDatosMatriculaPre($id,$tabla,$link) {
    // datos de la accion - matricula: tabla: matriculas
    $q1 = 'SELECT ga.ngrupo, ga.id_accion, a.numeroaccion, a.denominacion, a.horastotales, a.modalidad, m.*
    FROM acciones a, matriculas m, grupos_acciones ga
    WHERE m.id_accion = a.id
    AND m.id_grupo = ga.id
    AND m.id = '.$id.'
    LIMIT 0,1';

    //echo $id;

    $q1 = mysqli_query($link,$q1);
    $rows = array();
    while($r = mysqli_fetch_assoc($q1)) {
        $rows[0] = $r;
    }
    $q1 = 'SELECT COUNT( id_matricula ) as cuentas
    FROM ptemp_mat_emp
    WHERE id_matricula = '.$id.'
    UNION ALL
    SELECT COUNT( id_docente )
    FROM mat_doc
    WHERE id_matricula = '.$id;
    $q1 = mysqli_query($link,$q1);
    while($r = mysqli_fetch_assoc($q1)) {
        $rows[] = $r;
    }
    $q1 = 'SELECT codigopostal,costeaula,direccioncentro,c.id,c.id_matricula,c.localidad,nombrecentro,c.provincia
    FROM centros c, matriculas m
    WHERE m.centro = c.id
    AND m.id = '.$id;
    $q1 = mysqli_query($link,$q1);
    while($r = mysqli_fetch_assoc($q1)) {
        $rows[] = $r;
    }

    // $q1 = 'SELECT DISTINCT c.id as comercialempresa
    // FROM comerciales c, ptemp_mat_emp m, empresas e
    // WHERE m.id_empresa = e.id
    // AND e.comercial = c.id
    // AND m.id_matricula = '.$id;

    // $q1 = mysqli_query($link,$q1);
    // while($r = mysqli_fetch_assoc($q1)) {
    //     $rows[] = $r;
    // }

    $q1 = 'SELECT DISTINCT c.*
    FROM costes_rentabilidad c, matriculas m
    WHERE m.id = c.id_matricula
    AND m.id = '.$id;

    $q1 = mysqli_query($link,$q1);
    while($r = mysqli_fetch_assoc($q1)) {
        $rows[rentabilidad] = $r;
    }

    echo json_encode($rows);
}

function matricular_presencial($valores, $link) {
    // echo "<br>";
    // print_r($valores);
    // echo $values[0];
    // $valores = "";
    // $valores = $values[0];
    // echo("<pre>".print_r($valores,true)."</pre>");
    // // echo "<br>".$valores;
    // echo("<pre>".print_r($fechasinc,true)."</pre>");
    // print_r($valores['id_alumno']);
    // print_r($valores['numerocuenta']);
    // print_r($valores['id_docente']);
    // print_r($valores['id_empresa']);
    // print_r($valores['id_matricula']);
    // print_r($valores['jornadalaboral']);

    // echo $empresasrlt;

    $empresasrlt = "";

    $coma = ",";
    $q = 'SELECT numeroaccion, horastotales FROM acciones
    WHERE id = ' . $valores['id_accion'];
    // echo $q."<br>";
    $q = mysqli_query($link, $q);
    $row = mysqli_fetch_array($q);
    $numeroaccion = $row['numeroaccion'];
    $grupo = $valores['ngrupo'];
    $horastotales = $row['horastotales'];

    //echo "Id matricula: ".$valores['id_matricula'];

    if ($valores['id_matricula'] == "") { // si hay id de matricula, es actualización


        // insertar grupos con su numero de accion
        // hay que traerse ngrupo del calculado en el form
        $q1 = 'INSERT IGNORE INTO grupos_acciones
        (id_accion, ngrupo)
        VALUES ("' . $valores['id_accion'] . '","' . $valores['ngrupo'] . '")';
        // echo $q1 . "<br>";
        $q1 = mysqli_query($link,$q1);
        $id_grupo = mysqli_insert_id($link);
        // echo "grupo insertado " . $id_grupo;
        $q = 'SELECT max(id) FROM matriculas';
        $q = mysqli_query($link,$q);
        $id = mysqli_fetch_row($q);
        $id = $id[0] + 1;


        // inserto el centro de formacion presencial

        // echo "tamano nombrecentro".sizeof($valores['nombrecentro']);
        // $id_centro = 0;

        if (strlen($valores['nombrecentro']) > 0) {

            if ( $valores['id_centro'] != "" && $valores['centronuevo'] == "No" ) {

                $id_centro = $valores['id_centro'];

            } else {

                // $q = 'SELECT max(id)
                // FROM centros';
                // $q = mysqli_query($link, $q);

                // $row = mysqli_fetch_row($q);
                // $id_centro = $row[0] + 1;
                // echo $id_centro;
                $q1 = 'INSERT IGNORE INTO `centros`( `nombrecentro`, `direccioncentro`, `codigopostal`, `localidad`, `provincia`, `id_matricula`)
                VALUES ("' . $valores['nombrecentro'] . '","' . $valores['direccioncentro'] . '","' . $valores['codigopostal'] . '","' . $valores['poblacion'] . '",
                "' . $valores['provincia'] . '","' . $id . '")';
                // echo $q1 . "<br>";
                $q1 = mysqli_query($link,$q1);
                $id_centro = mysqli_insert_id($link);

            }

        }

        // echo "Nombre centro: ".$valores['nombrecentro'];

        if ( strlen($valores['nombrecentro']) > 0 ) {
            $q1 = 'INSERT INTO `centros`( `nombrecentro`, `direccioncentro`, `codigopostal`, `localidad`, `provincia`, `id_matricula`, `observaciones`)
            VALUES ("' . $valores['nombrecentro'] . '","' . $valores['direccioncentro'] . '","' . $valores['codigopostal'] . '","' . $valores['poblacion'] . '","' . $valores['provincia'] . '","' . $id . '","' . $valores['observaciones'] . '")';
             // echo $q1 . "<br>";
            $q1 = mysqli_query($link,$q1);
        }

        // inserto  matricula - accion
        $q1 = 'INSERT IGNORE INTO matriculas
        (id, id_accion, fechaini, fechafin, id_grupo, estado, horariomini, horariomfin, horariotini, horariotfin, diascheck, fechacreacion, fechacomunicacion, presupuesto, comercial, observaciones, solicitud, id_solicitudikea, id_solicitud, centro, tipo_docente, incidencias, grupo_dino, observacioneslogistica, aulavirtual)
        VALUES ("' . $id . '","' . $valores['id_accion'] . '","' . $valores['fechaini'] . '","' . $valores['fechafin'] . '","' . $id_grupo . '",
        "' . $valores['estado'] . '","' . $valores['horariomini'] . '","' . $valores['horariomfin'] . '","' . $valores['horariotini'] . '",
        "' . $valores['horariotfin'] . '","' . $valores['diascheck'] . '","' . date("Y-m-d") . '","' . date("Y-m-d") . '","' . $valores['presupuesto'] . '","' . $valores['comercial'] . '","' . $valores['observaciones'] . '","' . $valores['solicitud'] . '","' . $valores['id_solicitudikea'] . '","' . $valores['id_solicitud'] . '","' . $id_centro . '","' . $valores['tipo_docente'] . '", "' . addslashes($valores['incidencias']) . '", "'. $valores['grupo_dino'].'", "'. $valores['observacioneslogistica'].'","'. $valores['aulavirtual'].'")';
        // echo $q1 . "<br>";
        $q1 = mysqli_query($link,$q1) or die("error insertando mat");

        $enviarlt = 0;
        $coma = ",";
        if ( sizeof($valores['id_empresa']) > 0 ) {
            for ($i = 0; $i < sizeof($valores['id_empresa']); $i++) {

                // comprueba num cuenta
                compruebaNumCuenta($valores['id_empresa'][$i], $numeroaccion, $grupo, $link);

                if ( strpos($grupo, "p") === FALSE ) {

                    $qrlt = 'SELECT razonsocial FROM empresas
                    WHERE id = "'.$valores[id_empresa][$i].'"
                    AND representacionlegal = 1';
                    // echo $qrlt;
                    $qrlt = mysqli_query($link, $qrlt) or die("error rlt");

                    if ( mysqli_num_rows($qrlt) > 0 ) $enviarlt = 1;

                }


                if ($i == sizeof($valores['id_empresa']) - 1)
                    $coma = "";
                $empresas .= ' ("' . $id . '","' . $valores['id_empresa'][$i] . '")' . $coma;
            }


            // EN TABLA TEMPORAL! NO NUMCUENTA, NO ALUMNO, NO JORNADAS
            // inserto  matricula - empresas
            $q1 = 'INSERT IGNORE INTO ptemp_mat_emp
            (id_matricula, id_empresa)
            VALUES ' . $empresas;
            // echo $q1 . "<br>";
            $q1 = mysqli_query($link,$q1);

        }

        if ( $valores['solicitud'] != "" && $valores['solicitud'] != 'undefined' ) {

            if ( strpos($valores['solicitud'],'IK') !== FALSE ) {

                $tabla = 'ikea_solicitudes';
                $campot = 'estadosolikea';
                $valor = $valores[id_solicitudikea];

            } else {

                $tabla = 'peticiones_formativas';
                $campot = 'estado_peticion';
                $valor = $valores[id_solicitud];

            }

            $q2 = 'UPDATE '.$tabla.' SET '. $campot. ' = "Aceptada"
            WHERE id = "'. $valor .'"';
            // echo $q2;
            $q2 = mysqli_query($link, $q2) or die('error:update' .mysqli_error($link));

        }


        $horariomini = $valores[horariomini];
        $horariomfin = $valores[horariomfin];
        $horariotini = $valores[horariotini];
        $horariotfin = $valores[horariotfin];

        if ( $horariomini !== "" )
            $horario = $horariomini.' - '.$horariomfin;
        if ( $horariomini !== "" && $horariotini !== "" )
            $horario .= ' | ';
        if ( $horariotini != "" )
            $horario .= $horariotini.' - '.$horariotfin;


        $coma = ",";

        if ( sizeof($valores['id_docente']) > 0 ) {

            $k = 1;
            for ($i = 0; $i < sizeof($valores['id_docente']); $i++) {
                if ($i == sizeof($valores['id_docente']) -1)
                    $coma = "";

                if ($valores['fechadocini'.$k] == "") $valores['fechadocini'.$k] = $valores['fechaini'];
                if ($valores['fechadocfin'.$k] == "") $valores['fechadocfin'.$k] = $valores['fechafin'];
                if ($valores['horariodoc'.$k] == "") $valores['horariodoc'.$k] = $horario;
                if ($valores['numhorasdoc'.$k] == "") $valores['numhorasdoc'.$k] = $horastotales;


                $docentes .= '("' . $id . '","' . $valores['id_docente'][$i] . '","' . $valores['fechadocini'.$k] . '", "' . $valores['fechadocfin'.$k] . '","' .$valores['horariodoc'.$k]. '","' .$valores['numhorasdoc'.$k]. '")' . $coma;
                $k++;
                // echo $docentes;
            }

            $q1 = 'INSERT IGNORE INTO mat_doc
            (id_matricula, id_docente, fechadocini, fechadocfin, horariodoc, numhorasdoc)
            VALUES ' . $docentes;
            // echo $q1 . "<br>";
            $q1 = mysqli_query($link,$q1);
        }

        $coma = ",";
        if ( sizeof($valores['fechas']) > 0 ) {
            // print_r($valores['fechas']);
            $fechas = explode(",", $valores['fechas']);
            for ($i=0; $i < sizeof($fechas); $i++) {
                if ($i == sizeof($fechas) - 1) $coma = "";
                $values .= '("'.$id.'","'.$fechas[$i].'")' . $coma;
            }
            $q = 'INSERT IGNORE INTO fechas_excluir
            (id_matricula, fecha)
            VALUES '.$values;
            // echo $q;
            $q = mysqli_query($link, $q);
        }


       // if ( strlen($valores[precioventamat]) > 0 ) {
         //   $q1 = 'INSERT IGNORE INTO `costes_rentabilidad`(`costeaula`, `fungibledidac`, `alumnosestimados`, `precioventamat`, `totalingresos`, `totalcostes`, `costedocente`, `administracion`, `otrosgastos`, `margenbeneficio`, `porcentajeventas`, `id_matricula`, `justificacion`) VALUES ("'.$valores[costeaula].'","'.$valores[fungibledidac].'","'.$valores[alumnosestimados].'","'.$valores[precioventamat].'","'.$valores[totalingresos].'","'.$valores[totalcostes].'","'.$valores[costedocente].'","'.$valores[administracion].'","'.$valores[otrosgastos].'","'.$valores[margenbeneficio].'","'.$valores[porcentajeventas].'","'.$id.'","'.$valores[justificacion].'")';
            // echo $q1;
           // $q1 = mysqli_query($link,$q1);
        //}

        // if ( $_SESSION['user'] != 'root') {


        enviarMailNotif($numeroaccion,$grupo,'p-ini',$link,'',$_SESSION[user]);

        if ($valores['estado'] == 'Comunicada') {
            enviarMailNotif($numeroaccion, $grupo, 'pm-alta',$link,$id);
            envioMailCalidad("", $valores[id_docente][0], $link);
        }

        if ( $enviarlt == 1 )
            enviarMailNotif($numeroaccion,$grupo,'p-rltiniciop',$link,'P');
        // }

        // Fungibles y Otros Gastos Detallados
        // $qItems = "INSERT INTO mat_items_gastos(id_item, cantidad, id_mat) select id_item, cantidad, ".$id." from mat_items_gastos_temp";

        // $qItems = mysqli_query($link, $qItems);

        $qItems = "UPDATE mat_items_gastos SET id_mat = '".$id."' WHERE id_temp = ".$valores[id_temp];

        $qItems = mysqli_query($link, $qItems);

        echo $id;


    } else {
        $id = $valores['id_matricula'];
        $fechaComunicada = '';
        $fechaFinalizada = '';

        if ($valores['estado'] == 'Comunicada') {
            // echo "entra a pmalta";
            $fechaComunicada = date("Y-m-d");
            enviarMailNotif($numeroaccion, $grupo, 'pm-alta',$link,$id);
        }
        if ($valores['estado'] == 'Finalizada')
            $fechaFinalizada = date("Y-m-d");
        if ($valores['estado'] == 'Anulada') {

            $q = 'SELECT md.id_docente
            FROM mat_doc md
            WHERE md.id_matricula = '.$id;
            $q = mysqli_query($link, $q);

            while ( $row = mysqli_fetch_array($q) ) {

                enviarMailNotif($numeroaccion, $grupo, 'pm-alta-anu',$link,$id.'-'.$row[id_docente]);

            }
            enviarMailNotif($numeroaccion,$grupo,'pm-anu',$link,'',$_SESSION[user]);

        }


        $qup = 'SELECT m.id_accion, fechaini, fechafin, m.id_grupo, m.tipo_docente, estado, horariomini, horariomfin, horariotini, horariotfin, diascheck, fechacreacion, presupuesto, comercial, m.observaciones, grupo, solicitud, id_solicitud, id_solicitudikea, r.*, a.numeroaccion, ga.ngrupo, a.denominacion,c.nombrecentro, c.direccioncentro, c.provincia,c.codigopostal,c.costeaula,c.id as id_centro,c.localidad as poblacion
        FROM matriculas m, costes_rentabilidad r, acciones a, grupos_acciones ga,centros c
        WHERE m.id = '.$id.'
        AND r.id_matricula = m.id
        AND m.id_grupo = ga.id
        AND m.id_accion = a.id
        AND m.centro = c.id';
        // echo $qup;
        $qup = mysqli_query($link, $qup) or die("error" . mysqli_error($link) );

        $row = mysqli_fetch_assoc($qup);

        // for ($z=0; $z < count($row); $z++) {
        unset($valores[fuente]);
        unset($valores[matricula]);
        unset($valores[tiposolicitud]);
        unset($valores[id_coste]);
        unset($valores[id_matricula]);
        $centronuevo = $valores[centronuevo];
        unset($valores[centronuevo]);
        $id_centro = $valores['id_centro'];
        unset($valores[id_centro]);
        unset($valores[id_matricula]);
        // print_r($valores);
        // echo "<br>";
        // print_r($row);
        $dif = array_diff_assoc($valores, $row);
        // echo "diferencias: ".print_r($dif);
        $t = "<pre>".print_r($dif, true)."</pre>";
        $t = str_replace('Array', '', $t);

        if ( count($dif) > 0 )  {
            enviarMailNotif($numeroaccion, $grupo, 'cambios-mat-presen', $link, $t, $_SESSION[user]);
        }


        // echo $id_centro;

        if ( strlen($valores['nombrecentro']) > 0 ) {



            if ( $id_centro != "" && $centronuevo == "No" ) {

                $q1 = 'UPDATE centros SET
                nombrecentro = ' . '"' . $valores['nombrecentro'] . '"' . ', direccioncentro = ' . '"' . $valores['direccioncentro'] . '"' . ', codigopostal = ' . '"' . $valores['codigopostal'] . '"' .
                ', localidad = ' . '"' . $valores['poblacion'] . '"' . ', provincia = ' . '"' . $valores['provincia'] . '" WHERE id = ' . $id_centro;
                // echo $q1 . "<br>";
                $q1 = mysqli_query($link, $q1);

            } else {

                // $q = 'SELECT max(id)
                // FROM centros';
                // $q = mysqli_query($link, $q);

                // $row = mysqli_fetch_row($q);
                // $id_centro = $row[0] + 1;
                // echo $id_centro;

                $q1 = 'INSERT IGNORE INTO `centros`( `nombrecentro`, `direccioncentro`, `codigopostal`, `localidad`, `provincia`, `id_matricula`)
                VALUES ("' . $valores['nombrecentro'] . '","' . $valores['direccioncentro'] . '","' . $valores['codigopostal'] . '","' . $valores['poblacion'] . '","' . $valores['provincia'] . '","' . $id . '")';
                // echo $q1 . "<br>";
                $q1 = mysqli_query($link,$q1);
                $id_centro = mysqli_insert_id($link);

            }

        }

        $q1 = 'UPDATE matriculas SET
            fechaini = ' . '"' . $valores['fechaini'] . '"' . ', fechafin = ' . '"' . $valores['fechafin'] . '"' . ', estado = ' . '"' . $valores['estado'] . '"' .
            ', horariomini = ' . '"' . $valores['horariomini'] . '"' . ', horariomfin = ' . '"' . $valores['horariomfin'] . '"' . ', horariotini = ' . '"' .
            $valores['horariotini'] . '"' . ', horariotfin = ' . '"' . $valores['horariotfin'] . '"' . ', diascheck = ' . '"' . $valores['diascheck'] . '"' .
            ', fechacomunicacion = ' . '"' . $fechaComunicada . '"' . ', fechafinalizacion = ' . '"' . $fechaFinalizada . '"' . ', presupuesto = ' . '"' . $valores['presupuesto'] . '"' .', observaciones = ' . '"' . $valores['observaciones'] . '"' .
            ', comercial = ' . '"' . $valores['comercial'] . '"' . ', solicitud = ' . '"' . $valores['solicitud'] . '"' . ', id_solicitudikea = ' . '"' . $valores['id_solicitudikea'] . '"' . ', id_solicitud = ' . '"' . $valores['id_solicitud'] . '"'.' , centro = ' . '"' . $id_centro . '"' .' , tipo_docente = ' . '"' . $valores['tipo_docente'] . '", incidencias = "'.addslashes($valores[incidencias]).'", grupo_dino = "'. $valores['grupo_dino'].'", observacioneslogistica = "'. $valores['observacioneslogistica'].'", aulavirtual =
            "'. $valores['aulavirtual'] . '"  WHERE id = ' . $id;
            // echo $q1 . "<br>";
            $q1 = mysqli_query($link, $q1);



        $enviarlt = 0;
        $coma = ",";
        if ( sizeof($valores['id_empresa']) > 0 ) {
            for ($i = 0; $i < sizeof($valores['id_empresa']); $i++) {

                // comprueba num cuenta
                compruebaNumCuenta($valores['id_empresa'][$i], $numeroaccion, $grupo, $link);

                if ( strpos($grupo, "p") === FALSE ) {

                    $qrlt2 = 'SELECT razonsocial FROM empresas
                    WHERE id = "'.$valores[id_empresa][$i].'"
                    AND representacionlegal = 1';
                    // echo $qrlt2;
                    $qrlt2 = mysqli_query($link, $qrlt2) or die("error rlt");

                    if ( mysqli_num_rows($qrlt2) > 0 ) $enviarlt = 1;
                    // echo $enviarlt;

                }


                if ($i == sizeof($valores['id_empresa']) - 1)
                    $coma = "";
                $empresas .= ' ("' . $id . '","' . $valores['id_empresa'][$i] . '")' . $coma;
            }


            // EN TABLA TEMPORAL! NO NUMCUENTA, NO ALUMNO, NO JORNADAS
            // inserto  matricula - empresas
            $qemp = 'INSERT IGNORE INTO ptemp_mat_emp
            (id_matricula, id_empresa)
            VALUES ' . $empresas;
            // echo $qemp . "<br>";
            $qemp = mysqli_query($link,$qemp) or die ("error insert". mysqli_error($link));
            enviarMailNotif($numeroaccion,$grupo,'p-act-nuevaemp', $link,'',$_SESSION[user]);

        }

        // $enviarlt = 0;
        // $coma = ",";
        // if ( sizeof($valores['id_empresa']) > 0 ) {

        //     // comprueba num cuenta
        //     // compruebaNumCuenta($valores['id_empresa'][$i], $numeroaccion, $grupo, $link);
        //     for ($i = 0; $i < sizeof($valores['id_empresa']); $i++) {
        //         if ( strpos($grupo, "p") === FALSE ) {

        //             $qrlt = 'SELECT razonsocial FROM empresas
        //             WHERE id = "'.$valores[id_empresa][$i].'"
        //             AND representacionlegal = 1';
        //             // echo $qrlt;
        //             $qrlt = mysqli_query($link, $qrlt) or die("error rlt");

        //             if ( mysqli_num_rows($qrlt) > 0 ) $enviarlt = 1;
        //             // echo $enviarlt;

        //         }

        //             if ($i == sizeof($valores['id_empresa']) - 1)
        //                 $coma = "";
        //             $empresas .= ' ("' . $id . '","' . $valores['id_empresa'][$i] . '")' . $coma;
        //     }


        //     // EN TABLA TEMPORAL! NO NUMCUENTA, NO ALUMNO, NO JORNADAS
        //     // inserto  matricula - empresas
        //     $q1 = 'INSERT IGNORE INTO ptemp_mat_emp
        //     (id_matricula, id_empresa)
        //     VALUES ' . $empresas;
        //     // echo $q1 . "<br>";
        //     $q1 = mysqli_query($link,$q1);
            // enviarMailNotif($numeroaccion,$grupo,'p-act-nuevaemp', $link,$empresas,$_SESSION[user]);

        // }


        if ( $valores['solicitud'] != "" && $valores['solicitud'] != 'undefined' ) {

            if ( strpos($valores['solicitud'],'IK') !== FALSE ) {

                $tabla = 'ikea_solicitudes';
                $campot = 'estadosolikea';
                $valor = $valores[id_solicitudikea];

            } else {

                $tabla = 'peticiones_formativas';
                $campot = 'estado_peticion';
                $valor = $valores[id_solicitud];

            }

            $q2 = 'UPDATE '.$tabla.' SET '. $campot. ' = "Aceptada"
            WHERE id = "'. $valor .'"';
            // echo $q2;
            $q2 = mysqli_query($link, $q2) or die('error:update' .mysqli_error($link));

        }


        $horariomini = $valores[horariomini];
        $horariomfin = $valores[horariomfin];
        $horariotini = $valores[horariotini];
        $horariotfin = $valores[horariotfin];

        if ( $horariomini !== "" )
            $horario = $horariomini.' - '.$horariomfin;
        if ( $horariomini !== "" && $horariotini !== "" )
            $horario .= ' | ';
        if ( $horariotini != "" )
            $horario .= $horariotini.' - '.$horariotfin;


        $coma = ",";
        if ( sizeof($valores['id_docente']) > 0 ) {

            // $q = 'SELECT id_docente
            // FROM mat_doc md
            // WHERE m.id_matricula = '.$id;
            // $q = mysqli_query($link, $q);

            // $row = mysqli_fetch_array($q);
            // $docenteant = $row[id_docente];

            $k = 1;
            for ($i = 0; $i < sizeof($valores['id_docente']); $i++) {
                if ($i == sizeof($valores['id_docente']) -1)
                    $coma = "";

                if ($valores['fechadocini'.$k] == "") $valores['fechadocini'.$k] = $valores['fechaini'];
                if ($valores['fechadocfin'.$k] == "") $valores['fechadocfin'.$k] = $valores['fechafin'];
                if ($valores['horariodoc'.$k] == "") $valores['horariodoc'.$k] = $horario;
                if ($valores['numhorasdoc'.$k] == "") $valores['numhorasdoc'.$k] = $horastotales;

                $docentes .= '("' . $id . '","' . $valores['id_docente'][$i] . '","' . $valores['fechadocini'.$k] . '", "' . $valores['fechadocfin'.$k] . '","' .$valores['horariodoc'.$k]. '","' .$valores['numhorasdoc'.$k]. '")' . $coma;
                $k++;
                // echo $docentes;
            }

            $q1 = 'INSERT IGNORE INTO mat_doc
            (id_matricula, id_docente, fechadocini, fechadocfin, horariodoc, numhorasdoc)
            VALUES ' . $docentes;
            // echo $q1 . "<br>";
            $q1 = mysqli_query($link,$q1);
            enviarMailNotif($numeroaccion,$grupo,'p-act-nuevodocpresen',$link, '', $_SESSION[user]);
        }

        $coma = ",";
        if ( sizeof($valores['fechas']) > 0 ) {
            // print_r($valores['fechas']);
            $fechas = explode(",", $valores['fechas']);
            for ($i=0; $i < sizeof($fechas); $i++) {
                if ($i == sizeof($fechas) - 1) $coma = "";
                $values .= '("'.$id.'","'.$fechas[$i].'")' . $coma;
            }
            $q = 'INSERT IGNORE INTO fechas_excluir
            (id_matricula, fecha)
            VALUES '.$values;
            // echo $q;
            $q = mysqli_query($link, $q) or die("error" .mysqli_error($link));
        }

        //if ( strlen($valores[precioventamat]) > 0 ) {

          //  $q = 'SELECT id
            //FROM costes_rentabilidad
            //WHERE id_matricula = '.$id;
            //$q = mysqli_query($link, $q);
            // $row = mysqli_fetch_array($q);

            //if ( mysqli_num_rows($q) > 0 ) {

              //  $q1 = 'UPDATE `costes_rentabilidad` SET costeaula = "'.$valores[costeaula].'", fungibledidac = "'.$valores[fungibledidac].'", alumnosestimados = "'.$valores[alumnosestimados].'", precioventamat = "'.$valores[precioventamat].'", totalingresos = "'.$valores[totalingresos].'", totalcostes = "'.$valores[totalcostes].'", costedocente = "'.$valores[costedocente].'", administracion = "'.$valores[administracion].'", otrosgastos = "'.$valores[otrosgastos].'", margenbeneficio = "'.$valores[margenbeneficio].'", porcentajeventas = "'.$valores[porcentajeventas].'", justificacion = "'.$valores[justificacion].'" WHERE id_matricula = "'.$id.'"';
                // echo $q1;
                //$q1 = mysqli_query($link,$q1);

            //} else {

              //  $q1 = 'INSERT IGNORE INTO `costes_rentabilidad`(`costeaula`, `fungibledidac`, `alumnosestimados`, `precioventamat`, `totalingresos`, `totalcostes`, `costedocente`, `administracion`, `otrosgastos`, `margenbeneficio`, `porcentajeventas`, `id_matricula`, `justificacion`) VALUES ("'.$valores[costeaula].'","'.$valores[fungibledidac].'","'.$valores[alumnosestimados].'","'.$valores[precioventamat].'","'.$valores[totalingresos].'","'.$valores[totalcostes].'","'.$valores[costedocente].'","'.$valores[administracion].'","'.$valores[otrosgastos].'","'.$valores[margenbeneficio].'","'.$valores[porcentajeventas].'","'.$id.'","'.$valores[justificacion].'")';
                // echo $q1;
                //$q1 = mysqli_query($link,$q1);

            //}
        //}




        // if ( !isRoot() ) {

            enviarMailNotif($numeroaccion, $grupo, 'p-act',$link);

            if ( $enviarlt == 1 ) {
                // echo "entra enviarlt";
                enviarMailNotif($numeroaccion,$grupo,'p-rltiniciop',$link,'P');
            }


            if ($valores['estado'] == 'Comunicada') {
                // echo "entra";
                enviarMailNotif($numeroaccion, $grupo, 'pm-alta',$link,$id);
                // envioMailCalidad("", $valores[id_docente][0], $link);
            }

            if ($valores['estado'] == 'Gratuita') {
                enviarMailNotif($numeroaccion, $grupo, 'aviso_diplomas', $link );
                enviarMailNotif($numeroaccion, $grupo, 'mat-a-gratis', $link, 'Presencial', '', $_SESSION[user]);
            }

        // } else {

            // Fungibles y Otros Gastos Detallados
            // como es una actualización no hace falta hace nada aquí, ya lo hicimos al modificarlos
            // $qItems = "INSERT INTO mat_items_gastos(id_item, cantidad, id_mat) select id_item, cantidad, ".$id." from mat_items_gastos_temp";

            // $qItems = mysqli_query($link, $qItems);

            // $qItems = "delete from mat_items_gastos_temp";

            // $qItems = mysqli_query($link, $qItems);

        // }

        echo $id;
    }
}


function guardarObservacionesFin($idmat, $observacionesfin, $link) {

    $q = 'UPDATE matriculas SET observacionesfin = "'.addslashes($observacionesfin).'" WHERE id = '.$idmat;
    $q = mysqli_query($link, $q) or die("error update observ ".mysqli_error($link));

    $q = 'SELECT m.id, a.numeroaccion, ga.ngrupo, a.modalidad
    FROM matriculas m, acciones a, grupos_acciones ga
    WHERE m.id_accion = a.id
    AND m.id_grupo = ga.id
    AND m.id = '.$idmat;
    // echo $q;
    $q = mysqli_query($link, $q);


    $row = mysqli_fetch_array($q);
    $numeroaccion = $row[numeroaccion];
    $ngrupo = $row[ngrupo];

    enviarMailNotif($numeroaccion, $ngrupo, 'observacionesfin', $link, $observacionesfin, $_SESSION[user]);

    // return "Guardado"


}


function guardarObservacionesFinAmanda($idmat, $observacionesfin, $link) {

    $q = 'UPDATE matriculas SET observacionesfinamanda = "'.addslashes($observacionesfin).'" WHERE id = "'.$idmat.'"';
    // echo $q;
    $q = mysqli_query($link, $q) or die("error update observ ".mysqli_error($link));

}

function guardarIncidenciasFinAmanda($idmat, $observacionesfin, $link) {

    $q = 'UPDATE matriculas SET incidenciasfinamanda = "'.addslashes($observacionesfin).'" WHERE id = "'.$idmat.'"';
    // echo $q;
    $q = mysqli_query($link, $q) or die("error update observ ".mysqli_error($link));

    // $q = 'SELECT m.id, a.numeroaccion, ga.ngrupo, a.modalidad
    // FROM matriculas m, acciones a, grupos_acciones ga
    // WHERE m.id_accion = a.id
    // AND m.id_grupo = ga.id
    // AND m.id = '.$idmat;
    // // echo $q;
    // $q = mysqli_query($link, $q);


    // $row = mysqli_fetch_array($q);
    // $numeroaccion = $row[numeroaccion];
    // $ngrupo = $row[ngrupo];

    // enviarMailNotif($numeroaccion, $ngrupo, 'observacionesfin', $link, $observacionesfin, $_SESSION[user]);

    // return "Guardado"


}

function enviarRLTpremix( $id_emp, $id_mat, $link ) {


    for ($i=0; $i < count($id_emp); $i++) {

        $q = 'SELECT representacionlegal
        FROM empresas e
        WHERE id = "'.$id_emp[$i].'"';
        $q = mysqli_query($link, $q);
        $r = mysqli_fetch_row($q);

        if ( $r[0] == 1 ) {

            $sql = 'SELECT DISTINCT a.numeroaccion, a.denominacion, ga.ngrupo, m.fechaini, m.fechafin, e.razonsocial, m.comercial
            FROM matriculas m, acciones a, grupos_acciones ga, ptemp_mat_emp ma, empresas e
            WHERE m.id_accion = a.id
            AND m.id_grupo = ga.id
            AND ma.id_matricula = m.id
            AND ma.id_empresa = e.id
            AND e.id ='.$id_emp[$i].'
            AND m.id ='.$id_mat;

            $sql = mysqli_query($link, $sql) or die ("error");

            while ($row = mysqli_fetch_array($sql)) {
                $naccion = $row[numeroaccion];
                $ngrupo = $row[ngrupo];
                $denominacion = $row[denominacion];
                $fechaini = date("d/m/Y",strtotime($row[fechaini]));
                $fechafin = date("d/m/Y",strtotime($row[fechafin]));
                $razonsocial = trim($row[razonsocial]);
                $comercial = $row[comercial];
            }

            ob_start();
            include($baseurl.'/documentacion/rlt2.php');
            $content .= ob_get_contents();

        }
    }

    $nombreFichero = "RLT-".$naccion."_".$ngrupo.".pdf";

    $html2pdf = new HTML2PDF('P', 'A4', 'es', true, 'UTF-8', array(0, 0, 0, 0));
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content);
    $content_PDF = $html2pdf->Output('','S');

    if ( $comercial == 0  ) {
        $q = 'SELECT c.email
        FROM empresas e, comerciales c
        WHERE e.comercial = c.id
        AND e.id = '.$id_emp[0];
        // echo $q;
        $q = mysqli_query($link, $q);

        $row = mysqli_fetch_row($q);
        $emailcomercial = $row[0];
    } else {
        $q = 'SELECT c.email
        FROM comerciales c
        WHERE c.id = "'.$comercial.'"';
        // echo $q;
        $q = mysqli_query($link, $q);


        $row = mysqli_fetch_row($q);
        $emailcomercial = $row[0];
    }


    $cc = $emailcomercial;
    //$para = 'mchinea@eduka-te.com';
    $para = 'margarita.mitkova@eduka-te.com';
    $mail = new PHPMailer;
    $mail->From = 'gestion@eduka-te.com';
    $mail->FromName = 'Gestión';
    $mail->addAddress($para);                   // Add a recipient
    // $mail->addAddress('ellen@example.com');               // Name is optional
    // $mail->addReplyTo('ivan.cabrera@eduka-te.com');
    $mail->addCC($cc);
    $mail->addAddress('shirley.gonzalez@eduka-te.com');
    $mail->addBCC('ivan.cabrera@eduka-te.com');
    $mail->addBCC('aperojo@eduka-te.com');
    // $mail->WordWrap = 50;                                   // Set word wrap to 50 characters
    $mail->AddStringAttachment($content_PDF, $nombreFichero, 'base64', 'application/pdf');
    // $mail->addAttachment($pdf);                   // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');   // Optional name
    $mail->isHTML(true);                                    // Set email format to HTML
    $titulo = $mail->Subject = 'Requerida RLT en acción '.$naccion.'.'.$ngrupo;
    $mail->Body    = 'La siguientes empresas tienen q cumplimentar la RLT para poder participar en la acción formativa '.$naccion.'.'.$ngrupo."<br>".'Adjunto a este correo enviamos modelo para su cumplimentación';
    $mail->CharSet = 'UTF-8';

    if(!$mail->send()) {
        echo 'Error. Email no enviado: ' . $mail->ErrorInfo;
    } else {
        registrarMailBD($para, $titulo, $cc, $link);
        echo 'ok';
    }


}


?>
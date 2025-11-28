<?
// 30.OCTUBRE.2019 - ERRORES
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

session_start();
// $link = connect();
//if ( strpos($_SESSION['user'], 'ikea_') !== false ) {
 //   $link = connect(2016);
    $link = connect($_SESSION['anio']);
    
//}
$gestion = devuelveAnio();

// ini_set('max_execution_time', 0);
date_default_timezone_set('Europe/London');
setlocale(LC_TIME,"es_ES");

$baseurl = $_SERVER['DOCUMENT_ROOT'].'/app';
$basepath = 'http://gestion.eduka-te.com.com/app';

if ($_POST['actualizarContactos'] != 0 && $_POST['actualizarContactos'] != undefined) {

    actualizarContactos($_POST['id_contacto'],$_POST,$link);

} else if ($_POST['guardarContactos'] == '1') {

    guardaContactos($_POST['id_emp'],$_POST,$link);

} else if ($_POST['contactos'] == '1') {

    if ($_POST['id_emp'] != "")
        devuelveContactos($_POST['id_emp'], $link);
    else
        return false;

} else if ($_POST['cambiajornada'] == '1') {

    cambiaJornada($_POST['id_matricula'], $_POST['id_alumno'], $_POST['jornadalaboral'], $link);

} else if ($_POST['cuadrocredenciales'] == '1') {

    cuadroCredenciales($_POST['id_alumno'], $_POST['id_mat'], $link);

} else if ($_POST['guardarcredenciales'] == '1') {

    guardarCredenciales($_POST['id_alu'], $_POST['id_mat'], $_POST['user'], $_POST['pass'], $link);

} else if ($_POST['eliminardematricula'] == '1') { // ELIMINAR DOCENTE / ALUMNO DE MATRICULA

    if ( isset($_POST['id_alumno']) )
        eliminarAlumnoDeMatricula($_POST['id_alumno'], $_POST['id_matricula'], $link);
    else if ( isset($_POST['id_docente']) )
        eliminarDocenteDeMatricula($_POST['id_docente'], $_POST['id_matricula'], $link);

} else if (isset($_POST['tabla']) &&  $_POST['abre'] == '1') { // ABRE MODAL Y CARGA DATOS

    mostrarTabla($_POST['tabla'], $_POST['mat'], $link, $_POST['id_mat']);

} else if (isset($_POST['id']) &&  $_POST['cierra'] == '1' && isset($_POST['tabla'])) { // CIERRA MODAL Y DEVUELVE DATOS

    if (!isset($_POST['devolvermat']))
        devolverDatos($_POST['id'],$_POST['tabla'],$_POST['mat'],$link);
    else
        devolverDatosMatricula($_POST['id'],$_POST['tabla'],$link);

} else if ( $_POST['guardacodiploma'] == '1') {

    guardacodpiloma($_POST[mat], $_POST[emp], $_POST[alu], $_POST[codiploma], $link);

} else if ( $_POST['compruebaenvioguia'] == '1' ) {

    comprobarEnvioGuia($_POST['id_matricula'], $link);

} else if ( $_POST['alumnosguias'] == '1' ) {

    devuelveAlumnosGuias($_POST['id_matricula'], $_POST[tipo], $_POST[mod], $link);

} else if ( $_POST['checkcif'] == '1' ) {

    compruebaCIFemp($_POST, $link);

} else if ( $_POST['checkalu'] == '1' ) {

    compruebaAlu($_POST, $link);

} else if ( $_POST['anadiralumnomoodle'] == '1' ) {

    anadirAlumnoMoodle($_POST, $link);

} else if ( $_POST['docentesacuerdos'] == '1' ) {

    formacionesDocente($_POST[id], $_POST[docente], $link);

} else if ( $_POST['limiteAlu'] == '1' ) {

    limiteAlumnosDocente($_POST[fechaini], $_POST[fechafin], $_POST[id_docente], $link);

} else if ( $_POST['costedocente'] == '1' ) {

    devuelveDatosCosteDocente($_POST[id_docente],$_POST[id_matricula], $link);

} else if ( $_POST['costefungibles'] == '1' ) {

    devuelveDatosFungibles($link);

} else if ( $_POST['costeotrosgastos'] == '1' ) {

    devuelveDatosOtrosGastos($link);

} else if ( $_POST['formacionalumno'] == '1' ) {

    formacionesAlumno($_POST[id_alumno], $_POST[alumno], $link);

} else if ( $_POST['formacionempresa'] == '1' ) {

    formacionesEmpresa($_POST[id_empresa], $_POST[empresa], $link);

} else if ( $_POST['buscarcentro'] == '1' ) {

    buscarCentro($_POST[nombrecentro], $link);

} else if ( $_POST['datoscentro'] == '1' ) {

    devuelveDatosCentro($_POST[id], $link);

} else if ( $_POST['datosempresa'] == '2' ) {

    devuelveDatosEmpresaCostesFac($_POST['id_matricula'], $link);

} else if ( $_POST['borraralumnobd'] == '1' ) {

    borrarAlumnoBD($_POST['id_alumno'], $link);

} else if ( $_POST['borrarempresabd'] == '1' ) {

    borrarEmpresaBD($_POST['id_empresa'], $link);

} else if ( $_POST['borrarmatindbd'] == '1' ) {

    borrarMatriculaIndDB($_POST['id_matricula'], $link);

} else if ( $_POST['cambiargrupo'] == '1' ) {

    cambiarGrupo($_POST['grupoant'],$_POST['gruponuevo'],$link);

} else if ( $_POST['anadirgrupoemp'] == '1' ) {

    anadirGrupoNuevo($_POST['nombregrupo'], $link);

} else if ( $_POST['precomisionistacontinua'] == '1' ) {

    preComisionistaContinua($_POST['id_comisionista'], $link);

} else if ( $_POST['precomisionistacontrato'] == '1' ) {

    preComisionistaContrato($_POST['id_comisionista'], $link);

} else if ( $_POST['precomisionistaotro'] == '1' ) {

    preComisionistaOtro($_POST['id_comisionista'], $link);

} else if ( $_POST['guardaestipulaciones'] == '1' ) {

    guardaEstipulacioneS($_POST['id_comisionista'], $_POST['estipulaciones'], $link);

} else if ( $_POST['compruebavin'] == '1') {

    compruebaVIN($_POST['id_matricula'], $link);

} else if ( $_POST['crearuserdocente'] == '1' ) {

    crearUserDocente($_POST[id], $link);

} else if ( $_POST['listarsms'] == '1' ) {

    listarSMS($link);

} else if ( $_POST['launcher'] == '1' ) {

    connect($_POST['gestion']);

} else if ( $_POST['guardacuestionario'] == '1' ) {

    guardaCuestionario($_POST, $link);

} else if ( $_POST['guardacuestionarioikea'] == '1' ) {

    guardaCuestionarioIKEA($_POST, $link);

} else if ( $_POST['guardar_reporte'] == '1') {

    guardaReporte($_POST, $link);

} else if ( $_POST['guardarempresareporte'] == '1') {

    guardarEmpresaReporte($_POST, $link);

} else if ( $_POST['listarreportes'] == '1' ) {

    listarReporte($_SESSION['user'], $link);

} else if ( $_POST['listarreportesprox'] == '1' ) {

    listarReporteProx($_SESSION['user'], $link);

} else if ( $_POST['guardar_peticion'] == '1' ) {

    guardarPeticionPropuesta($_POST, $link);

} else if ( $_POST['guardar_mireporte'] == '1') {

    guardaMiReporte($_POST, $link);

} else if ( $_POST['cuestionarioikea'] == '1' ) {

    devuelveCuestionarioIKEA($_POST[id_mat], $link);

} else if ( $_POST['devuelvenominas'] == '1' ) {

    devuelveNominasMostrar($_POST[dni]);

} else if ( $_POST['guardar_usuario_nomina'] == '1' ) {

    guardarUserNomina($_POST, $link);

} else if ( $_POST['vernomina'] == '1' ) {

    verNomina($_POST[user], $link);

} else if ( $_POST['preparaback'] == '1' ) {

    preparaBackDiploma($_POST[html], $_POST[porcen], $_POST[fuente], $_POST[fuentereal], $_POST[id_accion], $_POST[id_mat], $link);

} else if ( $_POST['alumnosdiplomas'] == '1' ) {

    devuelveAlumnosDiplomas($_POST[id_matricula], $_POST[tipo], $_POST[modalidad], $_POST[html], $_POST[porcen], $_POST[fuente], $_POST[fuentereal], $_POST[id_accion], $link);

} else if ( $_POST['guardatipofra'] == '1' ) {

    guardaTipoFra($_POST[tipofra], $_POST[id_mat], $link);

} else if ( $_POST['solcredresulta'] == '1' ) {

    enviarMailNotif($_POST[cif], $_POST[id_comercial], 'credito-resuelto', $link);

} else if ( $_POST['duplicar_propuesta'] == '1' ) {

    duplicarPropuesta($_POST[idprop], $_POST[id_comercial], $link);

} else if ( $_POST['duplicar_propuesta_mat'] == '1' ) {

    duplicarPropuestaMat($_POST[idprop], $link);

} else if ( $_POST['devuelve_comerciales_prop'] == '1' ) {

    devuelveComercialesProp($link);

} else if ( $_POST['guardarmediasik'] == '1' ) {

    guardarMediasIK($_POST['mediainicial'], $_POST['mediafinal'], $_POST['valoracioncurso'], $_POST['id'], $link);

} else if ( $_POST['cargarFacturasAcciones'] == '1' ) {

    cargarFacturasAccion($_POST['id_matricula'], $link);

} else if ( isset($_POST[duplicardocente]) ) {

    duplicarDocente($_POST[id], $link);

} else if ( isset($_POST[rltcif]) ) {

    RLTCIF();

} elseif ( $_POST['cargarSelectRentabilidad'] == '1' ) {

    cargarSelectRentabilidad($_POST[tipoGasto], $link);

} else if ( isset($_POST['anadeviajes']) ) {

    insertar($valores, 'peticiones_viajes', $link);

} else if ( isset($_POST['cursos_tpc']) ) {

    insertaCursoTPC($_POST['docentes'], $_POST['horario'], $_POST['id'], $link);

} else if ( isset($_POST['compruebaiban']) ) {

    compruebaIBAN($_POST['iban']);

} else if ( isset($_POST['acceso']) ) {

    compruebaAcceso($_POST['user'], $link);

} else if ( isset($_POST['borrar']) ) {

    borrarGenerico($_POST['id'], $_POST['tabla'], $link);

}




function compruebaAcceso($user, $link) {

    $q = 'SELECT acceso
    FROM usuarios
    WHERE user = "'.$user.'"';
    // echo $q;
    $q = mysqli_query($link, $q) or die("error select : " .mysqli_error($link));

    $row = mysqli_fetch_assoc($q);

    echo json_encode($row);


}

function insertaCursoTPC($docentes, $horario, $id, $link) {

    // arrayText($_POST);

    if ( $id != "" ) {
        $q = 'DELETE FROM cursos_tpc_docentes WHERE id_curso = "'.$id.'"';
        $q = mysqli_query($link, $q) or die("error delete docentes: " .mysqli_error($link));
    }

    $q = 'INSERT IGNORE INTO cursos_tpc_docentes (id_docente, id_curso)
    VALUES ';

    $coma = ', ';

    foreach ($docentes as $key => $value) {

        if ( $i++ == count($docentes)-1 )
            $coma = '';

        $q .= '("'.$value.'", "'.$id.'")'.$coma;
    }

    echo "<br>".$q."<br>";
    $q = mysqli_query($link, $q) or die("error select docentes: " .mysqli_error($link));

    // arrayText($docentes);
    // arrayText($horario);

    $horarios = array_chunk($horario[0], 5);

    // arrayText($horarios);

    $q = 'INSERT IGNORE INTO cursos_tpc_horarios (fecha, horariomini, horariomfin, horariotini, horariotfin, id_curso)
    VALUES ';


    $coma = ', ';

    for ($i=0; $i < count($horarios); $i++) {

        $j = 0;
        $q .= '(';
        if ( $i == count($horarios)-1 ) $coma = '';

        foreach ($horarios[$i] as $key => $value) {

            arrayText($value);
            echo $value;
            $coma2 = ', ';
            if ( $j++ == count($horarios[$i])-1 )
                $coma2 = '';
            $q .= '"'.$value['value'].'"'.$coma2;
        }
        $q .= ',"'.$id.'")'.$coma;
    }

    echo "<br>".$q."<br>";
    $q = mysqli_query($link, $q) or die("error select horarios: " .mysqli_error($link));

}

function RLTCIF() {

    echo
    '
    <div class="col-md-12" style="overflow:auto; margin: 20px 0 20px 0">
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label" for="CIF">CIF Empresa:</label>
                <input type="text" id="CIF" name="CIF" class="form-control">
            </div>
        </div>
        <div style="float:right; margin-top:25px; " class="col-md-4">
            <div class="form-group botones">
                <a href="#" data-toggle="modal" id="rltcifgo" name="empresas" class="btn btn-block btn-sm btn-default"><span class="glyphicon glyphicon-list-alt"></span> Generar RLT</a>
            </div>
        </div>
    </div>
    ';


}

function duplicarDocente($id, $link) {

    $q = 'SELECT d.*
    FROM docentes d
    WHERE d.id = '.$id;
    $q = mysqli_query($link, $q) or die("error" . mysqli_error($link));

    $row = mysqli_fetch_assoc($q);
    unset($row[id]);

    $table_name = 'docentes';
    $fields = array_keys($row);

    $sql = "INSERT INTO ".$table_name."
    (`".implode('`,`', $fields)."`)
    VALUES('".implode("','", $row)."')";
    echo $sql;
    $result=mysqli_query($link,$sql) or die("error: ".mysqli_error($link));



}

function desayunoConexion($link){

    $link_d=mysqli_connect("46.16.62.150","myEDUKA-TE","qMtJ7OoD","EDUKA-TE2015wp") or die ("Error de CONEXION");

}


function guardarMediasIK($notaini, $notafin, $valoracion, $id, $link) {

    $q = 'UPDATE matriculas SET mediainicial = "'.$notaini.'", mediafinal = "'.$notafin.'", valoracioncurso = "'.$valoracion.'" WHERE id = "'.$id.'"';
    // echo $q;
    $q = mysqli_query($link, $q) or die("error insertando medias " . mysqli_error($link));

}


function devuelveComercialesBusqueda($user, $link) {

    // if ( $user == 'oscar' ) {

    //     $q = 'SELECT id, nombre, apellido
    //     FROM comerciales WHERE id IN (2,3,12,7,38,40, 4)
    //     ORDER by id ASC';
        echo '<option value="">Cualquiera</option>';

    // } else if ( $user == 'isabel' || $user == 'amparo' ) {

    //     $q = 'SELECT id, nombre, apellido
    //     FROM comerciales WHERE id IN (3,7,12)
    //     ORDER by id DESC';
    //     echo '<option value="">Cualquiera</option>';

    // } else if ( $user == 'efrencomercial' ) {

    //     $q = 'SELECT id, nombre, apellido
    //     FROM comerciales WHERE id IN (2,4)
    //     ORDER by id DESC';
    //     echo '<option value="">Cualquiera</option>';

    // } else if ( strpos($user, 'asociado') !== false )

    //     $q = 'SELECT id, nombre, apellido
    //     FROM comerciales WHERE id IN (32)
    //     ORDER by id ASC';

    // else if ( $user == 'root' || $user == 'daniel' || $user == 'margarita.mitkova' || $user == 'sdaluz' || $user == 'rmedina' || $user == 'margarita' || $user == 'alago' || $user == 'margarita' || $user == 'margarita' || $user == 'gyanes' ) {

    //     echo '<option value="">Cualquiera</option>';

    //     $q = 'SELECT id, nombre, apellido
    //     FROM comerciales
    //     ORDER by id ASC';

    // } else

    //     $q = 'SELECT c.id, c.nombre, c.apellido
    //     FROM comerciales c, usuarios u
    //     WHERE u.id_comercial = c.id
    //     AND u.user = "'.$user.'"
    //     ORDER by id ASC';


    // quitamos restriccion temporal para comerciales
    $q = 'SELECT id, nombre, apellido
    FROM comerciales
    ORDER by id ASC';

    // echo $q;
    $q = mysqli_query($link,$q);

    while ($row = mysqli_fetch_array($q))
        echo '<option value="'.$row['id'].'">'.$row['nombre'].' '.$row['apellido'].' </option>';

}


function devuelveComercialesProp($link) {

    ?>
    <div class="col-md-12" style="margin-top:20px; overflow:auto">
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label" for="comercial">Comercial:</label>
                <?
                $q = 'SELECT c.id, c.nombre
                FROM comerciales c';
                $q = mysqli_query($link, $q) or die("error:" .mysqli_error($link));

                ?>
                <select name="comercial" id="comercial" class="form-control" >
                    <option value="">Mismo comercial</option>
                    <?  while ( $row = mysqli_fetch_array($q) )
                    echo '<option value="'.$row[id].'">'.$row[nombre].'</option>';
                    ?>
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <a id="duplicar_propuesta_go" style="margin-top:25px" name="" class="btn btn-sm btn-success">Duplicar Propuesta</a>
        </div>
    </div>
    <?

}


function duplicarPropuestaMat($id, $link) {


    $qprev = 'SELECT max(numero) as numero
    FROM peticiones_formativas';
    $qprev = mysqli_query($link, $qprev) or die("error" . mysqli_error($link));

    $rowprev = mysqli_fetch_array($qprev);
    $numero = $rowprev[numero]+1;
    $numero = str_pad($numero, 4, '0', STR_PAD_LEFT);
    // echo $numero;

    $q = "INSERT INTO peticiones_formativas (`numero`, `id_accion`, `modalidad`, `horaspresenciales`, `horasdistancia`, `cif`, `horastotales`, `empresas`, `tipoformacionpropuesta`, `fechaini`, `fechafin`, `observaciones`, `nombrecentro`, `numalumnos`, `id_comercial`, `formacion`, `presupuesto`, `id_centro`, `fecha_peticion`, `estado_peticion`, `prefijo`, `preciomatricula`, `abierto`, `tiposol`, `objetivos`, `contenidos`, `comisionista`, `comisionistatxt`, `observacionesgestor`, `metodologia`, `tablaprecios`, `incluye`, `metodologianum`, `presufrase`, `textobonificable`) SELECT '".$numero."', `id_accion`, `modalidad`, `horaspresenciales`, `horasdistancia`, `cif`, `horastotales`, `empresas`, `tipoformacionpropuesta`, `fechaini`, `fechafin`, `observaciones`, `nombrecentro`, `numalumnos`, `id_comercial`, `formacion`, `presupuesto`, `id_centro`, '".date('Y-m-d')."', 'Pendiente', `prefijo`, `preciomatricula`, `abierto`, 'SM', `objetivos`, `contenidos`, `comisionista`, `comisionistatxt`, `observacionesgestor`, `metodologia`, `tablaprecios`, `incluye`, `metodologianum`, `presufrase`, `textobonificable` FROM `peticiones_formativas` WHERE id = ".$id;
    // echo $q;
    $q = mysqli_query($link, $q) or die("error duplicando" . mysqli_error($link));


}

function duplicarPropuesta($id, $idc, $link) {



    $qprev = 'SELECT max(numero) as numero
    FROM peticiones_formativas';
    $qprev = mysqli_query($link, $qprev) or die("error" . mysqli_error($link));

    $rowprev = mysqli_fetch_array($qprev);
    $numero = $rowprev[numero]+1;
    $numero = str_pad($numero, 4, '0', STR_PAD_LEFT);
    // echo $numero;

    if ( $idc == "" )

        $q = "INSERT INTO peticiones_formativas (`numero`, `id_accion`, `modalidad`, `horaspresenciales`, `horasdistancia`, `cif`, `horastotales`, `empresas`, `tipoformacionpropuesta`, `fechaini`, `fechafin`, `observaciones`, `nombrecentro`, `numalumnos`, `id_comercial`, `formacion`, `presupuesto`, `id_centro`, `fecha_peticion`, `estado_peticion`, `prefijo`, `preciomatricula`, `abierto`, `tiposol`, `objetivos`, `contenidos`, `comisionista`, `comisionistatxt`, `observacionesgestor`, `metodologia`, `tablaprecios`, `incluye`, `metodologianum`, `presufrase`, `textobonificable`) SELECT '".$numero."', `id_accion`, `modalidad`, `horaspresenciales`, `horasdistancia`, `cif`, `horastotales`, `empresas`, `tipoformacionpropuesta`, `fechaini`, `fechafin`, `observaciones`, `nombrecentro`, `numalumnos`, `id_comercial`, `formacion`, `presupuesto`, `id_centro`, '".date('Y-m-d')."', `estado_peticion`, `prefijo`, `preciomatricula`, `abierto`, `tiposol`, `objetivos`, `contenidos`, `comisionista`, `comisionistatxt`, `observacionesgestor`, `metodologia`, `tablaprecios`, `incluye`, `metodologianum`, `presufrase`, `textobonificable` FROM `peticiones_formativas` WHERE id = ".$id;

    else

        $q = "INSERT INTO peticiones_formativas (`numero`, `id_accion`, `modalidad`, `horaspresenciales`, `horasdistancia`, `cif`, `horastotales`, `empresas`, `tipoformacionpropuesta`, `fechaini`, `fechafin`, `observaciones`, `nombrecentro`, `numalumnos`, `id_comercial`, `formacion`, `presupuesto`, `id_centro`, `fecha_peticion`, `estado_peticion`, `prefijo`, `preciomatricula`, `abierto`, `tiposol`, `objetivos`, `contenidos`, `comisionista`, `comisionistatxt`, `observacionesgestor`, `metodologia`, `tablaprecios`, `incluye`, `metodologianum`, `presufrase`, `textobonificable`) SELECT '".$numero."', `id_accion`, `modalidad`, `horaspresenciales`, `horasdistancia`, `cif`, `horastotales`, `empresas`, `tipoformacionpropuesta`, `fechaini`, `fechafin`, `observaciones`, `nombrecentro`, `numalumnos`, '".$idc."', `formacion`, `presupuesto`, `id_centro`, '".date('Y-m-d')."', `estado_peticion`, `prefijo`, `preciomatricula`, `abierto`, `tiposol`, `objetivos`, `contenidos`, `comisionista`, `comisionistatxt`, `observacionesgestor`, `metodologia`, `tablaprecios`, `incluye`, `metodologianum`, `presufrase`, `textobonificable` FROM `peticiones_formativas` WHERE id = ".$id;

    // echo $q;
    $q = mysqli_query($link, $q) or die("error duplicando" . mysqli_error($link));


}

// function solCredResuelta($cif, $comercial, $link) {

//     $q = 'SELECT asignado, dispuesto_acciones, dispuesto_pif, disponible, actualizado_a, c.email
//     FROM empresas e, comerciales c
//     WHERE e.cif = "'.$cif.'"
//     AND e.comercial = c.id';
//     $q = mysqli_query($link, $q) or die("error:" .mysqli_error($link));

//     $row = mysqli_fetch_array($q);

//     enviarMailNotif($cif,$numero,'credito-resuelto',$link);

// }

function guardaTipoFra($tipofra, $id_mat, $link) {

    $q = 'UPDATE matriculas SET tipofra = "'.$tipofra.'" WHERE id = '.$id_mat;
    $q = mysqli_query($link, $q) or die("error:" .mysqli_error($link));

}

function preparaBackDiploma($html, $porcen, $fuente, $fuentereal, $accion, $id_mat, $link) {

    if ( $accion == 25 ) $fuentereal = "8px";
    if ( $accion == 23 ) $fuentereal = "7px";

    if ( $fuente >= 1 && $fuente <= 8 ) {
        $htmlinicio = '<div style="font-size:'.$fuentereal.'"><table><tr>';
        $htmlfin = '</tr></table></div>';
    } else {
        $htmlinicio = '<div style="font-size:'.$fuentereal.'"><table><tr><td>';
        $htmlfin = '</td></tr></table></div>';
    }

    if ( $porcen == "25%" )
        $ancho = "215px";
    else if ( $porcen == "50%" )
        $ancho = "430px";
    else if ( $porcen == "33%" )
        $ancho = "286px";
    else if ( $porcen == "12%" )
        $ancho = "107px";
    else {
        $ancho = "850px";
    }

    $porcen = "width:".$porcen;
    $ancho = "width:".$ancho;

    $buscar = array("div", $porcen);
    $reemp = array("td", $ancho);

    // echo $html;echo "<br>";
    $htmlcontent = str_replace($buscar, $reemp, $html);
    $htmlfinal = $htmlinicio . $htmlcontent . $htmlfin;


    $q = 'UPDATE acciones SET htmldiploma = "'.mysql_escape_string($htmlfinal).'" WHERE id = '.$accion;
    mysqli_query($link, $q) or die("error" . mysqli_error($link) );

    $q2 = 'SELECT *
    FROM confirmaciones_diplomas
    WHERE id_matricula = '.$id_mat;
    $q2 = mysqli_query($link, $q2) or die("error" . mysqli_error($link));

    $resultado = array();
    if ( mysqli_num_rows($q2) > 0 ) {
        $resultado[recepcion] = 1;
        $row = mysqli_fetch_array($q2);
        $resultado[fecharecepcion] = formateaFechaHora($row[fechahora]);
    } else
    $resultado[recepcion] = 0;


    $resultado[envio] = comprobarEnvioDiplo($id_mat, $id_alu, $link);

    echo json_encode($resultado);

}

function verNomina($user, $link) {

    $resultado = array();
    $anio = devuelveAnio();

    $meses = array("",
        "Enero",
        "Febrero",
        "Marzo",
        "Abril",
        "Mayo",
        "Junio",
        "Julio",
        "Agosto",
        "Septiembre",
        "Octubre",
        "Noviembre",
        "Diciembre" );

    $q = 'SELECT nu.nombre, nu.dni, vacaciones_pendientes
    FROM nominas_usuarios nu, usuarios u
    WHERE nu.usuario = u.id
    AND u.user = "'.$user.'"';

    //echo "SQL: " .$q;

    $q = mysqli_query($link, $q) or die("error:" .mysqli_error($link));

    $row = mysqli_fetch_array($q);
    $nombre = $row[nombre];
    $vacaciones = $row[vacaciones_pendientes];
    $dni = $row[dni];

    $resultado = devuelveNominasMostrar($dni, 1);
    // echo "<pre>";
    // print_r($resultado);
    // echo "</pre>";

    echo '
    <div class="col-md-4">
        <div class="form-group">
            <label class="control-label" for="persona">Nombre:</label>
            <input type="text" value="'. $nombre .'" id="persona" name="persona" class="form-control" readonly/>
            <input type="hidden" id="dni" value="'.$dni.'"/>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label" for="persona">Vacaciones Pendientes ('.$_SESSION[anio].'):</label>
            <input type="text" value="'. $vacaciones .'" id="persona" name="persona" class="form-control" readonly/>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-4" style="margin-top: 20px">
        <table class="table table-condensed">

            <thead>
                <th style="text-align:left">Nómina Mes</th>
                <th style="text-align:center">Descargar</th>
            </thead>

            <tbody>';

                $anio1 = 2015;
                $anioActual = $anio;

            // if ( $anio1 != $anioActual ) {
                $anios = range($anioActual, $anio1);

                $i = 1; $j=1;

                $m = 12;
                foreach ($anios as $key => $value) {

                    for ($i=1; $i <= $m; $i++) {

                        $border = "";

                    // echo $i."<br>";
                        if ( $i == 12 ) {
                            $border = 'style="border-bottom: 3px solid #ccc;" ';
                        }

                        echo
                        '<tr '; echo $border.'>
                        <td style="text-align:left">'. $meses[$i].' '.$value .'</td>
                        <td style="text-align:center">
                            <a href="#" class="btn-sm ';
                            if ( $resultado[nominas][$j] == 1 )
                                echo 'btn-success"';
                            else
                                echo 'btn-danger"';
                            echo 'id="mostrarpdfnomina" iden="'.$i.'" fecha="'. $meses[$i].$value .'">
                            <span class="glyphicon glyphicon-save"></span>
                        </a>
                    </td>
                </tr>';

                $j++;

            }

        }


        echo '
    </tbody>
</table>
</div>';


}


function guardarUserNomina($valores, $link) {

    foreach ($valores as $clave => $valor)
        $valores[$clave] = $valor;

    $tabla = $valores['tabla'];
    unset($valores['tabla']);
    unset($valores['guardar_usuario_nomina']);
    $fields = array_keys($valores);


    if ( $valores[id] == "" ) {

        if ( $valores[dni] != "" ) {

            $q = 'SELECT dni
            FROM nominas_usuarios n
            WHERE n.dni = "'.$valores[dni].'"';

            $q = mysqli_query($link, $q) or die("error1:" .mysqli_error($link));

            if ( mysqli_num_rows($q) > 0 ) {
                echo "existe";
                return false;

            } else {

                if ( $valores[tipo] == "Personal" ) {

                    $sql = "INSERT INTO ".$tabla."
                    (`".implode('`,`', $fields)."`)
                    VALUES('".implode("','", $valores)."')";

                    enviarMailNotif($valores[nombre],$valores[dni], 'personal-creado', $link);

                } else {

                    $q2 = 'SELECT id, email, email2
                    FROM docentes d
                    WHERE d.documento = "'.$valores[dni].'"';
                    $q2 = mysqli_query($link, $q2) or die("error2:" .mysqli_error($link));

                    if ( mysqli_num_rows($q2) == 0 ) {
                        echo "not"; // no esta el docente creado
                        return false;
                    } else {

                        $row2 = mysqli_fetch_array($q2);
                        if ( $row2[email] == "" )
                            $email = $row2[email2];
                        else
                            $email = $row2[email];

                        crearUserDocente($row2[id], $link);

                        $id_user = mysqli_insert_id($link);
                        if ( $id_user != "" ) {
                            array_push($fields, 'usuario');
                            $valores[usuario] = $id_user;
                        }
                        // print_r($fields);
                        $sql = "INSERT INTO ".$tabla."
                        (`".implode('`,`', $fields)."`)
                        VALUES('".implode("','", $valores)."')";
                        // echo $sql;

                        enviarMailNotif($valores[nombre],$valores[dni], 'acceso-nominas', $link, $email);

                    }
                }

            }

        } else {

            echo "nodni";
            return false;
        }

    } else {

        $sql = 'UPDATE '.$tabla.' SET ';
        $c = count($valores);
        $coma = ", ";

        foreach ($valores as $key => $value) {
            if (++$i === $c)
                $coma = "";
            $sql .= $key .' = '.'"'.$value.'"'.$coma;
        }
        $sql .= ' WHERE id ='.$valores[id];

    }

    mysqli_query($link, $sql) or die("error3: ".mysqli_error($link));

}

function devuelveNominasMostrar($dni, $opt=NULL) {

    // echo "entraphp";
    $anio = devuelveAnio();
    $rutanominas = dirname(__DIR__).'/documentacion'.$anio.'/nominas/';

    $meses = array("",
        "Enero",
        "Febrero",
        "Marzo",
        "Abril",
        "Mayo",
        "Junio",
        "Julio",
        "Agosto",
        "Septiembre",
        "Octubre",
        "Noviembre",
        "Diciembre" );

    $resultados = array();


    $i = 1;
    $j = 1;
    $m = 12;

    $anio1 = 2015;
    $anioActual = $anio;

    // if ( $anio1 != $anioActual ) {
    $anios = range($anioActual, $anio1);
    // }

    foreach ($anios as $key => $value) {

        for ($i=1; $i <= $m; $i++) {

            $rutanominas = dirname(__DIR__).'/documentacion'.$value.'/nominas/';

            if ( file_exists($rutanominas.$dni.'-'.$meses[$i].$value.'.pdf') )
                $resultados[nominas][$j] = 1;
            else
                $resultados[nominas][$j] = 0;

            $j++;

        }

    }

    // print_r($resultados);

    if ( $opt == 1 )
        return $resultados;
    else
        echo json_encode($resultados);


}


function leerCredito($cif, $link) {

    $baseurl = $_SERVER['DOCUMENT_ROOT'].'/app';
    include_once ($baseurl.'/plugins/pdfparser/vendor/autoload.php');
    // include_once ($baseurl.'/functions/funciones.php');

    $gestion = devuelveAnio();
    $rutaempresa = dirname(__DIR__).'/pdf_tripartita'.$gestion.'/empresa/';

    $message = '';
    $texts   = array();
    $lines = array();
    $cadena = '';
    $texto = '';

    try {
        $content = '';

        $content = file_get_contents($rutaempresa.'/'.$cif.'-informe.pdf');

        if ($content) {
            $parser = new \Smalot\PdfParser\Parser();
            $pdf    = $parser->parseContent($content);
            $pages  = $pdf->getPages();

            foreach ($pages as $page) {
                $texts[] = $page->getText();
                    // print_r($texts);
            }
        } else {
            throw new Exception('Unable to retrieve content. Check if it is really a pdf file.');
        }
    } catch(Exception $e) {
        $message = $e->getMessage();
    }


    foreach ($texts as $key => $value) {
        $texto .= $value;
    }

        // echo "<pre>";
        // echo $texto;
        // echo "</pre>";


            // echo "<br><br>";
            // echo $textofinal;
            // $texts[0] = "hola Participantes";
            // echo $t;
    $posini = 0;
    $posini = strpos($texto, "Asignado");
            // if ( $posini !== FALSE ) echo "<br>".$posini.' siii'; else echo "<br>no";

    $pos = 0;
    $posfin = strrpos($texto, "Período para Disponer");
            // if ( $posfin !== FALSE ) echo "<br>".$posfin.' siii'; else echo "<br>no";

    $credito = strtolower( substr($texto, ($posini), ( ($posfin)-($posini)) ) );
            // echo "<BR>".$credito;

            // $asignado = substr($credito, (strpos($credito, "Asignado:")+9), ((strpos($credito, "€") )));
    $asignado = substr($credito, (strpos($credito, "asignado:")+9), ((strpos($credito, "dispuesto acciones")-7)-(strpos($credito, "asignado:")+9)) );
            // echo "<br>".$asignado;

    $dispuesto_acciones = substr($credito, (strpos($credito, "formativas:")+11), ((strpos($credito, "dispuesto pif")-7)-(strpos($credito, "formativas:")+11)) );
            // echo "<br>".$dispuesto_acciones;

    $dispuesto_pif = substr($credito, (strpos($credito, "pif:")+4), ((strpos($credito, "disponible")-7)-(strpos($credito, "pif:")+4)) );
            // echo "<br>".$dispuesto_pif;

    $disponible = substr($credito, (strpos($credito, "disponible:")+11), ((strrpos($credito, "€")-1)-(strpos($credito, "disponible:")+11)) );
            // echo "<br>".$disponible;


    $posini = strpos($texto, "Emitido el");
            // if ( $posini !== FALSE ) echo "<br>".$posini.' siii'; else echo "<br>no";

    $pos = 0;
    $posfin = strpos($texto, "Cuentas de Cotización");
            // if ( $posfin !== FALSE ) echo "<br>".$posfin.' siii'; else echo "<br>no";

    $fecha = substr($texto, ($posini)+11, ( ($posfin-11)-($posini)) );
            // echo "<BR>".$fecha;

    $busca = array('.', ',','\n');
    $reemplaza = array('', '.','');

    $q = 'UPDATE empresas SET asignado = "'.str_replace($busca, $reemplaza, $asignado).'", dispuesto_acciones = "'.str_replace($busca, $reemplaza, $dispuesto_acciones).'", dispuesto_pif = "'.str_replace($busca, $reemplaza, $dispuesto_pif).'", disponible = "'.str_replace($busca, $reemplaza, $disponible).'", actualizado_a = "' . $fecha . '" WHERE cif = "'.$cif.'"';
            // echo "<br>".$q;
    $q = mysqli_query($link, $q) or die("error:" .mysqli_error($link));

    $devuelve = array();
    $devuelve['asignado'] = floatval(str_replace($busca, $reemplaza, $asignado));
    $devuelve['dispuesto_acciones'] = floatval(str_replace($busca, $reemplaza, $dispuesto_acciones));
    $devuelve['dispuesto_pif'] = floatval(str_replace($busca, $reemplaza, $dispuesto_pif));
    $devuelve['disponible'] = floatval(str_replace($busca, $reemplaza, $disponible));
    $devuelve['actualizado_a'] = (string)$fecha;

    echo json_encode($devuelve);


}

function guardaMiReporte($values, $link) {


    foreach ($values as $clave => $valor)
        $valores[$clave] = $valor;


    $tabla = $valores['tabla'];
    $id = $valores['id'];
    // echo $id;

    unset($valores['id']);
    unset($valores['tabla']);
    unset($valores['guardar_mireporte']);

    $fields = array_keys($valores);

    if ( $id == "" ) {

        $sql = "INSERT IGNORE INTO ".$tabla."
        (`".implode('`,`', $fields)."`)
        VALUES('".implode("','", $valores)."')";


    } else {

        $sql = 'UPDATE '.$tabla.' SET ';
        $c = count($valores);
        $coma = ", ";

        foreach ($valores as $key => $value) {
            if (++$i === $c)
                $coma = "";
            $sql .= $key .' = '.'"'.$value.'"'.$coma;
        }
        $sql .= ' WHERE id ='.$id;
    }

    // echo $sql;
    mysqli_query($link, $sql) or die("error: ".mysqli_error($link));



}

function devuelveCuestionarioIKEA($id_mat, $link) {

    $q = 'SELECT * FROM cuestionario_ikea c
    WHERE c.id_matricula = '.$id_mat;
    // echo $q;
    $q = mysqli_query($link, $q) or die('error:' . mysqli_error($link) );

    ?>

    <table style="margin-top: 15px;" class="table">
        <thead>

            <tr style="font-size:11px">
                <th style="text-align:center;border-bottom:0px"></th>
                <th colspan="2" style="border-bottom:0px;border-top:0px;border-right: 2px solid #ccc;text-align:center;"></th>
                <th colspan="4" style="border-left: 2px solid #ccc;border-right: 2px solid #ccc;text-align:center;">Sobre el formador</th>
                <th colspan="8" style="border-left: 2px solid #ccc;border-right: 2px solid #ccc;text-align:center;">Sobre detalles que afectan al curso </th>
                <th colspan="2" style="border-bottom:0px;border-left: 2px solid #ccc;border-right: 2px solid #ccc;text-align:center;">&nbsp;</th>
            </tr>

            <tr style="font-size:11px">
                <th style="text-align:center;border-top:0px;"></th>
                <th colspan="2" style="border-top:0px;border-left: 2px solid #ccc;border-right: 2px solid #ccc;text-align:center;">Opinión general</th>
                <th colspan="4" style="border-left: 2px solid #ccc;border-right: 2px solid #ccc;text-align:center;">¿Cuál es tu opinión sobre su...?</th>
                <th colspan="4" style="border-left: 2px solid #ccc;border-right: 2px solid #ccc;text-align:center;">4. ¿Podrías valorar la comunicación realizada antes del encuentro respecto a...?</th>
                <th colspan="2" style="border-left: 2px solid #ccc;border-right: 2px solid #ccc;text-align:center;">5. Opinión sobre los recursos de la formación</th>
                <th colspan="2" style="border-left: 2px solid #ccc;border-right: 2px solid #ccc;text-align:center;">&nbsp;</th>
                <th colspan="2" style="border-top:0px;border-left: 2px solid #ccc;border-right: 2px solid #ccc;text-align:center;">Posibles mejoras</th>
            </tr>

            <tr style="font-size:11px">
                <th style="text-align:center;">Nº</th>
                <th style="text-align:center;">1.Cumplimiento expectativas formación</th>
                <th style="width:10%">2.Aplicación a tu trabajo diario</th>
                <th style="text-align:center;">3.1.Conocimiento de la materia tratada</th>
                <th style="text-align:center;">3.2.Claridad en sus explicaciones</th>
                <th style="text-align:center;">3.3.Aplicación del contenido a la tienda</th>
                <th style="text-align:center;">3.4.Conocimiento asistentes y necesidades</th>
                <th style="text-align:center;">4.1.La fecha de realización del curso</th>
                <th style="text-align:center;">4.2.Objetivos y contenidos del curso</th>
                <th style="text-align:center;">4.3.Horarios y duración acción</th>
                <th style="text-align:center;">4.4.Lugar de celebración</th>
                <th style="text-align:center;">5.1.Sala</th>
                <th style="text-align:center;">5.2.Material</th>
                <th style="text-align:center;">6.Tiempo previsto realización </th>
                <th style="text-align:center;">7.Opinión sobre asistentes</th>
                <th style="text-align:center;">8.¿Qué mejorar?</th>
                <th style="text-align:center;">9.¿Otras formaciones a desarollar?</th>
            </tr>
        </thead>
        <tbody> <?

            $nrows = mysqli_num_rows($q);
        // echo $nrows;

            while ($row = mysqli_fetch_array($q)) {
           // print_r($row);
           // echo $ruta;
             $mejora1 = '...<br><a id="obscuest" href="#" obs="'.$row[mejora1].'">Leer más</a>';
             $mejora2 = '...<br><a id="obscuest" href="#" obs="'.$row[mejora2].'">Leer más</a>';
             echo '<tr style="font-size:11px" class="'.$color.'">';
             echo '<td style="text-align:center;">'. ++$i .'</td>';

             for ($k=1; $k <= 7; $k++) {

                if ( $k == 3 ) {
                    for ($z=1; $z <= 4; $z++) {
                        echo '<td style="text-align:center;">'.$row['pregunta'.$k.$z].'</td>';
                        $resp_total[$k.$z] += $row['pregunta'.$k.$z];

                        if ( $nrows == $i )
                            $resp_total[$k.$z] = $resp_total[$k.$z]/$nrows;
                    }
                } else if ( $k == 4 ) {
                    for ($x=1; $x <= 4; $x++) {
                        echo '<td style="text-align:center;">'.$row['pregunta'.$k.$x].'</td>';
                        $resp_total[$k.$x] += $row['pregunta'.$k.$x];

                        if ( $nrows == $i )
                            $resp_total[$k.$x] = $resp_total[$k.$x]/$nrows;
                    }
                } else if ( $k == 5 ) {
                    for ($y=1; $y <= 2; $y++) {
                        echo '<td style="text-align:center;">'.$row['pregunta'.$k.$y].'</td>';
                        $resp_total[$k.$y] += $row['pregunta'.$k.$y];

                        if ( $nrows == $i )
                            $resp_total[$k.$y] = $resp_total[$k.$y]/$nrows;
                    }
                } else {
                    echo '<td style="text-align:center;">'.$row['pregunta'.$k].'</td>';
                    $resp_total[$k] += $row['pregunta'.$k];

                    if ( $nrows == $i )
                        $resp_total[$k] = $resp_total[$k]/$nrows;
                }


            }

            echo '<td style=";word-wrap: break-word">'.substr($row[mejora1],0, 10);
            if ( $row[mejora1] != "" ) echo $mejora1;
            echo '<td style=";word-wrap: break-word">'.substr($row[mejora2],0, 10);
            if ( $row[mejora2] != "" ) echo $mejora2;

            echo '</tr>';


        }
        echo '<tr style="font-size:11px;">';
        echo '<td><strong>MEDIAS:</strong> </td>';

        for ($k=1; $k <= 7; $k++) {

           if ( $k == 3 ) {
               for ($z=1; $z <= 4; $z++) {
                   $colorI = colorCuestionarioI($resp_total[$k.$z]);
                   echo '<td class="'.$colorI.'" style="text-align:center;">'.$resp_total[$k.$z].'</td>';
               }
           } else if ( $k == 4 ) {
               for ($x=1; $x <= 4; $x++) {
                   $colorI = colorCuestionarioI($resp_total[$k.$x]);
                   echo '<td class="'.$colorI.'" style="text-align:center;">'.$resp_total[$k.$x].'</td>';
               }
           } else if ( $k == 5 ) {
               for ($y=1; $y <= 2; $y++) {
                   $colorI = colorCuestionarioI($resp_total[$k.$y]);
                   echo '<td class="'.$colorI.'" style="text-align:center;">'.$resp_total[$k.$y].'</td>';
               }
           } else {
               $colorI = colorCuestionarioI($resp_total[$k]);
               echo '<td class="'.$colorI.'" style="text-align:center;">'.$resp_total[$k].'</td>';
           }

       }

       echo '<td></td><td></td></tbody>
   </table>';


}


function esIKEA($solicitud) {

    if ( strpos($solicitud, 'IK') !== FALSE && $solicitud != 0 && $solicitud != NULL )
        return true;
    else
        return false;

}

function guardarPeticionPropuesta($values, $link) {

    print_r($values);
    foreach ($values as $clave => $valor)
        $valores[$clave] = $valor;

    $valores[observaciones] = addslashes($valores[observaciones]);
    // $valores[textobonificable] = addslashes($valores[textobonificable]);


    $tabla = $valores['tabla'];
    unset($valores['tabla']);
    unset($valores['guardar_peticion']);
    unset($valores['observgestor']);
    $fields = array_keys($valores);
     print_r($valores);

    if ( $valores['id_comercial'] != "" ) {
        $qc = 'SELECT nombre, apellido
        FROM comerciales
        WHERE id = '.$valores[id_comercial];
        echo $qc;
        $qc = mysqli_query($link, $qc) or die("error busqueda comercial:" .mysqli_error($link));

        $rowc = mysqli_fetch_array($qc);
        $comercial = $rowc[nombre].' '.$rowc[apellido];
    } else {
        unset($valores['comercial']);
    }



    $t2 = 'Nuevo Curso en Abierto:<br><br>
    Curso: '.$valores[formacion].'<br>
    Modalidad: '.$valores[modalidad].'<br>
    Comercial: '.$comercial.'<br>
    Tipo: '.$valores[tipoformacionpropuesta].'<br>
    Horas: '.$valores[horastotales].'<br>
    Fechas: '.$valores[fechaini].' - '.$valores[fechafin].'<br>
    Centro: '.$valores[nombrecentro].'<br>';


    if ( $valores[id] == "" ) {

        $qn = 'SELECT max(numero) as maximo
        FROM peticiones_formativas';
        $qn = mysqli_query($link, $qn);

        $row = mysqli_fetch_array($qn);
        $max = $row[maximo]+1;

        $max = str_pad($max, 4, '0', STR_PAD_LEFT);
        $valores[numero] = $max;

        if ( $valores[tiposol] == 'SC' ) $valores[cif] = mb_strtoupper($valores[cif]);


        $sql = "INSERT INTO ".$tabla."
        (`".implode('`,`', $fields)."`)
        VALUES('".implode("','", $valores)."')";
        echo $sql;
        $sql = mysqli_query($link, $sql) or die("error insert " . mysqli_error($link));
        $t = "<pre>".print_r($valores, true)."</pre>";


        $t = str_replace('Array', '', $t);
        // echo $valores[tiposol];

        if ( isset($valores[cif]) ) {

            $agente = '';
            $agentefield = '';
            $agenteinsert = '';

            if ( $valores[id_comercial] == '12' ) {
                $agenteupdate = ', agente = "Amparo"';
                $agentefield = ',agente';
                $agenteinsert = 'Amparo';
                $valores[id_comercial] = '3';
            }

            if ( $valores[id_comercial] == '7' ) {
                $agenteupdate = ', agente = "Isabel"';
                $agentefield = ',agente';
                $agenteinsert = 'Isabel';
                $valores[id_comercial] = '3';
            }

            if ( $valores[id_comercial] == '48' ) {
                $agenteupdate = ', agente = "Yanira"';
                $agentefield = ',agente';
                $agenteinsert = 'Yanira';
                $valores[id_comercial] = '3';
            }

            $q = 'SELECT id
            FROM empresas
            WHERE cif = "'.$valores[cif].'"';
            // echo $q;
            $q = mysqli_query($link, $q) or die("error select cif:" .mysqli_error($link));

            if ( mysqli_num_rows($q) > 0 ) {

                $row = mysqli_fetch_assoc($q);

                $qx = 'UPDATE empresas SET comercial = "'.$valores[id_comercial].'", comisionista = "'.$valores[comisionista].'" '.$agenteupdate.'
                WHERE cif = "'.$valores[cif].'"';
                echo $qx;
                $qx = mysqli_query($link, $qx) or die("error update:" .mysqli_error($link));

            } else {

                $qx = 'INSERT INTO empresas (cif,comercial,comisionista,agente,representacionlegal,sede) VALUES ("'.$valores[cif].'","'.$valores[id_comercial].'","'.$valores[comisionista].'","'.$agenteinsert.'","2","")';
                $qx = mysqli_query($link, $qx) or die("error insert:" .mysqli_error($link));
            }

        }

        enviarMailNotif($valores[numero], $valores[modalidad], "solicitud-".$valores[tiposol], $link, $t, $_SESSION[user]);

        if ( $valores[abierto] == "Si" ) {
            enviarMailNotif($valores[numero], $valores[modalidad], "solicitud-abierto", $link, $t2, $_SESSION[user]);
        }


    } else {

        $q = 'SELECT *
        FROM peticiones_formativas
        WHERE id = '.$valores[id];

        $q = mysqli_query($link, $q) or die("error select pet update" . mysqli_error($link));

        $row = mysqli_fetch_array($q);
        $estado_peticion = $row[estado_peticion];

        if ( $row[fechaini] == "0000-00-00" ) $row[fechaini] = "";
        if ( $row[fechafin] == "0000-00-00" ) $row[fechafin] = "";

        if ( $valores[objetivos] != "" )
            $valores[objetivos] = addslashes($valores[objetivos]);

        if ( $valores[contenidos] != "" )
            $valores[contenidos] = addslashes($valores[contenidos]);

        $dif = array_diff_assoc($valores, $row);

        // echo "diferencias: ".print_r($dif);
        $t = "<pre>".print_r($dif, true)."</pre>";
        $t = str_replace('Array', '', $t);


        if ( count($dif) > 0 )  {
            enviarMailNotif($valores[numero], $valores[id_comercial], 'cambios-sol', $link, $t, $_SESSION[user]);
        }


        // si se cambian las fechas, se pone la solicitud a pendiente
        if ( $valores[tiposol] == 'SM'
            && ($row['fechaini'] != $valores['fechaini'] || $row['fechafin'] != $valores['fechafin'])
           )
        {
            echo "<br>fechainiant ".$row[fechaini];
            echo "<br>fechainipost ".$valores[fechaini];
            echo "<br>fechafinant ".$row[fechafin];
            echo "<br>fechafinpost ".$valores[fechafin];
            $valores[estado_peticion] = 'Pendiente';
        }

        $sql = 'UPDATE '.$tabla.' SET ';
        $c = count($valores);
        $coma = ", ";

        foreach ($valores as $key => $value) {
            if (++$i === $c)
                $coma = "";
            $sql .= $key .' = '.'"'.$value.'"'.$coma;
        }
        $sql .= ' WHERE id ='.$valores[id];
        mysqli_query($link, $sql) or die("error insert final update".mysqli_error($link));
        // echo $sql;

    }




    if ( $valores[tiposol] == "SP" && $estado_peticion != "Aceptada" && $valores[estado_peticion] == "Aceptada" ) {
        // echo "entra";
        enviarMailNotif($valores[id], $valores[numero].' - '.$valores[empresareal], 'propuesta-aceptada', $link, $valores[modalidad], $_SESSION[user]);
    }

    if ( $valores[tiposol] == "SP" && $valores[estado_peticion] == "Pendiente" && $valores[observpropuesta] == 1 ) {
        enviarMailNotif($valores[id_comercial], $valores[numero], 'cambios-observgestor', $link, $valores[observaciones], $_SESSION[user]);
    }

    if ( $valores[tiposol] == "SP" && $valores[estado_peticion] == "Pendiente" && $valores[observgestor] == 1 ) {
        enviarMailNotif($valores[id_comercial], $valores[numero], 'cambios-observgestor', $link, $valores[observacionesgestor], $_SESSION[user]);
    }

    // $q = 'SELECT  email
    // FROM comerciales
    // WHERE id = "'.$valores[id_comercial].'"';
    // $q = mysqli_query($link, $q) or die("error:" .mysqli_error($link));

    // $row = mysqli_fetch_row($q);
    // $email = $row[email];


    // if ( $valores[tiposol] == "SM" && $estado_peticion != "Aceptada" && $valores[estado_peticion] == "Aceptada" ) {
    //     // echo "entra";
    //     enviarMailNotif($valores[id], $valores[numero], 'matricula-aceptada', $link, $email, $_SESSION[user]);
    // }

    // $id = mysqli_insert_id($link);
    // echo $id;

}

function guardarEmpresaReporte($values, $link) {

    foreach ($values as $clave => $valor)
        $valores[$clave] = $valor;

    // $tabla = $valores['tabla'];
    // unset($valores['tabla']);
    unset($valores['guardarempresareporte']);

    $fields = array_keys($valores);
    $sql = "INSERT INTO empresas_reportes
    (`".implode('`,`', $fields)."`)
    VALUES('".implode("','", $valores)."')";
    // echo $sql;
    mysqli_query($link, $sql) or die("error: ".mysqli_error($link));
    $id = mysqli_insert_id($link);
    echo $id;

}


function listarMiReporte($link) {

    $q = 'SELECT r.*
    FROM mireporte r
    ORDER BY fecha DESC';
    $q = mysqli_query($link, $q) or die("error:" . mysqli_error($link) );


    echo '<table style="margin-top: 15px;" class="table">
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Fecha Inicio</th>
            <th>Fecha Fin</th>
            <th>Tipo Tarea</th>
            <th>Persona</th>
            <th>Tarea</th>
            <th>%</th>
            <th>Editar</th>
        </tr>
    </thead>
    <tbody>';

        $i=0;
        while ( $row = mysqli_fetch_assoc($q) ) {

            $readmore = '... <a style="font-size: 11px;" href="#" id="seleccionarmireporte" style="cursor:pointer" >Ver descripción</a>';
        // $datosempresa = '<a id="datosempresarepor" style="cursor:pointer" empresa="'.$row[empresa].'" contacto="'.$row[contactor].'" email="'.$row[emailr].'" tlf="'.$row[tlfr].'">'.$row[empresa].'</a>';
        // if (strpos($row[respuesta], 'err') !== false) $color = 'danger'; else $color = 'success';
            $fecha = $row[fecha];

            if ( $fecha != $fechant ) $style = 'style="border-top:3px solid #ccc"'; else $style = "";
            echo '<tr '.$style.' class="'.$color.'">';
            echo '<td style="display:none" id="id">'.$row[id].'</td>';
            echo '<td style="display:none" id="fechax">'.$row[fecha].'</td>';
            echo '<td style="display:none" id="fechainix">'.$row[fechaini].'</td>';
            echo '<td style="display:none" id="fechafinx">'.$row[fechafin].'</td>';
            echo '<td style="" id="fecha">'.formateaFecha($row[fecha]).'</td>';
            echo '<td style="" id="fechaini">'.formateaFecha($row[fechaini]).'</td>';
            echo '<td style="" id="fechafin">'.formateaFecha($row[fechafin]).'</td>';
            echo '<td id="tipotarea">'.$row[tipotarea].'</td>';
            echo '<td id="persona">'.$row[persona].'</td>';
            echo '<td id="descripcion">'.substr( $row[descripcion], 0,40 ).$readmore.'</td>';
            echo '<td id="progreso">'.$row[progreso].'</td>';
            echo '<td style="display:none" id="descripcionlarga">'.$row[descripcion].'</td>';
            echo '<td><a id="seleccionarmireporte" name="contactos" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span> </a></td>';
            echo '</tr>';
        // echo $row[observaciones];
            $fechant = $row[fecha];
        }
        echo '</tbody>
    </table>';


}



function listarReporte($user, $link) {

    $q = 'SELECT e.*, r.*, r.id as idrepor, e.contacto as contactor, e.email as emailr, e.telefono as tlfr, e.empresa as empresa, c.nombre as comercial
    FROM reportescomerciales r, empresas_reportes e, comerciales c, usuarios u
    WHERE r.id_comercial = c.id
    AND r.id_comercial = u.id_comercial
    AND u.user = "'.$user.'"
    AND e.id = r.id_empresa
    ORDER BY r.fecha DESC';
    $q = mysqli_query($link, $q);


    echo '<table style="margin-top: 15px;" class="table">
    <thead>
        <tr>
            <th>Tipo Contacto</th>
            <th>Fecha Inserción</th>
            <th>Fecha Contacto</th>
            <th>Prox. Contacto</th>
            <th>Comercial</th>
            <th>Empresa</th>
            <th>Proyecto/Formación</th>
            <th>Prioridad</th>
            <th>Observaciones</th>
            <th>Editar</th>
        </tr>
    </thead>
    <tbody>';

        $i=0;
        while ( $row = mysqli_fetch_assoc($q) ) {

            $readmore = '... <a style="font-size: 11px;" id="obscuest" style="cursor:pointer" obs="'.$row[observaciones].'">Leer más</a>';
            $datosempresa = '<a id="datosempresarepor" style="cursor:pointer" empresa="'.$row[empresa].'" contacto="'.$row[contactor].'" email="'.$row[emailr].'" tlf="'.$row[tlfr].'">'.$row[empresa].'</a>';
        // if (strpos($row[respuesta], 'err') !== false) $color = 'danger'; else $color = 'success';
            echo '<tr class="'.$color.'">';
            echo '<td style="display:none" id="idrepor">'.$row[idrepor].'</td>';
            echo '<td style="display:none" id="fechacontacto">'.$row[fecha].'</td>';
            echo '<td style="display:none" id="procontacto">'.$row[procontacto].'</td>';
            echo '<td id="tipocontacto">'.$row[tipocontacto].'</td>';
            echo '<td id="fechainsercion">'.date("d/m/Y H:i:s", strtotime($row['fechainsercion'])-3600).'</td>';
            echo '<td id="">'.formateaFecha($row[fecha]).'</td>';
            echo '<td id="">'.formateaFecha($row[procontacto]).'</td>';
            echo '<td id="comercial">'.$row[comercial].'</td>';
            echo '<td id="razonsocial">'.$datosempresa.'</td>';
            echo '<td id="id_empresa" style="display:none">'.$row[id_empresa].'</td>';
            echo '<td id="formacion">'.$row[formacion].'</td>';
            echo '<td id="id_accion" style="display:none">'.$row[id_accion].'</td>';
            echo '<td id="prioridad">'.$row[prioridad].'</td>';
            echo '<td style="display:none" id="observacioneslarga">'.$row[observaciones].'</td>';
            echo '<td id="observaciones" style=";word-wrap: break-word">'.substr($row[observaciones],0, 10);
            if ( $row[observaciones] != "" ) echo $readmore;
            echo '</td>';
            echo '<td><a id="seleccionarreporte" name="contactos" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span> </a></td>';
            echo '</tr>';
        // echo $row[observaciones];
        }
        echo '</tbody>
    </table>';


}

function listarReporteProx($user, $link) {

    $q = 'SELECT *, r.*, r.id as idrepor,e.contacto as contactor, e.email as emailr, e.telefono as tlfr, e.empresa as empresa
    FROM reportescomerciales r, empresas_reportes e
    WHERE r.comercial = "'.$user.'"
    AND e.id = r.id_empresa
    ORDER BY r.procontacto ASC';
    // echo $q;
    $q = mysqli_query($link, $q);


    echo '<table style="margin-top: 15px;" class="table">
    <thead>
        <tr>
            <th>Tipo Contacto</th>
            <th>Fecha Inserción</th>
            <th>Fecha Contacto</th>
            <th>Prox. Contacto</th>
            <th>Comercial</th>
            <th>Empresa</th>
            <th>Proyecto/Formación</th>
            <th>Prioridad</th>
            <th>Observaciones</th>
            <th>Editar</th>
        </tr>
    </thead>
    <tbody>';

        $i=0;
        while ( $row = mysqli_fetch_assoc($q) ) {
            $i++;
            $readmore = '... <a style="font-size: 11px;cursor:pointer" id="obscuest"  obs="'.$row[observaciones].'">Leer más</a>';
            $datosempresa = '<a id="datosempresarepor" style="cursor:pointer" empresa="'.$row[empresa].'" contacto="'.$row[contactor].'" email="'.$row[emailr].'" tlf="'.$row[tlfr].'">'.$row[empresa].'</a>';
        // if (strpos($row[respuesta], 'err') !== false) $color = 'danger'; else $color = 'success';
            if ( $i == 1 )
                echo '<tr class="danger">';
            else if ( $i == 2 )
                echo '<tr class="warning">';
            else
                echo '<tr class="">';
            echo '<td style="display:none" id="idrepor">'.$row[idrepor].'</td>';
            echo '<td style="display:none" id="fechacontacto">'.$row[fecha].'</td>';
            echo '<td style="display:none" id="procontacto">'.$row[procontacto].'</td>';
            echo '<td id="tipocontacto">'.$row[tipocontacto].'</td>';
            echo '<td id="fechainsercion">'.date("d/m/Y H:i:s", strtotime($row['fechainsercion'])-3600).'</td>';
            echo '<td id="">'.formateaFecha($row[fecha]).'</td>';
            echo '<td id="">'.formateaFecha($row[procontacto]).'</td>';
            echo '<td id="comercial">'.$row[comercial].'</td>';
            echo '<td id="razonsocial">'.$datosempresa.'</td>';
            echo '<td id="id_empresa" style="display:none">'.$row[id_empresa].'</td>';
            echo '<td id="formacion">'.$row[formacion].'</td>';
            echo '<td id="id_accion" style="display:none">'.$row[id_accion].'</td>';
            echo '<td id="prioridad">'.$row[prioridad].'</td>';
            echo '<td style="display:none" id="observacioneslarga">'.$row[observaciones].'</td>';
            echo '<td id="observaciones" style=";word-wrap: break-word">'.substr($row[observaciones],0, 10);
            if ( $row[observaciones] != "" ) echo $readmore;
            echo '</td>';
            echo '<td><a id="seleccionarreporte" name="contactos" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span> </a></td>';

            echo '</tr>';

        }
        echo '</tbody>
    </table>';


}


function guardaReporte ($form_data, $link) {

    foreach ($form_data as $clave => $valor)
        $valores[$clave] = $valor;


    $tabla = $valores['tabla'];
    $id = $valores['id'];
    // echo $id;

    unset($valores['id']);
    unset($valores['tabla']);
    unset($valores['guardar_reporte']);
    unset($valores['acceso']);

    $fields = array_keys($valores);

    if ( $id == "" ) {

        $sql = "INSERT IGNORE INTO ".$tabla."
        (`".implode('`,`', $fields)."`)
        VALUES('".implode("','", $valores)."')";


    } else {

        $sql = 'UPDATE '.$tabla.' SET ';
        $c = count($valores);
        $coma = ", ";

        foreach ($valores as $key => $value) {
            if (++$i === $c)
                $coma = "";
            $sql .= $key .' = '.'"'.$value.'"'.$coma;
        }
        $sql .= ' WHERE id ='.$id;
    }

    echo $sql;
    mysqli_query($link, $sql) or die("error: ".mysqli_error($link));

    $q = 'UPDATE usuarios SET acceso = 1 WHERE user = "'.$valores['comercial'].'"';
    mysqli_query($link, $q) or die("error: ".mysqli_error($link));



}


function guardaCuestionarioIKEA ($form_data, $link) {


    // $link = connect2014();
    foreach ($form_data as $clave => $valor)
        $valores[$clave] = $valor;

    $tabla = $valores['tabla'];
    unset($valores['tabla']);
    unset($valores['guardacuestionarioikea']);

    $fields = array_keys($valores);
    $sql = "INSERT INTO ".$tabla."
    (`".implode('`,`', $fields)."`)
    VALUES('".implode("','", $valores)."')";
    echo $sql;
    mysqli_query($link, $sql) or die("error: ".mysqli_error($link));


}

function guardaCuestionarioICongreso ($form_data, $link) {


    // $link = connect2014();
    foreach ($form_data as $clave => $valor)
        $valores[$clave] = $valor;

    $tabla = $valores['tabla'];
    unset($valores['tabla']);
    unset($valores['guardacuestionario']);

    $fields = array_keys($valores);
    $sql = "INSERT INTO ".$tabla."
    (`".implode('`,`', $fields)."`)
    VALUES('".implode("','", $valores)."')";
    // echo $sql;
    mysqli_query($link, $sql) or die("error: ".mysqli_error($link));


}

function guardaCuestionario ($form_data, $link) {


    $link = connect2014();
    foreach ($form_data as $clave => $valor)
        $valores[$clave] = $valor;

    $tabla = $valores['tabla'];
    unset($valores['tabla']);
    unset($valores['guardacuestionario']);

    $fields = array_keys($valores);
    $sql = "INSERT INTO ".$tabla."
    (`".implode('`,`', $fields)."`)
    VALUES('".implode("','", $valores)."')";
    // echo $sql;
    mysqli_query($link, $sql) or die("error: ".mysqli_error($link));


}

function compruebaVIN($id_matricula, $link) {

    $q = 'SELECT a.diploma
    FROM acciones a, matriculas m
    WHERE m.id_accion = a.id
    AND m.id = '.$id_matricula;
    // echo $q;
    $q = mysqli_query($link, $q);

    $row = mysqli_fetch_array($q);

    if ($row[diploma] != "VIN") echo 0;
    else echo 1;

}


function formateaFecha($fecha) {
    return date("d/m/Y", strtotime($fecha));
}

function formateaFechaHora($fecha) {
    return date("d/m/Y H:i:s", strtotime($fecha));
}

/*Formatea la fecha para ponerla en el nombre de los archivos*/
function formateaFechaDirectorio($fecha) {
    return date("Ymd", strtotime($fecha));
}

function guardaEstipulaciones($id_comisionista, $estipulaciones, $link) {

    $q = 'UPDATE comisionistas SET estipulaciones = "'.addslashes($estipulaciones).'" WHERE id = '.$id_comisionista;
    // echo $q;
    $q = mysqli_query($link, $q);
}

function preComisionistaContinua($id_comisionista, $link) {

    $q = 'SELECT formapagoformacion, vencimientoformacion
    FROM comisionistas
    WHERE id = '.$id_comisionista;
    // echo $q;
    $q = mysqli_query($link, $q);

    while ( $row = mysqli_fetch_array($q) ) {

        echo '<div style="margin-top:15px; overflow: auto;" class="col-md-12">
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label" for="formapago">Forma de Pago:</label>
                <select id="formapago" name="formapago" class="form-control">
                    <option '; if ($row[formapagoformacion] == "Transferencia") echo ' selected '; echo 'value="Transferencia">Transferencia</option>
                    <option '; if ($row[formapagoformacion] == "Cheque") echo ' selected '; echo ' value="Cheque">Cheque</option>
                    <option '; if ($row[formapagoformacion] == "Remesa") echo ' selected '; echo ' value="Remesa">Remesa</option>
                    <option '; if ($row[formapagoformacion] == "Efectivo") echo ' selected '; echo ' value="Efectivo">Efectivo</option>
                    <option '; if ($row[formapagoformacion] == "Domiciliación") echo ' selected '; echo ' value="Domiciliación">Domiciliación</option>
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label" for="vencimiento">Vencimiento:</label>
                <input value="'.$row[vencimientoformacion].'"type="text" id="vencimiento" name="vencimiento" class="form-control" />
            </div>
        </div>
        <div style="margin-top:25px" class="col-md-3">
            <a id="generarcomisionistacontinua" data-toggle=modal class="btn btn-warning"><span class="glyphicon glyphicon-list-alt"></span> Generar Acuerdo</a>
        </div>

    </div>';

}

}


function preComisionistaContrato($id_comisionista, $link) {

    $q = 'SELECT formapagocontrato, vencimientocontrato
    FROM comisionistas
    WHERE id = '.$id_comisionista;
    // echo $q;
    $q = mysqli_query($link, $q);

    while ( $row = mysqli_fetch_array($q) ) {

        echo '<div style="margin-top:15px; overflow: auto;" class="col-md-12">
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label" for="formapago">Forma de Pago:</label>
                <select id="formapago" name="formapago" class="form-control">
                    <option '; if ($row[formapagocontrato] == "Transferencia") echo ' selected '; echo 'value="Transferencia">Transferencia</option>
                    <option '; if ($row[formapagocontrato] == "Cheque") echo ' selected '; echo ' value="Cheque">Cheque</option>
                    <option '; if ($row[formapagocontrato] == "Remesa") echo ' selected '; echo ' value="Remesa">Remesa</option>
                    <option '; if ($row[formapagocontrato] == "Efectivo") echo ' selected '; echo ' value="Efectivo">Efectivo</option>
                    <option '; if ($row[formapagoformacion] == "Domiciliación") echo ' selected '; echo ' value="Domiciliación">Domiciliación</option>
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label" for="vencimiento">Vencimiento:</label>
                <input value="'.$row[vencimientocontrato].'"type="text" id="vencimiento" name="vencimiento" class="form-control" />
            </div>
        </div>
        <div style="margin-top:25px" class="col-md-3">
            <a id="generarcomisionistacontrato" data-toggle=modal class="btn btn-warning"><span class="glyphicon glyphicon-list-alt"></span> Generar Acuerdo</a>
        </div>
    </div>';

}

}


function preComisionistaOtro($id_comisionista, $link) {

    $q = 'SELECT formapagootro, vencimientootro, estipulaciones
    FROM comisionistas
    WHERE id = '.$id_comisionista;
    // echo $q;
    $q = mysqli_query($link, $q);

    while ( $row = mysqli_fetch_array($q) ) {

        echo '<div style="margin-top:15px; overflow: auto;" class="col-md-12">
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label" for="formapago">Forma de Pago:</label>
                <select id="formapago" name="formapago" class="form-control">
                    <option '; if ($row[formapagootro] == "Transferencia") echo ' selected '; echo 'value="Transferencia">Transferencia</option>
                    <option '; if ($row[formapagootro] == "Cheque") echo ' selected '; echo ' value="Cheque">Cheque</option>
                    <option '; if ($row[formapagootro] == "Remesa") echo ' selected '; echo ' value="Remesa">Remesa</option>
                    <option '; if ($row[formapagootro] == "Efectivo") echo ' selected '; echo ' value="Efectivo">Efectivo</option>
                    <option '; if ($row[formapagoformacion] == "Domiciliación") echo ' selected '; echo ' value="Domiciliación">Domiciliación</option>
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label" for="vencimiento">Vencimiento:</label>
                <input value="'.$row[vencimientootro].'"type="text" id="vencimiento" name="vencimiento" class="form-control" />
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-12" style="margin-top:10px;">
            <div class="form-group">
                <label class="control-label" for="estipulaciones">Estipulaciones:</label>
                <textarea name="estipulaciones" id="estipulaciones" class="form-control" rows="3">'.$row[estipulaciones].'</textarea>
            </div>
        </div>
        <div style="margin-top:25px" class="col-md-3">
            <a id="generarcomisionistaotro" data-toggle=modal class="btn btn-warning"><span class="glyphicon glyphicon-list-alt"></span> Generar Acuerdo</a>
        </div>
    </div>';

}

}

function anadirGrupoNuevo($nuevogrupo, $link) {

    $q = 'INSERT INTO grupos_empresas (grupo)
    VALUES ("'.$nuevogrupo.'")';
    // echo $q;
    $q = mysqli_query($link, $q) or die("error insertado");
    echo "Grupo insertado.";

}

// function cambiarGrupo($grupoant, $gruponuevo, $link) {

//     // $grupoant = $_POST['grupoant'];
//     $grupoant = explode("/", $_POST['grupoant']);

//     // $gruponuevo = $_POST['gruponuevo'];
//     $gruponuevo = explode("/", $_POST['gruponuevo']);

//     $q = 'SELECT ga.id
//     FROM grupos_acciones ga, acciones a
//     WHERE a.id = ga.id_accion
//     AND a.numeroaccion = '.$grupoant[0].'
//     AND ga.ngrupo = "'.$grupoant[1].'"';
//     // echo $q;
//     $q = mysqli_query($link, $q);

//     if ( mysqli_num_rows($q) > 0 ) {

//         $row = mysqli_fetch_array($q);
//         $q1 = 'UPDATE grupos_acciones SET ngrupo = "'.$gruponuevo[1].'" WHERE id = '.$row[id];
//         // echo $q1;
//         $q1 = mysqli_query($link,$q1) or die('error');
//         echo "OK!";

//     } else {
//         echo "No se encontró el grupo ".$grupoant[0].'/'.$grupoant[1];
//     }


// }

// function borrarMatriculaIndDB($id_mat, $link) {

//     $q= 'DELETE FROM grupos_acciones WHERE id IN ( SELECT id_grupo FROM matriculas WHERE id = '.$id_mat.')';
//     $q = mysqli_query($link, $q);

//     $q = 'DELETE FROM matriculas WHERE id = '.$id_mat;
//     $q = mysqli_query($link, $q);

//     $q = 'DELETE FROM mat_doc WHERE id_matricula = '.$id_mat;
//     $q = mysqli_query($link, $q);

//     $q = 'DELETE FROM mat_alu_cta_emp WHERE id_matricula = '.$id_mat;
//     $q = mysqli_query($link, $q);

//     $q = 'DELETE FROM mat_costes WHERE id_matricula = '.$id_mat;
//     $q = mysqli_query($link, $q);

//     $q = 'DELETE FROM costes_rentabilidad WHERE id_matricula = '.$id_mat;
//     $q = mysqli_query($link, $q);

//     $q = 'DELETE FROM centros WHERE id_matricula = '.$id_mat;
//     $q = mysqli_query($link, $q);

// }

function borrarGenerico($id, $tabla, $link) {

    $q = 'DELETE FROM '.$tabla.' WHERE id = '.$id;
    // echo $q;
    $q = mysqli_query($link, $q) or die ("error borrando factura acreedor");

}

function borrarAlumnoBD($id_alu, $link) {

    $q = 'DELETE FROM alumnos WHERE id = '.$id_alu;
    // echo $q;
    $q = mysqli_query($link, $q) or die ("error");

}

function borrarEmpresaBD($id_emp, $link) {

    $q = 'DELETE FROM empresas WHERE id = '.$id_emp;
    // echo $q;
    $q = mysqli_query($link, $q) or die ("error");

}



function devuelveDatosEmpresaCostesFac($id_matricula, $link) {

    $q = 'SELECT DISTINCT @id_emp:=e.id, e.razonsocial, e.cif, e.id, c.nombre, a.numeroaccion, ga.ngrupo,

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
    AND c.id = e.comercial
    AND mc.id_matricula = ma.id_matricula
    AND ma.id_matricula = '.$id_matricula.'
    AND ma.tipo = ""
    GROUP BY ma.id_empresa';
    // echo $q;
    $q = mysqli_query($link, $q);

    if ( mysqli_num_rows($q) > 0 ) {
        echo '<div class="col-md-12"><h3>Bonificado</h3></div>';

        while ( $row = mysqli_fetch_array($q) ) {

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


$q = 'SELECT DISTINCT @id_emp:=e.id, e.razonsocial, e.cif, a.numeroaccion, ga.ngrupo,
( SELECT DISTINCT TRUNCATE(mc.costes_imparticion,2) FROM mat_costes mc, mat_alu_cta_emp ma
WHERE mc.id_empresa = @id_emp
AND ma.id_empresa = @id_emp
AND ma.id_matricula = mc.id_matricula
AND ma.tipo = "Privado"
AND mc.id_matricula = '.$id_matricula.') as costes_imparticion,

(SELECT DISTINCT count(*)
FROM mat_alu_cta_emp ma, empresas e, alumnos a
WHERE e.id = ma.id_empresa
AND a.id = ma.id_alumno
AND ma.id_matricula = '.$id_matricula.'
AND ma.id_empresa = @id_emp
AND ma.tipo IN("Privado")) as nalumnos
FROM empresas e, mat_alu_cta_emp ma, mat_costes mc, acciones a, grupos_acciones ga, matriculas m
WHERE ma.id_empresa = e.id
AND m.id = ma.id_matricula
AND m.id_accion = a.id
AND m.id_grupo = ga.id
AND mc.id_matricula = ma.id_matricula
AND ma.id_matricula = '.$id_matricula.'
AND ma.tipo = "Privado"
GROUP BY ma.id_empresa';
    // echo $q;
$q = mysqli_query($link, $q);

if ( mysqli_num_rows($q) > 0 ) {
    echo '<div style="" class="col-md-12"><h3>Privado</h3></div>';

    while ( $row = mysqli_fetch_array($q) ) {

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

}


function devuelveDatosCentro($id, $link) {

    $q = 'SELECT DISTINCT c.*
    FROM centros c
    WHERE id = '.$id;
    $q = mysqli_query($link, $q);
    $r = array();

    while ($row = mysqli_fetch_assoc($q)) {
        $r[0] = $row;
    }
    echo json_encode($r);

}

function buscarCentro($centro=NULL, $link) {


    if ( $centro != NULL )
        $where = ' WHERE nombrecentro LIKE "%'.$centro.'%"';

    $q = 'SELECT c.*
    FROM centros c
    '. $where .'
    GROUP BY nombrecentro';
    // echo $q;
    $q = mysqli_query($link, $q);


    echo '<div class="modal-body mostrartabla">

    <table class="table table-striped">
        <thead>
            <tr>
                <th style="display:none;">ID</th>
                <th>Centro</th>
                <th>Dirección</th>
                <th>CP</th>
                <th>Localidad</th>
                <th>Provincia</th>
                <th></th>
            </tr>
        </thead>
        <tbody style="font-size: 11px;">';

            while ( $row = mysqli_fetch_array($q) ) {

                echo '<tr><td id="id" style="display:none;">';
                echo($row[id]);
                echo "</td>";
                echo "<td>";
                echo($row[nombrecentro]);
                echo "</td>";
                echo "<td>";
                print($row[direccioncentro]);
                echo "</td>";
                echo "<td>";
                print($row[codigopostal]);
                echo "</td>";
                echo "<td>";
                print($row[localidad]);
                echo "</td>";
                echo "<td>";
                print($row[provincia]);
                echo "</td>";
                echo '<td><a id="seleccionarcentro" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-plus-sign"></span> </a></td></tr>';
            }
            echo '</tbody></table>';
        }

        function formacionesAlumno($id_alu, $alumno, $link) {

            $q = 'SELECT m.id as idmat, m.fechaini, m.fechafin, ac.numeroaccion, ac.denominacion, ga.ngrupo, ac.modalidad, a.nombre, a.apellido, m.grupo
            FROM matriculas m, mat_alu_cta_emp ma, acciones ac, grupos_acciones ga, alumnos a
            WHERE ma.id_matricula = m.id
            AND m.id_accion = ac.id
            AND m.id_grupo = ga.id
            AND ma.id_alumno = a.id
            AND a.id = '.$id_alu;
    // echo $q;
            $q = mysqli_query($link, $q);

            echo '<div class="modal-body mostrartabla">

            <h4>Alumno: '.$alumno.'</h4>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="display:none;">ID</th>
                        <th>Acción</th>
                        <th>Denominación</th>
                        <th>Modalidad</th>
                        <th>Fechas</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody style="font-size: 12px;">';

                    while ($row = mysqli_fetch_array($q)) {

                        if ( $row[grupo] == 1 ) $grupo = " (G)"; else $grupo = "";

                        $idmat = $row[idmat];
                        echo '<tr><td id="id" style="display:none;">';
                        echo($idmat);
                        echo "</td>";
                        echo "<td>";
                        echo($row[numeroaccion].'/'.$row[ngrupo].$grupo);
                        echo "</td>";
                        echo "<td>";
                        print($row[denominacion]);
                        echo "</td>";
                        echo "<td>";
                        print($row[modalidad]);
                        echo "</td>";
                        echo "<td>";
                        print(date("d/m/Y", strtotime($row[fechaini])) .' - '. date("d/m/Y", strtotime($row[fechafin])) );
                        echo "</td></tr>";
            // echo '<td><a id="preacuerdo" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-list-alt"></span> </a></td></tr>';
                    }
                    echo '</tbody>
                </table>
            </div>';


        }

        function formacionesEmpresa($id_emp, $empresa, $link) {

            $q = 'SELECT DISTINCT m.id as idmat, m.fechaini, m.fechafin, m.estado, ac.numeroaccion, ac.denominacion, ga.ngrupo, ac.modalidad, e.razonsocial, e.cif, m.grupo
            FROM matriculas m, mat_alu_cta_emp ma, acciones ac, grupos_acciones ga, empresas e
            WHERE ma.id_matricula = m.id
            AND m.id_accion = ac.id
            AND m.id_grupo = ga.id
            AND ma.id_empresa = e.id
            AND e.id = '.$id_emp.'
            UNION
            SELECT DISTINCT m.id as idmat, m.fechaini, m.fechafin, m.estado, ac.numeroaccion, ac.denominacion, ga.ngrupo, ac.modalidad, e.razonsocial, e.cif, m.grupo
            FROM matriculas m, temp_empresas ma, acciones ac, grupos_acciones ga, empresas e
            WHERE ma.id_matricula = m.id
            AND m.id_accion = ac.id
            AND m.id_grupo = ga.id
            AND ma.cif = e.cif
            AND e.id = '.$id_emp.'
            UNION
            SELECT DISTINCT m.id as idmat, m.fechaini, m.fechafin, m.estado, ac.numeroaccion, ac.denominacion, ga.ngrupo, ac.modalidad, e.razonsocial, e.cif, m.grupo
            FROM matriculas m, ptemp_mat_emp ma, acciones ac, grupos_acciones ga, empresas e
            WHERE ma.id_matricula = m.id
            AND m.id_accion = ac.id
            AND m.id_grupo = ga.id
            AND ma.id_empresa = e.id
            AND e.id = '.$id_emp;
    // echo $q;
            $q = mysqli_query($link, $q) or die("error" . mysqli_error($link));

            echo '<div class="modal-body mostrartabla">

            <h4>Empresa: '.$empresa.'</h4>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="display:none;">ID</th>
                        <th>Acción</th>
                        <th>Denominación</th>
                        <th>Modalidad</th>
                        <th>Fechas</th>
                        <th>Estado</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody style="font-size: 12px;">';

                    while ($row = mysqli_fetch_array($q)) {

                        if ( $row[grupo] == 1 ) $grupo = " (G)"; else $grupo = "";

                        $idmat = $row[idmat];
                        echo '<tr><td id="id" style="display:none;">';
                        echo($idmat);
                        echo "</td>";
                        echo "<td>";
                        echo($row[numeroaccion].'/'.$row[ngrupo].$grupo);
                        echo "</td>";
                        echo "<td>";
                        print($row[denominacion]);
                        echo "</td>";
                        echo "<td>";
                        print($row[modalidad]);
                        echo "</td>";
                        echo "<td>";
                        print(date("d/m/Y", strtotime($row[fechaini])) .' - '. date("d/m/Y", strtotime($row[fechafin])) );
                        echo "</td>";
                        echo "<td>";
                        print($row[estado]);
                        echo "</td>";
                        echo "</tr>";
                    }
                    echo '</tbody>
                </table>
            </div>';


        }

        function devuelveDatosFungibles($link) {

            $q = 'SELECT id, item, precio
            FROM items_gastos
            WHERE tipo = 0';
            $q = mysqli_query($link, $q);

            echo '<div style="overflow:auto; margin-top: 10px;" class="col-md-12">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label" for="listafun">Lista de Material: </label>
                    <select id="listafun" name="listafun" class="form-control">
                        <option>Selecciona un elemento</option>';

                        while ( $row = mysqli_fetch_array($q) ) {

                            echo '<option iden="'.$row[id].'" precio="'.$row[precio].'" value="'.$row[item].'">'.$row[item].' - '.$row[precio].'</option>';

                        }

                        echo '</select></div></div></div><div class="clearfix"></div><span id="fin_listafun"></span>';



                        echo '<div style="overflow:auto; margin-top: 10px;" class="col-md-12">';

                        echo '<div class="col-md-8" id="divnuevoitemrentabilidad">
                        <div class="form-group">';

                            echo '    <a id="nuevoitemrentabilidad" tipoGasto="0" style="float:left; margin-top: 0px;" class="btn btn-success"> Nuevo Item</a>';

                            echo '</div></div></div>';



                        }

                        function cargarSelectRentabilidad($tipoGasto, $link){

                            $q = 'SELECT id, item, precio
                            FROM items_gastos
                            WHERE tipo = '.$tipoGasto;
                            $q = mysqli_query($link, $q);

                            echo '<option>Selecciona un elemento</option>';

                            while ( $row = mysqli_fetch_array($q) ) {

                                echo '<option iden="'.$row[id].'" precio="'.$row[precio].'" value="'.$row[item].'">'.$row[item].' - '.$row[precio].'</option>';

                            }
                        }


                        function devuelveDatosOtrosGastos($link) {

                            $q = 'SELECT id, item, precio
                            FROM items_gastos
                            WHERE tipo = 1';
                            $q = mysqli_query($link, $q);

                            echo '<div style="overflow:auto; margin-top: 10px;" class="col-md-12">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="listaotros">Lista de Gastos: </label>
                                    <select id="listaotros" name="listaotros" class="form-control">
                                        <option>Selecciona un elemento</option>';

                                        while ( $row = mysqli_fetch_array($q) ) {

                                            echo '<option iden="'.$row[id].'" precio="'.$row[precio].'" value="'.$row[item].'">'.$row[item].' - '.$row[precio].'</option>';

                                        }

                                        echo '</select></div></div></div><div class="clearfix"></div><span id="fin_listafun"></span>';

    //if ( $_SESSION['user'] == 'root' ) {

                                        echo '<div style="overflow:auto; margin-top: 10px;" class="col-md-12">';

                                        echo '<div class="col-md-8" id="divnuevoitemrentabilidad">
                                        <div class="form-group">';

                                            echo '    <a id="nuevoitemrentabilidad" tipoGasto="1" style="float:left; margin-top: 0px;" class="btn btn-success"> Nuevo Item</a>';

                                            echo '</div></div></div>';
    //}

                                        }

                                        function devuelveDatosCosteDocente($id_doc,$id_mat,$link) {

                                            if ( $id_doc == undefined ) {

                                                $q = 'SELECT situacionlaboral, preciohora
                                                FROM docentes d, mat_doc md
                                                WHERE md.id_docente = d.id
                                                AND md.id_matricula = '.$id_mat;

                                            } else {

                                                $q = 'SELECT situacionlaboral, preciohora
                                                FROM docentes d
                                                WHERE d.id = '.$id_doc;
        // echo $q;
                                            }

                                            $q = mysqli_query($link, $q);
                                            $row = mysqli_fetch_array($q);

                                            $situacion = $row[situacionlaboral];
                                            $preciohora = $row[preciohora];
                                            $pos = strpos($preciohora, "€");
                                            if ( $pos !== FALSE ) $preciohora = substr($preciohora, 0,2);


                                            echo '<div style="overflow:auto; margin-top: 10px;" class="col-md-12">
                                            <div class="col-md-offset-1 col-md-5">
                                                <div class="form-group">
                                                    <label class="control-label" for="costehora">¿ Alta Laboral ?</label>
                                                    <select id="altalaboral" name="altalaboral" class="form-control">
                                                        <option value="no">No</option>
                                                        <option value="si" '; if ($situacion == "Generar" || $situacion == "Desempleado" ) echo "selected"; echo '>Sí</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label class="control-label" for="costehora">Coste Bruto/Hora Docente:</label>
                                                    <input type="text" value="'.$preciohora.'" id="costehora" name="costehora" class="form-control"/>
                                                </div>
                                            </div>
                                        </div>';

                                    }

                                    function limiteAlumnosDocente($fechaini, $fechafin, $id_docente, $link) {

    // $fechaini = '12-06-2014';
    // $fechafin = '25-06-2014';
    // echo "Matricula rango: ".$fechaini. ' - '.$fechafin;
                                        $rangoMatActual = createDateRangeArray($fechaini, $fechafin);
                                        $valores = array();


                                        for ($i=0; $i < count($rangoMatActual); $i++) {

                                            $q = 'SELECT DISTINCT m.fechaini,m.fechafin, @idmat:=m.id, a.denominacion, a.numeroaccion, ga.ngrupo,
                                            (SELECT count(*) FROM mat_alu_cta_emp WHERE id_matricula = @idmat) as nalumnos
                                            FROM matriculas m, acciones a, mat_doc md, grupos_acciones ga
                                            WHERE m.id_accion = a.id
                                            AND m.id_grupo = ga.id
                                            AND md.id_matricula = m.id
                                            AND a.modalidad IN("Teleformación","A Distancia")
                                            AND md.id_docente = '.$id_docente.'
                                            AND m.estado IN("Comunicada")
                                            AND m.fechaini <= "'.$rangoMatActual[$i].'" AND m.fechafin >= "'.$rangoMatActual[$i].'"
                                            GROUP by fechaini
                                            ORDER BY fechaini';
                                            $q = mysqli_query($link, $q);


                                            while ( $row = mysqli_fetch_array($q) ) {

                                                array_push($valores, date("d/m/Y", strtotime($row[fechaini])).' -> '.date("d/m/Y", strtotime($row[fechafin])).' | '.$row[denominacion].' '.$row[numeroaccion].'/'.$row[ngrupo].' | '.$row[nalumnos]);
                                            }

                                        }

                                        $valores = array_unique($valores);
    // print( "<pre>".print_r($valores, true)."</pre>" );
                                        echo '<h4 style="margin-left: 15px">Fechas matrícula: '.date("d/m/Y", strtotime($fechaini)).' - '.date("d/m/Y", strtotime($fechafin)).'</h4><br>';
                                        echo '<table style="margin-left: 15px;">';
                                        for ($i=0; $i < count($valores); $i++) {
                                            echo '<tr><td>'.$valores[$i].'</td></tr>';
                                            $c = substr($valores[$i], -2);
                                            $total = $total+$c;
                                        }

                                        echo "<tr><td>Total alumnos en esas fechas: ".$total."</td></tr>";
                                        echo '</table>';

                                    }

                                    function formacionesDocente($id, $docente, $link) {

                                        $q = 'SELECT m.id as idmat, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, a.modalidad, d.nombre, d.apellido, d.apellido2
                                        FROM matriculas m, mat_doc md, acciones a, grupos_acciones ga, docentes d
                                        WHERE md.id_matricula = m.id
                                        AND m.id_accion = a.id
                                        AND m.id_grupo = ga.id
                                        AND md.id_docente = d.id
                                        AND d.id = '.$id;
    // echo $q;
                                        $q = mysqli_query($link, $q);

                                        echo '<div class="modal-body mostrartabla">

                                        <h4>Docente: '.$docente.'</h4>
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th style="display:none;">ID</th>
                                                    <th>Acción</th>
                                                    <th>Denominación</th>
                                                    <th>Modalidad</th>
                                                    <th>Fechas</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody style="font-size: 12px;">';

                                                while ($row = mysqli_fetch_array($q)) {
                                                    $idmat = $row[idmat];
                                                    echo '<tr><td id="id" style="display:none;">';
                                                    echo($idmat);
                                                    echo "</td>";
                                                    echo "<td>";
                                                    echo($row[numeroaccion].'/'.$row[ngrupo]);
                                                    echo "</td>";
                                                    echo "<td>";
                                                    print($row[denominacion]);
                                                    echo "</td>";
                                                    echo "<td>";
                                                    print($row[modalidad]);
                                                    echo "</td>";
                                                    echo "<td>";
                                                    print(date("d/m/Y", strtotime($row[fechaini])) .' - '. date("d/m/Y", strtotime($row[fechafin])) );
                                                    echo "</td>";
                                                    echo '<td><a id="preacuerdo" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-list-alt"></span> </a></td></tr>';
                                                }
                                                echo '</tbody>
                                            </table>
                                        </div>';


                                    }


    function anadirAlumnoMoodle($datos, $link) {

        $domainname = 'http://EDUKA-TE.com/campusfpe';
        $token = 'c25817143e06c29e0438e7d474752b07';
    // $functionname = 'core_user_create_users';
    $restformat = 'json'; //Also possible in Moodle 2.2 and later: 'json'

    //////// moodle_user_create_users ////////

    $id_mat = $datos[id_mat];
    $id_alu = $datos[id_alu];

    $q1 = 'SELECT DISTINCT a.id as id_alu,a.nombre,a.apellido,a.apellido2,e.razonsocial,e.cif,m.jornadalaboral,ac.modalidad,
    ma.*,a.*,ac.denominacion,ac.horastotales, ac.url,ac.*,m.*,ga.ngrupo
    FROM mat_alu_cta_emp m
    INNER JOIN alumnos a ON m.id_alumno = a.id
    INNER JOIN empresas e ON m.id_empresa = e.id
    INNER JOIN matriculas ma ON ma.id = m.id_matricula
    INNER JOIN acciones ac ON ma.id_accion = ac.id
    INNER JOIN grupos_acciones ga ON ma.id_grupo = ga.id
    WHERE m.id_matricula = '.$id_mat.'
    AND m.id_alumno = '.$id_alu;
    // echo $q1;
    $q1 = mysqli_query($link, $q1);
    $row = mysqli_fetch_array($q1);

    $user = $row[user];
    $pass = $row[pass];
    $nombre = $row[nombre];
    $apellidos = $row[apellido].' '.$row[apellido2];
    $email = trim($row[email]);
    $fechaini = $row[fechaini];
    $fechaini = strtotime($row[fechaini])+3600;
    // $fechainif = date("d/m/Y H:i", $fechaini);
    $fechafin = $row[fechafin];
    $fechafin = strtotime($row[fechafin])+90000;
    // $fechafinf = date("d/m/Y H:i", $fechafin);
    $naccion = $row[numeroaccion];
    $ngrupo = $row[ngrupo];
    $courseid = $row[courseid];

    $linkm = connectMoodle();


    $q2 = 'SELECT id
    FROM mdl_user
    WHERE email = "'.$email.'"';
    // echo $q;
    $q2 = mysqli_query($linkm, $q2);
    $row = mysqli_fetch_array($q2);


    if ( mysqli_num_rows($q2) > 0 ) {

        $iduser = $row[id];
        echo "iduser esta con id: ".$iduser;

        $q = 'SELECT mg.name
        FROM mdl_groups mg, mdl_groups_members mgm
        WHERE mgm.userid = '.$iduser.'
        AND mgm.groupid = mg.id';
        // echo $q;
        $q = mysqli_query($linkm, $q);
        $grupo = array();
        while ( $row = mysqli_fetch_array($q) ) {
            array_push($grupo, $row[name]);
        }
        // print_r($grupo);
        $match = "";

        for ( $i=0; $i < count($grupo); $i++ ) {
            // echo $grupo[$i];
            if ( $grupo[$i] == $naccion.'.'.$ngrupo || $grupo[$i] == $naccion.'/'.$ngrupo) {
                $match = $grupo[$i];
            }
        }

        if ( $match != "" ) {

            echo "El alumno ya está matriculado en este curso: ".$match;
            return false;

        }

        $q = 'UPDATE mdl_user SET email = "'.$email.'.old" WHERE id='.$iduser;
        // echo $q;
        $q = mysqli_query($linkm, $q);

    }

    $user1 = new stdClass();
    $user1->username = $user;
    $user1->password = $pass;
    $user1->firstname = $nombre;
    $user1->lastname = $apellidos;
    $user1->email = $email;
    $user1->auth = 'manual';

        // $user1->idnumber = '222';
    $user1->lang = 'es';
        // $user1->theme = 'standard';
        // $user1->mailformat = 0;
    $user = array($user1);

        // print_r($user);
        //////// core_user_create_users ////////

    $functionname = 'core_user_create_users';
    $params = array('users' => $user);
        // print_r($params);
        // // header('Content-Type: text/plain');
    $serverurl = $domainname . '/webservice/rest/server.php'. '?wstoken=' . $token . '&wsfunction='.$functionname;
        // echo $serverurl;
    require_once('./curl.php');
    $curl = new curl;
        // //if rest format == 'xml', then we do not add the param for backward compatibility with Moodle < 2.2
    $restformat = ($restformat == 'json')?'&moodlewsrestformat=' . $restformat:'';
    $resp = $curl->post($serverurl . $restformat, $params);

        print_r($params);
        echo "<br>";
        print_r($resp);

    $resp = json_decode($resp);
        // print_r($resp);
    $error = $resp->exception;

    if ( isset($error) && $error != "" ) {
            echo "no insertado";
        print_r($resp);
        $debug = $resp->debuginfo;
        echo $fechainif."<br>";
        echo $fechafinf."<br>";
        if ( strpos($debug, "Username") !== false )
            echo "Cambia el nombre de usuario del alumno y vuelve a insertar";
        return false;
    } else {
        $iduser = $resp[0]->id;
        print_r('a1'.$resp);
        echo "id insertado: ".$iduser;

    }


    // buscar id del grupo en tabla moodle
    $q = 'SELECT id as idgrupo
    FROM mdl_groups
    WHERE name = "'. $naccion.'/'.$ngrupo .'"';
    $q = mysqli_query($linkm, $q) or die ("error select idgrupo");
    $row = mysqli_fetch_array($q);

    if ( mysqli_num_rows($q) > 0 ) {

        $idgrupo = $row[idgrupo];
        echo "id grupo que ya estaba: ".$idgrupo;

    } else {

        // crear el grupo en moodle
        $q = 'INSERT INTO mdl_groups
        (courseid, name)
        VALUES
        ("'.$courseid.'","'.$naccion.'/'.$ngrupo.'")';
        $q = mysqli_query($linkm, $q) or die ("error insert idgrupo");
        $idgrupo = mysqli_insert_id($linkm);
        echo "id grupo creado: ".$idgrupo;

    }


    // inserto user al grupo
    $q = 'INSERT INTO mdl_groups_members
    (groupid, userid)
    VALUES
    ("'.$idgrupo.'","'.$iduser.'")';
    $q = mysqli_query($linkm, $q) or die ("error");


    // saco el enrolid del curso
    $q = 'SELECT id FROM mdl_enrol
    WHERE courseid = '.$courseid.'
    AND enrol = "manual"';
    $q = mysqli_query($linkm, $q) or die ("error");
    $row = mysqli_fetch_array($q);
    $enrolid = $row[id];

    echo "enrolid: ".$enrolid;




    /// enrol_manual_enrol_users ///

    $functionname = 'enrol_manual_enrol_users';
    $serverurl = $domainname . '/webservice/rest/server.php'. '?wstoken=' . $token . '&wsfunction='.$functionname;
    $enrolment = new stdClass();
    $enrolment->roleid = 5;             // estudiante = 5
    $enrolment->userid = $iduser;       // sacar max de mdl_users
    $enrolment->courseid = $courseid;           // referenciado en acciones
    $enrolments = array( $enrolment);
    $params = array('enrolments' => $enrolments);

    $id_user = $iduser;

    print_r($params);
    $resp2 = $curl->post($serverurl . $restformat, $params);
    print_r('a'.$resp2);

    // inserto en mdl_user_enrolments: enrolid, userid, fecha ini y fechafin
    $q = 'UPDATE mdl_user_enrolments
    SET timestart = "'.$fechaini.'",timeend = "'.$fechafin.'"
    WHERE enrolid = '.$enrolid.' AND userid = '.$id_user;
    // echo $q;
    $q = mysqli_query($linkm, $q) or die ("error insertando");

    // echo $fechaini;
    // echo $fechafin;


}

function compruebaCIFemp($datos, $link) {

    $q = 'SELECT DISTINCT razonsocial FROM empresas
    WHERE cif = "'.$datos[cif].'"';
    // echo $q;
    $q = mysqli_query($link, $q);

    if ( mysqli_num_rows($q) > 0 ) {

        // echo "no";
        $row = mysqli_fetch_array($q);
        $r[0] = 'si';
        $r[1] = $row[razonsocial];

        echo json_encode($r);

    } else
    echo "no";

}


function compruebaAlu($datos, $link) {

    $q = 'SELECT DISTINCT CONCAT(nombre, " ", apellido, " ", apellido2) as alumno
    FROM alumnos
    WHERE documento = "'.$datos[documento].'"';
    // echo $q;
    $q = mysqli_query($link, $q);

    if ( mysqli_num_rows($q) > 0 ) {

        $row = mysqli_fetch_array($q);
        $r[0] = 'si';
        $r[1] = $row[alumno];

        echo json_encode($r);

    } else
    echo "no";

}


function devuelveAlumnosGuias($id_mat, $tipo, $mod, $link) {

    $sec = explode("?",$_SERVER['HTTP_REFERER']);
    if ($sec[1] == 'form_matricula_doc' || $sec[1] == 'form_matricula_doc#')
        $finalizado = ' ';
    else
        $finalizado = ' AND mp.finalizado = 1 ';


    $q = 'SELECT m.estado, a.url, a.numeroaccion, a.denominacion, ga.ngrupo, a.nsystem, m.fechaini
    FROM matriculas m, acciones a, grupos_acciones ga
    WHERE m.id_accion = a.id
    AND m.id_grupo = ga.id
    AND a.id = ga.id_accion
    AND m.id = '.$id_mat;
    $q = mysqli_query($link, $q);

    $row = mysqli_fetch_array($q);
    $estado = $row[estado];
    $url = $row[url];
    $naccion = $row[numeroaccion];
    $denominacion = $row[denominacion];
    $ngrupo = $row[ngrupo];
    $ncurso = $row[nsystem];
    $fechaini = $row[fechaini];

    $denominacion = explode(" ", $denominacion);
    $denominacion = $denominacion[0];


    if ( $tipo == 'bonificado' ) {

        if ( $mod == 'p')
            $tablas = 'temp_alumnos a, temp_empresas e ';

        if ( $estado == 'Finalizada' || $mod != 'p' )
            $q = 'SELECT DISTINCT a.*, a.id as id_alumno, e.*, ma.user, ma.pass, a.email as emailalumno
        FROM mat_alu_cta_emp ma, alumnos a, empresas e
        WHERE ma.id_alumno = a.id
        '.$finalizado.'
        AND ma.tipo = ""
        AND ma.id_matricula = '.$id_mat.'
        AND ma.id_empresa = e.id';
        else
            $q = 'SELECT *, a.id as id_alumno, e.id as id_empresa, a.email as emailalumno
        FROM '. $tablas .'
        WHERE a.id_empresa = e.id
        AND a.id_matricula = '.$id_mat;

    } else {

        if ( $mod == 'p')
            $tablas = 'temp_alumnosp a, temp_empresasp e ';

        if ( $estado == 'Finalizada' || $mod != 'p' )
            $q = 'SELECT DISTINCT a.*, a.id as id_alumno, e.*, ma.user, ma.pass, a.email as emailalumno
        FROM mat_alu_cta_emp ma, alumnos a, empresas e
        WHERE ma.id_alumno = a.id
        '.$finalizado.'
        AND ma.tipo = "Privado"
        AND ma.id_matricula = '.$id_mat.'
        AND ma.id_empresa = e.id';
        else
            $q = 'SELECT *, a.id as id_alumno, e.id as id_empresa, a.email as emailalumno
        FROM '. $tablas .'
        WHERE a.id_empresa = e.id
        AND a.id_matricula = '.$id_mat;
    }

    // echo $q;
    $q = mysqli_query($link, $q);
    $i = 0;

    // $tablausers = '<table><tr><td>username</td><td>password</td><td>firstname</td><td>lastname</td><td>email</td><td>course1</td><td>group1</td><td>city</td><td>country</td></tr>';
    $tablausers = '<table><tr><td>username</td><td>password</td><td>firstname</td><td>lastname</td><td>email</td><td>course1</td><td>group1</td><td>city</td><td>country</td></tr>';

    while ( $rows = mysqli_fetch_array($q) ) {

        $email=$rows[emailalumno];
        $alumno = $rows[nombre].' '.$rows[apellido].' '.$rows[apellido2];
        $alumno1 = $rows[nombre].' '.$rows[apellido];


        $res = comprobarEnvioGuiaAl($id_mat, $email, $link);
        if ( $res == 'si' )
            $boton = 'btn-success';
        else
            $boton = 'btn-warning';

        $razonsocial = $rows[razonsocial];
        $documento = $rows[documento];



        $pass = normaliza($rows[nombre][0].($rows[apellido]).substr($documento, 4,4));
        $url2 = explode('.com/', $url);

        if ( $url2[1][0] != 'a'  ) { // MOODLE

            // echo "entra";
            $nombre = explode(" ", $rows[nombre]);
            $nombre = $nombre[0];
            //$user = 'alum';
            $anio = strftime('%y', strtotime($fechaini));
            $mes = strftime('%m', strtotime($fechaini));
            //$mes ='04';
            //$user .= $anio.$mes.substr($rows[documento], 1,4);
            $user = strtolower($rows[documento]);
            $pass = strtoupper(normaliza($rows[nombre][0])).trim(normaliza($rows[apellido])).substr($rows[documento], 4,4);


        }

        $pass = preg_replace('/\s+/', '', $pass);


        if ( $rows[user] != "" )
            $user = $rows[user];
        else {

            if ( $url2[1][0] == 'a' )
                $user = "";
        }

        if ( $rows[pass] != "" )
            $pass = $rows[pass];

        // $pass = trim(html_entity_decode($pass));

        $i++;
        echo '
        <div style="margin: 15px 0px 20px 0px; font-size:12px; overflow: auto" class="col-md-12">
            <input type="hidden" id="id_matricula" value="'. $id_mat .'">
            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label" for="alumno">Alumno:</label>
                    <input style="font-size:12px;" value="'. $rows[nombre].' '.$rows[apellido].' '.$rows[apellido2] .'" type="text" id="alumno" name="alumno" class="form-control" disabled />
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label" for="user">Usuario:</label>
                    <input value="'. $user .'" type="text" id="user'.$i.'" name="user" class="form-control"  />
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label" for="pass">Password:</label>
                    <input value="'. $pass .'" type="text" id="pass'.$i.'" name="pass" class="form-control"  />
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label" for="email">Email:</label>
                    <input value="'. $email .'" type="text" id="email'.$i.'" name="email" class="form-control" disabled />
                </div>
            </div>
            <div class="col-md-1" style="margin-top: 25px">
                <a style="width:100%" id="guardauserpass_grupal" user="'.$i.'" name="'.$rows[id_alumno].'" tipo="'.$tipo.'" class="btn btn-success"><span class="glyphicon glyphicon-btc"></span> </a>
                </div>
            <div class="col-md-1" style="margin-top: 25px">
                <a style="width:100%" id="guardauserpass_grupal" user="'.$i.'" name="'.$rows[id_alumno].'" tipo="'.$tipo.'" class="btn btn-info"><span class="glyphicon glyphicon-save"></span> </a>
            </div>
            <div class="col-md-1" style="margin-top: 25px">
                <a style="width:100%" id="guiadelalumnomp" user="'.$i.'" name="'.$rows[id_alumno].'" tipo="'.$tipo.'" class="btn btn-warning"><span class="glyphicon glyphicon-list-alt"></span> </a>
            </div>
            <div class="col-md-1" style="margin-top: 25px">
                <a style="width:100%" id="enviaguiagrupoindv" user="'.$i.'" name="'.$rows[id_alumno].'" tipo="'.$tipo.'" class="btn '.$boton.'"><span class="glyphicon glyphicon-envelope"></span> </a>
            </div>
            <div class="col-md-1" style="margin-top: 25px">
                <a id="informe-conex" style="width: 100%;" href="#" ncurso='.$ncurso.' user="'.$user.'" pass="'.$pass.'" name="matriculas" data-toggle=modal class="btn btn-success"><span class="glyphicon glyphicon-list-alt"></span></a>
            </div>
        </div>';

        $tablausers .= '<tr><td>'.$user.'</td><td>'.$pass.'</td><td>'.$rows[nombre].'</td><td>'.$rows[apellido].' '.$rows[apellido2].'</td><td>'.$email.'</td><td>'.$naccion.$denominacion.'</td><td>'.$naccion.'.'.$ngrupo.'</td><td>Islas Canarias</td><td>ES</td></tr>';

    }
    $tableusers .= '</table>';

    echo '
    <div class="clearfix"></div>
    <form id="form_users" action="functions/exportar_users.php" method="post">

        <a id="exportar_users" style="margin-right: 30px;float:left;" class="pull-right btn btn-warning"><span class="glyphicon glyphicon-user"></span> Exportar usuarios</a>
        <a id="enviartodasguias" style="margin-right: 30px;float:left;" class="pull-right btn btn-success"><span class="glyphicon glyphicon-envelope"></span> Enviar todas</a>

        <input type="hidden" name="tablausers" id="tablausers" value="'.$tablausers.'">
    </form>
    <div class="clearfix"></div>';
    // echo '<div style="margin: 15px 0px 20px 0px; overflow: auto" class="col-md-12">
    //  <a style="margin-right:15px" id="guiadelalumnomtodos" class="pull-right btn btn-danger"><span class="glyphicon glyphicon-list-alt"></span> Descargar todas</a>
    // </div>
    // <div class="clearfix"></div>';
}

function devuelveAlumnosDiplomas($id_mat, $tipo, $mod, $html, $porcen, $fuente, $fuentereal, $accion, $link) {

    if ( $fuente >= 1 && $fuente <= 8 ) {
        $htmlinicio = '<div style="font-size:'.$fuentereal.'"><table><tr>';
        $htmlfin = '</tr></table></div>';
    } else {
        $htmlinicio = '<div style="font-size:'.$fuentereal.'"><table><tr><td>';
        $htmlfin = '</td></tr></table></div>';
    }

    if ( $porcen == "25%" )
        $ancho = "215px";
    else if ( $porcen == "50%" )
        $ancho = "430px";
    else if ( $porcen == "33%" )
        $ancho = "286px";
    else if ( $porcen == "12%" )
        $ancho = "107px";
    else {
        $ancho = "850px";
    }

    $porcen = "width:".$porcen;
    $ancho = "width:".$ancho;

    $buscar = array("div", $porcen);
    $reemp = array("td", $ancho);

     //echo $html;echo "<br>";
    $htmlcontent = str_replace($buscar, $reemp, $html);
    $htmlfinal = $htmlinicio . $htmlcontent . $htmlfin;
    // echo $htmlfinal;

    $qa = 'SELECT fixed_diploma
    FROM acciones a
    WHERE a.id = "'.$accion.'"';
    $qa = mysqli_query($link, $qa) or die("error select : " .mysqli_error($link));

    $rowa = mysqli_fetch_assoc($qa);

    // si fixeo el diploma no lo reajustes
    if ( $rowa['fixed_diploma'] != 1 && $rowa['fixed_diploma'] != NULL ) {

        $q = 'UPDATE acciones SET htmldiploma = "'.mysql_escape_string($htmlfinal).'" WHERE id = '.$accion;
        mysqli_query($link, $q) or die("error" . mysqli_error($link) );
        // echo "entra a updatear";
    }

    $q = 'SELECT m.estado, a.url, a.numeroaccion, a.denominacion, ga.ngrupo, m.fechaini, m.fechafin
    FROM matriculas m, acciones a, grupos_acciones ga
    WHERE m.id_accion = a.id
    AND m.id_grupo = ga.id
    AND a.id = ga.id_accion
    AND m.id = '.$id_mat;
    $q = mysqli_query($link, $q);

    $row = mysqli_fetch_array($q);
    $estado = $row[estado];
    $url = $row[url];
    $naccion = $row[numeroaccion];
    $denominacion = $row[denominacion];
    $ngrupo = $row[ngrupo];


    $denominacion = explode(" ", $denominacion);
    $denominacion = $denominacion[0];


    if ( $tipo == 'bonificado' ) {

        $q = 'SELECT DISTINCT a.*, a.id as id_alumno, e.*, ma.user, ma.pass, a.email as email_alumno, e.email as email_empresa
        FROM mat_alu_cta_emp ma, alumnos a, empresas e
        WHERE ma.id_alumno = a.id
        AND ma.tipo = ""
        AND ma.finalizado = 1
        AND ma.id_matricula = '.$id_mat.'
        AND ma.id_empresa = e.id';

    } else {

        $q = 'SELECT DISTINCT a.*, a.id as id_alumno, e.*, ma.user, ma.pass, a.email as email_alumno, e.email as email_empresa
        FROM mat_alu_cta_emp ma, alumnos a, empresas e
        WHERE ma.id_alumno = a.id
        AND ma.tipo = "Privado"
        AND ma.finalizado = 1
        AND ma.id_matricula = '.$id_mat.'
        AND ma.id_empresa = e.id';

    }

    $q = mysqli_query($link, $q);

    $i = 0;

    while ( $rows = mysqli_fetch_array($q) ) {


        $q2 = 'SELECT *
        FROM confirmaciones_diplomas
        WHERE id_matricula = '.$id_mat.'
        AND id_alumno = '.$rows[id_alumno];
        $q2 = mysqli_query($link, $q2) or die("error" . mysqli_error($link));

        $resultado = array();
        if ( mysqli_num_rows($q2) > 0 ) {
            $resultado[recepcion] = 1;
            $row = mysqli_fetch_array($q2);
            $resultado[fecharecepcion] = formateaFechaHora($row[fechahora]);
        } else
        $resultado[recepcion] = 0;


        $resultado[envio] = comprobarEnvioDiplo($id_mat, $rows[id_alumno], $link);
        // echo "<pre>";print_r($resultado);echo "</pre>";

        $boton2 = 'btn-success';
        if ( $resultado["envio"]["envio"] == 0 ) {
            // echo "entra";
            $boton2 = 'btn-danger';
            $resultado["envio"]["fechaenvio"] = "-";
        }
        if ( $resultado["recepcion"] == 0 ) {
            $resultado["fecharecepcion"] = "-";
        }


        // print_r($rows);
        $email=$rows[email_alumno];
        $alumno = $rows[nombre].' '.$rows[apellido].' '.$rows[apellido2];
        $alumno1 = $rows[nombre].' '.$rows[apellido];


        $razonsocial = $rows[razonsocial];
        $documento = $rows[documento];


        $i++;
        echo '
        <div style="margin: 15px 0px 20px 0px; font-size:12px; overflow: auto" class="col-md-12">
            <input type="hidden" id="id_matricula" value="'. $id_mat .'">
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label" for="alumno">Alumno:</label>
                    <input style="font-size:12px;" value="'. $rows[nombre].' '.$rows[apellido].' '.$rows[apellido2] .'" type="text" id="alumno" name="alumno" class="form-control" disabled />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label" for="email">Email:</label>
                    <input value="'. $email .'" type="text" id="email'.$i.'" name="email" class="form-control"  disabled/>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label" for="email">Fecha Envio:</label>
                    <input value="'.$resultado["envio"]["fechaenvio"].'" type="text" id="email'.$i.'" name="email" class="form-control"  disabled/>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label" for="email">Fecha Descarga:</label>
                    <input value="'.$resultado["fecharecepcion"].'" type="text" id="email'.$i.'" name="email" class="form-control"  disabled/>
                </div>
            </div>
            <div class="col-md-1" style="margin-top: 25px">
                <a style="width:100%" id="verdiplomagrupo" user="'.$i.'" name="'.$rows[id_alumno].'" tipo="'.$tipo.'" class="btn btn-warning"><span class="glyphicon glyphicon-bookmark"></span> </a>
            </div>
            <div class="col-md-1" style="margin-top: 25px">
                <a style="width:100%" id="enviardiplomagrupo" user="'.$i.'" name="'.$rows[id_alumno].'" tipo="'.$tipo.'" class="btn disabled '.$boton2.'"><span class="glyphicon glyphicon-envelope"></span> </a>
            </div>

        </div>';


    }

    echo '
    <div class="clearfix"></div>
    <form id="form_users" action="functions/exportar_users.php" method="post">

        <a id="enviartodosdiplos" style="margin-right: 30px;float:left;" class="pull-right btn btn-success disabled"><span class="glyphicon glyphicon-envelope"></span> Enviar todos</a>
        <a id="enviardiplomagrupoemp" style="margin-right: 30px;float:left;" tipo="'.$tipo.'" class="pull-right btn btn-success "><span class="glyphicon glyphicon-envelope"></span> Enviar a empresa</a>
        <div class="col-md-3 pull-right">
        <div class="form-group">
            <input style="font-size:12px;" placeholder="Email empresa" value="'.$row['email_empresa'].'" type="text" id="diploma_email_emp" name="diploma_email_emp" class="form-control"  />
        </div>
        </div>

        <input type="hidden" name="tablausers" id="tablausers" value="'.$tablausers.'">
    </form>
    <div class="clearfix"></div>';
    // echo '<div style="margin: 15px 0px 20px 0px; overflow: auto" class="col-md-12">
    //  <a style="margin-right:15px" id="guiadelalumnomtodos" class="pull-right btn btn-danger"><span class="glyphicon glyphicon-list-alt"></span> Descargar todas</a>
    // </div>
    // <div class="clearfix"></div>';
}



function comprobarEnvioDiplo($id_mat, $id_alu=NULL, $link) {

    if ( $id_alu != NULL )
        $alu = ' AND al.id = '.$id_alu;

    $q = 'SELECT DISTINCT a.numeroaccion, ga.ngrupo, a.denominacion, al.nombre, al.apellido
    FROM grupos_acciones ga, acciones a, matriculas m, mat_alu_cta_emp ma, alumnos al
    WHERE m.id_accion = a.id
    AND ma.id_matricula = m.id
    AND ma.id_alumno = al.id
    AND a.id = ga.id_accion
    AND m.id_grupo = ga.id
    '.$alu.'
    AND m.id = '.$id_mat;
    // echo $q;
    $q = mysqli_query($link, $q);

    $row = mysqli_fetch_assoc($q);
    $like = $row[nombre].' '.$row[apellido];
    $like2 = $row[numeroaccion].'/'.$row[ngrupo];

    $q = "SELECT * FROM registro_emails
    WHERE titulo
    LIKE '%diploma%'
    AND titulo LIKE '%".$like."%'
    AND titulo LIKE '%".$like2."%'";
    // echo $q;
    $q = mysqli_query($link, $q);
    $resul = array();

    if ( mysqli_num_rows($q) > 0 ) {
        $resul[envio] = 1;
        $rowx = mysqli_fetch_array($q);
        $resul[fechaenvio] = formateaFechaHora($rowx[fecha]);
    } else
    $resul[envio] = 0;

    return $resul;
}

function comprobarEnvioGuia($id_mat, $link) {

    $q = 'SELECT a.numeroaccion, ga.ngrupo
    FROM grupos_acciones ga, acciones a, matriculas m
    WHERE m.id_accion = a.id
    AND a.id = ga.id_accion
    AND m.id_grupo = ga.id
    AND m.id = '.$id_mat;
    // echo $q;
    $q = mysqli_query($link, $q);

    $row = mysqli_fetch_assoc($q);
    $naccion = $row[numeroaccion];
    $ngrupo = $row[ngrupo];
    $like = $naccion.'.'.$ngrupo;

    $q = "SELECT * FROM registro_emails
    WHERE titulo
    LIKE '%Guía%'
    AND titulo LIKE '% ".$like." %'";
    // echo $q;
    $q = mysqli_query($link, $q);

    if ( mysqli_num_rows($q) > 0 )
        echo "si";
    else
        echo "no";
}



function comprobarEnvioGuiaAl($id_mat, $nombre, $link) {

    $q = 'SELECT a.numeroaccion, ga.ngrupo
    FROM grupos_acciones ga, acciones a, matriculas m
    WHERE m.id_accion = a.id
    AND a.id = ga.id_accion
    AND m.id_grupo = ga.id
    AND m.id = '.$id_mat;
    // echo $q;
    $q = mysqli_query($link, $q);

    $row = mysqli_fetch_assoc($q);
    $naccion = $row[numeroaccion];
    $ngrupo = $row[ngrupo];
    $like = $naccion.'.'.$ngrupo.' - '.$nombre;

    $q = "SELECT * FROM registro_emails
    WHERE titulo
    LIKE '%Guía%'
    AND para = '".$nombre."'";
    // echo $q;
    $q = mysqli_query($link, $q);

    if ( mysqli_num_rows($q) > 0 )
        return "si";
    else
        return "no";
}

function createDateRangeArray($start, $end) {
    // Modified by JJ Geewax
    // echo $start.' - '.$end;
    $range = array();

    if (is_string($start) === true) $start = strtotime($start);
    if (is_string($end) === true ) $end = strtotime($end);

    if ($start > $end) return createDateRangeArray($end, $start);

    do {
      $range[] = date('Y-m-d', $start);
      $start = strtotime("+ 1 day", $start);
  }
  while($start <= $end);

    // print_r($range);
  return $range;
}

function time_range( $start, $end, $step = 1800 ) {
    $return = array();
    for( $time = $start; $time <= $end; $time += $step )
        $return[] = date( 'H:i', $time );
    return $return;
}

function actualizarContactos($id_contacto, $values, $link) {

    foreach ($values as $clave => $valor)
        $valores[$clave] = $valor;

    $q = 'UPDATE contactos SET
    nombre = '.'"'.$valores['nombre'].'"'.', apellido = '.'"'.$valores['apellido'].'"'.', apellido2 = '.'"'.$valores['apellido2'].'"'.', telefonoc = '.'"'.$valores['telefono'].'"'.
    ', emailc = '.'"'.$valores['email'].'"'.', cargo = '.'"'.$valores['cargo'].'"'.
    ' WHERE id = '.$id_contacto;
    echo $q;
    $q = mysqli_query($link, $q);

}

function guardaContactos($id_emp, $values, $link) {

    foreach ($values as $clave => $valor)
        $valores[$clave] = $valor;

    unset($valores[guardarContactos]);
    unset($valores[actualizarContactos]);
    unset($valores[id_contacto]);
    unset($valores[id_emp]);
    $values = $id_emp."', ";
    $values .= "'".implode("','",$valores);
    $q = 'INSERT INTO contactos
    (id_empresa, nombre, apellido, apellido2, telefonoc, emailc, cargo)
    VALUES ('."'".$values."'".')';
    echo $q;
    $q = mysqli_query($link, $q);
}

function devuelveContactos($id_emp, $link) {


    $q = 'SELECT id, nombre, apellido, apellido2, telefonoc, emailc, cargo
    FROM contactos
    WHERE id_empresa = '.$id_emp;
    // echo $q;
    $q = mysqli_query($link,$q);

    ?>

    <div class="modal-body listacontactos">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="display:none;">ID</th>
                    <th>Cargo</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>2º Apellido</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                <?

                while ($row = mysqli_fetch_array($q)) {
                    echo '<tr><td id="id" style="display:none;">';
                    echo($row[id]);
                    echo "</td>";
                    echo '<td id="cargo">';
                    print($row[cargo]);
                    echo "</td>";
                    echo '<td id="nombre">';
                    echo($row[nombre]);
                    echo "</td>";
                    echo '<td id="apellido">';
                    print($row[apellido]);
                    echo "</td>";
                    echo '<td id="apellido2">';
                    print($row[apellido2]);
                    echo "</td>";
                    echo '<td id="telefonoc">';
                    print($row[telefonoc]);
                    echo "</td>";
                    echo '<td id="emailc">';
                    print($row[emailc]);
                    echo "</td>";
                    echo '<td><a id="seleccionarcontacto" name="contactos" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span> </a></td></tr>';
                } ?>
            </tbody>
        </table>
    </div>

    <?

}

function devuelveComerciales ($link, $selected = NULL) {
    $q = 'SELECT id,nombre,apellido,apellido2
    FROM comerciales ORDER by id ASC';
    $q = mysqli_query($link,$q);

    echo '<option value="">-</option>';
    while ($row = mysqli_fetch_array($q)) {
        echo '<option ' .($row['id'] == $selected ? "selected" : "" ). ' value="'.$row['id'].'">'.$row['nombre'].' '.$row['apellido'].' '.$row['apellido2'].'</option>';
    }
}

function cambiaJornada($id_mat, $id_alu, $jornadalaboral, $link) {
    $q = 'UPDATE mat_alu_cta_emp SET jornadalaboral = '.$jornadalaboral.
    ' WHERE id_matricula = '.$id_mat.' AND id_alumno = '.$id_alu;
    //echo $q;
    $q = mysqli_query($link,$q);
}

function asignaGrupo ($id_accion, $link) {

    $q1 = 'SELECT max(ngrupo) as grupo
    FROM grupos_acciones
    WHERE id_accion = '.$id_accion;
    $q1 = mysqli_query($link,$q1);
    $id = mysqli_fetch_row($q1);

    if ( is_null($id[0]) )
        echo "1";
    else
        echo $id[0]+1;
}

function devolverDatos ($id,$tabla,$mat,$link) {

    $gestion = devuelveAnio();
    $sec = explode("?",$_SERVER['HTTP_REFERER']);
    // echo $sec[1];
    $q1 = 'SELECT * FROM ' .$tabla. ' WHERE id = "'.$id.'" LIMIT 0, 1';
    // echo $q1;
    $q1 = mysqli_query($link,$q1) or die("error ".mysqli_error($link));
    $rows = array();
    while($r = mysqli_fetch_assoc($q1)) {

        if ( $r['tipodoc'] == 'Empresa' && strpos('docente', $sec[1]) === false ) {
            // echo "entra";
            $r['nombre'] = $r['nombredocente'];
            $r['apellido'] = $r['apellidodocente'];
            $r['documento'] = $r['documentodocente'];
        }

        $rows[0] = $r;
        $id_ac = $r[id_accion];
        $id_ce = $r[id_centro];
        $id_com = $r[id_comercial];
        $cif = $r[cif];

        // $id_peticion = $r[id];
    }

    // arrayText($rows[0]);

    if ( $tabla == 'cursos_tpc' ) {

        $qf = 'SELECT d.id_docente FROM cursos_tpc_docentes d
        WHERE d.id_curso = "'.$id.'"';
        $qf = mysqli_query($link, $qf) or die("error select : " .mysqli_error($link));

        while ( $rowf = mysqli_fetch_assoc($qf) ) {
            $rows['docentestpc'][] = $rowf['id_docente'];
        }

        $rutatpc = dirname(__DIR__).'/documentacion'.$gestion.'/tpc/'.$rows[0]['numcurso'].'/';
        // echo $rutatpc.'-tabla.xls';
        if (file_exists($rutatpc.$rows[0]['numcurso'].'-tabla.xls'))
            $rows['existetablatpc'] = "1";
        else
            $rows['existetablatpc'] = "0";

    }


    if ( $tabla == 'peticiones_gastos' && $rows[0]['tiposol'] == 'SF' ) {

        $qf = 'SELECT i.item, i.id as id_item, i.precio, m.cantidad
        FROM mat_items_gastos m
        INNER JOIN peticiones_gastos p ON m.id_peticion = p.id
        INNER JOIN items_gastos i ON i.id = m.id_item
        AND id_peticion = "'.$rows[0]['id'].'"';
        // echo $qf;
        $qf = mysqli_query($link, $qf) or die("error select : " .mysqli_error($link));

        while ( $rowf = mysqli_fetch_assoc($qf) ) {

            $rows['fungibles'] .= '
            <div class="fungibles">
             <div id="fungiblerow" class="col-md-12" style="margin-top: 15px;">
              <div class="col-md-4">
               <div class="form-group"><label class="control-label" for="nuevoitem">Item:</label>
                   <input type="text" value="'.$rowf['item'].'" iden="'.$rowf['id_item'].'" id="nuevoitem" name="nuevoitem" class="form-control" readonly/></div>
               </div>
               <div class="col-md-3">
                   <div class="form-group"><label class="control-label" for="precioitem">Precio:</label>
                       <input value="'.$rowf['precio'].'" type="text" id="precioitem'.$rowf['id_item'].'" name="precioitem" class="form-control" readonly/></div>
                   </div>
                   <div class="col-md-3">
                       <div class="form-group"><label class="control-label" for="cantidaditem">Cantidad:</label>
                           <input type="text" value="'.$rowf['cantidad'].'" id="cantidaditem'.$rowf['id_item'].'" name="cantidaditem" class="form-control"/></div>
                       </div>
                       <div class="col-md-2">
                           <div class="form-group"><label class="control-label" for="totalitem">Total:</label>
                               <input type="text" value="'.$rowf['cantidad']*$rowf['precio'].'" id="totalitem'.$rowf['id_item'].'" name="totalitem" class="form-control"/></div>
                           </div>
                       </div>
                   </div>
                   <div class="clearfix"></div>';

               }


           }

           if ( $tabla == 'peticiones_gastos' && $rows[0]['tiposol'] == 'SV' ) {

            $qv = 'SELECT *
            FROM peticiones_viajes
            WHERE id_peticion = "'.$rows[0]['id'].'"';
            $qv = mysqli_query($link, $qv) or die("error select : " .mysqli_error($link));

            while ( $rowv = mysqli_fetch_assoc($qv) ) {

                $z++;

                $rows['viajes'] .= '
                <div class="linea_viaje">
                    <div class="col-md-1 col-xs-12">
                        <div class="form-group">
                            <label class="control-label" for="tipoviaje">Medio:</label>
                            <select id="tipoviaje'.$z.'" name="tipoviaje" class="form-control">';
                                $rows['viajes'] .= '<option '. ( $rowv['tipoviaje'] == '' ? "selected" : "" ). ' value="">Cualquiera</option>';
                                $rows['viajes'] .= '<option '. ( $rowv['tipoviaje'] == 'Avión' ? "selected" : "" ). ' value="Avión">Avión</option>';
                                $rows['viajes'] .= '<option '. ( $rowv['tipoviaje'] == 'Barco' ? "selected" : "" ). ' value="Barco">Barco</option>';
                                $rows['viajes'] .= '<option '. ( $rowv['tipoviaje'] == 'Coche' ? "selected" : "" ). ' value="Coche">Coche</option>';
                                $rows['viajes'] .= '</select>
                            </div>
                        </div>
                        <div class="col-md-3 col-xs-12">
                            <div class="form-group">
                                <label class="control-label" for="origen">Origen - Destino:</label>
                                <input value="'.$rowv['origen'].'" type="text" id="origen'.$z.'" name="origen" class="form-control" /> </div>
                            </div>
                            <div class="col-md-2 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="fechaini">Fecha Inicio:</label>
                                    <input value="'.$rowv['fechaini'].'" type="date" id="fechaini'.$z.'" name="fechaini" class="form-control" /> </div>
                                </div>
                                <div class="col-md-2 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label" for="fechafin">Fecha Fin:</label>
                                        <input value="'.$rowv['fechafin'].'" type="date" id="fechafin'.$z.'" name="fechafin" class="form-control" /> </div>
                                    </div>
                                    <div class="col-md-1 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" for="idavuelta">Vuelta:</label>
                                            <select id="idavuelta'.$z.'" name="idavuelta" class="form-control">';
                                                $rows['viajes'] .= '<option '. ( $rowv['idavuelta'] == '' ? "selected" : "" ). ' value="">Selecciona</option>';
                                                $rows['viajes'] .= '<option '. ( $rowv['idavuelta'] == 'Si' ? "selected" : "" ). ' value="Si">Si</option>';
                                                $rows['viajes'] .= '<option '. ( $rowv['idavuelta'] == 'No' ? "selected" : "" ). ' value="No">No</option>';
                                                $rows['viajes'] .= '</select>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-xs-12">
                                            <div class="form-group">
                                                <label class="control-label" for="horario">Horario:</label>
                                                <input value="'.$rowv['horario'].'" type="text" id="horario'.$z.'" name="horario" class="form-control" /> </div>
                                            </div>
                                            <div class="col-md-1 col-xs-12">
                                                <div class="form-group">
                                                    <label class="control-label" for="importeviaje">Importe:</label>
                                                    <input value="'.$rowv['importeviaje'].'" type="text" id="importeviaje'.$z.'" name="importeviaje" class="form-control" /> </div>
                                                </div>
                                            </div>
                                            ';

                                        }
                                        $rows['viajes'] .= '<input type="hidden" id="countlineas" value="'.$z.'" disabled /> ';


                                    }

    if ($tabla == 'empresas') { // vale para devolver a EMPRESAS y a MATRICULA.
        $q1 = 'SELECT numerocuenta FROM cuentascotizacion WHERE id_empresa = '.$id;
        // echo $q1;
        $q1 = mysqli_query($link,$q1);

        while($r = mysqli_fetch_assoc($q1)) {
            $rows[numerocuenta][] = $r;
        }

        $q1 = 'SELECT c.id, c.nombre FROM comisionistas c, empresas e
        WHERE e.comisionista = c.id
        AND e.id = '.$id;
        // echo $q1;
        $q1 = mysqli_query($link,$q1);
        while($r = mysqli_fetch_assoc($q1)) {
            $rows[] = $r;
        }

        $rutaempresasanex = dirname(__DIR__).'/pdf_tripartita'.$gestion.'/anexos/';

        $sec = explode("?",$_SERVER['HTTP_REFERER']);
        // echo $sec[1];
        if ( $sec[1] != 'empresas' ) {

            if (file_exists($rutaempresasanex.$cif.'-anexoenc_esfocc.pdf')) $rows[aesfocc] = "1";
            else $rows[aesfocc] = "0";

            if (file_exists($rutaempresasanex.$cif.'-anexoenc_estrateg.pdf')) $rows[aestra] = "1";
            else $rows[aestra] = "0";

        }


    }

    if ( $tabla == 'comisionistas' ) {

        $rutacomisionistas = dirname(__DIR__).'/documentacion'.$gestion.'/comisionistas/';
        $id_comisionista = $id;

        $sql = 'SELECT c.nombre, c.tipocomisionista
        FROM comisionistas c
        WHERE id = '.$id_comisionista;

        $sql = mysqli_query($link, $sql);
        $row = mysqli_fetch_assoc($sql);
        $comisionistapdf = $row[tipocomisionista].'-'.normaliza($row[nombre]);

        $archivo =  $rutacomisionistas.$comisionistapdf.'.pdf';
        // echo $archivo;
        if (file_exists($archivo)) $rows['existecomisionista'] = 1;

    }

    if ( $tabla == 'acciones' ) {

        $rutametodologia = dirname(__DIR__).'/documentacion'.$gestion.'/acciones/';

        $id_accion = $id;

        $sql = 'SELECT denominacion,numeroaccion
        FROM acciones
        WHERE id = '.$id_accion;

        $sql = mysqli_query($link, $sql);
        $row = mysqli_fetch_assoc($sql);
        $metodologiapdf = 'Metodologia-'.normaliza($row[denominacion]).'-'.$row[numeroaccion];

        $archivo =  $rutametodologia.$metodologiapdf.'.pdf';
        // echo $archivo;
        if (file_exists($archivo)) $rows['existemetodologia'] = 1;


    }

    if ( $tabla == 'ikea_solicitudes' ) {

        // echo $gestion;
        // $anio = $devuelveAnio();
        $idsol = $id;

        $sql = 'SELECT *
        FROM ikea_solicitudes
        WHERE id = '.$idsol;

        $sql = mysqli_query($link, $sql);
        $row = mysqli_fetch_assoc($sql);
        $tablaikea = $row[numero].'_'.quitaTildesConComas($row[denominacion]).'.xlsx';
        $consentikea = $row[numero].'_'.quitaTildesConComas($row[denominacion]).'-consentimiento.pdf';
        // echo $tablaikea;
        $rutaikea = dirname(__DIR__).'/ikea'.$gestion.'/tablasparticipantes/';
        $rutaikeadocu = dirname(__DIR__).'/ikea'.$gestion.'/consentimiento/';
        $archivo =  $rutaikea.$tablaikea;
        $archivoconsent =  $rutaikeadocu.$consentikea;
        // echo $archivoconsent;


        $q = 'SELECT COUNT(id) as cuentas
        FROM temp_empresas_ikea
        WHERE id_solicitud = '.$idsol;
        $q = mysqli_query($link, $q) or die("error:" .mysqli_error($link));

        $row = mysqli_fetch_assoc($q);
        $rows[] = $row;

        $sql = 'SELECT p.id_empresa
        FROM ikea_solicitudes i, temp_empresas_ikea p
        WHERE p.id_solicitud = i.id
        AND i.id = '.$idsol;
        // echo $sql;
        $sql=mysqli_query($link, $sql) or die('error');

        while($r = mysqli_fetch_assoc($sql)) {
            $rows[] = $r;
        }

        if (file_exists($archivo)) $rows[2] = "1";
        else $rows[2] = "0";

        if (file_exists($archivoconsent)) $rows[3] = "1";
        else $rows[3] = "0";


    }

    if ( $mat == 'x' ) {


        $qx = 'SELECT a.*
        FROM acciones a
        WHERE a.id = '.$id_ac;
        // echo $qx;
        $qx = mysqli_query($link, $qx) or die("error:" .mysqli_error($link));

        while ( $rowx = mysqli_fetch_assoc($qx) )
            $rows[] = $rowx;


        $qy = 'SELECT c.*
        FROM centros c
        WHERE c.id = '.$id_ce;
        // echo $qy;
        $qy = mysqli_query($link, $qy) or die("error:" .mysqli_error($link));

        while ( $rowy = mysqli_fetch_assoc($qy) )
            $rows[] = $rowy;


        $qc = 'SELECT nombre
        FROM comerciales c
        WHERE c.id = "'.$id_com.'"';
        $qc = mysqli_query($link, $qc) or die("error:" .mysqli_error($link));

        while ( $rowc = mysqli_fetch_assoc($qc) )
            $rows[] = $rowc;


    }

    if ( $tabla == 'peticiones_formativas' && !isset($mat) ) {

        // echo "entra";
        $sql = 'SELECT p.*, c.nombre as nombrecomercial
        FROM peticiones_formativas p, comerciales c
        WHERE c.id = p.id_comercial
        AND p.id = '.$id;
        // echo $sql;
        $sql = mysqli_query($link, $sql) or die("error" . mysqli_error($link));
        $row = mysqli_fetch_assoc($sql);
        $rows[0] = $row;
        // print_r($row);
        $rutasolicitudes = dirname(__DIR__).'/documentacion'.$gestion.'/solicitudes/';
        $rutaempresasanex = dirname(__DIR__).'/pdf_tripartita'.$gestion.'/anexos/';

        $archivotablab =  $rutasolicitudes.$row[numero].'/'.$row[numero].'-tabla-bonif.xlsx';
        // echo $archivotablab;
        $archivotablap =  $rutasolicitudes.$row[numero].'/'.$row[numero].'-tabla-priv.xlsx';
        // $archivoanexo =  $rutasolicitudes.$row[numero].'/'.$row[numero].'-anexo001.pdf';
        // $archivoanexoestrat =  $rutasolicitudes.$row[numero].'/'.$row[numero].'-anexo001.pdf';
        $archivomat =  $rutasolicitudes.$row[numero].'/'.$row[numero].'-matricula.pdf';
        $archivorecibo =  $rutasolicitudes.$row[numero].'/'.$row[numero].'-justificante.pdf';
        // echo $archivorecibo;

        if ( $row[tiposol] != "SC" ) {

            if (file_exists($archivotablab)) $rows[1] = "1";
            else $rows[1] = "0";

            if (file_exists($archivotablap)) $rows[2] = "1";
            else $rows[2] = "0";

            if (file_exists($archivomat)) $rows[3] = "1";
            else $rows[3] = "0";
        }

        if ( $row[tiposol] == "SC" ) {

            // $archivoanexo =  $rutaempresasanex.$row[cif].'-anexoenc_esfocc.pdf';
            // echo $archivoanexo;
            if (file_exists($rutaempresasanex.$row[cif].'-anexoenc_esfocc.pdf')) $rows[4] = "1";
            else $rows[4] = "0";

            if (file_exists($rutaempresasanex.$row[cif].'-anexoenc_estrateg.pdf')) $rows[5] = "1";
            else $rows[5] = "0";


        } else {

            if (file_exists($rutaempresasanex.$row[cif].'-anexoenc_esfocc.pdf')) $rows[4] = "1";
            else $rows[4] = "0";

            if (file_exists($rutaempresasanex.$row[cif].'-anexoenc_estrateg.pdf')) $rows[5] = "1";
            else $rows[5] = "0";

            if (file_exists($archivorecibo)) $rows[6] = "1";
            else $rows[6] = "0";

        }


    }



    echo json_encode($rows);
}

function devolverDatosMatricula($id,$tabla,$link) {

    // datos de la accion - matricula: tabla: matriculas
    $q1 = 'SELECT ga.ngrupo, ga.id_accion, a.numeroaccion, a.denominacion, a.horastotales, a.contenido, a.modalidad, m.*
    FROM acciones a, matriculas m, grupos_acciones ga
    WHERE m.id_accion = a.id
    AND m.id_grupo = ga.id
    AND m.id = '.$id.'
    LIMIT 0,1';
    $q1 = mysqli_query($link,$q1);
    $rows = array();
    while($r = mysqli_fetch_assoc($q1)) {
        $rows[0] = $r;
    }

    $q1 = 'SELECT COUNT( id_matricula ) as cuentas
    FROM mat_alu_cta_emp
    WHERE id_matricula = '.$id.'
    UNION ALL
    SELECT COUNT( id_docente )
    FROM mat_doc
    WHERE id_matricula = '.$id;
    $q1 = mysqli_query($link,$q1);
    while($r = mysqli_fetch_assoc($q1)) {
        $rows[] = $r;
    }


    $q1 = 'SELECT DISTINCT c.id as comercialempresa
    FROM comerciales c, mat_alu_cta_emp m, empresas e
    WHERE m.id_empresa = e.id
    AND e.comercial = c.id
    AND m.id_matricula = '.$id;

    $q1 = mysqli_query($link,$q1);
    while($r = mysqli_fetch_assoc($q1)) {
        $rows[] = $r;
    }

    $q1 = 'SELECT DISTINCT c.*
    FROM costes_rentabilidad c, matriculas m
    WHERE m.id = c.id_matricula
    AND m.id = '.$id;

    $q1 = mysqli_query($link,$q1);
    while($r = mysqli_fetch_assoc($q1)) {
        $rows[] = $r;
    }

    echo json_encode($rows);

}


function connectMoodle() {

    $linkm = mysqli_connect("localhost","myEDUKA-TE","qMtJ7OoD","campusfpe");

    /* check connection */
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    mysqli_set_charset($linkm,"utf8");
    // $mysqli->query('SET NAMES utf8');
    return $linkm;

}

function connectCongreso() {

    $linke = mysqli_connect("localhost","mycon4363","Td6Q98oD","congreso");

    /* check connection */
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    mysqli_set_charset($linke,"utf8");
    return $linke;

}

function connectEmplea() {

    $linke = mysqli_connect("localhost","myEDUKA-TEem","N94ZnA23@E","EDUKA-TEemplea");

    /* check connection */
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    mysqli_set_charset($linkm,"utf8");
    return $linke;

}

function connectDesayuno() {

    $link=mysqli_connect("localhost","myEDUKA-TE","qMtJ7OoD","EDUKA-TE2015wp") or die ("Error de CONEXION");

    /* check connection */
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    mysqli_set_charset($link,"utf8");
    return $link;
}



function connect2014() {

    $link = mysqli_connect("localhost","myEDUKA-TE","qMtJ7OoD","gestion-EDUKA-TE");

    /* check connection */
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    mysqli_set_charset($link,"utf8");
    return $link;
}

function connectAnio($gestion) {
$link = mysqli_connect("edukateccxgs".$gestion.".mysql.db","edukateccxgs".$gestion,"Solutions".$gestion,"edukateccxgs".$gestion);
   // if ($anio == 2019){
  // $link = mysqli_connect("edukateccxgs2019.mysql.db","edukateccxgs2019","Solutions2019","edukateccxgs2019");
//}else
//{$link = mysqli_connect("edukateccxgs2020.mysql.db","edukateccxgs2020","Solutions20","edukateccxgs2020");}

    /* check connection */
    if (!$link)  {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    mysqli_set_charset($link,"utf8");
    return $link;
}


function connect($gestion) {


    $_SESSION['anio'] = $gestion;
    //echo "dentro funcion ".$gestion;

    if ( !isset($_SESSION['anio']) ) {

        if( date("Y") == '2014' ) $gestion = '';
        else $gestion = date("Y");

        $_SESSION['anio'] = date("Y");

    } else {

       if( $_SESSION['anio'] == '2014' ) $gestion = '';
       else $gestion = $_SESSION['anio'];
    }

$link = mysqli_connect("edukateccxgs".$gestion.".mysql.db","edukateccxgs".$gestion,"Solutions".$gestion,"edukateccxgs".$gestion);
//     if ($anio == 2019){
//    $link = mysqli_connect("edukateccxgs2019.mysql.db","edukateccxgs2019","Solutions2019","edukateccxgs2019");
// }else
// {$link = mysqli_connect("edukateccxgs2020.mysql.db","edukateccxgs2020","Solutions20","edukateccxgs2020");}
    /* check connection */
    if (!$link)  {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    mysqli_set_charset($link,"utf8");
    return $link;
}


function obtenerPoblaciones($cp,$link) {

    $q1 = 'SELECT codpostal,poblacion FROM poblaciones WHERE codpostal = '. $cp;
    $q1 = mysqli_query($link,$q1);
    while ($row = mysqli_fetch_array($q1)) {
        echo '<option value="'.($row[poblacion]).'">'.$row[codpostal].' - '.$row[poblacion].'</option>';
    }

}

function obtenerProvincia($cp,$link) {
    $q1 = 'SELECT DISTINCT provincia FROM provincias,poblaciones WHERE poblaciones.id_provincia = provincias.id_provincia AND poblaciones.codpostal = '. $cp;
    $q1 = mysqli_query($link,$q1);
    while ($row = mysqli_fetch_array($q1)) {
        echo '<option value="'.$row[provincia].'">'.$row[provincia].'</option>';
    }
}

function trim_all( $str , $what = NULL , $with = '' )
{
    if( $what === NULL )
    {
        //  Character      Decimal      Use
        //  "\0"            0           Null Character
        //  "\t"            9           Tab
        //  "\n"           10           New line
        //  "\x0B"         11           Vertical Tab
        //  "\r"           13           New Line in Mac
        //  " "            32           Space

        $what   = "\\x00-\\x20";    //all white-spaces and control chars
    }

    return trim( preg_replace( "/[".$what."]+/" , $with , $str ) , $what );
}

function sexoconvierte($dato) {

    $dato = preg_replace('/\s+/', '', $dato);
    $dato = trim_all($dato);

    if ($dato == 'M')
        return "M";
    else if($dato == 'F'){
        return "F";
    }
}
function nifonie($documento) {
    if (is_numeric(substr($documento,0,1)))
        return "10";
    else
        return "60";
}

function adivinaBooleano($dato) {

    if ($dato == '1' OR $dato == 'SI')
        return "true";
    else
        return "false";
}

function adivinaCategoria($cat,$grupo) {
    if ($cat=="") {
        // sacar la categoria por el grupo de cotizacion
        if ($grupo == '8')
            return "1";
        else
            return "2";
    } else {
        switch ($cat) {
            case 'D':
            return '1';
            break;
            case 'MI':
            return '2';
            break;
            case 'T':
            return '3';
            break;
            case 'TC':
            return '4';
            break;
            case 'TBC':
            return '5';
            break;
        }
    }
}

function adivinaEstudios($estudios,$grupo) {
    if ($estudios == "") {
        // sacar los estudios por el grupo de cotizacion
        if ($grupo == '8')
            return '2';
        else
            return '4';
    } else {
        return $estudios;
    }
}

function cambioDeSexo($dato) {
    if ($dato == 'H' || $dato == 'V')
        return 'M';
    else if ($dato == 'M')
        return 'F';
}

function sacarBooleano($dato) {
    if ($dato == '1')
        return "true";
    else
        return "false";
}

function tipoDocumento($tipo) {
    if ($tipo == 'NIF')
        return "10";
    else
        return "60";
}

function mostrarTabla ($tabla,$mat,$link,$id) {

    $sec = basename($_SERVER['HTTP_REFERER'], ".php");

    if ( $tabla == 'docentes' ) {

        $q1 = "SELECT @did:=d.id, d.*,

        (select count(*)
        from docentes d
        inner join mat_doc md on md.id_docente = d.`id`
        where d.id = @did ) as cuenta

        FROM docentes d
        left join mat_doc md on md.id_docente = d.id


        GROUP BY d.id
        ORDER BY cuenta DESC
        LIMIT 0,20";

    }
    else if ( $tabla == 'matriculas') {

        if ( $sec == 'index.php?presencial' )

            $q1 = 'SELECT  m.id, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado, m.solicitud
        FROM matriculas m, acciones a, grupos_acciones ga
        WHERE m.id_accion = a.id
        AND ga.id = m.id_grupo
        AND modalidad = "Presencial"
        AND m.estado NOT IN("Oculto") '.$campos.'
        ORDER BY
        CASE
        WHEN estado = "Creada" THEN 1
        WHEN estado = "Comunicada" THEN 2
        WHEN estado = "Finalizada" THEN 3
        ELSE 4
        END
        LIMIT 0,30';


        else if ( $sec == 'index.php?presencial_doc' )

            $q1 = 'SELECT  m.id, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado, m.solicitud, m.solicitud
        FROM matriculas m, acciones a, grupos_acciones ga
        WHERE m.id_accion = a.id
        AND ga.id = m.id_grupo
        AND modalidad = "Presencial"
        AND m.estado NOT IN ("Anulada","Oculto")'.$campos.'
        ORDER BY m.id DESC
        LIMIT 0,30';

        else if ( $sec == 'index.php?inspeccionpm' )

            $q1 = 'SELECT  m.id, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado, m.solicitud, m.solicitud
        FROM matriculas m, acciones a, grupos_acciones ga
        WHERE m.id_accion = a.id
        AND ga.id = m.id_grupo
        AND modalidad IN ("Presencial","Mixta")
        AND m.estado NOT IN ("Anulada","Oculto")'.$campos.'
        ORDER BY m.id DESC
        LIMIT 0,30';

        else if ( $sec == 'index.php?presencial_docm' )

            $q1 = 'SELECT  m.id, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado, m.solicitud, m.solicitud
        FROM matriculas m, acciones a, grupos_acciones ga
        WHERE m.id_accion = a.id
        AND ga.id = m.id_grupo
        AND modalidad = "Mixta"
        AND m.estado NOT IN ("Anulada","Oculto")'.$campos.'
        ORDER BY id DESC
        LIMIT 0,30';


        else if ( $sec == 'index.php?form_docufinal')

            $q1 = 'SELECT  m.id, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado, m.solicitud, m.solicitud
        FROM matriculas m, acciones a, grupos_acciones ga
        WHERE m.id_accion = a.id
        AND ga.id = m.id_grupo
        AND m.solicitud LIKE "IK%"
        AND modalidad = "Presencial"
        AND m.estado NOT IN ("Anulada","Oculto")'.$campos.'
        union
        SELECT  m.id, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado, m.solicitud, m.solicitud
        FROM matriculas m, acciones a, grupos_acciones ga
        WHERE m.id_accion = a.id
        AND ga.id = m.id_grupo
        AND m.solicitud LIKE "IK%"
        AND modalidad = "Mixta"
        AND m.estado NOT IN ("Anulada","Oculto") '.$campos.'
        ORDER BY id DESC
        LIMIT 0,30';

        else if ( $sec == 'index.php?form_docufinalonlinedist')

            $q1 = 'SELECT  m.id, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado, m.solicitud
        FROM matriculas m, acciones a, grupos_acciones ga
        WHERE m.id_accion = a.id
        AND ga.id = m.id_grupo
        AND m.solicitud LIKE "IK%"
        AND modalidad = "Teleformación"
        AND m.estado NOT IN ("Anulada","Oculto")'.$campos.'
        union
        SELECT  m.id, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado, m.solicitud
        FROM matriculas m, acciones a, grupos_acciones ga
        WHERE m.id_accion = a.id
        AND ga.id = m.id_grupo
        AND m.solicitud LIKE "IK%"
        AND modalidad = "A Distancia"
        AND m.estado NOT IN ("Anulada","Oculto") '.$campos.'
        ORDER BY id DESC
        LIMIT 0,30';

            // $q1 = 'SELECT DISTINCT m.id, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado, m.solicitud, a.modalidad,c.nombrecentro
            // FROM matriculas m, acciones a, grupos_acciones ga, centros c
            // WHERE m.id_accion = a.id
            // AND c.id = m.centro
            // AND ga.id = m.id_grupo
            // AND m.solicitud LIKE "IK%"
            // AND m.estado NOT IN ("Anulada","Oculto")
            // ORDER BY id DESC';

        else if ( $sec == 'index.php?form_listado-cuestionarioikea')

            $q1 = 'SELECT  m.id, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado, m.solicitud, a.modalidad
        FROM matriculas m, acciones a, grupos_acciones ga
        WHERE m.id_accion = a.id
        AND ga.id = m.id_grupo
        AND m.solicitud LIKE "IK%"
        AND m.estado NOT IN ("Anulada","Oculto")'.$campos.'
        ORDER BY id DESC
        LIMIT 0,30';

        else if ( $sec == 'index.php?presencial_fin' )

            $q1 = 'SELECT  m.id, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado, m.solicitud
        FROM matriculas m, acciones a, grupos_acciones ga
        WHERE m.id_accion = a.id
        AND ga.id = m.id_grupo
        AND modalidad = "Presencial"
        AND m.estado NOT IN ("Anulada","Oculto")'.$campos.'
        UNION ALL
        SELECT  m.id, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado, m.solicitud
        FROM matriculas m, acciones a, grupos_acciones ga
        WHERE m.id_accion = a.id
        AND ga.id = m.id_grupo
        AND modalidad = "Mixta"
        AND m.estado NOT IN ("Anulada","Oculto") '.$campos.'
        ORDER BY id DESC
        LIMIT 0,30';

        else if ( $sec == 'index.php?form_matricula_ini' || $sec == 'index.php?form_matricula_doc' || $sec == 'index.php?form_matricula_fin')

            $q1 = 'SELECT  m.id, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado
        FROM matriculas m, acciones a, grupos_acciones ga
        WHERE m.id_accion = a.id
        AND ga.id = m.id_grupo
        AND modalidad IN("Teleformación", "A Distancia")'.$campos.'
        AND m.grupo = 1
        AND m.estado NOT IN ("Oculto")
        ORDER BY id DESC
        LIMIT 0,30';

        else if ( $sec == 'index.php?facturacion' )

            $q1 = 'SELECT m.id, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado, m.solicitud, m.fechafinalizacion
        FROM matriculas m, acciones a, grupos_acciones ga
        WHERE m.id_accion = a.id
        AND ga.id = m.id_grupo
        AND m.estado IN ("Finalizada", "Facturada","Liquidada", "Gratuita")
        AND (numeroaccion < 5000 OR numeroaccion >= 7000)
        AND (m.solicitud NOT LIKE "IK%" OR m.solicitud IS NULL)'.$campos.'
        UNION ALL
        SELECT m.id, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado, m.solicitud, m.fechafinalizacion
        FROM matriculas m, acciones a, grupos_acciones ga
        WHERE m.id_accion = a.id
        AND ga.id = m.id_grupo
        AND m.estado IN ("Comunicada")
        AND (numeroaccion < 5000 OR numeroaccion >= 7000)
        AND (m.solicitud NOT LIKE "IK%" OR m.solicitud IS NULL)'.$campos.'
        AND ga.ngrupo LIKE "%p%"
        ORDER BY fechafinalizacion DESC';

        else if ( $sec == 'index.php?facturacion_ikea' ) {

            if ( $_SESSION[user] != 'root' )
                $q1 = 'SELECT m.id, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado, m.solicitud, m.fechafinalizacion
            FROM matriculas m, acciones a, grupos_acciones ga
            WHERE m.id_accion = a.id
            AND ga.id = m.id_grupo
            AND (m.solicitud LIKE "IK%" OR (numeroaccion >= 6000 AND numeroaccion < 7000))
            AND m.estado IN ("Finalizada", "Facturada","Liquidada", "Gratuita")
            ORDER BY fechafinalizacion DESC';
            else
                $q1 = 'SELECT m.id, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado, m.solicitud, m.fechafinalizacion
            FROM matriculas m, acciones a, grupos_acciones ga
            WHERE m.id_accion = a.id
            AND ga.id = m.id_grupo
            AND (m.solicitud LIKE "IK%" OR (numeroaccion >= 6000 AND numeroaccion < 7000))
            AND m.estado IN ("Finalizada", "Facturada","Liquidada", "Gratuita", "Comunicada")
            ORDER BY fechafinalizacion DESC';

        } else if ( $sec == 'index.php?facturas-rectificativas' )

        $q1 = 'SELECT @idmat:=m.id as mat, ac.modalidad, e.razonsocial, ac.numeroaccion, ga.ngrupo, m.fechaini, m.fechafin, ac.denominacion,
        f.cobrado, f.base_facturacion, f.importe_a_abonar, f.total_factura, f.id as idfac
        FROM acciones ac, empresas e, grupos_acciones ga, matriculas m, mat_alu_cta_emp ma, facturacion_bonificada f
        WHERE ac.id = m.id_accion
        AND e.id = ma.id_empresa
        AND ga.id = m.id_grupo
        AND m.id = ma.id_matricula
        AND ma.id_empresa = e.id
        AND f.matricula = m.id
        AND f.empresa = e.id '.$campos.'
        GROUP BY e.id,m.id
        UNION
        SELECT @idmat:=m.id as mat, ac.modalidad, e.razonsocial, ac.numeroaccion, ga.ngrupo, m.fechaini, m.fechafin, ac.denominacion,
        f.cobrado, f.base_facturacion, f.importe_a_abonar, f.total_factura, f.id as idfac
        FROM acciones ac, empresas e, grupos_acciones ga, matriculas m, mat_alu_cta_emp ma, facturacion_privada f
        WHERE ac.id = m.id_accion
        AND e.id = ma.id_empresa
        AND ga.id = m.id_grupo
        AND m.id = ma.id_matricula
        AND ma.id_empresa = e.id
        AND f.matricula = m.id
        AND f.empresa = e.id'.$campos.'
        GROUP BY e.id,m.id';


        else if ( $sec == 'index.php?mixto' )

            $q1 = 'SELECT m.id, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado, m.solicitud, m.fechaini_nop, m.fechafin_nop
        FROM matriculas m, acciones a, grupos_acciones ga
        WHERE m.id_accion = a.id
        AND ga.id = m.id_grupo
        AND modalidad = "Mixta"
        AND m.estado NOT IN("Oculto")'.$campos.'
        ORDER BY id DESC';

        else if ( $sec == 'index.php?registro-incendios') {

            if ( $gestion == 2014 )

             $q1 = 'SELECT m.id, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado
         FROM matriculas m, acciones a, grupos_acciones ga
         WHERE m.id_accion = a.id
         AND ga.id = m.id_grupo
         AND a.numeroaccion IN (17,18,1001,1006,1017,1027,106)
         AND m.estado IN("Finalizada","Comunicada","Facturada","Liquidada","Gratuita") '.$campos.'
         ORDER BY id DESC';

         else

            $q1 = 'SELECT m.id, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado
        FROM matriculas m, acciones a, grupos_acciones ga
        WHERE m.id_accion = a.id
        AND ga.id = m.id_grupo
        AND a.incendios = 1
        AND m.estado IN("Finalizada","Comunicada","Facturada","Liquidada","Gratuita") '.$campos.'
        ORDER BY id DESC';


    } else if ( $sec == 'index.php?inspeccion')

    $q1 = 'SELECT  m.id, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado,al.nombre, al.apellido, m.solicitud
    FROM matriculas m, acciones a, grupos_acciones ga, alumnos al, mat_alu_cta_emp ma
    WHERE m.id_accion = a.id
    AND ga.id = m.id_grupo
    AND ma.id_matricula = m.id
    AND ma.id_alumno = al.id
    AND modalidad = "Teleformación"
    AND m.grupo IN (0,1)
    AND m.estado NOT IN ("Anulada","Oculto")'.$campos.'
    GROUP BY m.id
    UNION
    SELECT  m.id, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado,
    al.nombre, al.apellido, m.solicitud
    FROM matriculas m, acciones a, grupos_acciones ga, alumnos al, mat_alu_cta_emp ma
    WHERE m.id_accion = a.id
    AND ga.id = m.id_grupo
    AND ma.id_matricula = m.id
    AND ma.id_alumno = al.id
    AND m.grupo IN (0,1)
    AND a.modalidad = "A Distancia"'.$campos.'
    GROUP BY m.id
    ORDER BY id DESC';

    else if ( $sec == 'index.php?tutorias' || $sec == 'index.php?tutoriasext' ) {

                // print_r($_SESSION);

        if ( $_SESSION['user'] == 'margarita' || $_SESSION['user'] == 'root' || $_SESSION['user'] == 'alago' ) {

            $q1 = 'SELECT  m.id, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado, ma.progreso, ma.finalizado,
            al.nombre, al.apellido, al.id as id_alu, a.modalidad, a.url, ma.tipo
            FROM matriculas m, acciones a, grupos_acciones ga, docentes d, mat_doc md, usuarios u, mat_alu_cta_emp ma, alumnos al
            WHERE m.id_accion = a.id
            AND ga.id = m.id_grupo
            AND m.id = md.id_matricula
            AND ma.id_matricula = m.id
            AND ma.id_alumno = al.id
            AND md.id_docente = d.id
            AND a.modalidad = "Teleformación"
            AND d.id = u.id_docente'.$campos.'
            UNION
            SELECT  m.id, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado, ma.progreso, ma.finalizado,
            al.nombre, al.apellido, al.id as id_alu, a.modalidad, a.url, ma.tipo
            FROM matriculas m, acciones a, grupos_acciones ga, docentes d, mat_doc md, usuarios u, mat_alu_cta_emp ma, alumnos al
            WHERE m.id_accion = a.id
            AND ga.id = m.id_grupo
            AND m.id = md.id_matricula
            AND ma.id_matricula = m.id
            AND ma.id_alumno = al.id
            AND md.id_docente = d.id
            AND a.modalidad = "A Distancia"
            AND d.id = u.id_docente'.$campos.'
            UNION
            SELECT  m.id, m.fechaini_nop, m.fechafin_nop, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado, ma.progreso, ma.finalizado,
            al.nombre, al.apellido, al.id as id_alu, a.modalidad, a.url, ma.tipo
            FROM matriculas m, acciones a, grupos_acciones ga, docentes d, mat_doc md, usuarios u, mat_alu_cta_emp ma, alumnos al
            WHERE m.id_accion = a.id
            AND ga.id = m.id_grupo
            AND m.id = md.id_matricula
            AND ma.id_matricula = m.id
            AND ma.id_alumno = al.id
            AND md.id_docente = d.id
            AND a.modalidad = "Mixta"
            AND a.mixta = "Teleformación"
            AND d.id = u.id_docente
            AND m.estado NOT IN ("Anulada", "Creada")
            AND u.user = "'.$_SESSION['user'].'"'.$campos.'
            ORDER BY estado,fechafin,nombre ASC
            LIMIT 0,10';

        } else if ( strpos($_SESSION[user], 'ext_') != -1 ) {

            $q1 = 'SELECT  m.id, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado, ma.progreso, ma.finalizado,
            al.nombre, al.apellido, al.id as id_alu, a.modalidad, a.url, ma.tipo
            FROM matriculas m, acciones a, grupos_acciones ga, docentes d, mat_doc md, usuarios u, mat_alu_cta_emp ma, alumnos al
            WHERE m.id_accion = a.id
            AND ga.id = m.id_grupo
            AND m.id = md.id_matricula
            AND ma.id_matricula = m.id
            AND ma.id_alumno = al.id
            AND md.id_docente = d.id
            AND a.modalidad = "Teleformación"
            AND d.id = u.id_docente
            AND u.user = "'.$_SESSION['user'].'"
            UNION
            SELECT  m.id, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado, ma.progreso, ma.finalizado,
            al.nombre, al.apellido, al.id as id_alu, a.modalidad, a.url, ma.tipo
            FROM matriculas m, acciones a, grupos_acciones ga, docentes d, mat_doc md, usuarios u, mat_alu_cta_emp ma, alumnos al
            WHERE m.id_accion = a.id
            AND ga.id = m.id_grupo
            AND m.id = md.id_matricula
            AND ma.id_matricula = m.id
            AND ma.id_alumno = al.id
            AND md.id_docente = d.id
            AND a.modalidad = "A Distancia"
            AND d.id = u.id_docente
            AND u.user = "'.$_SESSION['user'].'"
            UNION
            SELECT  m.id, m.fechaini_nop, m.fechafin_nop, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado, ma.progreso, ma.finalizado,
            al.nombre, al.apellido, al.id as id_alu, a.modalidad, a.url, ma.tipo
            FROM matriculas m, acciones a, grupos_acciones ga, docentes d, mat_doc md, usuarios u, mat_alu_cta_emp ma, alumnos al
            WHERE m.id_accion = a.id
            AND ga.id = m.id_grupo
            AND m.id = md.id_matricula
            AND ma.id_matricula = m.id
            AND ma.id_alumno = al.id
            AND md.id_docente = d.id
            AND a.modalidad = "Mixta"
            AND a.mixta = "Teleformación"
            AND d.id = u.id_docente
            AND m.estado NOT IN ("Anulada", "Creada")
            AND u.user = "'.$_SESSION['user'].'"
            ORDER BY estado,fechafin,nombre ASC
            LIMIT 0,10';


        } else {

            $q1 = 'SELECT  m.id, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado, ma.progreso, ma.finalizado,
            al.nombre, al.apellido, al.id as id_alu, a.modalidad, a.url, ma.tipo
            FROM matriculas m, acciones a, grupos_acciones ga, docentes d, mat_doc md, usuarios u, mat_alu_cta_emp ma, alumnos al
            WHERE m.id_accion = a.id
            AND ga.id = m.id_grupo
            AND m.id = md.id_matricula
            AND ma.id_matricula = m.id
            AND ma.id_alumno = al.id
            AND md.id_docente = d.id
            AND a.modalidad = "Teleformación"
            AND m.estado NOT IN ("Anulada", "Creada")
            AND d.id = u.id_docente
            AND u.user = "'.$_SESSION['user'].'"
            UNION
            SELECT  m.id, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado, ma.progreso, ma.finalizado,
            al.nombre, al.apellido, al.id as id_alu, a.modalidad, a.url, ma.tipo
            FROM matriculas m, acciones a, grupos_acciones ga, docentes d, mat_doc md, usuarios u, mat_alu_cta_emp ma, alumnos al
            WHERE m.id_accion = a.id
            AND ga.id = m.id_grupo
            AND m.id = md.id_matricula
            AND ma.id_matricula = m.id
            AND ma.id_alumno = al.id
            AND md.id_docente = d.id
            AND a.modalidad = "A Distancia"
            AND d.id = u.id_docente
            AND m.estado NOT IN ("Anulada", "Creada")
            AND u.user = "'.$_SESSION['user'].'"
            UNION
            SELECT  m.id, m.fechaini_nop, m.fechafin_nop, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado,
            al.nombre, al.apellido, al.id as id_alu, a.modalidad, a.url, ma.tipo
            FROM matriculas m, acciones a, grupos_acciones ga, docentes d, mat_doc md, usuarios u, mat_alu_cta_emp ma, alumnos al
            WHERE m.id_accion = a.id
            AND ga.id = m.id_grupo
            AND m.id = md.id_matricula
            AND ma.id_matricula = m.id
            AND ma.id_alumno = al.id
            AND md.id_docente = d.id
            AND a.modalidad = "Mixta"
            AND a.mixta = "Teleformación"
            AND d.id = u.id_docente
            AND m.estado NOT IN ("Anulada", "Creada")
            AND u.user = "'.$_SESSION['user'].'"
            ORDER BY estado,fechafin,nombre ASC';

        }


    } else

    $q1 = 'SELECT  m.id, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado,
    al.nombre, al.apellido, solicitud
    FROM matriculas m, acciones a, grupos_acciones ga, alumnos al, mat_alu_cta_emp ma
    WHERE m.id_accion = a.id
    AND ga.id = m.id_grupo
    AND ma.id_matricula = m.id
    AND ma.id_alumno = al.id
    AND a.modalidad = "Teleformación"
    AND m.estado NOT IN("Oculto")'.$campos.'
    AND m.grupo = 0
    UNION
    SELECT  m.id, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado,
    al.nombre, al.apellido, solicitud
    FROM matriculas m, acciones a, grupos_acciones ga, alumnos al, mat_alu_cta_emp ma
    WHERE m.id_accion = a.id
    AND ga.id = m.id_grupo
    AND ma.id_matricula = m.id
    AND ma.id_alumno = al.id
    AND a.modalidad = "A Distancia"
    AND m.estado NOT IN("Oculto")'.$campos.'
    AND m.grupo = 0
    ORDER BY id DESC';



}

else if ( $tabla == 'mat_alu_cta_emp' )

    $q1 = 'SELECT  a.id as id_alu,a.nombre,a.apellido,a.apellido2,e.razonsocial,e.cif,m.jornadalaboral,ac.modalidad,ga.ngrupo,e.representacionlegal, e.cif, e.id as id, a.email as email_alumno
FROM mat_alu_cta_emp m
INNER JOIN alumnos a ON m.id_alumno = a.id
INNER JOIN empresas e ON m.id_empresa = e.id
INNER JOIN matriculas ma ON ma.id = m.id_matricula
INNER JOIN grupos_acciones ga ON ga.id = ma.id_grupo
INNER JOIN acciones ac ON ma.id_accion = ac.id'.$campos.'
WHERE m.id_matricula = '.$id;

else if ( $tabla == 'mat_doc' )

    $q1 = "SELECT d.id, d.nombre, d.apellido, d.apellido2, d.documento, md.proveedor
FROM docentes d, mat_doc md
WHERE d.id = md.id_docente AND md.id_matricula = ".$id;

else if ( $tabla == 'alumnos' )

    $q1 = 'SELECT * FROM '. $tabla .' ORDER BY id DESC LIMIT 0, 15';

else if ( $tabla == 'ikea_solicitudes' )

    $q1 = 'SELECT t.fechaini as fechaini_sol, t.fechafin as fechafin_sol, t.denominacion as  denominacion_sol, t.modalidad as modalidad_sol, t.id as id_sol
FROM '. $tabla .' t
LEFT JOIN matriculas m ON t.id = m.id_solicitudikea
LEFT JOIN grupos_acciones ga ON ga.id = m.id_grupo
LEFT JOIN acciones a ON a.id = m.id_accion
ORDER BY t.id DESC';

else if ( $tabla == 'empresas' ) {

    if ( $_SESSION['user'] == 'amparo' || $_SESSION['user'] == 'isabel' )
        $q1 = "SELECT e.id, e.nombrecomercial, e.razonsocial, e.cif
    FROM empresas e, comerciales c
    WHERE c.id = e.comercial
    AND c.id IN (3,10,7,12)
    ORDER BY e.id DESC";
    if ( $_SESSION['user'] == 'oscar' )
        $q1 = "SELECT e.id, e.nombrecomercial, e.razonsocial, e.cif
    FROM empresas e, comerciales c
    WHERE c.id = e.comercial
    AND c.id IN (2,3,10,7,12,38,40)
    ORDER BY e.id DESC";
    else if ( strpos($_SESSION[user], 'asociado') )
        $q1 = "SELECT e.id, e.nombrecomercial, e.razonsocial, e.cif
    FROM empresas e, comerciales c
    WHERE c.id = e.comercial
    AND c.id IN (32)
    ORDER BY e.id DESC";
    else if ( $sec == 'index.php?solicitudikea' )
        $q1 = "SELECT e.id, e.nombrecomercial, e.razonsocial, e.cif
    FROM empresas e, grupos_empresas ge
    WHERE ge.id = e.grupo
    AND ge.id = 20
    ORDER BY e.id DESC";
    else if ( stripos($_SESSION['user'], 'comercial') === false )
        $q1 = "SELECT  e.id, e.nombrecomercial, e.razonsocial, e.cif
    FROM empresas e
    WHERE e.comercial NOT IN(8,9)
    ORDER BY e.id DESC";
    else
        $q1 = "SELECT e.id, e.nombrecomercial, e.razonsocial, e.cif
    FROM empresas e, comerciales c, usuarios u
    WHERE u.id_comercial = c.id
    AND c.id = e.comercial
    AND u.user = '".$_SESSION['user']."'
    ORDER BY e.id DESC";

    $q1 .= " LIMIT 0,20";


}   else if ( $tabla == 'peticiones_formativas' ) {

    if ( $_SESSION['user'] == 'isabel' || $_SESSION['user'] == 'amparo' )

        $q1 = "SELECT p.*, c.nombre
        FROM peticiones_formativas p
        INNER JOIN comerciales c ON c.id = p.id_comercial
        WHERE id_comercial IN (3,7,12)";

    // if ( $_SESSION['user'] == 'mnieblacomercial' )

    //     $q1 = "SELECT p.*, c.nombre
    //     FROM peticiones_formativas p
    //     INNER JOIN comerciales c ON c.id = p.id_comercial
    //     WHERE id_comercial IN (38)";

    // if ( $_SESSION['user'] == 'ialonsocomercial' )

    //     $q1 = "SELECT p.*, c.nombre
    //     FROM peticiones_formativas p
    //     INNER JOIN comerciales c ON c.id = p.id_comercial
    //     WHERE id_comercial IN (38)";

    if ( $_SESSION['user'] == 'oscar' )

        $q1 = "SELECT p.*, c.nombre
        FROM peticiones_formativas p
        INNER JOIN comerciales c ON c.id = p.id_comercial
        WHERE id_comercial IN (3,7,12,38,40,4)";

    else if ( $_SESSION['user'] == 'margarita.mitkova' || $_SESSION['user'] == 'margarita' || $_SESSION['user'] == 'root' || $_SESSION['user'] == 'daniel' || $_SESSION['user'] == 'margarita' || $_SESSION['user'] == 'ysuarez' || $_SESSION['user'] == 'alago' || $_SESSION['user'] == 'rmedina' || $_SESSION['user'] == 'cristina' || $_SESSION['user'] == 'ctosco' || $_SESSION['user'] == 'asantana' ) {

        $q1 = "SELECT p.*, c.nombre
        FROM peticiones_formativas p
        INNER JOIN comerciales c ON c.id = p.id_comercial";


    } else if ( $_SESSION[user] == 'efrencomercial' ) {

        $q1 = "SELECT p.*, c.nombre
        FROM peticiones_formativas p
        INNER JOIN comerciales c ON c.id = p.id_comercial
        WHERE id_comercial IN (4)";

    } else if ( $_SESSION[user] == 'ana' ) {

        $q1 = "SELECT p.*, c.nombre
        FROM peticiones_formativas p
        INNER JOIN comerciales c ON c.id = p.id_comercial
        WHERE id_comercial IN (2)";

    } else if ( $_SESSION[user] == 'gyanes' || $_SESSION[user] == 'margarita.mitkova' ) {

        $q1 = "SELECT p.*, c.nombre
        FROM peticiones_formativas p
        INNER JOIN comerciales c ON c.id = p.id_comercial
        WHERE tiposol IN ('SM','SP')";

    } else if ( strpos($_SESSION[user], 'asociado') ) {

        $q1 = "SELECT p.*, c.nombre
        FROM peticiones_formativas p
        INNER JOIN comerciales c ON c.id = p.id_comercial
        WHERE id_comercial IN (32)";

    } else if ( esExterno($_SESSION[user]) ) {

        $q1 = "SELECT p.*,c.nombre
        FROM peticiones_formativas p
        INNER JOIN comerciales c ON c.id = p.id_comercial
        AND id_comercial IN (".$_SESSION[comercial].")";

    } else if ( strpos($_SESSION['user'], 'comercial') !== false ) {

        $q1 = 'SELECT p.*,c.nombre
        FROM peticiones_formativas p
        INNER JOIN comerciales c ON c.id = p.id_comercial
        INNER JOIN usuarios u ON u.id_comercial = c.id
        AND u.user = "'.$_SESSION[user].'"';

    }

    if ( !esExterno($_SESSION[user]) ) {
        $q1 .= '
        ORDER BY id DESC
        LIMIT 0,50';
    }

    // echo $q1;

}


else if ( $tabla == 'peticiones_gastos' ) {


    if ( $_SESSION['user'] == 'cmunoz' || $_SESSION['user'] == 'sdaluz' || $_SESSION['user'] == 'daniel' || $_SESSION['user'] == 'rmedina' || $_SESSION['user'] == 'root' )

        $q1 = 'SELECT CONCAT(tiposol, "", LPAD(numero, 4, 0)), fecha, u.user as nombre, estado, motivogasto, docente, observaciones, p.id
    FROM peticiones_gastos p, usuarios u
    WHERE u.id = p.id_usuario
    ORDER BY p.id DESC';

    else if ( $_SESSION['user'] == 'isabel' || $_SESSION['user'] == 'amparo' )

        $q1 = 'SELECT CONCAT(tiposol, "", LPAD(numero, 4, 0)), fecha, u.user as nombre, estado, motivogasto, docente, observaciones, p.id
    FROM peticiones_gastos p, usuarios u
    WHERE u.id = p.id_usuario AND u.id IN(10,14,34)
    ORDER BY p.id DESC';

    else if ( $_SESSION['user'] == 'oscar' )

        $q1 = 'SELECT CONCAT(tiposol, "", LPAD(numero, 4, 0)), fecha, u.user as nombre, estado, motivogasto, docente, observaciones, p.id
    FROM peticiones_gastos p, usuarios u
    WHERE u.id = p.id_usuario AND u.id IN(10,14,17,34,267,269,17)
    ORDER BY p.id DESC';

    else

        $q1 = 'SELECT CONCAT(tiposol, "", LPAD(numero, 4, 0)), fecha, u.user as nombre, estado, motivogasto, docente, observaciones, p.id
    FROM peticiones_gastos p, usuarios u
    WHERE u.id = p.id_usuario AND u.user = "'.$_SESSION['user'].'"
    ORDER BY p.id DESC';

} else if ( $tabla == 'cursos_tpc' ) {

    if ( $_SESSION['user'] == 'margarita' || $_SESSION['user'] == 'jony' || $_SESSION['user'] == 'root' ) {

        $q1 = 'SELECT c.id, numcurso, a.denominacion, fechaini, fechafin
        FROM cursos_tpc c
        INNER JOIN acciones a ON a.id = c.id_accion';

    }

}

else if ( $tabla == 'acciones' ) {

    if ( $sec  == 'index.php?matricula' ) {

     $q1 = 'SELECT * FROM '. $tabla .' WHERE
     modalidad = "Teleformación" OR modalidad = "Distancia"
     ORDER BY numeroaccion DESC LIMIT 0, 10';

 } else if ( $sec  == 'index.php?presencial' ||  $sec  == 'index.php?presencial_doc' || $sec  == 'index.php?presencial_docm' || $sec  == 'index.php?presencial_fin') {

     $q1 = 'SELECT * FROM '. $tabla .' WHERE
     modalidad = "Presencial" OR modalidad = "Mixta"
     ORDER BY numeroaccion DESC LIMIT 0, 10';

 } else if ( $sec  == 'index.php?mixto' ) {

     $q1 = 'SELECT * FROM '. $tabla .' WHERE
     modalidad = "Mixta"
     ORDER BY numeroaccion DESC LIMIT 0, 10';

 } else if ( $sec  == 'index.php?form_matricula_ini' ) {

    $q1 = 'SELECT * FROM '. $tabla .' WHERE
    modalidad IN("Teleformación","A Distancia")
    ORDER BY numeroaccion DESC LIMIT 0, 10';

} else if ( $sec  == 'index.php?form_control-facturacion-acciones-acre' ) {

 $q1 = 'SELECT * FROM '. $tabla .' ORDER BY numeroaccion DESC LIMIT 0, 40';

} else
$q1 = 'SELECT * FROM '. $tabla .' ORDER BY numeroaccion DESC LIMIT 0, 5';

} else if ($tabla == 'nominas_usuarios'){

    $q1 = "SELECT id, nombre, tipo, CASE activo
    WHEN 0 THEN 'NO'
    WHEN 1 THEN 'SI'
    END AS activo
    FROM nominas_usuarios ORDER BY activo DESC";

} else if($tabla == 'empresas_lopd'){

    $q1 = "SELECT id, razonsocial, cif, nombrecomercial FROM empresas_lopd";

}
else if ( $sec  == 'index.php?comerciales' ) {

    $q1 = 'SELECT * FROM '. $tabla .' WHERE id NOT IN(8,9)';

} else
$q1 = 'SELECT * FROM '. $tabla .' ORDER BY id DESC';

    // echo $q1;

    // TODO: cgutierrez
if ( $_SESSION['user'] == 'root' ){
    echo $q1.'<br>';
    echo $tabla;
}

$q1 = mysqli_query($link,$q1) or die ("error" . mysqli_error($link));
$nrows = mysqli_num_rows($q1);
    // echo $nrows;

if ($mat == '1') $mat = 'mat-';
else if ($mat == '2')
    $mat = 'matp-';
else if ($mat == '3' || $mat == '4')
    $mat = 'matpdoc-';
else if ($mat == '5')
    $mat = 'matpfac-';
else if ($mat == '6')
    $mat = 'matm-';
else if ($mat == '7')
    $mat = 'matt-';
else if ($mat == 'docentempre')
    $mat = 'matmpre-';
else if ($mat == 'docentemod')
    $mat = 'matmpod-';
else if ($mat == '8')
    $mat = 'cert-';
else if ($mat == '9')
    $mat = 'inspec-';
else if ($mat == '10')
    $mat = 'inspecpm-';
else if ($mat == '11')
    $mat = 'matodoc-';
else if ($mat == '12')
    $mat = 'matoini-';
else
    $mat = "";


if ($sec == 'index.php?form_docufinal')
    $mat = 'inspecpm-';

if ($sec == 'index.php?form_docufinalonlinedist')
    $mat = 'inspec-';

if ($sec == 'index.php?form_listado-cuestionarioikea')
    $mat = 'ikeacuest';

if ($sec == 'index.php?facturacion_ikea')
    $mat = 'matpfacikea-';

    // if ($sec == 'index.php?solicitudikea' )
    //     $mat = 'matempikea-';


    // if ( $_SESSION['user'] == 'root' ){
    //     echo '<br>'.$mat;
    //     echo '<br>'.$tabla;
    // }


switch ($tabla) {


    case 'alumnos':
    ?>
    <div class="modal-header camposbusqueda">
        <form role="form" action="" method="post" id="form-modal">
            <input name="tabla" type="hidden" id="tabla" value="alumnos" />
            <input name="matricula" type="hidden" id="matricula" value="<? echo($mat); ?>" />
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label" for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" class="required form-control" />
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label" for="apellido">Apellido:</label>
                    <input type="text" id="apellido" name="apellido" class="required form-control" />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label" for="documento">Nº Documento:</label>
                    <input type="text" id="documento" name="documento" class="required form-control" />
                </div>
            </div>
            <div class="col-md-1">
                <a style="margin-top: 24px; width: 100%" id="busqueda" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></a>
            </div>
        </form>
    </div>

    <div class="modal-body mostrartabla">

        <table class="table table-striped">
            <thead>
                <tr> <!-- AQUI UN SWITCH? !-->
                    <th style="display:none;">ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>2º Apellido</th>
                    <th>Nº Documento</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?
                while ($row = mysqli_fetch_array($q1)) {
                    echo '<tr><td id="id" style="display:none;">';
                    echo($row[id]);
                    echo "</td>";
                    echo "<td id='nombre'>";
                    echo($row[nombre]);
                    echo "</td>";
                    echo "<td id='apellido'>";
                    print($row[apellido]);
                    echo "</td>";
                    echo "<td>";
                    print($row[apellido2]);
                    echo "</td>";
                    echo '<td id="documento">';
                    print($row[documento]);
                    echo "</td>";
                    echo '<td><a id="'.$mat.'seleccionaralumno" name="alumnos" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span> </a></td>';
                    echo '<td><a id="formacionesAlumno" name="alumnos" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-list-alt"></span> </a></td>';
                    if ($_SESSION[user] == 'root')
                        echo '<td><a id="eliminarAlumnoBD" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span> </a></td></tr>';
                    else
                        echo '</tr>';
                } ?>
            </tbody>
        </table></div> <?
        break;


        case 'empresas':
        ?>

        <? if ($sec != 'index.php?solicitudikea') { ?>
        <div class="modal-header camposbusqueda">
            <form role="form" action="" method="post" id="form-modal">
                <input name="tabla" type="hidden" id="tabla" value="empresas" />
                <input name="matricula" type="hidden" id="matricula" value="<? echo($mat); ?>" />


                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label" for="nombrecomercial">Nombre Comercial:</label>
                        <input type="text" id="nombrecomercial" name="nombrecomercial" class="required form-control" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label" for="razonsocial">Nombre Fiscal:</label>
                        <input type="text" id="razonsocial" name="razonsocial" class="required form-control" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label" for="cif">CIF:</label>
                        <input type="text" id="cif" name="cif" class="required form-control" />
                    </div>
                </div>

                <div class="clearfix"></div>
                <div style="margin-top:10px"></div>

                <div class="col-md-3">
                    <div class="form-group">
                     <label class="control-label" for="comercial">Comercial:</label>
                     <select id="comercial" name="comercial" class="form-control">
                        <?

                        devuelveComercialesBusqueda($_SESSION[user], $link);

                        ?>
                    </select>
                </div>
            </div>

            <? if ($gestion != "") { ?>
            <div class="col-md-2">
                <div class="form-group">
                 <label class="control-label" for="agente">Agente:</label>
                 <select id="agente" name="agente" class="form-control">
                    <?


                    echo '<option value="">Cualquiera</option>';
                    $q = 'SELECT nombre
                    FROM agentes';
                    $q = mysqli_query($link, $q) or die("error:" .mysqli_error($link));
                        // echo mb_strtoupper($_SESSION[user]);
                        // echo $q;
                    while ( $row = mysqli_fetch_array($q) )  {

                        if ( $row[nombre] == ucfirst($_SESSION[user]) || $_SESSION[user] == 'daniel' || $_SESSION[user] == 'rmedina' || $_SESSION[user] == 'root' )
                            echo '<option value="'.$row[nombre].'">'.$row[nombre].'</option>';
                    }


                    ?>
                </select>
            </div>
        </div>
        <? } ?>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label" for="grupo">Grupo:</label>
                <select id="grupo" name="grupo" class="form-control">
                    <?
                    $q = 'SELECT id, grupo
                    FROM grupos_empresas ORDER by id ASC';
                    $q = mysqli_query($link,$q);
                    echo '<option value="">Sin grupo</option>';
                    while ($row = mysqli_fetch_array($q))
                        echo '<option value="'.$row['id'].'">'.$row['grupo'].'</option>';
                    ?>
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label" for="categoria">Categoría:</label>
                <select id="categoria" name="categoria" class="form-control">
                    <?
                    $q = 'SELECT id, categoria
                    FROM categorias_empresa ORDER by id ASC';
                    $q = mysqli_query($link,$q);
                    echo '<option value="">Cualquiera</option>';
                    while ($row = mysqli_fetch_array($q))
                        echo '<option value="'.$row['id'].'">'.$row['categoria'].'</option>';
                    ?>
                </select>
            </div>
        </div>

        <div class="col-md-1">
            <a style="margin-top: 24px;" id="busqueda" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></a>
        </div>
    </form>
</div>

<? } ?>
<div class="modal-body mostrartabla">

    <table class="table table-striped">
        <thead>
            <tr> <!-- AQUI UN SWITCH? !-->
                <th style="display:none;">ID</th>
                <th>Empresa</th>
                <th>Nombre Fiscal</th>
                <th>CIF</th>
                <th></th>
                <? if ($_SESSION[user] == 'root') echo '<th></th>'; ?>
            </tr>
        </thead>
        <tbody>
            <?
            while ($row = mysqli_fetch_array($q1)) {
                echo '<tr><td id="id" style="display:none;">';
                echo($row[id]);
                echo "</td>";
                echo "<td>";
                echo($row[nombrecomercial]);
                echo "</td>";
                echo '<td id="empresa">';
                print($row[razonsocial]);
                echo "</td>";
                echo '<td>';
                print($row[cif]);
                echo "</td>";
                echo '<td><a id="'.$mat.'seleccionarempresa" name="empresas" href="#" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span> </a></td>';
                echo '<td><a id="formacionesEmpresa" name="empresas" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-list-alt"></span> </a></td>';
                if ($_SESSION[user] == 'root')
                    echo '<td><a id="eliminarEmpresaBD" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span> </a></td></tr>';
                else
                    echo '</tr>';
            } ?>
        </tbody>
    </table></div> <?
    break;

    case 'acciones':
    ?>

    <div class="modal-header camposbusqueda">
        <form role="form" action="" method="post" id="form-modal">
            <input name="tabla" type="hidden" id="tabla" value="acciones" />
            <input name="matricula" type="hidden" id="matricula" value="<? echo($mat); ?>" />
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label" for="numeroaccion">Número Acción:</label>
                        <input type="text" id="numeroaccion" name="numeroaccion" class="required form-control" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label" for="denominacion">Nombre Acción:</label>
                        <input type="text" id="denominacion" name="denominacion" class="required form-control" />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label" for="modalidad">Modalidad:</label>
                        <select id="modalidad" name="modalidad" class="form-control">
                            <option value="">Cualquiera</option>
                            <? if ( $sec  == 'index.php?presencial' || $sec  == 'index.php?accion' ) { ?>
                            <option value="Presencial">Presencial</option> <? } ?>
                            <? if ( $sec  == 'index.php?matricula' || $sec  == 'index.php?accion' || $sec == 'index.php?form_matricula_ini') { ?>
                            <option value="A Distancia">A Distancia</option>
                            <option value="Teleformación">Teleformación</option> <? } ?>
                            <option value="Mixta">Mixta</option>
                        </select>
                    </div>
                </div>
            </div>

            <br>

            <!--MODIFICACION OCTAVIO 4/4/2017-->
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label" for="diploma">Tipo Formacion:</label>
                        <select id="diplomatipo" name="diploma" class="form-control">
                            <option value="">-</option>
                            <option value="VIN">VIN</option>
                            <option value="ESSSCAN">ESSSCAN</option>
                            <option value="DESA">DESA</option>
                            <option value="LEGIONELLA">LEGIONELLA</option>
                            <option value="DINOSOL">DINOSOL</option>
                            <option value="TPC">TPC</option>
                            <option value="TPCF">TPC Fundación</option>
                        </select>
                    </div>
                </div>
                <!--TERMINA MODIFICACION-->

                <div class="col-md-1">
                    <a style="margin-top: 24px;" id="busqueda" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></a>
                </div>
            </div>
        </form>
    </div>

    <div class="modal-body mostrartabla">

        <table class="table table-striped">
            <thead>
                <tr> <!-- AQUI UN SWITCH? !-->
                    <th style="display:none;">ID</th>
                    <th>Nº Acción</th>
                    <th>Nombre Acción</th>
                    <th>Modalidad</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?
                while ($row = mysqli_fetch_array($q1)) {
            // if ($row[numeroaccion] != "0") {
                    echo '<tr><td id="id" style="display:none;">';
                    echo($row[id]);
                    echo "</td>";
                    echo "<td>";
                    echo($row[numeroaccion]);
                    echo "</td>";
                    echo "<td>";
                    print($row[denominacion]);
                    echo "</td>";
                    echo '<td id="modalidad">';
                    print($row[modalidad]);
                    echo "</td>";
                    echo '<td><a id="'.$mat.'seleccionaraccion" name="acciones" href="#" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span> </a></td></tr>';
            // }
                } ?>
            </tbody>
        </table></div> <?
        break;


        case 'docentes':

        ?>
        <div class="modal-header camposbusqueda">
            <form role="form" action="" method="post" id="form-modal">
                <input name="tabla" type="hidden" id="tabla" value="docentes" />
                <input name="matricula" type="hidden" id="matricula" value="<? echo($mat); ?>" />
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label" for="nombre">Nombre Docente / Proveedor:</label>
                            <input type="text" id="nombre" name="nombre" class="required form-control" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label" for="apellido">Apellido:</label>
                            <input type="text" id="apellido" name="apellido" class="required form-control" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label" for="especialidades">Especialidades:</label><br>
                        <select class="form-control" id="especialidad" name="especialidad" >
                            <?
                            $q = 'SELECT id,especialidad FROM especialidades';
                            $q = mysqli_query($link,$q);

                            echo '<option value="">Cualquiera</option>';
                            while ($row = mysqli_fetch_array($q))
                                echo '<option value="'.$row['id'].'">'.$row['especialidad'].'</option>';
                            ?>
                        </select>
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label" for="documento">DNI Docente / CIF Proveedor</label>
                            <input type="text" name="documento" id="documento" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <a style="margin-top: 24px;" id="busqueda" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></a>
                    </div>
                </div>

            </form>
        </div>

        <div class="modal-body mostrartabla">

            <table class="table table-striped">
                <thead>
                    <tr> <!-- AQUI UN SWITCH? !-->
                        <th style="display:none;">ID</th>
                        <th>Nombre </th>
                        <th>Apellido</th>
                        <th>Proveedor</th>
                        <th>Especialidades</th>
                        <th></th>
                        <? if ( $_SESSION[user] == 'rmedina' || $_SESSION[user] == 'root' || $_SESSION[user] == 'daniel' || $_SESSION[user] == 'rmedina' || $_SESSION[user] == 'margarita' || $_SESSION[user] == 'margarita.mitkova' ) ?>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?
                    while ($row = mysqli_fetch_array($q1)) {
                        echo '<tr><td id="id" style="display:none;">';
                        echo($row[id]);
                        echo "</td>";

                        if ( $row['tipodoc'] == "Persona" || $row['tipodoc'] == "" ) {

                            echo '<td id="nombre">';
                            echo($row[nombre]);
                            echo "</td>";
                            echo '<td id="apellido">';
                            echo($row[apellido]);
                            echo "</td>";
                            echo '<td id="proveedor">';
                            echo('-');
                            echo "</td>";

                        } else if ( $row['tipodoc'] == "Empresa" ) {

                            echo '<td id="nombredocente">';
                            echo($row[nombredocente]);
                            echo "</td>";
                            echo '<td id="apellidodocente">';
                            echo($row[apellidodocente]);
                            echo "</td>";
                            echo '<td id="proveedor">';
                            echo($row[nombre]);
                            echo "</td>";

                        }

                        echo '<td style="width:25%; font-size:10px;" id="especialidad">';
                        if ( $row[especialidad] == '0' ) echo 'Sin especialidad';
                        else echo ($row[especialidad]);
                        echo "</td>";
                        echo '<td><a id="'.$mat.'seleccionardocente" name="docentes" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span> </a></td>';
                        if ( $_SESSION[user] == 'sdaluz' || $_SESSION[user] == 'root' || $_SESSION[user] == 'daniel' || $_SESSION[user] == 'rmedina' || $_SESSION[user] == 'margarita' || $_SESSION[user] == 'javier' || $_SESSION[user] == 'margarita.mitkova' || $_SESSION[user] == 'cmunoz' )
                            echo '<td><a id="docentesacuerdos" name="docentes" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-list-alt"></span> </a></td></tr>';
                        else
                            echo '</tr>';
                    } ?>
                </tbody>
            </table></div> <?
            break;

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
                        <a style="margin-top: 24px; width:100%;" id="restablecer-matonline" class="btn btn-default"><span class="glyphicon glyphicon-repeat"></span></a>
                    </div>

                    <div class="clearfix"></div>

                    <div style="margin-top: 10px;">

                        <? if ( $sec == 'index.php?tutorias' ) {

                            if ( $_SESSION['user'] == 'margarita' || $_SESSION['user'] == 'root' ) { ?>

                            <div class="col-md-4">
                                <div class="form-group">
                                 <label class="control-label" for="docente">Docente:</label>
                                 <select id='docente' name='docente' class="form-control">
                                    <?
                                    $q = 'SELECT id, nombre, apellido
                                    FROM docentes WHERE dmodalidad IN( "Teleformación", "Todas" )
                                    ORDER by id ASC';
                                    $q = mysqli_query($link,$q);
                                    echo '<option value="">Cualquiera</option>';
                                    while ($row = mysqli_fetch_array($q))
                                        echo '<option value="'.$row['id'].'">'.$row['nombre'].' '.$row['apellido'].' </option>';
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                             <label class="control-label" for="comercial">Comercial:</label>
                             <select id="comercial" name="comercial" class="form-control">
                                <?
                                $q = 'SELECT id,nombre,apellido,apellido2
                                FROM comerciales ORDER by id ASC';
                                $q = mysqli_query($link,$q);
                                echo '<option value="">Cualquiera</option>';
                                while ($row = mysqli_fetch_array($q))
                                    echo '<option value="'.$row['id'].'">'.$row['nombre'].' '.$row['apellido'].' '.$row['apellido2'].'</option>';
                                ?>
                            </select>
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
                                <option value="Gratuita">Gratuita</option>
                                <option value="Facturada">Facturada</option>
                                <option value="Liquidada">Liquidada</option>
                                <option value="Anulada">Anulada</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1 col-md-offset-1">
                        <a style="margin-top: 24px; width: 100%" id="busqueda" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></a>
                    </div>
                </form>
            </div>

            <? } else { ?>

            <div class="col-md-3">
                <div class="form-group">
                 <label class="control-label" for="comercial">Comercial:</label>
                 <select id="comercial" name="comercial" class="form-control">
                    <?
                    $q = 'SELECT id,nombre,apellido,apellido2
                    FROM comerciales ORDER by id ASC';
                    $q = mysqli_query($link,$q);
                    echo '<option value="">Cualquiera</option>';
                    while ($row = mysqli_fetch_array($q))
                        echo '<option value="'.$row['id'].'">'.$row['nombre'].' '.$row['apellido'].' '.$row['apellido2'].'</option>';
                    ?>
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label" for="estado">Estado:</label>
                <select id="estado" name="estado" class="form-control" >
                    <option value="">Cualquiera</option>
                    <option value="Creada">Creada</option>
                    <option value="Comunicada">Comunicada</option>
                    <option value="Finalizada">Finalizada</option>
                    <option value="Gratuita">Gratuita</option>
                    <option value="Facturada">Facturada</option>
                    <option value="Liquidada">Liquidada</option>
                    <option value="Anulada">Anulada</option>
                </select>
            </div>
        </div>
        <div class="pull-right col-md-1">
            <a style="margin-top: 24px; width: 100%" id="busqueda" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></a>
        </div>
    </form>
</div>



<? }

} else { ?>



<?  if ( $sec == 'index.php?matricula' ) { ?>

<div class="col-md-4">
    <div class="form-group">
        <label class="control-label" for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" class="required form-control" />
    </div>
</div>
<div class="col-md-4">
    <div class="form-group">
        <label class="control-label" for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" class="required form-control" />
    </div>
</div>
<div class="col-md-4">
    <div class="form-group">
        <label class="control-label" for="apellido2">Apellido 2:</label>
        <input type="text" id="apellido2" name="apellido2" class="required form-control" />
    </div>
</div>
<div class="clearfix"></div>
<? } ?>

<div style="margin-top:10px;overflow:auto">
    <? if ( $sec != 'index.php?form_docufinal' ) { ?>
    <div class="col-md-3">
        <div class="form-group">
         <label class="control-label" for="comercial">Comercial:</label>
         <select id="comercial" name="comercial" class="form-control">
            <?
            $q = 'SELECT id,nombre,apellido,apellido2
            FROM comerciales ORDER by id ASC';
            $q = mysqli_query($link,$q);
            echo '<option value="">Cualquiera</option>';
            while ($row = mysqli_fetch_array($q))
                echo '<option value="'.$row['id'].'">'.$row['nombre'].' '.$row['apellido'].' '.$row['apellido2'].'</option>';
            ?>
        </select>
    </div>
</div>
<? } ?>

<? if ( $sec == 'index.php?form_docufinal' ) { ?>
<div class="col-md-6">
    <div class="form-group">
     <label class="control-label" for="centro">Centro:</label>
     <select id="centro" name="centro" class="form-control">
        <?
        $q = 'SELECT id,nombrecentro
        FROM centros
        WHERE nombrecentro LIKE "IKEA%"';
        $q = mysqli_query($link,$q);
        echo '<option value="">Cualquiera</option>';
        while ($row = mysqli_fetch_array($q))
            echo '<option value="'.$row['id'].'">'.$row['nombrecentro'].'</option>';
        ?>
    </select>
</div>
</div>

<? } ?>
<div class="col-md-3">
    <div class="form-group">
        <label class="control-label" for="estado">Estado:</label>
        <select id="estado" name="estado" class="form-control" >
            <option value="">Cualquiera</option>
            <option value="Creada">Creada</option>
            <option value="Comunicada">Comunicada</option>
            <option value="Finalizada">Finalizada</option>
            <option value="Gratuita">Gratuita</option>
            <option value="Facturada">Facturada</option>
            <option value="Liquidada">Liquidada</option>
            <option value="Anulada">Anulada</option>
        </select>
    </div>
</div>
<? if ( $sec != 'index.php?form_docufinal' ) { ?>
<div class="col-md-3">
    <div class="form-group">
     <label class="control-label" for="meses">Mes Finalización:</label>
     <select id="meses" name="meses" class="form-control" >
        <option value="">Cualquiera</option>
        <option value="1"> Enero </option> <option value="2"> Febrero </option> <option value="3"> Marzo </option> <option value="4"> Abril </option> <option value="5"> Mayo </option> <option value="6"> Junio </option> <option value="7"> Julio </option> <option value="8"> Agosto </option> <option value="9"> Septiembre </option> <option value="10"> Octubre </option> <option value="11"> Noviembre </option> <option value="12"> Diciembre </option>
    </select>
</div>
</div>
<div class="col-md-1">
    <div class="form-group">
        <label class="control-label" for="solicitud">Tipo:</label>
        <select id="solicitud" name="solicitud" class="form-control">
            <option value="">Cualquiera</option>
            <option value="IKEA">IKEA</option>
            <option value="EDUKA-TE">EDUKA-TE</option>
            <option value="DINOSOL">DINOSOL</option>
            <option value="CCC">CCC</option>
        </select>
    </div>
</div>

<div class="col-md-2">
    <div class="form-group">
        <label class="control-label" for="tipo">Bonificado:</label>
        <select id="tipo" name="tipo" class="form-control">
            <option value="">Cualquiera</option>
            <option value="bonificado">Bonificado</option>
            <option value="privado">Privado</option>
        </select>
    </div>
</div><? } ?>


<? if ( $sec == 'index.php?presencial' || $sec == 'index.php?presencial_doc' || $sec  == 'index.php?presencial_docm' || $sec == 'index.php?presencial_fin' || $sec == 'index.php?mixto' ) { ?>

</div>
<div style="margin-top:10px">
    <div class="col-md-6">
        <div class="form-group">
         <label class="control-label" for="centro">Centro:</label>
         <select id="centro" name="centro" class="form-control">
            <?
            $q = 'SELECT id,nombrecentro
            FROM centros';
            $q = mysqli_query($link,$q);
            echo '<option value="">Cualquiera</option>';
            while ($row = mysqli_fetch_array($q))
                echo '<option value="'.$row['id'].'">'.$row['nombrecentro'].'</option>';
            ?>
        </select>
    </div>
</div>
</div>

<? } ?>

<div class="col-md-1">
    <a style="margin-top: 24px; width: 100%" id="busqueda" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></a>
</div>
</div>

</form>
</div>

<?  } ?> </div>

<? if ( $sec == 'index.php?tutorias' ) { ?>

<div class="modal-body mostrartabla">

    <table id="tablamatriculas" class="table table-striped">
        <thead>
            <tr> <!-- AQUI UN SWITCH? !-->
                <th style="display:none;">ID</th>
                <th>Acción</th>
                <th>Denominación</th>
                <th>Alumno</th>
                <th>Modalidad</th>
                <th>Progreso</th>
                <th>Estado</th>
                <th>Inicio</th>
                <th>Fin</th>
                <th>Plataforma</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?


            while ($row = mysqli_fetch_array($q1)) {
                echo '<tr style="font-size: 12px" class="'; echo colorFinalizacion($row[estado], $row[tipo]); echo '"><td id="id" style="display:none;">';
                echo($row[id]);
                echo "</td>";
                echo "<td>";
                echo($row[numeroaccion].'/'.$row[ngrupo]);
                echo "</td>";
                echo '<td style="width:35%">';
                print($row[denominacion]);
                echo "</td>";
                echo '<td style="width:25%">';
                print($row[nombre].' '.$row[apellido]);
                echo "</td>";
                echo "<td>". $row[modalidad] ."</td>";
                echo '<td style="width: 15%">';
                print($row[progreso].'% | ');

                if ($row[finalizado] == '0') echo 'En Progreso';
                else if ($row[finalizado] == '1') echo 'Finalizado';
                else echo 'NO Finalizado';

                echo "</td>";
                echo "<td>";
                print($row[estado]);
                echo "</td>";
                echo "<td>";
                print(date("d/m/Y", strtotime($row[fechaini])));
                echo "</td>";
                echo '<td>';
                print(date("d/m/Y", strtotime($row[fechafin])));
                echo "</td>";
                echo '<td>';
                if ( strpos($row[url], 'ecampus') !== FALSE )
                    echo 'Moodle';
                else
                    echo 'System';
                echo '</td>';
                echo '<td><a id="'.$mat.'seleccionarmat" id_alu="'. $row[id_alu] .'" name="matriculas" href="#" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span> </a></td></tr>';
            } ?>
        </tbody>
    </table></div>

    <? } else {  ?>

    <div class="modal-body mostrartabla">

        <table id="tablamatriculas" class="table table-striped">
            <thead>
                <tr> <!-- AQUI UN SWITCH? !-->
                    <th <? if ( $_SESSION[user] != 'root') echo 'style="display:none;"' ?>>ID</th>
                    <th>Acción</th>
                    <th>Denominación</th>
                    <? if ( $sec == 'index.php?form_docufinal' ) { ?>
                    <th>Modalidad</th>
                    <th>Centro</th> <? } ?>
                    <? if ( $sec == 'index.php?matricula' ) { ?>
                    <th>Alumno</th> <? } ?>
                    <th>Estado</th>
                    <th>Inicio</th>
                    <th>Fin</th>
                    <th></th>
                    <? if ($_SESSION[user] == 'root') echo '<th></th>'; ?>
                </tr>
            </thead>
            <tbody>
                <?

                $i = 0;
                while ($row = mysqli_fetch_array($q1)) {


                    echo '<tr style="font-size: 12px" class="'; echo colorSeguimientoEstado($row[estado]); echo '">
                    <td id="id"';
                    if ($_SESSION[user] != 'root') echo 'style="display:none;">';
                    else echo '>';
                    echo($row[id]);
                    echo "</td>";
                    echo "<td id='af'>";
            // echo $row[solicitud];
                    if ( strpos($row[solicitud],'IK') !== FALSE )
                        $ikea = ' <strong>IKEA</strong> ';
                    else $ikea = '';
                    echo($ikea . '<strong>'.$row[numeroaccion].'/'.$row[ngrupo].'</strong>');
                    echo "</td>";
                    echo '<td id="denominacion" style="width:35%">';
                    print($row[denominacion]);
                    echo "</td>";
                    if ( $sec == 'index.php?form_docufinal' ) {
                        echo "<td id='modalidad'>";
                        print($row[modalidad]);
                        echo "</td>";
                        echo "<td id='centro'>";
                        print($row[nombrecentro]);
                        echo "</td>";
                    }
                    if ( $sec == 'index.php?matricula' ) {
                        echo '<td style="width:25%">';
                        print($row[nombre].' '.$row[apellido]);
                        echo "</td>"; }

                        echo "<td id='estado'>";

                        if ( $sec == 'index.php?presencial_fin' || $sec == 'index.php?form_matricula_fin' ) {

                            $estado = devuelveNoFinBonif($row[estado], $row[ngrupo], $row[numeroaccion]);
                            echo $estado;

                        } else
                        echo($row[estado]);

                        echo "</td>";


                        echo "<td id='fechaini'>";
                        print(date("d/m/Y", strtotime($row[fechaini]))).'<br>';
                        if ( $row[fechaini_nop] != "" && $row[fechaini_nop] != "0000-00-00" ) print(date("d/m/Y", strtotime($row[fechaini_nop])).' O/D');
                        echo "</td>";
                        echo '<td id="fechafin">';
                        print(date("d/m/Y", strtotime($row[fechafin]))).'<br>';
                        if ( $row[fechafin_nop] != "" && $row[fechafin_nop] != "0000-00-00" ) print(date("d/m/Y", strtotime($row[fechafin_nop])).' O/D');
                        echo "</td>";

                        echo '<td><a id="'.$mat.'seleccionarmat" name="matriculas" href="#" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span> </a></td>';
                        if ($_SESSION[user] == 'root') {
                            echo '<td><a id="eliminarMatriculaIndBD" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span> </a></td>';
                        } else
                        echo '</tr>';

                    } ?>
                </tbody>
            </table>
            <?
        // if ( $sec == 'index.php?facturacion' && $_SESSION['user'] == 'root' ) {

        //         echo '<div style="margin-right: 2px;" class="col-md-2 pull-right"><a id="facturartodo" class="btn btn-success"><span class="glyphicon glyphicon-list-alt"></span> Facturar todo</a></div>
        //         <div class="clearfix"></div>';

        //     }
            ?>

        </div> <? }

        break;

        case 'mat_alu_cta_emp':
        ?>
        <!-- <div class="modal-header camposbusqueda">
            <form role="form" action="" method="post" id="form-modal">
                <input name="tabla" type="hidden" id="tabla" value="matriculas" />  !-->
            <input name="matricula" type="hidden" id="matricula" value="<? echo($mat); ?>" /> <!--
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
            </form>
        </div> -->

        <div class="modal-body mostrartabla">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="display:none;">ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Empresa</th>
                        <th>CIF</th>
                        <th>RLT</th>
                        <th>Plataforma</th>
                        <th>Credenciales</th>
                        <th>Jornada</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?


                    while ($row = mysqli_fetch_array($q1)) {
                        echo '<tr><td id="id" style="display:none;">';
                        echo($row[id_alu]);
                        echo "</td>";
                        echo "<td>";
                        echo($row[nombre]);
                        echo "</td>";
                        echo "<td>";
                        print($row[apellido]);
                        echo "</td>";
                        echo "<td>";
                        print($row[razonsocial]);
                        echo "</td>";
                        echo "<td>";
                        print($row[cif]);
                        echo "</td>";
                        echo "<td>";
                        if ( $row[representacionlegal] == 1)
                            print('<a target="_blank" href="http://gestion.eduka-te.com/app/documentacion/rltpremix.php?id_mat='.$id.'&tipo=O&id_emp='.$row[id].'">RLT</a>');
                        echo "</td>";

                //tsuptrip - bonificado - 1806
                //TutorEDUKA-TE1 - privado - 1807

                // $denominacion = "Formador de Formadores";
                        $denominacion = $row[denominacionsystem];

                        if ( strpos($row[ngrupo], "p") )
                            $tutor = '1807';
                        else
                            $tutor = '1806';

                        $target = 'target = "_blank"';
                        $plataforma = 'System';
                        $pass = normaliza($row[nombre][0]).trim(normaliza($row[apellido])).substr($row[documento], 4,4);

                        $row[denominacion] = "Excel%202010%20Inicial";

                        $megaurl = 'http://plataformateleformacion.com/Profesor/procesos/alumadd.php?Nombre='.$row[nombre].'&Apellidos='.$row[apellido].' '.$row[apellido2].'&Direccion='.$row[direccion].'&Poblacion='.$row[poblacion].'&Provincia='.$row[provincia].'&CP='.$row[codpostal].'&Telefono=&Email='.$row[email].'&Pais=&Empresa=&Cif=&Pass='.$pass.'&Pass2='.$pass.'&Accion='.$row[numeroaccion].'&Grupo='.$row[ngrupo].'&Tutor='.$tutor.'&Dia_FechaInicio='.date("d",strtotime($row[fechaini])).'&Mes_FechaInicio='.date("m",strtotime($row[fechaini])).'&Ano_FechaInicio='.date("Y",strtotime($row[fechaini])).'&Dia_FechaTermino='.date("d",strtotime($row[fechafin])).'&Mes_FechaTermino='.date("m",strtotime($row[fechafin])).'&Ano_FechaTermino='.date("Y",strtotime($row[fechafin])).'&Tipo=T&MandarCuest=0&Cursos%5B%5D='.$denominacion.'&Horas%5B%5D='.$row[horastotales].'&NumTema%5B%5D=99';

                // $megaurl = 'http://www.plataformateleformacion.com/Profesor/procesos/alumadd.php?Nombre='.rawurlencode(($row[nombre])).'&Apellidos='.rawurlencode(($row[apellido])).' '.rawurlencode(($row[apellido2])).'&Direccion='.$row[direccion].'&Poblacion='.$row[poblacion].'&Provincia='.$row[provincia].'&CP='.$row[codpostal].'&Telefono=&Email='.$row[email_alumno].'&Pais=&Empresa=&Cif=&Pass='.$pass.'&Pass2='.$pass.'&Accion='.$row[numeroaccion].'&Grupo='.$row[ngrupo].'&Tutor=1807&Dia_FechaInicio='.date("d",strtotime($row[fechaini])).'&Mes_FechaInicio='.date("m",strtotime($row[fechaini])).'&Ano_FechaInicio='.date("Y",strtotime($row[fechaini])).'&Dia_FechaTermino='.date("d",strtotime($row[fechafin])).'&Mes_FechaTermino='.date("m",strtotime($row[fechafin])).'&Ano_FechaTermino='.date("Y",strtotime($row[fechafin])).'&Tipo=T&MandarCuest=0&Cursos%5B%5D='.$row[denominacion].'&Horas%5B%5D='.$row[horastotales].'&NumTema%5B%5D=99&Tutorizacion=NO&NoRestarBonos=1&NoRestarAlumnos=1';

                        $url = explode('.com/', $row[url]);
                // echo $url[1][0];
                if ( $url[1][0] != 'a'  ) { // MOODLE

                    $plataforma = 'Moodle';
                    $megaurl = '';
                    $target = '';
                    $user = 'alum';
                    $anio = strftime('%y', strtotime($row[fechaini]));
                    $mes = strftime('%m', strtotime($row[fechaini]));
                    $user .= $anio.$mes.substr($row[documento], 1,4);
                    $pass = strtoupper(normaliza($row[nombre][0])).trim(normaliza($row[apellido])).substr($row[documento], 4,4);
                }

                echo( '<td><a '.$target.' id_alu="'.$row[id_alu].'" href="'.$megaurl.'" id="anadirAlumno'.$plataforma.'" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-share"></span> '. $plataforma .' </a></td>');

                echo '<td>';
                if ($row[modalidad] == 'Teleformación') {
                    print('<a style="width:100%" href="#" data-toggle=modal id="btncredenciales" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-asterisk"></span> Generar</a>'); }
                    echo "</td>";
                    echo '<td style="text-align:center">';
                    echo('<input class="jornada" type="checkbox"'); if ($row[jornadalaboral] == '1') echo (' checked = "checked" />');
                    echo "</td>";
                    echo '<td><a target="_blank" id="'.$mat.'seleccionaralumnomat" name="matriculas" href="#" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span> </a></td></tr>';
                } ?>
            </tbody>
        </table></div> <?
        break;

        case 'mat_doc':
        ?>
        <!-- <div class="modal-header camposbusqueda">
            <form role="form" action="" method="post" id="form-modal">
                <input name="tabla" type="hidden" id="tabla" value="matriculas" /> !-->
            <input name="matricula" type="hidden" id="matricula" value="<? echo($mat); ?>" /> <!--
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
            </form>
        </div> -->

        <div class="modal-body mostrartabla">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="display:none;">ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>2º Apellido</th>
                        <th>Documento</th>
                        <th>Proveedor</th>
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
                        echo($row[nombre]);
                        echo "</td>";
                        echo "<td>";
                        print($row[apellido]);
                        echo "</td>";
                        echo "<td>";
                        print($row[apellido2]);
                        echo "</td>";
                        echo '<td>';
                        print($row[documento]);
                        echo "</td>";
                        echo '<td><a id="'.$mat.'seleccionardocentemat" name="matriculas" href="#" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span> </a></td></tr>';
                    } ?>
                </tbody>
            </table></div> <?
            break;

            case 'comisionistas':
            ?>

            <div class="modal-header camposbusqueda">
                <form role="form" action="" method="post" id="form-modal">
                    <input name="tabla" type="hidden" id="tabla" value="comisionistas" />
                    <input name="matricula" type="hidden" id="matricula" value="<? echo($mat); ?>" />
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label" for="nombre">Nombre:</label>
                            <input type="text" id="nombre" name="nombre" class="required form-control" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label" for="comercial">Comercial:</label><br>
                            <select class="form-control" id="comercial" name="comercial" >
                                <?

                                devuelveComercialesBusqueda($_SESSION[user],$link);

                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="control-label" for="tipocomisionista">Tipo:</label><br>
                            <select class="form-control" id="tipocomisionista" name="tipocomisionista" >
                                <?
                                echo '<option value="">Cualquiera</option>';
                                echo '<option value="Asesoria">Asesoría</option>';
                                echo '<option value="Agente">Agente</option>';
                                echo '<option value="Colaborador">Colaborador</option>';
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label" for="nifcif">NIF/CIF:</label>
                            <input type="text" id="nifcif" name="nifcif" class="required form-control" />
                        </div>
                    </div>
                    <div class="col-md-1">
                        <a style="margin-top: 24px;" id="busqueda" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></a>
                    </div>
                </form>
            </div>


            <div class="modal-body mostrartabla">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="display:none;">ID</th>
                            <th>Tipo</th>
                            <th>Nombre</th>
                            <th>Teléfono</th>
                            <th>Comercial</th>
                            <th>Contacto</th>
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
                        echo($row[tipocomisionista]);
                        echo "</td>";
                        echo "<td>";
                        echo($row[nombre]);
                        echo "</td>";
                        echo "<td>";
                        print($row[telefono]);
                        echo "</td>";
                        echo "<td>";
                        print($row[email]);
                        echo "</td>";
                        echo '<td>';
                        print($row[contacto]);
                        echo "</td>";
                        echo '<td><a id="seleccionarcomisionista" name="matriculas" href="#" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span> </a></td></tr>';
                    } ?>
                </tbody>
            </table></div> <?
            break;


            case 'comerciales':
            ?>
            <input name="matricula" type="hidden" id="matricula" value="<? echo($mat); ?>" />

            <div class="modal-body mostrartabla">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="display:none;">ID</th>
                            <th>Nombre</th>
                            <th>Teléfono</th>
                            <th>Email</th>
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
                        echo($row[nombre].' '.$row[apellido].' '.$row[apellido2]);
                        echo "</td>";
                        echo "<td>";
                        print($row[telefono]);
                        echo "</td>";
                        echo "<td>";
                        print($row[email]);
                        echo "</td>";
                        echo '<td><a id="seleccionarcomercial" name="matriculas" href="#" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span> </a></td></tr>';
                    } ?>
                </tbody>
            </table></div> <?
            break;



            case 'acreedores':
            ?>

            <div class="modal-header camposbusqueda">
                <form role="form" action="" method="post" id="form-modal">
                    <input name="tabla" type="hidden" id="tabla" value="comisionistas" />
                    <input name="matricula" type="hidden" id="matricula" value="<? echo($mat); ?>" />
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label" for="razonsocial">Acreedor:</label>
                            <input type="text" id="razonsocial" name="razonsocial" class="required form-control" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label" for="tipoacreedor">Tipo Acreedor:</label><br>
                            <select class="form-control" id="tipoacreedor" name="tipoacreedor" >
                                <?

                                echo '<option value="">Cualquiera</option>';
                                echo '<option value="Docente">Docente</option>';
                                echo '<option value="Acreedor">Acreedor</option>';
                                echo '<option value="Proveedor">Proveedor</option>';
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label" for="cif">CIF:</label>
                            <input type="text" id="cif" name="cif" class="required form-control" />
                        </div>
                    </div>
                    <div class="col-md-1">
                        <a style="margin-top: 24px;" id="busqueda" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></a>
                    </div>
                </form>
            </div>

            <div class="modal-body mostrartabla">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="display:none;">ID</th>
                            <th>Tipo</th>
                            <th>Acreedor</th>
                            <th>CIF</th>
                            <th>Teléfono</th>
                            <th>Email</th>
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
                        print($row[tipoacreedor]);
                        echo "</td>";
                        echo "<td>";
                        echo($row[razonsocial]);
                        echo "</td>";
                        echo "<td>";
                        print($row[cif]);
                        echo "</td>";
                        echo "<td>";
                        print($row[telefono]);
                        echo "</td>";
                        echo "<td>";
                        print($row[email]);
                        echo "</td>";
                        echo '<td><a id="seleccionaracreedor" name="matriculas" href="#" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span> </a></td></tr>';
                    } ?>
                </tbody>
            </table></div> <?
            break;


            case 'ikea_solicitudes':
            ?>
            <!-- <input name="matricula" type="hidden" id="matricula" value="<? echo($mat); ?>" />  -->

            <div class="modal-body mostrartabla">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="display:none;">ID</th>
                            <th>Nº</th>
                            <th>AF</th>
                            <th>Materia</th>
                            <th>Tipo</th>
                            <th>Denominación</th>
                            <th>Modalidad</th>
                            <th>Horas</th>
                            <th>Fechas</th>
                            <th>Lugar</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody style="font-size:12px">
                       <?


                       while ($row = mysqli_fetch_array($q1)) {

                        $barra = '';
                        $color = colorSeguimientoIKEA($row[estadosolikea]);
                        if ( $color == "warning" ) $pendiente = 'font-weight: bold'; else $pendiente = '';
                        echo '<tr class="'.$color.'" style="'.$pendiente.'"><td id="id" style="display:none;">';
                        echo($row[id_sol]);
                        echo "</td>";
                        echo "<td>";
                        echo($row[numero]);
                        echo "</td>";
                        if ( $row[numeroaccion] != "" ) $barra = '/';
                        echo "<td>";
                        echo($row[numeroaccion].$barra.$row[ngrupo]);
                        echo "</td>";
                        echo "<td>";
                        echo($row[materia]);
                        echo "</td>";
                        echo "<td>";
                        echo($row[tipoformacionikea]);
                        echo "</td>";
                        echo "<td>";
                        print($row[denominacion_sol]);
                        echo "</td>";
                        echo "<td>";
                        print($row[modalidad_sol]);
                        echo "</td>";
                        echo "<td>";
                        print($row[horastotales]);
                        echo "</td>";
                        echo '<td style="width:10%">';
                        print(formateaFecha($row[fechaini_sol]).' <br> '.formateaFecha($row[fechafin_sol]));
                        echo "</td>";
                        echo "<td>";
                        print($row[lugar]);
                        echo "</td>";
                        echo '<td>';
                        print(formateaFecha($row[fecha_peticion]));
                        echo "</td>";
                        echo '<td>';
                        print($row[estadosolikea]);
                        echo "</td>";
                        echo '<td><a id="seleccionarsolicitud" name="matriculas" href="#" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span> </a></td></tr>';
                    } ?>
                </tbody>
            </table></div> <?
            break;


            case 'peticiones_formativas':
            ?>
            <!-- <input name="matricula" type="hidden" id="matricula" value="<? echo($mat); ?>" />  -->

            <div style="margin-top:0px" class="modal-header camposbusqueda">
                <form role="form" action="" method="post" id="form-modal">
                    <input name="tabla" type="hidden" id="tabla" value="peticiones_formativas" />
                    <input name="matricula" type="hidden" id="matricula" value="<? echo($mat); ?>" />
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label" for="modalidad">Modalidad:</label><br>
                            <select class="form-control" id="modalidad" name="modalidad" >
                                <?

                                echo '<option value="">Cualquiera</option>';
                                echo '<option value="Presencial">Presencial</option>';
                                echo '<option value="Teleformación">Teleformación</option>';
                                echo '<option value="Mixta">Mixta</option>';

                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label" for="tiposol">Tipo Solicitud:</label><br>
                            <select class="form-control" id="tiposol" name="tiposol" >
                                <?

                                echo '<option value="">Cualquiera</option>';
                                echo '<option value="SM">Matrícula</option>';
                                echo '<option value="SC">Crédito</option>';
                                echo '<option value="SP">Propuesta</option>';
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label" for="estado_peticion">Estado:</label><br>
                            <select class="form-control" id="estado_peticion" name="estado_peticion" >
                                <?

                                echo '<option value="">Cualquiera</option>';
                                echo '<option value="Pendiente">Pendiente</option>';
                                echo '<option value="Aceptada">Aceptada</option>';
                                echo '<option value="Resuelta">Resuelta</option>';
                                echo '<option value="Realizada">Realizada</option>';
                                echo '<option value="Anulada">Anulada</option>';

                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="control-label" for="numero">Número:</label>
                            <input type="text" id="numero" name="numero" class="required form-control" />
                        </div>
                    </div>
                    <div class="col-md-1">
                        <a style="margin-top: 24px;" id="busqueda" style="pointer-events:none" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></a>
                    </div>
                    <div class="clearfix"></div>
                    <? if ( !esExterno($_SESSION['user']) ) { ?>
                    <div class="col-md-3" style="margin-top: 15px">
                        <div class="form-group">
                         <label class="control-label" for="id_comercial">Comercial:</label>
                         <select id="id_comercial" name="id_comercial" class="form-control">
                            <?

                            devuelveComercialesBusqueda($_SESSION[user], $link);

                            ?>
                        </select>
                    </div>
                </div>
                <? } ?>
                <div class="col-md-3" style="margin-top: 15px">
                    <div class="form-group">
                        <label class="control-label" for="mes">Mes de Inicio:</label>
                        <select id="mes" name="mes" class="form-control" >
                            <option value="">Cualquiera</option>
                            <option value="01">Enero</option>
                            <option value="02">Febrero</option>
                            <option value="03">Marzo</option>
                            <option value="04">Abril</option>
                            <option value="05">Mayo</option>
                            <option value="06">Junio</option>
                            <option value="07">Julio</option>
                            <option value="08">Agosto</option>
                            <option value="09">Septiembre</option>
                            <option value="10">Octubre</option>
                            <option value="11">Noviembre</option>
                            <option value="12">Diciembre</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4" style="margin-top: 15px">
                    <div class="form-group">
                        <label class="control-label" for="empresas">Empresa:</label>
                        <input type="text" id="empresas" name="empresas" class="form-control" />
                    </div>
                </div>
            </form>
        </div>

        <div class="modal-body mostrartabla">

            <table style="" class="table table-striped">
                <thead>
                    <tr>
                        <th style="display:none;">ID</th>
                        <th>Nº</th>
                        <!-- <th>Solicitud</th> -->
                        <th>AF</th>
                        <th>Tipo</th>
                        <th style="width:5%">Comercial</th>
                        <th style="width:25%">Denominación</th>
                        <th style="width:20%">Empresas</th>
                        <th>Modalidad</th>
                        <th>Horas</th>
                        <th>Fechas</th>
                        <!-- <th>Estado</th> -->
                        <th>Fecha Solicitud</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody style="font-size: 12px">
                   <?


                   while ($row = mysqli_fetch_array($q1)) {

                    if ( $row[tiposol] == 'SM' ) {
                // echo "EY";
                        $qn = 'SELECT numeroaccion, ngrupo, grupo, p.empresas
                        FROM matriculas m, acciones a, grupos_acciones ga, peticiones_formativas p
                        WHERE m.id_accion = a.id
                        AND m.id_grupo = ga.id
                        AND p.id = m.id_solicitud
                        AND p.id = '.$row[id];
                // echo $qn;
                        $qn = mysqli_query($link, $qn) or die("error:" .mysqli_error($link));

                        $rowz = mysqli_fetch_array($qn);
                        if ( $rowz[grupo] == 1 ) $grupo = " (G)"; else $grupo = "";

                    } else unset($rowz);

                    $color = colorSeguimientoIKEA($row[estado_peticion]);
                    echo '<tr class="'.$color.'" style="'.$pendiente.'"><td id="id" style="display:none;">';
                    echo($row[id]);
                    echo "</td>";
                    echo "<td>";
                    echo($row[tiposol].$row[numero]);
                    echo "</td>";
            // echo "<td>";
            // if ( $row[tiposol] == "SM" )
            //     echo "Matrícula";
            // else if ( $row[tiposol] == "SC" )
            //     echo "Crédito";
            // else
            //     echo "<strong>Propuesta</strong>";
            // echo "</td>";
                    echo "<td>";
                    if ( count($rowz) > 0 ) echo $rowz[numeroaccion].'/'.$rowz[ngrupo].$grupo;
                    echo "</td>";
                    echo "<td>";
                    echo($row[tipoformacionpropuesta]);
                    echo "</td>";
                    echo "<td>";
                    echo($row[nombre]);
                    echo "</td>";
                    echo "<td>";
                    if ( $row[tiposol] == "SC" )
                        print($row[cif]);
                    else
                        print($row[formacion]);
                    echo "</td>";
                    echo "<td>";
                    print($row[empresas]);
                    echo "</td>";
            // echo "<td>".$rowz[empresas]."</td>";
                    echo "<td>";
                    print($row[modalidad]);
                    echo "</td>";
                    echo "<td>";
                    print($row[horastotales]);
                    echo "</td>";
                    echo '<td style="text-align:center;width:20%">';
                    if ( $row[tiposol] == "SC" )
                        echo(" - ");
                    else if ( $row[fechaini] == "0000-00-00" || $row[fechafin] == "0000-00-00" )
                        echo(" - ");
                    else
                        print(formateaFecha($row[fechaini]).' - '.formateaFecha($row[fechafin]));
                    echo "</td>";
            // echo "<td>";
            // print($row[estado_peticion]);
            // echo "</td>";
                    echo "<td>";
                    print(formateaFecha($row[fecha_peticion]));
                    echo "</td>";
                    echo '<td><a id="seleccionarsolicitudpeti" name="peticiones_formativas" href="#" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span> </a></td></tr>';
                } ?>
            </tbody>
        </table></div> <?
        break;


        case 'propuestas_formativas':
        ?>
        <!-- <input name="matricula" type="hidden" id="matricula" value="<? echo($mat); ?>" />  -->

        <div class="modal-body mostrartabla">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="display:none;">ID</th>
                        <th>Nº</th>
                        <th>Tipo</th>
                        <th>Denominación</th>
                        <th>Modalidad</th>
                        <th>Horas</th>
                        <th>Fechas</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody style="font-size: 12px">
                   <?


                   while ($row = mysqli_fetch_array($q1)) {
                    echo '<tr><td id="id" style="display:none;">';
                    echo($row[id]);
                    echo "</td>";
                    echo "<td>";
                    echo('P'.$row[numero]);
                    echo "</td>";
                    echo "<td>";
                    echo($row[tipoformacionpropuesta]);
                    echo "</td>";
                    echo "<td>";
                    print($row[formacion]);
                    echo "</td>";
                    echo "<td>";
                    print($row[modalidad]);
                    echo "</td>";
                    echo "<td>";
                    print($row[horastotales]);
                    echo "</td>";
                    echo '<td style="width:20%">';
                    print(formateaFecha($row[fechaini]).' - '.formateaFecha($row[fechafin]));
                    echo "</td>";
                    echo '<td><a id="seleccionarsolicitudprop" name="peticiones_formativas" href="#" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span> </a></td></tr>';
                } ?>
            </tbody>
        </table></div> <?
        break;


        case 'ikea_tiendas':
        ?>
        <!-- <input name="matricula" type="hidden" id="matricula" value="<? echo($mat); ?>" />  -->

        <div class="modal-body mostrartabla">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="display:none;">ID</th>
                        <th>Tienda</th>
                        <th>Población</th>
                        <th>Jefe de Tienda</th>
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
                    echo($row[tienda]);
                    echo "</td>";
                    echo "<td>";
                    print($row[poblacion]);
                    echo "</td>";
                    echo "<td>";
                    print($row[jefetienda]);
                    echo "</td>";
                    echo '<td><a id="seleccionartienda" name="matriculas" href="#" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span> </a></td></tr>';
                } ?>
            </tbody>
        </table></div> <?
        break;


        case 'peticiones_gastos':

            ?>
            <div style="display:none;margin-top:0px" class="modal-header camposbusqueda">
                <form role="form" action="" method="post" id="form-modal">
                    <input name="tabla" type="hidden" id="tabla" value="peticiones_formativas" />
                    <input name="matricula" type="hidden" id="matricula" value="<? echo($mat); ?>" />
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label" for="modalidad">Modalidad:</label><br>
                            <select class="form-control" id="modalidad" name="modalidad" >
                                <?

                                echo '<option value="">Cualquiera</option>';
                                echo '<option value="Presencial">Presencial</option>';
                                echo '<option value="Teleformación">Teleformación</option>';
                                echo '<option value="Mixta">Mixta</option>';

                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label" for="tiposol">Tipo Solicitud:</label><br>
                            <select class="form-control" id="tiposol" name="tiposol" >
                                <?

                                echo '<option value="">Cualquiera</option>';
                                echo '<option value="SM">Matrícula</option>';
                                echo '<option value="SC">Crédito</option>';
                                echo '<option value="SP">Propuesta</option>';
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label" for="estado_peticion">Estado:</label><br>
                            <select class="form-control" id="estado_peticion" name="estado_peticion" >
                                <?

                                echo '<option value="">Cualquiera</option>';
                                echo '<option value="Pendiente">Pendiente</option>';
                                echo '<option value="Aceptada">Aceptada</option>';
                                echo '<option value="Resuelta">Resuelta</option>';
                                echo '<option value="Realizada">Realizada</option>';
                                echo '<option value="Anulada">Anulada</option>';

                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="control-label" for="numero">Número:</label>
                            <input type="text" id="numero" name="numero" class="required form-control" />
                        </div>
                    </div>
                    <div class="col-md-1">
                        <a style="margin-top: 24px;" id="busqueda" style="pointer-events:none" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-3" style="margin-top: 15px">
                        <div class="form-group">
                            <label class="control-label" for="id_comercial">Comercial:</label>
                            <select id="id_comercial" name="id_comercial" class="form-control">
                            <?

                            devuelveComercialesBusqueda($_SESSION[user], $link);

                            ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3" style="margin-top: 15px">
                        <div class="form-group">
                            <label class="control-label" for="mes">Mes de Inicio:</label>
                            <select id="mes" name="mes" class="form-control" >
                                <option value="">Cualquiera</option>
                                <option value="01">Enero</option>
                                <option value="02">Febrero</option>
                                <option value="03">Marzo</option>
                                <option value="04">Abril</option>
                                <option value="05">Mayo</option>
                                <option value="06">Junio</option>
                                <option value="07">Julio</option>
                                <option value="08">Agosto</option>
                                <option value="09">Septiembre</option>
                                <option value="10">Octubre</option>
                                <option value="11">Noviembre</option>
                                <option value="12">Diciembre</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>

            <?

            $headers = array('Número', 'Fecha Petición', 'Usuario', 'Estado', 'Motivo', 'Docente', 'Observaciones', '');

            while ($row = mysqli_fetch_assoc($q1)) {
                $datos[] = $row;
            }

            arrayTable($headers, $datos, false, true, 'seleccionargasto', 'peticiones_gastos');

        break;


        case 'cursos_tpc':

            ?>
            <div style="display:none;margin-top:0px" class="modal-header camposbusqueda">
                <form role="form" action="" method="post" id="form-modal">
                    <input name="tabla" type="hidden" id="tabla" value="peticiones_formativas" />
                    <input name="matricula" type="hidden" id="matricula" value="<? echo($mat); ?>" />
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label" for="modalidad">Modalidad:</label><br>
                            <select class="form-control" id="modalidad" name="modalidad" >
                                <?

                                echo '<option value="">Cualquiera</option>';
                                echo '<option value="Presencial">Presencial</option>';
                                echo '<option value="Teleformación">Teleformación</option>';
                                echo '<option value="Mixta">Mixta</option>';

                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label" for="tiposol">Tipo Solicitud:</label><br>
                            <select class="form-control" id="tiposol" name="tiposol" >
                                <?

                                echo '<option value="">Cualquiera</option>';
                                echo '<option value="SM">Matrícula</option>';
                                echo '<option value="SC">Crédito</option>';
                                echo '<option value="SP">Propuesta</option>';
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label" for="estado_peticion">Estado:</label><br>
                            <select class="form-control" id="estado_peticion" name="estado_peticion" >
                                <?

                                echo '<option value="">Cualquiera</option>';
                                echo '<option value="Pendiente">Pendiente</option>';
                                echo '<option value="Aceptada">Aceptada</option>';
                                echo '<option value="Resuelta">Resuelta</option>';
                                echo '<option value="Realizada">Realizada</option>';
                                echo '<option value="Anulada">Anulada</option>';

                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="control-label" for="numero">Número:</label>
                            <input type="text" id="numero" name="numero" class="required form-control" />
                        </div>
                    </div>
                    <div class="col-md-1">
                        <a style="margin-top: 24px;" id="busqueda" style="pointer-events:none" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-3" style="margin-top: 15px">
                        <div class="form-group">
                         <label class="control-label" for="id_comercial">Comercial:</label>
                         <select id="id_comercial" name="id_comercial" class="form-control">
                            <?

                            devuelveComercialesBusqueda($_SESSION[user], $link);

                            ?>
                        </select>
                    </div>
                    </div>
                    <div class="col-md-3" style="margin-top: 15px">
                        <div class="form-group">
                            <label class="control-label" for="mes">Mes de Inicio:</label>
                            <select id="mes" name="mes" class="form-control" >
                                <option value="">Cualquiera</option>
                                <option value="01">Enero</option>
                                <option value="02">Febrero</option>
                                <option value="03">Marzo</option>
                                <option value="04">Abril</option>
                                <option value="05">Mayo</option>
                                <option value="06">Junio</option>
                                <option value="07">Julio</option>
                                <option value="08">Agosto</option>
                                <option value="09">Septiembre</option>
                                <option value="10">Octubre</option>
                                <option value="11">Noviembre</option>
                                <option value="12">Diciembre</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>

            <?

            $headers = array('Número', 'Curso', 'Fecha Inicio', 'Fecha Fin', '');

            while ($row = mysqli_fetch_assoc($q1)) {
                $datos[] = $row;
            }

            arrayTable($headers, $datos, false, true, 'seleccionartpc', 'cursos_tpc');

            ?>

            </tbody>
            </table></div> <?


        break;

        //MODIFICACION 18/4/2017
        case 'nominas_usuarios':?>

            <div style="display:none;margin-top:0px" class="modal-header nominasusuarios">
                <form role="form" action="" method="post" id="form-modal">
                    <input name="tabla" type="hidden" id="tabla" value="nominas_usuarios" />
                </form>
            </div>
            </div>

            <?

            $headers = array('Nombre', 'Tipo', 'Activo', '');

            while ($row = mysqli_fetch_assoc($q1)) {
                $datos[] = $row;
            }

            arrayTable($headers, $datos, false, true, 'seleccionarnominasusuarios', 'nominas_usuarios');

        break;
    //TERMINA MODIFICACION

    //MODIFICACION 28/4/2017
    case 'empresas_lopd':?>

        <div style="display:none;margin-top:0px" class="modal-header empresaslopd">
            <form role="form" action="" method="post" id="form-modal">
                <input name="tabla" type="hidden" id="tabla" value="empresas_lopd" />
            </form>
        </div>

        <?

        $headers = array('Razon social', 'CIF', 'Nombre comercial', '');

        while ($row = mysqli_fetch_assoc($q1)) {
            $datos[] = $row;
        }

        arrayTable($headers, $datos, false, true, 'seleccionarempresaslopd', 'empresas_lopd');

    break;
    //TERMINA MODIFICACION
    }


}

function uncheckboxes($table_name, $form_data) {

    switch ($table_name) {
        case 'alumnos':
        if (!isset($form_data['afectadosviolenciagenero']))
            $form_data['afectadosviolenciagenero'] = "0";
        if (!isset($form_data['afectadosterrorismo']))
            $form_data['afectadosterrorismo'] = "0";
        if (!isset($form_data['discapacidad']))
            $form_data['discapacidad'] = "0";
        break;

        case 'empresas':
        if (!isset($form_data['mailing']))
            $form_data['mailing'] = "0";
        if (!isset($form_data['empresacreada']))
            $form_data['empresacreada'] = "0";
        if (!isset($form_data['representacionlegal']))
            $form_data['representacionlegal'] = "0";
        break;

        case 'docentes':
        if (!isset($form_data['docenteinterno']))
            $form_data['docenteinterno'] = "0";
        break;
    }
    return $form_data;
}

function compruebaDocumento ($documento, $table_name, $link) {
    $q1 = 'SELECT documento FROM ' .$table_name.' WHERE documento = "'.$documento.'"';
    $q1 = mysqli_query($link,$q1);
    if (mysqli_num_rows($q1) > 0)
        return $existe = "1";
}

function compruebaCIF ($documento, $table_name, $link) {
    $q1 = 'SELECT cif FROM ' .$table_name.' WHERE cif = "'.$documento.'"';
    //echo $q1;
    $q1 = mysqli_query($link,$q1);
    if (mysqli_num_rows($q1) > 0)
        return $existe = "1";
}

function compruebaNumAccion ($accion, $table_name, $link) {
    $q1 = 'SELECT numeroaccion FROM ' .$table_name.' WHERE numeroaccion = "'.$accion.'"';
    $q1 = mysqli_query($link,$q1);
    if (mysqli_num_rows($q1) > 0)
        return $existe = "1";
}

function insertar($table_name, $form_data, $link) {

    $form_data = uncheckboxes ($table_name, $form_data);

    switch ($table_name) {

        case 'alumnos':
        $existe = compruebaDocumento($form_data['documento'],$table_name, $link);
        break;

        case 'empresas':

            // $datosEmpresa = array();
        $contactos = array();
            // for ($i = 0; $i < sizeof($form_data[values]); $i++) {
                // $datosEmpresa[$form_data[values][$i][name]] = $form_data[values][$i][value];
            // }
        $existe = compruebaCIF($form_data['cif'],$table_name, $link);
        $cuentas = array();
        $cuentas = explode(",",$form_data['numeroscuenta']);
        echo $cuentas;
        unset($form_data['numeroscuenta']);
        unset($form_data['modifcuentas']);
        print_r($form_data);
        $form_data[razonsocial] = trim($form_data[razonsocial]);
            // $sql = "INSERT INTO empresas_reportes
            // (`".implode('`,`', $fields)."`)
            // VALUES('".implode("','", $form_data)."')";
            // echo $sql;
            // mysqli_query($link,$sql);

        break;

        case 'acciones':
        $existe = compruebaNumAccion($form_data['numeroaccion'],$table_name, $link);
        $form_data[contenido] = addslashes($form_data[contenido]);
        $form_data[objetivos] = addslashes($form_data[objetivos]);
        break;

        case 'docentes':
            // $existe = compruebaDocumento($form_data['documento'],$table_name, $link);
        $modifespecialidad = $form_data['modifespecialidad'];
        unset($form_data['modifespecialidad']);
        $especialidades = array();
        $especialidades = explode(",", $form_data['especialidades']);
        print_r($form_data['especialidades']);
        print_r($especialidades);
        unset($form_data['especialidades']);
        break;

        case 'ikea_solicitudes':

        $id_empresas = array();
        $id_empresas = $form_data[id_empresa];
        $nalus = $form_data[nalus];

        $q = 'SELECT MAX(numero) as maximo
        FROM ikea_solicitudes';
        $q = mysqli_query($link, $q) or die("error:" .mysqli_error($link));

        $row = mysqli_fetch_array($q);
        $max = $row[maximo]+1;
        $form_data[numero] = str_pad($max, 4, '0', STR_PAD_LEFT);

        unset($form_data['id_empresa']);
        unset($form_data['nalus']);

        break;

        case 'peticiones_gastos':

        $q = 'SELECT MAX(numero) as maximo
        FROM peticiones_gastos';
        $q = mysqli_query($link, $q) or die("error:" .mysqli_error($link));

        $row = mysqli_fetch_array($q);
        $max = $row[maximo]+1;
        $form_data[numero] = str_pad($max, 4, '0', STR_PAD_LEFT);

            // unset($form_data['id_empresa']);
            // unset($form_data['nalus']);

        break;


    }

    //echo "existe: ".$existe;
    if ($existe != '1') {
        $fields = array_keys($form_data);

        if ( $form_data[razonsocial] != "" )
            $form_data[razonsocial] = trim($form_data[razonsocial]);

        if ( $form_data[objetivos] != "" )
            $form_data[objetivos] = addslashes($form_data[objetivos]);

        if ( $form_data[contenido] != "" )
            $form_data[contenido] = addslashes($form_data[contenido]);

        if ( $form_data[domiciliosocial] != "" )
            $form_data[domiciliosocial] = addslashes($form_data[domiciliosocial]);

        if ( $form_data[domiciliofiscal] != "" )
            $form_data[domiciliofiscal] = addslashes($form_data[domiciliofiscal]);

        $sql = "INSERT INTO ".$table_name."
        (`".implode('`,`', $fields)."`)
        VALUES('".implode("','", $form_data)."')";
        // echo $sql;
        $result=mysqli_query($link,$sql) or die("error: ".mysqli_error($link));
        $id = mysqli_insert_id($link);


        if ( false===$result ) {
            printf("error: %s\n", mysqli_error($link));
            $resul['error'] = mysqli_error($link);
        }

        if ($table_name == 'docentes' && $modifespecialidad == '1') {

            $coma = ",";
            for ($i=0; $i < sizeof($especialidades); $i++) {
                if( $i == sizeof($especialidades)-1 )
                    $coma = "";
                $values .= " (".$id.",".$especialidades[$i].")".$coma;
            }
            $sql = 'INSERT INTO docente_especialidad (id_docente,id_especialidad) VALUES '.$values;
            mysqli_query($link,$sql);
        }


        // CREA USUARIO DE APLICACION PARA EL NUEVO DOCENTE DE TELEFORMACION
        if ( $table_name == 'docentes' && ( $form_data['dmodalidad'] == 'Teleformación' || $form_data['dmodalidad'] == 'Distancia') ) {

            if (strpos($form_data[nombre], ' ')) {
                $nombretutor = explode(' ', $form_data[nombre]);
                $nombre = $nombretutor[0];
            } else {
                $nombre = $form_data[nombre];
            }

            $user = normaliza(strtolower($nombre.'tutor'));
            $pass = md5($form_data['documento'].'@eduka-te');
            $q = 'INSERT INTO usuarios
            (user, pass, id_docente)
            VALUES ("'.$user.'","'.$pass.'","'.$id.'")';
            mysqli_query($link,$q);
        }

        if ($table_name == 'empresas' ) {

            if ($id != 0) {
                $coma = ",";
                for ($i=0; $i < sizeof($cuentas); $i++) {
                    if( $i == sizeof($cuentas)-1 )
                        $coma = "";
                    $values .= " (".$id.",".substr($cuentas[$i], 0,9).")".$coma;
                }
                $sql = 'INSERT INTO cuentascotizacion (id_empresa,numerocuenta) VALUES '.$values;
                // echo $sql;
                mysqli_query($link,$sql) or die("error". mysqli_error($link));
                return $id;
            }
        }

        if ( $table_name == 'ikea_solicitudes' ) {

            $coma = ',';
            if ( sizeof($id_empresas) > 0 ) {

                for ($i = 0; $i < sizeof($id_empresas); $i++) {

                    if ($i == sizeof($id_empresas) - 1)
                        $coma = "";
                    $empresas .= ' ("' . $id . '","' . $id_empresas[$i] . '","' . $nalus[$i] . '")' . $coma;
                }


                $q1 = 'INSERT IGNORE INTO temp_empresas_ikea
                (id_solicitud, id_empresa, nalus)
                VALUES ' . $empresas;
                // echo $q1 . "<br>";
                $q1 = mysqli_query($link,$q1) or die("error insertando empresa: ".mysqli_error($link));

            }

            envioMailIKEA($form_data[numero], '', 'ikea_solicitudes', $link, $id);


        }

        if ( $table_name == 'peticiones_gastos' ) {

            $resul['id'] = $id;
            echo json_encode($resul);
            enviarMailNotif($form_data['tiposol'].$form_data['numero'], $form_data['observaciones'], 'nueva-peticion-gasto', $link, $form_data['id_usuario'], $_SESSION['user']);

        }

        if ( $table_name == 'cursos_tpc' ) {

            $resul['id'] = $id;
            echo json_encode($resul);

        }



    } else echo "1";
}

function actualizar($table_name, $form_data, $link) {

    $modifcuentas = $form_data['modifcuentas'];
    $modifespecialidad = $form_data['modifespecialidad'];
    unset($form_data['modifcuentas']);
    unset($form_data['modifespecialidad']);
    $id_empresas = array();
    $id_empresas = $form_data[id_empresa];

    unset($form_data['id_empresa']);

    $form_data = uncheckboxes ($table_name, $form_data);


    if ( $table_name == 'peticiones_gastos' ) {

        $qorig = 'SELECT *
        FROM peticiones_gastos
        WHERE id = '.$form_data[id];
        // echo $qorig;
        $qorig = mysqli_query($link, $qorig) or die("error" . mysqli_error($link));

        $roworig = mysqli_fetch_array($qorig);
        // $nalus = $form_data[nalus];
        // unset($form_data['nalus']);

    }

    if ( $table_name == 'ikea_solicitudes' ) {

        $qorig = 'SELECT *
        FROM ikea_solicitudes
        WHERE id = '.$form_data[id];
        // echo $qorig;
        $qorig = mysqli_query($link, $qorig) or die("error" . mysqli_error($link));

        $roworig = mysqli_fetch_array($qorig);
        $nalus = $form_data[nalus];
        unset($form_data['nalus']);

    }

    if ($table_name == 'docentes') {
        $especialidades = array();
        $especialidades = explode(",", $form_data['especialidades']);
        unset($form_data['especialidades']);

        // CAMBIOS

        $qup = 'SELECT *
        FROM docentes d
        WHERE d.id = '.$form_data[id];
        // echo $qup;
        $qup = mysqli_query($link, $qup) or die("error" . mysqli_error($link) );

        $row = mysqli_fetch_assoc($qup);


        $dif = array_diff_assoc($form_data, $row);
        // echo "diferencias: ".print_r($dif);
        $t = "<pre>".print_r($dif, true)."</pre>";
        $t = str_replace('Array', '', $t);
        if ( count($dif) > 0 )  {
            enviarMailNotif($form_data[nombre], $form_data[documento], 'cambios-docentes', $link, $t, $_SESSION[user]);
        }

    }

    if ($table_name == 'acciones') {
            // $especialidades = array();
            // $especialidades = explode(",", $form_data['especialidades']);
            // unset($form_data['especialidades']);

            // CAMBIOS
        $form_data[contenido] = addslashes($form_data[contenido]);
        $form_data[objetivos] = addslashes($form_data[objetivos]);

        $qup = 'SELECT *
        FROM acciones a
        WHERE a.id = '.$form_data[id];
            // echo $qup;
        $qup = mysqli_query($link, $qup) or die("error" . mysqli_error($link) );

        $row = mysqli_fetch_assoc($qup);


        $dif = array_diff_assoc($form_data, $row);
            // echo "diferencias: ".print_r($dif);
        $t = "<pre>".print_r($dif, true)."</pre>";
        $t = str_replace('Array', '', $t);
        if ( count($dif) > 0 )  {
            enviarMailNotif($form_data[numeroaccion], '', 'cambios-acciones', $link, $t, $_SESSION[user]);
        }

    }



    if ( $table_name == 'empresas') {
        $cuentas = array();
        $cuentas = explode(",",$form_data['numeroscuenta']);
        unset($form_data['numeroscuenta']);

        $q = 'SELECT DISTINCT id, fecha
        FROM facturacion_bonificada
        WHERE empresa = '.$form_data['id'];
        echo $q;
        $q = mysqli_query($link, $q);

        if ( mysqli_num_rows($q) > 0 ) {

            while ( $row = mysqli_fetch_array($q)) {

                $fecha = $row[fecha];
                $id = $row[id];
                $fecha_vencimiento = date('Y-m-d', strtotime($fecha. ' + '.$form_data[vencimiento].' days'));

                $q = 'UPDATE facturacion_bonificada SET fecha_vencimiento = "'.$fecha_vencimiento.'", vencimiento = "'.$form_data[vencimiento].'" WHERE id = '.$id;
                echo $q;
                $q = mysqli_query($link, $q);

            }
        }

        $q = 'SELECT DISTINCT id, fecha
        FROM facturacion_privada
        WHERE empresa = '.$form_data['id'];
        echo $q;
        $q = mysqli_query($link, $q);

        if ( mysqli_num_rows($q) > 0 ) {

            while ( $row = mysqli_fetch_array($q)) {

                $fecha = $row[fecha];
                $id = $row[id];
                $fecha_vencimiento = date('Y-m-d', strtotime($fecha. ' + '.$form_data[vencimiento].' days'));

                $q = 'UPDATE facturacion_privada SET fecha_vencimiento = "'.$fecha_vencimiento.'", vencimiento = "'.$form_data[vencimiento].'" WHERE id = '.$id;
                echo $q;
                $q = mysqli_query($link, $q);

            }
        }


        //CAMBIOS

        $qup = 'SELECT *
        FROM empresas e
        WHERE e.id = '.$form_data[id];
        // echo $qup;
        $qup = mysqli_query($link, $qup) or die("error" . mysqli_error($link) );

        $row = mysqli_fetch_assoc($qup);

        // for ($z=0; $z < count($row); $z++) {
        // unset($valores[matricula]);
        // unset($valores[tiposolicitud]);
        // unset($valores[id_coste]);
        // print_r($valores);
        // echo "<br>";
        // print_r($row);
        if ( $row[fecha_revision] == "0000-00-00" )
            $row[fecha_revision] = "";
        // echo "<br>";
        // print_r($row);

        $dif = array_diff_assoc($form_data, $row);
        // echo "diferencias: ".print_r($dif);
        $t = "<pre>".print_r($dif, true)."</pre>";
        $t = str_replace('Array', '', $t);
        if ( count($dif) > 0 )  {
            enviarMailNotif($form_data[razonsocial], $form_data[cif], 'cambios-empresa', $link, $t, $_SESSION[user]);
        }



    }

    if ( $form_data[objetivos] != "" )
        $form_data[objetivos] = addslashes($form_data[objetivos]);

    if ( $form_data[contenido] != "" )
        $form_data[contenido] = addslashes($form_data[contenido]);

    if ( $form_data[datosformador] != "" )
        $form_data[datosformador] = addslashes($form_data[datosformador]);

    if ( $form_data[observacionesEDUKA-TE] != "" )
        $form_data[observacionesEDUKA-TE] = addslashes($form_data[observacionesEDUKA-TE]);

    if ( $form_data[observacionesikea] != "" )
        $form_data[observacionesikea] = addslashes($form_data[observacionesikea]);

    if ( $form_data[domiciliosocial] != "" )
        $form_data[domiciliosocial] = addslashes($form_data[domiciliosocial]);

    if ( $form_data[domiciliofiscal] != "" )
        $form_data[domiciliofiscal] = addslashes($form_data[domiciliofiscal]);


    $id = $form_data['id'];
    // unset($form_data['id']);

    $fields = array_keys($form_data);
    // echo $fields;
    $sql = 'UPDATE '.$table_name.' SET ';
    $c = count($form_data);
    // echo $c.'<br><Br>';
    $coma = ", ";



    // print_r($form_data);
    // echo "<br><br>";
    foreach ($form_data as $key => $value) {
        if (++$i === $c)
            $coma = "";
        $sql .= $key .' = '.'"'.$value.'"'.$coma;
    }
    // echo $sql;
    $sql .= ' WHERE id ='.$id;
    // echo $sql;
    mysqli_query($link,$sql) or die("error;" . mysqli_error($link));


    if ( $table_name == 'peticiones_gastos' ) {

        $dif = array_diff_assoc($form_data, $roworig);

        $t = "<pre>".print_r($dif, true)."</pre>";
        // if ( $empanadida == 1 ) $t .= "<br>Empresa añadida";
        $t = str_replace('Array', '', $t);


        if ( count($dif) > 0 )  {
            enviarMailNotif($form_data['tiposol'].$form_data['numero'], $form_data['id_usuario'], 'act-peticion-gasto', $link, $t, $_SESSION['user']);
        }

        $array['id'] = $id;
        echo json_encode($array);

    }

    if ( $table_name == 'ikea_solicitudes' ) {

        $coma = ',';
        if ( sizeof($id_empresas) > 0 ) {

            $empanadida = 1;

            for ($i = 0; $i < sizeof($id_empresas); $i++) {

                if ($i == sizeof($id_empresas) - 1)
                    $coma = "";
                $empresas .= ' ("' . $form_data[id] . '","' . $id_empresas[$i] . '", "' . $nalus[$i] . '")' . $coma;
            }


            $q1 = 'INSERT IGNORE INTO temp_empresas_ikea
            (id_solicitud, id_empresa, nalus)
            VALUES ' . $empresas;
            echo $q1 . "<br>";
            $q1 = mysqli_query($link,$q1) or die("error insertando empresa: ".mysqli_error($link));

        }


        if ( $form_data[observEDUKA-TE] == 1 )
            envioMailIKEA($form_data[numero], '', 'ikea_observacionesEDUKA-TE', $link, $form_data[observacionesEDUKA-TE]);

        if ( $form_data[observikea] == 1 )
            envioMailIKEA($form_data[numero], '', 'ikea_observacionesikea', $link, $form_data[observacionesikea]);

        unset($form_data['observEDUKA-TE']);
        unset($form_data['observikea']);

        // $estado_peticion = $row[estado_peticion];

        $dif = array_diff_assoc($form_data, $roworig);

        // echo "diferencias: ".print_r($dif);

        $t = "<pre>".print_r($dif, true)."</pre>";
        if ( $empanadida == 1 ) $t .= "<br>Empresa añadida";
        $t = str_replace('Array', '', $t);


        if ( count($dif) > 0 || $empanadida == 1 )  {
            enviarMailNotif($form_data[id], $form_data[modalidad], 'cambios-sol-ikea', $link, $t, $_SESSION[user]);
        }

    }


    if ( $modifcuentas == '1' ) {
        //echo "se ha modificado";

        $sql = 'DELETE FROM cuentascotizacion WHERE id_empresa = '.$id;
        mysqli_query($link,$sql);

        $coma = ",";
        for ($i=0; $i < sizeof($cuentas); $i++) {
            if( $i == sizeof($cuentas)-1 )
                $coma = "";
            $values .= " (".$id.",".$cuentas[$i].")".$coma;
        }
        $sql = 'INSERT INTO cuentascotizacion (id_empresa,numerocuenta) VALUES '.$values;
        mysqli_query($link,$sql);
        //echo $sql;
    }

    if ($modifespecialidad == '1') {
        echo "se ha modificado las especialidades";

        $sql = 'DELETE FROM docente_especialidad WHERE id_docente = '.$id;
        //echo $sql;
        mysqli_query($link,$sql);

        $coma = ",";
        for ($i=0; $i < sizeof($especialidades); $i++) {
            if( $i == sizeof($especialidades)-1 )
                $coma = "";
            $values .= " (".$id.",".$especialidades[$i].")".$coma;
        }
        $sql = 'INSERT INTO docente_especialidad (id_docente,id_especialidad) VALUES '.$values;
        mysqli_query($link,$sql);
        //echo $sql;
    }

    if ( $table_name == 'cursos_tpc' ) {

        $resul['id'] = $id;
        echo json_encode($resul);

    }



}

function matricular ($valores, $link) {


    // echo "<br>";
    // print_r($valores['id_alumno']);
    // print_r($valores['numerocuenta']);
    // print_r($valores['id_docente']);
    // print_r($valores['id_empresa']);
    // print_r($valores['id_matricula']);
    // print_r($valores['jornadalaboral']);
    // echo "<br>";
    // print_r($valores['ngrupo']);
    // echo "<br>";
    $coma = ",";

    $q = 'SELECT numeroaccion FROM acciones
    WHERE id = '.$valores['id_accion'];
    $q = mysqli_query($link,$q);
    $row = mysqli_fetch_array($q);
    $numeroaccion = $row['numeroaccion'];
    $grupo = $valores['ngrupo'];


    if ( strpos($grupo, 'p') ) $tipo = 'Privado';
    else $tipo = '';


    if ( $valores['id_matricula'] == "" ) { // si hay id de matricula, es actualización

        // insertar grupos con su numero de accion
        // hay que traerse ngrupo del calculado en el form

        $q1 = 'INSERT IGNORE INTO grupos_acciones
        (id_accion, ngrupo)
        VALUES ("'.$valores['id_accion'].'","'.$valores['ngrupo'].'")';
        // echo $q1."<br>";
        $q1 = mysqli_query($link,$q1);
        $id_grupo = mysqli_insert_id($link);
        // echo "grupo insertado ".$id_grupo;

        $q = 'SELECT max(id) FROM matriculas';
        $q = mysqli_query($link,$q);
        $id = mysqli_fetch_row($q);
        $id = $id[0] + 1;


        // inserto el centro de formacion presencial

        // echo "tamano nombrecentro".sizeof($valores['nombrecentro']);
        // $id_centro = 0;

        // if (strlen($valores['nombrecentro']) > 0) {

        //     if ( $valores['id_centro'] != "" && $valores['centronuevo'] == "No" ) {

        //         $id_centro = $valores['id_centro'];

        //     } else {

        //         // $q = 'SELECT max(id)
        //         // FROM centros';
        //         // $q = mysqli_query($link, $q);

        //         // $row = mysqli_fetch_row($q);
        //         // $id_centro = $row[0] + 1;
        //         // echo $id_centro;
        //         $q1 = 'INSERT IGNORE INTO `centros`( `nombrecentro`, `direccioncentro`, `codigopostal`, `localidad`, `provincia`, `id_matricula`)
        //         VALUES ("' . $valores['nombrecentro'] . '","' . $valores['direccioncentro'] . '","' . $valores['codigopostal'] . '","' . $valores['poblacion'] . '",
        //         "' . $valores['provincia'] . '","' . $id . '")';
        //         // echo $q1 . "<br>";
        //         $q1 = mysqli_query($link,$q1);
        //         $id_centro = mysqli_insert_id($link);

        //     }

        // }


        // inserto  matricula - accion
        $q1 = 'INSERT IGNORE INTO matriculas
        (id, id_accion, fechaini, fechafin, id_grupo, estado, horariomini, horariomfin, horariotini, horariotfin, diascheck, observaciones, fechacreacion, comercial, solicitud, id_solicitud, id_solicitudikea, tipo_docente, grupo_dino)
        VALUES ("'.$id.'","'.$valores['id_accion'].'","'.$valores['fechaini'].'","'.$valores['fechafin'].'","'.$id_grupo.'","'.$valores['estado'].'","'.$valores['horariomini'].
        '","'.$valores['horariomfin'].'","'.$valores['horariotini'].'","'.$valores['horariotfin'].'","'.$valores['diascheck'].'","'.$valores['observaciones'].'","'. date("Y-m-d") .'","'.$valores['comercial'].'", "'.$valores['solicitud'].'", "'.$valores['id_solicitud'].'", "'.$valores['id_solicitudikea'].'", "'.$valores['tipo_docente'].'", "'.$valores['grupo_dino'].'")';
        // echo $q1."<br>";
        $q1 = mysqli_query($link,$q1) or die ('error');

        $enviarlt = 0;

        if ( sizeof($valores['id_alumno']) > 0 ) {

            for ($i=0; $i < sizeof($valores['id_alumno']); $i++) {

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

                if( $i == sizeof($valores['id_alumno'])-1 )
                    $coma = "";
                $alumnos .= ' ("'.$id.'","'.$valores['id_alumno'][$i].'","'.$valores['numerocuenta'][$i].'","'.$valores['id_empresa'][$i].'","'. $valores['jornadalaboral'][$i+1] .'","'.$tipo.'")'.$coma;
            // echo $alumnos;
            }


            // inserto  matricula - alumno - numerocuenta
            $q1 = 'INSERT INTO mat_alu_cta_emp
            (id_matricula, id_alumno, numerocuenta, id_empresa, jornadalaboral, tipo)
            VALUES '.$alumnos;
             // echo $q1."<br>";
            $q1 = mysqli_query($link,$q1);

        }


        if ( sizeof($valores['id_docente']) > 0 ) {

            for ($i=0; $i < sizeof($valores['id_docente']); $i++) {
                if( $i == sizeof($valores['id_docente'])-1 )
                    $coma = "";
                $docentes .= ' ("'.$id.'","'.$valores['id_docente'][$i].'", "'.$valores['perfil'][$i].'", "'.$valores['numhorasdoc'][$i].'")'.$coma;
            }


            // inserto  matricula - docentes
            $q1 = 'INSERT IGNORE INTO mat_doc
            (id_matricula, id_docente, perfil, numhorasdoc)
            VALUES '.$docentes;
             // echo $q1."<br>";
            $q1 = mysqli_query($link,$q1);


        }

        if ( strlen($valores[precioventamat]) > 0 || strlen($valores[justificacion]) > 0 ) {
            $q1 = 'INSERT IGNORE INTO `costes_rentabilidad`(`costeaula`, `fungibledidac`, `alumnosestimados`, `precioventamat`, `totalingresos`, `totalcostes`, `costedocente`, `administracion`, `otrosgastos`, `margenbeneficio`, `porcentajeventas`, `id_matricula`) VALUES ("'.$valores[costeaula].'","'.$valores[fungibledidac].'","'.$valores[alumnosestimados].'","'.$valores[precioventamat].'","'.$valores[totalingresos].'","'.$valores[totalcostes].'","'.$valores[costedocente].'","'.$valores[administracion].'","'.$valores[otrosgastos].'","'.$valores[margenbeneficio].'","'.$valores[porcentajeventas].'","'.$id.'")';
            // echo $q1;
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
            $q2 = mysqli_query($link, $q2) or die('error:update sol aceptada' .mysqli_error($link));

        }



        enviarMailNotif($numeroaccion,$grupo, 'od-ini',$link,'',$_SESSION[user]);

        if ($valores['estado'] == 'Comunicada') {
            enviarMailNotif($numeroaccion, $grupo, 'td-ini-tutor',$link);
            envioMailCalidad("", $valores[id_docente][0], $link);
        }

        if ( $enviarlt == 1 )
            enviarMailNotif($numeroaccion,$grupo,'p-rltiniciop',$link,'I');

        // $q = 'SELECT representacionlegal
     //    FROM empresas e
     //    WHERE id = '.$valores[id_empresa][0];
     //    // echo $q;
     //    $q = mysqli_query($link, $q);
     //    $r = mysqli_fetch_row($q);

     //    if ( $r[0] == 1 )
        //  enviaRLTonlinedist($id, $link);

    } else {

        $id = $valores['id_matricula'];

        $fechaComunicada = '';
        $fechaFinalizada = '';
        if ($valores['estado'] == 'Comunicada')
            $fechaComunicada = date("Y-m-d");
        if ($valores['estado'] == 'Finalizada') {
            $fechaFinalizada = date("Y-m-d");

            $q = 'SELECT numeroaccion FROM acciones
            WHERE id = '.$valores['id_accion'];
            $q = mysqli_query($link,$q);
            $row = mysqli_fetch_array($q);
            $numeroaccion = $row['numeroaccion'];
            $grupo = $valores['ngrupo'];

            if ( strpos($grupo, "p")  ) {

                $q = 'SELECT costes_imparticion
                FROM mat_costes mc, matriculas m
                WHERE m.id = mc.id_matricula
                AND m.id = '.$id;
                $q = mysqli_query($link, $q);

                if ( mysqli_num_rows($q) > 0 ) {

                    $row = mysqli_fetch_array($q);
                    if ( $row[costes_imparticion] != 0 )
                        enviarMailNotif($numeroaccion, $grupo, 'td-finp', $link, '',$_SESSION[user]);
                }
            }
        }

        if ($valores['estado'] == 'Anulada') {

            // $q = 'SELECT md.id_docente
            // FROM mat_doc md
            // WHERE md.id_matricula = '.$id;
            // $q = mysqli_query($link, $q);

            // while ( $row = mysqli_fetch_array($q) ) {

            //     enviarMailNotif($numeroaccion, $grupo, 'pm-alta-anu',$link,$id.'-'.$row[id_docente]);

            // }
            enviarMailNotif($numeroaccion,$grupo,'td-anu',$link,'',$_SESSION[user]);

        }

        $qup = 'SELECT m.id_accion, fechaini, fechafin,m.tipo_docente, m.id_grupo, estado, horariomini, horariomfin, horariotini, horariotfin, diascheck, fechacreacion, presupuesto, comercial, observaciones, grupo, solicitud, id_solicitud, id_solicitudikea, observacionesfin, r.*, a.numeroaccion, ga.ngrupo, a.denominacion
        FROM matriculas m, costes_rentabilidad r, acciones a, grupos_acciones ga
        WHERE m.id = '.$id.'
        AND r.id_matricula = m.id
        AND m.id_grupo = ga.id
        AND m.id_accion = a.id';
        echo $qup;
        $qup = mysqli_query($link, $qup) or die("error" . mysqli_error($link) );

        $row = mysqli_fetch_assoc($qup);

        // for ($z=0; $z < count($row); $z++) {
        unset($valores[fuente]);
        unset($valores[matricula]);
        unset($valores[tiposolicitud]);
        unset($valores[id_coste]);
        unset($valores[costes_imparticion]);
        unset($valores[metodo]);
        unset($valores[costes_salariales]);
        unset($valores[mes_bonificable]);
        unset($valores[maximo_bonificable]);

        print_r($valores);
        echo "<br>";
        print_r($row);
        $dif = array_diff_assoc($valores, $row);
        echo "diferencias: ".print_r($dif);
        $t = "<pre>".print_r($dif, true)."</pre>";
        $t = str_replace('Array', '', $t);

        if ( count($dif) > 0 )  {
            enviarMailNotif($numeroaccion, $grupo, 'cambios-mat-indv', $link, $t, $_SESSION[user]);
        }

        // if ( strlen($valores['nombrecentro']) > 0 ) {


        //     if ( $id_centro != "" && $centronuevo == "No" ) {

        //         $q1 = 'UPDATE centros SET
        //         nombrecentro = ' . '"' . $valores['nombrecentro'] . '"' . ', direccioncentro = ' . '"' . $valores['direccioncentro'] . '"' . ', codigopostal = ' . '"' . $valores['codigopostal'] . '"' .
        //         ', localidad = ' . '"' . $valores['poblacion'] . '"' . ', provincia = ' . '"' . $valores['provincia'] . '" WHERE id = ' . $id_centro;
        //         // echo $q1 . "<br>";
        //         $q1 = mysqli_query($link, $q1);

        //     } else {

        //         // $q = 'SELECT max(id)
        //         // FROM centros';
        //         // $q = mysqli_query($link, $q);

        //         // $row = mysqli_fetch_row($q);
        //         // $id_centro = $row[0] + 1;
        //         // echo $id_centro;

        //         $q1 = 'INSERT IGNORE INTO `centros`( `nombrecentro`, `direccioncentro`, `codigopostal`, `localidad`, `provincia`, `id_matricula`)
        //         VALUES ("' . $valores['nombrecentro'] . '","' . $valores['direccioncentro'] . '","' . $valores['codigopostal'] . '","' . $valores['poblacion'] . '","' . $valores['provincia'] . '","' . $id . '")';
        //         // echo $q1 . "<br>";
        //         $q1 = mysqli_query($link,$q1);
        //         $id_centro = mysqli_insert_id($link);

        //     }

        // }


        $q1 = 'UPDATE matriculas SET
        fechaini = '.'"'.$valores['fechaini'].'"'.', fechafin = '.'"'.$valores['fechafin'].'"'.', estado = '.'"'.$valores['estado'].'"'.', horariomini = '.'"'.$valores['horariomini'].'"'.
        ', horariomfin = '.'"'.$valores['horariomfin'].'"'.', horariotini = '.'"'.$valores['horariotini'].'"'.', horariotfin = '.'"'.$valores['horariotfin'].'"'.
        ', diascheck = '.'"'.$valores['diascheck'].'"'.', observaciones = '.'"'.$valores['observaciones'].'"'.', fechacomunicacion = '.'"'. $fechaComunicada .'"'.', comercial = '.'"'. $valores['comercial'] .'"'.
        ', fechafinalizacion = '.'"'. $fechaFinalizada .'"'.', id_solicitud = '.'"'. $valores['id_solicitud'] .'"'.', id_solicitudikea = '.'"'. $valores['id_solicitudikea'] .'"'.', solicitud = '.'"'. $valores['solicitud'] .'"'.', tipo_docente = '.'"'. $valores['tipo_docente'] .'"'.', grupo_dino = '.'"'. $valores['grupo_dino'] .'"'.
        ' WHERE id = '.$id;
        echo $q1."<br>";
        $q1 = mysqli_query($link,$q1);


        $enviarlt = 0;

        if ( sizeof($valores['id_alumno']) > 0 ) {

            for ($i=0; $i < sizeof($valores['id_alumno']); $i++) {

                // comprueba num cuenta
                // compruebaNumCuenta($valores['id_empresa'][$i], $numeroaccion, $grupo, $link);

                if ( strpos($grupo, "p") === FALSE ) {

                    $qrlt = 'SELECT razonsocial FROM empresas
                    WHERE id = "'.$valores[id_empresa][$i].'"
                    AND representacionlegal = 1';
                    // echo $qrlt;
                    $qrlt = mysqli_query($link, $qrlt) or die("error rlt");

                    if ( mysqli_num_rows($qrlt) > 0 ) $enviarlt = 1;

                }

                if( $i == sizeof($valores['id_alumno'])-1 )
                    $coma = "";
                $alumnos .= ' ("'.$id.'","'.$valores['id_alumno'][$i].'","'.$valores['numerocuenta'][$i].'","'.$valores['id_empresa'][$i].'","'. $valores['jornadalaboral'][$i+1] .'")'.$coma;
            }

            // inserto  matricula - alumno - numerocuenta
            $q1 = 'INSERT IGNORE INTO mat_alu_cta_emp
            (id_matricula, id_alumno, numerocuenta, id_empresa, jornadalaboral)
            VALUES '.$alumnos;
            echo $q1."<br>";
            $q1 = mysqli_query($link,$q1);

        }


        if ( sizeof($valores['id_docente']) > 0 ) {

            for ($i=0; $i < sizeof($valores['id_docente']); $i++) {
                if( $i == sizeof($valores['id_docente'])-1 )
                    $coma = "";
                $docentes .= ' ("'.$id.'","'.$valores['id_docente'][$i].'", "'.$valores['perfil'][$i].'", "'.$valores['numhorasdoc'][$i].'")'.$coma;
            }

            // inserto  matricula - docentes
            $q1 = 'INSERT IGNORE INTO mat_doc
            (id_matricula, id_docente, perfil, numhorasdoc)
            VALUES '.$docentes;
            echo $q1."<br>";
            $q1 = mysqli_query($link,$q1);
            enviarMailNotif($numeroaccion,$grupo,'p-act-nuevodocindv',$link, '', $_SESSION[user]);

        }


        if ( strlen($valores[precioventamat]) > 0 || strlen($valores[justificacion]) > 0 ) {

            $q = 'SELECT id
            FROM costes_rentabilidad
            WHERE id_matricula = '.$id;
            $q = mysqli_query($link, $q);
            // $row = mysqli_fetch_array($q);

            if ( mysqli_num_rows($q) > 0 ) {

                $q1 = 'UPDATE `costes_rentabilidad` SET costeaula = "'.$valores[costeaula].'", fungibledidac = "'.$valores[fungibledidac].'", alumnosestimados = "'.$valores[alumnosestimados].'", precioventamat = "'.$valores[precioventamat].'", totalingresos = "'.$valores[totalingresos].'", totalcostes = "'.$valores[totalcostes].'", costedocente = "'.$valores[costedocente].'", administracion = "'.$valores[administracion].'", otrosgastos = "'.$valores[otrosgastos].'", margenbeneficio = "'.$valores[margenbeneficio].'", porcentajeventas = "'.$valores[porcentajeventas].'" WHERE id_matricula = "'.$id.'"';
                echo $q1;
                $q1 = mysqli_query($link,$q1);

            } else {

                $q1 = 'INSERT INTO `costes_rentabilidad`(`costeaula`, `fungibledidac`, `alumnosestimados`, `precioventamat`, `totalingresos`, `totalcostes`, `costedocente`, `administracion`, `otrosgastos`, `margenbeneficio`, `porcentajeventas`, `id_matricula`) VALUES ("'.$valores[costeaula].'","'.$valores[fungibledidac].'","'.$valores[alumnosestimados].'","'.$valores[precioventamat].'","'.$valores[totalingresos].'","'.$valores[totalcostes].'","'.$valores[costedocente].'","'.$valores[administracion].'","'.$valores[otrosgastos].'","'.$valores[margenbeneficio].'","'.$valores[porcentajeventas].'","'.$id.'")';
                echo $q1;
                $q1 = mysqli_query($link,$q1);

            }
        }

        if ( $valores['solicitud'] != "" && $valores['solicitud'] != 'undefined' ) {

            if ( strpos($valores['solicitud'],'IK') !== FALSE ) {

                $tabla = 'ikea_solicitudes';
                $campot = 'estadosolikea';
                $valor = $valores[id_solicitudikea];

                // if ( $estado == 'Finalizada' ) {
                //     enviarMailNotif($numeroaccion, $grupo, 'ikea_cuestionario', $link, $id);
                // }

            } else {

                $tabla = 'peticiones_formativas';
                $campot = 'estado_peticion';
                $valor = $valores[id_solicitud];

            }
            // echo $campot;

            $q2 = 'UPDATE '.$tabla.' SET '. $campot. ' = "Aceptada"
            WHERE id = "'. $valor .'"';
            // echo $q2;
            $q2 = mysqli_query($link, $q2) or die('error:uptae2' .mysqli_error($link));

        }


        if ( $valores['estado'] == 'Anulada' ) {

            $tabla = 'peticiones_formativas';
            $campot = 'estado_peticion';
            $valor = $valores[id_solicitud];

            $q2 = 'UPDATE '.$tabla.' SET '. $campot. ' = "Anulada"
            WHERE id = "'. $valor .'"';
            // echo $q2;
            $q2 = mysqli_query($link, $q2) or die('error:update sol anulada' .mysqli_error($link));


        }




        enviarMailNotif($numeroaccion, $grupo, 'od-act',$link);

        if ($valores['estado'] == 'Comunicada') {
            enviarMailNotif($numeroaccion, $grupo, 'td-ini-tutor',$link);
            envioMailCalidad("", $valores[id_docente][0], $link);
        }

        if ($valores['estado'] == 'Gratuita') {
            enviarMailNotif($numeroaccion, $grupo, 'aviso_diplomas', $link );
            enviarMailNotif($numeroaccion, $grupo, 'mat-a-gratis', $link, 'Online/Distancia Individual', '', $_SESSION['user']);
        }

        if ( $enviarlt == 1 )
            enviarMailNotif($numeroaccion,$grupo,'p-rltiniciop',$link,'I');



    }

}

function eliminarAlumnoDeMatricula ($id_alumno, $id_matricula, $link) {

    $sql = 'DELETE FROM mat_alu_cta_emp WHERE id_alumno = '.$id_alumno.' AND id_matricula = '.$id_matricula;
    echo $sql;
    mysqli_query($link,$sql);

}

function eliminarDocenteDeMatricula ($id_docente, $id_matricula, $link) {

    $sql = 'DELETE FROM mat_doc WHERE id_docente = '.$id_docente.' AND id_matricula = '.$id_matricula;
    mysqli_query($link,$sql);

}

function enviarMail ($numeroaccion,$grupo) {


    $mail = new PHPMailer();
    $mail->From = 'gestion@eduka-te.com';
    $mail->FromName = 'Contratos Formativos EDUKA-TE';
    $mail->addAddress('ivan.cabrera@eduka-te.com');
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Subject = 'Acceso al Curso de '.$row2[desc];
    $mail->Body = 'Buenos días, <br><br>';

    if(!$mail->send()) {
        echo 'Error. Email no enviado: ' . $mail->ErrorInfo;
    } else {
        echo 'Email enviado con éxito.';

    }
    $para       = 'backup-gestion@eduka-te.com';
    $titulo     = 'Nueva matrícula creada '.$numeroaccion. '/' .$grupo;
    $mensaje    = 'Se creó la matrícula '.$numeroaccion. '/' .$grupo;
    // Para enviar un correo HTML mail, la cabecera Content-type debe fijarse
    $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
    $cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";

    // Cabeceras adicionales
    $cabeceras .= 'From: Gestion EDUKA-TE <gestion@eduka-te.com>' . "\r\n";

    mail($para, $titulo, $mensaje, $cabeceras);
    registrarMailBD($para, $titulo, $mensaje, $link);

}

function enviarMailSimple ($titulo, $para, $link, $mensaje = NULL) {

    $baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
    include_once($baseurl.'/plugins/PHPMailer/PHPMailerAutoload.php');

    $mail = new PHPMailer();
    $mail->From = 'gestion@eduka-te.com';
    $mail->FromName = 'Gestión EDUKA-TE';
    anadeMails($para, $mail);

    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Subject = $titulo;
    $mail->Body = ( $mensaje === NULL ) ? ' - ' : $mensaje;

    if (!$mail->send()) {
        echo 'Error. Email no enviado: ' . $mail->ErrorInfo;
    } else {
        echo 'Email enviado con éxito.';
        registrarMailBD($para, $titulo, $mensaje, $link);
    }


}

function enviarMailPreFin ($numeroaccion,$grupo) {

    $para       = 'ivan.cabrera@eduka-te.com';
    $titulo     = 'Acción '.$numeroaccion. '/' .$grupo.' lista para finalizar';
    $mensaje    = 'Se subió un excel de finalización para la acción '.$numeroaccion. '/' .$grupo;
    // Para enviar un correo HTML mail, la cabecera Content-type debe fijarse
    $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
    $cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";

    // Cabeceras adicionales
    $cabeceras .= 'To: ivan.cabrera@eduka-te.com' . "\r\n";
    $cabeceras .= 'From: Gestion EDUKA-TE <gestion@eduka-te.com>' . "\r\n";

    mail($para, $titulo, $mensaje, $cabeceras);
    registrarMailBD($para, $titulo, $mensaje, $link);

}

function envioMailExterno($numeroaccion, $ngrupo, $tipo, $link, $opt=NULL) {


    $gestion = devuelveAnio();
    $rutainicio = dirname(__DIR__).'/pdf_tripartita'.$gestion.'/inicio/';

    $baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
    include_once($baseurl.'/plugins/PHPMailer/PHPMailerAutoload.php');

    $mail = new PHPMailer;
    $mail->FromName = 'Gestión EDUKA-TE';

    $mail->CharSet = 'UTF-8';
    $mail->isHTML(true);


    switch ($tipo) {

        case 'ext_documentacion':

        $id_mat = $opt;


        $q = 'SELECT DISTINCT ac.numeroaccion, ac.modalidad, ga.ngrupo, ac.denominacion, m.fechaini, m.fechafin, m.externo
        FROM acciones ac, matriculas m, grupos_acciones ga
        WHERE m.id_grupo = ga.id
        AND m.id_accion = ac.id
        AND m.externo != ""
        AND m.id = '.$id_mat;
        $q = mysqli_query($link, $q) or die('error:' . mysqli_error($link));

        while ($row = mysqli_fetch_array($q)) {

            $denominacion = $row[denominacion];
            $naccion = $row[numeroaccion];
            $ngrupo = $row[ngrupo];
            $fechaini = $row[fechaini];
            $fechafin = $row[fechafin];
            $modalidad = $row[modalidad];
            $externo = $row[externo];
        }


        $q = 'SELECT DISTINCT m.email
        FROM comerciales c
        WHERE c.nombre = "'.$externo.'"';

        $q = mysqli_query($link, $q) or die('error:' . mysqli_error($link));

        if ( mysqli_num_rows($q) == 0 ) {

            $envia = 0;

        } else {
            $envia = 1;
            $mail->addAddress($row[email]);
            $para .= $row[email];
        }


        $gestion = devuelveAnio();
        $linkikeacartel = '<a href="http://gestion.EDUKA-TE.com/app/documentacion/generadoc.php?id_matricula='.$id_mat.'">Cartel del curso</a>';
        $linkikeadocu = '<a href="http://gestion.EDUKA-TE.com/app/documentacion/documentacion_rellena.php?id_matricula='.$id_mat.'">Documentación completa</a>';
        $linkikeadiplomas = '<a href="http://gestion.EDUKA-TE.com/app/documentacion/generar_diploma_pre_bonif.php?id_matricula='.$id_mat.'">Diplomas del curso - Frontal</a>';
        $linkikeadiplomasa = '<a href="http://gestion.EDUKA-TE.com/app/documentacion/generar_diploma_pre_bonif_atras.php?id_matricula='.$id_mat.'">Diplomas del curso - Trasera</a>';
        $linkikeacuestionario = '<a href="http://gestion.EDUKA-TE.com/app/pdf_tripartita'.$gestion.'/cuestionario/'.$naccion.'-'.$ngrupo.'cues.pdf">Cuestionario Tripartita</a>';


                // $mail->ErrorInfo;
        $mail->FromName = 'Gestión EDUKA-TE';
        $mail->addAddress('ivan.cabrera@eduka-te.com');

        if ( $modalidad == "Presencial" || $modalidad == "Mixta" ) {
            //$mail->addBCC('mchinea@eduka-te.com');
            //$mail->addBCC('abenitez@eduka-te.com');
        } else
        $mail->addBCC('margarita.mitkova@eduka-te.com');


                // $mail->addBCC('abenitez@eduka-te.com');
                // $mail->addBCC('ivan.cabrera@eduka-te.com');

        $mail->Subject = '['.$externo.'] DOCUMENTACIÓN CURSO '.$naccion.'/'.$ngrupo.': '.$denominacion;
                // echo $mail->Subject;
        $mail->Body = 'Buenos días, <br><br> Esta es la documentación para el curso '.$naccion.'/'.$ngrupo.': '.$denominacion.' con fecha: '.formateaFecha($fechaini).' - '.formateaFecha($fechafin).'<br><br>';
        $mail->Body .= $linkikeacartel."<br>";
        $mail->Body .= $linkikeacuestionario."<br>";
        $mail->Body .= $linkikeadocu."<br>";
        $mail->Body .= $linkikeadiplomas."<br>";
        $mail->Body .= $linkikeadiplomasa."<br><br>";
        $mail->Body .= "Para sacar la documentación/diplomas en PDF: con Google Chrome, simplemente cambiar el destino a 'Guardar como PDF' en la ventana de impresión.<br>* Es necesario activar la opción de 'Gráficos de fondo'";
                // $mail->Body .= $emails."<br>";

        $mail->CharSet = 'UTF-8';
        $mail->isHTML(true);

                // echo "entra2";

        break;

    }

}

function envioMailCalidad($emailtutor=NULL, $opt=NULL, $link) {

    $baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
    include_once($baseurl.'/plugins/PHPMailer/PHPMailerAutoload.php');

    $mail = new PHPMailer();
    $mail->FromName = 'Gestión EDUKA-TE';

    if ( $emailtutor == "" || $emailtutor === NULL )  {

        $q = 'SELECT email
        FROM docentes
        WHERE id = '.$opt;
        $q = mysqli_query($link, $q) or die("error:" .mysqli_error($link));

        $row = mysqli_fetch_array($q);
        $emailtutor = $row[email];
        $mail->addAddress($emailtutor);

    } else
    $mail->addAddress($emailtutor);


    $mail->CharSet = 'UTF-8';
    $mail->isHTML(true);

    // $mail->addBCC('ivan.cabrera@eduka-te.com');
    $mail->addCC('margarita.mitkova@eduka-te.com');
    $mail->addBCC('backup-gestion@eduka-te.com');
    $politica = dirname(__DIR__).'/sistema_calidad/Politica_Calidad_y_MedioAmbiente.pdf';
    $mail->addAttachment($politica);

    $titulo = $mail->Subject = 'Información sobre la Política de Calidad y Medioambiente de EDUKA-TE - '.$emailtutor;
    $mail->Body = "Buenos días, <br><br>Le informamos que la Escuela Superior de Formación y Cualificación de Canarias (EDUKA-TE), tiene implantado un Sistema de Gestión de Calidad y Medio Ambiente según la Norma ISO 9001 e ISO 14001. En el marco de este compromiso,  consideramos importante que los docentes que trabajan para nuestra empresa tengan conocimiento de  la Política de Calidad y Medio Ambiente.";

    if ( $emailtutor != "" && $emailtutor !== NULL ) {
        if ( compruebaEnvioEmail($titulo, $link) != 1 ) {
            if(!$mail->send()) {
                echo 'Error. Email no enviado: ' . $mail->ErrorInfo;
                exit;
            } else {
                registrarMailBD($emailtutor,$mail->Subject,'',$link);
            }
        }
    }


}

function envioMailIKEA ($numeroaccion, $ngrupo, $tipo, $link, $opt=NULL) {

    $gestion = devuelveAnio();
    $rutainicio = dirname(__DIR__).'/pdf_tripartita'.$gestion.'/inicio/';

    $baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
    include_once($baseurl.'/plugins/PHPMailer/PHPMailerAutoload.php');

    $mail = new PHPMailer;
    $mail->FromName = 'Gestión EDUKA-TE';

    $mail->CharSet = 'UTF-8';
    $mail->isHTML(true);


    $envia = 1;
    switch ($tipo) {


        case 'ikea_observacionesEDUKA-TE':

        $q = 'SELECT email, modalidad, denominacion
        FROM ikea_solicitudes i, usuarios u
        WHERE i.usuario = u.user
        AND i.numero = '.$numeroaccion;
                // echo $q;
        $q = mysqli_query($link, $q) or die("error:" .mysqli_error($link));

        while ( $row = mysqli_fetch_array($q) ) {
            $modalidad = $row[modalidad];
            $denominacion = $row[denominacion];
            $mail->addAddress($row[email]);
        }

        if ( $modalidad == 'Teleformación') {
            $mail->addAddress('margarita.mitkova@eduka-te.com');
            $para = 'margarita.mitkova@eduka-te.com';
        }
        else {
            //$mail->addAddress('mchinea@eduka-te.com');
            //$para = 'mchinea@eduka-te.com';
            $mail->addAddress('margarita.mitkova@eduka-te.com');
            $para = 'margarita.mitkova@eduka-te.com';
        }

        $mail->addCC('backup-gestion@eduka-te.com');
        //$mail->addCC('abenitez@eduka-te.com');
        $cc = 'backup-gestion@eduka-te.com';

                // $mail->addAddress('ivan.cabrera@eduka-te.com');
        $mail->CharSet = 'UTF-8';
        $mail->isHTML(true);

        $mail->addCC('laura.garcia@woden.es');
        $mail->Subject = '[IKEA] Actualización Observaciones en solicitud '.$numeroaccion.' - '.$denominacion;
        $mail->Body = 'Se han actualizado las observaciones en esta solicitud:<br>'.$opt;

        break;


        case 'ikea_observacionesikea':

        $q = 'SELECT modalidad, denominacion
        FROM ikea_solicitudes i
        WHERE i.numero = '.$numeroaccion;
                // echo $q;
        $q = mysqli_query($link, $q) or die("error:" .mysqli_error($link));

        $row = mysqli_fetch_array($q);
        $modalidad = $row[modalidad];
        $denominacion = $row[denominacion];

        if ( $modalidad == 'Teleformación') {
            $mail->addAddress('margarita.mitkova@eduka-te.com');
            $para = 'margarita.mitkova@eduka-te.com';
        }
        else {
            //$mail->addAddress('mchinea@eduka-te.com');
            //$para = 'mchinea@eduka-te.com';
            $mail->addAddress('margarita.mitkova@eduka-te.com');
            $para = 'margarita.mitkova@eduka-te.com';
        }

        //$mail->addCC('abenitez@eduka-te.com');
        //$cc = 'abenitez@eduka-te.com';

                // $mail->addAddress('ivan.cabrera@eduka-te.com');
        $mail->CharSet = 'UTF-8';
        $mail->isHTML(true);

        $mail->Subject = '[IKEA] Actualización Observaciones en solicitud '.$numeroaccion.' - '.$denominacion;
        $mail->Body = 'Se han actualizado las observaciones en esta solicitud:<br>'.$opt;

        break;

        case 'ikea_solicitudes':

        $mail->addAddress('margarita.mitkova@eduka-te.com');
        $mail->addCC('backup-gestion@eduka-te.com');
        //$mail->addCC('abenitez@eduka-te.com');
        $mail->addCC('laura.garcia@woden.es');


        $q = 'SELECT *
        FROM ikea_solicitudes
        WHERE id = '.$opt;
        $q = mysqli_query($link, $q);

        $row = mysqli_fetch_array($q);
        $mail->Subject = $row[numero].' - '.'[IKEA] Solicitud de curso';
        $mail->Body = 'Solicitud de curso por parte de '.$row[usuario].' con los siguientes datos: <BR>
        Denominación: '.$row[denominacion].'
        Tipo: '.$row[tipoformacionikea].'
        Modalidad: '.$row[modalidad].'
        Horas: '.$row[horastotales].'
        Fecha Inicio: '.$row[fechaini].'
        Fecha Fin: '.$row[fechafin].'
        Lugar: '.$row[lugar].'<BR>
        Más información <a href="http://gestion.EDUKA-TE.com/app/index.php?solicitudikea">aquí</a>.';


        break;

        case 'ikea_comunicacion':

                // $para = 'laura.garcia@woden.es';
        //$mail->addReplyTo = 'mchinea@eduka-te.com';
        $mail->addReplyTo = 'margarita.mitkova@eduka-te.com';
        $mail->FromName = 'Gestión EDUKA-TE';
                // $mail->addBCC('ivan.cabrera@eduka-te.com');

                // MIRAR SI USER DANIEL PARA ESAS 2 EMPRESAS

        $q = 'SELECT DISTINCT ac.numeroaccion, ga.ngrupo, ac.denominacion, m.fechaini, m.fechafin, u.nombre, u.cargo, u.email, u.user
        FROM acciones ac, matriculas m, grupos_acciones ga, centros c, usuarios u, ikea_solicitudes i
        WHERE m.id_grupo = ga.id
        AND m.id_accion = ac.id
        AND m.solicitud LIKE "IK%"
        AND u.cargo LIKE "RRHH%"
        AND m.centro = c.id
        AND i.id = m.id_solicitudikea
        AND c.id = u.centro
        AND ac.numeroaccion = '.$numeroaccion.'
        AND ga.ngrupo = "'.$ngrupo.'"';
                // $consulta = $q;
        $q = mysqli_query($link, $q) or die('error:' . mysqli_error($link));

        if ( mysqli_num_rows($q) == 0 ) {

            $envia = 0;

        } else {

            while ($row = mysqli_fetch_array($q)) {

                $mail->addCC($row[email]);
                $para .= $row[email];
                $denominacion = $row[denominacion];
            }
        }

        $q1 = 'SELECT i.* FROM ikea_solicitudes i, matriculas m, acciones a, grupos_acciones ga
        WHERE i.usuario = "ikea_daniell"
        AND m.id_accion = a.id
        AND m.id_grupo = ga.id
        AND m.id_solicitudikea = i.id
        AND a.numeroaccion = '.$numeroaccion.'
        AND ga.ngrupo = "'.$ngrupo.'"';

        $q1 = mysqli_query($link, $q1) or die('error:' . mysqli_error($link));
        $row = mysqli_fetch_array($q1);

        if ( mysqli_num_rows($q1) > 0 ) {
            $mail->addCC($row[email]);
        }


        $mail->addCC('laura.garcia@woden.es');
        $fichero = $rutainicio . $numeroaccion.'-'.$ngrupo.'ini.pdf';
                // echo $fichero;
                $mail->addAttachment($fichero);                   // Add attachments

                $mail->Subject = '[IKEA] CURSO COMUNICADO '.$numeroaccion.'/'.$ngrupo.': '.$denominacion;

                $mail->Body    = 'Buenos días, <br><br>

                Adjunto a este correo envíamos notificación de inicio de la formación. <br><br>';

                break;


                case 'ikea_tabla':

                // $mail->addReplyTo = 'mchinea@eduka-te.com';
                // $mail->FromName = 'Gestión EDUKA-TE';

                if ( $opt == 'Teleformación') {
                    $mail->addAddress('margarita.mitkova@eduka-te.com');
                    $emails = 'margarita.mitkova@eduka-te.com';
                } else {
                    //$mail->addAddress('mchinea@eduka-te.com');
                    $mail->addAddress('margarita.mitkova@eduka-te.com');
                    //$emails = 'mchinea@eduka-te.com';
                    $emails = 'margarita.mitkova@eduka-te.com';
                }

                //$mail->addCC('abenitez@eduka-te.com');

                $rutaikea = dirname(__DIR__).'/ikea'.$gestion.'/tablasparticipantes/';
                $fichero = $rutaikea . $numeroaccion.'_'.quitaTildesConComas($ngrupo).'.xlsx';

                $mail->addAttachment($fichero);                   // Add attachments

                $mail->Subject = '[IKEA] TABLA DE PARTICIPANTES SOLICITUD '.$numeroaccion.': '.$ngrupo;

                $mail->Body    = 'Buenos días, <br><br>

                Adjunto a este correo se envía la tabla de participantes para este curso. <br><br>';


                break;


                case 'ikea_docufinal':

                // $mail->addReplyTo = 'mchinea@eduka-te.com';
                $mail->FromName = 'Gestión EDUKA-TE';

                if ( $opt == 'Teleformación')
                    $para = 'margarita.mitkova@eduka-te.com';
                else
                    $para = 'margarita.mitkova@eduka-te.com';

                $mail->addAddress($para);
                //$cc = 'abenitez@eduka-te.com';
                $mail->addCC($cc);
                $mail->addCC('ivan.cabrera@eduka-te.com');
                // $mail->addAddress('ivan.cabrera@eduka-te.com');


                $mail->Subject = '[IKEA] DOCUMENTACIÓN FINALIZACIÓN IKEA SUBIDA '.$numeroaccion.'/'.$ngrupo;

                $mail->Body    = 'Buenos días, <br><br>

                Se ha subido documentación para este curso. <br><br>';


                break;


                case 'ikea_documentacion':

                $id_mat = $opt;
                // $para = 'laura.garcia@woden.es';
                // $para = 'laura.garcia@woden.es';
                //$mail->addReplyTo = 'mchinea@eduka-te.com';
                $mail->addReplyTo = 'margarita.mitkova@eduka-te.com';
                $mail->FromName = 'Gestión EDUKA-TE';
                // $mail->addBCC('ivan.cabrera@eduka-te.com');
                // $mail->addBCC('ivan.cabrera@eduka-te.com');

                // MIRAR SI USER DANIEL PARA ESAS 2 EMPRESAS

                // echo "entra";

                $q = 'SELECT DISTINCT ac.numeroaccion, ac.modalidad, ga.ngrupo, ac.denominacion, m.fechaini, m.fechafin
                FROM acciones ac, matriculas m, grupos_acciones ga, ikea_solicitudes i
                WHERE m.id_grupo = ga.id
                AND m.id_accion = ac.id
                AND i.id = m.id_solicitudikea
                AND m.id = '.$id_mat;
                $q = mysqli_query($link, $q) or die('error:' . mysqli_error($link));

                while ($row = mysqli_fetch_array($q)) {

                    $denominacion = $row[denominacion];
                    $naccion = $row[numeroaccion];
                    $ngrupo = $row[ngrupo];
                    $fechaini = $row[fechaini];
                    $fechafin = $row[fechafin];
                    $modalidad = $row[modalidad];
                    // echo $modalidad;
                }


                $q = 'SELECT DISTINCT u.nombre, u.cargo, u.email, u.user
                FROM matriculas m, centros c, usuarios u, ikea_solicitudes i
                WHERE u.cargo LIKE "RRHH%"
                AND m.centro = c.id
                AND i.id = m.id_solicitudikea
                AND c.id = u.centro
                AND m.id = '.$id_mat;
                // echo $q;
                $q = mysqli_query($link, $q) or die('error:' . mysqli_error($link));

                if ( mysqli_num_rows($q) == 0 ) {

                    $envia = 0;

                } else {
                    $envia = 1;
                    $mail->addAddress($row[email]);
                    $para .= $row[email];
                }

                $q1 = 'SELECT u.email FROM ikea_solicitudes i, matriculas m, acciones a, grupos_acciones ga, usuarios u
                WHERE
                i.usuario = u.user
                AND m.id_accion = a.id
                AND m.id_grupo = ga.id
                AND m.id_solicitudikea = i.id
                AND m.id = '.$id_mat;


                $q1 = mysqli_query($link, $q1) or die('error:' . mysqli_error($link));
                $row = mysqli_fetch_array($q1);

                if ( mysqli_num_rows($q1) > 0 ) {
                    $envia = 1;
                    $mail->addAddress($row[email]);
                    $para .= $row[email];
                }

                $gestion = devuelveAnio();

                // $anio = explode('-', $fechafin);

                // if ( date('Y') != $anio[0] ) $anio = '&anio='.$anio[0]; else $anio = "";

                $linkikeacartel = '<a href="http://gestion.EDUKA-TE.com/app/documentacion/generadoc.php?id_matricula='.$id_mat.'">Cartel del curso</a>';
                $linkikeadocu = '<a href="http://gestion.EDUKA-TE.com/app/documentacion/documentacion_rellena.php?id_matricula='.$id_mat.'">Documentación completa</a>';
                $linkikeadiplomas = '<a href="http://gestion.EDUKA-TE.com/app/documentacion/generar_diploma_pre_bonif.php?id_matricula='.$id_mat.'">Diplomas del curso - Frontal</a>';
                $linkikeadiplomasa = '<a href="http://gestion.EDUKA-TE.com/app/documentacion/generar_diploma_pre_bonif_atras.php?id_matricula='.$id_mat.'">Diplomas del curso - Trasera</a>';
                $linkikeacuestionario = '<a href="http://gestion.EDUKA-TE.com/app/pdf_tripartita'.$gestion.'/cuestionario/'.$naccion.'-'.$ngrupo.'cues.pdf">Cuestionario Tripartita</a>';


                // $mail->ErrorInfo;
                $mail->FromName = 'Gestión EDUKA-TE';
                $mail->addAddress('ivan.cabrera@eduka-te.com');

                if ( $modalidad == "Presencial" || $modalidad == "Mixta" ) {
                    //$mail->addBCC('mchinea@eduka-te.com');
                    $mail->addBCC('margarita.mitkova@eduka-te.com');
                }
                else
                    $mail->addBCC('margarita.mitkova@eduka-te.com');


                //$mail->addBCC('abenitez@eduka-te.com');
                $mail->addBCC('ivan.cabrera@eduka-te.com');
                $mail->addCC('laura.garcia@woden.es');

                $mail->Subject = '[IKEA] DOCUMENTACIÓN CURSO '.$naccion.'/'.$ngrupo.': '.$denominacion;

                // echo $mail->Subject;
                $mail->Body = 'Buenos días, <br><br> Esta es la documentación para el curso '.$naccion.'/'.$ngrupo.': '.$denominacion.' con fecha: '.formateaFecha($fechaini).' - '.formateaFecha($fechafin).'<br><br>';

                if ( $modalidad != "Teleformación" ) {
                    $mail->Body .= $linkikeacartel."<br>";
                    $mail->Body .= $linkikeacuestionario."<br>";
                    $mail->Body .= $linkikeadocu."<br>";
                }

                $mail->Body .= $linkikeadiplomas."<br>";
                $mail->Body .= $linkikeadiplomasa."<br><br>";
                $mail->Body .= "Para sacar la documentación/diplomas en PDF: con Google Chrome, simplemente cambiar el destino a 'Guardar como PDF' en la ventana de impresión.<br>* Es necesario activar la opción de 'Gráficos de fondo'";
                // $mail->Body .= $emails."<br>";

                $mail->CharSet = 'UTF-8';
                $mail->isHTML(true);

                $envia = 1;

                break;


                case 'ikea_cuestionario':

                $q = 'SELECT a.id as id_alu, a.nombre, a.apellido, a.email
                FROM mat_alu_cta_emp ma, alumnos a
                WHERE ma.id_alumno = a.id
                AND ma.id_matricula = '.$opt;
                // echo $q;
                $q = mysqli_query($link, $q) or die('error: '.mysqli_error($link));


                while ( $row = mysqli_fetch_array($q) ) {

                    // print_r($row);
                    $emails = $row[email];
                    $alumno = $row[nombre].' '.$row[apellido];
                    $mail->addAddress('ivan.cabrera@eduka-te.com');

                    $mail->Subject = '[IKEA] CUESTIONARIO '.$numeroaccion.'/'.$ngrupo.': '.$alumno;
                    // echo $mail->Subject;
                    $mail->Body = 'Buenos días, <br><br> Le solicitamos dos minutos de su tiempo para realizar este pequeño cuestionario, debiendo evaluar las preguntas del 1 al 10, siendo “1” el de menor satisfacción y “10” el de mayor satisfacción.<br><br>';
                    $mail->Body .= '<a href="http://gestion.EDUKA-TE.com/app/forms/form_cuestionarioikea.php?id_mat='.$opt.'&id_alu='.$row[id_alu].'">Ir al cuestionario</a><br>';
                    // $mail->Body .= $emails."<br>";

                    //if ( compruebaEnvioEmail($mail->Subject, $link) != 1 ) {

                    if(!$mail->send()) {
                        echo 'Error. Email no enviado: ' . $mail->ErrorInfo;
                        exit;
                    } else {
                        registrarMailBD($emails,$mail->Subject,$emails,$link);
                    }
                    //}
                    $mail->ClearAddresses();

                }

                $envia = 0;


                break;

            }

            $mail->addBCC('backup-gestion@eduka-te.com');
    // $mail->addBCC('laura.garcia@woden.es'); // == SARA VARGAS
    // $envia = 1;
            $mail->CharSet = 'UTF-8';
            $mail->isHTML(true);

            if ( $envia == 1 ) {
        // echo "llega";
                if(!$mail->send()) {
                    echo 'Error. Email no enviado: ' . $mail->ErrorInfo;
                    exit;
                } else {
                    echo "email enviado";
                    registrarMailBD($emails,$mail->Subject,$emails,$link);

                }
            }



        }


        function enviarMailNotif ($numeroaccion,$grupo,$tipo,$link,$opt = NULL,$opt2 = NULL) {

            $cc = '-';
            $gestion = devuelveAnio();
    // Para enviar un correo HTML mail, la cabecera Content-type debe fijarse
            $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
            $cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";

            $envia = 0;
            switch ($tipo) {

                case 'costes_actualizados':

                $fechahora = date('Y-m-d H:i');
                $para = 'backup-gestion@eduka-te.com';
                $cc = 'margarita.mitkova@eduka-te.com, ivan.cabrera@eduka-te.com, ivan.cabrera@eduka-te.com';
                $titulo = '['.$opt2.'] Costes añadidos '.$numeroaccion. '/' .$grupo. ' - ' . $opt. ' ' . $fechahora;
                $envia = 1;

                break;

                case 'justificante-subido':

                // echo "entra";

                $baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
                //include_once($baseurl.'/plugins/PHPMailer/PHPMailerAutoload.php');

                $qx = 'SELECT p.*, c.nombre, c.apellido
                FROM peticiones_formativas p, comerciales c
                WHERE p.numero = "'.$numeroaccion.'"
                AND p.id_comercial = c.id';
                // echo $qx;
                $qx = mysqli_query($link, $qx) or die("error select sol" . mysqli_error($link));

                while ( $row = mysqli_fetch_array($qx) ) {

                    $t2 .= '
                    Nº Solicitud: '.$numeroaccion.'<br>
                    Curso: '.$row[formacion].'<br>
                    Modalidad: '.$row[modalidad].'<br>
                    Tipo: '.$row[tipoformacionpropuesta].'<br>
                    Comercial: '.$row[nombre].' '.$row[apellido].'<br>
                    Horas: '.$row[horastotales].'<br>
                    Presupuesto: '.$row[presupuesto].'<br>
                    Empresa: '.$row[empresas].'<br>
                    Observaciones/Datos Facturación: <br>'.nl2br( $row[observaciones] ).'<br>';

                }

                // $para = 'ivan.cabrera@eduka-te.com';
                $para = 'backup-gestion@eduka-te.com';
                $cc = 'backup-gestion@eduka-te.com';

                // $para = 'ivan.cabrera@eduka-te.com';
                $justificante = '../documentacion'.$gestion.'/solicitudes/'.$numeroaccion.'/'.$numeroaccion.'-justificante.pdf';
                // echo $justificante;
                $mail = new PHPMailer();
                $mail->FromName = 'Gestión EDUKA-TE';
                $mail->addAddress($para);
                $mail->addCC($cc);
                $mail->addBCC('ivan.cabrera@eduka-te.com');
                $mail->CharSet = 'UTF-8';
                $mail->isHTML(true);
                $mail->addAttachment($justificante);

                $titulo = $mail->Subject = '['.$opt2.'] Justificante de Pago - Solicitud: '.$numeroaccion;
                $mail->Body = 'Datos de la Solicitud:<br><br>'.$t2;

                if (!$mail->send())
                    echo "error";
                else {
                    registrarMailBD($para, $titulo, $cc, $link, $opt);
                }

                // $titulo = '['.$opt2.'] Justificante de Pago - Solicitud: '.$numeroaccion;
                // $mensaje = ' Datos de la Solicitud:<br><br>'.$t2;
                $NoEnvia = 1;

                break;

                case 'empresa-eliminada':

                $q = 'SELECT numeroaccion, ngrupo, modalidad
                FROM matriculas m, grupos_acciones ga, acciones a
                WHERE m.id_grupo = ga.id
                AND m.id_accion = a.id
                AND m.id = '.$numeroaccion;
                $q = mysqli_query($link, $q) or die("error:" .mysqli_error($link));

                $row = mysqli_fetch_array($q);
                $af = $row[numeroaccion].'/'.$row[ngrupo];
                $modalidad = $row[modalidad];

                $q1 = 'SELECT razonsocial
                FROM empresas e
                WHERE id = '.$grupo;
                $q1 = mysqli_query($link, $q1) or die("error:" .mysqli_error($link));

                $rowx = mysqli_fetch_array($q1);
                $empresa = $rowx[razonsocial];

                $para = 'margarita.mitkova@eduka-te.com';
                /*if ( $modalidad == 'Teleformación' )
                    $cc = 'abenitez@eduka-te.com';
                else
                    $cc = 'abenitez@eduka-te.com';*/

                $titulo = '['.$opt.'] Empresa '.$empresa.' eliminada de AF: '.$af;
                $mensaje = '-';
                $envia = 1;


                break;

                case 'propuesta-aceptada':

                if ( $opt == 'Teleformación' )
                    $para = 'margarita.mitkova@eduka-te.com';
                else
                    $para = 'margarita.mitkova@eduka-te.com';

                //$cc = 'abenitez@eduka-te.com,mmitkova@eduka-te.com';

                // $para = 'ivan.cabrera@eduka-te.com';
                $titulo = '['.$opt2.'] Propuesta SP'.$grupo.' aceptada';
                $mensaje = '';
                $envia = 1;

                break;

                case 'matricula-aceptada':

                // if ( $opt == 'Teleformación' )
                //     $para = 'abenitez@eduka-te.com';
                // else
                //     $para = 'mchinea@eduka-te.com';

                // $cc = 'abenitez@eduka-te.com,mmitkova@eduka-te.com'; 

                // $para = 'ivan.cabrera@eduka-te.com';
                $titulo = '['.$opt2.'] Matrícula SP'.$grupo.' aceptada';
                $mensaje = '';
                $envia = 1;

                break;


                case 'personal-creado':

                $para = 'ivan.cabrera@eduka-te.com';
                $titulo = 'Nuevo usuario nómina de personal creado - '.$numeroaccion.' - '.$grupo;
                $mensaje = '-';
                $envia = 1;

                break;

                case 'nuevo-anexo':

                $para = 'margarita.mitkova@eduka-te.com, margarita.mitkova@eduka-te.com';
                // $cc = 'ivan.cabrera@eduka-te.com';

                $titulo = '['.$opt2.'] Actualización anexo '.$grupo.' SC'.$opt;
                $mensaje = '';
                $envia = 1;

                break;

                case 'nueva-peticion-gasto':

                $para = 'margarita.mitkova@eduka-te.com,backup-gestion@eduka-te.com,rmedina@eduka-te.com';
                $cc = 'ivan.cabrera@eduka-te.com';
                //$ccodani = ',ivan.cabrera@eduka-te.com';

                $q = 'SELECT n.email
                FROM usuarios u, nominas_usuarios n
                WHERE n.usuario = u.id
                AND u.id = "'.$opt.'"';
                $q = mysqli_query($link, $q) or die("error select : " .mysqli_error($link));

                $row = mysqli_fetch_assoc($q);
                if ( $row['email'] != "" ) $cc .= ','.$row['email'];

                $titulo = '['.$opt2.'] Nueva petición de gasto '.$numeroaccion;
                $mensaje = "Observaciones: ".$grupo;
                $envia = 1;

                break;

                case 'act-peticion-gasto':

                $para = 'margarita.mitkova@eduka-te.com,backup-gestion@eduka-te.com,rmedina@eduka-te.com';
                // $cc = 'ivan.cabrera@eduka-te.com';
                $ccodani = ',ivan.cabrera@eduka-te.com';

                $q = 'SELECT n.email
                FROM usuarios u, nominas_usuarios n
                WHERE n.usuario = u.id
                AND u.id = "'.$grupo.'"';
                $q = mysqli_query($link, $q) or die("error select : " .mysqli_error($link));

                $row = mysqli_fetch_assoc($q);
                if ( $row['email'] != "" ) $cc .= ','.$row['email'];

                $titulo = '['.$opt2.'] Actualización petición de gasto '.$numeroaccion;
                $mensaje = "Cambios: ".$opt;
                $envia = 1;

                break;

                case 'credito-resuelto':

                // $cc = 'ivan.cabrera@eduka-te.com';

                $q = 'SELECT asignado, dispuesto_acciones, dispuesto_pif, disponible, actualizado_a, c.email as emailcomercial, e.razonsocial, e.agente
                FROM empresas e, comerciales c
                WHERE e.cif = "'.$numeroaccion.'"
                AND e.comercial = c.id';
                // echo $q;
                $q = mysqli_query($link, $q) or die("error:" .mysqli_error($link));

                $row = mysqli_fetch_assoc($q);

                $para = $row[emailcomercial];
                
                if ( $para == 'backup-gestion@eduka-te.com' ) $para = 'margarita.mitkova@eduka-te.com';

                if ( $row[agente] == "Isabel" )
                    $para .= ',margarita.mitkova@eduka-te.com';
                else if ( $row[agente] == "Amparo" )
                    $para .= ',margarita.mitkova@eduka-te.com';

                $titulo = 'Solicitud de crédito SC'.$numero.' - '.$row[razonsocial].' - '.$row[emailcomercial];
                $mensaje = 'Este es el crédito para la empresa '.$row[razonsocial].':<br><br>';
                $mensaje .= 'Crédito asignado: '.$row[asignado].':<br>';
                $mensaje .= 'Crédito consumido: '.$row[dispuesto_acciones].':<br>';
                $mensaje .= 'Crédito disponible: '.$row[disponible].':<br>';
                $mensaje .= 'Actualizado el: '.$row[actualizado_a].':<br><br>';
                $mensaje .= '** Puede revisar esta información en cualquier momento en la ficha correspondiente del formulario de empresas **';


                $envia = 1;

                break;

                case 'emp-sin-numcuenta':

                $para = 'backup-gestion@eduka-te.com, ivan.cabrera@eduka-te.com';

                if ( $opt2 == 'Amparo' )
                    $cc = 'margarita.mitkova@eduka-te.com';
                else
                    $cc = 'margarita.mitkova@eduka-te.com';

                $titulo = 'La empresa '.$opt.' no tiene número de cuenta - AF: '.$numeroaccion.'/'.$grupo;
                $mensaje = '';


                break;

                case 'solicitud-abierto':

                $q = 'SELECT email
                FROM comerciales
                WHERE avisos = 1
                AND nombre NOT LIKE "ext_%"';
                $q = mysqli_query($link, $q) or die("error:" .mysqli_error($link));

                while ( $row = mysqli_fetch_assoc($q) ) {
                    $i++;
                    if ( $row[email] != "" )
                        $ar[$i] .= $row[email];
                }

                $para = implode(",", $ar);

                $cc = 'margarita.mitkova@eduka-te.com, ivan.cabrera@eduka-te.com';

                $titulo = '['.$opt2.'] Nueva solicitud de MATRÍCULA/PROPUESTA en ABIERTO - Nº S'.$numeroaccion;
                $mensaje = $opt;


                break;

            // case 'solicitud-abierto-act':

            //     $q = 'SELECT email
            //     FROM comerciales
            //     WHERE id NOT IN(15,6,2,8,9,10,17,20,21,9)';
            //     $q = mysqli_query($link, $q) or die("error:" .mysqli_error($link));

            //     while ( $row = mysqli_fetch_assoc($q) ) {
            //         $i++;
            //         if ( $row[email] != "" )
            //             $ar[$i] .= $row[email];
            //     }

            //     $para = implode(",", $ar);

            //     $cc = 'abenitez@eduka-te.com, ivan.cabrera@eduka-te.com, ivan.cabrera@eduka-te.com';

            //     $titulo = '['.$opt2.'] Actualización solicitud de MATRÍCULA/SOLICITUD en ABIERTO - Nº S'.$numeroaccion;
            //     $mensaje = $opt;


            // break;



                case 'solicitud-SM':

                // echo "llega";
                if ( $grupo == 'Teleformación' )
                    $para = 'margarita.mitkova@eduka-te.com';
                else
                    $para = 'margarita.mitkova@eduka-te.com';

                $cc = 'ivan.cabrera@eduka-te.com';

                if ( $opt2 == 'ext_montesano' ) {
                    $cc .= ', ivan.cabrera@eduka-te.com';
                }

                if ( $opt2 == 'ext_cervecera' ) {
                    $cc .= ', ivan.cabrera@eduka-te.com';
                }

                if ( $opt2 == 'ext_ideco' || $opt2 == 'ext_seur' || $opt2 == 'ext_spar' ) {
                    $cc .= ', backup-gestion@eduka-te.com';
                }

                $titulo = '['.$opt2.'] Nueva solicitud de MATRÍCULA Nº S'.$numeroaccion;
                $mensaje = $opt;


                break;

                case 'solicitud-SC':

                // if ( $grupo == 'Teleformación' )
                //     $para = 'abenitez@eduka-te.com';
                // else
                //     $para = 'mchinea@eduka-te.com';

                $para = 'margarita.mitkova@eduka-te.com,margarita.mitkova@eduka-te.com';
                $cc = 'ivan.cabrera@eduka-te.com';

                if ( $opt2 == 'margarita' ) {
                    //$cc .= ',mchinea@eduka-te.com';
                    //$cc .= ',abenitez@eduka-te.com';
                }

                if ( $opt2 == 'ext_montesano' ) {
                    $cc .= ', backup-gestion@eduka-te.com, ivan.cabrera@eduka-te.com';
                }

                if ( $opt2 == 'ext_cervecera' ) {
                    $cc .= ', backup-gestion@eduka-te.com, ivan.cabrera@eduka-te.com';
                }

                if ( $opt2 == 'ext_ideco' || $opt2 == 'ext_seur' || $opt2 == 'ext_spar' ) {
                    $cc .= ', backup-gestion@eduka-te.com';
                }

                $titulo = '['.$opt2.'] Nueva solicitud de CRÉDITO Nº S'.$numeroaccion;
                $mensaje = $opt;


                break;

                case 'solicitud-SP':

               
                $para = 'backup-gestion@eduka-te.com';
                $para = 'backup-gestion@eduka-te.com';
               

                if ( $opt2 == 'ext_montesano' ) {
                    $cc .= ', backup-gestion@eduka-te.com, ivan.cabrera@eduka-te.com';
                }

                if ( $opt2 == 'ext_cervecera' ) {
                    $cc .= ', backup-gestion@eduka-te.com, ivan.cabrera@eduka-te.com';
                }

                if ( $opt2 == 'ext_ideco' || $opt2 == 'ext_seur' || $opt2 == 'ext_spar' ) {
                    $cc .= ', backup-gestion@eduka-te.com';
                }


                $titulo = '['.$opt2.'] Nueva solicitud de PROPUESTA Nº S'.$numeroaccion;
                $mensaje = $opt;


                break;


                case 'tabla_subida':

                $q = 'SELECT modalidad, formacion
                FROM peticiones_formativas
                WHERE numero = '.$numeroaccion;
                $q = mysqli_query($link, $q) or die("error select : " .mysqli_error($link));

                $row = mysqli_fetch_assoc($q);

                if ( $row[modalidad] == 'Teleformación' )
                    $para = 'margarita.mitkova@eduka-te.com, margarita.mitkova@eduka-te.com';
                else
                    $para = 'margarita.mitkova@eduka-te.com, margarita.mitkova@eduka-te.com';

                // $cc = 'abenitez@eduka-te.com, ivan.cabrera@eduka-te.com';

                $titulo = 'Tabla de participantes subida - Solicitud '.$numeroaccion.': '.$row[formacion];
                $mensaje = '.';
                $envia = 1;


                break;


                case 'cambios-empresa':

                $para = 'backup-gestion@eduka-te.com';
                // $cc = 'abenitez@eduka-te.com,ivan.cabrera@eduka-te.com,abenitez@eduka-te.com';
                $titulo = '['.$opt2.'] Cambios en Empresas '.$numeroaccion.'/'.$grupo;
                $mensaje = "Cambios realizados por ".$opt2.":<br>".$opt;
                $envia = 1;

                break;

                case 'cambios-docentes':

                $para = 'ivan.cabrera@eduka-te.com';
                $cc = 'margarita.mitkova@eduka-te.com,ivan.cabrera@eduka-te.com';
                $titulo = '['.$opt2.'] Cambios en Docentes '.$numeroaccion.' - '.$grupo;
                $mensaje = "Cambios realizados por ".$opt2.":<br>".$opt;
                $envia = 1;

                break;

                case 'cambios-acciones':

                // $para = 'ivan.cabrera@eduka-te.com';
                $para = 'ivan.cabrera@eduka-te.com';
                $cc = 'margarita.mitkova@eduka-te.com,ivan.cabrera@eduka-te.com';
                $titulo = '['.$opt2.'] Cambios en Acciones '.$numeroaccion.' - '.$grupo;
                $mensaje = "Cambios realizados por ".$opt2.":<br>".$opt;
                $envia = 1;

                break;


                case 'cambios-observgestor':

                // $para = 'ivan.cabrera@eduka-te.com';
                $q = 'SELECT email
                FROM comerciales c
                WHERE c.id = '.$numeroaccion;
                $q = mysqli_query($link, $q) or die("error:" .mysqli_error($link));

                $row = mysqli_fetch_array($q);
                $para = $row[email];

                $cc = 'ivan.cabrera@eduka-te.com';
                $titulo = '['.$opt2.'] Observaciones Comercial en Propuesta SP'.$numeroaccion;
                $mensaje = "Observaciones: <br>".nl2br($opt);
                $envia = 1;

                break;

                // case 'acceso-nominas':

                // $para = $opt;
                // // $cc = 'ivan.cabrera@eduka-te.com';
                // $cc = 'cmunoz@eduka-te.com, mmitkova@eduka-te.com, ivan.cabrera@eduka-te.com, cmunoz@eduka-te.com';

                // $titulo = 'Acceso a las nóminas por aplicación EDUKA-TE: '.$numeroaccion.' - '.$grupo;
                // $mensaje = 'Hola, <br><br> Le enviamos el usuario y contraseña de la aplicación para que pueda acceder a sus nóminas en PDF:<br><br>

                // Enlace: <a href="http://gestion.EDUKA-TE.com/app">Aplicación EDUKA-TE</a><br>
                // Usuario: [primerainicialnombre][primerapellido]tutor<br>
                // Contraseña: [SUDNICONLETRA]@eduka-te<br><br>

                // * Quitar los corchetes<br>
                // * Respetar las mayúsculas/minúsculas <br><br>


                // Una vez dentro, pinche en su nombre de usuario (arriba a la derecha).<br>

                // Si no le aparece para descargar (en verde) en los meses que le corresponden, diríjase a Margarita Mitkova (mmitkova@eduka-te.com), cmunoz Coll (cmunoz@eduka-te.com) o Vicente Segurado (cmunoz@eduka-te.com).<br><br>

                // Saludos.<br>';
                // $envia = 1;

                // break;

                case 'cambios-sol':

                $qp = 'SELECT modalidad, tiposol, formacion, empresas
                FROM peticiones_formativas
                WHERE numero = "'.$numeroaccion.'"';
                $qp = mysqli_query($link, $qp) or die("error:" .mysqli_error($link));

                $rowp = mysqli_fetch_array($qp);
                $modalidad = $rowp[modalidad];
                $formacion = $rowp[formacion];
                $empresas = $rowp[empresas];
                $tiposol = $rowp[tiposol];

                $q = 'SELECT email
                FROM comerciales c
                WHERE id = '.$grupo;
                $q = mysqli_query($link, $q) or die("error:" .mysqli_error($link));

                $row = mysqli_fetch_array($q);
                $emailcomercial = $row[email];


                if ( $tiposol == "SC" ) {

                    $para = 'margarita.mitkova@eduka-te.com,margarita.mitkova@eduka-te.com';
                    $cc = $emailcomercial;
                    //if ( $emailcomercial == 'backup-gestion@eduka-te.com' )
                        //$cc .= ',abenitez@eduka-te.com';

                } else if ( $tiposol == "SP" ) {
                    $para = 'backup-gestion@eduka-te.com';
                    // $cc = $emailcomercial;
                } else {
                    if ( $opt2 == 'javier' || $modalidad == 'Teleformación' )
                        $para = 'margarita.mitkova@eduka-te.com';
                    else if ( $opt2 == 'margarita' || $modalidad != 'Teleformación' )
                        $para = 'margarita.mitkova@eduka-te.com';

                    $cc = $emailcomercial;

                    if ( $emailcomercial == 'backup-gestion@eduka-te.com' )
                        //$cc .= ',mchinea@eduka-te.com';
                        $cc .= ',margarita.mitkova@eduka-te.com';
                }


                $titulo = '['.$opt2.'] Cambios en Solicitud '.$numeroaccion. ': '.$formacion.' - '.$empresas;
                $mensaje = "Cambios realizados por ".$opt2.":<br>".$opt;
                $envia = 1;

                break;

                case 'cambios-sol-ikea':

                $qp = 'SELECT modalidad, numero, denominacion
                FROM ikea_solicitudes
                WHERE id = "'.$numeroaccion.'"';
                $qp = mysqli_query($link, $qp) or die("error:" .mysqli_error($link));

                $rowp = mysqli_fetch_array($qp);
                $modalidad = $rowp[modalidad];
                $denominacion = $rowp[denominacion];
                $numero = $rowp[numero];
                // $tiposol = $rowp[tiposol];

                if ( $modalidad == 'Teleformación' )
                    $para = 'margarita.mitkova@eduka-te.com';


                $cc = 'margarita.mitkova@eduka-te.com';
                $titulo = '['.$opt2.'] Cambios en Solicitud IKEA '.$numero.': '.$denominacion;
                $mensaje = "Cambios realizados por ".$opt2.":<br>".$opt;
                $envia = 1;

                break;

                case 'cambios-mat-grupal':

                $para = 'ivan.cabrera@eduka-te.com';
                $cc = 'margarita.mitkova@eduka-te.com,margarita.mitkova@eduka-te.com';
                $titulo = '['.$opt2.'] Cambios en Matrícula Grupal '.$numeroaccion.'/'.$grupo;
                $mensaje = "Cambios realizados por ".$opt2.":<br>".$opt;
                $envia = 1;

                break;

                case 'p-act-nuevodocgrupal':

                $para = 'ivan.cabrera@eduka-te.com';
                $cc = 'margarita.mitkova@eduka-te.com';
                $titulo = '['.$opt2.'] Cambios en Docentes Matrícula Grupal '.$numeroaccion.'/'.$grupo;
                $mensaje = "";
                $envia = 1;

                break;

                case 'cambios-mat-presen':

                $para = 'ivan.cabrera@eduka-te.com';
                $cc = 'margarita.mitkova@eduka-te.com,margarita.mitkova@eduka-te.com';
                $titulo = '['.$opt2.'] Cambios en Matrícula Presencial '.$numeroaccion.'/'.$grupo;
                $mensaje = "Cambios realizados por ".$opt2.":<br>".$opt;
                $envia = 1;

                break;

                case 'p-act-nuevodocpresen':

                $para = 'ivan.cabrera@eduka-te.com';
                $cc = 'margarita.mitkova@eduka-te.com';
                $titulo = '['.$opt2.'] Cambios en Docentes Matrícula Presencial '.$numeroaccion.'/'.$grupo;
                $mensaje = "";
                $envia = 1;

                break;

                case 'cambios-mat-indv':

                $para = 'ivan.cabrera@eduka-te.com';
                $cc = 'margarita.mitkova@eduka-te.com,margarita.mitkova@eduka-te.com';
                $titulo = '['.$opt2.'] Cambios en Matrícula Online/Distancia '.$numeroaccion.'/'.$grupo;
                $mensaje = "Cambios realizados por ".$opt2.":<br>".$opt;
                $envia = 1;

                break;

                case 'p-act-nuevodocindv':

                $para = 'ivan.cabrera@eduka-te.com';
                $cc = 'margarita.mitkova@eduka-te.com';
                $titulo = '['.$opt2.'] Cambios en Docentes Matrícula Online/Distancia '.$numeroaccion.'/'.$grupo;
                $mensaje = "";
                $envia = 1;

                break;


                case 'nomina_subida':

                $para = 'backup-gestion@eduka-te.com';

                $q = 'SELECT nombre
                FROM nominas_usuarios
                WHERE dni = "'.$numeroaccion.'"
                AND dni = "72057022T"';
                $q = mysqli_query($link, $q) or die("error" . mysqli_error($link) );

                if ( mysqli_num_rows($q) == 0 ) $NoEnvia = 1;
                $row = mysqli_fetch_array($q);

                $titulo = 'Nómina '.$grupo.' de '.$row[nombre].' subida';
                $mensaje = "";

                $cabeceras .= 'Cc: '.$cc. "\r\n";
                $cabeceras .= 'From: Gestion EDUKA-TE <gestion@eduka-te.com>' . "\r\n";

                break;

                case 'p-rltiniciop':

                // echo "entra en zona email";

                if ( $opt == "P" )

                    $sql = 'SELECT DISTINCT a.numeroaccion, a.denominacion, ga.ngrupo, m.fechaini, m.fechafin, e.razonsocial, c.email as emailcomercial, m.comercial, e.*, e.id as id_emp, m.id as id_mat
                FROM matriculas m, acciones a, grupos_acciones ga, ptemp_mat_emp ma, empresas e, comerciales c
                WHERE m.id_accion = a.id
                AND c.id = e.comercial
                AND m.id_grupo = ga.id
                AND ma.id_matricula = m.id
                AND ma.id_empresa = e.id
                AND e.representacionlegal = 1
                AND a.numeroaccion = '.$numeroaccion.'
                AND ga.ngrupo = "'. $grupo .'"';

                else if ( $opt == "G" )

                    $sql = 'SELECT DISTINCT a.numeroaccion, a.denominacion, ga.ngrupo, m.fechaini, m.fechafin, e.razonsocial, c.email as emailcomercial, m.comercial, e.*, e.id as id_emp, m.id as id_mat
                FROM matriculas m, acciones a, grupos_acciones ga, otemp_mat_emp ma, empresas e, comerciales c
                WHERE m.id_accion = a.id
                AND c.id = e.comercial
                AND m.id_grupo = ga.id
                AND e.representacionlegal = 1
                AND ma.id_matricula = m.id
                AND ma.id_empresa = e.id
                AND a.numeroaccion = '.$numeroaccion.'
                AND ga.ngrupo = "'. $grupo .'"';

                else

                    $sql = 'SELECT DISTINCT a.numeroaccion, a.denominacion, ga.ngrupo, m.fechaini, m.fechafin, e.razonsocial, c.email as emailcomercial, m.comercial, e.*, e.id as id_emp, m.id as id_mat
                FROM matriculas m, acciones a, grupos_acciones ga, mat_alu_cta_emp ma, empresas e, comerciales c
                WHERE m.id_accion = a.id
                AND c.id = e.comercial
                AND m.id_grupo = ga.id
                AND ma.id_matricula = m.id
                AND ma.id_empresa = e.id
                AND e.representacionlegal = 1
                AND a.numeroaccion = '.$numeroaccion.'
                AND ga.ngrupo = "'. $grupo .'"';

                $sql = mysqli_query($link, $sql) or die("error:" .mysqli_error($link));

                if ( $opt == 'P' )
                    $para = 'margarita.mitkova@eduka-te.com';
                    
                else
                    $para = 'margarita.mitkova@eduka-te.com';

                $cc = 'ivan.cabrera@eduka-te.com';

                $titulo = 'Empresas que necesitan RLT del curso '.$numeroaccion.'/'.$grupo;
                $mensaje = "Empresas que necesitan RLT:<br><br>";


                $gestion = (int)$gestion;
                $gestion = $gestion - 1;
                while ( $row = mysqli_fetch_array($sql) ) {

                    if ( $row[emailcomercial] != "" )
                        //$cc .= ','.$row[emailcomercial];

                    if ( $row[emailcomercial] == 'backup-gestion@eduka-te.com' )
                        $cc .= ',margarita.mitkova@eduka-te.com,margarita.mitkova@eduka-te.com';

                    $mensaje .= '<a href="http://gestion.EDUKA-TE.com/app/documentacion/rltpremix.php?id_mat='.$row[id_mat].'&tipo='.$opt.'&id_emp='.$row[id_emp].'">RLT '.$row[razonsocial].'</a><br>';
                    $mensaje .= '<a href="http://gestion.EDUKA-TE.com/app/pdf_tripartita'.$gestion.'/empresa/'.$row[cif].'-informe.pdf">Informe de Empresa</a><br>';

                }

                $cabeceras .= 'Cc: '.$cc. "\r\n";
                $cabeceras .= 'From: Gestion EDUKA-TE <gestion@eduka-te.com>' . "\r\n";

                $envia = 1;

                break;


                case 'aviso_excel_priv_fin':

                // $para = 'ivan.cabrera@eduka-te.com';
                $para = 'margarita.mitkova@eduka-te.com';
                $cc = 'ivan.cabrera@eduka-te.com';

                $titulo = 'Error en empresa no existente - EXCEL PRIVADO Finalizacion '.$numeroaccion.'/'.$grupo;
                $mensaje = 'La/s siguiente/s empresa/s no existen en la base de datos: '.$opt;

                $cabeceras .= 'Cc: '.$cc. "\r\n";
                $cabeceras .= 'From: Gestion EDUKA-TE <gestion@eduka-te.com>' . "\r\n";

                $mail = mail($para, $titulo, $mensaje, $cabeceras);

                if ( $mail === TRUE )
                 registrarMailBD($para, $titulo, $cc, $link);
             else
                return "errormail";

            break;

            case 'aviso_excel_priv':

                // $para = 'ivan.cabrera@eduka-te.com';
            $para = 'margarita.mitkova@eduka-te.com';
            $cc = 'ivan.cabrera@eduka-te.com';

            $titulo = 'Error en empresa no existente - EXCEL PRIVADO documentacion '.$numeroaccion.'/'.$grupo;
            $mensaje = 'La/s siguiente/s empresa/s no existen en la base de datos: '.$opt;

            $cabeceras .= 'Cc: '.$cc. "\r\n";
            $cabeceras .= 'From: Gestion EDUKA-TE <gestion@eduka-te.com>' . "\r\n";

            $mail = mail($para, $titulo, $mensaje, $cabeceras);

            if ( $mail === TRUE )
             registrarMailBD($para, $titulo, $cc, $link);
         else
            return "errormail";

        break;

        case 'aviso_excel_bonif':

                // $para = 'ivan.cabrera@eduka-te.com';
        $para = 'margarita.mitkova@eduka-te.com';
        $cc = 'ivan.cabrera@eduka-te.com';

        $titulo = 'Error en empresa no notificada - EXCEL BONIFICADO documentación '.$numeroaccion.'/'.$grupo;
        $mensaje = 'La/s siguiente/s empresa/s no se encuentra notificadas: '.$opt;

        $cabeceras .= 'Cc: '.$cc. "\r\n";
        $cabeceras .= 'From: Gestion EDUKA-TE <gestion@eduka-te.com>' . "\r\n";

        break;

        case 'aviso_diplomas':

        $para = 'margarita.mitkova@eduka-te.com';
        $cc = 'ivan.cabrera@eduka-te.com';

        $titulo = 'ENVIAR DIPLOMAS - Curso Online/Distancia finalizado '.$numeroaccion.'/'.$grupo;
        $mensaje = 'Recordatorio para enviar los diplomas de este curso.';

        $q = 'SELECT al.nombre, al.apellido, al.apellido2, al.documento
        FROM mat_alu_cta_emp ma, grupos_acciones ga, acciones a, matriculas m, alumnos al
        WHERE m.id_accion = a.id
        AND m.id_grupo = ga.id
        AND ma.id_matricula = m.id
        AND ma.id_alumno = al.id
        AND ma.finalizado = 1
        AND ga.ngrupo = "'.$grupo.'"
        AND a.numeroaccion = '.$numeroaccion;
                // echo $q;
        $q = mysqli_query($link, $q) or die("error:" .mysqli_error($link));

        echo "<pre>";
        while ( $row = mysqli_fetch_array($q) ) {

            print_r($row);

        }
        echo "</pre>";

        $cabeceras .= 'Cc: '.$cc. "\r\n";
        $cabeceras .= 'From: Gestion EDUKA-TE <gestion@eduka-te.com>' . "\r\n";

        break;


        case 'mat-a-gratis':

        $para = 'margarita.mitkova@eduka-te.com, ivan.cabrera@eduka-te.com';
                // $cc = 'ivan.cabrera@eduka-te.com';

        $titulo = '['.$opt2.'] '.$opt.' '.$numeroaccion.'/'.$grupo.' cambia a estado GRATUITO';
        $mensaje = 'Cambio de estado a GRATUITO';

        $cabeceras .= 'Cc: '.$cc. "\r\n";
        $cabeceras .= 'From: Gestion EDUKA-TE <gestion@eduka-te.com>' . "\r\n";

        break;

        case 'ikea_solicitudes':

        
        $para = 'margarita.mitkova@eduka-te.com';
        $cc = 'backup-gestion@eduka-te.com, ivan.cabrera@eduka-te.com';

        $q = 'SELECT *
        FROM ikea_solicitudes
        WHERE id = '.$opt;
        $q = mysqli_query($link, $q);

        $row = mysqli_fetch_array($q);
        $titulo = $row[numero].' - '.'[IKEA] Solicitud de curso';
        $mensaje = 'Solicitud de curso por parte de '.$row[usuario].' con los siguientes datos: <BR>
        Denominación: '.$row[denominacion].'
        Tipo: '.$row[tipoformacionikea].'
        Modalidad: '.$row[modalidad].'
        Horas: '.$row[horastotales].'
        Fecha Inicio: '.$row[fechaini].'
        Fecha Fin: '.$row[fechafin].'
        Lugar: '.$row[lugar].'<BR>
        Más información <a href="http://gestion.EDUKA-TE.com/app/index.php?solicitudikea">aquí</a>.';


        $cabeceras .= 'Cc: '.$cc. "\r\n";
        $cabeceras .= 'From: Gestion EDUKA-TE <gestion@eduka-te.com>' . "\r\n";
        break;


        case 'o-ini-grupo':

        $para = 'margarita.mitkova@eduka-te.com';
        $cc = 'ivan.cabrera@eduka-te.com,margarita.mitkova@eduka-te.com';
                // $para = 'ivan.cabrera@eduka-te.com';
        $titulo = '['.$opt2.'] Nueva matrícula grupal Online/Distancia creada '.$numeroaccion. '/' .$grupo;
        $mensaje = 'Nueva matrícula grupal Online/Distancia creada '.$numeroaccion. '/' .$grupo;
                // Cabeceras adicionales
        $cabeceras .= 'Cc: '.$cc. "\r\n";
        $cabeceras .= 'From: Gestion EDUKA-TE <gestion@eduka-te.com>' . "\r\n";
        break;


            // case 'o-act-grupo':

            //     $para = 'abenitez@eduka-te.com';
            //     $cc = 'ivan.cabrera@eduka-te.com, abenitez@eduka-te.com';
            //     // $para = 'ivan.cabrera@eduka-te.com';
            //     $titulo = 'Cambios en matrícula grupal Online/Distancia '.$numeroaccion. '/' .$grupo;
            //     $mensaje = 'Cambios en matrícula grupal Online/Distancia '.$numeroaccion. '/' .$grupo;
            //     // Cabeceras adicionales
            //     $cabeceras .= 'Cc: '.$cc. "\r\n";
            //     $cabeceras .= 'From: Gestion EDUKA-TE <gestion@eduka-te.com>' . "\r\n";
            //     break;

        case 'pm-alta':

        // $q = 'SELECT a.*, d.*, m.*, c.*, c.codigopostal as codpostalcentro, c.localidad as localcentro, c.provincia as provcentro, md.fechadocini, md.fechadocfin, md.horariodoc, md.numhorasdoc, d.poblacion as poblacion_docente, d.provincia as provincia_docente, m.observaciones as observmat, d.porcentajediscapacidad, a.diploma, d.documento as cifproveedor
        // FROM mat_doc md, docentes d, matriculas m, acciones a, centros c
        // WHERE md.id_matricula = m.id
        // AND m.id_accion = a.id
        // AND md.id_docente = d.id
        // AND m.centro = c.id
        // AND (tipo_docente <> "Externo" OR d.documento = "B76571140")
        // AND m.fechafin > "'.date('Y-m-d').'"
        // AND (d.situacionlaboral IN("Generar","Desempleado")
        // OR ( d.documento = "B76571140" AND situacionlaboral = "Autonomo" ))
        // AND m.id = '.$opt;

        $q = 'SELECT a.*, d.*, m.*, c.*, c.codigopostal as codpostalcentro, c.localidad as localcentro, c.provincia as provcentro, md.fechadocini, md.fechadocfin, md.horariodoc, md.numhorasdoc, d.poblacion as poblacion_docente, d.provincia as provincia_docente, m.observaciones as observmat, d.porcentajediscapacidad, a.diploma, d.documento as cifproveedor
        FROM matriculas m
        INNER JOIN mat_doc md ON md.id_matricula = m.id
        INNER JOIN docentes d ON md.id_docente = d.id
        INNER JOIN acciones a ON a.id = m.id_accion
        LEFT JOIN centros c ON c.id = m.centro
        WHERE (tipo_docente <> "Externo" OR d.documento = "B76571140")
        AND m.fechafin > "'.date('Y-m-d').'"
        AND (d.situacionlaboral IN("Generar","Desempleado")
        OR ( d.documento = "B76571140" AND situacionlaboral = "Autonomo" ))
        AND m.id = '.$opt;
                //echo $q;
        $q = mysqli_query($link, $q) or die("error". mysqli_error($link));

        $fechaAlta = date("d/m/Y H:i");
        // $nrows = mysqli_num_rows($q);
        // echo "nrows: ".$nrows;

        if ( mysqli_num_rows($q) > 0 ) {

            // echo "si1";

            while ( $row = mysqli_fetch_array($q) ) {

                // print_r($row);

                if ( $row[cifproveedor] == "B76571140" ) {
                    $docente = $row[nombredocente].' '.$row[apellidodocente].' '.$row[apellido2docente];
                    $row[documento] = $row[documentodocente];
                } else {
                    $docente = $row[nombre].' '.$row[apellido].' '.$row[apellido2];
                }

                $fechadocini = $row[fechadocini];
                $fechadocfin = $row[fechadocfin];
                $horariodoc = $row[horariodoc];
                $numhorasdoc = $row[numhorasdoc];
                $diascheck = $row[diascheck];

                $cc = 'backup-gestion@eduka-te.com,ivan.cabrera@eduka-te.com,margarita.mitkova@eduka-te.com';
                        // $para = 'patricia_asesoriaha@hotmail.com,Patricia.asesorialaboral@gmail.com';

                if ( $row[cifproveedor] == "B76571140" ) {
                    $empresa = ' en ISLAS PREVENCIÓN';
                    // $emailcc = ', fernando@islasprevencion.com';
                    $mensajeislas = '<strong>La empresa encargada de la formación es ISLAS PREVENCIÓN</strong>';
                }

                //$para = 'laboral@basefis.com';
                         $para = 'ivan.cabrera@eduka-te.com';
                        //$cc = 'ivan.cabrera@eduka-te.com';

                $titulo = 'Asesoría: Alta Laboral '.$empresa.' para '.$docente.' - '.$numeroaccion. '/' .$grupo;
                $tituloanu = 'Asesoría: Alta Laboral '.$empresa.' ANULADA para '.$docente.' - '.$numeroaccion. '/' .$grupo;
                $mensaje = "<br/><b>".'Datos del Curso'."</b><br/>";
                $mensaje .= "<br/>".'Denominación: '.$row[denominacion];
                $mensaje .= "<br/>".'Acción/Grupo: '.$numeroaccion.'/'.$grupo;
                $mensaje .= "<br/>".'Centro: '.$row[nombrecentro].': '.$row[direccioncentro].', '.$row[codpostalcentro].', '.$row[localcentro].', '.$row[provcentro];
                $mensaje .= "<br/>".'Coste/Hora bruto docencia: '.$row[preciohora];

                $mensaje .= "<br/><br/><b>".'Datos del Docente'."</b><br/>";
                if ( $row['situacionlaboral'] == 'Generar' ) $row['situacionlaboral'] = "Alta laboral";
                $mensaje .= "<br/>".'<b>Situación Laboral: '.$row['situacionlaboral'].'</b>';

                $mensaje .= "<br/><br/>".'Nombre: '.$docente;
                $mensaje .= "<br/>".'Fechas: '.formateaFecha($fechadocini). ' - '.formateaFecha($fechadocfin);
                $mensaje .= "<br/>".'Horario: '.$horariodoc;
                $mensaje .= "<br/>".'Días: '.$diascheck;
                $mensaje .= "<br/>".'Nº Horas: '.$numhorasdoc;
                $mensaje .= "<br/>".'Dirección: '.$row[direccion];
                $mensaje .= "<br/>".'Localidad: '.$row[poblacion_docente];
                $mensaje .= "<br/>".'Provincia: '.$row[provincia_docente];
                $mensaje .= "<br/>".'Titulación: '.$row[titulacion];

                if ( $row[porcentajediscapacidad] != "" && $row[porcentajediscapacidad] !== NULL )
                    $mensaje .= "<br/>".'% Discapacidad: '.$row[porcentajediscapacidad];
                $mensaje .= "<br/>".'Titulación: '.$row[titulacion];
                $mensaje .= "<br/><br/>".'Datos Alta SS '."<br/>".'Nº SS: '.$row[niss]."<br/>".'Número de Cuenta: '.$row[numcuenta];
                $mensaje .= "<br/>".'NIF/NIE: '.$row[documento];
                $mensaje .= "<br/><br/>".'Observaciones '."<br/>".$row[observmat];

                $mensaje .= "<br/><br/>".$mensajeislas."</br>";

                        // Cabeceras adicionales
                $cabeceras .= 'Cc: '.$cc. "\r\n";
                $cabeceras .= 'Bcc: backup-gestion@eduka-te.com' . "\r\n";
                $cabeceras .= 'From: Gestion EDUKA-TE <gestion@eduka-te.com>' . "\r\n";


                $q2 = 'SELECT id
                FROM registro_emails
                WHERE titulo = "'.$tituloanu.'"';
                $q2 = mysqli_query($link, $q2);

                $tituloanu = $tituloanu.' anulado';
                while ( $r = mysqli_fetch_array($q2) ) {

                    $q1 = 'UPDATE registro_emails SET titulo = "'.$tituloanu.'" WHERE id = '.$r[id];
                    $q1 = mysqli_query($link, $q1);

                }

                if ( compruebaEnvioEmail($titulo, $link) != 1 ) {
                    $mail = mail($para, $titulo, $mensaje, $cabeceras);

                    if ( $mail === TRUE ) {

                     registrarMailBD($para, $titulo, $cc, $link);
                       // echo "mail enviado";
                 }
                 else {
                    return "errormail";
                        // echo "error mail";
                }
            }

        }


    }
    break;



    case 'pm-alta-anu':

    $opt = explode('-', $opt);

    $q = 'SELECT a.*, d.*, m.*, c.*, c.codigopostal as codpostalcentro, c.localidad as localcentro, c.provincia as provcentro, md.fechadocini, md.fechadocfin, md.horariodoc, md.numhorasdoc, d.poblacion as poblacion_docente, d.provincia as provincia_docente, m.observaciones as observmat, d.porcentajediscapacidad, a.diploma, d.documento as cifproveedor
    FROM mat_doc md, docentes d, matriculas m, acciones a, centros c
    WHERE md.id_matricula = m.id
    AND m.id_accion = a.id
    AND md.id_docente = d.id
    AND m.centro = c.id
    AND (tipo_docente <> "Externo" OR d.documento = "B76571140")
    AND (d.situacionlaboral IN("Generar","Desempleado")
    OR ( d.documento = "B76571140" AND situacionlaboral = "Autonomo" ))
    AND m.estado IN("Comunicada","Anulada")
    AND m.fechafin > "'.date('Y-m-d').'"
    AND m.id = '.$opt[0].'
    AND d.id = '.$opt[1];
                // echo $q;
    $q = mysqli_query($link, $q);

    $fechaAlta = date("d/m/Y H:i");

    $nrows = mysqli_num_rows($q);

    if ( $nrows > 0 ) {

        $row = mysqli_fetch_array($q);

        if ( $row['cifproveedor'] == "B76571140" ) {
            $docente = $row[nombredocente].' '.$row[apellidodocente].' '.$row[apellido2docente];
            $row[documento] = $row[documentodocente];
        } else {
            $docente = $row[nombre].' '.$row[apellido].' '.$row[apellido2];
        }

        $fechadocini = $row[fechadocini];
        $fechadocfin = $row[fechadocfin];
        $horariodoc = $row[horariodoc];
        $numhorasdoc = $row[numhorasdoc];
        $diascheck = $row[diascheck];
//
        $cc = 'backup-gestion@eduka-te.com, ivan.cabrera@eduka-te.com,margarita.mitkova@eduka-te.com';
                    // $para = 'patricia_asesoriaha@hotmail.com,Patricia.asesorialaboral@gmail.com';

        if ( $row['cifproveedor'] == "B76571140" ) {
            $empresa = ' en ISLAS PREVENCIÓN';
            // $emailcc = ', fernando@islasprevencion.com';
            $mensajeislas = '<strong>La empresa encargada de la formación es ISLAS PREVENCIÓN</strong>';
        }

        //$para = 'laboral@basefis.com';
                     $para = 'ivan.cabrera@eduka-te.com';
                    // $cc = 'ivan.cabrera@eduka-te.com';
        $titulo = 'Asesoría: Alta Laboral '.$empresa.' ANULADA para '.$docente.' - '.$numeroaccion. '/' .$grupo;
        $tituloanu = 'Asesoría: Alta Laboral '.$empresa.' para '.$docente.' - '.$numeroaccion. '/' .$grupo;
        $mensaje = "<br/><b>".'Datos del Curso'."</b><br/>";
        $mensaje .= "<br/>".'Denominación: '.$row[denominacion];
        $mensaje .= "<br/>".'Acción/Grupo: '.$numeroaccion.'/'.$grupo;
        $mensaje .= "<br/>".'Centro: '.$row[nombrecentro].': '.$row[direccioncentro].', '.$row[codpostalcentro].', '.$row[localcentro].', '.$row[provcentro];
        $mensaje .= "<br/>".'Coste/Hora bruto docencia: '.$row[preciohora];

        $mensaje .= "<br/><br/><b>".'Datos del Docente'."</b><br/>";

        if ( $row['situacionlaboral'] == 'Generar' ) $row['situacionlaboral'] = "Alta laboral";
        $mensaje .= "<br/>".'<b>Situación Laboral: '.$row['situacionlaboral'].'</b>';

        $mensaje .= "<br/><br/>".'Nombre: '.$docente;

        $mensaje .= "<br/>".'Fechas: '.formateaFecha($fechadocini). ' - '.formateaFecha($fechadocfin);
        $mensaje .= "<br/>".'Horario: '.$horariodoc;
        $mensaje .= "<br/>".'Días: '.$diascheck;
        $mensaje .= "<br/>".'Nº Horas: '.$numhorasdoc;
        $mensaje .= "<br/>".'Dirección: '.$row[direccion];
        $mensaje .= "<br/>".'Localidad: '.$row[poblacion_docente];
        $mensaje .= "<br/>".'Provincia: '.$row[provincia_docente];
        $mensaje .= "<br/>".'Titulación: '.$row[titulacion];
        if ( $row[porcentajediscapacidad] != "" && $row[porcentajediscapacidad] !== NULL )
            $mensaje .= "<br/>".'Titulación: '.$row[titulacion];
        $mensaje .= "<br/>".'Titulación: '.$row[titulacion];
        $mensaje .= "<br/><br/>".'Datos Alta SS '."<br/>".'Nº SS: '.$row[niss]."<br/>".'Número de Cuenta: '.$row[numcuenta];
        $mensaje .= "<br/>".'NIF/NIE: '.$row[documento];
        if ( $row['situacionlaboral'] == 'Generar' ) $row['situacionlaboral'] = "Alta laboral";
        $mensaje .= "<br/>".'Situación Laboral: '.$row['situacionlaboral'];
        $mensaje .= "<br/><br/>".'Observaciones '."<br/>".$row[observmat];

        $mensaje .= "<br/><br/>".$mensajeislas."</br>";


                    // Cabeceras adicionales
        $cabeceras .= 'Cc: '.$cc. "\r\n";
        $cabeceras .= 'Bcc: backup-gestion@eduka-te.com' . "\r\n";
        $cabeceras .= 'From: Gestion EDUKA-TE <gestion@eduka-te.com>' . "\r\n";

        $q2 = 'SELECT id
        FROM registro_emails
        WHERE titulo = "'.$tituloanu.'"';
        $q2 = mysqli_query($link, $q2);

        $tituloanu = $tituloanu.' anulado';
        while ( $r = mysqli_fetch_array($q2) ) {

            $q1 = 'UPDATE registro_emails SET titulo = "'.$tituloanu.'" WHERE id = '.$r[id];
            $q1 = mysqli_query($link, $q1);

        }

    }
    break;

    case 'p-acuerdos':

    if ( $opt != NULL ) {

        $q = 'SELECT nombre, apellido, apellido2
        FROM docentes WHERE id = '.$opt;
        $q = mysqli_query($link, $q);

        $row = mysqli_fetch_array($q);
        $docente = $row[nombre].' '.$row[apellido].' '.$row[apellido2];

        $para = 'backup-gestion@eduka-te.com';
        $cc = 'backup-gestion@eduka-te.com';
        $titulo = 'Alta Laboral para '.$docente.' - '.$numeroaccion. '/' .$grupo;
        $mensaje = "<br/><br/>".'Ir a <a href="http://gestion.EDUKA-TE.com/app/index.php?docente">docentes</a>';
                    // Cabeceras adicionales
        $cabeceras .= 'From: Gestion EDUKA-TE <gestion@eduka-te.com>' . "\r\n";

    }

    break;


    case 'td-ini':

    $para = 'margarita.mitkova@eduka-te.com';
    $cc = 'ivan.cabrera@eduka-te.com,margarita.mitkova@eduka-te.com';
                // $para = 'ivan.cabrera@eduka-te.com';
    $titulo = '['.$opt2.'] Acción '.$numeroaccion. '/' .$grupo.' comunicada';
    $mensaje = 'Acción '.$numeroaccion. '/' .$grupo.' comunicada';
                // Cabeceras adicionales
    $cabeceras .= 'Cc: '.$cc. "\r\n";
    $cabeceras .= 'From: Gestion EDUKA-TE <gestion@eduka-te.com>' . "\r\n";
    break;

    case 'pm-anu':

    $para = 'gestion@eduka-te.com';
    $cc = 'margarita.mitkova@eduka-te.com,ivan.cabrera@eduka-te.com,backup-gestion@eduka-te.com,backup-gestion@eduka-te.com';
    $titulo = '['.$opt2.'] Acción Presencial/Mixta '.$numeroaccion. '/' .$grupo. ' ANULADA';
    $mensaje = 'Se anuló la acción '.$numeroaccion. '/' .$grupo.' anulada';
    $mensaje   .=  "<br/><br/>".'Ir a <a href="http://gestion.EDUKA-TE.com/app/index.php?presencial">las matrículas presenciales</a>';
                // Cabeceras adicionales
    $cabeceras .= 'Cc: '.$cc. "\r\n";
    $cabeceras .= 'From: Gestion EDUKA-TE <gestion@eduka-te.com>' . "\r\n";
    break;

    case 'td-anu':

    $para = 'gestion@eduka-te.com';
    $cc = 'margarita.mitkova@eduka-te.com,ivan.cabrera@eduka-te.com,backup-gestion@eduka-te.com,backup-gestion@eduka-te.com';
    $titulo = '['.$opt2.'] Acción Online '.$numeroaccion. '/' .$grupo. ' ANULADA';
    $mensaje = 'Se anuló la acción '.$numeroaccion. '/' .$grupo.' anulada';
    $mensaje   .=  "<br/><br/>".'Ir a <a href="http://gestion.EDUKA-TE.com/app/index.php?presencial">las matrículas presenciales</a>';
                // Cabeceras adicionales
    $cabeceras .= 'Cc: '.$cc. "\r\n";
    $cabeceras .= 'From: Gestion EDUKA-TE <gestion@eduka-te.com>' . "\r\n";
    break;

    case 'td-ini-tutor':

    $q = 'SELECT d.email, a.denominacion, a.modalidad, m.fechaini, m.fechafin, d.nombre, d.apellido, d.documento, a.url, ga.ngrupo, u.user, d.email2
    FROM grupos_acciones ga, acciones a, matriculas m, mat_doc md, docentes d, usuarios u
    WHERE m.id_grupo = ga.id
    AND ga.id_accion = m.id_accion
    AND ga.id_accion = a.id
    AND md.id_matricula = m.id
    AND md.id_docente = d.id
    AND u.id_docente = d.id
    AND a.numeroaccion = '.$numeroaccion.'
    AND ga.ngrupo = "'.$grupo.'"';
    $q = mysqli_query($link, $q);
    $row = mysqli_fetch_assoc($q);

    $emailtutor = $row[email];
    $denominacion = $row[denominacion];
    $fechaini = $row[fechaini];
    $fechafin = $row[fechafin];
    $nombre = $row[nombre];
    $apellido = $row[apellido];
    $documento = $row[documento];
    $url = $row[url];
    $modalidad = $row[modalidad];

    if ($row[email2] != "")
        $email2 = ', '.$row[email2];
                // $ngrupo = $row[ngrupo];

    $url = explode('.com/', $row[url]);
                if ( $url[1][0] != 'a'  ) { // MOODLE

                    $usuario = $row[user];
                    $pass = 'Tutor-EDUKA-TE15';

                } else if ( strpos($grupo, 'p') !== FALSE ) {

                    $usuario = 'TutorEDUKA-TE1';
                    $pass = 'EDUKA-TE2013';

                } else {

                    $usuario = 'Tsuptrip';
                    $pass = 'EDUKA-TE2013';

                }

                $para = $emailtutor.$email2;
                $cc = 'ivan.cabrera@eduka-te.com';
                $titulo = 'Nueva tutoría '.$numeroaccion. '/' .$grupo.' asignada - Fecha Inicio: '.date("d/m/Y", strtotime($fechaini));
                $mensaje = 'Se le ha asignado la tutoría de la acción formativa '.$numeroaccion. '/' .$grupo.': '.$denominacion;


                if ( $modalidad == "A Distancia" ) {

                    $mensaje .= '<br/><br/> Recuerde que esta formación es a distancia y debe procurar que la mayoría de los contactos con el alumno sean por correo electrónico.<br>';

                } else if ( $modalidad == "Teleformación" ) {

                    $mensaje   .=  "<br/><br/>".'Datos para acceder a la plataforma: <BR>
                    <br/>Enlace: <a href="'.$url.'">'.$url.'</a>
                    <br/>Usuario: '.$usuario.'
                    <br/>Contraseña: '.$pass;

                }


                    // $user = normaliza(strtolower($row[user]));
                    // $mensaje   .=  "<br/><br/>".'Tu usuario de acceso a la Aplicación EDUKA-TE son: ';
                    // $mensaje   .=  "<br/>".'Usuario: '.$row[user];
                    // $mensaje   .=  "<br/>".'Contraseña: '.$documento.'@eduka-te';
                    // $mensaje   .=  "<br/><br/>".'Ir a <a href="http://gestion.EDUKA-TE.com/app/index.php?tutorias">tus tutorías</a> en Gestión EDUKA-TE.';
                $mensaje   .=  "<br/><br/><hr>".'

                <p>La Aplicaci&oacute;n de Gesti&oacute;n de EDUKA-TE es una potente herramienta que facilita nuestra labor como tutores y tutoras y que, adem&aacute;s permite optimizar tiempo y esfuerzos. </p>

                <p>Desde la aplicaci&oacute;n se podr&aacute; ver toda la informaci&oacute;n relativa al alumno/a, as&iacute; como al curso que realiza. Podremos ir introduciendo los datos referidos a las tutorizaciones realizadas y visualizar todo lo relativo al alumno/a en un mismo espacio.</p>

                <p>&iquest;Qu&eacute; encontraremos y qu&eacute; haremos en la aplicaci&oacute;n?</p>

                <ul>
                    <li>A&ntilde;adir contacto. Este bot&oacute;n nos permitir&aacute; a&ntilde;adir los datos de una tutorizaci&oacute;n. </li>
                    <li>Barra de progreso. Debemos ir actualizando la barra de progreso del alumno/a en relaci&oacute;n a su progreso en el curso.
                        <li>Fecha. La fecha se marca por defecto, no obstante podremos modificarla (esto ser&aacute; muy &uacute;til a la hora de introducir los datos referidos a tutor&iacute;as pasadas. OJO, debemos emplear el formato que se utiliza desde la aplicaci&oacute;n)
                        </li>
                        <li>Contacto. Seleccionaremos el tipo de contacto (correo plataforma, correo personal, llamada, seguimiento). En el caso de que enviemos el mismo correo por la plataforma y al correo personal del alumno/a lo a&ntilde;adiremos como contactos diferentes (ser&aacute;n dos diferentes). En el caso de las llamadas, en el apartado respuesta, debemos anotar si se ha dejado mensaje en el buz&oacute;n de voz, no se ha atendido la llamada, etc. Emplearemos seguimiento, &agrave;ra anotar en &quot;contenido tutorizaci&oacute;n&quot; el progreso del alumno/a siempre y cuando no contactemos por las v&iacute;as establecidas (hay ocasiones en las que miramos su progreso y al por ejemplo, no haber avanzado decidimos no agobiarlo con un nuevo correo); anotaremos tambi&eacute;n observaciones al respecto si as&iacute; lo consideramos. - </li>
                        <li>Contenido tutorizaci&oacute;n. Anotaremos el contenido del contacto realizado (progreso del alumno, material complementario aportado, observaciones relevantes, etc.) Intentaremos detallar este apartado.
                        </li>
                    </ul>

                    <p>Como ver&aacute;n, esta herramienta, adem&aacute;s de facilitar nuestro trabajo, nos permitir&aacute; organizar mejor la informaci&oacute;n, as&iacute; como optimizar tiempo y esfuerzo. </p>

                    <p> Muchas gracias por tu colaboraci&oacute;n.</p>';

                // }

                //Cabeceras adicionales
                    $cabeceras .= 'Cc: '.$cc. "\r\n";
                    $cabeceras .= 'From: Gestion EDUKA-TE <gestion@eduka-te.com>' . "\r\n";
                    break;

            case 'td-fin': //

            $q = 'SELECT m.estado, id_solicitudikea
            FROM grupos_acciones ga, acciones a, matriculas m
            WHERE m.id_grupo = ga.id
            AND ga.id_accion = m.id_accion
            AND ga.id_accion = a.id
            AND a.numeroaccion = '.$numeroaccion.'
            AND ga.ngrupo = "'.$grupo.'"';
            $q = mysqli_query($link, $q);

            $row = mysqli_fetch_assoc($q);
            $estado = $row[estado];

            if ( $row[id_solicitudikea] != "0" && $row[id_solicitudikea] != NULL )
                $IKEA = ' IKEA ';
            else
                $IKEA = '';

            if ( $estado != 'Anulada' ) {

                $para = 'backup-gestion@eduka-te.com';
                $cc = 'margarita.mitkova@eduka-te.com, margarita.mitkova@eduka-te.com, ivan.cabrera@eduka-te.com';
                $titulo = 'Para facturar '.$IKEA.$numeroaccion. '/' .$grupo. ' Online/Distancia Individual';
                $mensaje = 'Acción '.$numeroaccion. '/' .$grupo.' finalizada';
                    // Cabeceras adicionales
                $cabeceras .= 'Cc: '.$cc. "\r\n";
                $cabeceras .= 'From: Gestion EDUKA-TE <gestion@eduka-te.com>' . "\r\n";

            }
            break;

            case 'td-fingrupo': //

            $q = 'SELECT m.estado, id_solicitudikea
            FROM grupos_acciones ga, acciones a, matriculas m
            WHERE m.id_grupo = ga.id
            AND ga.id_accion = m.id_accion
            AND ga.id_accion = a.id
            AND m.grupo = 1
            AND a.numeroaccion = '.$numeroaccion.'
            AND ga.ngrupo = "'.$grupo.'"';
            $q = mysqli_query($link, $q);

            $row = mysqli_fetch_assoc($q);
            $estado = $row[estado];
            if ( $row[id_solicitudikea] != "0" && $row[id_solicitudikea] != NULL )
                $IKEA = ' IKEA ';
            else
                $IKEA = '';

            if ( $estado != 'Anulada' ) {

                $para = 'backup-gestion@eduka-te.com';
                $cc = 'margarita.mitkova@eduka-te.com, margarita.mitkova@eduka-te.com, ivan.cabrera@eduka-te.com';
                $titulo = 'Para facturar '.$IKEA.$numeroaccion. '/' .$grupo. ' GRUPAL Online/Distancia';
                $mensaje = 'Acción '.$numeroaccion. '/' .$grupo.' finalizada';
                    // Cabeceras adicionales
                $cabeceras .= 'Cc: '.$cc. "\r\n";
                $cabeceras .= 'From: Gestion EDUKA-TE <gestion@eduka-te.com>' . "\r\n";

            }
            break;

            case 'td-finp': //

            $para = 'backup-gestion@eduka-te.com';
            $cc = 'ivan.cabrera@eduka-te.com, margarita.mitkova@eduka-te.com, ivan.cabrera@eduka-te.com';
            $titulo = '['.$opt2.'] Para facturar privado '.$numeroaccion. '/' .$grupo. ' Online/Distancia Individual';
            $mensaje = 'Acción '.$numeroaccion. '/' .$grupo.' finalizada';
                // Cabeceras adicionales
            $cabeceras .= 'Cc: '.$cc. "\r\n";
            $cabeceras .= 'From: Gestion EDUKA-TE <gestion@eduka-te.com>' . "\r\n";
            break;

            case 'td-finpgrupo': // se completan costes de privado, listo para facturar parte privada. Incluir Observaciones.

            $str = explode("-", $grupo);
            $id_empresa = $str[1];
            $grupo = $str[0];

            $q = 'SELECT m.observacionesfin, id_solicitudikea
            FROM grupos_acciones ga, acciones a, matriculas m
            WHERE m.id_grupo = ga.id
            AND ga.id_accion = m.id_accion
            AND ga.id_accion = a.id
            AND m.grupo = 1
            AND a.numeroaccion = '.$numeroaccion.'
            AND ga.ngrupo = "'.$grupo.'"';
                // echo $q;
            $q = mysqli_query($link, $q);

            $row = mysqli_fetch_assoc($q);
            $observaciones = $row[observacionesfin];

            if ( $row[id_solicitudikea] != "0" && $row[id_solicitudikea] != NULL )
                $IKEA = ' IKEA ';
            else
                $IKEA = '';

            $q = 'SELECT e.razonsocial
            FROM empresas e
            WHERE e.id = '.$id_empresa;
            $q = mysqli_query($link, $q);

            $row = mysqli_fetch_assoc($q);
            $empresa = $row[razonsocial];
            $fechahora = date('Y-m-d H:i');

            $para       = 'backup-gestion@eduka-te.com';
            $cc         = 'margarita.mitkova@eduka-te.com, ivan.cabrera@eduka-te.com';
            $titulo     = '['.$opt2.'] Para facturar privado '.$IKEA.$numeroaccion. '/' .$grupo.' GRUPAL Online/Distancia '.$empresa.' '.$fechahora;
            $mensaje    = 'Acción '.$numeroaccion. '/' .$grupo.' (parte privada) finalizada';
            $mensaje    =  "<br/><br/>".'Empresa: '.$empresa;
            $mensaje   .=  "<br/><br/>".'Observaciones: '.$observaciones;
            $mensaje   .=  "<br/><br/>".'Ir a <a href="http://gestion.EDUKA-TE.com/app/index.php?presencial_fin">Finalización</a>';

            $cabeceras .= 'Cc: '.$cc. "\r\n";
            $cabeceras .= 'From: Gestion EDUKA-TE <gestion@eduka-te.com>' . "\r\n";
            break;

            case 'td-modfinpgrupo': // se completan costes de privado, listo para facturar parte privada. Incluir Observaciones.

            $str = explode("-", $grupo);
            $id_empresa = $str[1];
            $grupo = $str[0];

            $q = 'SELECT m.observacionesfin, id_solicitudikea
            FROM grupos_acciones ga, acciones a, matriculas m
            WHERE m.id_grupo = ga.id
            AND ga.id_accion = m.id_accion
            AND ga.id_accion = a.id
            AND m.grupo = 1
            AND a.numeroaccion = '.$numeroaccion.'
            AND ga.ngrupo = "'.$grupo.'"';
                // echo $q;
            $q = mysqli_query($link, $q);

            $row = mysqli_fetch_assoc($q);
            $observaciones = $row[observacionesfin];
            if ( $row[id_solicitudikea] != "0" && $row[id_solicitudikea] != NULL )
                $IKEA = ' IKEA ';
            else
                $IKEA = '';

            $q = 'SELECT e.razonsocial
            FROM empresas e
            WHERE e.id = '.$id_empresa;
            $q = mysqli_query($link, $q);

            $row = mysqli_fetch_assoc($q);
            $empresa = $row[razonsocial];
            $fechahora = date('Y-m-d H:i');

            $para       = 'backup-gestion@eduka-te.com';
            $cc         = 'margarita.mitkova@eduka-te.com, ivan.cabrera@eduka-te.com';
            $titulo     = '['.$opt2.'] Para facturar privado '.$IKEA.$numeroaccion. '/' .$grupo.' GRUPAL Online/Distancia '.$empresa.' '.$fechahora;
            $mensaje    = 'Acción '.$numeroaccion. '/' .$grupo.' (parte privada) finalizada';
            $mensaje    =  "<br/><br/>".'Empresa: '.$empresa;
            $mensaje   .=  "<br/><br/>".'Observaciones: '.$observaciones;
            $mensaje   .=  "<br/><br/>".'Ir a <a href="http://gestion.EDUKA-TE.com/app/index.php?presencial_fin">Finalización</a>';

            $cabeceras .= 'Cc: '.$cc. "\r\n";
            $cabeceras .= 'From: Gestion EDUKA-TE <gestion@eduka-te.com>' . "\r\n";
            break;

            case 'pm-ini': // ok

            //$para = 'mchinea@eduka-te.com';
            $para = 'margarita.mitkova@eduka-te.com';
            $cc = 'ivan.cabrera@eduka-te.com,margarita.mitkova@eduka-te.com';
            $titulo = '['.$opt2.'] Acción '.$numeroaccion. '/' .$grupo.' comunicada';
            $mensaje = 'Acción '.$numeroaccion. '/' .$grupo.' comunicada';
                // Cabeceras adicionales

            $cabeceras .= 'From: Gestion EDUKA-TE <gestion@eduka-te.com>' . "\r\n";
            break;

            case 'pm-fin': // ok


            $q = 'SELECT m.observacionesfin, m.estado, m.id_solicitudikea
            FROM grupos_acciones ga, acciones a, matriculas m
            WHERE m.id_grupo = ga.id
            AND ga.id_accion = m.id_accion
            AND ga.id_accion = a.id
            AND a.numeroaccion = '.$numeroaccion.'
            AND ga.ngrupo = "'.$grupo.'"';
                // return $q;
            $q = mysqli_query($link, $q) or die("error " .mysqli_error($link) );

            $row = mysqli_fetch_assoc($q);
            $observaciones = $row[observacionesfin];
            $estado = $row[estado];
            if ( $row[id_solicitudikea] != "0" && $row[id_solicitudikea] != NULL )
                $IKEA = ' IKEA ';
            else
                $IKEA = '';

            if ( $estado != 'Anulada' ) {

                $para = 'backup-gestion@eduka-te.com';
                $cc = 'margarita.mitkova@eduka-te.com';
                $titulo = 'Para facturar '.$IKEA.$numeroaccion. '/' .$grupo. ' Presencial/Mixta';
                $mensaje = 'Acción '.$numeroaccion. '/' .$grupo.' finalizada';
                $mensaje   .=  "<br/><br/>".'Observaciones: '.$observaciones;
                    // Cabeceras adicionales
                $cabeceras .= 'From: Gestion EDUKA-TE <gestion@eduka-te.com>' . "\r\n";

            }

            break;

            // case 'od-act': // ?

            //     $para = 'ivan.cabrera@eduka-te.com';
            //     $cc = 'abenitez@eduka-te.com';
            //     $titulo = 'Cambios en acción '.$numeroaccion. '/' .$grupo. ' Online/Distancia';
            //     $mensaje = 'Acción '.$numeroaccion. '/' .$grupo.' actualizada';
            //     // Cabeceras adicionales
            //     $cabeceras .= 'Cc: '.$cc. "\r\n";
            //     $cabeceras .= 'From: Gestion EDUKA-TE <gestion@eduka-te.com>' . "\r\n";
            //     break;

            // case 'p-act': // ok

            //     $para = 'gestion@eduka-te.com';
            //     $cc = 'abenitez@eduka-te.com';
            //     $titulo = 'Cambios en acción '.$numeroaccion. '/' .$grupo. ' Presencial';
            //     $mensaje = 'Acción '.$numeroaccion. '/' .$grupo.' actualizada';
            //     // Cabeceras adicionales
            //     $cabeceras .= 'Cc: '.$cc. "\r\n";
            //     $cabeceras .= 'From: Gestion EDUKA-TE <gestion@eduka-te.com>' . "\r\n";
            //     break;


            case 'p-act-nuevaemp': // ok

            $para = 'ivan.cabrera@eduka-te.com';
            $cc = 'margarita.mitkova@eduka-te.com,margarita.mitkova@eduka-te.com';
            $titulo = '['.$opt2.'] Modificación de empresas en acción presencial '.$numeroaccion. '/' .$grupo.' '.rand(1,1000);
            $mensaje = '';
                // Cabeceras adicionales
            $cabeceras .= 'Cc: '.$cc. "\r\n";
            $cabeceras .= 'From: Gestion EDUKA-TE <gestion@eduka-te.com>' . "\r\n";
            break;

            case 'p-act-nuevaempgrupal': // ok

            $para = 'ivan.cabrera@eduka-te.com';
            $cc = 'margarita.mitkova@eduka-te.com';
            $titulo = '['.$opt2.'] Modificación de empresas en acción GRUPAL '.$numeroaccion. '/' .$grupo.' '.rand(1,1000);
            $mensaje = '';
                // Cabeceras adicionales
            $cabeceras .= 'Cc: '.$cc. "\r\n";
            $cabeceras .= 'From: Gestion EDUKA-TE <gestion@eduka-te.com>' . "\r\n";
            break;

            // case 'm-act': // no

            //     $para = 'gestion@eduka-te.com';
            //     $cc = 'abenitez@eduka-te.com';
            //     $titulo = 'Cambios en acción '.$numeroaccion. '/' .$grupo. ' Mixta';
            //     $mensaje = 'Acción '.$numeroaccion. '/' .$grupo.' actualizada';
            //     // Cabeceras adicionales
            //     $cabeceras .= 'Cc: '.$cc. "\r\n";
            //     $cabeceras .= 'From: Gestion EDUKA-TE <gestion@eduka-te.com>' . "\r\n";
            //     break;

            case 'm-ini': // no

            $para       = 'gestion@eduka-te.com';
            $cc = 'margarita.mitkova@eduka-te.com,ivan.cabrera@eduka-te.com, margarita.mitkova@eduka-te.com';
            $titulo     = '['.$opt2.'] Nueva matrícula mixta creada '.$numeroaccion. '/' .$grupo;
            $mensaje    = 'Se creó la matrícula '.$numeroaccion. '/' .$grupo;

                // Cabeceras adicionales
            $cabeceras .= 'Cc: '.$cc. "\r\n";
            $cabeceras .= 'From: Gestion EDUKA-TE <gestion@eduka-te.com>' . "\r\n";
            break;

            case 'p-ini': // ok

            $para       = 'margarita.mitkova@eduka-te.com';
            //$para       = 'mchinea@eduka-te.com';
            $cc = 'ivan.cabrera@eduka-te.com, margarita.mitkova@eduka-te.com';
            $titulo     = '['.$opt2.'] Nueva matrícula presencial creada '.$numeroaccion. '/' .$grupo;
            $mensaje    = 'Se creó la matrícula '.$numeroaccion. '/' .$grupo;

                // Cabeceras adicionales
            $cabeceras .= 'Cc: '.$cc. "\r\n";
            $cabeceras .= 'From: Gestion EDUKA-TE <gestion@eduka-te.com>' . "\r\n";
            break;

            case 'od-ini': // ?

            $para       = 'ivan.cabrera@eduka-te.com';
            $cc = 'margarita.mitkova@eduka-te.com,margarita.mitkova@eduka-te.com';
            $titulo     = '['.$opt2.'] Nueva matrícula Online/Distancia creada '.$numeroaccion. '/' .$grupo;
            $mensaje    = 'Se creó la matrícula '.$numeroaccion. '/' .$grupo;

                // Cabeceras adicionales
            $cabeceras .= 'Cc: '.$cc. "\r\n";
            $cabeceras .= 'From: Gestion EDUKA-TE <gestion@eduka-te.com>' . "\r\n";
            break;

            case 'fin': // ok - finp ? no hay caso.

            $para       = 'ivan.cabrera@eduka-te.com';
            $cc         = 'margarita.mitkova@eduka-te.com';
            $titulo     = 'Acción '.$numeroaccion. '/' .$grupo.' lista para finalizar';
            $mensaje    = 'Se subió un excel de finalización para la acción '.$numeroaccion. '/' .$grupo;

            $cabeceras .= 'Cc: '.$cc. "\r\n";
            $cabeceras .= 'From: Gestion EDUKA-TE <gestion@eduka-te.com>' . "\r\n";
            break;

            case 'doc': // se sube documentación bonificado

            $para       = 'margarita.mitkova@eduka-te.com';
            $cc         = 'ivan.cabrera@eduka-te.com';
            $titulo     = '['.$opt2.'] Se generó documentación para la acción '.$numeroaccion. '/' .$grupo;
            $mensaje    = 'Se subió un excel para documentación de la acción '.$numeroaccion. '/' .$grupo;
            $mensaje   .=  "<br/><br/>".'Ir a <a href="http://gestion.EDUKA-TE.com/app/index.php?presencial_doc">Documentación</a>';

            $cabeceras .= 'Cc: '.$cc. "\r\n";
            $cabeceras .= 'From: Gestion EDUKA-TE <gestion@eduka-te.com>' . "\r\n";
            break;

            case 'docp': // se sube documentación de privado

            $para       = 'margarita.mitkova@eduka-te.com';
            $cc         = 'ivan.cabrera@eduka-te.com';
            $titulo     = '['.$opt2.'] Se generó documentación para la acción de privado '.$numeroaccion. '/' .$grupo;
            $mensaje    = 'Se subió un excel para documentación de la acción '.$numeroaccion. '/' .$grupo;
            $mensaje   .=  "<br/><br/>".'Ir a <a href="http://gestion.EDUKA-TE.com/app/index.php?presencial_doc">Documentación</a>';

            $cabeceras .= 'Cc: '.$cc. "\r\n";
            $cabeceras .= 'From: Gestion EDUKA-TE <gestion@eduka-te.com>' . "\r\n";
            break;

            case 'pm-finp': // se completan costes de privado, listo para facturar parte privada. Incluir Observaciones.

            $str = explode("-", $grupo);
            $id_empresa = $str[1];
            $grupo = $str[0];

            $q = 'SELECT m.observacionesfin
            FROM grupos_acciones ga, acciones a, matriculas m
            WHERE m.id_grupo = ga.id
            AND ga.id_accion = m.id_accion
            AND ga.id_accion = a.id
            AND m.grupo = 0
            AND a.numeroaccion = '.$numeroaccion.'
            AND ga.ngrupo = "'.$grupo.'"';
                // echo $q;
            $q = mysqli_query($link, $q);

            $row = mysqli_fetch_assoc($q);
            $observaciones = $row[observacionesfin];


            $q = 'SELECT e.razonsocial
            FROM empresas e
            WHERE e.id = '.$id_empresa;
            $q = mysqli_query($link, $q);

            $row = mysqli_fetch_assoc($q);
            $empresa = $row[razonsocial];
            $fechahora = date('Y-m-d H:i');

            $para       = 'backup-gestion@eduka-te.com';
            $cc         = 'margarita.mitkova@eduka-te.com, ivan.cabrera@eduka-te.com';
            $titulo     = '['.$opt2.'] Para facturar privado '.$numeroaccion. '/' .$grupo.' Presencial/Mixta '.$empresa.' '.$fechahora;
            $mensaje    = 'Acción '.$numeroaccion. '/' .$grupo.' (parte privada) finalizada';
            $mensaje    =  "<br/><br/>".'Empresa: '.$empresa;
            $mensaje   .=  "<br/><br/>".'Observaciones: '.$observaciones;
            $mensaje   .=  "<br/><br/>".'Ir a <a href="http://gestion.EDUKA-TE.com/app/index.php?presencial_fin">Finalización</a>';

            $cabeceras .= 'Cc: '.$cc. "\r\n";
            $cabeceras .= 'From: Gestion EDUKA-TE <gestion@eduka-te.com>' . "\r\n";
            break;

            case 'pm-modfinpgrupo': // se actualizan los costes de privado

            $str = explode("-", $grupo);
            $id_empresa = $str[1];
            $grupo = $str[0];

            $q = 'SELECT m.observacionesfin
            FROM grupos_acciones ga, acciones a, matriculas m
            WHERE m.id_grupo = ga.id
            AND ga.id_accion = m.id_accion
            AND ga.id_accion = a.id
            AND a.numeroaccion = '.$numeroaccion.'
            AND ga.ngrupo = "'.$grupo.'"';
                // echo $q;
            $q = mysqli_query($link, $q);

            $row = mysqli_fetch_assoc($q);
            $observaciones = $row[observacionesfin];


            $q = 'SELECT e.razonsocial
            FROM empresas e
            WHERE e.id = '.$id_empresa;
            $q = mysqli_query($link, $q);

            $row = mysqli_fetch_assoc($q);
            $empresa = $row[razonsocial];
            $fechahora = date('Y-m-d H:i');

            $para       = 'backup-gestion@eduka-te.com';
            $cc         = 'margarita.mitkova@eduka-te.com, ivan.cabrera@eduka-te.com';
            $titulo     = '['.$opt2.'] Para facturar privado '.$numeroaccion. '/' .$grupo.' Presencial/Mixta '.$empresa.' '.$fechahora;
            $mensaje    = 'Acción '.$numeroaccion. '/' .$grupo.' (parte privada) finalizada';
            $mensaje    =  "<br/><br/>".'Empresa: '.$empresa;
            $mensaje   .=  "<br/><br/>".'Observaciones: '.$observaciones;
            $mensaje   .=  "<br/><br/>".'Ir a <a href="http://gestion.EDUKA-TE.com/app/index.php?presencial_fin">Finalización</a>';
                // echo $mensaje;
            $cabeceras .= 'Cc: '.$cc. "\r\n";
            $cabeceras .= 'From: Gestion EDUKA-TE <gestion@eduka-te.com>' . "\r\n";
            break;

            case 'act-fin': // se actualiza la formacion a finalizada. Incluir a ISA cuando se actualicen todos.

            $para       = 'ivan.cabrera@eduka-te.com';
            $cc         = 'margarita.mitkova@eduka-te.com';
            $titulo     = 'Formación Online/Distancia finalizada '.$numeroaccion. '/' .$grupo;
            $mensaje    = 'Se finalizó la formación de la acción '.$numeroaccion. '/' .$grupo;
            $mensaje   .=  "<br/><br/>".'Ir a <a href="http://gestion.EDUKA-TE.com/app/index.php?tutorias">tutorías</a>';

            $cabeceras .= 'Cc: '.$cc. "\r\n";
            $cabeceras .= 'From: Gestion EDUKA-TE <gestion@eduka-te.com>' . "\r\n";
            break;

            case 'observacionesfin':
            $para       = 'backup-gestion@eduka-te.com';
                // $cc         = 'margarita.mitkova@eduka-te.com, abenitez@eduka-te.com';
            $titulo     = '['.$opt2.'] Observaciones de finalización guardadas '.$numeroaccion. '/' .$grupo;
            $mensaje    = 'Observaciones: '.$opt;
                // $mensaje   .=  "<br/><br/>".'Ir a <a href="http://gestion.EDUKA-TE.com/app/index.php?tutorias">tutorías</a>';

                // $cabeceras .= 'Cc: '.$cc. "\r\n";
            $cabeceras .= 'From: Gestion EDUKA-TE <gestion@eduka-te.com>' . "\r\n";
            break;

            case 'mat_subida': // ok

            $para = 'margarita.mitkova@eduka-te.com';
            $titulo = '['.$opt2.'] Matrícula de la Acción '.$numeroaccion. '/' .$grupo.' subida';
            $mensaje = 'Acción '.$numeroaccion. '/' .$grupo.' - Matrícula ubida';
                // Cabeceras adicionales

            $cabeceras .= 'From: Gestion EDUKA-TE <gestion@eduka-te.com>' . "\r\n";
            break;


        }
      // echo $q;
        if ( !isset($opt) ) $opt = '';
        $cabeceras .= 'Cc: '.$cc. "\r\n";
        $cabeceras .= 'From: Gestion EDUKA-TE <gestion@eduka-te.com>' . "\r\n";
        $cabeceras .= 'Bcc: backup-gestion@eduka-te.com' . $ccodani . "\r\n";

        if ($NoEnvia != 1) {
            if ( compruebaEnvioEmail($titulo, $link) != 1 || $envia == 1 ) {
                $mail = mail($para, $titulo, $mensaje, $cabeceras);

                if ( $mail === TRUE )
                 registrarMailBD($para, $titulo, $cc, $link, $opt);
             else
                return "errormail";
        }
    }

}




function compruebaEnvioEmail($titulo, $link) {


    $q1 = "SELECT * FROM registro_emails
    WHERE titulo IN('" .$titulo. "')";
    // echo $q1;
    $q1 = mysqli_query($link, $q1);

    if ( mysqli_num_rows($q1) > 0 ) return 1;
    else return 0;

}

function compruebaEnvioEmailFac($titulo, $link) {


    // $q3 = "SELECT MATCH (titulo) AGAINST('".$titulo."') AS score, fecha
    // FROM registro_emails
    // WHERE MATCH (titulo) AGAINST('".$titulo."')";
    // $q3 = "SELECT MATCH (titulo) AGAINST('".$titulo."') AS score, fecha
    $q3 = "SELECT fecha FROM registro_emails
    WHERE titulo IN('" .$titulo. "')";
    // echo $q3;
    $q3 = mysqli_query($link, $q3) or die('error' . mysqli_error($link));
    $r2 = mysqli_fetch_array($q3);

    // return $row[fecha];
    if ( mysqli_num_rows($q3) > 0 ) {
        $row = mysqli_fetch_array($q3);
        // echo $r2[fecha];
        $fecha = $r2[fecha];
        return $fecha;
    }
    else return 0;

}

function registrarMailBD ($para, $titulo, $cc, $link, $opt = NULL, $opt2 = NULL) {


    $q = 'INSERT INTO registro_emails
    (`fecha`, `para`, `cc`, `titulo`, `mensaje`, `opt`)
    VALUES
    ("'. date("Y-m-d H:i") .'","'. $para .'","'. $cc .'","'. $titulo .'","'. $opt .'","'. $opt2 .'")';
    // else
    //     $q = 'INSERT INTO registro_emails
    //     (`fecha`, `para`, `cc`, `titulo`)
    //     VALUES
    //     ("'. date("Y-m-d H:i") .'","'. $para .'","'. $cc .'","'. $titulo .'")';
    // echo $q;
    $q = mysqli_query($link, $q) or die("Error insert en bbdd " .mysqli_error($link));

}

function registrarMailBDparams ($para, $titulo, $cc, $id_mat, $id_alu, $link) {

    $q = 'INSERT INTO registro_emails
    (`fecha`, `para`, `cc`, `titulo`, `id_mat`, `id_alu`)
    VALUES
    ("'. date("Y-m-d H:i") .'","'. $para .'","'. $cc .'","'. $titulo .'","'. $id_mat .'","'. $id_alu .'")';
    // echo $q;
    $q = mysqli_query($link, $q) or die("Error");

}

function insertarContactos ($id, $contactos, $link) {

    echo "id empresa: ".$id;

    $contactos = array_chunk($contactos,6);
    $numContactos = sizeof($contactos);

    //print_r($contactos);
    for ($i=0; $i < sizeof($contactos); $i++) {
        $contactosEmpresa .= '( '.$id.', ';
        for ($j=0; $j < sizeof($contactos[$i]) ; $j++) {
            $contactosEmpresa .= "'".$contactos[$i][$j][value]."'";
            if ( $j < sizeof($contactos[$i])-1 )
                $contactosEmpresa .= ', ';
        }
        if ( $i < sizeof($contactos)-1 )
            $contactosEmpresa .= '), ';
        else
            $contactosEmpresa .= ')';
    }
    echo($contactosEmpresa);

    $q = 'INSERT INTO contactos
    (id_empresa, nombre, apellido, apellido2, telefonoc, emailc, cargo)
    VALUES '.$contactosEmpresa;
    echo $q;
    $q = mysqli_query($link, $q) or die("error");

}

function normaliza ($cadena) {
    $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕñ';
    $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRrn';
    $cadena = utf8_decode($cadena);
    $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
    $cadena = strtolower($cadena);
    return utf8_encode($cadena);
}

function quitaTildes ($cadena) {
    $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕñ';
    $modificadas = 'AAAAAAACEEEEIIIIDNOOOOOOUUUUYbsaaaaaaaceeeeiiiidnoooooouuuyybyRrn';
    $cadena = utf8_decode($cadena);
    $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
    return utf8_encode($cadena);
}

function quitaTildesSMS ($cadena) {
    $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðòóôõöøùúûýýþÿ';
    $modificadas = 'AAAAAAACEEEEIIIIDOOOOOOUUUUYbsaaaaaaaceeeeiiiidoooooouuuyyby';
    $cadena = utf8_decode($cadena);
    $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
    return utf8_encode($cadena);
}

function quitaTildesConComas ($cadena) {
    $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕñ,';
    $modificadas = 'AAAAAAACEEEEIIIIDNOOOOOOUUUUYbsaaaaaaaceeeeiiiidnoooooouuuyybyRrn,';
    $cadena = utf8_decode($cadena);
    $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
    $cadena = str_replace(array(',',';'), '', $cadena);
    return utf8_encode($cadena);
}

function quitaTildesConComasyBarras ($cadena) {
    $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕñ,/';
    $modificadas = 'AAAAAAACEEEEIIIIDNOOOOOOUUUUYbsaaaaaaaceeeeiiiidnoooooouuuyybyRrn,-';
    $cadena = utf8_decode($cadena);
    $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
    $cadena = str_replace(array(',',';'), '', $cadena);
    return utf8_encode($cadena);
}

function cuadroCredenciales($id_alu, $id_mat, $link) {

    $i = 0;
    $q = 'SELECT ma.user, ma.pass, a.nombre, a.apellido, a.apellido2, a.documento, ac.url, ac.nsystem, m.fechaini
    FROM mat_alu_cta_emp ma, alumnos a, matriculas m, acciones ac
    WHERE a.id = ma.id_alumno
    AND m.id = ma.id_matricula
    AND m.id_accion = ac.id
    AND m.id = '.$id_mat.'
    AND a.id = '.$id_alu;
    // echo $q;
    $q = mysqli_query($link, $q) or die("error");

    while ( $row = mysqli_fetch_array($q) ) {

        $nombre = $row['nombre'];
        $apellido = $row['apellido'];
        $apellido2 = $row['apellido2'];
        $documento = $row['documento'];
        $user = $row['user'];
        $pass = $row['pass'];
        $url = $row['url'];
        $ncurso = $row[nsystem];
        $fechaini = $row[fechaini];

    }

    if ( ($user == "" && $pass == "") || ($user === undefined && $pass == undefined) ) {

        $pass = normaliza($nombre[0]).trim(normaliza($apellido)).substr($documento, 4,4);
        $url = explode('.com/', $url);

        if ( $url[1][0] != 'a'  ) { // MOODLE

            $nombre = explode(" ", $nombre);
            $nombre = $nombre[0];
            $user = 'alum';
            $anio = strftime('%y', strtotime($fechaini));
            $mes = strftime('%m', strtotime($fechaini));
            $user .= $anio.$mes.substr($documento, 1,4);

            $pass = strtoupper(normaliza($nombre[0])).trim(normaliza($apellido)).substr($documento, 4,4);
        }

    }

    echo '<div id="datoscredenciales" style="overflow:auto; margin-top:10px;">
    <input type="hidden" id="id_alu" value="'. $id_alu .'">
    <input type="hidden" id="id_mat" value="'. $id_mat .'">
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label" for="user">Usuario:</label>
            <input value="'. $user .'" type="text" id="user'.$i.'" name="user" class="form-control" />
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label" for="pass">Contraseña:</label>
            <input value="'. $pass .'" type="text" id="pass'.$i.'" name="pass" class="form-control" />
        </div>
    </div>
    <div class="col-md-3">
        <a id="enviaguiagrupoindv" name="'.$id_alu.'" user="'.$i.'" style="float:none; margin-top:25px;" href="#" class="btn btn-sm btn-success">Reenviar Guía del Alumno</a>
    </div>
</div>';

}

function guardarCredenciales($id_alu, $id_mat, $user, $pass, $link) {


    $q = 'UPDATE mat_alu_cta_emp SET
    user = "'. $user .'", pass = "'. $pass .'"
    WHERE id_matricula = '.$id_mat.' AND id_alumno = '.$id_alu;
    // echo $q;
    $q = mysqli_query($link, $q);

}



function colorFacturas ($estado) {

    switch ($estado) {

        case 'Pendiente':
        return 'warning';
        break;

        case 'Pagada':
        return 'success';
        break;

        case 'Rectificada':
        return 'danger';
        break;

        case 'PendienteAlgo':
        return 'info';
        break;

        case 'CobradoMas':
        return 'gratuita';
        break;

    }

}


function colorFinalizacion ($estado, $tipo = "") {

    // echo "tipo ".$tipo;
    switch ($estado) {

        case '0':
            return 'warning';
        break;

        case '1':
        if ( $tipo == "Privado" )
            return 'finprivado';
        else
            return 'success';
        break;

        case '2':
        return 'danger';
        break;


    }

}

function colorSeguimiento ($porcentaje) {

    switch ($porcentaje) {

        case '0':
        return 'danger';
        break;

        case $porcentaje > 0 && $porcentaje < 50:
        return 'warning';
        break;

        case $porcentaje >= 50 && $porcentaje < 75:
        return 'info';
        break;

        case $porcentaje >= 75 && $porcentaje <= 100:
        return 'success';
        break;

    }

}

function colorSeguimientoEstado ($estado) {

    switch ($estado) {

        case 'Anulada':
        return 'danger';
        break;

        case 'Creada':
        return 'warning';
        break;

        case 'Comunicada':
        return 'info';
        break;

        case 'Finalizada':
        return 'success';
        break;

        case 'Facturada':
        return 'facturada';
        break;

        case 'Gratuita':
        return 'gratuita';
        break;

        case 'Liquidada':
        return 'liquidada';
        break;

    }

}

function colorSeguimientoIKEA ($estado) {

    switch ($estado) {

        case 'Rechazada':
        case 'Anulada':
        return 'danger';
        break;

        case 'Pendiente':
        return 'warning';
        break;

        case 'Revisada':
        return 'info';
        break;

        case 'Aceptada':
        case 'Resuelta':
        case 'Realizada':
        return 'success';
        break;

    }

}


function colorSeguimientoFormacion($finalizado) {

    switch ($finalizado) {

        case '1':
        return 'success';
        break;

        case '0':
        return 'info';
        break;

        case '2':
        return 'danger';
        break;


    }

}

function nivelFormacion($numeroaccion) {

    switch ($numeroaccion) {

        case 17:
        case 1001:
        case 1006:
        case 1017:
        case 106:
        return "I";
        break;

        case 18:
        case 1027:
        return "II";
        break;

    }
}


function guardacodpiloma($mat, $emp, $alu, $codiploma, $link) {

    $q = 'UPDATE mat_alu_cta_emp SET codiploma = '. $codiploma .'
    WHERE id_matricula = '.$mat.' AND id_empresa = '.$emp.' AND id_alumno = '.$alu;
    echo $q;
    mysqli_query($link, $q) or die("error");


}

function crearZip($folder, $nombrefile = NULL) {

    echo "llega ".$folder;

    // Get real path for our folder
    $rootPath = realpath($folder);
    echo $rootPath;
    // Initialize archive object
    $zip = new ZipArchive();

    if ( $nombrefile === NULL ) $nombrefile = 'file.zip';

    $zip->open($nombrefile, ZipArchive::CREATE | ZipArchive::OVERWRITE);

    arrayText($zip);
    // Create recursive directory iterator
    /** @var SplFileInfo[] $files */
    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($rootPath),
        RecursiveIteratorIterator::LEAVES_ONLY
        );

    foreach ($files as $name => $file)
    {
        // Skip directories (they would be added automatically)
        if (!$file->isDir())
        {
            // Get real and relative path for current file
            $filePath = $file->getRealPath();
            $relativePath = substr($filePath, strlen($rootPath) + 1);

            // Add current file to archive
            $zip->addFile($filePath, $relativePath);
        }
    }

    // Zip archive will be created only after closing object
    $zip->close();


}

function create_zip($files = array(), $destination = '', $overwrite = true) {

    // print_r($files);
    //if the zip file already exists and overwrite is false, return false
    if(file_exists($destination) && !$overwrite) { return false; }
    //vars
    $valid_files = array();
    //if files were passed in...
    if(is_array($files)) {
        //cycle through each file
        foreach($files as $file) {
            //make sure the file exists
            if(file_exists($file)) {
                $valid_files[] = $file;
            }
        }
    }
    //if we have good files...
    if(count($valid_files)) {
        //create the archive
        $zip = new ZipArchive();
        if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
            return false;
        }
        //add the files

        foreach($valid_files as $file) {
            $new_filename = substr($file,strrpos($file,'/') + 1);
            $zip->addFile($file,$new_filename);
        }
        //debug
         // echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;

        //close the zip -- done!
        $zip->close();

        // echo $destination;
        // chdir($ruta);
        //check to make sure the file exists
        return file_exists($destination);

    }
    else
    {
        return false;
    }

    arrayText($zip);
}



function valida_nif_cif_nie($cif) {

    //Returns: 1 = NIF ok, 2 = CIF ok, 3 = NIE ok, -1 = NIF bad, -2 = CIF bad, -3 = NIE bad, 0 = ??? bad
    $cif = strtoupper($cif);
    for ($i = 0; $i < 9; $i ++)
    {
        $num[$i] = substr($cif, $i, 1);
    }
    //si no tiene un formato valido devuelve error
    if (!preg_match('/((^[A-Z]{1}[0-9]{7}[A-Z0-9]{1}$|^[T]{1}[A-Z0-9]{8}$)|^[0-9]{8}[A-Z]{1}$)/', $cif))
    {
        return 0;
    }
    //comprobacion de NIFs estandar
    if (preg_match('/(^[0-9]{8}[A-Z]{1}$)/', $cif))
    {
        if ($num[8] == substr('TRWAGMYFPDXBNJZSQVHLCKE', substr($cif, 0, 8) % 23, 1))
        {
            return 1;
        }
        else
        {
            return -1;
        }
    }
    //algoritmo para comprobacion de codigos tipo CIF
    $suma = $num[2] + $num[4] + $num[6];
    for ($i = 1; $i < 8; $i += 2)
    {
        $suma += substr((2 * $num[$i]),0,1) + substr((2 * $num[$i]), 1, 1);
    }
    $n = 10 - substr($suma, strlen($suma) - 1, 1);
    //comprobacion de NIFs especiales (se calculan como CIFs o como NIFs)
    if (preg_match('/^[KLM]{1}/', $cif))
    {
        if ($num[8] == chr(64 + $n) || $num[8] == substr('TRWAGMYFPDXBNJZSQVHLCKE', substr($cif, 1, 8) % 23, 1))
        {
            return 1;
        }
        else
        {
            return -1;
        }
    }
    //comprobacion de CIFs
    if (preg_match('/^[ABCDEFGHJNPQRSUVW]{1}/', $cif))
    {
        if ($num[8] == chr(64 + $n) || $num[8] == substr($n, strlen($n) - 1, 1))
        {
            return 2;
        }
        else
        {
            return -2;
        }
    }
    //comprobacion de NIEs
    if (preg_match('/^[XYZ]{1}/', $cif))
    {
        if ($num[8] == substr('TRWAGMYFPDXBNJZSQVHLCKE', substr(str_replace(array('X','Y','Z'), array('0','1','2'), $cif), 0, 8) % 23, 1))
        {
            return 3;
        }
        else
        {
            return -3;
        }
    }
    //si todavia no se ha verificado devuelve error
    return 0;
}


function enviaRLTonlinedist($id, $link) {

    $sql = 'SELECT DISTINCT a.numeroaccion, a.denominacion, ga.ngrupo, m.fechaini, m.fechafin, e.razonsocial, m.comercial
    FROM matriculas m, acciones a, grupos_acciones ga, mat_alu_cta_emp ma, empresas e
    WHERE m.id_accion = a.id
    AND m.id_grupo = ga.id
    AND ma.id_matricula = m.id
    AND ma.id_empresa = e.id
    AND m.id ='.$id;
            // echo $sql;
    $sql = mysqli_query($link, $sql) or die ("error");

    while ($row = mysqli_fetch_array($sql)) {
        $naccion = $row[numeroaccion];
        $ngrupo = $row[ngrupo];
        $denominacion = $row[denominacion];
        $fechaini = date("d/m/Y",strtotime($row[fechaini]));
        $fechafin = date("d/m/Y",strtotime($row[fechafin]));
        $razonsocial = $row[razonsocial];
        $comercial = $row[comercial];
    }

    $nombreFichero = "RLT-".$naccion."_".$ngrupo."-".normaliza(trim($razonsocial)).".pdf";
            // echo $nombreFichero;

               // require_once($baseurl.'/plugins/PHPMailer/PHPMailerAutoload.php');

    $baseurl = $_SERVER['DOCUMENT_ROOT'].'/app';
    if ( file_exists($baseurl.'/plugins/html2pdf/html2pdf.class.php') )
        include_once($baseurl.'/plugins/html2pdf/html2pdf.class.php');
    else
        echo "error";

    if ( file_exists($baseurl.'/plugins/PHPMailer/PHPMailerAutoload.php') )
        include_once($baseurl.'/plugins/PHPMailer/PHPMailerAutoload.php');
    else
        echo "error";


    ob_start();
    include($baseurl.'/documentacion'.$gestion.'/rlt2.php');
    $content = ob_get_clean();
    $html2pdf = new HTML2PDF('P', 'A4', 'es', true, 'UTF-8', array(0, 0, 0, 0));
               // // $html2pdf->setModeDebug();
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content);
               // $html2pdf->setModeDebug(true);
               // $html2pdf->createIndex('indice', 25, 12, false, true, 2);
               // $html2pdf->Output($nombreFichero,'D');
    $content_PDF = $html2pdf->Output('','S');
               // $pdf = chunk_split(base64_encode($pdf));


    // EMAIL.

    if ( $comercial == 0  ) {
        $q = 'SELECT c.email
        FROM empresas e, comerciales c
        WHERE e.comercial = c.id
        AND e.id = '.$valores[id_empresa][0];
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

    // echo $emailcomercial;

    $cc = $emailcomercial;
    $para = 'margarita.mitkova@eduka-te.com';
    $mail = new PHPMailer;
    $mail->From = 'gestion@eduka-te.com';
    $mail->FromName = 'Gestión EDUKA-TE';
    $mail->addAddress($para);                   // Add a recipient
    // $mail->addAddress('ellen@example.com');               // Name is optional
    // $mail->addReplyTo('ivan.cabrera@eduka-te.com');
    $mail->addCC($cc);
    $mail->addBCC('ivan.cabrera@eduka-te.com');
    // $mail->addBCC('ivan.cabrera@eduka-te.com');
    // $mail->WordWrap = 50;                                   // Set word wrap to 50 characters
    $mail->AddStringAttachment($content_PDF, $nombreFichero, 'base64', 'application/pdf');
    // $mail->addAttachment($pdf);                   // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');   // Optional name
    $mail->isHTML(true);                                    // Set email format to HTML
    $titulo = $mail->Subject = 'Requerida RLT en acción '.$naccion.'.'.$ngrupo;
    $mail->Body    = 'La empresa '. $razonsocial .' tiene q cumplimentar la RLT para poder participar en la acción formativa '.$naccion.'.'.$ngrupo."<br>".'Adjunto a este correo enviamos modelo para su cumplimentación';
    $mail->CharSet = 'UTF-8';
    // registrarMailBD($para, $titulo, $mensaje, $link);
    if(!$mail->send()) {
        echo 'Error. Email no enviado: ' . $mail->ErrorInfo;
    } else {
        registrarMailBD($para, $titulo, $cc, $link);
        echo 'Email enviado con éxito.';
    }

}

function calculaSesiones($horariomini, $horariotini, $horariomfin, $horariotfin) {

    $resultado = array();

    if ($horariomini == "") {
        $t = 1;
        $sesion = $t;

        $turno = "TRAMO 2";
        $horario = "De ".$horariotini." a ".$horariotfin;
    }
    else if ($horariotini == "") {
        $m = 1;
        $sesion = $m;

        $turno = "TRAMO 1";
        $horario = "De ".$horariomini." a ".$horariomfin;
    }
    else {
        $mt = 2;
        $sesion = $mt;
        $turno = 'TRAMO 1 - TRAMO 2';
        $horario = "De ".$horariomini." a ".$horariomfin.' - '."De ".$horariotini." a ".$horariotfin;

    }

    $resultado[0] = $sesion;
    $resultado[1] = $turno;
    $resultado[2] = $horario;
    return $resultado;

}

function crearUserDocente($id, $link) {

    $q = 'SELECT *
    FROM docentes
    WHERE id = '.$id;
    $q = mysqli_query($link, $q);

    $row = mysqli_fetch_array($q);

    $nombretutor = explode(' ', $row[nombre]);
    $nombre = $nombretutor[0][0];
    $apellido = str_replace(' ', '', $row[apellido]);

    $user = normaliza(strtolower($nombre)).normaliza(strtolower($apellido.'tutor'));
    $pass = md5($row['documento'].'@eduka-te');
    $q = 'INSERT INTO usuarios
    (user, pass, id_docente)
    VALUES ("'.$user.'","'.$pass.'","'.$id.'")';
    mysqli_query($link,$q);

}

function devuelveAnio() {

    if ( !isset($_SESSION['anio']) ) {

        if( date("Y") == '2014' ) $gestion = '';
        else $gestion = date("Y");

        $_SESSION['anio'] = date("Y");

    } else {

        if( $_SESSION['anio'] == '2014' ) $gestion = '';
        else $gestion = $_SESSION['anio'];
    }

    return $gestion;

}

function devuelveAnioReal() {

    if ( !isset($_SESSION['anio']) ) $anio = date("Y");
    else $anio = $_SESSION['anio'];

    return $anio;

}



/******
/ SMS
/*****/

function send_params($param) {
    $URL = "http://www.soysms.com/api/send";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $URL);
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
    $retuned_data = curl_exec($ch);
    curl_close($ch);
    return $retuned_data;
}

function listarSMS($link) {

    $q = 'SELECT *
    FROM registro_sms
    ORDER BY id DESC';
    $q = mysqli_query($link, $q);


    echo '<table style="margin-top: 40px;" class="table">
    <thead>
        <tr>
            <th>Fecha</th>
            <th>De</th>
            <th>Para</th>
            <th>Mensaje</th>
            <th>Respuesta</th>
            <th>Usuario</th>
        </tr>
    </thead>
    <tbody>';

        $i=0;
        while ( $row = mysqli_fetch_assoc($q) ) {

            if (strpos($row[respuesta], 'err') !== false) $color = 'danger'; else $color = 'success';
            echo '<tr class="'.$color.'">';
            echo '<td>'.formateaFechaHora($row[fecha]).'</td>';
            echo '<td>'.$row[de].'</td>';
            echo '<td>'.$row[para].'</td>';
            echo '<td>'.$row[mensaje].'</td>';
            echo '<td>'.$row[respuesta].'</td>';
            echo '<td>'.$row[usuario].'</td>';
            echo '</tr>';

        }
        echo '</tbody>
    </table>';

}

function colorCuestionarioI($numero) {

    switch ($numero) {

        case 0:
        return 'danger';
        break;

        case $numero < 5:
        return 'danger';
        break;

        case $numero > 5:
        return 'success';
        break;

        case 5:
        return 'info';
        break;
    }

}

function devuelveColectivoIKEA($numero) {

    switch ($numero) {
        case '1':
        return "DI";
        break;

        case '2':
        return "MI";
        break;

        case '3':
        return "TE";
        break;

        case '4':
        return "TC";
        break;

        case '5':
        return "TC";
        break;

    }

}


function devuelveNoFinBonif($estado, $ngrupo, $numeroaccion) {

    if ( ($estado == 'Finalizada' || $estado == 'Facturada') && strpos($ngrupo, 'p') === false ) {

        $gestion = devuelveAnio();

        $rutafin = dirname(__DIR__).'/import'.$gestion.'/fin/';
        $finp = $rutafin.$numeroaccion.'-'.$ngrupo.'finp.xlsx';
        $fin = $rutafin.$numeroaccion.'-'.$ngrupo.'fin.xlsx';

        if ( file_exists($finp) && !file_exists($fin) ) {

            $icono = '<span style="color: #cc0000; font-size: 16px;" class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>';
            return ($estado.'  '.$icono);

        } else
        return ($estado);

    } else
    return ($estado);


}


function compruebaNumCuenta($id_empresa, $numeroaccion, $ngrupo, $link) {


    $q = 'SELECT razonsocial, agente
    FROM empresas
    WHERE iban = ""
    AND comercial = 3
    AND formapago IN("Remesa","Domiciliación")
    AND id = '.$id_empresa;
    $q = mysqli_query($link, $q) or die("error numcuenta:" .mysqli_error($link));

    if ( mysqli_num_rows($q) > 0 ) {

        $row = mysqli_fetch_array($q);

        enviarMailNotif( $numeroaccion, $ngrupo, 'emp-sin-numcuenta', $link, $row[razonsocial], $row[agente] );

    }

    // return $row[razonsocial];

}


function esExterno($user) {
    if ( strpos($user, 'ext_') !== FALSE ) return true;
    else return false;
}


function devuelveHorario($horariomini, $horariomfin, $horariotini, $horariotfin) {

    if ( $horariomini !== "" )
        $horario = $horariomini.' - '.$horariomfin;
    if ( $horariomini !== "" && $horariotini !== "" )
        $horario .= ' | ';
    if ( $horariotini != "" )
        $horario .= $horariotini.' - '.$horariotfin;

    return $horario;

}


function devuelveDias($diascheck) {

    $dias = array('Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo');

    for ($i=0; $i < 7 ; $i++) {

      if ( $diascheck[$i] == 'L' ) $dias_semana = 'Lunes, ';
      if ( $diascheck[$i] == 'M' ) $dias_semana .= 'Martes, ';
      if ( $diascheck[$i] == 'X' ) $dias_semana .= 'Miércoles, ';
      if ( $diascheck[$i] == 'J' ) $dias_semana .= 'Jueves, ';
      if ( $diascheck[$i] == 'V' ) $dias_semana .= 'Viernes, ';
      if ( $diascheck[$i] == 'S' ) $dias_semana .= 'Sábado, ';
      if ( $diascheck[$i] == 'D' ) $dias_semana .= 'Domingo, ';

  }

  return $dias_semana;

}

function arrayText($array) {

    echo "<pre>".print_r($array,true)."</pre>";

}

function anadeMails($email, $mail) {

    if ( strpos($email, ',') === FALSE && !is_array($email) )  $mail->addBCC($email);
    else {

        if ( !is_array($email) )
            $email = explode(",", $email);

        for ($i=0; $i < count($email); $i++) {
            $mail->addBCC(trim($email[$i]));
        }
    }

    return $mail;

}

function iniciaTelegram() {

    $baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
    include($baseurl.'/plugins/Telegram.php');

    define(TOKEN, '175906410:AAHseqP1LGG4i3J_bnk_2MhRtZ0e4Wvtgm8');

    $telegram = new Telegram(TOKEN);

    return $telegram;
}

function enviaTelegram($telegram, $msg, $user) {

    $msg = str_replace('<br>', '', $msg);
    // echo $msg;
    // $msg = nl2br($msg);
    $users = array(
        'alberto' => 5917859,
        'cris' => 106294751
        );

// arrayText($users);
    if ( $user != 'todos' ) {

        $id = $users[$user];
        $content = array( chat_id => $id, 'text' => $msg );
        $telegram->sendMessage($content);

    } else {

        foreach ($users as $key => $value) {
            $content = array( chat_id => $value, 'text' => $msg );
            arrayText($content);
            $telegram->sendMessage($content);
        }

    }


}


// function arrayTable($headers, $content, $print = false, $bootstrap = false, $seleccionar = '', $tabla = '') {

//     if ( $bootstrap === false )
//         $style = ' style="padding: 5px;border: 1px solid #ccc"';
//     else
//         $style = '';


//     $str = '<table style="margin-top: 30px; border-spacing: 5px; border-collapse:collapse; font-size:12px"
//     class="table table-striped"><tr>';

//     $col = 0;
//     foreach ($headers as $key => $value) {
//         $col++;
//         $str .= '<th '.$style.'>'.$value.'</th>';
//     }

//     $str .= '</tr>';


//     // arrayText($content);

//     if ( isMultiArray($content) ) {

//         for ($j=0; $j < count($content); $j++) {

//             $i = 0;
//             foreach ($content[$j] as $key => $value) {

//                 $colx++;
//                 // if ( $value != "" ) {

//                 if ( $i == 0 ) {
//                     $str .= '<tr>';
//                 }

//                 if ( isDate($value) ) {
//                     $str .= '<td '.$style.'>'.formateaFecha($value).'</td>';
//                 } else if ( stripos($key, 'observaciones') !== false ) {
//                     $str .= '<td '.$style.'>'. substr($value, 0, 50) .' ... </td>';
//                 } else {
//                     if ( $key != 'id' )
//                         $str .= '<td '.$style.'>'.$value.'</td>';
//                 }


//                 if ( $i++ == count($content[0]) ) {
//                     $str .= '</tr>';
//                 }

//                 // }

//                 if ( $colx == $col && $seleccionar != "" ) {

//                     $str .= '<td><a id="'.$seleccionar.'" iden="'.$content[$j]['id'].'" tabla="'.$tabla.'" href="#" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span> </a></td>';
//                     $colx = 0;
//                 }
//             }

//         }

//     } else {

//         $i = 0;
//         foreach ($content as $key => $value) {

//             // if ( $value != "" ) {

//             if ( $i == 0 ) {
//                 $str .= '<tr>';
//             }

//             if ( isDate($value) ) {
//                 $str .= '<td '.$style.'>'.formateaFecha($value).'</td>';
//             } else if ( stripos($key, 'observaciones') !== false ) {
//                     $str .= '<td '.$style.'>'. substr($value, 0, 50) .' ... </td>';
//             } else {
//                 $str .= '<td '.$style.'>'.$value.'</td>';
//             }

//             if ( $i++ == count($content) ) {
//                 $str .= '</tr>';
//             }

//         }

//     }

//     $str .= '</tr></table>';

//     if ( $print === false )
//         echo $str;
//     else
//         return $str;

// }

function arrayTable($headers, $content, $print = false, $bootstrap = false, $seleccionar = '', $tabla = '') {

    if ( $bootstrap === false )
        $style = ' style="padding: 5px;border: 1px solid #ccc;"';
    else
        $style = '';


    $str = '<table style="margin-top: 30px; border-spacing: 5px; border-collapse:collapse; font-size:12px"
    class="table table-striped"><tr>';

    $col = 0;
    foreach ($headers as $key => $value) {
        $col++;
        $str .= '<th '.$style.'>'.$value.'</th>';
    }

    $str .= '</tr>';


    // arrayText($content);

    if ( isMultiArray($content) ) {

        for ($j=0; $j < count($content); $j++) {

            $i = 0;
            foreach ($content[$j] as $key => $value) {

                $colx++;

                $nombreColumna = nombreColumna($content[$j]);

                if ( $i == 0 ) {
                    $str .= '<tr class="'.arrayTableColores($content[$j][$nombreColumna]).'">';
                }

                if ( isDate($value) ) {

                    $str .= '<td '.$style.'>'.formateaFecha($value).'</td>';

                } else if ( stripos($key, 'observaciones') !== false ) {

                    if ($value != "") {
                        $mensaje = ' ... Leer más';
                    } else{
                        $mensaje = '';
                    }

                    $readmore = '<a id="obscuest" href="#" obs="'.$value.'">'.$mensaje.'</a>';
                    $str .= '<td '.$style.'>'.substr($value, 0, 25).$readmore.'</td>';

                    //echo 'ererer';

                } else {

                    if ( $key != 'id' )
                        $str .= '<td '.$style.'>'.$value.'</td>';
                }


                if ( $i++ == count($content[0]) ) {
                    $str .= '</tr>';
                }


                if ( $colx == $col && $seleccionar != "" ) {

                    $str .= '<td><a id="'.$seleccionar.'" iden="'.$content[$j]['id'].'" tabla="'.$tabla.'" href="#" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span> </a></td>';
                    $colx = 0;
                }
            }

        }



    } else {

        $i = 0;
        foreach ($content as $key => $value) {

            // if ( $value != "" ) {
            // echo $i."<br>";

            if (stripos($key, 'numero') !== false) {
                /*$colorEstado = arrayTableColores($value);*/
                $colorEstado = arrayTableColores($content['estado']);
            }

            if ( $i == 0 ) {
                $str .= '<tr class="'.$colorEstado.'">';
            }

            if ( isDate($value) ) {
                $str .= '<td '.$style.'>'.formateaFecha($value).'</td>';
            } else if ( stripos($key, 'observaciones') !== false ) {
                $str .= '<td '.$style.'>'. substr($value, 0, 50) .' ... </td>';
            } else {
                $str .= '<td '.$style.'>'.$value.'</td>';
            }

            if ( $i++ == count($content) ) {
                $str .= '</tr>';
            }

        }

        //echo 'no es multi array';
    }

    $str .= '</tr></table>';

    if ( $print === false )
        echo $str;
    else
        return $str;

}

function arrayTableColores($estado){

    //LOS COLORES VAN POR CLASE WARNING, INFO, ETC

    switch ($estado) {

        case 'Aceptada':
        case 'Pagado':

        return 'success';

        break;

        case 'Anulada':
        case 'Rechazada':

        return 'danger';

        break;

        case 'Pendiente':

        return 'warning';

        break;
    }

}

function nombreColumna($listado){

    foreach ($listado as $key => $value) {
        if (stripos($key, 'estado') !== false) {
            return $key;
        }
    }

}


function isDate($fecha) {

    if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$fecha))
    {
        return true;
    }else{
        return false;
    }

}

function isRoot() {
    if ( $_SESSION['user'] == 'root' )
        return true;
    else
        return false;
}

function isMultiArray($a){
    foreach($a as $v) if(is_array($v)) return TRUE;
    return FALSE;
}


function leerExcel($archivo) {

    require_once($GLOBALS['baseurl']."/plugins/phpexcel/Classes/PHPExcel.php");
    require_once($GLOBALS['baseurl']."/plugins/phpexcel/Classes/PHPExcel/IOFactory.php");

    if ( strpos($archivo, '/') !== false ) {
        $rutabs = $GLOBALS['baseurl'].'/'.$archivo;
        $inputFileName = '../'.$archivo;
    } else {
        $rutabs = $baseurl.'/import/'.$archivo;
        $inputFileName = '../import/'.$archivo;
    }

    // echo $rutabs;
    // echo $inputFileName;

    $col = 0;
    if ( file_exists($rutabs) ) {

        // echo "existe";

        $objReader = PHPExcel_IOFactory::createReader('Excel5');
        $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);

        $i = 0;
        $worksheet = $objPHPExcel->getActiveSheet();
        foreach ($worksheet->getRowIterator() as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);

            foreach ($cellIterator as $cell) {


                $valor = $cell->getCalculatedValue();

                if ( PHPExcel_Shared_Date::isDateTime($cell) ) {

                    $valor = PHPExcel_Style_NumberFormat::toFormattedString($valor, 'YYYY-mm-dd');

                }

                $colu = PHPExcel_Cell::columnIndexFromString($cell->getColumn());

                $data[$cell->getRow()][$colu] = trim($valor);
                // echo $valor;
                $i++;

            }
        }

        return $data;

    } else {

        return false;

    }



}

//**************************************************//
//**************************************************//
// Autor:       cgutierrez                          //
// Fecha:       06/10/2016                          //
// Descripción: Lista las facturas asociadas a una  //
//              Acción Formativa                    //
//**************************************************//
//**************************************************//
function cargarFacturasAccion($id_matricula, $link){

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
}



function calcularIBAN($codigoPais,$ccc){
  $pesos = array('A' => '10',
   'B' => '11',
   'C' => '12',
   'D' => '13',
   'E' => '14',
   'F' => '15',
   'G' => '16',
   'H' => '17',
   'I' => '18',
   'J' => '19',
   'K' => '20',
   'L' => '21',
   'M' => '22',
   'N' => '23',
   'O' => '24',
   'P' => '25',
   'Q' => '26',
   'R' => '27',
   'S' => '28',
   'T' => '29',
   'U' => '30',
   'V' => '31',
   'W' => '32',
   'X' => '33',
   'Y' => '34',
   'Z' => '35' );
  $dividendo = $ccc.$pesos[substr($codigoPais, 0 , 1)].$pesos[substr($codigoPais, 1 , 1)].'00';
  $digitoControl =  98 - bcmod($dividendo, '97');
  if(strlen($digitoControl)==1) $digitoControl = '0'.$digitoControl;
  return $codigoPais.$digitoControl.$ccc;
}


function ccc_valido($ccc)
{
    //$ccc sería el 20770338793100254321
    $valido = true;

    ///////////////////////////////////////////////////
    //    Dígito de control de la entidad y sucursal:
    //Se multiplica cada dígito por su factor de peso
    ///////////////////////////////////////////////////
    $suma = 0;
    $suma += $ccc[0] * 4;
    $suma += $ccc[1] * 8;
    $suma += $ccc[2] * 5;
    $suma += $ccc[3] * 10;
    $suma += $ccc[4] * 9;
    $suma += $ccc[5] * 7;
    $suma += $ccc[6] * 3;
    $suma += $ccc[7] * 6;

    $division = floor($suma/11);
    $resto    = $suma - ($division  * 11);
    $primer_digito_control = 11 - $resto;
    if($primer_digito_control == 11)
        $primer_digito_control = 0;

    if($primer_digito_control == 10)
        $primer_digito_control = 1;

    if($primer_digito_control != $ccc[8])
        $valido = false;

    ///////////////////////////////////////////////////
    //            Dígito de control de la cuenta:
    ///////////////////////////////////////////////////
    $suma = 0;
    $suma += $ccc[10] * 1;
    $suma += $ccc[11] * 2;
    $suma += $ccc[12] * 4;
    $suma += $ccc[13] * 8;
    $suma += $ccc[14] * 5;
    $suma += $ccc[15] * 10;
    $suma += $ccc[16] * 9;
    $suma += $ccc[17] * 7;
    $suma += $ccc[18] * 3;
    $suma += $ccc[19] * 6;

    $division = floor($suma/11);
    $resto = $suma-($division  * 11);
    $segundo_digito_control = 11- $resto;

    if($segundo_digito_control == 11)
        $segundo_digito_control = 0;
    if($segundo_digito_control == 10)
        $segundo_digito_control = 1;

    if($segundo_digito_control != $ccc[9])
        $valido = "NO VALIDO";

    return "valido";
}


/**
 * Validate an IBAN Number.
 * @param $IBAN the IBAN number to check.
 * @return BOOLEAN TRUE if valid, FALSE if invalid.
 */
function validarIBAN($IBAN){
    $result = preg_match("/[A-Z]{2,2}[0-9]{2,2}[a-zA-Z0-9]{1,30}/",$IBAN);
    if ($result == 0 || $result === False){
        return False;
    }

    $indexArray = array_flip(['0','1','2','3','4','5','6','7','8','9','A','B','C',
     'D','E','F','G','H','I','J','K','L','M','N','O','P',
     'Q','R','S','T','U','V','W','X','Y','Z']);

    $IBAN = strtoupper($IBAN);

    // echo "<br>".$IBAN."<br>";

    $IBAN = substr($IBAN,4).substr($IBAN,0,4); // Place CC and Check at back

    $IBANArray = str_split($IBAN);
    $IBANDecimal = "";
    foreach ($IBANArray as $char){
        $IBANDecimal .= $indexArray[$char]; //Convert the iban to decimals
    }

    //To avoid the big number issues, we split the modulus into iterations.

    //First chunk is 9, the rest are modulus (max 2) + 7, last one is whatever is left (2 + < 7).
    $startchunk = substr($IBANDecimal,0,9);
    $startmod = intval($startchunk) % 97;

    $IBANDecimal = substr($IBANDecimal,9);
    $chunks = ceil(strlen($IBANDecimal)/7);
    $remainder = strlen($IBANDecimal) % 7;

    for($i = 0;$i <= $chunks;$i++){
        $IBANDecimal = $startmod.$IBANDecimal;
        $startchunk = substr($IBANDecimal,0,7);
        $startmod = intval($startchunk) % 97;
        $IBANDecimal = substr($IBANDecimal,7);
    }

    //Check if we have a chunk with less than 7 numbers.
    if($remainder != 0){
        $endmod = intval($startmod.$IBANDecimal) % 97;
    }else{
        $endmod = $startmod;
    }
    if($endmod == 1){
        return True;
    }else{
        return False;
    }

}//validateIBAN



function calculaDiasLaborables($fechaini, $fechafin, $diascheck) {

    $fechasmt = createDateRangeArray($fechaini,$fechafin);

    $diascheck = explode('-', $diascheck);


    $dias_semana = array();
    $dias = array('Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo');
    $dias_formacion = array();

    for ($i=0; $i < 7 ; $i++) {

      if ( $diascheck[$i] == 'L' ) array_push($dias_semana, 'Lunes');
      if ( $diascheck[$i] == 'M' ) array_push($dias_semana, 'Martes');
      if ( $diascheck[$i] == 'X' ) array_push($dias_semana, 'Miércoles');
      if ( $diascheck[$i] == 'J' ) array_push($dias_semana, 'Jueves');
      if ( $diascheck[$i] == 'V' ) array_push($dias_semana, 'Viernes');
      if ( $diascheck[$i] == 'S' ) array_push($dias_semana, 'Sábado');
      if ( $diascheck[$i] == 'D' ) array_push($dias_semana, 'Domingo');

  }

        // MATCH DIAS DE LA SEMANA CON FECHAS
  for ($i=0; $i < sizeof($fechasmt); $i++) {

    for ($j=0; $j < sizeof($dias_semana) ; $j++) {

        if ( $dias_semana[$j] == utf8_encode(ucwords(strftime("%A", strtotime($fechasmt[$i])))) )
            array_push($dias_formacion, $fechasmt[$i]);

    }
}

return $dias_formacion;

}


function compruebaIBAN($IBAN) {

    $IBAN = mb_strtoupper(str_replace(' ', '', $IBAN));
    $IBAN = trim(str_replace('-', '', $IBAN));
    $IBAN = trim(str_replace('/', '', $IBAN));

    if ( $IBAN != "" ) {

        if ( strpos($IBAN, 'ES') === false && $IBAN != "" )
            $IBAN = calcularIBAN("ES",$IBAN);

        if ( validarIBAN($IBAN) ) {

            $iban['resul'] = true;
            $iban['iban'] = $IBAN;

        } else {

            $iban['resul'] = false;
            $iban['iban'] = $IBAN;

        }

    } else {

        $iban['resul'] = false;
        $iban['iban'] = $IBAN;

    }

    echo json_encode($iban);


}


//**************************************************//
//**************************************************//
// Autor:       cgutierrez                          //
// Fecha:       10/11/2016                          //
// Descripción: Creación de código único para los   //
//              Diplomas                            //
//**************************************************//
//**************************************************//

function generarCodigos($id_matricula, $id_alumno, $link, $cantidad=1, $longitud=20, $incluyeNum=true){
    //Cargamos las cadenas de caracteres que se usarna en la creación del código
    $caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    if($incluyeNum)
        $caracteres .= "1234567890";
    $strcodigo = "";
    $index = 0;
    $existecodigo = 0;

    //Verificamos que el código no esté ya generado y guardado en la base de datos
    $q = "SELECT codigo FROM diplomas_codigos WHERE id_matricula = ".$id_matricula." AND id_alumno = ".$id_alumno;

    //echo $q;

    $q = mysqli_query($link, $q) or die(" error Buscar Código de Diploma:" .mysqli_error($link));

    $row = mysqli_fetch_array($q);

    $existecodigo = mysqli_num_rows($q);

    if ( $existecodigo == 0 ) {

        while($index<$cantidad){

            $tmp = "";

            for($i=0;$i<$longitud;$i++){
                $tmp.=$caracteres[rand(0,strlen($caracteres)-1)];
            }

            $strcodigo = $tmp;
            $index++;

        }

        $q2 = "INSERT INTO diplomas_codigos
        (`id_matricula`,`id_alumno`,`codigo`)
        VALUES ('".$id_matricula."','".$id_alumno."','".$strcodigo."')";

        $result = mysqli_query($link,$q2) or die("Error al insertar en tabla diplomas_codigos. Error: ".mysqli_error($link));


    } else if ( $existecodigo == 1 ) {

        $strcodigo = $row['codigo'];

    }

    return $strcodigo;

    //$codigos=generarCodigos(3,10);
    //print_r($codigos); // Array ( [0] => XOIU3JIGY5 [1] => 16LJO4S0HO [2] => RU7HY16MI6 )
}


function strpos_arr($haystack, $needle) {

    if(!is_array($needle)) $needle = array($needle);
    foreach($needle as $what) {
        if(($pos = stripos($haystack, $what))!==false) return $pos;
    }
    return false;
}


?>
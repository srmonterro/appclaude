<?

include_once './funciones.php';

// session_start();
$gestion = devuelveAnio();
//echo $gestion;
$rutainicio = dirname(__DIR__).'/pdf_tripartita'.$gestion.'/inicio/';
$rutafin = dirname(__DIR__).'/pdf_tripartita'.$gestion.'/fin/';
$rutacues = dirname(__DIR__).'/pdf_tripartita'.$gestion.'/cuestionario/';
$rutaempresa = dirname(__DIR__).'/pdf_tripartita'.$gestion.'/empresa/';
$rutaempresanexo = dirname(__DIR__).'/pdf_tripartita'.$gestion.'/anexos/';
$rutadocentes = dirname(__DIR__).'/documentacion/docentes/';
$rutacomisionistas = dirname(__DIR__).'/documentacion'.$gestion.'/comisionistas/';
$rutametodologia = dirname(__DIR__).'/documentacion'.$gestion.'/acciones/';
$rutaacreedor = dirname(__DIR__).'/facturacion'.$gestion.'/acreedores/';
$rutanominadocente = dirname(__DIR__).'/facturacion'.$gestion.'/nominasdocentes/';
$rutaikea = dirname(__DIR__).'/ikea'.$gestion.'/tablasparticipantes/';
$rutaikeadocu = dirname(__DIR__).'/ikea'.$gestion.'/consentimiento/';
$rutanominas = dirname(__DIR__).'/documentacion'.$gestion.'/nominas/';
$rutasolicitudes = dirname(__DIR__).'/documentacion'.$gestion.'/solicitudes/'.$_POST[numero].'/';
$rutatpc = dirname(__DIR__).'/documentacion'.$gestion.'/tpc/'.$_POST[numero].'/';
$rutanotagastos = dirname(__DIR__).'/documentacion'.$gestion.'/notagastos/'.$_POST[numero].'/';
$rutavacaciones = dirname(__DIR__).'/documentacion'.$gestion.'/vacaciones/';
$rutapropuestas = dirname(__DIR__).'/documentacion'.$gestion.'/propuestas/';


if ($_FILES["file"]["error"] > 0) {

    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    return false;

} else {

    $tipo = $_POST["tipo"];
    //echo $tipo;
    if ( isset($_POST["id_mat"]) ) {

        $id_mat = $_POST["id_mat"];

        $sql = 'SELECT  a.numeroaccion, ga.ngrupo, a.modalidad,m.grupo
        FROM matriculas m, acciones a, grupos_acciones ga
        WHERE m.id_accion = a.id
        AND m.id_grupo = ga.id
        AND m.id = '.$id_mat;
        // echo $sql;
        $sql = mysqli_query($link, $sql) or die("error1" . mysqli_error($link) );
        while ($row = mysqli_fetch_assoc($sql)) {
            $naccion = $row['numeroaccion'];
            $ngrupo = $row['ngrupo'];
            $modalidad = $row['modalidad'];
            $grupo = $row['grupo'];
        }

    } else  if ( isset($_POST["id_empresa"]) ) {

        $id_empresa = $_POST["id_empresa"];

        $sql = 'SELECT cif
        FROM empresas
        WHERE id = '.$id_empresa;

        $sql = mysqli_query($link, $sql);
        $cif = mysqli_fetch_row($sql);
        $cif = $cif[0];

    } else  if ( isset($_POST["id_docente"]) ) {

        $id_docente = $_POST["id_docente"];

        $sql = 'SELECT d.*
        FROM docentes d
        WHERE id = '.$id_docente;

        $sql = mysqli_query($link, $sql);
        $row = mysqli_fetch_assoc($sql);

        if ( $row['tipodoc'] == 'Empresa' ) {
            $row[nombre]  = $row[nombredocente];
            $row[apellido] = $row[apellidodocente];
            $row[documento] = $row[documentodocente];
            // arrayText($row);
        }
        $docentepdf  = normaliza($row[nombre].'_'.$row[apellido].'_'.$row[documento]);

    } else if ( isset($_POST['id_comisionista']) ) {

        $id_comisionista = $_POST["id_comisionista"];

        $sql = 'SELECT c.nombre, c.tipocomisionista
        FROM comisionistas c
        WHERE id = '.$id_comisionista;

        $sql = mysqli_query($link, $sql);
        $row = mysqli_fetch_assoc($sql);
        $comisionistapdf = $row[tipocomisionista].'-'.normaliza($row[nombre]);

    } else if ( isset($_POST['id_accion']) ) {

        // echo "entra";

        $id_accion = $_POST["id_accion"];

        $sql = 'SELECT denominacion,numeroaccion
        FROM acciones
        WHERE id = '.$id_accion;
        // echo $sql;
        $sql = mysqli_query($link, $sql) or die ("error select accion" . mysqli_error($link));
        $row = mysqli_fetch_assoc($sql);
        $metodologiapdf = 'Metodologia-AF_'.$row[numeroaccion];
        // echo $metodologiapdf;

    }

    // echo $sql;
    switch ($tipo) {

        case 'inicio':
            $move = move_uploaded_file($_FILES["file"]["tmp_name"], $rutainicio . $naccion.'-'.$ngrupo.'ini.pdf');
            chmod($rutainicio . $naccion.'-'.$ngrupo.'ini.pdf',0755);


            if ($modalidad == 'Teleformación' || $modalidad == 'A Distancia') {
                enviarMailNotif($naccion, $ngrupo, 'td-ini',$link, '', $_SESSION[user]);
                enviarMailNotif($naccion, $ngrupo, 'td-ini-tutor',$link);
            }
            else if ($modalidad == 'Presencial' || $modalidad == 'Mixta') {
                //envioMailIKEA($naccion, $ngrupo, 'ikea_comunicacion', $link);
                enviarMailNotif($naccion, $ngrupo, 'pm-ini',$link, '', $_SESSION[user]);
                $mail = enviarMailNotif($naccion, $ngrupo, 'pm-alta',$link,$id_mat);
            }

            $fechaComunicada = date("Y-m-d");
            $q = 'UPDATE matriculas SET estado = "Comunicada", fechacomunicacion = "'.$fechaComunicada.'" WHERE id = '.$id_mat;
            $q = mysqli_query($link, $q);

            break;

        case 'fin':
            $move = move_uploaded_file($_FILES["file"]["tmp_name"], $rutafin . $naccion.'-'.$ngrupo.'fin.pdf');
            chmod($rutafin . $naccion.'-'.$ngrupo.'fin.pdf',0755);


            if ($modalidad == 'Teleformación' || $modalidad == 'A Distancia') {
                if ( $grupo == 0 )
                    enviarMailNotif($naccion, $ngrupo, 'td-fin',$link);
                else
                    enviarMailNotif($naccion, $ngrupo, 'td-fingrupo',$link);

                enviarMailNotif($naccion, $ngrupo, 'aviso_diplomas', $link );

            } else if ($modalidad == 'Presencial' || $modalidad == 'Mixta') {
                $mail =enviarMailNotif($naccion, $ngrupo, 'pm-fin',$link);
                // echo $mail;
            }

            $fechaFinalizada = date("Y-m-d");
            $q = 'UPDATE matriculas SET estado = "Finalizada", fechafinalizacion = "'.$fechaFinalizada.'" WHERE id = '.$id_mat;
            // echo $q;
            $q = mysqli_query($link, $q) or die("error:" . mysqli_error($link));

            break;

        case 'cuestionario':
            $move = move_uploaded_file($_FILES["file"]["tmp_name"], $rutacues . $naccion.'-'.$ngrupo.'cues.pdf');
            chmod($rutacues . $naccion.'-'.$ngrupo.'cues.pdf',0755);
            break;

        case 'informe':
            $move = move_uploaded_file($_FILES["file"]["tmp_name"], $rutaempresa . $cif.'-informe.pdf');
            chmod($rutaempresa . $cif.'-informe.pdf',0755);
            // LEER CREDITO
            $devuelve = leerCredito($cif, $link);
            return $devuelve;
            break;

        case 'anexo':
            $move = move_uploaded_file($_FILES["file"]["tmp_name"], $rutaempresanexo . $cif.'-anexo.pdf');
            chmod($rutaempresanexo . $cif.'-anexo.pdf',0755);
            break;

        case 'cv':
            $move = move_uploaded_file($_FILES["file"]["tmp_name"], $rutadocentes.$docentepdf.'-cv.pdf');
            chmod($rutadocentes.$docentepdf.'-cv.pdf',0755);
            break;

        case 'contrato':
            $move = move_uploaded_file($_FILES["file"]["tmp_name"], $rutadocentes.$docentepdf.'-contrato.pdf');
            chmod($rutadocentes.$docentepdf.'-contrato.pdf',0755);
            break;

        case 'nif':
            $move = move_uploaded_file($_FILES["file"]["tmp_name"], $rutadocentes.$docentepdf.'-nif.pdf');
            chmod($rutadocentes.$docentepdf.'-nif.pdf',0755);
            break;

        case 'niss':
            $move = move_uploaded_file($_FILES["file"]["tmp_name"], $rutadocentes.$docentepdf.'-niss.pdf');
            chmod($rutadocentes.$docentepdf.'-niss.pdf',0755);
            break;

        case 'responsable':
            $move = move_uploaded_file($_FILES["file"]["tmp_name"], $rutadocentes.$docentepdf.'-responsable.pdf');
            chmod($rutadocentes.$docentepdf.'-responsable.pdf',0755);
            break;

        case 'comisionista':
            $move = move_uploaded_file($_FILES["file"]["tmp_name"], $rutacomisionistas.$comisionistapdf.'.pdf');
            chmod($rutacomisionistas.$comisionistapdf.'.pdf',0755);
            break;

        case 'metodologia':
            // echo $rutametodologia;
            $move = move_uploaded_file($_FILES["file"]["tmp_name"], $rutametodologia.$metodologiapdf.'.pdf');
            echo $move;
            chmod($rutametodologia.$metodologiapdf.'.pdf',0755);
            break;

        case 'acreedor':
            $valor = $_POST['numero'] = str_replace('/', '-', $_POST['numero']);
            $acreedorpdf = $_POST['numero'].'-'.quitaTildesConComas($_POST['acreedor']);
            /*echo $rutaacreedor.$acreedorpdf;*/
            $move = move_uploaded_file($_FILES["file"]["tmp_name"], $rutaacreedor.$acreedorpdf.'.pdf');
            chmod($rutaacreedor.$acreedorpdf.'.pdf',0755);
            break;
        //AGREGADO OCTAVIO 16/05/2017
        case 'nominadocente':
            /*$_POST['mes'] = str_replace('/', '-', $_POST['mes']);
            $_POST['anio'] = str_replace('/', '-', $_POST['anio']);*/
            /*$docentepdf = $_POST['mes'].'-'.$_POST['anio'].'-'.quitaTildesConComas($_POST['nombredocente']);*/
            $docentepdf = $_POST['fechainicio'].'_'.$_POST['docente'].'_'.$_POST['fechafin'];
            $move = move_uploaded_file($_FILES["file"]["tmp_name"], $rutanominadocente.$docentepdf.'.pdf');
            chmod($rutanominadocente.$docentepdf.'.pdf',0755);
            /*echo $rutanominadocente.$docentepdf;*/
            break;
        //TERMINA AGREGADO
        case 'tablaikea':
            $filetype = pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION);
            $tablaikea = $_POST['numero'].'_'.quitaTildesConComas($_POST['denominacion']);
            $move = move_uploaded_file($_FILES["file"]["tmp_name"], $rutaikea.$tablaikea.'.xlsx');
            envioMailIKEA($_POST['numero'],$_POST['denominacion'],'ikea_tabla',$link,$_POST[modalidad]);
            chmod($rutaikea.$tablaikea,0755);
            break;

        case 'consentikea':
            $filetype = pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION);
            // echo $filetype;
            $tablaikea = $_POST['numero'].'_'.quitaTildesConComas($_POST['denominacion']).'-consentimiento';
            $move = move_uploaded_file($_FILES["file"]["tmp_name"], $rutaikeadocu.$tablaikea.'.pdf');
            // envioMailIKEA($_POST['numero'],$_POST['denominacion'],'ikea_tabla',$link,$_POST[modalidad]);
            chmod($rutaikeadocu.$tablaikea,0755);
            break;

        case 'docufinalikea':
            // $filetype = pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION);
            $docuikea = str_replace('/','-', trim($_POST[numeroaccion]));
            // echo $docuikea;
            $move = move_uploaded_file($_FILES["file"]["tmp_name"], $rutaikeadocu.$docuikea.'.pdf');
            chmod($rutaikeadocu.$docuikea,0755);
            envioMailIKEA($_POST['numeroaccion'],'','ikea_docufinal',$link,$_POST[modalidad]);
            break;

        case 'nomina':
            // $filetype = pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION);
            $nomina = $_POST[dni].'-'.$_POST[fecha].'.pdf';
            // echo $nomina;
            $move = move_uploaded_file($_FILES["file"]["tmp_name"], $rutanominas.$nomina);
            chmod($rutanominas.$nomina,0755);
            enviarMailNotif($_POST[dni],$_POST[fecha], 'nomina_subida', $link);
            // envioMailIKEA($_POST['numeroaccion'],'','ikea_docufinal',$link,$_POST[modalidad]);
            break;

        case 'tablasolb':
            // $filetype = pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION);

            if ( !file_exists($rutasolicitudes) )
                mkdir($rutasolicitudes);

            $tablasol = $_POST[numero].'-tabla-bonif.xlsx';
            // echo $nomina;
            $move = move_uploaded_file($_FILES["file"]["tmp_name"], $rutasolicitudes.$tablasol);
            chmod($rutasolicitudes.$tablasol,0755);
            enviarMailNotif($_POST[numero],'', 'tabla_subida', $link);
            // envioMailIKEA($_POST['numeroaccion'],'','ikea_docufinal',$link,$_POST[modalidad]);
        break;

        case 'tablasolp':
            // $filetype = pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION);

            if ( !file_exists($rutasolicitudes) )
                mkdir($rutasolicitudes);

            $tablasol = $_POST[numero].'-tabla-priv.xlsx';
            // echo $nomina;
            $move = move_uploaded_file($_FILES["file"]["tmp_name"], $rutasolicitudes.$tablasol);
            chmod($rutasolicitudes.$tablasol,0755);
            enviarMailNotif($_POST[numero],'', 'tabla_subida', $link);
            // envioMailIKEA($_POST['numeroaccion'],'','ikea_docufinal',$link,$_POST[modalidad]);
        break;

        case 'tablatpc':
            // $filetype = pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION);

            if ( !file_exists($rutatpc) )
                mkdir($rutatpc);

            $tablasol = $_POST['numero'].'-tabla.xls';
            // echo $nomina;
            $move = move_uploaded_file($_FILES["file"]["tmp_name"], $rutatpc.$tablasol);
            chmod($rutatpc.$tablasol,0755);
            // enviarMailNotif($_POST[numero],'', 'tab', $link);
            // envioMailIKEA($_POST['numeroaccion'],'','ikea_docufinal',$link,$_POST[modalidad]);
        break;

        case 'matsol':

            if ( !file_exists($rutasolicitudes) )
                mkdir($rutasolicitudes);

            $matsol = $_POST[numero].'-matricula.pdf';
            // echo $nomina;
            $move = move_uploaded_file($_FILES["file"]["tmp_name"], $rutasolicitudes.$matsol);
            chmod($rutasolicitudes.$matsol,0755);
            enviarMailNotif($_POST[numero],'', 'mat_subida', $link);
            // envioMailIKEA($_POST['numeroaccion'],'','ikea_docufinal',$link,$_POST[modalidad]);
        break;

        case 'recibosol':

            if ( !file_exists($rutasolicitudes) )
                mkdir($rutasolicitudes);

            $matsol = $_POST[numero].'-justificante.pdf';
            // echo $nomina;
            $move = move_uploaded_file($_FILES["file"]["tmp_name"], $rutasolicitudes.$matsol);
            chmod($rutasolicitudes.$matsol,0755);
            enviarMailNotif($_POST[numero],'', 'justificante-subido', $link, '', $_SESSION[user]);
            // envioMailIKEA($_POST['numeroaccion'],'','ikea_docufinal',$link,$_POST[modalidad]);
        break;

        case 'anexosol':

            if ( !file_exists($rutasolicitudes) )
                mkdir($rutasolicitudes);

            $numsol = $_POST[numero];

            $rutasolicitudesx = '../documentacion'.$gestion.'/solicitudes/'.$numsol.'/';
            $anex = $numsol.'-anexo';
            $ficheros = scandir($rutasolicitudesx);

            for ($i=0; $i < count($ficheros) ; $i++) {

                if ( strpos($ficheros[$i], $anex) !== FALSE )
                    $numanexos = substr($ficheros[$i], -7, -4);

            }

            // echo $numanexos;
            $numanexos = $numanexos+1;
            $numanexos = str_pad($numanexos, 3, "0", STR_PAD_LEFT);

            $matsol = $anex.$numanexos.'.pdf';
            $move = move_uploaded_file($_FILES["file"]["tmp_name"], $rutasolicitudes.$matsol);
            chmod($rutasolicitudes.$matsol,0755);

            // envioMailIKEA($_POST['numeroaccion'],'','ikea_docufinal',$link,$_POST[modalidad]);
        break;

        case 'notagastos':

            $filetype = pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION);

            if ( !file_exists($rutanotagastos) )
                mkdir($rutanotagastos);

            $numsol = $_POST['numero'];
            $nombre = trim(normaliza($_POST['nombre']));

            $rutanotagastosx = '../documentacion'.$gestion.'/notagastos/'.$numsol.'/';
            $gasto = $numsol.'_'.$nombre;
            $ficheros = scandir($rutanotagastosx);

            $numgastos = count($ficheros)-1;
            $numgastos = str_pad($numgastos, 3, "0", STR_PAD_LEFT);

            $matsol = "SN".$gasto.'.'.$filetype;
            $move = move_uploaded_file($_FILES["file"]["tmp_name"], $rutanotagastos.$matsol);
            chmod($rutanotagastos.$matsol,0755);


            if ( $move === true ) {
                $q = 'UPDATE peticiones_gastos SET tickets = 1 WHERE numero = "'.$numsol.'"';
                $q = mysqli_query($link, $q) or die("error select : " .mysqli_error($link));
            }

            // envioMailIKEA($_POST['numeroaccion'],'','ikea_docufinal',$link,$_POST[modalidad]);
        break;



        // case 'anexosoluno':

        //     // if ( !file_exists($rutasolicitudes) )
        //     //     mkdir($rutasolicitudes);

        //     $numsol = $_POST[numero];

        //     // $ficheros = scandir($rutasolicitudesx);

        //     // for ($i=0; $i < count($ficheros) ; $i++) {

        //     //     if ( strpos($ficheros[$i], $anex) !== FALSE )
        //     //         $numanexos = substr($ficheros[$i], -7, -4);

        //     // }

        //     // echo $numanexos;
        //     // $numanexos = $numanexos+1;
        //     // $numanexos = str_pad($numanexos, 3, "0", STR_PAD_LEFT);

        //     // $matsol = $anex.$numanexos.'.pdf';
        //     $move = move_uploaded_file($_FILES["file"]["tmp_name"], $rutaempresanexo.$numsol.'-anexo.pdf');
        //     // echo $move;
        //     chmod( $rutaempresanexo.$numsol.'-anexo.pdf',0755);

        //     // envioMailIKEA($_POST['numeroaccion'],'','ikea_docufinal',$link,$_POST[modalidad]);
        // break;

        case 'anexoenc_esfocc':

            if ( $cif == "" )
                $cif = $_POST[numero];

            $cif = mb_strtoupper($cif);
            $move = move_uploaded_file($_FILES["file"]["tmp_name"], $rutaempresanexo . $cif.'-anexoenc_esfocc.pdf');
            chmod($rutaempresanexo . $cif.'-anexoenc_esfocc.pdf',0755);

            if ( $_POST[email] == '1' )
                enviarMailNotif('', 'esfocc', 'nuevo-anexo', $link, $_POST[solicitud], $_SESSION[user]);

        break;

        case 'anexoenc_estrateg':

            if ( $cif == "" )
                $cif = $_POST[numero];

            $cif = mb_strtoupper($cif);
            $move = move_uploaded_file($_FILES["file"]["tmp_name"], $rutaempresanexo . $cif.'-anexoenc_estrateg.pdf');
            chmod($rutaempresanexo . $cif.'-anexoenc_estrateg.pdf',0755);

            if ( $_POST[email] == '1' )
                enviarMailNotif('', 'estrategias', 'nuevo-anexo', $link, $_POST[solicitud], $_SESSION[user]);

        break;

        case 'vacaciones':
            $move = move_uploaded_file($_FILES["file"]["tmp_name"], $rutavacaciones.$id.'_ParteVacaciones.pdf');
            // echo $move;
            chmod($rutavacaciones.$id.'_ParteVacaciones.pdf',0755);
        break;

        case 'propuestafirmada':

            $q = 'SELECT *
            FROM peticiones_formativas
            WHERE id = "'.$_POST['id_propuesta'].'"';
            $q = mysqli_query($link, $q) or die("error select : " .mysqli_error($link));

            $row = mysqli_fetch_assoc($q);
            $emp = quitaTildesConComasyBarras($row['empresareal']);
            $curso = $row['formacion'];
            $formacion = quitaTildesConComasyBarras($row['formacion']);
            $nombreFichero = $row['tiposol'].$row['numero'].'_'.$formacion.'_OK.pdf';

            $move = move_uploaded_file($_FILES["file"]["tmp_name"], $rutapropuestas.$nombreFichero);
            // echo $move;
            // chmod($rutavacaciones.$id.'_OK.pdf',0755);

        break;


    }

    if ( $move == 'true' ) {

        if ( $mail == 'errormail' )
            echo "email no enviado";
        else
            echo "bien";


    }
    else {
        // echo "este error";
        echo "error";
    }
}

//you get the following information for each file:
// print_r($_FILES['excel']['name']);
// print_r($_FILES['excel']['size']);
// print_r($_FILES['excel']['type']);
// print_r($_FILES['excel']['tmp_name']);
// echo "<br>";
//print_r($_FILES['file']['error']);
?>
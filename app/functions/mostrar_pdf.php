<?

include_once './funciones.php';


// session_start();
$gestion = devuelveAnio();

$id_mat = $_POST['id_mat'];

$rutaini = dirname(__DIR__).'/pdf_tripartita'.$gestion.'/inicio/';
$rutafin = dirname(__DIR__).'/pdf_tripartita'.$gestion.'/fin/';
$rutacues = dirname(__DIR__).'/pdf_tripartita'.$gestion.'/cuestionario/';
$rutaempresa = dirname(__DIR__).'/pdf_tripartita'.$gestion.'/empresa/';
$rutaempresanexo = dirname(__DIR__).'/pdf_tripartita'.$gestion.'/anexos/';
$rutadocentes = dirname(__DIR__).'/documentacion/docentes/';
$rutacomisionistas = dirname(__DIR__).'/documentacion'.$gestion.'/comisionistas/';
$rutametodologia = dirname(__DIR__).'/documentacion'.$gestion.'/acciones/';
$rutaacreedores = dirname(__DIR__).'/facturacion'.$gestion.'/acreedores/';
$rutaikea = dirname(__DIR__).'/ikea'.$gestion.'/tablasparticipantes/';
$rutaikeadocu = dirname(__DIR__).'/ikea'.$gestion.'/consentimiento/';
$rutanominas = dirname(__DIR__).'/documentacion'.$gestion.'/nominas/';
$rutasolicitudes = dirname(__DIR__).'/documentacion'.$gestion.'/solicitudes/'.$_POST[numero].'/';
$rutatpc = dirname(__DIR__).'/documentacion'.$gestion.'/tpc/'.$_POST[numero].'/';
$rutanotagastos = dirname(__DIR__).'/documentacion'.$gestion.'/notagastos/'.$_POST[numero].'/';
$rutapropuestas = dirname(__DIR__).'/documentacion'.$gestion.'/propuestas/';
$rutanominadocente = dirname(__DIR__).'/facturacion'.$gestion.'/nominasdocentes/';
$rutabasepropuestas = 'http://gestion.eduka-te.com/app/documentacion'.$gestion.'/propuestas/';
$rutanominadocente = dirname(__DIR__).'/facturacion'.$gestion.'/nominasdocentes/';
$rutabasenominadocente = 'http://gestion.eduka-te.com/app/facturacion'.$gestion.'/nominasdocentes/';
$rutabaseini = 'http://gestion.eduka-te.com/app/pdf_tripartita'.$gestion.'/inicio/';
$rutabasefin = 'http://gestion.eduka-te.com/app/pdf_tripartita'.$gestion.'/fin/';
$rutabasecues = 'http://gestion.eduka-te.com/app/pdf_tripartita'.$gestion.'/cuestionario/';
$rutabaseemp = 'http://gestion.eduka-te.com/app/pdf_tripartita'.$gestion.'/empresa/';
$rutabaseempanexo = 'http://gestion.eduka-te.com/app/pdf_tripartita'.$gestion.'/anexos/';
$rutabasedoc = 'http://gestion.eduka-te.com/app/documentacion/docentes/';
$rutabasecomisionistas = 'http://gestion.eduka-te.com/app/documentacion'.$gestion.'/comisionistas/';
$rutabasemetodologia = 'http://gestion.eduka-te.com/app/documentacion'.$gestion.'/acciones/';
$rutabaseacreedores = 'http://gestion.eduka-te.com/app/facturacion'.$gestion.'/acreedores/';
$rutabaseikea = 'http://gestion.eduka-te.com/app/ikea'.$gestion.'/tablasparticipantes/';
$rutabaseikeadocu = 'http://gestion.eduka-te.com/app/ikea'.$gestion.'/consentimiento/';
$rutabasenominas = 'http://gestion.eduka-te.com/app/documentacion'.$gestion.'/nominas/';
$rutabasesolicitudes = 'http://gestion.eduka-te.com/app/documentacion'.$gestion.'/solicitudes/'.$_POST[numero].'/';
$rutabasetpc = 'http://gestion.eduka-te.com/app/documentacion'.$gestion.'/tpc/'.$_POST[numero].'/';
$rutabasenotagastos = 'http://gestion.eduka-te.com/app/documentacion'.$gestion.'/notagastos/'.$_POST[numero].'/';




if ( isset($_POST['id_mat']) ) {


    $sql = 'SELECT DISTINCT a.numeroaccion, ga.ngrupo

    FROM matriculas m, acciones a, grupos_acciones ga

    WHERE m.id_accion = a.id

    AND m.id_grupo = ga.id

    AND m.id = '.$id_mat;



    $sql = mysqli_query($link, $sql);

    while ($row = mysqli_fetch_assoc($sql)) {

        $naccion = $row['numeroaccion'];

        $ngrupo = $row['ngrupo'];

    }

    if ( $_POST['informedesdemat'] == '1' ) {

        $sql = 'SELECT DISTINCT e.cif
        FROM matriculas m, mat_alu_cta_emp ma, empresas e
        WHERE m.id = ma.id_matricula
        AND ma.id_empresa = e.id
        AND m.id = '.$id_mat;
            // echo $sql;
        $sql = mysqli_query($link, $sql);

        $row = mysqli_fetch_array($sql);
        $cif = $row[0];
        $tipo = 'empresa';
            }



} else if ( isset($_POST['id_empresa']) )  {



    $sql = 'SELECT cif

    FROM empresas

    WHERE id = '.$_POST[id_empresa];



    $sql = mysqli_query($link, $sql);

    $cif = mysqli_fetch_row($sql);

    $cif = $cif[0];



} else if ( isset($_POST['id_docente']) )  {



    $sql = 'SELECT d.*

    FROM docentes d

    WHERE id = '.$_POST[id_docente];



    $sql = mysqli_query($link, $sql);

    $row = mysqli_fetch_assoc($sql);

    if ( $row['tipodoc'] == 'Empresa' ) {
        $row[nombre]  = $row[nombredocente];
        $row[apellido] = $row[apellidodocente];
        $row[documento] = $row[documentodocente];
    }

    $docentepdf  = normaliza($row[nombre].'_'.$row[apellido].'_'.$row[documento]);
    // echo $docentepdf;


} else if ( isset($_POST['id_comisionista']) ) {

    $id_comisionista = $_POST["id_comisionista"];

    $sql = 'SELECT c.nombre, c.tipocomisionista
    FROM comisionistas c
    WHERE id = '.$id_comisionista;

    $sql = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($sql);
    $comisionistapdf = $row[tipocomisionista].'-'.normaliza($row[nombre]);

} else if ( isset($_POST['id_accion']) ) {

    $id_accion = $_POST["id_accion"];

    $sql = 'SELECT denominacion,numeroaccion
    FROM acciones
    WHERE id = '.$id_accion;

    $sql = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($sql);
    $metodologiapdf = 'Metodologia-AF_'.$row[numeroaccion];

}



if ( $_POST['busqueda'] == '1' ) {



    $row = array();

    $archivoini = $rutaini.$naccion.'-'.$ngrupo.'ini.pdf';

    $archivofin = $rutafin.$naccion.'-'.$ngrupo.'fin.pdf';

    $archivocues = $rutacues.$naccion.'-'.$ngrupo.'cues.pdf';



    if (file_exists($archivoini)) $row['existeini'] = 1;

    if (file_exists($archivofin)) $row['existefin'] = 1;

    if (file_exists($archivocues)) $row['existecues'] = 1;



    echo json_encode($row);



} else if ( $_POST['busqueda'] == '2' ) {



    $row = array();

    $archivoemp = $rutaempresa.$cif.'-informe.pdf';

    $archivoanexo = $rutaempresanexo.$cif.'-anexo.pdf';

    $archivoanexoenc_esfocc = $rutaempresanexo.$cif.'-anexoenc_esfocc.pdf';

    $archivoanexoenc_estrateg = $rutaempresanexo.$cif.'-anexoenc_estrateg.pdf';


    if (file_exists($archivoemp)) $row['existeinforme'] = 1;

    if (file_exists($archivoanexo)) $row['existeanexo'] = 1;

    if (file_exists($archivoanexoenc_esfocc)) $row['existeanexoenc_esfocc'] = 1;

    if (file_exists($archivoanexoenc_estrateg)) $row['existeanexoenc_estrateg'] = 1;

    $row['user'] = $_SESSION[user];

    echo json_encode($row);



} else if ( $_POST['busqueda'] == '3' ) {



    $row = array();

    $archivocv = $rutadocentes.$docentepdf.'-cv.pdf';
    // echo $archivocv;

    $archivocontrato = $rutadocentes.$docentepdf.'-contrato.pdf';
    $archivonif = $rutadocentes.$docentepdf.'-nif.pdf';
    $archivoniss = $rutadocentes.$docentepdf.'-niss.pdf';
    $archivoresp = $rutadocentes.$docentepdf.'-responsable.pdf';


    if (file_exists($archivocv)) $row['existecv'] = 1;
    if (file_exists($archivocontrato)) $row['existecontrato'] = 1;
    if (file_exists($archivonif)) $row['existenif'] = 1;
    if (file_exists($archivoniss)) $row['existeniss'] = 1;
    if (file_exists($archivoresp)) $row['existeresp'] = 1;


    echo json_encode($row);
    // echo $archivocv;43807837J

} else {



    $tipo = $_POST["tipo"];



    switch ($tipo) {



        case 'inicio':



        $archivo = $rutaini.$naccion.'-'.$ngrupo.'ini.pdf';

        $rutafinal = $rutabaseini.$naccion.'-'.$ngrupo.'ini.pdf';

        break;



        case 'fin':



        $archivo = $rutafin.$naccion.'-'.$ngrupo.'fin.pdf';

        $rutafinal = $rutabasefin.$naccion.'-'.$ngrupo.'fin.pdf';

        break;



        case 'cuestionario':



        $archivo = $rutacues.$naccion.'-'.$ngrupo.'cues.pdf';

        $rutafinal = $rutabasecues.$naccion.'-'.$ngrupo.'cues.pdf';

        break;



        case 'empresa':



        $archivo = $rutaempresa.$cif.'-informe.pdf';

        $rutafinal = $rutabaseemp.$cif.'-informe.pdf';

        break;



        case 'anexo':



        $archivo = $rutaempresanexo.$cif.'-anexo.pdf';

        $rutafinal = $rutabaseempanexo.$cif.'-anexo.pdf';

        break;

        case 'anexoenc_estrateg':


        if ( $cif == "" )
            $cif = $_POST[numero];


        $archivo = $rutaempresanexo.$cif.'-anexoenc_estrateg.pdf';

        $rutafinal = $rutabaseempanexo.$cif.'-anexoenc_estrateg.pdf';

        break;

        case 'anexoenc_esfocc':


        if ( $cif == "" )
            $cif = $_POST[numero];

        $archivo = $rutaempresanexo.$cif.'-anexoenc_esfocc.pdf';

        $rutafinal = $rutabaseempanexo.$cif.'-anexoenc_esfocc.pdf';


        break;


        case 'cv':



        $archivo = $rutadocentes.$docentepdf.'-cv.pdf';

        $rutafinal = $rutabasedoc.$docentepdf.'-cv.pdf';

        break;



        case 'contrato':



        $archivo = $rutadocentes.$docentepdf.'-contrato.pdf';

        $rutafinal = $rutabasedoc.$docentepdf.'-contrato.pdf';

        break;


        case 'nif':



        $archivo = $rutadocentes.$docentepdf.'-nif.pdf';

        $rutafinal = $rutabasedoc.$docentepdf.'-nif.pdf';

        break;


        case 'niss':



        $archivo = $rutadocentes.$docentepdf.'-niss.pdf';

        $rutafinal = $rutabasedoc.$docentepdf.'-niss.pdf';

        break;


        case 'responsable':

        $archivo = $rutadocentes.$docentepdf.'-responsable.pdf';

        $rutafinal = $rutabasedoc.$docentepdf.'-responsable.pdf';

        break;

        case 'comisionista':
        $archivo =  $rutacomisionistas.$comisionistapdf.'.pdf';
        $rutafinal =  $rutabasecomisionistas.$comisionistapdf.'.pdf';
        break;

        case 'metodologia':
        $archivo =  $rutametodologia.$metodologiapdf.'.pdf';
        $rutafinal =  $rutabasemetodologia.$metodologiapdf.'.pdf';
        break;

        case 'acreedores':
        $_POST['numero'] = str_replace('/', '-', $_POST['numero']);
        $acreedorpdf = $_POST['numero'].'-'.quitaTildesConComas($_POST['acreedor']);
        $archivo =  $rutaacreedores.$acreedorpdf.'.pdf';
        $rutafinal =  $rutabaseacreedores.$acreedorpdf.'.pdf';
                // echo $rutafinal;
        break;

        case 'tablaikea':
                // $_POST['numero'] = str_replace('/', '-', $_POST['numero']);
        $tablaikea = $_POST['numero'].'_'.quitaTildesConComas($_POST['denominacion']);
        $archivo =  $rutaikea.$tablaikea.'.xlsx';
        $rutafinal =  $rutabaseikea.$tablaikea.'.xlsx';
        break;

        case 'consentikea':
                // $_POST['numero'] = str_replace('/', '-', $_POST['numero']);
        $tablaikea = $_POST['numero'].'_'.quitaTildesConComas($_POST['denominacion']).'-consentimiento';
        $archivo =  $rutaikeadocu.$tablaikea.'.pdf';
        $rutafinal =  $rutabaseikeadocu.$tablaikea.'.pdf';
        break;

        case 'docufinalikea':
                // $filetype = pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION);
        $docuikea = str_replace('/','-', trim($_POST[numeroaccion]));
        $archivo =  $rutaikeadocu.$docuikea.'.pdf';
        $rutafinal =  $rutabaseikeadocu.$docuikea.'.pdf';
        break;

        case 'nomina':
                // $filetype = pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION);
        $anio = substr($_POST[fecha], -4);
        $rutanominas = dirname(__DIR__).'/documentacion'.$anio.'/nominas/';
        $rutabasenominas = 'http://gestion.eduka-te.com/app/documentacion'.$anio.'/nominas/';
        $nomina = $_POST[dni].'-'.$_POST[fecha];
        $archivo =  $rutanominas.$nomina.'.pdf';
        $rutafinal =  $rutabasenominas.$nomina.'.pdf';
                // echo $rutafinal;
                // envioMailIKEA($_POST['numeroaccion'],'','ikea_docufinal',$link,$_POST[modalidad]);
        break;

        case 'nominadocente':

            $_POST['fechainicio'] = str_replace('/', '-', $_POST['fechainicio']);
            $_POST['fechafin'] = str_replace('/', '-', $_POST['fechafin']);
            /*$docentepdf = $_POST['mes'].'-'.$_POST['anio'].'-'.quitaTildesConComas($_POST['nombredocente']);*/
            $docentepdf = $_POST['fechainicio'].'_'.$_POST['docente'].'_'.$_POST['fechafin'];
            $archivo = $rutanominadocente.$docentepdf.'.pdf';
            $rutafinal =  $rutabasenominadocente.$docentepdf.'.pdf';
            // echo $rutafinal;

        break;

        case 'tablasolb':
                // $filetype = pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION);
        $tablasol = $_POST[numero].'-tabla-bonif.xlsx';
                // echo $nomina;
        $archivo =  $rutasolicitudes.$tablasol;
        $rutafinal =  $rutabasesolicitudes.$tablasol;
                // envioMailIKEA($_POST['numeroaccion'],'','ikea_docufinal',$link,$_POST[modalidad]);
        break;

        case 'tablasolp':
                // $filetype = pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION);
        $tablasol = $_POST[numero].'-tabla-priv.xlsx';
                // echo $nomina;
        $archivo =  $rutasolicitudes.$tablasol;
        $rutafinal =  $rutabasesolicitudes.$tablasol;

                // envioMailIKEA($_POST['numeroaccion'],'','ikea_docufinal',$link,$_POST[modalidad]);
        break;

        case 'tablatpc':
            // $filetype = pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION);

            $tablasol = $_POST['numero'].'-tabla.xls';
                // echo $nomina;
            $archivo =  $rutatpc.$tablasol;
            $rutafinal =  $rutabasetpc.$tablasol;

        break;

        case 'matsol':
                // $filetype = pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION);
        $matsol = $_POST[numero].'-matricula.pdf';
                // echo $nomina;
        $archivo =  $rutasolicitudes.$matsol;
        $rutafinal =  $rutabasesolicitudes.$matsol;
                // envioMailIKEA($_POST['numeroaccion'],'','ikea_docufinal',$link,$_POST[modalidad]);
        break;

        case 'recibosol':
                // $filetype = pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION);
        $matsol = $_POST[numero].'-justificante.pdf';
                // echo $nomina;
        $archivo =  $rutasolicitudes.$matsol;
        $rutafinal =  $rutabasesolicitudes.$matsol;
                // envioMailIKEA($_POST['numeroaccion'],'','ikea_docufinal',$link,$_POST[modalidad]);
        break;

        case 'anexosol':
                // $filetype = pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION);
        $numsol = $_POST[numero];
                // echo $nomina;

        $rutasolicitudesx = '../documentacion'.$gestion.'/solicitudes/'.$numsol.'/';
        $anex = $numsol.'-anexo';
        $ficheros = scandir($rutasolicitudesx);

        $enlaces = '<div style="text-align:center; margin-top: 15px">';
        for ($i=0; $i < count($ficheros) ; $i++) {

            if ( strpos($ficheros[$i], $anex) !== FALSE ) {
                $j++;
                $enlaces .= '<a style="text-align:center" href="'.$rutabasesolicitudes.$ficheros[$i].'" target="_blank">Anexo'. $j .'</a><br>';
            }

        }
        $enlaces .= '</div>';

        $archivo =  $rutasolicitudes.$matsol;
        $rutafinal =  $rutabasesolicitudes.$matsol;
        $devuelvelinks = 1;
                // envioMailIKEA($_POST['numeroaccion'],'','ikea_docufinal',$link,$_POST[modalidad]);
        break;

        case 'notagastos':
                // $filetype = pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION);
        $numsol = $_POST['numero'];
                // echo $nomina;
                // echo "entra";
        $rutanotagastosx = '../documentacion'.$gestion.'/notagastos/'.$numsol.'/';
                // $notagastos = $numsol.'-gasto';
        $ficheros = scandir($rutanotagastosx);
                // arrayText($ficheros);

        $files = array();
        $ruta = dirname(__DIR__).'/documentacion'.$gestion.'/notagastos/'.$numsol.'/';

        $enlaces = '<div style="text-align:left; margin: 20px">';
        for ($i=0; $i < count($ficheros) ; $i++) {

            $info = pathinfo($ficheros[$i]);

            if ( $i > 1 && $info['extension'] != "zip" ) {
                $j++;

                $fich = $ruta.$ficheros[$i];
                array_push($files, $fich);
                $enlaces .= '<li><a style="text-align:left" href="'.$rutabasenotagastos.$ficheros[$i].'" target="_blank">'.$ficheros[$i].'&nbsp; <span class="warning glyphicon glyphicon-save"></span></a></li>';
            }

        }
        $enlaces .= '</div>';

                // echo "hola".$enlaces;

        $archivo =  $rutanotagastos;
        $rutafinal =  $rutabasenotagastos;
        $devuelvelinks = 1;

        $resul = create_zip($files, $ruta.$numsol.'.zip');

        if ( $resul !== false ) {
            $enlaces .= '<a class="btn btn-success" style="margin:20px; text-align:left" href="'.$rutabasenotagastos.$numsol.'.zip" target="_blank"><span class="glyphicon glyphicon-save"></span> Descargar todo </a>';
        }


                // envioMailIKEA($_POST['numeroaccion'],'','ikea_docufinal',$link,$_POST[modalidad]);
        break;


        case 'propuestafirmada':
                // $filetype = pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION);

        $q = 'SELECT *
        FROM peticiones_formativas
        WHERE id = "'.$_POST['id_propuesta'].'"';
        $q = mysqli_query($link, $q) or die("error select : " .mysqli_error($link));

        $row = mysqli_fetch_assoc($q);
        $emp = quitaTildesConComasyBarras($row['empresareal']);
        $curso = $row['formacion'];
        $formacion = quitaTildesConComasyBarras($row['formacion']);
        $nombreFichero = $row['tiposol'].$row['numero'].'_'.$formacion.'_OK.pdf';

                // echo $nomina;
        $archivo =  $rutapropuestas.$nombreFichero;
        $rutafinal =  $rutabasepropuestas.$nombreFichero;
                // envioMailIKEA($_POST['numeroaccion'],'','ikea_docufinal',$link,$_POST[modalidad]);
        break;


    }


// echo ($rutafinal);

    if ( $devuelvelinks == 1 ) {
        echo $enlaces;
    } else {
        if ( file_exists($archivo) )
            echo ($rutafinal);
        else
            echo "no";
    }



}





?>
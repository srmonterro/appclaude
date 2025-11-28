
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="/app/css/fonts.css" type="text/css" charset="utf-8">
    <link rel="stylesheet" href="/app/css/esfocc.css" type="text/css" charset="utf-8">
</head>


<?

include('../functions/funciones.php');


?>

<style>

    * {
        margin:0;
        padding:0;
        background-color: white !important;
        background-image: none !important;
        font-family: sans-serif;
    }

    .page {
        width: 21cm;
        height: 31.10cm;
        padding: 15px 30px;
        page-break-after: always
    }


    @page {
        size: A4;
        margin: 0;
    }


    th, td { padding: 5px; }
    table { font-size: 12px; border-collapse: collapse; }
    td {border: 1px solid #FF0000; height: 25px;}
    th {border: 3px solid #FF0000}

    table.sinborde td { border: 0px; }

    table.bordegris td { border: 1px solid #ccc; padding-top: 5px; }
    table.bordegris th { border: 1px solid #ccc}
    table.bordegris { border: 3px solid #ccc; color: #1B0085; font-weight: bold;}

    table.bordegrisTPC { border: 3px solid #ccc; color: black; font-weight: bold;}
    table.bordegrisTPC td { border: 1px solid #ccc; padding-top: 5px; }
    table.bordegrisTPC th { border: 1px solid #ccc}

    table.ikearlt td {border: 1px solid #000; height: 25px;}
    table.ikearlt th {border: 3px solid #000}

    .controlasist {
        color: #1B0085;
    }

    .controlasistTPC{
      color: black;
  }

  p { margin-top: 3px; line-height: 130% }
  ol li { margin-top: 5px;}
  ul li { margin-top: 5px;}


</style>


<?


if ( isset($_GET['numero']) ) {

    $numero = $_GET['numero'];

    $archivo = '/documentacion'.$gestion.'/tpc/'.$numero.'/'.$numero.'-tabla.xls';
    // echo $archivo;

    if ( $a = leerExcel($archivo) ) {
        // echo "entra";
        $q = 'SELECT c.*, a.horastotales, a.denominacion, a.modalidad, ch.*
        FROM acciones a
        INNER JOIN cursos_tpc c ON c.id_accion = a.id
        LEFT JOIN cursos_tpc_horarios ch ON ch.id_curso = c.id
        WHERE c.numcurso = "'.$numero.'"
        ORDER BY fecha ASC';
        // echo $q;
        $q = mysqli_query($link, $q) or die("error select : " .mysqli_error($link));


        while ($row = mysqli_fetch_assoc($q)) {


            $horario = "";
            if ( $row['horariomini'] !== "" )
                $horario = $row['horariomini'].' - '.$row['horariomfin'];
            if ( $row['horariomini'] !== "" && $row['horariotini'] !== "" )
                $horario .= ' | ';
            if ( $row['horariotini'] != "" )
                $horario .= $row['horariotini'].' - '.$row['horariotfin'];

            ?>
            <div style="" class="controlasistTPC page page-break">

                <div style="overflow: auto" id="cabecera">
                    <div style="margin-top: 35px;">
                        <h4 style="text-align:center;">
                        CENTRO DE IMPARTICIÓN: ISLAS PREVENCIÓN Y SEGURIDAD EN LA EMPRESA
                        </h4>
                    </div>
                    <div style="margin-top: 20px; float:none">
                        <h4 style="text-align:center;">
                        CONTROL DE ASISTENCIA
                        </h4>
                    </div>
                </div>

                <div class="clearfix"></div>

                <table class="bordegrisTPC" style="margin-top: 20px; width:100%;">
                  <tr>
                    <td style="width:20%;">NOMBRE DEL CURSO: </td>
                    <td style="width:80%;" colspan="5"><? echo ($row['denominacion']) ?></td>
                </tr>
                <tr >
                    <td style="width:20%;">CÓDIGO DEL CURSO: </td>
                    <td style="width:10%;"><? echo $row['numcurso'] ?></td>
                    <td style="width:10%;">LOCALIDAD DE IMPARTICIÓN:</td>
                    <td style="width:60%;" colspan="3"><? echo ($row['poblacion'])?></td>
                </tr>
                <tr>
                    <td style="width:20%;">C.P.:</td>
                    <td style="width:10%;"><? echo ($row['codigopostal']) ?></td>
                    <td style="width:10%;">PROVINCIA:</td>
                    <td style="width:60%;" colspan="3"><? echo ($row['provincia'])?></td>
                </tr>
                <tr>
                    <td style="width:20%;">PROFESOR/PROFESORES: </td>
                    <?

                    $docente = "";

                    $q1 = 'SELECT DISTINCT d.*
                    FROM cursos_tpc c
                    INNER JOIN cursos_tpc_docentes cd ON cd.id_curso = c.id
                    INNER JOIN docentes d ON d.id = cd.id_docente
                    WHERE c.numcurso = "'.$numero.'"';
                    // echo $q1;
                    $q1 = mysqli_query($link, $q1) or die("error select : " .mysqli_error($link));

                    while ( $row1 = mysqli_fetch_assoc($q1) ) {
                        $docente .= $row1['nombredocente'].' '.$row1['apellidodocente'].' '.$row1['apellido2docente']."<br>";
                    }

                    ?>
                    <td style="width:80%;" colspan="5"><? echo $docente ?></td>
                </tr>
                <tr>
                    <td style="width:20%;">FECHA: </td>
                    <td style="width:10%;">
                        <?
                        echo (formateaFecha($row['fecha'])."</td>");
                        echo ("<td style='width:10%;'>HORARIO:</td>");
                        echo ("<td style='width:40%;' colspan='3'>".$horario."</td>");
                        ?>
                    </tr>
                </table>

                <div class="clearfix"></div>

                <table class="bordegrisTPC" style="width:100%; margin-top: 25px;" >
                  <tr>
                    <th colspan="2" style="height:50px;">ALUMNOS (Apellidos y Nombre)</th>
                    <th>DNI / NIE</th>
                    <th>FIRMA DE ASISTENCIA</th>
                    <th>OBSERVACIONES<sup>1<sup></th>
                </tr>
                <?

                $k = 1;

                foreach ($a as $key => $value) {

                    if ( $value['3'] != "NOMBRE" ) { ?>

                    <tr>
                        <td colspan="2"><span style="margin-right:3px; color:#bbb"><? echo $k++ .'.</span> '. mb_strtoupper( $value['3'].' '.$value['2'], 'UTF-8' ) ?></td>
                        <td><? echo($value['4']) ?></td>
                        <td></td>
                        <td></td>
                    </tr>

                    <?
                }

            }

            while ($k <= 25) {

                ?>

                <tr>
                    <td colspan="2"><span style="margin-right:3px; color:#bbb"><? echo $k++ .'.</span> '?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

                <?
            }


            ?>

        </table>

        <table class="bordegrisTPC" style="width:100%; margin-top: 25px;" >
          <tr>
            <td style="width:35%; height:70px; vertical-align:text-top">FIRMA PROFESOR/PROFESORES:</td>
            <td style="width:65%;"></td>
        </tr>
    </table>

    <div style="border-top:1px solid black; margin-top: 25px;" id="notapie3">
        <p style="margin-top:2px; font-size: 9px"><sub style="vertical-align:super">1</sub> En la última sesión del curso realizado se deberá reflejar el resultado de aprovechamiento del mismo, indicando la calificación de
            <span style="margin-right:3px;">APTO /NO APTO</span>, conforme los criterios de evaluación fijados para el curso.</p>
        </div>
    </div>

        <?
        }
    } else {
        echo "error, no lee archivo";
    }

} else {

    echo "Error, falta parametro.";

}

?>

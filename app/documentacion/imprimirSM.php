<?

	$baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
    include_once($baseurl.'/functions/funciones.php');
    require_once($baseurl.'/plugins/html2pdf/html2pdf.class.php');
    require_once($baseurl.'/plugins/mpdf/mpdf.php');

    // print_r($_SESSION);
    // $id = '2066';
    $id = $_GET['id'];

    $q = 'SELECT *
	FROM peticiones_formativas p
	WHERE id = '.$id;
    // echo $q;
	$q = mysqli_query($link, $q) or die("error select : " .mysqli_error($link));

	$row = mysqli_fetch_assoc($q);

	$camposmat = array("Curso", "Modalidad", "Tipo Formación", "Horas", "Nº Alumnos", "Precio/Alumno", "Fecha Inicio", "Fecha Fin", "Lugar" );
	$valoresmat = array($row[formacion], $row[modalidad], $row[tipoformacionpropuesta], $row[horastotales], $row[numalumnos], $row[preciomatricula], $row[fechaini], $row[fechafin], $row[nombrecentro]);

    // echo $_SESSION['anio'];
    $archivo = "documentacion".$gestion."/solicitudes/".substr($row[numero], -4)."/".substr($row[numero], -4)."-tabla-bonif.xlsx";
        // echo $archivo;

    // if ( file_exists($archivo) )
    $a = leerExcel($archivo);

    if ( count($a) > 1 ) {
            // arrayText($a);
        foreach ($a as $k => $v) {

            if ( $v != "" ) {
                unset($a[$k][5]);
                // unset($a[$k][6]); // empresa
                // unset($a[$k][7]); // cif
                unset($a[$k][8]);
                unset($a[$k][9]);
                unset($a[$k][10]);
                unset($a[$k][11]);
                unset($a[$k][12]);
                unset($a[$k][13]);
                unset($a[$k][14]);
                unset($a[$k][15]);
                unset($a[$k][16]);
                    // echo $a[$k][18];
                if ( strpos($a[$k][17], 'ELECTRÓNICO') !== false )
                    $a[$k][17] = 'EMAIL';
                if ($a[$k][18] == 'NUMERO DE TELEFONO')
                    $a[$k][18] = 'TELEFONO';

                unset($a[$k][19]);

            }
        }

        $campos = $a[1];

        // unset($campos[6]);
        // unset($campos[7]);
        // arrayText($campos);

        unset($a[1]);
        $datos = array();
        array_multisort($a, SORT_DESC);

        foreach ($a as $key => $value) {

            if ( $value[1] != "" ) {

                if ( $value[7] != $cif_ant ) {
                    $emp[$value[7]][] = $value;
                } else {
                    $emp[$value[7]][] = $value;
                }

                $cif_ant = $value[7];
            }

            // unset($emp[$key][$value][6]);
            // unset($emp[$key][$value][7]);

        }
        // arrayText($a);

        // arrayText($emp);
        // arrayTable($campos, $emp);

    }
    // cgutierrez adaptación para cuando no hay tabla
    // else {
    //      $emp[$value[7]][] = "Carlos ....";
    // }
    //echo 'ererer';
//
    $html2pdf = new mPDF('','', 0, '', 20, 20, 30, 25, 30, 20, 'P');

    ob_start();


  	?>

	<style>
		*:not(h3,h2) {
			font-size: 15px;
		}
        body {
            margin: 0;
            padding: 0;
            background-image-resize: 6;
            background-image: url('/fondo_doc.jpg');
        }
	</style>

    <body style="background-image:url(<? echo $baseurl; ?>/documentacion/fondo_doc.png)">


    <?


    $z = 0;
    foreach ($emp as $key => $value) {


        $empresa = $value[0][6].' - '.$value[0][7];

    ?>


        <div stlye="" >

        	<h2 style="margin-top: 50px;text-align:center">Matrícula <? echo $row[numero]. ' - '. $empresa ?></h2>

        	<h3 style="margin-top: 50px">Datos de Empresa y Participantes</h3>

        	<strong>Empresa: </strong><? echo $empresa ?>

        	<?

                arrayTable($campos, $value);

        	?>

        	<h3 style="margin-top: 50px">Datos del Curso</h3>

        	<?

        	echo '<ul style="list-style-type:none">';

        	$i = 0;
        	foreach ($valoresmat as $valor) {

        		if ( $valor == "0000-00-00" ) {
        			$valor = "";
        		}
        		else if ( isDate($valor) ) {
        			$valor = formateaFecha($valor);
        		}

        		echo '<li style="padding:5px"><strong>· '.$camposmat[$i].':</strong> '.$valor.' </li>';
        		$i++;

        	}

        	echo '</ul>';

        	?>

        	<table style="margin-top: 60px">
        		<tr style="text-align:center">
        		    <td width="70"></td>
        			<td style="text-align:center">Conforme <? echo $empresa ?></td>
        			<td width="30"></td>
        			<td style="text-align:center">Conforme ESFOCC</td>
        		</tr>
        	</table>


        </div>
        <pagebreak>
        <? $z++;

    } ?>

    </body>

    <?

    // arrayText($emp);
    $contenido = ob_get_clean();

    $nombreFichero = 'ComprobanteMatricula_SM'.$row[numero].'.pdf';
    // $html2pdf->setDebug();
    // $html2pdf = new HTML2PDF('P', 'A4', 'es', true, 'UTF-8', array(0, 0, 0, 0));
    // $html2pdf->setDefaultFont('Arial');

    $html2pdf->writeHTML($contenido);
	$html2pdf->Output($nombreFichero, 'I');

?>
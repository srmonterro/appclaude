<?

	$baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
    include_once($baseurl.'/functions/funciones.php');
    require_once($baseurl.'/plugins/html2pdf/html2pdf.class.php');
    require_once($baseurl.'/plugins/mpdf/mpdf.php');

    // print_r($_SESSION);
    // $id = '2066';
    $id = $_GET['id'];


    $q = 'SELECT p.*, c.nombre as nombrecomercial, c.apellido as apcomercial, d.nombre as nombredocente, d.apellido as apdocente
	FROM peticiones_gastos p
    LEFT JOIN comerciales c ON c.id = p.id_comercial
    LEFT JOIN docentes d ON d.id = p.id_docente_peticion
	WHERE p.id = '.$id;
    // echo $q;
	$q = mysqli_query($link, $q) or die("error select : " .mysqli_error($link));

	$row = mysqli_fetch_assoc($q);

    if ( $row['nombredocente'] === NULL ) {
        $usuario = $row['nombrecomercial'].' '.$row['apcomercial'];
    } else {
        $usuario = $row['nombredocente'].' '.$row['apdocente'];
    }
	// $camposmat = array("Curso", "Modalidad", "Tipo Formación", "Horas", "Nº Alumnos", "Precio/Alumno", "Fecha Inicio", "Fecha Fin", "Lugar" );
	// $valoresmat = array($row[formacion], $row[modalidad], $row[tipoformacionpropuesta], $row[horastotales], $row[numalumnos], $row[preciomatricula], $row[fechaini], $row[fechafin], $row[nombrecentro]);

    $html2pdf = new mPDF();
    ob_start();


  	?>

	<style>
		*:not(h3,h2) {
			font-size: 15px;
		}
        body {
            font-family: Arial;
            margin: 0;
            padding: 0;
            background-image-resize: 6;
            background-image: url('/fondo_doc.jpg');
        }
        li {
            margin-top: 15px;
        }
	</style>

    <body style="background-image:url(<? echo $baseurl; ?>/documentacion/fondo_doc.png)">


    <?


    $z = 0;

    ?>

        <div stlye="" >

        	<h2 style="text-align:center; margin-top: 50px;">Nota de Gatos - <? echo "SN".$row['numero'].": ".$usuario  ?></h2>

        	<h3 style="text-align:center; margin-top: 50px">Detalle de Gastos</h3>
            <hr>

            <ul>
            <?
            if ( $row['importedietas'] != 0 ) {
                echo "<li><strong>Dietas:</strong><p> ".$row['importedietas']." €</p></li>";
            }

            if ( $row['importegasolina'] != 0 ) {
                echo "<li><strong>Gasolina:</strong><p> ".$row['importegasolina']." €</p></li>";
            }

            if ( $row['importemateriales'] != 0 ) {
                echo "<li><strong>Materiales:</strong><p> ".$row['importemateriales']." €</p></li>";
            }

            echo "<li><strong>Método de Pago:</strong><p> ".$row['metodopago']."</p></li>";

            if ( $row['observaciones'] != "" && $row['observaciones'] !== NULL ) {
                echo "<li><strong>Observaciones:</strong><p> ".$row['observaciones']."</p></li>";
            }

            ?>
            </ul>

        </div>

    </body>

    <?

    // arrayText($emp);
    $contenido = ob_get_clean();

    $nombreFichero = 'NotaGastos_SN'.$row['numero'].'.pdf';
    // $html2pdf->setDebug();
    // $html2pdf = new HTML2PDF('P', 'A4', 'es', true, 'UTF-8', array(0, 0, 0, 0));
    // $html2pdf->setDefaultFont('Arial');

    $html2pdf->writeHTML($contenido);
	$html2pdf->Output($nombreFichero, 'I');

?>

<?

    include_once '../functions/funciones.php';
    // $id_docente = $_POST["id_docente"];
    $idmat = $_POST[id_matricula];

    $sql = 'SELECT d.*
    FROM mat_doc md, docentes d
    WHERE md.id_docente = d.id
    AND md.id_matricula = '.$idmat;

    $i = 0;
    $sql = mysqli_query($link, $sql);

    while ( $row = mysqli_fetch_assoc($sql) ) {

        if ( $row['tipodoc'] == 'Empresa' ) {
            $row[nombre]  = $row[nombredocente];
            $row[apellido] = $row[apellidodocente];
            $row[documento] = $row[documentodocente];
        }

        // $nombredocente = $row[nombre];
        // $apellidodocente = $row[apellido];
        // $documentodocente = $row[documento];
        $docentepdf  = normaliza($row[nombre].'_'.$row[apellido].'_'.$row[documento]).'-cv.pdf';

        $filenamedir = './docentes/'.$docentepdf;
        //$filename = 'http://gestion.eduka-te.com/app/documentacion/docentes/'.$docentepdf;
        $filename ='http://gestion.eduka-te.com/app/documentacion/docentes/Hoja_Datos_Alumnado.pdf';
        $i++;

        $r[$i][url] = $filename;

    }

    if ( count($r) > 0 )
        echo json_encode($r);
    else
        echo 0;



?>
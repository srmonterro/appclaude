<?

include_once './funciones.php';

session_start();
$gestion = devuelveAnio();


$rutadoc = dirname(__DIR__).'/import'.$gestion.'/doc/';
$rutafin = dirname(__DIR__).'/import'.$gestion.'/fin/';


if ($_FILES["file"]["error"] > 0) {
    
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    
} else {
        
    $id_mat = $_POST["id_mat"];
    $tipo = $_POST["tipo"];
    $bonificado = $_POST["bonificado"];
    
    $sql = 'SELECT DISTINCT a.numeroaccion, ga.ngrupo, a.modalidad
    FROM matriculas m, acciones a, grupos_acciones ga 
    WHERE m.id_accion = a.id
    AND m.id_grupo = ga.id
    AND m.id = '.$id_mat;

    $sql = mysqli_query($link, $sql);
    while ($row = mysqli_fetch_assoc($sql)) { 
        $naccion = $row['numeroaccion'];
        $ngrupo = $row['ngrupo'];
        $modalidad = $row['modalidad'];
    }
     
    // para el cambio de numeracion de privados
    $grupo = explode('p', $ngrupo);
    $ngrupo = $grupo[0]; 


    switch ($tipo) {
        
        case 'doc':            
            
            if ( $bonificado == 'si' ) {

                $move = move_uploaded_file($_FILES["file"]["tmp_name"], $rutadoc . $naccion.'-'.$ngrupo.'doc.xlsx');
                chmod($rutadoc . $naccion.'-'.$ngrupo.'doc.xlsx',0755);
                enviarMailNotif($naccion, $ngrupo, 'doc',$link, '', $_SESSION[user]);

            } else if ( $bonificado == 'no' ) {

                $move = move_uploaded_file($_FILES["file"]["tmp_name"], $rutadoc . $naccion.'-'.$ngrupo.'docp.xlsx');
                chmod($rutadoc . $naccion.'-'.$ngrupo.'docp.xlsx',0755);
                enviarMailNotif($naccion, $ngrupo, 'docp',$link, '', $_SESSION[user]);
            }

            break;
        
        case 'fin':

            if ( $bonificado == 'si' ) {

                $move = move_uploaded_file($_FILES["file"]["tmp_name"], $rutafin . $naccion.'-'.$ngrupo.'fin.xlsx');
                chmod($rutafin . $naccion.'-'.$ngrupo.'fin.xlsx',0755);
                enviarMailNotif($naccion, $ngrupo, 'fin',$link, '', $_SESSION[user]);

            } else if ( $bonificado == 'no' ) {

                $move = move_uploaded_file($_FILES["file"]["tmp_name"], $rutafin . $naccion.'-'.$ngrupo.'finp.xlsx');
                chmod($rutafin . $naccion.'-'.$ngrupo.'finp.xlsx',0755);
                //enviarMailNotif($naccion, $ngrupo, 'finp',$link); //  no contmemplado en enviarMailNotif.

            }

            break;
        
    }
       
    if ( $move == 'true' ) {
        
        echo "bien";
    }
    else 
        echo "error";
}

//you get the following information for each file:
// print_r($_FILES['excel']['name']);
// print_r($_FILES['excel']['size']);
// print_r($_FILES['excel']['type']);
// print_r($_FILES['excel']['tmp_name']);
// echo "<br>";
//print_r($_FILES['file']['error']);
?>
<?

$ruta = dirname(__DIR__).'/import/';

if ($_FILES["file"]["error"] > 0) {
    
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    
} else {
    
    // echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    // echo "Type: " . $_FILES["file"]["type"] . "<br>";
    // echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    // echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

    if (file_exists($ruta . 'datos-fin.xlsx')) {
            
        chmod('datos-fin.xlsx',0755); //Change the file permissions if allowed
        unlink('datos-fin.xlsx'); //remove the file
       
    }
               
    $move = rename($_FILES["file"]["tmp_name"],$ruta . 'datos-fin.xlsx');
    chmod($ruta .'datos-fin.xlsx',0755);   
    
    if ( $move == 'true' ) {
        echo "bien";
        $naccion = '-';
        $ngrupo = '-';
        enviarMailNotif ($naccion, $ngrupo, 'fin', $link);
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
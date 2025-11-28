<?

include './funciones.php';


    // unset($_POST['seg-comercial']);
    // unset($_POST['buscarempresa']);
    
    // $comercial = '( (m.comercial = c.id AND m.comercial <> 0) OR (e.comercial = c.id) )';
    // $costes = ' (SELECT SUM(mc.costes_imparticion)
    // FROM mat_costes mc where mc.id_matricula = @idmat) AS coste ';
    // $costesemp1 = '';
    // $costesemp2 = '';
    // $grupo = '';

    $i = 0;
    foreach ($_POST as $key => $value) { 

        if ( $value != "" ) {

            $and = ' AND ';

            if ($key == 'operador') {
                $op = $value; 
                $and = '';
                $in = '';
            }
            
            if ($key == 'credito') {
                $in = ' credito '.$op.$value;
                $like = '';
            }

            if ($key == 'zona') {
                $in = ' e.codigopostal = codpostal AND idzona = z.id AND z.id IN '."('".$value."')";
                $like = ''; 
                $zona = ' , zonas z, poblaciones p';
            }

            if ($key == 'razonsocial') {
                $like = $key.' LIKE '."'%".$value."%'";
                $in = ''; 
            }
             
            if ($key == 'provincia') {
                $in = ' '.$key.' IN '."('".$value."')";
                $like = '';
                
            }

            if ($key == 'poblacion') {
                if ( isset($_POST[zona]) )
                    $in = ' p.poblacion IN '."('".$value."')";
                else
                    $in = ' '.$key.' IN '."('".$value."')";
                $like = '';
                
            }

            if ($key == 'codigopostal') {
                $in = ' '.$key.' IN '."('".$value."')";
                $like = '';
                
            }

            if ($key == 'actividad') {
                $in = ' e.actividad IN '."('".$value."')";
                $like = '';
                
            }

            if ($key == 'razonsocial') {
                $like = $key.' LIKE '."'%".$value."%'";
                $in = ''; 
                
            }

            if ($key == 'comercial') {                
                $in = ' c.id IN '."('".$value."')";
                $like = '';
                
            }

            $valores .= $value;
            $campos .= $and.$like.$in;

        }
        
    } 

    $q = 'SELECT DISTINCT e.*, CONCAT(c.nombre," ",c.apellido) as comercial
    FROM empresas e, comerciales c '.$zona.'
    WHERE e.comercial = c.id 
    '.$campos;

    // echo $q;
    $q = mysqli_query($link, $q);


    header('Content-Encoding: UTF-8');
    header("Content-type: text/x-vcard");
    header("Content-Disposition: filename=listaemails".date("d-m-Y").".vcf");  
    
    $emails = array();
    while ( $row = mysqli_fetch_assoc($q) ) {
        // $razonsocial = str_replace(",", " ", $row[razonsocial]);

        if ( array_search($row[email], $emails) === false ) {
            $text .= "BEGIN:VCARD\r\n";
            $text .= "VERSION:3.0\r\n";
            $text .= "FN:".quitaTildes($row[razonsocial])."\r\n";
            $text .= "ORG: Mailing\r\n";
            // $text .= "TEL;CELL;PREF:+34 ".$row[telefono]."\r\n";
            $text .= "EMAIL:".$row[email]."\r\n";
            $text .= "END:VCARD\r\n";
        }

        array_push($emails, $row[email]);
    }
    
    echo $text;
    // echo ( mb_convert_encoding($text, 'UTF-16LE', 'UTF-8') );
    exit;



?>


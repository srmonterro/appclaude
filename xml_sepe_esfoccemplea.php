<?

if ($_GET['id_matricula'])
    $id_mat = $_GET['id_matricula'];

$baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
include_once($baseurl.'/functions/funciones.php');


$link = connectEmplea();

header('Content-type: text/xml');
header('Content-Disposition: attachment; filename="sepe.xml"');
   

$text ='<?xml version="1.0" encoding="ISO-8859-1"?>
<ENVIO_ENPI xsi:noNamespaceSchemaLocation="XML_ENPI_v1_1.xsd" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
    <ENVIO_MENSUAL>
        <CODIGO_AGENCIA>0500000114</CODIGO_AGENCIA>
        <AÑO_MES_ENVIO>201601</AÑO_MES_ENVIO>';

// $sql = 'SELECT count(*) as total FROM ly1t7_users
// WHERE registerDate >= "2015-06-01" 
// AND registerDate <= "2015-07-31"';
$sql = 'SELECT count(*) as total FROM ly1t7_users u, ly1t7_js_job_resume r, ly1t7_js_job_userfield_data ud
WHERE registerDate >= "2016-01-01" AND registerDate <= "2016-01-31"
AND r.uid = u.id 
AND create_date >= "2016-01-01" 
AND create_date <= "2016-01-31" 
AND ud.referenceid = r.id
AND ud.field = 20
AND CHAR_LENGTH(data) = 9
AND r.date_of_birth NOT IN("0000-00-00 00:00:00","1970-01-01 00:00:00","1970-01-01 01:00:00")';
$sql = mysqli_query($link, $sql) or die('error1' . mysqli_query($link) );
$row = mysqli_fetch_array($sql);
$TOTAL_PERSONAS = $row[total];

$sql = 'SELECT count(*) as nuevas FROM ly1t7_users u, ly1t7_js_job_resume r, ly1t7_js_job_userfield_data ud
WHERE registerDate >= "2016-01-01" AND registerDate <= "2016-01-31"
AND r.uid = u.id 
AND create_date >= "2016-01-01" 
AND create_date <= "2016-01-31" 
AND ud.referenceid = r.id
AND ud.field = 20
AND CHAR_LENGTH(data) = 9
AND r.date_of_birth NOT IN("0000-00-00 00:00:00","1970-01-01 00:00:00","1970-01-01 01:00:00")';
$sql = mysqli_query($link, $sql) or die('error2' . mysqli_query($link) );
$row = mysqli_fetch_array($sql);
$TOTAL_NUEVAS_REGISTRADAS = $row[nuevas];

$sql = 'SELECT count(*) as totalofertas FROM ly1t7_js_job_jobs
WHERE created >= "2016-01-01" AND created <= "2016-01-01"';
$sql = mysqli_query($link, $sql) or die('error3' . mysqli_query($link) );
$row = mysqli_fetch_array($sql);
$TOTAL_OFERTAS = $row[totalofertas];



$text.= '<ACCIONES_REALIZADAS>';

	  $sql = 'SELECT DISTINCT * 
    FROM ly1t7_users u, ly1t7_js_job_resume r, ly1t7_js_job_userfield_data ud
    WHERE r.uid = u.id 
    AND create_date >= "2016-01-01" 
    AND create_date <= "2016-01-31" 
    AND ud.referenceid = r.id
    AND ud.field = 20
    AND CHAR_LENGTH(data) = 9
    AND r.date_of_birth NOT IN("0000-00-00 00:00:00","1970-01-01 00:00:00","1970-01-01 01:00:00")';
    $sql = mysqli_query($link, $sql) or die('error' . mysqli_query($link) );
    
    $nivel = array("00","10","20","30");
    // print_r($nivel);
    while ($row = mysqli_fetch_array($sql)) {
        
        $apellido = explode(" ",$row[last_name]);
        $fechaNac = explode(" ",$row[date_of_birth]);
        $nombre = explode(" ", $row[first_name]);

      if ( !is_numeric($row[data]) ) {
    			$text.='
    	   <ACCION>
      	    <ID_TRABAJADOR>'. $row[data] .'</ID_TRABAJADOR>
      			<NOMBRE_TRABAJADOR>'.substr($nombre[0], 0, 15).'</NOMBRE_TRABAJADOR>
      			<APELLIDO1_TRABAJADOR>'.$apellido[0].'</APELLIDO1_TRABAJADOR>
      			<APELLIDO2_TRABAJADOR>'.$apellido[1].'</APELLIDO2_TRABAJADOR>
      			<FECHA_NACIMIENTO>'.str_replace("-", "", $fechaNac[0]).'</FECHA_NACIMIENTO>
      			<SEXO_TRABAJADOR>'.$row[gender].'</SEXO_TRABAJADOR>
      			<NIVEL_FORMATIVO>';
            $text.= array_rand($nivel).'0';
            $text.='</NIVEL_FORMATIVO>
      			<DISCAPACIDAD>N</DISCAPACIDAD>
      			<INMIGRANTE>'; 
            if ( $row[data][0] == "X" || $row[data][0] == "Y" ) 
                $text.= "S";
            else 
                $text.= "N";
            $text .='</INMIGRANTE>
      			<COLOCACION>N</COLOCACION>
         </ACCION>';
      }

		}
            
    

$text .= '</ACCIONES_REALIZADAS>
<DATOS_AGREGADOS>
      <TOTAL_PERSONAS>'.$TOTAL_PERSONAS.'</TOTAL_PERSONAS>
      <TOTAL_NUEVAS_REGISTRADAS>'.$TOTAL_NUEVAS_REGISTRADAS.'</TOTAL_NUEVAS_REGISTRADAS>
      <TOTAL_PERSONAS_PERCEPTORES>0</TOTAL_PERSONAS_PERCEPTORES>
      <TOTAL_PERSONAS_INSERCION>0</TOTAL_PERSONAS_INSERCION>
      <TOTAL_OFERTAS>'.$TOTAL_OFERTAS.'</TOTAL_OFERTAS>
      <TOTAL_OFERTAS_ENVIADAS>0</TOTAL_OFERTAS_ENVIADAS>
      <TOTAL_OFERTAS_CUBIERTAS>0</TOTAL_OFERTAS_CUBIERTAS>
      <TOTAL_PUESTOS>0</TOTAL_PUESTOS>
      <TOTAL_PUESTOS_CUBIERTOS>0</TOTAL_PUESTOS_CUBIERTOS>
      <TOTAL_CONTRATOS>0</TOTAL_CONTRATOS>
      <TOTAL_CONTRATOS_INDEFINIDOS>0</TOTAL_CONTRATOS_INDEFINIDOS>
      <TOTAL_PERSONAS_COLOCADAS>0</TOTAL_PERSONAS_COLOCADAS>
    </DATOS_AGREGADOS>
    </ENVIO_MENSUAL>
</ENVIO_ENPI>';

echo $text;

?>
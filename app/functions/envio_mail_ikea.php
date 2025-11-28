<?

    $baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
    include_once($baseurl.'/functions/funciones.php');
    require_once($baseurl.'/plugins/PHPMailer/PHPMailerAutoload.php');

    $tipo = $_POST[tipo];
    $id = $_POST[id];

    switch ($tipo) {


            case 'ikea_comunicacion': 

                // $para = 'sara.vargas@ikeasi.com';
                $para = 'aperojo@eduka-te.com';
                $cc = '';

                $q = 'SELECT ac.numeroaccion, ga.ngrupo, ac.denominacion, m.fechaini, m.fechafin, e.razonsocial
                FROM acciones ac, matriculas m, ptemp_mat_emp ma, empresas e, grupos_acciones ga
                WHERE m.id = ma.id_matricula
                AND m.id_grupo = ga.id
                AND m.id_accion = ac.id
                AND ma.id_empresa = e.id
                AND solicitud LIKE "IK%"
                AND m.id = '.$id;
                // echo $q;
                $q = mysqli_query($link, $q) or die('error:' . mysqli_error($link));

                while ($row = mysqli_fetch_array($q)) {
                    $empresas .= $row[razonsocial].' <br> '; 
                }

                $titulo = '[IKEA] CURSO '.$numeroaccion.'/'.$grupo.': '.$row[denominacion].' comunicado en la tripartita';
                $mensaje = ' [IKEA] CURSO '.$numeroaccion.'/'.$grupo.': '.$row[denominacion].' comunicado en la tripartita para las siguientes empresas: <br><br>:'.$empresas;

                $cabeceras .= 'Cc: '.$cc. "\r\n";
                $cabeceras .= 'From: Gestion ESFOCC <gestion@eduka-te.com>' . "\r\n";
                break;
	}

?>
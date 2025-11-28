<?

    $baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';

    include_once($baseurl.'/functions/funciones.php');
    require_once($baseurl.'/plugins/PHPMailer/PHPMailerAutoload.php');
    require_once($baseurl.'/plugins/html2pdf/html2pdf.class.php');


// function generaDiplomaBonif($id_mat, $id_emp, $link) {

        // $id_mat = $_GET['id_matricula'];
    // $id_emp = $_GET['id_empresa'];


    $sql = 'SELECT DISTINCT a.numeroaccion, a.denominacion, a.horastotales, a.modalidad, ga.ngrupo, a.contenido,
        m.fechaini, m.fechafin, m.horariomini, m.horariomfin, m.horariotini, m.horariotfin, m.estado
        FROM matriculas m, acciones a, grupos_acciones ga
        WHERE m.id_accion = a.id
        AND m.id_grupo = ga.id
        AND m.id ='.$id_mat;
        // echo $sql;
        $sql = mysqli_query($link, $sql) or die ("error");
        
        while ($row = mysqli_fetch_array($sql)) { 
            $naccion = $row[numeroaccion];
            $ngrupo = $row[ngrupo];
            $denominacion = $row[denominacion];
            $horastotales = $row[horastotales];
            $fechaini = $row[fechaini];
            $fechafin = $row[fechafin];
            $horariomini = $row[horariomini];
            $horariomfin = $row[horariomfin];
            $horariotini = $row[horariotini];
            $horariotfin = $row[horariotfin];
            $modalidad = $row[modalidad];
            $contenido = $row[contenido];
            $estado = $row[estado];
        }
        // echo $naccion;

    $lugar = 'San Cristóbal de La Laguna';

    // if ( $mod == 'o' || ( $sec[1] == 'form_matricula_doc' || $sec[1] == 'form_matricula_doc#') ) $back = 'back_girado';
    // else $back = 'back';

    // DETERMINA QUE TIPO DE DIPLOMA ES
    if ( $naccion == '17' || $naccion == '106' ) $clase = "../img/diplomas/dipfront_bonif_incen1.png";
    else if ( $naccion == '18' ) $clase = "../img/diplomas/dipfront_bonif_incen2.png";
    else if ( $naccion == '1001' || $naccion == '1006' || $naccion == '1017' ) $clase = "../img/diplomas/dipfront_bonif_incen_1001.png";
    else $clase = "../img/diplomas/dipfront_bonif.png";

    if ( $estado == 'Finalizada' || $estado == 'Facturada' ) 
     
        $sql = 'SELECT DISTINCT a.nombre,a.apellido,a.apellido2,a.documento,e.razonsocial,e.cif 
        FROM mat_alu_cta_emp ma, alumnos a, empresas e 
        WHERE ma.id_alumno = a.id 
        AND ma.tipo = "" 
        AND ma.id_matricula = '.$id_mat.' 
        AND ma.id_empresa = e.id 
        AND e.id = '.$id_emp.
        $limit; 
        
    else  {

    //     if ( $mod == 'o' )
    //         $sql = 'SELECT a.nombre,a.apellido,a.apellido2,a.documento,e.razonsocial,e.cif 
    //         FROM temp_alumnos_o a,temp_empresas_o e 
    //         WHERE a.id_empresa = e.id
    //         AND e.id = '.$id_emp.
    //         $limit;
    //     else
            $sql = 'SELECT a.nombre,a.apellido,a.apellido2,a.documento,e.razonsocial,e.cif 
            FROM temp_alumnos a,temp_empresas e 
            WHERE a.id_empresa = e.id
            AND e.id = '.$id_emp.
            $limit;

    }
        
    // echo $sql;    
    $sql = mysqli_query($link, $sql) or die ("error");

         ob_start(); 

    ?>
        

        <style>

        body {
            width: 27.8cm;
            height: 19.6cm;
        }
        .page {
            position: relative;
            width: 21cm;
            height: 29.7cm; 
            padding: 15px 30px;
        } 
        .page-hor {
            position: relative;
            width: 28.5cm;
            height: 19.6cm; 
        }


        .contenidotxt {
            width: 860px;
            height: 560px;
            position: absolute;
            margin: 100px 0px 0px 100px;
            
        }

        .prueba {
            border: 1px solid red;
            line-height: auto;
            width: 20px;
            height: 30px;

        }

        .alumno {
            position: relative;
            text-align: center;
            top: 200px;
            font-size: 32px;
        }

        .nif {
            position: absolute;
            top: 283px;
            margin-left: 155px;
            font-size: 16px;
        }

        .cif {
           position: absolute;
            top: 303px;
            margin-left: 155px;
            font-size: 16px;
        }

        .af {
            position: absolute;
            top: 324px;
            margin-left: 208px;
            font-size: 16px;
        }

        .razonsocial {
            position: absolute;
            top: 282px;
            margin-left: 695px;
            font-size: 16px;    
        }

        .denominacion {
            position: relative;
            padding-left: 70px;
            padding-right: 70px;
            text-align: center;
            top: 140px;
            font-size: 32px;
        }

        .duracion {
            position: absolute;
            top: 498px;
            margin-left: 225px;
            font-size: 16px;
        }

        .fechaini {
            position: absolute;
            top: 521px;
            margin-left: 198px;
            font-size: 16px;
        }

        .fechafin {
            position: absolute;
            top: 542px;
            margin-left: 235px;
            font-size: 16px;
        }

        .modalidad {
            position: absolute;
            top: 561px;
            margin-left: 167px;
            font-size: 16px;
        }

        .lugar {
            position: absolute;
            top: 522px;
            margin-left: 617px;
            font-size: 16px;
        }

        .dia {
            position: absolute;
            top: 522px;
            margin-left: 862px;
            font-size: 16px;
        }

        .mes {
            position: absolute;
            top: 522px;
            margin-left: 907px;
            font-size: 16px;

        }

        </style>

    <?

       

        while ($row = mysqli_fetch_array($sql)) { 
            $emp = $row[razonsocial];
        // $row = mysqli_fetch_array($sql); ?>

        <page format="A4" orientation="L" backimgy="0" backimgx="0" backimgw="1122px" backimg="<? echo $clase ?>">
            
                <div class="alumno"><? echo $row[nombre].' '.$row[apellido].' '.$row[apellido2] ?></div>
                <div class="nif"><? echo $row[documento] ?></div>
                <div class="cif"><? echo $row[cif] ?></div>
                <div class="af"><? echo $naccion.'/'.$ngrupo ?></div>
                <div class="razonsocial"><? echo $row[razonsocial] ?></div>
                <? if ( $naccion != '17' && $naccion != '18' && $naccion != '106' ) { ?>
                <div class="denominacion"><? echo $denominacion ?></div> <? } ?>
                <div class="duracion"><? echo $horastotales.' horas' ?></div>
                <div class="fechaini"><? echo date("d/m/Y",strtotime($fechaini)) ?></div>
                <div class="fechafin"><? echo date("d/m/Y",strtotime($fechafin)) ?></div>
                <div class="modalidad"><? echo $modalidad ?></div>
                <div class="lugar"><? echo $lugar ?></div>
                <div class="dia"><? echo date("d",strtotime($fechafin)) ?></div>
                <div class="mes"><? echo ucwords(strftime("%B",strtotime($fechafin))) ?></div>
            
        </page>

        

    <? } 

            $emp = quitaTildesConComas(str_replace(' ','', $emp));
            $nombreFichero = "Diplomas".$naccion."-".$ngrupo."_".$emp.".pdf"; 
            $content = ob_get_clean();

            // $html2pdf->setModeDebug();
            $html2pdf = new HTML2PDF('P', 'A4', 'es', true, 'UTF-8', array(0, 0, 0, 0));
            $html2pdf->setDefaultFont('Arial');
            $html2pdf->writeHTML($content);
            // $html2pdf->createIndex('indice', 25, 12, false, true, 2);
            // $html2pdf->Output($nombreFichero,'D');
            // $rutadiploma = 'inspeccion/'.$naccion.'-'.$ngrupo.'/';  
            // echo $ruta.$nombreFichero;  
            $html2pdf->Output($ruta.$nombreFichero, 'F');
            // $html2pdf->Output($ruta.$nombreFichero);
    ?>



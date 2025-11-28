<?
    $baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
echo $baseurl;
    include_once($baseurl.'/functions/funciones.php');
    // require_once($baseurl.'/plugins/PHPMailer/PHPMailerAutoload.php');

    if ( file_exists($baseurl.'/plugins/html2pdf/html2pdf.class.php') )
        include_once($baseurl.'/plugins/html2pdf/html2pdf.class.php');
    else 
        echo "nop";

    setlocale(LC_TIME, "es_ES");
    $id_mat = $_GET[id_mat];

    // $sql = 'SELECT DISTINCT a.numeroaccion, a.denominacion, a.horastotales, a.modalidad, ga.ngrupo, 
    //     a.contenido, m.fechaini, m.fechafin, m.horariomini, m.horariomfin, m.horariotini, m.horariotfin, 
    //     CONCAT(d.nombre," ",d.apellido," ",d.apellido2) as docente, d.email as emailtutor, a.url, ma.user, ma.pass, al.documento,
    //     CONCAT(al.nombre," ", al.apellido," ", al.apellido2) as alumno, e.razonsocial, a.objetivos, al.email as emailalumno, d.telefono
    //     FROM matriculas m, acciones a, grupos_acciones ga, mat_doc md, 
    //     docentes d, mat_alu_cta_emp ma, alumnos al, empresas e
    //     WHERE m.id_accion = a.id
    //     AND m.id_grupo = ga.id
    //     AND md.id_matricula = m.id
    //     AND md.id_docente = d.id
    //     AND ma.id_matricula = m.id
    //     AND ma.id_alumno = al.id
    //     AND ma.id_empresa = e.id
    //     AND m.id ='.$id_mat;
    //     echo $sql;
    //     $sql = mysqli_query($link, $sql) or die ("error");
        
    // while ($row = mysqli_fetch_array($sql)) { 
    //     $naccion = $row[numeroaccion];
    //     $ngrupo = $row[ngrupo];
    //     $denominacion = $row[denominacion];
    //     $horastotales = $row[horastotales];
    //     $fechaini = date("d/m/Y",strtotime($row[fechaini]));
    //     $fechafin = date("d/m/Y",strtotime($row[fechafin]));
    //     $horariomini = $row[horariomini];
    //     $horariomfin = $row[horariomfin];
    //     $horariotini = $row[horariotini];
    //     $horariotfin = $row[horariotfin];
    //     $modalidad = $row[modalidad];
    //     $contenido = $row[contenido];
    //     $docente = $row[docente];
    //     $alumno = $row[alumno];
    //     $razonsocial = $row[razonsocial];
    //     $url = $row[url];
    //     $emailtutor = $row[emailtutor];
    //     $user = $row[user];
    //     $pass = $row[pass];
    //     $objetivos = $row[objetivos];
    //     $emailalumno = $row[emailalumno];
    //     $tlftutor = $row[telefono];
    //     $documento = $row[documento];
    // }



    // if ( $horariomini !== "" )
    //     $horario = $horariomini.' - '.$horariomfin;
    // if ( $horariomini !== "" && $horariotini !== "" )
    //     $horario .= ' | ';
    // if ( $horariotini != "" )
    //     $horario .= $horariotini.' - '.$horariotfin;

    // echo $horario;
    $nombreFichero = "x.pdf"; 

    ob_start();

?>


<style type="text/Css">

* {
    margin:0;
    padding:0;
    /*font-family: 'Conv_estre',Sans-Serif;*/
}

.page-hor {
    position: relative;
    height: 28.5cm;
    width: 19.6cm; 
}


.encabezado {
    margin: auto;
}

.tituloguia {
    color: #C80000;
    margin-top: 200px;
    text-align: center;
} 

.indice {
    color: #C80000;
    border-bottom: 1px solid #ccc;
}

.cuadroindice {
    width: 490px;
    margin: 120px 115px;
}

ol { list-style-type: decimal }
ol.listaindice li {
    font-weight: bold;
    padding: 10px 10px 10px 0px;
    font-size: 16px;
}

ol.listaindice li ol li {
    padding-bottom: 0px;
    font-weight: normal;
}

ol.listaindice li ol li:first {
    padding-top: 5px;
}

.listadatos { width: 100%; border-collapse: collapse; }
.listadatos td {
    border-bottom: 1px solid #ccc;
    width: 50%;
    padding: 5px;
    font-size: 14px;
}
.listadatos td:nth-child(odd) {
    font-weight: bold;
}


.datosportada {
    margin-top: 20px;
    text-align: center;
}

.tituloseccion {
    page-break-before: always;
    color: #C80000;
    margin: 15px 0 10px 0;
}

p { 
    font-size: 15px; 
    line-height: 1.3;
    margin-bottom: 10px;
}

.listatexto {
    list-style-type: disc;    
}

.listatexto li {
    padding: 3px;
    font-size: 15px;
}

.circulo {
    right: 5px;
    text-align: center;
    margin: 0 10px 10px 0;
    position: relative;
    display: inline-block;
    width: 30px;
    height: 30px;
    /*padding: 5px;*/
    border-radius: 15px;
    border: 1px solid #C80000;
}

.pie {
    color: black; 
    font-weight: bold; 
    margin-top: 7px;
}


</style>



    <!--  -->
    <!--  -->
    <!-- RLT -->
    <!--  -->
    <!--  -->
    
    <page backleft="40px" backright="40px" backtop="140px" backbottom="60px">
        <page_header height="100px">        
            <div style="margin: 30px 0 0 30px">
                <!-- <img style="width: 200px" src="img/esfocclogo.png" alt=""> --></div>
        </page_header>

        <div style="">
            <div style="margin-top: 20px;"><h2 style="text-align:center;">REPRESENTACIÓN LEGAL DE LOS TRABAJADORES</h2></div>
        </div>
        
        <div style="width:100%">
            D. <hr><br>
            <p>como Representante Legal de los Trabajadores de la Empresa <? echo $empresa ?> manifiesta haber recibido la propuesta de la acción formativa <? echo $naccion.'.'.$ngrupo ?> del curso <? echo $denominacion ?> , que se celebrará del <? echo $fechaini ?> hasta el <? echo $fechafin ?>, ante el cual da su:</p>
        </div>
        
        <div style="margin: 60px 0 60px 0">
            <input type="checkbox"> Conformidad
            <input type="checkbox"> Disconformidad
        </div>        

        <p>Y para que conste a efectos oportunos lo firmo en</p><br>
        <span style="width: 30%; border-bottom: 1px solid black"></span> a <span style="width: 15%; border-bottom: 1px solid black"></span> de <span style="width: 40%; border-bottom: 1px solid black"></span> de <? echo date("Y"); ?>
        
        <div style="margin-top: 90px">
            <span style="float: left;">Por la R.L.T</span>
            <span style="float: right;">Por la empresa</span>
        </div>

    </page>
    

<?

    $content = ob_get_clean();    
    $html2pdf = new HTML2PDF('P', 'A4', 'es', true, 'UTF-8', array(0, 0, 0, 0));
    // $html2pdf->setModeDebug();
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content);
    // $html2pdf->createIndex('indice', 25, 12, false, true, 2);
    $html2pdf->Output($nombreFichero);

?>
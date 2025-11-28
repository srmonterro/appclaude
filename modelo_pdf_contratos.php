<?php
header('Content-Type: text/html; charset=ISO-8859-1');
$baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
$baseurlc = $_SERVER['DOCUMENT_ROOT'].'/gestion/contratos';
include_once($baseurlc.'/functions/funciones.php');
require_once($baseurl.'/plugins/html2pdf/html2pdf.class.php');

// $link = contratosConexion();

// function contratosConexion(){
    
//     $link=mysqli_connect("46.16.62.150","myesfocc","qMtJ7OoD","contratos-esfocc") or die ("Error de CONEXION");
//     return $link;
// }

ob_start(); ?>

<style>

    * {
        margin:0;
        padding:0;
        /*background-color: white !important;*/
        /*background-image: none !important;*/
        /*font-family: sans-serif;*/
    }

    .page {
        position: relative;
        overflow: auto;
        display: block;
        width: 21cm;
        height: 31.5cm; 
        padding: 20px;
        /*background-image: url(../Fondo_Doc_2014.jpg);*/
        /*background-size: 24cm 32.5cm;*/
        /*background-position: 20px 0 0 0;*/

    }

    .subpage {

        /*padding: 60px 30px;*/
        width: 19cm;
        height: 28cm;
        margin: auto;
        padding-top: 30px;
        /*border: 1px solid black;*/

    }
    .cabecera {
        overflow:  auto;
        margin-top: 20px;

    }
    @page {
        size: A4;
        margin: 0;
    }

    p {
        line-height: 1.8;
    }

    table { 
        width: 100%;
        border-collapse: collapse; 
    }
    
    table td {
        padding: 5px;
        border: 1px solid #ccc;
        width: 199px;
    }

    th{
        padding: 5px;
        background-color: #C80000; 
        text-align: center;
        color:white;
    }
    
    span{
        font-size: 15px ;
        margin-left:120px;
        font-weight: bold;
    }
    
    #check{
        width: 20px;
        height: 20px;
    }
    
</style>




<?php

setlocale(LC_TIME, "es_ES");

$id_contrato = 3;


$sql = 'select c.id,c.faseProrroga,a.documento,a.nombre,a.apellido,a.apellido2,c.fechaDesde,c.fechaHasta,o.ocupacion,a.provincia,c.idContrato,c.principal1anio,c.principal2anio

from alumnos as a

inner join contratos as c
on c.id_alumno=a.id

inner join empresas as e
on e.id=c.id_empresa

inner join ocupaciones as o
on o.codigo=a.ocupacion

inner join certificados as ce
on ce.id_ocupacion=o.id

WHERE c.id = "'.$id_contrato.'"';

$sql = mysqli_query($link, $sql) or die('error');
$i=0;
$cont=1;

while ( $r = mysqli_fetch_array($sql) ) {
    
    
    $alumno = utf8_encode($r['nombre']).' '.utf8_encode($r['apellido']).' '.utf8_encode($r['apellido2']);
    $nif = $r['documento'];
    $provincia = $r['provincia'];
    $h_modulo = $r['horas_modulo'];
    $provincia = $r['provincia'];
    $h_modulo = $r['horas_modulo'];
    $fechaini = formateaFecha($r['fechaDesde']);
    $fechafin = formateaFecha($r['fechaHasta']);
    $ocupacion = utf8_encode($r['ocupacion']);
    $descripcion = utf8_encode($r['descripcion']);
    $id_contrado = $r['idContrato'];
    $suma_horas=($r['principal1anio'])+($r['principal2anio']);
    
    echo '<page backimg="./documentacion/fondo_doc.jpg" backimgx="center" backimgy="bottom" backimgw="100%" backleft="60px" backright="60px" backtop="50px" backbottom="60px">';
?>    
    <div class="cabecera">
                    
                    <div style="margin: 30px 0 15px 0; background-color: #c80000; padding: 10px; color: #fff; text-align: center;">
                    <strong>CERTIFICADO DE IMPARTICIÓN DE FORMACIÓN</strong>
                    </div>

                    <p style="margin-top: 20px;">Don <strong>Daniel Álvarez Benítez</strong> como responsable del centro <strong>ESCUELA SUPERIOR DE FORMACIÓN Y CUALIFICACIÓN , SLU (ESFOCC)</strong> con código de identificación fiscal <strong>B76567718</strong>.</p>
                    
                    <div class="cabecera">


                        <p style="margin-top: 10px;"><strong>CERTIFICA</strong> que se ha impartido la <strong>FORMACIÓN</strong> con nº de contrato <strong><? echo $id_contrado ?></strong> en la provincia de <strong><? echo $provincia ?></strong> del/la trabajador/a <strong><? echo $alumno ?></strong> con documento nacional de identidad <strong><? echo $nif ?></strong> con duración de <strong><? echo $suma_horas ?></strong> horas, en el período comprendido entre el <strong><? echo $fechaini ?></strong> hasta el <strong><? echo $fechafin ?></strong> en la ocupación de <strong><? echo $ocupacion ?></strong> y en la modalidad de formación <strong>A DISTANCIA</strong> con el <strong>contenido formativo expuesto</strong> en el dorso y con el siguiente <strong>grado de aprovechamiento:</strong></p>
                        <br/><br/><br/>
                    </div>
                           <span><img id="check" src="./documentacion/checkbox.png"/>ALTO</span> 
                            
                           <span>NORMAL</span>
                            
                           <span>BAJO</span>
                </div>
<?
echo "</page>";    
} 


    $content = ob_get_clean();
        // $html2pdf->setModeDebug();
        $html2pdf = new HTML2PDF('P', 'A4', 'es', true, 'UTF-8', array(0, 0, 0, 0));
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($content);
        // $html2pdf->createIndex('indice', 25, 12, false, true, 2);
        // $html2pdf->Output($nombreFichero,'D');
        $html2pdf->Output($nombreFichero);
?>  




        


<?php
$baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
include_once($baseurl.'/functions/funciones.php');
require_once($baseurl.'/plugins/html2pdf/html2pdf.class.php');

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

    #numero_alumno{
        width: 30px; 
        text-align: center;
    }
    
    #nombre_alumno{
        width: 330px; 
        text-align: center;
    }
    
    #dni_alumno{
        width: 235px;  
        text-align: center;
    }
</style>




<?php

setlocale(LC_TIME, "es_ES");

$id_mat = 467;
// $id_emp = $_GET['id_empresa'];

$sql = 'SELECT a.nombre,a.apellido,a.apellido2,a.documento,e.razonsocial,e.cif,ac.horastotales,ac.modalidad,ac.denominacion,m.fechaini,m.fechafin,ac.objetivos,ac.contenido,ac.numeroaccion,ga.ngrupo,e.razonsocial
FROM mat_alu_cta_emp ma, alumnos a, empresas e, matriculas m, acciones ac, grupos_acciones as ga

WHERE ma.id_alumno = a.id
AND ac.id = m.id_accion
AND m.id = ma.id_matricula
AND ma.id_empresa = e.id
AND ga.id=m.id_grupo
AND ac.id=ga.id_accion
AND ma.id_matricula = '.$id_mat.' AND ma.finalizado=1 ';
// echo $sql;
$sql = mysqli_query($link, $sql) or die('error');
$i=0;
$cont=1;
echo '<page backimg="./documentacion/fondo_doc.jpg" backimgx="center" backimgy="bottom" backimgw="100%" backleft="60px" backright="60px" backtop="50px" backbottom="60px">';

while ( $r = mysqli_fetch_array($sql) ) {
    
    $alumno = $r['nombre'].' '.$r['apellido'].' '.$r['apellido2'];
    $nif = $r['documento'];
    $fechaini = formateaFecha($r['fechaini']);
    $fechafin = formateaFecha($r['fechafin']);
    $num_accion = $r['numeroaccion'];
    $n_grupo = $r['ngrupo'];
    $denominacion = $r['denominacion'];
    $empresa = $r['razonsocial'];
    ?>
        
            <?php 
                if($i==0){
            ?>
            
                <div class="cabecera">
                    
                    <div style="margin: 30px 0 15px 0; background-color: #c80000; padding: 10px; color: #fff; text-align: center;">
                    <strong>CERTIFICADO DE IMPARTICIÓN DE FORMACIÓN</strong>
                    </div>

                    <p style="margin-top: 20px;">Don <strong>Daniel Álvarez Benítez</strong> como responsable del centro <strong>ESCUELA SUPERIOR DE FORMACIÓN Y CUALIFICACIÓN , SLU (ESFOCC)</strong> con código de identificación fiscal <strong>B76567718</strong>.</p>
                    
                    <div class="cabecera">


                        <p style="margin-top: 10px;"><strong>CERTIFICA</strong> que se ha impartido la <strong>FORMACIÓN</strong> de la acción <strong><? echo $num_accion ?>/<? echo $n_grupo ?></strong> en la formación de <strong><? echo $denominacion ?></strong> en la empresa <strong><? echo $empresa ?></strong>, en el periódo comprendido entre el <strong><? echo $fechaini ?></strong> hasta el <strong><? echo $fechafin ?></strong> de los siguientes alumnos:</p>
                        <br/>
                    </div>
                </div>
            
            <?php 
                 echo '<table>
                        <thead>
                            <tr id="cabecera">
                                <th>
                                    Nº
                                </th>
                                <th>
                                    Nombre
                                </th>
                                <th>
                                    DNI
                                </th>
                            </tr>
                        </thead>
                        
                        '; 
                  $i++;
                    
                }
            ?>
                    
                    
                            <tr>
                                <td id="numero_alumno">
                                    <?php echo $cont; $cont++ ?>
                                </td>
                                <td id="nombre_alumno">
                                    <?php echo $alumno ?>
                                </td>
                                <td id="dni_alumno">
                                    <?php echo  $nif?>
                                </td>
                            </tr>
                        

                
            
        

<? 
    
} 
echo "</table>";
echo "</page>";
    $content = ob_get_clean();
        // $html2pdf->setModeDebug();
        $html2pdf = new HTML2PDF('P', 'A4', 'es', true, 'UTF-8', array(0, 0, 0, 0));
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($content);
        // $html2pdf->createIndex('indice', 25, 12, false, true, 2);
        // $html2pdf->Output($nombreFichero,'D');
        $html2pdf->Output($nombreFichero);

        




        



<?php
header('Content-Type: text/html; charset=ISO-8859-1');
$baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
include_once($baseurl.'/functions/funciones.php');
require_once($baseurl.'/plugins/html2pdf/html2pdf.class.php');

ob_start(); ?>

<style>

    #cabecera{
        width: 100%;
        height: 60%;
        font-family: Arial;
        margin-top:30px;
    }
    
    #titulo{
       margin-left: 1000px;
    }
    
    #divison{
        padding-left: 20px;
        padding-right: 20px;
        padding-top: -10px;
    }
    
    #interno{
        float:left;
        border: 0px;
        width: 320px;
        margin-left: 20px;
        margin-top:-10px;
    }
    
    #tabla{
        width: 250px;
        margin-left: 350px;
        margin-top: -185px;
    }
    
    #tabla2{
        width: 250px;
        margin-left: 350px;
        margin-top: 20px;
    }
    
    th{
        padding: 5px;
        background-color: #C80000; 
        text-align: center;
        color:white;
        padding-left: 90px;
        padding-right: 90px;
    }
    
    .td{
        padding: 3px;
    }
    
    #colspan{
        padding-right: 40px;
    }
    
    .titulo_tabla2{
        padding-left: 46px;
        padding-right: 46px;
    }
    
    .td_centrado{
        text-align: center;
    }
    
    .td_centrado{
        text-align: center;
    }
    
    #tabla_firma{
        border: 0px;
        margin-left: 20px;
        margin-top: 45px;
    }
    
    .titulo_tabla3{
        padding-left: 283px;
        padding-right: 283px;
    }
    
    .palabra_interno{
        margin-bottom: 30px;
        
    }
    
    #parte_control{
        font-weight: bold;
        font-style: italic;
        font-size: 17px;
        margin-left: 425px;
        padding-right: -4px;
        padding-top: -19px;
        margin-bottom: -30px;
        width: 240px;
    }
    
    #nombre{
        width: 350px;
        margin-top:20px;
        padding-left:19px;
        margin-bottom:-10px;
    }
    
    #pie{
        margin-top:320px;
        margin-left:470px;
        color:grey;
    }

</style>

<?php

setlocale(LC_TIME, "es_ES");

$id_vacaciones = $_GET['id_vacaciones'];

$sql = 'select dias_vacaciones.dia_salida, 
        dias_vacaciones.dia_entrada, 
        dias_vacaciones.dias, 
        dias_vacaciones.pendiente,
        dias_vacaciones.id,
        dias_vacaciones.no_computable,
        nominas_usuarios.nombre,
        nominas_usuarios.vacaciones_pendientes as pendientes,
        dias_vacaciones.id_usuario,
        nominas_usuarios.vacaciones_pendientes
        FROM nominas_usuarios INNER JOIN dias_vacaciones 
            ON nominas_usuarios.id = dias_vacaciones.id_usuario
        WHERE dias_vacaciones.id='.$id_vacaciones ;
   
$sql = mysqli_query($link, $sql) or die('error');

$vacaciones = mysqli_fetch_array($sql);

$parteNumero = $vacaciones['id'];
$nombre = $vacaciones['nombre'];
$dia_salida = formateaFecha($vacaciones['dia_salida']);
$dia_entrada = formateaFecha($vacaciones['dia_entrada']);
$dias = $vacaciones['dias'];
$pendiente = $vacaciones['pendiente']; 
$total_pendiente = $vacaciones['vacaciones_pendientes'];

$sqlDisfrutados = 'select sum(dias) as diasDisfrutados from dias_vacaciones where id_usuario = ' .$vacaciones['id_usuario']. ' and no_computable = 1';

$sqlDisfrutados = mysqli_query($link, $sqlDisfrutados) or die('error');

$sqlDisfrutados = mysqli_fetch_array($sqlDisfrutados);

$dias_disfrutados = $sqlDisfrutados['diasDisfrutados'];

$no_computable = $vacaciones['no_computable']; 

$dias_naturales = $dias_disfrutados + $total_pendiente;

if ( $pendiente > 0 ) 
    $disfrutados = $dias_disfrutados;
else
    $disfrutados = $dias;

$fecha = date('d')."/".date('m')."/".date('Y');
$anio = $_SESSION['anio'];
$fecha_salida = formateaFechaDirectorio($vacaciones['dia_salida']);

echo '<page backimg="./fondo_doc.jpg" backimgx="center" backimgy="bottom" backimgw="100%" backleft="60px" backright="60px" backtop="50px" backbottom="60px">';
?>    
    <div id="cabecera">
        
        <div id="nombre"> <?php echo $nombre; ?> </div>
        <div id="parte_control">Parte control de vacaciones</div>    

            <div id="divison"><hr /></div>
            <br/><br/>
        <div id="interno">
            <!--<div class="palabra_interno">Parte nº: <?//php echo $parteNumero; ?></div> -->
            
            <div class="palabra_interno" >Modalidad:    <?php echo $dias_naturales; ?> días naturales</div>
            <div hspace="10" class="palabra_interno" >Fecha parte: <?php echo $fecha; ?></div>  
            <div class="palabra_interno" >Vacaciones año: <?php echo $anio; ?></div>
            <div class="palabra_interno"> </div> 
   
        </div>
        <div id="tabla">
                <table border=1 cellspacing=0 >
                <thead>
                    <tr>
                        <th colspan="2">Período a Disfrutar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="td">
                            Del día:
                        </td>
                        <td class="td td_centrado">
                            <?php echo $dia_salida; ?>
                        </td>

                    </tr>
                    <tr>
                        <td class="td">
                          Al día:  
                        </td>
                        <td class="td td_centrado">
                          <?php echo $dia_entrada; ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="td">
                          Total Días:  
                        </td>
                        <td class="td td_centrado">
                            <?php 
                            echo $dias; 
                            if($no_computable=="2"){
                                echo " (NC)";
                            }
                            ?>

                        </td>
                    </tr>
                </tbody>
            </table>
            </div>
            <div id="tabla2">
                <table border=1 cellspacing=0 >
                <thead>
                    <tr>
                        <th class="titulo_tabla2">Tras regreso:</th>
                        <th class="titulo_tabla2">Dias</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="td">
                            Total Disfrutados:
                        </td>
                        
                        <td class="td td_centrado">
                            <?php echo $disfrutados ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="td">
                            Total pendientes:
                        </td>
                        <td class="td td_centrado">
                            <?php echo $total_pendiente; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
            </div>
            
            <div id="tabla_firma">
                <table border=1 cellspacing=0 >
                <thead>
                    <tr>
                        <th colspan="2" class="titulo_tabla3">Conforme</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="">
                            El trabajador:<br/><br/><br/><br/><br/><br/><br/>
                        </td>
                        <td class="">
                            La empresa:
                        </td>
                    </tr>
                </tbody>
            </table>
            </div>
    </div>
    <div id="pie">COPIA PARA LA EMPRESA</div>

<?
echo "</page>";
echo '<page backimg="./fondo_doc.jpg" backimgx="center" backimgy="bottom" backimgw="100%" backleft="60px" backright="60px" backtop="50px" backbottom="60px">';

?>
   <div id="cabecera">
        
        <div id="nombre"><?php echo $nombre; ?></div>
        <div id="parte_control">Parte control de vacaciones</div>    

            <div id="divison"><hr /></div>
            <br/><br/>
        <div id="interno">
            <!--<div class="palabra_interno">Parte nº: <?//php echo $parteNumero; ?></div> -->
            <div class="palabra_interno" >Modalidad:    <?php echo $dias_naturales; ?> días naturales</div>
            <div hspace="10" class="palabra_interno" >Fecha parte: <?php echo $fecha; ?></div>  
            <div class="palabra_interno" >Vacaciones año: <?php echo $anio; ?></div>
            <div class="palabra_interno"> </div> 
            
        </div>
        <div id="tabla">
                <table border=1 cellspacing=0 >
                <thead>
                    <tr>
                        <th colspan="2">Período a Disfrutar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="td">
                            Del día:
                        </td>
                        <td class="td td_centrado">
                            <?php echo $dia_salida; ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="td">
                          Al día:  
                        </td>
                        <td class="td td_centrado">
                          <?php echo $dia_entrada; ?>  
                        </td>
                    </tr>
                    <tr>
                        <td class="td">
                          Total Días:  
                        </td>
                        <td class="td td_centrado">
                            <?php 
                            echo $dias; 
                            if($no_computable=="2"){
                                echo " (NC)";
                            }
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>
            </div>
            <div id="tabla2">
                <table border=1 cellspacing=0 >
                <thead>
                    <tr>
                        <th class="titulo_tabla2">Tras regreso:</th>
                        <th class="titulo_tabla2">Dias</th>
                    </tr>

                </thead>
                <tbody>
                    <tr>
                        <td class="td">
                            Total Disfrutados:
                        </td >                            
                        <td class="td td_centrado">
                            <?php echo $disfrutados; ?>
                        </td>

                    </tr>
                    <tr>
                        <td class="td">
                            Total pendientes:
                        </td>
                        <td class="td td_centrado">
                            <?php echo $total_pendiente; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
            </div>
            <div id="tabla_firma">
                <table border=1 cellspacing=0 >
                <thead>
                    <tr>
                        <th colspan="2" class="titulo_tabla3">Conforme</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="">
                            El trabajador:<br/><br/><br/><br/><br/><br/><br/>
                        </td>
                        <td class="">
                            La empresa:
                        </td>
                    </tr>
                    
                </tbody>
            </table>
            </div>
    </div>
    <div id="pie">COPIA PARA EL TRABAJADOR</div>

<?
    $nombreFichero = $fecha_salida .'_ParteVacaciones' . '.pdf';

    echo "</page>";
    $content = ob_get_clean();
    // $html2pdf->setModeDebug();
    $html2pdf = new HTML2PDF('P', 'A4', 'es', true, 'UTF-8', array(0, 0, 0, 0));
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content);
    // $html2pdf->createIndex('indice', 25, 12, false, true, 2);
    // $html2pdf->Output($nombreFichero,'D');
    $html2pdf->Output($nombreFichero);
?>
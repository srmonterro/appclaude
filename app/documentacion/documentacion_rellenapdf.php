<?

$baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
setlocale(LC_TIME, 'es_ES');

    include_once($baseurl.'/functions/funciones.php');
    require_once($baseurl.'/plugins/PHPMailer/PHPMailerAutoload.php');
    require_once($baseurl.'/plugins/html2pdf/html2pdf.class.php');


ob_start();

?>


<style>

* {
    margin:0;
    padding:0;
    background-color: white !important;
    background-image: none !important;
}

.page {
    width: 21cm;
    height: 31.10cm; 
    padding: 15px 30px;
    page-break-after: always
}


@page {
    size: A4;
    margin: 0;
}

th, td { padding: 5px; }
table { font-size: 12px; border-collapse: collapse; }
td {border: 1px solid #FF0000; height: 25px;}
th {border: 3px solid #FF0000}

table.sinborde td { border: 0px; }

table.bordegris td { border: 1px solid #ccc; padding-top: 5px; }
table.bordegris th { border: 1px solid #ccc}
table.bordegris { border: 3px solid #ccc; color: #1B0085; font-weight: bold;}

table.ikearlt td {border: 1px solid #000; height: 25px;}
table.ikearlt th {border: 3px solid #000}

.controlasist {
    color: #1B0085;
}

p { margin-top: 3px; line-height: 130% }
ol li { margin-top: 5px;}
ul li { margin-top: 5px;}


</style>


<?

  

$id_mat = $_GET['id_matricula'];

$sql = 'SELECT DISTINCT a.numeroaccion, a.denominacion, a.horastotales, a.modalidad, ga.ngrupo, a.objetivos, c.localidad as localidad,
    m.fechaini, m.fechafin, m.horariomini, m.horariomfin, m.horariotini, m.horariotfin, m.diascheck, m.estado, d.*, m.solicitud, c.*
    FROM matriculas m, acciones a, grupos_acciones ga, docentes d, mat_doc md, centros c
    WHERE m.id_accion = a.id
    AND c.id = m.centro
    AND md.id_matricula = m.id
    AND d.id = md.id_docente
    AND m.id_grupo = ga.id
    AND m.id ='.$id_mat;
    // echo $sql;
    $sql = mysqli_query($link, $sql) or die ("error: ". mysqli_error($link));
    
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
      $diascheck = $row[diascheck];
      $estado = $row[estado];
      $solicitud = $row[solicitud];
      $objetivos = $row[objetivos];
      $localidad = $row[localidad];
      // echo $solicitud;
      $docente = $row[nombre]. ' ' . $row[apellido]. ' ' . $row[apellido2];

      if ( $horariomini !== "" )
          $horario = $horariomini.' - '.$horariomfin;
      if ( $horariomini !== "" && $horariotini !== "" )
          $horario .= ' | ';
      if ( $horariotini != "" )
          $horario .= $horariotini.' - '.$horariotfin;

      $centro = $row[nombrecentro];
    }

?>
<!--  -->
<!--  PRIMERA PAGINA: FICHA DEL PARTICIPANTE -->
<!--  -->

<?
// echo $estado;
if ( $estado == 'Finalizada' || $estado == 'Facturada' )
  $sql = 'SELECT DISTINCT a.*, e.*, ma.numerocuenta as cuentacotizacion
  FROM mat_alu_cta_emp ma, alumnos a, empresas e 
  WHERE ma.id_alumno = a.id 
  AND ma.tipo = "" 
  AND ma.id_matricula = '.$id_mat.' 
  AND ma.id_empresa = e.id';
else
  $sql = 'SELECT * FROM temp_alumnos a, temp_empresas e 
  WHERE a.id_empresa = e.id';

$sql = mysqli_query($link, $sql) or die ("error");

while ($row = mysqli_fetch_array($sql)) {
    
    ?>
<div style="" class="ficha page page-break">

    <div style="overflow: auto; margin-top: 40px" id="cabecera">
        <div style="float:left;margin-right: 10px;"><!-- <img height="80px;" src="../img/esfocclogo.png" /> --></div>
        <div style="margin-top: 40px; margin-left: 25px; float:left"><h2 style="text-align:center;">FICHA DEL PARTICIPANTE</h2></div>
        <div style="float:right; "><!-- <img width="170px" src="../img/LogoTripartita.png" /> --></div>
    </div>
    
    <div class="clearfix"></div>
    
    <h3 style="margin-bottom: 5px; text-align:center;">DATOS DEL CURSO</h3>
    <table style="width:100%;">
        
        <tr>
            <td colspan="3">DENOMINACIÓN DE LA ACCIÓN FORMATIVA: <? echo ($denominacion) ?></td>                      
        </tr>
        <tr>
            <td colspan="2">NÚMERO DE LA ACCIÓN FORMATIVA: <? echo ($naccion) ?></td><td>NÚMERO DEL GRUPO: <? echo ($ngrupo) ?></td>
        </tr>
        <tr>
            <td>FECHA INICIO: <? echo(date("d/m/Y", strtotime($fechaini))); ?></td><td>FECHA FIN: <? echo(date("d/m/Y", strtotime($fechafin))); ?></td><td>MODALIDAD: <? echo($modalidad) ?></td>
        </tr>
        
    </table>
    
    
    <h3 style="margin-top: 25px; margin-bottom: 5px; text-align:center;">DATOS DEL PARTICIPANTE</h3>
    <table  style="width:100%; margin-top: 5px;" >
        
       <tr>
           <td>APELLIDOS: <? echo $row[apellido].' '.$row[apellido2] ?></td><td>NOMBRE: <? echo $row[nombre] ?></td>
       </tr>
       <tr>
           <td>NIF/NIE: <? echo $row[documento] ?></td><td>Nº AFILIACION S.S.: <? echo $row[niss] ?></td>
       </tr>
       <tr>
           <td colspan="2">CUENTA DE COTIZACION DE LA EMPRESA: <? echo $row[cuentacotizacion] ?></td>
       </tr>
       <tr>
           <td>FECHA DE NACIMIENTO: <? echo(date("d/m/Y", strtotime($row[fechanac]))) ?></td><td>SEXO: <input type="checkbox" <? if ($row[sexo] == "M") echo " checked"  ?>> M <input <? if ($row[sexo] == "F") echo " checked"  ?> type="checkbox"> F</td>
       </tr>
       <tr>
           <td>DISCAPACITADO: <input <? if ($row[discapacidad] === 1) echo " checked"  ?> type="checkbox"> SI <input <? if ($row[discapacidad] != 1) echo " checked"  ?> type="checkbox"> NO </td>
           <td>VICTIMA/AFECTADO VIOLENCIA GÉNERO: <input <? if ($row[afectadosviolenciagenero] === 1) echo " checked"  ?> type="checkbox"> SI <input <? if ($row[afectadosviolenciagenero] != 1) echo " checked"  ?> type="checkbox"> NO</td>
       </tr>
       <tr>
           <td>VICTIMA/AFECTADO TERRORISMO: <input <? if ($row[afectadosterrorismo] === 1) echo " checked"  ?> type="checkbox"> SI <input <? if ($row[afectadosterrorismo] != 1) echo " checked"  ?> type="checkbox"> NO</td><td>GRUPO DE COTIZACIÓN: <? echo $row[grupocotizacion] ?></td>
       </tr>
       <tr>
           <td>ESTUDIOS</td><td>
               <input <? if ($row[nivelestudios] == 1) echo " checked"  ?> type="checkbox"> SIN ESTUDIOS<BR>
               <input <? if ($row[nivelestudios] == 2) echo " checked"  ?> type="checkbox"> ESTUDIOS PRIMARIOS, EGB O EQUIVALENTE<BR>
               <input <? if ($row[nivelestudios] == 3) echo " checked"  ?> type="checkbox"> FP I,FP II, BACHILLERATO SUPERIOR, BUP O EQUIVALENTE<BR>
               <input <? if ($row[nivelestudios] == 4) echo " checked"  ?> type="checkbox"> ARQUITECTO TÉCNICO, INGENIERO TÉCNICO, DIPLOMADO<BR>
               <input <? if ($row[nivelestudios] == 5) echo " checked"  ?> type="checkbox"> ARQUITECTO E INGENIERO SUPERIOR O LICENCIADO<BR>
           </td>
       </tr>
       <tr>
           <td>CATEGORÍA</td><td>
                <input <? if ($row[categoriaprofesional] == 1) echo " checked"  ?> type="checkbox"> DIRECTIVO<BR>
                <input <? if ($row[categoriaprofesional] == 2) echo " checked"  ?> type="checkbox"> MANDO INTERMEDIO<BR>
                <input <? if ($row[categoriaprofesional] == 3) echo " checked"  ?> type="checkbox"> TÉCNICO<BR>
                <input <? if ($row[categoriaprofesional] == 4) echo " checked"  ?> type="checkbox"> TRABAJADOR CUALIFICADO<BR>
                <input <? if ($row[categoriaprofesional] == 5) echo " checked"  ?> type="checkbox"> TRABAJADOR CON BAJA CUALIFICACIÓN<BR>
           </td>
       </tr>
        
    </table>
    
    
    <h3 style="margin-top: 25px; margin-bottom: 5px; text-align:center;">DATOS DE LA EMPRESA</h3>
    <table style="width:100%;" >
        
        <tr>
            <td>RAZÓN SOCIAL: <? echo($row[razonsocial]) ?></td><td>CIF: <? echo($row[cif]) ?></td>                      
        </tr>
        <tr>
            <td colspan="2">DIRECCIÓN: </td>
        </tr>
        <tr>
            <td>CP: </td><td>POBLACIÓN: </td>
        </tr>
        <tr>
            <td colspan="2">PROVINCIA: </td>
        </tr>
        
    </table>
    
    
    <table style="margin-top: 25px; width:50%;" >
        
        <tr>
            <td>FECHA: <? echo(date("d/m/Y", strtotime($fechaini))) ?></td>                      
        </tr>
        <tr>
            <td>FIRMA DEL TRABAJADOR: <div style="height:70px;"></div></td>
            
        </tr>     
                   
    </table>
    
    <div style="margin-top: 25px;" id="notapie">
        <p style="font-size: 9px">
        El interesado presta expresamente su consentimiento a que los datos personales que proporciona en el presente formulario sean incluidos en un fichero del que es titular Escuela Superior de Formación y Cualificación, S.L. con la finalidad de la inscripción y participación del interesado en el curso elegido entre los organizados por esta entidad, así como para la correcta gestión, ejecución y justificación del mismo conforme a la normativa vigente, y para hacer llegar las comunicaciones relativas al curso respectivo. Dicha información será compartida únicamente con las entidades públicas y privadas que se encuentren relacionadas directamente con el cumplimiento de la mencionada finalidad. La negativa a facilitar los datos personales solicitados, o prestar el consentimiento antes indicado, impedirá que el interesado pueda inscribirse y participar en cualquiera de los cursos. Conforme a lo previsto en la Ley Orgánica 15/1999, de 13 de Diciembre, de Protección de Datos de Carácter Personal, el interesado puede ejercitar, respecto de los mismos, los derechos de acceso, rectificación, cancelación y oposición dirigiéndose por escrito, adjuntando fotocopia del D.N.I., a la dirección del responsable del fichero, Escuela Superior de Formación y Cualificación, S.L. en San Cristóbal de La Laguna (38204) C/ El Sol, 10., o por cualquier otro medio que permita acreditar la identidad del usuario que ejercite cualquiera de los anteriores derechos. En todo caso, los datos de carácter personal serán cancelados cuando hayan dejado de ser necesarios para la finalidad para la cual fueron recabados.      
        </p>     
    </div>
    <div style="border-top:1px solid black; margin-top: 5px;" id="notapie2">
        <p style="margin-top:2px; font-size: 8px"><sub style="vertical-align:super">1</sub> DEL 1 AL 11 SEGÚN NÓMINA</p>
    </div>
    

</div>

<? }

        $content = ob_get_clean();
        
        $html2pdf = new HTML2PDF('P', 'A4', 'es', true, 'UTF-8', array(0, 0, 0, 0));
        // $html2pdf->setModeDebug();
        // $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($content);
        // $html2pdf->createIndex('indice', 25, 12, false, true, 2);
        $html2pdf->Output($nombreFichero);
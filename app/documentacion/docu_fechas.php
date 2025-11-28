<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
</head>  


<style>

* {
    margin:0;
    padding:0;
    background-color: white !important;
    background-image: none !important;
    font-family: sans-serif;
}

.page {
    position: relative;
    width: 21cm;
    height: 31.14cm; 
    padding: 15px 30px;
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

.controlasist {
    color: #1B0085;
}

</style>


<?

include_once '../functions/funciones.php';

setlocale(LC_TIME, 'es_ES');

$id_mat = $_GET['id_matricula'];

$sql = 'SELECT DISTINCT a.numeroaccion, a.denominacion, a.horastotales, a.modalidad, ga.ngrupo, 
    m.fechaini, m.fechafin, m.horariomini, m.horariomfin, m.horariotini, m.horariotfin, m.diascheck
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
        $diascheck = $row[diascheck];
    }


// echo $fechaini;
// echo "<br>";
// echo $fechafin;
// echo "<br>";
// echo $diascheck.' - Tamaño: '.sizeof($diascheck);
// echo "<br>";

?>
<!--  -->
<!--  PRIMERA PAGINA: FICHA DEL PARTICIPANTE -->
<!--  -->

<?

$sql = 'SELECT * FROM temp_alumnos a, temp_empresas e 
WHERE a.id_empresa = e.id';
$sql = mysqli_query($link, $sql) or die ("error");

while ($row = mysqli_fetch_array($sql)) {
    
    ?>
<div style="" class="ficha page">

    <div style="overflow: auto" id="cabecera">
        <div style="float:left"><img height="120px;" src="../img/logoEsfocc.jpg" /></div>
        <div style="margin-top: 40px; margin-left: 0px; float:left"><h2 style="text-align:center;">FICHA DEL PARTICIPANTE</h2></div>
        <!-- <div style="float:right"><img src="../img/LogoTripartita.png" /></div> -->
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
    
    <div style="margin-top: 20px;" id="notapie">
        <p style="font-size: 9px">
        El interesado presta expresamente su consentimiento a que los datos personales que proporciona en el presente formulario sean incluidos en un fichero del que es titular Escuela Superior de Formación y Cualificación de Canarias, S.L. con la finalidad de la inscripción y participación del interesado en el curso elegido entre los organizados por esta entidad, así como para la correcta gestión, ejecución y justificación del mismo conforme a la normativa vigente, y para hacer llegar las comunicaciones relativas al curso respectivo. Dicha información será compartida únicamente con las entidades públicas y privadas que se encuentren relacionadas directamente con el cumplimiento de la mencionada finalidad. La negativa a facilitar los datos personales solicitados, o prestar el consentimiento antes indicado, impedirá que el interesado pueda inscribirse y participar en cualquiera de los cursos. Conforme a lo previsto en la Ley Orgánica 15/1999, de 13 de Diciembre, de Protección de Datos de Carácter Personal, el interesado puede ejercitar, respecto de los mismos, los derechos de acceso, rectificación, cancelación y oposición dirigiéndose por escrito, adjuntando fotocopia del D.N.I., a la dirección del responsable del fichero, Escuela Superior de Formación y Cualificación de Canarias, S.L. en San Cristóbal de La Laguna (38204) C/ El Sol, 10., o por cualquier otro medio que permita acreditar la identidad del usuario que ejercite cualquiera de los anteriores derechos. En todo caso, los datos de carácter personal serán cancelados cuando hayan dejado de ser necesarios para la finalidad para la cual fueron recabados.      
        </p>     
    </div>
    <div style="border-top:1px solid black; margin-top: 5px;" id="notapie2">
        <p style="margin-top:2px; font-size: 8px"><sub style="vertical-align:super">1</sub> DEL 1 AL 11 SEGÚN NÓMINA</p>
    </div>
    

</div>

<? } 



$fechasmt = array();
$fechasmt = createDateRangeArray($fechaini,$fechafin);
//print_r($fechasmt); // TO DO EL RANGO DE FECHAS


$dias_semana = array();
$dias = array('Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo');
$dias_formacion = array();

for ($i=0; $i < 7 ; $i++) { 

  if ( $diascheck[$i] == 'L' ) array_push($dias_semana, 'Lunes');
  if ( $diascheck[$i] == 'M' ) array_push($dias_semana, 'Martes');
  if ( $diascheck[$i] == 'X' ) array_push($dias_semana, 'Miércoles');
  if ( $diascheck[$i] == 'J' ) array_push($dias_semana, 'Jueves');  
  if ( $diascheck[$i] == 'V' ) array_push($dias_semana, 'Viernes');
  if ( $diascheck[$i] == 'S' ) array_push($dias_semana, 'Sábado');
  if ( $diascheck[$i] == 'D' ) array_push($dias_semana, 'Domingo');
  
}

//print_r($dias_semana);

//echo "<br>";

// MATCH DIAS DE LA SEMANA CON FECHAS
for ($i=0; $i < sizeof($fechasmt); $i++) { 
	
	for ($j=0; $j < sizeof($dias_semana) ; $j++) { 

		if ( $dias_semana[$j] == utf8_encode(ucwords(strftime("%A", strtotime($fechasmt[$i])))) ) {
			array_push($dias_formacion, $fechasmt[$i]);
		}

	}

}
// echo "<br>";
// print_r($dias_formacion);
// echo "<br>";

// QUITAMOS DIAS QUE NO HAY FORMACION (SI SE DA EL CASO)

$sql = 'SELECT DISTINCT fecha
    FROM fechas_excluir
    WHERE id_matricula ='.$id_mat;
    // echo $sql;
    $sql = mysqli_query($link, $sql) or die ("error");
    
    $fechas_excluir = array();
    while ($row = mysqli_fetch_array($sql)) { 
        ++$i;
        $fechas_excluir[$i] = $row[fecha];
    }

if ( sizeof($fechas_excluir) > 0 ) {
    print_r($fechas_excluir);
    // echo "<br>";
    $dias_formacion = array_diff($dias_formacion, $fechas_excluir);
}

// print_r($dias_formacion);
$fechas = $dias_formacion;
$dias = sizeof($dias_formacion);

if ($horariomini == "") {
    $t = 1;
    $sesion = $dias*$t;   

    $turno = "TARDE";
    $horario = "De ".$horariotini." a ".$horariotfin;
}
else if ($horariotini == "") {
    $m = 1;
    $sesion = $dias*$m;

    $turno = "MAÑANA";
    $horario = "De ".$horariomini." a ".$horariomfin;
}
else {
    $mt = 2;
    $sesion = $dias*$mt;
    $turno = array();
    $horario = array();
    $j = 0;
    for ($i=0; $i < $sesion ; $i++) {
        
        if ($i % 2 == 0) {  
            $turno[$i] = "MAÑANA";
            $horario[$i] = "De ".$horariomini." a ".$horariomfin;
        } else {
            $turno[$i] = "TARDE";
            $horario[$i] = "De ".$horariotini." a ".$horariotfin;
        }
    }
    $fechasmt = $dias_formacion;

}
//print_r($fechas);
// print_r($turno);
// print_r($horario);
// echo "<br>";
// echo $dias;
// echo "<br>";
// echo $sesion;

// print_r($fechas);


// COGER LAS EMPRESAS DEL EXCEL
$sql = 'SELECT te.id, te.razonsocial, te.cif 
FROM temp_empresas te';
$sql = mysqli_query($link, $sql) or die ("error");

while ($row = mysqli_fetch_array($sql)) {
    ?>

<div style="" class="justficert page">

    <div style="overflow: auto" id="cabecera">
        <div style="margin-top: 0px; margin-top: 20px; float:none"><h2 style="text-align:center;">JUSTIFICANTE ENTREGA DE CERTIFICADO</h2></div>
    </div>
    
    <div class="clearfix"></div>
    
    <table class="sinborde" style="margin-top: 20px; width:100%;">
        
        <tr>
            <td style="width:75%;">DENOMINACIÓN A.F.: <? echo ($denominacion) ?></td><td>A.F.: <? echo ($naccion) ?></td><td>GRUPO: <? echo ($ngrupo) ?></td>                       
        </tr>
    </table>
    <table class="sinborde" style="width:100%;">
        <tr>
            <td style="width:33.33%">FECHA INICIO: <? echo(date("d/m/Y", strtotime($fechaini))); ?></td><td style="width:33.33%">FECHA FIN: <? echo(date("d/m/Y", strtotime($fechafin))); ?></td><td style="width:33.33%">FECHA: <? echo(date("d/m/Y", strtotime($fechafin))) ?></td>
        </tr>
    </table>
    <table class="sinborde" style="width:100%;">
        <tr>
            <td>EMPRESA: <? echo $row[razonsocial]; ?></td>
        </tr>
    </table>
    
    
    <table style="width:100%; margin-top: 25px;" >
        
      <th style="width: 5px;">Nº</th>  
      <th>APELLIDOS</th>
      <th>NOMBRE</th>
      <th>NIF</th>
      <th>FIRMA</th>

      <? 
      
      $q = 'SELECT a.nombre, a.apellido, a.apellido2, a.documento
      FROM temp_alumnos a, temp_empresas te
      WHERE a.id_empresa = te.id 
      AND te.id = '.$row[id];
      // echo $q;
      $q = mysqli_query($link, $q) or die ("error");

      $i = 1;
      
      while ($rows = mysqli_fetch_array($q)) { ?>
        <tr><td><? echo $i++ ?></td><td><? echo( $rows[apellido] .' '. $rows[apellido2] ) ?></td><td><? echo($rows[nombre]) ?></td><td><? echo($rows[documento]) ?></td><td></td></tr>
      <? }

      while ($i <= 25) { ?> 
        <tr><td><? echo $i++ ?></td><td></td><td></td><td></td><td></td></tr>
      <? } ?>
        
    </table>
        

</div>


<!--  -->
<!--  TERCER PAGINA: JUSTIFICANTE ENTREGA DE MATERIAL -->
<!--  -->


<div style="" class="justficert page">

    <div style="overflow: auto" id="cabecera">
        <div style="margin-top: 0px; margin-top: 20px; float:none"><h2 style="text-align:center;">JUSTIFICANTE ENTREGA DE MATERIAL</h2></div>
    </div>

    
    <div class="clearfix"></div>
    
    <table class="sinborde" style="margin-top: 20px; width:100%;">
        
        <tr>
            <td style="width:75%;">DENOMINACIÓN A.F.: <? echo ($denominacion) ?></td><td>A.F.: <? echo ($naccion) ?></td><td>GRUPO: <? echo ($ngrupo) ?></td>                       
        </tr>
    </table>
    <table class="sinborde" style="width:100%;">
        <tr>
            <td style="width:33.33%">FECHA INICIO: <? echo(date("d/m/Y", strtotime($fechaini))); ?></td><td style="width:33.33%">FECHA FIN: <? echo(date("d/m/Y", strtotime($fechafin))); ?></td><td style="width:33.33%">FECHA: <? echo(date("d/m/Y", strtotime($fechaini))) ?></td>
        </tr>      
    </table>
    <table class="sinborde" style="width:100%;">
        <tr>
            <td>EMPRESA: <? echo $row[razonsocial]; ?></td>
        </tr>
    </table>
    
    
    <table style="width:100%; margin-top: 25px;" >
        
       <th style="width: 5px;">Nº</th>  
      <th>APELLIDOS</th>
      <th>NOMBRE</th>
      <th>NIF</th>
      <th>FIRMA</th>

      <? 
      
      $q = 'SELECT a.nombre, a.apellido, a.apellido2, a.documento
      FROM temp_alumnos a, temp_empresas te
      WHERE a.id_empresa = te.id 
      AND te.id = '.$row[id];
      // echo $q;
      $q = mysqli_query($link, $q) or die ("error");
      $i = 1;
      
      while ($rows = mysqli_fetch_array($q)) { ?>
        <tr><td><? echo $i++ ?></td><td><? echo( $rows[apellido] .' '. $rows[apellido2] ) ?></td><td><? echo($rows[nombre]) ?></td><td><? echo($rows[documento]) ?></td><td></td></tr>
      <? } 
      
      while ($i <= 25) { ?> 
        <tr><td><? echo $i++ ?></td><td></td><td></td><td></td><td></td></tr>
      <? } ?>
             
    </table>
        

</div>


<!--  -->
<!--  CONTROL DE ASISTENCIA TRIPARTITA: POR EMPRESA Y SESIONES. -->
<!--  -->

<?

    for ($j=0; $j < $sesion ; $j++) { 

    ?>
<div style="" class="controlasist page">

    <div style="overflow: auto" id="cabecera">
        <!-- <div style=""><img src="../img/LogoTripartita.png" /></div> -->
        <div style="margin-top: 0px; margin-top: 5px; float:none"><h2 style="text-align:center;">CONTROL DE ASISTENCIA</h2></div>
    </div>
    
    <div class="clearfix"></div>
    
    <table class="bordegris" style="margin-top: 20px; width:100%;">
        
        <tr>
            <td style="width:15%;">OPCIÓN A </td><td>EMPRESA BONIFICADA: <? echo($row[razonsocial]) ?></td><td>CIF: <? echo($row[cif]) ?></td>                       
        </tr>
        <tr>
            <td rowspan="2" style="width:15%;">OPCIÓN B </td>
            <td colspan="2">ENTIDAD ORGANIZADORA: <span style="font-weight:normal">ESCUELA SUPERIOR DE FORMACIÓN Y CUALIFICACIÓN DE CANARIAS, S.L</span>
             C: <span style="font-weight:normal">B76567718</span> </td>
        </tr>
        <tr><td colspan="2">CÓDIGO DE AGRUPACIÓN: B160251AA</td></tr>
    </table>


    <table class="bordegris" style="margin-top: 20px; width:100%;">
        
        <tr>
            <td colspan="4">DENOMINACIÓN ACCIÓN FORMATIVA: <? echo ($denominacion) ?></td>                  
        </tr>
        <tr>
            <td>Nº: <? echo ($naccion) ?></td><td>GRUPO: <? echo ($ngrupo) ?></td><td>FECHA DE INICIO: <? echo(date("d/m/Y", strtotime($fechaini))); ?></td><td>FECHA FIN: <? echo(date("d/m/Y", strtotime($fechafin))); ?></td>                  
        </tr>
        <tr>
            <td colspan="4">FORMADOR/RESPONSABLE DE FORMACIÓN: </td>                  
        </tr>
        <tr>
            <td>SESIÓN Nº: <? echo($j+1) ?></td><td>FECHA: <? if ($mt != "") echo(date("d/m/Y", strtotime($fechasmt[floor($j/2)]))); else  echo(date("d/m/Y", strtotime($fechas[$j]))); ?></td>
            <td><? if ($mt != "") echo($turno[$j]); else echo($turno); ?> </td><td>HORARIO: <? if ($mt != "") echo($horario[$j]); else echo($horario); ?> </td>                  
        </tr>
        <tr>
            <td colspan="4">Firmado por:<br>(Formador/Resp. Formación) </td>                  
        </tr>
    </table>    
    
    <table class="bordegris" style="width:100%; margin-top: 25px;" >
        
      <tr>
        <th colspan="3">DATOS DE LOS ASISTENTES</th><th rowspan="2">FIRMAS</th><th rowspan="2">OBSERVACIONES</th>
      </tr>
      <tr>
        <th>APELLIDOS</th>
        <th>NOMBRE</th>
        <th>NIF</th>
      </tr>

      <?
      
      $q = 'SELECT a.nombre, a.apellido, a.apellido2, a.documento
      FROM temp_alumnos a, temp_empresas te
      WHERE a.id_empresa = te.id 
      AND te.id = '.$row[id];
      // echo $q;
      $q = mysqli_query($link, $q) or die ("error");
      $i = 1;
      
      while ($rows = mysqli_fetch_array($q)) { ?>
        <tr><td><span style="margin-right:3px; color:#bbb"><? echo $i++ .'</span> '.$rows[apellido] .' '. $rows[apellido2] ?></td><td><? echo($rows[nombre]) ?></td><td><? echo($rows[documento]) ?></td><td></td><td></td></tr>
      <? } 
      
      while ($i <= 25) { ?> 
        <tr><td><span style="margin-right:3px; color:#bbb"><? echo $i++ .'</span> '?></td><td></td><td></td><td></td><td></td></tr>
      <? } ?> 
      
      
    </table>
        

</div>

<? } 

} ?>


?>

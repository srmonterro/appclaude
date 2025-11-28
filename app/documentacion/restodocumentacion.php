
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
    page-break-after: always
}


@page {
    size: A4;
    margin: 0;
}

th, td { padding: 5px; }
table { font-size: 12px; border-collapse: collapse; }
td {border: 1px solid #1B0085; height: 25px;}
th {border: 3px solid #1B0085}

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

<!-- 12.11.2019-IVÁN: LA SIGUIENTE LÍNEA ERA  if ($naccion<5000 ) para comprobar q no fuese acción de entidad externa -->
<? if ( $naccion < 0 ) { ?>

<div style="" class="ficha page">

    <div style="overflow: auto; margin-top: 40px" id="cabecera">
        <div style="float:left;margin-right: 10px;"><img height="80px;" src="../img/logo.png" /></div>
        <div style="margin-top: 40px; margin-left: 25px; float:left"><h2 style="text-align:center;">FICHA DEL PARTICIPANTE</h2></div>
        <!-- <div style="float:right; "><img width="170px" src="../img/LogoTripartita.png" /></div> -->
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
           <td>APELLIDOS: </td><td>NOMBRE: </td>
       </tr>
       <tr>
           <td>NIF/NIE: </td><td>Nº AFILIACION S.S.: </td>
       </tr>
       <tr>
           <td colspan="2">CUENTA DE COTIZACION DE LA EMPRESA: </td>
       </tr>
       <tr>
           <td>FECHA DE NACIMIENTO: </td><td>SEXO: <input type="checkbox"> M <input type="checkbox"> F</td>
       </tr>
       <tr>
           <td>DISCAPACITADO: <input type="checkbox"> SI <input type="checkbox"> NO </td><td>VICTIMA/AFECTADO VIOLENCIA GÉNERO: <input type="checkbox"> SI <input type="checkbox"> NO</td>
       </tr>
       <tr>
           <td>VICTIMA/AFECTADO TERRORISMO: <input type="checkbox"> SI <input type="checkbox"> NO</td><td>GRUPO DE COTIZACIÓN: </td>
       </tr>
       <tr>
           <td>ESTUDIOS</td><td>
               <input type="checkbox"> SIN ESTUDIOS<BR>
               <input type="checkbox"> ESTUDIOS PRIMARIOS, EGB O EQUIVALENTE<BR>
               <input type="checkbox"> FP I,FP II, BACHILLERATO SUPERIOR, BUP O EQUIVALENTE<BR>
               <input type="checkbox"> ARQUITECTO TÉCNICO, INGENIERO TÉCNICO, DIPLOMADO<BR>
               <input type="checkbox"> ARQUITECTO E INGENIERO SUPERIOR O LICENCIADO<BR>
           </td>
       </tr>
       <tr>
           <td>CATEGORÍA</td><td>
                <input type="checkbox"> DIRECTIVO<BR>
                <input type="checkbox"> MANDO INTERMEDIO<BR>
                <input type="checkbox"> TÉCNICO<BR>
                <input type="checkbox"> TRABAJADOR CUALIFICADO<BR>
                <input type="checkbox"> TRABAJADOR CON BAJA CUALIFICACIÓN<BR>
           </td>
       </tr>

    </table>


    <h3 style="margin-top: 25px; margin-bottom: 5px; text-align:center;">DATOS DE LA EMPRESA</h3>
    <table style="width:100%;" >

        <tr>
            <td>RAZÓN SOCIAL: </td><td>CIF: </td>
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
<? } ?>

<!--  -->
<!--  SEGUNDA PAGINA: JUSTIFICANTE ENTREGA DE CERTIFICADO -->
<!--  -->

<?

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
    WHERE id_matricula ='.$id_mat.' AND tipo = "p"';
    // echo $sql;
    $sql = mysqli_query($link, $sql) or die ("error");

    $fechas_excluir = array();
    while ($row = mysqli_fetch_array($sql)) {
        ++$i;
        $fechas_excluir[$i] = $row[fecha];
    }

if ( sizeof($fechas_excluir) > 0 ) {
    // print_r($fechas_excluir);
    // echo "<br>";
    $dias_formacion = array_diff($dias_formacion, $fechas_excluir);
}

// print_r($dias_formacion);echo "<br>";
$fechas = array_values($dias_formacion);
$dias = sizeof($dias_formacion);

$fechasIncluir = array();

$q3 = 'SELECT dia, horariomini, horariomfin, horariotini, horariotfin
    FROM fechas_incluir
    WHERE id_matricula = '.$id_mat.' and tipo = "p"';
    // echo $q3;
    $q3 = mysqli_query($link, $q3);
    $z = 0;
    while ( $rowss = mysqli_fetch_array($q3) ) {

        $fechasIncluir[$z][dia] = $rowss[dia];
        $fechasIncluir[$z][horariomini] = $rowss[horariomini];
        $fechasIncluir[$z][horariomfin] = $rowss[horariomfin];
        $fechasIncluir[$z][horariotini] = $rowss[horariotini];
        $fechasIncluir[$z][horariotfin] = $rowss[horariotfin];
        $z++;
    }

// echo("<pre>".print_r($fechasIncluir)."</pre>"); echo "<br>";
    // print_r(expression)
// echo $dias;
$fechasFinal = array();
for ($i=0; $i < $dias; $i++) {

    $fechasFinal[$i][dia] = $fechas[$i];
    $fechasFinal[$i][horariomini] = $horariomini;
    $fechasFinal[$i][horariomfin] = $horariomfin;
    $fechasFinal[$i][horariotini] = $horariotini;
    $fechasFinal[$i][horariotfin] = $horariotfin;
    $sesiones = calculaSesiones($fechasFinal[$i][horariomini], $fechasFinal[$i][horariotini], $fechasFinal[$i][horariomfin], $fechasFinal[$i][horariotfin]);
    $fechasFinal[$i][sesiones] = $sesiones[0];
    $fechasFinal[$i][turno] = $sesiones[1];
    $fechasFinal[$i][horario] = $sesiones[2];


    for ($j=0; $j < sizeof($fechasIncluir); $j++) {
      // echo "incluir: ".$fechasIncluir[$j][dia];echo "<br>";
      // echo "fecha: ".$fechasFinal[$i][dia];echo "<br>";
        if ( $fechasIncluir[$j][dia] == $fechasFinal[$i][dia] ) {
            $fechasFinal[$i][horariomini] = $fechasIncluir[$j][horariomini];
            $fechasFinal[$i][horariomfin] = $fechasIncluir[$j][horariomfin];
            $fechasFinal[$i][horariotini] = $fechasIncluir[$j][horariotini];
            $fechasFinal[$i][horariotfin] = $fechasIncluir[$j][horariotfin];
            $sesiones = calculaSesiones($fechasFinal[$i][horariomini], $fechasFinal[$i][horariotini], $fechasFinal[$i][horariomfin], $fechasFinal[$i][horariotfin]);
            $fechasFinal[$i][sesiones] = $sesiones[0];
            $fechasFinal[$i][turno] = $sesiones[1];
            $fechasFinal[$i][horario] = $sesiones[2];
        }
    }

}

// echo("<pre>");print_r($fechasFinal);echo("</pre>");


$sql = 'SELECT e.id, e.razonsocial, e.cif
  FROM ptemp_mat_emp te, empresas e, matriculas m
  WHERE e.id = te.id_empresa
  AND m.id = te.id_matricula
  AND m.id = '.$id_mat;
// echo $sql;
$sql = mysqli_query($link, $sql) or die ("error");

while ($row = mysqli_fetch_array($sql)) {
    ?>

<div style="" class="justficert page">

    <div style="overflow: auto" id="cabecera">
        <div style="margin-top: 50px; float:none"><h2 style="text-align:center;">JUSTIFICANTE ENTREGA DE CERTIFICADO</h2></div>
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
      for ($i=0; $i < 30 ; $i++) { ?>
        <tr><td style="height: 30px;"><? echo $i+1 ?></td><td style="height: 30px;"></td><td style="height: 30px;"></td><td style="height: 30px;"></td><td style="height: 30px;"></td></tr>
      <? } ?>

    </table>


</div>


<!--  -->
<!--  TERCER PAGINA: JUSTIFICANTE ENTREGA DE MATERIAL -->
<!--  -->


<div style="" class="justficert page">

    <div style="overflow: auto" id="cabecera">
        <div style="margin-top: 50px; float:none"><h2 style="text-align:center;">JUSTIFICANTE ENTREGA DE MATERIAL</h2></div>
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


    <table style="width:100%;  margin-top: 25px;" >

      <th style="width: 5px;">Nº</th>
      <th style="width: 25%;">APELLIDOS</th>
      <th style="width: 15%;">NOMBRE</th>
      <th style="width: 10%;">NIF</th>
      <th>FIRMA</th>


      <?
      for ($i=0; $i < 30 ; $i++) { ?>
        <tr><td style="height: 30px;"><? echo $i+1 ?></td><td style="height: 30px;"></td><td style="height: 30px;"></td><td style="height: 30px;"></td><td style="height: 30px;"></td></tr>
      <? } ?>

    </table>


</div>


<!--  -->
<!--  CUARTA PAGINA: LISTADOS EMAIL-TELEFONO -->
<!--  -->

<? if ( $naccion < 0 ) { ?>

<div style="" class="justficert page page-break">

    <div style="overflow: auto" id="cabecera">
        <div style="margin-top: 50px; float:none"><h2 style="text-align:center;">DATOS CONTACTO</h2></div>
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


    <table style="width:100%;font-size:11px; margin-top: 25px;" >

      <th style="width: 5px;">Nº</th>
      <th style="width: 20%;">APELLIDOS</th>
      <th style="width: 15%;">NOMBRE</th>
      <th style="width: 10%;">NIF</th>
      <th style="width: 13%;">TELEFONO</th>
      <th>EMAIL</th>

      <?


      for ($i=0; $i < 30 ; $i++) { ?>
        <tr><td><? echo $i+1 ?></td><td></td><td></td><td></td><td></td><td></td></tr>
      <? } ?>


    </table>


</div>

<? } ?>

<!--  -->
<!--  CONTROL DE ASISTENCIA TRIPARTITA: POR EMPRESA Y SESIONES. -->
<!--  -->

<?

$nsesion = 0;
for ($i=0; $i < count($fechasFinal); $i++) {

    $sesion = 0;

    // echo $fechasFinal[$i][dia];
    for ($j=0; $j < $fechasFinal[$i][sesiones]; $j++) {
        $sesion++; $nsesion++;
    ?>
    <div style="" class="controlasist page page-break">

    
    <div style="overflow: auto" id="cabecera">
          <!-- <div style="margin-top: 15px"><img src="../img/LogoTripartita.png" /></div> -->
          <? if ( $naccion > 22000 ) { ?>
         <div style="float:left;margin-right: 10px;"><img height="60px;" src="../img/logo.png" /></div><? } else { ?>
         <div style="float:left;margin-right: 10px;"><img height="60px;" src="../img/Grupo-Valora.png" /></div><? } ?>
        <div style="margin-top: 40px; margin-left: 85px; float:left"><h2 style="text-align:center;">CONTROL DE ASISTENCIA</h2></div>
      </div>
    <div class="clearfix"></div>

    <table class="bordegris" style="margin-top: 20px; width:100%;">

        <tr>
            <td style="width:15%;">OPCIÓN A </td><td>EMPRESA BONIFICADA: <? echo($row[razonsocial]) ?></td><td>CIF: <? echo($row[cif]) ?></td>
        </tr>
        <? if ( $naccion > 22000 ) { ?>
        <tr>
            <td rowspan="2" style="width:15%;">OPCIÓN B </td>
            
            <td colspan="2">ENTIDAD ORGANIZADORA: <span style="font-weight:normal">EDUKA-TE SOLUTIONS, S.L.U.</span>
             CIF: <span style="font-weight:normal">B76757764</span> </td>
        </tr>
        <? } else { ?>
            <tr>
              <td rowspan="2" style="width:15%;">OPCIÓN B </td>
              <td colspan="2">ENTIDAD ORGANIZADORA: <span style="font-weight:normal">GRUPO VALORA CANARIAS, SL - PERFIL GRUPO DE EMPRESAS</span> CIF: <span style="font-weight:normal">B38040713</span> </td>
          </tr>
          <? } ?>
          <?
        if ( $naccion >= 24000 )
        echo '<tr><td colspan="2">CÓDIGO DE AGRUPACIÓN: B245287AF</td></tr>';
        else if ( $naccion >= 22000 )
        echo '<tr><td colspan="2">CÓDIGO DE AGRUPACIÓN: B223451AB</td></tr>';
    else if ( $gestion = "2021" )
        echo '<tr><td colspan="2">CÓDIGO DE AGRUPACIÓN: B218911AG</td></tr>';
     else if ( $gestion = "2020" )
        echo '<tr><td colspan="2">CÓDIGO DE AGRUPACIÓN: B200712AJ</td></tr>';
    else
        echo '<tr><td colspan="2">CÓDIGO DE AGRUPACIÓN: B206337AC</td></tr>';

        ?>
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
            <td>SESIÓN Nº: <? echo $nsesion ?></td><td>FECHA:
            <? if ( $fechasFinal[$i][sesiones] == 2) {

                    $turno = explode(" - ", $fechasFinal[$i][turno]);
                    $horario = explode(" - ", $fechasFinal[$i][horario]);

                    if ( $sesion == 1 ) {
                        echo(date("d/m/Y", strtotime($fechasFinal[$i][dia]))."</td>");
                        echo("<td>".$turno[0]."</td>");
                        echo("<td>HORARIO: ".$horario[0]."</td>");
                    } else {
                        echo(date("d/m/Y", strtotime($fechasFinal[$i][dia]))."</td>");
                        echo("<td>".$turno[1]."</td>");
                        echo("<td>HORARIO: ".$horario[1]."</td>");
                    }

            } else {
                echo(date("d/m/Y", strtotime($fechasFinal[$i][dia]))."</td>");
                echo("<td>".$fechasFinal[$i][turno]."</td>");
                echo("<td>HORARIO: ".$fechasFinal[$i][horario]."</td>");
            } ?>
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
      for ($x=0; $x < 30 ; $x++) { ?>
        <tr><td><span style="color:#bbb"><? echo $x+1 ?></span></td><td></td><td></td><td></td><td></td></tr>
      <? } ?>

    </table>

    </div>

<? }
  }
} ?>

<!-- <script type="text/javascript">
window.onload = function () {
    window.print();
}
</script> -->

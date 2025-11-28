
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
td {border: 1px solid #1B0085; height: 25px;}
th {border: 3px solid #1B0085}

table.sinborde td { border: 0px; }

table.bordegris td { border: 1px solid #ccc; padding-top: 5px; }
table.bordegris th { border: 1px solid #ccc}
table.bordegris { border: 3px solid #ccc; color: #1B0085; font-weight: bold;}

table.bordegrisTPC { border: 3px solid #ccc; color: black; font-weight: bold;}
table.bordegrisTPC td { border: 1px solid #ccc; padding-top: 5px; }
table.bordegrisTPC th { border: 1px solid #ccc}

table.ikearlt td {border: 1px solid #000; height: 25px;}
table.ikearlt th {border: 3px solid #000}

.controlasist {
    color: #1B0085;
}

.controlasistTPC{
  color: black;
}

p { margin-top: 3px; line-height: 130% }
ol li { margin-top: 5px;}
ul li { margin-top: 5px;}


</style>


<?

//echo "asd";
include_once '../functions/funciones.php';

setlocale(LC_TIME, "es_ES");
// echo locale_get_default();

// $miFecha= gmmktime(12,0,0,1,15,2089);
// echo 'Antes de setlocale strftime devuelve: '.strftime("%A, %d de %B de %Y", $miFecha).'<br/>';
// echo 'Antes de setlocale date devuelve: '.date("l, d-m-Y (H:i:s)", $miFecha).'<br/>';
// setlocale(LC_TIME,"es_ES");
// echo 'Después de setlocale es_ES date devuelve: '.date("l, d-m-Y (H:i:s)", $miFecha).'<br/>';
// echo 'Después de setlocale es_ES strftime devuelve: '.strftime("%A, %d de %B de %Y", $miFecha).'<br/>';



$id_mat = $_GET['id_matricula'];

$sql = 'SELECT  DISTINCT  a.numeroaccion, a.denominacion, a.horastotales, a.modalidad, a.tipoformacionac, ga.ngrupo, a.objetivos, c.localidad as localidad, c.provincia, c.codigopostal,
  m.fechaini, m.fechafin, m.horariomini, m.horariomfin, m.horariotini, m.horariotfin, m.diascheck, m.estado, d.*, m.solicitud, c.*, c.id as id_centro, m.incluirp_solo
  FROM matriculas m, acciones a, grupos_acciones ga, docentes d, mat_doc md, centros c
  WHERE m.id_accion = a.id
  AND c.id = m.centro
  AND md.id_matricula = m.id
  AND d.id = md.id_docente
  AND m.id_grupo = ga.id
  AND m.id ='.$id_mat;
   //echo $sql;
$sql = mysqli_query($link, $sql) or die ("error: ". mysqli_error($link));

if ( mysqli_num_rows($sql) < 1 ) {

    $link = connectAnio(date('Y')-1);
    $sql = 'SELECT DISTINCT  a.numeroaccion, a.denominacion, a.horastotales, a.modalidad, a.tipoformacionac,ga.ngrupo, a.objetivos, c.localidad as localidad, c.provincia, c.codigopostal,
        m.fechaini, m.fechafin, m.horariomini, m.horariomfin, m.horariotini, m.horariotfin, m.diascheck, m.estado, d.*, m.solicitud, c.*, c.id as id_centro, m.incluirp_solo
        FROM matriculas m, acciones a, grupos_acciones ga, docentes d, mat_doc md, centros c
        WHERE m.id_accion = a.id
        AND c.id = m.centro
        AND md.id_matricula = m.id
        AND d.id = md.id_docente
        AND m.id_grupo = ga.id
        AND m.id ='.$id_mat;
    $sql = mysqli_query($link, $sql) or die ("error: ". mysqli_error($link));

}

while ($row = mysqli_fetch_array($sql)) {
  $incluirp_solo = $row[incluirp_solo];
  $naccion = $row[numeroaccion];
  $tipoformacionac = $row[tipoformacionac];
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
  $provincia = $row[provincia];
  $codpostal = $row[codigopostal];
  $id_centro = $row[id_centro];
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
  $sql = 'SELECT DISTINCT  a.*, e.*, ma.numerocuenta as cuentacotizacion
  FROM mat_alu_cta_emp ma, alumnos a, empresas e
  WHERE ma.id_alumno = a.id
  AND ma.finalizado = 1
  AND ma.tipo = ""
  AND ma.id_matricula = '.$id_mat.'
  AND ma.id_empresa = e.id';
else
  $sql = 'SELECT DISTINCT a.*, e.razonsocial as empresa, e.id as id_empresa
  FROM temp_alumnos a, temp_empresas te, empresas e, ptemp_mat_emp pt
  WHERE pt.id_matricula = te.id_matricula
  AND pt.id_empresa = e.id
  AND a.id_empresa = te.id
  AND te.id_matricula = a.id_matricula
  AND te.cif = e.cif
  AND te.id_matricula = '.$id_mat;
  // $sql = 'SELECT *, e.razonsocial as empresa, e.id as id_empresa FROM temp_alumnos a, temp_empresas te, empresas e
  // WHERE a.id_empresa = te.id
  // AND e.cif = te.cif
  // AND te.id_matricula = '.$id_mat.'
  // AND te.id_matricula = a.id_matricula';

// if ( isRoot() )
 // echo $sql;

$sql = mysqli_query($link, $sql) or die ("error".mysqli_error($link));

// if ( isRoot() )
//   echo "<br>llega 1";

while ($row = mysqli_fetch_array($sql)) {

?>

<?
  // if ( isRoot() )
   //echo '<br>naccion: '.$naccion;
// 12.11.2019-IVÁN: LA SIGUIENTE LÍNEA ERA --> if ($naccion<5000 ) para comprobar q no fuese acción de entidad externa
  if ( $naccion < 0 ) { ?>

    <div style="" class="ficha page page-break">

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
           <td>APELLIDOS: <? echo mb_strtoupper($row[apellido].' '.$row[apellido2], 'UTF-8') ?></td><td>NOMBRE: <? echo mb_strtoupper($row[nombre], 'UTF-8') ?></td>
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
            <td>RAZÓN SOCIAL: <? echo($row[empresa]) ?></td><td>CIF: <? echo($row[cif]) ?></td>
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
        De conformidad con la Ley Orgánica 15/1999, le informamos que los datos que se faciliten en este formulario forman parte de un fichero de carácter personal con la denominación “ALUMNOS”, cuya titularidad pertenece a “ESCUELA SUPERIOR DE FORMACIÓN Y CUALIFICACIÓN DE CANARIAS S.L.U.”, con domicilio en C./ Seguidillas, 9 Z.I. Llanos del Camello – Las Chafiras, 38639 – San Miguel de Abona, cuya finalidad es relación formativa y comercial, así como el envío de información de diferentes ofertas formativas que se realice dicha entidad. Asimismo, nos autoriza al uso de imágenes realizadas en las acciones formativas que se desarrollen, y que forman parte del fichero cuya denominación es “WEB”, cuya titularidad pertenece a “ESCUELA SUPERIOR DE FORMACIÓN Y CUALIFICACIÓN DE CANARIAS S.L.U.”, para poder ser publicadas tanto en web como redes sociales. Si desea ejercer sus derechos de acceso, rectificación, cancelación y oposición, pueden enviarnos un correo electrónico a info@eduka-te.com o llamar al teléfono.
        </p>
    </div>
    <div style="border-top:1px solid black; margin-top: 5px;" id="notapie2">
        <p style="margin-top:2px; font-size: 8px"><sub style="vertical-align:super">1</sub> DEL 1 AL 11 SEGÚN NÓMINA</p>
    </div>


</div>
<? }
// if ( isRoot() )
//   echo "<br>llega 2";
?>



<? if ( strpos($solicitud, 'IK') !== false ) { // ES IKEA
// if ( isRoot() )
//   echo "<br>llega 3";
  ?>



<div style="" class="ficha page page-break">

  <p style="margin-top: 50px">En  <? echo $localidad ?>, a ...... de .......................... de <? echo $gestion ?> </p><br><br>

  <p>D/Dª. <? echo mb_strtoupper($row[nombre] .' '. $row[apellido].' '.$row[apellido2], 'UTF-8') ?> manifiesta estar conforme con la realización del curso/acción formativa denominado/a <? echo $dneominacion ?>, sobre cuyo contenido declara haber sido informado/a. </p> <br>

  <p>Dicho curso/acción formativa se impartirá de forma <? echo strtolower($modalidad) ?> por <? echo ucfirst($docente) ?>, el/ los próximo/s día/s <? echo formateaFecha($fechaini). ' a ' . formateaFecha($fechafin) .' , en horario de '. $horario .' en el centro '.$centro.'.' ?> </p><br>

  <p>Con la firma del presente documento el trabajador se compromete a finalizar este curso descrito en el párrafo primero del cual la Empresa ha asumido, parcial o totalmente, su coste.</p><br>

  <p>En el supuesto en que el trabajador no finalice dicho curso, deberá concurrir causa justa para ello, la cual deberá justificar a la empresa con la antelación pertinente.</p><br>

  <p>Objetivos:</p><br>
  <p><? echo nl2br($objetivos) ?></p>

  <p style="margin-top: 50px">Enterado/a y conforme.</p>


  <p style="text-align:center; margin-top: 100px">Firma del Trabajador<br><br>
  <? echo mb_strtoupper($row[nombre] .' '. $row[apellido].' '.$row[apellido2], 'UTF-8').' - '.$row[documento] ?></p>

</div>

<? }

}

// echo $incluirp_solo;

$fechasmt = array();
$fechasmt = createDateRangeArray($fechaini,$fechafin);
// echo "sale";
// print_r($fechasmt); // TO DO EL RANGO DE FECHAS


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

// print_r($dias_semana);

//echo "<br>";

// MATCH DIAS DE LA SEMANA CON FECHAS
for ($i=0; $i < sizeof($fechasmt); $i++) {

  for ($j=0; $j < sizeof($dias_semana) ; $j++) {

    if ( $dias_semana[$j] == utf8_encode(ucwords(strftime("%A", strtotime($fechasmt[$i])))) ) {
      // echo "entra";
      array_push($dias_formacion, $fechasmt[$i]);
    }

  }

}
// print_r($dias_formacion);
// echo strftime("%A", strtotime($fechasmt[0]));
// echo "<br>";// echo "<br>";


// QUITAMOS DIAS QUE NO HAY FORMACION (SI SE DA EL CASO)
if ( $incluirp_solo != 1 ) {

  $sql = 'SELECT  fecha
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

}

// print_r($dias_formacion);
$fechas = $dias_formacion;
$fechas = array_values($fechas);
$dias = sizeof($dias_formacion);


$fechasIncluir = array();
$fechasFinal = array();


$q3 = 'SELECT dia, horariomini, horariomfin, horariotini, horariotfin
    FROM fechas_incluir
    WHERE id_matricula = '.$id_mat.' and tipo = "p"';
    // echo $q3;
$q3 = mysqli_query($link, $q3);
$z = 0;
while ( $rowss = mysqli_fetch_array($q3) ) {

    if ( $incluirp_solo != 1 ) {
      $fechasIncluir[$z][dia] = $rowss[dia];
      $fechasIncluir[$z][horariomini] = $rowss[horariomini];
      $fechasIncluir[$z][horariomfin] = $rowss[horariomfin];
      $fechasIncluir[$z][horariotini] = $rowss[horariotini];
      $fechasIncluir[$z][horariotfin] = $rowss[horariotfin];
      $z++;
    } else {
      $fechasFinal[$z][dia] = $rowss[dia];
      $fechasFinal[$z][horariomini] = $rowss[horariomini];
      $fechasFinal[$z][horariomfin] = $rowss[horariomfin];
      $fechasFinal[$z][horariotini] = $rowss[horariotini];
      $fechasFinal[$z][horariotfin] = $rowss[horariotfin];
      $sesiones = calculaSesiones($fechasFinal[$z][horariomini], $fechasFinal[$z][horariotini], $fechasFinal[$z][horariomfin], $fechasFinal[$z][horariotfin]);
      $fechasFinal[$z][sesiones] = $sesiones[0];
      $fechasFinal[$z][turno] = $sesiones[1];
      $fechasFinal[$z][horario] = $sesiones[2];
      $z++;
    }
}

// arrayText($fechasIncluir);


if ($incluirp_solo != 1) {
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
}


// echo("<pre>");
// print_r($fechasFinal);
// echo "</pre>";

// if ( isRoot() )
//   echo "<br>llega 4";

if ( $estado == 'Finalizada' || $estado == 'Facturada' )
  $sql = 'SELECT DISTINCT  e.*
  FROM mat_alu_cta_emp ma, empresas e
  WHERE ma.id_empresa = e.id
  AND ma.finalizado = 1
  AND ma.tipo = ""
  AND ma.id_matricula = '.$id_mat;
else
  $sql = 'SELECT DISTINCT te.id, te.razonsocial, te.cif, e.representacionlegal, e.razonsocial as empresa, e.id as id_empresa
  FROM temp_empresas te, empresas e, ptemp_mat_emp pt
  WHERE pt.id_matricula = te.id_matricula
  ANd pt.id_empresa = e.id
  ANd e.cif = te.cif
  AND te.id_matricula = '.$id_mat;

// if ( isRoot() )
//   echo '<br>'.$sql;

$sql = mysqli_query($link, $sql) or die ("error xx s".mysqli_error($link));

while ($row = mysqli_fetch_array($sql))
{
?>
  <div style="" class="justficert page page-break">
    <div style="overflow: auto" id="cabecera">
        <div style="margin-top: 50px; float:none"><h2 style="text-align:center;">JUSTIFICANTE ENTREGA DE CERTIFICADO</h2></div>
    </div>
    <div class="clearfix"></div>
    <table class="sinborde" style="margin-top: 20px; width:100%;">
      <tr>
        <td style="width:75%;">DENOMINACIÓN A.F.: <? echo ($denominacion) ?></td>
        <td>A.F.: <? echo ($naccion) ?></td><td>GRUPO: <? echo ($ngrupo) ?></td>
      </tr>
    </table>
    <table class="sinborde" style="width:100%;">
      <tr>
        <td style="width:33.33%">FECHA INICIO: <? echo(date("d/m/Y", strtotime($fechaini))); ?></td>
        <td style="width:33.33%">FECHA FIN: <? echo(date("d/m/Y", strtotime($fechafin))); ?></td>
        <td style="width:33.33%">FECHA: <? echo(date("d/m/Y", strtotime($fechafin))) ?></td>
      </tr>
    </table>
    <table class="sinborde" style="width:100%;">
      <tr>
        <td>EMPRESA: <? echo $row[empresa]; ?></td>
      </tr>
    </table>

    <table style="width:100%; margin-top: 25px;" >
      <th style="width: 5px;">Nº</th>
      <th>APELLIDOS</th>
      <th>NOMBRE</th>
      <th>NIF</th>
      <th>FIRMA</th>

      <?

      if ( $estado == 'Finalizada' || $estado == 'Facturada' )
        $q = 'SELECT DISTINCT  a.nombre, a.apellido, a.apellido2, a.documento
        FROM mat_alu_cta_emp ma, alumnos a, empresas e
        WHERE ma.id_alumno = a.id
        AND ma.finalizado = 1
        AND ma.id_empresa = e.id
        AND e.id = '.$row[id].'
        AND ma.id_matricula = '.$id_mat;
      else
        $q = 'SELECT DISTINCT a.*, e.razonsocial as empresa, e.id as id_empresa
        FROM temp_alumnos a, temp_empresas te, empresas e, ptemp_mat_emp pt
        WHERE pt.id_matricula = te.id_matricula
        AND pt.id_empresa = e.id
        AND a.id_empresa = te.id
        AND te.id_matricula = a.id_matricula
        AND te.cif = e.cif  AND e.id = '.$row['id_empresa'].'
        AND te.id_matricula = '.$id_mat;
      // echo $q;

      $q = mysqli_query($link, $q) or die ("error xx".mysqli_error($link));

      $i = 1;

      while ($rows = mysqli_fetch_array($q)) { ?>
        <tr><td><? echo $i++ ?></td><td><? echo mb_strtoupper($rows[apellido] .' '. $rows[apellido2], 'UTF-8' ) ?></td><td><? echo mb_strtoupper($rows[nombre], 'UTF-8') ?></td><td><? echo($rows[documento]) ?></td><td></td></tr>
      <? }

      while ($i <= 30) { ?>
        <tr><td><? echo $i++ ?></td><td></td><td></td><td></td><td></td></tr>
      <? } ?>

    </table>
  </div>

  <!--  -->
  <!--  TERCER PAGINA: JUSTIFICANTE ENTREGA DE MATERIAL -->
  <!--  -->

  <div style="" class="justficert page page-break">

    <div style="overflow: auto" id="cabecera">
        <div style="margin-top: 50px; float:none"><h2 style="text-align:center;">JUSTIFICANTE ENTREGA DE MATERIAL</h2></div>
    </div>

    <div class="clearfix"></div>

    <table class="sinborde" style="margin-top: 20px; width:100%;">
      <tr>
        <td style="width:75%;">DENOMINACIÓN A.F.: <? echo ($denominacion) ?></td>
        <td>A.F.: <? echo ($naccion) ?></td>
        <td>GRUPO: <? echo ($ngrupo) ?></td>
      </tr>
    </table>
    <table class="sinborde" style="width:100%;">
      <tr>
        <td style="width:33.33%">FECHA INICIO: <? echo(date("d/m/Y", strtotime($fechaini))); ?></td>
        <td style="width:33.33%">FECHA FIN: <? echo(date("d/m/Y", strtotime($fechafin))); ?></td>
        <td style="width:33.33%">FECHA: <? echo(date("d/m/Y", strtotime($fechaini))) ?></td>
      </tr>
    </table>
    <table class="sinborde" style="width:100%;">
      <tr>
        <td>EMPRESA: <? echo $row[empresa]; ?></td>
      </tr>
    </table>

    <table style="width:100%;font-size:11px; margin-top: 25px;" >

      <th style="width: 5px;">Nº</th>
      <th style="width: 25%;">APELLIDOS</th>
      <th style="width: 15%;">NOMBRE</th>
      <th style="width: 10%;">NIF</th>
      <th>FIRMA</th>

      <?

      if ( $estado == 'Finalizada' || $estado == 'Facturada')
        $q = 'SELECT DISTINCT  a.nombre, a.apellido, a.apellido2, a.documento
        FROM mat_alu_cta_emp ma, alumnos a, empresas e
        WHERE ma.id_alumno = a.id
        AND ma.finalizado = 1
        AND ma.id_empresa = e.id
        AND e.id = '.$row[id].'
        AND ma.id_matricula = '.$id_mat;
      else
        $q = 'SELECT DISTINCT a.*, e.razonsocial as empresa, e.id as id_empresa
        FROM temp_alumnos a, temp_empresas te, empresas e, ptemp_mat_emp pt
        WHERE pt.id_matricula = te.id_matricula
        AND pt.id_empresa = e.id
        AND a.id_empresa = te.id
        AND te.id_matricula = a.id_matricula
        AND te.cif = e.cif  AND e.id = '.$row['id_empresa'].'
        AND te.id_matricula = '.$id_mat;
      // echo $q;

      $q = mysqli_query($link, $q) or die ("error");
      $i = 1;

      while ($rows = mysqli_fetch_array($q)) { ?>
        <tr>
          <td><? echo $i++ ?></td>
          <td><? echo mb_strtoupper($rows[apellido] .' '. $rows[apellido2], 'UTF-8' ) ?></td>
          <td><? echo mb_strtoupper($rows[nombre], 'UTF-8' ) ?></td>
          <td><? echo($rows[documento]) ?></td>
          <td></td>
        </tr>
      <? }

      while ($i <= 30) { ?>
        <tr>
          <tr><td><? echo $i++ ?></td><td></td><td></td><td></td><td></td></tr>
        </tr>
      <? } ?>

    </table>

  </div>

  

  <!--  -->
  <!--  CONTROL DE ASISTENCIA TRIPARTITA: POR EMPRESA Y SESIONES. -->
  <!--  -->

<?

  // arrayText($fechasFinal);

  // if ( isRoot() )
  //   echo "<br>Llega 6";

  $nsesion = 0;
  for ($i=0; $i < count($fechasFinal); $i++)
  {

      $sesion = 0;

      // echo "fechafinal : ".$fechasFinal[$i][dia]."<br>";
      // echo "sesiones : ".$fechasFinal[$i][sesiones]."<br>";

      for ($j=0; $j < $fechasFinal[$i][sesiones]; $j++) {
          $sesion++; $nsesion++;
      ?>
      <div style="" class="controlasist page page-break">

      <div style="overflow: auto" id="cabecera">
          <!-- <div style="margin-top: 15px"><img src="../img/LogoTripartita.png" /></div> -->
          <? if ( $tipoformacionac <>'Valora' ) { ?>
          <div style="float:left;margin-right: 10px;"><img height="60px;" src="../img/logo.png" /></div><? } else { ?>
         <div style="float:left;margin-right: 10px;"><img height="60px;" src="../img/Grupo-Valora.png" /></div><? } ?>
        <div style="margin-top: 40px; margin-left: 85px; float:left"><h2 style="text-align:center;">CONTROL DE ASISTENCIA</h2></div>
      </div>

      <div class="clearfix"></div>

      <table class="bordegris" style="margin-top: 20px; width:100%;">

          <tr>
              <td style="width:15%;">OPCIÓN A </td>
              <td>EMPRESA BONIFICADA: <? echo($row[empresa]) ?></td>
              <td>CIF: <? echo($row[cif]) ?></td>
          </tr>
          <? if ( $naccion > 22000 ) { ?>
          <tr>
              <td rowspan="2" style="width:15%;">OPCIÓN B </td>
              <td colspan="2">ENTIDAD ORGANIZADORA: <span style="font-weight:normal">EDUKA-TE SOLUTIONS, S.L.U.</span> CIF: <span style="font-weight:normal">B76757764</span> </td>
          </tr>
          <? } else { ?>
            <tr>
              <td rowspan="2" style="width:15%;">OPCIÓN B </td>
              <td colspan="2">ENTIDAD ORGANIZADORA: <span style="font-weight:normal">GRUPO VALORA CANARIAS, SL - PERFIL GRUPO DE EMPRESAS</span> CIF: <span style="font-weight:normal">B38040713</span> </td>
          </tr>
          
          <? } ?>
          <?
          if ( $naccion >= 25000 )
          echo '<tr><td colspan="2">CÓDIGO DE AGRUPACIÓN: B259530AF</td></tr>';
          else if ( $naccion >= 24000 )
          echo '<tr><td colspan="2">CÓDIGO DE AGRUPACIÓN: B245287AF</td></tr>';
          else if ( $naccion >= 23000 )
              echo '<tr><td colspan="2">CÓDIGO DE AGRUPACIÓN: B239545AC</td></tr>';
          else if ( $naccion >= 8000 )
              echo '<tr><td colspan="2">CÓDIGO DE AGRUPACIÓN: B237252AN</td></tr>';
          else if ( $gestion = "2021" )
              echo '<tr><td colspan="2">CÓDIGO DE AGRUPACIÓN: B252902AM</td></tr>';
           else if ( $gestion = "2020" )
              echo '<tr><td colspan="2">CÓDIGO DE AGRUPACIÓN: B237252AN</td></tr>';
          else
              echo '<tr><td colspan="2">CÓDIGO DE AGRUPACIÓN: B206337AC</td></tr>';

          ?>

          <!-- <tr><td colspan="2">CÓDIGO DE AGRUPACIÓN: B160251AA</td></tr> -->
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
        if ( $estado == 'Finalizada' || $estado == 'Facturada')
          $q = 'SELECT DISTINCT  a.nombre, a.apellido, a.apellido2, a.documento
          FROM mat_alu_cta_emp ma, alumnos a, empresas e
          WHERE ma.id_alumno = a.id
          AND ma.finalizado = 1
          AND ma.id_empresa = e.id
          AND e.id = '.$row[id].'
          AND ma.id_matricula = '.$id_mat;
        else
          $q = 'SELECT DISTINCT a.*, e.razonsocial as empresa, e.id as id_empresa
        FROM temp_alumnos a, temp_empresas te, empresas e, ptemp_mat_emp pt
        WHERE pt.id_matricula = te.id_matricula
        AND pt.id_empresa = e.id
        AND a.id_empresa = te.id
        AND te.id_matricula = a.id_matricula
        AND te.cif = e.cif  AND e.id = '.$row['id_empresa'].'
        AND te.id_matricula = '.$id_mat;

        // echo $q;
        $q = mysqli_query($link, $q) or die ("error");
        $k = 1;

        while ($rows = mysqli_fetch_array($q)) { ?>
          <tr><td><span style="margin-right:3px; color:#bbb"><? echo $k++ .'</span> '. mb_strtoupper($rows[apellido] .' '. $rows[apellido2], 'UTF-8') ?></td><td><? echo mb_strtoupper($rows[nombre], 'UTF-8') ?></td><td><? echo($rows[documento]) ?></td><td></td><td></td></tr>
        <?  }

        while ($k <= 30) { ?>
          <tr><td><span style="margin-right:3px; color:#bbb"><? echo $k++ .'</span> '?></td><td></td><td></td><td></td><td></td></tr>
        <? } ?>


      </table>

      </div>

<?
  }
}
?>
  <!--  -->
  <!--  CONTROL DE ASISTENCIA TPC: POR EMPRESA Y SESIONES. -->
  <!--  -->

<?
  // if ( isRoot() )
  //   echo "<br>llega 7";
  // print_r($fechasFinal);
if (strpos($denominacion, "TPC")  ){
  for ($i=0; $i < count($fechasFinal); $i++)
  {
?>
    <div style="" class="controlasistTPC page page-break">

    <div style="overflow: auto" id="cabecera">
        <div style="margin-top: 35px;"><h4 style="text-align:center;">CENTRO DE IMPARTICIÓN: ISLAS PREVENCIÓN Y SEGURIDAD EN LA EMPRESA</h4></div>
        <div style="margin-top: 20px; float:none"><h4 style="text-align:center;">CONTROL DE ASISTENCIA</h4></div>
    </div>

    <div class="clearfix"></div>

    <table class="bordegrisTPC" style="margin-top: 20px; width:100%;">
      <tr>
        <td style="width:20%;">NOMBRE DEL CURSO: </td>
        <td style="width:80%;" colspan="5"><? echo ($denominacion) ?></td>
      </tr>
      <tr >
        <td style="width:20%;">CÓDIGO DEL CURSO: </td>
        <td style="width:10%;">XXXXX</td>
        <td style="width:10%;">LOCALIDAD DE IMPARTICIÓN:</td>
        <td style="width:60%;" colspan="3"><? echo ($localidad)?></td>
      </tr>
      <tr>
        <td style="width:20%;">C.P.:</td>
        <td style="width:10%;"><? echo ($codpostal) ?></td>
        <td style="width:10%;">PROVINCIA:</td>
        <td style="width:60%;" colspan="3"><? echo ($provincia)?></td>
      </tr>
      <tr>
        <td style="width:20%;">PROFESOR/PROFESORES: </td>
        <td style="width:80%;" colspan="5"><? echo $docente ?></td>
      </tr>
      <tr>
        <td style="width:20%;">FECHA: </td>
        <td style="width:10%;">
<?
        echo(date("d/m/Y", strtotime($fechasFinal[$i][dia]))."</td>");
        echo("<td style='width:10%;'>HORARIO:</td>");
        echo("<td style='width:40%;' colspan='3'>".$fechasFinal[$i][horario]."</td>");
?>
      </tr>
    </table>

    <div class="clearfix"></div>

    <table class="bordegrisTPC" style="width:100%; margin-top: 25px;" >
      <tr>
        <th colspan="2" style="height:50px;">ALUMNOS (Apellidos y Nombre)</th>
        <th>DNI / NIE</th>
        <th>FIRMA DE ASISTENCIA</th>
        <th>OBSERVACIONES<sup>1<sup></th>
      </tr>
<?
      $k = 1;
      if ($row[id]){
        if ( $estado == 'Finalizada' || $estado == 'Facturada') {
          $q = 'SELECT DISTINCT  a.nombre, a.apellido, a.apellido2, a.documento
            FROM mat_alu_cta_emp ma, alumnos a, empresas e
            WHERE ma.id_alumno = a.id
            AND ma.finalizado = 1
            AND ma.id_empresa = e.id
            AND e.id = '.$row[id].'
            AND ma.id_matricula = '.$id_mat;
        } else {
            $q = 'SELECT DISTINCT a.*
            FROM temp_alumnos a, temp_empresas te, empresas e, ptemp_mat_emp pt
            WHERE pt.id_matricula = te.id_matricula
            AND pt.id_empresa = e.id
            AND a.id_empresa = te.id
            AND te.id_matricula = a.id_matricula
            AND te.cif = e.cif  AND e.id = '.$row['id_empresa'].'
            AND te.id_matricula = '.$id_mat;
        }

        // echo $q;
        $q = mysqli_query($link, $q) or die ("error");

        while ($rows = mysqli_fetch_array($q)) {
?>
          <tr>
            <td colspan="2"><span style="margin-right:3px; color:#bbb"><? echo $k++ .'.</span> '. mb_strtoupper($rows[apellido].' '.$rows[apellido2].', '.$rows[nombre], 'UTF-8') ?></td>
            <td><? echo($rows[documento]) ?></td>
            <td></td>
            <td></td>
          </tr>
        <?  }
      }

      while ($k <= 30) { ?>
        <tr>
          <td colspan="2"><span style="margin-right:3px; color:#bbb"><? echo $k++ .'.</span> '?></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
      <? } ?>
    </table>

    <table class="bordegrisTPC" style="width:100%; margin-top: 25px;" >
      <tr>
        <td style="width:35%; height:70px; vertical-align:text-top">FIRMA PROFESOR/PROFESORES:</td>
        <td style="width:65%;"></td>
      </tr>
    </table>

    <div style="border-top:1px solid black; margin-top: 25px;" id="notapie3">
        <p style="margin-top:2px; font-size: 9px"><sub style="vertical-align:super">1</sub> En la última sesión del curso realizado se deberá reflejar el resultado de aprovechamiento del mismo, indicando la calificación de
        <span style="margin-right:3px;">APTO /NO APTO</span>, conforme los criterios de evaluación fijados para el curso.</p>
    </div>
  </div>

<?}
  }
}

?>
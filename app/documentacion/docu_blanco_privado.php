
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
    width: 31.14cm;
    height: 21cm;
    padding: 10px 15px;
    page-break-after: always;
}


@page {
    size: landscape;
    margin: 0;

}

th, td { padding: 5px; }
table { font-size: 11px; border-collapse: collapse; }
td {border: 1px solid #87be5e; height: 20px;}
th {border: 3px solid #87be5e}

table.sinborde td { border: 0px; }

table.bordegris td { border: 1px solid #ccc; padding-top: 2px; }
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

// print_r($dias_formacion);
$fechas = $dias_formacion;
$fechas = array_values($fechas);
// print_r($fechas);
$dias = sizeof($dias_formacion);
// echo $dias;
$sql = 'SELECT e.id, e.razonsocial, e.cif
  FROM ptemp_mat_emp te, empresas e, matriculas m
  WHERE e.id = te.id_empresa
  AND m.id = te.id_matricula
  AND m.id = '.$id_mat;
$sql = mysqli_query($link, $sql) or die ("error2");
//$nrows = mysqli_num_rows($sql);

$c = 0;
// if ( $dias > 2 ) {

$diasProx = $dias;
// $diasProx = 7;
  // $dias = 2;

// }


if ( $diasProx > 0 ) {

  if ( $diasProx % 4 == 0 ) {
    if ( $diasProx == 4 )
      $hojas = 1;
    else
      $hojas = ($diasProx / 4);
  } else
    $hojas = ($diasProx / 4);

  $hojas = round($hojas, PHP_ROUND_HALF_UP);

}

// $hojas = 2;
// echo $hojas;
for ($k=0; $k < $hojas; $k++) {

  if ( $diasProx < 4 )
    $camposPorHoja = $diasProx;
  else {
    $diasProx = $diasProx - 4;
    $camposPorHoja = 4;
  }


?>

<div style="" class="privado page">
    <div style="overflow: auto; margin-top: 20px" id="cabecera">
        <div style="float:left"><img height="90px;" src="../img/logo.png" /></div>
        <div style="margin-top: 30px; margin-left: 100px; float:left"><h3 style="text-align:center;"><? echo($denominacion) ?></h3></div>
    </div>

    <div style="padding:0px 5px; text-align:center; margin-top: 15px; font-size: 12px; overflow: auto;">
        <p style="float:left; margin-left: 250px;">EMPRESA: </p> <p style="margin-left: 310px; float:left">CIF: </p>
        <p style="margin-left: 100px; float:left">FECHA: Del <strong> <? echo(date("d/m/Y", strtotime($fechaini))); ?> </strong> Al <strong><? echo(date("d/m/Y", strtotime($fechafin))); ?> </strong></p>
    </div>


    <table style="width:100%; margin-top: 5px;" >

      <th style="width: 5px;">Nº</th>
      <th style="width:20%">APELLIDOS</th>
      <th style="width:20%">NOMBRE</th>
      <th style="width:10%">NIF</th>
      <th style="width:10%">FIRMA Mat.</th>
      <th style="width:10%">FIRMA Cert.</th>

      <?
      for ($j=0; $j < $camposPorHoja; $j++) {
          $dia = $j+1;
          echo '<th style="">FIRMA Asist. '."<br>".date("d/m/Y", strtotime($fechas[$c])).'</th>';
          $c++;
      }

      for ($i=0; $i < 25 ; $i++) { ?>
        <tr><td><? echo $i+1 ?></td><td></td><td></td><td></td><td></td><td></td>
        <? for ($j=0; $j < $camposPorHoja; $j++) {
          echo '<td style=""></td>';
        } ?>
        </tr>
      <? } ?>


    </table>
</div>

<? } ?>



<div style="" class="justficert page page-break">

    <div style="overflow: auto" id="cabecera">
        <div style="margin-top: 50px; float:none"><h2 style="text-align:center;">DATOS DE CONTACTO</h2></div>
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
      <th style="width: 20%;">NOMBRE</th>
      <th style="width: 15%;">NIF</th>
      <th style="width: 15%;">TELEFONO</th>
      <th>EMAIL</th>

      <?


      $i = 1;


      while ($i <= 25) { ?>
        <tr><td><? echo $i++ ?></td><td></td><td></td><td></td><td></td><td></td></tr>
      <? } ?>

    </table>


</div>



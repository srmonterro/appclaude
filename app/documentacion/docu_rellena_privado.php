
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
    width: 30.5cm;
    height: 21.5cm;
    padding: 10px 15px;
    page-break-after: always;
}


@page {
    size: landscape;
    margin: 0;

}

.salto-pagina {
  page-break-after: always;
}


th, td { padding: 5px;     font-size: 9px !important;
 }
table { font-size: 11px; border-collapse: collapse; }
td {border: 1px solid #87BE5E; height: 20px;}
th {border: 3px solid #87BE5E}

table.sinborde td { border: 0px; }

table.bordegris td { border: 1px solid #ccc; padding-top: 2px; }
table.bordegris th { border: 1px solid #ccc}

table.bordegris { border: 3px solid #ccc; color: #1B0085; font-weight: bold;}

.controlasist {
    color: #1B0085;
}

</style>

<?

// echo "asd";
include_once '../functions/funciones.php';

setlocale(LC_TIME, 'es_ES');

$id_mat = $_GET['id_matricula'];

$sql = 'SELECT DISTINCT a.numeroaccion, a.denominacion, a.horastotales, a.modalidad, ga.ngrupo,
    m.fechaini, m.fechafin, m.horariomini, m.horariomfin, m.horariotini, m.horariotfin, m.diascheck, m.estado
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
        $estado = $row[estado];
    }
    // echo $estado;

$fechasmt = array();
$fechasmt = createDateRangeArray($fechaini,$fechafin);
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

if ( $estado == 'Finalizada' || $estado == 'Facturada' || $estado == 'Gratuita' )
  $sql = 'SELECT DISTINCT e.*
  FROM mat_alu_cta_emp ma, empresas e
  WHERE ma.id_empresa = e.id
  AND ma.finalizado = 1
  AND ma.tipo = "Privado"
  AND ma.id_matricula = '.$id_mat;
else
  $sql = 'SELECT DISTINCT te.id, te.razonsocial, te.cif
  FROM temp_empresasp te
  WHERE te.id_matricula = '.$id_mat;

// echo $sql;
$sql = mysqli_query($link, $sql) or die ("error2". mysqli_error($link));
//$nrows = mysqli_num_rows($sql);

while ($row = mysqli_fetch_assoc($sql)) {
    ?>

<div style="" class="privado page">

    <div style="overflow: auto; margin-top: 20px" id="cabecera">
        <div style="float:left"><img height="75px;" src="../img/logo.png" /></div>
        <div style="margin-top: 20px; text-align:center; margin-left: 0px; float:left">
        <h4 style="text-align:center;"><? echo($naccion.'/'.$ngrupo.': '.$denominacion) ?></h4></div>
    </div>

    <div style="padding:0px 5px; text-align:center; margin-top: 15px; font-size: 12px;">

        EMPRESA: <strong><? echo $row[razonsocial]; ?></strong> | CIF: <strong><? echo $row[cif]; ?></strong> |
        FECHA: Del <strong> <? echo(date("d/m/Y", strtotime($fechaini))); ?> </strong> Al <strong><? echo(date("d/m/Y", strtotime($fechafin))); ?> </strong>

    </div>


    <table style="width:100%; margin-top: 5px;" >

      <th style="width: 5px;">Nº</th>
      <th>APELLIDOS</th>
      <th>NOMBRE</th>
      <th>NIF</th>
      <th style="width:15%">FIRMA Mat.</th>
      <th style="width:15%">FIRMA Cert.</th>

      <?
      for ($j=0; $j < $dias; $j++) {
          $dia = $j+1;
          echo '<th style="width:15%">FIRMA Asist. Día <br>'.date("d/m/Y", strtotime($fechas[$j])).'</th>';
      }


      if ( $estado == 'Finalizada' || $estado == 'Facturada' || $estado == 'Gratuita' )
        $q = 'SELECT DISTINCT a.nombre, a.apellido, a.apellido2, a.documento
        FROM mat_alu_cta_emp ma, alumnos a, empresas e
        WHERE ma.id_alumno = a.id
        AND ma.finalizado = 1
        AND ma.id_empresa = e.id
        AND e.id = '.$row[id].'
        AND ma.id_matricula = '.$id_mat;
      else
        $q = 'SELECT DISTINCT a.nombre, a.apellido, a.apellido2, a.documento
        FROM temp_alumnosp a, temp_empresasp te
        WHERE te.id = a.id_empresa
        AND te.id = '.$row[id].'
        AND te.id_matricula = '.$id_mat.'
        AND te.id_matricula = a.id_matricula';
      //echo $q;

      $q = mysqli_query($link, $q) or die("error3" . mysqli_error($link));

      $i = 0;
      while ($r = mysqli_fetch_assoc($q)) { ?>
        <tr><td><? echo ($i+1) ?></td><td><? echo ($r[apellido].' '.$r[apellido2]) ?></td><td><? echo $r[nombre] ?></td><td><? echo $r[documento] ?></td><td style="width:15%"></td><td style="width:15%"></td>

        <? for ($j=0; $j < $dias; $j++) {
          echo '<td style="width:15%"></td>';
        } ?>

        </tr> <?
        $i++;

        if ( $i % 30 == 0 ) {  ?>

          </table>
        </div>

        <div style="" class="privado page">

          <div style="overflow: auto; margin-top: 20px" id="cabecera">
          <div style="float:left"><img height="90px;" src="../img/logo.png" /></div>
          <div style="margin-top: 45px; margin-left: 100px; float:left"><h2 style="text-align:center;"><? echo($denominacion) ?></h2></div>
          </div>

          <div style="padding:0px 5px; text-align:center; margin-top: 15px; font-size: 12px;">

              EMPRESA: <strong><? echo $row[razonsocial]; ?></strong> | CIF: <strong><? echo $row[cif]; ?></strong> |
              FECHA: Del <strong> <? echo(date("d/m/Y", strtotime($fechaini))); ?> </strong> Al <strong><? echo(date("d/m/Y", strtotime($fechafin))); ?> </strong>

          </div>
          <table style="width:100%; margin-top: 5px;" >

          <th style="width: 5px;">Nº</th>
          <th>APELLIDOS</th>
          <th>NOMBRE</th>
          <th>NIF</th>
          <th style="width:15%">FIRMA Mat.</th>
          <th style="width:15%">FIRMA Cert.</th>

          <?
          for ($j=0; $j < $dias; $j++) {
            $dia = $j+1;
            echo '<th style="width:15%">FIRMA Asist. Día '.date("d/m/Y", strtotime($fechas[$j])).'</th>';
          } ?>

     <? }


      }


      $i++;
      while ($i <= 30) { ?>
        <tr><td><? echo $i++ ?></td><td></td><td></td><td></td><td></td><td></td>

        <? for ($j=0; $j < $dias; $j++) {
          echo '<td style="width:15%"></td>';
        } ?>

        </tr>
      <? } ?>

    </table>
    </div>
    <div style="margin-top:15px" class="privado page page-break">

        <div style="overflow: auto; margin-top: 20px" id="cabecera">
          <div style="float:left"><img height="90px;" src="../img/logo.png" /></div>
          <div style="margin-top: 25px; margin-left: 0px; float:left">
          <h4 style="text-align:center;"><? echo($denominacion). '<br> DATOS DE CONTACTO' ?></h4></div>
        </div>


        <div class="clearfix"></div>

        <div style="padding:0px 5px; text-align:center; margin-top: 10px; font-size: 12px;">

            EMPRESA: <strong><? echo $row[razonsocial]; ?></strong> | CIF: <strong><? echo $row[cif]; ?></strong> |
            FECHA: Del <strong> <? echo(date("d/m/Y", strtotime($fechaini))); ?> </strong> Al <strong><? echo(date("d/m/Y", strtotime($fechafin))); ?> </strong>

        </div>

        <table style="width:100%;font-size:11px; margin-top: 5px;" >

          <th style="width: 5px;">Nº</th>
          <th style="width: 20%;">APELLIDOS</th>
          <th style="width: 15%;">NOMBRE</th>
          <th style="width: 10%;">NIF</th>
          <th style="width: 13%;">TELEFONO</th>
          <th>EMAIL</th>

          <?

          if ( $estado == 'Finalizada' || $estado == 'Facturada')
            $q = 'SELECT DISTINCT a.nombre, a.apellido, a.apellido2, a.documento, a.email, a.telefono
            FROM mat_alu_cta_emp ma, alumnos a, empresas e
            WHERE ma.id_alumno = a.id
            AND ma.finalizado = 1
            AND ma.id_empresa = e.id
            AND e.id = '.$row[id].'
            AND ma.id_matricula = '.$id_mat;
          else
            $q = 'SELECT a.nombre, a.apellido, a.apellido2, a.documento, a.email, a.telefono
            FROM temp_alumnosp a, temp_empresasp te
            WHERE a.id_empresa = te.id
            AND te.id_matricula = a.id_matricula
            AND te.id = '.$row[id].'
            AND te.id_matricula = '.$id_mat;

          // echo $q;

          $q = mysqli_query($link, $q) or die ("error");
          $i = 1;

          while ($rows = mysqli_fetch_array($q)) { ?>
            <tr><td><? echo $i++; ?></td><td><? echo mb_strtoupper($rows[apellido] .' '. $rows[apellido2],'UTF-8')  ?></td><td><? echo mb_strtoupper($rows[nombre], 'UTF-8') ?></td><td><? echo($rows[documento]) ?></td><td><? if ( $rows[telefono] != 0 ) echo $rows[telefono]; ?></td><td><? echo($rows[email]) ?></td></td></tr>

            <? if ( $i % 31 == 0) {

                  echo '</table></div>';
                  echo '<div style="margin-top:15px" class="privado page page-break">

                  <div style="overflow: auto; margin-top: 20px" id="cabecera">
                    <div style="float:left"><img height="90px;" src="../img/logo.png" /></div>
                    <div style="margin-top: 45px; margin-left: 100px; float:left"><h3 style="text-align:center;">'. ($denominacion). ' - DATOS DE CONTACTO </h3></div>
                  </div>


                  <div class="clearfix"></div>

                  <div style="padding:0px 5px; text-align:center; margin-top: 10px; font-size: 12px;">

                      EMPRESA: <strong>'. $row[razonsocial] .'</strong> | CIF: <strong>'.  $row[cif] .'</strong> |
                      FECHA: Del <strong> '. (date("d/m/Y", strtotime($fechaini))) .' </strong> Al <strong>'. (date("d/m/Y", strtotime($fechafin))) .' </strong>

                  </div>

                  <table style="width:100%;font-size:11px; margin-top: 5px;" >

                    <th style="width: 5px;">Nº</th>
                    <th style="width: 20%;">APELLIDOS</th>
                    <th style="width: 15%;">NOMBRE</th>
                    <th style="width: 10%;">NIF</th>
                    <th style="width: 13%;">TELEFONO</th>
                    <th>EMAIL</th>';

              } ?>
          <? }

          while ($i <= 30) { ?>
            <tr><td><? echo $i++ ?></td><td></td><td></td><td></td><td></td><td></td></tr>
          <? } ?>

        </table>


    </div>



</div> <? } ?>
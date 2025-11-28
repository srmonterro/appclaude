<?php

$baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
require_once($baseurl."/plugins/remesas/SEPASDD.php");
include ($baseurl.'/functions/funciones.php');



$tele = "Teleformación ";
$config_esfocc = array(
  "name" => "ESCUELA SUPERIOR DE FORMACIÓN Y CUALIFICACIÓN, S.L.U.",
  //"IBAN" => "ES7201820772430101506704",
  "IBAN" => "ES6001820772420201668490",
                //"BIC" => "BANKNL2A", <- Optional, banks may disallow BIC in future
  "batch" => True,
  "creditor_id" => "ES06000B76567718",
  "currency" => "EUR",
  "version" => "2"
  );
$config = $config_esfocc;



$SEPASDD = new SEPASDD($config);
// arrayText($SEPASDD);

// // arrayText($_POST);s

// if ( $_POST['bonificado'] == "Bonificado" ) {

//   $q = 'SELECT e.razonsocial, e.iban, f.total_factura, f.fecha, e.id as id_empresa, f.mes, f.anio, f.numero, f.numero
//   FROM facturacion_bonificada f, empresas e, mat_alu_cta_emp ma
//   WHERE e.id = ma.id_empresa
//   AND f.id_empresa = ma.id_empresa
//   AND e.formapago = "Remesa"
//   AND f.estado NOT IN("Anulada", "Rectificada")';

// } else {

//   $q = 'SELECT e.razonsocial, e.iban, f.total_factura, f.fecha_fra, e.id as id_empresa, f.mes, f.anio, f.numero, f.numero
//   FROM facturacion_tele f, empresas e, contratos c
//   WHERE e.id = c.id_empresa
//   AND c.id = f.id_contrato
//   AND e.formapago = "Remesa"
//   AND f.estado NOT IN("Anulada")
//   AND f.prefijo = "CF"
//   AND mes = "'.$_POST[mes].'"
//   UNION
//   SELECT e.razonsocial, e.iban, f.total_factura, f.fecha_fra, e.id as id_empresa, f.mes, f.anio, f.numero, f.numero
//   FROM facturacion_tele f, empresas e
//   WHERE e.id = f.id_empresa
//   AND e.formapago = "Remesa"
//   AND f.estado NOT IN("Anulada")
//   AND f.prefijo = "CF"
//   AND mes = "'.$_POST[mes].'"
//   AND grupal= "Si"';

// }
// // echo $q;
// $q = mysqli_query($link, $q) or die("error" . mysqli_error($link));

// $q = $_POST['sql'];
// // echo $q;
// $q = mysqli_query($link, $q) or die("error select : " .mysqli_error($link));

$ccc = array();
while ( $row = mysqli_fetch_assoc($q) ) {

    $i++;

    // arrayText($row);

    if ( $row['formapago'] == "Remesa" ) {

      // $row[total_factura] = str_replace('.', '', $row[total_factura]);
      $row[total_factura] = number_format($row[total_factura],2,'','');
      $row[iban] = mb_strtoupper(str_replace(' ', '', $row[iban]));
      $row[iban] = trim(str_replace('-', '', $row[iban]));

      // echo "entra";
      // echo "<br>Razon social: ".$row[razonsocial]."<br>";
      // echo "<br>IBAN: ".$row[iban]."<br>";
      // echo "<br>total: ".$row[total_factura]."<br>";
      // $row[total_factura] = intval($row[total_factura]);
      // print_r($row);
      if ( strpos($row[iban], 'ES') === false && $row[iban] != "" ) {
          $ccc[$i][id_empresa] = $row[id_empresa];
          $ccc[$i][ccc] = $row[iban];
          $ccc[$i][valido_ccc] = $r = ccc_valido($row[iban]);
          $ccc[$i][iban] = $r = calcularIBAN("ES",$row[iban]);
      }

  //     $i++;
  //     echo "etra";
      $payment[name] = $row[razonsocial];

      if ( strpos($row[iban], 'ES') === false && $row[iban] != "" )
          $payment[IBAN] = calcularIBAN("ES",$row[iban]);
      else
          $payment[IBAN] = $row[iban];

      if ( validateIBAN($payment[IBAN]) ) {
        echo "<br>OK<br>";
      } else {
        echo "<br>Razon social: ".$row[razonsocial]."<br>";
        echo "<br>IBAN: ".$row[iban]."<br>";
        echo "<br>total: ".$row[total_factura]."<br>";
      }

      // $payment[amount] = $row[total_factura];
      // $payment[type] = "RCUR";
      // $payment[collection_date] = "2017-03-01";
      // $payment[mandate_id] = $row['numero'];
      // $payment[mandate_date] = $row['fecha'];
      // $payment[description] = 'cobro fra. '.$row['numero'].'/'.$row['anio'].' impartición formación';

      // // arrayText($payment);

      // try {
      //     $SEPASDD->addPayment($payment);
      // } catch(Exception $e){
      //     //echo 'try';
      //     echo $e->getMessage();
      //     exit;
      // }

    }


}

// arrayText($payment);



// $SEPASDD->save();

echo 'remesa.xml';

// actualizaDB($_POST['mes'], $_POST['entidad'], $config, $link);



function actualizaDB($mes, $entidad, $config, $link){

    if ( $entidad == 'ESFOC' ) {
        $tabla = 'facturacion';
    } else {
        $tabla = 'facturacion_tele';
    }

    // UPDATE INDIVIDUALES:

    //echo 'actualizaDB';
    $qI = 'UPDATE '.$tabla.' AS f
    INNER JOIN contratos AS c ON c.id = f.id_contrato
    INNER JOIN empresas AS e ON e.id = c.id_empresa
    SET f.cobrado = f.total_factura, f.pendiente = 0, f.estado = "Pagada"
    WHERE f.mes = "'.$mes.'" AND e.formapago = "Remesa" AND f.estado <> "Anulada"';

    // echo $qI."<br>";

    $qI = mysqli_query($link, $qI) or die('error');

    //UPDATE GRUPALES:

    $qG = 'UPDATE '.$tabla.' AS f
    INNER JOIN empresas AS e ON e.id = f.id_empresa
    SET f.cobrado = f.total_factura, f.pendiente = 0, f.estado = "Pagada"
    WHERE f.mes = "'.$mes.'" AND e.formapago = "Remesa" AND f.grupal = "Si" AND f.estado <> "Anulada"';

    // echo $qG."<br>";

    $qG = mysqli_query($link, $qG) or die('error');


    $q = 'SELECT f.id, f.total_factura
    FROM '.$tabla.' f
    INNER JOIN contratos AS c ON c.id = f.id_contrato
    INNER JOIN empresas AS e ON e.id = c.id_empresa
    WHERE f.mes = "'.$mes.'" AND e.formapago = "Remesa"
    UNION
    SELECT f.id, f.total_factura
    FROM '.$tabla.' f
    INNER JOIN empresas AS e ON e.id = f.id_empresa
    WHERE f.mes = "'.$mes.'" AND e.formapago = "Remesa"';
    $q = mysqli_query($link, $q) or die("error select : " .mysqli_error($link));

    while ( $row = mysqli_fetch_assoc($q) ) {

         $qx = 'INSERT IGNORE INTO conciliaciones (fecha, cobrado, observaciones, factura, entidad)
        VALUES ( "'.date('Y-m-d').'", "'.$row['total_factura'].'", "Conciliación remesa '.$entidad.' mes '.$mes.'  - Cuenta BBVA: '.substr( $config['IBAN'], -4 ).'", "'.$row['id'].'",  "'.$entidad.'" )';
        // echo $qx."<br>";
        $qx = mysqli_query($link, $qx) or die("error select : " .mysqli_error($link));

    }

}

?>
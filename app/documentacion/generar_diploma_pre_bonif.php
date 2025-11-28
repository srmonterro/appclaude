
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="/app/css/fonts.css" type="text/css" charset="utf-8">
    <link rel="stylesheet" href="/app/css/edukate.css" type="text/css" charset="utf-8">
</head>


<style>

    * {
        margin:0;
        padding:0;
        /*font-family: 'Conv_estre',Sans-Serif;*/
        font-family: "Avenir" !important;
    }

    body {
        width: 30.8cm;
        height: 21.7cm;
    }
    .page {
        position: relative;
        width: 21cm;
        height: 29.7cm;
        padding: 15px 30px;
    }
    .page-hor {
        position: relative;
        width: 28.5cm;
        height: 21.7cm;
    }

    .front_bonif_tpc {
        overflow: auto;
        position: relative;
        display: block;
        background-image: url('../img/diplomas/dipfront_tpc.png');
        background-repeat:no-repeat;
        background-size: 30.8cm 21.7cm ;
        width: 100%;
        height: 100%;
        page-break-after: always;
    }

    .front_bonif_ikea {
        overflow: auto;
        position: relative;
        display: block;
        background-image: url('../img/diplomas/dipfront_bonif_ikea.png');
        background-repeat:no-repeat;
        background-size: 30.8cm 21.7cm ;
        width: 100%;
        height: 100%;
        page-break-after: always;
    }
    .front_bonif {
        overflow: auto;
        position: relative;
        display: block;
         /*background-image: url('../img/diplomas/dipfront_bonif.png');*/
        background-image: url('../img/diplomas/dipfront.png');
        background-repeat:no-repeat;
        background-size: 30.8cm 21.7cm ;
        width: 100%;
        height: 100%;
        page-break-after: always;
    }

    .front_bonif_incen1 {
        overflow: auto;
        position: relative;
        display: block;
        background-image: url('../img/diplomas/dipfront_bonif_incen1.png');
        background-repeat:no-repeat;
        background-size: 30.8cm 21.7cm ;
        width: 100%;
        height: 100%;
        page-break-after: always;
    }

    .front_bonif_incen2 {
        overflow: auto;
        position: relative;
        display: block;
        background-image: url('../img/diplomas/dipfront_bonif_incen2.png');
        background-repeat:no-repeat;
        background-size: 30.8cm 21.7cm ;
        width: 100%;
        height: 100%;
        page-break-after: always;
    }

/*.front_bonif_incen_1001 {
    overflow: auto;
    position: relative;
    display: block;
    background-image: url('../img/diplomas/dipfront_bonif_incen_1001.png');
    background-repeat:no-repeat;
    background-size: 30.8cm 21.7cm ;
    width: 100%;
    height: 100%;
    page-break-after: always;
}

.front_nobonif_incen_1001 {
    overflow: auto;
    position: relative;
    display: block;
    background-image: url('../img/diplomas/dipfront_nobonif_incen_1001.png');
    background-repeat:no-repeat;
    background-size: 30.8cm 21.7cm ;
    width: 100%;
    height: 100%;
    page-break-after: always;
}*/


.back {
    overflow: auto;
    position: relative;
    display: block;
    /*background-image: url('../img/diplomas/diploma_atras.png');*/
    background-image: url('../img/diplomas/dip_tras.png');
    background-repeat:no-repeat;
    background-size: 30.8cm 21.7cm ;
    width: 100%;
    height: 100%;
    page-break-after: always;
    -webkit-transform: rotate(180deg);
}

.back_ikea {
    overflow: auto;
    position: relative;
    display: block;
    background-image: url('../img/diplomas/diploma_atras_ikea.png');
    background-repeat:no-repeat;
    background-size: 30.8cm 21.7cm ;
    width: 100%;
    height: 100%;
    page-break-after: always;
    -webkit-transform: rotate(180deg);
}

.contenidotxt {
    width: 860px;
    height: 560px;
    position: absolute;
    margin: 100px 0px 0px 100px;

}

.prueba {
    border: 1px solid red;
    line-height: auto;
    width: 20px;
    height: 30px;

}


.doscolumnas {
    -moz-column-count: 2;
    -moz-column-gap: 1em;
    -webkit-column-count: 2;
    -webkit-column-gap: 1em;
}

.trescolumnas {
    -moz-column-count: 3;
    -moz-column-gap: 1em;
    -webkit-column-count: 3;
    -webkit-column-gap: 1em;
}

.cuatrocolumnas {
    -moz-column-count: 4;
    -moz-column-gap: 1em;
    -webkit-column-count: 4;
    -webkit-column-gap: 1em;
}
.cincocolumnas {
    -moz-column-count: 5;
    -moz-column-gap: 1em;
    -webkit-column-count: 5;
    -webkit-column-gap: 1em;
}
.seiscolumnas {
    -moz-column-count: 6;
    -moz-column-gap: 1em;
    -webkit-column-count: 6;
    -webkit-column-gap: 1em;
}


@page {
    size: landscape;
    margin: 0;
}


.alumno {
    position: relative;
    text-align: justify;
    top: 220px;
    margin-left: 100px;
    margin-right: 150px;
    font-size: 20px;
    line-height : 32px;
}
.alumno2 {
    position: relative;
    text-align: justify;
    top: 350px;
    margin-left: 100px;
    margin-right: 150px;
    font-size: 20px;
    line-height : 32px;
}

.nif {
    position: absolute;
    top: 292px;
    margin-left: 150px;
    font-size: 16px;
}

.cif {
   position: absolute;
    top: 315px;
    margin-left: 150px;
    font-size: 16px;
}

.af {
    position: relative;
    top: 300px;
    text-align: center;
    font-size: 22px;
}

.razonsocial {
    position: absolute;
    top: 295px;
    margin-left: 720px;
    width: 315px !important;
    font-size: 16px;
}

.denominacion {
    position: relative;
    text-align: center;
    top: 280px;
    font-weight: bold;
    font-size: 28px;
}

.duracion {
    position: absolute;
    top: 515px;
    margin-left: 240px;
    font-size: 16px;
}

.fechaini {
    position: absolute;
    top: 540px;
    margin-left: 205px;
    font-size: 16px;
}

.fechafin {
    position: absolute;
    top: 560px;
    margin-left: 245px;
    font-size: 16px;
}

.modalidad {
    position: absolute;
    top: 580px;
    margin-left: 168px;
    font-size: 16px;
}

.lugar {
    position: absolute;
    top: 543px;
    margin-left: 640px;
    font-size: 16px;
}

/*.dia {
    position: absolute;
    top: 543px;
    margin-left: 890px;
    font-size: 16px;
}*/
.dia {
    position: absolute;
    top: 630px;
    margin-left: 470px;
    font-size: 24px;
}
.mes {
    position: absolute;
    top: 543px;
    margin-left: 947px;
    font-size: 16px;
}

.anio {
    position: absolute;
    top: 543px;
    margin-left: 1050px;
    font-size: 16px;
}

.legionella {
    position: absolute;
    top: 550px;
    margin-left: 275px;
    font-size: 11px;
    text-align: center;
    width: 510px;
}

.codigo {
    position: absolute;
    top: 778px;
    margin-left: 352px;
    font-family: courier;
    font-size: 14px;
}

.titulocodigo {
    position: absolute;
    top: 780px;
    margin-left: 232px;
    font-size: 12px;
}

.urlcodigo {
    position: absolute;
    top: 780px;
    margin-left: 632px;
    font-size: 12px;
}




.tpc_alumno {
    color: hsla(235, 84%, 19%, 0.81);
    font-weight: bold;
    position: relative;
    text-align: center;
    top: 210px;
    font-size: 32px;
}

.tpc_nif {
    color: hsla(235, 84%, 19%, 0.81);
    font-weight: bold;
    position: absolute;
    top: 290px;
    margin-left: 200px;
    font-size: 16px;
}

.tpc_cif {
 color: hsla(235, 84%, 19%, 0.81);
 font-weight: bold;p
 position: absolute;
 top: 315px;
 margin-left: 150px;
 font-size: 16px;
 display: none;
}

.tpc_af {
    color: hsla(235, 84%, 19%, 0.81);
    font-weight: bold;
    position: absolute;
    top: 334px;
    margin-left: 240px;
    font-size: 16px;
}

.tpc_razonsocial {
    color: hsla(235, 84%, 19%, 0.81);
    font-weight: bold;
    position: absolute;
    top: 295px;
    margin-left: 720px;
    width: 315px !important;
    font-size: 16px;
    display: none;
}

.tpc_denominacion {
    color: hsla(235, 84%, 19%, 0.81);
    font-weight: bold;
    position: relative;
    text-align: center;
    top: 356px;
    font-size: 32px;
}

.tpc_duracion {
    color: hsla(235, 84%, 19%, 0.81);
    font-weight: bold;
    position: absolute;
    top: 540px;
    margin-left: 270px;
    font-size: 16px;
}

.tpc_fechaini {
    color: hsla(235, 84%, 19%, 0.81);
    font-weight: bold;
    position: absolute;
    top: 565px;
    margin-left: 242px;
    font-size: 16px;
}

.tpc_fechafin {
    color: hsla(235, 84%, 19%, 0.81);
    font-weight: bold;
    position: absolute;
    top: 587px;
    margin-left: 285px;
    font-size: 16px;
}

.tpc_modalidad {
    color: hsla(235, 84%, 19%, 0.81);
    font-weight: bold;
    position: absolute;
    top: 609px;
    margin-left: 215px;
    font-size: 16px;
}

.tpc_lugar {
    color: hsla(235, 84%, 19%, 0.81);
    font-weight: bold;
    position: absolute;
    top: 568px;
    margin-left: 685px;
    font-size: 16px;
}

.tpc_dia {
    color: hsla(235, 84%, 19%, 0.81);
    font-weight: bold;
    position: absolute;
    top: 568px;
    margin-left: 920px;
    font-size: 16px;
}

.tpc_mes {
    color: hsla(235, 84%, 19%, 0.81);
    font-weight: bold;
    position: absolute;
    top: 568px;
    margin-left: 971px;
    font-size: 16px;
}

.tpc_anio {
    color: hsla(235, 84%, 19%, 0.81);
    font-weight: bold;
    position: absolute;
    top: 568px;
    margin-left: 1085px;
    font-size: 16px;
}

.tpc_legionella {
    color: hsla(235, 84%, 19%, 0.81);
    font-weight: bold;
    position: absolute;
    top: 600px;
    margin-left: 275px;
    font-size: 11px;
    text-align: center;
    width: 510px;
}

.tpc_codigo {
    color: hsla(235, 84%, 19%, 0.81);
    font-weight: bold;
    position: absolute;
    top: 796px;
    margin-left: 240px;
    font-family: courier;
    font-size: 12px;
}

.tpc_titulocodigo {
    color: hsla(235, 84%, 19%, 0.81);
    font-weight: bold;
    position: absolute;
    top: 796px;
    margin-left: 132px;
    font-size: 12px;
}

.tpc_urlcodigo {
    color: hsla(235, 84%, 19%, 0.81);
    font-weight: bold;
    position: absolute;
    top: 796px;
    margin-left: 432px;
    font-size: 12px;
}

.firma_tpc {
    position: absolute;
    top: 588px;
    margin-left: 920px;
    width: 200px;
    height: 148px;
    background-image: url(../img/diplomas/firma_tpc.png);
    background-repeat: no-repeat;
    background-size: 200px 148px;
}



</style>


<?

 //echo "entra";
include_once '../functions/funciones.php';
$gestion = devuelveAnioReal();
$anio = $_GET[anio];

if ( $anio != "" )
 include_once '../functions/connect.php';

$sec = explode("?",$_SERVER['HTTP_REFERER']);
setlocale(LC_TIME, "es_ES");

$id_mat = $_GET['id_matricula'];

if ( isset($_GET['nboton']) ) {

    $nboton = $_GET['nboton'];

    $limite = 10;

    if ( $nboton == $_GET['total'] && $resto != 0 ) {
        $resto = $_GET['resto'];
        $limite = $resto;
    }

    if ( $nboton == 1 )
        $limit = ' LIMIT 0, '.$limite;
    else {
        $nboton = $nboton-1;
        $limit = ' LIMIT '.$nboton.'0, '.$limite;
    }
}

//echo "ey";
//$sql = 'SELECT DISTINCT a.numeroaccion, a.denominacion, a.horastotales, a.modalidad, ga.ngrupo, a.contenido,
//m.fechaini, m.fechafin, m.horariomini, m.horariomfin, m.horariotini, m.horariotfin, m.estado, a.incendios,a.nivel_incendios, m.id as idmat, m.grupo, m.id_solicitudikea, a.diploma, m.referencia_legio, m.fechaini_nop, m.fechafin_nop, htmldiploma, referencia_tpc
$sql = 'SELECT DISTINCT a.numeroaccion, a.denominacion, a.horastotales, a.modalidad, ga.ngrupo, a.contenido,
m.fechaini, m.fechafin, m.horariomini, m.horariomfin, m.horariotini, m.horariotfin, m.estado, a.incendios,a.nivel_incendios, m.id, m.grupo, m.id_solicitudikea, a.diploma, m.referencia_legio, m.fechaini_nop, m.fechafin_nop
FROM matriculas m, acciones a, grupos_acciones ga
WHERE m.id_accion = a.id
AND m.id_grupo = ga.id
AND m.id ='.$id_mat;
     //echo $sql;
    
$sql = mysqli_query($link, $sql) or die ("error 1". mysqli_error($link));

if ( mysqli_num_rows($sql) < 1 ) {

         //echo "e";
    $link = connectAnio(date('Y')-1);
    $sql = 'SELECT DISTINCT a.numeroaccion, a.denominacion, a.horastotales, a.modalidad, ga.ngrupo, a.contenido,
    m.fechaini, m.fechafin, m.horariomini, m.horariomfin, m.horariotini, m.horariotfin, m.estado, a.incendios,a.nivel_incendios, m.id as idmat, m.grupo, m.id_solicitudikea, a.diploma, m.referencia_legio, m.fechaini_nop, m.fechafin_nop, htmldiploma, referencia_tpc
    FROM matriculas m, acciones a, grupos_acciones ga
    WHERE m.id_accion = a.id
    AND m.id_grupo = ga.id
    AND m.id ='.$id_mat;
    $sql = mysqli_query($link, $sql) or die ("error 2". mysqli_error($link));

}

//echo "aeiou-579";
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
    $contenido = $row[htmldiploma];
    $estado = $row[estado];
    $incendios = $row[incendios];
    $nivel_incendios = $row[nivel_incendios];
    $idmat = $row[idmat];
    $grupal = $row[grupo];
    $diploma = $row[diploma];
    $ref = $row[referencia_legio];

    if ( $modalidad == "Mixta" ) {
        if ( strtotime($row[fechaini_nop]) < strtotime($row[fechaini]) )
            $fechaini = $row[fechaini_nop];
        if ( strtotime($row[fechafin_nop]) > strtotime($row[fechafin]) )
            $fechafin = $row[fechafin_nop];
    }

    if ( $row[id_solicitudikea] != 0 && $row[id_solicitudikea] != NULL )
        $ikea = 1;
    else
        $ikea = 0;
         //print_r($row);
}

$lugar = 'Costa Adeje';
//echo $lugar;
//echo $limit;
//$excluidas = array("1595","1268","1146","1229","1450");

//if ( in_array($idmat, $excluidas) ) $incendios = 0;

//if ( $mod == 'o' || ( $sec[1] == 'form_matricula_doc' || $sec[1] == 'form_matricula_doc#') ) $back = 'back_girado';
//else 
$back = 'back';
if ( $sec[1] == 'form_matricula_doc' || $sec[1] == 'form_matricula_doc#' ) $grupal = 1;


// DETERMINA QUE TIPO DE DIPLOMA ES
if ( $gestion == 2014 ) {
    if ( $naccion == '17' || $naccion == '106' ) $clase = "front_bonif_incen1";
    else if ( $naccion == '18' ) $clase = "front_bonif_incen2";
    else if ( $naccion == '1001' || $naccion == '1006' || $naccion == '1017' ) $clase = "front_bonif_incen_1001";
    else $clase = "front_bonif";

    echo $clase;
    if ( $estado == 'Finalizada' || $estado == 'Facturada' || $estado == 'Gratuita' || $grupal == 1 )
        //echo "IF";
        $sql = 'SELECT DISTINCT a.id, a.nombre,a.apellido,a.apellido2,a.documento,e.razonsocial,e.cif
        FROM mat_alu_cta_emp ma, alumnos a, empresas e
        WHERE ma.id_alumno = a.id
        AND ma.tipo = ""
        AND ma.id_matricula = '.$id_mat.'
        AND ma.id_empresa = e.id'
        .$limit;
        //$limit;
    else {
        $sql = 'SELECT a.id, a.nombre,a.apellido,a.apellido2,a.documento,e.razonsocial,e.cif
        FROM temp_alumnos a,temp_empresas e
        WHERE a.id_empresa = e.id
        AND e.id_matricula = '.$id_mat;
        //.$limit;
        //.$limit;
        
    }
    //echo $sql;
    $sql = mysqli_query($link, $sql) or die ("error 3". mysqli_error($link));
    //echo $sql;
    while ($row = mysqli_fetch_array($sql)) {

        //cgutierrez: obtener código de validación del diploma
        //if ( isRoot() ) {
            // $codigo_diploma = generarCodigos($id_mat, $row[id], $link);
        //}

        ?>

        <div class=<? echo '"'. $clase .'"'  ?> >
            <div class="alumno"><? echo $row[nombre].' '.$row[apellido].' '.$row[apellido2] ?></div>
            <div class="nif"><? echo $row[documento] ?></div>
            <div class="cif"><? echo $row[cif] ?></div>
            <div class="af"><? echo $naccion.'/'.$ngrupo ?></div>
            <div class="razonsocial"><? echo $row[razonsocial] ?></div>
            <? if ( $naccion != '17' && $naccion != '18' && $naccion != '106' ) { ?>
            <div class="denominacion"><? echo $denominacion ?></div> <? } ?>
            <div class="duracion"><? echo $horastotales.' horas' ?></div>
            <div class="fechaini"><? echo date("d/m/Y",strtotime($fechaini)) ?></div>
            <div class="fechafin"><? echo date("d/m/Y",strtotime($fechafin)) ?></div>
            <div class="modalidad"><? echo $modalidad ?></div>
            <div class="lugar"><? echo $lugar ?></div>
            <div class="dia"><? echo date("d",strtotime($fechafin)) ?></div>
            <div class="mes"><? echo ucwords(strftime("%B",strtotime($fechafin))) ?></div>
            <div class="anio"><? echo strftime("%Y",strtotime($fechafin)) ?></div>
            <? //if ( isRoot() ) { ?>
            <div class="titulocodigo"><? echo 'Código de validación: ' ?></div>
            <div class="codigo"><? echo $codigo_diploma ?></div>
            <div class="urlcodigo"><? echo 'URL de verificación: <a href="diplomas.esfocc.com">diplomas.esfocc.com</a>' ?></div>
            <? //} ?>
        </div>
        <?
        if ( $diploma == "LEGIONELLA" ) {

            echo '<div class="legionella">Programa homologado y autorizado por la Dirección General de Salud Pública del Gobierno de Canarias como entidad formadora ESCUELA SUPERIOR DE FORMACIÓN Y CUALIFICACIÓN. Fecha: 23/03/2015 No. Reg: 147/2015<br><br>
            Edición: '.$ref.' | Validez del presente certificado: 5 años | 23 horas teóricas y 7 prácticas</div>';

        } ?>


        <? }

    } else {

        $fechai = explode('-', $fechaini);
        $anio = $fechai[0];
        //echo $gestion;

        //include ('../functions/connect.php');

        //if ( $incendios == 1 ) {

            //if ( $nivel_incendios == "I" ) $clase = "front_bonif_incen1";
           // else $clase = "front_bonif_incen2";

       // } else $clase = "front_bonif";

       // if ( $naccion >= 5000 ) {
       //     $clase = 'front_bonif_ikea';
      //  }

        $clase = "front_bonif";
        //echo $clase;
        if ( $estado == 'Finalizada' || $estado == 'Facturada' || $estado == 'Gratuita' || $grupal == 1 )
            $sql = 'SELECT DISTINCT a.id, a.nombre,a.apellido,a.apellido2,a.documento,e.razonsocial,e.cif
        FROM mat_alu_cta_emp ma, alumnos a, empresas e
        WHERE ma.id_alumno = a.id
        -- AND ma.finalizado = 1
        AND ma.tipo = ""
        AND ma.id_matricula = '.$id_mat.'
        AND ma.id_empresa = e.id'
        .$limit;
        else
            $sql = 'SELECT a.id, a.nombre,a.apellido,a.apellido2,a.documento,e.razonsocial,e.cif
        FROM temp_alumnos a,temp_empresas e
        WHERE a.id_empresa = e.id
        AND e.id_matricula = '.$id_mat
        //AND e.id_matricula = a.id_matricula'
        .$limit;

    // echo $sql;
        $sql = mysqli_query($link, $sql) or die ("error 4");



        while ($row = mysqli_fetch_array($sql)) {

            //cgutierrez: obtener código de validación del diploma
            $codigo_diploma = generarCodigos($id_mat, $row[id], $link);
            //echo $codigo_diploma;

            if ( $diploma == "TPCX" ) {

             $clase = 'front_bonif_tpc';
             $clase_atras = 'back_tpc'; ?>

             <div class=<? echo '"'. $clase .'"'  ?> >
                <div class="tpc_alumno"><? echo mb_strtoupper( $row[nombre].' '.$row[apellido].' '.$row[apellido2], 'UTF-8' ) ?></div>
                <div class="tpc_nif"><? echo $row[documento] ?></div>
                <div class="tpc_cif"><? echo $row[cif] ?></div>
                <? if ($incendios != 1) { ?>
                <div class="tpc_denominacion"><? echo $denominacion ?></div><? } ?>
                <div class="tpc_af"><? echo $row['referencia_tpc'] ?></div>
                <div class="tpc_razonsocial"><? echo $row[razonsocial] ?></div>
                <div class="tpc_duracion"><? echo $horastotales.' horas' ?></div>
                <div class="tpc_fechaini"><? echo date("d/m/Y",strtotime($fechaini)) ?></div>
                <div class="tpc_fechafin"><? echo date("d/m/Y",strtotime($fechafin)) ?></div>
                <div class="tpc_modalidad"><? echo $modalidad ?></div>
                <div class="tpc_lugar"><? echo $lugar ?></div>
                <div class="tpc_dia"><? echo date("d",strtotime($fechafin)) ?></div>
                <div class="tpc_mes"><? echo ucwords(strftime("%B",strtotime($fechafin))) ?></div>
                <div class="tpc_anio"><? echo strftime("%Y",strtotime($fechafin)) ?></div>

                <div class="tpc_titulocodigo"><? echo 'Código de validación: ' ?></div>
                <div class="tpc_codigo"><? echo $codigo_diploma ?></div>
                <div class="tpc_urlcodigo"><? echo 'URL de verificación: <a href="diplomas.esfocc.com">diplomas.esfocc.com</a>' ?></div>
                <div class="firma_tpc"></div>

            </div>

            <div class="<? echo $clase_atras ?>">
             <div class="contenidotxt">
                 <div><? echo $contenido ?></div>
             </div>
         </div>

         <?

     } else {

        ?>

        <div class=<? echo '"'. $clase .'"'  ?> >
                <div class="alumno"><? echo 'D/Dña. '.$row[nombre].' '.$row[apellido].' '.$row[apellido2].'  con NIF '.$row[documento].' que presta  sus servicios en la Empresa '.$row[razonsocial].' con CIF '.$row[cif].' ha realizado la acción formativa '?>
                    
                </div>
                 <div class="denominacion"><? echo $denominacion ?></div> 
                 <div class="af"><? echo 'GRUPO '.$ngrupo.' - CÓDIGO AF '.$naccion ?></div> 
                 <div class="alumno2"><? echo 'Durante  los días  '.date("d/m/Y",strtotime($fechaini)).' al  '.date("d/m/Y",strtotime($fechafin)).' con una  duración total  de  '.$horastotales.' horas  en la modalidad formativa '.$modalidad.'.' ?>
                    
                </div>
                <!-- <div class="alumno"><? //echo $row[nombre].' '.$row[apellido].' '.$row[apellido2] ?></div>
                <div class="nif"><? //echo $row[documento] ?></div> -->
               <!--  <div class="cif"><? //echo $row[cif] ?></div> -->
                <? if ($incendios != 1) {  ?>
                <!-- <div class="denominacion"><? //echo $denominacion ?></div><? } ?>  -->
                <!-- <div class="af"><? //echo $naccion.'/'.$ngrupo ?></div> -->
                <!-- <div class="razonsocial"><? //echo $row[razonsocial] ?></div> -->
                <!-- <div class="duracion"><? //echo $horastotales.' horas' ?></div>
                <div class="fechaini"><? //echo date("d/m/Y",strtotime($fechaini)) ?></div>
                <div class="fechafin"><? //echo date("d/m/Y",strtotime($fechafin)) ?></div>
                <div class="modalidad"><? //echo $modalidad ?></div>
                <div class="lugar"><? //echo $lugar ?></div> -->
                <div class="dia"><? echo date("d/m/Y",strtotime($fechafin)) ?></div>
                <!-- <div class="mes"><? //echo ucwords(strftime("%B",strtotime($fechafin))) ?></div>
                <div class="anio"><? //echo strftime("%Y",strtotime($fechafin)) ?></div> -->
            <?
            if ( $diploma == "LEGIONELLA" ) {

                echo '<div class="legionella">Programa homologado y autorizado por la Dirección General de Salud Pública del Gobierno de Canarias como entidad formadora ESCUELA SUPERIOR DE FORMACIÓN Y CUALIFICACIÓN. Fecha: 23/03/2015 No. Reg: 147/2015<br><br>
                Edición: '.$ref.' | Validez del presente certificado: 5 años | 23 horas teóricas y 7 prácticas</div>';

            } ?> 

            <div class="titulocodigo"><? echo 'Código de validación: ' ?></div>
            <div class="codigo"><? echo $codigo_diploma ?></div>
            <!-- <div class="urlcodigo"><? //echo 'URL de verificación: <a href="diplomas.eduka-te.com">diplomas.eduka-te.com</a>' ?></div> -->
            <div class="urlcodigo"><? echo 'URL de verificación: diplomas.eduka-te.com' ?></div>
        </div>

            <? if ( $ikea == 1 ) {
                if ( $naccion >= 5000 )
                    $clase_atras = 'back_ikea';
                else
                    $clase_atras = 'back';
                ?>
                <div class="<? echo $clase_atras ?>">
                    <div class="contenidotxt">
                        <div><? echo $contenido ?></div>
                    </div>
                </div>

                <? }

            } ?>


            <? }

        } ?>

        <script type="text/javascript">
            window.print();
        </script>


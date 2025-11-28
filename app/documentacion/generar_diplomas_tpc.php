
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="/app/css/fonts.css" type="text/css" charset="utf-8">
    <link rel="stylesheet" href="/app/css/esfocc.css" type="text/css" charset="utf-8">
</head>


<?

include('../functions/funciones.php');


?>

<style>

    * {
        margin:0;
        padding:0;
        font-family: 'Conv_estre',Sans-Serif;
        color:hsla(235, 84%, 19%, 0.81);
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
        background-image: url('../img/diplomas/dipfront_bonif.png');
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
    background-image: url('../img/diplomas/diploma_atras.png');
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
    margin: 150px 0px 0px 100px;

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
    text-align: center;
    top: 210px;
    font-size: 32px;
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
    position: absolute;
    top: 338px;
    margin-left: 215px;
    font-size: 16px;
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
    top: 356px;
    font-size: 32px;
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

.dia {
    position: absolute;
    top: 543px;
    margin-left: 890px;
    font-size: 16px;
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
    top: 600px;
    margin-left: 275px;
    font-size: 11px;
    text-align: center;
    width: 510px;
}

.codigo {
    position: absolute;
    top: 758px;
    margin-left: 352px;
    font-family: courier;
    font-size: 14px;
}

.titulocodigo {
    position: absolute;
    top: 760px;
    margin-left: 232px;
    font-size: 12px;
}

.urlcodigo {
    position: absolute;
    top: 760px;
    margin-left: 632px;
    font-size: 12px;
}




.tpc_alumno {
    color: hsla(235, 84%, 19%, 0.81);
    font-weight: bold;
    position: relative;
    text-align: center;
    top: 210px;
    width: 960px;
    margin-left: 140px;
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
    width: 960px;
    margin-left: 140px;
    /*margin-left: 180px;*/
}

.tpc_duracion {
    color: hsla(235, 84%, 19%, 0.81);
    font-weight: bold;
    position: absolute;
    top: 541px;
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

.tpc_localidad {
    color: hsla(235, 84%, 19%, 0.81);
    font-weight: bold;
    position: absolute;
    top: 632px;
    margin-left: 315px;
    font-size: 16px;
}


.tpc_lugar {
    color: hsla(235, 84%, 19%, 0.81);
    font-weight: bold;
    position: absolute;
    top: 568px;
    margin-left: 655px;
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
    display: none;
    position: absolute;
    top: 588px;
    margin-left: 920px;
    width: 200px;
    height: 148px;
    background-image: url(../img/diplomas/firma_tpc.png);
    background-repeat: no-repeat;
    background-size: 200px 148px;
}
.back_tcp {
    overflow: auto;
    position: relative;
    display: block;
    background-image: url('../img/diplomas/dipback_tpc.png');
    background-repeat:no-repeat;
    background-size: 30.8cm 21.7cm ;
    width: 100%;
    height: 100%;
    page-break-after: always;
}


</style>




<script>

$(function() {

    $('.contenidotxt div').css('font-size', '1em');
    var fuente = 8;
    while( $('.contenidotxt div').height() > $('.contenidotxt').height() ) {

        fuente = parseInt($('.contenidotxt div').css('font-size')) - 1;
        $('.contenidotxt div').css('font-size', fuente + "px" );

    }

 // alert(fuente);

    fuente = 15;

    if (fuente == 1) {
        $('.contenidotxt div').css('font-size', "8" + "px" );
        $('.contenidotxt div').columnize({columns: 8});
    }
    else if (fuente == 2) {
        $('.contenidotxt div').css('font-size', "9" + "px" );
        $('.contenidotxt div').columnize({columns: 4});
    }
    else if (fuente == 3) {
        $('.contenidotxt div').css('font-size', "9" + "px" );
        $('.contenidotxt div').columnize({columns: 4});
    }
    else if (fuente == 4) {
        $('.contenidotxt div').css('font-size', "12" + "px" );
        $('.contenidotxt div').columnize({columns: 3});
    }
    else if (fuente == 5) {
        $('.contenidotxt div').css('font-size', "11" + "px" );
        $('.contenidotxt div').columnize({columns: 2});
    }
    else if (fuente == 6) {
        $('.contenidotxt div').css('font-size', "12" + "px" );
        $('.contenidotxt div').columnize({columns: 2});
    }
    else if (fuente == 7) {
        $('.contenidotxt div').css('font-size', "14" + "px" );
        $('.contenidotxt div').columnize({columns: 2});
    }
    else if (fuente == 8) {
        $('.contenidotxt div').css('font-size', "15" + "px" );
        $('.contenidotxt div').columnize({columns: 1});
    }
    else {
        $('.contenidotxt div').css('font-size', fuente + "px" );

    }

});

</script>

<?

$q = 'SELECT a.numeroaccion as naccion, c.*, a.horastotales, a.denominacion, a.modalidad
FROM acciones a
INNER JOIN cursos_tpc c ON c.id_accion = a.id
WHERE c.numcurso = "'.$_GET['numero'].'"';
// echo $q;
$q = mysqli_query($link, $q) or die("error select 1: " .mysqli_error($link));

$row = mysqli_fetch_assoc($q);

// arrayText($row);
$accion = $row['naccion'];
$denominacion = $row['denominacion'];
$modalidad = $row['modalidad'];
$lugar = $row['poblacion'];
$fechaini = $row['fechaini'];
$fechafin = $row['fechafin'];
$horastotales = $row['horastotales'];

// $rutatpc = 'documentacion'.$gestion.'/tpc/'.$_POST['numero'].'/';
$archivo = '/documentacion'.$gestion.'/tpc/'.$_GET['numero'].'/'.$_GET['numero'].'-tabla.xls';
// echo $archivo;


if ( $a = leerExcel($archivo) ) {

    // arrayText($a);

    foreach ($a as $key => $value) {

        if ( $value['3'] != "NOMBRE" ) {

            $clase = 'front_bonif_tpc';

            ?>

            <div class=<? echo '"'. $clase .'"'  ?> >
               <div class="tpc_alumno"><? echo mb_strtoupper( $value['3'].' '.$value['2'], 'UTF-8' ) ?></div>
               <div class="tpc_nif"><? echo $value['4'] ?></div>
               <div class="tpc_cif"><? echo $row[cif] ?></div>
               <? if ($incendios != 1) { ?>
               <div class="tpc_denominacion"><? echo $denominacion ?></div><? } ?>
               <div class="tpc_af"><? echo $value['1'] ?></div>
               <div class="tpc_razonsocial"><? echo $row['razonsocial'] ?></div>
               <div class="tpc_duracion"><? echo $horastotales. " horas" ?></div>
               <div class="tpc_fechaini"><? echo (formateaFecha($fechaini)) ?></div>
               <div class="tpc_fechafin"><? echo (formateaFecha($fechafin)) ?></div>
               <div class="tpc_modalidad"><? echo $modalidad ?></div>
               <div class="tpc_localidad"><? echo $lugar ?></div>
               <div class="tpc_lugar"><? echo $lugar ?></div>
               <div class="tpc_dia"><? echo date("d",strtotime($fechafin)) ?></div>
               <div class="tpc_mes"><? echo ucwords(strftime("%B",strtotime($fechafin))) ?></div>
               <div class="tpc_anio"><? echo strftime("%Y",strtotime($fechafin)) ?></div>

               <div class="firma_tpc"></div>

           </div>

           <?

           $q = 'SELECT *
           FROM acciones a
           WHERE numeroaccion IN ('.$accion.')';
           // echo $q;
           $q = mysqli_query($link, $q) or die("error select 2: " .mysqli_error($link));

           $clase_atras = 'back_tcp';

           $row = mysqli_fetch_assoc($q); ?>

            <div class="<? echo $clase_atras ?>">
                <div class="contenidotxt">
                    <div><? echo nl2br($row['contenido']) ?></div>
                </div>
            </div>

            <?
        }

    }


} else {

    echo "No existe archivo";

}



?>

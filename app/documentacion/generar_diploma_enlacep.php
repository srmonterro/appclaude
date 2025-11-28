
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="/app/css/fonts.css" type="text/css" charset="utf-8">
    <link rel="stylesheet" href="/app/css/esfocc.css" type="text/css" charset="utf-8">
</head>


<style>

* {
    margin:0;
    padding:0;
    font-family: 'Conv_estre',Sans-Serif;
}

body {
    width: 27.8cm;
    height: 19.6cm;
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
    height: 19.6cm;
}

.front_nobonif {
    overflow: auto;
    position: relative;
    display: block;
    background-image: url('../img/diplomas/dipfront_nobonif.png');
    background-repeat:no-repeat;
    background-size: 27.8cm 19.7cm ;
    width: 100%;
    height: 100%;
    page-break-after: always;
}

.front_nobonif_lopesan {
    overflow: auto;
    position: relative;
    display: block;
    background-image: url('../img/diplomas/dipfront_nobonif_lopesan.png');
    background-repeat:no-repeat;
    background-size: 27.8cm 19.7cm ;
    width: 100%;
    height: 100%;
    page-break-after: always;
}

.front_nobonif_incen1 {
    overflow: auto;
    position: relative;
    display: block;
    background-image: url('../img/diplomas/dipfront_nobonif_incen1.png');
    background-repeat:no-repeat;
    background-size: 27.8cm 19.7cm ;
    width: 100%;
    height: 100%;
    page-break-after: always;
}

.front_nobonif_incen2 {
    overflow: auto;
    position: relative;
    display: block;
    background-image: url('../img/diplomas/dipfront_nobonif_incen2.png');
    background-repeat:no-repeat;
    background-size: 27.8cm 19.7cm ;
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
    background-size: 27.8cm 19.7cm ;
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
    background-size: 27.8cm 19.7cm ;
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
    background-size: 27.8cm 19.7cm ;
    width: 100%;
    height: 100%;
    page-break-after: always;
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
    text-align: center;
    top: 190px;
    font-size: 32px;
}

.nif {
    position: absolute;
    top: 265px;
    margin-left: 140px;
    font-size: 16px;
}

.cif {
   position: absolute;
    top: 285px;
    margin-left: 140px;
    font-size: 16px;
}

.cifpriv {
   position: absolute;
    top: 285px;
    margin-left: 81px;
    font-size: 16px;
}
.razonsocialpriv {
    position: absolute;
    top: 262px;
    margin-left: 407px;
    font-size: 16px;
}

.af {
    position: absolute;
    top: 306px;
    margin-left: 196px;
    font-size: 16px;
}

.razonsocial {
    position: absolute;
    top: 267px;
    width: 315px !important;
    margin-left: 655px;
    font-size: 16px;
}


.denominacion {
    position: relative;
    text-align: center;
    top: 160px;
    margin: 0 50px 0 50px;
    font-size: 28px;
}

.duracion {
    position: absolute;
    top: 468px;
    margin-left: 210px;
    font-size: 16px;
}

.fechaini {
    position: absolute;
    top: 490px;
    margin-left: 187px;
    font-size: 16px;
}

.fechafin {
    position: absolute;
    top: 510px;
    margin-left: 223px;
    font-size: 16px;
}

.modalidad {
    position: absolute;
    top: 526px;
    margin-left: 158px;
    font-size: 16px;
}

.lugar {
    position: absolute;
    top: 490px;
    margin-left: 593px;
    font-size: 16px;
}

.dia {
    position: absolute;
    top: 492px;
    margin-left: 807px;
    font-size: 16px;
}

.mes {
    position: absolute;
    top: 491px;
    margin-left: 850px;
    font-size: 16px;
}

.anio {
    position: absolute;
    top: 494px;
    margin-left: 948px;
    font-size: 16px;
}

</style>


<?

include_once '../functions/funciones.php';
$gestion = devuelveAnioReal();

setlocale(LC_TIME, "es_ES");
$sec = explode("?",$_SERVER['HTTP_REFERER']);
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

$sql = 'SELECT DISTINCT a.numeroaccion, a.denominacion, a.horastotales, a.modalidad, ga.ngrupo, a.contenido,
    m.fechaini, m.fechafin, m.horariomini, m.horariomfin, m.horariotini, m.horariotfin, m.estado, a.incendios, a.nivel_incendios
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
        $contenido = $row[contenido];
        $estado = $row[estado];
        $incendios = $row[incendios];
        $nivel_incendios = $row[nivel_incendios];
    }

$lugar = 'San Cristóbal de La Laguna';
// echo $naccion;


if ( $mod == 'o' || ( $sec[1] == 'form_matricula_doc' || $sec[1] == 'form_matricula_doc#') ) $back = 'back_girado';
else $back = 'back';

if ( $sec[1] == 'form_matricula_doc' || $sec[1] == 'form_matricula_doc#' ) $grupal = 1;


if ( $gestion == 2014 ) {

    if ( $naccion == '17' || $naccion == '106' )
        $clase = "front_nobonif_incen1";
    else if ( $naccion == '18' )
        $clase = "front_nobonif_incen2";
    else if ( $naccion == '1001' || $naccion == '1006' || $naccion == '1017') {
        // echo $ngrupo;
        if ( $ngrupo == '22p' )
            $clase = "front_nobonif_lopesan";
        else
        $clase = "front_nobonif_incen_1001";
    } else
        $clase = "front_nobonif";


    if ( $estado == 'Finalizada' || $estado == 'Facturada' || $estado == 'Gratuita' || $grupal == 1 )
        $sql = 'SELECT DISTINCT a.nombre,a.apellido,a.apellido2,a.documento,e.razonsocial,e.cif
        FROM mat_alu_cta_emp ma, alumnos a, empresas e
        WHERE ma.id_alumno = a.id
        AND ma.tipo = "Privado"
        AND ma.id_matricula = '.$id_mat.'
        AND ma.id_empresa = e.id'.
        $limit;
    else
        $sql = 'SELECT a.nombre,a.apellido,a.apellido2,a.documento,e.razonsocial,e.cif
        FROM temp_alumnosp a,temp_empresasp e
        WHERE a.id_empresa = e.id
        AND e.id_matricula = '.$id_mat.'
        AND e.id_matricula = a.id_matricula'
        .$limit;

    $sql = mysqli_query($link, $sql) or die ("error");

    // echo $naccion;

    while ($row = mysqli_fetch_array($sql)) { ?>

        <div class=<? echo '"'. $clase .'"'  ?> >
                <div class="alumno"><? echo mb_strtoupper( $row[nombre].' '.$row[apellido].' '.$row[apellido2], 'UTF-8' ) ?></div>
                <div class="nif"><? echo $row[documento] ?></div>
                <? if ( $naccion != '17' && $naccion != '18' && $naccion != '106' ) { ?>
                <div class="denominacion"><? echo $denominacion ?></div> <? } ?>
                <? if ( $naccion == '1001' || $naccion == '1006' || $naccion == '1017' || $naccion == '1027' ) {
                    if ($ngrupo != '22p') { ?>
                        <div class="cif"><? echo $row[cif] ?></div>
                        <div class="razonsocial"><? echo $row[razonsocial] ?></div> <? }
                    else { ?>
                        <div class="razonsocial"><? echo $row[razonsocial].' - '.$row[cif] ?></div>
                    <? } ?>
                <? } else if ( $naccion != '1001' && $naccion != '1006' && $naccion != '1017' && $naccion != '1027' ){ ?>
                    <!-- <div class="cifpriv"><? echo 'con CIF:  '.$row[cif] ?></div> -->
                    <!-- <div class="razonsocialpriv"><? echo 'que presta sus servicios a la empresa: ' ?>
                        <div style="margin: -15px 0 0 240px; width:320px"><? echo $row[razonsocial] ?></div></div> -->
                <? } ?>
                <div class="duracion"><? echo $horastotales.' horas' ?></div>
                <div class="fechaini"><? echo date("d/m/Y",strtotime($fechaini)) ?></div>
                <div class="fechafin"><? echo date("d/m/Y",strtotime($fechafin)) ?></div>
                <div class="modalidad"><? echo $modalidad ?></div>
                <div class="lugar"><? echo $lugar ?></div>
                <div class="dia"><? echo date("d",strtotime($fechafin)) ?></div>
                <div class="mes"><? echo ucwords(strftime("%B",strtotime($fechafin))) ?></div>
                <div class="anio"><? echo strftime("%Y",strtotime($fechafin)) ?></div>
        </div>


    <? }

} else {

    if ( $incendios == 1 ) {

        if ( $nivel_incendios == "I" ) $clase = "front_nobonif_incen1";
        else $clase = "front_nobonif_incen2";

    } else $clase = "front_nobonif";


    if ( $estado == 'Finalizada' || $estado == 'Facturada' || $estado == 'Gratuita' || $grupal == 1 )
        $sql = 'SELECT DISTINCT a.nombre,a.apellido,a.apellido2,a.documento,e.razonsocial,e.cif
        FROM mat_alu_cta_emp ma, alumnos a, empresas e
        WHERE ma.id_alumno = a.id
        -- AND ma.finalizado = 1
        AND ma.tipo = "Privado"
        AND ma.id_matricula = '.$id_mat.'
        AND ma.id_empresa = e.id'.
        $limit;
    else
        $sql = 'SELECT a.nombre,a.apellido,a.apellido2,a.documento,e.razonsocial,e.cif
        FROM temp_alumnosp a,temp_empresasp e
        WHERE a.id_empresa = e.id
        AND a.id_matricula = '.$id_mat
        .$limit;

        // echo $sql;
    $sql = mysqli_query($link, $sql) or die ("error");

    // echo $naccion;

    while ($row = mysqli_fetch_array($sql)) { ?>

        <div class=<? echo '"'. $clase .'"'  ?> >
                <div class="alumno"><? echo $row[nombre].' '.$row[apellido].' '.$row[apellido2] ?></div>
                <div class="nif"><? echo $row[documento] ?></div>
                <? if ($incendios != 1) { ?>
                <div class="denominacion"><? echo $denominacion ?></div><? } ?>
                <div class="cif"><? echo $row[cif] ?></div>
                <div class="af"><? echo $naccion.'/'.$ngrupo ?></div>
                <div class="razonsocial"><? echo $row[razonsocial] ?></div>
                <div class="duracion"><? echo $horastotales.' horas' ?></div>
                <div class="fechaini"><? echo date("d/m/Y",strtotime($fechaini)) ?></div>
                <div class="fechafin"><? echo date("d/m/Y",strtotime($fechafin)) ?></div>
                <div class="modalidad"><? echo $modalidad ?></div>
                <div class="lugar"><? echo $lugar ?></div>
                <div class="dia"><? echo date("d",strtotime($fechafin)) ?></div>
                <div class="mes"><? echo ucwords(strftime("%B",strtotime($fechafin))) ?></div>
                <div class="anio"><? echo strftime("%Y",strtotime($fechafin)) ?></div>
        </div>
        <div class="back">
            <div class="contenidotxt">
                <div><? echo nl2br($contenido) ?></div>
            </div>
        </div>


    <? }


} ?>

<script type="text/javascript">
    window.print();
</script>
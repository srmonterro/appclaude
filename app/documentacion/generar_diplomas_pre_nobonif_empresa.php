
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="/app/css/fonts.css" type="text/css" charset="utf-8">
    <link rel="stylesheet" href="/app/css/edukate.css" type="text/css" charset="utf-8">
</head>

<script src="../js/jquery-1.10.2.js"></script>
<script src="../js/jquery.columnizer.js"></script>


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
    width: 30.8cm;
    height: 21.7cm;
    padding: 15px 30px;
}
.page-hor {
    position: relative;
    width: 30.8cm;
    height: 21.7cm;
}

.front_nobonif {
    overflow: auto;
    position: relative;
    display: block;
    /*background-image: url('../img/diplomas/dipfront_nobonif.png');*/
    background-image: url('../img/diplomas/dipfront.png');
    background-repeat:no-repeat;
    background-size: 30.8cm 21.7cm ;
    width: 100%;
    height: 100%;
    page-break-after: always;
}

.front_nobonif_noemp {
    overflow: auto;
    position: relative;
    display: block;
    /*background-image: url('../img/diplomas/dipfront_nobonif_noemp.png');*/
    background-image: url('../img/diplomas/dipfront.png');
    background-repeat:no-repeat;
    background-size: 30.8cm 21.7cm ;
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
    background-size: 30.8cm 21.7cm ;
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
    background-size: 30.8cm 21.7cm ;
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
}

.back_girado {
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

</style>

<script>

$(function() {

    $('.contenidotxt div').css('font-size', '1em');
    var fuente = 16;
    while( $('.contenidotxt div').height() > $('.contenidotxt').height() ) {

        fuente = parseInt($('.contenidotxt div').css('font-size')) - 1;
        $('.contenidotxt div').css('font-size', fuente + "px" );

    }

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
        $('.contenidotxt div').css('font-size', "12" + "px" );
        $('.contenidotxt div').columnize({columns: 2});
    }
    else if (fuente == 8) {
        $('.contenidotxt div').css('font-size', "12" + "px" );
        $('.contenidotxt div').columnize({columns: 2});
    }
    else {
        $('.contenidotxt div').css('font-size', fuente + "px" );

    }

});

</script>


<?

include_once '../functions/funciones.php';
$sec = explode("?",$_SERVER['HTTP_REFERER']);
setlocale(LC_TIME, "es_ES");
$gestion = devuelveAnioReal();
$anio = $_GET[anio];



if ( $anio != "" )
    include_once '../functions/connect.php';

$id_mat = $_GET['id_matricula'];
$id_emp = $_GET['id_empresa'];
$mod = $_GET['mod'];

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
    m.fechaini, m.fechafin, m.horariomini, m.horariomfin, m.horariotini, m.horariotfin, m.estado, a.incendios, a.nivel_incendios, m.fechaini_nop, m.fechafin_nop, diploma
    FROM matriculas m, acciones a, grupos_acciones ga
    WHERE m.id_accion = a.id
    AND m.id_grupo = ga.id
    AND m.id ='.$id_mat;

    // echo $sql;

    $sql = mysqli_query($link, $sql) or die ("error");

    if ( mysqli_num_rows($sql) < 1 ) {

        $link = connectAnio(date('Y')-1);
        $sql = 'SELECT DISTINCT a.numeroaccion, a.denominacion, a.horastotales, a.modalidad, ga.ngrupo, a.contenido,
            m.fechaini, m.fechafin, m.horariomini, m.horariomfin, m.horariotini, m.horariotfin, m.estado, a.incendios, a.nivel_incendios, m.fechaini_nop, m.fechafin_nop, diploma
            FROM matriculas m, acciones a, grupos_acciones ga
            WHERE m.id_accion = a.id
            AND m.id_grupo = ga.id
            AND m.id ='.$id_mat;
        $sql = mysqli_query($link, $sql) or die ("error");

    }


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
        $diploma = $row[diploma];

        if ( $modalidad == "Mixta" ) {
            if ( strtotime($row[fechaini_nop]) < strtotime($row[fechaini]) )
                $fechaini = $row[fechaini_nop];
            if ( strtotime($row[fechafin_nop]) > strtotime($row[fechafin]) )
                $fechafin = $row[fechaini_nop];
        }
    }



$lugar = 'San Cristóbal de La Laguna';


$clasenif = 'nif';
$clasecif = 'cif';


// if ( $mod == 'o' || ( $sec[1] == 'form_matricula_doc' || $sec[1] == 'form_matricula_doc#') ) $back = 'back_girado';
// else
$back = 'back';

if ( $sec[1] == 'form_matricula_doc' || $sec[1] == 'form_matricula_doc#' ) $grupal = 1;

// echo $naccion;
// DETERMINA QUE TIPO DE DIPLOMA ES
//echo "asdasd";

if ( $gestion == 2014 ) {

if ( $naccion == '17' ) $clase = "front_nobonif_incen1";
else if ( $naccion == '18' ) $clase = "front_nobonif_incen2";
else if ( $naccion == '1001' || $naccion == '1006' || $naccion == '1017' || $naccion == '1027' ) {

    if ( $ngrupo == '22p' ) {
        $clase = "front_nobonif_lopesan";
        $clasenif = 'niflopesan';
        $clasecif = 'ciflopesan';
    }
    else
        $clase = "front_nobonif_incen_1001";

} else $clase = "front_nobonif";

if ( $sec[1] == 'form_matricula_doc' || $sec[1] == 'form_matricula_doc#' ) $grupal = 1;

if ( $estado == 'Finalizada' || $estado == 'Facturada' || $estado == 'Gratuita' || $grupal == 1 ){
    $sql = 'SELECT DISTINCT a.id, a.nombre,a.apellido,a.apellido2,a.documento,e.razonsocial,e.cif
    FROM mat_alu_cta_emp ma, alumnos a, empresas e
    WHERE ma.id_alumno = a.id
    AND ma.tipo = "Privado"
    AND ma.id_matricula = '.$id_mat.'
    AND ma.id_empresa = e.id
    AND e.id = '.$id_emp.
    $limit;

    // echo "asdasd";
    }
else  {

        $sql = 'SELECT a.id, a.nombre,a.apellido,a.apellido2,a.documento,e.razonsocial,e.cif
        FROM temp_alumnosp a,temp_empresasp e
        WHERE a.id_empresa = e.id
        AND e.id = '.$id_emp.
        $limit;

}
// echo "asdasd";
//echo $sql;

$sql = mysqli_query($link, $sql) or die ("error: ---");

while ($row = mysqli_fetch_array($sql)) {

    //cgutierrez: obtener código de validación del diploma
    // if ( isRoot() ) {
        // $codigo_diploma = generarCodigos($id_mat, $row[id], $link);
    // }

    ?>

    <div class=<? echo '"'. $clase .'"'  ?> >
            <div class="alumno"><? echo $row[nombre].' '.$row[apellido].' '.$row[apellido2] ?></div>
            <div class=<? echo '"'.$clasenif.'"' ?> ><? echo $row[documento] ?></div>
            <? if ( $naccion != '17' && $naccion != '18' && $naccion != '106' ) { ?>
            <div class="denominacion"><? echo $denominacion ?></div> <? } ?>

                    <div class="cif"><? echo $row[cif] ?></div>
                    <div class="razonsocial"><? echo $row[razonsocial] ?></div>
                    <div class="af"><? echo $naccion.'/'.$ngrupo ?></div>


            <div class="duracion"><? echo $horastotales.' horas' ?></div>
            <div class="fechaini"><? echo date("d/m/Y",strtotime($fechaini)) ?></div>
            <div class="fechafin"><? echo date("d/m/Y",strtotime($fechafin)) ?></div>
            <div class="modalidad"><? echo $modalidad ?></div>
            <div class="lugar"><? echo $lugar ?></div>
            <div class="dia"><? echo date("d",strtotime($fechafin)) ?></div>
            <div class="mes"><? echo ucwords(strftime("%B",strtotime($fechafin))) ?></div>
            <div class="anio"><? echo strftime("%Y",strtotime($fechafin)) ?></div>
    </div>

    <div class=<? echo '"'. $back .'"' ?>>
        <div class="contenidotxt">
            <div><? echo nl2br($contenido) ?></div>
        </div>
    </div>
    <?
    }


} else {

    if ( $incendios == 1 ) {

        if ( $nivel_incendios == "I" ) $clase = "front_nobonif_incen1";
        else $clase = "front_nobonif_incen2";

    } else $clase = "front_nobonif";

    // si es ESFOCC o persona física

    if ( $estado == 'Finalizada' || $estado == 'Facturada' || $estado == 'Gratuita' || $grupal == 1 )
        $sql = 'SELECT DISTINCT a.id, a.nombre,a.apellido,a.apellido2,a.documento,e.razonsocial,e.cif, e.grupo, e.id as id_empresa, e.categoria
        FROM mat_alu_cta_emp ma, alumnos a, empresas e
        WHERE ma.id_alumno = a.id
        AND ma.finalizado = 1
        AND ma.tipo = "Privado"
        AND ma.id_matricula = '.$id_mat.'
        AND ma.id_empresa = e.id
        AND e.id = '.$id_emp
        .$limit;
    else
        $sql = 'SELECT a.id, a.nombre,a.apellido,a.apellido2,a.documento,e.razonsocial,e.cif, e.grupo, e.id as id_empresa, e.categoria
        FROM temp_alumnosp a,temp_empresasp te, empresas e
        WHERE a.id_empresa = te.id
        AND te.id_matricula = '.$id_mat.'
        AND te.id_matricula = a.id_matricula
        AND e.cif = te.cif
        AND te.id = '.$id_emp
        .$limit;

    // echo $sql;
    $sql = mysqli_query($link, $sql) or die ("error" . mysqli_error($link));


    while ($row = mysqli_fetch_array($sql)) {


        // si es ESFOCC o persona física
        $individual = 0;
        if ( $row['cif'] == $row['documento'] || $row['categoria'] == "PERSONA FISICA" || $row['id_empresa'] == 10339 ) {
            $individual = 1;
            $clase = "front_nobonif_noemp";
        }

        // echo "llega";
        //cgutierrez: obtener código de validación del diploma
        // if ( isRoot() ) {
            $codigo_diploma = generarCodigos($id_mat, $row[id], $link);
        // }

        ?>

        <div class=<? echo '"'. $clase .'"'  ?> >
                <div class="alumno"><? echo 'D/Dña. '.$row[nombre].' '.$row[apellido].' '.$row[apellido2].'  con NIF '.$row[documento].' que presta  sus servicios en la Empresa '.$row[razonsocial].' con CIF '.$row[cif].' ha realizado la acción formativa '?>
                    
                </div>
                 <div class="denominacion"><? echo $denominacion ?></div> 
                 <!-- <div class="af"><? //echo 'GRUPO '.$ngrupo.' - CÓDIGO AF '.$naccion ?></div>  -->
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

                    echo '<div class="legionella">Programa homologado y autorizado por la Dirección General de Salud Pública del Gobierno de Canarias como entidad formadora EDUKA-TE SOLUTIONS, SLU. Fecha: 00/00/2020 No. Reg: 000/2020<br><br>
                        Referencia: '.$ref.' | Validez del presente certificado: 5 años | 23 horas teóricas y 7 prácticas</div>';

                } ?>

                    <div class="titulocodigo"><? echo 'Código de validación: ' ?></div>
                    <div class="codigo"><? echo $codigo_diploma ?></div>
                    <div class="urlcodigo"><? echo 'URL de verificación: diplomas.eduka-te.com' ?></div>

        </div>

        <? //if ( $row[grupo] == 1 )  { // SPRING ¯\_(ツ)_/¯  ?>
        <div class=<? echo '"'. $back .'"' ?>>
            <div class="contenidotxt">
                <div><? echo nl2br($contenido) ?></div>
            </div>
        </div>
        <? //}

        if ( $diploma == "DINOSOL" ) {

            echo '<img class="diplomadino" src="diplomas/logo_dinosol.png" />';

        }


    }

} ?>



<script type="text/javascript">
    window.print();
</script>

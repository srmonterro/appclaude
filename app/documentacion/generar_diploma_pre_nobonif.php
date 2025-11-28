
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
        width: 30.8cm;
        height: 21.7cm;
    }
    .page {
        position: relative;
        width: 21cm;
        height: 30.8cm;
        padding: 15px 30px;
    }
    .page-hor {
        position: relative;
        width: 28.5cm;
        height: 21.7cm;
    }

    .front_nobonif {
        overflow: auto;
        position: relative;
        display: block;
        background-image: url('../img/diplomas/dipfront_nobonif.png');
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
        background-image: url('../img/diplomas/dipfront_nobonif_noemp.png');
        background-repeat:no-repeat;
        background-size: 30.8cm 21.7cm ;
        width: 100%;
        height: 100%;
        page-break-after: always;
    }
    .front_nobonif_fasnia {
        overflow: auto;
        position: relative;
        display: block;
        background-image: url('../img/diplomas/dipfront_nobonif_fasnia.png');
        background-repeat:no-repeat;
        background-size: 30.8cm 21.7cm ;
        width: 100%;
        height: 100%;
        page-break-after: always;
    }

    .front_nobonif_abona {
        overflow: auto;
        position: relative;
        display: block;
        background-image: url('../img/diplomas/dipfront_nobonif_abona.png');
        background-repeat:no-repeat;
        background-size: 30.8cm 21.7cm ;
        width: 100%;
        height: 100%;
        page-break-after: always;
    }


    .front_nobonif_bosco {
        overflow: auto;
        position: relative;
        display: block;
        background-image: url('../img/diplomas/diploma_bosco.png');
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
    background-image: url('../img/diplomas/diploma_atras.png');
    background-repeat:no-repeat;
    background-size: 30.8cm 21.7cm ;
    width: 100%;
    height: 100%;
    page-break-after: always;
    /*-webkit-transform: rotate(180deg);*/
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
    top: 550px;
    margin-left: 275px;
    font-size: 11px;
    text-align: center;
    width: 510px;
}

.alumno {
    position: relative;
    text-align: center;
    top: 190px;
    font-size: 32px;
}

.nif {
    position: absolute;
    top: 293px;
    margin-left: 150px;
    font-size: 16px;
}

.cif {
   position: absolute;
   top: 315px;
   margin-left: 150px;
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

.diplomadino {
    position: absolute;
    top: 615px;
    margin-left: 100px;
    font-size: 16px;
    width: 300px;
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

.texto_abona {
    position: relative;
    text-align: center;
    width: 900px;
    left: 100px;
    top: 356px;
    line-height: 1.5;
    font-size: 18px;
}
.nif_abona {
    position: absolute;
    top: 363px;
    margin-left: 216px;
    font-size: 16px;
}
.af_abona {
    position: absolute;
    top: 390px;
    margin-left: 231px;
    font-size: 16px;
}
.denominacion_abona {
    position: relative;
    text-align: center;
    top: 420px;
    font-size: 32px;
}
.alumno_abona {
    position: relative;
    text-align: center;
    top: 290px;
    font-size: 32px;
}


</style>


<?

include_once '../functions/funciones.php';
$gestion = devuelveAnioReal();
$anio = $_GET[anio];

if ( $anio != "" )
    include_once '../functions/connect.php';

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
m.fechaini, m.fechafin, m.horariomini, m.horariomfin, m.horariotini, m.horariotfin, m.estado, a.incendios, a.nivel_incendios, m.id_solicitudikea, a.diploma, m.referencia_legio, m.fechaini_nop, m.fechafin_nop, m.id as id_matricula, htmldiploma
FROM matriculas m, acciones a, grupos_acciones ga
WHERE m.id_accion = a.id
AND m.id_grupo = ga.id
AND m.id ='.$id_mat;
    // echo $sql;

$sql = mysqli_query($link, $sql) or die ("error");

if ( mysqli_num_rows($sql) < 1 ) {

    $link = connectAnio(date('Y')-1);
    $sql = 'SELECT DISTINCT a.numeroaccion, a.denominacion, a.horastotales, a.modalidad, ga.ngrupo, a.contenido,
    m.fechaini, m.fechafin, m.horariomini, m.horariomfin, m.horariotini, m.horariotfin, m.estado, a.incendios, a.nivel_incendios, m.id_solicitudikea, a.diploma, m.referencia_legio, m.fechaini_nop, m.fechafin_nop, m.id as id_matricula, htmldiploma
    FROM matriculas m, acciones a, grupos_acciones ga
    WHERE m.id_accion = a.id
    AND m.id_grupo = ga.id
    AND m.id ='.$id_mat;
    $sql = mysqli_query($link, $sql) or die ("error");

}



while ($row = mysqli_fetch_array($sql)) {

    $idmat = $row[id_matricula];
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
    $diploma = $row[diploma];
    $ref = $row[referencia_legio];

    if ( $modalidad == "Mixta" ) {
        if ( strtotime($row[fechaini_nop]) < strtotime($row[fechaini]) )
            $fechaini = $row[fechaini_nop];
        if ( strtotime($row[fechafin_nop]) > strtotime($row[fechafin]) )
            $fechafin = $row[fechaini_nop];
    }

    if ( $row[id_solicitudikea] != 0 && $row[id_solicitudikea] != NULL )
        $ikea = 1;
    else
        $ikea = 0;
}

$lugar = 'San Cristóbal de La Laguna';
// echo $naccion;


// if ( $mod == 'o' || ( $sec[1] == 'form_matricula_doc' || $sec[1] == 'form_matricula_doc#') ) $back = 'back_girado';
// else
$back = 'back';

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


    $individual = 0;
    if ( $row['cif'] == $row['documento'] || $row['categoria'] == "PERSONA FISICA" || $row['id_empresa'] == 15 ) {
        $individual = 1;
        $clase = "front_nobonif_noemp";
    }


    if ( $estado == 'Finalizada' || $estado == 'Facturada' || $estado == 'Gratuita' || $grupal == 1 )
        $sql = 'SELECT DISTINCT a.id, a.nombre,a.apellido,a.apellido2,a.documento,e.razonsocial,e.cif
    FROM mat_alu_cta_emp ma, alumnos a, empresas e
    WHERE ma.id_alumno = a.id
    AND ma.tipo = "Privado"
    AND ma.id_matricula = '.$id_mat.'
    AND ma.id_empresa = e.id'.
    $limit;
    else
        $sql = 'SELECT a.id, a.nombre,a.apellido,a.apellido2,a.documento,e.razonsocial,e.cif
    FROM temp_alumnosp a,temp_empresasp e
    WHERE a.id_empresa = e.id
    AND e.id_matricula = '.$id_mat.'
    AND e.id_matricula = a.id_matricula'
    .$limit;

    $sql = mysqli_query($link, $sql) or die ("error");

    // echo $naccion;

    while ($row = mysqli_fetch_array($sql)) {

        //cgutierrez: obtener código de validación del diploma
        // if ( isRoot() ) {
        //     $codigo_diploma = generarCodigos($id_mat, $row[id], $link);
        // }



        ?>

        <div class=<? echo '"'. $clase .'"'  ?> >
            <div class="alumno"><? echo mb_strtoupper( $row[nombre].' '.$row[apellido].' '.$row[apellido2], 'UTF-8' ) ?></div>
            <div class="nif"><? echo $row[documento] ?></div>
            <div class="af<? echo $abona ?>"><? echo $naccion.'/'.$ngrupo ?></div>
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
                    <? // } ?>
                </div>

                <?
                if ( $diploma == "LEGIONELLA" ) {

                    echo '<div class="legionella">Programa homologado y autorizado por la Dirección General de Salud Pública del Gobierno de Canarias como entidad formadora ESCUELA SUPERIOR DE FORMACIÓN Y CUALIFICACIÓN. Fecha: 25/03/2015 No. Reg: 147/2015<br><br>
                    Referencia: '.$ref.' | Validez del presente certificado: 5 años | 23 horas teóricas y 7 prácticas</div>';

                }

                ?>




                <? }

            } else {

                if ( $incendios == 1 ) {

                    if ( $nivel_incendios == "I" ) $clase = "front_nobonif_incen1";
                    else $clase = "front_nobonif_incen2";

    } else if ($idmat == 860 || $idmat == 143 ) { // ayutamiento abona (3logos)

        $clase = "front_nobonif_abona";

    } else $clase = "front_nobonif";

 	} else if ($idmat == 945 || $idmat == 860 || $idmat == 973) { // ayutamiento fasnia

        $clase = "front_nobonif_fasnia";

    } else $clase = "front_nobonif";

    if ( $estado == 'Finalizada' || $estado == 'Facturada' || $estado == 'Gratuita' || $grupal == 1 )
        $sql = 'SELECT DISTINCT a.id, a.nombre,a.apellido,a.apellido2,a.documento,e.razonsocial,e.cif, e.categoria
    FROM mat_alu_cta_emp ma, alumnos a, empresas e
    WHERE ma.id_alumno = a.id
        -- AND ma.finalizado = 1
        AND ma.tipo = "Privado"
        AND ma.id_matricula = '.$id_mat.'
        AND ma.id_empresa = e.id'.
        $limit;
        else
            $sql = 'SELECT DISTINCT a.id, a.nombre,a.apellido,a.apellido2,a.documento,e.razonsocial,e.cif, e.categoria
        FROM temp_alumnosp a,temp_empresasp te, empresas e
        WHERE a.id_empresa = te.id
        AND e.cif = te.cif
        AND a.id_matricula = '.$id_mat
        .$limit;

        // echo $sql;
        $sql = mysqli_query($link, $sql) or die ("error " . mysqli_error($link));

    // echo $naccion;

        while ($row = mysqli_fetch_array($sql)) {

        if ( $row[cif] == 'G14522171' ) // DON BOSCO DIPLOMA ESPECIAL
        $clase = 'front_nobonif_bosco';

        //cgutierrez: obtener código de validación del diploma
        // if ( isRoot() ) {
        $codigo_diploma = generarCodigos($id_mat, $row[id], $link);
        // }


        // si es ESFOCC o persona física
        $individual = 0;
        if ( $row['cif'] == $row['documento'] || $row['categoria'] == "PERSONA FISICA" || $row['id_empresa'] == 10339 ) {
            $individual = 1;
            $clase = "front_nobonif_noemp";
        }


        if ( $idmat == 143 ) $abona = '_abona';

        ?>

        <div class=<? echo '"'. $clase .'"'  ?> >

            <? if ( $idmat != 1051 ) { ?>
            <div class="alumno<? echo $abona ?>"><? echo $row[nombre].' '.$row[apellido].' '.$row[apellido2] ?></div>
            <div class="nif<? echo $abona ?>"><? echo $row[documento] ?></div>
            <? if ($incendios != 1) { ?>
            <div class="denominacion<? echo $abona ?>"><? echo $denominacion ?></div><? } ?>
            <div class="cif"><? echo $individual == 1 ? "" : $row[cif] ?></div>
            <div class="af<? echo $abona ?>"><? echo $naccion.'/'.$ngrupo ?></div>
            <div class="razonsocial"><? echo $individual == 1 ? "" : $row[razonsocial] ?></div>
            <? } else { $modalidad = "Presencial";
            if ( $idmat != 143 ) { ?>

            <div class="texto_abona">
                <? echo "Don/Doña ".$row[nombre].' '.$row[apellido].' '.$row[apellido2].", con DNI ".$row[documento].",participante del Programa Experimental de Empleo JOVEMPLEO CONECT@, ha cursado con aprovechamiento el Curso de <strong>".$denominacion."</strong>, desarrollado desde el día ".date("d/m/Y",strtotime($fechaini)). " al ".date("d/m/Y",strtotime($fechafin))." y con una duración de ".$horastotales." horas." ?>
            </div>

            <? } } ?>
            <div class="duracion"><? echo $horastotales.' horas' ?></div>
            <div class="fechaini"><? echo date("d/m/Y",strtotime($fechaini)) ?></div>
            <div class="fechafin"><? echo date("d/m/Y",strtotime($fechafin)) ?></div>
            <div class="modalidad"><? echo $modalidad ?></div>
            <div class="lugar"><? echo $lugar ?></div>
            <div class="dia"><? echo date("d",strtotime($fechafin)) ?></div>
            <div class="mes"><? echo ucwords(strftime("%B",strtotime($fechafin))) ?></div>
            <div class="anio"><? echo strftime("%Y",strtotime($fechafin)) ?></div>
            <?
            if ( $diploma == "LEGIONELLA" ) {

                echo '<div class="legionella">Programa homologado y autorizado por la Dirección General de Salud Pública del Gobierno de Canarias como entidad formadora ESCUELA SUPERIOR DE FORMACIÓN Y CUALIFICACIÓN. Fecha: 25/03/2015 No. Reg: 147/2015<br><br>
                Referencia: '.$ref.' | Validez del presente certificado: 5 años | 23 horas teóricas y 7 prácticas</div>';

            } else if ( $diploma == "DINOSOL" ) {

                echo '<img class="diplomadino" src="diplomas/logo_dinosol.png" />';

            } ?>
            <? //if ( isRoot() ) { ?>
            <div class="titulocodigo"><? echo 'Código de validación: ' ?></div>
            <div class="codigo"><? echo $codigo_diploma ?></div>
            <div class="urlcodigo"><? echo 'URL de verificación: <a href="diplomas.esfocc.com">diplomas.esfocc.com</a>' ?></div>
            <? //} ?>
        </div>

        <? //if ( $ikea == 1 ) { ?>
<!--         <div class="back">
            <div class="contenidotxt">
                <div><? echo ($contenido) ?></div>
            </div>
        </div>
    -->        <? //} ?>


    <? }


} ?>

<script type="text/javascript">
    window.print();
</script>
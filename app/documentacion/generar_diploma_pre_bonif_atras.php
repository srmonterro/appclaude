<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="/app/css/fonts.css" type="text/css" charset="utf-8">
</head>

<script src="../js/jquery-1.10.2.js"></script>
<script src="../js/jquery.columnizer.js"></script>

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
    width: 21.7cm;
    height: 30.8cm;
    padding: 15px 30px;
}
.page-hor {
    position: relative;
    width: 30.8cm;
    height: 21.7cm;
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

    //fuente = 3;
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

include_once '../functions/funciones.php';

$anio = $_GET[anio];

if ( $anio != "" )
include_once '../functions/connect.php';

setlocale(LC_TIME, "es_ES");

$id_mat = $_GET['id_matricula'];

$sql = 'SELECT DISTINCT a.numeroaccion, a.denominacion, a.horastotales, a.modalidad, ga.ngrupo, a.contenido,
    m.fechaini, m.fechafin, m.horariomini, m.horariomfin, m.horariotini, m.horariotfin, htmldiploma
    FROM matriculas m, acciones a, grupos_acciones ga
    WHERE m.id_accion = a.id
    AND m.id_grupo = ga.id
    AND m.id ='.$id_mat;
    // echo $sql;

    $sql = mysqli_query($link, $sql) or die ("error");

    if ( mysqli_num_rows($sql) < 1 ) {

         echo "e";
        $link = connectAnio(date('Y')-1);
        $sql = 'SELECT DISTINCT a.numeroaccion, a.denominacion, a.horastotales, a.modalidad, ga.ngrupo, a.contenido,
            m.fechaini, m.fechafin, m.horariomini, m.horariomfin, m.horariotini, m.horariotfin, htmldiploma
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
    }

$lugar = 'San Cristóbal de La Laguna';


$sql = 'SELECT a.nombre,a.apellido,a.apellido2,a.documento,e.razonsocial,e.cif
FROM temp_alumnos a,temp_empresas e
WHERE a.id_empresa = e.id';
$sql = mysqli_query($link, $sql) or die ("error");

?>

<div class="back">
    <div class="contenidotxt">
        <div><? echo nl2br($contenido) ?></div>
    </div>
</div>

<script type="text/javascript">
    window.print();
</script>

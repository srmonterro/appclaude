
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

.front_bonif {
    overflow: auto;
    position: relative;
    display: block;
    background-image: url('../img/diplomas/dipfront_bonif.png');
    background-repeat:no-repeat;
    background-size: 27.8cm 19.7cm ;
    width: 100%;
    height: 100%;
    page-break-after: always;
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

.af {
    position: absolute;
    top: 306px;
    margin-left: 196px;
    font-size: 16px;
}

.razonsocial {
    position: absolute;
    top: 267px;
    margin-left: 655px;
    font-size: 16px;    
}

.denominacion {
    position: relative;
    text-align: center;
    top: 336px;
    font-size: 32px;
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

</style>

<script>

$(function() {

    $('.contenidotxt div').css('font-size', '1em');
    var fuente = 16;
    while( $('.contenidotxt div').height() > $('.contenidotxt').height() ) {

        fuente = parseInt($('.contenidotxt div').css('font-size')) - 1;
        $('.contenidotxt div').css('font-size', fuente + "px" );
        
    }

    // alert(fuente);


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

// window.onload =  function() {
//     $('.contenidotxt').boxfit({ multiline: true, align_true: false, step_limit: 500 });
// };
</script>


<?

include_once '../functions/funciones.php';

setlocale(LC_TIME, "es_ES");

$id_mat = $_GET['id_matricula'];
$id_emp = $_GET['id_empresa'];

$sql = 'SELECT DISTINCT a.numeroaccion, a.denominacion, a.horastotales, a.modalidad, ga.ngrupo, a.contenido,
    m.fechaini, m.fechafin, m.horariomini, m.horariomfin, m.horariotini, m.horariotfin
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
    }

$lugar = 'San Cristóbal de La Laguna';

// DETERMINA QUE TIPO DE DIPLOMA ES
if ( strpos($ngrupo, "p") !== false ) {
    $nobonificado = 1;
    $clase = "front_nobonif";
} else 
    $clase = "front_bonif";


$sql = 'SELECT a.nombre,a.apellido,a.apellido2,a.documento,e.razonsocial,e.cif 
FROM mat_alu_cta_emp ma, alumnos a, empresas e
WHERE ma.id_alumno = a.id
AND ma.id_empresa = e.id
AND ma.id_matricula = '.$id_mat.' 
AND ma.id_empresa = '.$id_emp;
$sql = mysqli_query($link, $sql) or die ("error");

while ($row = mysqli_fetch_array($sql)) { ?>
    
    <div class=<? echo '"'. $clase .'"'  ?> >
            <div class="alumno"><? echo $row[nombre].' '.$row[apellido].' '.$row[apellido2] ?></div>
            <div class="nif"><? echo $row[documento] ?></div>

            <? if ( $nobonificado != 1 ) { ?>
                <div class="cif"><? echo $row[cif] ?></div>                
                <div class="af"><? echo $naccion.'/'.$ngrupo ?></div> 
                <div class="razonsocial"><? echo $row[razonsocial] ?></div>
            <? } ?>
            
            <div class="denominacion"><? echo $denominacion ?></div>
            <div class="duracion"><? echo $horastotales.' horas' ?></div>
            <div class="fechaini"><? echo date("d/m/Y",strtotime($fechaini)) ?></div>
            <div class="fechafin"><? echo date("d/m/Y",strtotime($fechafin)) ?></div>
            <div class="modalidad"><? echo $modalidad ?></div>
            <div class="lugar"><? echo $lugar ?></div>
            <div class="dia"><? echo date("d",strtotime($fechafin)) ?></div>
            <div class="mes"><? echo ucwords(strftime("%B",strtotime($fechafin))) ?></div>
    </div>

    <div class="back">                
        <div class="contenidotxt">
            <div><? echo nl2br($contenido) ?></div>
        </div>
    </div>    
    
<? } ?>


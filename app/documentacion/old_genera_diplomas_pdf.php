<style type="text/css">

* {
    margin:0;
    padding:0;
    /*font-family: 'Conv_estre',Sans-Serif;*/
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
    background-image: url(./diplomas/dipfront_bonif.png);
    background-repeat:no-repeat;
    background-size: 27.8cm 19.7cm ;
    width: 100%;
    height: 100%;
    page-break-after: always;
}
 
.front_bonif_incen1 {
    overflow: auto;
    position: relative;
    display: block;
    background-image: url(./diplomas/dipfront_bonif_incen1.png);
    background-repeat:no-repeat;
    background-size: 27.8cm 19.7cm ;
    width: 100%;
    height: 100%;
    page-break-after: always;
}

.front_bonif_incen2 {
    overflow: auto;
    position: relative;
    display: block;
    background-image: url(./diplomas/dipfront_bonif_incen2.png);
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
    background-image: url(./diplomas/diploma_atras.png);
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
    margin-left: 860px;
    font-size: 16px;
}

</style>


<?

// include_once '../functions/funciones.php';


$id_mat = 15;

$sql = 'SELECT DISTINCT a.numeroaccion, a.denominacion, a.horastotales, a.modalidad, ga.ngrupo, a.contenido,
    m.fechaini, m.fechafin, m.horariomini, m.horariomfin, m.horariotini, m.horariotfin
    FROM matriculas m, acciones a, grupos_acciones ga
    WHERE m.id_accion = a.id
    AND m.id_grupo = ga.id
    AND m.id ='.$id_mat;
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
if ( $naccion == '17' ) $clase = "front_bonif_incen1";
else if ( $naccion == '18' ) $clase = "front_bonif_incen2";
else $clase = "front_bonif";

$sql = 'SELECT a.nombre,a.apellido,a.apellido2,a.documento,e.razonsocial,e.cif 
FROM temp_alumnos a,temp_empresas e 
WHERE a.id_empresa = e.id';
$sql = mysqli_query($link, $sql) or die ("error");

while ($row = mysqli_fetch_array($sql)) {  ?>

    <div class=<? echo '"'. $clase .'"'  ?> >
            <div class="alumno"><? echo $row[nombre].' '.$row[apellido].' '.$row[apellido2] ?></div>
            <div class="nif"><? echo $row[documento] ?></div>
            <div class="cif"><? echo $row[cif] ?></div>
            <div class="af"><? echo $naccion.'/'.$ngrupo ?></div>
            <div class="razonsocial"><? echo $row[razonsocial] ?></div>
            <? if ( $naccion != '17' && $naccion != '18' ) { ?>
            <div class="denominacion"><? echo $denominacion ?></div> <? } ?>
            <div class="duracion"><? echo $horastotales.' horas' ?></div>
            <div class="fechaini"><? echo date("d/m/Y",strtotime($fechaini)) ?></div>
            <div class="fechafin"><? echo date("d/m/Y",strtotime($fechafin)) ?></div>
            <div class="modalidad"><? echo $modalidad ?></div>
            <div class="lugar"><? echo $lugar ?></div>
            <div class="dia"><? echo date("d",strtotime($fechafin)) ?></div>
            <div class="mes"><? echo ucwords(strftime("%B",strtotime($fechafin))) ?></div>
    </div>

<? } ?>

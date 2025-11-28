
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
    width: 21cm;
    height: 29.7cm; 
    padding: 15px 30px;
}
.page-hor {
    position: relative;
    width: 29. 7;
    height: 18cm; 
    padding: 15px 30px;
}

@page {
    size: landscape;
    margin: 0;
}

</style>

<?

include_once '../functions/funciones.php';

$id_mat = $_GET['id_matricula'];

$sql = 'SELECT DISTINCT a.numeroaccion, a.denominacion, a.horastotales, a.tipoformacionac, ga.ngrupo, 
    m.fechaini, m.fechafin, m.horariomini, m.horariomfin, m.horariotini, m.horariotfin
    FROM matriculas m, acciones a, grupos_acciones ga 
    WHERE m.id_accion = a.id
    AND m.id_grupo = ga.id
    AND m.id ='.$id_mat;
    // echo $sql;
    $sql = mysqli_query($link, $sql) or die ("error");
    
    while ($row = mysqli_fetch_array($sql)) { 
        $naccion = $row[numeroaccion];
        $tipoformacionac = $row[tipoformacionac];
        $ngrupo = $row[ngrupo];
        $denominacion = $row[denominacion];
        $horastotales = $row[horastotales];
        $fechaini = $row[fechaini];
        $fechafin = $row[fechafin];
        $horariomini = $row[horariomini];
        $horariomfin = $row[horariomfin];
        $horariotini = $row[horariotini];
        $horariotfin = $row[horariotfin];
    }

    
?>

<div class="cartel page-hor">

    
    <div style="text-align: center; margin-top: 45px">
    <? if ( $naccion > 24999 ) { ?>
            <img width="250px" src="../img/logo.png" />
            <h2>FORMACIÓN PROGRAMADA SEGÚN LEY 30/2015</h2>
            <div style="border-top: 2px solid #ccc; border-bottom: 2px solid #ccc; margin-top: 55px; margin-bottom: 30px">
        <div style="margin-bottom: 20px; margin-top: 20px;">
            <h2>Expediente: B259530AF   -  Acción: <? echo($naccion) ?>  Grupo: <? echo $ngrupo ?> </h2><br> 
        </div>
        <? } else {if ( $naccion > 23999 ) { ?>
            <img width="250px" src="../img/logo.png" />
            <h2>FORMACIÓN PROGRAMADA SEGÚN LEY 30/2015</h2>
            <div style="border-top: 2px solid #ccc; border-bottom: 2px solid #ccc; margin-top: 55px; margin-bottom: 30px">
        <div style="margin-bottom: 20px; margin-top: 20px;">
            <h2>Expediente: B245287AF   -  Acción: <? echo($naccion) ?>  Grupo: <? echo $ngrupo ?> </h2><br> 
        </div>
        <? } else { 
        if ( $naccion > 22999 ) { ?>
            <img width="250px" src="../img/logo.png" />
            <h2>FORMACIÓN PROGRAMADA SEGÚN LEY 30/2015</h2>
            <div style="border-top: 2px solid #ccc; border-bottom: 2px solid #ccc; margin-top: 55px; margin-bottom: 30px">
        <div style="margin-bottom: 20px; margin-top: 20px;">
            <h2>Expediente: B239545AC   -  Acción: <? echo($naccion) ?>  Grupo: <? echo $ngrupo ?> </h2><br> 
        </div>
        <? } else { 

            if ( $naccion > 22000 ) { ?>
            <img width="250px" src="../img/logo.png" />
            <h2>FORMACIÓN PROGRAMADA SEGÚN LEY 30/2015</h2>
            <div style="border-top: 2px solid #ccc; border-bottom: 2px solid #ccc; margin-top: 55px; margin-bottom: 30px">
        <div style="margin-bottom: 20px; margin-top: 20px;">
            <h2>Expediente: B223451AB  -  Acción: <? echo($naccion) ?>  Grupo: <? echo $ngrupo ?> </h2><br> 
        </div>
        <? } else { if ( $tipoformacionac =='Valora' ) {?>
            <img width="250px" src="../img/Grupo-Valora.png" />
            
            <h2>FORMACIÓN PROGRAMADA SEGÚN LEY 30/2015</h2>
            <div style="border-top: 2px solid #ccc; border-bottom: 2px solid #ccc; margin-top: 55px; margin-bottom: 30px">
        <div style="margin-bottom: 20px; margin-top: 20px;">
            <h2>Expediente: B252902AM  -  Acción: <? echo($naccion) ?>  Grupo: <? echo $ngrupo ?> </h2><br> 
        <? } }}}}?>
    
        <div style="margin-bottom: 20px; margin-top: 20px;">
            
            <h2>Denominación de la Acción Formativa: <br><br> 
                <div style="text-align:center"><? echo $denominacion; ?></div>
            </h2><br><br>
            <h2>Fechas: Del <? echo date("d/m/Y", strtotime($fechaini)) ?> Al <? echo date("d/m/Y", strtotime($fechafin)) ?> </h2><br>
            <? if ($horariomini != '') { ?>
            <h2>Horario Sesión Turno 1: De <? echo $horariomini ?> A <? echo $horariomfin ?> </h2> <? } ?>
            <? if ($horariotini != '') { ?>
            <h2>Horario Sesión Turno 2: De <? echo $horariotini ?> A <? echo $horariotfin ?> </h2> <? } ?>
        </div>
    </div>  
    <!-- <div style="position: relative; text-align: center; margin-top: 70px; text-align: center"><img src="../img/LogoTripartita.png" /></div> -->

</div>

<!-- <script type="text/javascript">
window.onload = function () {
    window.print();
}
</script> -->

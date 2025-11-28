<?php

include ('functions/funciones.php');

$nopermitidos = array('ext_', 'n_', 'tutor');

if ( !strpos_arr($nopermitidos, $_SESSION['user']) ) {

?>

<div class="container">


<h3 style="margin-bottom:40px">Hola, <? echo $_SESSION['user'] ?> 👋 </h3>

<?php

$anio = $_SESSION['anio'];
echo $anio;
/** VACACIONES AÑO ACTUAL **/


// SALIDA
$q = 'SELECT n.nombre, v.dia_salida, v.dia_entrada, v.dias
FROM dias_vacaciones v, nominas_usuarios n
WHERE v.id_usuario = n.id
AND "'.date($anio.'-m-d').'" BETWEEN v.dia_salida AND DATE_SUB(v.dia_entrada, INTERVAL 1 DAY)
AND n.activo = 1';
    // echo $q;
//$link = mysqli_connect("edukateccxgs2019.mysql.db","edukateccxgs2019","Solutions2019","edukateccxgs2019");
$link = connectAnio($anio);
$q = mysqli_query($link, $q) or die("error select : " .mysqli_error($link));

$i = 0;

if ( mysqli_num_rows($q) > 0 ) {

    while ( $row = mysqli_fetch_assoc($q) ) {

        $vacas_anio[] = $row;

    }
}


/** VACACIONES AÑO ANTERIOR **/

$anio_ant = $anio - 1;
$link = connectAnio($anio_ant);

//SALIDA
$q = 'SELECT n.nombre, v.dia_salida, v.dia_entrada, v.dias
FROM dias_vacaciones v, nominas_usuarios n
WHERE v.id_usuario = n.id
AND "'.date($anio.'-m-d').'" BETWEEN v.dia_salida AND DATE_SUB(v.dia_entrada, INTERVAL 1 DAY)
AND n.activo = 1';
    // echo $q;
$q = mysqli_query($link, $q) or die("error select : " .mysqli_error($link));

$i = 0;

if ( mysqli_num_rows($q) > 0 ) {

    while ( $row = mysqli_fetch_assoc($q) ) {

        $vacas_anio[] = $row;

    }
}


if ( count($vacas_anio) > 0 ) {

    echo "<h4 style='margin-top: 50px;'>Hoy de vacaciones</h4>";
    $headers = array('Nombre', 'Fecha Salida', 'Fecha Entrada', 'Días');
    arrayTable($headers, $vacas_anio);
}



$link = connectAnio($anio);

$q = 'SELECT DISTINCT CONCAT(ac.numeroaccion, "/", ga.ngrupo), ac.modalidad, ac.denominacion, m.fechaini, m.fechafin
FROM acciones ac, matriculas m, grupos_acciones ga
WHERE m.id_grupo = ga.id
AND m.fechafin = "'.date($anio.'-m-d').'"
AND m.id_accion = ac.id
AND m.estado <> "Anulada"
ORDER BY modalidad';
$q = mysqli_query($link, $q) or die("error select : " .mysqli_error($link));

if ( mysqli_num_rows($q) > 0 ) {

    echo "<h4 style='margin-top: 50px;'>Cursos que finalizan hoy ".formateaFecha(date($anio.'-m-d'))."</h4>";

    while ( $row = mysqli_fetch_assoc($q) ) {

        $datos[] = $row;

    }

    $headers = array('AF', 'Modalidad', 'Denominación', 'Fecha Inicio', 'Fecha Fin');
    arrayTable($headers, $datos);

}

$datos = array();

$q = 'SELECT DISTINCT CONCAT(ac.numeroaccion, "/", ga.ngrupo), ac.modalidad, ac.denominacion, m.fechaini, m.fechafin
FROM acciones ac, matriculas m, grupos_acciones ga
WHERE m.id_grupo = ga.id
AND m.fechaini = "'.date($anio.'-m-d').'"
AND m.id_accion = ac.id
AND m.estado <> "Anulada"
ORDER BY modalidad';
$q = mysqli_query($link, $q) or die("error select : " .mysqli_error($link));

if ( mysqli_num_rows($q) > 0 ) {

    echo "<h4 style='margin-top: 50px;'>Cursos que empiezan hoy ".formateaFecha(date($anio.'-m-d'))."</h4>";

    while ( $row = mysqli_fetch_assoc($q) ) {

        $datos[] = $row;

    }

    $headers = array('AF', 'Modalidad', 'Denominación', 'Fecha Inicio', 'Fecha Fin');
    arrayTable($headers, $datos);

}

?>

</div>
<!-- <table class="table table-striped">


</table>

<div class="row">
    <div class="col-lg-2 col-sm-6">
        <div class="circle-tile">
            <a href="#">
                <div class="circle-tile-heading dark-blue">
                    <i class="fa fa-users fa-fw fa-3x"></i>
                </div>
            </a>
            <div class="circle-tile-content dark-blue">
                <div class="circle-tile-description text-faded">
                    Alumnos <? echo $gestion ?>
                </div>
                <div class="circle-tile-number text-faded">
                    265
                    <span id="sparklineA"></span>
                </div>
                <a href="#" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-sm-6">
        <div class="circle-tile">
            <a href="#">
                <div class="circle-tile-heading green">
                    <i class="fa fa-money fa-fw fa-3x"></i>
                </div>
            </a>
            <div class="circle-tile-content green">
                <div class="circle-tile-description text-faded">
                    Revenue
                </div>
                <div class="circle-tile-number text-faded">
                    $32,384
                </div>
                <a href="#" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-sm-6">
        <div class="circle-tile">
            <a href="#">
                <div class="circle-tile-heading orange">
                    <i class="fa fa-bell fa-fw fa-3x"></i>
                </div>
            </a>
            <div class="circle-tile-content orange">
                <div class="circle-tile-description text-faded">
                    Alerts
                </div>
                <div class="circle-tile-number text-faded">
                    9 New
                </div>
                <a href="#" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-sm-6">
        <div class="circle-tile">
            <a href="#">
                <div class="circle-tile-heading blue">
                    <i class="fa fa-tasks fa-fw fa-3x"></i>
                </div>
            </a>
            <div class="circle-tile-content blue">
                <div class="circle-tile-description text-faded">
                    Tasks
                </div>
                <div class="circle-tile-number text-faded">
                    10
                    <span id="sparklineB"></span>
                </div>
                <a href="#" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-sm-6">
        <div class="circle-tile">
            <a href="#">
                <div class="circle-tile-heading red">
                    <i class="fa fa-shopping-cart fa-fw fa-3x"></i>
                </div>
            </a>
            <div class="circle-tile-content red">
                <div class="circle-tile-description text-faded">
                    Orders
                </div>
                <div class="circle-tile-number text-faded">
                    24
                    <span id="sparklineC"></span>
                </div>
                <a href="#" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-sm-6">
        <div class="circle-tile">
            <a href="#">
                <div class="circle-tile-heading purple">
                    <i class="fa fa-comments fa-fw fa-3x"></i>
                </div>
            </a>
            <div class="circle-tile-content purple">
                <div class="circle-tile-description text-faded">
                    Mentions
                </div>
                <div class="circle-tile-number text-faded">
                    96
                    <span id="sparklineD"></span>
                </div>
                <a href="#" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
            </div>
        </div>
    </div>
</div>

<div class="clearfix"></div> -->

<? } ?>

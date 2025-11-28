
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
</head>


<script src="../../js/jquery-1.10.2.js"></script>
<script src="../../js/jquery.columnizer.js"></script>

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


    // window.print();
</script>


<style>

* {
    margin:0;
    padding:0;
    /*background-color: white !important;*/
    /*background-image: none !important;*/
    font-family: sans-serif;
}

.page {
    position: relative;
    overflow: auto;
    display: block;
    width: 21cm;
    height: 31.5cm;
    padding: 30px 50px 10px;
    background-image: url(../Fondo_Doc_2014.jpg);
    background-size: 24cm 32.5cm;
    margin-bottom: 50px;
    /*background-position: 0px 0 0 0;*/

}

.subpage {

    /*padding: 60px 30px;*/
    width: 19cm;
    height: 28cm;
    margin: auto;
    padding-top: 30px;
    /*border: 1px solid black;*/

}
.cabecera {
    overflow:  auto;
    margin-top: 20px;

}
@page {
    size: A4;
    margin: 0;
}

p {
    line-height: 1.8;
}

table {
    width: 100%;
    border-collapse: collapse;
}
table td {
    padding: 5px;
    border: 1px solid #ccc;
}

.contenidotxt {
    width: 720px;
    height: 550px;
    position: absolute;
    /*margin: 100px 0px 0px 100px;*/
}

</style>




<?



$baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
include_once($baseurl.'/functions/funciones.php');


setlocale(LC_TIME, "es_ES");

$id_mat = $_GET['id_matricula'];
// $id_emp = $_GET['id_empresa'];

$sql = 'SELECT a.nombre,a.apellido,a.apellido2,a.documento,e.razonsocial,e.cif,ac.horastotales,ac.modalidad,ac.denominacion,m.fechaini,m.fechafin,ac.objetivos,ac.contenido
FROM mat_alu_cta_emp ma, alumnos a, empresas e, matriculas m, acciones ac
WHERE ma.id_alumno = a.id
AND ac.id = m.id_accion
AND m.id = ma.id_matricula
AND ma.id_empresa = e.id
AND ma.id_matricula = '.$id_mat;
// echo $sql;
$sql = mysqli_query($link, $sql) or die('error');

while ( $r = mysqli_fetch_array($sql) ) {

    $alumno = $r[nombre].' '.$r[apellido].' '.$r[apellido2];
    $nif = $r[documento];
    $horas = $r[horastotales];
    $fechaini = formateaFecha($r[fechaini]);
    $fechafin = formateaFecha($r[fechafin]);
    $modalidad = $r[modalidad];
    $denominacion = $r[denominacion];
    $objetivos = $r[objetivos];
    $contenidos = $r[contenido];

    ?>
        <div class="page">

            <div class="subpage">
                <div class="cabecera">

                    <p style="background-color: #BB0313; padding: 5px 10px; color: #fff; text-align: center;"><strong>CERTIFICADO DE IMPARTICIÓN DE FORMACIÓN</strong></p>

                    <p style="margin-top: 20px;">Don <strong>Daniel Álvarez Benítez</strong> como responsable del centro <strong>ESCUELA SUPERIOR DE FORMACIÓN Y CUALIFICACIÓN DE CANARIAS, SL (ESFOCC)</strong> con código de identificación fiscal <strong>B76567718</strong>.</p>

                    <p style="margin-top: 10px;"><strong>CERTIFICA</strong> que se ha impartido la <strong>FORMACIÓN</strong> del trabajador <strong><? echo $alumno ?></strong> con documento nacional de identidad <strong><? echo $nif ?></strong> con duración de <strong><? echo $horas ?></strong> horas, en el periódo comprendido entre el <strong><? echo $fechaini ?></strong> hasta el <strong><? echo $fechafin ?></strong> en la formación de <strong><? echo $denominacion ?></strong> y en la modalidad de formación <strong><? echo $modalidad ?></strong> con el siguiente:</p>

                    <p style="margin-top: 30px">GRADO DE APROVECHAMIENTO: </p>
                    <input style="margin: 5px" type="checkbox" name="vehicle"> ALTO<br>
                    <input type="checkbox" style="margin: 5px" name="vehicle" checked="checked"> NORMAL <br>
                    <input type="checkbox" style="margin: 5px" name="vehicle"> BAJO<br>

                    <p style="margin-top: 40px">CONTENIDO FORMATIVO (ver dorso)</p>
                    <p style="margin-top: 15px">Y para que conste a los efectos que proceda, se expide el presente Certificado. <br>
                        En San Cristóbal de La Laguna, a <? echo date("d",strtotime($r[fechafin])) ?> de <? echo ucwords(strftime("%B",strtotime($r[fechafin]))) ?> de <? echo strftime("%Y",strtotime($r[fechafin])) ?></p>

                    <p style="margin-top: 60px; text-align: center"> EL RESPONSABLE DEL CENTRO</p>
                    <img style="text-align: center; width:230px; margin-left: 210px;" src="../../img/firma_admin_esfocc.png" alt="">
                    <p style="text-align: center">Fdo: Daniel Álvarez Benitez</p>

                </div>
            </div>

        </div>


        <!--  -->
        <!--  -->
        <!--  -->
        <!-- SEGUNDA PAGINA CERTIFICADO -->
        <!--  -->
        <!--  -->
        <!--  -->

        <div class="page">

            <div class="subpage">
                <div class="cabecera">

                    <p style="background-color: #BB0313; padding: 5px 10px; color: #fff; text-align: center;"><strong>CONTENIDO FORMATIVO</strong></p>

                    <p style="margin-top: 20px;color: #BB0313; "><strong><u>Objetivos:</u></strong></p>
                    <p style="font-size: 14px; text-align: left"><? echo nl2br($objetivos) ?></p>

                   <p style="margin-top: 20px;color: #BB0313;"><strong><u>Contenidos:</u></strong></p>
                   <div class="contenidotxt">
                    <div><? echo nl2br($contenidos) ?></div>
                   </div>


                </div>
            </div>



        </div>

<? } ?>




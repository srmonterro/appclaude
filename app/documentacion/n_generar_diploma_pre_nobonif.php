<?

$baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
include_once($baseurl.'/functions/funciones.php');
require_once($baseurl.'/plugins/PHPMailer/PHPMailerAutoload.php');
require_once($baseurl.'/plugins/html2pdf/html2pdf.class.php');

ob_start();

?>

<style>

table {
    width: 860px;
    height: 560px;
    position: fixed;
    margin: 110px 0px 0px 100px;

}
.alumno {
    position: relative;
    text-align: center;
    top: 195px;
    font-size: 32px;
}

.nif {
    position: absolute;
    top: 280px;
    margin-left: 150px;
    font-size: 16px;
}

.cif {
   position: absolute;
    top: 302px;
    margin-left: 150px;
    font-size: 16px;
}

.af {
    position: absolute;
    top: 323px;
    margin-left: 210px;
    font-size: 16px;
}

.razonsocial {
    position: absolute;
    top: 283px;
    width: 320px;
    margin-left: 695px;
    font-size: 16px;    
}

.denominacion {
    position: relative;
    text-align: center;
    top: 160px;
    font-size: 32px;
}

.duracion {
    position: absolute;
    top: 498px;
    margin-left: 222px;
    font-size: 16px;
}

.fechaini {
    position: absolute;
    top: 521px;
    margin-left: 195px;
    font-size: 16px;
}

.fechafin {
    position: absolute;
    top: 542px;
    margin-left: 237px;
    font-size: 16px;
}

.modalidad {
    position: absolute;
    top: 561px;
    margin-left: 166px;
    font-size: 16px;
}

.lugar {
    position: absolute;
    top: 524px;
    margin-left: 620px;
    font-size: 16px;
}

.dia {
    position: absolute;
    top: 524px;
    margin-left: 865px;
    font-size: 16px;
}

.mes {
    position: absolute;
    top: 524px;
    margin-left: 910px;
    font-size: 14px;
}
.anio {
    position: absolute;
    top: 526px;
    margin-left: 1011px;
    font-size: 16px;
}


</style>


<?


$gestion = devuelveAnioReal();

setlocale(LC_TIME, "es_ES");
$sec = explode("?",$_SERVER['HTTP_REFERER']);
$id_mat = $_GET['id_matricula'];
$modalidad = $_GET['modalidad'];


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

    
    if ( $modalidad == 'P' ) {

        if ( $incendios == 1 ) {

            if ( $nivel_incendios == "I" ) $clase = "./diplomas/dipfront_nobonif_incen1.png";
            else $clase = "./diplomas/dipfront_nobonif_incen2.png";

        } else $clase = "./diplomas/dipfront_nobonif.png"; 

    } else {

        if ( $incendios == 1 ) {

            if ( $nivel_incendios == "I" ) $clase = "front_bonif_incen1";
            else $clase = "front_bonif_incen2";
        } else $clase = "front_bonif"; 

    }

    
    $sql = 'SELECT DISTINCT a.nombre,a.apellido,a.apellido2,a.documento,e.razonsocial,e.cif 
    FROM mat_alu_cta_emp ma, alumnos a, empresas e 
    WHERE ma.id_alumno = a.id 
    AND ma.tipo = "Privado" 
    AND ma.id_matricula = '.$id_mat.' 
    AND ma.id_empresa = e.id';

    $sql = mysqli_query($link, $sql) or die ("error" . mysqli_error($link));

    // echo $naccion;

    while ($row = mysqli_fetch_array($sql)) { ?>
        
        <page backimg="<? echo $clase ?>">
            <div class="alumno"><? echo $row[nombre].' '.$row[apellido].' '.$row[apellido2] ?></div>
            <div class="nif"><? echo $row[documento] ?></div>
            <div class="cif"><? echo $row[cif] ?></div>                
            <div class="af"><? echo $naccion.'/'.$ngrupo ?></div>
            <div class="razonsocial"><? echo $row[razonsocial] ?></div>                        
            <div class="denominacion"><? echo $denominacion ?></div>
            <div class="duracion"><? echo $horastotales.' horas' ?></div>
            <div class="fechaini"><? echo date("d/m/Y",strtotime($fechaini)) ?></div>
            <div class="fechafin"><? echo date("d/m/Y",strtotime($fechafin)) ?></div>
            <div class="modalidad"><? echo $modalidad ?></div>
            <div class="lugar"><? echo $lugar ?></div>
            <div class="dia"><? echo date("d",strtotime($fechafin)) ?></div>
            <div class="mes"><? echo ucwords(strftime("%B",strtotime($fechafin))) ?></div>
            <div class="anio"><? echo strftime("%Y",strtotime($fechafin)) ?></div>
        </page>

        <page backimg="./diplomas/diploma_atras.png">
            <div class="contenidotxt">
                <? echo $htmldiploma ?>
            </div>
        </page>

        
    <? 

    }

    $content = ob_get_clean();
    $html2pdf = new HTML2PDF('L', 'A4', 'es', true, 'UTF-8', array(0, 0, 0, 0));
    // $html2pdf->setModeDebug();
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content);
    $html2pdf->Output($nombreFichero);

 

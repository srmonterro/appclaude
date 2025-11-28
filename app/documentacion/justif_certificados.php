<?
    $baseurl = $_SERVER['DOCUMENT_ROOT'].'/app';

    include_once($baseurl.'/functions/funciones.php');
    require_once($baseurl.'/plugins/html2pdf/html2pdf.class.php');

    $tipo = $_GET['tipo'];
    $id_mat = $_GET['id_matricula'];

    $gestion = devuelveAnio();
    if ( $gestion == 2014 )
        $finalizado = " ";
    else
        $finalizado = " AND ma.finalizado = 1 ";

    if ( $tipo == 'bonificado' ) {
    
            $q = 'SELECT DISTINCT a.*, e.*, m.*, ac.*, ga.ngrupo
            FROM mat_alu_cta_emp ma, alumnos a, empresas e, matriculas m, acciones ac, grupos_acciones ga
            WHERE ma.id_alumno = a.id 
            AND m.id = ma.id_matricula
            '.$finalizado.'
            AND m.id_accion = ac.id
            AND m.id_grupo = ga.id
            AND ma.tipo = "" 
            AND ma.id_matricula = '.$id_mat.' 
            AND ma.id_empresa = e.id';

    } else if ( $tipo == 'privado' ) {


            $q = 'SELECT DISTINCT a.*, e.*, m.*, ac.*, ga.ngrupo
            FROM mat_alu_cta_emp ma, alumnos a, empresas e, matriculas m, acciones ac, grupos_acciones ga
            WHERE ma.id_alumno = a.id 
            '.$finalizado.'
            AND m.id = ma.id_matricula
            AND m.id_accion = ac.id
            AND m.id_grupo = ga.id
            AND ma.tipo = "Privado" 
            AND ma.id_matricula = '.$id_mat.' 
            AND ma.id_empresa = e.id';
    }

    // echo $q;
    $q = mysqli_query($link, $q) or die ("error:" . mysqli_error($link));

    ob_start();
    while ( $row = mysqli_fetch_array($q) ) {

        $naccion = $row[numeroaccion];
        $ngrupo = $row[ngrupo];
        $denominacion = $row[denominacion];
        $horastotales = $row[horastotales];
        $fechaini = date("d/m/Y",strtotime($row[fechaini]));
        $fechafin = date("d/m/Y",strtotime($row[fechafin]));

        $alumno = $row[nombre].' '.$row[apellido].' '.$row[apellido2];
        $razonsocial = $row[razonsocial];
        $documento = $row[documento];
    
        
        // $pass = normaliza($row[nombre][0]).trim(normaliza(trim($row[apellido]))).'@'.substr($documento, 4,4);                    
        // $url2 = explode('.com/', $url);

        // if ( $url2[1][0] == 'e'  ) { // MOODLE

        //     $nombre = explode(" ", $row[nombre]);
        //     $nombre = $nombre[0];
        //     $user = normaliza($nombre).normaliza($row[apellido][0]);

        //     if ( $row[apellido2] != "" )
        //         $user .= normaliza($row[apellido2][0]).substr($documento, 1,4);
        //     else
        //         $user .= substr($documento, 1,4);

        //     $pass = strtoupper(normaliza($nombre[0])).trim(normaliza($row[apellido])).'@'.substr($documento, 4,4);   

        // } else { $user = $_GET['user']; }
    // $user = $row[user];
    // $pass = $row[pass];

    $nombreFichero = "JustifCertificado_".$naccion."-".$ngrupo."_".str_replace(' ', '-', quitaTildes($alumno)).".pdf"; 
    // echo $nombreFichero;
    

?>

<style type="text/Css">

* {
    margin:0;
    padding:0;
    /*font-family: 'Conv_estre',Sans-Serif;*/
}

.page-hor {
    position: relative;
    height: 28.5cm;
    width: 19.6cm; 
}


.encabezado {
    margin: auto;
}

.tituloguia {
    color: #87BE5E;
    margin-top: 200px;
    text-align: center;
} 

.indice {
    color: #87BE5E;
    border-bottom: 1px solid #ccc;
}

.cuadroindice {
    width: 490px;
    margin: 120px 115px;
}

ol { list-style-type: decimal }
ol.listaindice li {
    font-weight: bold;
    padding: 10px 10px 10px 0px;
    font-size: 16px;
}

ol.listaindice li ol li {
    padding-bottom: 0px;
    font-weight: normal;
}

ol.listaindice li ol li:first {
    padding-top: 5px;
}

.listadatos { width: 100%; border-collapse: collapse; }
.listadatos td {
    border-bottom: 1px solid #ccc;
    width: 50%;
    padding: 5px;
    font-size: 14px;
}
.listadatos td:nth-child(odd) {
    font-weight: bold;
}


.datosportada {
    margin-top: 20px;
    text-align: center;
}

.tituloseccion {
    page-break-before: always;
    color: #87BE5E;
    margin: 15px 0 10px 0;
}

p { 
    font-size: 15px; 
    line-height: 1.3;
    margin-bottom: 10px;
}

.listatexto {
    list-style-type: disc;    
}

.listatexto li {
    padding: 3px;
    font-size: 15px;
}

.circulo {
    right: 5px;
    text-align: center;
    margin: 0 10px 10px 0;
    position: relative;
    display: inline-block;
    width: 30px;
    height: 30px;
    /*padding: 5px;*/
    border-radius: 15px;
    border: 1px solid #87BE5E;
}

.pie {
    color: black; 
    font-weight: bold; 
    margin-top: 7px;
}
table.sinborde { margin-bottom: 10px; }
table.sinborde td { border: 0px; }

table.bordegris td { border: 1px solid #ccc; padding-top: 5px; }
table.bordegris th { border: 1px solid #ccc}

table.bordegris { border: 3px solid #ccc; color: #1B0085; font-weight: bold;}

.controlasist {
    color: #1B0085;
}


.tablacert {
    border-collapse: collapse;
}

.tablacert td {
    border: 1px solid #87BE5E;
    margin-top: 10px;
    text-align: center;
    padding: 5px;
}

.tablacert th {
    border: 2px solid #87BE5E;
    margin-top: 10px;
    text-align: center;
    padding: 5px;
}

</style>
    
    <page backleft="40px" backright="40px" backtop="140px" backbottom="60px">
        <page_header height="100px">        
            <div style="margin: 30px 0 0 30px">
                <img style="width: 200px" src="guias/img/logo.png" alt="">
                </div>
        </page_header>

        <div style="">
            <div style="margin-top: 20px;"><h2 style="text-align:center;">JUSTIFICANTE ENTREGA DE CERTIFICADO</h2></div>
        </div>
        
        
        <table class="sinborde" style="margin-top: 40px; width: 100%">
            
            <tr>
                <td style="width:70%">DENOMINACIÓN A.F.: <strong><? echo ($denominacion) ?></strong></td><td style="width:15%">A.F.: <strong><? echo ($naccion) ?></strong></td><td style="width:15%">GRUPO: <strong><? echo ($ngrupo) ?></strong></td>
            </tr>

        </table>

        <table class="sinborde" style="margin-top: 15px; width:100%;">
            <tr>
                <td style="width:33.33%">FECHA INICIO: <strong><? echo($fechaini); ?></strong></td><td style="width:33.33%">FECHA FIN: <strong><? echo($fechafin); ?></strong></td><td style="width:33.33%">FECHA: <strong><? echo($fechafin) ?></strong></td>
            </tr>
        </table>
        <table class="sinborde" style="margin-top: 15px; width:100%;">
            <tr>
                <td>EMPRESA: <strong><? echo $razonsocial; ?></strong></td>
            </tr>
        </table>
        
        <table class="tablacert" style="width:100%; margin-top: 25px;" >
            
            <tr>
                <th style="width: 5%;">Nº</th>  
                <th style="width: 45%;">NOMBRE</th>
                <th style="width: 25%;">NIF</th>
                <th style="width: 25%;">FIRMA</th>
            </tr>

            <? 
    
            $i = 1; ?>
            <tr><td><? echo $i++ ?></td><td><? echo( $alumno ) ?></td><td><? echo($documento) ?></td><td></td></tr>
                      
        </table>
        
    </page>

    

    <? }

        $content = ob_get_clean();
        // $html2pdf->setModeDebug();
        $html2pdf = new HTML2PDF('P', 'A4', 'es', true, 'UTF-8', array(0, 0, 0, 0));
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($content);
        // $html2pdf->createIndex('indice', 25, 12, false, true, 2);
        // $html2pdf->Output($nombreFichero,'D');
        $html2pdf->Output($nombreFichero);


<?
    $baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
// echo $baseurl;
    include_once($baseurl.'/functions/funciones.php');
    // require_once($baseurl.'/plugins/PHPMailer/PHPMailerAutoload.php');

    if ( file_exists($baseurl.'/plugins/html2pdf/html2pdf.class.php') )
        include_once($baseurl.'/plugins/html2pdf/html2pdf.class.php');
    // else 
    //     echo "nop";

    setlocale(LC_TIME, "es_ES");

    if ( isset($_GET[id_mat]) ) {
        $id_mat = $_GET[id_mat];
        rltod ($id_mat,$link);
     }
    

    function rltod ($id_mat) {

        // $id_mat = $_GET[id_mat];
        include_once($baseurl.'/functions/funciones.php');

        $sql = 'SELECT DISTINCT a.numeroaccion, a.denominacion, ga.ngrupo, m.fechaini, m.fechafin, e.razonsocial
            FROM matriculas m, acciones a, grupos_acciones ga, mat_alu_cta_emp ma, empresas e
            WHERE m.id_accion = a.id
            AND m.id_grupo = ga.id
            AND ma.id_matricula = m.id
            AND ma.id_empresa = e.id
            AND m.id ='.$id_mat;
            // echo $sql;
            $sql = mysqli_query($link, $sql) or die ("error");
            
        while ($row = mysqli_fetch_array($sql)) { 
            $naccion = $row[numeroaccion];
            $ngrupo = $row[ngrupo];
            $denominacion = $row[denominacion];
            $fechaini = date("d/m/Y",strtotime($row[fechaini]));
            $fechafin = date("d/m/Y",strtotime($row[fechafin]));
            $razonsocial = $row[razonsocial];
        }
        // echo $razonsocial;


        $nombreFichero = "x.pdf"; 

        ob_start();

    ?>


    <style type="text/Css">

    * {
        margin:0;
        padding:0;
        line-height: 1.5;
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
        color: #C80000;
        margin-top: 200px;
        text-align: center;
    } 

    .indice {
        color: #C80000;
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
        color: #C80000;
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
        border: 1px solid #C80000;
    }

    .pie {
        color: black; 
        font-weight: bold; 
        margin-top: 7px;
    }


    </style>



        <!--  -->
        <!--  -->
        <!-- RLT -->
        <!--  -->
        <!--  -->
        
        <page backleft="40px" backright="40px" backtop="140px" backbottom="60px">
            <page_header height="100px">        
                <div style="margin: 30px 0 0 30px">
                    <!-- <img style="width: 200px" src="guias/img/esfocclogo.png" alt=""> --></div>
            </page_header>

            <div style="">
                <div style="margin-top: 20px;"><h2 style="text-align:center;">REPRESENTACIÓN LEGAL DE LOS TRABAJADORES</h2></div>
            </div>
            
            <div style="width:100%; margin-top: 50px; ">
                D. <div style="width: 695px; margin-left: 5px; margin-top: 12px; border-bottom:1px solid black"></div>
                <p>como Representante Legal de los Trabajadores de la Empresa <? echo $razonsocial ?> manifiesta haber recibido la propuesta de la acción formativa <? echo $naccion.'.'.$ngrupo ?> del curso <? echo $denominacion ?> , que se celebrará del <? echo $fechaini ?> hasta el <? echo $fechafin ?>, ante el cual da su:</p>
            </div>
            
            <div style="margin: 60px 0 60px 0">
                <table>
                    <tr>
                        <td>
                            <div style="width: 15px; height: 15px; border:1px solid black; background-color: #fff"></div>
                        </td> 
                        <td>
                            <p>&nbsp;Conformidad</p>
                        </td>
                    </tr>
                    <tr style="margin-top: 20px; ">
                        <td>
                            <div style="margin-top: 10px; width: 15px; height: 15px; border:1px solid black; background-color: #fff"></div>
                        </td> 
                        <td>
                            <p style="margin-top: 10px;">&nbsp;Disconformidad</p>
                        </td>
                    </tr>
                 </table>
            </div>        

            <p>Y para que conste a efectos oportunos lo firmo en</p><br>
            <table>
                <td style="width: 300px; border-bottom: 1px solid black"></td><td>&nbsp; a &nbsp;</td> <td style="width: 70px; border-bottom: 1px solid black"></td> <td>&nbsp; de &nbsp;</td> <td style="width: 210px; border-bottom: 1px solid black"></td> <td> &nbsp; de &nbsp;<? echo date("Y"); ?></td>
            </table>

            <div style="margin-top: 90px">
                <table>
                    <td style="width: 60px;"></td><td>Por la R.L.T</td><td style="width: 400px;"></td>
                    <td>Por la empresa</td><td></td>
                </table>
            </div>

        </page>
        

    <?

        $content = ob_get_clean();    
        $html2pdf = new HTML2PDF('P', 'A4', 'es', true, 'UTF-8', array(0, 0, 0, 0));
        // $html2pdf->setModeDebug();
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($content);
        // $html2pdf->createIndex('indice', 25, 12, false, true, 2);
        $html2pdf->Output($nombreFichero);

} ?>
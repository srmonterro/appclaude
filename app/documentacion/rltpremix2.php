<? 
    $baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
    include_once($baseurl.'/functions/funciones.php');
    include_once($baseurl.'/plugins/html2pdf/html2pdf.class.php');

ob_start(); ?>

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
    ol li { font-size: 15px; padding-bottom: 10px;}

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
        <?

                $anio = 2015;
                include_once('../functions/connect.php');
        
                $tipo = $_GET[tipo];

                if ( $tipo == "P" )

                    $sql = 'SELECT DISTINCT a.numeroaccion, a.denominacion, ga.ngrupo, m.fechaini, m.fechafin, e.razonsocial, m.comercial, e.*
                    FROM matriculas m, acciones a, grupos_acciones ga, ptemp_mat_emp ma, empresas e
                    WHERE m.id_accion = a.id
                    AND m.id_grupo = ga.id
                    AND ma.id_matricula = m.id
                    AND ma.id_empresa = e.id
                    AND e.id = '.$_GET[id_emp].'
                    AND m.id = '.$_GET[id_mat];                    

                else if ( $tipo == "G" )

                    $sql = 'SELECT DISTINCT a.numeroaccion, a.denominacion, ga.ngrupo, m.fechaini, m.fechafin, e.razonsocial, m.comercial, e.*
                    FROM matriculas m, acciones a, grupos_acciones ga, otemp_mat_emp ma, empresas e
                    WHERE m.id_accion = a.id
                    AND m.id_grupo = ga.id
                    AND ma.id_matricula = m.id
                    AND ma.id_empresa = e.id
                    AND e.id = '.$_GET[id_emp].'
                    AND m.id = '.$_GET[id_mat];  

                else       

                    $sql = 'SELECT DISTINCT a.numeroaccion, a.denominacion, ga.ngrupo, m.fechaini, m.fechafin, e.razonsocial, m.comercial, e.*
                    FROM matriculas m, acciones a, grupos_acciones ga, mat_alu_cta_emp ma, empresas e
                    WHERE m.id_accion = a.id
                    AND m.id_grupo = ga.id
                    AND ma.id_matricula = m.id
                    AND ma.id_empresa = e.id
                    AND e.id = '.$_GET[id_emp].'
                    AND m.id = '.$_GET[id_mat];              

			   	// echo $sql; 
			   	$sql = mysqli_query($link, $sql) or die ("error".mysqli_error($link) );
			            
			    while ($row = mysqli_fetch_array($sql)) { 

                    $fechaini = $row[fechaini];
                    $fecha15 = date('Y-m-d', strtotime('-15 day', strtotime($fechaini)));

                ?>
			       
			       <page backleft="40px" backright="40px" backtop="50px" backbottom="60px">

			            <div style="">
			                <div style="margin-top: 20px;"><h3 style="text-align:center;">INFORMACIÓN A LA REPRESENTACIÓN LEGAL TRABAJADORES</h3></div>
			            </div>
                        <p style="margin-top: 50px"><h4>Datos de la empresa</h4></p>
                        <p>Razón Social: <? echo $row[razonsocial] ?></p>
                        <p>CIF/NIF: <? echo $row[cif] ?> </p>
                        <p>Domicilio: <? echo $row[domiciliosocial] ?></p>
			            
			            <div style="width:100%; margin-top: 50px; ">
			                <p>De conformidad con el Art. 15 apartado 1 del RD 395/2007  de 23 de marzo, por el que se regula el subsistema de formación  profesional  para el empleo, la Representación Legal de los Trabajadores declara que, con fecha <? echo formateaFecha($fecha15) ?>, la empresa ha proporcionado la siguiente información sobre la acción formativa <? echo $row[numeroaccion].'/'.$row[ngrupo] ?> del curso <? echo $row[denominacion] ?> de formación continua:</p>
			            </div>
			            
                        <ol>
                            <li>Denominación, objetivos y descripción de las acciones a desarrollar.</li>
                            <li>Colectivos destinatarios y número de participantes por acciones.</li>
                            <li>Calendario previsto de ejecución.</li>
                            <li>Medios pedagógicos.</li>
                            <li>Criterios de selección de los participantes.</li>
                            <li>Lugar previsto de impartición de las acciones formativas.</li>
                            <li>Balance de las acciones formativas desarrolladas en el ejercicio precedente.</li>
                        </ol>
			            

                        <p style="margin-top: 25px">Nombre y apellidos:     </p>
                        <p>CIF/NIF: </p>
                        <p>Firma original:</p>


                        <p style="margin: 25px 0 25px 0">Acuse de recibo por parte de la R.L.T.:</p>
                        <p>Nombre y apellidos:</p>
                        <p>NIF: </p>
                        <p>Firma original:</p>


			        </page>

			        <?
			       


	    	}


	    $content = ob_get_clean();    
        $html2pdf = new HTML2PDF('P', 'A4', 'es', true, 'UTF-8', array(0, 0, 0, 0));
        // $html2pdf->setModeDebug();
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($content);
        // $html2pdf->createIndex('indice', 25, 12, false, true, 2);
        $html2pdf->Output($nombreFichero);  
			       
			       // $html2pdf->setModeDebug(true);
			       
        
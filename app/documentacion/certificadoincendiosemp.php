
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
    overflow: auto;
    display: block;
    width: 21cm;
    height: 31.5cm; 
    padding: 30px 50px 5px;
    
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

</style>

<?

include '../functions/funciones.php';
$gestion = devuelveAnio();

setlocale(LC_TIME, "es_ES");

$id_mat = $_GET['id_matricula'];
$id_emp = $_GET['id_empresa'];

    $sql = 'SELECT DISTINCT a.numeroaccion, a.denominacion, LPAD(m.grupoincendios, 4, 0) as grupoincendios, m.fechafin, m.fechaini, a.nivel_incendios
    FROM matriculas m, acciones a, grupos_acciones ga 
    WHERE m.id_accion = a.id
    AND m.id_grupo = ga.id
    AND m.id ='.$id_mat;
    // echo $sql;
    $sql = mysqli_query($link, $sql) or die ("error");

    if ( mysqli_num_rows($sql) < 1 ) {

        $actual = date('Y');
        $anio = $actual - 1;

        if ( $anio != "" )
            include_once '../functions/connect.php';

        $sql = 'SELECT DISTINCT a.numeroaccion, a.denominacion, LPAD(m.grupoincendios, 4, 0) as grupoincendios, m.fechafin, m.fechaini, a.nivel_incendios
        FROM matriculas m, acciones a, grupos_acciones ga 
        WHERE m.id_accion = a.id
        AND m.id_grupo = ga.id
        AND m.id ='.$id_mat;
        // echo $sql;
        $sql = mysqli_query($link, $sql) or die ("error");

    }
    
    while ($row = mysqli_fetch_array($sql)) { 
        $naccion = $row[numeroaccion];
        $denominacion = $row[denominacion];
        $fechaini = $row[fechaini];
        $fechafin = $row[fechafin];
        $ncertificado = $row[grupoincendios];
        $nivel_incendios = $row[nivel_incendios];
    }

    if ( $gestion == 2014 )
        $nivel = nivelFormacion($naccion);
    else
        $nivel = $nivel_incendios;



    $q = 'SELECT DISTINCT ma.id_empresa, @id_emp:=e.id, e.razonsocial, e.cif, 
    (SELECT count(id_alumno) 
    FROM mat_alu_cta_emp ma 
    WHERE ma.id_matricula = '.$id_mat.' 
    AND ma.id_empresa = '.$id_emp.' ) as nalumnos
    FROM mat_alu_cta_emp ma, empresas e
    WHERE ma.id_empresa = e.id 
    AND ma.id_matricula = '.$id_mat.' 
    AND ma.id_empresa = '.$id_emp;
    // echo $q;
    $q = mysqli_query($link, $q);

    while ( $row = mysqli_fetch_array($q) ) { 

        if ( $row[nalumnos] > 12 ) { 
            $fuente = '9px';
            $fuentep = '12px';
            $margintop = 'margin-top: 5px; font-size: 13px; text-align: center';
        } else
            $margintop = 'margin-top: 15px; font-size: 14px; text-align: center';

        ?>

        <div class="page">

            <div class="cabecera">

                <img style="width: 280px; float:left" src="/app/img/esfocclogo.png">
                <img style="width: 120px; margin-top: 5px; float:right" src="/app/img/gobcanarias.png">

            </div>

            <div id="icasel" style="margin-top:25px; overflow:auto; font-size:12px; <? echo $icaselno ?>">
                <P style="font-weight: bold; float:left; text-align: left; margin-left: 48px">FORMACIÓN CONTRA INCENDIOS</P>
                <P style="float:right; font-weight: bold;  text-align: rigth; margin-right: 43px">R/26</P>
            </div>

            <div style="float:none; margin-top:60px;" class="cuerpo">

                <p style="font-weight: bold; margin-bottom: 50px">Certificado nº: <? echo $ncertificado ?></p>

                <p style="margin-bottom: 90px; "><strong>Don José Daniel Álvarez Benítez, con DNI 78565562T</strong> en calidad de Administrador de la empresa ESCUELA SUPERIOR DE FORMACIÓN Y CUALIFICACIÓN S.L, con 
                CIF B76567718 Entidad colaboradora del Instituto Canario de Seguridad Laboral, con autorización número 26.</p> 

                <p style="text-align:center; text-decoration: underline; font-weight:bold; font-size: 22px; margin-bottom: 30px;">CERTIFICA QUE:</p>
                <p style="margin-bottom: 25px">En cumplimiento de lo establecido en el Decreto 305/1996, del 23 de diciembre sobre las medidas de Seguridad y Protección Contra Incendios
                 en establecimientos turísticos, modificado por el decreto 39/1997, de 20 de Marzo, se ha impartido curso de 
                 formación <strong>NIVEL <? echo $nivel ?>  a trabajadores pertenecientes a la empresa:</strong> </p> 

                <table style="margin-bottom: 55px">
                   <tr>
                       <td><strong>NOMBRE DE LA EMPRESA:</strong> </td><td><? echo $row[razonsocial] ?></td>
                   </tr>
                <tr>
                   <td><strong>CIF:</strong> </td><td><? echo $row[cif] ?></td>
                </tr>
               
                <tr>
                   <td><strong>DENOMINACIÓN COMERCIAL:</strong> </td><td><? echo $row[nombrecomercial] ?></td>
                </tr>
               
                <tr>
                   <td><strong>NÚMERO DE ALUMNOS FORMADOS:</strong> </td><td><? echo $row[nalumnos] ?></td>
                </tr>
                </table>
                
                <P>
                    Certificado que se emite a solicitud de la parte interesada en Santa Cruz de Tenerife, a <? echo date("d", strtotime($fechafin)).' de '. ucwords(strftime("%B", strtotime($fechafin))).' de '. date("Y",strtotime($fechafin))?>
                </P>
                
                <div style="text-align: center;">
                    <img style="width:200px; margin: 5px 75px 3px 0px" src="/app/img/firma_admin_esfocc.png">
                </div>
                
                <p style="line-height: 1.3;text-align: center">J.Daniel Álvarez Benítez<br>
                 Administrador Escuela Superior de Formación y Cualificación S.L.</p>  

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

                <div class="cabecera">

                    <img style="width: 280px; float:left" src="/app/img/esfocclogo.png">
                    <img style="width: 120px; margin-top: 5px; float:right" src="/app/img/gobcanarias.png">

                </div>

                <div id="icasel" style="margin-top:15px; overflow:auto; font-size:12px; <? echo $icaselno ?>">
                    <P style="font-weight: bold; float:left; text-align: left; margin-left: 48px">FORMACIÓN CONTRA INCENDIOS</P>
                    <P style="float:right; font-weight: bold;  text-align: rigth; margin-right: 43px">R/26</P>
                </div>

                <div style="float:none; margin-top:20px;" class="cuerpo">

                    <p style="font-weight: bold; margin-bottom: 20px">Nº Registro: <? echo $ncertificado ?></p>

                    <p style="text-align:center; text-decoration: underline; font-weight:bold; font-size: 20px; margin-bottom: 10px;">
                        Registro de Entrega de Certificados cursos Seguridad Contra Incendios Nivel <? echo $nivel ?>:</p>

                    <p style="margin-bottom: 15px; font-size: <? echo $fuentep ?> "><strong>Don José Daniel Álvarez Benítez, con DNI 78565562T</strong> en calidad de Administrador de la empresa ESCUELA SUPERIOR DE FORMACIÓN Y CUALIFICACIÓN S.L, con 
                    CIF B76567718, empresa autorizada por el Instituto Canario de Seguridad laboral del Gobierno <strong>Certifica</strong> que los alumnos que se mencionan a continuación han recibido la formación
                    correspondiente al nivel <? echo $nivel ?> de Seguridad Contra Incendios, de acuerdo a lo establecido en el decreto 305/96 de 26 de diciembre.
                    </p> 

                    <table style="width: 100%; margin-bottom: 20px; font-size: <? echo $fuente ?>">
                       <tr>
                           <td><strong>Empresa:</strong> </td><td><? echo $row[razonsocial] ?></td><td><strong>CIF:</strong></td><td><? echo $row[cif] ?></td>
                       </tr>
                    </table>

                    <?

                    $q1 = 'SELECT a.nombre, a.apellido, a.apellido2, a.documento, LPAD(ma.codiploma, 5,0) as codiploma, 
                    (SELECT LPAD(grupoincendios, 4, 0) FROM matriculas WHERE id = '.$id_mat.' ) as grupoincendios
                    FROM mat_alu_cta_emp ma, alumnos a
                    WHERE ma.id_alumno = a.id 
                    AND ma.id_empresa = '.$row[id_empresa].' 
                    AND ma.id_matricula = '.$id_mat;
                    // echo $q1;
                    $q1 = mysqli_query($link, $q1);
                    $i = 0;

                    echo '
                    <table style="width: 100%; font-size:'; echo $fuente .'">
                        <thead>
                            <th>Nº</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>DNI/NIE</th>
                            <th>Cod. Diploma</th>
                            <th>Fecha</th>
                        </thead>';
                    while ( $r = mysqli_fetch_array($q1) ) { ++$i; ?>
                        
                        
                        <tr>
                            <td><? echo $i ?></td>
                            <td><? echo $r[nombre] ?></td>
                            <td><? echo $r[apellido].' '.$r[apellido2] ?></td>
                            <td><? echo $r[documento] ?></td>
                            <td><? echo $r[grupoincendios].'/'.date("Y",strtotime($fechafin)).'/'.$nivel.'/'.$r[codiploma] ?></td>
                            <td><? echo date("d/m/Y", strtotime($fechafin)) ?></td>
                        </tr>                    

                    <? } ?>
                    </table>
                    
                    <P style="<? echo $margintop ?> ">
                    Certificado que se emite a solicitud de la parte interesada en Santa Cruz de Tenerife, a <? echo date("d", strtotime($fechafin)).' de '. ucwords(strftime("%B", strtotime($fechafin))).' de '. date("Y",strtotime($fechafin))?>
                </P>
                
                <div style="text-align: center;">
                    <img style="width:200px; margin: 5px 75px 3px 0px" src="/app/img/firma_admin_esfocc.png">
                </div>
                
                <p style="line-height: 1.3; <? echo $margintop ?>">J.Daniel Álvarez Benítez<br>
                 Administrador Escuela Superior de Formación y Cualificación S.L.</p>  

                </div>
        </div>
        
    <? } ?>

<script type="text/javascript">
    window.print();
</script>


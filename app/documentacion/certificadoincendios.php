
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
    page-break-after: always;

}
.page2 {
    position: relative;
    overflow: auto;
    display: block;
    width: 21cm;
    height: 31.5cm;
    padding: 30px 50px 5px;
    page-break-after: always;

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


setlocale(LC_TIME, "es_ES");

$id_mat = $_GET['id_matricula'];

$sql = 'SELECT DISTINCT a.numeroaccion, a.denominacion, a.modalidad, a.horastotales, ga.ngrupo, LPAD(m.grupoincendios, 5, 0) as grupoincendios, m.fechafin, m.fechaini
    FROM matriculas m, acciones a, grupos_acciones ga
    WHERE m.id_accion = a.id
    AND m.id_grupo = ga.id
    AND m.id ='.$id_mat;
    // echo $sql;
    $sql = mysqli_query($link, $sql) or die ("error1");

    while ($row = mysqli_fetch_array($sql)) {
        $naccion = $row[numeroaccion];
        $denominacion = $row[denominacion];
        $modalidad = $row[modalidad];
        $horas = $row[horastotales];
        $ngrupo= $row[ngrupo];
        $fechaini = $row[fechaini];
        $fechafin = $row[fechafin];
        $ncertificado = $row[grupoincendios];
        $nivel = $row[nivel_incendios];
        
    }

    if ( $gestion == 2014 )
        $nivel = nivelFormacion($naccion);
    else
        $nivel = $nivel_incendios;


    // if ( $naccion == '1001' ) $icaselno = 'display:none';

    $q = 'SELECT DISTINCT ma.id_empresa, ma.finalizado, @id_emp:=e.id, e.razonsocial, e.cif,
    (SELECT count(id_alumno)
    FROM mat_alu_cta_emp ma
    WHERE ma.id_matricula = '.$id_mat.'
    AND ma.finalizado = 1
    AND ma.id_empresa = @id_emp) as nalumnos
    FROM mat_alu_cta_emp ma, empresas e
    WHERE ma.id_empresa = e.id
    AND ma.finalizado = 1
    AND ma.id_matricula = '.$id_mat;
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

                <img style="width: 280px; float:left" src="/app/img/logo.png">
                

            </div>

            

            <div style="float:none; margin-top:60px;" class="cuerpo">

                <p style="margin-bottom: 60px;"><strong>Doña Ana Isabel Alves Vieira, con NIE X7142443T</strong> en calidad de Administradora de la empresa de formación EDUKA-TE SOLUTIONS,  S.L.U., con CIF B76757764.</p>

                <p style="text-align:center; text-decoration: underline; font-weight:bold; font-size: 22px; margin-bottom: 30px;">CERTIFICA QUE:</p>
                <p style="margin-bottom: 25px">EDUKA-TE SOLUTIONS ha impartido el curso de
                 formación denominado <strong><? echo $denominacion ?> </strong> del <? echo formateaFecha($fechaini) ?> al <? echo formateaFecha($fechafin) ?> a trabajadores pertenecientes a la empresa:</strong> </p>

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
                <tr>
                   <td><strong>ACCIÓN/GRUPO FORMATIVO:</strong> </td><td><? echo $naccion.'/'.$ngrupo ?></td>
                </tr>
                <tr>
                   <td><strong>DENOMINACIÓN DEL CURSO:</strong> </td><td><? echo $denominacion ?></td>
                </tr>
                <tr>
                   <td><strong>MODALIDAD:</strong> </td><td><? echo $modalidad ?></td>
                </tr>
                <tr>
                   <td><strong>DURACIÓN DEL CURSO (horas):</strong> </td><td><? echo $horas ?></td>
                </tr>
                </table>

                <P style="">
                    Certificado que se emite a solicitud de la parte interesada en Costa Adeje, a <? echo date("d", strtotime($fechafin)).' de '. ucwords(strftime("%B", strtotime($fechafin))).' de '. date("Y",strtotime($fechafin))?>
                </P>

                <div style="text-align: center;">
                    <img style="width:200px; margin: 5px 10px 3px 0px" src="/app/img/firma_admin.jpg">
                </div>

                <p style="line-height: 1.3; text-align: center">Ana Isabel Alves Vieira<br>
                 Eduka-te Solutions, S.L.U.</p>

            </div>

        </div>


        <!--  -->
        <!--  -->
        <!--  -->
        <!-- SEGUNDA PAGINA CERTIFICADO -->
        <!--  -->
        <!--  -->
        <!--  -->
<page>
        <div class="page">

                <div class="cabecera">

                    <img style="width: 280px; float:left" src="/app/img/logo.png">
                    

                </div>

                

                <div style="float:none; margin-top:20px; " class="cuerpo">

                   <p style="text-align:center;  font-weight:bold; font-size: 20px; margin-bottom: 10px;">
                        Certificado de realización del Curso <br><? echo $denominacion ?></p>

                    <p style="margin-bottom: 15px; font-size: <? echo $fuentep ?> "><strong>Doña Ana Isabel Alves Vieira, con NIE X7142443T</strong> en calidad de Administradora de la empresa de formación EDUKA-TE SOLUTIONS,  S.L.U., con CIF B76757764. <strong>certifica</strong> que los alumnos que se mencionan a continuación <strong>han realizado con aprovechamiento </strong>la formación
                    correspondiente al curso  <? echo $denominacion ?>.
                    </p>

                    <table style="width: 100%; margin-bottom: 20px; font-size: <? echo $fuente ?> "">
                       <tr>
                           <td><strong>Empresa:</strong> </td><td><? echo $row[razonsocial] ?></td><td><strong>CIF:</strong></td><td><? echo $row[cif] ?></td>
                       </tr>
                    </table>

                    <?

                    $q1 = 'SELECT a.nombre, a.apellido, a.apellido2, a.documento, ma.finalizado,  LPAD(ma.codiploma, 5, 0) as codiploma,
                    (SELECT LPAD(grupoincendios, 4, 0) FROM matriculas WHERE id = '.$id_mat.' ) as grupoincendios
                    FROM mat_alu_cta_emp ma, alumnos a
                    WHERE ma.id_alumno = a.id
                    AND ma.finalizado = 1
                    AND ma.id_empresa = '.$row[id_empresa].'
                    AND ma.id_matricula = '.$id_mat;
                    
                    $q1 = mysqli_query($link, $q1);
                    $i = 0;

                    echo '
                    <table style="width: 100%; font-size:'; echo $fuente .'">
                        <thead>
                            <th>Nº</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>DNI/NIE</th>
                            
                        </thead>';
                   
                    while ( $i<31 and $r = mysqli_fetch_array($q1)  ) { ++$i;  ?>

                        
                        <tr>
                            <td style="text-align:center"><? echo $i ?></td>
                            <td><? echo $r[nombre] ?></td>
                            <td><? echo $r[apellido].' '.$r[apellido2] ?></td>
                            <td style="text-align:center"><? echo $r[documento] ?></td>
                            
                        </tr>

                    <? }?>
                    </table>
                    <br><br>
                    <P style="">
                <!--  <P style=" meter aqui el echo margintop de la línea 314">-->
                    Certificado que se emite a solicitud de la parte interesada en Costa Adeje, a <? echo date("d", strtotime($fechafin)).' de '. ucwords(strftime("%B", strtotime($fechafin))).' de '. date("Y",strtotime($fechafin))?>
                </P>

                <div style="text-align: center;">
                    <img style="width:200px; margin: 5px 10px 3px 0px" src="/app/img/firma_admin.jpg">
                </div>

                <p style="line-height: 1.3; <? echo $margintop ?>">Ana Isabel Alves Vieira<br>
                 Eduka-te Solutions, S.L.U.</p>
</div>
</div>
</page>
<page>
            <div class="page">

                <div class="cabecera">

                    <img style="width: 280px; float:left" src="/app/img/logo.png">
                    

                </div>

                

                <div style="float:none; margin-top:20px; " class="cuerpo">

                   <p style="text-align:center;  font-weight:bold; font-size: 20px; margin-bottom: 10px;">
                        Certificado de realización del Curso <br><? echo $denominacion ?></p>
               
               
<?
               
               echo '
                    <table style="width: 100%; font-size:'; echo $fuente .'">
                        <thead>
                            <th>Nº</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>DNI/NIE</th>
                            
                        </thead>';
                   
                    
                    while ( $r = mysqli_fetch_array($q1) ) { ++$i;  ?>

                        
                        <tr>
                            <td style="text-align:center"><? echo $i ?></td>
                            <td><? echo $r[nombre] ?></td>
                            <td><? echo $r[apellido].' '.$r[apellido2] ?></td>
                            <td style="text-align:center"><? echo $r[documento] ?></td>
                            
                        </tr>

                    <? }?>
                    </table>

                 <P style="">
                <!--  <P style=" meter aqui el echo margintop de la línea 314">-->
                    Certificado que se emite a solicitud de la parte interesada en Costa Adeje, a <? echo date("d", strtotime($fechafin)).' de '. ucwords(strftime("%B", strtotime($fechafin))).' de '. date("Y",strtotime($fechafin))?>
                </P>

                <div style="text-align: center;">
                    <img style="width:200px; margin: 5px 10px 3px 0px" src="/app/img/firma_admin.jpg">
                </div>

                <p style="line-height: 1.3; <? echo $margintop ?>">Ana Isabel Alves Vieira<br>
                 Eduka-te Solutions, S.L.U.</p>


                </div>
        </div>
</div>
    <? } ?>
</page>
<script type="text/javascript">
    window.print();
</script>

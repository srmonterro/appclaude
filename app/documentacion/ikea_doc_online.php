<? 

$baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
include_once($baseurl.'/functions/funciones.php');
include_once($baseurl.'/plugins/html2pdf/html2pdf.class.php');

ob_start();

?>

<style>

p { font-size: 15px; margin: 5px }
th, td { padding: 5px; }
table { font-size: 12px; border-collapse: collapse; }
table.ikearlt td {border: 1px solid #000; height: 25px;}
table.ikearlt th {border: 3px solid #000}

ol li { font-size: 15px; padding: 5px}

</style>

<?

$id_mat = $_GET[id_mat];

$rlt = 0;
$cc = array('0700106564752', '35109679860');
$colectivos = array();


$sql = 'SELECT DISTINCT a.numeroaccion, a.denominacion, a.horastotales, a.modalidad, ga.ngrupo, a.objetivos, al.categoriaprofesional, ma.numerocuenta,
    m.fechaini, m.fechafin, m.horariomini, m.horariomfin, m.horariotini, m.horariotfin, m.diascheck, m.estado, d.*, m.solicitud, e.*, al.nombre as nombrealu, al.apellido as apellidoalu, al.apellido2 as apellido2alu
    FROM matriculas m, acciones a, grupos_acciones ga, docentes d, mat_doc md, mat_alu_cta_emp ma, alumnos al, empresas e
    WHERE m.id_accion = a.id
    AND ma.id_matricula = m.id
    AND ma.id_alumno = al.id
    AND ma.id_empresa = e.id
    AND md.id_matricula = m.id
    AND d.id = md.id_docente
    AND m.id_grupo = ga.id
    AND m.id ='.$id_mat;
    // echo $sql;

    $sql = mysqli_query($link, $sql) or die ("error: ". mysqli_error($link) );
    $numalumnos = mysqli_num_rows($sql);

    $i = 0;
    while ($row = mysqli_fetch_assoc($sql)) {

      // echo "<pre>";
      // print_r($row);
      // echo "</pre>";
      $i++;

      $separa = "";
      if ( !in_array($row[categoriaprofesional], $colectivos) ) {
          $colectivos[$i] = $row[categoriaprofesional];
          $separa = ' / ';
      }

      $colectivostr .= devuelveColectivoIKEA( $colectivos[$i] ).$separa;
       
      if ( count($colectivos) == 1 ) $colectivostr = substr($colectivostr, 0, -2);

      $numerocuenta = str_replace(" ", "", $row[numerocuenta]);
      // echo $numerocuenta;

      if ( in_array($numerocuenta, $cc) ) $rlt = 1;

      $representacionlegal = $row[representacionlegal];
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
      $diascheck = $row[diascheck];
      $estado = $row[estado];
      $solicitud = $row[solicitud];
      $objetivos = $row[objetivos];
      $docente = $row[nombre]. ' ' . $row[apellido]. ' ' . $row[apellido2];

      if ( $horariomini !== "" )
          $horario = $horariomini.' - '.$horariomfin;
      if ( $horariomini !== "" && $horariotini !== "" )
          $horario .= ' | ';
      if ( $horariotini != "" )
          $horario .= $horariotini.' - '.$horariotfin;



if ( $representacionlegal == 1 ) { ?>

<page backleft="40px" backright="40px" backtop="30px" backbottom="30px"> 

  <!-- <div style="margin:0px 0 20px 0px;"><img width="170px" src="../img/LogoTripartita.png" /></div> -->
  <h3 style="text-align:center;margin-bottom: 30px">Información a la Representación Legal Trabajadores</h3>
  
  <h4 style="">Datos de la empresa</h4>
    <p>Razón: <? echo $row[razonsocial] ?></p>
    <p>CIF/NIF: <? echo $row[cif] ?></p>
    <p>Centro de Trabajo: <? echo $centro ?></p>
  
  <p style="margin-top: 20px">De conformidad con el Art. 15 apartado 1 del RD 395/2007  de 23 de marzo, por el que se regula el subsistema de formación  profesional  para el empleo, la Representación Legal de los Trabajadores declara que, con fecha ........................, la empresa ha proporcionado  la siguiente información  sobre las acciones formativas de formación continua:
  </p>

  <ol style="margin: 30px 0 0 50px">
    <li>Denominación, objetivos y descripción de las acciones a desarrollar.</li>
    <li>Colectivos destinatarios y número de participantes por acciones.</li>
    <li>Calendario previsto de ejecución.</li>
    <li>Medios pedagógicos.</li>
    <li>Criterios de selección de los participantes.</li>
    <li>Lugar previsto de impartición de las acciones formativas.</li>
    <li>Balance de las acciones formativas desarrolladas en el ejercicio precedente.</li>
  </ol>

  <p style="margin-top:30px">Fecha de entrega por parte de la empresa: </p>
  <p>Nombre y apellidos: </p>
  <p>NIF:</p>
  <p>Firma original:</p>


  <p style="margin-top: 30px">Acuse de recibo por parte de la R.L.T.:</p>
  <p>Nombre y apellidos: </p>
  <p>NIF: </p>
  <p>Cargo sindical:   </p>
  <p>Sindicato al que representa: Firma original:</p>
  
  <p style="font-size:8px; margin-top: 50px">Los datos personales recogidos en este documento  pasarán a formar  parte  de un fichero automatizado titularidad  de la entidad organizadora  del plan de formación  y serán tratados  por esta, de acuerdo con la legislación  vigente en materia de protección  de datos personales, con la finalidad  de llevar a cabo la acción formativa. Los datos personales podrán ser comunicados a terceros sin el consentimiento del titular de los mismos, siempre  que esta comunicación responda a una necesidad para el desarrollo, cumplimiento y control  de la acción formativa  y se limite  a esta finalidad; tal y como se establece en el art. 11.1 de la Ley Orgánica 15/1999, de 13 de diciembre, de protección de datos de carácter Personal. Para ejercitar  los derechos de acceso, impugnación, rectificación cancelación u oposición de sus datos, deberán dirigirse  a la entidad  organizador  y cumplimentar los formularios  di spuestos al efecto.
  </p>

</page>


<page backleft="40px" backright="40px" backtop="30px" backbottom="30px"> 

  <!-- <div style="margin:0px 0 20px 0px;"><img width="170px" src="../img/LogoTripartita.png" /></div> -->

  <table class="ikearlt" style="">
    
    <tr>
      <td style="font-weight: bold;">Curso </td>
      <td style="font-weight: bold;">Horas </td>
      <td style="font-weight: bold;">Partic  </td>
      <td style="font-weight: bold;">Col.(1) </td>
      <td style="font-weight: bold;">Calendario  </td>
      <td style="font-weight: bold;">Crit.Selec.(2)  </td>
      <td style="font-weight: bold;">Lugar Impartic. (3)</td>
      <td style="font-weight: bold;">Modalid.(4)</td>
      <td style="font-weight: bold;">Medios Pedagóg.(5)</td>
    </tr>
    
    <tr style="font-size:12px">
      <td style="overflow:auto; width:12%;"><? echo $denominacion ?></td>
      <td><? echo $horastotales ?></td>
      <td><? echo $numalumnos ?></td>
      <td style="overflow:auto; width:5%;"><? echo $colectivostr ?></td>
      <td><? echo formateaFecha($fechaini). '<br>' .formateaFecha($fechafin) ?></td>
      <td><? echo "" ?></td>
      <td><? echo $centro ?></td>
      <td><? echo $modalidad ?></td>
      <td><? echo "" ?></td>
    </tr>
    
  </table>


  <ul style="margin: 50px 0 25px 0; list-style:none; font-size:14px">
    <li style="font-weight: bold">1. COLECTIVOS</li>
    <li>DI: Directivos</li>
    <li>MI: Mandos intermedios</li>
    <li>TE: Técnicos especialistas</li>
    <li>TC: Trabajador cualificado</li>
    <li>NC: No cualificado</li>
  </ul>

  <ul style="margin-bottom: 25px; list-style:none; font-size:14px">
    <li style="font-weight: bold">2. CRITERIOS DE SELECCIÓN DE LOS PARTICIPANTES (puede indicarse más de uno)</li>
    <li>CP: En función de la categoría profesional</li>
    <li>AF: En función del área funcional</li>
    <li>EP: En función de la experiencia profesional</li>
    <li>NC: En función del nivel de cualificación</li>
    <li>GM: En función del grado de motivación inicial por parte del interesado</li>
    <li>PT: En función del puesto de trabajo</li>
    <li>CO: En función del nivel de conocimientos necesarios</li>
    <li>OT: Otros criterios</li>
  </ul>  

  <p style="margin: 15px 0 15px 33px;font-size: 14px"><span style="font-weight:bold">3. LUGAR IMPARTICIÓN.</span> Adjuntar, si procede, relación con las direcciones de los diferentes centros de trabajo en los que se impartirá la formación.</p>

  <ul style="margin-bottom: 25px; list-style:none; font-size:14px">
    <li style="font-weight: bold">4. MODALIDAD</li>
    <li>P: Presencial</li>
    <li>D: Distancia</li>
    <li>TF: Teleformación</li>
    <li>M: Mixta</li>
  </ul>

  <ul style="margin-bottom: 25px; list-style:none; font-size:14px">
    <li style="font-weight: bold">5. MEDIOS PEDAGÓGICOS</li>
    <li>MA: Medios audiovisuales</li>
    <li>MI: Medios informáticos</li>
    <li>M1: Manual o documentación de apoyo</li>
    <li>M2: Manual o documentación de consulta</li>
    <li>PR: Pizarra y/o Rotafolios</li>
    <li>GD: Guía Didáctica</li>
    <li>Otros: vehículos, maquinaria… a detallar</li>
  </ul>


  <p style="font-size:8px; margin-top: 75px">Los datos personales recogidos en este documento  pasarán a formar  parte  de un fichero automatizado titularidad  de la entidad organizadora  del plan de formación  y serán tratados  por esta, de acuerdo con la legislación  vigente en materia de protección  de datos personales, con la finalidad  de llevar a cabo la acción formativa. Los datos personales podrán ser comunicados a terceros sin el consentimiento del titular de los mismos, siempre  que esta comunicación responda a una necesidad para el desarrollo, cumplimiento y control  de la acción formativa  y se limite  a esta finalidad; tal y como se establece en el art. 11.1 de la Ley Orgánica 15/1999, de 13 de diciembre, de protección de datos de carácter Personal. Para ejercitar  los derechos de acceso, impugnación, rectificación cancelación u oposición de sus datos, deberán dirigirse  a la entidad  organizador  y cumplimentar los formularios  di spuestos al efecto.
  </p>

</page>

<? } ?>

<page backleft="40px" backright="40px" backtop="30px" backbottom="30px"> 

  <p style="margin-top: 50px">En  ........................................................., a ...... de .......................... de <? echo $gestion ?> </p><br><br>

  <p>D/Dª. <? echo mb_strtoupper($row[nombrealu] .' '. $row[apellidoalu].' '.$row[apellido2alu], 'UTF-8') ?> manifiesta estar conforme con la realización del curso/acción formativa denominado/a <? echo $dneominacion ?>, sobre cuyo contenido declara haber sido informado/a. </p> <br>

  <p>Dicho curso/acción formativa se impartirá de forma <? echo strtolower($modalidad) ?> por <? echo ucfirst($docente) ?>, el/ los próximo/s día/s <? echo formateaFecha($fechaini). ' a ' . formateaFecha($fechafin) .' , en horario de '. $horario ?> </p><br>

  <p>Objetivos:</p><br>
  <p><? echo nl2br($objetivos) ?></p>

  <p style="margin-top: 50px">Enterado/a y conforme.</p>


  <p style="text-align:center; margin-top: 100px">Firma del Trabajador<br><br>
  <? echo mb_strtoupper($row[nombrealu] .' '. $row[apellidoalu].' '.$row[apellido2alu], 'UTF-8').' - '.$row[documento] ?></p>

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

?>
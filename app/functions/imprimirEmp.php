<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html" charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/esfocc.css" rel="stylesheet">
</head>

<?

    include_once 'funciones.php';

    ?> 
    <div class="container">
    <?

    $id_emp = $_GET['id_empresa'];

    $sql = 'SELECT * FROM empresas
    WHERE id ='.$id_emp;
    $sql = mysqli_query($link, $sql);

    ?> 

    <h3>Matrícula</h3>
    <table class="table table-striped">
            <thead>
                <tr> 
                    <th>Acción/Grupo</th>
                    <th>Denominación</th>
                    <th>Horas</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                </tr>
            </thead>
            <tbody>

    <?
        while ($row = mysqli_fetch_array($sql)) { 
            echo '<tr>';
            echo '<td>'.$row[numeroaccion].'/'.$row[ngrupo].'</td>';
            echo '<td>'.$row[denominacion].'</td>';
            echo '<td>'.$row[horastotales].'</td>';
            echo '<td>'.$row[fechaini].'</td>';
            echo '<td>'.$row[fechafin].'</td>';
            echo '</tr>';
        }
        echo '</tbody></table>';
    

    $sql = 'SELECT m.horariomini, m.horariomfin, m.horariotini, m.horariotfin, m.diascheck, m.horasteleformacion, d.nombre, d.apellido
    FROM matriculas m, docentes d, mat_doc md
    WHERE md.id_docente = d.id
    AND m.id = md.id_matricula
    AND m.id ='.$id_mat;
    $sql = mysqli_query($link, $sql);

    ?>

    <h3>Tutoría</h3>
    <table class="table table-striped">
            <thead>
                <tr> 
                    <th>Horario Mañana Inicio</th>
                    <th>Horario Mañana Fin</th>
                    <th>Horario Tarde Inicio</th>
                    <th>Horario Tarde Fin</th>
                    <th>Días Formación</th>
                    <th>Tutor</th>
                </tr>
            </thead>
            <tbody>

    <?
        while ($row = mysqli_fetch_array($sql)) { 
            echo '<tr>';
            echo '<td>'.$row[horariomini].'</td>';
            echo '<td>'.$row[horariomfin].'</td>';
            echo '<td>'.$row[horariotini].'</td>';
            echo '<td>'.$row[horariotfin].'</td>';
            echo '<td>'.$row[diascheck].'</td>';
            echo '<td>'.$row[nombre].' '.$row[apellido].'</td>';
            echo '</tr>';
        } 
        echo '</tbody></table>';


    $sql = 'SELECT a.nombre, a.apellido, a.apellido2, a.documento, a.telefono, a.email, e.razonsocial, e.cif
    FROM alumnos a, empresas e, mat_alu_cta_emp m
    WHERE m.id_alumno = a.id
    AND m.id_empresa = e.id
    AND m.id_matricula = '.$id_mat;
    $sql = mysqli_query($link, $sql);

    ?> 

    <h3>Alumnos - Empresa</h3>
    <table class="table table-striped">
            <thead>
                <tr> 
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>DNI/NIF</th>
                    <th>Empresa</th>
                    <th>CIF</th>
                </tr>
            </thead>
            <tbody>

    <?
        while ($row = mysqli_fetch_array($sql)) { 
            echo '<tr>';
            echo '<td>'.$row[nombre].'</td>';
            echo '<td>'.$row[apellido].' '.$row[apellido2].'</td>';
            echo '<td>'.$row[telefono].'</td>';
            echo '<td>'.$row[email].'</td>';
            echo '<td>'.$row[documento].'</td>';
            echo '<td>'.$row[razonsocial].'</td>';
            echo '<td>'.$row[cif].'</td>';
            echo '</tr>';
        } 
        echo '</tbody></table>';


    $sql = 'SELECT d.nombre, d.apellido, d.apellido2, d.documento, d.telefono
    FROM docentes d, mat_doc m
    WHERE m.id_docente = d.id
    AND m.id_matricula = '.$id_mat;
    $sql = mysqli_query($link, $sql);

    ?> 

    <h3>Docentes</h3>
    <table class="table table-striped">
            <thead>
                <tr> 
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>DNI</th>
                    <th>Teléfono</th>
                </tr>
            </thead>
            <tbody>

    <?
        while ($row = mysqli_fetch_array($sql)) { 
            echo '<tr>';
            echo '<td>'.$row[nombre].'</td>';
            echo '<td>'.$row[apellido].' '.$row[apellido2].'</td>';
            echo '<td>'.$row[documento].'</td>';
            echo '<td>'.$row[telefono].'</td>';
            echo '</tr>';
        } 
        echo '</tbody></table>';


    

}

?>

    </div>
</html>

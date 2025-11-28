
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
  		<link href="/app/css/bootstrap.css" rel="stylesheet">
		<link href="/app/css/esfocc.css" rel="stylesheet">
		<script src="/app/js/misc.js"></script>
		<script src="/app/js/jquery-1.10.2.js"></script>
</head>  


<script type="text/javascript">

$(document).on("click", "#codiplomass", function(event) {

	var button = $(this);
    var parentTd = button.parent('td');
    var parentTr = parentTd.parent('tr');
    var codiploma = parentTr.find('input#codiploma').val();
    // alert(codiploma);

	$.ajax({
        cache: false,
        type: 'POST',
        url: 'funciones.php',
        data: 'mat='+$(this).attr('mat')+'&emp='+$(this).attr('emp')+'&alu='+$(this).attr('alu')+'&codiploma='+codiploma+'&guardacodiploma=1',
        success: function(data) 
        {
            //alert(data);
        }
	}); ajax.abort();	
	

});

</script>

<style>

table { 
    border-collapse: collapse; 
    width: 100%;
    table-layout:fixed; 
}
table td {
    padding: 5px;
    border: 1px solid #ccc;
    white-space: normal; 
}
</style>

<?


include './funciones.php';

$q = 'SELECT a.id as alu, m.id as mat,e.id as emp,a.nombre, a.apellido, a.apellido2, e.razonsocial, 
ma.codiploma, m.fechafin, ga.ngrupo, ac.numeroaccion
FROM mat_alu_cta_emp ma, alumnos a, acciones ac, matriculas m, empresas e, grupos_acciones ga
WHERE ma.id_alumno = a.id
AND e.id = ma.id_empresa
AND ga.id = m.id_grupo
AND ac.id = m.id_accion
AND ma.id_matricula = m.id
AND m.id_accion = ac.id
AND ac.incendios = 1
ORDER BY fechaini,id_alumno ASC';
    $q = mysqli_query($link, $q);

    while ( $row = mysqli_fetch_array($q) ) { ?>

    <table class="table table-striped">
    	<tr>
            <td><? echo $row[numeroaccion].'/'.$row[ngrupo] ?></td>
    		<td><? echo date("d/m/Y", strtotime($row[fechafin])) ?></td>	
    		<td><? echo $row[nombre] ?></td>
    	    <td><? echo $row[apellido] ?></td>
    	    <td><? echo $row[apellido2] ?></td>
    	    <td><? echo $row[razonsocial] ?></td>
    	    <td><input id="codiploma" style="width:120px" type="text" value="<? echo $row[codiploma] ?>"></td>
    	  	<td><a id="codiplomass" alu="<? echo $row[alu] ?>" emp="<? echo $row[emp] ?>" mat="<? echo $row[mat] ?>" class="btn btn-default">guardar</a></td>
    	</tr>
    </table>

        
    <? } ?>




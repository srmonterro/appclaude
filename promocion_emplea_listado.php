<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height, target-densitydpi=device-dpi" />
        <link href="./css/bootstrap.css" rel="stylesheet">
        <script src="js/jquery-1.10.2.js"></script>
        
    </head>
<?
include ('./functions/funciones.php');
?>

<div class="container" style="margin-top: 30px">
	<h1>Listado de inscritos en la promoción: Emplea</h1>
</div>

<div style="margin-top: 30px" class="container">

	<div id="listado-seguimiento" style="">
		<table style="margin-top: 15px;" class="table">
            <thead>
                <tr>
                	<th style="text-align:center">Nº</th>                         
                    <th style="text-align:center">Nombre</th>
                    <th style="text-align:center">Apellidos</th>
                    <th style="text-align:center">Codigo</th>
                </tr>
            </thead>
        	<tbody>

		<?
		$q = 'SELECT * FROM promociones WHERE promocion like "promo1"';
		
		$q = mysqli_query($link, $q) or die("error: ".mysqli_error($link) );
		$numeroLinea = 1;
		while ($row = mysqli_fetch_array($q)) {
            echo '<tr>';
            echo '<td>';
            echo($numeroLinea);
            echo "</td>";
            echo "<td>";
            print($row[nombre]);
            echo "</td>";
            echo "<td>";
            echo($row[apellido]. ' ' .$row[apellido2]);
            echo "</td>";
            echo "<td>";
            print($row[codigo_inv]);
            echo "</td>";
            $numeroLinea+=1;
        }	
	    ?>
	        </tbody>
	    </table>
	</div>
</div>
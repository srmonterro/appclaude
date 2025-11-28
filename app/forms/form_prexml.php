<form id="formulario" role="form" action="importar_csv.php"method="post">
<div style="margin-top: 30px" class="container">
    <div class="form-group">
    	<div class="col-md-4">
		    <label for="accion">Acción:</label>
		    <input type="text" id="accion" name="accion" class="form-control" <? echo 'value="'.$_POST['accion'].'"'; ?> />
	    </div>
	</div>
	<div class="form-group">
    	<div class="col-md-4">
		    <label for="grupo">Grupo:</label>
		    <input type="text" id="grupo" name="grupo" class="form-control" <? echo 'value="'.$_POST['grupo'].'"'; ?> />
	    </div>
    </div>	
  
<p style="text-align: left; margin-top: 30px; margin-left: 15px;">
  <input type="submit" name="submit" value="Exportar XML" class="btn btn-primary btn-lg">
</p>  
</div>   
</form>

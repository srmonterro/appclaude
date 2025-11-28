
<div style="margin-top: 45px" class="container">
<ol class="breadcrumb">
      <li>Online-Distancia</li>
      <li class="active">Inspección</li>
</ol>

<input name="matricula" type="hidden" id="matricula" value="1" />
<input name="id_matricula" type="hidden" id="id_matricula" value="" />  
<input name="id_accion" type="hidden" id="id_accion" value="" />

<form class="formularioinspeccion" id="formulario" role="form" action="" method="post">

    <div class="col-md-12 " style="text-align: left;min-height:70px;">
        <a id="abrebusqueda" name="matriculas" data-toggle=modal class="btn btn-lg btn-primary">Seleccionar Curso</a>
    </div>
    

    <div id="datosaccion" style="display:none">

            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label" for="numeroaccion">Acción Formativa:</label>
                    <input type="text" id="numeroaccion" name="numeroaccion" class="form-control" readonly/>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label" for="denominacion">Denominación Acción Formativa:</label>
                    <input style="font-size:12px" type="text" id="denominacion" name="denominacion" class="form-control" readonly />
                </div>
            </div>
            
            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label" for="fechaini">Fecha Inicio:</label>
                    <input type="date" id="fechaini" name="fechaini" class="form-control" readonly/>
                </div>
            </div> 
            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label" for="fechafin">Fecha Fin:</label>
                    <input type="date" id="fechafin" name="fechafin" class="form-control" readonly/>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label" for="modalidad">Modalidad:</label>
                    <input type="text" id="modalidad" name="modalidad" class="form-control" readonly/>
                </div>
            </div>

    </div>
    

</form>

<div class="clearfix"></div>

<div class="inspec-upload col-md-12">
    

</div>

</div>

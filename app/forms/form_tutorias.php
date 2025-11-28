
<div style="margin-top: 45px" class="container">

	<input name="matricula" type="hidden" id="matricula" value="" />
	<input name="id_matricula" type="hidden" id="id_matricula" value="" />
	<input name="id_accion" type="hidden" id="id_accion" value="" />
    <input name="id_alumno" type="hidden" id="id_alumno" value="" />
    <input name="tipo" type="hidden" id="tipo" value="" />
    <div style="display:none" id="confirmacion" class="inv alert alert-success">Progreso guardado. Acuérdate de ir actualizándolo a medida que el alumno va avanzando en la formación.</div>
    <div style="display:none" id="error" class="alert alert-danger">Error.</div>


	<ol class="breadcrumb">
      <li>Online-Distancia</li>
      <li class="active">Tutorías</li>
	</ol>

	<div class="clearfix"></div>

	<form class="formulariotutoria" id="formulario" role="form" action="" method="post">

    <div class="col-md-4" style="text-align: left; min-height:70px;">
        <a id="abrebusqueda" href="#" name="matriculas" data-toggle=modal class="btn btn-lg btn-primary">Seleccionar Curso</a>
    </div>

    <div class="col-md-2 seguimiento pull-right" style="margin-top: 0px; text-align: right;">
        <a href="#" style="width:100%" id="imprimirSeguimiento" class="btn btn-warning"><span class="glyphicon glyphicon-eye-open"></span> Reporte</a>
    </div>
    <div class="col-md-2 seguimiento pull-right" style="margin-top: 0px; text-align: right;">
        <a href="#" style="width:100%" id="imprimirSeguimientoG" class="btn btn-warning"><span class="glyphicon glyphicon-eye-open"></span> Reporte Grupo</a>
    </div>

    <div class="clearfix"></div>

    <div id="datostutoria" style="display:none">

            <div class="col-md-1">
                <div class="form-group">
                    <label class="control-label" for="numeroaccion">Acción:</label>
                    <input type="text" id="numeroaccion" name="numeroaccion" class="form-control" disabled/>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label" for="denominacion">Denominación Acción Formativa:</label>
                    <input type="text" id="denominacion" name="denominacion" class="form-control" disabled />
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label" for="fechaini">Fecha Inicio:</label>
                    <input type="date" id="fechaini" name="fechaini" class="form-control" disabled/>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label" for="fechafin">Fecha Fin:</label>
                    <input type="date" id="fechafin" name="fechafin" class="form-control" disabled/>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label" for="horario">Horario:</label>
                    <input type="text" id="horario" name="horario" class="form-control" disabled />
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <label class="control-label" for="horastotales">Horas:</label>
                    <input type="text" id="horastotales" name="horastotales" class="form-control" disabled />
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label" for="alumno">Alumno:</label>
                    <input type="text" id="alumno" name="alumno" class="form-control" disabled/>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label" for="email">Email:</label>
                    <input type="text" id="email" name="email" class="form-control"  />
                </div>
            </div>
            <div class="col-md-1" style="margin-top: 25px">
                <a href="#" style="width:100%" id="guardarEmailTutoria" class="btn btn-success"><span class="glyphicon glyphicon-floppy-save"></span> </a>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label" for="telefono1">Teléfono:</label>
                    <input type="text" id="telefono1" name="telefono1" class="form-control" disabled/>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label" for="telefono2">Teléfono Trabajo:</label>
                    <input type="text" id="telefono2" name="telefono2" class="form-control" disabled/>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-3">
                <div class="cp form-group">
                    <label class="control-label" for="progreso">Progreso Contenido:</label>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button id="recarga_progreso" name="recarga_progreso" class="btn btn-default"><span class="glyphicon glyphicon-repeat"></span></button>
                        </span>
                        <input type="text" id="progreso" name="progreso" class="form-control" />
                        <span class="input-group-addon">%</span>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div style="margin-top: 30px;" class="progress progress-striped active">
                    <div id="progresobar" class="progress-bar progress-bar-success"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 25%">
                        <span class="sr-only">23% Complete</span>
                    </div>
                    <div id="progresobar" class="progress-bar progress-bar-danger"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 75%">
                        <span class="sr-only">23% Complete</span>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-3">
                <div class="cp form-group">
                    <label class="control-label" for="progreso2">Progreso Cuestionarios:</label>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button id="recarga_progreso2" name="recarga_progreso2" class="btn btn-default"><span class="glyphicon glyphicon-repeat"></span></button>
                        </span>
                        <input type="text" id="progreso2" name="progreso2" class="form-control" />
                        <span class="input-group-addon">%</span>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div style="margin-top: 30px;" class="progress progress-striped active">
                    <div id="progresobar2" class="progress-bar progress-bar-success"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 25%">
                        <span class="sr-only">23% Complete</span>
                    </div>
                    <div id="progresobar2" class="progress-bar progress-bar-danger"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 75%">
                        <span class="sr-only">23% Complete</span>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-3">
                <div class="cp form-group">
                    <label class="control-label" for="dedicacion">% Dedicación:</label>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button id="recarga_dedicacion" name="recarga_dedicacion" class="btn btn-default"><span class="glyphicon glyphicon-repeat"></span></button>
                        </span>
                        <input type="text" id="dedicacion" name="dedicacion" class="form-control" />
                        <span class="input-group-addon">%</span>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div style="margin-top: 30px;" class="progress progress-striped active">
                    <div id="dedicacionbar" class="progress-bar progress-bar-success"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 25%">
                        <span class="sr-only">23% Complete</span>
                    </div>
                    <div id="dedicacionbar" class="progress-bar progress-bar-danger"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 75%">
                        <span class="sr-only">23% Complete</span>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label" for="finalizado">Estado:</label>
                    <select id="finalizado" name="finalizado" class="form-control" >
                        <option value="0">En Progreso</option>
                        <option value="1">Finalizado - Bonificado</option>
                        <option value="3">Finalizado - Privado</option>
                        <option value="2">NO Finalizado</option>
                    </select>
                </div>
            </div>

            <div class="clearfix"></div>

            <a id="tutorias_contactos" style="float:left; margin-top:25px; margin-left: 15px" class="btn btn-default btn-default"><span class="glyphicon glyphicon-plus-sign"></span> Añadir Contacto</a>
            <a id="btncredenciales" style="float:left; margin-top:25px; margin-left: 15px" class="btn btn-primary"><span class="glyphicon glyphicon-plus-sign"></span> Credenciales / Guía del Alumno</a>


            <div class="clearfix"></div>
            <span id="ini_tutoria"></span>
            <span id="fin_tutoria"></span>

    </div>
    </form>
</div>
<ol class="breadcrumb">
    <li><a href="<?php echo site_url("principal/"); ?>">Principal</a></li>
    <li class="active">Listado de Obras</li>
</ol> 
<div class="container-fluid">
   
   
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="table-responsive" id="tabla-principal">
                <table class="table table-striped table-hover table-bordered" id="t_listado"  width="200%">
                    <thead>
                        <tr>
                            <th>
                                Acción
                            </th>
                            <th>
                                Orden de Trabajo
                            </th>
                            <th>
                                Contrato
                            </th>
                            <th>
                                Obra
                            </th>                               
                            <th>
                                Descripcion
                            </th>
                             
                            <th>
                                Normatividad
                            </th> 
                              <th>
                                Modalidad
                            </th> 
                            <th>
                                Ejercicio
                            </th> 
                            <th>
                                Estatus Obra
                            </th>

                            <th>
                                Direccion Ejecutora
                            </th>
                            <th>
                                Supervisor
                            </th>
                            <th>
                                Inicio Contrato
                            </th>
                            <th>
                                Monto Contratado
                            </th>
                            <th>
                                Monto Ejercido por SIOP
                            </th>
                            <th>
                                Finiquitada
                            </th>
                            <th>
                                Contratista
                            </th>
                            <th>
                                Estatus FIDO
                            </th>

                        </tr>
                    </thead>
                    
                </table>
            </div>
        </div>
            
        
        
    </div>

    <!-- Historial del Bloque  -->
        <div class="modal fade" id="modal-historico-archivo" role="dialog" aria-labelledby="myModalLabel-observaciones_bloque" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header panel-default">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel-historial">
                            Estatus de bloques
                        </h4>
                    </div>
                    <div class="modal-body">
                        
                                <div id="idHistorial_estatus"></div>
                                                                              
                    </div>
                    <div class="modal-footer">                            
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>

        </div>

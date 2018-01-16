<div class="panel panel-default plantilla">
    <div class="panel-heading flex">
        <a class="panel-title" data-toggle="collapse" data-parent="#panel-464595" href="#panel-element-566826">Datos de la Obra</a>
    </div>
 
    <div id="panel-element-566826" class="panel-collapse collapse in">
        <div class="panel-body">
            <div class="row clearfix">
                <!-- Panel de Control-->
                <div class="col-md-8">
                    <div class="tab-pane" id="panel-Vales">
                             
                        <div class="col-md-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">Datos Generales </div>

                                <div class="row panel-body">

                                    <div class="col-md-12">
                                        

                                        <div class="d-f m-b">

                                            <div class="col-md-2 align-t-e"><strong>Orden Trabajo</strong></div>
                                            <div class="col-md-10"><?= $aArchivo['OrdenTrabajo']; ?></div>
                                        </div>
                                        <div class="d-f m-b">

                                            <div class="col-md-2 align-t-e"><strong>Contrato</strong></div>
                                            <div class="col-md-10"> <?= $aArchivo['Contrato']; ?></div>
                                        </div>
                                        <div class="d-f m-b">

                                            <div class="col-md-2  align-t-e"><strong>Obra</strong></div>
                                            <div class="col-md-10"><?= $aArchivo['Obra']; ?></div>
                                        </div>
                                        <div class="d-f m-b">

                                            <div class="col-md-2 align-t-e"><strong>Modalidad</strong></div>
                                            <div class="col-md-10"><?= $addw_modalidades[$aArchivo['idModalidad']]; ?> </div>
                                        </div>
                                        <div class="d-f m-b">

                                            <div class="col-md-2 align-t-e"><strong>Ejercicio</strong></div>
                                            <div class="col-md-10"><?= $aArchivo['idEjercicio']; ?></div>
                                        </div>
                                        <div class="d-f m-b">

                                            <div class="col-md-2 align-t-e"><strong>Normatividad</strong></div>
                                            <div class="col-md-10"> <?= $aArchivo['Normatividad']; ?> </div>
                                        </div>
                                        <div class="d-f m-b">

                                            <div class="col-md-2 align-t-e"><strong>Fondo de Programa</strong></div>
                                            <div class="col-md-10"> <?= $aArchivo['FondodePrograma']; ?> </div>
                                        </div>
                                         
                                         
                                    </div>
                                     
                                     


                                      
                                </div>
                                 
                                 
                            </div> <!--Fin panel primary-->
                        </div>
                    </div>   
                </div>
                 
                <div class="col-md-4">
                    <div class="panel panel-warning">
                        <div class="panel-heading">Datos de Archivo</div>
                        <div class="panel-body">
                            <div class="col-md-12">
                                <form class="form-horizontal">
                                     
                                     
                                        <div class="form-group m-b" id="caja-i">
                                             
                                             
                                                <label class="col-sm-4 control-label" for="exampleInputEmail3">Identificador</label>
                                                <div class="col-sm-8">
                                                    <input type="hidden" id="identificador" name="identificador"  value="<?php if ($aArchivo['identificado']) echo $aArchivo['identificado']?>" required />
                                                    
                                                </div>
                                                <!--
                                                <div class="col-sm-3">
                                                    <a class="btn btn-default col-sm-12" id="mostrar" onclick="cargar_identificador(<?php echo $idArchivo ?>)">Agregar</a>
                                                </div>
                                                -->
                                             

                                                
                                             
                                        </div>

                                     
                                     
                                     
                                     
                                    <?php if ($preregistro ==0){ ?>
                                         
                                            <!-- grupo va en la tabla bloque-->
                                            <div class="form-group m-b" id="">
                                              <label class="col-sm-4 control-label" for="exampleInputEmail3">Grupo Obra</label>
                                              <div class="col-sm-8">
                                                  <select class="form-control" id="slc_obra" name="slc_obra" onchange="cargar_bloqueObra(<?php echo $idArchivo ?>)">
                                                        <option value="0"><?php if ($aArchivo['idBloqueObra']) echo $aArchivo['idBloqueObra']; else echo "Selecciona un Grupo" ?></option>
                                                        <?php foreach ($qBloques->result() as $rowdata) {  ?>
                                                        <option value="<?php echo $rowdata->id; ?>"><?php echo $rowdata->Nombre; ?></option>
                                                        <?php } ?>
                                                  </select>
                                              </div>

                                            </div>

                                                 
                                   <?php } ?>
                                     
                                    <div class="form-group m-b"> 
                                        <div class="col-sm-12">
                                            <a href="<?php echo site_url("archivo/ver_plantilla"). '/' . $aArchivo['id']; ?>" class="btn btn-success"  onclick=""><span class="glyphicon glyphicon-repeat"></span> Actualizar Plantilla </a>
                                        </div>
                                         
                                         
                                         
                                    </div>

                                    <div class="form-group m-b"> 
                                        <div class="col-sm-12">
                                                <a href="#" data-toggle="modal" data-target="#observacion_bloque_archivo" role="button" class="btn btn-success" onclick="agregar_observaciones_archivo(<?= $aArchivo['idDireccion']?>, <?= $aArchivo['idContrato']?>)">
                                                    <span class="glyphicon glyphicon-plus"></span> Observaciones Archivo
                                                </a>
                                        </div>
                                    </div>
                                </form>
                                     
                                     
                                    <?php if($Editar == 1){
                                         
                                    if ($NoProcesos_archivo == $NoProcesos_archivo_integracion){ ?>
                                    <div class="alert alert-success" role="alert" style="margin-bottom:20px;">
                                     
                                                 
                                        <?php echo '<b>Estatus Obra: </b>' . 'Finalizado'; ?> 
                                        <div>  
                                            <a class="enlace-succes" href="#" data-toggle="modal" data-target="#enviar_concentracion" role="button"  onclick="uf_enviar_concentracion()"><span class="glyphicon glyphicon-share-alt"></span> Enviar a Concentración</a>
                                        </div> 

                                               
                                           
                                    </div>
                                     
                                     
                                    <?php } else {  
                                        echo '<b>Bloques finalizados: </b>' . $NoProcesos_archivo_integracion; 
                                        }
                                    }
                                     
                                     
                                    ?>
                                     
                                    <?php if ($reviso ==1): ?>
                                
                                        <div id="trabajar_ot">
                                            <?php $usuario =   $this->datos_model->usuario_trabajando($idArchivo);   ?> 
                                            <?php  if( $usuario->num_rows() == 1 ): ?>
                                                <?php foreach ($usuario->result() as $rUsuario):?>
                                                    <?php if ($rUsuario->idUsuario_Trabajando > 0  ): ?> <!--//alguien está trabajando con OT ?> -->
                                                        <?php if($rUsuario->idUsuario_Trabajando == $idusuario): ?> <!-- //el usuario esta trabajando algún bloque en OT?> -->
                                            
                                                            <label><span class='glyphicon glyphicon-folder-open'></span> Trabajando con OT</label>
                                                 
                                                        <?php else:  ?> <!--  //hay algun usuario esta trabajando en la OT ?>-->
                                            
                                                            <label><span class='glyphicon glyphicon-ban-circle'></span> OT Ocupada</label>
                                                        <?php  endif;?>
                                                    <?php else: ?> <!--  //OT Libre?>-->
                                            
                                                            <label><span class='glyphicon glyphicon-folder-open'></span> OT Libre</label>
                                                    <?php  endif;?>
                                                <?php endforeach;?>
                                            <?php else:  ?> <!--  //hay algun usuario esta trabajando en la OT ?>-->
                                            
                                                <label><span class='glyphicon glyphicon-ban-circle'></span> OT Ocupada</label>
                                           <?php  endif;?>
                                        </div>
                                    <?php  endif;?>
                                        
                                     
                                
                                   
                            </div>
                        </div>
                    </div>
                </div> <!--Fin panel 4 col -->
                 
                
                 
            </div>
             
        </div>
    </div>
     
</div> <!-- panel-default -->
</div>
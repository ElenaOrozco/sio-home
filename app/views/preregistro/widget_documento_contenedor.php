<div id="documento-contenedor" class="d-n">
    <div id="container-documento" class="col-md-12">
        <!-- row-documento -->
        <div class="row flex-center" id="row-documento">

            <!-- row-title -->
            <div id="row-title" class="col-md-6 col-xs-12">
                
                <h6> {Nombre}
                    <br><small>RESPONSABLE: {Direccion}</small>
                </h6>
                
            </div> 
            <!-- /row-title -->
            
            <!-- row-tipo-documento -->
            <div id="row-tipo-documento" class="col-md-2 col-xs-12">

                <label class="sr-only" for="exampleInputEmail3">No. de Estimaciones</label>
                <input type="number" class="form-control" id="noEstimaciones" name="noEstimaciones" placeholder="No Estimaciones" onkeypress="return validar(event)" onchange="cargar_estimaciones(event, {id})">
               
                    
            </div> 
            <!-- /row-tipo-documento -->

            <!-- row-hojas -->
            <div id="row-hojas" class="col-md-2 col-xs-12">
                <label class="sr-only" for="exampleInputEmail3">No. Hojas</label>
                <input type="number" class="form-control" id="noHojas_doc_{id}" min="0" name="noHojas_doc_{id}" placeholder="No Hojas" value=""
                    onchange="preregistrar_hojas(event,{id})" onkeyup="preregistrar_hojas(event,{id})" onkeypress="return validar(event)"  >
                   
            </div> 
            <!-- row-hojas -->
            
            <!-- row-acciones -->
            <div id="row-acciones" class="col-md-2 col-sx-12">

                <a href="#observaciones_bloque" id="btn-ver-obs"  data-toggle="modal" title="Ver Observaciones" class="btn btn-default btn-sm" data-target="#observaciones_bloque" title="Observaciones" role="button" onclick="ver_observaciones_documento({idTipoProceso},{idSubTipoProceso},{idDocumento})">
                    <span class="glyphicon glyphicon-search"></span>
                </a>

                <a href="#" id="btn-agregar-obs"  data-toggle="modal" title="Agregar observaciones" data-target="#observacion_bloque" role="button" class="btn btn-warning btn-sm" onclick="uf_agregar_observaciones({idTipoProceso},{idSubTipoProceso},{idDocumento})">
                    <span class="glyphicon glyphicon-comment"></span>
                </a>

            </div> <!-- row-acciones -->
        </div> 
        <!-- /row-documento -->
        <hr class="documento">
    
    </div>
    


    
  
    

</div>


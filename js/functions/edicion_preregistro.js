$(document).ready(function(){ 
    llenar_plantilla();
    
})


function llenar_plantilla(){
    traer_procesos()    

        
} 

function traer_procesos(){
    $.ajax({
        async:false,    
        cache:false,
        url: url + 'archivo/llenar_plantilla',
        type: 'POST',
        timeout: 10000,
        data: {idArchivo: $("#idArchivo").val()},
        beforeSend: function(){
            $("#contenido").html('<div class="spinner" ><i class="fa fa-spinner fa-5x" aria-hidden="true"></i></div>');
        },
        error: function(){
            $("#contenido").html('');
            console.log('Ha surgido un error.')
        },
        success: function(respuesta){
            $("#contenido").html('');
           // console.log(respuesta)
            var contenido = "";
            for (i = 0; i < respuesta.length;  i++) {

                obj = respuesta[i];
                div = document.createElement('div');
                div_contenido = $('#procesos').html();
                
                //Como ocpamos 4 veces la propiedad 
                for(j=0 ; j <8 ;j++){
                    for( prop in obj){
                        //console.log(prop  + "  " +  obj[prop]);
                        div_contenido = div_contenido.replace('{'+prop+'}', obj[prop]);
                    }
                }
                
                //console.log(div_contenido)
                div.innerHTML = div_contenido;
                //console.log(respuesta[i].idTipoProceso)
                document.getElementById('contenido').appendChild(div);
                traer_subprocesos(respuesta[i].idTipoProceso)
               
            }
            //
            traer_documentos_alternos();
            
        }
    })

}

function traer_subprocesos(idTipoProceso){
    $.ajax({
        url: url + 'archivo/subprocesos_de_proceso',
        type: 'POST',
        timeout: 10000,
        data: {idArchivo: $("#idArchivo").val(), idTipoProceso: idTipoProceso},
        beforeSend: function(){
            $("#panel-body-proceso-"+idTipoProceso).html('<div class="spinner" ><i class="fa fa-spinner fa-5x" aria-hidden="true"></i></div>');
        },
        error: function(){
            $("#panel-body-proceso-"+idTipoProceso).html('Error');
            console.log('Ha surgido un error.')
        },
        success: function(respuesta){
            $("#panel-body-proceso-"+idTipoProceso).html('');
            //console.log(respuesta)
            var contenido = "";
            for (i = 0; i < respuesta.length;  i++) {

                obj = respuesta[i]
                div = document.createElement('div');
                div_contenido = $('#subproceso').html();
                
                //Como ocupamos 4 veces la propiedad 
                for(j=0 ; j < 8;j++){
                    for( prop in obj){
                        
                        div_contenido = div_contenido.replace('{'+prop+'}', obj[prop]);
                        
                    }
                }
                
                
                div.innerHTML = div_contenido;
                
                $("#panel-body-proceso-"+idTipoProceso).append(div);
               
                //traer_documentos(idTipoProceso, respuesta[i].id)
                
            }
            //traer_documentos_alternos();
            
        }
    });
}

function traer_documentos_alternos(){
     $.ajax({
        url: url + 'archivo/documentos_de_archivo',
        type: 'POST',
        timeout: 10000,
        data: {idArchivo: $("#idArchivo").val()},
        beforeSend: function(){
            console.log('Ha surgido un esperar.')
            //$("#panel-body-subproceso-"+id).html('<div class="spinner" ><i class="fa fa-spinner fa-5x" aria-hidden="true"></i></div>');
        },
        error: function(){
            $("#panel-body-subproceso-"+id).html('Error');
            console.log('Ha surgido un error.')
        },
        success: function(respuesta){


            
            //console.log(respuesta)
            var Ejecutora = $("#ejecutora").val();

            
            var contenido = "";
            for (i = 0; i < respuesta.length;  i++) {

                id = respuesta[i].idSubTipoProceso;
                console.log("Sunproceso " +id)
                //$("#panel-body-subproceso-"+id).html('');

                obj = respuesta[i]
                div = document.createElement('div');

                console.log(obj.idDocumento)
                if(obj.idDocumento != 114){
                    div_contenido = $('#documento').html();
                } else {
                    div_contenido = $('#documento-contenedor').html();
                }
                //Remplazar en el contenido
                div_contenido = div_contenido.replace( /{id}/g, obj.id);
                div_contenido = div_contenido.replace('{Nombre}', obj.Nombre);
                div_contenido = div_contenido.replace(/{idTipoProceso}/g, obj.idTipoProceso);
                div_contenido = div_contenido.replace(/{idSubTipoProceso}/g, obj.idSubTipoProceso);
                div_contenido = div_contenido.replace(/{idDocumento}/g, obj.idDocumento);

                
                if (obj.responsable_documento == 0 ){
                   obj.Direccion = Ejecutora; 
                }   
                if (obj.Direccion == null){
                   obj.Direccion = "Sin Definir";   
                }                    
                div_contenido = div_contenido.replace('{Direccion}', obj.Direccion);
                //Fin Remplazar en el contenido
               
                div.innerHTML = div_contenido;
                
                
                $("#panel-body-subproceso-"+id).append(div);
                
                
            }
            traer_preregistrados()
            
        }
    });
}

function traer_documentos(idTipoProceso, id){
    $.ajax({
        url: url + 'archivo/documentos_de_subproceso',
        type: 'POST',
        timeout: 10000,
        data: {idArchivo: $("#idArchivo").val(), idTipoProceso: idTipoProceso, idSubProceso: id},
        beforeSend: function(){
            //console.log('Ha surgido un esperar.')
            $("#panel-body-subproceso-"+id).html('<div class="spinner" ><i class="fa fa-spinner fa-5x" aria-hidden="true"></i></div>');
        },
        error: function(){
            $("#panel-body-subproceso-"+id).html('Error');
            console.log('Ha surgido un error.')
        },
        success: function(respuesta){
            $("#panel-body-subproceso-"+id).html('');
            //console.log(respuesta)
            var Ejecutora = $("#ejecutora").val();

            
            var contenido = "";
            for (i = 0; i < respuesta.length;  i++) {

                obj = respuesta[i]
                div = document.createElement('div');

                console.log(obj.idDocumento)
                if(obj.idDocumento != 114){
                    div_contenido = $('#documento').html();
                } else {
                    div_contenido = $('#documento-contenedor').html();
                }
                //Remplazar en el contenido
                div_contenido = div_contenido.replace( /{id}/g, obj.id);
                div_contenido = div_contenido.replace('{Nombre}', obj.Nombre);
                div_contenido = div_contenido.replace(/{idTipoProceso}/g, obj.idTipoProceso);
                div_contenido = div_contenido.replace(/{idSubTipoProceso}/g, obj.idSubTipoProceso);
                div_contenido = div_contenido.replace(/{idDocumento}/g, obj.idDocumento);

                
                if (obj.responsable_documento == 0 ){
                   obj.Direccion = Ejecutora; 
                }   
                if (obj.Direccion == null){
                   obj.Direccion = "Sin Definir";   
                }                    
                div_contenido = div_contenido.replace('{Direccion}', obj.Direccion);
                //Fin Remplazar en el contenido
               
                div.innerHTML = div_contenido;
                
                
                $("#panel-body-subproceso-"+id).append(div);
                
                
            }
            traer_preregistrados()
            
        }
    });
}

function traer_preregistrados(){
     $.ajax({
        url: url + 'archivo/traer_preregistrados',
        type: 'POST',
        timeout: 10000,
        data: {idArchivo: $("#idArchivo").val()},
        beforeSend: function(){
            
        },
        error: function(){
            
            console.log('Ha surgido un error.')
        },
        success: function(respuesta){
           //console.log(respuesta)
           

           for(var i=0; i <respuesta.length; i++){
                

                idRAD = respuesta[i].id_Rel_Archivo_Documento;
                valor = respuesta[i].tipo_documento;

                $('#tipo_documento'+ idRAD + ' > option[value="' + valor +'"]').attr('selected', 'selected');
                $('#noHojas_doc_'+ idRAD).val(respuesta[i].noHojas)

           }  
            
        }
    });
}

function preregistrar_documento(id, idTipoProceso, idDocumento){

    var tipo_documento = $("#tipo_documento"+id).val();
    var idArchivo = $("#idArchivo").val();
    
    url = $("#base_url").val()+ "archivo/preregistrar_documento";
   
    $.ajax({
        data:  { 
            id: id,
            idArchivo:idArchivo,
            tipo_documento: tipo_documento,
            idTipoProceso: idTipoProceso,
            idSubTipoProceso: idSubTipoProceso
        },
        url:  url , 
        dataType: 'json',
        quietMillis: 100,
        type:  'POST',
        success:  function (data) {
            console.log(data.retorno);
            if(data.retorno == 1){
                $("#tipo_documento"+id).css("border-color", "green");
                $("#noPreregistrados-"+idTipoProceso).html(data.preregistrados_proceso);
                $("#noPreregistrados-subproceso-"+idSubTipoProceso).html(data.preregistrados_subproceso);
            }else{
                $("#tipo_documento"+id).css("border-color", "red");
            }
        }
    });
    
                       
}

function validar(e) {
  tecla = (document.all) ? e.keyCode : e.which;
  return (tecla!=13)
  
}

function preregistrar_hojas(e, idRAD){
    //tecla = (document.all) ? e.keyCode : e.which;
    if (validar(e)){

        var hojas     = $("#noHojas_doc_"+idRAD).val();
        var url       = $("#base_url").val()+ "archivo/preregistrar_hojas";
        

        $.post( url, { noHojas: hojas, idRAD: idRAD })
            .done(function( data ) {
                console.log(data);
                console.log(data.retorno);
                if(data.retorno > 0){
                     $("#noHojas_doc_"+idRAD).css("border-color", "green");
                }else{
                    console.log("Error")
                    $.alert({
                        title: 'Alerta!',
                        content: 'Selecciona un tipo de documento!',
                        icon: 'fa fa-exclamation-circle',
                        type: 'red',
                        typeAnimated: true
                    });
                    //$("#noHojas_doc_"+idRAD).css("border-color", "red");
                    $("#noHojas_doc_"+idRAD).val("");

                }
               
            });
    }               
}

function cargar_estimaciones(e, idRel, idArchivo, preregistro){
        
    //tecla = (document.all) ? e.keyCode : e.which;
    if (validar(e)){
        $("#tipo_documento"+idRel).val(4);


        uf_recibir_tipo_documento(idRel, idArchivo, preregistro)


        var estimaciones = $("#noEstimaciones").val(); 
            $.ajax({
                beforeSend: function(){

                    $("#div_estimaciones_"+idRel).html("Cargando...")

                },
                type: "POST",

                url: "<?php echo site_url('archivo/cargar_estimaciones'); ?>/" + idRel+"/"+idArchivo+"/"+estimaciones,
                success: function (data) {

                    dibujar_tabla_estimaciones(idRel, idArchivo)
                    //$("#div_estimaciones_"+idRel).html(data["estimaciones"]); 
                     //$('#div_estimaciones').html("Hola");

                }
            }) ;
    }

  
}




/*$(function(){ 
    oTable = $('#tabla_documentos').dataTable({
        //ajax: sUrl_source_ajax,                    
        scrollX: false,
        deferRender: true,
        autoWidth: true,
        order: [],
        columnDefs: [ 
            {"targets": [0], 'searchable': false, "orderable": false, 'className': 'text-center small'},
            {"targets": [1], 'className': 'small sinwarp'},
            {"targets": [1], 'className': 'small sinwarp'},
            //{"targets": [2,3,4,5,10,11,12], 'className': 'small text-center'},
            //{"targets": [6], 'className': 'text-justify small'},
            //{"targets": [7], 'className': 'small'},
            //{"targets": [8,9], 'className': 'sinwarp text-right small'},
        ],
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros de la _START_ a la _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
        "oTableTools": {
            "aButtons": [
                {
                    "sExtends": "copy",
                    "sButtonText": "Copiar",
                    "oSelectorOpts": {
                        filter: "applied",
                        order: 'current'
                    }
                },
                {
                    "sExtends": "xls",
                    "sButtonText": "Exportar a XL",
                    "oSelectorOpts": {
                        filter: 'applied',
                        order: 'current'
                    },
                    "sFileName": "listado_registros.xls"
                },
            ]
        }

    });

    //traer procesos
    
                
    /*$("#identificador").select2({
        placeholder: "Ingresa Identificador",
        ajax: {
            url: '<?php echo site_url("transferencia/identificador_json"); ?>',
            dataType: 'json',
            quietMillis: 100,
            type: 'POST',
            data: function (term, page) {
                return {
                    term: term, //search term
                    page_limit: 100 // page size                               
                };
            },
            results: function (data, page) {
               
                return { results: data.results };
            }
        },
        initSelection: function(element, callback) {
            var idInicial = $("#identificador").val();
            return $.post( '<?php echo site_url("transferencia/identificador_json"); ?>', { id: idInicial }, function( data ) {
               
                return callback(data.results[0]);
               
            }, "json");
         
        }
    });
                
    $("#identificador").on("change", function(){
        ot = "<?php echo $idArchivo ?>"  
        id = $("#identificador").val()
        cambiar_identificador(ot, id)
    })
    
    function cambiar_identificador(idArchivo, id){
    
    
        $.post("<?php echo site_url('transferencia/editarIdentificador'); ?>/", 
                    { identificador : id, ot: idArchivo },
                    function(data) {
                        console.log(data)
                        $("#select2-chosen-1").css("background", "#d9e4da")
                    }
        ); 
    
    }
                
                
    $("div.btn-permisos  > a").attr("disabled", "disabled");*/
    
    
    /*
    $('#form-modificar-ubicacion').on('submit',function(event) {  
        //alert("OK");
        var idArchivo = $("#idUbi_Archivo").val();
        var proceso = $("#idUbi_Proceso").val();
        event.preventDefault();  
        var url = "<?php echo site_url("archivo/modificar_ubicacion_fisica"); ?>";  
        var datos = $(this).serialize();  
        $.post(url, datos, function(resultado) {  
            //alert(resultado);
            $("#modal-modificar-ubicacion").modal('hide');
            if (resultado == 1){
                dibujar_tabla_ubicaciones(idArchivo, proceso)
            }
        });  
    }); 
    
}); */


                        
/*/*function buscar_legajo(){
   $.ajax({
      url: 'buscar_empleado.php',
      type: 'POST',
      timeout: 10000,
      data: {legajo: $("#legajo").val()},
      beforeSend: function(){
         $("#respuesta").html('Buscando legajo...');
      },
      error: function(){
         $("#respuesta").html('');
            alert('Ha surgido un error.')
         },
      success: function(respuesta){
         $("#respuesta").html(respuesta);
      }
   })
} 
$(document).ready(function(){
   $("#boton_buscar_legajo").click(function(){
      buscar_legajo();
   });
});
    
    
                


function nuevo_tipo_anexo(){
    $("#modal-nuevo_tipo_anexo").modal('show');    
}

function estatus(idArchivoo, idTDd, idProceso, idSubproceso){
        $("#idEstatusE").val('');
        $("#idTitularidadE").val('');
        $("#idTpDocuest").val(idTDd);
        $("#idProceso_est").val(idProceso);
        $("#idSubProceso_est").val(idSubproceso);
        
    var parametros = {
        "idArchivoo" : idArchivoo,
        "idTpDocc" : idTDd,
    };
    $.ajax({
        data:  parametros,
        url:   '<?php echo site_url("archivo/estatus"); ?>',
        dataType: 'json',
        quietMillis: 100,
        type:  'POST',
        success:  function (data) {
            $("#idEstatusE").val(data['idEstatus']);
            $("#idTitularidadE").val(data['idTitularidad']);
        }
    });
    //alert(idArchivo)
    //alert(idProceso)
    //alert(idSubproceso)
    //alert(idTD)
    $("#modal-estatus").modal('show');    
}

function ubicacion_fisica(idArchivo, idTD, idProceso, idSubproceso){
        $("#ColumnaA").val('');
        $("#FilaA").val('');
        $("#CarpetaA").val('');
        $("#MetadatoO").val('');
        
        $("#idProceso_uf").val(idProceso);
        $("#idSubProceso_uf").val(idSubproceso);
        
    //alert(idArchivo)
    //alert(idProceso)
    //alert(idSubproceso)
    //alert(idTD)
    var parametros = {
        "idArchivo" : idArchivo,
        "idTpDoc" : idTD,
    };
    $.ajax({
        data:  parametros,
        url:   '<?php echo site_url("archivo/ubicacion"); ?>',
        dataType: 'json',
        quietMillis: 100,
        type:  'POST',
        success:  function (data) {
            $("#ColumnaA").val(data['Columna']);
            $("#FilaA").val(data['Fila']);
            $("#CarpetaA").val(data['Carpeta']);
            $("#MetadatoO").val(data['Metadato']);
        }
    });
    
    $("#idTpDocub").val(idTD);
    $("#modal-ubicacion_fisica").modal('show');    
}
        
        
function nuevo_doc_anexo(idArchivo,idRelDocumento,idProceso,idSubProceso, idDoc){
    var Es_Estimacion = 0;
    var Es_Prorroga = 0;
    var SubDoc = false;
    $("#idDocumento_anexo").val(idRelDocumento);
    $("#idArchivo_anexo").val(idArchivo);
    $("#idProceso_anexo").val(idProceso);
    $("#idSubProceso_anexo").val(idSubProceso);
    
    $("#idDoc_anexo").val(idDoc);
    
    
    
            
    var parametros = {
        "idDoc" : idDoc
    };
    $.ajax({
        data:  parametros,
        url:   '<?php echo site_url("archivo/Tipo_Documento"); ?>',
        dataType: 'json',
        quietMillis: 100,
        type:  'POST',
        success:  function (datan) {
            Es_Estimacion = datan['Es_Estimacion'];
            Es_Prorroga = datan['Es_Prorroga'];
            SubDoc = datan['SubDocs'];
            $("#Es_Estimacion_idd").val(datan['Es_Estimacion']);
            $("#Es_Prorroga_idd").val(datan['Es_Prorroga']);
            
            if(Es_Estimacion == '1'){
                document.getElementById('Estm_Prorr').style.display = 'block';
                document.getElementById('Es_Estimacion_id').style.display = 'block';
                document.getElementById('Es_Prorroga_id').style.display = 'none';
            }else if(Es_Prorroga == '1'){
                document.getElementById('Estm_Prorr').style.display = 'block';
                document.getElementById('Es_Prorroga_id').style.display = 'block';
                document.getElementById('Es_Estimacion_id').style.display = 'none';
            }else{
                document.getElementById('Estm_Prorr').style.display = 'none';
            }
          
        }
    });
    
    id=idDoc;
    
        var subdocumento=0;
        $.ajax({
            url: "<?php echo site_url('archivo/no_subdocumento'); ?>/" + idDoc,
            dataType: 'json',
            success: function (data, textStatus, jqXHR) {
                
                 subdocumento = data['numero'];
                 
                 if (subdocumento >0){
                     document.getElementById('presenta_subdocumentos').style.display = 'block';
                 }else{
                     document.getElementById('presenta_subdocumentos').style.display = 'none';
                 }
            }
        });
        
       
    
    $("#modal-nuevo_anexo").modal('show');    
}
        
        
        
         function modificar_listado_sub_documentos_mod()
            {
                
               
                
                id=$("#idDoc_anexo").val();
                
                
               
                
                $.ajax({
                    url: "<?php echo site_url('archivo/listado_sub_documentos_mod'); ?>/" + id,
                    dataType: 'json',
                    success: function (data, textStatus, jqXHR) {
                        $("#listado_sub_documentos_mod").html(data);
                    }
                });
                
                
            }
        
        
        
        function modificar_sub_documento_mod(id)
            {
                $("#idSubDocumento_mod").val(id);
                $("#modal-cambiar-sub-documentos-mod").modal('hide');
               
               
                
                
               

                
                
                $.ajax({
                    url: "<?php echo site_url('archivo/datos_subdocumento'); ?>/" + id,
                    dataType: 'json',
                    success: function (data, textStatus, jqXHR) {
                        var subdocumento =data['Nombre'];
                        $("#subdocumento_mod").html(subdocumento);
                    }
                });
            }
        
        
        function mostrar_Estim(){
            if(document.getElementById('m_c_estim').style.display === 'block'){
                document.getElementById('m_c_estim').style.display = 'none';
                document.getElementById('Es_Prorroga_id').style.display = 'block';
            }else{
                document.getElementById('m_c_estim').style.display = 'block';
                document.getElementById('Es_Prorroga_id').style.display = 'none';
            }
        }
        function mostrar_Prorr(){
            if(document.getElementById('m_c_prorr').style.display === 'block'){
                document.getElementById('m_c_prorr').style.display = 'none';
                document.getElementById('Es_Estimacion_id').style.display = 'block';
            }else{
                document.getElementById('m_c_prorr').style.display = 'block';
                document.getElementById('Es_Estimacion_id').style.display = 'none';
            }
        }
        
        
        
        function numeroAleatorio(min, max){
          return Math.round(Math.random() * (max - min) + min);
        }
        
        function addfile_individual(){
            idDoc = numeroAleatorio(1, 1000000);
            var xx = document.createElement("INPUT");
            xx.setAttribute("type", "file");
            xx.setAttribute("name", "docfile[]");
            xx.setAttribute("class", "form-control");
            xx.setAttribute("id", idDoc);
            xx.setAttribute("required", "");
            document.getElementById('crearfile').appendChild(xx);

            var texto = document.createTextNode("Quitar Documento");
            var xxx = document.createElement("BUTTON");
            xxx.setAttribute("type", "button");
            xxx.setAttribute("onclick", "eliminar("+idDoc+")");
            xxx.setAttribute("class", "btn btn-danger");
            xxx.setAttribute("value", "Borrar");
            xxx.setAttribute("title", "Borrar");
            xxx.setAttribute("id", idDoc);
            xxx.appendChild(texto);
            document.getElementById('crearfile').appendChild(xxx);

            var x = document.createElement("br");
            x.setAttribute("id", idDoc);
            document.getElementById('crearfile').appendChild(x);
        }
        
        function eliminar(nodo_name){
            if(document.getElementById(nodo_name)){
                var x = document.getElementById(nodo_name);
                x.parentNode.removeChild(x);
                eliminar(nodo_name);
            }else{
                //alert("se removio el nodo:"+nodo_name);
            }
        }
        function uf_modificar_archivo(id){
            $("#idCatalogo").val(id);
                //var marcado = $("#chkStatus").prop("checked") ? true : false;
                $.ajax({
                    url: "<?php echo site_url('archivo/datos_archivo') ?>/" + id,
                    dataType: 'json',
                    success: function (data, textStatus, jqXHR) {
                        $("#OrdenTrabajo_mod").val(data['OrdenTrabajo']);
                        $("#Contrato_mod").val(data['Contrato']);
                        $("#Obra_mod").val(data['Obra']);
                        $("#Descripcion_mod").val(data['Descripcion']);
                        $("#FondodePrograma_mod").val(data['FondodePrograma']);
                        $("#Normatividad_mod").val(data['Normatividad']);
                        $("#idModalidad_mod").val(data['idModalidad']);
                        $("#idEjercicio_mod").val(data['idEjercicio']);
                        $("#Proyecto_mod").val(data['proyecto']);
                        
                        if ($("#Proyecto_mod").val() == 1){
                            $("#Proyecto_mod").prop("checked", true);
                        } 
                        
                         
                        
                         
                    }
                });
                
        }
        
        
        
        function uf_recibir_documento(elemento,idRel_Archivo_Documento) {
                            
            recibido=0;
            if (elemento.checked){
                recibido=1;
                $("#recibio"+idRel_Archivo_Documento).prop( "disabled", true );
            }





            $.ajax({
               type:"POST",
               url:"<?php echo site_url('archivo/edit_recibio'); ?>/" + idRel_Archivo_Documento,
               data: {recibido:recibido} ,
               success: function(data) {
                 //$('.center').html(data); 
                 alert ("OK")
                 $('#numero_documentos_proceso_recibidos'+data["idTipoProceso"]).html(data["strTipoProceso_recibido"])
                 $('#numero_documentos_subproceso_recibidos'+data["idSubTipoProceso"]).html(data["strSubTipoProceso_recibido"])

               }
             });
                        
                       
                           
        }
        
        
        function modificar_tipo_documento(idRel_Archivo_Documento, idArchivo, preregistro, idRAP) {
                        
                        //alert($("#tipo_documento"+idRel_Archivo_Documento).val())
            if($("#tipo_documento"+idRAP).val()==1){
                preregistrado=1;
            }
            if($("#tipo_documento"+idRAP).val()==2){ 
                preregistrado=2;
            }
            if($("#tipo_documento"+idRAP).val()==0){
                preregistrado=0;
                $("#noHojas_doc_"+idRAP).val("")
                $("#oculta-noHojas-"+idRAP).css("display", "none")
            }
            if($("#tipo_documento"+idRAP).val()==3){
                preregistrado=3;
                $("#noHojas_doc_"+idRAP).val(0)
                $("#oculta-noHojas-"+idRAP).html("<b>No Hojas: </b> 0")
            }
            //Si contiene estimaciones
            if($("#tipo_documento"+idRAP).val()==4){
                preregistrado=4;

            }
                      
                         
                $.ajax({
                  type:"POST",
                  url:"<?php echo site_url('archivo/modificar_tipo_documento'); ?>/" + idRel_Archivo_Documento +'/' + idArchivo +'/' + idRAP,
                  data: {
                      preregistrado:preregistrado
          } ,



                  }) .done(function( data, textStatus, jqXHR ) {

                       $("#tipo_documento"+idRAP).css("border-color", "green");
                       $('#numero_documentos_proceso_preregistrados'+data["idTipoProceso"]).css("display", "none")


                       if (preregistro==1){
                           $('#numero_documentos_proceso_preregistrados_preregistro'+data["idTipoProceso"]).css("display", "block")
                           $('#numero_documentos_proceso_preregistrados_preregistro'+data["idTipoProceso"]).html(data["strTipoProceso_preregistrados"])
                           $('#numero_documentos_subproceso_preregistrados'+data["idSubTipoProceso"]).html(data["strSubTipoProceso_preregistrados"])
                       } else{

                           $('#numero_documentos_proceso_preregistrados_recibe'+data["idTipoProceso"]).css("display", "block")

                           $('#numero_documentos_proceso_preregistrados_recibe'+data["idTipoProceso"]).html(data["strTipoProceso_cid"])
                           $('#numero_documentos_subproceso_preregistrados_recibe'+data["idSubTipoProceso"]).html(data["strSubTipoProceso_cid"])
                       }
                        if ( console && console.log ) {
                            console.log( "La solicitud se ha completado correctamente." );
                        }
                        $("#preregistro-"+idRel_Archivo_Documento).val(data.registro);
                    })
                    .fail(function( jqXHR, textStatus, errorThrown ) {

                       $("#tipo_documento"+idRAP).css("border-color", "red");
                        if ( console && console.log ) {
                            console.log( "La solicitud a fallado: " +  textStatus);
                        }
                   });
                        
                       
                           
        }
        
        
        //**
        function uf_recibir_tipo_documento(idRel_Archivo_Documento, idArchivo, preregistro) {
                        
                        //alert($("#tipo_documento"+idRel_Archivo_Documento).val())
                        if($("#tipo_documento"+idRel_Archivo_Documento).val()==1){
                            preregistrado=1;
                        }
                        if($("#tipo_documento"+idRel_Archivo_Documento).val()==2){ 
                            preregistrado=2;
                        }
                        if($("#tipo_documento"+idRel_Archivo_Documento).val()==0){
                            preregistrado=0;
                            $("#noHojas_doc_"+idRel_Archivo_Documento).val("")
                            $("#oculta-noHojas-"+idRel_Archivo_Documento).css("display", "none")
                        }
                        if($("#tipo_documento"+idRel_Archivo_Documento).val()==3){
                            preregistrado=3;
                            $("#noHojas_doc_"+idRel_Archivo_Documento).val(0)
                            $("#oculta-noHojas-"+idRel_Archivo_Documento).html("<b>No Hojas: </b> 0")
                        }
                        //Si contiene estimaciones
                        if($("#tipo_documento"+idRel_Archivo_Documento).val()==4){
                            preregistrado=4;
                            
                        }
                        //alert('preregistrado ' +preregistrado)
                        
                       
                    //alert ($("#tipo_documento"+idRel_Archivo_Documento).val())
                       
                       
                        
                         
                         $.ajax({
                           type:"POST",
                           url:"<?php echo site_url('archivo/edit_preregistrados'); ?>/" + idRel_Archivo_Documento +'/' + idArchivo,
                           data: {preregistrado:preregistrado} ,
                            
                                
                              
                           }) .done(function( data, textStatus, jqXHR ) {
                                
                                $("#tipo_documento"+idRel_Archivo_Documento).css("border-color", "green");
                                $('#numero_documentos_proceso_preregistrados'+data["idTipoProceso"]).css("display", "none")
                                 
                                 
                                if (preregistro==1){
                                    $('#numero_documentos_proceso_preregistrados_preregistro'+data["idTipoProceso"]).css("display", "block")
                                    $('#numero_documentos_proceso_preregistrados_preregistro'+data["idTipoProceso"]).html(data["strTipoProceso_preregistrados"])
                                    $('#numero_documentos_subproceso_preregistrados'+data["idSubTipoProceso"]).html(data["strSubTipoProceso_preregistrados"])
                                } else{
                                 
                                    $('#numero_documentos_proceso_preregistrados_recibe'+data["idTipoProceso"]).css("display", "block")
                             
                                    $('#numero_documentos_proceso_preregistrados_recibe'+data["idTipoProceso"]).html(data["strTipoProceso_cid"])
                                    $('#numero_documentos_subproceso_preregistrados_recibe'+data["idSubTipoProceso"]).html(data["strSubTipoProceso_cid"])
                                }
                                 if ( console && console.log ) {
                                     console.log( "La solicitud se ha completado correctamente." );
                                 }
                                 $("#preregistro-"+idRel_Archivo_Documento).val(data.registro);
                             })
                             .fail(function( jqXHR, textStatus, errorThrown ) {
                                
                                $("#tipo_documento"+idRel_Archivo_Documento).css("border-color", "red");
                                 if ( console && console.log ) {
                                     console.log( "La solicitud a fallado: " +  textStatus);
                                 }
                            });
                        
                       
                           
        }
        
        
        
        
        //Cuando hay preregistro
        function uf_recibir_tipo_documento_preregistro(id, id_Rel_Archivo_Documento, idArchivo) {
                        
                        //alert($("#tipo_documento"+idRel_Archivo_Documento).val())
                        if($("#tipo_documento"+id).val()==1){
                            preregistrado=1;
                        }
                        if($("#tipo_documento"+id).val()==2){ 
                            preregistrado=2;
                        }
                        if($("#tipo_documento"+id).val()==0){
                            preregistrado=0;
                        }
                        if($("#tipo_documento"+id).val()==3){
                            preregistrado=3;
                            $("#noHojas_doc_"+id).val(0)
                            $("#oculta-noHojas-"+id).html("0")
                        }
                        //Si contiene estimaciones
                        if($("#tipo_documento"+id).val()==4){
                            preregistrado=4;
                        }
                        //alert('preregistrado ' +preregistrado)
                        
                       
                    //alert ($("#tipo_documento"+idRel_Archivo_Documento).val())
                       
                       
                        $.ajax({
                           type:"POST",
                           url:"<?php echo site_url('archivo/editar_documento_preregistro'); ?>/"+id+'/' + id_Rel_Archivo_Documento +'/' + idArchivo,
                           data: {preregistrado:preregistrado} ,
                           success: function(data) {
                             //$('.center').html(data); 
                                //alert('Data ' +data)
                            
                                $('#numero_documentos_proceso_preregistrados'+data["idTipoProceso"]).html(data["strTipoProceso_preregistrados"])
                                $('#numero_documentos_subproceso_preregistrados'+data["idSubTipoProceso"]).html(data["strSubTipoProceso_preregistrados"])
                             
                           }
                         });
                        
                       
                           
        }
        
        
        function uf_recibir_estimacion(elemento,idEstimacion) {
               
                        var Est_recibido=0;
                        if (elemento.checked){
                            Est_recibido=1;
                        }
                        
                       
                    
                       
                       
                        $.ajax({
                           type:"POST",
                           url:"<?php echo site_url('archivo/edit_est_recibio'); ?>/" + idEstimacion +'/' + Est_recibido,
                           data: {recibido:Est_recibido } ,
                           success: function (data) {
                             //$('.center').html(data); 
                            
                             
                             
                           }
                         });
                       
        }
        
        //Documento
        function uf_recibir_tipo_estimacion(idEstimacion) {
                        
                        //alert ($("#tipo_documento_est"+idEstimacion).val())
                        
                        if($("#tipo_documento_est"+idEstimacion).val()==1){
                            recibido=1;
                           
                        }
                        if($("#tipo_documento_est"+idEstimacion).val()==2){
                        
                            recibido=2;
                            
                        }
                        if($("#tipo_documento_est"+idEstimacion).val()==3){
                        
                            recibido=3;
                        }
                        if($("#tipo_documento_est"+idEstimacion).val()==0){
                        
                            recibido=0;
                            $("#noHojas_est_"+idEstimacion).val(0)
                            $("#div_noHojas_est_"+idEstimacion).html("<b>No Hojas: </b> 0" )
                            $("#div_noHojas_est_aux_"+idEstimacion).html("<b>No Hojas: </b> 0" )
                        }
                        
                        
                       
                    //alert ($("#tipo_documento"+idRel_Archivo_Documento).val())
                       
                       
                        $.ajax({
                           type:"POST",
                           url:"<?php echo site_url('archivo/preregistrar_documento_estimacion'); ?>/" + idEstimacion,
                           data: {recibido:recibido} ,
                           success: function(data) {
                             //$('.center').html(data); 
                            if (data = 1){
                                $("#tipo_documento_est"+idEstimacion).css("border-color", "green");
                            } else {
                                $("#tipo_documento_est"+idEstimacion).css("border-color", "red");
                            }
                            
                             //$('#numero_documentos_proceso_recibidos'+data["idTipoProceso"]).html(data["strTipoProceso_recibido"])
                             //$('#numero_documentos_subproceso_recibidos'+data["idSubTipoProceso"]).html(data["strSubTipoProceso_recibido"])
                             
                           }
                         });
                        
                       
                           
        }
        
        

        function uf_original_recibido_estimacion(elemento,idEstimacion) {
                        
                        
                        
                        var Est_original_recibido=0;
                        if (elemento.checked){
                            Est_original_recibido=1;
                        }
                       
                       
                    
                       
                       
                        $.ajax({
                           type:"POST",
                           url:"<?php echo site_url('archivo/edit_original_recibido_estimacion'); ?>/" + idEstimacion +'/' + Est_original_recibido,
                           data: {original_recibido:Est_original_recibido} ,
                           success: function (data) {
                             //$('.center').html(data); 
                            
                             
                             
                           }
                         });
                         
                         
                        
                       
                           
        }
        
        function uf_revisado_estimacion(elemento,idEstimacion) {
                        
                        
                        
                        var Est_revisado=0;
                        if (elemento.checked){
                            Est_revisado=1;
                        }
                       
                       
                    
                       
                       
                        $.ajax({
                           type:"POST",
                           url:"<?php echo site_url('archivo/edit_est_revisado'); ?>/" + idEstimacion +'/' + Est_revisado,
                           data: {revisado:Est_revisado} ,
                           success: function (data) {
                             //$('.center').html(data); 
                            
                             
                             
                           }
                         });
                         
                         
                        
                       
                           
        }

                            
           
        
        
        function uf_orginal_recibido(elemento,idRel_Archivo_Documento) {
                        
                        
                        original_recibido=0;
                        if (elemento.checked){
                            original_recibido=1;
                        }
                       
                        $.ajax({
                           type:"POST",
                           url:"<?php echo site_url('archivo/edit_original_recibio'); ?>/" + idRel_Archivo_Documento,
                           data: {original_recibido:original_recibido} ,
                           success: function(data) {
                             //$('.center').html(data); 
                             
                           }
                         });
                        
                       
                           
        }
        
        
        
        
        function uf_recibir_revisado(elemento, idArchivo, id ,idRel_Archivo_Documento) {
                        
                        
                        //Estado OT 
                        
                        $.ajax({
                            type: "POST",
                            url: "<?php echo site_url('archivo/estado_ot'); ?>/"  + idArchivo,
                            success: function (data, textStatus, jqXHR) {
                                console.log(data)
                                var revisado=0;
                                if (elemento.checked){
                                    revisado=1;
                                }

                                if (data == 1){
                                    trabajar_ot(idArchivo);
                                    





                                    $.ajax({
                                       type:"POST",
                                       url:"<?php echo site_url('archivo/edit_revisado'); ?>/" + id + "/" + idRel_Archivo_Documento,
                                       data: {revisado:revisado} ,
                                       success: function(data) {
                                         //$('.center').html(data);
                                          if(data.Revision == 1){
                                              $("#revisado-"+id).css("border-color","red")
                                              $("#revisado-"+id).prop("checked",false)
                                              $.alert({
                                                title: 'Alerta!',
                                                content: 'Ya marcaste como revisado un documento !',
                                                });

                                          }else{

                                          $('#numero_documentos_proceso_revisados'+data["idTipoProceso"]).html(data["strTipoProceso_revisado"])
                                          $('#numero_documentos_subproceso_revisados'+data["idSubTipoProceso"]).html(data["strSubTipoProceso_revisado"])
                                          }

                                       }
                                     });
                                     
                                     
                                } else {
                                   $.confirm({
                                        title: 'Lo Sentimos!',
                                        content: 'Esta OT esta ocupada. No puedes trabajar con los documentos',
                                        type: 'red',
                                        typeAnimated: true,
                                        buttons: {
                                            tryAgain: {
                                                text: 'Cerrar',
                                                btnClass: 'btn-red',
                                                action: function(){
                                                    //alert("OG " +revisado)
                                                    if (revisado == 0){
                                                        elemento.checked = 1
                                                    } else {
                                                        elemento.checked = 0
                                                    }
                                                }
                                            }
                                        }
                                    });
                                }

                            }
                        });
                        //alert(estado)
                       
                        
                       
                           
        }
        
        function uf_recibido_cid(elemento,id, idRel_Archivo_Documento) {
                 
                        recibido_cid=0;
                        if (elemento.checked){
                            recibido_cid=1;
                        }
                        
                        
                        //Verificar estado trabajo
                        $.ajax({
                           type:"POST",
                           url:"<?php echo site_url('archivo/actualizar_estado_trabajo'); ?>/" + idRel_Archivo_Documento,
                           success: function(data) {
                              console.log(data)
                              var msj = data
                              //Si no esta ocupado el bloque
                               if ( data == 1){
                                   //recibir
                                   $.ajax({
                                        type:"POST",
                                        url:"<?php echo site_url('archivo/edit_recibido_cid'); ?>/" + id+"/"+ idRel_Archivo_Documento,
                                        data: {recibido_cid:recibido_cid} ,
                                        success: function(data) {

                                            $('#numero_documentos_proceso_recibidos'+data["idTipoProceso"]).html(data["strTipoProceso_recibido"])
                                            $('#numero_documentos_subproceso_recibidos'+data["idSubTipoProceso"]).html(data["strSubTipoProceso_recibido"])
                                            //$('#estado-bloque-'+data["idTipoProceso"]).css("color", "red");
                                            $('#estado-bloque-'+data["idTipoProceso"]).html("<span class='glyphicon glyphicon-folder-open'></span> Trabajando con Bloque");

                                            $("#enviar_revision_"+data["idTipoProceso"]).css("display", "block")
                                            //alert(data["TipoProceso_distinct"] +"=="+ data["NumTipoProceso"])
                                            if (data["TipoProceso_distinct"] == data["NumTipoProceso"]){
                                                //alert ("son iguales")
                                                $("#enviar_revision_"+data["idTipoProceso"]).css("display", "block")
                                            }else{
                                                $("#enviar_revision_"+data["idTipoProceso"]).css("display", "none")
                                            }
                                        }
                                    });
                                   
                               } else {
                                    elemento.checked = 0
                               
                                    $.confirm({
                                        title: 'Alerta!',
                                        content: ' '+msj,
                                        type: 'red',
                                        typeAnimated: true,
                                        buttons: {
                                            Cerrar: {
                                                text: 'Cerrar',
                                                btnClass: 'btn-red',
                                                action: function(){
                                                }
                                            }
                                           
                                        }
                                    });
                                   
                                
                               }
                           }
                         });
                       
                        
                             
        }
        
        
        function uf_orginal_revisado(elemento,idRel_Archivo_Documento) {
                        
                        
            original_revisado=0;
            if (elemento.checked){
                original_revisado=1;
            }

            $.ajax({
               type:"POST",
               url:"<?php echo site_url('archivo/edit_original_revisado'); ?>/" + idRel_Archivo_Documento,
               data: {original_revisado:original_revisado} ,
               success: function(data) {
                 //$('.center').html(data);

               }
             });
                        
                       
                           
        }
        
        
        
        function uf_ubicacion_fisica(elemento,idArchivo,idProceso) {
                        
                        
                        
                       
                        Ubicacion_fisica=elemento.value;        
                        
                      
                       
                        $.ajax({
                           type:"POST",
                           url:"<?php echo site_url('archivo/edit_ubicacion_fisica'); ?>/" + idArchivo+"/"+idProceso,
                           data: {Ubicacion_fisica:Ubicacion_fisica} ,
                           success: function(data) {
                             //$('.center').html(data); 
                           }
                         });
                        
                       
                           
        }
        
        
        function uf_folio_desde(elemento,idArchivo,idProceso) {
                       
                        folio_desde=elemento.value;        
                        $.ajax({
                           type:"POST",
                           url:"<?php echo site_url('archivo/edit_folio_desde'); ?>/" + idArchivo+"/"+idProceso,
                           data: {folio_desde:folio_desde} ,
                           success: function(data) {
                             //$('.center').html(data); 
                           }
                         });
        }
        
        
         function uf_folio_hasta(elemento,idArchivo,idProceso) {
                        folio_hasta=elemento.value;        
                        $.ajax({
                           type:"POST",
                           url:"<?php echo site_url('archivo/edit_folio_hasta'); ?>/" + idArchivo+"/"+idProceso,
                           data: {folio_hasta:folio_hasta} ,
                           success: function(data) {
                             //$('.center').html(data); 
                           }
                         });
        }
        
        
        function ver_observaciones_archivo(idArchivo){
                    $.ajax({
                        type:"POST",
                        url:"<?php echo site_url('archivo/ver_observaciones_archivo'); ?>/" + idArchivo,
                        success: function(data) {
                         $('#idObservacionesArchivo').html(data["historial"]); 
                        }
                      });
        }
        
        function ver_observaciones_documento(idArchivo,idProceso ,idSubTipoProceso, idDocumento, preregistro){
        
                    if (preregistro == 0){
                        $.ajax({
                            type:"POST",
                            url:"<?php echo site_url('archivo/ver_observaciones_documento'); ?>/" + idArchivo+"/"+idProceso+"/"+idSubTipoProceso+"/"+idDocumento,
                               success: function(data) {
                                $('#idObservacionesBloque').html(data["historial"]); 
                               }
                            });
                    } else {
                    
                        $.ajax({
                            type:"POST",
                            url:"<?php echo site_url('archivo/ver_observaciones_documento_direccion'); ?>/" + idArchivo+"/"+idProceso+"/"+idSubTipoProceso+"/"+idDocumento,
                               success: function(data) {
                                $('#idObservacionesBloque').html(data["historial"]); 
                               }
                            });
                    
                    }
        }
        
        function ver_observaciones_documento_por_archivo(idArchivo){
                $.ajax({
                        type:"POST",
                        url:"<?php echo site_url('archivo/ver_observaciones_documento_por_archivo'); ?>/" + idArchivo,
                        success: function(data) {
                         $('#idObservacionesArchivo_Documento').html(data["historial"]); 
                        }
                      });
        }
        
        
        function uf_ver_historia_bloque(idArchivo,idProceso) {
                        $.ajax({
                           type:"POST",
                           url:"<?php echo site_url('archivo/ver_historia_bloque'); ?>/" + idArchivo+"/"+idProceso,
                           success: function(data) {
                            $('#idHistorialBloque').html(data["historial"]); 
                           }
                         });
        }
        
        
        
        function uf_ver_observaciones_bloque(idArchivo,idProceso ,idSubTipoProceso, idDocumento) {
                        $.ajax({
                           type:"POST",
                           url:"<?php echo site_url('archivo/ver_observaciones_bloque'); ?>/" + idArchivo+"/"+idProceso+"/"+idSubTipoProceso+"/"+idDocumento,
                           success: function(data) {
                            $('#idObservacionesBloque').html(data["historial"]); 
                           }
                         });
        }
        
        
        
        function uf_ver_ubicacion_fisica_libre(idArea, idArchivo) {
                        
                       
                        
                        $.ajax({
                           type:"POST",
                           url:"<?php echo site_url('archivo/ver_ubicaciones_libres_area'); ?>/" + idArea + "/" +idArchivo, 
                           success: function(data) {
                              
                                $('#idUbicacionFisica_libre').html(data["ubicacion_fisica_libre"]); 
                           }
                         });
                       
        }
        
        function uf_ver_ubicacion_fisica_libre_mod(idArea, idArchivo) {
                        
                       
                        
                        $.ajax({
                           type:"POST",
                           url:"<?php echo site_url('archivo/ver_ubicaciones_libres_mod'); ?>/" + idArea + "/" +idArchivo,
                           success: function(data) {
                              
                                $('#idUbicacionFisica_libre_mod').html(data["ubicacion_fisica_libre"]); 
                           }
                         });
                       
        }
        
        
       
        function uf_enviar_revision(idProceso, idArchivo) {
               $("#idTipoProceso_revision").val(idProceso);
               $("#Estatus-recibir").show();
               liberar_estado_trabajo(idProceso, idArchivo,0);
        }

        function uf_enviar_foliado(idProceso, idArchivo) {
               $("#idTipoProceso_foliado").val(idProceso);
               liberar_estado_trabajo(idProceso, idArchivo,0);
        }
       
       
       function uf_enviar_validar(idProceso, idArchivo) {
               $("#idTipoProceso_validar").val(idProceso);
               liberar_estado_trabajo(idProceso, idArchivo,0);
        }
       
       function uf_enviar_digitalizar(idProceso, idArchivo) {
               $("#idTipoProceso_digitalizar").val(idProceso);
               liberar_estado_trabajo(idProceso, idArchivo,0);
        }
     
        function uf_enviar_editar(idProceso, idArchivo) {
               $("#idTipoProceso_editar").val(idProceso);
               liberar_estado_trabajo(idProceso, idArchivo,0);
        }
        
        function uf_enviar_integracion(idProceso, idArchivo) {
               $("#idTipoProceso_integracion").val(idProceso);
               liberar_estado_trabajo(idProceso, idArchivo,0);
        }
        
        
        function uf_enviar_finalizar(idProceso, idArchivo) {
               $("#idTipoProceso_finalizar").val(idProceso);
               $("#finalizar").hide();
               $("#finalizar-oculto").show();
               liberar_estado_trabajo(idProceso, idArchivo, 0);
        }
        
        
        
        function uf_enviar_rechazar(idProceso) {
               $("#idTipoProceso_rechazar").val(idProceso);
        }
        
        function uf_agregar_observaciones(idProceso, idSubProceso, idDocumento, direccion, usuario_preregistro) {
               $("#idTipoProceso_observacion").val(idProceso);
               $("#idSubTipoProceso_observacion").val(idSubProceso);
               $("#idDocumento_observacion").val(idDocumento);
               $("#dir_respuesta_observacion").val(direccion);
               $("#usuario_preregistro").val(usuario_preregistro);
               
               
               
               
        }
        
        function uf_agregar_ubicacion(idProceso){
                $("#idTipoProceso_ubicacion").val(idProceso);
        }
        
        
        
        function uf_totales_recibidos_revisados(idArchivo,idProceso,idSubProceso) {
                        
                      
                       
                        $.ajax({
                           type:"POST",
                           url:"<?php echo site_url('archivo/total_documentos_revisados'); ?>/" + idArchivo+"/"+idProceso+"/"+idSubProceso,
                           success: function(data) {
                             alert(data["strSubTipoProceso_revisado"]);  
                             $('#numero_documentos_proceso_revisados'+data["idTipoProceso"]).html(data["strTipoProceso_revisado"])
                             $('#numero_documentos_subproceso_revisados'+data["idSubTipoProceso"]).html(data["strSubTipoProceso_revisado"])
                             
                              
                             
                           }
                         });
                        
                        $.ajax({
                           type:"POST",
                           url:"<?php echo site_url('archivo/total_documentos_recibidos'); ?>/" + idArchivo+"/"+idProceso+"/"+idSubProceso,
                           success: function(data) {
                             $('#numero_documentos_proceso_recibidos'+data["idTipoProceso"]).html(data["strTipoProceso_recibido"])
                             $('#numero_documentos_subproceso_recibidos'+data["idSubTipoProceso"]).html(data["strSubTipoProceso_recibido"])
                           }
                         });
                       
                           
        }
        
        function agregar_observaciones_estimacion(){
            
            
            var marcado =0
            $("#observacion_estimacion").modal('hide');
            if ($("#tipo_observacion_estimacion").prop("checked")){
                marcado = 1
            }
            
                $.ajax({
                    data: {
                        "Motivo" :$("#motivo_observacion_estimacion").val(), 
                        "idArchivo" : $("#idArchivo_realizo_observacion").val(),
                        "idEstimacion" : $("#idEstimacion_observacion").val(),
                        "direccion_respuesta" : $("#idDireccion_respuesta").val(),
                        "idDireccion" : $("#direccion_realizo_observacion").val(),
                        "tipo_usuario" : $("#tipo_usuario_realizo_observacion").val(),
                        "tipo_observacion" : marcado,
                    
                    },
                    type: "POST",
                    dataType: "json",
                    url: "<?php echo site_url('archivo/agregar_observaciones_estimacion/'); ?>",
                })
                 .done(function( data, textStatus, jqXHR ) {
                     if ( console && console.log ) {
                         console.log( "La solicitud se ha completado correctamente." );
                     }
                 })
                 .fail(function( jqXHR, textStatus, errorThrown ) {
                     if ( console && console.log ) {
                         console.log( "La solicitud a fallado: " +  textStatus);
                     }
                });
            $("#motivo_observacion_estimacion").val("");
            $("#tipo_observacion_estimacion").prop("checked", false);
        }
        
        
        
         function uf_agregar_ubicacion_fisica_mod(id,ubicacion_fisica)
            {
                $("#idUbicacionFisica_mod").val(id);
                $("#txtnom_mod").val(ubicacion_fisica);
                $("#modal-cambiar-ubicacionfisica-mod").modal('hide');
                
            }
            
        function uf_agregar_ubicacion_fisica(id,ubicacion_fisica)
            {
                $("#idUbicacionFisica").val(id);
                $("#nomubicacionfisica").html(ubicacion_fisica);
                $("#modal-cambiar-ubicacionfisica").modal('hide');
                
            }
            
        
        function uf_modificar_ubicacion(id) {

                $("#idRel_mod").val(id);
                
                $.ajax({
                    url: "<?php echo site_url('ubicacionFisica/datos_relacion_ubicacion') ?>/" + id,
                    dataType: 'json',
                    success: function (data, textStatus, jqXHR) {
                        //$idProceso = $("#Nombre_mod").val(data['Nombre']);
                        
                        var ubicacion = data['Columna'] + data['Fila'] + data['CajaUbi'] + data['Apartado'] + data['Posicion'];
                        $("#txtnom_mod").val(ubicacion);
                        $("#idUbicacionFisica_mod").val(data['idUbi']);
                        $("#idUbi_Proceso").val(data['idTipoProceso']);
                        $("#idUbi_anterior").val(data['idUbi']);

                        
                        
                    }
                });

                

            } 
        
        function uf_agregar_documentos(idArchivo, idProceso){
            $("#idArchivo_agregar").val(idArchivo);
            $("#idProceso_agregar").val(idProceso);
                $.ajax({
                    url: "<?php echo site_url('archivo/listado_documentos_por_proceso') ?>/" + idProceso + "/" +idArchivo,
                    dataType: 'json',
                    success: function (data, textStatus, jqXHR) {
                        
                        $("#tablaDocumentos").html(data["listado"]);
                       //$("#tablaDocumentos").html("Hola");
                    }
                });
                
                
        }
        
        function imprimir_documento_agregado(idDocumento, idProceso, idSubProceso, idArchivo){
            $("#modal-agregar-documentos").modal('hide');
           
            $.ajax({
                    url: "<?php echo site_url('archivo/agregar_relacion_archivo_documento') ?>/" + idDocumento + "/" + idProceso + "/" + idSubProceso + "/" + idArchivo,
                    dataType: 'json',
                    success: function (data, textStatus, jqXHR) {
                        
                    }
                });
            
            location.href="<?php echo site_url('archivo/cambios') ?>" +"/"  + idArchivo;
        }
        
        function actualizar_plantilla(recibio){
            if (recibio == 1){
                alert ('Ya tienes documentos recibidos, no puedes volver a cargar la plantilla')
            }
        }
        
        function cargar_identificador(id){
            //prevent.default()
            var identificador = $("#identificador").val();
             
            
            $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('archivo/cargar_identificador') ?>/" + id + "/" + identificador,
                     
                    success: function (data, textStatus, jqXHR) {
                         $("#identificador").css("border-color", "green");
                          
                    }
                });
                 
                /*$("#identificador").val("");
                $("#caja-i").hide();
                $("#oculta").html("<b>Identificador: </b>" + identificador);
                $("#oculta").show();*/
                //document.getElementById('caja-v').style.display = 'block';
      /*       
             
             
        }
         
         
        function cargar_bloqueObra(id){
         
            var bloque = $("#slc_obra").val();
             
            //alert($("#slc_obra").val());
            
            $.ajax({
                    url: "<?php echo site_url('archivo/cargar_idBloqueObra') ?>/" + id + "/" + bloque,
                    dataType: 'json',
                    success: function (data, textStatus, jqXHR) {
                          
                          
                    }
                });
                 
                //$("#idBloqueObra").val("");
               // $("#caja-b").hide();
                //$("#oculta-b").html("<b>Bloque : </b>" + identificador);
                //$("#oculta-b").show();
                //document.getElementById('caja-v').style.display = 'block';
        }
         
        
        function uf_modificar_observacion(id){
                $("#ver_observaciones_bloque_archivo").modal('hide');
                $('#idCatalogo').val(id);
                
                $.ajax({
                    url: "<?php echo site_url('observaciones/datos_observacion') ?>/" + id,
                    dataType: 'json',
                    success: function (data, textStatus, jqXHR) {
            $("#OrdenTrabajo").html(data['OrdenTrabajo']);
                        $("#Contrato").html(data['Contrato']);
                        $("#Obra").html(data['obra']);
                        $("#Motivo").html(data['Motivo']);
                        $("#Respuesta").html(data['Respuesta']);
                        
                    }
                
                });
                
                
            }
        function modificar_observacion_documento(id){
                //$("#mod-observacion-documento").modal('hide');
                $("#observaciones_bloque").modal('hide');
                $('#idCatalogo_mod_observacion').val(id);
               
                
                $.ajax({
                    url: "<?php echo site_url('observaciones/datos_observacion_documento_por_id') ?>/" + id,
                    dataType: 'json',
                    success: function (data, textStatus, jqXHR) {
                        //alert (data['motivo'])
                        //alert (data['tipo_observacion'])
                        $("#mod_motivo_observacion").html(data['Motivo']);
                        $('#idArchivo_mod_observacion').val(data['idArchivo']);
                        $('#idTipoProceso_mod_observacion').val(data['idTipoProceso']);
                        $('#idSubTipoProceso_mod_observacion').val(data['idSubTipoProceso']);
                        $('#idDocumento_mod_observacion').val(data['idDocumento']);
                        
                        if ( data['tipo_observacion'] == 1){
                        $("#mod_tipo_observacion").attr("checked","checked");
                        }
                        
                        
                    }
                
                });
                
                
        }
            
        function agregar_observaciones_archivo(idDireccion,idContrato){
            $("#idDireccion_Archivo").val(idDireccion);
            $("#idContrato_Archivo").val(idContrato);
            
        }
        
        function modificar_bloque(id)
            {
                $("#idBloqueObra").val(id);
                $("#modal-cambiar-bloque").modal('hide');
                //$("#modal-modificar-cat").modal('hide');
                
                $.ajax({
                    url: "<?php echo site_url('archivo/datos_bloque'); ?>/" + id,
                    dataType: 'json',
                    success: function (data, textStatus, jqXHR) {
                        
                       $("#nomBloque").val(data['Nombre']);
                       
                    }
                });
            }
            
        function checar_estado_trabajo(idRAD){
            //alert("Checar")
            
                $.ajax({
                    //id= idProceso
                    url: "<?php echo site_url('archivo/comprobar_estado_trabajo'); ?>/" + idRAD,
                    dataType: 'json',
                    success: function (data, textStatus, jqXHR) {
                      //$("#estado-trabajo-"+id).html(data['idUsuario_Trabajando']);  
                      if( data['idUsuario_Trabajando'] != 0){
                            //alert('idUsuario_Trabajando dif 0')
                            if(data['idUsuario_Trabajando'] == usuario){
                                uf_modificar_estado_trabajo(elemento, id, idArchivo, preregistro, recibir, revisar, foliar, validar, digitalizar, editar);
                                //alert('idUsuario_Trabajando == usuario')
                            } else {
                                //alert('idUsuario_Trabajando dif usuario ' +usuario)
                                
                                $("#modal-ocupado").modal('show');
                            }
            */                
                            //Si estaba el bloque abierto
                            /*if(tipo==1){
                                $("#bloque-abierto-"+id).css("display", "none")
                                $("#bloque-ocupado-"+id).css("display", "none")
                            }
                      }
                      else {
                          uf_modificar_estado_trabajo(elemento, id, idArchivo, preregistro, recibir, revisar, foliar, validar, digitalizar, editar);
                      }
                      //alert(data['idUsuario_Trabajando'])
                       
                    }
                });
                
                
               
            
           
            
        
            
                
           
           
        }
            
            
        function uf_modificar_estado_trabajo(elemento, id, idArchivo, preregistro, recibir, revisar, foliar, validar, digitalizar, editar){
            var trabajando = 0;
            if (elemento.checked){
                
               
                trabajando =1;
            }
            
            //alert( "#panel-proceso-datos-"+id);
            
            
            
            $.ajax({
                    url: "<?php echo site_url('archivo/estado_trabajo'); ?>/" + id + "/" + trabajando + "/" + idArchivo,
                    dataType: 'json',
                    success: function (data, textStatus, jqXHR) {
                        
                      //$("#panel-proceso-datos-"+id).hide();
                       
                    }
                });
           
            
            if(trabajando == 0){
                $("#panel-body-"+id).hide();
                
                $("#ubicaciones-tabla-"+id).css("display", "none" );
                
                $("#info-oculto-"+id).css("display", "none");
                $("#div-agregar-documentos-"+id).css("display", "none" );
                $("#div-accion-"+id).css("display", "none" );
                
                
                
                //$("#ver_ubi").attr("disabled", "disabled" );
                
                //$("#panel-proceso-datos-"+id).children().attr("disabled","disabled");
            }
            if(trabajando == 1){
                $("#panel-body-"+id).show();
      
                $("#ubicaciones-tabla-"+id).css("display", "block" );
                
                $("#info-oculto-"+id).css("display", "block" );
                $("#div-agregar-documentos-"+id).css("display", "block" );
                $("#div-accion-"+id).css("display", "block" );
                
                if(validar == 1 || digitalizar ==1){
                    
                    $("#div-accion-"+id).css("display", "block" );
                }
                
                if(foliar == 1){
                    
                    $("#div-accion-"+id).css("display", "block" );
                    $("div.input-folio  > input").removeAttr("disabled");
                }
                
                if(preregistro == 1){
                    $("#ubicaciones-tabla-"+id).css("display", "none" );
                    $("#div-accion-"+id).css("display", "none" );
                   
                    $("#btn-agregar-documentos").removeAttr("disabled");
                    $("div.btn-documentos  > a").removeAttr("disabled");
                }
                if(recibir == 1 || revisar == 1){
                   
                    $("div.btn-permisos  > a").removeAttr("disabled");
                    $("div.btn-ubicaciones  > a").removeAttr("disabled");
                    $("#ubicaciones-tabla-"+id).css("display", "block" );
                    $("#btn-agregar-ubi").removeAttr("disabled");
                    $("#btn-ubicaciones-libres").removeAttr("disabled");
                    $("div.btn-observaciones  > a").removeAttr("disabled");
                    $("#btn-ver-obs").removeAttr("disabled");
                    $("#div-accion-"+id).css("display", "block" );
                }
                 if (recibir == 0){
                       
                       //btn tabla
                        $("div.btn-permisos  > a").attr("disabled", "disabled");
                        $("div.btn-ubicaciones  > a").attr("disabled", "disabled");
                }
                
                
                
                
                
                
                //$("#ver_ubi").removeAttr("disabled");
                
            }
            
        }
        
        function liberar_estado_trabajo(idProceso, idArchivo, tipo){
            var trabajando = 0;
            //alert("Entro " +tipo)
            $.ajax({
                    url: "<?php echo site_url('archivo/estado_trabajo'); ?>/" + idProceso + "/" + trabajando + "/" + idArchivo,
                    dataType: 'json',
                    success: function (data, textStatus, jqXHR) {
                       //alert("Succes") 
                      
                       
                    }
                });
            //$("#panel-proceso-datos-"+idProceso).hide();
            //
            //
            //Dejar de trabajar con bloque
            if(tipo ==1){
                //alert("tipo=1")
                  $("#bloque-ocupado-"+idProceso).css("display", "none")
                  $("#bloque-abierto-"+idProceso).css("display", "none")


            }
            
            
            
        }
        
        function cargar_noHojas(e, idRelacion, idArchivo){
        //var valor = document.getElementById("texto").value;
          tecla = (document.all) ? e.keyCode : e.which;
          if (tecla!=13){
           
            var hojas = $("#noHojas_doc_"+idRelacion).val();
            
            $.post("<?php echo site_url('archivo/cargar_noHojas'); ?>/" + idRelacion +  "/" + idArchivo +  "/" + hojas, 
                    function() {
                    //$("#noHojas_doc_"+idRelacion).val(data['noHojas']);
                    

                  },
                  'json'
            ) 
            .done(function(data, textStatus, jqXHR) {
                //alert(data.estado)
                $("#noHojas_doc_"+idRelacion).css("border-color", "green");
                 if ( console && console.log ) {
                    console.log( "La solicitud se ha completado correctamente." );
                }
            })
            .fail(function(data, textStatus, jqXHR) {
                
                $.alert({
                    title: 'Alerta!',
                    content: 'Selecciona un tipo de documento!',
                });
                $("#noHojas_doc_"+idRelacion).css("border-color", "red");
                $("#noHojas_doc_"+idRelacion).val("");
                
                if ( console && console.log ) {
                    console.log( "La solicitud a fallado: " +  textStatus);
                }
            })

            

                
                
            
            //$("#caja-noHojas").hide();
            $("#oculta-noHojas-"+idRelacion).html("<b>No Hojas: </b>" + hojas);
            $("#noHojas-"+idRelacion).hide();
            $("#oculta-noHojas-"+idRelacion).show();
            
           
            
            
          }
               
        }
        
        function modificar_noHojas(e, idRelacion, idArchivo, idRAP){
        //var valor = document.getElementById("texto").value;
          tecla = (document.all) ? e.keyCode : e.which;
          if (tecla!=13){
           
            var hojas = $("#noHojas_doc_"+idRAP).val();
            
            $.post("<?php echo site_url('archivo/modificar_noHojas'); ?>/" + idRelacion +  "/" + idArchivo +  "/" + hojas + "/" + idRAP, 
                    function() {
                    //$("#noHojas_doc_"+idRelacion).val(data['noHojas']);
                    

                  },
                  'json'
            ) 
            .done(function(data, textStatus, jqXHR) {
                //alert(data.estado)
                $("#noHojas_doc_"+idRAP).css("border-color", "green");
                 if ( console && console.log ) {
                    console.log( "La solicitud se ha completado correctamente." );
                }
            })
            .fail(function(data, textStatus, jqXHR) {
                
                $.alert({
                    title: 'Alerta!',
                    content: 'Error al modificar!',
                });
                $("#noHojas_doc_"+idRAP).css("border-color", "red");
                $("#noHojas_doc_"+idRAP).val("");
                
                if ( console && console.log ) {
                    console.log( "La solicitud a fallado: " +  textStatus);
                }
            })

            

                
                
            
            //$("#caja-noHojas").hide();
            $("#oculta-noHojas-"+idRelacion).html("<b>No Hojas: </b>" + hojas);
            $("#noHojas-"+idRelacion).hide();
            $("#oculta-noHojas-"+idRelacion).show();
            
           
            
            
          }
               
        }
        
        function cargar_noHojas_preregistro(id, idArchivo){
        //var valor = document.getElementById("texto").value;
            var hojas = $("#noHojas_doc_"+id).val();
            //alert($("#noHojas_doc_"+idRelacion).val());
            //var noHojas = document.getElementById("noHojas_doc").value;
            $.ajax({
                    
                    url: "<?php echo site_url('archivo/cargar_noHojas_preregistro'); ?>/" + id +  "/"  + hojas,
                    dataType: 'json',
                    success: function (data, textStatus, jqXHR) {
                         //$("#noHojas_doc_"+id).val(data['noHojas']);
                         
                    }
                    
                });
                
                
            
            //$("#caja-noHojas").hide();
            $("#oculta-noHojas-"+id).html("<b>No Hojas: </b>" + hojas);
            $("#noHojas-"+id).hide();
            $("#oculta-noHojas-"+id).show();
                
               
        }

        function validar(e) {
          tecla = (document.all) ? e.keyCode : e.which;
          return (tecla!=13)
          
        }
        
        function agregar_observaciones_documento(){
            
            
            var marcado =0
            $("#observacion_bloque").modal('hide');
            if ($("#tipo_observacion").prop("checked")){
                marcado = 1
            }
            
                $.ajax({
                    data: {
                        "Motivo" :$("#motivo_observacion").val(), 
                        "idSubTipoProceso_observacion" : $("#idSubTipoProceso_observacion").val(),
                        "idArchivo_observacion" : $("#idArchivo_observacion").val(),
                        "idTipoProceso_observacion" : $("#idTipoProceso_observacion").val(),
                        "idDocumento_observacion" : $("#idDocumento_observacion").val(),
                        "idContrato_observacion" : $("#idContrato_observacion").val(),
                        "idDireccion_observacion" : $("#idDireccion_observacion").val(),
                        "tipo_usuario" : $("#tipo_usuario_observacion").val(),
                        "tipo_observacion" : marcado,
                        "direccion_respuesta" : $("#dir_respuesta_observacion").val(),
                        "usuario_preregistro" : $("#usuario_preregistro").val(),
                        
                        
                    },
                    type: "POST",
                    dataType: "json",
                    url: "<?php echo site_url('archivo/agregar_observaciones_documento/'); ?>",
                })
                 .done(function( data, textStatus, jqXHR ) {
                     if ( console && console.log ) {
                         console.log( "La solicitud se ha completado correctamente." );
                     }
                 })
                 .fail(function( jqXHR, textStatus, errorThrown ) {
                     if ( console && console.log ) {
                         console.log( "La solicitud a fallado: " +  textStatus);
                     }
                });
            $("#motivo_observacion").val("");
            $("#tipo_observacion").prop("checked", false);
        }
        
        
        function responder_observacion_documento(id){
            $("#observaciones_bloque").modal("hide");
            $.ajax({
                   
                    type: "POST",
                    dataType: "json",
                    url: "<?php echo site_url('observaciones/datos_observacion_documento_por_id/');  ?>/" + id,
                    success: function(data, textStatus, jqXHR){
                        alert(data["Motivo"])
                         $("#Motivo").html(data["Motivo"]);
                         $("#Respuesta").val(data["Respuesta"]);
                         $("#idCatalogo_observacion").val(data["id"]);
                    }
                });
                
                
                 
                
        }*/
        
        /*
        function modificar_observaciones_documento(){
            
            
            var marcado =0
            $("#observacion_bloque").modal('hide');
            if ($("#mod_tipo_observacion").prop("checked")){
                marcado = 1
            }
            var id = $("#idCatalogo_mod_observacion").val()
            
                $.ajax({
                    data: {
                        "Motivo" :$("#mod_motivo_observacion").val(), 
                        "tipo_observacion" : marcado,
                    
                    },
                    type: "POST",
                    dataType: "json",
                    url: "<?php echo site_url('archivo/modificar_observaciones_documento/');  ?>/" + id,
                })
                 .done(function( data, textStatus, jqXHR ) {
                     if ( console && console.log ) {
                         console.log( "La solicitud se ha completado correctamente." );
                     }
                 })
                 .fail(function( jqXHR, textStatus, errorThrown ) {
                     if ( console && console.log ) {
                         console.log( "La solicitud a fallado: " +  textStatus);
                     }
                });
                
            $("#mod-observacion-documento").modal('hide');
            //ver_observaciones_documento(
              //          $('#idArchivo_mod_observacion').val(),
              //          $('#idTipoProceso_mod_observacion').val(),
             //           $('#idSubTipoProceso_mod_observacion').val(),
             //           $('#idDocumento_mod_observacion').val(),
             //           $('#preregistro_mod_observacion').val()
              //          )
            
            //$("#motivo_observacion").val("");
            //
            //$("#tipo_observacion").prop("checked", false);
        }
        
        function agregar_ubicacion_fisica(idArchivo){
            
            
            var ubicacion = $("#idUbicacionFisica").val()
            //alert(ubicacion)
            var proceso = $("#idTipoProceso_ubicacion").val()
            //alert("Proceso " +proceso)
            $("#modal-agregar-ubicacion-fisica").modal('hide');
                $.ajax({
                    beforeSend: function(){
                        $("#tabla_ubi_actualizada_"+proceso).html("Cargando...")

                    },
                    data: {
                        "idUbicacionFisica" :ubicacion, 
                        "idArchivo" : idArchivo,
                        "idTipoProceso" : proceso,
                        
                    },
                    type: "POST",
                    url: "<?php echo site_url('archivo/agregar_ubicacion_fisica/'); ?>",
                     success: function (data, textStatus, jqXHR) {
                        //alert (data)
                        if (data ==1){
                            dibujar_tabla_ubicaciones(idArchivo, proceso)
                            $("#idUbicacionFisica").val("") 
                            $("#nomubicacionfisica").html("")
                            $("#idTipoProceso_ubicacion").val("")
                        } else
                            $.alert({
                                title: 'Error!',
                                content: 'No se pudo agregar la ubicacion<br> Intentalo nuevamente!',
                            });
                         
                     },
                     error: function(jqXHR, estado, error){
                        console.log(estado)
                        console.log(error)
                     }
                }) ;
                
                
        }
        
        function dibujar_tabla_ubicaciones(idArchivo, proceso){
        
            $.ajax({
                    
                    type: "POST",
                    
                    url: "<?php echo site_url('archivo/ver_ubicaciones_proceso'); ?>/" +idArchivo+"/"+proceso,
                    success: function (data) {
                        
                         //alert("dib" +data["tabla"])
                         $("#tabla_ubi_actualizada_"+proceso).html(data["tabla"]); 
                         $("#tabla_ubi_principal_"+proceso).hide();
                         $("#tabla_ubi_actualizada_"+proceso).show();
                         
                    }
                }) ;
               
        }
        
        
        function cargar_estimaciones(e, idRel, idArchivo, preregistro){
        
            tecla = (document.all) ? e.keyCode : e.which;
            if (tecla!=13){
                $("#tipo_documento"+idRel).val(4);


                uf_recibir_tipo_documento(idRel, idArchivo, preregistro)


                var estimaciones = $("#noEstimaciones").val(); 
                    $.ajax({
                        beforeSend: function(){

                            $("#div_estimaciones_"+idRel).html("Cargando...")

                        },
                        type: "POST",

                        url: "<?php echo site_url('archivo/cargar_estimaciones'); ?>/" + idRel+"/"+idArchivo+"/"+estimaciones,
                        success: function (data) {

                            dibujar_tabla_estimaciones(idRel, idArchivo)
                            //$("#div_estimaciones_"+idRel).html(data["estimaciones"]); 
                             //$('#div_estimaciones').html("Hola");

                        }
                    }) ;
            }

          
        }

        function dibujar_tabla_estimaciones(idRel, idArchivo){
            $.ajax({
                    
                    type: "POST",
                    
                    url: "<?php echo site_url('archivo/ver_estimaciones_relacion'); ?>/" +idArchivo+"/"+idRel,
                    success: function (data) {
                        
                         //alert//("dib" +data["estimaciones"])
                         $("#noEstimaciones").css("border-color", "green")
                         $("#div_estimaciones_"+idRel).html(data["estimaciones"]); 
                        
                         
                    }
                }) ;
        }
        
        function eliminar_observacion_documento(id){
            //alert("OK" +idRel);
            //var idRel = idRel
                $.confirm({
                title: 'Eliminar Registro',
                content: '¿Deseas Eliminar el Registro?',
                buttons: {
                    Si: function () {
                        $.ajax({
                            
                            type: "POST",
                            url: "<?php echo site_url('archivo/eliminar_observacion_documento');?>/"+id,
                             success: function (data, textStatus, jqXHR) {
                                    //alert("Eliminado")
                                    $("#observaciones_bloque").modal('hide');
                                    
                                 
                             },
                             error: function(jqXHR, estado, error){
                                console.log(estado)
                                console.log(error)
                             }
                        }) ;
                    },
                    No: function () {
                        //$.alert('Canceled!');
                    }
                    
                }});
            
        }


        function eliminar_estimacion(Numero_Estimacion, idRel, idArchivo){
            //alert("OK" +idRel);
            //var idRel = idRel
                
                $.confirm({
                title: 'Eliminar Registro',
                content: '¿Deseas Eliminar el Registro?',
                buttons: {
                    Si: function () {
                        $.ajax({
                            
                            type: "POST",
                            url: "<?php echo site_url('archivo/eliminar_estimacion');?>/"+Numero_Estimacion  + "/" +idRel,
                             success: function (data, textStatus, jqXHR) {
                                    //alert(data)
                                    if (data == 0){
                                        $.alert({
                                            title: 'Error!',
                                            content: 'No se puede eliminar la estimacion! (Contiene documentos)',
                                        });
                                        
                                    } else {
                                    dibujar_tabla_estimaciones(idRel, idArchivo)
                                    }
                                 
                             },
                             error: function(jqXHR, estado, error){
                                console.log(estado)
                                console.log(error)
                                //alert ("No se pudo eliminar ya que tienes documentos")
                             }
                        }) ;
                    },
                    No: function () {
                        //$.alert('Canceled!');
                    }
                    
                }});
            
        }
        function estado_ot(idArchivo){
            
            //trabajando=0
            //if (elemento.checked){
               // trabajando=1
            //}
            
            
            $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('archivo/estado_ot'); ?>/"  + idArchivo,
                    success: function (data, textStatus, jqXHR) {
                        console.log(data)
                        
                        if (data == 1){
                            trabajar_ot(idArchivo);
                            return 1;
                        } else {
                            return -1;
                        }
                       
                    }
                });
        }
        
        function trabajar_ot(idArchivo){
            
            //trabajando=0
            //if (elemento.checked){
               // trabajando=1
            //}
            
            
            $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('archivo/trabajar_ot'); ?>/"  + idArchivo,
                    success: function (data, textStatus, jqXHR) {
                        console.log(data)
                        
                        if (data == 1){
                            $("#trabajar_ot").html("<span class='glyphicon glyphicon-folder-open'></span> Trabajando con OT");
                            console.log("Exito "+data)
                        }else {
                            console.log("Error "+data)
                        }
                       
                    }
                });
        }
        
        function uf_enviar_concentracion(){
            $(".enlace-succes").css("display", "none")
        }
        
        //cargar_noHojas_estimaciones
 
        function cargar_noHojas_estimaciones(id){
        //var valor = document.getElementById("texto").value;
            var hojas = $("#noHojas_est_"+id).val();
            //alert($("#noHojas_doc_"+idRelacion).val());
            //var noHojas = document.getElementById("noHojas_doc").value;
            
            $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('archivo/editar_estimacion_hojas'); ?>/" + id +  "/"  + hojas,
                    success: function (data, textStatus, jqXHR) {
                       $("#noHojas_est_"+id).css("border-color", "green")  
                          
                    }
                     
                });
                
                $("#div_noHojas_est_"+id).hide();
                $("#div_noHojas_est_aux_"+id).html("<b>No Hojas: </b>" + hojas)
                $("#div_noHojas_est_aux_"+id).show()
          
                
        }
        
        
        function activar_bloque_observacion(){
             $("#observaciones_bloque").modal("show");
        
        
        }
        
        function responder_observaciones(){
            $("#modal-ver-observacion").modal("hide");    
             $.ajax({
                    
                    data: {
                        "id" : $("#idCatalogo_observacion").val(), 
                        "Respuesta" : $("#Respuesta").val(),
                        
                        
                    },
                    type: "POST",
                    url: "<?php echo site_url('observaciones/responder_observacion_documento/'); ?>",
                     success: function (data, textStatus, jqXHR) {
                        
                        $("#Respuesta").val("")
                         
                     },
                     error: function(jqXHR, estado, error){
                        console.log(estado)
                        console.log(error)
                     }
                }) ;
            
        }
        
        function marcar_visto(id){
            $("#visto"+id).css("display", "none");    
             $.ajax({
                    
                    data: {
                        "id" : $("#idCatalogo_observacion").val(), 
                        
                        
                        
                    },
                    type: "POST",
                    url: "<?php echo site_url('observaciones/marcar_visto_observacion_documento/'); ?>",
                     success: function (data, textStatus, jqXHR) {
                        
                      
                         
                     },
                     error: function(jqXHR, estado, error){
                        console.log(estado)
                        console.log(error)
                     }
                }) ;
            
        }
        
        function uf_agregar_observaciones_estimacion(idEstimacion, direccion_responsable_documento, direcion_preregistro) {
               $("#idEstimacion_observacion").val(idEstimacion);
               $("#idDireccion_respuesta").val(direccion_responsable_documento);
               $("#direccion_realizo_observacion").val(direcion_preregistro);
               
               
               
               
               
        }
        
        function ver_observaciones_estimacion(idArchivo,idEstimacion, preregistro){
                       alert
                    if (preregistro == 0){
                        $.ajax({
                            type:"POST",
                            url:"<?php echo site_url('archivo/ver_observaciones_documento_estimacion'); ?>/" + idArchivo+"/"+idEstimacion,
                               success: function(data) {
                                $('#idObservacionesEstimaciones').html(data["historial"]); 
                               }
                            });
                    } else {
                    
                        $.ajax({
                            type:"POST",
                            url:"<?php echo site_url('archivo/ver_observaciones_estimacion_direccion'); ?>/" +idEstimacion,
                               success: function(data) {
                                $('#idObservacionesEstimaciones').html(data["historial"]); 
                               }
                            });
                    
                    }
        }
        
        function modificar_observacion_estimacion(id){
                //$("#mod-observacion-documento").modal('hide');
                $("#observaciones_estimaciones").modal('hide');
                $('#idCatalogo_mod_observacion_estimacion').val(id);
             */  
                
                /*$.ajax({
                    url: "<?php echo site_url('observaciones/datos_observacion_estimacion_por_id') ?>/" + id,
                    dataType: 'json',
                    success: function (data, textStatus, jqXHR) {
                        //alert (data['motivo'])
                        //alert (data['tipo_observacion'])
                        $("#mod_motivo_observacion_estimacion").html(data['Motivo']);
                       
                        
                        if ( data['tipo_observacion'] == 1){
                        $("#mod_tipo_observacion_estimacion").attr("checked","checked");
                        }
                        
                        
                    }
                
                });
                
                
        }
        
        function modificar_observaciones_estimacion(){
            
            
            var marcado =0
            $("#mod-observacion-estimacion").modal('hide');
            if ($("#mod_tipo_observacion_estimacion").prop("checked")){
                marcado = 1
            }
            var id = $("#idCatalogo_mod_observacion_estimacion").val()
            
                $.ajax({
                    data: {
                        "Motivo" :$("#mod_motivo_observacion_estimacion").val(), 
                        "tipo_observacion" : marcado,
                    
                    },
                    type: "POST",
                    dataType: "json",
                    url: "<?php echo site_url('archivo/modificar_observaciones_estimacion/');  ?>/" + id,
                })
                 .done(function( data, textStatus, jqXHR ) {
                     if ( console && console.log ) {
                         console.log( "La solicitud se ha completado correctamente." );
                     }
                 })
                 .fail(function( jqXHR, textStatus, errorThrown ) {
                     if ( console && console.log ) {
                         console.log( "La solicitud a fallado: " +  textStatus);
                     }
                });
                
            $("#mod-observacion-estimacion").modal('hide');
            //ver_observaciones_documento(
              //          $('#idArchivo_mod_observacion').val(),
              //          $('#idTipoProceso_mod_observacion').val(),
             //           $('#idSubTipoProceso_mod_observacion').val(),
             //           $('#idDocumento_mod_observacion').val(),
             //           $('#preregistro_mod_observacion').val()
              //          )
            
            //$("#motivo_observacion").val("");
            //
            //$("#tipo_observacion").prop("checked", false);
        }
        
        
        function eliminar_observacion_estimacion(id){
            //alert("OK" +idRel);
            //var idRel = idRel
                $.confirm({
                title: 'Eliminar Registro',
                content: '¿Deseas Eliminar el Registro?',
                buttons: {
                    Si: function () {
                        $.ajax({
                            
                            type: "POST",
                            url: "<?php echo site_url('archivo/eliminar_observacion_estimacion');?>/"+id,
                             success: function (data, textStatus, jqXHR) {
                                    //alert("Eliminado")
                                    $("#observaciones_estimaciones").modal('hide');
                                    
                                 
                             },
                             error: function(jqXHR, estado, error){
                                console.log(estado)
                                console.log(error)
                             }
                        }) ;
                    },
                    No: function () {
                        //$.alert('Canceled!');
                    }
                    
                }});
            
        }
        
       
        
        
        
        


       
        
    
        
        </script>         
</body>
*/
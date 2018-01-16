$(document).ready(function(){  
            
    var dataTable = $('#t_listado').DataTable({  
           "processing":true,  
           "serverSide":true, 
           "responsive":true,
           "scrollX": false,
           
           "order":[],  
           "ajax":{  
                url: url +  'archivo/fetch_archivos',  
                type:"POST" 
           }, 
           "language": {
                "url": url + 'assets/dataTables.spanish.lang',
            }, 

           "columnDefs":[  
                {  
                    "targets":[0, 14, 16], 
                    "orderable":false,  
                },  
           ]
      });  
 }); 
          




/*function valida_Datos(){
    
    document.getElementById("idGuardar").disabled=true;
    return true;
}*/
            
function ver_historico_archivo(idArchivo){
    
    $.ajax({
        type:"POST",
        url: url + 'archivo/historico_archivo/' + idArchivo,
        success: function(data) {
                $('#idHistorial_estatus').html(data["historial"]); 
               }
        });   
    
}
            
/*function filtrar_archivos(tipofiltro){

    if (tipofiltro==1){
        var filtro = $("#slc_Estatus").val();
    }else{
        filtro = $("#slc_Grupos").val();
    }



    $.ajax({
        beforeSend: function(){
           $('#tabla-principal').hide();
           $('#filtro-tabla').html("Cargando...");
           $('#filtro-tabla').show();


       },
        type:"POST",
        url: url + 'archivo/filtrar_archivos/' + filtro + "/" + tipofiltro,

        success: function(data) {
                   
            $('#filtro-tabla').html(data["tabla"]);
            $('#filtro-tabla').show();
             
            $('#t_listado').dataTable({
                'bProcessing': true,
                //'sScrollY': '400px',                    

                'sPaginationType': 'bs_normal',
                'sDom': '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>',
                'iDisplayLength': 10,
                'aaSorting': [[1, 'desc']],
                'aLengthMenu': [[10, 50, 100, 200, -1], [10, 50, 100, 200, "Todo"]],
                'bDeferRender': true,
                'bAutoWidth': false,
                'bScrollCollapse': false,                    
                'oLanguage': {
                    'sProcessing': '<img src=\"./images/ajax-loader.gif\"/> Procesando...',
                    'sLengthMenu': 'Mostrar _MENU_ archivos',
                    'sZeroRecords': 'Buscando Archivos...',
                    'sInfo': 'Mostrando desde _START_ hasta _END_ de _TOTAL_ archivos',
                    'sInfoEmpty': 'Mostrando desde 0 hasta 0 de 0 archivos',
                    'sInfoFiltered': '(filtrado de _MAX_ archivos en total)',
                    'sInfoPostFix': '',
                    'sSearch': 'Buscar:',
                    'sUrl': '',
                    'oPaginate': {
                        'sFirst': '&nbsp;Primero&nbsp;',
                        'sPrevious': '&nbsp;Anterior&nbsp;',
                        'sNext': '&nbsp;Siguiente&nbsp;',
                        'sLast': '&nbsp;&Uacute;ltimo&nbsp;'
                    }
                },
                'aoColumns': [
                    {'sClass': 'small'},
                    {'sClass': 'small'},
                    {'sClass': 'small'},
                    {'sClass': 'small'},
                    {'sClass': 'small'},
                    {'sClass': 'small'},
                    {'sClass': 'small'},
                    {'sClass': 'small'},
                    {'sClass': 'small'},
                    {'sClass': 'small'},
                    {'sClass': 'small'},
                    {'sClass': 'small'},
                    {'sClass': 'small'},
                    {'sClass': 'small'},
                    {'sClass': 'small'},
                    
                    {'sClass': 'small'}
                  
                ],
            });

            if(filtro == 0){
                $('#filtro-tabla').hide();
                $('#tabla-principal').show();
            }
                 

        }
    });
    
} */
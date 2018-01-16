<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title><?php
            if (isset($title))
                echo $title;
            ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">        
        <?php
        if (isset($meta))
            echo meta($meta);
        ?>  

        
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs-3.3.7/jq-2.2.4/dt-1.10.15/sc-1.4.2/datatables.min.css"/>
        <link href="<?php echo site_url(); ?>css/jquery.vegas.min.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo site_url(); ?>css/font-awesome.min.css" type="text/css" rel="stylesheet" />
        
       
        <!-- Fav and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo site_url(); ?>img/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo site_url(); ?>img/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo site_url(); ?>img/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="<?php echo site_url(); ?>img/apple-touch-icon-57-precomposed.png">
        <link rel="shortcut icon" href="<?php echo site_url(); ?>img/favicon.png">
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs-3.3.7/jq-2.2.4/dt-1.10.15/sc-1.4.2/datatables.min.js"></script> <script type="text/javascript" src="<?php echo site_url(); ?>js/dataTables.bootstrap.js"></script>              
        <script type="text/javascript" src="<?php echo site_url(); ?>js/scripts.js"></script>
        <script type="text/javascript" src="<?php echo site_url(); ?>js/jquery.vegas.min.js"></script>
        
 
       
        <script type="text/javascript">
            var oTable;
            var sUrl_source_ajax = '<?php echo site_url('gestiona_documentos/listado'); ?>';
			
            $(function() {
               
                $.vegas({
                    src: '<?php echo site_url(); ?>images/fondoESCUDO.png',
                    fade: 2000,
                    valign: 'top', // top, center, bottom or %
                    align: 'right' // left, center, right or %
                });
                
				
		oTable = $('#tabla_scroll').dataTable({
                    //ajax: sUrl_source_ajax,                    
                    scrollX: true,
                    deferRender: true,
                    autoWidth: true,
                    order: [],
                    columnDefs: [ 
                        {"targets": [0], 'searchable': false, "orderable": false, 'className': 'text-center small'},
                        {"targets": [1], 'className': 'small sinwarp'},
                        {"targets": [2], 'className': 'small sinwarp'},
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
                
            });     
         
        function uf_modificar_seccion(id) {

                $("#idCatalogo").val(id);
               
                $.ajax({
                    url: "<?php echo site_url('seccion/datos_seccion') ?>/" + id,
                    dataType: 'json',
                    success: function (data, textStatus, jqXHR) {
			$("#Nombre_mod").val(data['Nombre']);
                        $("#Codigo_mod").val(data['Codigo']);
                                   
                        
                    }
                });
            } 
         
         
         
    
         
         
        </script>
        <style>
            .sinwarp {
                white-space: nowrap;
            }
            container-fluid {
                padding-right: 10px;
                padding-left: 10px;
            }
            .r_obra {
                cursor: pointer;
            }
            .r_contratista {
                cursor: pointer;
            }
            .custom-select{

                width: 488px;
                height: 34px;
                padding: 6px 12px;
                font-size: 14px;
                line-height: 1.42857143;
                color: #555;
                background-color: #fff;
                background-image: none;
                border: 1px solid #ccc;
                border-radius: 4px;
                -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
                box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
                -webkit-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
                transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
            } 
            .margin-boton{
                margin-bottom: 30px;
            }
        </style>
        
    </head>
    <body>
        
        
        <!-- Menu Superior -->
        <?php if (isset($aWidgets["widget_menu"])) echo $aWidgets["widget_menu"]; ?>
       
        
        <!-- contenidos -->
        <div class="container-fluid">
            <div class="row">
                <!-- breadcrumb -->
                
                <div class="col-md-12 column">
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url("principal/"); ?>">Principal</a></li>
                        <li class="active">Secciones</li>
                    </ol>
                </div>
                
                <!-- breadcrumb -->
            </div>
            
            <?php if ($error != ''): ?>
                <div class="col-sm-12">
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Error!</strong> <?= $error ?>
                    </div>
                </div>
                
                <?php endif; ?>
            
            <div class="row">
                <div class="col-md-12">
                    <h3>
                        <center> Secciones </center>
                    </h3>
                </div>
		
                
                <div class="col-md-12">
                        <a href="#modal-agregar-cat" class="btn btn-primary margin-boton" role="button" data-toggle="modal" ><span class="glyphicon glyphicon-plus"></span> Nueva Sección</a>
                </div>
                
                
                
                <div class="col-md-12">                    
                    <table class="table table-striped table-bordered table-hover small" id="tabla_scroll">
                        <thead>
                            <tr>
                                <th class="col-md-1">
                                   Acción
                                </th>
                                <th>
                                   Nombre
                                </th>
                                <th>
                                   Código
                                </th>
                                

                            </tr>
                        </thead>
                        <tbody>
                                <?php
                                    if (isset($qListado)) {
                                        if ($qListado->num_rows() > 0) {
                                            foreach ($qListado->result() as $rSolicitud) {
                                                ?>
                                                <tr>
                                                    <td>
                                                        <a href="#" class="btn btn-success btn-xs" title=""  data-toggle="modal" data-target="#modal-modificar-cat" role="button" onclick="uf_modificar_seccion(<?php echo $rSolicitud->id; ?>)"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;
                                                        <a class="btn btn-danger btn-xs del_documento" title="Eliminar Solicitud" onclick="return confirm('¿Confirma eliminar Registro?');" target="_self" href="<?php echo site_url('seccion/eliminar_cat/' . $rSolicitud->id); ?>" ><span class="glyphicon glyphicon-remove" ></span></a>
                                                    </td>
                                                    <td>
                                                        <?php echo $rSolicitud->Nombre; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $rSolicitud->Codigo; ?>
                                                    </td>


                                                </tr>
                                                <?php
                                            }
                                        }
                                    }
                                ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> 
		
		
          <!-- Dialogo Nuevo Bloque -->
        <div class="modal fade" id="modal-agregar-cat" role="dialog" aria-labelledby="modal-agregar-cat_myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            ×
                        </button>
                        <h4 class="modal-titlsamplee" id="modal-nuevo_documentomyModalLabel">Grupo - Nuevo</h4>
                    </div>
                    <form action="<?php echo site_url("seccion/agregar_cat"); ?>" method="post" name="forma1" target="_self" id="forma1" role="form" class="form-horizontal" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            
                           
                            
                            <div class="form-group">
                                <label for="nombre" class="col-sm-3 control-label">Nombre </label>	
                                <div class="col-sm-7"> 
                                    <input type="text" name="Nombre" id="Nombre" required value="" class="form-control" >
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="nombre" class="col-sm-3 control-label">Código </label>	
                                <div class="col-sm-7"> 
                                    <input type="text" name="Codigo" id="Codigo" required value="" class="form-control" >
                                </div>
                            </div>
                            
                            
                            
                            
                        </div>
                        <div class="modal-footer">
                            
                            <button type="submit" class="btn btn-success">
                                Guardar
                            </button>						
                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                Cancelar
                            </button>						
                        </div>
                    </form>                    
                </div>
            </div>
        </div>

 
          
          
          <!-- Dialogo Modificar Bloque -->
        <div class="modal fade" id="modal-modificar-cat" role="dialog" aria-labelledby="modal-modificar-cat_myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            ×
                        </button>
                        <h4 class="modal-titlsamplee" id="modal-nuevo_documentomyModalLabel">Modificar Sección</h4>
                    </div>
                    <form action="<?php echo site_url("seccion/modificar_cat"); ?>" method="post" name="forma1" target="_self" id="forma1" role="form" class="form-horizontal" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            
                            
                            <div class="form-group">
                                        <label for="Nombre_mod" class="col-sm-3 control-label">Nombre</label>	
                                         <div class="col-sm-7"> 
                                            <input type="text" name="Nombre_mod" id="Nombre_mod" required value="" class="form-control" >
                                         </div>
                            </div>
                            
                            <div class="form-group">
                                        <label for="Codigo_mod" class="col-sm-3 control-label">Código</label>	
                                         <div class="col-sm-7"> 
                                            <input type="text" name="Codigo_mod" id="Codigo_mod" required value="" class="form-control" >
                                         </div>
                            </div>
                            
                            
                            
                            
                                                                     
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="idCatalogo" id="idCatalogo" required value="0" class="form-control" >
                            
                            <button type="submit" class="btn btn-success">
                                Guardar
                            </button>						
                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                Cancelar
                            </button>						
                        </div>
                    </form>                    
                </div>
            </div>
        </div> 		
		
		
         
        
    </body>
</html>


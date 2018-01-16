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
 
        <!--link rel="stylesheet/less" href="<?php echo site_url(); ?>less/bootstrap.less" type="text/css" /-->
        <!--link rel="stylesheet/less" href="<?php echo site_url(); ?>less/responsive.less" type="text/css" /-->
        <!--script src="<?php echo site_url(); ?>js/less-1.3.3.min.js"></script-->
        <!--append '#!watch' to the browser URL, then refresh the page. -->
 
        <link href="<?php echo site_url(); ?>css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo site_url(); ?>css/style.css" rel="stylesheet">
        <link href="<?php echo site_url(); ?>css/principal.css" rel="stylesheet">
        <link href="<?php echo site_url(); ?>css/dataTables.bootstrap.css" rel="stylesheet">
        <link href="<?php echo site_url(); ?>css/jquery.vegas.min.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo site_url(); ?>css/font-awesome.min.css" type="text/css" rel="stylesheet" />
         
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="<?php echo site_url(); ?>js/html5shiv.js"></script>
        <![endif]-->
 
        <!-- Fav and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo site_url(); ?>img/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo site_url(); ?>img/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo site_url(); ?>img/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="<?php echo site_url(); ?>img/apple-touch-icon-57-precomposed.png">
        <link rel="shortcut icon" href="<?php echo site_url(); ?>img/favicon.png">
 
        <script type="text/javascript" src="<?php echo site_url(); ?>js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo site_url(); ?>js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo site_url(); ?>js/jquery.dataTables.js"></script>
        <script type="text/javascript" src="<?php echo site_url(); ?>js/dataTables.tableTools.js"></script>              
        <script type="text/javascript" src="<?php echo site_url(); ?>js/dataTables.bootstrap.js"></script>              
        <script type="text/javascript" src="<?php echo site_url(); ?>js/scripts.js"></script>
        <script type="text/javascript" src="<?php echo site_url(); ?>js/jquery.vegas.min.js"></script>
 
        <script type="text/javascript">
            var oTable;
            var sUrl_source_ajax = '<?php echo site_url('docuentos/listado'); ?>';
             
            $(function() {
                
                $.vegas({
                    src: '<?php echo site_url(); ?>images/fondoESCUDO.png',
                    fade: 2000,
                    valign: 'top', // top, center, bottom or %
                    align: 'right' // left, center, right or %
                });
                 
                 
        oTable = $('#tabla_scroll').dataTable({
                    //ajax: sUrl_source_ajax,                    
                    scrollX: false,
                    deferRender: true,
                    autoWidth: true,
                    order: [],
                    columnDefs: [ 
                        {"targets": [0], 'searchable': false, "orderable": false, 'className': 'text-center small'},
                        {"targets": [1], 'className': 'small sinwarp'},
                        //{"targets": [1], 'className': 'small sinwarp'},
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
                $('#demo').before( oTableTools.dom.container );
                 
            });  
            
          
        
        function uf_modificar_cat(id) {
 
                $("#idCatalogo").val(id);
                
               
                $.ajax({
                    url: "<?php echo site_url('areas_ubicacion/datos_areas') ?>/" + id,
                    dataType: 'json',
                    success: function (data, textStatus, jqXHR) {
                        $("#Nombre_mod").val(data['Nombre']);
                        $("#deFila_mod").val(data['deFila']);
                        $("#hastaFila_mod").val(data['hastaFila']);  
                         
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
            
            margin_boton {
                
                margin-bottom: 30px;
            }
            
            
        </style>
    </head>
    <body>
        <!-- Menu Superior -->
         <?php if (isset($aWidgets["widget_menu"])) echo $aWidgets["widget_menu"]; ?>
     
         
         
        <!-- Barra Inferior -->
        <nav class="navbar navbar-inverse navbar-fixed-bottom" role="navigation" style="min-height: 28px !important;">
            <div class="navbar-header">
                &nbsp;
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">  
                    <ol class="breadcrumb bottomMenu" style="display: none;">
                        <li><a href="<?php echo site_url("principal/"); ?>">Principal</a></li>
                        <li class="active">Área de ubicación</li>
                    </ol>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <p class="navbar-text">Usuario: <?php echo $usuario; ?></p>                
                </ul>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row clearfix">
                <!-- breadcrumb -->
                 
                <div class="col-md-12 column">
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url("principal/"); ?>">Principal</a></li>
                        <li class="active">Área de ubicación</li>
                    </ol>
                </div>
                 
                <!-- breadcrumb -->
            </div>
            <div class="row clearfix">
                <div class="col-md-12 column">
                    <h3>
                        <?php //echo $Titulo; ?>
                    </h3>
                </div>
         
                <div class="col-md-12 column">
                        <a href="#modal-agregar-cat" class="btn btn-primary margin_boton" role="button" data-toggle="modal" ><span class="glyphicon glyphicon-plus"></span>Nueva Área de ubicación</a>
                </div>
                 
                <div class="col-md-12 column">                    
                    <table class="table table-striped table-bordered table-hover small" id="tabla_scroll">
                        <thead>
                            <tr>
                                <th class="col-sm-1">
                                    Acción
                                </th>
                                <th class="col-sm-3">
                                   Nombre
                                </th>
                               
                                 <th class="col-sm-3">
                                   de Fila
                                </th>
                                 
                                 <th class="col-sm-3">
                                   hasta Fila
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
                                                                    <a href="#" class="btn btn-xs btn-success" title=""  data-toggle="modal" data-target="#modal-modificar-cat" role="button" onclick="uf_modificar_cat(<?php echo $rSolicitud->id; ?>)"><i class="glyphicon glyphicon-pencil"></i></a>&nbsp;
                                                                    <a class="btn btn-danger btn-xs del_subdocumento" href="<?php echo site_url("areas_ubicacion/eliminar_cat/" . $rSolicitud->id); ?>" title="Eliminar Solicitud" onclick="return confirm('¿Confirma eliminar Registro?');" target="_self"><span class="glyphicon glyphicon-remove" ></span></a>
                                                                </td>
                                                                <td>
                                                                    <?php echo $rSolicitud->Nombre; ?>
                                                                </td>
                                                               
                                                                 <td>
                                                                    <?php echo $rSolicitud->deFila; ?>
                                                                </td>
                                                                 
                                                                 <td>
                                                                    <?php echo $rSolicitud->hastaFila; ?>
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
        
        
        
        
        
        <!--Nueva Area Ubicacion -->
        <div class="modal fade" id="modal-agregar-cat" role="dialog" aria-labelledby="modal-agregar-cat_myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            ×
                        </button>
                        <h4 class="modal-titlsamplee" id="modal-nuevo_subdocumentomyModalLabel">Área Ubicación - Nueva</h4>
                    </div>
                    <form action="<?php echo site_url("areas_ubicacion/agregar_cat"); ?>" method="post" name="forma1" target="_self" id="forma1" role="form" class="form-horizontal" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                             
                            
                             
                            <div class="form-group">
                                <label for="Nombre" class="col-sm-3 control-label">Nombre</label>    
                                <div class="col-sm-7"> 
                                    <input type="text" name="Nombre" id="Nombre" required value="" class="form-control" >
                                </div>            
                            </div>  
                             
                             
                             <div class="form-group">
                                <label for="deFila" class="col-sm-3 control-label">Desde Fila</label>   
                                <div class="col-sm-7"> 
                                    <input type="text" name="deFila" id="deFila" required value="" class="form-control">
                                </div>            
                            </div> 
                             
                            
                            
                            <div class="form-group">
                                <label for="hastaFila" class="col-sm-3 control-label">Hasta Fila</label>   
                                <div class="col-sm-7"> 
                                    <input type="text" name="hastaFila" id="hastaFila" required value="" class="form-control">
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
        </div> <!-- /Nueva Area Ubicacion -->
         
        
        
        
       <!-- Dialogo Modificar Area Ubicacion -->
        <div class="modal fade" id="modal-modificar-cat" role="dialog" aria-labelledby="modal-modificar-cat_myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            ×
                        </button>
                        <h4 class="modal-titlsamplee" id="modal-nuevo_subdocumentomyModalLabel">Área ubicación - Modificar</h4>
                    </div>
                    <form action="<?php echo site_url("areas_ubicacion/modificar_cat"); ?>" method="post" name="forma1" target="_self" id="forma1" role="form" class="form-horizontal" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                             
                            
                             
                             <div class="form-group">
                                <label for="Nombre" class="col-sm-3 control-label">Nombre</label>    
                                <div class="col-sm-7"> 
                                    <input type="text" name="Nombre_mod" id="Nombre_mod" required value="" class="form-control" >
                                </div>            
                            </div>  
                             
                             
                             <div class="form-group">
                                <label for="deFila" class="col-sm-3 control-label">Desde Fila</label>   
                                <div class="col-sm-7"> 
                                    <input type="text" name="deFila_mod" id="deFila_mod" required value="" class="form-control">
                                </div>            
                            </div> 
                             
                            
                            
                            <div class="form-group">
                                <label for="hastaFila" class="col-sm-3 control-label">Hasta Fila</label>   
                                <div class="col-sm-7"> 
                                    <input type="text" name="hastaFila_mod" id="hastaFila_mod" required value="" class="form-control">
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
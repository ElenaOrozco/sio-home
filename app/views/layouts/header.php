<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title><?php if (isset($title)) echo $title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">        
        <meta charset="utf-8">
        <title></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">        
        <meta name="robots" content="no-cache" />
        <meta name="description" content=" - Sistema para la Gestión de Archivos Versión: b1.0" />
        <meta name="AUTHOR" content="Luis Montero Covarrubias" />
        <meta name="AUTHOR" content="Maria Elena Orozco Chavarria" />
        <meta name="keywords" content="tramites, gestion, archivos, cid, estimaciones, generadores, siop" />

        <!-- CSS -->
        
        <link href="<?php echo site_url(); ?>css/datatables18.min.css" rel="stylesheet">
        <link href="<?php echo site_url(); ?>css/jquery.vegas.min.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo site_url(); ?>css/font-awesome.min.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo site_url(); ?>css/jquery-confirm.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat|Roboto" rel="stylesheet">
        <link href="<?php echo site_url(); ?>css/principal.css" rel="stylesheet">
        <link href="<?php echo site_url(); ?>css/style.css" rel="stylesheet">

        
       
        
        <!-- Fav and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo site_url(); ?>img/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo site_url(); ?>img/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo site_url(); ?>img/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="<?php echo site_url(); ?>img/apple-touch-icon-57-precomposed.png">
        <link rel="shortcut icon" href="<?php echo site_url(); ?>img/favicon.png">

    
    </head>
    <body>
        
        <nav class="navbar navbar-inverse" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo site_url(); ?>">Sistema para la Gestión de Archivos(SIGA)</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            
                <?php if ($preregistro == 0): ?>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-list-alt" aria-hidden="true"></i> Archivo <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="<?php echo site_url("archivo/"); ?>" title="Listado de Obras">Preregistro</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url("archivo/captura"); ?>" title="Estados de Obra">Estado de Obra</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url("proyectos/"); ?>" title="Proyectos">Proyectos</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url("concentracion/"); ?>" title="Concentración">Concentración</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url("transferencia/"); ?>" title="Concentración">Transferencias</a>
                                </li>
                           
                                
                            </ul>
                        </li>
                            
                        <li>
                            <a href="<?php echo site_url("ubicacionFisica/ubicaciones_archivo"); ?>" title="Ubicaciones Archivo"><i class="fa fa-map-marker" aria-hidden="true"></i> Ubicaciones de Archivos</a>
                        </li>
                             
                            
                            
                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope" aria-hidden="true"></i> Observaciones <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo site_url("observaciones"); ?>">Observaciones por Dirección</a></li>
                                <li><a href="<?php echo site_url("observaciones/observaciones_documentos"); ?>">Observaciones de Documentos</a></li>
                                <li><a href="<?php echo site_url("observaciones/observaciones_archivos"); ?>">Observaciones de Archivos</a></li>
                                
                            </ul>
                        </li>

                        <?php if(uri_string()== "archivo/captura")  { ?>
                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Reportes <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a  href=""data-toggle="modal" data-target="#modal-ver-reporte" role="button">Obras por Dirección</a>
                                        
                                    </li>
                                    <li>
                                        <a  href=""data-toggle="modal" data-target="#modal-ver-reporte-documento-direccion" role="button">Documentos por Dirección</a>
                                        
                                    </li>
                                    
                                    <li>
                                        <a  href=""data-toggle="modal" data-target="#modal-ver-reporte-documento-bloque" role="button">Documentos por Bloque</a>
                                        
                                    </li>
                                     <li>
                                        <a  href="<?php echo site_url("impresion/reporte_listado_contratistas"); ?>" target="_blank" >Contratistas (736 Obras)</a>
                                        
                                    </li>
                                    <li>
                                        <a  href="<?php echo site_url("impresion/reporte_relacion_obras_2017/"); ?>" target="_blank" >Relación de Obras Ejercicio Fiscal 2017</a>
                                        
                                    </li>
                                    
                                    
                                    
                                </ul>
                            </li>
                            <?php  } ?>
                            
                            <?php if(isset($idArchivo) && (uri_string()== "archivo/cambios/" .$idArchivo || uri_string()== "archivo/preregistrar/" .$idArchivo) )  { ?>
                            <li class="dropdown list-style"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-print"></span> Impresiones <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <?php if (uri_string()== "archivo/cambios/" .$idArchivo) : ?>
                                            <a  href="<?php echo site_url("impresion/reporte_preregistro"). '/' . $aArchivo['id']; ?> " target="_blank" >Preregistro</a>
                                        <?php else: ?>
                                            <a  href="<?php echo site_url("impresion/reporte_preregistro_cid"). '/' . $aArchivo['id']; ?> " target="_blank" >Preregistro</a>
                                        <?php endif;?>
                                    </li>
                                    


                                </ul>
                            
                            </li>
                            <?php  } ?>
                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-book" aria-hidden="true"></i> Catálogos <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    

                                    <li>
                                        <a href="<?php echo site_url("documentos/"); ?>" title="Documentos">Documentos</a>
                                    </li>
                                    
                                    <li>
                                        <a href="<?php echo site_url("subdocumentos/"); ?>" title="SubDocumentos">Sub Documentos</a>
                                    </li>
                                    
                                    
                                    <li>
                                        <a href="<?php echo site_url("plantillas/"); ?>" title="Plantillas">Plantillas</a>
                                    </li>
                                    
                                    
                                    <li>
                                        <a href="<?php echo site_url("control_usuarios/"); ?>" title="Usuarios">Usuarios</a>
                                    </li>
                                    
                                    
                                    <li>
                                        <a href="<?php echo site_url("procesos/"); ?>" title="Procesos">Procesos</a>
                                    </li>
                                    
                                     <li>
                                        <a href="<?php echo site_url("subproceso/"); ?>" title="Sub Procesos">Sub Procesos</a>
                                    </li>
                                    
                                     <li>
                                        <a href="<?php echo site_url("titularidad/"); ?>" title="Sub Procesos">Titularidad</a>
                                    </li>
                                    
                                    <li>
                                        <a href="<?php echo site_url("modalidad/"); ?>" title="Sub Procesos">Modalidades</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url("ubicacionFisica/"); ?>" title="Ubicacion Bloques">Ubicacion Bloques</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url("ubicacion_proyectos/"); ?>" title="Ubicacion Proyectos">Ubicacion Proyectos</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url("areas_ubicacion/"); ?>" title="Áreas ubicación trabajo">Áreas ubicación trabajo</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url("bloques_obras/"); ?>" title="Bloques Obras">Grupos Obras</a>
                                    </li>
                            
                            
                                </ul>
                            </li>
                             
                            <?php /* }
                                } */
                            ?>
                            <li>
                                <a href="<?php echo site_url("sessions/logout"); ?>"><i class="fa fa-sign-out" aria-hidden="true"></i> Salir</a>
                            </li>   
                      
                    </ul>
                <?php else: ?>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-list-alt" aria-hidden="true"></i> Archivo <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="<?php echo site_url("archivo/"); ?>" title="Listado de Obras">Preregistro</a>
                                </li>
                               
                                <li>
                                    <a href="<?php echo site_url("transferencia/"); ?>" title="Concentración">Transferencias</a>
                                </li>
                            </ul>
                        </li>
                            
                       
                            
                        <li><a href="<?php echo site_url("observaciones"); ?>" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope" aria-hidden="true"></i> Observaciones</a>
                        </li>

                        
                        <li>
                            <a href="<?php echo site_url("sessions/logout"); ?>"><i class="fa fa-sign-out" aria-hidden="true"></i> Salir</a>
                        </li>   
                      
                    </ul>

                <?php endif; ?>
            </div><!-- /.navbar-collapse -->
        </nav>
        

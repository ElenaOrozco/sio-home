
         
 
   
        
       <!--  <style>
           .align-t-e{
               text-align: end;
        
           }
           .plantilla{
              
               -moz-box-shadow: 5px 5px 5px #888;
               -webkit-box-shadow: 5px 5px 5px#888;
               box-shadow: 5px 5px 5px #888;
             
           }
           .p-l{
             padding-left: 15px;
           }
           
           .table-small{
               font-size: 12px;
               color: #000;
           }
           
           .btn-yellow{
               background: rgb(250, 235, 204);
           }
           .flex{
               display: flex;
               justify-content: space-between;
           }
           .list-style{
               list-style: none;
           }
           
           
           p-t {
             font-size : 2.5em ;
             text-align : center;
             color : #333;
             text-shadow : 0px 3px 5px #999;
           }
           .box{
             position : absolute;
             top : calc(50% - 2.5em);
             left : calc(50% - 3em);
           }
           .container-fluid {
               padding-right: 10px;
               padding-left: 10px;
           }
       
           .tog .tog-con{
               width : 5em;
               height : 5em/2;
               border-radius : 5em/2;
               box-shadow : 0 0 4px #999;
               position : relative;
               background : #f55;
               transition : all ease-in-out 300ms;
           }
           .tog .tog-con:after{
                 content : "SI";
                 line-height : 5em/2;
                 text-align : center;
                 color : #111;
                 width : 5em/2;
                 height : 5em/2;
                 display : block;
                 background : #eee;
                 border-radius : 5em/2;
                 box-shadow : 0 0 5px -1px;
                 position : absolute;
                 left : 0;
                 transition : all ease-in-out 300ms;
           }
           #s2id_identificador{
               width: 100%;
           }
           
           .d-n{
             display : none;
           }
           .input :checked .tog-con{
               background : #1c5;
               transition : all ease-in-out 300ms;
           }
           .input:after{
                 left : 5em/2;
                 content : "NO"
           }
           .align-end{
               text-align: end;
           }
           
           .width-modal{
               width: 1000px !important;
           }
           .enlace-succes{
               color: #3c763d;
           }
           .flex-center{
               display: flex; 
               align-items: center;
           }
           .m-b{
               margin-bottom: 10px;
           }
           .m-b-separacion{
               margin-bottom: 30px;
           }
           
           .list-style{
               list-style: none;
           }
           .m-t{
               margin-top: 10px;
           }
           .d-f{
               display: flex;
               justify-content: space-between;
           }
           .color-red{
               color: #d9534f;
           }
           .m-b-body{
               margin-bottom: 60px;
           }
           .checkbox-lg{
               width: 25px;
               height: 25px;
           }
           .estatus{
               padding: 5px;
               background:rgba(17, 173, 20, 0.12); 
               border-radius: 2px;
           }
           .estatus-sin{
               padding: 5px;
               background: rgb(249, 243, 212); 
               border-radius: 2px;
           }
           .estatus-recibir{
               padding: 5px;
               background: rgba(136, 205, 255, 0.35); 
               border-radius: 2px;
               
           }
           hr{
               margin-bottom: 10px;
               margin-top: 10px;
           }
           body{
               font-size: 14px;
               line-height: 20px;
           }
           .enlace-blue{
               color: #31708f;
               margin-bottom: 5px;
           }
           #row-title{
               color: #8a6d3b;
               background-color: #fcf8e3;
               border-color: #faebcc;
               border-radius: 5px;
           }
           h5 small{
               color: #989080; 
           }
         
       </style>
           
           <body  class="m-b-body" style="overflow: visible;"> -->
        
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url("archivo/"); ?>">Listado de Obras</a></li>
            <li class="active">Edición de Preregistro</li>
        </ol>
        <!-- Contenido Principal -->
        <div class="container">
            
            <div class="row">
                <!-- Widget Datos Obra -->
                <?php //include 'widget_datos_obra.php'; ?>
                <!-- /Widget Datos Obra -->
                <input type="hidden" id="idArchivo" value="<?= $idArchivo ?>">
                <input type="hidden" id="ejecutora" value="<?= $aArchivo['Direccion'] ?>">
                <input type="hidden" id="base_url" value="<?php echo site_url(); ?>">
                
            </div>

            
            

            <div id="contenido">
              
            </div>



            <!-- Contenido Dinamico -->
            <div class="d-n" id="procesos">
                <!-- /Procesos -->
                <div class="row">
                    <div class="col-md-12"> 
                        <div class="panel panel-primary plantilla">

                            <div class="panel-heading"> 
                                <a class="panel-title" id="panel-proceso-titulo-{idTipoProceso}" data-toggle="collapse" data-parent="#panel-proceso-{idTipoProceso}" href="#panel-element-proceso-{idTipoProceso}">
                                    <div class="d-f">
                                      <div class="col-md-5">{Proceso}</div>
                                      <div id="estatus-{idTipoProceso}">Estatus {Estatus}</div>
                                      <div id="noPreregistrados-{idTipoProceso}">Preregistrados {preregistrados} de {total}</div>



                                    </div>
                                   
                                           
                                </a>  
                            </div>
                            
                            
                            <div id="panel-element-proceso-{idTipoProceso}" class="panel-collapse collapse in">
                                <div class="panel-body"  id="panel-body-proceso-{idTipoProceso}">
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Procesos -->
            </div>
            <?php include 'widget_subproceso.php'; ?>
            <?php include 'widget_documento.php'; ?>
            <?php include 'widget_documento_contenedor.php'; ?>
            <!-- /Contenido Dinamico -->
            
            
    
           
                 
           
           
     
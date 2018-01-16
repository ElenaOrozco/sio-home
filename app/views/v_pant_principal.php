<ol class="breadcrumb ol-principal" id="ol-principal">
    <li class="active">Principal</li>
    
</ol>
<div class="container-fluid">
       
           
        
        
        
            <div class="row">                
                <div class="col-md-12">                     									
                    <img src="<?php echo site_url(); ?>images/logo-secretaria.jpg" alt="Logo Secretaria" class="img-responsive center-block" />     				
                </div> 
            </div> 

                                    
            <?php
            if (isset($qAvisos) && $qAvisos !== FALSE) {
                if ($qAvisos->num_rows() > 0) {
                    ?>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 column">
                            <h2 class="text-primary">
                                Avisos
                            </h2>
                        </div>
                        <?php foreach ($qAvisos->result() as $rAviso) { ?>
                            <div class="col-xs-12 col-sm-6 column">
                                <h3 class="text-info">
                                    <?php echo $rAviso->Titulo; ?></h3>
                                <h5><small class><?php echo $this->ferfunc->fechacas(date("Y-m-d", strtotime($rAviso->FechaHora))); ?></small>
                                </h5>
                                <blockquote class="blockquote-reverse">
                                    <p class="text-justify">
                                        <?php
                                        // detectar si no es párrafo
                                        echo trim($rAviso->Aviso);
                                        ?>
                                    </p>
                                    <?php if (!empty($rAviso->Enlace)) { ?>
                                        <p>
                                            <a class="btn" href="<?php echo $rAviso->Enlace; ?>"><?php echo $rAviso->EnlaceText; ?> »</a>
                                        </p>
                                    <?php } // si hay Enlace   ?>
                                    <footer>
                                        <?php echo $rAviso->Direccion; ?>                                       
                                    </footer>                                    
                                </blockquote>
                            </div>

                        <?php } // foreach   ?>
                    </div>
                            <?php
                        } // if
                    } // if 
                    ?>                

               
       
    <nav class="navbar navbar-inverse navbar-fixed-bottom" role="navigation" style="min-height: 28px !important; ">
        <div class="container-fluid">
            <div class="container-fluid navbar-header">
                &nbsp;
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <p class="navbar-text">Usuario: <?php echo $usuario; ?></p>                
                </ul>
            </div>
        </div>
    </nav>
</div>


<script type="text/javascript" src="<?php echo site_url(); ?>js/datatables18.min.js"></script>
 <script type="text/javascript" src="<?php echo site_url(); ?>js/jquery-confirm.js"></script> 
<script> var url ="<?php echo site_url( ); ?>" ; </script>
<script type="text/javascript" src="<?php echo site_url(); ?>js/scripts.js"></script>
<?php if(isset($js)): ?>  
    <script type="text/javascript" src="<?php echo site_url(); ?>js/functions/<?= $js ?>"></script>
<?php endif; ?>
<!-- SI LA RUTA ES ARCHIVO -->
<?php if(uri_string()== "archivo"): ?>        
    <script type="text/javascript" src="<?php echo site_url(); ?>js/functions/archivo.js"></script>
<?php else: ?>
<?php endif; ?>


</body>
</html>
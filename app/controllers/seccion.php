<?php


class Seccion extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index($error='') {
        
        $this->load->model('seccion_model');
        $this->load->library('ferfunc');
        /*if ($this->ferfunc->get_permiso_edicion_lectura($this->session->userdata('id'),"Modalidades","P")==false){
            header("Location:" . site_url('principal'));
        }*/
        
        $data['meta'] = array(
            array('name' => 'robots', 'content' => 'no-cache'),
            array('name' => 'description', 'content' => $this->config->item('titulo_ext') . " - " . $this->config->item('titulo') . " Version: " . $this->config->item('version')),
            array('name' => 'AUTHOR', 'content' => 'Luis Montero Covarrubias'),
            array('name' => 'AUTHOR', 'content' => 'Maria Elena Orozco Chavarria'),
            array('name' => 'keywords', 'content' => 'siga, archivo, documentos, historico, siop'),
            array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv'),
            array('name' => 'CACHE-CONTROL', 'content' => 'NO-CACHE', 'type' => 'equiv'),
            array('name' => 'EXPIRES', 'content' => 'Mon, 26 Jul 1997 05:00:00 GMT', 'type' => 'equiv')
        );
        $data['error']=$error;
       
        $data['usuario'] = $this->session->userdata('nombre');
        $data["aWidgets"]["widget_menu"] = $this->load->view('widget_menu.php', $data, TRUE);
        $data['qListado']=$this->seccion_model->listado_seccion();      
        $data['urlanterior']= isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : 'principal';
        
        
        $this->load->view('v_pant_seccion', $data);
        
    }
    
    public function agregar_cat() {
        $this->load->model('seccion_model');
         
         
        $data = array(
            'Nombre' => strtoupper($this->input->post('Nombre')),
            'Codigo' => $this->input->post('Codigo'),
            
        );
         
        $retorno = $this->seccion_model->datos_seccion_insert($data);
        

        if($retorno['retorno'] < 0){
            header('Location:'.site_url('seccion/index/' . $retorno['error']));
        }
        else {
            header('Location:'.site_url('seccion')); 
        }
    }
    
    
    public function modificar_cat() {
         $this->load->model('seccion_model');
         
         
         
         $id = $this->input->post('idCatalogo');
         $data=array(
            'Nombre'=> strtoupper($this->input->post('Nombre_mod')),
            'Codigo'=> $this->input->post('Codigo_mod'),
        );

        $retorno =  $this->seccion_model->datos_seccion_update($data, $id);
        if($retorno['retorno']<0){
            header('Location:'.site_url('seccion/index/'.$retorno['error']));
        }
        else{
            header('Location:'.site_url('seccion')); 
        }
    }
    
    
    public function eliminar_cat($id) {
         
        $this->load->model('seccion_model');
         
         
        $data=array(
            'Estatus'=> 0,
            
        );

        $retorno =  $this->seccion_model->datos_seccion_update($data, $id);
        if($retorno['retorno']<0){
            header('Location:'.site_url('seccion/index/'.$retorno['error']));
        }
        else{
            header('Location:'.site_url('seccion')); 
        }
    }
    
    
     public function datos_seccion($id) {
        $this->load->model('seccion_model');
        $query = $this->seccion_model->datos_seccion($id);
        echo json_encode($query->row_array());
    }
    
    
    
    
    
}
<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Archivo extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('datos_model');
        $this->load->model('usuarios_model');
        $this->load->library('ferfunc');
        //$this->load->helper('form');
    }
    
    
    
    

    public function index() {
        
        if ($this->ferfunc->get_permiso_edicion_lectura($this->session->userdata('id'),"Listado de Obras","P")==false ){
            header("Location:" . site_url('principal'));
        }
        
        $data['meta'] = array(
            array('name' => 'robots', 'content' => 'no-cache'),
            array('name' => 'description', 'content' => $this->config->item('titulo_ext') . " - " . $this->config->item('titulo') . " Versión: " . $this->config->item('version')),
            array('name' => 'AUTHOR', 'content' => 'Luis Montero Covarrubias'),
            array('name' => 'AUTHOR', 'content' => 'Maria Elena Orozco Chavarria'),
            array('name' => 'keywords', 'content' => 'tramites, transparencia, estimaciones, generadores, siop'),
            array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv'),
            array('name' => 'CACHE-CONTROL', 'content' => 'NO-CACHE', 'type' => 'equiv'),
            array('name' => 'EXPIRES', 'content' => 'Mon, 26 Jul 1997 05:00:00 GMT', 'type' => 'equiv')
        );

        //$data["qArchivos"] = $this->datos_model->listado();
        $data["qArchivos_736"] = $this->datos_model->listado_736();
        $data["aUsuarios"] = $this->datos_model->get_usuarios();
        $data["Tipos_Arch"] = $this->datos_model->get_Tipos_Arch_select();
        $data["Tam_Norm"] = $this->datos_model->get_Tam_Norm_select();
        $data["Tipos_uni"] = $this->datos_model->get_Tipos_uni_select();
        $data["Titularidades"] = $this->datos_model->get_Titularidades_select();
        $data["Direcciones"] = $this->datos_model->get_Direcciones_select();
        $data["Ejercicios"] = $this->datos_model->get_Ejercicio_select();
        $data["Modalidades"] = $this->datos_model->get_Modalidades_select();
        
        $this->load->model("direcciones_model");
        $data["Direcciones"] = $this->direcciones_model->listado_catDirecciones();
        
        
        $data['usuario'] = $this->session->userdata('nombre');
        $data["recibe"]=$this->session->userdata('recibe');
        $data["reviso"]=$this->session->userdata('reviso');
        $data["Foliar"]=$this->session->userdata('Foliar');
        $data["Validar"]=$this->session->userdata('Validar');
        $data["digitalizar"]=$this->session->userdata('digitalizar');
        $data["Editar"]=$this->session->userdata('Editar');

        $data["integracion"]=$this->session->userdata('integracion');
        $data["preregistro"]=$this->session->userdata('preregistro');
        $data["aWidgets"]["widget_menu"] = $this->load->view('widget_menu.php', $data, TRUE);
        
        $this->load->model("ubicacion_fisica_model");
        $this->load->model("datos_model");
         
        $data["qBloques"] = $this->datos_model->get_bloques();
        $data["qEstatus"] = $this->datos_model->listado_estatus_archivos();
        $data["qGrupos"] = $this->datos_model->get_grupos(); //Grupos obra- idBloqueObra
        $data["qUbicacionesFisicas"]=$this->ubicacion_fisica_model->listado_ubicacion_ordenada_por_columna();
       
        
        
      
                        
                        
                       

        
        
        
        
        /*
        $data["aCategorias"] = array(0 => "N/D", 1 => "Falla (bug)", 2 => "Modificación", 3 => "Rediseño", 4 => "Proceso de Datos", 5 => "Sistema Nuevo");
        $data["aPrioridad"] = array(0 => "N/D", 1 => "Baja", 2 => "Media", 3 => "Alta", 4 => "Urgente");
        $data["aEstatus"] = array(0 => "Baja", 1 => "Nueva", 2 => "Atendiendo", 3 => "Terminada", 4 => "Re Abierta",  5 => "Atendiendo - En Pruebas",  6 => "Atendiendo - Liberada");
        */
        //this->load->view('v_listado.php', $data);
        
        
            
        
            $this->load->view('v_pant_archivo.php', $data);
       
            
        
        
        
        
        
        
    }
    
    
    
     public function captura() {
        
        if ($this->ferfunc->get_permiso_edicion_lectura($this->session->userdata('id'),"Estado de Obras","P")==false ){
            header("Location:" . site_url('principal'));
        }
        
        $data['meta'] = array(
            array('name' => 'robots', 'content' => 'no-cache'),
            array('name' => 'description', 'content' => $this->config->item('titulo_ext') . " - " . $this->config->item('titulo') . " Versión: " . $this->config->item('version')),
            array('name' => 'AUTHOR', 'content' => 'Luis Montero Covarrubias'),
            array('name' => 'AUTHOR', 'content' => 'Maria Elena Orozco Chavarria'),
            array('name' => 'keywords', 'content' => 'tramites, transparencia, estimaciones, generadores, siop'),
            array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv'),
            array('name' => 'CACHE-CONTROL', 'content' => 'NO-CACHE', 'type' => 'equiv'),
            array('name' => 'EXPIRES', 'content' => 'Mon, 26 Jul 1997 05:00:00 GMT', 'type' => 'equiv')
        );

        //$data["qArchivos"] = $this->datos_model->listado();
        $data["qArchivos_736"] = $this->datos_model->listado_736();
        $data["aUsuarios"] = $this->datos_model->get_usuarios();
        $data["Tipos_Arch"] = $this->datos_model->get_Tipos_Arch_select();
        $data["Tam_Norm"] = $this->datos_model->get_Tam_Norm_select();
        $data["Tipos_uni"] = $this->datos_model->get_Tipos_uni_select();
        $data["Titularidades"] = $this->datos_model->get_Titularidades_select();
        $data["Direcciones"] = $this->datos_model->get_Direcciones_select();
        $data["Ejercicios"] = $this->datos_model->get_Ejercicio_select();
        $data["Modalidades"] = $this->datos_model->get_Modalidades_select();
        
        
        $data['usuario'] = $this->session->userdata('nombre');
        $data["recibe"]=$this->session->userdata('recibe');
        $data["reviso"]=$this->session->userdata('reviso');
        $data["Foliar"]=$this->session->userdata('Foliar');
        $data["Validar"]=$this->session->userdata('Validar');
        $data["digitalizar"]=$this->session->userdata('digitalizar');
        $data["Editar"]=$this->session->userdata('Editar');
        

        $data["integracion"]=$this->session->userdata('integracion');
        $data["preregistro"]=$this->session->userdata('preregistro');
        $data["aWidgets"]["widget_menu"] = $this->load->view('widget_menu.php', $data, TRUE);
        
        $this->load->model("ubicacion_fisica_model");
        $this->load->model("datos_model");
         
        $data["qBloques"] = $this->datos_model->get_bloques();
        $data["qEstatus"] = $this->datos_model->listado_estatus_archivos();
        $data["qGrupos"] = $this->datos_model->get_grupos(); //Grupos obra- idBloqueObra
        $data["qUbicacionesFisicas"]=$this->ubicacion_fisica_model->listado_ubicacion_ordenada_por_columna();
        $data["qDirecciones"]=$this->datos_model->get_Direcciones_SIOP();
       
      
                        
                        
                       

        
        
        
        
        /*
        $data["aCategorias"] = array(0 => "N/D", 1 => "Falla (bug)", 2 => "Modificación", 3 => "Rediseño", 4 => "Proceso de Datos", 5 => "Sistema Nuevo");
        $data["aPrioridad"] = array(0 => "N/D", 1 => "Baja", 2 => "Media", 3 => "Alta", 4 => "Urgente");
        $data["aEstatus"] = array(0 => "Baja", 1 => "Nueva", 2 => "Atendiendo", 3 => "Terminada", 4 => "Re Abierta",  5 => "Atendiendo - En Pruebas",  6 => "Atendiendo - Liberada");
        */
        
        if ($data["preregistro"]== 1){
            $this->load->view('v_pant_principal', $data);
            
        }else {
            $this->load->view('v_pant_archivo_captura.php', $data);
        }
        
        
        
        
        
    }
    
  
    public function fetch_archivos(){  
           $this->load->model('archivo_model');  
           $Modalidades = $this->datos_model->get_Modalidades_select();
           $fetch_data = $this->archivo_model->make_datatables();  
           
           $data = array();  
           foreach($fetch_data as $row)  
           {  
                $sub_array = array();  
                $sub_array[] = ' <a href="'. site_url('archivo/cambios/' .$row->id) .'"   class="btn btn-xs btn-success"><span class="glyphicon glyphicon-pencil"></span></a>';  
                $sub_array[] = $row->OrdenTrabajo ;  
                $sub_array[] = $row->Contrato;  
                $sub_array[] = $row->Obra ;  
                $sub_array[] = $row->Descripcion;  
                $sub_array[] = $row->Normatividad ;  
                if(isset($Modalidades[$row->idModalidad])){
                    $sub_array[] =  $Modalidades[$row->idModalidad];
                } else {
                    $sub_array[] = "";
                }
 
                $sub_array[] = $row->idEjercicio;  
                $sub_array[] = $row->EstatusObra ;  
                $sub_array[] = $row->Direccion;  
                $sub_array[] = $row->Supervisor;  
                $sub_array[] = $row->FechaInicio;   
                $sub_array[] = $row->ImporteContratado;  
                $sub_array[] = $row->EjercidoSiop ;  
 
                if ($row->Finiquitada == 0) {
                    $sub_array[] = 'No';
                } else {
                    $sub_array[] = 'Si';
                }    
                $sub_array[] = $row->Contratista ;  
                $sub_array[] = '<a href="#" class="btn btn-warning btn-xs" title=""  data-toggle="modal" data-target="#modal-historico-archivo" role="button" onclick="ver_historico_archivo('. $row->id .')"><span class="glyphicon glyphicon-search"></span></a>&nbsp;';
 
 
 
     
                $data[] = $sub_array;  
           }  
           $output = array(  
                "draw"                =>     intval($_POST["draw"]),  
                "recordsTotal"        =>     $this->archivo_model->get_all_data(),  
                "recordsFiltered"     =>     $this->archivo_model->get_filtered_data(),  
                "data"                =>     $data 
           );  
           echo json_encode($output);  
      }  
      
    public function ot_json() {
        $term = $this->input->post("term");
        $id = $this->input->post("id");
        $condicion = $this->input->post("condicion");
        $this->load->model('datos_model');
       
        $aRemitente = $this->datos_model->ot_json($term,$id, $condicion);
        
        //print_r($aRemitente);
        
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');
        echo json_encode($aRemitente, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
    }
    
    
    public function listado_tx(){
        $this->load->model('datos_model');
        $tabla ="";
        
        //Filtro por grupos
        $qFiltro = $this->datos_model->listado_tx();
           
        
        /*if (isset($qFiltro)) {
                                    if ($qFiltro->num_rows() > 0) {
                                       
                                        foreach ($qFiltro->result() as $rFiltro) {
                                            echo $rFiltro->OrdenTrabajo;
                                        }
                                    }
        }
        exit();*/
        
        $tabla.='
         
           
          <table class="table table-responsive table-striped table-hover table-bordered" id="t_tx">
                            <thead>
                            <tr>
                                <th class="col-md-1">
                                    Acción
                                </th>
                                <th>
                                    Orden de Trabajo
                                </th>
                                <th>
                                    Contrato
                                </th>
                                <th>
                                    Obra
                                </th>                               
                                <th>
                                    Descripcion
                                </th>
                               
                                  <th >
                                    Normatividad
                                </th> 
                                  <th >
                                    Modalidad
                                </th> 
                                <th >
                                    Ejercicio
                                </th> 
                                <th >
                                    Estatus Obra
                                </th>
                                
                                <th >
                                    Direccion Ejecutora
                                </th>
                                <th >
                                    Supervisor
                                </th>
                                <th >
                                    Inicio Contrato
                                </th>
                                <th >
                                    Monto Contratado
                                </th>
                                <th >
                                    Monto Ejercido por SIOP
                                </th>
                                <th >
                                    Finiquitada
                                </th>
                                <th>
                                    Estatus FIDO
                                </th>
                               
                            </tr>
                        </thead>
                        <tbody>
         ';
         
         
                                if (isset($qFiltro)) {
                                    if ($qFiltro->num_rows() > 0) {
                                        $i = 0;
                                        foreach ($qFiltro->result() as $rFiltro) {
                                            if ( $rFiltro->Finiquitada == 0){
                                                $finiquitada = 'NO';
                                            }else {
                                                $finiquitada = 'SI';
                                            }
                                           $tabla.= "<tr>";
                                                $tabla.=  "<td>" ;
                                                
                                                $tabla.= "<a href='". site_url('archivo/cambios/' . $rFiltro->id) ."' class='btn btn-xs btn-success'><span class='glyphicon glyphicon-pencil'></span></a></td>";
                                                $tabla.=  "<td>" . $rFiltro->OrdenTrabajo . "</td>";

                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->Contrato . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->Obra . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->Descripcion . "</td>";
                                               
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->Normatividad . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->idModalidad . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->idEjercicio . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->EstatusObra . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->Direccion . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->Supervisor . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->FechaInicio . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->ImporteContratado . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->EjercidoSiop . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $finiquitada. "</td>";
                                                $tabla.= "<td class='sinwarp'> <a href='#' class='btn btn-warning btn-xs' title=''  data-toggle='modal' data-target='#modal-historico-archivo' role='button' onclick='ver_historico_archivo(" . $rFiltro->id  .")'><span class='glyphicon glyphicon-search'></span></a>&nbsp;</td>";
                                           
                                               //$tabla.= "<td class='sinwarp'>" .$rProcesos->Estatus. "</td>";
                                           $tabla.= "</tr>";
                                            
                                        }
                                    }
                                }
        
                                
        $tabla.=' </tbody>
                        </table> ';                        
                                
        $data=array();
        $data["tabla"]=$tabla;
                                
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');
        echo json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);  
    }

        public function historico_archivo($idArchivo){
        $this->load->model('datos_model');
        $this->load->model('rel_archivo_documento_model');
        $this->load->model('procesos_model');
        
        $Estatus_Bloque = $this->datos_model->addw_Estatus_Bloque();
        $qProcesos = $this->rel_archivo_documento_model->get_procesos_por_archivo($idArchivo);
        $addw_Procesos = $this->procesos_model->addw_procesos();
        
       
        //echo 'Llegamos';
        //exit();
         
        
         
         
         $tabla='
         
         
          <table class="table table-striped table-hover table-condensed" id="tabla_scroll">
                            <thead>
                                <tr>                                    
                                    
                                    <th>
                                        Bloque
                                    </th>
                                    <th>
                                        Estatus
                                    </th>
                                    
                                    
                                </tr>
                            </thead>
                            <tbody>
         ';
         
         
                                if (isset($qProcesos)) {
                                    if ($qProcesos->num_rows() > 0) {
                                        $i = 0;
                                        foreach ($qProcesos->result() as $rProcesos) {
                                            $i++;
                                            
                                           $tabla.= "<tr>";
                                                $tabla.=  "<td>" . $addw_Procesos[$rProcesos->idTipoProceso]. "</td>";

                                                $tabla.= "<td class='sinwarp'>" .$Estatus_Bloque[$rProcesos->Estatus]. "</td>";
                                           
                                               //$tabla.= "<td class='sinwarp'>" .$rProcesos->Estatus. "</td>";
                                           $tabla.= "</tr>";
                                            
                                        }
                                    }
                                }
        
                                
        $tabla.=' </tbody>
                        </table> ';                        
                                
        $data=array();
        $data["historial"]=$tabla;
                                
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');
        echo json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);  
    }

    public function datos_archivo($id){
        $this->load->model('datos_model');
        $query = $this->datos_model->datos_Archivo($id);
        echo json_encode($query->row_array());
    }
    
    public function datos_bloque($id){
        $this->load->model('datos_model');
        $query = $this->datos_model->datos_bloque($id);
        echo json_encode($query->row_array());
    }
    
    public function modificar_archivo(){
        if (isset($_REQUEST['Proyecto_mod'])) { 
             $proyecto=1; 
             
         }  
         else { 
             $proyecto=0; 
             
         } 
        
        
        $data = array(
                'idUsuario' => $this->session->userdata("id"),
                'OrdenTrabajo' => $this->input->post("OrdenTrabajo_mod"),
                'Contrato' => $this->input->post("Contrato_mod"),
                'Obra' => $this->input->post("Obra_mod"),
                'Descripcion' => $this->input->post("Descripcion_mod"),
                'FechaRegistro' => date("Y-m-d G:i:s"),
                'Estatus' => 10,
                'FondodePrograma' => $this->input->post("FondodePrograma_mod"),
                'Normatividad' => $this->input->post("Normatividad_mod"),
                'idModalidad' => $this->input->post("idModalidad_mod"),
                'idEjercicio' => $this->input->post("idEjercicio_mod"),
                'proyecto' => $proyecto,
            );
        $this->load->model('datos_model');
        $id=$this->input->post('idCatalogo');
        $retorno=  $this->datos_model->datos_archivo_update($data, $id);
        if($retorno['retorno']<0)
            header('Location:'.site_url('archivo/index/'.$retorno['error']));
        else
            header('Location:'.site_url('archivo')); 
    }

    public function nuevo() {
        $data = array();
        $data["idUsuario"] = $this->session->userdata("id");
        $data["FechaRegistro"] = date("Y-m-d G:i:s");
        $data["Estatus"] = 10;
        $retorno = $this->datos_model->alta($data);
        if($retorno['retorno'] == 1){
            /*header('Cache-Control: no-cache, must-revalidate');
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
            header('Location: ' . site_url("archivo/cambios/" . $retorno['id_registro']));*/
            $this->cambios($retorno['id_registro']);
        }else{
            $this->index();
        }
    }
    
    

    public function cambios($id_archivo = null, $idProceso = 1, $idSubProceso = 1, $idDocumento = 1, $Numero_Estimacion = "") {
        
        if ($id_archivo != 0) {
            /*
            $data["aArchivo"] = $this->datos_model->datos_Archivo($id_archivo)->row_array();
            $Tp_plantilla = $this->datos_model->get_tipo_plantilla($data["aArchivo"]['idModalidad'],$data["aArchivo"]['Normatividad']);
            
            if($Tp_plantilla){
                if($Tp_plantilla->num_rows() > 0){
                    foreach($Tp_plantilla->result() as $dato_p){
                        $idPlantilla = $dato_p->id;
                    }
                }
                $data["Id_Plantilla"] = $idPlantilla;
                $data["Documentos_Totales"] = $this->datos_model->get_Documentos_totales_por_plantilla($idPlantilla);
            }else{
                $data["Documentos_Totales"] = false;
                $data["Id_Plantilla"] = 0;
            }
            
            $data["aUsuarios"] = $this->datos_model->get_usuarios();
            $data["Tipos_Arch"] = $this->datos_model->get_Tipos_Arch_select();
            $data["Tam_Norm"] = $this->datos_model->get_Tam_Norm_select();
            $data["Tipos_uni"] = $this->datos_model->get_Tipos_uni_select();
            $data["Titularidades"] = $this->datos_model->get_Titularidades_select();
            $data["Direcciones"] = $this->datos_model->get_Direcciones_select();
            $data["Ejercicios"] = $this->datos_model->get_Ejercicio_select();
            $data["Modalidades"] = $this->datos_model->get_Modalidades_select();
            $data["Estatus_select"] = $this->datos_model->get_Estatus_select();
            $data["Historia"] = $this->datos_model->get_Historia($id_archivo);
            $data["Procesos"] = $this->datos_model->get_procesos();
            $this->load->view('v_reporte_form.php', $data);
            */
            
            $data['usuario'] = $this->session->userdata('nombre');
            $data['idusuario'] = $this->session->userdata('id');
            $this->load->library('ferfunc');
            
            $data["idArchivo"] = $id_archivo;
            $data["idProceso"] = $idProceso;
            $data["idSubProceso"] = $idSubProceso;
            $data["idDocumento"] = $idDocumento;
            $data["Numero_Estimacion"] = $Numero_Estimacion;
            $data["Estatus_select"] = $this->datos_model->get_Estatus_select();
            $data["Titularidades"] = $this->datos_model->get_Titularidades_select();
            //$data["SubDocs"] = $this->datos_model->get_SubDocs_select();
            $data["aArchivo"] = $this->datos_model->datos_Archivo($id_archivo)->row_array();
            //
            $data["aUsuarios"] = $this->datos_model->get_usuarios();
            //$data["qProcesos"] = $this->datos_model->get_procesos();
            $data["qProcesos"] = $this->datos_model->procesos_de_archivo($id_archivo);
            $data["NoProcesos_archivo"] = $this->datos_model->get_procesos_archivo($id_archivo)->num_rows();
            $data["NoProcesos_archivo_integracion"] = $this->datos_model->get_procesos_archivo_integracion( $id_archivo)->num_rows();
            $data["qBloques"] = $this->datos_model->get_bloques();
            $data["Ejercicios"] = $this->datos_model->get_Ejercicio_select();
            $data["Modalidades"] = $this->datos_model->get_Modalidades_select();
            $data["aWidgets"]["widget_menu"] = $this->load->view('widget_menu.php', $data, TRUE);
            $data["preregistro_realizado"] = $this->datos_model->preregistro_realizado($id_archivo)->num_rows();
            
            
            //#MAOC
           $data["Estatus_doc"] = $this->load->datos_model->get_Estatus_relacion($idDocumento);
            //$this->load->view('v_reporte_form.php', $data);
            
            $this->load->model('modalidad_model');
            $this->load->model('subdocumentos_model');
            $data["addw_modalidades"]= $this->modalidad_model->addw_modalidades();

            $data["addw_Estatus_Bloque"]= $this->datos_model->addw_Estatus_Bloque();
            $data["addw_SubDocumentos"]= $this->subdocumentos_model->addw_subDocumentos();
            
            $data["recibe"]=$this->session->userdata('recibe');
            $data["reviso"]=$this->session->userdata('reviso');
            $data["Foliar"]=$this->session->userdata('Foliar');
            $data["Validar"]=$this->session->userdata('Validar');
            $data["digitalizar"]=$this->session->userdata('digitalizar');
            $data["Editar"]=$this->session->userdata('Editar');
            
            $data["integracion"]=$this->session->userdata('integracion');
            $data["preregistro"]=$this->session->userdata('preregistro');
            
            $data["idDireccion_responsable"]=$this->session->userdata('idDireccion_responsable');
            
            $data["idArea_ubicacion_trabajo"]=$this->session->userdata('idArea_ubicacion_trabajo');
            
            
            $this->load->model("ubicacion_fisica_model");
            $data["qUbicacionesFisicas"]=$this->ubicacion_fisica_model->listado_ubicacion_ordenada_por_columna();
            
            $data["qRelProcesoUbicacion"]=$this->ubicacion_fisica_model->listado_ubicacion_fisica(); 
            
            $this->load->model("direcciones_model");
            $data["addw_direciones"] = $this->direcciones_model->addw_direccion();
            $data["addw_catDireccion"] = $this->direcciones_model->addw_catDireccion();
            
            $this->load->model("estimaciones_model");

            $this->load->view('v_pant_preregistro', $data);
            /* if( $data["preregistro"]== 1 ){
                //$data["qCarga"] = $this->datos_model->get_procesos();
                $this->load->view('v_pant_preregistro', $data);
                 //$this->load->view('v_reporte_form_2.php', $data);
            } else {
            //$this->load->view('v_reporte_form.php', $data);
            $this->load->view('v_reporte_form_2.php', $data);
            }*/
            
        }else{
            
            $data["Direcciones"] = $this->datos_model->get_Direcciones_select(); 
            $data["Titularidades"] = $this->datos_model->get_Titularidades_select();
            $data["Tipos_uni"] = $this->datos_model->get_Tipos_uni_select();
            $data["Tam_Norm"] = $this->datos_model->get_Tam_Norm_select();
            $data["Tipos_Arch"] = $this->datos_model->get_Tipos_Arch_select();
            $data["aUsuarios"] = $this->datos_model->get_usuarios();
            $data["Ejercicios"] = $this->datos_model->get_Ejercicio_select();
            $data["Modalidades"] = $this->datos_model->get_Modalidades_select();
            $this->load->view('v_reporte_new.php', $data);
            
        }
    }
    
    public function cargar_plantilla ($idArchivo){
        
       
        $resultado = array (
            "procesos" =>  $this->datos_model->procesos_de_archivo($idArchivo),
            "array_subprocesos" =>  $this->datos_model->procesos_de_archivo($idArchivo),
            "plantilla" => $this->datos_model->procesos_de_archivo($idArchivo),
        );
        
    }
    
    public function cargar_documentos($idArchivo, $idproceso, $idsubproceso){
        $this->load->model("datos_model");
        $documentos = $this->datos_model->cargar_documentos($idArchivo, $idproceso, $idsubproceso);
        if (isset($documentos)){
            if ($documentos->num_rows() > 0){
                foreach ($documentos->result() as $rRow){
                   require('site_url("archivo/cargar_documentos"); ?>row_documentos.php');
                }
            }
        }
        
        
    }

    public function preregistrar($id_archivo = null, $idDireccion, $idProceso = 1, $idSubProceso = 1, $idDocumento = 1, $Numero_Estimacion = "") {
        
       if ($id_archivo != 0) {
            
            $data['usuario'] = $this->session->userdata('nombre');
            $data['idusuario'] = $this->session->userdata('id');
            $this->load->library('ferfunc');
            
            $data["idArchivo"] = $id_archivo;
            $data["idProceso"] = $idProceso;
            $data["idSubProceso"] = $idSubProceso;
            $data["idDocumento"] = $idDocumento;
            $data["Numero_Estimacion"] = $Numero_Estimacion;
            $data["Estatus_select"] = $this->datos_model->get_Estatus_select();
            $data["Titularidades"] = $this->datos_model->get_Titularidades_select();
            //$data["SubDocs"] = $this->datos_model->get_SubDocs_select();
            $data["aArchivo"] = $this->datos_model->datos_Archivo($id_archivo)->row_array();
            //
            $data["aUsuarios"] = $this->datos_model->get_usuarios();
            //$data["qProcesos"] = $this->datos_model->get_procesos();
            $data["qProcesos"] = $this->datos_model->procesos_de_archivo($id_archivo);
            $data["NoProcesos_archivo"] = $this->datos_model->get_procesos_archivo($id_archivo)->num_rows();
            $data["NoProcesos_archivo_integracion"] = $this->datos_model->get_procesos_archivo_integracion( $id_archivo)->num_rows();
            $data["qBloques"] = $this->datos_model->get_bloques();
            $data["Ejercicios"] = $this->datos_model->get_Ejercicio_select();
            $data["Modalidades"] = $this->datos_model->get_Modalidades_select();
            $data["aWidgets"]["widget_menu"] = $this->load->view('widget_menu.php', $data, TRUE);
            $data["preregistro_realizado"] = $this->datos_model->preregistro_realizado($id_archivo)->num_rows();
            
            
            //#MAOC
           $data["Estatus_doc"] = $this->load->datos_model->get_Estatus_relacion($idDocumento);
            //$this->load->view('v_reporte_form.php', $data);
            
            $this->load->model('modalidad_model');
            $this->load->model('subdocumentos_model');
            $data["addw_modalidades"]= $this->modalidad_model->addw_modalidades();

            $data["addw_Estatus_Bloque"]= $this->datos_model->addw_Estatus_Bloque();
            $data["addw_SubDocumentos"]= $this->subdocumentos_model->addw_subDocumentos();
            
            $data["recibe"]=$this->session->userdata('recibe');
            $data["reviso"]=$this->session->userdata('reviso');
            $data["Foliar"]=$this->session->userdata('Foliar');
            $data["Validar"]=$this->session->userdata('Validar');
            $data["digitalizar"]=$this->session->userdata('digitalizar');
            $data["Editar"]=$this->session->userdata('Editar');
            
            $data["integracion"]=$this->session->userdata('integracion');
            $data["preregistro"]=$this->session->userdata('preregistro');
            
            $data["idDireccion_responsable"]=$this->session->userdata('idDireccion_responsable');
            
            $data["idArea_ubicacion_trabajo"]=$this->session->userdata('idArea_ubicacion_trabajo');
            
            
            $this->load->model("ubicacion_fisica_model");
            $data["qUbicacionesFisicas"]=$this->ubicacion_fisica_model->listado_ubicacion_ordenada_por_columna();
            
            $data["qRelProcesoUbicacion"]=$this->ubicacion_fisica_model->listado_ubicacion_fisica(); 
            
            $this->load->model("direcciones_model");
            $data["addw_direciones"] = $this->direcciones_model->addw_direccion();
            $data["addw_catDireccion"] = $this->direcciones_model->addw_catDireccion();
            $data["Direcciones"] = $this->direcciones_model->listado_catDirecciones();

            $this->load->model("estimaciones_model");
            $this->load->model("preregistro_model");

            
            
            //$this->load->view('v_reporte_form.php', $data);
            $this->load->view('v_reporte_form_preregistro.php', $data);
            
        }else{
            
            $data["Direcciones"] = $this->datos_model->get_Direcciones_select(); 
            $data["Titularidades"] = $this->datos_model->get_Titularidades_select();
            $data["Tipos_uni"] = $this->datos_model->get_Tipos_uni_select();
            $data["Tam_Norm"] = $this->datos_model->get_Tam_Norm_select();
            $data["Tipos_Arch"] = $this->datos_model->get_Tipos_Arch_select();
            $data["aUsuarios"] = $this->datos_model->get_usuarios();
            $data["Ejercicios"] = $this->datos_model->get_Ejercicio_select();
            $data["Modalidades"] = $this->datos_model->get_Modalidades_select();
            $this->load->view('v_reporte_new.php', $data);
            
        }
    }
    
    
    public function ver_plantilla($idArchivo){
       $this->load->model('rel_archivo_documento_model');
       
       $qDocumentosRecibidos = $this->rel_archivo_documento_model->documentos_recibidos($idArchivo);
       
       if ( $qDocumentosRecibidos->num_rows() > 0) {
           header("Location:" . site_url('archivo/cambios/'. $idArchivo.'/'. 'No se puede Actualizar. Tiene Documentos Recibidos'));
           //echo 'Tiene'. $qDocumentosRecibidos->num_rows().' docum recibidos';
          //exit();
           
       }
       else{
           //echo 'No Tiene docum recibidos';
           //exit();
           
        
        $this->load->model('datos_model');
        $this->load->model('rel_archivo_documento_model');
        
        //datos_archivo_insert
        
        
       
        
        
        //$qObras=$this->secip_obras_model->listado_obras();
        //
        //Borrado momentaneamente para no eliminar relacion
        $this->rel_archivo_documento_model->eliminar_relacion_archivo_documento_por_Archivo($idArchivo) ;
        //echo 'Verificar'; exit();
        $qArchivo = $this->datos_model->datos_Archivo($idArchivo);
        

        $row = $qArchivo->row_array();

        if (isset($row))
        {
                $idModalidad = $row['idModalidad'];
                $Normatividad = $row['Normatividad'];
                
               
        } 
        
        
        

                $id_new_archivo=$idArchivo;
                //echo $id_new_archivo; exit();

                $Tp_plantilla = $this->datos_model->get_tipo_plantilla($idModalidad, $Normatividad);

                if($Tp_plantilla){
                    if($Tp_plantilla->num_rows() > 0){
                        foreach($Tp_plantilla->result() as $dato_p){
                            $idPlantilla = $dato_p->id;
                        }
                    }
                    $Documentos_Totales = $this->datos_model->get_Documentos_totales_por_plantilla($idPlantilla);
                    if($Documentos_Totales->num_rows() > 0){
                        //echo $Documentos_Totales->num_rows() ;
                        //$i= 0;
                        foreach($Documentos_Totales->result() as $Documento){
                            //$i++;
                            //echo $Documento->id . ' ' . $id_new_archivo. ' ' .  $Documento->ordenar . ' </br>' ;
                            $accion = $this->datos_model->insert_plantilla_en_Relaciones($Documento->id, $id_new_archivo, $Documento->ordenar);
                        }
                        //echo $i;
                        //exit();
                    }
                }
            
        header("Location:" . site_url('archivo/cambios/'. $idArchivo . '/'. 'Plantilla Actualizada' )); 
       
       }
    }
    
    public function edit_est_revisado($idEstimacion) {
        $this->load->model('estimaciones_model');
        
        $data=array();
        if ($this->input->post("revisado") == 1){
            $data["revisado"] = 1;
            $data["idUsuario_revisado"]=  $this->session->userdata('id');
        }else {
            $data["revisado"] = 0;
            $data["idUsuario_revisado"]=  0;
            
        }
        
        $this->estimaciones_model->datos_estimaciones_update($data,$idEstimacion);
        
    }
        
    public function edit_est_recibio($idEstimacion) {
        $this->load->model('estimaciones_model');
        
        $data=array();
        if ($this->input->post("recibido") == 1){
            $data["recibido"] = 1;
        }else {
            $data["recibido"] = 0;
            
            
        }
        $data["idUsuario_recibio"]=  $this->session->userdata('id');
        $this->estimaciones_model->datos_estimaciones_update($data,$idEstimacion);
        
        /*if ($this->input->post("recibido") == 1){
            $data["copia"]= 1;
            $data["original_recibido"]= 0;
            $data["no_aplica"]= 0;
            $data["eliminacion_logica"]= 0;
        }
        
        if ($this->input->post("recibido") == 2){
            $data["original_recibido"]= 1;
            $data["copia"]= 0;
            $data["no_aplica"]= 0;
            $data["eliminacion_logica"]= 0;
        }
        if ($this->input->post("recibido") == 3){
            $data["no_aplica"]= 1;
            $data["copia"]= 0;
            $data["original_recibido"]= 0;
            $data["noHojas"]= 0;
            $data["eliminacion_logica"]= 0;
        }
        if ($this->input->post("recibido") ==0){
            $data["original_recibido"]= 0;
            $data["copia"]= 0;
            $data["no_aplica"]= 0;
            $data["noHojas"]= 0;
            $data["eliminacion_logica"]= 1;

        }
        
        
        
        $data["idUsuario"]=  $this->session->userdata('id');
        //$data["idDireccion_responsable"]=  $this->session->userdata('idDireccion_responsable');
        
        
        $this->estimaciones_model->datos_estimaciones_update($data,$idEstimacion);
        
        */
        

    }
    
    
    public function edit_estimacion_preregistro($idEstimacion, $direccion) {
        $this->load->model('estimaciones_model');
        
        $data=array();
        
        
        if ($this->input->post("recibido") == 1){
            $data["copia"]= 1;
            $data["original_recibido"]= 0;
            $data["no_aplica"]= 0;
        }
        
        if ($this->input->post("recibido") == 2){
            $data["original_recibido"]= 1;
            $data["copia"]= 0;
            $data["no_aplica"]= 0;
        }
        if ($this->input->post("recibido") == 3){
            $data["no_aplica"]= 1;
            $data["copia"]= 0;
            $data["original_recibido"]= 0;
            $data["noHojas"]= 0;
        }
        if ($this->input->post("recibido") ==0){
            $data["original_recibido"]= 0;
            $data["copia"]= 0;
            $data["no_aplica"]= 0;
            $data["noHojas"]= 0;
             $data["eliminacion_logica"]= 1;

        }
        
        
        
        $data["idUsuario"]=  $this->session->userdata('id');
        //$data["idDireccion_responsable"]=  $direccion;
        
        
        $this->estimaciones_model->datos_estimaciones_update($data,$idEstimacion);
        
        
        

    }
    
    public function preregistrar_documento_estimacion($id){
        $this->load->model('estimaciones_model');
        
        $data=array();
        
        
        if ($this->input->post("recibido") == 1){
            $data["copia"]= 1;
            $data["original_recibido"]= 0;
            $data["no_aplica"]= 0;
        }
        
        if ($this->input->post("recibido") == 2){
            $data["original_recibido"]= 1;
            $data["copia"]= 0;
            $data["no_aplica"]= 0;
        }
        if ($this->input->post("recibido") == 3){
            $data["no_aplica"]= 1;
            $data["copia"]= 0;
            $data["original_recibido"]= 0;
            $data["noHojas"]= 0;
        }
        if ($this->input->post("recibido") ==0){
            $data["original_recibido"]= 0;
            $data["copia"]= 0;
            $data["no_aplica"]= 0;
            $data["noHojas"]= 0;
            $data["eliminacion_logica"]= 1;

        }
        
        
        
        $data["idUsuario"]=  $this->session->userdata('id');
        $data["idDireccion_responsable"]=   $this->session->userdata('idDireccion_responsable');
        
        
        $retorno = $this->estimaciones_model->datos_estimaciones_update($data,$id);
        echo $retorno['retorno'];
        
    }


    public function edit_recibio($idRelDoc_Archivo) {
        $this->load->model('rel_archivo_documento_model');
        
        $data=array();
        $data["idUsuario_recibio"]=  $this->session->userdata('id');
        $data["idDireccion_responsable"] =$this->session->userdata('idDireccion_responsable');
        //echo $this->input->post("recibido");
        //exit();
        
        if ($this->input->post("recibido") == 1){
            $data["copia"]= 1;
            $data["original_recibido"]= 0;
        }
        
        if ($this->input->post("recibido") == 2){
            $data["original_recibido"]= 1;
            $data["copia"]= 0;
        }
        if ($this->input->post("recibido") ==0){
            $data["original_recibido"]= 0;
            $data["copia"]= 0;
            $data["idUsuario_recibio"]=  0;
            $data["idDireccion_responsable"] =0;
        }
        
        
        
       
        
        //echo $data["copia"] . ' ' . $data["original_recibido"] . ' ' . $data["idUsuario_recibio"] . ' ' . $data["idDireccion_responsable"] . ' ' . $idRelDoc_Archivo;
        //exit();
        
        $this->rel_archivo_documento_model->datos_relacion_archivo_documento_update($data,$idRelDoc_Archivo);
        
        /*
        $aRegistro=$this->rel_archivo_documento_model->datos_relacion_archivo_documento($idRelDoc_Archivo)->row_array();
        
        
        $qSubTipoProceso_recibido=$this->rel_archivo_documento_model->listado_registros_recibido_por_sub_tipo_proceso($aRegistro["idArchivo"],$aRegistro["idSubTipoProceso"]);
        
        $qTipoProceso_recibido=$this->rel_archivo_documento_model->listado_registros_recibido_por_tipo_proceso($aRegistro["idArchivo"],$aRegistro["idTipoProceso"]);
        
        
        $qSubTipoProceso=$this->rel_archivo_documento_model->listado_registros_recibido_por_sub_tipo_proceso_total($aRegistro["idArchivo"],$aRegistro["idSubTipoProceso"]);
        
        $qTipoProceso=$this->rel_archivo_documento_model->listado_registros_recibido_por_tipo_proceso_total($aRegistro["idArchivo"],$aRegistro["idTipoProceso"]);
    
        
        $data=array();
        $data["NumSubTipoProceso_recibido"]=$qSubTipoProceso_recibido->num_rows();
        $data["NumTipoProceso_recibido"]=$qTipoProceso_recibido->num_rows();
        $data["NumSubTipoProceso"]=$qSubTipoProceso->num_rows();
        $data["NumTipoProceso"]=$qTipoProceso->num_rows();
        $data["idTipoProceso"]=$aRegistro["idTipoProceso"];
        $data["idSubTipoProceso"]=$aRegistro["idSubTipoProceso"];
        
        $data["strTipoProceso_recibido"]="Recibidos " . $qTipoProceso_recibido->num_rows() . " de " . $qTipoProceso->num_rows();
        $data["strSubTipoProceso_recibido"]="Recibidos " . $qSubTipoProceso_recibido->num_rows() . " de " . $qSubTipoProceso->num_rows();
        */
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');
        echo json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);

        
    }
    
     public function cid_preregistra($idRelDoc_Archivo, $idArchivo, $idDireccion) {
        $this->load->model('rel_archivo_documento_model');
        $this->load->model('rel_archivo_preregistro_model');
        
        
        
        
        
        $str_existe_preregistro = $this->existe_preregistro($idRelDoc_Archivo, $idDireccion);
        
        if($str_existe_preregistro->num_rows() > 0 )  {
            $datos=array();
            $datos['tipo_documento']= $this->input->post("preregistrado");
            if ($this->input->post("preregistrado") == 3){
                $datos['noHojas']= 0;
            }
            if ($this->input->post("preregistrado") == 0){
                $datos['noHojas']= 0;
                $datos['eliminacion_logica']= 1;
                
            }else {
                $datos['eliminacion_logica']= 0;
            }
            $datos['fecha_ingreso']=date('Y-m-d H:i:s');
            $idDireccion_responsable = $idDireccion;
            $this->rel_archivo_preregistro_model->datos_relacion_archivo_preregistro_update($datos, $idDireccion, $idRelDoc_Archivo);
        }  else {
            $datos=array();
            $datos['id_Rel_Archivo_Documento']= $idRelDoc_Archivo;
            $datos['idDireccion_responsable']= $idDireccion;
            $datos['idUsuario_preregistra']=$this->session->userdata('id');
            $datos['idUsuario_acepta']=$this->session->userdata('id');
            $datos['preregistro_aceptado']=1;
            $datos['fecha_ingreso']=date('Y-m-d H:i:s');
            
            $datos['tipo_documento']= $this->input->post("preregistrado");
            $datos["idArchivo"] =$idArchivo;
            $this->rel_archivo_preregistro_model->datos_relacion_archivo_preregistro_insert($datos);
        }
       
        
        /*echo 'rel_preregistro';
        if ($this->rel_archivo_documento_model->datos_relacion_archivo_preregistro_insert($datos)){
            echo 'OK';
        }else{
            echo 'No';
        }
        exit();*/
        /*$existe_preregistro ="No";
        if ($this->existe_preregistro($idRelDoc_Archivo)){
            $existe_preregistro= "Si";
        }*/
        
        
        
        
        $aRegistro=$this->rel_archivo_documento_model->datos_relacion_archivo_documento($idRelDoc_Archivo)->row_array();
        
        $qSubTipoProceso_preregistro=$this->rel_archivo_documento_model->listado_registros_preregistrados_por_sub_tipo_proceso_preregistro($aRegistro["idArchivo"],$aRegistro["idSubTipoProceso"],  $idDireccion);
        
        $qTipoProceso_preregistro=$this->rel_archivo_documento_model->listado_registros_preregistrados_por_tipo_proceso_preregistro($aRegistro["idArchivo"],$aRegistro["idTipoProceso"],  $idDireccion);
        
        $qSubTipoProceso_recibido=$this->rel_archivo_documento_model->listado_registros_preregistrados_por_sub_tipo_proceso($aRegistro["idArchivo"],$aRegistro["idSubTipoProceso"]);
        
        $qTipoProceso_recibido=$this->rel_archivo_documento_model->listado_registros_preregistrados_por_tipo_proceso($aRegistro["idArchivo"],$aRegistro["idTipoProceso"]);
        
        
        $qSubTipoProceso=$this->rel_archivo_documento_model->listado_registros_recibido_por_sub_tipo_proceso_total($aRegistro["idArchivo"],$aRegistro["idSubTipoProceso"]);
        
        $qTipoProceso=$this->rel_archivo_documento_model->listado_registros_recibido_por_tipo_proceso_total($aRegistro["idArchivo"],$aRegistro["idTipoProceso"]);
        //$str_existe_preregistro ='OK';
        
        $data=array();
        $data["NumSubTipoProceso_recibidos"]=$qSubTipoProceso_recibido->num_rows();
        $data["NumTipoProceso_recibidos"]=$qTipoProceso_recibido->num_rows();
        $data["NumSubTipoProceso_preregistrasos"]=$qSubTipoProceso_preregistro->num_rows();
        $data["NumTipoProceso_preregistados"]=$qTipoProceso_preregistro->num_rows();
        $data["idTipoProceso"]=$aRegistro["idTipoProceso"];
        $data["idSubTipoProceso"]=$aRegistro["idSubTipoProceso"];
        
        
        $data["strTipoProceso_preregistrados"]="Preregistrados " . $qTipoProceso_preregistro->num_rows() . " de " . $qTipoProceso->num_rows();
        $data["strSubTipoProceso_preregistrados"]="Preregistrados " . $qSubTipoProceso_preregistro->num_rows() . " de " . $qSubTipoProceso->num_rows();
        
        $data["strTipoProceso_cid"]="Entregados " . $qTipoProceso_recibido->num_rows() . " de " . $qTipoProceso->num_rows();
        $data["strSubTipoProceso_cid"]="Entregados " . $qSubTipoProceso_recibido->num_rows() . " de " . $qSubTipoProceso->num_rows();
        
        $data["str_existe_preregistro"] = $str_existe_preregistro->num_rows();
        
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');
        echo json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);

        
    }


   
    
    //*
    public function edit_preregistrados($idRelDoc_Archivo, $idArchivo) {
        $this->load->model('rel_archivo_documento_model');
        $this->load->model('rel_archivo_preregistro_model');
        $fecha =  date('Y-m-d H:i:s');
        $datos=array();
        //$datos['fecha_ingreso']=date('Y-m-d H:i:s');
        
        //Si no es de preregistro
        if ($this->session->userdata('preregistro') == 0){
            $str_existe_preregistro = $this->hay_preregistro($idRelDoc_Archivo);

            if($str_existe_preregistro > 0 )  {
                
                $datos['tipo_documento']= $this->input->post("preregistrado");
                $datos['idUsuario_preregistra']=$this->session->userdata('id');
                if ($this->input->post("preregistrado") == 3){
                    $datos['noHojas']= 0;
                }
                if ($this->input->post("preregistrado") == 0){
                    $datos['noHojas']= 0;
                    $datos['eliminacion_logica']= 1;

                }else {
                    $datos['eliminacion_logica']= 0;
                }
                
                
                $this->rel_archivo_preregistro_model->datos_preregistro_update_por_relacion($datos, $idRelDoc_Archivo);
            }  else {
                
                $datos['id_Rel_Archivo_Documento']= $idRelDoc_Archivo;
                $datos['idDireccion_responsable']= $this->session->userdata("idDireccion_responsable");
                $datos['idUsuario_preregistra']=$this->session->userdata('id');

                $datos['tipo_documento']= $this->input->post("preregistrado");
                $datos["idArchivo"] =$idArchivo;
                $this->rel_archivo_preregistro_model->datos_relacion_archivo_preregistro_insert($datos);
            }
            
        } else {
        
            $str_existe_preregistro = $this->existe_preregistro($idRelDoc_Archivo, $this->session->userdata('idDireccion_responsable'));
            
            if($str_existe_preregistro->num_rows() > 0 )  {
                
                /*
                $datos['tipo_documento']= $this->input->post("preregistrado");
                
                $datos['fecha_preregistro'] = $fecha;
                
                if ($this->input->post("preregistrado") == 3){
                    $datos['noHojas']= 0;
                }
                if ($this->input->post("preregistrado") == 0){
                    $datos['noHojas']= 0;
                    $datos['eliminacion_logica']= 1;

                }else {
                    
                    $datos['eliminacion_logica']= 0;
                }
                
                $row = $str_existe_preregistro->row_array();

                if (isset($row))
                {
                    $id= $row['id'];
                        
                }
               
               
                $idDireccion_responsable = $this->session->userdata('idDireccion_responsable');
               
                
                $this->rel_archivo_preregistro_model->update_registro($datos, $id);*/
            }  else {
                
                $datos['id_Rel_Archivo_Documento']= $idRelDoc_Archivo;
                $datos['idDireccion_responsable']= $this->session->userdata('idDireccion_responsable');
                $datos['idUsuario_preregistra']=$this->session->userdata('id');
                $datos['fecha_preregistro'] = $fecha;
                $datos['tipo_documento']= $this->input->post("preregistrado");
                $datos["idArchivo"] =$idArchivo;
                
                /*echo $str_existe_preregistro->num_rows();
                print_r($datos);
                //exit(); */
                
                $this->rel_archivo_preregistro_model->datos_relacion_archivo_preregistro_insert($datos);
            }
       
        
        
        
        }
        
        
        
        
        $aRegistro=$this->rel_archivo_documento_model->datos_relacion_archivo_documento($idRelDoc_Archivo)->row_array();
        
        $idDireccion_responsable = $this->session->userdata('idDireccion_responsable');
        
        $qSubTipoProceso_preregistro=$this->rel_archivo_documento_model->listado_registros_preregistrados_por_sub_tipo_proceso_preregistro($aRegistro["idArchivo"],$aRegistro["idSubTipoProceso"],  $idDireccion_responsable);
        
        $qTipoProceso_preregistro=$this->rel_archivo_documento_model->listado_registros_preregistrados_por_tipo_proceso_preregistro($aRegistro["idArchivo"],$aRegistro["idTipoProceso"],  $idDireccion_responsable);
        
        
        $qSubTipoProceso_recibido=$this->rel_archivo_documento_model->listado_registros_preregistrados_por_sub_tipo_proceso($aRegistro["idArchivo"],$aRegistro["idSubTipoProceso"]);
        
        $qTipoProceso_recibido=$this->rel_archivo_documento_model->listado_registros_preregistrados_por_tipo_proceso($aRegistro["idArchivo"],$aRegistro["idTipoProceso"]);
        
        
        $qSubTipoProceso=$this->rel_archivo_documento_model->listado_registros_recibido_por_sub_tipo_proceso_total($aRegistro["idArchivo"],$aRegistro["idSubTipoProceso"]);
        
        $qTipoProceso=$this->rel_archivo_documento_model->listado_registros_recibido_por_tipo_proceso_total($aRegistro["idArchivo"],$aRegistro["idTipoProceso"]);
        //$str_existe_preregistro ='OK';
        
        $data=array();
        $data["NumSubTipoProceso_recibidos"]=$qSubTipoProceso_recibido->num_rows();
        $data["NumTipoProceso_recibidos"]=$qTipoProceso_recibido->num_rows();
        $data["NumSubTipoProceso_preregistrados"]=$qSubTipoProceso_preregistro->num_rows();
        $data["NumTipoProceso_preregistados"]=$qTipoProceso_preregistro->num_rows();
        $data["idTipoProceso"]=$aRegistro["idTipoProceso"];
        $data["idSubTipoProceso"]=$aRegistro["idSubTipoProceso"];
        $data["fecha"]=$fecha;
        
        
        $data["strTipoProceso_preregistrados"]="Preregistrados " . $qTipoProceso_preregistro->num_rows() . " de " . $qTipoProceso->num_rows();
        $data["strSubTipoProceso_preregistrados"]="Preregistrados " . $qSubTipoProceso_preregistro->num_rows() . " de " . $qSubTipoProceso->num_rows();
        
        $data["strTipoProceso_cid"]="Entregados " . $qTipoProceso_recibido->num_rows() . " de " . $qTipoProceso->num_rows();
        $data["strSubTipoProceso_cid"]="Entregados " . $qSubTipoProceso_recibido->num_rows() . " de " . $qSubTipoProceso->num_rows();
        
        //$data["str_existe_preregistro"] = $str_existe_preregistro->num_rows();
        
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');
        echo json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);

        
    }
    
    public function modificar_tipo_documento($idRelDoc_Archivo, $idArchivo,  $idRAP){
        $this->load->model('rel_archivo_documento_model');
        $this->load->model('rel_archivo_preregistro_model');
        
        $datos=array();
        
        
       
        $fecha =  date('Y-m-d H:i:s'); 
        $datos['fecha_preregistro']= $fecha;
        $datos['tipo_documento']= $this->input->post("preregistrado");
        
        if ($this->input->post("preregistrado") == 3){
            $datos['noHojas']= 0;
        }
        if ($this->input->post("preregistrado") == 0){
            $datos['noHojas']= 0;
            $datos['eliminacion_logica']= 1;

        }else {
            $datos['eliminacion_logica']= 0;
        }


        $this->rel_archivo_preregistro_model->update_registro($datos, $idRAP);
        
            
       
        
        $aRegistro=$this->rel_archivo_documento_model->datos_relacion_archivo_documento($idRelDoc_Archivo)->row_array();
        
        $idDireccion_responsable = $this->session->userdata('idDireccion_responsable');
        
        $qSubTipoProceso_preregistro=$this->rel_archivo_documento_model->listado_registros_preregistrados_por_sub_tipo_proceso_preregistro($aRegistro["idArchivo"],$aRegistro["idSubTipoProceso"],  $idDireccion_responsable);
        
        $qTipoProceso_preregistro=$this->rel_archivo_documento_model->listado_registros_preregistrados_por_tipo_proceso_preregistro($aRegistro["idArchivo"],$aRegistro["idTipoProceso"],  $idDireccion_responsable);
        
        
        $qSubTipoProceso_recibido=$this->rel_archivo_documento_model->listado_registros_preregistrados_por_sub_tipo_proceso($aRegistro["idArchivo"],$aRegistro["idSubTipoProceso"]);
        
        $qTipoProceso_recibido=$this->rel_archivo_documento_model->listado_registros_preregistrados_por_tipo_proceso($aRegistro["idArchivo"],$aRegistro["idTipoProceso"]);
        
        
        $qSubTipoProceso=$this->rel_archivo_documento_model->listado_registros_recibido_por_sub_tipo_proceso_total($aRegistro["idArchivo"],$aRegistro["idSubTipoProceso"]);
        
        $qTipoProceso=$this->rel_archivo_documento_model->listado_registros_recibido_por_tipo_proceso_total($aRegistro["idArchivo"],$aRegistro["idTipoProceso"]);
        //$str_existe_preregistro ='OK';
        
        $data=array();
        $data["NumSubTipoProceso_recibidos"]=$qSubTipoProceso_recibido->num_rows();
        $data["NumTipoProceso_recibidos"]=$qTipoProceso_recibido->num_rows();
        $data["NumSubTipoProceso_preregistrados"]=$qSubTipoProceso_preregistro->num_rows();
        $data["NumTipoProceso_preregistados"]=$qTipoProceso_preregistro->num_rows();
        $data["idTipoProceso"]=$aRegistro["idTipoProceso"];
        $data["idSubTipoProceso"]=$aRegistro["idSubTipoProceso"];
        
        
        $data["strTipoProceso_preregistrados"]="Preregistrados " . $qTipoProceso_preregistro->num_rows() . " de " . $qTipoProceso->num_rows();
        $data["strSubTipoProceso_preregistrados"]="Preregistrados " . $qSubTipoProceso_preregistro->num_rows() . " de " . $qSubTipoProceso->num_rows();
        
        $data["strTipoProceso_cid"]="Entregados " . $qTipoProceso_recibido->num_rows() . " de " . $qTipoProceso->num_rows();
        $data["strSubTipoProceso_cid"]="Entregados " . $qSubTipoProceso_recibido->num_rows() . " de " . $qSubTipoProceso->num_rows();
        
       
        
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');
        echo json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
    }
            
            
    public function editar_documento_preregistro($id, $idRelDoc_Archivo, $idArchivo) {
        $this->load->model('rel_archivo_documento_model');
        $this->load->model('rel_archivo_preregistro_model');
        
        
        
        //$str_existe_preregistro = $this->existe_preregistro($idRelDoc_Archivo, $this->session->userdata('idDireccion_responsable'));
        
        //if($str_existe_preregistro > 0 )  {
            $datos=array();
            
            $datos['tipo_documento']= $this->input->post("preregistrado");
            if ($this->input->post("preregistrado") == 3){
                $datos['noHojas']= 0;
            }
            if ($this->input->post("preregistrado") == 0){
                $datos['eliminacion_logica']= 1;
            }else{
                $datos['eliminacion_logica']= 0;
            }
            //print_r($datos);
            //$idDireccion_responsable = $this->session->userdata('idDireccion_responsable');
            $this->rel_archivo_preregistro_model->update_registro($datos, $id);
        
       
        
        
        
        
        $aRegistro=$this->rel_archivo_documento_model->datos_relacion_archivo_documento($idRelDoc_Archivo)->row_array();
        
        
        $qSubTipoProceso_recibido=$this->rel_archivo_documento_model->listado_registros_preregistrados_por_sub_tipo_proceso($aRegistro["idArchivo"],$aRegistro["idSubTipoProceso"]);
        
        $qTipoProceso_recibido=$this->rel_archivo_documento_model->listado_registros_preregistrados_por_tipo_proceso($aRegistro["idArchivo"],$aRegistro["idTipoProceso"]);
        
        
        $qSubTipoProceso=$this->rel_archivo_documento_model->listado_registros_recibido_por_sub_tipo_proceso_total($aRegistro["idArchivo"],$aRegistro["idSubTipoProceso"]);
        
        $qTipoProceso=$this->rel_archivo_documento_model->listado_registros_recibido_por_tipo_proceso_total($aRegistro["idArchivo"],$aRegistro["idTipoProceso"]);
        //$str_existe_preregistro ='OK';
        
        $data=array();
        $data["NumSubTipoProceso_preregistrados"]=$qSubTipoProceso_recibido->num_rows();
        $data["NumTipoProceso_preregistrados"]=$qTipoProceso_recibido->num_rows();
        $data["NumSubTipoProceso"]=$qSubTipoProceso->num_rows();
        $data["NumTipoProceso"]=$qTipoProceso->num_rows();
        $data["idTipoProceso"]=$aRegistro["idTipoProceso"];
        $data["idSubTipoProceso"]=$aRegistro["idSubTipoProceso"];
        
        $data["strTipoProceso_preregistrados"]="Preregistrados " . $qTipoProceso_recibido->num_rows() . " de " . $qTipoProceso->num_rows();
        $data["strSubTipoProceso_preregistrados"]="Preregistrados " . $qSubTipoProceso_recibido->num_rows() . " de " . $qSubTipoProceso->num_rows();
        
        $data["str_existe_preregistro"] = $str_existe_preregistro;
        
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');
        echo json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);

        
    }
    
    public function existe_preregistro($idRelDoc_Archivo, $direccion){
        $this->load->model('rel_archivo_preregistro_model');
        
        $query= $this->rel_archivo_preregistro_model->get_relacion_archivo_preregistro($idRelDoc_Archivo, $direccion);
        
        return $query;
    }
    
    
    public function hay_preregistro($idRelDoc_Archivo){
        $this->load->model('rel_archivo_preregistro_model');
        
        
        $query= $this->rel_archivo_preregistro_model->get_relacion_archivo_preregistro_por_relacion($idRelDoc_Archivo);
        
        return $query->num_rows();
    }

    

    public function cargar_identificador($id, $identificador){
        
         $this->load->model('datos_model');
         $data=array(
            'identificado' => $identificador,
            
            );
        $this->datos_model-> datos_archivo_update($data, $id) ;
           

    }
    
    public function cargar_noHojas($idRelacion, $idArchivo, $hojas){
        $this->load->model('rel_archivo_documento_model');
        $this->load->model('rel_archivo_preregistro_model');
        
        $data=array(
            'noHojas' => $hojas,
            
            );
        //$this->rel_archivo_documento_model-> datos_relacion_archivo_documento_update($data, $idRelacion) ;
        
        if ( $this->session->userdata('preregistro') == 0){
            $estado = $this->rel_archivo_preregistro_model->datos_preregistro_update_por_relacion($data, $idRelacion);
        } else {
            $idDireccion_responsable = $this->session->userdata('idDireccion_responsable');
            $estado = $this->rel_archivo_preregistro_model->datos_relacion_archivo_preregistro_update($data, $idDireccion_responsable, $idRelacion) ;
        }
        
        
        $data=array();
        $data["estado"]=$estado;
        
        echo json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
        
        
        
        
    }
    
    
    public function modificar_noHojas($idRelacion, $idArchivo, $hojas, $idRAP){
        $this->load->model('rel_archivo_documento_model');
        $this->load->model('rel_archivo_preregistro_model');
        
        $data=array(
            'noHojas' => $hojas,
            
            );
        
       
        $estado = $this->rel_archivo_preregistro_model->update_registro($data, $idRAP) ;
        
        
        
        
        $data["estado"]=$estado;
        
        echo json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
        
        
        
        
    }

    public function cargar_noHojas_direccion($idRelacion, $idArchivo, $hojas, $direccion){
        $this->load->model('rel_archivo_documento_model');
        $this->load->model('rel_archivo_preregistro_model');
        
        $data=array(
            'noHojas' => $hojas,
            
            );
        //$this->rel_archivo_documento_model-> datos_relacion_archivo_documento_update($data, $idRelacion) ;
        
        
        $idDireccion_responsable = $direccion;
        $this->rel_archivo_preregistro_model-> datos_relacion_archivo_preregistro_update($data, $idDireccion_responsable, $idRelacion) ;
        
        
        
    }
    
    public function editar_estimacion_hojas($idEstimacion, $hojas) {
        $this->load->model('estimaciones_model');
         
        $data=array(
            'noHojas' => $hojas
 
        );
         
         
 
        $this->estimaciones_model->datos_estimaciones_update($data,$idEstimacion);
         
         
         
 
    }
    
    public function cargar_noHojas_preregistro($id, $hojas){
        
        $this->load->model('rel_archivo_preregistro_model');
        
        $data=array(
            'noHojas' => $hojas,
            
            );
       
        $this->rel_archivo_preregistro_model-> update_registro($data, $id) ;
        
        
        
    }
    

    public function cargar_idBloqueObra($id, $bloque){
        
         $this->load->model('datos_model');
         
         $data=array(
            'idBloqueObra' => $bloque,
            
            );
        $this->datos_model-> datos_archivo_update($data, $id) ;
        
        
        
           

    }
    
    public function cargar_estimaciones($idRel, $idArchivo, $noEstimaciones){
       
        $this->load->model('subdocumentos_model');
        $this->load->model('estimaciones_model');
        
        /*
        $noEstimaciones= $this->input->post("no_estimaciones");
        $idRel= $this->input->post("idRel");
        $idArchivo= $this->input->post("idArchivo");
        */
        $estimaciones_existentes = $this->estimaciones_model->estimaciones_existentes($idRel)->num_rows();
        $addw_SubDocumentos= $this->subdocumentos_model->addw_subDocumentos();
        echo "REl: $idRel, Archivo $idArchivo, estimaciones $estimaciones_existentes, estimaciones agregar $noEstimaciones</br>";
        //exit();
        
        for ($i = 0 ; $i < $noEstimaciones;  $i++){
            //traer subdocumentos
            echo 'Entra';
            $qSubDocumentos = $this->subdocumentos_model->listado_subdocumento();
            if (isset($qSubDocumentos)) {
                if ($qSubDocumentos->num_rows() > 0) {
                    
                    foreach ($qSubDocumentos->result() as $rSolicitud) {
                        //insertar en saaEstimaciones con No estimacion, id subdocumento, usuario, rel_archivo_documento
                         $data=array(
                            'Numero_Estimacion' => $estimaciones_existentes + 1,
                            'idSubDocumento' => $rSolicitud->id,
                            'idUsuario' => $this->session->userdata('id'),
                            'idRel_archivo_documento' => $idRel,
                            'ordenar_subdocumento' => $rSolicitud->ordenar_subdocumento,
                        );
                        
                        
                        $retorno = $this->estimaciones_model-> datos_estimaciones_insert($data) ;
                        if($retorno['retorno'] < 0){
                            header("Location:" . site_url('archivo/cambios/'. $idArchivo . 'Error al cargar estimaciones'));
                            exit();
                        }
                    }
                    $estimaciones_existentes++;
                    echo $estimaciones_existentes;
                }
            }
        }
       // exit();
    }
    
    


    public function ver_estimaciones_relacion($idArchivo, $idRel){
        $this->load->model('estimaciones_model');
        $this->load->model('subdocumentos_model');
        
        $preregistro = $this->session->userdata('preregistro');
        $reviso = $this->session->userdata('reviso');
        $idDireccion_responsable = $this->session->userdata('idDireccion_responsable');
        $Direccion_responsable_documento = $this->buscar_responsable_documento($idRel)->row_array();
        //json_encode($Direccion_responsable_documento);
        $responsable = $Direccion_responsable_documento['idDireccion_responsable'];
        
        if ($responsable == 0){
            $direccion = $this->buscar_ejecutora($idArchivo)->row_array();
            $direccion = $direccion['Direccion'];
            $responsable =  $this->buscar_id_ejecutora($direccion)->row_array();
            $responsable = $responsable['id'];
            
            
        }
        //print_r($responsable);
        
        //exit();
        

        $div_estimaciones = "";
        $addw_SubDocumentos= $this->subdocumentos_model->addw_subDocumentos();
        
        //todas las estimaciones
        $qEstimaciones = $this->estimaciones_model->estimaciones_rel_archivo($idRel);
        //$div_estimaciones .= "Est totales" . $qEstimaciones->num_rows();
        //exit();
        $disable_estimacion= "disabled='disabled";
        if($reviso==0){
            $disable_estimacion= "disabled='disabled";
        }
        //numeros de estimaciones
        $estimaciones_existentes = $this->estimaciones_model->estimaciones_existentes($idRel); 
            if ($estimaciones_existentes->num_rows() >0){
                
                //$div_estimaciones .= "EST distintas existen" .$estimaciones_existentes->num_rows()."</br>";
                foreach ($estimaciones_existentes->result() as $estimaciones) { 
                    //$div_estimaciones .= "No est".$estimaciones->Numero_Estimacion."</br>";
            
                    
                    
                    
            $div_estimaciones .='<div class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">

                                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-'. $estimaciones->Numero_Estimacion .'" aria-expanded="true" aria-controls="collapse-'. $estimaciones->Numero_Estimacion .'">

                                                <div class="d-f">

                                                    EST. '. $estimaciones->Numero_Estimacion .'
                                                    <a class="btn btn-danger del_documento" id="eliminar_est" onclick="eliminar_estimacion('. $estimaciones->Numero_Estimacion . ','. $estimaciones->idRel_Archivo_Documento .','.$idArchivo.')" target="_self"><span class="glyphicon glyphicon-remove"></span> Eliminar Estimacion</a>

                                                </div>


                                            </a>

                                        </div>
                                        
                                        <div id="collapse-'. $estimaciones->Numero_Estimacion  .'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-'.$estimaciones->Numero_Estimacion  .'">
                                            <div class="panel-body">';
                                                


                                                 if (isset($qEstimaciones)){ 
                                                            $i=0;
                                                            if ($qEstimaciones->num_rows() >0){
                                                                //$div_estimaciones .= "numero de estimaciones ". $qEstimaciones->num_rows();
                                                                foreach ($qEstimaciones->result() as $rEstimaciones) { 
                                                                    $i++;
                                                                    //$div_estimaciones .= 'Vuelta ' .$i;
                                                                    //$div_estimaciones .= $estimaciones->Numero_Estimacion .'Est No. == Est Relacion'. $rEstimaciones->Numero_Estimacion . ' '.  $rEstimaciones->id ."</br>";
                                                                    $strchecked_revisado=""; 
                                                                    $value_estimaciones= "";
                                                                    $seleccion_estimaciones = "";
                                                                    $disable_estimacion='';
                                                                    
                                                                   
                                                                        
                                                                    if($estimaciones->Numero_Estimacion  == $rEstimaciones->Numero_Estimacion){
                                                                        
                                                                        
                                                                        if ($rEstimaciones->original_recibido==0 && $rEstimaciones->copia==0 && $rEstimaciones->no_aplica==0){
                                                                                $seleccion_estimaciones = "Selecciona una opción";
                                                                                $value_estimaciones = 0;
                                                                                $seleccion_estimaciones1 = "Copia";
                                                                                $value_estimaciones1 = 1;
                                                                                $seleccion_estimaciones2 = "Original";
                                                                                $value_estimaciones2 = 2;
                                                                                $seleccion_estimaciones3 = "No Aplica";
                                                                                $value_estimaciones3 = 3;
                                                                        }
                                                                        
                                                                        if ($rEstimaciones->original_recibido==1){
                                                                                $seleccion_estimaciones = "Original";
                                                                                $value_estimaciones = 2;
                                                                                $seleccion_estimaciones1 = "Copia";
                                                                                $value_estimaciones1 = 1;
                                                                                
                                                                                $seleccion_estimaciones2 = "No Aplica";
                                                                                $value_estimaciones2 = 3;
                                                                                $seleccion_estimaciones3 = "Selecciona una opcion";
                                                                                $value_estimaciones3 = 0;
                                                                        }
                                                                        
                                                                        if ($rEstimaciones->copia==1){
                                                                                $seleccion_estimaciones = "Copia";
                                                                                $value_estimaciones = 1;
                                                                                $seleccion_estimaciones1 = "Original";
                                                                                $value_estimaciones1 = 2;
                                                                                $seleccion_estimaciones2 = "No Aplica";
                                                                                $value_estimaciones2 = 3;
                                                                                $seleccion_estimaciones3 = "Selecciona una opcion";
                                                                                $value_estimaciones3 = 0;
                                                                        }
                                                                        
                                                                        if ($rEstimaciones->no_aplica==1){
                                                                            $seleccion_estimaciones = "No aplica";
                                                                            $value_estimaciones = 3;
                                                                            $seleccion_estimaciones1 = "Original";
                                                                            $value_estimaciones1 = 2;
                                                                            $seleccion_estimaciones2 = "Copia";
                                                                            $value_estimaciones2 = 1;
                                                                            $seleccion_estimaciones3 = "Selecciona una opcion";
                                                                            $value_estimaciones3 = 0;
                                                                        }
                                                                        
                                                               
   
                                               $div_estimaciones .='<div class="row">
                                                                        <div class="col-md-5">
                                                                            <h5> EST. '. $rEstimaciones->Numero_Estimacion .' - ' .$addw_SubDocumentos[$rEstimaciones->idSubDocumento] .'</h5>

                                                                        </div> 
                                                                        
                                                                        <div class="col-md-2">
                                                                           
   
                                                                            <select class="form-control m-b" name="tipo_documento_est'.$rEstimaciones->id .'" id="tipo_documento_est'.$rEstimaciones->id .'" onchange="uf_recibir_tipo_estimacion('. $rEstimaciones->id .')" >
                                                                                <option value="'.$value_estimaciones .'" id="select" name="select">'. $seleccion_estimaciones .'</option>

                                                                                <option id="tipo_documento_est'.$rEstimaciones->id .'" name="tipo_documento_est'.$rEstimaciones->id .'" value="'.$value_estimaciones1 .'">'. $seleccion_estimaciones1 .'</option>
                                                                                <option id="tipo_documento_est'.$rEstimaciones->id .'" name="tipo_documento_est'.$rEstimaciones->id .'" value="'.$value_estimaciones2 .'">'. $seleccion_estimaciones2 .'</option>
                                                                                <option id="tipo_documento_est'.$rEstimaciones->id .'" name="tipo_documento_est'.$rEstimaciones->id .'" value="'.$value_estimaciones3 .'">'. $seleccion_estimaciones3 .'</option>
                                                                             </select>
   
                                                                          
                                                                        </div>
                                                                        
                                                                        <div class="col-md-2">
                                                                            <div class="">
                                                                                <label class="sr-only" for="exampleInputEmail3">No. Hojas</label>
                                                                                <input type="number" class="form-control" id="noHojas_est_'.$rEstimaciones->id .'" name="noHojas_est_'.$rEstimaciones->id .'" placeholder="No Hojas" value="" onchange="cargar_noHojas_estimaciones('.$rEstimaciones->id .')" min="0">
                                                                            </div>

                                                                        </div>
                                                                                
                                                                        <div class="col-md-2">
                                                                            <a href="#observaciones_bloque" id="btn-ver-obs"  data-toggle="modal" title="Ver Observaciones" class="btn btn-default btn-sm" data-target="#observaciones_estimaciones" title="Observaciones" role="button" onclick="ver_observaciones_estimacion(' . $idArchivo .','.  $rEstimaciones->id .','.  $preregistro .')">
                                                                                <span class="glyphicon glyphicon-search"></span>
                                                                            </a>
                                                                            <a href="#" id="btn-agregar-obs"  data-toggle="modal" title="Agregar observaciones" data-target="#observacion_estimacion" role="button" class="btn btn-warning btn-sm" onclick="uf_agregar_observaciones_estimacion('. $rEstimaciones->id .' , ' .$idDireccion_responsable .' , ' .$responsable  .')">
                                                                                <span class="glyphicon glyphicon-list"></span>
                                                                            </a>


                                                                        </div>';
                                                                        
                                                                        if($reviso ==1 ){
                                                                            $disable_estimacion= "";
                                                                        } else {
                                                                            $disable_estimacion= "disabled = 'disabled'";
                                                                        }
                                                                        
                                                $div_estimaciones .=    '<div class="col-md-1" >
                                                                            <div class="checkbox-inline">
                                                                                <label><input name="Est_revisado'. $rEstimaciones->id .'" type="checkbox"   id="Est_revisado'. $rEstimaciones->id .'"  onclick="uf_revisado_estimacion(this,'.$rEstimaciones->id .')"  '.$strchecked_revisado . ' ' . $disable_estimacion.'>Revisado</label>
                                                                            </div>

                                                                        </div> 
                                                                          
                                                                        
   
                                                                    </div> <!--Fin row mb separacion-->
                                                                    <hr>';
                                                                      
                                                                    
                                                                       
                                                                       
                                                                    
                                                                                  }              
                                                                              }
                                                                          }
                                                                                                   
                                                                      } //if $qEstimaciones
                                                                   
                                                                  
                                                                      
                                   $div_estimaciones .=    '</div>   <!-- panel body-->
                                                              </div> <!-- panel collapse-->
                                                           
                                                               
                                                          </div>
                                                      </div>';
                                               
                                
                                                    } //foreach
                                                } 
                                            
                                            
          

               
        
        
        $data=array();
        $data["estimaciones"]=$div_estimaciones;
                          
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');
        echo json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);  
        //$output =     $div_estimaciones;   
         //echo json_encode($output, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);  
        
                                                     
                                           
        //header("Location:" . site_url('archivo/cambios/'. $idArchivo));
        
    }
    
    public function buscar_responsable_documento($idRel){
        $this->load->model('datos_model');
        return $this->datos_model->buscar_responsable_documento($idRel);
    }
    
    public function buscar_ejecutora($idArchivo){
        $this->load->model('datos_model');
        return $this->datos_model->buscar_ejecutora($idArchivo);
    }
    
    public function buscar_id_ejecutora($direccion){
        $this->load->model('datos_model');
        return $this->datos_model->buscar_id_ejecutora($direccion);
    }

    public function eliminar_estimacion($no_estimacion, $relacion){
        $msj = "";
        $this->load->model('estimaciones_model');
        
        $no_documentos = $this->estimaciones_model->get_no_documentos($relacion, $no_estimacion);
        
        if ($no_documentos > 0){
            $msj = 0;
        } else {
            $this->estimaciones_model->eliminar_estimacion($relacion, $no_estimacion);
            $msj = 1;
        }
        
        echo $msj;
        
        
    }

    

    public function edit_ubicacion_fisica($idArchivo,$idProceso) {
        $this->load->model('rel_archivo_documento_model');
        $data=array();
        $data["Ubicacion_fisica"]= $this->input->post("Ubicacion_fisica");
        //$data["idUsuario_ubicacion"]=  $this->session->userdata('id');
        
        $this->rel_archivo_documento_model->datos_relacion_archivo_documento_update_por_proceso($data,$idArchivo,$idProceso);
        
     }    
    
    public function edit_folio_desde($idArchivo,$idProceso) {
        $this->load->model('rel_archivo_documento_model');
        $data=array();
        $data["Folio_Desde"]= $this->input->post("folio_desde");
        //$data["idUsuario_ubicacion"]=  $this->session->userdata('id');
        
        $this->rel_archivo_documento_model->datos_relacion_archivo_documento_update_por_proceso($data,$idArchivo,$idProceso);
        
     }  
     
    
    public function edit_folio_hasta($idArchivo,$idProceso) {
        $this->load->model('rel_archivo_documento_model');
        $data=array();
        $data["Folio_Hasta"]= $this->input->post("folio_hasta");
        //$data["idUsuario_ubicacion"]=  $this->session->userdata('id');
        
        $this->rel_archivo_documento_model->datos_relacion_archivo_documento_update_por_proceso($data,$idArchivo,$idProceso);
        
    }  
     
    
    public function edit_original_recibio($idRelDoc_Archivo) {
        $this->load->model('rel_archivo_documento_model');
        
        $data=array();
        
        
        $data["original_recibido"]= $this->input->post("original_recibido");
        
        $this->rel_archivo_documento_model->datos_relacion_archivo_documento_update($data,$idRelDoc_Archivo);
        
    }
    
    public function edit_original_recibido_estimacion($idEstimacion, $check) {
        $this->load->model('estimaciones_model');
        
        $data=array();
        
        
        $data["original_recibido"]= $check;
        
        
        $this->estimaciones_model->datos_estimaciones_update($data,$idEstimacion);
        
    }
    
    public function edit__revisado_estimacion($idEstimacion, $check) {
        $this->load->model('estimaciones_model');
        
        $data=array();
        
        
        $data["revisado"]= $check;
        
        
        $this->estimaciones_model->datos_estimaciones_update($data,$idEstimacion);
        
       
        
    }
    
    
    
     public function edit_original_revisado($idRelDoc_Archivo) {
        $this->load->model('rel_archivo_documento_model');
        
        $data=array();
        
        
        $data["original_revisado"]= $this->input->post("original_revisado");
        
        $this->rel_archivo_documento_model->datos_relacion_archivo_documento_update($data,$idRelDoc_Archivo);
        
       
        
    }
    
    
    
    
    public function edit_revisado($id ,$idRelDoc_Archivo) {
        $this->load->model('datos_model');
        $this->load->model('rel_archivo_documento_model');
        $this->load->model('rel_archivo_preregistro_model');
        
        $data=array();
        
        
        $data["revisado"]= $this->input->post("revisado");
        $data["idUsuario_revisado"]=  $this->session->userdata('id');
        if ($data["revisado"]==0){
           $data["revisado"]=0; 
        }else{
        $data["revisado"]=  1;
        
        }
        
        if ( $data["revisado"]==  1){
            $qRevisado = $this->rel_archivo_documento_model->traer_revisado($idRelDoc_Archivo);

            if ($qRevisado->num_rows() > 0){
                foreach ($qRevisado->result() as $rRevisado){
                    $revisado = $rRevisado->revisado ;
                }
            }
        } else{
            $revisado ="";
        }
      
        
        
        if($revisado == 0 || $data["revisado"]==  0 ){
            
            
            
            $this->rel_archivo_preregistro_model->update_registro($data,$id);
            if($revisado == 0){
                $data["id_preregistro"]= $id;
            }
            if ( $data["revisado"]==  0){
                $data["id_preregistro"]= 0;
            }
            $this->rel_archivo_documento_model->datos_relacion_archivo_documento_update($data,$idRelDoc_Archivo);

            $aRegistro=$this->rel_archivo_documento_model->datos_relacion_archivo_documento($idRelDoc_Archivo)->row_array();


            $qSubTipoProceso_revisados=$this->datos_model->listado_registros_revisados_por_sub_tipo_proceso($aRegistro["idArchivo"],$aRegistro["idSubTipoProceso"]);

            $qTipoProceso_revisados=$this->datos_model->listado_registros_revisados_por_tipo_proceso($aRegistro["idArchivo"],$aRegistro["idTipoProceso"]);


            $qSubTipoProceso=$this->rel_archivo_documento_model->listado_registros_revisados_por_sub_tipo_proceso_total($aRegistro["idArchivo"],$aRegistro["idSubTipoProceso"]);

            $qTipoProceso=$this->rel_archivo_documento_model->listado_registros_revisados_por_tipo_proceso_total($aRegistro["idArchivo"],$aRegistro["idTipoProceso"]);


            $data=array();
            $data["NumSubTipoProceso_revisado"]=$qSubTipoProceso_revisados->num_rows();
            $data["NumTipoProceso_revisado"]=$qTipoProceso_revisados->num_rows();
            $data["NumSubTipoProceso"]=$qSubTipoProceso->num_rows();
            $data["NumTipoProceso"]=$qTipoProceso->num_rows();
            $data["idTipoProceso"]=$aRegistro["idTipoProceso"];
            $data["idSubTipoProceso"]=$aRegistro["idSubTipoProceso"];
            $data["Revision"]= $revisado;

            $data["strTipoProceso_revisado"]="Revisados " . $qTipoProceso_revisados->num_rows() . " de " . $qTipoProceso->num_rows();
            $data["strSubTipoProceso_revisado"]="Revisados " . $qSubTipoProceso_revisados->num_rows() . " de " . $qSubTipoProceso->num_rows();

            
        } else {
            $data=array();
            $data["Revision"]= $revisado;
        }
        
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');
        echo json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);

    }
    
    public function edit_recibido_cid($id, $idRelDoc_Archivo) {
        $this->load->model('rel_archivo_documento_model');
        $this->load->model('datos_model');
        $this->load->model('rel_archivo_preregistro_model');
        
        $data=array();
        
        
        $data["recibido_cid"]= $this->input->post("recibido_cid");
        $data["idUsuario_recibe"]= $this->session->userdata("id");
        
        
        $this->rel_archivo_preregistro_model->update_registro($data, $id);
        
        
        $aRegistro=$this->rel_archivo_documento_model->datos_relacion_archivo_documento($idRelDoc_Archivo)->row_array();
        
        
        $qSubTipoProceso_recibido=$this->datos_model->documentos_subproceso($aRegistro["idArchivo"], $aRegistro["idSubTipoProceso"]);
        
        $qTipoProceso_recibido=$this->datos_model->documentos_proceso_recibidos($aRegistro["idArchivo"],$aRegistro["idTipoProceso"]);
        
        $qSubTipoProceso=$this->rel_archivo_documento_model->listado_registros_recibido_por_sub_tipo_proceso_total($aRegistro["idArchivo"],$aRegistro["idSubTipoProceso"]);
        
        $qTipoProceso=$this->rel_archivo_documento_model->listado_registros_recibido_por_tipo_proceso_total($aRegistro["idArchivo"],$aRegistro["idTipoProceso"]);
        
        $qTipoProceso_distinct=$this->datos_model->documentos_proceso_distinct($aRegistro["idArchivo"],$aRegistro["idTipoProceso"]);
        
        $datos=array(
            "NumSubTipoProceso_recibido" => $qSubTipoProceso_recibido->num_rows(),
            "NumTipoProceso_recibido" => $qTipoProceso_recibido->num_rows(),
            "NumSubTipoProceso" =>  $qSubTipoProceso->num_rows(),
            "NumTipoProceso" => $qTipoProceso->num_rows(),
            "idTipoProceso" => $aRegistro["idTipoProceso"],
            "idSubTipoProceso" => $aRegistro["idSubTipoProceso"],
            "TipoProceso_distinct" =>$qTipoProceso_distinct->num_rows(),

            "strTipoProceso_recibido" => "Recibidos " . $qTipoProceso_recibido->num_rows() . " de " . $qTipoProceso->num_rows(),
            "strSubTipoProceso_recibido" => "Recibidos " . $qSubTipoProceso_recibido->num_rows() . " de " . $qSubTipoProceso->num_rows()
        );
        
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');
        
        
        echo json_encode($datos);
        
       // var_dump(json_decode($datos, true));

        
    }
    
    
    
    public function total_documentos_revisados($idArchivo,$idTipoProceso,$idSubTipoProceso) {
        $this->load->model('rel_archivo_documento_model');
        
     
        
        
        $qSubTipoProceso_revisados=$this->rel_archivo_documento_model->listado_registros_revisados_por_sub_tipo_proceso($idArchivo,$idSubTipoProceso);
        
        $qTipoProceso_revisados=$this->rel_archivo_documento_model->listado_registros_revisados_por_tipo_proceso($idArchivo,$idTipoProceso);
        
        
        $qSubTipoProceso=$this->rel_archivo_documento_model->listado_registros_revisados_por_sub_tipo_proceso_total($idArchivo,$idSubTipoProceso);
        
        $qTipoProceso=$this->rel_archivo_documento_model->listado_registros_revisados_por_tipo_proceso_total($idArchivo,$idTipoProceso);
    
        
        $data=array();
        $data["NumSubTipoProceso_revisado"]=$qSubTipoProceso_revisados->num_rows();
        $data["NumTipoProceso_revisado"]=$qTipoProceso_revisados->num_rows();
        $data["NumSubTipoProceso"]=$qSubTipoProceso->num_rows();
        $data["NumTipoProceso"]=$qTipoProceso->num_rows();
        $data["idTipoProceso"]=$aRegistro["idTipoProceso"];
        $data["idSubTipoProceso"]=$aRegistro["idSubTipoProceso"];
        
        $data["strTipoProceso_revisado"]="Revisados " . $qTipoProceso_revisados->num_rows() . " de " . $qTipoProceso->num_rows();
        $data["strSubTipoProceso_revisado"]="Revisados " . $qSubTipoProceso_revisados->num_rows() . " de " . $qSubTipoProceso->num_rows();
        
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');
        echo json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
        
    }
    

    
    public function total_documentos_recibidos($idArchivo,$idTipoProceso,$idSubTipoProceso) {
       
              
        
        
        $qSubTipoProceso_recibido=$this->rel_archivo_documento_model->listado_registros_recibido_por_sub_tipo_proceso($idArchivo,$idSubTipoProceso);
        
        $qTipoProceso_recibido=$this->rel_archivo_documento_model->listado_registros_recibido_por_tipo_proceso($idArchivo,$idTipoProceso);
        
        
        $qSubTipoProceso=$this->rel_archivo_documento_model->listado_registros_recibido_por_sub_tipo_proceso_total($idArchivo,$idSubTipoProceso);
        
        $qTipoProceso=$this->rel_archivo_documento_model->listado_registros_recibido_por_tipo_proceso_total($idArchivo,$idTipoProceso);
    
        
        $data=array();
        $data["NumSubTipoProceso_recibido"]=$qSubTipoProceso_recibido->num_rows();
        $data["NumTipoProceso_recibido"]=$qTipoProceso_recibido->num_rows();
        $data["NumSubTipoProceso"]=$qSubTipoProceso->num_rows();
        $data["NumTipoProceso"]=$qTipoProceso->num_rows();
        $data["idTipoProceso"]=$aRegistro["idTipoProceso"];
        $data["idSubTipoProceso"]=$aRegistro["idSubTipoProceso"];
        
        $data["strTipoProceso_recibido"]="Recibidos " . $qTipoProceso_recibido->num_rows() . " de " . $qTipoProceso->num_rows();
        $data["strSubTipoProceso_recibido"]="Recibidos " . $qSubTipoProceso_recibido->num_rows() . " de " . $qSubTipoProceso->num_rows();
        
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');
        echo json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);


        
        
        
    }
    
    
    
    public function edit_archivo($action = null) {
        if($action == 1){//modificacion datos del archivo
            if($this->input->post("FechaIniciaVigenciaa")) {
                $fechaV = $this->input->post("FechaIniciaVigenciaa");
                $vigencia = 0;
            }else{
                $fechaV = $this->input->post("FechaIniciaVigencia");
                $vigencia = 1;
            }

            $data = array(
                'idUsuario' => $this->input->post("id_user"),
                'OrdenTrabajo' => $this->input->post("OrdenTrabajo"),
                'Contrato' => $this->input->post("Contrato"),
                'Obra' => $this->input->post("Obra"),
                'Descripcion' => $this->input->post("Descripcion"),
                'idTipo_archivo' => $this->input->post("idTipo_archivo"),//Continuar con la captura de tipo d earchivo
                'idTamano_normalizado' => $this->input->post("idTamano_normalizado"),//Continuar con la captura de tipo d earchivo
                'idTipo_unidad' => $this->input->post("idTipo_unidad"),
                'idTitularidad' => $this->input->post("idTitularidad"),
                'idDireccion' => $this->input->post("idDireccion"),
                'FondodePrograma' => $this->input->post("FondodePrograma")
            );
            $id_archivo = $this->input->post("id");
            $retorno = $this->datos_model->updateArchivo($data, $id_archivo);
            
            redirect(isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : 'archivo');
            
        }else if($action == 2){//Nueva categoria de documento y carga de documentos para tal.
            
            if ($this->input->post('idsdocs')){
                $idArchi = $this->input->post('idArchivo');
                $idsdocs = $this->input->post('idsdocs');
                $idEjercicio = $this->input->post('idEjercicio');
                
                foreach($this->input->post('idsdocs') as $iddoc) {
                    
                    $idRel = $this->datos_model->crear_relacion($idArchi, $iddoc);
                    $total = count($_FILES['docfile'.$iddoc]['name']);
                    
                    for($i=0; $i<$total; $i++) {
                        // Convertir el archivo en cadena
                        if($_FILES['docfile'.$iddoc]['tmp_name'][$i]){
                            $filen = $_FILES['docfile'.$iddoc]['tmp_name'][$i];                        
                            $trozos = explode(".", $_FILES['docfile'.$iddoc]["name"][$i]);                        
                            $extension = '.'.end($trozos);

                            $nom = $_FILES['docfile'.$iddoc]['name'][$i];
                            $mime = $_FILES['docfile'.$iddoc]['type'][$i];
                            $Datos = file_get_contents($_FILES['docfile'.$iddoc]['tmp_name'][$i]);
                            $firma = sha1($Datos);

                            // Cargar documento
                            $data_adjunto = array();
                            $data_adjunto["idRel_Archivo_Documento"] = $idRel;
                            $data_adjunto["Tipo"] = 'Anexos';
                            $data_adjunto["Numero2"] = ' Numero';
                            $data_adjunto["Descripcion"] = 'Descripcion'; //$this->input->post('Descripcion')
                            $data_adjunto["FechaHora"] = date('Y-m-d G:i:s');
                            $data_adjunto["Mime"] = $mime;
                            $data_adjunto["Estatus"] = 10;
                            $data_adjunto["Extension"] = $extension;
                            $data_adjunto["Datos"] = base64_encode(bzcompress($Datos));
                            $data_adjunto["Firma"] = $firma;
                            $data_adjunto["nombrearchivo"] = $nom;

                            if($this->datos_model->agregar_documento_digital($data_adjunto, $idEjercicio)){
                                $data_a = array('Estatus' => 10);
                                $resp = $this->datos_model->update_relacion($data_a, $idRel);
                            }
                            unlink($filen);
                        }
                    }
                }
                redirect(isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : 'archivo');
            }else{
                redirect(isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : 'archivo');
            }
            
        }else if($action == 3){//Nueva carga de Documentos segun categoria seleccionada.
            
           
             if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                $idArchi = $this->input->post('idArchivo_anexo');
                $idEjercicio = $this->input->post('idEjercicio_anexo');
                $idTpDoc = $this->input->post('idDocumento_anexo');
                $idProceso = $this->input->post('idProceso_anexo');
                $idSubProceso = $this->input->post('idSubProceso_anexo');
                
                $Documento = '';
                if($this->input->post('Es_Estimacion') == 1){
                    $Es_Estim = 1;
                    $Numero_Estimacion = $this->input->post('Numero_Estimacion');
                    $Documento = $this->input->post('Documento_est');
                }else{
                    $Es_Estim = 0;
                    $Numero_Estimacion = 0;
                }
                if($this->input->post('Es_Prorroga') == 1){
                    $Es_Prorr = 1;
                    $Numero_Prorroga = $this->input->post('Numero_Prorroga');
                    $Documento = $this->input->post('Documento_prorr');
                }else{
                    $Es_Prorr = 0;
                    $Numero_Prorroga = 0;
                }
                    
                $idSubDocumento=$this->input->post('idSubDocumento_mod');
                
                    //$idRel = $this->datos_model->crear_relacion($idArchi, $idTpDoc);
                    $total = count($_FILES['docfile']['name']);
                    
                    
                    
                    for($i=0; $i<$total; $i++) {
                        
                      

                        // Convertir el archivo en cadena
                        if($_FILES['docfile']['tmp_name'][$i]){
                            
                              
                            
                            $filen = $_FILES['docfile']['tmp_name'][$i];                        
                            $trozos = explode(".", $_FILES['docfile']["name"][$i]);                        
                            $extension = '.'.end($trozos);

                            $nom = $_FILES['docfile']['name'][$i];
                            $mime = $_FILES['docfile']['type'][$i];
                            $Datos = file_get_contents($_FILES['docfile']['tmp_name'][$i]);
                            $firma = sha1($Datos);

                           
                             
                            
                            
                            // Cargar documento
                            $data_adjunto = array();
                            $data_adjunto["idRel_Archivo_Documento"] = $idTpDoc;
                            $data_adjunto["Tipo"] = 'Anexos';
                            $data_adjunto["Numero"] = ' Numero';
                            //$data_adjunto["Descripcion"] = 'Descripcion'; //$this->input->post('Descripcion')
                            $data_adjunto["FechaHora"] = date('Y-m-d G:i:s');
                            $data_adjunto["Mime"] = $mime;
                            $data_adjunto["Estatus"] = 10;
                            $data_adjunto["Extension"] = $extension;
                            $data_adjunto["Datos"] = base64_encode(bzcompress($Datos));
                            $data_adjunto["Firma"] = $firma;
                            $data_adjunto["nombrearchivo"] = $nom;
                            $data_adjunto["Es_Estimacion"] = $Es_Estim;
                            $data_adjunto["Numero_Estimacion"] = $Numero_Estimacion;
                            //$data_adjunto["Documento"] = $Documento;
                            $data_adjunto["Es_Prorroga"] = $Es_Prorr;
                            $data_adjunto["Numero_Prorroga"] = $Numero_Prorroga;
                            $data_adjunto["idSubDocumento"] = $idSubDocumento;
                            
                            
                          
                            
                            if($this->datos_model->agregar_documento_digital($data_adjunto, $idEjercicio)){
                                $data_a = array('Estatus' => 10);
                                $resp = $this->datos_model->update_relacion($data_a, $idRel);
                            }
                            unlink($filen);
                        }
                    }
                //redirect(site_url("archivo/estado_de_carga/".$idArchi."/".$idTpDoc."/".$idEjercicio));
                //redirect(isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : 'archivo');
                header("Location:" . site_url('archivo/cambios/'. $idArchi.'/'.$idProceso.'/'.$idSubProceso.'/'.$idTpDoc.'/'.$Numero_Estimacion.'#section_'.$idTpDoc));
            }else{
                //redirect(isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : 'archivo');
                header("Location:" . site_url('archivo/cambios/'. $idArchi.'/'.$idProceso.'/'.$idSubProceso.'/'.$idTpDoc.'#section_'.$idTpDoc));
            }
        }else if($action == 4){// Definicion de la Ubicacion Fisica de la categoria 
             
            $idArchi = $this->input->post('idArchivo');
            $idTpDoc = $this->input->post('idTpDocub');
            $idProceso = $this->input->post('idProceso_uf');
            $idSubProceso = $this->input->post('idSubProceso_uf');
            
            $idRel = $this->datos_model->verifica_relacion($idArchi, $idTpDoc);
            
            if(!$idRel){
                $idRel = $this->datos_model->crear_relacion($idArchi, $idTpDoc);
                $data_a = array('Estatus' => 10);
                $resp = $this->datos_model->update_relacion($data_a, $idRel);
            }
             
            $data = array(
                'idRel_Archivo_Documento' => $idRel,
                'Columna' => $this->input->post("Columna"),
                'Fila' => $this->input->post("Fila"),
                'Carpeta' => $this->input->post("Carpeta"),
                'Metadato' => $this->input->post("Metadato")
            );
            
            $relaciones_archivo = $this->datos_model->get_relacion_id_archivo($idArchi);
            $indicador = 0;
            foreach ($relaciones_archivo->result() as $relacion_archivo){
                $ubic_rel = $this->datos_model->getUbicacionFisica($relacion_archivo->id);
                if($ubic_rel){
                    $indicador++;
                }
            }
            if($indicador == 0){
                
                foreach ($relaciones_archivo->result() as $relacion_archivo){
                    $dataG = array(
                        'idRel_Archivo_Documento' => $relacion_archivo->id,
                        'Columna' => $this->input->post("Columna"),
                        'Fila' => $this->input->post("Fila"),
                        'Carpeta' => $this->input->post("Carpeta"),
                        'Metadato' => $this->input->post("Metadato")
                    );
                    $ubic_rel = $this->datos_model->getUbicacionFisica($relacion_archivo->id);
                    if($ubic_rel){
                        $ubic = $ubic_rel->row();
                        $result = $this->datos_model->update_Ubicaciones_fisicas_individuales($dataG, $ubic->id);
                    }else{
                        $result = $this->datos_model->crear_Ubicaciones_fisicas_individuales($dataG);
                    }
                }
                $data_a = array(
                        'Columna' => $this->input->post("Columna"),
                        'Fila' => $this->input->post("Fila"),
                        'Carpeta' => $this->input->post("Carpeta"),
                        'Metadato' => $this->input->post("Metadato")
                    );
                
                $resp = $this->datos_model->updateArchivo($data_a, $idArchi);
                
            }else{
                $ubic_rel = $this->datos_model->getUbicacionFisica($idRel);
                if($ubic_rel){
                    $ubic = $ubic_rel->row();
                    $result = $this->datos_model->update_Ubicaciones_fisicas_individuales($data, $ubic->id);
                }else{
                    $result = $this->datos_model->crear_Ubicaciones_fisicas_individuales($data);
                }
            }
            
            //redirect(isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : 'archivo');
            
            header("Location:" . site_url('archivo/cambios/'. $idArchi.'/'.$idProceso.'/'.$idSubProceso.'/'.$idTpDoc.'/-1'.'#section_'.$idTpDoc));
            
        }else if($action == 5){ // Definicion del Estatus de la Categoria y Titulaeidad
            
            $idArchi = $this->input->post('idArchivo');
            $idTpDoc = $this->input->post('idTpDocuest');
            $idProceso = $this->input->post('idProceso_est');
            $idSubProceso = $this->input->post('idSubProceso_est');
            
            $idRel = $this->datos_model->verifica_relacion($idArchi, $idTpDoc);
            if($idRel){
                //$idRel = $this->datos_model->crear_relacion($idArchi, $idTpDoc);
                $data = array(
                    'Estatus' => $this->datos_model->get_id_estatus($this->input->post("idEstatus")),
                    'idTitularidad' => $this->input->post("idTitularidad")
                );
                $resp = $this->datos_model->update_relacion($data, $idRel);
            }
            //redirect(isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : 'archivo');
            header("Location:" . site_url('archivo/cambios/'. $idArchi.'/'.$idProceso.'/'.$idSubProceso.'/'.$idTpDoc.'/-1'.'#section_'.$idTpDoc));
            
        }else if($action == 6){// Definicion de la Ubicaicon Global del Archivo (Proceso Eliminado en el sistema )
                $idArchi = $this->input->post('idArchivo');
                
                $data = array(
                    'UbicacionGlobal' => 1,
                    'Columna' => $this->input->post('Columna'),
                    'Fila' => $this->input->post('Fila'),
                    'Carpeta' => $this->input->post('Carpeta'),
                    'Metadato' => $this->input->post('Metadato')
                );
                
                if($this->datos_model->updateArchivo($data, $idArchi)){
                    $relaciones_archivo = $this->datos_model->get_relacion_id_archivo($idArchi);
                    foreach ($relaciones_archivo->result() as $relacion_archivo){
                        $dataUb = array(
                               'idRel_Archivo_Documento' => $relacion_archivo->id,
                               'Columna' => $this->input->post('Columna'),
                               'Fila' => $this->input->post('Fila'),
                               'Carpeta' => $this->input->post('Carpeta'),
                               'Metadato' => $this->input->post('Metadato')
                            );
                        $ubic_rel = $this->datos_model->getUbicacionFisica($relacion_archivo->id);
                        if($ubic_rel){
                            //$ubic = $ubic_rel->row();
                            //$result = $this->datos_model->update_Ubicaciones_fisicas_individuales($dataUb, $ubic->id);
                        }else{
                            $result = $this->datos_model->crear_Ubicaciones_fisicas_individuales($dataUb);
                        }
                    }
                }
                redirect(isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : 'archivo');

        }else{
            redirect(isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : 'archivo');
        }
        
    }
    
    public function estado_de_carga($id_archivo = null, $idTpDoc = null, $idEjercicio = null){
        
        //$data["Archivo"] = $this->datos_model->datos_Archivo($id_archivo)->row_array();
        $data["idArchivo"] = $id_archivo;
        $data["idEjercicio"] = $idEjercicio;
        list($idSP, $NSP, $idP, $NP, $NomDoc) = $this->datos_model->get_proceso_suproc($idTpDoc);
        $data["idTpDoc"] = $idTpDoc;
        $data["idSubProceso"] = $idSP;
        $data["idProceso"] = $idP;
        $data["NomDocumento"] =  $NomDoc;
        $data["NomProcesos"] =  $NP;
        $data["NomSubProcesos"] =  $NSP;
        $data["Titularidades"] = $this->datos_model->get_Titularidades_select();
        $data["Estatus_select"] = $this->datos_model->get_Estatus_select();
        //$data["Historia_Doc"] = $this->datos_model->get_Historia_tpDoc($id_archivo, $idTpDoc, $idEjercicio);
        
        $this->load->view('v_estados_carga_documentos.php', $data);
    }
    
    public function ubicacion_global($idArchivo = null){
        $idArchivo = $_POST['idArchivo'];
        $archivo = $this->datos_model->verifica_ubicacion_global($idArchivo);
        $data = array();
        if($archivo){
            $arch = $archivo->row();
            $data['Estado'] = 'Sin Ubicacion Global';
            if($arch->UbicacionGlobal == 1){
                $data['Estado'] = 'Ubicacion global';
            }
            $data['Columna'] = $arch->Columna;
            $data['Fila'] = $arch->Fila;
            $data['Carpeta'] = $arch->Carpeta;
            $data['Metadato'] = $arch->Metadato;
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
        }else{
            echo 'Sin Relacion';
        }
    }
    
    public function ubicacion($idArchivo = null, $idTpDoc = null){
        $idArchivo = $_POST['idArchivo'];
        $idTpDoc = $_POST['idTpDoc'];
        $accion = $this->datos_model->verifica_relacion($idArchivo, $idTpDoc);
        $data = array();
        if($accion){
            $ubicacion = $this->datos_model->getUbicacionFisica($accion);
            foreach ($ubicacion->result() as $row ){
                $data['Columna'] = $row->Columna;
                $data['Fila'] = $row->Fila;
                $data['Carpeta'] = $row->Carpeta;
                $data['Metadato'] = $row->Metadato;
            }
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
        }else{
            echo 'Sin Relacion';
        }
    }
    
    public function Tipo_Documento($idTpDoc = null){
        $idTpDoc = $_POST['idDoc'];
        $doc = $this->datos_model->doc_id($idTpDoc);
        $data = array();
        if($doc){
            if($doc->num_rows() > 0){
                foreach ($doc->result() as $row ){
                    $data['Es_Estimacion'] = $row->Es_Estimacion;
                    $data['Es_Prorroga'] = $row->Es_Prorroga;
                }
            }else{
                $data['Es_Estimacion'] = 0;
                $data['Es_Prorroga'] = 0;
            }
            
        }else{
            $data['Es_Estimacion'] = 0;
            $data['Es_Prorroga'] = 0;
        }
        
        $subdocs = $this->datos_model->subdocs_idDoc($idTpDoc);
        $SubDocselect = $this->datos_model->get_SubDocs_idDoc_select($idTpDoc);
        $data['SubDocs'] = $subdocs;
        $data['SubDocselect'] = $SubDocselect;
        
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
    }

    public function estatus($idArchivo = null, $idTpDoc = null){
        $idArchivo = $_POST['idArchivoo'];
        $idTpDoc = $_POST['idTpDocc'];
        
        $accion = $this->datos_model->verifica_relacion($idArchivo, $idTpDoc);
        $data = array();
        if($accion){
            $ubicacion = $this->datos_model->get_estatus_rel_id($accion);
            if($ubicacion){
                foreach ($ubicacion->result() as $row ){
                    $idEst = $this->datos_model->get_estatus_Est($row->Estatus);
                    if($idEst == false){
                        $idEst = 0;
                    }
                    $data['Estatus'] = $row->Estatus;
                    $data['idEstatus'] = $idEst;
                    $data['idTitularidad'] = $row->idTitularidad;
                }
            }
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
        }else{
            //echo 'Sin Relacion';
        }
    }
    
    public function agregar_archivo(){
        if (isset($_REQUEST['Proyecto'])) { 
             $proyecto=1; 
             
         }  
         else { 
             $proyecto=0; 
             
         } 
        $data = array(
                'idUsuario' => $this->session->userdata("id"),
                'OrdenTrabajo' => $this->input->post("OrdenTrabajo"),
                'Contrato' => $this->input->post("Contrato"),
                'Obra' => $this->input->post("Obra"),
                'Descripcion' => $this->input->post("Descripcion"),
                'FechaRegistro' => date("Y-m-d G:i:s"),
                'Estatus' => 10,
                'FondodePrograma' => $this->input->post("FondodePrograma"),
                'Normatividad' => $this->input->post("Normatividad"),
                'idModalidad' => $this->input->post("idModalidad"),
                'idEjercicio' => $this->input->post("idEjercicio"),
                'proyecto' => $proyecto,
            );
        $retorno=  $this->datos_model->datos_archivo_insert($data);
        
        $id_new_archivo=$retorno['registro'];
        
        
            $Tp_plantilla = $this->datos_model->get_tipo_plantilla($this->input->post("idModalidad"), $this->input->post("Normatividad"));
            
            if($Tp_plantilla){
                if($Tp_plantilla->num_rows() > 0){
                    foreach($Tp_plantilla->result() as $dato_p){
                        $idPlantilla = $dato_p->id;
                    }
                }
                $Documentos_Totales = $this->datos_model->get_Documentos_totales_por_plantilla($idPlantilla);
                if($Documentos_Totales->num_rows() > 0){
                    foreach($Documentos_Totales->result() as $Documento){
                        $accion = $this->datos_model->insert_plantilla_en_Relaciones($Documento->id, $id_new_archivo, $Documento->ordenar);
                    }
                }
            }
        
        
        if($retorno['retorno']<0)
            header('Location:'.site_url('archivo/index/'.$retorno['error']));
        else
            header('Location:'.site_url('archivo')); 
    }
    
    public function new_archivo(){
         if (isset($_REQUEST['Proyecto'])) { 
             $proyecto=1; 
             
         }  
         else { 
             $proyecto=0; 
             
         } 
        
        if($this->input->post("id_user")){
        $data["idUsuario"] = $this->session->userdata("id");
            $data = array(
                'idUsuario' => $this->session->userdata("id"),
                'OrdenTrabajo' => $this->input->post("OrdenTrabajo"),
                'Contrato' => $this->input->post("Contrato"),
                'Obra' => $this->input->post("Obra"),
                'Descripcion' => $this->input->post("Descripcion"),
                'FechaRegistro' => date("Y-m-d G:i:s"),
                'Estatus' => 10,
                'FondodePrograma' => $this->input->post("FondodePrograma"),
                'Normatividad' => $this->input->post("Normatividad"),
                'idModalidad' => $this->input->post("idModalidad"),
                'idEjercicio' => $this->input->post("idEjercicio"),
                'proyecto' => $proyecto,
            );
            
            $id_new_archivo = $this->datos_model->newArchivo($data);
            $Tp_plantilla = $this->datos_model->get_tipo_plantilla($this->input->post("idModalidad"), $this->input->post("Normatividad"));
            
            if($Tp_plantilla){
                if($Tp_plantilla->num_rows() > 0){
                    foreach($Tp_plantilla->result() as $dato_p){
                        $idPlantilla = $dato_p->id;
                    }
                }
                $Documentos_Totales = $this->datos_model->get_Documentos_totales_por_plantilla($idPlantilla);
                if($Documentos_Totales->num_rows() > 0){
                    foreach($Documentos_Totales->result() as $Documento){
                        $accion = $this->datos_model->insert_plantilla_en_Relaciones($Documento->id, $id_new_archivo, $Documento->ordenar);
                    }
                }
            }
            
            redirect(site_url("archivo"));
        }else{
            redirect(isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : 'archivo');
        }
    }
    
    public function delete_archivo($id_arch = null){
        if($id_arch){
            $data = array( 'eliminacion_logica' => 1 );
            $retorno = $this->datos_model->updateArchivo($data, $id_arch);
        }
        redirect(isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : 'archivo');
    }
    
    public function delete_doc_anexo($idDocAdj = null, $idEjercicio = null){
        if($idDocAdj){
            $data = array( 'eliminacion_logica' => 1 );
            $retorno = $this->datos_model->update_doc_adjunto($data, $idDocAdj, $idEjercicio);
        }
        redirect(isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : 'archivo');
    }
    
    public function documentos_json() {
        $aDocsTotales = $this->datos_model->documentos_idP_json($this->input->post("term"), $this->input->post("id"), $this->input->post("id_plantilla"));
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');
        echo json_encode($aDocsTotales, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
    }
        
    public function returndocdesrip($id = null){
        $id = $_POST['iddoc'];
        $doc = $this->datos_model->docs_id($id);
        if($doc){
            $do = $doc->Nombre;
            header('Cache-Control: no-cache, must-revalidate');
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
            header('Content-type: application/json');
            echo json_encode($do, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
        }else{
           $do = 'Sin Documento';
        }
    }
    
    public function returndocid($id = null){
        $id = $_POST['iddoc'];
        $doc = $this->datos_model->docs_id($id);
        if($doc){
            $do = $doc->id;
            header('Cache-Control: no-cache, must-revalidate');
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
            header('Content-type: application/json');
            echo json_encode($do, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
        }else{
           $do = 'Sin Documento';
        }
    }
    
     
    public function eliminarDir($carpeta){
        foreach(glob($carpeta . "/*") as $archivos_carpeta)
        {
            if (is_dir($archivos_carpeta))
            {
                $this->eliminarDir($archivos_carpeta);
            }
            else
            {
                unlink($archivos_carpeta);
            }
        }
        
        if(rmdir($carpeta))         // Eliminamos la carpeta vacia 
            return true;
        else
            return false;
    }
    
    public function verDoc($idDocDigital = null, $idEjercicio = null){
        
        if($idDocDigital){
            $idUser = $this->session->userdata('id');
            $dirUser = './js/documentos_vistas/'.$idUser.'/';
            $statcd = 0;
            //creando los directorios en el servidor para aguardar los documentos que seran vistos            
                if(!is_dir($dirUser)){
                    //crea la carpeta del usuario mediante su ID
                    @mkdir($dirUser, 0777);
                    $statcd = 1;
                }else{
                     //elimino la carpeta y su contenido para crearla nuevamente
                    if($this->eliminarDir($dirUser)){
                        //crea la carpeta del usuario mediante su ID
                        @mkdir($dirUser, 0777);
                        $statcd = 2;
                    }else{
                        $statcd = -2;
                    }
                }
            //una vez creados los directorios preparamos la url para Viwer JS donde se contrara el documento a mostrar
            if($statcd > 0){
                $newDirUser = '';
                for($i=0; $i<strlen($dirUser); $i++){
                    if($i>4){
                       $newDirUser .= $dirUser[$i];
                    }
                }
            }else{
                $newDirUser = false;
            }
            //depues pasamos a la creacion del documento extrayendolo de la base de datos
            $aDocumento = $this->datos_model->get_doc_adjunto($idDocDigital, $idEjercicio)->row_array();
            
                if ($aDocumento === FALSE) {
                   $newDirUser = false;
                }else{
                    $Nombre = "Documento".$idUser.$aDocumento["Extension"];
                    $contenido = bzdecompress(base64_decode($aDocumento["Datos"]));
                    $archivo = fopen(''.$dirUser.$Nombre, 'w');
                    fwrite($archivo, $contenido);
                    fclose($archivo);
                }
                if($newDirUser){
                   $data['carpeta_user'] = $newDirUser.$Nombre; 
                }else{
                    $data['carpeta_user'] = false; 
                }
                
            $data['idEjercicio'] = $idEjercicio;
            $data['extension'] = $aDocumento["Extension"];
            $data['idDocDigital'] = $idDocDigital;
            $data['urlanterior']= isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : 'archivo';
            $this->load->view('v_verdoc_anexo', $data);
        }else{
            redirect(isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : 'archivo');
        }
    }
    
    public function descargarDoc($idDocDigital = null, $idEjercicio = null){
        $aDocumento = $this->datos_model->get_doc_adjunto($idDocDigital, $idEjercicio)->row_array();
        if ($aDocumento === FALSE) {
            die("Error al obtener documento");
        }
        $blob = bzdecompress(base64_decode($aDocumento["Datos"]));
        header('Content-Type: ' . $aDocumento["Mime"]);
        $Nombre = "Doc_anexo_".$aDocumento["nombrearchivo"];
        header("Content-disposition: attachment; filename=\"" . $Nombre . "\"");
        echo $blob;
    }
    
    public function prueba_arbol($id_archivo = null) {
         
            $data["aUsuarios"] = $this->datos_model->get_usuarios();
            $data["Procesos"] = $this->datos_model->get_procesos();
            $data["SubProcesos"] = $this->datos_model->get_subprocesos();
            $data["SubProcesos_select"] = $this->datos_model->get_subprocesos_select();
            
            $this->load->view('v_prueba_arbol.php', $data);
       
    }


    public function act_ordenar() {
         
        $Rel = $this->datos_model->get_rel();
        if($Rel->num_rows() > 0){
            foreach($Rel->result() as $Re){
                $data = array( 'ordenar' => $Re->ordenar*10);
                $this->datos_model->update_rel($data, $Re->id);
            }
        }
            
        redirect('archivo/prueba_arbol');
       
    }

































    
    
    
        
        
        
        
    
    
    
    
    
    
    public function edit_db() {

        $data = array();


        $id = $this->input->post("id");

        $data["Categoria"] = $this->input->post("Categoria");
        $data["Titulo"] = $this->input->post("Titulo");
        $data["Prioridad"] = $this->input->post("Prioridad");
        $data["Descripcion"] = $this->input->post("Descripcion");
        $data["UsuarioReporta"] = $this->input->post("UsuarioReporta");
        $data["idAsignado"] = $this->input->post("idAsignado");
        $data["Sistema"] = $this->input->post("Sistema");
//        $data["FechaReporte"] = $this->input->post("FechaReporte");
//        $data["FechaUltimoAvance"] = $this->input->post("FechaUltimoAvance");
//        $data["FechaTerminacion"] = $this->input->post("FechaTerminacion");
        //$data["Estatus"] = $this->input->post("Estatus");

        $retorno = $this->datos_model->updateReporte($data, $id);
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');


        header('Location: ' . site_url("archivo/"));
    }

    public function reabrir_db() {

        $data = array();

        $fechahora = time();

        $data["Comentario"] = htmlentities($this->input->post("Comentario"), ENT_QUOTES, "UTF-8");
        $data["idHelpDesk"] = $this->input->post("idHelpDesk");
        $data["idUsuario"] = $this->session->userdata("id");
        $data["fecha"] = $fechahora;

        // obtener el estatus actual del reporte

        $retorno = $this->datos_model->alta_comentario($data);

        $fin = $this->input->post("fin");
        $EstatusAvance = $this->input->post("EstatusAvance");

        $estatus = $this->datos_model->get_estatus($data["idHelpDesk"]);

       
        $data2["FechaTerminacion"] = $fechahora;
        $data2["Estatus"] = 4;
        $data2["FechaUltimoAvance"] = $fechahora;

        $retorno = $this->datos_model->updateReporte($data2, $data["idHelpDesk"]);


        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');

        header('Location: ' . site_url("archivo/cambios/" . $data["idHelpDesk"] . "#Avances"));
    }
    
    public function nuevo_archivo_previo() {
        
    }
    
    
    public function comentario_db() {

        $data = array();

        $fechahora = time();

        $data["Comentario"] = htmlentities($this->input->post("Comentario"), ENT_QUOTES, "UTF-8");
        $data["idHelpDesk"] = $this->input->post("idHelpDesk");
        $data["idUsuario"] = $this->session->userdata("id");
        $data["fecha"] = $fechahora;

        // obtener el estatus actual del reporte


        $retorno = $this->datos_model->alta_comentario($data);

        $fin = $this->input->post("fin");
        $EstatusAvance = $this->input->post("EstatusAvance");

        $estatus = $this->datos_model->get_estatus($data["idHelpDesk"]);

        if ($fin == "1") {
            $data2["FechaTerminacion"] = $fechahora;
            $data2["Estatus"] = 3;
        } else {
            //if ($estatus == 1) {
                // si el reporte es nuevo , cambiar a atendiendo
                // Registrar fecha de inicio de atencion
                $data2["FechaInicioAtencion"] = $fechahora;
                $data2["Estatus"] = $EstatusAvance;
            //}
        }

        $data2["FechaUltimoAvance"] = $fechahora;

        $retorno = $this->datos_model->updateReporte($data2, $data["idHelpDesk"]);


        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');

        header('Location: ' . site_url("archivo/cambios/" . $data["idHelpDesk"] . "#Avances"));
    }

    public function sistemas_text() {

        $aEjecutoras = $this->datos_model->sistemas_txt();

        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');
        echo json_encode($aEjecutoras, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
    }

    public function foto_db() {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = '5000000';

        $id = $this->input->post('id');

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            echo "<script>
                    if(confirm('" . $this->upload->display_errors('', '') . "')) {
                        window.location.href = '" . site_url('archivo/cambios/' . $id . '#Pantallas') . "';
                        } else {
                        window.location.href = '" . site_url('archivo/cambios/' . $id . '#Pantallas') . "';
                        }
                    </script>";
        } else {
            $data = array('upload_data' => $this->upload->data());


            if (!$data['upload_data']['is_image'] == 1) {
                echo "<script>
                    if(confirm('El archivo no es una imagen')) {
                        window.location.href = '" . site_url('archivo/cambios/' . $id . '#Pantallas') . "';
                        } else {
                        window.location.href = '" . site_url('archivo/cambios/' . $id . '#Pantallas') . "';
                        }
                    </script>";
            }


            // Convertir el archivo en cadena
            $file = $data['upload_data']['full_path'];
            $mime = $data['upload_data']['file_type'];
            //$extension = $data['upload_data']['file_ext'];
            // Procesar el archivo
            //$file_blob = bzcompress($this->uf_procesar_archivo($file, 800));
            $file_blob = $this->uf_procesar_archivo($file, 800);

            $fotografia['Pantalla'] = base64_encode($file_blob);
            $fotografia['idHelpDesk'] = $id;
            $fotografia['Mime'] = $mime;

            $retorno = $this->datos_model->foto_insert($fotografia);

            unlink($file);
            header('Location: ' . site_url('archivo/cambios/' . $id . '#Pantallas'));
        }
    }

    public function uf_procesar_archivo($binario_nombre_temporal, $maximo = 1600) {

        $image = new Imagick($binario_nombre_temporal);

        $maxsize = $maximo;

        // primero a RGB
        //	// Set to use jpeg compression
        $image->setImageCompression(Imagick::COMPRESSION_JPEG);
        $image->setImageCompressionQuality(95);

        if ($image->getImageColorspace() == Imagick::COLORSPACE_CMYK) {
            $profiles = $image->getImageProfiles('*', false);
            // we're only interested if ICC profile(s) exist 
            $has_icc_profile = (array_search('icc', $profiles) !== false);
            // if it doesnt have a CMYK ICC profile, we add one 
            if ($has_icc_profile === false) {
                $icc_cmyk = file_get_contents('/var/www/lib/Adobe_ICC_Profiles/CMYK/USWebUncoated.icc');
                $image->profileImage('icc', $icc_cmyk);
                unset($icc_cmyk);
            }
            // then we add an RGB profile 
            $icc_rgb = file_get_contents('/var/www/lib/Adobe_ICC_Profiles/RGB/sRGB_v4_ICC_preference.icc');
            $image->profileImage('icc', $icc_rgb);
            unset($icc_rgb);
        }

        $image->setImageColorSpace(1);
        $image->stripImage();

        // Resizes to whichever is larger, width or height
        if ($image->getImageHeight() <= $image->getImageWidth()) {
            // Resize image using the lanczos resampling algorithm based on width
            $image->resizeImage($maxsize, 0, Imagick::FILTER_LANCZOS, 1);
        } else {
            // Resize image using the lanczos resampling algorithm based on height
            $image->resizeImage(0, $maxsize, Imagick::FILTER_LANCZOS, 1);
        }

        $new_blob = $image->getImageBlob();
        // Destroys Imagick object, freeing allocated resources in the process
        $image->destroy();
        return $new_blob;
    }

    public function borrar_img($idReporte, $idFoto) {
        $this->datos_model->foto_borrar($idFoto);

        header('Location: ' . site_url('archivo/cambios/' . $idReporte . '#Pantallas'));
    }

    public function borrar_avance($idReporte, $idAvance) {
        $this->datos_model->avance_borrar($idAvance);
        header('Location: ' . site_url('archivo/cambios/' . $idReporte . '#Avances'));
    }

    
    
    
     public function listado_sub_documentos_mod($id) {
        ini_set("memory_limit","100000M");
       
        
        $this->load->model('subdocumentos_model');
        $qSubDocumentos = $this->subdocumentos_model->listado_subdocumentos_documento($id);
        
      
        
        
         $tabla='<table class="table table-striped table-bordered table-hover table-condensed" width="800" border="0" cellpadding="1" cellspacing="0" id="t_aprovisionamientos_concepto">
                                            <thead>
                                                <tr valign="top">
                                                    <th scope="col">Acci&oacute;n</th>
                                                    <th scope="col">Descripción</th>
                                                </tr>
                                            </thead>';
        
        foreach ($qSubDocumentos->result() as $rowdata) {
            $tabla.='<tr>';
            $tabla.='<td>';
            $tabla.='<a href="#" class="btn btn-default btn-xs"  id="reg'. $rowdata->id .'" onclick="modificar_sub_documento_mod('. $rowdata->id.')">Seleccionar</a>';
            $tabla.='</td>';
            $tabla.='<td>';
            $tabla.= $rowdata->Nombre; 
            $tabla.='</td>';
            $tabla.='</tr>';
        } 
         $tabla.='
        </tbody>
       </table>';
        $output= $tabla;
        
        //header('Cache-Control: no-cache, must-revalidate');
        //header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        //header('Content-type: application/json');
        echo json_encode($output, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
         
    }
   
    
     public function datos_subdocumento($id) {
        $this->load->model('subdocumentos_model');
        $dSudDocumento = $this->subdocumentos_model->datos_subdocumento($id)->row_array();
        echo json_encode($dSudDocumento);
    } 
    
    
    public function no_subdocumento($id) {
        $this->load->model('subdocumentos_model');
        $dSudDocumento = $this->subdocumentos_model->listado_subdocumentos_documento($id);
        
        
        $data =array();
        $data['numero']= $dSudDocumento->num_rows();
        echo json_encode($data);
    } 
    
    
    public function cambio_estatus($estatus) {
        $this->load->model('rel_archivo_documento_model');
        
        $idTipoProceso=$this->input->post("idTipoProceso_revision");
        $idArchivo=$this->input->post("idArchivo_revision");
        
       
        
        
        $retorno = $this->rel_archivo_documento_model->cambiar_estatus($idArchivo,$idTipoProceso, $estatus);
       
        
       
        
        if ($retorno == 0) {
            die('Estatus Actual no Permitido');
        }
        
        $idSubProceso=0;
        $idTpDoc=0;
        header("Location:" . site_url('archivo/cambios/'. $idArchivo.'/'.$idTipoProceso.'/'.$idSubProceso.'/'.$idTpDoc.'/-1'.'#section_'.$idTpDoc));   
        
    }


    
    public function cambio_estatus_foliado($estatus) {
        $this->load->model('rel_archivo_documento_model');
        
        $idTipoProceso=$this->input->post("idTipoProceso_foliado");
        $idArchivo=$this->input->post("idArchivo_foliado");
        
       
        
        
        $retorno = $this->rel_archivo_documento_model->cambiar_estatus($idArchivo,$idTipoProceso, $estatus);
       
        
       
        
        if ($retorno == 0) {
            die('Estatus Actual no Permitido');
        }
        
        $idSubProceso=0;
        $idTpDoc=0;
        header("Location:" . site_url('archivo/cambios/'. $idArchivo.'/'.$idTipoProceso.'/'.$idSubProceso.'/'.$idTpDoc.'/-1'.'#section_'.$idTpDoc));   
        
    }

    
    public function cambio_estatus_digitalizar($estatus) {
        $this->load->model('rel_archivo_documento_model');
        
        $idTipoProceso=$this->input->post("idTipoProceso_digitalizar");
        $idArchivo=$this->input->post("idArchivo_digitalizar");
        
       
        
        
        $retorno = $this->rel_archivo_documento_model->cambiar_estatus($idArchivo,$idTipoProceso, $estatus);
       
        
       
        
        if ($retorno == 0) {
            die('Estatus Actual no Permitido');
        }
        
        $idSubProceso=0;
        $idTpDoc=0;
        header("Location:" . site_url('archivo/cambios/'. $idArchivo.'/'.$idTipoProceso.'/'.$idSubProceso.'/'.$idTpDoc.'/-1'.'#section_'.$idTpDoc));   
        
    }
    
    
    
    public function cambio_estatus_validar($estatus) {
        $this->load->model('rel_archivo_documento_model');
        
        $idTipoProceso=$this->input->post("idTipoProceso_validar");
        $idArchivo=$this->input->post("idArchivo_validar");
        
       
        
        
        $retorno = $this->rel_archivo_documento_model->cambiar_estatus($idArchivo,$idTipoProceso, $estatus);
       
        
       
        
        if ($retorno == 0) {
            die('Estatus Actual no Permitido');
        }
        
        $idSubProceso=0;
        $idTpDoc=0;
        header("Location:" . site_url('archivo/cambios/'. $idArchivo.'/'.$idTipoProceso.'/'.$idSubProceso.'/'.$idTpDoc.'/-1'.'#section_'.$idTpDoc));   
        
    }
    
    
    public function cambio_estatus_editar($estatus) {
        $this->load->model('rel_archivo_documento_model');
        
        $idTipoProceso=$this->input->post("idTipoProceso_editar");
        $idArchivo=$this->input->post("idArchivo_editar");
        
       
        
        
        $retorno = $this->rel_archivo_documento_model->cambiar_estatus($idArchivo,$idTipoProceso, $estatus);
       
        
       
        
        if ($retorno == 0) {
            die('Estatus Actual no Permitido');
        }
        
        $idSubProceso=0;
        $idTpDoc=0;
        header("Location:" . site_url('archivo/cambios/'. $idArchivo.'/'.$idTipoProceso.'/'.$idSubProceso.'/'.$idTpDoc.'/-1'.'#section_'.$idTpDoc));   
        
    }
    
    public function cambio_estatus_integrar($estatus) {
        $this->load->model('rel_archivo_documento_model');
        
        $idTipoProceso=$this->input->post("idTipoProceso_integracion");
        $idArchivo=$this->input->post("idArchivo_integracion");
        
       
        
        
        $retorno = $this->rel_archivo_documento_model->cambiar_estatus($idArchivo,$idTipoProceso, $estatus);
       
        
       
        
        if ($retorno == 0) {
            die('Estatus Actual no Permitido');
        }
        
        $idSubProceso=0;
        $idTpDoc=0;
        header("Location:" . site_url('archivo/cambios/'. $idArchivo.'/'.$idTipoProceso.'/'.$idSubProceso.'/'.$idTpDoc.'/-1'.'#section_'.$idTpDoc));   
        
    }
    
    
    
      public function cambio_estatus_finalizar($estatus) {
        $this->load->model('rel_archivo_documento_model');
        
        $idTipoProceso=$this->input->post("idTipoProceso_finalizar");
        $idArchivo=$this->input->post("idArchivo_finalizar");
        
       
        
        
        $retorno = $this->rel_archivo_documento_model->cambiar_estatus($idArchivo,$idTipoProceso, $estatus);
       
        
       
        
        if ($retorno == 0) {
            die('Estatus Actual no Permitido');
        }
        
        $idSubProceso=0;
        $idTpDoc=0;
        header("Location:" . site_url('archivo/cambios/'. $idArchivo.'/'.$idTipoProceso.'/'.$idSubProceso.'/'.$idTpDoc.'/-1'.'#section_'.$idTpDoc));   
        
    }
    
      public function cambio_estatus_concentracion($estatus) {
        $this->load->model('rel_archivo_documento_model');
        
        
        $idArchivo=$this->input->post("idArchivo_concentracion");
        
       
        
        
        $retorno = $this->rel_archivo_documento_model->cambiar_estatus_ot($idArchivo, $estatus);
       
        
       
        
        if ($retorno == 0) {
            die('Estatus Actual no Permitido');
        }
        
        $idSubProceso=0;
        $idTpDoc=0;
        header("Location:" . site_url('archivo/cambios/'. $idArchivo.'/'.$idTipoProceso.'/'.$idSubProceso.'/'.$idTpDoc.'/-1'.'#section_'.$idTpDoc));   
        
    }
    
    
     public function cambio_estatus_rechazar($estatus) {
        $this->load->model('rel_archivo_documento_model');
        
        $idTipoProceso=$this->input->post("idTipoProceso_rechazar");
        $idArchivo=$this->input->post("idArchivo_rechazar");
        
       
        
        
        $retorno = $this->rel_archivo_documento_model->cambiar_estatus_rechazar($idArchivo,$idTipoProceso, $estatus,$this->input->post("motivo"));
       
        
       
        
        if ($retorno == 0) {
            die('Estatus Actual no Permitido');
        }
        
        $idSubProceso=0;
        $idTpDoc=0;
        header("Location:" . site_url('archivo/cambios/'. $idArchivo.'/'.$idTipoProceso.'/'.$idSubProceso.'/'.$idTpDoc.'/-1'.'#section_'.$idTpDoc));   
        
    }

    
    
     public function agregar_observaciones_bloque() {
        $this->load->model('rel_archivo_documento_model');
        
        $idSubTipoProceso=$this->input->post("idSubTipoProceso_observacion");
        $idTipoProceso=$this->input->post("idTipoProceso_observacion");
        $idArchivo=$this->input->post("idArchivo_observacion");
        $idDocumento=$this->input->post("idDocumento_observacion");
        $idDireccion=$this->input->post("idArchivo_observacion");
        $idDocumento=$this->input->post("idDocumento_observacion");
        
        $retorno = $this->rel_archivo_documento_model->agregar_observaciones_bloque($idArchivo,$idTipoProceso,$this->input->post("motivo"),$idSubTipoProceso, $idDocumento);
       
       
        
        if ($retorno == 0) {
            die('Estatus Actual no Permitido');
        }
        
        $idSubProceso=0;
        $idTpDoc=0;
        header("Location:" . site_url('archivo/cambios/'. $idArchivo.'/'.$idTipoProceso.'/'.$idSubProceso.'/'.$idTpDoc.'/-1'.'#section_'.$idTpDoc));   
        
    }
    
    
    
    /*public function agregar_observaciones_por_archivo($idArchivo) {
        $this->load->model('observaciones_model');
        
        $data =array(
            
            'Motivo'    => $this->input->post("motivo_observacion_archivo"),
            'Fecha'     => date('Y-m-d H:i:s'),
            'idUsuario' => $this->session->userdata('id'),
            'idDireccion_responsable' =>  $this->session->userdata('idDireccion_responsable'),
            'idArchivo' => $idArchivo,
            
        );
        
        
        
        $retorno = $this->observaciones_model->agregar_observaciones_por_archivo($data);
       
       
        
        if($retorno['retorno'] < 0){
            header('Location:'.site_url('archivo/cambios/' .$idArchivo . '/' .$retorno['error']));
        }
        else{
            
            header('Location:'.site_url('archivo/cambios/' .$idArchivo)); 
        }
        
    }*/
    
     public function agregar_observaciones_documento() {
        $this->load->model('observaciones_model');
         
         
        $idArchivo=$this->input->post("idArchivo_observacion");
         
        $tipo_usuario = $this->input->post("tipo_usuario");
        $mensaje = $this->input->post("Motivo");
         
        $data =array(
             
            'Motivo'    => $mensaje,
            'Fecha'     => date('Y-m-d H:i:s'),
            'idUsuario' => $this->session->userdata('id'),
            'idDireccion_responsable' =>  $this->session->userdata('idDireccion_responsable'),
            'idArchivo' => $this->input->post("idArchivo_observacion"),
            'idTipoProceso' => $this->input->post("idTipoProceso_observacion"),
            'idSubTipoProceso' => $this->input->post("idSubTipoProceso_observacion"),
            'idDocumento' => $this->input->post("idDocumento_observacion"),
            //Direccion del preregistro
            'idDireccion' => $this->input->post("idDireccion_observacion"),
            'idContrato' => $this->input->post("idContrato_observacion"),
            'tipo_observacion' => $this->input->post("tipo_observacion"),
            'tipo_usuario' => $tipo_usuario,
             
        );
         
        if( $tipo_usuario == 0){
            //direccion responsable_documento
            $data['direccion_respuesta']=$this->input->post("direccion_respuesta");
        }
         
        $this->observaciones_model->agregar_observaciones_por_documento($data);
          
        //1 Solicita respuesta y son de CID
        if ($data['tipo_observacion'] == 1 && $tipo_usuario== 0 ){
            $this->enviar_correo($data['idUsuario'], $this->input->post("usuario_preregistro"), $mensaje);
        }
        //$retorno = $this->observaciones_model->agregar_observaciones_por_documento($data);
        
       /*
         
        if($retorno['retorno'] < 0){
            header('Location:'.site_url('archivo/cambios/' .$idArchivo . '/' .$retorno['error']));
        }
        else{
             
            header('Location:'.site_url('archivo/cambios/' .$idArchivo)); 
        }*/
         
    }
    
    
     public function agregar_observaciones_estimacion() {
        $this->load->model('observaciones_estimacion_model');
        
        
        $idArchivo=$this->input->post("idArchivo_observacion");
        
        $tipo_usuario = $this->input->post("tipo_usuario");
        $mensaje = $this->input->post("Motivo");
        
        $data =array(
            
            'Motivo'    => $mensaje,
            'Fecha'     => date('Y-m-d H:i:s'),
            'idUsuario' => $this->session->userdata('id'),
            'idDireccion_responsable' =>  $this->session->userdata("idDireccion_responsable"),
            'idDireccion' =>  $this->input->post("idDireccion"),
            'idArchivo' => $this->input->post("idArchivo"),
            'idEstimacion' => $this->input->post("idEstimacion"),
            
            'tipo_observacion' => $this->input->post("tipo_observacion"),
            'tipo_usuario' => $tipo_usuario,
            
        );
        
        if( $tipo_usuario == 0){
            $data['direccion_respuesta'] = $this->input->post("direccion_respuesta");
        }
        
        $this->observaciones_estimacion_model->agregar_observacion_estimacion($data);
         
        //1 Solicita respuesta y son de CID
        if ($data['tipo_observacion'] == 1 && $tipo_usuario== 0 ){
            $this->enviar_correo($data['idUsuario'], $this->input->post("usuario_preregistro"), $mensaje);
        }
        //$retorno = $this->observaciones_model->agregar_observaciones_por_documento($data);
       
       /*
        
        if($retorno['retorno'] < 0){
            header('Location:'.site_url('archivo/cambios/' .$idArchivo . '/' .$retorno['error']));
        }
        else{
            
            header('Location:'.site_url('archivo/cambios/' .$idArchivo)); 
        }*/
        
    }
    
    public function modificar_observaciones_documento($id) {
        $this->load->model('observaciones_model');
        
        
       
        
        $data =array(
            
            'Motivo'    => $this->input->post("Motivo"),
            'tipo_observacion' => $this->input->post("tipo_observacion"),
            'Fecha'     => date('Y-m-d H:i:s'),
            
            
        );
        
        
        
        $this->observaciones_model->observaciones_documento_update($data, $id);
         
        //1 Solicita respuesta y son de CID
        //if ($data['tipo_observacion'] == 1 && $tipo_usuario== 0 ){
            //$this->enviar_correo($data['idUsuario'], $this->input->post("usuario_preregistro"), $mensaje);
       // }
        //$retorno = $this->observaciones_model->agregar_observaciones_por_documento($data);
       
       /*
        
        if($retorno['retorno'] < 0){
            header('Location:'.site_url('archivo/cambios/' .$idArchivo . '/' .$retorno['error']));
        }
        else{
            
            header('Location:'.site_url('archivo/cambios/' .$idArchivo)); 
        }*/
        
    }
    
    
    public function modificar_observaciones_estimacion($id) {
        $this->load->model('observaciones_estimacion_model');
        
        $data =array(
            
            'Motivo'    => $this->input->post("Motivo"),
            'tipo_observacion' => $this->input->post("tipo_observacion"),
            'Fecha'     => date('Y-m-d H:i:s'),
    
        );
        
        $this->observaciones_estimacion_model->observaciones_estimacion_update($data, $id);
       
    }
    
    public function eliminar_observacion_documento($id) {
        $this->load->model('observaciones_model');
        $data =array(
            
            'eliminacion_logica'    => 1,
          
        );
        $this->observaciones_model->observaciones_documento_update($data, $id);
        
    }
    
    
    public function eliminar_observacion_estimacion($id) {
        $this->load->model('observaciones_estimacion_model');
        $data =array(
            
            'eliminacion_logica'    => 1,
          
        );
        $this->observaciones_estimacion_model->observaciones_estimacion_update($data, $id);
        
    }
    
    public function enviar_correo($de, $para, $mensaje){
        
        $this->load->model('usuarios_model');
        $aUsuarios=$this->usuarios_model->addw_usuarios_correos();
        
       
        $to = $aUsuarios[$de];
        $from = $aUsuarios[$para];
        //$mail = "Prueba de mensaje";
        //Titulo
        $titulo = "PRUEBA DE TITULO";
        //cabecera
        $headers = "MIME-Version: 1.0\r\n"; 
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
        //dirección del remitente 
        $headers .= "From: ". $from ."\r\n";
        //Enviamos el mensaje a tu_dirección_email 
        //$bool = mail("tu_dirección_email",$titulo,$mail,$headers);
        /*$bool = mail($to,$titulo,$mensaje,$headers);
        if($bool){
            echo "Mensaje enviado";
            
        }else{
            echo "Mensaje no enviado";
            echo "From " . $from;
            echo "to " . $to;
            echo "mensaje " . $mensaje;
        } */
        if($this->load->library('email')){
            echo 'si carga';
        }
        
        $this->load->library('email');

        $this->email->from('elena.orozco@hotmail.com', 'Elena Orozco');
        $this->email->to('elena.orozcoch@gmail.com');
        //$this->email->cc('another@another-example.com');
        $this->email->bcc('them@their-example.com');

        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');

        if($this->email->send()){
               echo "Mensaje enviado";
            
        }else{
            echo "Mensaje no enviado";
            echo "From " . $from;
            echo "to " . $to;
            echo "mensaje " . $mensaje;
        }
    }
    
    
    public function ver_observaciones_documento($idArchivo ,$idTipoProceso, $idSubTipoProceso,$idDocumento) {
        $this->load->model('observaciones_model');
        $this->load->model('control_usuarios_model');
        
         
        $aUsuarios=$this->control_usuarios_model->addw_Usuarios();
       
        
         
        $qHistorial=$this->observaciones_model->listado_observaciones_documento($idArchivo, $idTipoProceso, $idSubTipoProceso, $idDocumento);
        $qEnlaces = $this->observaciones_model->listado_observaciones_documento_enlaces($idArchivo, $idTipoProceso, $idSubTipoProceso, $idDocumento);
        $qEnlacesVistos = $this->observaciones_model->listado_observaciones_documento_enlaces_vistos($idArchivo, $idTipoProceso, $idSubTipoProceso, $idDocumento);
        $qCid = $this->observaciones_model->listado_observaciones_documento_cid($idArchivo, $idTipoProceso, $idSubTipoProceso, $idDocumento);
         
         
        $tabla='
            <div>

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                  <li role="presentacion" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Nuevos (' . $qEnlaces->num_rows.')</a></li>
                  <li role="presentation"><a href="#vistos" aria-controls="messages" role="tab" data-toggle="tab">Enlaces (' . $qEnlacesVistos->num_rows.')</a></li>
                  <li role="presentation"><a href="#cid" aria-controls="cid" role="tab" data-toggle="tab">CID (' . $qCid->num_rows.')</a></li>
                  <li role="presentation"><a href="#todo" aria-controls="messages" role="tab" data-toggle="tab">Todas (' . $qHistorial->num_rows.')</a></li>
                      
                  
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">
                        
                        <table class="table table-striped table-hover table-condensed" id="tabla_scroll">
                            <thead>
                                <tr>                                    
                                    <th>
                                        #
                                    </th> 
                                   
                                    <th>
                                        Fecha
                                    </th>
                                    <th>
                                        Usuario
                                    </th>
                                    
                                    <th>
                                        Motivo
                                    </th>
                                    <th>
                                        Respuesta
                                    </th>
                                </tr>
                            </thead>
                            <tbody>';
         
         
                                if (isset($qEnlaces)) {
                                    if ($qEnlaces->num_rows() > 0) {
                                        $i = 0;
                                        foreach ($qEnlaces->result() as $rEnlaces) {
                                            $i++;
                                            
                                           $tabla.= "<tr>";
                                           //$tabla.=  "<td>" . $i . "</td>";
                                           $tabla.= "<td>";
                                                        if($rEnlaces->tipo_observacion ==1){
                                                
                                                            $tabla.= "<a href='#' data-toggle='modal' data-target='#modal-ver-observacion' role='button'  class='btn btn-xs btn-warning' onclick='responder_observacion_documento(".$rEnlaces->id.")'>
                                                               <span class='glyphicon glyphicon-send'></span>
                                                            </a>";
                                                                
                                                        }else{
                                                            $tabla.= "<a href='#' id='visto".$rEnlaces->id."' class='btn btn-xs btn-success' title= 'Marcar como Visto' onclick='marcar_visto(".$rEnlaces->id.")'>
                                                               <span class='glyphicon glyphicon-ok'></span>
                                                            </a>";
                                                        }
                                           $tabla.= "</td> "; 
                                           $tabla.= "<td class='sinwarp'>" .date("d-m-Y h:i:s", strtotime($rEnlaces->Fecha)) . "</td>";
                                           $tabla.="<td>" . $aUsuarios[$rEnlaces->idUsuario] . "</td>"; 
                                                        
                                                
                                           
                                           $tabla.="<td class='text-justify'>" . $rEnlaces->Motivo. "</td>";  
                                           $tabla.="<td class='text-justify'>"; 
                                                    if($rEnlaces->tipo_observacion==0){
                                                        $tabla.= 'No se Solicito Repuesta';
                                                    }
                                                    else if ($rEnlaces->Respuesta){
                                                        $tabla.= "".$rEnlaces->Respuesta;
                                                    }else{
                                                        $tabla.='Esperando Respuesta';
                                                    }
                                           $tabla.="</td>" ;
                                               
                                           $tabla.= "</tr>";
                                            
                                        }
                                    }
                                }
        
                                
                        $tabla.=' </tbody>
                                        </table> ';  


        $tabla.=   '</div>
                    <div role="tabpanel" class="tab-pane" id="vistos">
                        <table class="table table-striped table-hover table-condensed" id="tabla_scroll">
                            <thead>
                                <tr>                                    
                                    <th>
                                        #
                                    </th> 
                                   
                                    <th>
                                        Fecha
                                    </th>
                                    <th>
                                        Usuario
                                    </th>
                                    
                                    <th>
                                        Motivo
                                    </th>
                                    <th>
                                        Respuesta
                                    </th>
                                </tr>
                            </thead>
                            <tbody>';
         
         
                                if (isset($qEnlacesVistos)) {
                                    if ($qEnlacesVistos->num_rows() > 0) {
                                        $i = 0;
                                        foreach ($qEnlacesVistos->result() as $rEnlacesVistos) {
                                            $i++;
                                            
                                           $tabla.= "<tr>";
                                           $tabla.=  "<td>" . $i . "</td>";
                                           /*$tabla.= "<td>
                                                
                                                        <a href='#' data-toggle='modal' data-target='#mod-observacion-documento' role='button'  class='btn btn-xs btn-success' onclick='modificar_observacion_documento(".$rCid->id.")'>
                                                           <span class='glyphicon glyphicon-pencil'></span>
                                                        </a>
                                                        <a href='#' class='btn btn-xs btn-danger' onclick='eliminar_observacion_documento(".$rCid->id.")'>
                                                           <span class='glyphicon glyphicon-remove'></span>
                                                        </a>
                                                     </td> "; */
                                           $tabla.= "<td class='sinwarp'>" .date("d-m-Y h:i:s", strtotime($rEnlacesVistos->Fecha)) . "</td>";
                                           $tabla.="<td>" . $aUsuarios[$rEnlacesVistos->idUsuario] . "</td>"; 
                                                        
                                                
                                           
                                           $tabla.="<td class='text-justify'>" . $rEnlacesVistos->Motivo. "</td>";  
                                           $tabla.="<td class='text-justify'>"; 
                                                    if($rEnlacesVistos->tipo_observacion==0){
                                                        $tabla.= 'No se Solicito Repuesta';
                                                    }
                                                    else if ($rEnlacesVistos->Respuesta){
                                                        $tabla.= "".$rEnlacesVistos->Respuesta;
                                                    }else{
                                                        $tabla.='Esperando Respuesta';
                                                    }
                                           $tabla.="</td>"; 
                                               
                                           $tabla.= "</tr>";
                                            
                                        }
                                    }
                                }
        
                                
                        $tabla.=' </tbody>
                                        </table> ';  
    $tabla.='    </div>
                <div role="tabpanel" class="tab-pane" id="cid">
                        <table class="table table-striped table-hover table-condensed" id="tabla_scroll">
                            <thead>
                                <tr>                                    
                                    <th>
                                        #
                                    </th> 
                                   
                                    <th>
                                        Fecha
                                    </th>
                                    <th>
                                        Usuario
                                    </th>
                                    
                                    <th>
                                        Motivo
                                    </th>
                                    <th>
                                        Respuesta
                                    </th>
                                </tr>
                            </thead>
                            <tbody>';
         
         
                                if (isset($qCid)) {
                                    if ($qCid->num_rows() > 0) {
                                        $i = 0;
                                        foreach ($qCid->result() as $rCid) {
                                            $i++;
                                            
                                           $tabla.= "<tr>";
                                           //$tabla.=  "<td>" . $i . "</td>";
                                           $tabla.= "<td>
                                                
                                                        <a href='#' data-toggle='modal' data-target='#mod-observacion-documento' role='button'  class='btn btn-xs btn-success' onclick='modificar_observacion_documento(".$rCid->id.",".$rCid->idTipoProceso.", ".$rCid->idSubTipoProceso.",".$rCid->idDocumento.")'>
                                                           <span class='glyphicon glyphicon-pencil'></span>
                                                        </a>
                                                        <a href='#' class='btn btn-xs btn-danger' onclick='eliminar_observacion_documento(".$rCid->id.")'>
                                                           <span class='glyphicon glyphicon-remove'></span>
                                                        </a>
                                                     </td> "; 
                                           $tabla.= "<td class='sinwarp'>" .date("d-m-Y h:i:s", strtotime($rCid->Fecha)) . "</td>";
                                           $tabla.="<td>" . $aUsuarios[$rCid->idUsuario] . "</td>"; 
                                                        
                                                
                                           
                                           $tabla.="<td class='text-justify'>" . $rCid->Motivo. "</td>";  
                                           $tabla.="<td class='text-justify'>"; 
                                                    if($rCid->tipo_observacion==0){
                                                        $tabla.= 'No se Solicito Repuesta';
                                                    }
                                                    else if ($rCid->Respuesta){
                                                        $tabla.= "".$rCid->Respuesta;
                                                    }else{
                                                        $tabla.='Esperando Respuesta';
                                                    }
                                           $tabla.="</td>"; 
                                               
                                           $tabla.= "</tr>";
                                            
                                        }
                                    }
                                }
        
                                
                        $tabla.=' </tbody>
                                        </table> ';  
    $tabla.='    </div>
                    
                    <div role="tabpanel" class="tab-pane" id="todo">
                        <table class="table table-striped table-hover table-condensed" id="tabla_scroll">
                            <thead>
                                <tr>                                    
                                    <th>
                                        #
                                    </th> 
                                   
                                    <th>
                                        Fecha
                                    </th>
                                    <th>
                                        Usuario
                                    </th>
                                    
                                    <th>
                                        Motivo
                                    </th>
                                    <th>
                                        Respuesta
                                    </th>
                                </tr>
                            </thead>
                            <tbody>';
         
         
                                if (isset($qHistorial)) {
                                    if ($qHistorial->num_rows() > 0) {
                                        $i = 0;
                                        foreach ($qHistorial->result() as $rHistorial) {
                                            $i++;
                                            
                                           $tabla.= "<tr>";
                                           $tabla.=  "<td>" . $i . "</td>";
                                           //$tabla.= "<td>
                                                
                                                       // <a href='#' data-toggle='modal' data-target='#modal-ver-observacion' role='button'  class='btn btn-xs btn-warning' onclick='uf_modificar_observacion(".$rHistorial->id.")'>
                                                       //     <span class='glyphicon glyphicon-search'></span>
                                                      //  </a>
                                                   // </td> "; 
                                           $tabla.= "<td class='sinwarp'>" .date("d-m-Y h:i:s", strtotime($rHistorial->Fecha)) . "</td>";
                                           $tabla.="<td>" . $aUsuarios[$rHistorial->idUsuario] . "</td>"; 
                                                        
                                                
                                           
                                           $tabla.="<td class='text-justify'>" . $rHistorial->Motivo. "</td>";  
                                           $tabla.="<td class='text-justify'>"; 
                                                    if($rHistorial->tipo_observacion==0){
                                                        $tabla.= 'No se Solicito Repuesta';
                                                    }
                                                    else if ($rHistorial->Respuesta){
                                                        $tabla.= "".$rHistorial->Respuesta;
                                                    }else{
                                                        $tabla.='Esperando Respuesta';
                                                    }
                                           $tabla.="</td>";  
                                               
                                           $tabla.= "</tr>";
                                            
                                        }
                                    }
                                }
        
                                
                        $tabla.=' </tbody>
                                        </table> ';                        
                                
    $tabla.=     '</div>
                  
                </div>

            </div>';
                
         /*
         
        $tabla='  <table class="table table-striped table-hover table-condensed" id="tabla_scroll">
                            <thead>
                                <tr>                                    
                                    <th>
                                        #
                                    </th> 
                                   
                                    <th>
                                        Fecha
                                    </th>
                                    <th>
                                        Usuario
                                    </th>
                                    
                                    <th>
                                        Motivo
                                    </th>
                                    <th>
                                        Respuesta
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
         ';
         
         
                                if (isset($qHistorial)) {
                                    if ($qHistorial->num_rows() > 0) {
                                        $i = 0;
                                        foreach ($qHistorial->result() as $rHistorial) {
                                            $i++;
                                            
                                           $tabla.= "<tr>";
                                           $tabla.=  "<td>" . $i . "</td>";
                                           //$tabla.= "<td>
                                                
                                                       // <a href='#' data-toggle='modal' data-target='#modal-ver-observacion' role='button'  class='btn btn-xs btn-warning' onclick='uf_modificar_observacion(".$rHistorial->id.")'>
                                                       //     <span class='glyphicon glyphicon-search'></span>
                                                      //  </a>
                                                   // </td> "; 
                                           $tabla.= "<td class='sinwarp'>" .date("d-m-Y h:i:s", strtotime($rHistorial->Fecha)) . "</td>";
                                           $tabla.="<td>" . $aUsuarios[$rHistorial->idUsuario] . "</td>"; 
                                                        
                                                
                                           
                                           $tabla.="<td class='text-justify'>" . $rHistorial->Motivo. "</td>";  
                                           $tabla.="<td class='text-justify'>" . $rHistorial->Respuesta. "</td>"; 
                                               
                                           $tabla.= "</tr>";
                                            
                                        }
                                    }
                                }
        
                                
        $tabla.=' </tbody>
                        </table> ';       */                  
                                
        $data=array();
        $data["historial"]=$tabla;
                                
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');
        echo json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);                      
         
    }

    public function ver_observaciones_documento_estimacion($idArchivo ,$idEstimacion) {
        $this->load->model('observaciones_estimacion_model');
        $this->load->model('control_usuarios_model');
        
         
        $aUsuarios=$this->control_usuarios_model->addw_Usuarios();
       
        
         
        $qHistorial=$this->observaciones_estimacion_model->listado_observaciones_estimacion($idEstimacion);
        $qEnlaces = $this->observaciones_estimacion_model->listado_observaciones_estimacion_enlaces($idEstimacion);
        $qEnlacesVistos = $this->observaciones_estimacion_model->listado_observaciones_estimacion_enlaces_vistos($idEstimacion);
        $qCid = $this->observaciones_estimacion_model->listado_observaciones_estimacion_cid($idEstimacion);
         
         
        $tabla='
            <div>

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                  <li role="presentacion" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Nuevos (' . $qEnlaces->num_rows.')</a></li>
                  <li role="presentation"><a href="#vistos" aria-controls="messages" role="tab" data-toggle="tab">Enlaces (' . $qEnlacesVistos->num_rows.')</a></li>
                  <li role="presentation"><a href="#cid" aria-controls="cid" role="tab" data-toggle="tab">CID (' . $qCid->num_rows.')</a></li>
                  <li role="presentation"><a href="#todo" aria-controls="messages" role="tab" data-toggle="tab">Todas (' . $qHistorial->num_rows.')</a></li>
                      
                  
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">
                        
                        <table class="table table-striped table-hover table-condensed" id="tabla_scroll">
                            <thead>
                                <tr>                                    
                                    <th>
                                        #
                                    </th> 
                                   
                                    <th>
                                        Fecha
                                    </th>
                                    <th>
                                        Usuario
                                    </th>
                                    
                                    <th>
                                        Motivo
                                    </th>
                                    <th>
                                        Respuesta
                                    </th>
                                </tr>
                            </thead>
                            <tbody>';
         
         
                                if (isset($qEnlaces)) {
                                    if ($qEnlaces->num_rows() > 0) {
                                        $i = 0;
                                        foreach ($qEnlaces->result() as $rEnlaces) {
                                            $i++;
                                            
                                           $tabla.= "<tr>";
                                           //$tabla.=  "<td>" . $i . "</td>";
                                           $tabla.= "<td>";
                                                        if($rEnlaces->tipo_observacion ==1){
                                                
                                                            $tabla.= "<a href='#' data-toggle='modal' data-target='#modal-ver-observacion' role='button'  class='btn btn-xs btn-warning' onclick='responder_observacion_documento(".$rEnlaces->id.")'>
                                                               <span class='glyphicon glyphicon-send'></span>
                                                            </a>";
                                                                
                                                        }else{
                                                            $tabla.= "<a href='#' id='visto".$rEnlaces->id."' class='btn btn-xs btn-success' title= 'Marcar como Visto' onclick='marcar_visto(".$rEnlaces->id.")'>
                                                               <span class='glyphicon glyphicon-ok'></span>
                                                            </a>";
                                                        }
                                           $tabla.= "</td> "; 
                                           $tabla.= "<td class='sinwarp'>" .date("d-m-Y h:i:s", strtotime($rEnlaces->Fecha)) . "</td>";
                                           $tabla.="<td>" . $aUsuarios[$rEnlaces->idUsuario] . "</td>"; 
                                                        
                                                
                                           
                                           $tabla.="<td class='text-justify'>" . $rEnlaces->Motivo. "</td>";  
                                           $tabla.="<td class='text-justify'>"; 
                                                    if($rEnlaces->tipo_observacion==0){
                                                        $tabla.= 'No se Solicito Repuesta';
                                                    }
                                                    else if ($rEnlaces->Respuesta){
                                                        $tabla.= "".$rEnlaces->Respuesta;
                                                    }else{
                                                        $tabla.='Esperando Respuesta';
                                                    }
                                           $tabla.="</td>" ;
                                               
                                           $tabla.= "</tr>";
                                            
                                        }
                                    }
                                }
        
                                
                        $tabla.=' </tbody>
                                        </table> ';  


        $tabla.=   '</div>
                    <div role="tabpanel" class="tab-pane" id="vistos">
                        <table class="table table-striped table-hover table-condensed" id="tabla_scroll">
                            <thead>
                                <tr>                                    
                                    <th>
                                        #
                                    </th> 
                                   
                                    <th>
                                        Fecha
                                    </th>
                                    <th>
                                        Usuario
                                    </th>
                                    
                                    <th>
                                        Motivo
                                    </th>
                                    <th>
                                        Respuesta
                                    </th>
                                </tr>
                            </thead>
                            <tbody>';
         
         
                                if (isset($qEnlacesVistos)) {
                                    if ($qEnlacesVistos->num_rows() > 0) {
                                        $i = 0;
                                        foreach ($qEnlacesVistos->result() as $rEnlacesVistos) {
                                            $i++;
                                            
                                           $tabla.= "<tr>";
                                           $tabla.=  "<td>" . $i . "</td>";
                                           /*$tabla.= "<td>
                                                
                                                        <a href='#' data-toggle='modal' data-target='#mod-observacion-documento' role='button'  class='btn btn-xs btn-success' onclick='modificar_observacion_documento(".$rCid->id.")'>
                                                           <span class='glyphicon glyphicon-pencil'></span>
                                                        </a>
                                                        <a href='#' class='btn btn-xs btn-danger' onclick='eliminar_observacion_documento(".$rCid->id.")'>
                                                           <span class='glyphicon glyphicon-remove'></span>
                                                        </a>
                                                     </td> "; */
                                           $tabla.= "<td class='sinwarp'>" .date("d-m-Y h:i:s", strtotime($rEnlacesVistos->Fecha)) . "</td>";
                                           $tabla.="<td>" . $aUsuarios[$rEnlacesVistos->idUsuario] . "</td>"; 
                                                        
                                                
                                           
                                           $tabla.="<td class='text-justify'>" . $rEnlacesVistos->Motivo. "</td>";  
                                           $tabla.="<td class='text-justify'>"; 
                                                    if($rEnlacesVistos->tipo_observacion==0){
                                                        $tabla.= 'No se Solicito Repuesta';
                                                    }
                                                    else if ($rEnlacesVistos->Respuesta){
                                                        $tabla.= "".$rEnlacesVistos->Respuesta;
                                                    }else{
                                                        $tabla.='Esperando Respuesta';
                                                    }
                                           $tabla.="</td>"; 
                                               
                                           $tabla.= "</tr>";
                                            
                                        }
                                    }
                                }
        
                                
                        $tabla.=' </tbody>
                                        </table> ';  
    $tabla.='    </div>
                <div role="tabpanel" class="tab-pane" id="cid">
                        <table class="table table-striped table-hover table-condensed" id="tabla_scroll">
                            <thead>
                                <tr>                                    
                                    <th>
                                        #
                                    </th> 
                                   
                                    <th>
                                        Fecha
                                    </th>
                                    <th>
                                        Usuario
                                    </th>
                                    
                                    <th>
                                        Motivo
                                    </th>
                                    <th>
                                        Respuesta
                                    </th>
                                </tr>
                            </thead>
                            <tbody>';
         
         
                                if (isset($qCid)) {
                                    if ($qCid->num_rows() > 0) {
                                        $i = 0;
                                        foreach ($qCid->result() as $rCid) {
                                            $i++;
                                            
                                           $tabla.= "<tr>";
                                           //$tabla.=  "<td>" . $i . "</td>";
                                           $tabla.= "<td>
                                               
                                                        <a href='#' data-toggle='modal' data-target='#mod-observacion-estimacion' role='button'  class='btn btn-xs btn-success' onclick='modificar_observacion_estimacion(". $rCid->id .")'>
                                                           <span class='glyphicon glyphicon-pencil'></span>
                                                        </a>
                                                        <a href='#' class='btn btn-xs btn-danger' onclick='eliminar_observacion_estimacion(".$rCid->id.")'>
                                                           <span class='glyphicon glyphicon-remove'></span>
                                                        </a>
                                                     </td> "; 
                                           $tabla.= "<td class='sinwarp'>" .date("d-m-Y h:i:s", strtotime($rCid->Fecha)) . "</td>";
                                           $tabla.="<td>" . $aUsuarios[$rCid->idUsuario] . "</td>"; 
                                                        
                                                
                                           
                                           $tabla.="<td class='text-justify'>" . $rCid->Motivo. "</td>";  
                                           $tabla.="<td class='text-justify'>"; 
                                                    if($rCid->tipo_observacion==0){
                                                        $tabla.= 'No se Solicito Repuesta';
                                                    }
                                                    else if ($rCid->Respuesta){
                                                        $tabla.= "".$rCid->Respuesta;
                                                    }else{
                                                        $tabla.='Esperando Respuesta';
                                                    }
                                           $tabla.="</td>"; 
                                               
                                           $tabla.= "</tr>";
                                            
                                        }
                                    }
                                }
        
                                
                        $tabla.=' </tbody>
                                        </table> ';  
    $tabla.='    </div>
                    
                    <div role="tabpanel" class="tab-pane" id="todo">
                        <table class="table table-striped table-hover table-condensed" id="tabla_scroll">
                            <thead>
                                <tr>                                    
                                    <th>
                                        #
                                    </th> 
                                   
                                    <th>
                                        Fecha
                                    </th>
                                    <th>
                                        Usuario
                                    </th>
                                    
                                    <th>
                                        Motivo
                                    </th>
                                    <th>
                                        Respuesta
                                    </th>
                                </tr>
                            </thead>
                            <tbody>';
         
         
                                if (isset($qHistorial)) {
                                    if ($qHistorial->num_rows() > 0) {
                                        $i = 0;
                                        foreach ($qHistorial->result() as $rHistorial) {
                                            $i++;
                                            
                                           $tabla.= "<tr>";
                                           $tabla.=  "<td>" . $i . "</td>";
                                           //$tabla.= "<td>
                                                
                                                       // <a href='#' data-toggle='modal' data-target='#modal-ver-observacion' role='button'  class='btn btn-xs btn-warning' onclick='uf_modificar_observacion(".$rHistorial->id.")'>
                                                       //     <span class='glyphicon glyphicon-search'></span>
                                                      //  </a>
                                                   // </td> "; 
                                           $tabla.= "<td class='sinwarp'>" .date("d-m-Y h:i:s", strtotime($rHistorial->Fecha)) . "</td>";
                                           $tabla.="<td>" . $aUsuarios[$rHistorial->idUsuario] . "</td>"; 
                                                        
                                                
                                           
                                           $tabla.="<td class='text-justify'>" . $rHistorial->Motivo. "</td>";  
                                           $tabla.="<td class='text-justify'>"; 
                                                    if($rHistorial->tipo_observacion==0){
                                                        $tabla.= 'No se Solicito Repuesta';
                                                    }
                                                    else if ($rHistorial->Respuesta){
                                                        $tabla.= "".$rHistorial->Respuesta;
                                                    }else{
                                                        $tabla.='Esperando Respuesta';
                                                    }
                                           $tabla.="</td>";  
                                               
                                           $tabla.= "</tr>";
                                            
                                        }
                                    }
                                }
        
                                
                        $tabla.=' </tbody>
                                        </table> ';                        
                                
    $tabla.=     '</div>
                  
                </div>

            </div>';
                
         /*
         
        $tabla='  <table class="table table-striped table-hover table-condensed" id="tabla_scroll">
                            <thead>
                                <tr>                                    
                                    <th>
                                        #
                                    </th> 
                                   
                                    <th>
                                        Fecha
                                    </th>
                                    <th>
                                        Usuario
                                    </th>
                                    
                                    <th>
                                        Motivo
                                    </th>
                                    <th>
                                        Respuesta
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
         ';
         
         
                                if (isset($qHistorial)) {
                                    if ($qHistorial->num_rows() > 0) {
                                        $i = 0;
                                        foreach ($qHistorial->result() as $rHistorial) {
                                            $i++;
                                            
                                           $tabla.= "<tr>";
                                           $tabla.=  "<td>" . $i . "</td>";
                                           //$tabla.= "<td>
                                                
                                                       // <a href='#' data-toggle='modal' data-target='#modal-ver-observacion' role='button'  class='btn btn-xs btn-warning' onclick='uf_modificar_observacion(".$rHistorial->id.")'>
                                                       //     <span class='glyphicon glyphicon-search'></span>
                                                      //  </a>
                                                   // </td> "; 
                                           $tabla.= "<td class='sinwarp'>" .date("d-m-Y h:i:s", strtotime($rHistorial->Fecha)) . "</td>";
                                           $tabla.="<td>" . $aUsuarios[$rHistorial->idUsuario] . "</td>"; 
                                                        
                                                
                                           
                                           $tabla.="<td class='text-justify'>" . $rHistorial->Motivo. "</td>";  
                                           $tabla.="<td class='text-justify'>" . $rHistorial->Respuesta. "</td>"; 
                                               
                                           $tabla.= "</tr>";
                                            
                                        }
                                    }
                                }
        
                                
        $tabla.=' </tbody>
                        </table> ';       */                  
                                
        $data=array();
        $data["historial"]=$tabla;
                                
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');
        echo json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);                      
         
    }
    
    
    
    
    public function ver_observaciones_documento_direccion($idArchivo ,$idTipoProceso, $idSubTipoProceso,$idDocumento) {
        $this->load->model('observaciones_model');
        $this->load->model('control_usuarios_model');
        
         
        $aUsuarios=$this->control_usuarios_model->addw_Usuarios();
       
        $direccion =  $this->session->userdata('idDireccion_responsable');
        $qHistorial=$this->observaciones_model->listado_observaciones_documento($idArchivo, $idTipoProceso, $idSubTipoProceso, $idDocumento, $direccion);
         
         
         $tabla='
         
         
          <table class="table table-striped table-hover table-condensed" id="tabla_scroll">
                            <thead>
                                <tr>                                    
                                    <th>
                                        #
                                    </th> 
                                   
                                    <th>
                                        Fecha
                                    </th>
                                    <th>
                                        Usuario
                                    </th>
                                    
                                    <th>
                                        Motivo
                                    </th>
                                    <th>
                                        Respuesta
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
         ';
         
         
                                if (isset($qHistorial)) {
                                    if ($qHistorial->num_rows() > 0) {
                                        $i = 0;
                                        foreach ($qHistorial->result() as $rHistorial) {
                                            $i++;
                                            
                                           $tabla.= "<tr>";
                                           //$tabla.=  "<td>" . $i . "</td>";
                                           $tabla.= "<td>
                                                
                                                        <a href='#' data-toggle='modal' data-target='#mod-observacion-documento' role='button'  class='btn btn-xs btn-success' onclick='modificar_observacion_documento(".$rHistorial->id.")'>
                                                           <span class='glyphicon glyphicon-pencil'></span>
                                                        </a>
                                                        <a href='#' class='btn btn-xs btn-danger' onclick='eliminar_observacion_documento(".$rHistorial->id.")'>
                                                           <span class='glyphicon glyphicon-remove'></span>
                                                        </a>
                                                     </td> "; 
                                           $tabla.= "<td class='sinwarp'>" .date("d-m-Y h:i:s", strtotime($rHistorial->Fecha)) . "</td>";
                                           $tabla.="<td>" . $aUsuarios[$rHistorial->idUsuario] . "</td>"; 
                                                        
                                                
                                           
                                           $tabla.="<td class='text-justify'>" . $rHistorial->Motivo. "</td>";  
                                           $tabla.="<td class='text-justify'>" ;
                                                if ( $rHistorial->tipo_observacion == 1) { 
                                                   $tabla.= $rHistorial->Respuesta ;

                                                } else { 
                                                    $tabla.= "No Requerida";
                                                }
                                                
                                           $tabla.= "</td>"; 
                                               
                                           $tabla.= "</tr>";
                                            
                                        }
                                    }
                                }
        
                                
        $tabla.=' </tbody>
                        </table> ';                        
                                
        $data=array();
        $data["historial"]=$tabla;
                                
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');
        echo json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);                      
         
    }
    
    
    public function ver_observaciones_estimacion_direccion($idEstimacion) {
        $this->load->model('observaciones_estimacion_model');
        $this->load->model('control_usuarios_model');
        
         
        $aUsuarios=$this->control_usuarios_model->addw_Usuarios();
       
        $direccion =  $this->session->userdata('idDireccion_responsable');
        $qHistorial=$this->observaciones_estimacion_model->listado_observaciones_estimacion_direccion($idEstimacion, $direccion);
         
         
         $tabla='
         
         
          <table class="table table-striped table-hover table-condensed" id="tabla_scroll">
                            <thead>
                                <tr>                                    
                                    <th>
                                        #
                                    </th> 
                                   
                                    <th>
                                        Fecha
                                    </th>
                                    <th>
                                        Usuario
                                    </th>
                                    
                                    <th>
                                        Motivo
                                    </th>
                                    <th>
                                        Respuesta
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
         ';
         
         
                                if (isset($qHistorial)) {
                                    if ($qHistorial->num_rows() > 0) {
                                        $i = 0;
                                        foreach ($qHistorial->result() as $rHistorial) {
                                            $i++;
                                            
                                           $tabla.= "<tr>";
                                           //$tabla.=  "<td>" . $i . "</td>";
                                           $tabla.= "<td>
                                                
                                                        <a href='#' data-toggle='modal' data-target='#mod-observacion-estimacion' role='button'  class='btn btn-xs btn-success' onclick='modificar_observacion_estimacion(". $rHistorial->id .")'>
                                                           <span class='glyphicon glyphicon-pencil'></span>
                                                        </a>
                                                        <a href='#' class='btn btn-xs btn-danger' onclick='eliminar_observacion_estimacion(".$rHistorial->id.")'>
                                                           <span class='glyphicon glyphicon-remove'></span>
                                                        </a>
                                                     </td> "; 
                                           $tabla.= "<td class='sinwarp'>" .date("d-m-Y h:i:s", strtotime($rHistorial->Fecha)) . "</td>";
                                           $tabla.="<td>" . $aUsuarios[$rHistorial->idUsuario] . "</td>"; 
                                                        
                                                
                                           
                                           $tabla.="<td class='text-justify'>" . $rHistorial->Motivo. "</td>";  
                                           $tabla.="<td class='text-justify'>" ;
                                                if ( $rHistorial->tipo_observacion == 1) { 
                                                   $tabla.= $rHistorial->Respuesta ;

                                                } else { 
                                                    $tabla.= "No Requerida";
                                                }
                                                
                                           $tabla.= "</td>"; 
                                               
                                           $tabla.= "</tr>";
                                            
                                        }
                                    }
                                }
        
                                
        $tabla.=' </tbody>
                        </table> ';                        
                                
        $data=array();
        $data["historial"]=$tabla;
                                
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');
        echo json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);                      
         
    }
    
    public function agregar_observaciones_por_archivo($idArchivo) {
        $this->load->model('observaciones_model');
        
        $data =array(
            
            'Motivo'    => $this->input->post("motivo_observacion_archivo"),
            'Fecha'     => date('Y-m-d H:i:s'),
            'idUsuario' => $this->session->userdata('id'),
            'idDireccion_responsable' =>  $this->session->userdata('idDireccion_responsable'),
            'idArchivo' => $idArchivo,
            'idDireccion' => $this->input->post("idDireccion_Archivo"),
            'idContrato' => $this->input->post("idContrato_Archivo"),
            
        );
        
        
        
        $retorno = $this->observaciones_model->agregar_observaciones_por_archivo($data);
       
       
        
        if($retorno['retorno'] < 0){
            header('Location:'.site_url('archivo/cambios/' .$idArchivo . '/' .$retorno['error']));
        }
        else{
            
            header('Location:'.site_url('archivo/cambios/' .$idArchivo)); 
        }
        
    }
    
     /*public function () {
        $this->load->model('observaciones_model');
        
        
        $idArchivo=$this->input->post("idArchivo_observacion");
        
        
        
        $data =array(
            
            'Motivo'    => $this->input->post("motivo"),
            'Fecha'     => date('Y-m-d H:i:s'),
            'idUsuario' => $this->session->userdata('id'),
            'idDireccion_responsable' =>  $this->session->userdata('idDireccion_responsable'),
            'idArchivo' => $this->input->post("idArchivo_observacion"),
            'idTipoProceso' => $this->input->post("idTipoProceso_observacion"),
            'idSubTipoProceso' => $this->input->post("idSubTipoProceso_observacion"),
            'idDocumento' => $this->input->post("idDocumento_observacion"),
            
        );
        
        
        
        $retorno = $this->observaciones_model->agregar_observaciones_por_documento($data);
       
       
        
        if($retorno['retorno'] < 0){
            header('Location:'.site_url('archivo/cambios/' .$idArchivo . '/' .$retorno['error']));
        }
        else{
            
            header('Location:'.site_url('archivo/cambios/' .$idArchivo)); 
        }
        
    }*/
    
    public function ver_observaciones_archivo($idArchivo) {
        $this->load->model('observaciones_model');
        $this->load->model('control_usuarios_model');
        
         
        $aUsuarios=$this->control_usuarios_model->addw_Usuarios();
       
        
         
        $qHistorial=$this->observaciones_model->listado_observaciones_archivo($idArchivo);
         
         
         $tabla='
         
         
          <table class="table table-striped table-hover table-condensed" id="tabla_scroll">
                            <thead>
                                <tr>                                    
                                    <th>
                                        #
                                    </th> 
                                   
                                    <th>
                                        Fecha
                                    </th>
                                    <th>
                                        Usuario
                                    </th>
                                    
                                    <th>
                                        Motivo
                                    </th>
                                    <th>
                                        Respuesta
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
         ';
         
         
                                if (isset($qHistorial)) {
                                    if ($qHistorial->num_rows() > 0) {
                                        $i = 0;
                                        foreach ($qHistorial->result() as $rHistorial) {
                                            $i++;
                                            
                                           $tabla.= "<tr>";
                                           //$tabla.=  "<td>" . $i . "</td>";
                                           $tabla.= "<td>
                                                
                                                        <a href='#' data-toggle='modal' data-target='#modal-ver-observacion' role='button'  class='btn btn-xs btn-warning' onclick='uf_modificar_observacion(".$rHistorial->id.")'>
                                                            <span class='glyphicon glyphicon-search'></span>
                                                        </a>
                                                    </td> "; 
                                           $tabla.= "<td class='sinwarp'>" .date("d-m-Y h:i:s", strtotime($rHistorial->Fecha)) . "</td>";
                                           $tabla.="<td>" . $aUsuarios[$rHistorial->idUsuario] . "</td>"; 
                                                        
                                                
                                           
                                           $tabla.="<td class='text-justify'>" . $rHistorial->Motivo. "</td>";  
                                           $tabla.="<td class='text-justify'>" . $rHistorial->Respuesta. "</td>"; 
                                               
                                           $tabla.= "</tr>";
                                            
                                        }
                                    }
                                }
        
                                
        $tabla.=' </tbody>
                        </table> ';                        
                                
        $data=array();
        $data["historial"]=$tabla;
                                
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');
        echo json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);                      
         
    }
    
    public function ver_observaciones_documento_por_archivo($idArchivo) {
        $this->load->model('observaciones_model');
        $this->load->model('control_usuarios_model');
        
         
        $aUsuarios=$this->control_usuarios_model->addw_Usuarios();
       
        
         
        $qHistorial=$this->observaciones_model->listado_observaciones_documento_por_archivo($idArchivo);
         
         
         $tabla='
         
         
          <table class="table table-striped table-hover table-condensed" id="tabla_scroll">
                            <thead>
                                <tr>                                    
                                    <th>
                                        #
                                    </th> 
                                   
                                    <th>
                                        Fecha
                                    </th>
                                    <th>
                                        Usuario
                                    </th>
                                    
                                    <th>
                                        Motivo
                                    </th>
                                    <th>
                                        Respuesta
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
         ';
         
         
                                if (isset($qHistorial)) {
                                    if ($qHistorial->num_rows() > 0) {
                                        $i = 0;
                                        foreach ($qHistorial->result() as $rHistorial) {
                                            $i++;
                                            
                                           $tabla.= "<tr>";
                                           $tabla.=  "<td>" . $i . "</td>";
                                           /*$tabla.= "<td>
                                                
                                                        <a href='#' data-toggle='modal' data-target='#modal-ver-observacion' role='button'  class='btn btn-xs btn-warning' onclick='uf_modificar_observacion(".$rHistorial->id.")'>
                                                            <span class='glyphicon glyphicon-search'></span>
                                                        </a>
                                                    </td> "; */
                                           $tabla.= "<td class='sinwarp'>" .date("d-m-Y h:i:s", strtotime($rHistorial->Fecha)) . "</td>";
                                           $tabla.="<td>" . $aUsuarios[$rHistorial->idUsuario] . "</td>"; 
                                                        
                                                
                                           
                                           $tabla.="<td class='text-justify'>" . $rHistorial->Motivo. "</td>";  
                                           $tabla.="<td class='text-justify'>" . $rHistorial->Respuesta. "</td>"; 
                                               
                                           $tabla.= "</tr>";
                                            
                                        }
                                    }
                                }
        
                                
        $tabla.=' </tbody>
                        </table> ';                        
                                
        $data=array();
        $data["historial"]=$tabla;
                                
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');
        echo json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);                      
         
    }
    
    public function ver_historia_bloque($idArchivo,$idTipoProceso) {
         $this->load->model('rel_archivo_documento_model');
         $this->load->model('control_usuarios_model');
         $this->load->model('datos_model');
         
         $aUsuarios=$this->control_usuarios_model->addw_Usuarios();
       
         $addw_Estatus_Bloque= $this->datos_model->addw_Estatus_Bloque();
         
         $qHistorial=$this->rel_archivo_documento_model->listado_historial_bloque($idArchivo,$idTipoProceso);
         
         
         $tabla='
         
         
          <table class="table table-striped table-hover table-condensed" id="tabla_scroll">
                            <thead>
                                <tr>                                    
                                    <th>
                                        #
                                    </th>                                    
                                    <th>
                                        Fecha
                                    </th>
                                    <th>
                                        Usuario
                                    </th>
                                    <th>
                                        Estatus
                                    </th>
                                    <th>
                                        Motivo
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
         ';
         
         
                                if (isset($qHistorial)) {
                                    if ($qHistorial->num_rows() > 0) {
                                        $i = 0;
                                        foreach ($qHistorial->result() as $rHistorial) {
                                            $i++;
                                            
                                           $tabla.= "<tr>";
                                           $tabla.=  "<td>" . $i . "</td>";
                                           $tabla.= "<td class='sinwarp'>" .date("d-m-Y h:i:s", strtotime($rHistorial->Fecha)) . "</td>";
                                           $tabla.="<td>" . $aUsuarios[$rHistorial->idUsuario] . "</td>"; 
                                                        
                                                
                                           $tabla.="<td>" . $addw_Estatus_Bloque[$rHistorial->Estatus]. "</td>";
                                           $tabla.="<td class='text-justify'>" . $rHistorial->Motivo. "</td>";     
                                               
                                           $tabla.= "</tr>";
                                            
                                        }
                                    }
                                }
        
                                
        $tabla.=' </tbody>
                        </table> ';                        
                                
        $data=array();
        $data["historial"]=$tabla;
                                
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');
        echo json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);                      
         
         
    }
    
    public function listado_documentos_por_proceso($idProceso, $idArchivo){
         $this->load->model('documentos_model');
         
         $qListado = $this->documentos_model->listado_documentos_por_proceso($idProceso);
         //echo $idArchivo;
         //exit();
         
         $tabla='
         
         
          <table class="table table-striped table-hover table-condensed" id="tabla_documentos">
                            <thead>
                                <tr>                                    
                                    <th>
                                        Accion
                                    </th>                                    
                                    <th>
                                        SubProceso
                                    </th>
                                    <th>
                                        Documento
                                    </th>
                                    
                                </tr>
                            </thead>
                            <tbody>
         ';
         
         
                                if (isset($qListado)) {
                                    if ($qListado->num_rows() > 0) {
                                        //echo 'Hola';
                                        foreach ($qListado->result() as $rListado) {
                                            //$i++;
                                            
                                           $tabla.= "<tr>";
                                           $tabla.=  "<td><small><a href='#' class='btn btn-default btn-xs'  id='' onclick='imprimir_documento_agregado(" . $rListado->id ."," .$rListado->idProceso . "," . $rListado->idSubproceso . "," .$idArchivo . ")'>Agregar</a></small></td>";
                                           $tabla.= "<td class='sinwarp'>" . $rListado->SubTipoProceso . "</td>";
                                           $tabla.="<td>" . $rListado->Nombre . "</td>"; 
                                                        
                                                
                                           
                                            
                                        }
                                    }
                                }
        
                                
        $tabla.=' </tbody>
                        </table> ';                        
                                
        $data=array();
        $data["listado"]=$tabla;
                                
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');
        echo json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);                      
         
         
    }
    
    
    public function agregar_relacion_archivo_documento($idDocumento, $idProceso, $idSubProceso, $idArchivo){
        $this->load->model('rel_archivo_documento_model');
        
        $data=array(
            'idDocumento'       =>  $idDocumento,
            'idTipoProceso'     =>  $idProceso,
            'idSubTipoProceso'  =>  $idSubProceso,
            'idArchivo'         =>  $idArchivo,
            //'Estatus'=>  $this->input->post('Estatus'),
        ); 
        
        $retorno =$this->rel_archivo_documento_model->agregar_relacion_archivo_documento($data);
        
        
        
        if($retorno['retorno'] < 0)
            header('Location:'.site_url('archivo/cambios/' . $idArchivo . '/' . $retorno['error']));
        else
            header('Location:'.site_url('archivo/cambios/'. $idArchivo )); 
    }
    
    public function eliminar_relacion_archivo_documento($id, $idArchivo){
        $this->load->model('rel_archivo_documento_model');
        
        
        $retorno=  $this->rel_archivo_documento_model->eliminar_relacion_archivo_documento($id);
        if($retorno['retorno'] < 0)
            header('Location:'.site_url('archivo/cambios/' . $idArchivo . '/' . $retorno['error']));
        else
            header('Location:'.site_url('archivo/cambios/'. $idArchivo ));
    }

    



    public function ver_observaciones_bloque($idArchivo,$idTipoProceso,$idSubTipoProceso,$idDocumento) {
         $this->load->model('rel_archivo_documento_model');
         $this->load->model('control_usuarios_model');
         $this->load->model('datos_model');
         
         $aUsuarios=$this->control_usuarios_model->addw_Usuarios();
       
         $addw_Estatus_Bloque= $this->datos_model->addw_Estatus_Bloque();
         
         $qHistorial=$this->rel_archivo_documento_model->listado_observaciones_bloque($idArchivo,$idTipoProceso,$idSubTipoProceso,$idDocumento);
         
         
         $tabla='
         
         
          <table class="table table-striped table-hover table-condensed" id="tabla_scroll">
                            <thead>
                                <tr>                                    
                                    <th>
                                        #
                                    </th>                                    
                                    <th>
                                        Fecha
                                    </th>
                                    <th>
                                        Usuario
                                    </th>
                                    <th>
                                        Estatus
                                    </th>
                                    <th>
                                        Motivo
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
         ';
         
         
                                if (isset($qHistorial)) {
                                    if ($qHistorial->num_rows() > 0) {
                                        $i = 0;
                                        foreach ($qHistorial->result() as $rHistorial) {
                                            $i++;
                                            
                                           $tabla.= "<tr>";
                                           $tabla.=  "<td>" . $i . "</td>";
                                           $tabla.= "<td class='sinwarp'>" .date("d-m-Y h:i:s", strtotime($rHistorial->Fecha)) . "</td>";
                                           $tabla.="<td>" . $aUsuarios[$rHistorial->idUsuario] . "</td>"; 
                                                        
                                                
                                           $tabla.="<td>" . $addw_Estatus_Bloque[$rHistorial->Estatus]. "</td>";
                                           $tabla.="<td class='text-justify'>" . $rHistorial->Motivo. "</td>";     
                                               
                                           $tabla.= "</tr>";
                                            
                                        }
                                    }
                                }
        
                                
        $tabla.=' </tbody>
                        </table> ';                        
                                
        $data=array();
        $data["historial"]=$tabla;
                                
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');
        echo json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);                      
         
         
    }
  
    
    
    
    public function ver_ubicaciones_libres() {
        $this->load->model("ubicacion_fisica_model");
        $this->load->model("rel_archivo_documento_model");
        
        $qColumnas=$this->ubicacion_fisica_model->listado_ubicacion_ordenada_por_columna();
        
         
         
         $tabla='
         
         
          <table class="table table-striped table-hover table-condensed" id="tabla_scroll">
                            <thead>
                                <tr>                                    
                                                                      
       ';                                    

                  
                                                    foreach ($qColumnas->result() as $rowdata){ 
                                                        $tabla.=' <th scope="col">' .  $rowdata->Columna .'</th>';
                                                     }
                 
        $tabla.='         

                                </tr>
                            </thead>
                            <tbody>
         ';
         
         
                                for( $i= 1 ; $i <= 4 ; $i++ ){
                                     $tabla.= "<tr>";
                                    foreach ($qColumnas->result() as $rowdata){

                                               $qCajas=$this->ubicacion_fisica_model->listado_ubicacion_ordenada_por_caja($rowdata->Columna,$i);
                                               $Ubicaciones_disponibles="";
                                               foreach ($qCajas->result() as $rRow_cajas) { 
                                                   
                                                   $Ubicacion_fisica=$rRow_cajas->Columna .'.'. $rRow_cajas->Fila .'.'. $rRow_cajas->Posicion.'.'. $rRow_cajas->Caja.'.'. $rRow_cajas->Apartado;
                                                  
                                                   if ($rRow_cajas->utilizado==0){
                                                        $click="uf_agregar_ubicacion_fisica(".$rRow_cajas->id.",'". $rRow_cajas->Columna .'.'. $rRow_cajas->Fila .'.'. $rRow_cajas->Posicion.'.'. $rRow_cajas->Caja.'.'. $rRow_cajas->Apartado ."')";
                                                        $estilo = "background:#cde7f9;color:#000;";
                                                        $Ubicaciones_disponibles.='<a href="#" style= '.$estilo.' onclick='.$click.'>' . $rRow_cajas->Columna .'.'. $rRow_cajas->Fila .'.'. $rRow_cajas->Posicion.'.'. $rRow_cajas->Caja.'.'. $rRow_cajas->Apartado . '</a>';
                                                   }else{
                                                        //$Ubicaciones_disponibles.=$Ubicacion_fisica;
                                                       $estilo = "background:#D8D8D8;color:#000";
                                                       $Ubicaciones_disponibles.= '<a  style= '.$estilo. '>'. $Ubicacion_fisica . '</a>';
                                                   }
                                                   $Ubicaciones_disponibles.="<br>";
                                               }
                                               
                                                
                                                $tabla.="<td class='text-justify'>" . $Ubicaciones_disponibles .  "</td>";  
                                               
                                               
                                        }
                                    $tabla.= "</tr>";    
                                 }   
       
        $tabla.=' </tbody>
                        </table> ';                        
                                
        $data=array();
        $data["ubicacion_fisica_libre"]=$tabla;
                                
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');
        echo json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);                      
         
         
    }
    
    /*public function ver_ubicaciones_libres_area($idArea) {
        $this->load->model("ubicacion_fisica_model");
        $this->load->model("rel_archivo_documento_model");
        $this->load->model("datos_model");
        
        $row = $this->datos_model->buscar_area($idArea);
        
        $desde = ' ';
        $hasta = ' ';
        if (isset($row))
        {
            
                $desde = $row['deFila'];   // access attributes
                $hasta = $row['hastaFila'];   // access class methods
        }
        
        //$desde = 'A';
        //$hasta = 'G';
    
        //echo $desde . ' ' . $hasta;
        //exit();
        $qColumnas=$this->ubicacion_fisica_model->listado_ubicacion_ordenada_por_columna_area($desde, $hasta);
        
         
         
         $tabla='
         
         
          <table class="table table-striped table-hover table-condensed" id="tabla_scroll">
                            <thead>
                                <tr>                                    
                                                                      
       ';                                    

                  
                                                    foreach ($qColumnas->result() as $rowdata){ 
                                                        $tabla.=' <th scope="col">' .  $rowdata->Columna .'</th>';
                                                     }
                 
        $tabla.='         

                                </tr>
                            </thead>
                            <tbody>
         ';
         
         
                                for( $i= 1 ; $i <= 4 ; $i++ ){
                                     $tabla.= "<tr>";
                                    foreach ($qColumnas->result() as $rowdata){

                                               $qCajas=$this->ubicacion_fisica_model->listado_ubicacion_ordenada_por_caja($rowdata->Columna,$i);
                                               $Ubicaciones_disponibles="";
                                               foreach ($qCajas->result() as $rRow_cajas) { 
                                                   
                                                   $Ubicacion_fisica=$rRow_cajas->Columna .'.'. $rRow_cajas->Fila .'.'. $rRow_cajas->Posicion.'.'. $rRow_cajas->Caja.'.'. $rRow_cajas->Apartado;
                                                  
                                                   if ($rRow_cajas->utilizado==0){
                                                        $click="uf_agregar_ubicacion_fisica(".$rRow_cajas->id.",'". $rRow_cajas->Columna .'.'. $rRow_cajas->Fila .'.'. $rRow_cajas->Posicion.'.'. $rRow_cajas->Caja.'.'. $rRow_cajas->Apartado ."')";
                                                        $estilo = "background:#cde7f9;color:#000;";
                                                        $Ubicaciones_disponibles.='<a href="#" style= '.$estilo.' onclick='.$click.'>' . $rRow_cajas->Columna .'.'. $rRow_cajas->Fila .'.'. $rRow_cajas->Posicion.'.'. $rRow_cajas->Caja.'.'. $rRow_cajas->Apartado . '</a>';
                                                   }else{
                                                        //$Ubicaciones_disponibles.=$Ubicacion_fisica;
                                                       $estilo = "background:#D8D8D8;color:#000";
                                                       $Ubicaciones_disponibles.= '<p  style= '.$estilo. '>'. $Ubicacion_fisica . '</p>';
                                                   }
                                                   $Ubicaciones_disponibles.="<br>";
                                               }
                                               
                                                
                                                $tabla.="<td class='text-justify'>" . $Ubicaciones_disponibles .  "</td>";  
                                               
                                               
                                        }
                                    $tabla.= "</tr>";    
                                 }   
       
        $tabla.=' </tbody>
                        </table> ';                        
                                
        $data=array();
        $data["ubicacion_fisica_libre"]=$tabla;
                                
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');
        echo json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);                      
         
         
    }*/
    
    
    public function ver_ubicaciones_libres_area($idArea, $idArchivo) {
        $this->load->model("ubicacion_fisica_model");
        $this->load->model("rel_archivo_documento_model");
        $this->load->model("datos_model");
        
        $row = $this->datos_model->buscar_area($idArea);
        
        $desde = ' ';
        $hasta = ' ';
        if (isset($row))
        {
            
                $desde = $row['deFila'];   // access attributes
                $hasta = $row['hastaFila'];   // access class methods
        }
        
        //$desde = 'A';
        //$hasta = 'G';
    
        //echo $desde . ' ' . $hasta;
        //exit();
        $qColumnas=$this->ubicacion_fisica_model->listado_ubicacion_ordenada_por_columna_area($desde, $hasta);
       /* $qUbicacionOcupadaArchivo = $this->ubicacion_fisica_model->ubicacion_ocupada_archivo(366,1717);
        if ($qUbicacionOcupadaArchivo->num_rows() < 0) {
            echo 'Ocupada en archivo';
        }
        else{
            echo 'No';
        }
        exit();*/
         
         $tabla='
         
         
          <table class="table table-striped table-hover table-condensed" id="tabla_scroll">
                            <thead>
                                <tr>                                    
                                                                      
       ';                                    

                  
                                                    foreach ($qColumnas->result() as $rowdata){ 
                                                        $tabla.=' <th scope="col">' .  $rowdata->Columna .'</th>';
                                                     }
                 
        $tabla.='         

                                </tr>
                            </thead>
                            <tbody>
         ';
         
         
                                for( $i= 1 ; $i <= 4 ; $i++ ){
                                     $tabla.= "<tr>";
                                    foreach ($qColumnas->result() as $rowdata){

                                               $qCajas=$this->ubicacion_fisica_model->listado_ubicacion_ordenada_por_caja($rowdata->Columna,$i);
                                               $Ubicaciones_disponibles="";
                                               foreach ($qCajas->result() as $rRow_cajas) { 
                                                   
                                                   $Ubicacion_fisica=$rRow_cajas->Columna .'.'. $rRow_cajas->Fila .'.'. $rRow_cajas->Posicion.'.'. $rRow_cajas->Caja.'.'. $rRow_cajas->Apartado;
                                                   $qUbicacionOcupadaArchivo = $this->ubicacion_fisica_model->ubicacion_ocupada_archivo($rRow_cajas->id,$idArchivo);
                                                   
                                                   if ($rRow_cajas->utilizado==0 || $qUbicacionOcupadaArchivo->num_rows() > 0){
                                                       
                                                        $click="uf_agregar_ubicacion_fisica(".$rRow_cajas->id.",'". $rRow_cajas->Columna .'.'. $rRow_cajas->Fila .'.'. $rRow_cajas->Posicion.'.'. $rRow_cajas->Caja.'.'. $rRow_cajas->Apartado ."')";
                                                        $estilo = "background:#cde7f9;color:#000;";
                                                        $Ubicaciones_disponibles.='<a href="#" style= '.$estilo.' onclick='.$click.'>' . $rRow_cajas->Columna .'.'. $rRow_cajas->Fila .'.'. $rRow_cajas->Posicion.'.'. $rRow_cajas->Caja.'.'. $rRow_cajas->Apartado . '</a>';
                                                   }else {
                                                       
                                                             //$Ubicaciones_disponibles.=$Ubicacion_fisica;
                                                            $estilo = "background:#D8D8D8;color:#000";
                                                            $Ubicaciones_disponibles.= '<a  style= '.$estilo. '>'. $Ubicacion_fisica . '</a>';
                                                        
                                                   }
                                                   
                                                   
                                                   
                                                   
                                                   $Ubicaciones_disponibles.="<br>";
                                               }
                                               
                                                
                                                $tabla.="<td class='text-justify'>" . $Ubicaciones_disponibles .  "</td>";  
                                               
                                               
                                        }
                                    $tabla.= "</tr>";    
                                 }   
       
        $tabla.=' </tbody>
                        </table> ';                        
        
        //exit();
        $data=array();
        $data["ubicacion_fisica_libre"]=$tabla;
                                
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');
        echo json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);                      
         
         
    }
    
    
    public function ver_ubicaciones_libres_captura($idArchivo) {
        $this->load->model("ubicacion_fisica_model");
        $this->load->model("rel_archivo_documento_model");
        $this->load->model("datos_model");
        
       
       
            
                $desde = 'A';   // access attributes
                $hasta = 'P';   // access class methods
     
        
        //$desde = 'A';
        //$hasta = 'G';
    
        //echo $desde . ' ' . $hasta;
        //exit();
        $qColumnas=$this->ubicacion_fisica_model->listado_ubicacion_ordenada_por_columna_area($desde, $hasta);
       /* $qUbicacionOcupadaArchivo = $this->ubicacion_fisica_model->ubicacion_ocupada_archivo(366,1717);
        if ($qUbicacionOcupadaArchivo->num_rows() < 0) {
            echo 'Ocupada en archivo';
        }
        else{
            echo 'No';
        }
        exit();*/
         
         $tabla='
         
         
          <table class="table table-striped table-hover table-condensed" id="tabla_scroll">
                            <thead>
                                <tr>                                    
                                                                      
       ';                                    

                  
                                                    foreach ($qColumnas->result() as $rowdata){ 
                                                        $tabla.=' <th scope="col">' .  $rowdata->Columna .'</th>';
                                                     }
                 
        $tabla.='         

                                </tr>
                            </thead>
                            <tbody>
         ';
         
         
                                for( $i= 1 ; $i <= 4 ; $i++ ){
                                     $tabla.= "<tr>";
                                    foreach ($qColumnas->result() as $rowdata){

                                               $qCajas=$this->ubicacion_fisica_model->listado_ubicacion_ordenada_por_caja($rowdata->Columna,$i);
                                               $Ubicaciones_disponibles="";
                                               foreach ($qCajas->result() as $rRow_cajas) { 
                                                   
                                                   $Ubicacion_fisica=$rRow_cajas->Columna .'.'. $rRow_cajas->Fila .'.'. $rRow_cajas->Posicion.'.'. $rRow_cajas->Caja.'.'. $rRow_cajas->Apartado;
                                                   $qUbicacionOcupadaArchivo = $this->ubicacion_fisica_model->ubicacion_ocupada_archivo($rRow_cajas->id,$idArchivo);
                                                   
                                                   if ($rRow_cajas->utilizado==0 || $qUbicacionOcupadaArchivo->num_rows() > 0){
                                                       
                                                        $click="uf_agregar_ubicacion_fisica(".$rRow_cajas->id.",'". $rRow_cajas->Columna .'.'. $rRow_cajas->Fila .'.'. $rRow_cajas->Posicion.'.'. $rRow_cajas->Caja.'.'. $rRow_cajas->Apartado ."')";
                                                        $estilo = "background:#cde7f9;color:#000;";
                                                        $Ubicaciones_disponibles.='<a href="#" style= '.$estilo.' onclick='.$click.'>' . $rRow_cajas->Columna .'.'. $rRow_cajas->Fila .'.'. $rRow_cajas->Posicion.'.'. $rRow_cajas->Caja.'.'. $rRow_cajas->Apartado . '</a>';
                                                   }else {
                                                       
                                                             //$Ubicaciones_disponibles.=$Ubicacion_fisica;
                                                            $estilo = "background:#D8D8D8;color:#000";
                                                            $Ubicaciones_disponibles.= '<a  style= '.$estilo. '>'. $Ubicacion_fisica . '</a>';
                                                        
                                                   }
                                                   
                                                   
                                                   
                                                   
                                                   $Ubicaciones_disponibles.="<br>";
                                               }
                                               
                                                
                                                $tabla.="<td class='text-justify'>" . $Ubicaciones_disponibles .  "</td>";  
                                               
                                               
                                        }
                                    $tabla.= "</tr>";    
                                 }   
       
        $tabla.=' </tbody>
                        </table> ';                        
        
        //exit();
        $data=array();
        $data["ubicacion_fisica_libre"]=$tabla;
                                
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');
        echo json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);                      
         
         
    }
    
    
    public function ver_ubicaciones_libres_mod($idArea, $idArchivo) {
        $this->load->model("ubicacion_fisica_model");
        $this->load->model("rel_archivo_documento_model");
        $this->load->model("datos_model");
        
        $row = $this->datos_model->buscar_area($idArea);
        
        $desde = ' ';
        $hasta = ' ';
        if (isset($row))
        {
            
                $desde = $row['deFila'];   // access attributes
                $hasta = $row['hastaFila'];   // access class methods
        }
        
        //$desde = 'A';
        //$hasta = 'G';
    
        //echo $desde . ' ' . $hasta;
        //exit();
        $qColumnas=$this->ubicacion_fisica_model->listado_ubicacion_ordenada_por_columna_area($desde, $hasta);
       /* $qUbicacionOcupadaArchivo = $this->ubicacion_fisica_model->ubicacion_ocupada_archivo(366,1717);
        if ($qUbicacionOcupadaArchivo->num_rows() < 0) {
            echo 'Ocupada en archivo';
        }
        else{
            echo 'No';
        }
        exit();*/
         
         $tabla='
         
         
          <table class="table table-striped table-hover table-condensed" id="tabla_scroll">
                            <thead>
                                <tr>                                    
                                                                      
       ';                                    

                  
                                                    foreach ($qColumnas->result() as $rowdata){ 
                                                        $tabla.=' <th scope="col">' .  $rowdata->Columna .'</th>';
                                                     }
                 
        $tabla.='         

                                </tr>
                            </thead>
                            <tbody>
         ';
         
         
                                for( $i= 1 ; $i <= 4 ; $i++ ){
                                     $tabla.= "<tr>";
                                    foreach ($qColumnas->result() as $rowdata){

                                               $qCajas=$this->ubicacion_fisica_model->listado_ubicacion_ordenada_por_caja($rowdata->Columna,$i);
                                               $Ubicaciones_disponibles="";
                                               foreach ($qCajas->result() as $rRow_cajas) { 
                                                   
                                                   $Ubicacion_fisica=$rRow_cajas->Columna .'.'. $rRow_cajas->Fila .'.'. $rRow_cajas->Posicion.'.'. $rRow_cajas->Caja.'.'. $rRow_cajas->Apartado;
                                                   $qUbicacionOcupadaArchivo = $this->ubicacion_fisica_model->ubicacion_ocupada_archivo($rRow_cajas->id,$idArchivo);
                                                   
                                                   if ($rRow_cajas->utilizado==0 || $qUbicacionOcupadaArchivo->num_rows() > 0){
                                                       
                                                        $click="uf_agregar_ubicacion_fisica_mod(".$rRow_cajas->id.",'". $rRow_cajas->Columna .'.'. $rRow_cajas->Fila .'.'. $rRow_cajas->Posicion.'.'. $rRow_cajas->Caja.'.'. $rRow_cajas->Apartado ."')";
                                                        $estilo = "background:#cde7f9;color:#000;";
                                                        $Ubicaciones_disponibles.='<a href="#" style= '.$estilo.' onclick='.$click.'>' . $rRow_cajas->Columna .'.'. $rRow_cajas->Fila .'.'. $rRow_cajas->Posicion.'.'. $rRow_cajas->Caja.'.'. $rRow_cajas->Apartado . '</a>';
                                                   }else {
                                                       
                                                             //$Ubicaciones_disponibles.=$Ubicacion_fisica;
                                                            $estilo = "background:#D8D8D8;color:#000";
                                                            $Ubicaciones_disponibles.= '<a  style= '.$estilo. '>'. $Ubicacion_fisica . '</a>';
                                                        
                                                   }
                                                   
                                                   
                                                   
                                                   
                                                   $Ubicaciones_disponibles.="<br>";
                                               }
                                               
                                                
                                                $tabla.="<td class='text-justify'>" . $Ubicaciones_disponibles .  "</td>";  
                                               
                                               
                                        }
                                    $tabla.= "</tr>";    
                                 }   
       
        $tabla.=' </tbody>
                        </table> ';                        
        
        //exit();
        $data=array();
        $data["ubicacion_fisica_libre"]=$tabla;
                                
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');
        echo json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); 
    }
    
    public function agregar_ubicacion_fisica(){
        $this->load->model('ubicacion_fisica_model');
        $idArchivo = $this->input->post('idArchivo');
        $idUbicacion =  $this->input->post('idUbicacionFisica');
        $idTipoProceso = $this->input->post('idTipoProceso');
        $retorno ="";
        //Todos los procesos
        if ( $idTipoProceso == 6){
            $qProcesos = $this->datos_model->get_procesos_archivo($idArchivo);
            foreach($qProcesos->result() as $rProcesos){
                $data=array(
                    'idTipoProceso'=> $rProcesos->idTipoProceso,
                    'idUbicacionFisica'=> $idUbicacion,
                    'idArchivo'=>  $idArchivo,
            
                );
         
                $retorno = $this->ubicacion_fisica_model->agregar_ubicacion_fisica($data);
            }
            
        } else {
        
            $data=array(
               'idTipoProceso'=> $this->input->post('idTipoProceso'),
               'idUbicacionFisica'=> $idUbicacion,
               'idArchivo'=>  $idArchivo,

                );

           $retorno = $this->ubicacion_fisica_model->agregar_ubicacion_fisica($data);
        }
        
        
        
        $this->actualizar_estado_ubicacion($idUbicacion, 1);
        echo $retorno["retorno"];
         
    }
    
    //accion: 1 Agregar - 2 Modificar
    public function actualizar_estado_ubicacion($idUbicacion, $accion){
        $this->load->model('ubicacion_fisica_model');
        if ($accion == 1){
            $u =1;
            $data = array(
                'utilizado' => $u,
            );
           
        }
        if ($accion == 2){
            $u =0;
            $data = array(
                'utilizado' => $u,
            );
           
        }
        
        $this->ubicacion_fisica_model->actualizar_estado_ubicacion($data, $idUbicacion);
    }
    
    public function modificar_ubicacion_fisica(){
         $this->load->model('ubicacion_fisica_model');
         
         $idArchivo = $this->input->post('idUbi_Archivo');
         $id = $this->input->post('idRel_mod');
         $idUbi_anterior = $this->input->post('idUbi_anterior');
         $idUbi = $this->input->post('idUbicacionFisica_mod');
                 
         $data=array(
            
            'idUbicacionFisica'=> $idUbi,
           
             );

        $retorno =  $this->ubicacion_fisica_model->datos_relacion_ubicacion_update($data, $id);
        if($retorno['retorno'] < 0){
           $respuesta = -1;
        }else {
            if ( $idUbi != $idUbi_anterior ){
                //checa que no este ocupada esa misma ubicacion en el archivo para liberarla
                $qUbicaciones_libres_de_archivo = $this->ubicacion_fisica_model->datos_relacion_proceso_ubicacion_archivo($idUbi_anterior, $idArchivo);

                if ($qUbicaciones_libres_de_archivo->num_rows() == 0){

                    $this->actualizar_estado_ubicacion($idUbi_anterior, 2);
                    $this->actualizar_estado_ubicacion($idUbi, 1);
                }
                
            } 
            
            $respuesta = 1;
        }
        echo $respuesta;
    }
    
    public function eliminar_relacion_ubicacion($id){
        $this->load->model('ubicacion_fisica_model');
        $idArchivo = $this->input->post('idArchivoAux');
        //echo $id. 'Aqui';
       // exit();
        //$pizza  = "porción1 porción2 porción3 porción4 porción5 porción6";
        $porciones = explode("%20", $id);
        /*echo $porciones[0] .'idRel'; // porción1 idRelacion
        echo $porciones[1] . 'idArc'; // porción2 idArchivo
        exit();*/
        $Estatus=0;
        $data=array(
            
            'Estatus'=> $Estatus ,
            );
        
        $retorno = $this->ubicacion_fisica_model->datos_relacion_ubicacion_update($data, $porciones[0]);
        //$retorno = $this->procesos_model->datos_proceso_delete($id);
        //$query = $this->procesos_model->datos_proceso_delete($id);
        if($retorno['retorno'] < 0){
            header('Location:'.site_url('archivo/cambios/' . $porciones[1] . $retorno['error']));
        }
        else{
            //checa que no este ocupada esa misma ubicacion en el archivo para liberarla
            $qUbicaciones_libres_de_archivo = $this->ubicacion_fisica_model->datos_relacion_proceso_ubicacion_archivo($porciones[2], $porciones[1]);
            
            if ($qUbicaciones_libres_de_archivo->num_rows() == 0){
                
                $this->actualizar_estado_ubicacion($porciones[2], 2);
            }
            
            header('Location:'.site_url('archivo/cambios/' .$porciones[1])); 
        }
    }
    
    public function eliminar_ubicacion($id, $idUbi, $idArchivo){
        $this->load->model('ubicacion_fisica_model');
        
        //echo $id. 'Aqui';
       // exit();
        //$pizza  = "porción1 porción2 porción3 porción4 porción5 porción6";
        
        /*echo $porciones[0] .'idRel'; // porción1 idRelacion
        echo $porciones[1] . 'idArc'; // porción2 idArchivo
        exit();*/
        $Estatus=0;
        $data=array(
            
            'Estatus'=> $Estatus ,
            );
        
        $retorno = $this->ubicacion_fisica_model->datos_relacion_ubicacion_update($data, $id);
        //$retorno = $this->procesos_model->datos_proceso_delete($id);
        //$query = $this->procesos_model->datos_proceso_delete($id);
        if($retorno['retorno'] < 0){
           
        }
        else{
            //checa que no este ocupada esa misma ubicacion en el archivo para liberarla
            $qUbicaciones_libres_de_archivo = $this->ubicacion_fisica_model->datos_relacion_proceso_ubicacion_archivo($idUbi, $idArchivo);
            
            if ($qUbicaciones_libres_de_archivo->num_rows() == 0){
                
                $this->actualizar_estado_ubicacion($idUbi, 2);
            }
            
           
        }
        
        exit();
    }
    
    
    public function eliminar_relacion_ubicacion_preregistro($idRel_proceso_ubicacion, $idArchivo, $idUbicacion, $idDireccion){
        $this->load->model('ubicacion_fisica_model');
        //$idArchivo = $this->input->post('idArchivoAux');
        //echo $id. 'Aqui';
       // exit();
        //$pizza  = "porción1 porción2 porción3 porción4 porción5 porción6";
        //$porciones = explode("%20", $id);
        /*echo $porciones[0] .'idRel'; // porción1 idRelacion
        echo $porciones[1] . 'idArc'; // porción2 idArchivo
        exit();*/
        $Estatus=0;
        $data=array(
            
            'Estatus'=> $Estatus ,
            );
        
        $retorno = $this->ubicacion_fisica_model->datos_relacion_ubicacion_update($data, $idRel_proceso_ubicacion);
        //$retorno = $this->procesos_model->datos_proceso_delete($id);
        //$query = $this->procesos_model->datos_proceso_delete($id);
        if($retorno['retorno'] < 0){
            header('Location:'.site_url('archivo/preregistrar/' . $idArchivo.'/' . $idDireccion .'/' . $retorno['error']));
        }
        else{
            //checa que no este ocupada esa misma ubicacion en el archivo para liberarla
            $qUbicaciones_libres_de_archivo = $this->ubicacion_fisica_model->datos_relacion_proceso_ubicacion_archivo($idUbicacion, $idArchivo);
            
            if ($qUbicaciones_libres_de_archivo->num_rows() == 0){
                
                $this->actualizar_estado_ubicacion($idUbicacion, 2);
            }
            
            header('Location:'.site_url('archivo/preregistrar/' . $idArchivo.'/' . $idDireccion )); 
        }
    }
    
    public function estado_trabajo($id, $trabajando, $idArchivo){
        $this->load->model('rel_archivo_documento_model');
        if ($trabajando == 0) {
            $data=array(
            
            'idUsuario_Trabajando'=> $trabajando ,
            );
        }else {
            $data=array(
            
            'idUsuario_Trabajando'=> $this->session->userdata('id'),
            );
        }
        //$this->rel_archivo_documento_model->datos_relacion_archivo_documento_update($data, $id);
        $this->rel_archivo_documento_model->datos_relacion_archivo_documento_update_por_proceso($data, $idArchivo,$id);
        if ($trabajando == 0) {
            
            header('Location:'.site_url('archivo/cambios/'.$idArchivo));
        }
        
    }
    
    public function estado_trabajo_check($id, $trabajando, $idArchivo){
        $this->load->model('rel_archivo_documento_model');
        
            $data=array(
            
            'idUsuario_Trabajando'=> $trabajando ,
            );
        
        //$this->rel_archivo_documento_model->datos_relacion_archivo_documento_update($data, $id);
        $this->rel_archivo_documento_model->datos_relacion_archivo_documento_update_por_proceso($data, $idArchivo,$id);
        
            
            header('Location:'.site_url('archivo/cambios/'.$idArchivo));
        
        
    }
    
    
    public function actualizar_estado_trabajo($idRAD){
        $this->load->model('rel_archivo_documento_model');
        $resultado ="";
        
        //Verificar _estado
        $estado = $this->rel_archivo_documento_model->comprobar_estado_trabajo($idRAD)->row_array();
        $usuario = $this->session->userdata('id');
        //print_r($estado['idUsuario_Trabajando']);
        
        
        
        //si no estan trabajando actualizarlo
        if( $estado['idUsuario_Trabajando'] == 0  ){
            
            //echo ("Entre");

            $data = array(
            
                'idUsuario_Trabajando'=> $usuario ,
            );
            
            $aff = $this->rel_archivo_documento_model->trabajar_bloque($data, $estado['idArchivo'], $estado['idTipoProceso']);
            if ($aff > 0){
                $resultado = 1;
                
            } else {
                $resultado = "Error";
            }
        } else if ($estado['idUsuario_Trabajando'] == $usuario) {
            $resultado = 1;
           
        }else {
            $resultado = "Bloque Ocupado";
        }
        
        //exit();
        
        
        echo $resultado;
        
       
    }
    
    public function estado_ot($idArchivo){
        $this->load->model('rel_archivo_documento_model');
        $this->load->model('datos_model');
        
        $idusuario = $this->session->userdata('id');
        $respuesta = "";
        
        $usuario =   $this->datos_model->usuario_trabajando($idArchivo); 
        if( $usuario->num_rows() == 1 ){
            foreach ($usuario->result() as $rUsuario){
                if ($rUsuario->idUsuario_Trabajando > 0  ){ //alguien está trabajando con OT
                    if($rUsuario->idUsuario_Trabajando == $idusuario){   //el usuario esta trabajando algún bloque en OT
                        $respuesta = 1;
                    }
                } else {   //OT Libre
                    $respuesta = 1;
                }
            }
        } else {    //hay algun usuario esta trabajando en la OT
            
            foreach ($usuario->result() as $rUsuario){
                if ( ($rUsuario->idUsuario_Trabajando > 0 && $rUsuario->idUsuario_Trabajando == $idusuario) || $rUsuario->idUsuario_Trabajando == 0 ){ 
                    $respuesta = 1;
                } else {
                    $respuesta = -1;
                }
            }
        }
        echo $respuesta;
    }
    
    
    public function trabajar_ot($idArchivo){
        $this->load->model('rel_archivo_documento_model');
        
            $data = array(

                'idUsuario_Trabajando'=> $this->session->userdata('id') ,
            );
            $retorno = $this->rel_archivo_documento_model->datos_relacion_archivo_documento_update_por_archivo($data, $idArchivo);
            if($retorno['retorno'] == 1){
               $respuesta =  1;
            }else{
               $respuesta =  -1;
            }
        
        
        echo $respuesta;

       
        /*
        if ($trabajando == 1){
            $data=array(

                'idUsuario_Trabajando'=> $this->session->userdata('id') ,
            );
        }else{
            $data=array(

                'idUsuario_Trabajando'=> 0 ,
            );
            
        }
        
        $retorno = $this->rel_archivo_documento_model->datos_relacion_archivo_documento_update_por_archivo($data, $idArchivo);
        /*
        if($retorno['retorno'] == 1){
            return "OK";
        }else{
            return "no";
        }*/
    }

    public function filtrar_archivos_estatus($filtro){
        $this->load->model('datos_model');
        $tabla ="";
        
        $qFiltro = $this->datos_model->filtrar_archivos($filtro);
           
        
        
        
        /*if (isset($qFiltro)) {
                                    if ($qFiltro->num_rows() > 0) {
                                       
                                        foreach ($qFiltro->result() as $rFiltro) {
                                            echo $rFiltro->OrdenTrabajo;
                                        }
                                    }
        }
        exit();*/
        
        $tabla.='
         
           
          <table class="table  table-striped table-hover table-bordered" id="t_listado_estatus'.$filtro .'">
                            <thead>
                            <tr>
                                <th class="col-md-1">
                                    Acción
                                </th>
                                <th class="col-md-1">
                                    Orden de Trabajo
                                </th>
                                <th class="col-md-1">
                                    Contrato
                                </th>
                                <th class="col-md-1">
                                    Obra
                                </th>                               
                                <th class="col-md-1">
                                    Descripcion
                                </th>
                               
                                  <th class="col-md-1">
                                    Normatividad
                                </th> 
                                  <th class="col-md-1">
                                    Modalidad
                                </th> 
                                <th class="col-md-1">
                                    Ejercicio
                                </th> 
                                <th class="col-md-1">
                                    Estatus Obra
                                </th>
                                
                                <th class="col-md-1">
                                    Direccion Ejecutora
                                </th>
                                <th class="col-md-1">
                                    Supervisor
                                </th>
                                <th class="col-md-1">
                                    Inicio Contrato
                                </th>
                                <th class="col-md-1">
                                    Monto Contratado
                                </th>
                                <th class="col-md-1">
                                    Monto Ejercido por SIOP
                                </th>
                                <th class="col-md-1">
                                    Finiquitada
                                </th>
                                <th class="col-md-1">
                                    Estatus FIDO
                                </th>
                               
                            </tr>
                        </thead>
                        <tbody>
         ';
         
         
                                if (isset($qFiltro)) {
                                    if ($qFiltro->num_rows() > 0) {
                                        $i = 0;
                                        foreach ($qFiltro->result() as $rFiltro) {
                                            if ( $rFiltro->Finiquitada == 0){
                                                $finiquitada = 'NO';
                                            }else {
                                                $finiquitada = 'SI';
                                            }
                                           $tabla.= "<tr>";
                                                $tabla.=  "<td><a href='". site_url('archivo/cambios/' . $rFiltro->id) ."' class='btn btn-xs btn-success'><span class='glyphicon glyphicon-pencil'></span></a></td> " ;
                                                          
                                                $tabla.=  "<td>" . $rFiltro->OrdenTrabajo . "</td>";

                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->Contrato . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->Obra . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->Descripcion . "</td>";
                                               
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->Normatividad . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->idModalidad . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->idEjercicio . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->EstatusObra . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->Direccion . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->Supervisor . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->FechaInicio . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->ImporteContratado . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->EjercidoSiop . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $finiquitada. "</td>";
                                                $tabla.= "<td class='sinwarp'> <a href='#' class='btn btn-warning btn-xs' title=''  data-toggle='modal' data-target='#modal-historico-archivo' role='button' onclick='ver_historico_archivo(" . $rFiltro->id  .")'><span class='glyphicon glyphicon-search'></span></a>&nbsp;</td>";
                                           
                                               //$tabla.= "<td class='sinwarp'>" .$rProcesos->Estatus. "</td>";
                                           $tabla.= "</tr>";
                                            
                                        }
                                    }
                                }
        
                                
        $tabla.=' </tbody>
                        </table> ';                        
                                
        $data=array();
        $data["tabla"]=$tabla;
                                
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');
        echo json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);  
        
        
    }
    
    public function filtrar_archivos($filtro, $tipofiltro){
        $this->load->model('datos_model');
        $tabla ="";
        if ($tipofiltro == 1){ //Filtro por estatus
            $qFiltro = $this->datos_model->filtrar_archivos($filtro);
           
        }
        
        if ($tipofiltro == 2){ //Filtro por grupos
            $qFiltro = $this->datos_model->filtrar_archivos_grupo($filtro);
           
        }
        /*if (isset($qFiltro)) {
                                    if ($qFiltro->num_rows() > 0) {
                                       
                                        foreach ($qFiltro->result() as $rFiltro) {
                                            echo $rFiltro->OrdenTrabajo;
                                        }
                                    }
        }
        exit();*/
        
        $tabla.='
         
           
          <table class="table  table-striped table-hover table-bordered" id="t_listado">
                            <thead>
                            <tr>
                                <th class="col-md-1">
                                    Acción
                                </th>
                                <th class="col-md-1">
                                    Orden de Trabajo
                                </th>
                                <th class="col-md-1">
                                    Contrato
                                </th>
                                <th class="col-md-1">
                                    Obra
                                </th>                               
                                <th class="col-md-1">
                                    Descripcion
                                </th>
                               
                                  <th class="col-md-1">
                                    Normatividad
                                </th> 
                                  <th class="col-md-1">
                                    Modalidad
                                </th> 
                                <th class="col-md-1">
                                    Ejercicio
                                </th> 
                                <th class="col-md-1">
                                    Estatus Obra
                                </th>
                                
                                <th class="col-md-1">
                                    Direccion Ejecutora
                                </th>
                                <th class="col-md-1">
                                    Supervisor
                                </th>
                                <th class="col-md-1">
                                    Inicio Contrato
                                </th>
                                <th class="col-md-1">
                                    Monto Contratado
                                </th>
                                <th class="col-md-1">
                                    Monto Ejercido por SIOP
                                </th>
                                <th class="col-md-1">
                                    Finiquitada
                                </th>
                                <th class="col-md-1">
                                    Estatus FIDO
                                </th>
                               
                            </tr>
                        </thead>
                        <tbody>
         ';
         
         
                                if (isset($qFiltro)) {
                                    if ($qFiltro->num_rows() > 0) {
                                        $i = 0;
                                        foreach ($qFiltro->result() as $rFiltro) {
                                            if ( $rFiltro->Finiquitada == 0){
                                                $finiquitada = 'NO';
                                            }else {
                                                $finiquitada = 'SI';
                                            }
                                           $tabla.= "<tr>";
                                                $tabla.=  "<td><a href='". site_url('archivo/cambios/' . $rFiltro->id) ."' class='btn btn-xs btn-success'><span class='glyphicon glyphicon-pencil'></span></a></td> " ;
                                                          
                                                $tabla.=  "<td>" . $rFiltro->OrdenTrabajo . "</td>";

                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->Contrato . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->Obra . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->Descripcion . "</td>";
                                               
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->Normatividad . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->idModalidad . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->idEjercicio . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->EstatusObra . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->Direccion . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->Supervisor . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->FechaInicio . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->ImporteContratado . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->EjercidoSiop . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $finiquitada. "</td>";
                                                $tabla.= "<td class='sinwarp'> <a href='#' class='btn btn-warning btn-xs' title=''  data-toggle='modal' data-target='#modal-historico-archivo' role='button' onclick='ver_historico_archivo(" . $rFiltro->id  .")'><span class='glyphicon glyphicon-search'></span></a>&nbsp;</td>";
                                           
                                               //$tabla.= "<td class='sinwarp'>" .$rProcesos->Estatus. "</td>";
                                           $tabla.= "</tr>";
                                            
                                        }
                                    }
                                }
        
                                
        $tabla.=' </tbody>
                        </table> ';                        
                                
        $data=array();
        $data["tabla"]=$tabla;
                                
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');
        echo json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);  
        
        
    }
    
     public function filtrar_archivos_736($filtro, $tipofiltro){
        $this->load->model('datos_model');
        $Modalidades = $this->datos_model->get_Modalidades_select();
        $tabla ="";
        if ($tipofiltro == 1){ //Filtro por estatus
            $qFiltro = $this->datos_model->filtrar_archivos_736($filtro);
           
        }
        
        if ($tipofiltro == 2){ //Filtro por grupos
            if ($filtro == 5){
                $qFiltro = $this->datos_model-> filtrar_archivos_ejercicio($filtro);
            }else {
            $qFiltro = $this->datos_model->filtrar_archivos_grupo_736($filtro);
            }
           
        }
        
        
        /*if (isset($qFiltro)) {
                                    if ($qFiltro->num_rows() > 0) {
                                       
                                        foreach ($qFiltro->result() as $rFiltro) {
                                            echo $rFiltro->OrdenTrabajo;
                                        }
                                    }
        }
        exit();*/
        
        $tabla.='
         
           
          <table class="table table-responsive table-striped table-hover table-bordered" id="t_listado"  width="200%">
                            <thead>
                            <tr>
                                <th class="col-md-1">
                                    Acción
                                </th>
                                <th >
                                    Orden de Trabajo
                                </th>
                                <th>
                                    Contrato
                                </th>
                                <th>
                                    Obra
                                </th>                               
                                <th>
                                    Descripcion
                                </th>
                               
                                  <th >
                                    Normatividad
                                </th> 
                                  <th >
                                    Modalidad
                                </th> 
                                <th >
                                    Ejercicio
                                </th> 
                                <th >
                                    Estatus Obra
                                </th>
                                
                                <th >
                                    Direccion Ejecutora
                                </th>
                                <th >
                                    Supervisor
                                </th>
                                <th >
                                    Inicio Contrato
                                </th>
                                <th >
                                    Monto Contratado
                                </th>
                                <th >
                                    Monto Ejercido por SIOP
                                </th>
                                <th >
                                    Finiquitada
                                </th>
                                <th >
                                    Contratista
                                </th>
                                <th>
                                    Estatus FIDO
                                </th>
                               
                            </tr>
                        </thead>
                        <tbody>
         ';
         
                               
                                if (isset($qFiltro)) {
                                    if ($qFiltro->num_rows() > 0) {
                                        $i = 0;
                                        foreach ($qFiltro->result() as $rFiltro) {
                                            if ( $rFiltro->Finiquitada == 0){
                                                $finiquitada = 'NO';
                                            }else {
                                                $finiquitada = 'SI';
                                            }
                                             if(isset($rFiltro->idModalidad)){
                                                $Modalidad = $Modalidades[$rFiltro->idModalidad];
                                            } else {
                                                $Modalidad = "NO DEFINIDA";
                                            }
                                           $tabla.= "<tr>";
                                                $tabla.=  "<td><a href='". site_url('archivo/cambios/' . $rFiltro->id) ."' class='btn btn-xs btn-success'><span class='glyphicon glyphicon-pencil'></span></a></td> " ;
                                                          
                                                $tabla.=  "<td>" . $rFiltro->OrdenTrabajo . "</td>";

                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->Contrato . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->Obra . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->Descripcion . "</td>";
                                               
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->Normatividad . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $Modalidad . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->idEjercicio . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->EstatusObra . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->Direccion . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->Supervisor . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->FechaInicio . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->ImporteContratado . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->EjercidoSiop . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $finiquitada. "</td>";
                                                 $tabla.= "<td class='sinwarp'>" . $rFiltro->Contratista . "</td>";
                                                $tabla.= "<td class='sinwarp'> <a href='#' class='btn btn-warning btn-xs' title=''  data-toggle='modal' data-target='#modal-historico-archivo' role='button' onclick='ver_historico_archivo(" . $rFiltro->id  .")'><span class='glyphicon glyphicon-search'></span></a>&nbsp;</td>";
                                           
                                               //$tabla.= "<td class='sinwarp'>" .$rProcesos->Estatus. "</td>";
                                           $tabla.= "</tr>";
                                            
                                        }
                                    }
                                }
        
                                
        $tabla.=' </tbody>
                        </table> ';                        
                                
        $data=array();
        $data["tabla"]=$tabla;
                                
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');
        echo json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);  
        
        
    }
    
    
    public function filtrar_archivos_direccion($filtro){
        $this->load->model('rel_archivo_preregistro_model');
        $tabla ="";
        
        //Filtro por grupos
        $qFiltro = $this->rel_archivo_preregistro_model->filtrar_archivos_direccion($filtro);
       
        if (isset($qFiltro)) {
            if ($qFiltro->num_rows() > 0) {
                $i = 0;
                $tabla.='<option value="" selected="selected">SELECCIONA UNA OT </option>';
                foreach ($qFiltro->result() as $rFiltro) {
                    
                    $tabla.='<option value="'. $rFiltro-> id .'" id="orden_trabajo" name="orden_trabajo">' . $rFiltro->OrdenTrabajo . '</option>';
                }
            } else{
                $tabla.='<option value="" selected="selected">DIRECCIÓN SIN PREREGISTROS </option>';
            }
        }
           
        
                          
                                
        $data=array();
        $data["tabla"]=$tabla;
                                
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');
        echo json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);  
        
        
    }
    
    
   
    public function imprimir_procesos($idArchivo){
        $this->load->model('datos_model');
        $this->load->model('procesos_model');
        
        $id = $this->datos_model->get_procesos_archivo($idArchivo);
        $aProcesos = $this->procesos_model->addw_procesos();
        $resultado = "";
        $resultado .= '<option value="6" >TODOS</option>';
         if (isset($id)) {
            if ($id->num_rows() > 0) {               
                foreach ($id->result() as $rId) { 
                    $resultado .= '<option value="'.$rId->idTipoProceso .'" >'. $aProcesos[$rId->idTipoProceso] .'</option>';
                }
            }
         
        }
        
        
        $data=array();
        
        //echo $tabla;
        //exit();
        $data["resultado"]=$resultado;
                                
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');
        echo json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
        
    }

    public function ver_ubicaciones_archivo($idArchivo){
         $this->load->model('ubicacion_fisica_model');
         $this->load->model('procesos_model');
         
         $aProcesos = $this->procesos_model->addw_procesos();
         $qRelProcesoUbicacion= $this->ubicacion_fisica_model->listado_ubicaciones_captura($idArchivo);
         //$tabla ="";
         $tabla = '
                            <div class="col-sm-12 m-b"> 
                                <a href="#" id="btn-agregar-ubi"  class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-agregar-ubicacion-fisica" onclick="imprimir_procesos()" role="button" ><span class="glyphicon glyphicon-plus-sign"></span> Agregar Ubicación </a>
                                <a href="#"  id="btn-ubicaciones-libres"   class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-cambiar-ubicacionfisica" role="button" onclick="uf_ver_ubicacion_fisica_libre()"><span class="glyphicon glyphicon-search"></span>  Ubicaciones Libres</a>
                            </div>
                                     
                                <table  id="ubicaciones-tabla-'.$idArchivo.'"  class="table-bordered table-condensed table-responsive table-small table-hover" width="100%">
                                    <thead>
                                        <th>Acción</th>
                                        <th>Proceso</th>
                                        <th>Ubicacion Fisica</th>
                                        
                                       
                                        
                                    </thead>
                                    <tbody>'; 
        if (isset($qRelProcesoUbicacion)) {
            if ($qRelProcesoUbicacion->num_rows() > 0) {               
                foreach ($qRelProcesoUbicacion->result() as $rRelacion) {
                    
                    $url_ot= site_url('impresion/etiqueta_orden_trabajo/'. $idArchivo). ' ' .$rRelacion->idTipoProceso .' '. $rRelacion->idUbicacionFisica; 
                    $url_ot_chica= site_url('impresion/etiqueta_orden_trabajo_chica/'.  $idArchivo . ' ' .$rRelacion->idTipoProceso.' '. $rRelacion->idUbicacionFisica  .' ' . $rRelacion->idRel);
                    $url_eliminar = site_url('archivo/eliminar_relacion_ubicacion/' . $rRelacion->idRel.' '.$idArchivo .' '. $rRelacion->idUbicacionFisica );
                    $confirmar= "¿Desea Eliminar esta ubicacion";


                    $tabla.= "<tr>";

                    $tabla.=    "<td>";
                    $tabla.=         "<div class='btn-group'>";
                    $tabla.=            "<div class='btn-group'>";
                    $tabla.=                "<button type='button' class='btn btn-default btn-xs dropdown-toggle' id='btn-impresion' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' style='margin-bottom:5px;''>";
                    $tabla.=                     "<span class='glyphicon glyphicon-print'></span>";
                    $tabla.=                "</button>";
                    $tabla.=                "<ul class='dropdown-menu'>";
                    $tabla.=                    "<li>";
                    $tabla.=                        "<a href='". $url_ot. "' target='_blank'>";
                    $tabla.=                           "<span class='glyphicon glyphicon-file'></span> Etiqueta para Archivo de Recepción";
                    $tabla.=                        "</a>";
                    $tabla.=                    "</li>";
                    

                    $tabla.=               "</ul>";
                    $tabla.=            "</div>";
                   
                    $tabla.=            "<a id='btn-tabla-elim' class='btn btn-danger btn-xs del_documento'  title='Eliminar Ubicación' onclick='eliminar_ubicacion(". $rRelacion->idRel .",".$rRelacion->idUbi .")'  ><span class='glyphicon glyphicon-remove'></span></a> ";
                    $tabla.=        "</div>";


                    $tabla.=     "</td>";
                    $tabla.=    "<td> ". $aProcesos[$rRelacion->idTipoProceso] ."</td>"; 
                   
                    $tabla.=    "<td> ". $rRelacion->Columna . '.' . $rRelacion->Fila.'.' . $rRelacion->C .'.' . $rRelacion->Apartado . '.' .$rRelacion->Posicion."</td>"; 
                   

                    $tabla.=    "</tr>"; 
                        

                                            
                                            
                      
                                    
                                            }
                                        
                                    
                        
                                
                                              
                                    }
                                } 
                        $tabla.=        "</tbody></table>"; 
                                
        $data=array();
        
        //echo $tabla;
        //exit();
        $data["tabla"]=$tabla;
                                
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');
        echo json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); 
                                
                                
    }
    
    public function ver_ubicaciones_proceso($idArchivo, $proceso){
         $this->load->model('ubicacion_fisica_model');
         $qRelProcesoUbicacion= $this->ubicacion_fisica_model->listado_ubicaciones_proceso($idArchivo, $proceso);
         //$tabla ="";
         $tabla = '
                                     
                                <table  id="ubicaciones-tabla-'.$proceso.'"  class="table-bordered table-condensed table-responsive table-small" width="100%">
                                    <thead>
                                        <th>Acción</th>
                                        <th>Ubicacion Fisica</th>
                                        
                                       
                                        
                                    </thead>
                                    <tbody>'; 
        if (isset($qRelProcesoUbicacion)) {
            if ($qRelProcesoUbicacion->num_rows() > 0) {               
                foreach ($qRelProcesoUbicacion->result() as $rRelacion) {
                    
                    $url_ot= site_url('impresion/etiqueta_orden_trabajo/'. $idArchivo). ' ' . $proceso .' '. $rRelacion->idUbicacionFisica; 
                    $url_ot_chica= site_url('impresion/etiqueta_orden_trabajo_chica/'.  $idArchivo . ' ' . $proceso .' '. $rRelacion->idUbicacionFisica  .' ' . $rRelacion->idRel);
                    $url_eliminar = site_url('archivo/eliminar_relacion_ubicacion/' . $rRelacion->idRel.' '.$idArchivo .' '. $rRelacion->idUbicacionFisica );
                    $confirmar= "¿Desea Eliminar esta ubicacion";


                    $tabla.= "<tr>";

                    $tabla.=    "<td>";
                    $tabla.=         "<div class='btn-group'>";
                    $tabla.=            "<div class='btn-group'>";
                    $tabla.=                "<button type='button' class='btn btn-default btn-xs dropdown-toggle' id='btn-impresion' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' style='margin-bottom:5px;''>";
                    $tabla.=                     "<span class='glyphicon glyphicon-print'></span>";
                    $tabla.=                "</button>";
                    $tabla.=                "<ul class='dropdown-menu'>";
                    $tabla.=                    "<li>";
                    $tabla.=                        "<a href='". $url_ot. "' target='_blank'>";
                    $tabla.=                           "<span class='glyphicon glyphicon-file'></span> Etiqueta para Archivo de Recepción";
                    $tabla.=                        "</a>";
                    $tabla.=                    "</li>";
                    

                    $tabla.=               "</ul>";
                    $tabla.=            "</div>";
                    $tabla.=            "<a id='btn-tabla-mod' class='btn btn-success btn-xs' id='btn-modificar-ubi' data-toggle='modal' data-target='#modal-modificar-ubicacion' role='button' onclick='uf_modificar_ubicacion(". $rRelacion->idRel .")'>";
                    $tabla.=                    "<span class='glyphicon glyphicon-pencil'></span></a>&nbsp;";
                    $tabla.=            "<a id='btn-tabla-elim' class='btn btn-danger btn-xs del_documento' href='' title='Eliminar Solicitud' onclick='return confirm('¿Confirma eliminar Registro?');'' target='_self' ><span class='glyphicon glyphicon-remove'></span></a> ";
                    $tabla.=        "</div>";


                    $tabla.=     "</td>"; 
                   
                    $tabla.=    "<td> ". $rRelacion->Columna . '.' . $rRelacion->Fila.'.' . $rRelacion->C .'.' . $rRelacion->Apartado . '.' .$rRelacion->Posicion."</td>"; 
                   

                    $tabla.=    "</tr>"; 
                        

                                            
                                            
                       /* $tabla.=               "<div class='btn-group'>";
                        $tabla.=                   '<button type="button" class="btn btn-default btn-xs dropdown-toggle" id="btn-impresion" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-bottom:5px;">';
                        $tabla.=                          '<span class="glyphicon glyphicon-print"></span>';
                        $tabla.=                   '</button>';
                        $tabla.=                   '<ul class="dropdown-menu">';
                        $tabla.=                        '<li>';
                        $tabla.=                            "<a href='site_url()" ."target='_blank'>";
                        $tabla.=                                '<span class="glyphicon glyphicon-file"></span> Etiqueta para Archivo de Recepción';
                        $tabla.=                            '</a>';
                        $tabla.=                        '</li>';
                        $tabla.=                        '<li>';
                        $tabla.=                             '<a href="site_url()" target="_blank">';
                        $tabla.=                                    '<span class="glyphicon glyphicon-file"></span> Etiqueta para Archivo de Integración';
                        $tabla.=                                '</a>';
                        $tabla.=                        '</li>';

                        $tabla.=                    '</ul>';
                        $tabla.=                 '</div>';
                        $tabla.=                 '<div class="btn-permisos">';
                        $tabla.=                         '<a href="#" id="btn-tabla-mod" class="btn btn-success btn-xs" title="" id="btn-modificar-ubi" data-toggle="modal" data-target="#modal-modificar-ubicacion" role="button" onclick="uf_modificar_ubicacion()"><span class="glyphicon glyphicon-pencil"></span></a>;';
                        $tabla.=                 '</div>';
                        $tabla.=           '</td>';
                        $tabla.=                 '<td>'.$rRelacion->Columna . '.' . $rRelacion->Fila.'.' . $rRelacion->C .'.' . $rRelacion->Apartado . '.' .$rRelacion->Posicion .'</td>';
                        $tabla.=                 '<td>'.  $rRelacion->CajaUbi .'</td>';
                        $tabla.=                 '<td>' . $rRelacion->Documentos .'</td>';
                        $tabla.=                 '<td>'.$rRelacion->NoFolioInicial .'</td>';
                        $tabla.=                 '<td>'.  $rRelacion->NoFolioFinal .'</td>';
                        $tabla.=                 '<td>'.$rRelacion->NoHojas .'</td>';
                        $tabla.=                 '<td>'; 
                        $tabla.=                     '<div class="btn-permisos">';
                        $tabla.=                        
                        $tabla.=                     '</div> ';
                        $tabla.=                 '</td>';
                        $tabla.=             '</tr>'; */
                                    
                                            }
                                        
                                    
                        
                                
                                              
                                    }
                                } 
                        $tabla.=        "</tbody></table>"; 
                                
        $data=array();
        
        //echo $tabla;
        //exit();
        $data["tabla"]=$tabla;
                                
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');
        echo json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); 
                                
                                
    }
    
    public function aceptar_preregistro($idArchivo, $idDireccion_responsable){
         $this->load->model('rel_archivo_documento_model');
         $this->load->model('rel_archivo_preregistro_model');
         $data = array(
                'preregistro_aceptado' => 1,
                'fecha_ingreso' => date('Y-m-d H:i:s'),
                'idUsuario_acepta' => $this->session->userdata("id"),
                );
            
         //$this->rel_archivo_documento_model->update_rel_archivo_documento_aceptar_preregistro($idArchivo, $idDireccion_responsable, $data);
         echo $this->rel_archivo_preregistro_model->datos_relacion_archivo_preregistro_update_preregistro($data, $idDireccion_responsable, $idArchivo) ;
       
    }
    
    public function mostrar_archivos_verificar(){
        $this->load->model('datos_model');
        $tabla ="";
        
        //Filtro por grupos
        $qFiltro = $this->datos_model->mostrar_archivos_verificar();
           
        
        /*if (isset($qFiltro)) {
                                    if ($qFiltro->num_rows() > 0) {
                                       
                                        foreach ($qFiltro->result() as $rFiltro) {
                                            echo $rFiltro->OrdenTrabajo;
                                        }
                                    }
        }
        exit();*/
        
        $tabla.='
         
           
          <table class="table table-responsive table-striped table-hover table-bordered" id="t_verificar">
                            <thead>
                            <tr>
                                <th class="col-md-1">
                                    Acción
                                </th>
                                <th>
                                    Orden de Trabajo
                                </th>
                                <th>
                                    Contrato
                                </th>
                                <th>
                                    Obra
                                </th>                               
                                <th>
                                    Descripcion
                                </th>
                               
                                  <th >
                                    Normatividad
                                </th> 
                                  <th >
                                    Modalidad
                                </th> 
                                <th >
                                    Ejercicio
                                </th> 
                                <th >
                                    Estatus Obra
                                </th>
                                
                                <th >
                                    Direccion Ejecutora
                                </th>
                                <th >
                                    Supervisor
                                </th>
                                <th >
                                    Inicio Contrato
                                </th>
                                <th >
                                    Monto Contratado
                                </th>
                                <th >
                                    Monto Ejercido por SIOP
                                </th>
                                <th >
                                    Finiquitada
                                </th>
                                <th>
                                    Estatus FIDO
                                </th>
                               
                            </tr>
                        </thead>
                        <tbody>
         ';
         
         
                                if (isset($qFiltro)) {
                                    if ($qFiltro->num_rows() > 0) {
                                        $i = 0;
                                        foreach ($qFiltro->result() as $rFiltro) {
                                            if ( $rFiltro->Finiquitada == 0){
                                                $finiquitada = 'NO';
                                            }else {
                                                $finiquitada = 'SI';
                                            }
                                           $tabla.= "<tr>";
                                                $tabla.=  "<td>" ;
                                                
                                                $tabla.= "<a href='". site_url('archivo/cambios/' . $rFiltro->id) ."' class='btn btn-xs btn-success'><span class='glyphicon glyphicon-pencil'></span></a></td>";
                                                $tabla.=  "<td>" . $rFiltro->OrdenTrabajo . "</td>";

                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->Contrato . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->Obra . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->Descripcion . "</td>";
                                               
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->Normatividad . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->idModalidad . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->idEjercicio . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->EstatusObra . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->Direccion . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->Supervisor . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->FechaInicio . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->ImporteContratado . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->EjercidoSiop . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $finiquitada. "</td>";
                                                $tabla.= "<td class='sinwarp'> <a href='#' class='btn btn-warning btn-xs' title=''  data-toggle='modal' data-target='#modal-historico-archivo' role='button' onclick='ver_historico_archivo(" . $rFiltro->id  .")'><span class='glyphicon glyphicon-search'></span></a>&nbsp;</td>";
                                           
                                               //$tabla.= "<td class='sinwarp'>" .$rProcesos->Estatus. "</td>";
                                           $tabla.= "</tr>";
                                            
                                        }
                                    }
                                }
        
                                
        $tabla.=' </tbody>
                        </table> ';                        
                                
        $data=array();
        $data["tabla"]=$tabla;
                                
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');
        echo json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);  
        
        
    }
    
    
    public function mostrar_todos(){
        $this->load->model('datos_model');
        $tabla ="";
        
        //Filtro por grupos
        $qFiltro =  $this->datos_model->listado();
           
        
        /*if (isset($qFiltro)) {
                                    if ($qFiltro->num_rows() > 0) {
                                       
                                        foreach ($qFiltro->result() as $rFiltro) {
                                            echo $rFiltro->OrdenTrabajo;
                                        }
                                    }
        }
        exit();*/
        
        $tabla.='
         
           
          <table class="table table-responsive table-striped table-hover table-bordered" id="t_todos">
                            <thead>
                            <tr>
                                <th class="col-md-1">
                                    Acción
                                </th>
                                <th>
                                    Orden de Trabajo
                                </th>
                                <th>
                                    Contrato
                                </th>
                                <th>
                                    Obra
                                </th>                               
                                <th>
                                    Descripcion
                                </th>
                               
                                  <th >
                                    Normatividad
                                </th> 
                                  <th >
                                    Modalidad
                                </th> 
                                <th >
                                    Ejercicio
                                </th> 
                                <th >
                                    Estatus Obra
                                </th>
                                
                                <th >
                                    Direccion Ejecutora
                                </th>
                                <th >
                                    Supervisor
                                </th>
                                <th >
                                    Inicio Contrato
                                </th>
                                <th >
                                    Monto Contratado
                                </th>
                                <th >
                                    Monto Ejercido por SIOP
                                </th>
                                <th >
                                    Finiquitada
                                </th>
                                <th>
                                    Estatus FIDO
                                </th>
                               
                            </tr>
                        </thead>
                        <tbody>
         ';
         
         
                                if (isset($qFiltro)) {
                                    if ($qFiltro->num_rows() > 0) {
                                        $i = 0;
                                        foreach ($qFiltro->result() as $rFiltro) {
                                            if ( $rFiltro->Finiquitada == 0){
                                                $finiquitada = 'NO';
                                            }else {
                                                $finiquitada = 'SI';
                                            }
                                           $tabla.= "<tr>";
                                                $tabla.=  "<td>" ;
                                                
                                                $tabla.= "<a href='#' onclick='editar_archivo(" . $rFiltro->id . ")' class='btn btn-xs btn-success'><span class='glyphicon glyphicon-pencil'></span></a></td>";
                                                $tabla.=  "<td>" . $rFiltro->OrdenTrabajo . "</td>";

                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->Contrato . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->Obra . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->Descripcion . "</td>";
                                               
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->Normatividad . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->idModalidad . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->idEjercicio . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->EstatusObra . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->Direccion . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->Supervisor . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->FechaInicio . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->ImporteContratado . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $rFiltro->EjercidoSiop . "</td>";
                                                $tabla.= "<td class='sinwarp'>" . $finiquitada. "</td>";
                                                $tabla.= "<td class='sinwarp'> <a href='#' class='btn btn-warning btn-xs' title=''  data-toggle='modal' data-target='#modal-historico-archivo' role='button' onclick='ver_historico_archivo(" . $rFiltro->id  .")'><span class='glyphicon glyphicon-search'></span></a>&nbsp;</td>";
                                           
                                               //$tabla.= "<td class='sinwarp'>" .$rProcesos->Estatus. "</td>";
                                           $tabla.= "</tr>";
                                            
                                        }
                                    }
                                }
        
                                
        $tabla.=' </tbody>
                        </table> ';                        
                                
        $data=array();
        $data["tabla"]=$tabla;
                                
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');
        echo json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);  
        
        
    }


    
    
    
            
            
            
            
            
    
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

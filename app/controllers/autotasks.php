<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Autor: Luis Fernando Chavez Villalobos (Derechos Reservados © 2015)
 * Para uso exclusivo de la Secretaria de Infraestructura y Obra Publica
 * Licancia no transferible
 */

/**
 * @author Luis Fernando Chavez Villalobos
 */
class Autotasks extends CI_Controller {

    function __construct() {
        date_default_timezone_set("America/Mexico_City");
        parent::__construct();
    }

    public function index() {
        echo "Tareas automatizadas del sistema <br> Funciona por consola con el comando crone";
        exit;
    }
    
    public function actualizar_preregistros(){
        $this->load->model('rel_archivo_preregistro_model');
        
        $preregistros_anteriores = $this->rel_archivo_preregistro_model->preregistros_anteriores();
        foreach ($preregistros_anteriores->result() as $row){
            $usuario = $this->rel_archivo_preregistro_model->preregistros_usuarios($row->id_Rel_Archivo_Documento);
            if($usuario->num_rows() > 0){
                foreach ($usuario->result() as $rRow ){
                    
                    $data = array (
                        'idUsuario_preregistra' => $rRow->idUsuario,
                    );
                    echo "usuario " .  $rRow->idUsuario ;
                    echo "idrel " . $row->id_Rel_Archivo_Documento;
                    echo "id " . $row->id;
                    var_dump($data);
                $this->rel_archivo_preregistro_model->update_registro_autotask($data, $row->id);
                }
            }
        }
    }

    public function ubicacion_fisica(){
        $this->load->model('ubicacion_fisica_model');
        array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M',
              'N', 'O', 'P');
        
        $Fila =4;
        $Caja = 4;
        
        
        $Apartado = 6;
        $n =1;
        foreach (range('A', 'P') as $Columna) {
           
           
                    
            for($i = 1; $i <= $Fila ; $i++){
                
               
                for($j = 1; $j <= $Caja ; $j++){
                    
                    for($k = 1; $k <= $Apartado ; $k++){
                        
                        //agregar_ubicacion_fisica($data)
                        $data=array(
                            'id' => $n,
                            'Columna' => $Columna,
                            'Fila'    => $i,
                            'Caja'    => $j,
                            'Apartado'=> $k,
                           
                        );
                        
                         //echo " $Columna - $i - $j - $k<br>";

                        $retorno = $this->ubicacion_fisica_model->datos_ubicacion_insert($data);
                        $n++;
                        //printf($retorno);

                        if($retorno['retorno'] < 0)
                            echo "Hubo error $Columna - $i - $j - $k<br>";
                        else
                            echo "OK  inserto $Columna - $i - $j - $k<br>";
                        
                         

                    }
                
                }
                
            }
            
        }
        
    }
    
   
    
    public function listado_obras(){
        $this->load->model('secip_obras_model');
        $this->load->model('datos_model');
        $this->load->library('ferfunc');
        
        //datos_archivo_insert
        
        
        
        $addw_supervisores=$this->secip_obras_model->addw_supervisores();
        $addw_direcciones=$this->secip_obras_model->addw_direcciones();
        $addw_estatus=$this->secip_obras_model->addw_estatus();
        
        
       
        $qObras=$this->secip_obras_model->listado_obras();
         
       
        
        foreach ($qObras->result() as $row):
            
            
                $Normatividad="FEDERAL";
                if ($row->Normatividad=="EST"){
                    $Normatividad="ESTATAL";
                }

                $Finiquitada=0;
                if ($row->Estatus==120){
                    $Finiquitada=1;
                }

                $proyecto=0;
            
            
            $qContratista=$this->secip_obras_model->datos_contratista($row->idContratista);    
            
            $idContratista=0;
            $Contratista="";
            if ($qContratista->num_rows()>0){
                $aContratista=$qContratista->row_array();
                $idContratista=$row->idContratista;
                $Contratista=$aContratista['RazonSocial'];
            }
            
            $qArchivo=$this->secip_obras_model->datos_Archivo_contrato($row->id);
            
            $qSupervisor=$this->secip_obras_model->datos_supervisor($row->idSupervisor);
            
            $supervisor="";
            if ($qSupervisor->num_rows()>0){
                 $aSupervisor=$qSupervisor->row_array();
                 $supervisor=$aSupervisor['Supervisor'];
             }        
            
             
            $xml = $row->complementoXML;
            $data= array();
            if (strlen($xml) > 0) {
                $aXml = $this->ferfunc->xml2array($xml);
                foreach ($aXml as $key => $value) {
                    $data["aObra"][$key] = $value;
                }
            }
             
            $FechaExtincionDerechos = date('Y-m-d'); 
            if (!empty($data["aObra"]['FechaExtincionDerechos'])) {
                $FechaExtincionDerechos = $data["aObra"]['FechaExtincionDerechos'];
            }
            
          
            
            if ($qArchivo->num_rows()==0){
        
                

                $data = array(
                    'OrdenTrabajo' => $row->OrdenTrabajo,
                    'Contrato' => $row->Contrato,
                    'Obra' => $row->Obra,
                    'Descripcion' => $row->Descripcion,
                    'FechaRegistro' => $row->FechaAdjudicacion,
                    'Estatus' => 10,
                    'Normatividad' => $Normatividad,
                    'idModalidad' => $row->idModalidad,
                    'idEjercicio' => $row->Ejercicio,
                    'proyecto' => $proyecto,
                    'FechaInicio' => $row->FechaInicio,
                    'FechaTermino' => $row->FechaTerminoReal,
                    'ImporteContratado' => $row->ImporteContratado,
                    'Finiquitada' => $Finiquitada,
                    'Supervisor' =>  $supervisor,
                    'idContrato' =>  $row->id,
                    'idDireccion' =>  $row->idDireccion,
                    'ImporteEjercido' =>  $row->ImporteEjercido,
                    'Direccion' =>  $addw_direcciones[$row->idDireccion],
                    'idSupervisor' =>  $row->idSupervisor,
                    'idJefeSupervisor' =>  $row->idJefeSupervisor,
                    'idDirectorGral' =>  $row->idDirectorGral,
                    'EstatusObra' => $addw_estatus[$row->Estatus],
                    'idContratista' => $idContratista,
                    'Contratista' => $Contratista,
                    'FechaExtincionDerechos' => $FechaExtincionDerechos,
                );

 
                
                $retorno=  $this->datos_model->datos_archivo_insert($data);

                $id_new_archivo=$retorno['registro'];

                $Tp_plantilla = $this->datos_model->get_tipo_plantilla($row->idModalidad, $Normatividad);

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
            
            }else{ //Si existe hay que actualizar los datos
                
               
                $data = array(
                    'OrdenTrabajo' => $row->OrdenTrabajo,
                    'Contrato' => $row->Contrato,
                    'Obra' => $row->Obra,
                    'Descripcion' => $row->Descripcion,
                    'FechaRegistro' => $row->FechaAdjudicacion,
                    'Normatividad' => $Normatividad,
                    'idModalidad' => $row->idModalidad,
                    'idEjercicio' => $row->Ejercicio,
                    'proyecto' => $proyecto,
                    'FechaInicio' => $row->FechaInicio,
                    'FechaTermino' => $row->FechaTerminoReal,
                    'ImporteContratado' => $row->ImporteContratado,
                    'Finiquitada' => $Finiquitada,
                    'Supervisor' =>  $supervisor,
                    'idDireccion' =>  $row->idDireccion,
                    'ImporteEjercido' =>  $row->ImporteEjercido,
                    'Direccion' =>  $addw_direcciones[$row->idDireccion],
                    'idSupervisor' =>  $row->idSupervisor,
                    'idJefeSupervisor' =>  $row->idJefeSupervisor,
                    'idDirectorGral' =>  $row->idDirectorGral,
                    'EstatusObra' => $addw_estatus[$row->Estatus],
                    'idContratista' => $idContratista,
                    'Contratista' => $Contratista,
                    'FechaExtincionDerechos' => $FechaExtincionDerechos,
                );

               
                
               $aArchivo=$qArchivo->row_array();
               $this->datos_model->datos_archivo_update($data,$aArchivo['id'] );
       
            }
           
            
            
        endforeach;
        
        echo "Proceso Terminado";
        
    }

    public function ubi_concentracion(){
        $this->load->model('concentracion_model');
        
        $ubicaciones = $this->concentracion_model->listado();
       
        foreach ($ubicaciones->result() as $row ){
            
            $data = array (
                
                'idUbicacion' => $row->id,
            );
            
            $Nombre = $row->Nombre;
         
            
            $retorno = $this->concentracion_model->update_ubi($data, $Nombre);
            
            echo $retorno['retorno'] .'-'. $retorno['query'];
            
            
        }
        
    }
    
     public function cuca(){
        $this->load->model('transferencia_model');
        
        $cuca = $this->transferencia_model->listado_identificadores();
       
        foreach ($cuca->result() as $row ){
            
            $data = array (
                
                'idSeccion' => $row->id,
                'idSerie'   => $row->ids,
                'idSubserie' => $row->idsub,
                'idSubSubserie' =>$row->idsubsub,
                
            );
            
            if (isset($row->Nombresubsub)) {   
                $data['identificador'] = $row->Codigosubsub;   
            } else if (isset($row->Nombresub)) {   
                $data['identificador'] = $row->Codigosub;
            } else{  
                $data['identificador'] = $row->Codigos;
            }

            
            $retorno = $this->transferencia_model->insertar_cuca($data);
            
            echo $retorno . '-'.$data['identificador'];
            
            
        }
        
    }
    
    public function actualizar_identificadores(){
        $this->load->model('transferencia_model');
        
        $cuca = $this->transferencia_model->listado_cuca();
       
        foreach ($cuca->result() as $row ){
            
            $like = $row->identificador;
            $data=array(
                'identificado' =>$row->id,
            );
            $retorno = $this->transferencia_model->update_archivo($like, $data);
            
            echo $retorno['retorno'] ."-" .$retorno['query']."<br>";
            
            
        }
        
    }

    public function actualizar_relacion(){

        $this->load->model('archivo_model');
        
        $preregistros = $this->archivo_model->listado_preregistros();

        $i=0;
        
        foreach ($preregistros->result() as $row ){
            
            
            $data=array(
                'idRAD' =>$row->id_Rel_Archivo_Documento,
                'idRAP' =>$row->id,
                'idDireccion_preregistra' => $row->idDireccion_responsable,
            );
            $retorno = $this->archivo_model->insert_relacion_RAD_RAP($data);
            
            echo "Ciclo $i <br>";
            echo $retorno['retorno'] ."-" .$retorno['registro']."<br>";
            $i++;
            
        }

    }
    
    
    
}    


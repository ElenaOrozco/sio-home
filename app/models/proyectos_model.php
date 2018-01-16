<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Proyectos_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    
    public function ot_json($term = null, $id = null){
        $aRow = array();
        $return_arr = array();            
        if (!empty($term) || !empty($id)){
            if ($id > 0){


                $this->db->select("id,OrdenTrabajo");
                $this->db->order_by("OrdenTrabajo", "ASC");
                $query2 = $this->db->get_where("saaArchivo",array("id" => $id),100);

            }else{


                $this->db->select("id,OrdenTrabajo");
                $this->db->like("OrdenTrabajo",$term);
                $this->db->order_by("OrdenTrabajo", "ASC");
                $query2 = $this->db->get("saaArchivo",100);                    
            }

            if ($query2->num_rows() > 0){


                foreach ($query2->result() as $row ){
                    $aRow["id"] = $row->id;
                    $aRow["text"] = $row->OrdenTrabajo;
                    $return_arr["results"][] = $aRow;
                }
            }else{
                $aRow["id"] = "newremit";
                $aRow["text"] = 'No se encontro OT';
                $return_arr["results"][] = $aRow;
            }
        }else{
            $aRow["id"] = "";
            $aRow["text"] = "";
            $return_arr["results"][] = $aRow;
        } 
        return $return_arr; 
    }
        
    
    public function buscar_fila_anterior(){
        $this->db->select("*");
        //$this->db->where("cm_utilizados <", 86-$cm);
        $this->db->where("eliminacion_logica", 0);
        $this->db->where("estatus", 1);
        $this->db->order_by('id DESC');
        $this->db->limit(1);
        return $this->db->get('saaUbicacion_Proyecto');
        
    
    }
    
    public function buscar_siguiente_fila(){
        
        $this->db->select("*");
        $this->db->where("eliminacion_logica", 0);
        $this->db->where("estatus", 0);
        $this->db->order_by('id ASC');
        $this->db->limit(1);
        return $this->db->get('saaUbicacion_Proyecto');
    
    }
    
    public function hay_espacion_fila($cm, $id){
        
        $this->db->select("*");
        $this->db->where("id", $id);
        $this->db->where("cm_utilizados <=", 85-$cm);
        $this->db->order_by('id ASC');
        $this->db->limit(1);
        $query =  $this->db->get('saaUbicacion_Proyecto');
        return ($query->num_rows() > 0)? TRUE : FALSE;
    }

    public function buscar_ubicacion($cm){
        
        //echo "cm  $cm <br>";
        //buscar ubicaciones disponibles
        $fila_anterior  = $this->buscar_fila_anterior();
       
        
        //Cuando es el primer registro
        if ($fila_anterior->num_rows() == 0){ 
            $ubicacion = $this->buscar_siguiente_fila();
        } else {
            $array_fila = $fila_anterior->row_array();
            if ($this->hay_espacion_fila($cm, $array_fila['id'])){

                $ubicacion = $fila_anterior;
            }else{
                $ubicacion = $this->buscar_siguiente_fila();

            }
        }
        
        
        return $ubicacion;
            
    }
    
    public function get_carpetas_ubicacion($id){
        $this->db->select("id");
        $this->db->where("idUbicacion", $id);
        $this->db->where("eliminacion_logica", 0);
        $query =  $this->db->get('saaRel_Proyecto_Ubicacion');
        return $query->num_rows();
    }

    public function asignar_ubicacion($data){
        
        $e = "";
        $resultado = "";
        
        $this -> db -> trans_start (); 
        // for($i=0;$i<count($data);$i++) {
        
        foreach($data as $item)
        {
            
            $cm = $item['cm'];
            //Buscar Ubicacion
            $ubicacion = $this->buscar_ubicacion($cm);
            //var_dump($ubicacion->row_array());
            
            if ($ubicacion->num_rows() == 0){                                             //error ubicacion
                //$e = "No hay ubicaciones Disponibles";
            } else { 
                $ubicacion = $ubicacion->row_array();
                //No de Carpetas estante
                $numero = $this->get_carpetas_ubicacion($ubicacion['id']);
                //Actualizar cm
                
                $cm_utilizados = $ubicacion["cm_utilizados"] + $cm;
                $data_ubicacion = array (
                    "cm_utilizados"  => $cm_utilizados,
                    "estatus" => 1,

                );
                //echo "<br>cm utilizados" .  $cm_utilizados . "<br>";
                
                $this->db->where('id', $ubicacion['id']);
                $this->db->update('saaUbicacion_Proyecto', $data_ubicacion);

               //Actualizar Relacion
                    
                   
                $datosCarpeta = array(
                    "idArchivo"             => $item['idArchivo'],
                    "idUbicacion"           => $ubicacion["id"],
                    'fecha_ingreso'         => date('Y-m-d H:i:s'),
                    "carpeta"               => $item['carpeta'],
                    "orden"                 => $numero+1,
                    "cm"                    => $item['cm'],
                );

                $this->db->insert('saaRel_Proyecto_Ubicacion', $datosCarpeta);
                $e = $this->db->_error_message();
                $aff = $this->db->affected_rows();
                $last_query = $this->db->last_query();
                $registro = $this->db->insert_id();
                //echo "registro relacion " .  $registro. "<br>";
                if (!empty($registro)) {
                        $this->log_new(array('Tabla' => 'saaRel_Proyecto_Ubicacion', 'Data' => $datosCarpeta, 'id' => $registro));
                }

            }
           
        }
        
        $this -> db -> trans_complete ();
        
        return ( $this -> db -> trans_status ()  ===  FALSE )? -1 : 1;
        
        
    }
    
    public function eliminar_registro($id, $cm_anteriores, $idUbicacion){
        $this -> db -> trans_start (); 
        
        //Hacer eliminacion logica
        $data_eliminacion["eliminacion_logica"] = 1;
        $this->log_save(array('Tabla' => 'saaRel_Proyecto_Ubicacion', 'Data' => $data_eliminacion, 'id' => $id));
        
        $this->db->where('id', $id);
        $this->db->update('saaRel_Proyecto_Ubicacion', $data_eliminacion);

        //Actualizar (Restar) los cm del la Ubicacion
        $array_ubicacion = $this->get_cm_utilizados($idUbicacion);
        //var_dump($array_ubicacion);
        $data_ubicacion["cm_utilizados"] = $array_ubicacion["cm_utilizados"] - $cm_anteriores;
        $this->db->where('id', $idUbicacion);
        $this->db->update('saaUbicacion_Proyecto', $data_ubicacion); 

        //Actualizar nivel
        $registros_nivel = $this->get_registros_nivel($idUbicacion);
        //var_dump($registros_nivel->result());
        $i = 1;
        foreach($registros_nivel->result() as $registro){
            $id_registro = $registro->id;
            //echo $id_registro ."<br>";
            $data_registro['orden']= $i ;
            $this->db->where('id', $id_registro);
            $this->db->update('saaRel_Proyecto_Ubicacion', $data_registro);

            $i++;
        }
        
        $this -> db -> trans_complete ();
        return ( $this -> db -> trans_status ()  ===  FALSE )? -1 : 1;
    }

    public function actualizar_cm($idUbicacion, $data_ubicacion){
        $this->db->where('id', $idUbicacion);
        $this->db->update('saaUbicacion_Proyecto', $data_ubicacion); 
    }
    
    public function get_registros_nivel($idUbicacion){
        $this->db->where('idUbicacion', $idUbicacion);
        $this->db->where('eliminacion_logica', 0);
        $this->db->order_by('orden asc');
        return $this->db->get('saaRel_Proyecto_Ubicacion'); 
    }
    
    public function actualizar_registro($id, $data){
        $this->db->where('id', $id);
        $this->db->update('saaRel_Proyecto_Ubicacion', $data); 
    }

    public function get_cm_utilizados($idUbicacion){
        $this->db->where('id', $idUbicacion);
        return $this->db->get('saaUbicacion_Proyecto')->row_array(); 
    }
    
    public function actualizar_relacion_ubi_proyectos($id, $data){
        $this->db->where('id', $id);
        $this->db->update('saaRel_Proyecto_Ubicacion', $data); 
    }

    public function nueva_ubicacion($data){
        $this->db->insert('saaRel_Proyecto_Ubicacion', $data);
        $e = $this->db->_error_message();
        $aff = $this->db->affected_rows();
        $last_query = $this->db->last_query();
        $registro = $this->db->insert_id();
        
        if (!empty($registro)) {
                $this->log_new(array('Tabla' => 'saaRel_Proyecto_Ubicacion', 'Data' => $data, 'id' => $registro));
            }
        
       
        if ($aff < 1) {
            if (empty($e)) {
                $e = "No se realizaron cambios";
            }
            // si hay debug
            $e .= "<pre>" . $last_query . "</pre>";
            return array("retorno" => "-1", "error" => $e);
        } else {
           
            return array("retorno" => "1", "registro" => $registro);
        }
    } 
    
    public function no_proyectos_anaquel($id) {
        $sql = 'SELECT id FROM saaRel_Proyecto_Ubicacion WHERE idUbicacion = ? AND eliminacion_logica=0';
        $query = $this->db->query($sql, array($id));
        return $query;
    }
    
    public function listado(){
        $sql = 'SELECT `saaRel_Proyecto_Ubicacion`.* ,
	`saaUbicacion_Proyecto`.`no_isla`,
	`saaUbicacion_Proyecto`.`columna`,
	`saaUbicacion_Proyecto`.`fila`,
                `saaArchivo`.`OrdenTrabajo`,
                `saaArchivo`.`Contrato`,
                `saaArchivo`.`Obra`,
                `saaArchivo`.`Descripcion`
                
                 FROM  `saaUbicacion_Proyecto`
                 INNER JOIN saaRel_Proyecto_Ubicacion
                 ON `saaUbicacion_Proyecto`.id = `saaRel_Proyecto_Ubicacion`.`idUbicacion`
                 INNER JOIN `saaArchivo`
                 ON `saaArchivo`.id= `saaRel_Proyecto_Ubicacion`.`idArchivo`
                 WHERE `saaRel_Proyecto_Ubicacion`.`eliminacion_logica` = 0
                 ORDER BY  `saaRel_Proyecto_Ubicacion`.`idUbicacion` DESC, 
                 `saaRel_Proyecto_Ubicacion`.`orden` DESC';
        $query = $this->db->query($sql);
        return $query;
    }
    
    public function datos_asignacion($id){
        $sql = 'SELECT * FROM `saaRel_Proyecto_Ubicacion`
		WHERE id= ?';
        $query = $this->db->query($sql, array($id));
        return $query;
    }

    public function datos_ubicacion_update($id, $data){
            $this->log_save(array('Tabla' => 'saaRel_Proyecto_Ubicacion', 'Data' => $data, 'id' => $id));
            $this->db->where('id', $id);
            $this->db->update('saaRel_Proyecto_Ubicacion', $data);
            $e = $this->db->_error_message();
            $aff = $this->db->affected_rows();
            $last_query = $this->db->last_query();
   

            if ($aff < 1) {
                if (empty($e)) {
                    $e = "No se realizaron cambios";
                }
                // si hay debug
                $e .= "<pre>" . $last_query . "</pre>";
                return array("retorno" => "-1", "error" => $e);
            } else {
               
                return array("retorno" => "1", "registro" => $id);
            }
    }
    
    
    
    public function log_save($cambios) {
            $this->load->model("control_usuarios_model");
            return $this->control_usuarios_model->log_save($cambios);
    }
    
    public function log_new($cambios) {
            $this->load->model("control_usuarios_model");
            return $this->control_usuarios_model->log_new($cambios);
    }
   
    
    
}
        
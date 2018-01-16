<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Areas_ubicacion_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function listado() {
        
         $sql = 'SELECT * FROM `saaAreasUbicacionTrabajo` WHERE eliminacion_logica = 0';
            $query = $this->db->query($sql);
            return $query; 
        
        
    }
    
    
    public function datos_area($id){
        $sql = 'SELECT * FROM `saaAreasUbicacionTrabajo` WHERE id =?';
        $query = $this->db->query($sql, array($id));
        return $query;
    }
    
    public function datos_area_insert($data) {
        
        $this->db->insert('saaAreasUbicacionTrabajo', $data);
        $e = $this->db->_error_message();
        $aff = $this->db->affected_rows();
        $last_query = $this->db->last_query();
        $registro = $this->db->insert_id();
        
        if (!empty($registro)) {
                $this->log_new(array('Tabla' => 'saaAreasUbicacionTrabajo', 'Data' => $data, 'id' => $registro));
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
    
    public function datos_area_update($data, $id) {
        
        $this->log_save(array('Tabla' => 'saaAreasUbicacionTrabajo', 'Data' => $data, 'id' => $id));
        
        $this->db->update('saaAreasUbicacionTrabajo', $data, array('id' => $id));
        $e = $this->db->_error_message();
        $aff = $this->db->affected_rows();
        $last_query = $this->db->last_query();
//        $registro = $this->db->insert_id();
        //$this->db->db_debug = $oldv; 

        
        
        
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
    
    public function datos_area_delete($id) {
        $data = array(
            'eliminacion_logica' => 1,
        );
        
         
        $this->log_save(array('Tabla' => 'saaAreasUbicacionTrabajo', 'Data' => $data, 'id' => $id));
        
        $this->db->update('saaAreasUbicacionTrabajo', $data, array('id' => $id));
        $e = $this->db->_error_message();
        $aff = $this->db->affected_rows();
        $last_query = $this->db->last_query();
//        $registro = $this->db->insert_id();
        //$this->db->db_debug = $oldv; 

        
        
        
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
    
    
     public function concepto_repetido($str) {
        $this->db->where('Nombre', $str);
        $query = $this->db->get_where('saaAreasUbicacionTrabajo');
        if ($query->num_rows() > 0) {
            $concepto = $query->row();
            return array('ret' => true, 'concepto' => $concepto->Nombre);
        } else
            return array('ret' => false, 'concepto' => 0);
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
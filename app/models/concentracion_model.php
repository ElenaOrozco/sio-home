<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class concentracion_model extends CI_Model {

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
                $where = "OrdenTrabajo LIKE '%$term%'
                            AND NOT (idEjercicio = 2013
                            OR idEjercicio = 2014
                            OR idEjercicio = 2015)";

                $this->db->select("id,OrdenTrabajo");
                $this->db->where($where);
               
                
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
    
    public function detalles_archivo($ot){
        $this->db->select("*");
        $this->db->where('id', $ot);  
        return $this->db->get("saaArchivo")->row_array(); 
        
        
    }
    public function fecha_ingreso($ot){
        /* *
        $this->db->select("fecha_ingreso");
        $this->db->distinct();
        $this->db->where('id', $ot);
        $this->db->order_by('fecha_ingreso', 'DESC');
        $this->db->limit(1);
        * */
         
        
        $query = $this->db->query("SELECT DISTINCT fecha_ingreso 
            FROM `saaRel_Archivo_Preregistro`
            WHERE idArchivo = $ot
            ORDER BY fecha_ingreso DESC
            LIMIT 1");

        $row = $query->row_array();
        
        return $row; 
        
        
    }
    
    public function datos_concentracion_insert($data){
        $this->db->insert('saaRel_ArchivoConcentracion_Ubicacion', $data);
        $e = $this->db->_error_message();
        $aff = $this->db->affected_rows();
        $last_query = $this->db->last_query();
        $registro = $this->db->insert_id();
        
        if (!empty($registro)) {
                $this->log_new(array('Tabla' => 'saaRel_ArchivoConcentracion_Ubicacion', 'Data' => $data, 'id' => $registro));
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
    
    
    
    public function capturar_datos_archivo($data, $id){
        $this->db->where('id', $id);
        $this->db->update('saaArchivo', $data);
        $aff = $this->db->affected_rows();
        $this->log_save(array('Tabla' => 'saaArchivo', 'Data' => $data, 'id' => $id));
        if($aff < 1) {
            return -1;
        } else {
            return 1;
        }
    }
    
    public function cambiar_identificador($id, $data){
        $this->db->where('id', $id);
        $this->db->update('saaArchivo', $data);
        $aff = $this->db->affected_rows();
        $this->log_save(array('Tabla' => 'saaArchivo', 'Data' => $data, 'id' => $id));

        if($aff < 1) {
            return -1;
        } else {
            return 1;
        }
    }
    
    
    
    public function listado_ubicaciones(){
        $this -> db -> select ( 'c.*, ide.identificador' ); 
        $this -> db -> from ( 'concentracion as c' ); 
        $this -> db -> join ( 'saaTransferencia_Cuca as ide', 'c.identificado = ide.id '); 
        $this -> db -> where ('c.idR IS NOT NULL');
        $this -> db -> order_by ('c.idI DESC, c.id ASC');
        $query  =  $this -> db -> get ();
        return $query;

    }
    
    public function get_identificador($id){
        $this -> db -> select ( 'identificador' ); 
        $this -> db -> from ( 'saaTransferencia_Cuca' );  
        $this -> db -> where ('id', $id);
       
        $query  =  $this -> db -> get ();
        return $query->row_array();

    }
    
    
    public function get_ingresosOT($idArchivo){
        $this->db->where('idArchivo', $idArchivo);
        $query = $this->db->get('concentracion');
        return $query;
    }
    
    //Registros Concentracion
    public function datos_relacion_ubicacion($id){
        $this -> db -> select ( 'c.*, ide.identificador' ); 
        $this -> db -> from ( 'concentracion as c' ); 
        $this -> db -> join ( 'saaTransferencia_Cuca as ide', 'c.identificado = ide.id '); 
       
        $this -> db -> where ('idR', $id);
        
        $query  =  $this -> db -> get ();
        return $query;

    }
    
    public function get_idUbicaciones( $ubicaciones_necesarias, $estatus ){
        $this -> db -> select ( 'id, Nombre' );
        $this -> db -> where('Estatus', $estatus);
        $this -> db -> order_by ('id', 'ASC');
        $this -> db -> limit ($ubicaciones_necesarias);
        return $this -> db -> get ( 'saaConcentracion_UbicacionesTipos' );
       
    }
    
     public function buscar_vacias( $identificador ){
        
        $estatus = -1; 
        $this -> db -> select ( 'ut.*, 
                    r.idIngreso,
                    i.idArchivo,
                    a.identificado' );
        $this -> db -> from ( 'saaConcentracion_UbicacionesTipos AS ut' ); 
        $this -> db -> join ( 'saaConcentracion_Registros AS r' ,  'r.idUbicacion = ut.idUbicacion' ); 
        $this -> db -> join ( 'saaConcentracion_Ingreso AS i' ,  'i.id = r.idIngreso' ); 
        $this -> db -> join ( 'saaArchivo as a' ,  'a.id = i.idArchivo' );
        $this -> db -> where('ut.Estatus', $estatus); //   -1  Vacias
        $this -> db -> where('a.identificado', $identificador); 
        $this -> db -> limit (1);
        
        return $this -> db -> get (  );
       
    }
    
    public function listado(){
        $this -> db -> select ( '*' ); 
        $query  =  $this -> db -> get ('transferencias');
        return $query;
    }
    
    public function update_ubi($data, $Nombre){
        $like = "Nombre LIKE '%$Nombre%'";
        
       
        
        $this -> db -> set ( 'idUbicacion' ,  $data['idUbicacion'] ); 
        $this -> db -> where ( $like ); 
        $this -> db -> update ( 'saaUbicaciones_Concentracion' );  // da UPDATE mytable SET campo = campo + 1 DONDE id = 2

        $aff = $this->db->affected_rows();
       
       $this->log_save(array('Tabla' => 'saaUbicaciones_Concentracion', 'Data' => $data, 'id' => $id));

        if ($aff < 1) {
            return array("retorno" => "-1", "query" => $str );
        } else {
            return array("retorno" => "1", "query" => $str );
        }
    }
    
    public function alta_concentracion($data_ingreso){
        /*$legajos = $data_ingreso['legajos'];
        $ubicaciones =  $data_ingreso['ubicaciones_necesarias'];
        
        $data = array();
        $i = 0;
        
        
        $this -> db -> trans_start (); 
        
         //Ingresar datos comunes del registro (cabeceras)
        $this -> db -> insert('saaConcentracion_Ingreso', $data_ingreso['data_cabecera']);   
        $idIngreso = $this-> db-> insert_id ();
        
        for ($i = 0 ; $i < $ubicaciones ; $i++ ){
            
            if ($legajos > $i){
                
                //insertar registros concentracion
              
                $data['idIngreso'] = $idIngreso;
                $this -> db -> insert('saaConcentracion_Registros', $data);
                $idRegistro = $this-> db-> insert_id ();
                 
            }
        }
        
        $this -> db -> trans_complete ();
        
        if  ( $this -> db -> trans_status ()  ===  FALSE ) 
        { 
                // genera un error ... o usa la función log_message () para registrar tu error 
            return -1;
        } else {
            return $idIngreso;
        }
        /*/
        
        $legajos = $data_ingreso['legajos'];
        $idUbicaciones = $data_ingreso['idUbicaciones'];
        $data = array();
        $i = 0;
        
        
        $this -> db -> trans_start (); 
        
         //Ingresar datos comunes del registro (cabeceras)
        $this -> db -> insert('saaConcentracion_Ingreso', $data_ingreso['data_cabecera']);   
        $idIngreso = $this-> db-> insert_id ();
        
        foreach ($idUbicaciones->result() as $row){
            
            if ($legajos > $i){
                
                //insertar registros concentracion
                $data['idUbicacion'] = $row->id;
                $data['idIngreso'] = $idIngreso;
                $this -> db -> insert('saaConcentracion_Registros', $data);
                
                $idRegistro = $this-> db-> insert_id ();
                
               
        
                if (!empty($idRegistro)) {
                        $this->log_new(array('Tabla' => 'saaRel_ArchivoConcentracion_Ubicacion', 'Data' => $data, 'id' => $idRegistro));
                }
                
                //Marcar la ubicacion ocupada
                $data_ubicacion = array(
                   'Estatus' => 1,
                   'idRegistro' => $idRegistro,
                  
                );

                $this->db->where('id', $row->id);
                $this->db->update('saaConcentracion_UbicacionesTipos', $data_ubicacion); 
               
            } else { 
                //Marcar como Vacia
                $this -> db -> query ( 'UPDATE saaConcentracion_UbicacionesTipos SET Estatus = -1 WHERE id = '.$row->id ); 
            }
            
            
            
            $i++;
        }
        
        $this -> db -> trans_complete ();
        
        if  ( $this -> db -> trans_status ()  ===  FALSE ) 
        { 
            // genera un error ... o usa la función log_message () para registrar tu error 
            return -1;
        } else {
            return $idIngreso;
        }
        
        
    }
    
    public function traer_relaciones($idIngreso){
        
 
                
        $this -> db -> select ( 'r.*, t.Nombre' );
        $this -> db -> from ( 'saaConcentracion_Registros as r' ); 
        $this -> db -> join ( 'saaConcentracion_UbicacionesTipos as t' ,  't.idRegistro = r.id' );         
        $this->db->where('r.idIngreso', $idIngreso);
        $query = $this->db->get( );
        return $query;
        
      
    }
    
    
    public function actualizar_relacion($id, $data){
        $this -> db -> where ('id', $id);
        $this -> db -> update ('saaConcentracion_Registros', $data);
        $aff = $this->db->affected_rows();
        $this->log_save(array('Tabla' => 'saaConcentracion_Registros', 'Data' => $data, 'id' => $id));
        return ($aff < 1)?  -1 :   1;
    
    }
    
    public function actualizar_ubicacion($id, $data){
        
        
        $this -> db -> trans_start (); 
        
        //Traer la ubicacion anterior
        $this -> db -> select ( 'idUbicacion' ); 
        $this -> db -> where ( 'id' , $id); 
        $Ubicacion_anterior =  $this -> db -> get ('saaConcentracion_Registros')->row_array();
        
        $anterior =  $Ubicacion_anterior['idUbicacion'];
        //Poner en cero  la ubicacion anterior
        $data_ubi = array (
            'Estatus' => 0,
        );
        $this -> db -> where ('id', $anterior);
        $this -> db -> update ('saaConcentracion_UbicacionesTipos', $data_ubi);
        $this->log_save(array('Tabla' => 'saaConcentracion_UbicacionesTipos', 'Data' => $data, 'id' => $id));
        
        //Marcar como ocupada la nueva ubicacion
        $data_ubi['Estatus'] = 1;
        $this -> db -> where ('id', $data['idUbicacion']);
        $this -> db -> update ('saaConcentracion_UbicacionesTipos', $data);


        //Registrar la nueva ubicacion
        $this -> db -> where ('id', $id);
        $this -> db -> update ('saaConcentracion_Registros', $data);
        
       
        
        $this -> db -> trans_complete ();
        
        if  ( $this -> db -> trans_status ()  ===  FALSE ) 
        { 
            // genera un error ... o usa la función log_message () para registrar tu error 
            return -1;
        } else {
            return 1;
        }
       
    
    }
    
    public function traer_ubicaciones(){
        
        return $this -> db -> get ( 'saaConcentracion_UbicacionesTipos' );
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
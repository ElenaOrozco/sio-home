<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class archivo_model extends CI_Model {

    var $table = "saaArchivo as a";  
    
    
    public function __construct() {
        parent::__construct();
    }


    // ******************       LISTADO DE OBRAS     *******************************//
    public function make_query(){  
           $this->db->select("a.*, m.Modalidad, d.Nombre");  
           $this->db->from($this->table); 
           $this->db->join("saaModalidad as m", " a.idModalidad = m.id");
           $this->db->join("catDirecciones as d", "d.id = a.idDireccion");
           
            
           if(isset($_POST["search"]["value"]))  
           {  
                $this->db->like("a.OrdenTrabajo", $_POST["search"]["value"]);  
                $this->db->or_like("a.Obra", $_POST["search"]["value"]); 
                $this->db->or_like("a.Contrato", $_POST["search"]["value"]);  
                $this->db->or_like("a.Descripcion", $_POST["search"]["value"]); 
                $this->db->or_like("a.Obra", $_POST["search"]["value"]); 
                $this->db->or_like("a.Normatividad", $_POST["search"]["value"]); 
                $this->db->or_like("m.Modalidad", $_POST["search"]["value"]); 
                $this->db->or_like("a.idEjercicio", $_POST["search"]["value"]); 
                $this->db->or_like("a.Direccion", $_POST["search"]["value"]); 
                $this->db->or_like("a.Supervisor", $_POST["search"]["value"]); 
                $this->db->or_like("a.FechaInicio", $_POST["search"]["value"]); 
                $this->db->or_like("a.ImporteContratado", $_POST["search"]["value"]); 
                $this->db->or_like("a.EjercidoSiop", $_POST["search"]["value"]);
                $this->db->or_like("a.Contratista", $_POST["search"]["value"]); 
                if ($_POST["search"]["value"] == "si"){
                  $this->db->or_like("a.Finiquitada", 1); 
                }
                if ($_POST["search"]["value"] == "no"){
                  $this->db->or_like("a.Finiquitada", 0); 
                } 
 

           }  
           if(isset($_POST["order"]))  
           {  
                $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
           }  
           else 
           {  
                $this->db->order_by('a.id', 'DESC');  
           }  
    } 
      
    public function make_datatables(){  
           $this->make_query();  
           if($_POST["length"] != -1)  
           {  
                $this->db->limit($_POST['length'], $_POST['start']);  
           }  
           $query = $this->db->get(); 
           
           return $query->result();  
    }  
    
    public function crear_datatables(){  
           $this->make_query();  
           if($_POST["length"] != -1)  
           {  
                $this->db->limit($_POST['length'], $_POST['start']);  
           }  
           $query = $this->db->get();
           
           return $query->result();  
    }  
    
    public function get_filtered_data(){  
           $this->make_query();  
           $query = $this->db->get();  
           return $query->num_rows();  
    }       
      
    public function get_all_data(){  
           $this->db->select("*");  
           $this->db->from($this->table); 
           
           
           return $this->db->count_all_results();  
    }

    public function get_estatus_fido($idArchivo){
        $this->db->select("rel.idTipoProceso,p.Nombre as Proceso, e.Nombre as Estatus,          ");  
        $this->db->distinct();  
        $this->db->from("saaRel_Archivo_Documento as rel"); 
        $this->db->join("saaTipoProceso as p", " p.id = rel.idTipoProceso");
        $this->db->join("sisEstatus as e", " e.Estatus = rel.Estatus");
        $this->db->where("rel.idArchivo", $idArchivo);
        $query = $this->db->get();
        return $query;
    }
 
    // ******************       EDICION PREREGISTRO     ****************************//

    public function procesos_de_archivo($id, $direccion_usuario){
        $this->db->select("rel.idTipoProceso,rel.idUsuario_Trabajando,p.Nombre as Proceso, e.Nombre as Estatus,
              (SELECT COUNT(id) 
              FROM `saarel_archivo_documento`
              WHERE idArchivo = $id
              AND idTipoProceso =  rel.idTipoProceso) AS total,
              (SELECT COUNT(rp.id)
              FROM saarel_archivo_preregistro AS rp
              INNER JOIN saarel_archivo_documento AS rd
              ON rd.id = rp.id_Rel_Archivo_Documento
              WHERE rd.idArchivo = $id
              AND idTipoProceso =  rel.idTipoProceso
              AND rp.`idDireccion_responsable` =$direccion_usuario) AS preregistrados
          ");  
        $this->db->distinct();  
        $this->db->from("saaRel_Archivo_Documento as rel"); 
        $this->db->join("saaTipoProceso as p", " p.id = rel.idTipoProceso");
        $this->db->join("sisEstatus as e", " e.Estatus = rel.Estatus");
        $this->db->where("rel.idArchivo", $id);
        $query = $this->db->get();
        return $query;
    }

    public function subprocesos_de_proceso($idArchivo, $idTipoProceso, $direccion_usuario){
        $this->db->select("p.id, p.Nombre, p.idTipoProceso,
              (SELECT COUNT(id) 
              FROM `saarel_archivo_documento`
              WHERE idArchivo = $idArchivo
              AND idSubTipoProceso =  p.id) AS total,
              (SELECT COUNT(rp.id)
              FROM saarel_archivo_preregistro AS rp
              INNER JOIN saarel_archivo_documento AS rd
              ON rd.id = rp.id_Rel_Archivo_Documento
              WHERE rd.idArchivo = $idArchivo
              AND idSubTipoProceso =  p.id
              AND rp.`idDireccion_responsable` =$direccion_usuario) AS preregistrados
          ");   
        $this->db->distinct();  
        $this->db->from("saaRel_Archivo_Documento as rel"); 
        $this->db->join("saaSubTipoProceso as p", " p.id = rel.idSubTipoProceso");
        $this->db->where("rel.idArchivo", $idArchivo);
        $this->db->where("rel.idTipoProceso", $idTipoProceso);
        $this->db->order_by("p.Ordenar, p.Nombre");
        $query = $this->db->get();
        return $query;
    }

    public function listado_preregistros(){
      
        return $this->db->get('saaRel_Archivo_Preregistro');

    }

    public function datos_Archivo($id_archivo){
      $this->db->where("id", $id_archivo);
      return $this->db->get('saaArchivo');
    }

    public function documentos_de_subproceso($idArchivo, $idTipoProceso, $idSubTipoProceso){

        $this->db->select("rel.id, 
          rel.idDocumento, 
          rel.idTipoProceso, 
          rel.idSubTipoProceso,
          d.idDireccion_responsable AS responsable_documento,
          d.Nombre, 
          dir.Nombre AS Direccion,
          rel.Ordenar");    
        $this->db->from("saaRel_Archivo_Documento as rel"); 
        $this->db->join("saaDocumentos as d", "rel.idDocumento = d.id");
        $this->db->join("catDirecciones AS dir", "d.idDireccion_responsable = dir.id", "left");
        $this->db->where("rel.idArchivo", $idArchivo);
        $this->db->where("rel.idTipoProceso", $idTipoProceso);
        $this->db->where("rel.idSubTipoProceso", $idSubTipoProceso);
        $this->db->order_by("rel.Ordenar");
        $query = $this->db->get();
        return $query;


        /*$this->db->select("p.*");    
        $this->db->from("saaRel_Archivo_Documento as rel"); 
        $this->db->join("plantilla_documento as p", " p.idRAD = rel.id");
        $this->db->where("rel.idArchivo", $idArchivo);
        $this->db->where("rel.idTipoProceso", $idTipoProceso);
        $this->db->where("rel.idSubTipoProceso", $idSubTipoProceso);
        $this->db->order_by("rel.Ordenar");
        $query = $this->db->get();
        return $query;*/
    }


    public function documentos_de_archivo($idArchivo){

        $this->db->select("rel.id, 
          rel.idDocumento, 
          rel.idTipoProceso, 
          rel.idSubTipoProceso,
          d.idDireccion_responsable AS responsable_documento,
          d.Nombre, 
          dir.Nombre AS Direccion,
          rel.Ordenar");    
        $this->db->from("saaRel_Archivo_Documento as rel"); 
        $this->db->join("saaDocumentos as d", "rel.idDocumento = d.id");
        $this->db->join("catDirecciones AS dir", "d.idDireccion_responsable = dir.id", "left");
        $this->db->where("rel.idArchivo", $idArchivo);
        $this->db->order_by("rel.Ordenar");
        $query = $this->db->get();
        return $query;

    }

    public function traer_preregistrados($idArchivo, $direccion_usuario){
      $this->db->where('idArchivo', $idArchivo);
      $this->db->where('idDireccion_responsable', $direccion_usuario);
      return $this->db->get('saaRel_Archivo_Preregistro');

    }

    public function datos_de_archivo($id) {
        $query = $this->db->get_where("saaArchivo", array("id" => $id));
        return $query;
    }

    public function insertar_preregistro($data){
      $this->db->insert('saaRel_Archivo_Preregistro', $data);
      $e = $this->db->_error_message();
      $aff = $this->db->affected_rows();
      $last_query = $this->db->last_query();
      $registro = $this->db->insert_id();

      return ($aff < 1)? -1 : 1;
    }

    public function modificar_preregistro($id,$data){
      $this->db->where('id', $id);
      $this->db->update('saaRel_Archivo_Preregistro', $data);
      
      $aff = $this->db->affected_rows();
      
      return ($aff < 1)? -1 : 1;
    }

    public function eliminar_preregistro($id){
      $this->db->where('id', $id);
      $this->db->delete('saaRel_Archivo_Preregistro');
      $aff = $this->db->affected_rows();
      
      return ($aff < 1)? -1 : 1;

    }

    public function total_documentos_proceso($idArchivo, $idTipoProceso){
      
      $this->db->where('idArchivo', $idArchivo);
      $this->db->where('idTipoProceso', $idTipoProceso);
      
      $query= $this->db->get('saaRel_Archivo_Documento');
      return $query->num_rows();

    }
    public function total_documentos_subproceso($idArchivo, $idSubProceso){
      
      $this->db->where('idArchivo', $idArchivo);
      $this->db->where('idSubTipoProceso', $idSubProceso);
      $query= $this->db->get('saaRel_Archivo_Documento');
      return $query->num_rows();

    }

    public function preregistrados_proceso_direccion($idArchivo, $idTipoProceso, $idDireccion_responsable){
      $this->db->select('p.id');
      $this->db->from('saaRel_Archivo_Documento as d');
      $this->db->join('saaRel_Archivo_Preregistro as p', 'd.id = p.id_Rel_Archivo_Documento');
      $this->db->where('d.idArchivo', $idArchivo);
      $this->db->where('d.idTipoProceso', $idTipoProceso);
      return $this->db->get()->num_rows();
    }
    
    public function preregistrados_subproceso_direccion($idArchivo, $idSubProceso, $idDireccion_responsable){
     $this->db->select('p.id');
      $this->db->from('saaRel_Archivo_Documento as d');
      $this->db->join('saaRel_Archivo_Preregistro as p', 'd.id = p.id_Rel_Archivo_Documento');
      $this->db->where('d.idArchivo', $idArchivo);
      $this->db->where('d.idSubTipoProceso', $idSubProceso);
      return $this->db->get()->num_rows();;
    }

 
   /* public function make_query(){  
           $this->db->select("*");  
           $this->db->from($this->table); 
           
            
           if(isset($_POST["search"]["value"]))  
           {  
                $this->db->like("OrdenTrabajo", $_POST["search"]["value"]);  
                $this->db->or_like("Obra", $_POST["search"]["value"]); 
                $this->db->or_like("Contrato", $_POST["search"]["value"]); 
                $this->db->or_like("Descripcion", $_POST["search"]["value"]);
                $this->db->or_like("Supervisor", $_POST["search"]["value"]); 
                $this->db->or_like("Contratista", $_POST["search"]["value"]); 
                
           }  
           if(isset($_POST["order"]))  
           {  
                $this->db->order_by($this->order_column[$_POST['order']['0']['column']], 
                        $_POST['order']['0']['dir'],
                        $_POST['order']['0']['dir'],
                        $_POST['order']['0']['dir'], 
                        $_POST['order']['0']['dir'], 
                        $_POST['order']['0']['dir'],
                        $_POST['order']['0']['dir'],
                        $_POST['order']['0']['dir'],
                        $_POST['order']['0']['dir'],
                        $_POST['order']['0']['dir'],
                        $_POST['order']['0']['dir'],
                        $_POST['order']['0']['dir'],
                        $_POST['order']['0']['dir'],
                        $_POST['order']['0']['dir'],
                        $_POST['order']['0']['dir'],
                        $_POST['order']['0']['dir'],
                        $_POST['order']['0']['dir']
                       
                        
                        );  
           }  
           else 
           {  
                $this->db->order_by('id', 'DESC');  
           }  
    } */
    
    
   /* public function make_datatables(){  
           $this->make_query();  
           if($_POST["length"] != -1)  
           {  
                $this->db->limit($_POST['length'], $_POST['start']);  
           }  
           $query = $this->db->get(); 
           
           return $query->result();  
    }  */
    
    /*public function crear_datatables(){  
           $this->make_query();  
           if($_POST["length"] != -1)  
           {  
                $this->db->limit($_POST['length'], $_POST['start']);  
           }  
           $query = $this->db->get();
           
           return $query->result();  
    }  
    
    function get_filtered_data(){  
           $this->make_query();  
           $query = $this->db->get();  
           return $query->num_rows();  
    }       
      
    function get_all_data(){  
           $this->db->select("*");  
           $this->db->from($this->table); 
           $where = "(idBloqueObra = 1 OR 
                idBloqueObra = 2 
                OR idBloqueObra = 3)
                AND eliminacion_logica = 0";
            $this->db->where($where);
           return $this->db->count_all_results();  
    }*/
    
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


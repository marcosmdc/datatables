<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Datatable_model extends CI_Model
{

    public function __construct()
    {
    
        $this->load->database('default', TRUE);
    }

    
    function getDatos()
    {
		$this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();        
        return $query->result();
    }


    private function _get_datatables_query()
    {
        $this->db->select('*');
        $this->db->from("producto");
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
		$this->db->from("producto");
        return $this->db->count_all_results();
    }
   

    
function getProductoQuery($query, $deposito)
{
    $this->db->select('id_producto as id, producto_nombre, cod_prod, cantidad');
    $this->db->from('v_egreso_ingreso');
    $this->db->like('producto_nombre', $query);
    $this->db->where('id_deposito', $deposito);
    $query = $this->db->get();
    $data = $query->result();
    return $data;
}

}

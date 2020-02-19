<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pasar_Model extends CI_Model {

    function get_all(){
        $data = $this->db->get('tbl_pasar');
        return $data->result();
    }

    function get_data($id){
        $this->db->where($id);
        $data = $this->db->get('tbl_pasar');
        return $data->row();
    }

    function add($data){
        $this->db->insert('tbl_pasar',$data);
        return $this->db->insert_id();
    }

    function update($where, $data){
        $this->db->set($data);
        $this->db->where($where);
        $this->db->update('tbl_pasar');
        return $this->db->affected_rows();
    }

    function delete($id){
        $this->db->delete('tbl_pasar',$id);
    }

}

/* End of file Pasar_Model.php */

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Survey_Model extends CI_Model {

    function get_all(){
        $data = $this->db->get('tbl_survey');
        return $data->result();
    }

    function get_data($id){
        $this->db->where($id);
        $data = $this->db->get('tbl_survey');
        return $data->row();
    }

    function add($data){
        $this->db->insert('tbl_survey',$data);
        return $this->db->insert_id();
    }

    function update($where, $data){
        $this->db->set($data);
        $this->db->where($where);
        $this->db->update('tbl_survey');
        return $this->db->affected_rows();
    }

    function delete($id){
        $this->db->delete('tbl_survey',$id);
    }

    function get_pasar(){
        $data = $this->db->get('tbl_pasar');
        return $data->result();
    }

    function get_komoditas(){
        $data = $this->db->get('tbl_komoditas');
        return $data->result();
    }

    function get_pasar_by($id){
        $this->db->where($id);
        $data = $this->db->get('tbl_pasar');
        return $data->result_array();
    }

    function get_komoditas_by($id){
        $this->db->where($id);
        $data = $this->db->get('tbl_komoditas');
        return $data->result_array();
    }
    
    function get_user_by($id){
        $this->db->where($id);
        $data = $this->db->get('tbl_users');
        return $data->result_array();
    }
}

/* End of file Survey_Model.php */

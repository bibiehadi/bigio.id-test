<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Survey_Model extends CI_Model {

    function get_all(){
        $data = $this->db->get('tbl_survey');
        return $data->result();
    }

    function get_accept(){
        $this->db->where('status','Disetujui');
        $data = $this->db->get('tbl_survey');
        return $data->result();
    }

    function get_srv($id){
        $this->db->where('id_user',$id);
        $data = $this->db->get('tbl_survey');
        return $data->result();
    }

    function get_data($id){
        $this->db->where($id);
        $data = $this->db->get('tbl_survey');
        return $data->row();
    }

    function add_data($data){
        $user = $this->session->userdata('id');
        $set = array();
        foreach($data['komoditas'] as $kom){
            $set[] = array_merge($kom,array(
                'id_pasar'=>$data['id_pasar'],
                'date'=>$data['date'],
                'id_user'=>$user,
                'status'=>'Menunggu'
            ));
        }
        if(count($set)>0)
        return $this->db->insert_batch('tbl_survey',$set);
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

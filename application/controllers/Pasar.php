<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasar extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        if($this->session->userdata('logged_in')!=TRUE){
            redirect('login');
        }
        $this->load->model('pasar_model', 'pasar');
    }
    
    public function index()
    {   
        if($this->session->userdata('role')==='adm'){
            $this->load->view('pasar_view');
        }
        
    }

    public function dataJSON(){
        $pasars = $this->pasar->get_all();
        foreach ($pasars as $pasar) {
            $row['id'] = $pasar->id;
            $row['nama'] = $pasar->nama;
            $row['alamat'] = $pasar->alamat;
 
            //add html for action
            $row['action'] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_pasar('."'".$pasar->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_pasar('."'".$pasar->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "data" => $data,
        );
        echo json_encode($data);
    }

    public function add_data(){
        $data = array(
            'nama' => $this->input->post('nama_pasar'),
            'alamat' => $this->input->post('alamat')
        );
        $this->pasar->add($data);
        echo json_encode(array("status" => TRUE));
    }

    public function edit_data($id){
        $data = $this->pasar->get_data(array('id' => $id));
        echo json_encode($data);
    }

    public function update_data(){
        $data = array(
            'nama' => $this->input->post('nama_pasar'),
            'alamat' => $this->input->post('alamat')
        );
        $this->pasar->update(array("id" => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function delete_data($id){
        $this->pasar->delete(array('id' => $id));
        echo json_encode(array("status" => TRUE));
    }

}

/* End of file Controllername.php */

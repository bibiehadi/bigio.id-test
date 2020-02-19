<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class Survey extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('logged_in')!=TRUE){
            redirect('login');
        }
        $this->load->model('survey_model', 'survey');
    }
    
    public function index()
    {
        $data['pasar'] = $this->survey->get_pasar();
        $data['komoditas'] = $this->survey->get_komoditas();
        $this->load->view('survey_view',$data);
    }

    public function dataJSON(){
        $datas = $this->survey->get_all();
        foreach ($datas as $data) {
            $kom = $this->get_komoditas($data->id_komoditas);
            $row['id'] = $data->id;
            $row['komoditas'] = $kom['nama']; 
            $row['satuan'] = $kom['satuan'];
            $row['harga'] = $data->harga;
            $row['pasar'] = $this->get_pasar($data->id_pasar);
            $row['user'] = $this->get_user($data->id_user);
            $row['date'] = $data->date;
            $row['status'] = $data->status;
            if (($data->status)== 'Menunggu'){
                $row['status'] = "<label class='label label-default'>Menunggu</label>";
            }else if (($data->status)== 'Disetujui'){
                $row['status'] = "<label class='label label-primary'>Disetujui</label>";
            }else{
                $row['status'] = "<label class='label label-danger'>Ditolak</label>";
            }
            $row['action'] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_survey('."'".$data->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_survey('."'".$data->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            
            $result[] = $row;
        }
        echo json_encode($result);
    }

    public function srvJSON(){
        $datas = $this->survey->get_srv($this->session->userdata('id'));
        foreach ($datas as $data) {
            $kom = $this->get_komoditas($data->id_komoditas);
            $row['id'] = $data->id;
            $row['komoditas'] = $kom['nama']; 
            $row['satuan'] = $kom['satuan'];
            $row['harga'] = $data->harga;
            $row['pasar'] = $this->get_pasar($data->id_pasar);
            $row['user'] = $this->get_user($data->id_user);
            $row['date'] = $data->date;
            $row['status'] = $data->status;
            if (($data->status)== 'Menunggu'){
                $row['status'] = "<label class='label label-default'>Menunggu</label>";
            }else if (($data->status)== 'Disetujui'){
                $row['status'] = "<label class='label label-primary'>Disetujui</label>";
            }else{
                $row['status'] = "<label class='label label-danger'>Ditolak</label>";
            }
            $row['action'] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_survey('."'".$data->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_survey('."'".$data->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            
            $result[] = $row;
        }
        echo json_encode($result);
    }

    public function vstJSON(){
        $datas = $this->survey->get_accept();
        foreach ($datas as $data) {
            $kom = $this->get_komoditas($data->id_komoditas);
            $row['id'] = $data->id;
            $row['komoditas'] = $kom['nama']; 
            $row['satuan'] = $kom['satuan'];
            $row['harga'] = $data->harga;
            $row['pasar'] = $this->get_pasar($data->id_pasar);
            $row['user'] = $this->get_user($data->id_user);
            $row['date'] = $data->date;
            $row['status'] = $data->status;
            if (($data->status)== 'Menunggu'){
                $row['status'] = "<label class='label label-default'>Menunggu</label>";
            }else if (($data->status)== 'Disetujui'){
                $row['status'] = "<label class='label label-primary'>Disetujui</label>";
            }else{
                $row['status'] = "<label class='label label-danger'>Ditolak</label>";
            }
            $row['action'] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_survey('."'".$data->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_survey('."'".$data->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            
            $result[] = $row;
        }
        echo json_encode($result);
    }



    public function survey_form(){
        if(($this->session->userdata('role')=='adm')||($this->session->userdata('role')=='srv')){    
            $data['pasar'] = $this->survey->get_pasar();
            $data['komoditas'] = $this->survey->get_komoditas();
            $this->load->view('surveyform_view',$data);
        }else{
            redirect('survey','refresh');
            
        }
    }
    
    public function add_data(){
        $komoditas = $this->input->post();
        if($this->survey->add_data($komoditas))
            echo json_encode(array('ok'=>true));
        else echo json_encode(array('ok'=>false));
        
    }
    
    // public function add_data(){
    //     $data = array(
    //         'id_komoditas' => $this->input->post('komoditas'),
    //         'harga' => $this->input->post('harga'),
    //         'id_pasar' => $this->input->post('pasar'),
    //         'id_user' => $this->session->userdata('id'),
    //         'date' => $this->input->post('date'),
    //         'status' => 'Menunggu',
    //     );
    //     $this->survey->add($data);
    //     echo json_encode(array("status" => TRUE));
    // }

    public function edit_data($id){
        $data = $this->survey->get_data(array('id' => $id));
        echo json_encode($data);
    }

    public function update_data(){
        $data = array(
            'id_komoditas' => $this->input->post('komoditas'),
            'harga' => $this->input->post('harga'),
            'id_pasar' => $this->input->post('pasar'),
            'id_user' => $this->session->userdata('id'),
            'date' => $this->input->post('date'),
            'status' => 'Menunggu',
        );
        $this->survey->update(array("id" => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function delete_data($id){
        $this->survey->delete(array('id' => $id));
        echo json_encode(array("status" => TRUE));
    }

    function get_pasar($id){
        $pasar = $this->survey->get_pasar_by(array('id' => $id));
        foreach ($pasar as $data){
            return $data['nama'];
        }
    }

    function get_komoditas($id){
        $pasar = $this->survey->get_komoditas_by(array('id' => $id));
        foreach ($pasar as $data){
            return $data;
        }
    }
    function get_user($id){
        $pasar = $this->survey->get_user_by(array('id' => $id));
        foreach ($pasar as $data){
            return $data['username'];
        }
    }
}


/* End of file Controllername.php */

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Pengguna extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->sesi->check_session();
        // if(($this->session->userdata('level') != '2') and ($this->session->userdata('level') != '1') ){
        //      redirect('Landing');
        // }
		$this->load->library('Template');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		$this->load->model('model_pengguna','pengguna');
        $this->load->library('Libkebutuhan');
	}

	function index(){
		$this->template->display("dashboard/pengguna/index");
	}

    function reset($id){
        $password = md5(sha1('123456'));
        $this->pengguna->resetPass($password, $id);
    }
	function listPengguna(){
		$list = $this->pengguna->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $pengguna) {
            $no++;
            $id = "'".$pengguna->id."'";
            $row = array();
            $row[] = $no;
            $row[] = $pengguna->nama;
            $row[] = $pengguna->jabatan;
            $row[] = $pengguna->namasekolah;
            $row[] = $pengguna->username;
            $row[] = //'<div class="btn-group">
                      //<button class="btn btn-xs btn-outline btn-primary" onclick="ubahData('.$id.')" style="display: block;"><i class="fa fa-edit"></i></button>
                      //</div>
                    '<div class="btn-group">
                    <button style="font-size: 13px;" class="btn btn-xs btn-outline btn-primary" onclick="resetPass('.$id.')" style="display: block;"><i class="fa fa-edit"></i> Reset Password</button>
                    </div>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->pengguna->count_filtered(),
            "recordsFiltered" => $this->pengguna->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
	}

    function generateuser()
    {
        $hasil = $this->pengguna->generateUser();
        if($hasil>0){
            echo json_encode(array("Status"=>$hasil));
        }else{
            echo json_encode(array("Status"=>intval(0)));
        }
    }

}
?>
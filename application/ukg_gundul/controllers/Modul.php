<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");
class Modul extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Model_modul','modul');
	}

	public function index()
	{
		redirect("modul/m_modul");
	}

	public function cek_aktif() {
		if ($this->session->userdata('admin_valid') == false && $this->session->userdata('admin_id') == "") {
			redirect('adm/login');
		} 
	}

	public function m_modul()
	{
		$this->cek_aktif();
		
		$a['sess_level'] = $this->session->userdata('admin_level');
		$a['sess_user'] = $this->session->userdata('admin_user');
		$a['sess_konid'] = $this->session->userdata('admin_konid');
		
		$a['p']			= "m_modul";
		
		$this->load->view('aaa_mod', $a);
	}

	public function getModul()
	{
		$list = $this->modul->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $modul) {
            $no++;
            $id = "'".$modul->id."'";
            $row = array();
            $row[] = $no;
            $row[] = $modul->nama.' '.$modul->modul;
            $row[] = '<div class="btn-group">
                          <a href="#" onclick="return m_modul_e('.$id.');" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-pencil" style="margin-left: 0px; color: #fff"></i> &nbsp;&nbsp;Edit</a>
                          <a href="#" onclick="return m_modul_h('.$id.');" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove" style="margin-left: 0px; color: #fff"></i> &nbsp;&nbsp;Hapus</a>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->modul->count_filtered(),
            "recordsFiltered" => $this->modul->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
	}

	public function getMatpel()
	{
		$hasil = $this->modul->getMatpel();
		if($hasil>0){
			$data['matpel'] = $hasil;
			echo j($data);
		}
	}

	public function getModulPelajaran()
	{
		$id_mapel = $this->input->get('id_mapel',true);
		$hasil = $this->modul->getModul($id_mapel);
		if($hasil >0 ){
			$data['modul'] = $hasil;
			echo json_encode($data);
		}
	}

	public function simpan()
	{
		$this->cek_aktif();
		cek_hakakses(array("admin"), $this->session->userdata('admin_level'));
		$p = json_decode(file_get_contents('php://input'));
		$hasil = '';
		if($p->id != 0){
			$where = array("id"=>$p->id);
			$data = array('id_mapel' => $p->matapelajaran,'modul'=>$p->nama);
			$hasil = $this->modul->updateModul($where,$data);
		}else{
			$id_modul = $this->modul->generateIdModul($p->matapelajaran);
			$data = array('id_mapel' => $p->matapelajaran, 'id_modul'=>$id_modul,'modul'=>$p->nama);
			$hasil = $this->modul->simpanModul($data);
		}
		if($hasil >0){
			$ret_arr['status'] 	= "ok";
			j($ret_arr);
		}else{
			$ret_arr['status'] 	= "fail";
			j($ret_arr);
		}
	}

	public function det()
	{
		$id = $this->input->get("id",true);
		$hasil = $this->modul->getDet($id);
		if(!$hasil){
			
		}else{
			j($hasil);
		}
	}

	public function hapus()
	{
		$id = $this->input->post('id',true);
		$hasil = $this->modul->hapusMod($id);
		if($hasil>0){
			$ret_arr['status'] 	= "ok";
			j($ret_arr);
		}else{
			$ret_arr['status'] 	= "fail";
			j($ret_arr);
		}
	}
}
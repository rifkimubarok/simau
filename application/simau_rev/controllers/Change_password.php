<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Change_password extends CI_Controller {
	 
	public function __construct()
	{
		parent::__construct();	
        $this->load->library('Template');
        $this->load->model('Model_password','pass');

	}
 
	public function change()
	{	
		$id = $this->session->userdata('id');
		$nama = $this->session->userdata('nama');
		$newname = $this->input->post('name');
		$newpassword = md5(sha1($this->input->post('new')));
		$verify = md5(sha1($this->input->post('verify')));
		$oldpassword = md5(sha1($this->input->post('old')));
		$cekrow = $this->pass->cek($id);
		$getrow = $this->pass->get($id);
		if($this->input->post('checkbox') == null){
			foreach($getrow as $a){
				$this->pass->change_username($newname, $a->id);
				$this->session->set_userdata(array('nama' => $newname));
			}
		}else{
			if($cekrow == 1){
				foreach($getrow as $a){
					if($oldpassword == $a->password && $verify == $newpassword){
						$this->pass->change_pass($newpassword, $newname, $a->id);
						$this->session->set_userdata(array('nama' => $newname));
					// 	echo '<script>alert("PASSWORD BERHASIL DIUBAH!");history.go(-1);</script>';
					// }else if($oldpassword == $a->password && $newpassword != $verify){
					// 	echo '<script>alert("PASSWORD YANG ANDA MASUKKAN TIDAK SAMA");history.go(-1);</script>';
					// }else if($oldpassword != $a->password){
					// 	echo '<script>alert("PASSWORD YANG ANDA MASUKKAN SALAH");history.go(-1);</script>';
					// }
					}
				}
			}
		}
		if($this->session->userdata('level') == "1"){
        	redirect('super');
        }else if($this->session->userdata('level') == "2" || $this->session->userdata('level') == "3"){
            redirect('pengelola');
        }else if($this->session->userdata('level') == "5" || $this->session->userdata('level') == "6"){
            redirect('sekolah');
        }

	}
}

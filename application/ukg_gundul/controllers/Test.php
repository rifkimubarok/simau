<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");
class Test extends CI_Controller {

    function __construct(){
		parent::__construct();
        $this->load->library("curl_func");
    }

    public function index()
    {
        $data = array("username"=>"admin","password"=>"admin");
        $result = $this->curl_func->req("http://172.10.11.140:9000/login",$data);
        $result = json_decode($result[0]);
        $_log['log']['status']			= "0";
        $_log['log']['keterangan']		= "Maaf, username dan password tidak ditemukan";
        $_log['log']['detil_admin']		= null;
        if($result){
            if(isset($result->token)){
                if(isset($result->data)){
                    $level = "";
                    if($result->data->peran_id == 53){
                        $level = "siswa";
                    }
                    if($level == "siswa"){
                        $_data = $result->data;
                        $data = array("nim"=>$_data->pengguna_id,"nama"=>$_data->nama,"jurusan"=>"","jenjang"=>"","id_matpel"=>"");
                        $where = array("nim"=>$_data->pengguna_id);
                        $kon_id = $this->insert_data("m_siswa",$data,$where);

                        $data = array("username"=>$_data->pengguna_id,"password"=>md5($_data->pengguna_id),"level"=>$level,"kon_id"=>$kon_id);
                        $where = array("username"=>$_data->pengguna_id);
                        $id = $this->insert_data("m_admin",$data,$where);

                        $data = array(
                            'admin_id' => $id,
                            'admin_user' => $_data->pengguna_id,
                            'admin_level' => $level,
                            'admin_konid' => $kon_id,
                            'admin_nama' => $_data->nama,
                            'admin_valid' => true
                            );
                        $this->session->set_userdata($data);
                        $_log['log']['status']			= "1";
                        $_log['log']['keterangan']		= "Login berhasil";
                        $_log['log']['detil_admin']		= $this->session->userdata;
                    }
                    
                }
            }
        }
        j($_log);
    }

    public function insert_data($table,$data,$where = null)
    {
        $check_data = false;
        $isChecked = false;
        $result_check;
        if($where != null){
            $result_check = $this->db->get_where($table,$where);
            if($result_check->num_rows() >0){
                $isChecked = true;
            }
            $check_data = true;
        }
        if($check_data){
            if($isChecked){
                $data = $result_check->row();
                return $data->id;
            }else{
                $this->db->insert($table,$data);
                return $this->db->insert_id();
            }
        }else{
            $this->db->insert($table,$data);
            return $this->db->insert_id();
        }
    }
}
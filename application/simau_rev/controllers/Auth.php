<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    
    public function index() {
        $this->load->view('awal');      
    }

    public function cek_login() {       
        
        $data = array('username' => $this->input->post('username', TRUE),
                'password' => md5(sha1($this->input->post('password', TRUE))));     
                $capth     = $this->input->post('secure');
        $this->load->model('model_user'); // load model_user
        $hasil = $this->model_user->cek_user($data);
        if ($hasil->num_rows()>0 /*and $this->_check_captcha($capth)==TRUE*/) {
            $sess = $hasil->row();
                //$sess_data['logged_in'] = 'Anda Sedang Login.';
            $session = new myObject();
            $session->npsn = $sess->kode_sekolah;
            $session->id = $sess->id;
            $session->nama = $sess->nama;
            $session->jabatan = $sess->jabatan;
            $session->level = $sess->level;
            $session->kecamatan = $sess->mengelola;
            $session->jenjang = $this->model_user->getJenjang($session->npsn);
            $session->status = true;
            set_session("user",$session);
            if($sess->level == "1"){
                redirect('dashboard');
            }else if($sess->level == "2" || $sess->level == "3"){
                redirect('dashboard');
            }else if($sess->level == "5" || $sess->level == "6"){
                redirect('dashboard');
            }else if($sess->level == "7" || $sess->level == "8"){
                redirect('dashboard');
            }else if($sess->level == "9"){
                redirect('dashboard');
            }else{
                redirect('Logout');
            }
        }
        else {
            echo "<script>alert('Gagal Login: Kode Pengaman, Cek Username dan Password!');history.go(-1);</script>";
        } 
    }
    
    /**
     * Create CAPTCHA image to verify user as a human
     *
     * @return    string
     */
    function _create_captcha() {
        $this->load->helper('captcha');
        $cap_config = array(
            'img_path' => './' . $this->config->item('captcha_path'),
            'img_url' => base_url() . $this->config->item('captcha_path'),
            'font_path' => './assets/fonts/tes.otf',
            'font_size' => '50',
            'img_width' => $this->config->item('captcha_width'),
            'img_height' => $this->config->item('captcha_height'),
            'show_grid' => $this->config->item('captcha_grid'),
            'expiration' => $this->config->item('captcha_expire'),
            'ip_address' => $this->input->ip_address(),
            // White background and border, black text and red grid
            'colors' => array(
                'background' => array(0, 0, 0),
                'border' => array(255, 255, 255),
                'text' => array(0, 0, 0),
                'grid' => array(255, 200, 200)
            )
        );
        $cap = create_captcha($cap_config);
        // Save captcha params in session
        $this->session->set_flashdata(array(
            'captcha_word'  => $cap['word'],
            'captcha_image' => $cap['image']
        ));
        return $cap['image'];
    }
    
    /**
     * Callback function. Check if CAPTCHA test is passed.
     *
     * @param    string
     * @return    bool
     */
    function _check_captcha($code) {
        $word = $this->session->flashdata('captcha_word');
        if (($this->config->item('captcha_case_sensitive') AND $code != $word) OR
                strtolower($code) != strtolower($word)) {
            return FALSE;
        }
        return TRUE;
    }
}
?>
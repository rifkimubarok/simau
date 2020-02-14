<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grafik_sekolah extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
        $this->load->library('Template');
        $this->load->model('Model_infograf', 'info');
        $this->load->model('Model_sekolah', 'sekolah');
        $this->load->library('Libkebutuhan');
    }
	
	public function index() 
	{
		$captcha_form = $this->config->item('captcha_form');
        $a['captcha_form'] = $captcha_form;
        if ($captcha_form) {
            $a['captcha_html'] = $this->session->flashdata('captcha_image') != NULL ? $this->session->flashdata('captcha_image') : $this->_create_captcha();
        }
        // COMBO TAMPIL GRAFIK
        if($this->session->userdata('cbbkab') == NULL && $this->session->userdata('cbbjenjang') == NULL){
            $a['graph_sekolah'] = $this->info->graph_sekolah();
            
        }elseif($this->session->userdata('cbbkab') != NULL && $this->session->userdata('cbbjenjang') != NULL){
            $a['graph_sekolah'] = $this->info->graph_sekolah_double_parameter($this->session->userdata('cbbkab'), $this->session->userdata('cbbjenjang'));

        }elseif($this->session->userdata('cbbkab') != NULL && $this->session->userdata('cbbjenjang') == NULL){
            $a['graph_sekolah'] = $this->info->graph_sekolah_kab_parameter($this->session->userdata('cbbkab'));

        }elseif($this->session->userdata('cbbkab') == NULL && $this->session->userdata('cbbjenjang') != NULL){
            $a['graph_sekolah'] = $this->info->graph_sekolah_jenjang_parameter($this->session->userdata('cbbjenjang'));
        }
        // END COMBO TAMPIL GRAFIK

		$this->template->show('awal/grafik/index', $a);
    }

    public function param(){
        if($this->input->post('cbbkab') != NULL && $this->input->post('cbbjenjang') != NULL){
            $this->session->set_userdata(array('cbbkab' => $this->input->post('cbbkab'),
                                            'cbbjenjang' => $this->input->post('cbbjenjang')));
        }else if($this->input->post('cbbkab') != NULL && $this->input->post('cbbjenjang') == NULL){
            $this->session->unset_userdata('cbbjenjang');
            $this->session->set_userdata(array('cbbkab' => $this->input->post('cbbkab')));
        }else if($this->input->post('cbbkab') == NULL && $this->input->post('cbbjenjang') != NULL){
            $this->session->unset_userdata('cbbkab');
            $this->session->set_userdata(array('cbbjenjang' => $this->input->post('cbbjenjang')));
        }else if($this->input->post('cbbkab') == NULL && $this->input->post('cbbjenjang') == NULL){
            $this->session->unset_userdata(array('cbbjenjang','cbbkab'));
        }
        redirect('awal/Grafik_sekolah');
    }

    public function delete_session(){
        $this->session->unset_userdata(array('cbbkab', 'cbbjenjang'));
        redirect('awal/Grafik_sekolah');
    }

    function getSekolah()
    {
        $data['kecamatan'] = $this->sekolah->getKecamatan();
        $data['jenjang'] = $this->sekolah->getJenjang();
        echo json_encode($data);
    }


    public function getGrafikSekolah($kec=null)
    {
        if($kec!=null){
            $hasil = $this->info->getGrafikSekolah($kec);
            $data['kecamatan'] = ' - '.$this->libkebutuhan->getNamaKecamatan($kec);
        }else{
            $hasil = $this->info->getGrafikSekolah();
            $data['kecamatan'] = "";
        }
        $isi = array();
            $label = array();
            foreach ($hasil as $has) {
                $row = array("name"=>$has->jenjang,"data"=>array(intval($has->Jumlah)));
                $isi[] = $row;
                $label[] = $has->jenjang;
            }
            $data['data'] = $isi;
            
            $data['label'] = $label;

            echo json_encode($data);
    }

     public function getPieGrafikSekolah($kec=null)
    {
        if($kec!=null){
            $hasil = $this->info->getGrafikSekolah($kec);
            $data['kecamatan'] = ' - '.$this->libkebutuhan->getNamaKecamatan($kec);
        }else{
            $hasil = $this->info->getGrafikSekolah();
            $data['kecamatan'] = "";
        }
        $isi = array();
            $label = array();
            foreach ($hasil as $has) {
                $row = array("name"=> $has->jenjang,"y"=>intval($has->Jumlah));
                $isi[] = $row;
                $label[] = $has->jenjang;
            }
            $data['data'] = $isi;
            
            $data['label'] = $label;

            echo json_encode($data);
    }

    public function getInformasi()
    {
        $kecamatan = $this->input->post('kecamatan');
        
        $data = $this->info->getInformasi($kecamatan);
        if($data->num_rows() >0){
            $guru = $this->info->getBanyakGuru($kecamatan);
            $hasil = $data->row();
            $data = array("totpeg"=>number_format($guru,0),"totmula"=>number_format($hasil->totmula,0),"totmupe"=>number_format($hasil->totmupe,0),"totmu"=>number_format($hasil->totmu,0));
        echo json_encode($data);
        }else{
            $data = array("totpeg"=>number_format(0,0),"totmula"=>number_format(0,0),"totmupe"=>number_format(0,0),"totmu"=>number_format(0,0));
            echo json_encode($data);
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
            'font_size' => '25',
            'img_width' => $this->config->item('captcha_width'),
            'img_height' => $this->config->item('captcha_height'),
            'show_grid' => $this->config->item('captcha_grid'),
            'expiration' => $this->config->item('captcha_expire'),
            'ip_address' => $this->input->ip_address(),
            'word_length'   => $this->config->item('captcha_word_length'),
            // White background and border, black text and red grid
            'colors' => array(
                'background' => array(255, 255, 255),
                'border' => array(255, 255, 255),
                'text' => array(0, 0, 0),
                'grid' => array(79, 135, 36)
            )
        );
        $cap = create_captcha($cap_config);
        // Save captcha params in session
        $this->session->set_flashdata(array(
            'captcha_word' => $cap['word'],
            'captcha_image' => $cap['image']
        ));
        return $cap['image'];
    }
}

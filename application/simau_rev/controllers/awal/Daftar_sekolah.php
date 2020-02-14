<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar_sekolah extends CI_Controller {
	
	function __construct() {
        parent::__construct();
        $this->load->model('Model_sekolah', 'sekolah');
        $this->load->model('Model_infograf', 'info');
        $this->load->library('Template');
		$this->load->library('form_validation');	
    }

 	public function index()
	{
		$a['kecamatan'] = $this->sekolah->getKecamatan();
        $a['kabupaten'] = $this->sekolah->getKabupaten();
        $a['jenjang'] = $this->sekolah->getJenjang();

		$this->template->show('awal/daftar_sekolah/index', $a);
	}

    public function listSekolah()
    {
        $this->load->helper('url');

        $list = $this->sekolah->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $sekolah) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $sekolah->namasekolah;
            $row[] = $sekolah->jenjang;
            $row[] = $sekolah->kecamatan;
            // $row[] = $sekolah->kabupaten;
            $row[] = $sekolah->alamat;
        
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->sekolah->count_all(),
                        "recordsFiltered" => $this->sekolah->count_filtered(),
                        "data" => $data,
                );
        
        echo json_encode($output);
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

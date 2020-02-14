<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar_sekolah extends CI_Controller {
	
	function __construct() {
        parent::__construct();
        $this->load->model('Model_sekolah', 'sekolah');
        $this->load->model('Model_infograf', 'info');
		// $this->load->library('form_validation');	
    }

 	public function index()
	{
		$captcha_form = $this->config->item('captcha_form');
		$a['captcha_form'] = $captcha_form;
        if ($captcha_form) {
            $a['captcha_html'] = $this->session->flashdata('captcha_image') != NULL ? $this->session->flashdata('captcha_image') : $this->_create_captcha();
        }

        $a['kabupaten'] = $this->sekolah->getKabupaten();
        $a['jenjang'] = $this->sekolah->getJenjang();
        $a['graph_sekolah'] = $this->info->graph_sekolah();

		$this->load->view('daftar_sekolah', $a);
	}

    public function listSekolah()
        {

            $list = $this->sekolah->get_datatables();
            $data = array();
            $no = $_GET['start'];
            foreach ($list as $sekolah) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $sekolah->npsn;
                $row[] = $sekolah->namasekolah;
                $row[] = $sekolah->jenjang;
                $row[] = $sekolah->kabupaten;
                $row[] = $sekolah->alamat;

                //add html for action
                $data[] = $row;
            }

            $output = array(
                "draw" => $_GET['draw'],
                "recordsTotal" => $this->sekolah->count_all_rpl(),
                "recordsFiltered" => $this->sekolah->count_filtered(),
                "data" => $data,
            );
            //output to json format
            echo json_encode($output);
        }

        function list_() {
            $results = $this->sekolah->get_list();
            echo json_encode($results);
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
            'font_path' => './' . $this->config->item('captcha_fonts_path'),
            'font_size' => $this->config->item('captcha_font_size'),
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
                'grid' => array(0, 181, 26)
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

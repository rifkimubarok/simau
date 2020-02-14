<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maps extends CI_Controller {
	 
	public function __construct()
	{
		parent::__construct();	
		// $this->load->library('Googlemaps');	
        $this->load->library('Template');

        $this->load->model('Map_model', '', TRUE);
        $this->load->model('Model_sekolah', 'sekolah');
        // if ($this->session->userdata('status') == FALSE) {
            
        // }else{
        //     redirect('Dashboard');
        // }

	}
 
	public function index()
    {   
        $captcha_form = $this->config->item('captcha_form');
        $a['captcha_form'] = $captcha_form;
        if ($captcha_form) {
            $a['captcha_html'] = $this->session->flashdata('captcha_image') != NULL ? $this->session->flashdata('captcha_image') : $this->_create_captcha();
        }

        $a['kecamatan'] = $this->sekolah->getKecamatan();
        $a['jenjang'] = $this->sekolah->getJenjang();
        $this->template->show('awal/main',$a); 
    }

    function getMaps(){
            $coords = $this->Map_model->get_coordinates($_GET['kec'], $_GET['jenjang']);
            $data = array();
            foreach ($coords as $coordinate) {
                if ($coordinate->posisilat == "" || $coordinate->posisilat == NULL && $coordinate->posisilong == "" || $coordinate->posisilong == NULL) {
                    // DILEWAT
                }else{
                        $marker = array();
                        
                        $marker['lat'] = $coordinate->posisilat;                        
                        $marker['long'] = $coordinate->posisilong; 
                        $marker['icon'] = base_url().'assets/images/'.$coordinate->icon;
                        $gambarnya = "";

                        $marker['infowindow_content'] = "<h4>".$coordinate->namasekolah."<br><p><small>".$coordinate->alamat." Des./Kel. ".$coordinate->kelurahan."<br>RT/RW ".$coordinate->rt."/".$coordinate->rw." ".$coordinate->kecamatan." ".$coordinate->kabupaten." ".$coordinate->provinsi."</small></p>";
                        $data[] = $marker;
                }
            }
            $output['data'] = $data;
            echo json_encode($output);
    }


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

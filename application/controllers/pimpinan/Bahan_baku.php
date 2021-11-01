<?php 
defined('BASEPATH') || exit('No direct script access allowed');

require APPPATH . '/libraries/BaseControllerBackend.php';

class Bahan_baku extends BaseControllerBackend {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mod_bahan_baku');
        $this->load->model('Mod_bank');
        $this->load->model('Mod_customer');
        $this->load->model('Mod_karyawan');
        $this->load->model('Mod_proposal');
        $this->load->model('Mod_produk');
        $this->load->model('Mod_supplier');
    }

    function index() {
        $nik_karyawan = $this->session->userdata('ses_nik_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses');  

        if($nik_karyawan != null && $hak_akses == 'Pimpinan'){
            $this->global['pageTitle'] = "Data Bahan Baku";

            $this->loadViews("backend/pimpinan/bahan_baku/body",$this->global,NULL,"backend/pimpinan/bahan_baku/footer");
        }
        else{ 
            redirect('login');
        }  
    }

    function load_data_bahan_baku(){
        $data['bahan_baku'] = $this->Mod_bahan_baku->get_all_bahan_baku();
        $this->load->view('backend/pimpinan/bahan_baku/load_bahan_baku', $data);
    }
    
}

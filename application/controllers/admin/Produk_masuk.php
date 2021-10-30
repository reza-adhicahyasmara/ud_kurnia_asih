<?php 
defined('BASEPATH') || exit('No direct script access allowed');

require APPPATH . '/libraries/BaseControllerBackend.php';

class Produk_masuk extends BaseControllerBackend {

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

        if($nik_karyawan != null && $hak_akses == 'Admin'){
            $this->global['pageTitle'] = "Data Produk Masuk";

            $this->loadViews("backend/admin/produk_masuk/body",$this->global,NULL,"backend/admin/produk_masuk/footer");
        }
        else{ 
            redirect('login');
        }  
    }

    function load_data_produk_masuk(){
        $data['produk_masuk'] = $this->Mod_produk->get_all_produk_masuk();
        $this->load->view('backend/admin/produk_masuk/load_data_produk_masuk', $data);
    }
}

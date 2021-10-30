<?php 
defined('BASEPATH') || exit('No direct script access allowed');

require APPPATH . '/libraries/BaseControllerBackend.php';

class Penyesuaian_produk extends BaseControllerBackend {

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
            $this->global['pageTitle'] = "Data Penyesuaian Stok Produk";

            $this->loadViews("backend/admin/penyesuaian_produk/body",$this->global,NULL,"backend/admin/penyesuaian_produk/footer");
        }
        else{ 
            redirect('login');
        }  
    }

    function load_data_penyesuaian_produk(){
        $data['penyesuaian_produk'] = $this->Mod_produk->get_all_penyesuaian_produk();
        $this->load->view('backend/admin/penyesuaian_produk/load_penyesuaian_produk', $data);
    }
}

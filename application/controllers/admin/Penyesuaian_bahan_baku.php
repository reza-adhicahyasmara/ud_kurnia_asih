<?php 
defined('BASEPATH') || exit('No direct script access allowed');

require APPPATH . '/libraries/BaseControllerBackend.php';

class Penyesuaian_bahan_baku extends BaseControllerBackend {

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
            $this->global['pageTitle'] = "Data Penyesuaian Stok Bahan Baku";

            $this->loadViews("backend/admin/penyesuaian_bb/body",$this->global,NULL,"backend/admin/penyesuaian_bb/footer");
        }
        else{ 
            redirect('login');
        }  
    }

    function load_data_penyesuaian_bb(){
        $data['penyesuaian_bb'] = $this->Mod_bahan_baku->get_all_penyesuaian_bb();
        $this->load->view('backend/admin/penyesuaian_bb/load_penyesuaian_bb', $data);
    }
}

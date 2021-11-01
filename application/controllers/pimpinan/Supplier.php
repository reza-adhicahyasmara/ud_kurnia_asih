<?php 
defined('BASEPATH') || exit('No direct script access allowed');

require APPPATH . '/libraries/BaseControllerBackend.php';

class Supplier extends BaseControllerBackend {

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
            $this->global['pageTitle'] = "Supplier";

            $this->loadViews("backend/pimpinan/supplier/body",$this->global,NULL,"backend/pimpinan/supplier/footer");
        }
        else{ 
            redirect('login');
        }  
    }

    function detail($id_supplier){
        $nik_karyawan = $this->session->userdata('ses_nik_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses');  

        if($nik_karyawan != null && $hak_akses == 'Pimpinan'){
            $this->global['pageTitle'] = "Detail Supplier";

            $data['supplier'] = $this->Mod_supplier->get_supplier($id_supplier);
            $this->loadViews("backend/pimpinan/supplier/body_detail",$this->global,$data,"backend/pimpinan/supplier/footer");
        }
        else{ 
            redirect('login');
        }  
    }

    function load_data_supplier(){
        $data['supplier'] = $this->Mod_supplier->get_all_supplier();
        $this->load->view('backend/pimpinan/supplier/load_supplier', $data);
    }

    function load_data_bahan_baku(){
        $id_supplier = $this->input->post('id_supplier');
        $data['bahan_baku'] = $this->Mod_bahan_baku->get_bahan_baku_supplier($id_supplier);
        $this->load->view('backend/pimpinan/bahan_baku/load_bahan_baku', $data);
    }

}

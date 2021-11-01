<?php 
defined('BASEPATH') || exit('No direct script access allowed');

require APPPATH . '/libraries/BaseControllerBackend.php';

class Retur_produk extends BaseControllerBackend {

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
            $this->global['pageTitle'] = "Data Retur Produk";

            $data['data_retur'] = $this->Mod_produk->get_all_retur_produk();
            $this->loadViews("backend/admin/retur_produk/body",$this->global,$data,"backend/admin/retur_produk/footer");
        }  
        else{ 
            redirect('login');
        }   
    }

    function detail($kode_retur_produk){
        $nik_karyawan = $this->session->userdata('ses_nik_karyawan');   
        $hak_akses = $this->session->userdata('ses_akses');  

        if($nik_karyawan != null && $hak_akses == 'Admin'){
            $this->global['pageTitle'] = "Detail Retur Produk";
            
            $data['data_detail'] = $this->Mod_produk->get_retur_produk($kode_retur_produk);

            $this->loadViews("backend/admin/retur_produk/body_detail",$this->global,$data,"backend/admin/retur_produk/footer");
        }
        else{ 
            redirect('login');
        }   
    }

    function invoice($kode_retur_produk){
        $nik_karyawan = $this->session->userdata('ses_nik_karyawan');   
        $hak_akses = $this->session->userdata('ses_akses');  

        if($nik_karyawan != null && $hak_akses == 'Admin'){
            $this->global['pageTitle'] = "Invoice";
            
            $data['data_detail'] = $this->Mod_produk->get_retur_produk($kode_retur_produk);
            $data['list_produk'] = $this->Mod_produk->get_item_retur_produk($kode_retur_produk);

            $this->loadViews("backend/admin/retur_produk/body_invoice",$this->global,$data,"backend/admin/retur_produk/footer_invoice");
        }
        else{ 
            redirect('login');
        }  
    }

    function load_data_detail_item_retur_produk(){
        $kode_retur_produk = $this->input->post('kode_retur_produk');
        $data['status_retur_produk'] = $this->input->post('status_retur_produk');
        $data['list_produk'] = $this->Mod_produk->get_item_retur_produk($kode_retur_produk);
        $this->load->view('backend/admin/retur_produk/load_data_detail_item_retur_produk', $data);
    }
}
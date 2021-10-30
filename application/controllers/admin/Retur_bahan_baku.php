<?php 
defined('BASEPATH') || exit('No direct script access allowed');

require APPPATH . '/libraries/BaseControllerBackend.php';

class Retur_bahan_baku extends BaseControllerBackend {

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
            $this->global['pageTitle'] = "Data Retur Bahan Baku";

            $data['data_retur'] = $this->Mod_bahan_baku->get_all_retur_bb();
            $this->loadViews("backend/admin/retur_bahan_baku/body",$this->global,$data,"backend/admin/retur_bahan_baku/footer");
        }  
        else{ 
            redirect('login');
        }   
    }

    function detail($kode_retur_bb){
        $nik_karyawan = $this->session->userdata('ses_nik_karyawan');   
        $hak_akses = $this->session->userdata('ses_akses');  

        if($nik_karyawan != null && $hak_akses == 'Admin'){
            $this->global['pageTitle'] = "Detail Pemesanan Toko";
            
            $data['data_detail'] = $this->Mod_bahan_baku->get_retur_bb($kode_retur_bb);
            $data['list_bahan_baku'] = $this->Mod_bahan_baku->get_item_retur_bb($kode_retur_bb);

            $this->loadViews("backend/admin/retur_bahan_baku/body_detail",$this->global,$data,"backend/admin/retur_bahan_baku/footer");
        }
        else{ 
            redirect('login');
        }   
    }

    function invoice($kode_retur_bb){
        $nik_karyawan = $this->session->userdata('ses_nik_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses');  

        if($nik_karyawan != null && $hak_akses == 'Admin'){
            $this->global['pageTitle'] = "Invoice";
            
            $data['data_detail'] = $this->Mod_bahan_baku->get_retur_bb($kode_retur_bb);
            $data['list_bahan_baku'] = $this->Mod_bahan_baku->get_item_retur_bb($kode_retur_bb);

            $this->loadViews("backend/admin/retur_bahan_baku/body_invoice",$this->global,$data,"backend/admin/retur_bahan_baku/footer_invoice");
        }
        else{ 
            redirect('login');
        }  
    }
}
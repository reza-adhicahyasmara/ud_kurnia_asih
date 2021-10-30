<?php 
defined('BASEPATH') || exit('No direct script access allowed');

require APPPATH . '/libraries/BaseControllerBackend.php';

class bahan_baku_masuk extends BaseControllerBackend {

    function __construct(){
        parent::__construct();
        $this->load->model('Mod_bahan_baku');
        $this->load->model('Mod_bank');
        $this->load->model('Mod_customer');
        $this->load->model('Mod_karyawan');
        $this->load->model('Mod_proposal');
        $this->load->model('Mod_produk');
        $this->load->model('Mod_supplier');
    }

    function index(){
        $nik_karyawan = $this->session->userdata('ses_nik_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses');  

        if($nik_karyawan != null && $hak_akses == 'Gudang'){
            $this->global['pageTitle'] = "Data Bahan Baku Masuk";

            $data['aaa'] = $this->Mod_bahan_baku->get_all_pemesanan_bb();
            $this->loadViews("backend/gudang/bahan_baku_masuk/body",$this->global,$data,"backend/gudang/bahan_baku_masuk/footer");
        }  
        else{ 
            redirect('login');
        }
    }

    function load_data_bahan_baku_masuk(){
        $data['bahan_baku_masuk'] = $this->Mod_bahan_baku->get_all_item_pemesanan_bb();
        $this->load->view('backend/gudang/bahan_baku_masuk/load_bahan_baku_masuk', $data);
    }

}

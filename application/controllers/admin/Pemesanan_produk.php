<?php 
defined('BASEPATH') || exit('No direct script access allowed');

require APPPATH . '/libraries/BaseControllerBackend.php';

class Pemesanan_produk extends BaseControllerBackend {

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
            $this->global['pageTitle'] = "Pemesanan Produk";

            $data['data_pemesanan'] = $this->Mod_produk->get_all_pemesanan_produk();
            $this->loadViews("backend/admin/pemesanan_produk/body",$this->global,$data,"backend/admin/pemesanan_produk/footer");
        }  
        else{ 
            redirect('login');
        }  
    }

    function detail($kode_pemesanan_produk){
        $nik_karyawan = $this->session->userdata('ses_nik_karyawan');   
        $hak_akses = $this->session->userdata('ses_akses');  

        if($nik_karyawan != null && $hak_akses == 'Admin'){
            $this->global['pageTitle'] = "Detail Pemesanan Produk";
            
            $data['data_detail'] = $this->Mod_produk->get_pemesanan_produk($kode_pemesanan_produk);
            $data['list_produk'] = $this->Mod_produk->get_item_pemesanan_produk($kode_pemesanan_produk);

            $this->loadViews("backend/admin/pemesanan_produk/body_detail",$this->global,$data,"backend/admin/pemesanan_produk/footer");
        }
        else{ 
            redirect('login');
        }  
    }

    function invoice($kode_pemesanan_produk){
        $nik_karyawan = $this->session->userdata('ses_nik_karyawan');   
        $hak_akses = $this->session->userdata('ses_akses');  

        if($nik_karyawan != null && $hak_akses == 'Admin'){
            $this->global['pageTitle'] = "Invoice";
            
            $data['data_detail'] = $this->Mod_produk->get_pemesanan_produk($kode_pemesanan_produk);
            $data['list_produk'] = $this->Mod_produk->get_item_pemesanan_produk($kode_pemesanan_produk);

            $this->loadViews("backend/admin/pemesanan_produk/body_invoice",$this->global,$data,"backend/admin/pemesanan_produk/footer_invoice");
        }
        else{ 
            redirect('login');
        }  

    }

    function load_data_item_pemesanan_produk(){
        $kode_pemesanan_produk = $this->input->post('kode_pemesanan_produk');
        $data['total_pby_pemesanan_produk'] = $this->input->post('total_pby_pemesanan_produk');
        $data['status_pemesanan_produk'] = $this->input->post('status_pemesanan_produk');
        $data['list_produk'] = $this->Mod_produk->get_item_pemesanan_produk($kode_pemesanan_produk);
        $this->load->view('backend/admin/pemesanan_produk/load_data_item_pemesanan_produk', $data);
    }

    function update_pemesanan_produk(){
        $kode_pemesanan_produk = $this->input->post('kode_pemesanan_produk');
        $status_pemesanan_produk = $this->input->post('status_pemesanan_produk');
        $status_pby_pemesanan_produk = $this->input->post('status_pby_pemesanan_produk');
        $keterangan_batal_pemesanan_produk = $this->input->post('keterangan_batal_pemesanan_produk');

        echo 1;  
        $save  = array( 
            'kode_pemesanan_produk'                 => $kode_pemesanan_produk,
            'status_pemesanan_produk'               => $status_pemesanan_produk,
            'status_pby_pemesanan_produk'           => $status_pby_pemesanan_produk,
            'keterangan_batal_pemesanan_produk'     => $keterangan_batal_pemesanan_produk
        );    
        $this->Mod_produk->update_pemesanan_produk($kode_pemesanan_produk, $save);  
    
    }
}
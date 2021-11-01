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

        if($nik_karyawan != null && $hak_akses == 'Gudang'){
            $this->global['pageTitle'] = "Data Retur Produk";

            $data['data_retur'] = $this->Mod_produk->get_all_retur_produk();
            $this->loadViews("backend/gudang/retur_produk/body",$this->global,$data,"backend/gudang/retur_produk/footer");
        }  
        else{ 
            redirect('login');
        }   
    }

    function detail($kode_retur_produk){
        $nik_karyawan = $this->session->userdata('ses_nik_karyawan');   
        $hak_akses = $this->session->userdata('ses_akses');  

        if($nik_karyawan != null && $hak_akses == 'Gudang'){
            $this->global['pageTitle'] = "Detail Retur Produk";
            
            $data['data_detail'] = $this->Mod_produk->get_retur_produk($kode_retur_produk);

            $this->loadViews("backend/gudang/retur_produk/body_detail",$this->global,$data,"backend/gudang/retur_produk/footer");
        }
        else{ 
            redirect('login');
        }   
    }

    function invoice($kode_retur_produk){
        $nik_karyawan = $this->session->userdata('ses_nik_karyawan');   
        $hak_akses = $this->session->userdata('ses_akses');  

        if($nik_karyawan != null && $hak_akses == 'Gudang'){
            $this->global['pageTitle'] = "Invoice";
            
            $data['data_detail'] = $this->Mod_produk->get_retur_produk($kode_retur_produk);
            $data['list_produk'] = $this->Mod_produk->get_item_retur_produk($kode_retur_produk);

            $this->loadViews("backend/gudang/retur_produk/body_invoice",$this->global,$data,"backend/gudang/retur_produk/footer_invoice");
        }
        else{ 
            redirect('login');
        }  
    }

    function load_data_detail_item_retur_produk(){
        $kode_retur_produk = $this->input->post('kode_retur_produk');
        $data['status_retur_produk'] = $this->input->post('status_retur_produk');
        $data['list_produk'] = $this->Mod_produk->get_item_retur_produk($kode_retur_produk);
        $this->load->view('backend/gudang/retur_produk/load_data_detail_item_retur_produk', $data);
    }

    function update_item_retur(){
        $kode_iretur_produk = $this->input->post('kode_iretur_produk');
        $status_iretur_produk = $this->input->post('status_iretur_produk');
        $keterangan_batal_iretur_produk = $this->input->post('keterangan_batal_iretur_produk');

        echo 1;         
        $save  = array( 
            'kode_iretur_produk'                => $kode_iretur_produk,
            'status_iretur_produk'              => $status_iretur_produk,
            'keterangan_batal_iretur_produk'    => $keterangan_batal_iretur_produk,
        );
                    
        $this->Mod_produk->update_item_retur_produk($kode_iretur_produk, $save);    
    }
    
    function update_retur_produk(){
        $kode_retur_produk = $this->input->post('kode_retur_produk');
        $status_retur_produk = $this->input->post('status_retur_produk');

        $cek_item1 = $this->Mod_produk->cek_item_proses($kode_retur_produk);
        
        if($cek_item1->num_rows() > 0){ 
            echo "Ada item yang belum diproses";
        } else {

            echo 1;         
            $save  = array( 
                'kode_retur_produk'                 => $kode_retur_produk,
                'status_retur_produk'               => $status_retur_produk,
            );
                        
            $this->Mod_produk->update_retur_produk($kode_retur_produk, $save);       
        }
    }

}
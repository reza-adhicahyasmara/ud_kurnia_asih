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

        if($nik_karyawan != null && $hak_akses == 'Gudang'){
            $this->global['pageTitle'] = "Data Produk Masuk";

            $this->loadViews("backend/gudang/produk_masuk/body",$this->global,NULL,"backend/gudang/produk_masuk/footer");
        }
        else{ 
            redirect('login');
        }  
    }

    function load_data_produk_masuk(){
        $data['produk_masuk'] = $this->Mod_produk->get_all_produk_masuk();
        $this->load->view('backend/gudang/produk_masuk/load_data_produk_masuk', $data);
    }
    
    function form_tambah_produk_masuk(){
        $data['produk'] = $this->Mod_produk->get_all_produk();
        $this->load->view("backend/gudang/produk_masuk/form_tambah_produk_masuk",$data);
    }
    
    function tambah_produk_masuk(){ 
        $kode_produk = $this->input->post('kode_produk');
        $jumlah_produk_masuk = $this->input->post('jumlah_produk_masuk');
        $stok_gudang_produk_lama = $this->input->post('stok_gudang_produk');
        $tanggal_produk_masuk = $this->input->post('tanggal_produk_masuk');
        $keterangan_produk_masuk = $this->input->post('keterangan_produk_masuk');
        
        $kode_produk_masuk = "PRK-".$kode_produk."-".date("YmdHis", strtotime($tanggal_produk_masuk));
        
        echo 1;
        $save  = array(
            'kode_produk_masuk'          => $kode_produk_masuk,
            'kode_produk'                => $kode_produk,
            'jumlah_produk_masuk'        => $jumlah_produk_masuk,
            'tanggal_produk_masuk'       => $tanggal_produk_masuk,
            'keterangan_produk_masuk'    => $keterangan_produk_masuk,    
        );
                    
        $this->Mod_produk->insert_produk_masuk("t_produk_masuk", $save);             
        
        $stok_gudang_produk = $stok_gudang_produk_lama + $jumlah_produk_masuk;

        $data2  = array(
            'kode_produk'          => $kode_produk,
            'stok_gudang_produk'   => $stok_gudang_produk       
        );
                    
        $this->Mod_produk->update_produk($kode_produk, $data2);      
        
    }

    function hapus_produk_masuk(){
        $kode_produk_masuk = $this->input->post('kode_produk_masuk');
        $jumlah_produk_masuk = $this->input->post('jumlah_produk_masuk');
        $kode_produk = $this->input->post('kode_produk');
        $stok_gudang_produk_lama = $this->input->post('stok_gudang_produk');

        $this->Mod_produk->delete_produk_masuk($kode_produk_masuk, 't_produk_masuk');

        $stok_gudang_produk = $stok_gudang_produk_lama - $jumlah_produk_masuk;

        $data2  = array(
            'kode_produk'          => $kode_produk,
            'stok_gudang_produk'   => $stok_gudang_produk       
        );
                    
        $this->Mod_produk->update_produk($kode_produk, $data2); 
    } 
    
    
}

<?php 
defined('BASEPATH') || exit('No direct script access allowed');

require APPPATH . '/libraries/BaseControllerBackend.php';

class Laporan_produk extends BaseControllerBackend {

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

    function data_pemesanan(){
        $nik_karyawan = $this->session->userdata('ses_nik_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses');  

        if($nik_karyawan != null && $hak_akses == 'Pimpinan'){
            $this->global['pageTitle'] = "Laporan Data Pemesanan Produk";
            $this->loadViews("backend/pimpinan/laporan_produk/data_pemesanan/body",$this->global,NULL,"backend/pimpinan/laporan_produk/data_pemesanan/footer");
        }
        else{ 
            redirect('login');
        }  
    }

    function laporan_data_pemesanan(){
        $tanggal_awal = $this->input->post("tanggal_awal");
        $tanggal_akhir = $this->input->post("tanggal_akhir");
        $status = $this->input->post("status");

        $data['tanggal_awal'] = $tanggal_awal;
        $data['tanggal_akhir'] =  $tanggal_akhir;
        $data['status'] =  $status;

        $data['data'] = $this->Mod_produk->get_laporan_pemesanan($tanggal_awal, $tanggal_akhir, $status);
        $this->load->view('backend/pimpinan/laporan_produk/data_pemesanan/load_laporan', $data);
    }





   function data_masuk(){
        $nik_karyawan = $this->session->userdata('ses_nik_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses');  

        if($nik_karyawan != null && $hak_akses == 'Pimpinan'){
            $this->global['pageTitle'] = "Laporan Data Produk Masuk";
            $this->loadViews("backend/pimpinan/laporan_produk/data_masuk/body",$this->global,NULL,"backend/pimpinan/laporan_produk/data_masuk/footer");
        }
        else{ 
            redirect('login');
        }  
    }

    function laporan_data_masuk(){
        $tanggal_awal = $this->input->post("tanggal_awal");
        $tanggal_akhir = $this->input->post("tanggal_akhir");

        $data['tanggal_awal'] = $tanggal_awal;
        $data['tanggal_akhir'] =  $tanggal_akhir;

        $data['data'] = $this->Mod_produk->get_laporan_masuk($tanggal_awal, $tanggal_akhir);
        $this->load->view('backend/pimpinan/laporan_produk/data_masuk/load_laporan', $data);
    }





    function data_keluar(){
        $nik_karyawan = $this->session->userdata('ses_nik_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses');  

        if($nik_karyawan != null && $hak_akses == 'Pimpinan'){
            $this->global['pageTitle'] = "Laporan Data Produk Keluar";
            $this->loadViews("backend/pimpinan/laporan_produk/data_keluar/body",$this->global,NULL,"backend/pimpinan/laporan_produk/data_keluar/footer");
        }
        else{ 
            redirect('login');
        }  
    }
    
    function laporan_data_keluar(){
        $tanggal_awal = $this->input->post("tanggal_awal");
        $tanggal_akhir = $this->input->post("tanggal_akhir");

        $data['tanggal_awal'] = $tanggal_awal;
        $data['tanggal_akhir'] =  $tanggal_akhir;

        $data['item_produk'] = $this->Mod_produk->get_all_item_pemesanan_produk();
        $data['data'] = $this->Mod_produk->get_laporan_keluar($tanggal_awal, $tanggal_akhir);
        $this->load->view('backend/pimpinan/laporan_produk/data_keluar/load_laporan', $data);
    }
    




    function data_penyesuaian_stok(){
        $nik_karyawan = $this->session->userdata('ses_nik_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses');  

        if($nik_karyawan != null && $hak_akses == 'Pimpinan'){
            $this->global['pageTitle'] = "Laporan Data Penyesuaian Stok Produk";
            $this->loadViews("backend/pimpinan/laporan_produk/data_penyesuaian_stok/body",$this->global,NULL,"backend/pimpinan/laporan_produk/data_penyesuaian_stok/footer");
        }
        else{ 
            redirect('login');
        }  
    }

    function laporan_data_penyesuaian_stok(){
        $tanggal_awal = $this->input->post("tanggal_awal");
        $tanggal_akhir = $this->input->post("tanggal_akhir");
        
        $data['tanggal_awal'] = $tanggal_awal;
        $data['tanggal_akhir'] =  $tanggal_akhir;

        $data['data'] = $this->Mod_produk->get_laporan_penyesuaian_stok($tanggal_awal, $tanggal_akhir);
        $this->load->view('backend/pimpinan/laporan_produk/data_penyesuaian_stok/load_laporan', $data);
    }





    function data_retur(){
        $nik_karyawan = $this->session->userdata('ses_nik_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses');  

        if($nik_karyawan != null && $hak_akses == 'Pimpinan'){
            $this->global['pageTitle'] = "Laporan Data Retur Produk";
            $this->loadViews("backend/pimpinan/laporan_produk/data_retur/body",$this->global,NULL,"backend/pimpinan/laporan_produk/data_retur/footer");
        }
        else{ 
            redirect('login');
        }  
    }
    
    function laporan_data_retur(){
        $tanggal_awal = $this->input->post("tanggal_awal");
        $tanggal_akhir = $this->input->post("tanggal_akhir");
        $status = $this->input->post("status");

        $data['tanggal_awal'] = $tanggal_awal;
        $data['tanggal_akhir'] =  $tanggal_akhir;
        $data['status'] =  $status;

        $data['retur_produk'] = $this->Mod_produk->get_all_item_retur_produk();
        $data['data'] = $this->Mod_produk->get_laporan_retur($tanggal_awal, $tanggal_akhir, $status);
        $this->load->view('backend/pimpinan/laporan_produk/data_retur/load_laporan', $data);
    }
}

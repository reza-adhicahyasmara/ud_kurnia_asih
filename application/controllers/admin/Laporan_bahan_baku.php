<?php 
defined('BASEPATH') || exit('No direct script access allowed');

require APPPATH . '/libraries/BaseControllerBackend.php';

class Laporan_bahan_baku extends BaseControllerBackend {

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

        if($nik_karyawan != null && $hak_akses == 'Admin'){
            $this->global['pageTitle'] = "Laporan Data Pemesanan Bahan Baku";
            $this->loadViews("backend/admin/laporan_bahan_baku/data_pemesanan/body",$this->global,NULL,"backend/admin/laporan_bahan_baku/data_pemesanan/footer");
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

        $data['data'] = $this->Mod_bahan_baku->get_laporan_pemesanan($tanggal_awal, $tanggal_akhir, $status);
        $this->load->view('backend/admin/laporan_bahan_baku/data_pemesanan/load_laporan', $data);
    }





    function data_masuk(){
        $nik_karyawan = $this->session->userdata('ses_nik_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses');  

        if($nik_karyawan != null && $hak_akses == 'Admin'){
            $this->global['pageTitle'] = "Laporan Data Bahan Baku Masuk";
            $this->loadViews("backend/admin/laporan_bahan_baku/data_masuk/body",$this->global,NULL,"backend/admin/laporan_bahan_baku/data_masuk/footer");
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

        $data['item_bb'] = $this->Mod_bahan_baku->get_all_item_pemesanan_bb();
        $data['data'] = $this->Mod_bahan_baku->get_laporan_masuk($tanggal_awal, $tanggal_akhir);
        $this->load->view('backend/admin/laporan_bahan_baku/data_masuk/load_laporan', $data);
    }





    function data_keluar(){
        $nik_karyawan = $this->session->userdata('ses_nik_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses');  

        if($nik_karyawan != null && $hak_akses == 'Admin'){
            $this->global['pageTitle'] = "Laporan Data Bahan Baku Keluar";
            $this->loadViews("backend/admin/laporan_bahan_baku/data_keluar/body",$this->global,NULL,"backend/admin/laporan_bahan_baku/data_keluar/footer");
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

        $data['data'] = $this->Mod_bahan_baku->get_laporan_keluar($tanggal_awal, $tanggal_akhir);
        $this->load->view('backend/admin/laporan_bahan_baku/data_keluar/load_laporan', $data);
    }
    




    function data_penyesuaian_stok(){
        $nik_karyawan = $this->session->userdata('ses_nik_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses');  

        if($nik_karyawan != null && $hak_akses == 'Admin'){
            $this->global['pageTitle'] = "Laporan Data Penyesuaian Stok Bahan Baku";
            $this->loadViews("backend/admin/laporan_bahan_baku/data_penyesuaian_stok/body",$this->global,NULL,"backend/admin/laporan_bahan_baku/data_penyesuaian_stok/footer");
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

        $data['data'] = $this->Mod_bahan_baku->get_laporan_penyesuaian_stok($tanggal_awal, $tanggal_akhir);
        $this->load->view('backend/admin/laporan_bahan_baku/data_penyesuaian_stok/load_laporan', $data);
    }





    function data_retur(){
        $nik_karyawan = $this->session->userdata('ses_nik_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses');  

        if($nik_karyawan != null && $hak_akses == 'Admin'){
            $this->global['pageTitle'] = "Laporan Data Retur Bahan Baku";
            $this->loadViews("backend/admin/laporan_bahan_baku/data_retur/body",$this->global,NULL,"backend/admin/laporan_bahan_baku/data_retur/footer");
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

        $data['retur_bb'] = $this->Mod_bahan_baku->get_all_item_retur_bb();
        $data['data'] = $this->Mod_bahan_baku->get_laporan_retur($tanggal_awal, $tanggal_akhir, $status);
        $this->load->view('backend/admin/laporan_bahan_baku/data_retur/load_laporan', $data);
    }
}

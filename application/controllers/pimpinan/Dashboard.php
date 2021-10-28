<?php 
defined('BASEPATH') || exit('No direct script access allowed');

require APPPATH . '/libraries/BaseControllerBackend.php';

class Dashboard extends BaseControllerBackend {

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

            $this->global['pageTitle'] = "Dashboard";

            $data['bahan_baku'] = $this->Mod_bahan_baku->get_all_bahan_baku();
            $data['produk'] = $this->Mod_produk->get_all_produk();
            $data['pemesanan_bahan_baku'] = $this->Mod_bahan_baku->get_all_pemesanan_bb();

            $this->loadViews("backend/pimpinan/dashboard/body",$this->global,$data,"backend/pimpinan/dashboard/footer");
        }   
        else{ 
            redirect('login');
        }  
    }

    function load_grafik_bahan_baku(){
        $kode_bahan_baku = $this->input->post('kode_bahan_baku');
        $grafik_masuk = $this->Mod_bahan_baku->grafik_masuk_bb($kode_bahan_baku);
        foreach($grafik_masuk->result() as $kasep){
            $jumlah_masuk[] = $kasep->jumlah;
            $bulan_tahun_masuk[] = $kasep->bulan."-".$kasep->tahun;
        }

        if (!isset($jumlah_masuk)){
            $jumlah_masuk = NULL;
        }
        if (!isset($bulan_tahun_masuk)){
            $bulan_tahun_masuk = NULL;
        }

        $data['jumlah_masuk'] = json_encode($jumlah_masuk);
        $data['bulan_tahun_masuk'] = json_encode($bulan_tahun_masuk);

        $grafik_keluar = $this->Mod_bahan_baku->grafik_keluar_bb($kode_bahan_baku);

        foreach($grafik_keluar->result() as $kasep){
            $jumlah_keluar[] = $kasep->jumlah;
            $bulan_tahun_keluar[] = $kasep->bulan."-".$kasep->tahun;
        }

        if (!isset($jumlah_keluar)){
            $jumlah_keluar = NULL;
        }
        if (!isset($bulan_tahun_keluar)){
            $bulan_tahun_keluar = NULL;
        }

        $data['jumlah_keluar'] = json_encode($jumlah_keluar);
        $data['bulan_tahun_keluar'] = json_encode($bulan_tahun_keluar);

        $this->load->view("backend/pimpinan/dashboard/grafik_bahan_baku", $data);
    }

    function load_grafik_produk(){
        $kode_produk = $this->input->post('kode_produk');
        $grafik_masuk = $this->Mod_produk->grafik_masuk_produk($kode_produk);
        foreach($grafik_masuk->result() as $kasep){
            $jumlah_masuk[] = $kasep->jumlah;
            $bulan_tahun_masuk[] = $kasep->bulan."-".$kasep->tahun;
        }

        if (!isset($jumlah_masuk)){
            $jumlah_masuk = NULL;
        }
        if (!isset($bulan_tahun_masuk)){
            $bulan_tahun_masuk = NULL;
        }

        $data['jumlah_masuk'] = json_encode($jumlah_masuk);
        $data['bulan_tahun_masuk'] = json_encode($bulan_tahun_masuk);

        $grafik_keluar = $this->Mod_produk->grafik_keluar_produk($kode_produk);

        foreach($grafik_keluar->result() as $kasep){
            $jumlah_keluar[] = $kasep->jumlah;
            $bulan_tahun_keluar[] = $kasep->bulan."-".$kasep->tahun;
        }

        if (!isset($jumlah_keluar)){
            $jumlah_keluar = NULL;
        }
        if (!isset($bulan_tahun_keluar)){
            $bulan_tahun_keluar = NULL;
        }

        $data['jumlah_keluar'] = json_encode($jumlah_keluar);
        $data['bulan_tahun_keluar'] = json_encode($bulan_tahun_keluar);

        $this->load->view("backend/pimpinan/dashboard/grafik_produk", $data);
    }
}

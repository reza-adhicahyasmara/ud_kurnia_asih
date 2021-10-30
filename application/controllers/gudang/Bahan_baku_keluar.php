<?php 
defined('BASEPATH') || exit('No direct script access allowed');

require APPPATH . '/libraries/BaseControllerBackend.php';

class Bahan_baku_keluar extends BaseControllerBackend {

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
            $this->global['pageTitle'] = "Data Bahan Baku Keluar";

            $this->loadViews("backend/gudang/bahan_baku_keluar/body",$this->global,NULL,"backend/gudang/bahan_baku_keluar/footer");
        }
        else{ 
            redirect('login');
        }  
    }

    function load_data_bahan_baku_keluar(){
        $data['bahan_baku_keluar'] = $this->Mod_bahan_baku->get_all_bahan_baku_keluar();
        $this->load->view('backend/gudang/bahan_baku_keluar/load_data_bahan_baku_keluar', $data);
    }
    
    function form_tambah_bahan_baku_keluar(){
        $data['bahan_baku'] = $this->Mod_bahan_baku->get_all_bahan_baku();
        $this->load->view("backend/gudang/bahan_baku_keluar/form_tambah_bahan_baku_keluar",$data);
    }
    
    function tambah_bahan_baku_keluar(){ 
        $kode_bb = $this->input->post('kode_bb');
        $jumlah_bb_keluar = $this->input->post('jumlah_bb_keluar');
        $stok_gudang_pab_bb_lama = $this->input->post('stok_gudang_pab_bb');
        $tanggal_bb_keluar = $this->input->post('tanggal_bb_keluar');
        $keterangan_bb_keluar = $this->input->post('keterangan_bb_keluar');
        
        $kode_bb_keluar = "BBOUT-".$kode_bb."-".date("YmdHis", strtotime($tanggal_bb_keluar));

        if($stok_gudang_pab_bb_lama < $jumlah_bb_keluar){
            echo "Stok kurang";
        }else{
            echo 1;
            $save  = array(
                'kode_bb_keluar'          => $kode_bb_keluar,
                'kode_bb'                 => $kode_bb,
                'jumlah_bb_keluar'        => $jumlah_bb_keluar,
                'tanggal_bb_keluar'       => $tanggal_bb_keluar,
                'keterangan_bb_keluar'    => $keterangan_bb_keluar,    
            );
                        
            $this->Mod_bahan_baku->insert_bahan_baku_keluar("t_bb_keluar", $save);             
            
            $stok_gudang_pab_bb = $stok_gudang_pab_bb_lama - $jumlah_bb_keluar;

            $data2  = array(
                'kode_bb'               => $kode_bb,
                'stok_gudang_pab_bb'    => $stok_gudang_pab_bb       
            );
                        
            $this->Mod_bahan_baku->update_bahan_baku($kode_bb, $data2);      
        }
    }

    function hapus_bahan_baku_keluar(){
        $kode_bb_keluar = $this->input->post('kode_bb_keluar');
        $jumlah_bb_keluar = $this->input->post('jumlah_bb_keluar');
        $kode_bb = $this->input->post('kode_bb');
        $stok_gudang_pab_bb_lama = $this->input->post('stok_gudang_pab_bb');

        $this->Mod_bahan_baku->delete_bahan_baku_keluar($kode_bb_keluar, 't_bb_keluar');

        $stok_gudang_pab_bb = $stok_gudang_pab_bb_lama + $jumlah_bb_keluar;

        $data2  = array(
            'kode_bb'               => $kode_bb,
            'stok_gudang_pab_bb'    => $stok_gudang_pab_bb       
        );
                    
        $this->Mod_bahan_baku->update_bahan_baku($kode_bb, $data2); 
    } 
    
    
}

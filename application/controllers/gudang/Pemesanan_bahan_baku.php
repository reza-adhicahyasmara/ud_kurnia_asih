<?php 
defined('BASEPATH') || exit('No direct script access allowed');

require APPPATH . '/libraries/BaseControllerBackend.php';

class Pemesanan_bahan_baku extends BaseControllerBackend {

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
            $this->global['pageTitle'] = "Pemesanan Bahan Baku";

            $data['data_pemesanan'] = $this->Mod_bahan_baku->get_all_pemesanan_bb();
            $this->loadViews("backend/gudang/pemesanan_bahan_baku/body",$this->global,$data,"backend/gudang/pemesanan_bahan_baku/footer");
        }  
        else{ 
            redirect('login');
        }  
    }

    function detail($kode_pemesanan_bb){
        $nik_karyawan = $this->session->userdata('ses_nik_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses');  

        if($nik_karyawan != null && $hak_akses == 'Gudang'){
            $this->global['pageTitle'] = "Detail Pemesanan Bahan Baku";
            
            $data['data_detail'] = $this->Mod_bahan_baku->get_pemesanan_bb($kode_pemesanan_bb);

            $this->loadViews("backend/gudang/pemesanan_bahan_baku/body_detail",$this->global,$data,"backend/gudang/pemesanan_bahan_baku/footer");
        }
        else{ 
            redirect('login');
        }  
    }

    function load_data_item_pemesanan_bb(){
        $kode_pemesanan_bb = $this->input->post('kode_pemesanan_bb');
        $data['total_pby_pemesanan_bb'] = $this->input->post('total_pby_pemesanan_bb');
        $data['status_pemesanan_bb'] = $this->input->post('status_pemesanan_bb');
        $data['list_bahan_baku'] = $this->Mod_bahan_baku->get_item_pemesanan_bb($kode_pemesanan_bb);
        $this->load->view('backend/gudang/pemesanan_bahan_baku/load_data_item_pemesanan_bb', $data);
    }

    
    function update_status_item_bb(){
        $kode_ipemesanan_bb = $this->input->post('kode_ipemesanan_bb');
        $jumlah_retur_ipemesanan_bb = $this->input->post('jumlah_retur_ipemesanan_bb');
        $keterangan_retur_ipemesanan_bb = $this->input->post('keterangan_retur_ipemesanan_bb');
        $status_ipemesanan_bb = $this->input->post('status_ipemesanan_bb');

        echo 1;         
        $save  = array( 
            'kode_ipemesanan_bb'                => $kode_ipemesanan_bb,
            'jumlah_retur_ipemesanan_bb'        => $jumlah_retur_ipemesanan_bb,
            'keterangan_retur_ipemesanan_bb'    => $keterangan_retur_ipemesanan_bb,
            'status_ipemesanan_bb'              => $status_ipemesanan_bb
        );
                    
        $this->Mod_bahan_baku->update_item_pemesanan_bb($kode_ipemesanan_bb, $save); 
    }

    function update_status_pemesanan_bb(){
        $kode_pemesanan_bb = $this->input->post('kode_pemesanan_bb');
        $status_pemesanan_bb = $this->input->post('status_pemesanan_bb');
        $tanggal_masuk = date("Y-m-d H:m:s");

        $cek_retur_item = $this->Mod_bahan_baku->cek_item_retur($kode_pemesanan_bb);
        $cek_kirim_item = $this->Mod_bahan_baku->cek_kirim_retur($kode_pemesanan_bb);

        if($status_pemesanan_bb == 5){
            if($cek_retur_item->num_rows() > 0){
                echo "Pastikan semua item diterima dengan kondisi baik";
            }elseif($cek_kirim_item->num_rows() > 0){
                echo "Pastikan item sudah diproses";
            }else{
                echo 1;         
                $save  = array( 
                    'kode_pemesanan_bb'                => $kode_pemesanan_bb,
                    'tanggal_terima_pemesanan_bb'      => $tanggal_masuk,
                    'status_pemesanan_bb'              => $status_pemesanan_bb
                );
                            
                $this->Mod_bahan_baku->update_pemesanan_bb($kode_pemesanan_bb, $save); 

                $item = $this->Mod_bahan_baku->get_item_pemesanan_bb($kode_pemesanan_bb)->result();

                foreach($item as $row){
                    $kode_ipemesanan_bb = $row->kode_ipemesanan_bb;
                    $kode_bb = $row->kode_bb;
                    $jumlah_ipemesanan_bb = $row->jumlah_ipemesanan_bb;
        
                    $currentStok = $this->Mod_bahan_baku->getValueOfTable("t_bahan_baku","stok_gudang_pab_bb",array("kode_bb" => $kode_bb));
        
                    $data_update_stok[] = array(
                        "kode_bb" => $kode_bb,
                        "stok_gudang_pab_bb" => $currentStok + $jumlah_ipemesanan_bb
                    );
        
                    $data_update_status[] = array(
                        "kode_ipemesanan_bb" => $kode_ipemesanan_bb,
                        "status_ipemesanan_bb" => '6',
                        "tanggal_masuk_ipemesanan_bb" =>  $tanggal_masuk
                    );
        
                    $this->db->update_batch("t_bahan_baku",$data_update_stok,"kode_bb");
                    $this->db->update_batch("t_ipemesanan_bb",$data_update_status,"kode_ipemesanan_bb");
                }
            }
        }else if($status_pemesanan_bb == 7){
            if($cek_retur_item->num_rows() > 0){
                echo 1;         
                $save  = array( 
                    'kode_pemesanan_bb'                => $kode_pemesanan_bb,
                    'status_pemesanan_bb'              => $status_pemesanan_bb
                );
                            
                $this->Mod_bahan_baku->update_pemesanan_bb($kode_pemesanan_bb, $save); 
            }elseif($cek_kirim_item->num_rows() > 0){
                echo "Pastikan item sudah diproses";
            }else{
                echo "Pastikan salah satu item diretur";
            }  
        }
    }


}
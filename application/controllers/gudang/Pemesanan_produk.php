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

        if($nik_karyawan != null && $hak_akses == 'Gudang'){
            $this->global['pageTitle'] = "Pemesanan Produk";

            $data['data_pemesanan'] = $this->Mod_produk->get_all_pemesanan_produk();
            $this->loadViews("backend/gudang/pemesanan_produk/body",$this->global,$data,"backend/gudang/pemesanan_produk/footer");
        }  
        else{ 
            redirect('login');
        }  
    }

    function detail($kode_pemesanan_produk){
        $nik_karyawan = $this->session->userdata('ses_nik_karyawan');   
        $hak_akses = $this->session->userdata('ses_akses');  

        if($nik_karyawan != null && $hak_akses == 'Gudang'){
            $this->global['pageTitle'] = "Detail Pemesanan Produk";
            
            $data['data_detail'] = $this->Mod_produk->get_pemesanan_produk($kode_pemesanan_produk);
            $data['list_produk'] = $this->Mod_produk->get_item_pemesanan_produk($kode_pemesanan_produk);

            $this->loadViews("backend/gudang/pemesanan_produk/body_detail",$this->global,$data,"backend/gudang/pemesanan_produk/footer");
        }
        else{ 
            redirect('login');
        }  
    }

    function invoice($kode_pemesanan_produk){
        $nik_karyawan = $this->session->userdata('ses_nik_karyawan');   
        $hak_akses = $this->session->userdata('ses_akses');  

        if($nik_karyawan != null && $hak_akses == 'Gudang'){
            $this->global['pageTitle'] = "Invoice";
            
            $data['data_detail'] = $this->Mod_produk->get_pemesanan_produk($kode_pemesanan_produk);
            $data['list_produk'] = $this->Mod_produk->get_item_pemesanan_produk($kode_pemesanan_produk);

            $this->loadViews("backend/gudang/pemesanan_produk/body_invoice",$this->global,$data,"backend/gudang/pemesanan_produk/footer_invoice");
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
        $this->load->view('backend/gudang/pemesanan_produk/load_data_item_pemesanan_produk', $data);
    }

    function insert_tanggal_kadaluwarsa(){
        $kode_ipemesanan_produk = $this->input->post('kode_ipemesanan_produk');
        $tanggal_kadaluwarsa_ipemesanan_produk = $this->input->post('tanggal_kadaluwarsa_ipemesanan_produk');

        echo 1;         
        $save  = array( 
            'kode_ipemesanan_produk'                    => $kode_ipemesanan_produk,
            'tanggal_kadaluwarsa_ipemesanan_produk'     => $tanggal_kadaluwarsa_ipemesanan_produk
        );
                    
        $this->Mod_produk->update_item_pemesanan_produk($kode_ipemesanan_produk, $save);       
    }

    function update_pemesanan_produk(){
        $kode_pemesanan_produk = $this->input->post('kode_pemesanan_produk');
        $status_pemesanan_produk = $this->input->post('status_pemesanan_produk');
        $status_pby_pemesanan_produk = $this->input->post('status_pby_pemesanan_produk');
        $keterangan_batal_pemesanan_produk = $this->input->post('keterangan_batal_pemesanan_produk');

        $cek_status_item = $this->Mod_produk->cek_item_retur($kode_pemesanan_produk);  

        if($status_pemesanan_produk == 4){
            
            $cek_tanggal = $this->Mod_produk->get_tanggal_kadaluwarsa($kode_pemesanan_produk);
            if($cek_tanggal->num_rows() > 0){
                echo "Tanggal kadaluwarsa wajib diisi";
            }else{
                
                echo 1;         
                $save  = array( 
                    'kode_pemesanan_produk'                 => $kode_pemesanan_produk,
                    'status_pemesanan_produk'               => $status_pemesanan_produk,
                    'status_pby_pemesanan_produk'           => $status_pby_pemesanan_produk,
                    'keterangan_batal_pemesanan_produk'     => $keterangan_batal_pemesanan_produk
                );
                $this->Mod_produk->update_pemesanan_produk($kode_pemesanan_produk, $save);  

                $item = $this->Mod_produk->get_item_pemesanan_produk($kode_pemesanan_produk)->result();

                foreach($item as $row){
                    $kode_produk = $row->kode_produk;
                    $jumlah_ipemesanan_produk = $row->jumlah_ipemesanan_produk;

                    $currentStok = $this->Mod_bahan_baku->getValueOfTable("t_produk","stok_gudang_produk",array("kode_produk" => $kode_produk));

                    $data_update_stok[] = array(
                        "kode_produk" => $kode_produk,
                        "stok_gudang_produk" => $currentStok - $jumlah_ipemesanan_produk
                    );

                    $this->db->update_batch("t_produk",$data_update_stok,"kode_produk");
                }
            }
        }
        elseif($status_pemesanan_produk == 7){
            if($cek_status_item->num_rows() > 0){  
                echo "Pastikan item sudah diretur";   
            }else{
                echo 1;         
                $save  = array( 
                    'kode_pemesanan_produk'                 => $kode_pemesanan_produk,
                    'status_pemesanan_produk'               => "4"
                );   
                $this->Mod_produk->update_pemesanan_produk($kode_pemesanan_produk, $save);  
            }             
        }else{
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
}
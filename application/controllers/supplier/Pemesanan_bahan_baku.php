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
        $id_supplier = $this->session->userdata('ses_id_supplier');   
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_supplier != null && $hak_akses == 'Supplier'){
            $this->global['pageTitle'] = "Pemesanan Bahan Baku";

            $data['data_pemesanan'] = $this->Mod_bahan_baku->get_pemesanan_bb_supplier($id_supplier);
            $this->loadViews("backend/supplier/pemesanan_bahan_baku/body",$this->global,$data,"backend/supplier/pemesanan_bahan_baku/footer");
        }  
        else{ 
            redirect('login');
        }  
    }

    function detail($kode_pemesanan_bb){
        $id_supplier = $this->session->userdata('ses_id_supplier');   
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_supplier != null && $hak_akses == 'Supplier'){
            $this->global['pageTitle'] = "Detail Pemesanan Bahan Baku";
            
            $data['data_detail'] = $this->Mod_bahan_baku->get_pemesanan_bb($kode_pemesanan_bb);
            $data['list_bahan_baku'] = $this->Mod_bahan_baku->get_item_pemesanan_bb($kode_pemesanan_bb);

            $this->loadViews("backend/supplier/pemesanan_bahan_baku/body_detail",$this->global,$data,"backend/supplier/pemesanan_bahan_baku/footer");
        }
        else{ 
            redirect('login');
        }  
    }

    function invoice($kode_pemesanan_bb){
        $id_supplier = $this->session->userdata('ses_id_supplier');   
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_supplier != null && $hak_akses == 'Supplier'){
            $this->global['pageTitle'] = "Invoice";
            
            $data['data_detail'] = $this->Mod_bahan_baku->get_pemesanan_bb($kode_pemesanan_bb);
            $data['list_bahan_baku'] = $this->Mod_bahan_baku->get_item_pemesanan_bb($kode_pemesanan_bb);

            $this->loadViews("backend/supplier/pemesanan_bahan_baku/body_invoice",$this->global,$data,"backend/supplier/pemesanan_bahan_baku/footer_invoice");
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
        $this->load->view('backend/supplier/pemesanan_bahan_baku/load_data_item_pemesanan_bb', $data);
    }

    function insert_tanggal_kadaluwarsa(){
        $kode_ipemesanan_bb = $this->input->post('kode_ipemesanan_bb');
        $tanggal_kadaluwarsa_ipemesanan_bb = $this->input->post('tanggal_kadaluwarsa_ipemesanan_bb');

        echo 1;         
        $save  = array( 
            'kode_ipemesanan_bb'                    => $kode_ipemesanan_bb,
            'tanggal_kadaluwarsa_ipemesanan_bb'     => $tanggal_kadaluwarsa_ipemesanan_bb
        );
                    
        $this->Mod_bahan_baku->update_item_pemesanan_bb($kode_ipemesanan_bb, $save);       
    }

    function update_pemesanan_bb(){
        $kode_pemesanan_bb = $this->input->post('kode_pemesanan_bb');
        $status_pemesanan_bb = $this->input->post('status_pemesanan_bb');
        $status_pby_pemesanan_bb = $this->input->post('status_pby_pemesanan_bb');
        $keterangan_batal_pemesanan_bb = $this->input->post('keterangan_batal_pemesanan_bb');

        $cek_status_item = $this->Mod_bahan_baku->cek_item_retur($kode_pemesanan_bb);  

        if($status_pemesanan_bb == 4){
            
            $cek_tanggal = $this->Mod_bahan_baku->get_tanggal_kadaluwarsa($kode_pemesanan_bb);
            if($cek_tanggal->num_rows() > 0){
                echo "Tanggal kadaluwarsa wajib diisi";
            }else{
                
                echo 1;         
                $save  = array( 
                    'kode_pemesanan_bb'                 => $kode_pemesanan_bb,
                    'status_pemesanan_bb'               => $status_pemesanan_bb,
                    'status_pby_pemesanan_bb'           => $status_pby_pemesanan_bb,
                    'keterangan_batal_pemesanan_bb'     => $keterangan_batal_pemesanan_bb
                );
                $this->Mod_bahan_baku->update_pemesanan_bb($kode_pemesanan_bb, $save);  

                $item = $this->Mod_bahan_baku->get_item_pemesanan_bb($kode_pemesanan_bb)->result();

                foreach($item as $row){
                    $kode_bb = $row->kode_bb;
                    $jumlah_ipemesanan_bb = $row->jumlah_ipemesanan_bb;

                    $currentStok = $this->Mod_bahan_baku->getValueOfTable("t_bahan_baku","stok_gudang_sup_bb",array("kode_bb" => $kode_bb));

                    $data_update_stok[] = array(
                        "kode_bb" => $kode_bb,
                        "stok_gudang_sup_bb" => $currentStok - $jumlah_ipemesanan_bb
                    );

                    $this->db->update_batch("t_bahan_baku",$data_update_stok,"kode_bb");
                }
            }
        }
        elseif($status_pemesanan_bb == 7){
            if($cek_status_item->num_rows() > 0){  
                echo "Pastikan item sudah diretur";   
            }else{
                echo 1;         
                $save  = array( 
                    'kode_pemesanan_bb'                 => $kode_pemesanan_bb,
                    'status_pemesanan_bb'               => "4"
                );   
                $this->Mod_bahan_baku->update_pemesanan_bb($kode_pemesanan_bb, $save);  
            }             
        }else{
            echo 1;  
            $save  = array( 
                'kode_pemesanan_bb'                 => $kode_pemesanan_bb,
                'status_pemesanan_bb'               => $status_pemesanan_bb,
                'status_pby_pemesanan_bb'           => $status_pby_pemesanan_bb,
                'keterangan_batal_pemesanan_bb'     => $keterangan_batal_pemesanan_bb
            );    
            $this->Mod_bahan_baku->update_pemesanan_bb($kode_pemesanan_bb, $save);  
        }
          
    }
}
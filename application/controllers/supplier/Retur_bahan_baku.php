<?php 
defined('BASEPATH') || exit('No direct script access allowed');

require APPPATH . '/libraries/BaseControllerBackend.php';

class Retur_bahan_baku extends BaseControllerBackend {

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
            $this->global['pageTitle'] = "Data Retur Bahan Baku";

            $data['supplier'] = $this->Mod_supplier->get_all_supplier();
            $data['data_retur'] = $this->Mod_bahan_baku->get_all_retur_bb();
            $data['bahan_baku'] = $this->Mod_bahan_baku->get_all_bahan_baku();
            $this->loadViews("backend/supplier/retur_bahan_baku/body",$this->global,$data,"backend/supplier/retur_bahan_baku/footer");
        }  
        else{ 
            redirect('login');
        }   
    }

    function detail($kode_retur_bb){
        $id_supplier = $this->session->userdata('ses_id_supplier');   
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_supplier != null && $hak_akses == 'Supplier'){
            $this->global['pageTitle'] = "Detail Pemesanan Toko";
            
            $data['data_detail'] = $this->Mod_bahan_baku->get_retur_bb($kode_retur_bb);

            $this->loadViews("backend/supplier/retur_bahan_baku/body_detail",$this->global,$data,"backend/supplier/retur_bahan_baku/footer");
        }
        else{ 
            redirect('login');
        }   
    }

    function invoice($kode_retur_bb){
        $id_supplier = $this->session->userdata('ses_id_supplier');   
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_supplier != null && $hak_akses == 'Supplier'){
            $this->global['pageTitle'] = "Invoice";
            
            $data['data_detail'] = $this->Mod_bahan_baku->get_retur_bb($kode_retur_bb);
            $data['list_bahan_baku'] = $this->Mod_bahan_baku->get_item_retur_bb($kode_retur_bb);

            $this->loadViews("backend/supplier/retur_bahan_baku/body_invoice",$this->global,$data,"backend/supplier/retur_bahan_baku/footer_invoice");
        }
        else{ 
            redirect('login');
        }  
    }

    function load_data_detail_item_retur_bb(){
        $kode_retur_bb = $this->input->post('kode_retur_bb');
        $data['status_retur_bb'] = $this->input->post('status_retur_bb');
        $data['list_bahan_baku'] = $this->Mod_bahan_baku->get_item_retur_bb($kode_retur_bb);
        $this->load->view('backend/supplier/retur_bahan_baku/load_data_detail_item_retur_bb', $data);
    }

    function update_item_retur(){
        $kode_iretur_bb = $this->input->post('kode_iretur_bb');
        $status_iretur_bb = $this->input->post('status_iretur_bb');
        $keterangan_batal_iretur_bb = $this->input->post('keterangan_batal_iretur_bb');

        echo 1;         
        $save  = array( 
            'kode_iretur_bb'                => $kode_iretur_bb,
            'status_iretur_bb'              => $status_iretur_bb,
            'keterangan_batal_iretur_bb'    => $keterangan_batal_iretur_bb,
        );
                    
        $this->Mod_bahan_baku->update_item_retur_bb($kode_iretur_bb, $save);    
    }
    
    function update_retur_bb(){
        $kode_retur_bb = $this->input->post('kode_retur_bb');
        $status_retur_bb = $this->input->post('status_retur_bb');

        $cek_item1 = $this->Mod_bahan_baku->cek_item_proses($kode_retur_bb);
        
        if($cek_item1->num_rows() > 0){ 
            echo "Ada item yang belum diproses";
        } else {

            echo 1;         
            $save  = array( 
                'kode_retur_bb'                 => $kode_retur_bb,
                'status_retur_bb'               => $status_retur_bb,
            );
                        
            $this->Mod_bahan_baku->update_retur_bb($kode_retur_bb, $save);       
        }
    }

}
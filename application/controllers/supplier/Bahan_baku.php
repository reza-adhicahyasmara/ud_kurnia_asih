<?php 
defined('BASEPATH') || exit('No direct script access allowed');

require APPPATH . '/libraries/BaseControllerBackend.php';

class Bahan_baku extends BaseControllerBackend {

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
            $this->global['pageTitle'] = "Bahan Baku";

            $this->loadViews("backend/supplier/bahan_baku/body",$this->global,NULL,"backend/supplier/bahan_baku/footer");
        }
        else{ 
            redirect('login');
        }  
    }

    function load_data_bahan_baku(){
        $data['bahan_baku'] = $this->Mod_bahan_baku->get_all_bahan_baku();
        $this->load->view('backend/supplier/bahan_baku/load_bahan_baku', $data);
    }

    function form_edit_bahan_baku(){
        $kode_bb = $this->input->post('kode_bb');
        
		$data['edit'] = $this->Mod_bahan_baku->get_bahan_baku($kode_bb);
        $this->load->view("backend/supplier/bahan_baku/form_edit_bahan_baku", $data);
    }

    function edit_bahan_baku(){
        $kode_bb = $this->input->post('kode_bb');
        $harga_bb = $this->input->post('harga_bb');
        $stok_gudang_sup_bb = $this->input->post('stok_gudang_sup_bb');
        $stok_limit_sup_bb = $this->input->post('stok_limit_sup_bb');

        echo 1;
        $save  = array( 
            'kode_bb'               => $kode_bb,
            'harga_bb'              => $harga_bb,
            'stok_gudang_sup_bb'    => $stok_gudang_sup_bb,
            'stok_limit_sup_bb'     => $stok_limit_sup_bb 
        );
                    
        $this->Mod_bahan_baku->update_bahan_baku($kode_bb, $save);   
    }
    
}

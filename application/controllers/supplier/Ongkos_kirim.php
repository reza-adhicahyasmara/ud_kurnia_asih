<?php 
defined('BASEPATH') || exit('No direct script access allowed');

require APPPATH . '/libraries/BaseControllerBackend.php';

class Ongkos_kirim extends BaseControllerBackend {

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

    function index(){
        $id_supplier = $this->session->userdata('ses_id_supplier');   
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_supplier != null && $hak_akses == 'Supplier'){
            $this->global['pageTitle'] = "Data Ongkos Kirim";

		    $data['edit'] = $this->Mod_supplier->get_supplier($id_supplier);
            $this->loadViews("backend/supplier/ongkos_kirim/body",$this->global,$data,"backend/supplier/ongkos_kirim/footer");
        }  
        else{ 
            redirect('login');
        }  
    }

    function edit_supplier(){
        $id_supplier = $this->input->post('id_supplier');
        $ongkir_supplier = $this->input->post('ongkir_supplier');
        $berat_ongkir_supplier = $this->input->post('berat_ongkir_supplier');
    
        echo 1;
                        
        $save  = array( 
            'id_supplier'               => $id_supplier,
            'ongkir_supplier'           => $ongkir_supplier,
            'berat_ongkir_supplier'     => $berat_ongkir_supplier
        );
                    
        $this->Mod_supplier->update_supplier($id_supplier, $save);             
        
    }
}

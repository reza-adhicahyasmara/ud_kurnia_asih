<?php 
defined('BASEPATH') || exit('No direct script access allowed');

require APPPATH . '/libraries/BaseControllerBackend.php';

class Rekening extends BaseControllerBackend {

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
        $id_customer = $this->session->userdata('ses_id_customer');   
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_customer != null && $hak_akses == 'Customer'){
            $this->global['pageTitle'] = "Data Rekening Bank";

            $this->loadViews("backend/customer/rekening/body",$this->global,NULL,"backend/customer/rekening/footer");
        }  
        else{ 
            redirect('login');
        }  
    }

    function load_data_rekening(){
        $data['rekening'] = $this->Mod_bank->get_all_rekening();
        $this->load->view('backend/customer/rekening/load_rekening', $data);
    }

    function form_tambah_rekening(){
        $data['bank'] = $this->Mod_bank->get_all_bank();
        $this->load->view("backend/customer/rekening/form_tambah_rekening", $data);
    }

    function form_edit_rekening(){
        $kode_rekening = $this->input->post('kode_rekening');
        $data['bank'] = $this->Mod_bank->get_all_bank();
		$data['edit'] = $this->Mod_bank->get_rekening($kode_rekening);
        $this->load->view("backend/customer/rekening/form_edit_rekening", $data);
    }

    function tambah_rekening(){ 
        $kode_bank = $this->input->post('kode_bank');
        $id_customer = $this->session->userdata('ses_id_customer');   
        $an_rekening = $this->input->post('an_rekening');
        $no_rekening = $this->input->post('no_rekening');
        
        echo 1;
                    
        $save  = array(
            'kode_bank'        => $kode_bank,
            'id'               => $id_customer,
            'an_rekening'      => $an_rekening,        
            'no_rekening'      => $no_rekening,        
        );
                    
        $this->Mod_bank->insert_rekening("t_rekening", $save);            
    }

    function edit_rekening(){
        $kode_rekening = $this->input->post('kode_rekening');
        $kode_bank = $this->input->post('kode_bank');  
        $an_rekening = $this->input->post('an_rekening');
        $no_rekening = $this->input->post('no_rekening');
        
        echo 1;
                    
        $save  = array(
            'kode_rekening'    => $kode_rekening,
            'kode_bank'        => $kode_bank,
            'an_rekening'      => $an_rekening,        
            'no_rekening'      => $no_rekening,        
        );
                       
        $this->Mod_bank->update_rekening($kode_rekening, $save);    
    }

    function hapus_rekening(){
        $kode_rekening = $this->input->post('kode_rekening');
        $this->Mod_bank->delete_rekening($kode_rekening, 't_rekening');
    } 
}

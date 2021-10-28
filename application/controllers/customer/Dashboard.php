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
        $id_customer = $this->session->userdata('ses_id_customer');   
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_customer != null && $hak_akses == 'Customer'){

            $this->global['pageTitle'] = "Dashboard";


            $this->loadViews("backend/customer/dashboard/body",$this->global,NULL,"backend/customer/dashboard/footer");
        }   
        else{ 
            redirect('login');
        }  
    }
}

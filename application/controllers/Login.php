<?php 
defined('BASEPATH') || exit('No direct script access allowed');

class Login extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model(array('Mod_customer')); 
        $this->load->model(array('Mod_karyawan')); 
        $this->load->model(array('Mod_supplier')); 
    }

    public function index(){   
        $this->load->view('login'); 
    }

    
    public function proses(){   
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $auth_customer = $this->Mod_customer->auth_customer($username, $password);
        $auth_karyawan = $this->Mod_karyawan->auth_karyawan($username, $password);
        $auth_supplier = $this->Mod_supplier->auth_supplier($username, $password);

        if($auth_karyawan->num_rows() > 0){
            $data=$auth_karyawan->row_array();
            $this->session->set_userdata('masuk',TRUE);
            $this->session->set_userdata('ses_akses',$data['level_karyawan']);
            $this->session->set_userdata('ses_nik_karyawan',$data['nik_karyawan']);
            $this->session->set_userdata('ses_nama_karyawan',$data['nama_karyawan']);
            $this->session->set_userdata('ses_alamat_karyawan',$data['alamat_karyawan']);
            $this->session->set_userdata('ses_kontak_karyawan',$data['kontak_karyawan']);
            $this->session->set_userdata('ses_username_karyawan',$data['username_karyawan']);
            $this->session->set_userdata('ses_password_karyawan',$data['password_karyawan']);
            $this->session->set_userdata('ses_foto_karyawan',$data['foto_karyawan']);
            if($data['level_karyawan']=='Admin'){
                echo "admin/dashboard";
            }
            elseif($data['level_karyawan']=='Pimpinan'){ 
                echo "pimpinan/dashboard";
            } 
            elseif($data['level_karyawan']=='Gudang'){ 
                echo "gudang/dashboard";
            } 
        }        
        elseif($auth_supplier->num_rows() > 0){
            $data=$auth_supplier->row_array();
            $this->session->set_userdata('masuk',TRUE);
            $this->session->set_userdata('ses_akses','Supplier');
            $this->session->set_userdata('ses_id_supplier',$data['id_supplier']);
            $this->session->set_userdata('ses_nama_supplier',$data['nama_supplier']);
            $this->session->set_userdata('ses_alamat_supplier',$data['alamat_supplier']);
            $this->session->set_userdata('ses_kontak_supplier',$data['kontak_supplier']);
            $this->session->set_userdata('ses_foto_supplier',$data['foto_supplier']);
            $this->session->set_userdata('ses_username_supplier',$data['username_supplier']);
            $this->session->set_userdata('ses_password_supplier',$data['password_supplier']);     
            echo "supplier/dashboard";
        }  
        elseif($auth_customer->num_rows() > 0){
            $data=$auth_customer->row_array();
            $this->session->set_userdata('masuk',TRUE);
            $this->session->set_userdata('ses_akses','Customer');
            $this->session->set_userdata('ses_id_customer',$data['id_customer']);
            $this->session->set_userdata('ses_nama_customer',$data['nama_customer']);
            $this->session->set_userdata('ses_alamat_customer',$data['alamat_customer']);
            $this->session->set_userdata('ses_kontak_customer',$data['kontak_customer']);
            $this->session->set_userdata('ses_foto_customer',$data['foto_customer']);
            $this->session->set_userdata('ses_ongkir_customer',$data['ongkir_customer']);
            $this->session->set_userdata('ses_berat_ongkir_customer',$data['berat_ongkir_customer']);  
            $this->session->set_userdata('ses_username_customer',$data['username_customer']);
            $this->session->set_userdata('ses_password_customer',$data['password_customer']);     
            echo "customer/dashboard";
        }  
        else{
            echo "1";
        }
    }
    
	
    public function logout(){
        $this->session->sess_destroy();
        redirect('login');
    }

}
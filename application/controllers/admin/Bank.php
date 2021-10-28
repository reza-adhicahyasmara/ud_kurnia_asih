<?php 
defined('BASEPATH') || exit('No direct script access allowed');

require APPPATH . '/libraries/BaseControllerBackend.php';

class Bank extends BaseControllerBackend {

    function __construct(){
        parent::__construct();
        $this->load->model('Mod_bahan_baku');
        $this->load->model('Mod_bank');
        $this->load->model('Mod_customer');
        $this->load->model('Mod_karyawan');
        $this->load->model('Mod_proposal');
        $this->load->model('Mod_produk');
        $this->load->model('Mod_bank');
    }

    function index(){
        $nik_karyawan = $this->session->userdata('ses_nik_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses');  

        if($nik_karyawan != null && $hak_akses == 'Admin'){
            $this->global['pageTitle'] = "Data Bank";

            $this->loadViews("backend/admin/bank/body",$this->global,NULL,"backend/admin/bank/footer");
        }  
        else{ 
            redirect('login');
        }  
    }

    
    ////////////////////-----BANK-----////////////////////

    function load_data_bank(){
        $data['bank'] = $this->Mod_bank->get_all_bank();
        $this->load->view('backend/admin/bank/load_bank', $data);
    }

    function form_tambah_bank(){
        $this->load->view("backend/admin/bank/form_tambah_bank", NULL);
    }

    function form_edit_bank(){
        $kode_bank = $this->input->post('kode_bank');
		$data['edit'] = $this->Mod_bank->get_bank($kode_bank);
        $this->load->view("backend/admin/bank/form_edit_bank", $data);
    }

    function tambah_bank(){ 
        $kode_bank_baru = $this->input->post('kode_bank_baru');
        $nama_bank = $this->input->post('nama_bank');
        
        $cek = $this->Mod_bank->get_bank($kode_bank_baru);
        if($cek->num_rows() > 0){
            echo "bank sudah ada..!!";
        }
        else {
            echo 1;
                        
            $save  = array(
                'kode_bank'     => $kode_bank_baru,
                'nama_bank'     => $nama_bank,        
            );
                        
            $this->Mod_bank->insert_bank("t_bank", $save);  
        }                 
    }

    function edit_bank(){
        $kode_bank_lama = $this->input->post('kode_bank_lama');
        $kode_bank_baru = $this->input->post('kode_bank_baru');
        $nama_bank = $this->input->post('nama_bank');

        $cek = $this->Mod_bank->get_bank($kode_bank_baru);
    
        if($kode_bank_lama == $kode_bank_baru){
            echo 1;
                            
            $save  = array( 
                'kode_bank'     => $kode_bank_baru,
                'nama_bank'     => $nama_bank  
            );
                        
            $this->Mod_bank->update_bank($kode_bank_lama, $save);   
        } else{
            if($cek->num_rows() > 0){
                echo "Kode bank sudah ada..!!";
            }
            else {
                echo 1;
                            
                $save  = array(
                    'kode_bank'     => $kode_bank_baru,
                    'nama_bank'     => $nama_bank       
                );
                            
                $this->Mod_bank->update_bank($kode_bank_lama, $save);    
            }                 
        }    
        
    }

    function hapus_bank(){
        $kode_bank = $this->input->post('kode_bank');
        $this->Mod_bank->delete_bank($kode_bank, 't_bank');
    } 



    ////////////////////-----REKENING-----////////////////////

    function load_data_rekening(){
        $data['rekening'] = $this->Mod_bank->get_all_rekening();
        $this->load->view('backend/admin/bank/load_rekening', $data);
    }

    function form_tambah_rekening(){
        $data['bank'] = $this->Mod_bank->get_all_bank();
        $this->load->view("backend/admin/bank/form_tambah_rekening", $data);
    }

    function form_edit_rekening(){
        $kode_rekening = $this->input->post('kode_rekening');
        $data['bank'] = $this->Mod_bank->get_all_bank();
		$data['edit'] = $this->Mod_bank->get_rekening($kode_rekening);
        $this->load->view("backend/admin/bank/form_edit_rekening", $data);
    }

    function tambah_rekening(){ 
        $kode_bank = $this->input->post('kode_bank'); 
        $an_rekening = $this->input->post('an_rekening');
        $no_rekening = $this->input->post('no_rekening');
        
        echo 1;
                    
        $save  = array(
            'kode_bank'     => $kode_bank,
            'an_rekening'   => $an_rekening,        
            'no_rekening'   => $no_rekening,        
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
            'kode_rekening' => $kode_rekening,
            'kode_bank'     => $kode_bank,
            'an_rekening'   => $an_rekening,        
            'no_rekening'   => $no_rekening,        
        );
                       
        $this->Mod_bank->update_rekening($kode_rekening, $save);    
    }

    function hapus_rekening(){
        $kode_rekening = $this->input->post('kode_rekening');
        $this->Mod_bank->delete_rekening($kode_rekening, 't_rekening');
    } 
}

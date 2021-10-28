<?php 
defined('BASEPATH') || exit('No direct script access allowed');

require APPPATH . '/libraries/BaseControllerBackend.php';

class Satuan extends BaseControllerBackend {

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
        $nik_karyawan = $this->session->userdata('ses_nik_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses');  

        if($nik_karyawan != null && $hak_akses == 'Admin'){
            $this->global['pageTitle'] = "Data Satuan";

            $this->loadViews("backend/admin/satuan/body",$this->global,NULL,"backend/admin/satuan/footer");
        }  
        else{ 
            redirect('login');
        }  
    }

    function load_data_satuan(){
        $data['satuan'] = $this->Mod_bahan_baku->get_all_satuan();
        $this->load->view('backend/admin/satuan/load_satuan', $data);
    }

    function form_tambah_satuan(){
        $this->load->view("backend/admin/satuan/form_tambah_satuan", NULL);
    }

    function form_edit_satuan(){
        $kode_satuan = $this->input->post('kode_satuan');
		$data['edit'] = $this->Mod_bahan_baku->get_satuan($kode_satuan);
        $this->load->view("backend/admin/satuan/form_edit_satuan", $data);
    }

    function tambah_satuan(){ 
        $nama_satuan_baru = $this->input->post('nama_satuan_baru');
        
        $cek = $this->Mod_bahan_baku->cek_satuan($nama_satuan_baru);
        if($cek->num_rows() > 0){
            echo "satuan sudah ada..!!";
        }
        else {
            echo 1;
                        
            $save  = array(
                'nama_satuan'     => $nama_satuan_baru,        
            );
                        
            $this->Mod_bahan_baku->insert_satuan("t_satuan", $save);  
        }                 
    }

    function edit_satuan(){
        $kode_satuan = $this->input->post('kode_satuan');
        $nama_satuan_lama = $this->input->post('nama_satuan_lama');
        $nama_satuan_baru = $this->input->post('nama_satuan_baru');

        $cek = $this->Mod_bahan_baku->cek_satuan($nama_satuan_baru);
    
        if($nama_satuan_lama == $nama_satuan_baru){
            echo 1;
                            
            $save  = array( 
                'kode_satuan'     => $kode_satuan,
                'nama_satuan'     => $nama_satuan_baru  
            );
                        
            $this->Mod_bahan_baku->update_satuan($kode_satuan, $save);   
        } else{
            if($cek->num_rows() > 0){
                echo "satuan sudah ada..!!";
            }
            else {
                echo 1;
                            
                $save  = array(
                    'nama_satuan'     => $nama_satuan_baru,        
                );
                            
                $this->Mod_bahan_baku->update_satuan($kode_satuan, $save);    
            }                 
        }    
        
    }

    function hapus_satuan(){
        $kode_satuan = $this->input->post('kode_satuan');
        $this->Mod_bahan_baku->delete_satuan($kode_satuan, 't_satuan');
    } 
}

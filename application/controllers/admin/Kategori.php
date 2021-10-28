<?php 
defined('BASEPATH') || exit('No direct script access allowed');

require APPPATH . '/libraries/BaseControllerBackend.php';

class Kategori extends BaseControllerBackend {

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
            $this->global['pageTitle'] = "Data Kategori";

            $this->loadViews("backend/admin/kategori/body",$this->global,NULL,"backend/admin/kategori/footer");
        }  
        else{ 
            redirect('login');
        }  
    }

    function load_data_kategori(){
        $data['kategori'] = $this->Mod_bahan_baku->get_all_kategori();
        $this->load->view('backend/admin/kategori/load_kategori', $data);
    }

    function form_tambah_kategori(){
        $this->load->view("backend/admin/kategori/form_tambah_kategori", NULL);
    }

    function form_edit_kategori(){
        $kode_kategori = $this->input->post('kode_kategori');
		$data['edit'] = $this->Mod_bahan_baku->get_kategori($kode_kategori);
        $this->load->view("backend/admin/kategori/form_edit_kategori", $data);
    }

    function tambah_kategori(){ 
        $nama_kategori_baru = $this->input->post('nama_kategori_baru');
        
        $cek = $this->Mod_bahan_baku->cek_kategori($nama_kategori_baru);
        if($cek->num_rows() > 0){
            echo "Kategori sudah ada..!!";
        }
        else {
            echo 1;
                        
            $save  = array(
                'nama_kategori'     => $nama_kategori_baru,        
            );
                        
            $this->Mod_bahan_baku->insert_kategori("t_kategori", $save);  
        }                 
    }

    function edit_kategori(){
        $kode_kategori = $this->input->post('kode_kategori');
        $nama_kategori_lama = $this->input->post('nama_kategori_lama');
        $nama_kategori_baru = $this->input->post('nama_kategori_baru');

        $cek = $this->Mod_bahan_baku->cek_kategori($nama_kategori_baru);
    
        if($nama_kategori_lama == $nama_kategori_baru){
            echo 1;
                            
            $save  = array( 
                'kode_kategori'     => $kode_kategori,
                'nama_kategori'     => $nama_kategori_baru  
            );
                        
            $this->Mod_bahan_baku->update_kategori($kode_kategori, $save);   
        } else{
            if($cek->num_rows() > 0){
                echo "Kategori sudah ada..!!";
            }
            else {
                echo 1;
                            
                $save  = array(
                    'nama_kategori'     => $nama_kategori_baru,        
                );
                            
                $this->Mod_bahan_baku->update_kategori($kode_kategori, $save);    
            }                 
        }    
        
    }

    function hapus_kategori(){
        $kode_kategori = $this->input->post('kode_kategori');
        $this->Mod_bahan_baku->delete_kategori($kode_kategori, 't_kategori');
    } 
}

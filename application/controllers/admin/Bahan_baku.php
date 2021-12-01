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
        $nik_karyawan = $this->session->userdata('ses_nik_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses');  

        if($nik_karyawan != null && $hak_akses == 'Admin'){
            $this->global['pageTitle'] = "Data Bahan Baku";

            $this->loadViews("backend/admin/bahan_baku/body",$this->global,NULL,"backend/admin/bahan_baku/footer");
        }
        else{ 
            redirect('login');
        }  
    }

    function load_data_bahan_baku(){
        $data['bahan_baku'] = $this->Mod_bahan_baku->get_all_bahan_baku();
        $this->load->view('backend/admin/bahan_baku/load_bahan_baku', $data);
    }
    
    function form_tambah_bahan_baku(){
        $data['kategori'] = $this->Mod_bahan_baku->get_all_kategori();
        $data['satuan'] = $this->Mod_bahan_baku->get_all_satuan();
        $data['supplier'] = $this->Mod_supplier->get_all_supplier();
        $this->load->view("backend/admin/bahan_baku/form_tambah_bahan_baku", $data);
    }

    function form_edit_bahan_baku(){
        $kode_bb = $this->input->post('kode_bb');
        $data['kategori'] = $this->Mod_bahan_baku->get_all_kategori();
        $data['satuan'] = $this->Mod_bahan_baku->get_all_satuan();
        $data['supplier'] = $this->Mod_supplier->get_all_supplier();
		$data['edit'] = $this->Mod_bahan_baku->get_bahan_baku($kode_bb);
		$this->load->view("backend/admin/bahan_baku/form_edit_bahan_baku", $data);
    }
    
    function tambah_bahan_baku(){ 
        $kode_bb_baru = $this->input->post('kode_bb_baru');
        $id_supplier = $this->input->post('id_supplier');
        $kode_kategori = $this->input->post('kode_kategori');
        $kode_satuan = $this->input->post('kode_satuan');
        $nama_bb_baru = $this->input->post('nama_bb_baru');
        $harga_bb = 0;
        $stok_gudang_pab_bb = 0;
        $stok_limit_pab_bb = $this->input->post('stok_limit_pab_bb');
        $status_penawaran_bb = $this->input->post('status_penawaran_bb');

        $cek_kode = $this->Mod_bahan_baku->get_bahan_baku($kode_bb_baru);
        $cek_nama = $this->Mod_bahan_baku->cek_bahan_baku($nama_bb_baru);

        if($cek_kode->num_rows() > 0){
            echo "Kode sudah digunakan";
        }elseif($cek_nama->num_rows() > 0){
                echo "Nama sudah digunakan";
        }else{          
            echo 1;
            $save  = array(
                'kode_bb'               => $kode_bb_baru,
                'id_supplier'           => $id_supplier,
                'kode_kategori'         => $kode_kategori,
                'kode_satuan'           => $kode_satuan,
                'nama_bb'               => $nama_bb_baru,
                'harga_bb'              => $harga_bb,
                'stok_gudang_pab_bb'    => $stok_gudang_pab_bb,
                'stok_limit_pab_bb'     => $stok_limit_pab_bb,
                'status_penawaran_bb'   => $status_penawaran_bb            
            );
                        
            $this->Mod_bahan_baku->insert_bahan_baku("t_bahan_baku", $save);  
        }                 
    
    }

    function edit_bahan_baku(){
        $kode_bb_lama = $this->input->post('kode_bb_lama');
        $kode_bb_baru = $this->input->post('kode_bb_baru');
        $id_supplier = $this->input->post('id_supplier');
        $kode_kategori = $this->input->post('kode_kategori');
        $kode_satuan = $this->input->post('kode_satuan');
        $nama_bb_lama = $this->input->post('nama_bb_lama');
        $nama_bb_baru = $this->input->post('nama_bb_baru');
        $stok_limit_pab_bb = $this->input->post('stok_limit_pab_bb');

        $cek_kode = $this->Mod_bahan_baku->get_bahan_baku($kode_bb_baru);
        $cek_nama = $this->Mod_bahan_baku->cek_bahan_baku($nama_bb_baru);
    
        if($kode_bb_lama == $kode_bb_baru && $nama_bb_lama == $nama_bb_baru){
            echo 1;
            $save  = array( 
                'kode_bb'               => $kode_bb_baru,
                'id_supplier'           => $id_supplier,
                'kode_kategori'         => $kode_kategori,
                'kode_satuan'           => $kode_satuan,
                'nama_bb'               => $nama_bb_baru,
                'stok_limit_pab_bb'     => $stok_limit_pab_bb    
            );
                        
            $this->Mod_bahan_baku->update_bahan_baku($kode_bb_lama, $save);   
        }
        elseif($kode_bb_lama != $kode_bb_baru) {
            if($cek_kode->num_rows() > 0){
                echo "Kode sudah digunakan";
            }else{ 
                echo 1;
                $save  = array( 
                    'kode_bb'               => $kode_bb_baru,
                    'id_supplier'           => $id_supplier,
                    'kode_kategori'         => $kode_kategori,
                    'kode_satuan'           => $kode_satuan,
                    'nama_bb'               => $nama_bb_baru,
                    'stok_limit_pab_bb'     => $stok_limit_pab_bb   
                );     
                $this->Mod_bahan_baku->update_bahan_baku($kode_bb_lama, $save);   
            }          
        }elseif($nama_bb_lama != $nama_bb_baru) {
            if($cek_nama->num_rows() > 0){
                echo "Nama sudah digunakan";
            }else{ 
                echo 1;
                $save  = array( 
                    'kode_bb'               => $kode_bb_baru,
                    'id_supplier'           => $id_supplier,
                    'kode_kategori'         => $kode_kategori,
                    'kode_satuan'           => $kode_satuan,
                    'nama_bb'               => $nama_bb_baru,
                    'stok_limit_pab_bb'     => $stok_limit_pab_bb   
                );     
                $this->Mod_bahan_baku->update_bahan_baku($kode_bb_lama, $save);   
            }          
        }
    }

    function hapus_bahan_baku(){
        $kode_bb = $this->input->post('kode_bb');
        $this->Mod_bahan_baku->delete_bahan_baku($kode_bb, 't_bahan_baku');
    } 
    
}

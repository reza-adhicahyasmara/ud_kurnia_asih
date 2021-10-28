<?php 
defined('BASEPATH') || exit('No direct script access allowed');

require APPPATH . '/libraries/BaseControllerBackend.php';

class Supplier extends BaseControllerBackend {

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
            $this->global['pageTitle'] = "Supplier";

            $this->loadViews("backend/admin/supplier/body",$this->global,NULL,"backend/admin/supplier/footer");
        }
        else{ 
            redirect('login');
        }  
    }

    function load_data_supplier(){
        $data['supplier'] = $this->Mod_supplier->get_all_supplier();
        $this->load->view('backend/admin/supplier/load_supplier', $data);
    }
    
    function form_tambah_supplier(){
        $this->load->view("backend/admin/supplier/form_tambah_supplier", NULL);
    }

    function form_edit_supplier(){
        $id_supplier = $this->input->post('id_supplier');
		$data['edit'] = $this->Mod_supplier->get_supplier($id_supplier);
		$this->load->view("backend/admin/supplier/form_edit_supplier", $data);
    }
    
    function tambah_supplier(){ 
        $nama_supplier = $this->input->post('nama_supplier');
        $pic_supplier = $this->input->post('pic_supplier');
        $kontak_supplier = $this->input->post('kontak_supplier');
        $alamat_supplier = $this->input->post('alamat_supplier');
        $foto_supplier = $this->input->post('foto_supplier');
        $username_supplier_baru = $this->input->post('username_supplier_baru');
        $password_supplier = $this->input->post('password_supplier');
        $id_supplier = md5($nama_supplier).date('Ymd');

        $cek_supplier = $this->Mod_supplier->cek_user_supplier($username_supplier_baru);

        if($cek_supplier->num_rows() > 0){
            echo "Username sudah digunakan";
        }else{          
            echo 1;
            $save  = array(
                'id_supplier'           => $id_supplier,
                'nama_supplier'         => $nama_supplier,
                'pic_supplier'          => $pic_supplier,
                'kontak_supplier'       => $kontak_supplier,
                'alamat_supplier'       => $alamat_supplier,
                'foto_supplier'         => $foto_supplier,
                'username_supplier'     => $username_supplier_baru,
                'password_supplier'     => $password_supplier            
            );
                        
            $this->Mod_supplier->insert_supplier("t_supplier", $save);  
        }                 
    
    }

    function edit_supplier(){
        $id_supplier = $this->input->post('id_supplier');
        $nama_supplier = $this->input->post('nama_supplier');
        $pic_supplier = $this->input->post('pic_supplier');
        $kontak_supplier = $this->input->post('kontak_supplier');
        $alamat_supplier = $this->input->post('alamat_supplier');
        $foto_supplier = $this->input->post('foto_supplier');
        $username_supplier_lama = $this->input->post('username_supplier_lama');
        $username_supplier_baru = $this->input->post('username_supplier_baru');
        $password_supplier = $this->input->post('password_supplier');
        
        $cek_supplier = $this->Mod_supplier->cek_user_supplier($username_supplier_baru);
    
        if($username_supplier_lama == $username_supplier_baru){
            echo 1;
            $save  = array( 
                'id_supplier'           => $id_supplier,
                'nama_supplier'         => $nama_supplier,
                'pic_supplier'          => $pic_supplier,
                'kontak_supplier'       => $kontak_supplier,
                'alamat_supplier'       => $alamat_supplier,
                'foto_supplier'         => $foto_supplier,
                'username_supplier'     => $username_supplier_baru,
                'password_supplier'     => $password_supplier  
            );
                        
            $this->Mod_supplier->update_supplier($id_supplier, $save);   
        }
        else {
            if($cek_supplier->num_rows() > 0){
                echo "Username sudah digunakan";
            }else{  
                echo 1;
                $save  = array( 
                    'id_supplier'           => $id_supplier,
                    'nama_supplier'         => $nama_supplier,
                    'pic_supplier'          => $pic_supplier,
                    'kontak_supplier'       => $kontak_supplier,
                    'alamat_supplier'       => $alamat_supplier,
                    'foto_supplier'         => $foto_supplier,
                    'username_supplier'     => $username_supplier_baru,
                    'password_supplier'     => $password_supplier  
                );     
                $this->Mod_supplier->update_supplier($id_supplier, $save);   
            }          
        }
    }

    function hapus_supplier(){
        $id_supplier = $this->input->post('id_supplier');
        $g = $this->Mod_supplier->get_gambar($id_supplier)->row_array();
        unlink('assets/img/supplier/'.$g['foto_supplier']);
        $this->Mod_supplier->delete_supplier($id_supplier, 't_supplier');
    } 
    
    function simpan_foto(){
        $nama_supplier = slug($this->input->post('nama_supplier'));
		$config['upload_path']   = './assets/img/supplier/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
        $config['max_size']	     = '3000';
        $config['max_width']     = '4000';
        $config['max_height']    = '3908';
		$config['file_name']     = $nama_supplier; 

        $this->upload->initialize($config);

		if ( ! $this->upload->do_upload('file')){   
            echo "Ukuran maksimal 3 Mb";
		} else {
			$haha = $this->upload->data();
			$image = $haha['file_name'];

			$config['image_library'] = 'gd2';
			$config['source_image'] = './assets/img/supplier/'.$image;
			$config['maintain_ratio'] = TRUE;
            $config['width'] = 500;

			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			echo $image;
		}
    }

    function hapus_foto(){
        $foto_supplier = $this->input->post('foto_supplier');
        unlink('assets/img/supplier/'.$foto_supplier);
        echo 1;
    }

}

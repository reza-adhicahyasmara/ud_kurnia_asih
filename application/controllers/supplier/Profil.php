<?php 
defined('BASEPATH') || exit('No direct script access allowed');

require APPPATH . '/libraries/BaseControllerBackend.php';

class Profil extends BaseControllerBackend {

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
            $this->global['pageTitle'] = "Profil Saya";
 
		    $data['edit'] = $this->Mod_supplier->get_supplier($id_supplier);

            $this->loadViews("backend/supplier/profil/body_profil",$this->global,$data,"backend/supplier/profil/footer");
        } 
        else{ 
            redirect('login');
        }   
    }

    function ubah_password(){
        $id_supplier = $this->session->userdata('ses_id_supplier');   
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_supplier != null && $hak_akses == 'Supplier'){
            $this->global['pageTitle'] = "Ubah Password";
 
		    $data['edit'] = $this->Mod_supplier->get_supplier($id_supplier);

            $this->loadViews("backend/supplier/profil/body_password",$this->global,$data,"backend/supplier/profil/footer");
        }  
        else{ 
            redirect('login');
        }   
    }

    function edit_supplier(){
        $id_supplier = $this->input->post('id_supplier');
        $pic_supplier = $this->input->post('pic_supplier');
        $alamat_supplier = $this->input->post('alamat_supplier');
        $kontak_supplier = $this->input->post('kontak_supplier');
        $foto_supplier = $this->input->post('foto_supplier');
    
        echo 1;
                        
        $save  = array( 
            'id_supplier'           => $id_supplier,
            'pic_supplier'          => $pic_supplier,
            'alamat_supplier'       => $alamat_supplier,
            'kontak_supplier'       => $kontak_supplier,
            'foto_supplier'         => $foto_supplier
        );
                    
        $this->Mod_supplier->update_supplier($id_supplier, $save);             
        
    }
    
    function reset_password(){
        $nikuser = $this->input->post('username_supplier');
        $id_supplier = $this->input->post('id_supplier');
        $password = $this->input->post('password_lama');
        $password_baru_1 = $this->input->post('password_baru_1');
        $password_baru_2 = $this->input->post('password_baru_2');

        $cek_password = $this->Mod_supplier->auth_supplier($nikuser, $password);
        if($cek_password->num_rows() > 0){

            echo 1;
            $save  = array(
                'id_supplier'              => $nikuser,
                'password_supplier'        => $password_baru_2
            );    
            $this->Mod_supplier->update_supplier($id_supplier, $save);

        } else {
            
            echo "Password lama salah..!";
        }
    }
    
    function simpan_foto(){
        $pic_supplier = slug($this->input->post('pic_supplier'));
		$config['upload_path']   = './assets/img/supplier/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
        $config['max_size']	     = '3000';
        $config['max_width']     = '4000';
        $config['max_height']    = '3908';
		$config['file_name']     = $pic_supplier; 

        $this->upload->initialize($config);

		if ( ! $this->upload->do_upload('file')){   
            $error = array('error' => $this->upload->display_errors());
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
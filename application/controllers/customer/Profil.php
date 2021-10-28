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
        $id_customer = $this->session->userdata('ses_id_customer');   
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_customer != null && $hak_akses == 'Customer'){
            $this->global['pageTitle'] = "Profil Saya";
 
		    $data['edit'] = $this->Mod_customer->get_customer($id_customer);

            $this->loadViews("backend/customer/profil/body_profil",$this->global,$data,"backend/customer/profil/footer");
        } 
        else{ 
            redirect('login');
        }   
    }

    function ubah_password(){
        $id_customer = $this->session->userdata('ses_id_customer');   
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_customer != null && $hak_akses == 'Customer'){
            $this->global['pageTitle'] = "Ubah Password";
 
		    $data['edit'] = $this->Mod_customer->get_customer($id_customer);

            $this->loadViews("backend/customer/profil/body_password",$this->global,$data,"backend/customer/profil/footer");
        }  
        else{ 
            redirect('login');
        }   
    }

    function edit_customer(){
        $id_customer = $this->input->post('id_customer');
        $pic_customer = $this->input->post('pic_customer');
        $alamat_customer = $this->input->post('alamat_customer');
        $kontak_customer = $this->input->post('kontak_customer');
        $foto_customer = $this->input->post('foto_customer');
    
        echo 1;
                        
        $save  = array( 
            'id_customer'           => $id_customer,
            'pic_customer'          => $pic_customer,
            'alamat_customer'       => $alamat_customer,
            'kontak_customer'       => $kontak_customer,
            'foto_customer'         => $foto_customer
        );
                    
        $this->Mod_customer->update_customer($id_customer, $save);             
        
    }
    
    function reset_password(){
        $nikuser = $this->input->post('username_customer');
        $id_customer = $this->input->post('id_customer');
        $password = $this->input->post('password_lama');
        $password_baru_1 = $this->input->post('password_baru_1');
        $password_baru_2 = $this->input->post('password_baru_2');

        $cek_password = $this->Mod_customer->auth_customer($nikuser, $password);
        if($cek_password->num_rows() > 0){

            echo 1;
            $save  = array(
                'id_customer'              => $nikuser,
                'password_customer'        => $password_baru_2
            );    
            $this->Mod_customer->update_customer($id_customer, $save);

        } else {
            
            echo "Password lama salah..!";
        }
    }
    
    function simpan_foto(){
        $pic_customer = slug($this->input->post('pic_customer'));
		$config['upload_path']   = './assets/img/customer/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
        $config['max_size']	     = '3000';
        $config['max_width']     = '4000';
        $config['max_height']    = '3908';
		$config['file_name']     = $pic_customer; 

        $this->upload->initialize($config);

		if ( ! $this->upload->do_upload('file')){   
            $error = array('error' => $this->upload->display_errors());
		} else {
			$haha = $this->upload->data();
			$image = $haha['file_name'];

			$config['image_library'] = 'gd2';
			$config['source_image'] = './assets/img/customer/'.$image;
			$config['maintain_ratio'] = TRUE;
            $config['width'] = 500;

			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			echo $image;
		}
    }

    function hapus_foto(){
        $foto_customer = $this->input->post('foto_customer');
        unlink('assets/img/customer/'.$foto_customer);
        echo 1;
    }

}
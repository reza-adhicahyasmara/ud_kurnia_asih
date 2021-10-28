<?php 
defined('BASEPATH') || exit('No direct script access allowed');

require APPPATH . '/libraries/BaseControllerBackend.php';

class Profil_karyawan extends BaseControllerBackend {

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

        if($nik_karyawan != null && $hak_akses == 'Admin' || $nik_karyawan != null && $hak_akses == 'Gudang' || $nik_karyawan != null && $hak_akses == 'Pimpinan'){
            $this->global['pageTitle'] = "Profil Saya";
 
		    $data['edit'] = $this->Mod_karyawan->get_karyawan($nik_karyawan);

            $this->loadViews("backend/profil/body_profil",$this->global,$data,"backend/profil/footer");
        } 
        else{ 
            redirect('login');
        }   
    }

    function ubah_password(){
        $nik_karyawan = $this->session->userdata('ses_nik_karyawan');   
        $hak_akses = $this->session->userdata('ses_akses');  

        if($nik_karyawan != null && $hak_akses == 'Admin' || $nik_karyawan != null && $hak_akses == 'Gudang' || $nik_karyawan != null && $hak_akses == 'Pimpinan'){
            $this->global['pageTitle'] = "Ubah Password";
 
		    $data['edit'] = $this->Mod_karyawan->get_karyawan($nik_karyawan);

            $this->loadViews("backend/profil/body_password",$this->global,$data,"backend/profil/footer");
        }  
        else{ 
            redirect('login');
        }   
    }

    function edit_karyawan(){
        $nik_karyawan = $this->input->post('nik_karyawan');
        $nama_karyawan = $this->input->post('nama_karyawan');
        $alamat_karyawan = $this->input->post('alamat_karyawan');
        $kontak_karyawan = $this->input->post('kontak_karyawan');
        $username_karyawan = $this->input->post('username_karyawan');
        $foto_karyawan = $this->input->post('foto_karyawan');
    
        echo 1;
                        
        $save  = array( 
            'nik_karyawan'          => $nik_karyawan,
            'nama_karyawan'         => $nama_karyawan,
            'alamat_karyawan'       => $alamat_karyawan,
            'kontak_karyawan'       => $kontak_karyawan,
            'username_karyawan'     => $username_karyawan,
            'foto_karyawan'         => $foto_karyawan
        );
                    
        $this->Mod_karyawan->update_karyawan($nik_karyawan, $save);             
        
    }
    
    function reset_password(){
        $username = $this->session->userdata('ses_username_karyawan');  
        $nik_karyawan = $this->input->post('nik_karyawan');
        $password = $this->input->post('password_lama');
        $password_baru_1 = $this->input->post('password_baru_1');
        $password_baru_2 = $this->input->post('password_baru_2');

        $cek_password = $this->Mod_karyawan->auth_karyawan($username, $password);
        if($cek_password->num_rows() > 0){

            echo 1;
            $save  = array(
                'username_karyawan'              => $username,
                'password_karyawan'         => $password_baru_2
            );    
            $this->Mod_karyawan->update_karyawan($nik_karyawan, $save);

        } else {
            
            echo "Password lama salah..!";
        }
    }
    
    function simpan_foto(){
        $nama_karyawan = slug($this->input->post('nama_karyawan'));
		$config['upload_path']   = './assets/img/karyawan/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
        $config['max_size']	     = '3000';
        $config['max_width']     = '4000';
        $config['max_height']    = '3908';
		$config['file_name']     = $nama_karyawan; 

        $this->upload->initialize($config);

		if ( ! $this->upload->do_upload('file')){   
            $error = array('error' => $this->upload->display_errors());
		} else {
			$haha = $this->upload->data();
			$image = $haha['file_name'];

			$config['image_library'] = 'gd2';
			$config['source_image'] = './assets/img/karyawan/'.$image;
			$config['maintain_ratio'] = TRUE;
            $config['width'] = 500;

			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			echo $image;
		}
    }

    function hapus_foto(){
        $foto_karyawan = $this->input->post('foto_karyawan');
        unlink('assets/img/karyawan/'.$foto_karyawan);
        echo 1;
    }

}
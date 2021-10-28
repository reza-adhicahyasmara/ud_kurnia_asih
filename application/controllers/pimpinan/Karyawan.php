<?php 
defined('BASEPATH') || exit('No direct script access allowed');

require APPPATH . '/libraries/BaseControllerBackend.php';

class Karyawan extends BaseControllerBackend {

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

        if($nik_karyawan != null && $hak_akses == 'Pimpinan'){
            $this->global['pageTitle'] = "Karyawan";

            $this->loadViews("backend/pimpinan/karyawan/body",$this->global,NULL,"backend/pimpinan/karyawan/footer");
        }
        else{ 
            redirect('login');
        }  
    }

    function load_data_admin(){
        $data['admin'] = $this->Mod_karyawan->get_all_karyawan();
        $this->load->view('backend/pimpinan/karyawan/load_admin', $data);
    }

    function load_data_gudang(){
        $data['gudang'] = $this->Mod_karyawan->get_all_karyawan();
        $this->load->view('backend/pimpinan/karyawan/load_gudang', $data);
    }

    function load_data_pimpinan(){
        $data['pimpinan'] = $this->Mod_karyawan->get_all_karyawan();
        $this->load->view('backend/pimpinan/karyawan/load_pimpinan', $data);
    }
    
    function form_tambah_karyawan(){
        $this->load->view("backend/pimpinan/karyawan/form_tambah_karyawan", NULL);
    }

    function form_edit_karyawan(){
        $nik_karyawan = $this->input->post('nik_karyawan');
		$data['edit'] = $this->Mod_karyawan->get_karyawan($nik_karyawan);
		$this->load->view("backend/pimpinan/karyawan/form_edit_karyawan", $data);
    }

    function tambah_karyawan(){ 
        $nik_karyawan = $this->input->post('nik_karyawan');
        $level_karyawan = $this->input->post('level_karyawan');
        $nama_karyawan = $this->input->post('nama_karyawan');
        $alamat_karyawan = $this->input->post('alamat_karyawan');
        $kontak_karyawan = $this->input->post('kontak_karyawan');
        $foto_karyawan = $this->input->post('foto_karyawan');
        $username_karyawan_baru = $this->input->post('username_karyawan_baru');
        $password_karyawan = $this->input->post('password_karyawan');
    
        $cek_nik = $this->Mod_karyawan->get_karyawan($nik_karyawan);
        $cek_username = $this->Mod_karyawan->get_karyawan_username($username_karyawan_baru);
        if($cek_nik->num_rows() > 0){
            echo "NIK sudak ada..!!";
        }
        elseif($cek_username->num_rows() > 0){
            echo "Username sudah ada..!!";
        }
        else{
            echo 1;
                        
            $save  = array(
                'nik_karyawan'          => $nik_karyawan,
                'level_karyawan'        => $level_karyawan,
                'nama_karyawan'         => $nama_karyawan,
                'alamat_karyawan'       => $alamat_karyawan,
                'kontak_karyawan'       => $kontak_karyawan,
                'foto_karyawan'         => $foto_karyawan,
                'username_karyawan'     => $username_karyawan_baru,
                'password_karyawan'     => $password_karyawan             
            );
                        
            $this->Mod_karyawan->insert_karyawan("t_karyawan", $save);                   
        }
    }

    function edit_karyawan(){
        $nik_karyawan = $this->input->post('nik_karyawan');
        $level_karyawan = $this->input->post('level_karyawan');
        $nama_karyawan = $this->input->post('nama_karyawan');
        $alamat_karyawan = $this->input->post('alamat_karyawan');
        $kontak_karyawan = $this->input->post('kontak_karyawan');
        $foto_karyawan = $this->input->post('foto_karyawan');
        $username_karyawan_baru = $this->input->post('username_karyawan_baru');
        $username_karyawan_lama = $this->input->post('username_karyawan_lama');
        $password_karyawan = $this->input->post('password_karyawan');
    
        $cek_username = $this->Mod_karyawan->get_karyawan_username($username_karyawan_baru);

        if($username_karyawan_lama == $username_karyawan_baru){
               
            echo 1;         
            $save  = array( 
                'nik_karyawan'          => $nik_karyawan,
                'level_karyawan'        => $level_karyawan,
                'nama_karyawan'         => $nama_karyawan,
                'alamat_karyawan'       => $alamat_karyawan,
                'kontak_karyawan'       => $kontak_karyawan,
                'foto_karyawan'         => $foto_karyawan,
                'username_karyawan'     => $username_karyawan_baru,
                'password_karyawan'     => $password_karyawan       
            );
                        
            $this->Mod_karyawan->update_karyawan($nik_karyawan, $save);             
        }
        else{
            if($cek_username->num_rows() > 0){
                echo "Username sudah ada..!!";
            }
            else{
                echo 1;         
                $save  = array( 
                    'nik_karyawan'          => $nik_karyawan,
                    'level_karyawan'        => $level_karyawan,
                    'nama_karyawan'         => $nama_karyawan,
                    'alamat_karyawan'       => $alamat_karyawan,
                    'kontak_karyawan'       => $kontak_karyawan,
                    'foto_karyawan'         => $foto_karyawan,
                    'username_karyawan'     => $username_karyawan_baru,
                    'password_karyawan'     => $password_karyawan       
                );
                            
                $this->Mod_karyawan->update_karyawan($nik_karyawan, $save); 
            }
        }
    }

    function hapus_karyawan(){
        $nik_karyawan = $this->input->post('nik_karyawan');
        $foto_karyawan = $this->input->post('foto_karyawan');
        unlink('assets/img/karyawan/'.$foto_karyawan);
        $this->Mod_karyawan->delete_karyawan($nik_karyawan, 't_karyawan');
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

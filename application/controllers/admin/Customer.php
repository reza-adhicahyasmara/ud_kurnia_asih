<?php 
defined('BASEPATH') || exit('No direct script access allowed');

require APPPATH . '/libraries/BaseControllerBackend.php';

class Customer extends BaseControllerBackend {

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
            $this->global['pageTitle'] = "Customer";

            $this->loadViews("backend/admin/customer/body",$this->global,NULL,"backend/admin/customer/footer");
        }
        else{ 
            redirect('login');
        }  
    }

    function load_data_customer(){
        $data['customer'] = $this->Mod_customer->get_all_customer();
        $this->load->view('backend/admin/customer/load_customer', $data);
    }
    
    function form_tambah_customer(){
        $this->load->view("backend/admin/customer/form_tambah_customer", NULL);
    }

    function form_edit_customer($id_customer){
		$data['edit'] = $this->Mod_customer->get_customer($id_customer);
		$this->load->view("backend/admin/customer/form_edit_customer", $data);
    }
    
    function tambah_customer(){ 
        $nama_customer = $this->input->post('nama_customer');
        $pic_customer = $this->input->post('pic_customer');
        $kontak_customer = $this->input->post('kontak_customer');
        $alamat_customer = $this->input->post('alamat_customer');
        $foto_customer = $this->input->post('foto_customer');
        $username_customer_baru = $this->input->post('username_customer_baru');
        $password_customer = $this->input->post('password_customer');
        $id_customer = md5($nama_customer).date('Ymd');

        $cek_customer = $this->Mod_customer->cek_user_customer($username_customer_baru);

        if($cek_customer->num_rows() > 0){
            echo "Username sudah digunakan";
        }else{          
            echo 1;
            $save  = array(
                'id_customer'           => $id_customer,
                'nama_customer'         => $nama_customer,
                'pic_customer'          => $pic_customer,
                'kontak_customer'       => $kontak_customer,
                'alamat_customer'       => $alamat_customer,
                'foto_customer'         => $foto_customer,
                'username_customer'     => $username_customer_baru,
                'password_customer'     => $password_customer            
            );
                        
            $this->Mod_customer->insert_customer("t_customer", $save);  
        }                 
    
    }

    function edit_customer(){
        $id_customer = $this->input->post('id_customer');
        $nama_customer = $this->input->post('nama_customer');
        $pic_customer = $this->input->post('pic_customer');
        $kontak_customer = $this->input->post('kontak_customer');
        $alamat_customer = $this->input->post('alamat_customer');
        $foto_customer = $this->input->post('foto_customer');
        $username_customer_lama = $this->input->post('username_customer_lama');
        $username_customer_baru = $this->input->post('username_customer_baru');
        $password_customer = $this->input->post('password_customer');
        
        $cek_customer = $this->Mod_customer->cek_user_customer($username_customer_baru);
    
        if($username_customer_lama == $username_customer_baru){
            echo 1;
            $save  = array( 
                'id_customer'           => $id_customer,
                'nama_customer'         => $nama_customer,
                'pic_customer'          => $pic_customer,
                'kontak_customer'       => $kontak_customer,
                'alamat_customer'       => $alamat_customer,
                'foto_customer'         => $foto_customer,
                'username_customer'     => $username_customer_baru,
                'password_customer'     => $password_customer  
            );
                        
            $this->Mod_customer->update_customer($id_customer, $save);   
        }
        else {
            if($cek_customer->num_rows() > 0){
                echo "Username sudah digunakan";
            }else{  
                echo 1;
                $save  = array( 
                    'id_customer'           => $id_customer,
                    'nama_customer'         => $nama_customer,
                    'pic_customer'          => $pic_customer,
                    'kontak_customer'       => $kontak_customer,
                    'alamat_customer'       => $alamat_customer,
                    'foto_customer'         => $foto_customer,
                    'username_customer'     => $username_customer_baru,
                    'password_customer'     => $password_customer  
                );     
                $this->Mod_customer->update_customer($id_customer, $save);   
            }          
        }
    }

    function hapus_customer(){
        $id_customer = $this->input->post('id_customer');
        $g = $this->Mod_customer->get_gambar($id_customer)->row_array();
        unlink('assets/img/customer/'.$g['foto_customer']);
        $this->Mod_customer->delete_customer($id_customer, 't_customer');
    } 
    
    function simpan_foto(){
        $nama_customer = slug($this->input->post('nama_customer'));
		$config['upload_path']   = './assets/img/customer/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
        $config['max_size']	     = '3000';
        $config['max_width']     = '4000';
        $config['max_height']    = '3908';
		$config['file_name']     = $nama_customer; 

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

<?php 
defined('BASEPATH') || exit('No direct script access allowed');

require APPPATH . '/libraries/BaseControllerBackend.php';

class Produk extends BaseControllerBackend {

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
            $this->global['pageTitle'] = "Data Produk";

            $this->loadViews("backend/admin/produk/body",$this->global,NULL,"backend/admin/produk/footer");
        }
        else{ 
            redirect('login');
        }  
    }

    function load_data_produk(){
        $data['produk'] = $this->Mod_produk->get_all_produk();
        $this->load->view('backend/admin/produk/load_produk', $data);
    }
    
    function form_tambah_produk(){
        $data['kategori'] = $this->Mod_bahan_baku->get_all_kategori();
        $data['satuan'] = $this->Mod_bahan_baku->get_all_satuan();
        $this->load->view("backend/admin/produk/form_tambah_produk", $data);
    }

    function form_edit_produk($kode_produk){
        $data['kategori'] = $this->Mod_bahan_baku->get_all_kategori();
        $data['satuan'] = $this->Mod_bahan_baku->get_all_satuan();
		$data['edit'] = $this->Mod_produk->get_produk($kode_produk);
		$this->load->view("backend/admin/produk/form_edit_produk", $data);
    }
    
    function tambah_produk(){ 
        $kode_produk_baru = $this->input->post('kode_produk_baru');
        $kode_kategori = $this->input->post('kode_kategori');
        $kode_satuan = $this->input->post('kode_satuan');
        $nama_produk_baru = $this->input->post('nama_produk_baru');
        $harga_produk = $this->input->post('harga_produk');
        $stok_gudang_produk = 0;
        $stok_limit_produk = $this->input->post('stok_limit_produk');
        $gambar_produk = $this->input->post('gambar_produk');

        $cek_kode = $this->Mod_produk->get_produk($kode_produk_baru);
        $cek_nama = $this->Mod_produk->cek_produk($nama_produk_baru);

        if($cek_kode->num_rows() > 0){
            echo "Kode sudah digunakan";
        }elseif($cek_nama->num_rows() > 0){
                echo "Nama sudah digunakan";
        }else{          
            echo 1;
            $save  = array(
                'kode_produk'           => $kode_produk_baru,
                'kode_kategori'         => $kode_kategori,
                'kode_satuan'           => $kode_satuan,
                'nama_produk'           => $nama_produk_baru,
                'harga_produk'          => $harga_produk,
                'stok_gudang_produk'    => $stok_gudang_produk,
                'stok_limit_produk'     => $stok_limit_produk,   
                'gambar_produk'         => $gambar_produk         
            );
                        
            $this->Mod_produk->insert_produk("t_produk", $save);  
        }                 
    
    }

    function edit_produk(){
        $kode_produk_lama = $this->input->post('kode_produk_lama');
        $kode_produk_baru = $this->input->post('kode_produk_baru');
        $kode_kategori = $this->input->post('kode_kategori');
        $kode_satuan = $this->input->post('kode_satuan');
        $nama_produk_lama = $this->input->post('nama_produk_lama');
        $nama_produk_baru = $this->input->post('nama_produk_baru');
        $harga_produk = $this->input->post('harga_produk');
        $stok_limit_produk = $this->input->post('stok_limit_produk');
        $gambar_produk = $this->input->post('gambar_produk');

        $cek_kode = $this->Mod_produk->get_produk($kode_produk_baru);
        $cek_nama = $this->Mod_produk->cek_produk($nama_produk_baru);
    
        if($kode_produk_lama == $kode_produk_baru && $nama_produk_lama == $nama_produk_baru){
            echo 1;
            $save  = array( 
                'kode_produk'           => $kode_produk_baru,
                'kode_kategori'         => $kode_kategori,
                'kode_satuan'           => $kode_satuan,
                'nama_produk'           => $nama_produk_baru,
                'harga_produk'          => $harga_produk,
                'stok_limit_produk'     => $stok_limit_produk,   
                'gambar_produk'         => $gambar_produk    
            );
                        
            $this->Mod_produk->update_produk($kode_produk_lama, $save);   
        }
        elseif($kode_produk_lama != $kode_produk_baru) {
            if($cek_kode->num_rows() > 0){
                echo "Kode sudah digunakan";
            }else{ 
                echo 1;
                $save  = array( 
                    'kode_produk'           => $kode_produk_baru,
                    'kode_kategori'         => $kode_kategori,
                    'kode_satuan'           => $kode_satuan,
                    'nama_produk'           => $nama_produk_baru,
                    'harga_produk'          => $harga_produk,
                    'stok_limit_produk'     => $stok_limit_produk,   
                    'gambar_produk'         => $gambar_produk   
                );     
                $this->Mod_produk->update_produk($kode_produk_lama, $save);   
            }          
        }elseif($nama_produk_lama != $nama_produk_baru) {
            if($cek_nama->num_rows() > 0){
                echo "Nama sudah digunakan";
            }else{ 
                echo 1;
                $save  = array( 
                    'kode_produk'           => $kode_produk_baru,
                    'kode_kategori'         => $kode_kategori,
                    'kode_satuan'           => $kode_satuan,
                    'nama_produk'           => $nama_produk_baru,
                    'harga_produk'          => $harga_produk,
                    'stok_limit_produk'     => $stok_limit_produk,   
                    'gambar_produk'         => $gambar_produk    
                );     
                $this->Mod_produk->update_produk($kode_produk_lama, $save);   
            }          
        }
    }

    function hapus_produk(){
        $kode_produk = $this->input->post('kode_produk');
        $g = $this->Mod_produk->get_gambar($kode_produk)->row_array();
        unlink('assets/img/produk/'.$g['gambar_produk']);
        $this->Mod_produk->delete_produk($kode_produk, 't_produk');
    } 
    
    function simpan_foto(){
        $nama_produk = slug($this->input->post('nama_produk'));
		$config['upload_path']   = './assets/img/produk/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
        $config['max_size']	     = '3000';
        $config['max_width']     = '4000';
        $config['max_height']    = '3908';
		$config['file_name']     = $nama_produk; 

        $this->upload->initialize($config);

		if ( ! $this->upload->do_upload('file')){   
            $error = array('error' => $this->upload->display_errors());
		} else {
			$haha = $this->upload->data();
			$image = $haha['file_name'];

			$config['image_library'] = 'gd2';
			$config['source_image'] = './assets/img/produk/'.$image;
			$config['maintain_ratio'] = TRUE;
            $config['width'] = 500;

			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			echo $image;
		}
    }

    function hapus_foto(){
        $gambar = $this->input->post('gambar');
        unlink('assets/img/produk/'.$gambar);
        echo 1;
    }
    
}

<?php 
defined('BASEPATH') || exit('No direct script access allowed');

require APPPATH . '/libraries/BaseControllerBackend.php';

class Penyesuaian_produk extends BaseControllerBackend {

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

        if($nik_karyawan != null && $hak_akses == 'Gudang'){
            $this->global['pageTitle'] = "Data Penyesuaian Stok Produk";

            $this->loadViews("backend/gudang/penyesuaian_produk/body",$this->global,NULL,"backend/gudang/penyesuaian_produk/footer");
        }
        else{ 
            redirect('login');
        }  
    }

    function load_data_penyesuaian_produk(){
        $data['penyesuaian_produk'] = $this->Mod_produk->get_all_penyesuaian_produk();
        $this->load->view('backend/gudang/penyesuaian_produk/load_penyesuaian_produk', $data);
    }
    
    function form_tambah_penyesuaian_produk(){
        $data['produk'] = $this->Mod_produk->get_all_produk();
        $this->load->view("backend/gudang/penyesuaian_produk/form_tambah_penyesuaian_produk",$data);
    }
    
    function tambah_penyesuaian_produk(){ 
        $kode_produk = $this->input->post('kode_produk');
        $jumlah_penyesuaian_produk = $this->input->post('jumlah_penyesuaian_produk');
        $stok_gudang_produk_lama = $this->input->post('stok_gudang_produk');
        $tanggal_penyesuaian_produk = $this->input->post('tanggal_penyesuaian_produk');
        $keterangan_penyesuaian_produk = $this->input->post('keterangan_penyesuaian_produk');
        $gambar_penyesuaian_produk = $this->input->post('gambar_penyesuaian_produk');
        
        $kode_penyesuaian_produk = "PSP-".$kode_produk."-".date("YmdHis", strtotime($tanggal_penyesuaian_produk));

        echo 1;
        $save  = array(
            'kode_penyesuaian_produk'          => $kode_penyesuaian_produk,
            'kode_produk'                      => $kode_produk,
            'jumlah_penyesuaian_produk'        => $jumlah_penyesuaian_produk,
            'tanggal_penyesuaian_produk'       => $tanggal_penyesuaian_produk,
            'keterangan_penyesuaian_produk'    => $keterangan_penyesuaian_produk,
            'gambar_penyesuaian_produk'        => $gambar_penyesuaian_produk            
        );
                    
        $this->Mod_produk->insert_penyesuaian_produk("t_penyesuaian_produk", $save);             
        
        
        $stok_gudang_produk = $stok_gudang_produk_lama + $jumlah_penyesuaian_produk;

        $data2  = array(
            'kode_produk'          => $kode_produk,
            'stok_gudang_produk'   => $stok_gudang_produk       
        );
                    
        $this->Mod_produk->update_produk($kode_produk, $data2);      
    
    }

    function hapus_penyesuaian_produk(){
        $kode_penyesuaian_produk = $this->input->post('kode_penyesuaian_produk');
        $jumlah_penyesuaian_produk = $this->input->post('jumlah_penyesuaian_produk');
        $kode_produk = $this->input->post('kode_produk');
        $stok_gudang_produk_lama = $this->input->post('stok_gudang_produk');
        $g = $this->Mod_produk->get_penyesuaian_produk($kode_penyesuaian_produk)->row_array();
        unlink('assets/img/produk/'.$g['gambar_penyesuaian_produk']);
        $this->Mod_produk->delete_penyesuaian_produk($kode_penyesuaian_produk, 't_penyesuaian_produk');


        $stok_gudang_produk = $stok_gudang_produk_lama - $jumlah_penyesuaian_produk;

        $data2  = array(
            'kode_produk'          => $kode_produk,
            'stok_gudang_produk'   => $stok_gudang_produk       
        );
                    
        $this->Mod_produk->update_produk($kode_produk, $data2);
    } 
    
    function simpan_foto(){
        $tanggal_penyesuaian_produk = slug($this->input->post('tanggal_penyesuaian_produk'));
		$config['upload_path']   = './assets/img/produk/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
        $config['max_size']	     = '3000';
        $config['max_width']     = '4000';
        $config['max_height']    = '3908';
		$config['file_name']     = $tanggal_penyesuaian_produk; 

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
        $gambar_penyesuaian_produk = $this->input->post('gambar_penyesuaian_produk');
        unlink('assets/img/produk/'.$gambar_penyesuaian_produk);
        echo 1;
    }
    
}

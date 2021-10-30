<?php 
defined('BASEPATH') || exit('No direct script access allowed');

require APPPATH . '/libraries/BaseControllerBackend.php';

class Penyesuaian_stok_bahan_baku extends BaseControllerBackend {

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
            $this->global['pageTitle'] = "Data Penyesuaian Stok Bahan Baku";

            $this->loadViews("backend/gudang/penyesuaian_bb/body",$this->global,NULL,"backend/gudang/penyesuaian_bb/footer");
        }
        else{ 
            redirect('login');
        }  
    }

    function load_data_penyesuaian_bb(){
        $data['penyesuaian_bb'] = $this->Mod_bahan_baku->get_all_penyesuaian_bb();
        $this->load->view('backend/gudang/penyesuaian_bb/load_penyesuaian_bb', $data);
    }
    
    function form_tambah_penyesuaian_stok_bahan_baku(){
        $data['bahan_baku'] = $this->Mod_bahan_baku->get_all_bahan_baku();
        $this->load->view("backend/gudang/penyesuaian_bb/form_tambah_penyesuaian_bb",$data);
    }
    
    function tambah_penyesuaian_bb(){ 
        $kode_bb = $this->input->post('kode_bb');
        $jumlah_penyesuaian_bb = $this->input->post('jumlah_penyesuaian_bb');
        $stok_gudang_pab_bb_lama = $this->input->post('stok_gudang_pab_bb');
        $tanggal_penyesuaian_bb = $this->input->post('tanggal_penyesuaian_bb');
        $keterangan_penyesuaian_bb = $this->input->post('keterangan_penyesuaian_bb');
        $gambar_penyesuaian_bb = $this->input->post('gambar_penyesuaian_bb');
        
        $kode_penyesuaian_bb = "PSBB-".$kode_bb."-".date("YmdHis", strtotime($tanggal_penyesuaian_bb));

        echo 1;
        $save  = array(
            'kode_penyesuaian_bb'      => $kode_penyesuaian_bb,
            'kode_bb'                       => $kode_bb,
            'jumlah_penyesuaian_bb'         => $jumlah_penyesuaian_bb,
            'tanggal_penyesuaian_bb'        => $tanggal_penyesuaian_bb,
            'keterangan_penyesuaian_bb'     => $keterangan_penyesuaian_bb,
            'gambar_penyesuaian_bb'         => $gambar_penyesuaian_bb            
        );
                    
        $this->Mod_bahan_baku->insert_penyesuaian_bb("t_penyesuaian_bb", $save);             
        
        
        $stok_gudang_pab_bb = $stok_gudang_pab_bb_lama + $jumlah_penyesuaian_bb;

        $data2  = array(
            'kode_bb'               => $kode_bb,
            'stok_gudang_pab_bb'    => $stok_gudang_pab_bb       
        );
                    
        $this->Mod_bahan_baku->update_bahan_baku($kode_bb, $data2);      
    
    }

    function hapus_penyesuaian_bb(){
        $kode_penyesuaian_bb = $this->input->post('kode_penyesuaian_bb');
        $jumlah_penyesuaian_bb = $this->input->post('jumlah_penyesuaian_bb');
        $kode_bb = $this->input->post('kode_bb');
        $stok_gudang_pab_bb_lama = $this->input->post('stok_gudang_pab_bb');
        $g = $this->Mod_bahan_baku->get_penyesuaian_bb($kode_penyesuaian_bb)->row_array();
        unlink('assets/img/bahan_baku/'.$g['gambar_penyesuaian_bb']);
        $this->Mod_bahan_baku->delete_penyesuaian_bb($kode_penyesuaian_bb, 't_penyesuaian_bb');


        $stok_gudang_pab_bb = $stok_gudang_pab_bb_lama - $jumlah_penyesuaian_bb;

        $data2  = array(
            'kode_bb'               => $kode_bb,
            'stok_gudang_pab_bb'    => $stok_gudang_pab_bb       
        );
                    
        $this->Mod_bahan_baku->update_bahan_baku($kode_bb, $data2);
    } 
    
    function simpan_foto(){
        $tanggal_penyesuaian_bb = slug($this->input->post('tanggal_penyesuaian_bb'));
		$config['upload_path']   = './assets/img/bahan_baku/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
        $config['max_size']	     = '3000';
        $config['max_width']     = '4000';
        $config['max_height']    = '3908';
		$config['file_name']     = $tanggal_penyesuaian_bb; 

        $this->upload->initialize($config);

		if ( ! $this->upload->do_upload('file')){   
            $error = array('error' => $this->upload->display_errors());
		} else {
			$haha = $this->upload->data();
			$image = $haha['file_name'];

			$config['image_library'] = 'gd2';
			$config['source_image'] = './assets/img/bahan_baku/'.$image;
			$config['maintain_ratio'] = TRUE;
            $config['width'] = 500;

			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			echo $image;
		}
    }

    function hapus_foto(){
        $gambar_penyesuaian_bb = $this->input->post('gambar_penyesuaian_bb');
        unlink('assets/img/bahan_baku/'.$gambar_penyesuaian_bb);
        echo 1;
    }
    
}

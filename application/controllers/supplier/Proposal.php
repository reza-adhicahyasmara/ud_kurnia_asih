<?php 
defined('BASEPATH') || exit('No direct script access allowed');

require APPPATH . '/libraries/BaseControllerBackend.php';

class Proposal extends BaseControllerBackend {

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
            $this->global['pageTitle'] = "Data Proposal";

            $data['penawaran'] = $this->Mod_proposal->get_all_proposal_supplier();
            $this->loadViews("backend/supplier/proposal/body",$this->global,$data,"backend/supplier/proposal/footer");
        }  
        else{ 
            redirect('login');
        }  
    }

    function load_data_penawaran(){
        $id_supplier = $this->session->userdata('ses_id_supplier');  
        $data['penawaran'] = $this->Mod_proposal->get_proposal_supplier($id_supplier);
        $this->load->view('backend/supplier/proposal/load_penawaran', $data);
    }

    function load_data_permintaan(){
        $data['permintaan'] = $this->Mod_proposal->get_all_proposal_supplier();
        $this->load->view('backend/supplier/proposal/load_permintaan', $data);
    }

    function form_tambah_proposal(){
        $data['kategori'] = $this->Mod_bahan_baku->get_all_kategori();
        $data['satuan'] = $this->Mod_bahan_baku->get_all_satuan();
        $this->load->view("backend/supplier/proposal/form_tambah_penawaran", $data);
    }
    
    function view_pdf_proposal(){
        $aaa = explode("|",$this->input->post('aaa'));
        
        $data['berkas_proposal'] = $aaa[1];
        $this->load->view('backend/supplier/proposal/view_pdf', $data);
    }

    function view_pdf_permintaan(){
        $aaa = explode("|",$this->input->post('aaa'));
        
        $data['berkas_proposal'] = $aaa[1];
        $this->load->view('backend/supplier/proposal/view_pdf', $data);
    }

    function tambah_proposal(){  
        
        $id_supplier = $this->session->userdata('ses_id_supplier'); 
        $tanggal_proposal = date("Y-m-d h:i:s");
        $judul_proposal = $this->input->post('judul_proposal');
        $berkas_proposal = $this->input->post('berkas_proposal');
        $status_proposal = 1;
        $kode_proposal = md5($tanggal_proposal);

        if($judul_proposal == ""){
            echo "Judul propasl harus diisi"; 
        }elseif($berkas_proposal == ""){
            echo "Berkas proposal harus diisi";
        }else{
            echo 1;
                        
            $save  = array(
                'kode_proposal'            => $kode_proposal,
                'tanggal_proposal'         => $tanggal_proposal,
                'id'                       => $id_supplier,  
                'judul_proposal'           => $judul_proposal,  
                'berkas_proposal'          => $berkas_proposal,  
                'status_proposal'          => $status_proposal
            );
                        
            $this->Mod_proposal->insert_proposal("t_proposal", $save);                   
        }

        $item = $this->Mod_bahan_baku->get_all_bahan_baku()->result();

        foreach($item as $row){
            if($row->kode_proposal == "" && $row->status_penawaran_bb == "Penawaran"){
                $kode_bb = $row->kode_bb;
                
                $data = array(
                    'kode_bb'           => $kode_bb,
                    'kode_proposal'     => $kode_proposal
                );
                
                $this->Mod_bahan_baku->update_bahan_baku($kode_bb, $data); 
            }
        }
    }

    function hapus_proposal(){
        $kode_proposal = $this->input->post('kode_proposal');
        $berkas_proposal = $this->input->post('berkas_proposal');
        unlink('assets/berkas/'.$berkas_proposal);
        $this->Mod_proposal->delete_proposal($kode_proposal, 't_proposal');
        $this->Mod_bahan_baku->delete_all_bahan_baku($kode_proposal, 't_bahan_baku');
    } 

    function save_pdf(){
        $nama_berkas = slug($this->input->post('nama_berkas'));
		$config['upload_path']   = './assets/berkas';
        $config['allowed_types'] = 'pdf'; //mencegah upload backdor
        $config['max_size']	     = '3000';
        $config['max_width']     = '4000';
        $config['max_height']    = '3908';
		$config['file_name']     = $nama_berkas; 

        $this->upload->initialize($config);

		if ( ! $this->upload->do_upload('file')){   
            $error = array('error' => $this->upload->display_errors());
		} else {
			$haha = $this->upload->data();
			$image = $haha['file_name'];

			$config['image_library'] = 'gd2';
			$config['source_image'] = './assets/berkas'.$image;
			$config['maintain_ratio'] = TRUE;
            $config['width'] = 500;

			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			echo $image;
		}
    }



    //LIST BAHAN BAKU PENAWARAN
    function load_data_bahan_baku(){
        $data['bahan_baku'] = $this->Mod_bahan_baku->get_all_bahan_baku();
        $this->load->view('backend/supplier/proposal/load_bahan_baku', $data);
    }

    function tambah_bahan_baku(){ 
        $kode_bb_baru = $this->input->post('kode_bb_baru');
        $id_supplier = $this->session->userdata('ses_id_supplier');   
        $kode_kategori = $this->input->post('kode_kategori');
        $kode_satuan = $this->input->post('kode_satuan');
        $nama_bb_baru = $this->input->post('nama_bb_baru');
        $harga_bb = $this->input->post('harga_bb');
        $stok_gudang_pab_bb = 0;
        $stok_limit_pab_bb = $this->input->post('stok_limit_pab_bb');
        $status_penawaran_bb = "Penawaran";

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

    function hapus_bahan_baku(){
        $kode_bb = $this->input->post('kode_bb');
        $this->Mod_bahan_baku->delete_bahan_baku($kode_bb, 't_bahan_baku');
    } 
}

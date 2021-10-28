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
        $this->load->view("backend/supplier/proposal/form_tambah_penawaran", NULL);
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

        echo 1;
                    
        $save  = array(
            'tanggal_proposal'         => $tanggal_proposal,
            'id'                       => $id_supplier,  
            'judul_proposal'           => $judul_proposal,  
            'berkas_proposal'          => $berkas_proposal,  
            'status_proposal'          => $status_proposal
        );
                    
        $this->Mod_proposal->insert_proposal("t_proposal", $save);                   
    }

    function hapus_proposal(){
        $kode_proposal = $this->input->post('kode_proposal');
        $berkas_proposal = $this->input->post('berkas_proposal');
        unlink('assets/berkas/'.$berkas_proposal);
        $this->Mod_proposal->delete_proposal($kode_proposal, 't_proposal');
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
}

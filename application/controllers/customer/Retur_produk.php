<?php 
defined('BASEPATH') || exit('No direct script access allowed');

require APPPATH . '/libraries/BaseControllerBackend.php';

class Retur_produk extends BaseControllerBackend {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mod_bahan_baku');
        $this->load->model('Mod_bank');
        $this->load->model('Mod_customer');
        $this->load->model('Mod_karyawan');
        $this->load->model('Mod_proposal');
        $this->load->model('Mod_produk');
        $this->load->model('Mod_customer');
    }

    function index() {
        $id_customer = $this->session->userdata('ses_id_customer');   
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_customer != null && $hak_akses == 'Customer'){
            $this->global['pageTitle'] = "Data Retur Bahan Baku";

            $data['data_retur'] = $this->Mod_produk->get_retur_produk_customer($id_customer);
            $data['data_produk'] = $this->Mod_produk->get_all_produk();
            $this->loadViews("backend/customer/retur_produk/body",$this->global,$data,"backend/customer/retur_produk/footer");
        }  
        else{ 
            redirect('login');
        }   
    }

    function detail($kode_retur_produk){
        $id_customer = $this->session->userdata('ses_id_customer');   
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_customer != null && $hak_akses == 'Customer'){
            $this->global['pageTitle'] = "Detail Pemesanan Toko";
            
            $data['data_detail'] = $this->Mod_produk->get_retur_produk($kode_retur_produk);
            $data['list_produk'] = $this->Mod_produk->get_item_retur_produk($kode_retur_produk);

            $this->loadViews("backend/customer/retur_produk/body_detail",$this->global,$data,"backend/customer/retur_produk/footer");
        }
        else{ 
            redirect('login');
        }   
    }

    function invoice($kode_retur_produk){
        $id_customer = $this->session->userdata('ses_id_customer');  
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_customer != null && $hak_akses == 'Customer'){
            $this->global['pageTitle'] = "Invoice";
            
            $data['data_detail'] = $this->Mod_produk->get_retur_produk($kode_retur_produk);
            $data['list_produk'] = $this->Mod_produk->get_item_retur_produk($kode_retur_produk);

            $this->loadViews("backend/customer/retur_produk/body_invoice",$this->global,$data,"backend/customer/retur_produk/footer_invoice");
        }
        else{ 
            redirect('login');
        }  
    }

    function load_data_item_retur_produk(){
        $data['tmp'] = $this->Mod_produk->get_all_item_retur_produk();
        $this->load->view('backend/customer/retur_produk/load_data_item_retur_produk', $data);
    }

    function form_tambah(){
        $kode_produk = $this->input->post('kode_produk');
        $data['data'] = $this->Mod_produk->get_produk($kode_produk);
        $this->load->view("backend/customer/retur_produk/form_tambah", $data);
    }

    function insert_item_retur_produk(){
        $id_customer = $this->session->userdata('ses_id_customer');  
        $kode_produk = $this->input->post('kode_produk');
        $jumlah_iretur_produk = $this->input->post('jumlah_iretur_produk');
        $keterangan_iretur_produk = $this->input->post('keterangan_iretur_produk');
        $gambar_iretur_produk = $this->input->post('gambar_iretur_produk');
        $status_iretur_produk = 1;

        $cek_item1 = $this->Mod_produk->cek_item_retur_produk_customer($id_customer, $kode_produk);

        if($cek_item1->num_rows() > 0){ 
            echo "Produk sudah ada";
        }else{
                echo 1;
                $save  = array( 
                    'id_customer'                   => $id_customer,
                    'kode_produk'                   => $kode_produk,
                    'jumlah_iretur_produk'          => $jumlah_iretur_produk,
                    'keterangan_iretur_produk'      => $keterangan_iretur_produk,
                    'gambar_iretur_produk'          => $gambar_iretur_produk,
                    'status_iretur_produk'          => $status_iretur_produk
                );
                $this->Mod_produk->insert_item_retur_produk("t_iretur_produk", $save);  
            }
        
    }

    function delete_item_retur_produk(){
        $kode_iretur_produk = $this->input->post('kode_iretur_produk');
        $gambar_iretur_produk = $this->input->post('gambar_iretur_produk');

        unlink('assets/img/retur_produk/'.$gambar_iretur_produk);
        $this->Mod_produk->delete_item_retur_produk($kode_iretur_produk, 't_iretur_produk');
    } 

    function insert_retur_produk(){
        $id_customer = $this->session->userdata('ses_id_customer');  
        $tanggal_retur_produk = date('Y-m-d H:m:s');
        $kode_retur_produk = 'RETPRO-'.date('YmdHms').'-'.$id_customer;
        $status_retur_produk = '1';

        $cek_item2 = $this->Mod_produk->cek_item_retur_produk_customer($id_customer);
        
        if($id_customer == ""){
            echo "customer tidak boleh kosong";
        }else{
            if($cek_item2->num_rows() > 0){ 
                echo 1;         
                $save  = array( 
                    'kode_retur_produk'         => $kode_retur_produk,
                    'id_customer'               => $id_customer,
                    'tanggal_retur_produk'      => $tanggal_retur_produk,
                    'status_retur_produk'       => $status_retur_produk
                );
                            
                $this->Mod_produk->insert_retur_produk("t_retur_produk", $save);        
                
                $item = $this->Mod_produk->get_all_item_retur_produk()->result();

                foreach($item as $row){
                    if($row->kode_retur_produk == ""){
                        $kode_iretur_produk = $row->kode_iretur_produk;
                        
                        $data = array(
                            'kode_iretur_produk'        => $kode_iretur_produk,
                            'kode_retur_produk'         => $kode_retur_produk,
                            'status_iretur_produk'      => '2'
                        );
                        
                        $this->Mod_produk->update_item_retur_produk($kode_iretur_produk, $data); 
                    }
                }
            }
            else {
                echo "customer tidak sesuai";
            }
        }
    }

    function update_retur_produk(){
        $kode_retur_produk = $this->input->post('kode_retur_produk');
        $status_retur_produk = $this->input->post('status_retur_produk');

        echo 1;         
        $save  = array( 
            'kode_retur_produk'     => $kode_retur_produk,
            'status_retur_produk'   => $status_retur_produk
        );
                    
        $this->Mod_produk->update_retur_produk($kode_retur_produk, $save);         
    }

       
    function save_image(){
        $nama_retur = slug($this->input->post('nama_retur'));
		$config['upload_path']   = './assets/img/retur_produk';
        $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
        $config['max_size']	     = '3000';
        $config['max_width']     = '4000';
        $config['max_height']    = '3908';
		$config['file_name']     = $nama_retur; 

        $this->upload->initialize($config);

		if ( ! $this->upload->do_upload('file')){   
            $error = array('error' => $this->upload->display_errors());
		} else {
			$haha = $this->upload->data();
			$image = $haha['file_name'];

			$config['image_library'] = 'gd2';
			$config['source_image'] = './assets/img/retur_produk'.$image;
			$config['maintain_ratio'] = TRUE;
            $config['width'] = 500;

			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			echo $image;
		}
    }

    function delete_image(){
        $gambar_iretur_produk = $this->input->post('gambar_iretur_produk');
        unlink('assets/img/retur_produk'.$gambar_iretur_produk);
        echo 1;
    }

}
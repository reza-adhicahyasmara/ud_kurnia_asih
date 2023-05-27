<?php 
defined('BASEPATH') || exit('No direct script access allowed');

require APPPATH . '/libraries/BaseControllerBackend.php';

class Pemesanan_produk extends BaseControllerBackend {

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
        $id_customer = $this->session->userdata('ses_id_customer');  
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_customer != null && $hak_akses == 'Customer'){
            $this->global['pageTitle'] = "Pemesanan Produk";

            $data['data_produk'] = $this->Mod_produk->get_all_produk();
            $data['data_pemesanan'] = $this->Mod_produk->get_pemesanan_produk_customer($id_customer);
            $this->loadViews("backend/customer/pemesanan_produk/body",$this->global,$data,"backend/customer/pemesanan_produk/footer");
        }  
        else{ 
            redirect('login');
        }  
    }

    function detail($kode_pemesanan_produk){
        $id_customer = $this->session->userdata('ses_id_customer');  
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_customer != null && $hak_akses == 'Customer'){
            $this->global['pageTitle'] = "Detail Pemesanan Produk";
            
            $data['data_detail'] = $this->Mod_produk->get_pemesanan_produk($kode_pemesanan_produk);

            $this->loadViews("backend/customer/pemesanan_produk/body_detail",$this->global,$data,"backend/customer/pemesanan_produk/footer_detail");
        }
        else{ 
            redirect('login');
        }  
    }

    function invoice($kode_pemesanan_produk){
        $id_customer = $this->session->userdata('ses_id_customer');  
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_customer != null && $hak_akses == 'Customer'){
            $this->global['pageTitle'] = "Invoice";
            
            $data['data_detail'] = $this->Mod_produk->get_pemesanan_produk($kode_pemesanan_produk);

            $this->loadViews("backend/customer/pemesanan_produk/body_invoice",$this->global,$data,"backend/customer/pemesanan_produk/footer_invoice");
        }
        else{ 
            redirect('login');
        }  

    }


    // PEMESANAN ITEM
    function load_data_item_produk(){
        $data['tmp'] = $this->Mod_produk->get_all_item_pemesanan_produk();
        $this->load->view('backend/customer/pemesanan_produk/load_data_item_produk', $data);
    }

    function form_tambah(){
        $kode_produk = $this->input->post('kode_produk');
        $data['data'] = $this->Mod_produk->get_produk($kode_produk);
        $this->load->view("backend/customer/pemesanan_produk/form_tambah", $data);
    }

    function insert_item_pemesanan_produk(){
        $id_customer = $this->session->userdata('ses_id_customer');  
        $kode_produk = $this->input->post('kode_produk');
        $jumlah_ipemesanan_produk = $this->input->post('jumlah_ipemesanan_produk');
        $harga_ipemesanan_produk = $this->input->post('harga_ipemesanan_produk');
        $stok_gudang_produk = $this->input->post('stok_gudang_produk');
        $subtotal_ipemesanan_produk = $jumlah_ipemesanan_produk * $harga_ipemesanan_produk;
        $status_ipemesanan_produk = 1;

        $cek_item1 = $this->Mod_produk->cek_item_pemesanan_produk($kode_produk);
        $cek_item2 = $this->Mod_produk->cek_item_pemesanan_produk_customer($id_customer);
        

        if($cek_item1->num_rows() > 0){ 
            echo "Produk sudah ada";
        }else if($harga_ipemesanan_produk == 0){
            echo "Harga tidak tercantum, konfirmasi terlebih dahulu kepada supplier";
        }else if($kode_produk == ""){
            echo "Produk tidak boleh kosong";
        }else if($jumlah_ipemesanan_produk == 0){
            echo "Jumlah item tidak boleh kosong";
        }else if($jumlah_ipemesanan_produk > $stok_gudang_produk){
            echo "Jumlah item melebihi stok gudang";
        }else{
            if($cek_item2->num_rows() > 0){ 
                echo 1;         
                $save  = array( 
                    'kode_produk'                   => $kode_produk,
                    'id_customer'               => $id_customer,
                    'jumlah_ipemesanan_produk'      => $jumlah_ipemesanan_produk,
                    'harga_ipemesanan_produk'       => $harga_ipemesanan_produk,
                    'subtotal_ipemesanan_produk'    => $subtotal_ipemesanan_produk,
                    'status_ipemesanan_produk'      => $status_ipemesanan_produk
                );
                
                $this->Mod_produk->insert_item_pemesanan_produk("t_ipemesanan_produk", $save);  
            }else{ //jika data ksong
                echo 1;
                $save  = array( 
                    'kode_produk'                       => $kode_produk,
                    'id_customer'                   => $id_customer,
                    'jumlah_ipemesanan_produk'          => $jumlah_ipemesanan_produk,
                    'harga_ipemesanan_produk'           => $harga_ipemesanan_produk,
                    'subtotal_ipemesanan_produk'        => $subtotal_ipemesanan_produk,
                    'status_ipemesanan_produk'          => $status_ipemesanan_produk
                );
                
                $this->Mod_produk->insert_item_pemesanan_produk("t_ipemesanan_produk", $save);  
            }
        }
    }

    function delete_item_pemesanan_produk(){
        $kode_ipemesanan_produk = $this->input->post('kode_ipemesanan_produk');
        $this->Mod_produk->delete_item_pemesanan_produk($kode_ipemesanan_produk, 't_ipemesanan_produk');
    } 

    //PEMESANAN
    function form_checkout(){
        $id_customer = $this->session->userdata('ses_id_customer');  
        $data['total_belanja'] = $this->input->post('total_belanja');
        $data['total_berat'] = $this->input->post('total_berat');
		$data['data_customer'] = $this->Mod_customer->get_customer($id_customer);
		$data['data_rekening'] = $this->Mod_bank->get_rekening_pab();
        $this->load->view("backend/customer/pemesanan_produk/form_checkout", $data);
    }

    function insert_pemesanan_produk(){
        $id_customer = $this->session->userdata('ses_id_customer');  
        $kode_rekening = $this->input->post('kode_rekening');
        $tanggal_pemesanan_produk = date('Y-m-d H:m:s');
        $total_pby_pemesanan_produk = $this->input->post('total_pby_pemesanan_produk');
        $kode_pemesanan_produk = 'INV-'.date('YmdHms').'-'.$id_customer;
        $status_pemesanan_produk = '1';
        $status_pby_pemesanan_produk = '1';

        $cek_item2 = $this->Mod_produk->cek_item_pemesanan_produk_customer($id_customer);
        if($kode_rekening == ""){
            echo "Kode bank tidak boleh kosong";
        }else{
            if($cek_item2->num_rows() > 0){ 
                echo 1;         
                $save  = array( 
                    'kode_pemesanan_produk'         => $kode_pemesanan_produk,
                    'id_customer'                   => $id_customer,
                    'kode_rekening'                 => $kode_rekening,
                    'tanggal_pemesanan_produk'      => $tanggal_pemesanan_produk,
                    'total_pby_pemesanan_produk'    => $total_pby_pemesanan_produk,
                    'status_pby_pemesanan_produk'   => $status_pby_pemesanan_produk,
                    'status_pemesanan_produk'       => $status_pemesanan_produk
                );
                            
                $this->Mod_produk->insert_pemesanan_produk("t_pemesanan_produk", $save);        
                
                $item = $this->Mod_produk->get_all_item_pemesanan_produk()->result();

                foreach($item as $row){
                    if($row->kode_pemesanan_produk == ""){
                        $kode_ipemesanan_produk = $row->kode_ipemesanan_produk;
                        
                        $data = array(
                            'kode_ipemesanan_produk'    => $kode_ipemesanan_produk,
                            'kode_pemesanan_produk'     => $kode_pemesanan_produk,
                            'status_ipemesanan_produk'  => '2'
                        );
                        
                        $this->Mod_produk->update_item_pemesanan_produk($kode_ipemesanan_produk, $data); 
                    }
                }
            }
            else {
                echo "Supplier tidak sesuai";
            }
        }
    }

    //STATUS PBY PENERIMAAN & RETUR
    function load_data_item_pemesanan_produk(){
        $kode_pemesanan_produk = $this->input->post('kode_pemesanan_produk');
        $data['total_pby_pemesanan_produk'] = $this->input->post('total_pby_pemesanan_produk');
        $data['status_pemesanan_produk'] = $this->input->post('status_pemesanan_produk');
        $data['list_produk'] = $this->Mod_produk->get_item_pemesanan_produk($kode_pemesanan_produk);
        $this->load->view('backend/customer/pemesanan_produk/load_data_item_pemesanan_produk', $data);
    }

    function update_pemesanan_produk(){
        $kode_pemesanan_produk = $this->input->post('kode_pemesanan_produk');
        $bukti_pby_pemesanan_produk = $this->input->post('bukti_pby_pemesanan_produk');
        $status_pemesanan_produk = $this->input->post('status_pemesanan_produk');
        $status_pby_pemesanan_produk = $this->input->post('status_pby_pemesanan_produk');

        echo 1;         
        $save  = array( 
            'kode_pemesanan_produk'         => $kode_pemesanan_produk,
            'bukti_pby_pemesanan_produk'    => $bukti_pby_pemesanan_produk,
            'status_pemesanan_produk'       => $status_pemesanan_produk,
            'status_pby_pemesanan_produk'   => $status_pby_pemesanan_produk
        );
                    
        $this->Mod_produk->update_pemesanan_produk($kode_pemesanan_produk, $save);        

    }

    function update_status_item_produk(){
        $kode_ipemesanan_produk = $this->input->post('kode_ipemesanan_produk');
        $jumlah_ipemesanan_produk = $this->input->post('jumlah_ipemesanan_produk');
        $jumlah_retur_ipemesanan_produk = $this->input->post('jumlah_retur_ipemesanan_produk');
        $keterangan_retur_ipemesanan_produk = $this->input->post('keterangan_retur_ipemesanan_produk');
        $status_ipemesanan_produk = $this->input->post('status_ipemesanan_produk');
        
        if($status_ipemesanan_produk == 5){
            if($jumlah_ipemesanan_produk < $jumlah_retur_ipemesanan_produk){
                echo "Jumlah melebihi yang dipesan";
            }else{
                echo 1;         
                $save  = array( 
                    'kode_ipemesanan_produk'                => $kode_ipemesanan_produk,
                    'jumlah_retur_ipemesanan_produk'        => $jumlah_retur_ipemesanan_produk,
                    'keterangan_retur_ipemesanan_produk'    => $keterangan_retur_ipemesanan_produk,
                    'status_ipemesanan_produk'              => $status_ipemesanan_produk
                );
                            
                $this->Mod_produk->update_item_pemesanan_produk($kode_ipemesanan_produk, $save); 
            }
        }else{
            echo 1;         
            $save  = array( 
                'kode_ipemesanan_produk'                => $kode_ipemesanan_produk,
                'jumlah_retur_ipemesanan_produk'        => $jumlah_retur_ipemesanan_produk,
                'keterangan_retur_ipemesanan_produk'    => $keterangan_retur_ipemesanan_produk,
                'status_ipemesanan_produk'              => $status_ipemesanan_produk
            );
                        
            $this->Mod_produk->update_item_pemesanan_produk($kode_ipemesanan_produk, $save); 
        }
    }

    
    function update_status_pemesanan_produk(){
        $kode_pemesanan_produk = $this->input->post('kode_pemesanan_produk');
        $status_pemesanan_produk = $this->input->post('status_pemesanan_produk');
        $tanggal_masuk = date("Y-m-d H:m:s");

        $cek_retur_item = $this->Mod_produk->cek_item_retur($kode_pemesanan_produk);
        $cek_kirim_item = $this->Mod_produk->cek_item_kirim($kode_pemesanan_produk);

        if($status_pemesanan_produk == 5){
            if($cek_retur_item->num_rows() > 0){
                echo "Pastikan semua item diterima dengan kondisi baik";
            }elseif($cek_kirim_item->num_rows() > 0){
                echo "Pastikan item sudah diproses";
            }else{
                echo 1;         
                $save  = array( 
                    'kode_pemesanan_produk'                => $kode_pemesanan_produk,
                    'tanggal_terima_pemesanan_produk'      => $tanggal_masuk,
                    'status_pemesanan_produk'              => $status_pemesanan_produk
                );
                            
                $this->Mod_produk->update_pemesanan_produk($kode_pemesanan_produk, $save); 

                $item = $this->Mod_produk->get_item_pemesanan_produk($kode_pemesanan_produk)->result();

                foreach($item as $row){
                    $kode_ipemesanan_produk = $row->kode_ipemesanan_produk;
                   
                    $data_update_status[] = array(
                        "kode_ipemesanan_produk" => $kode_ipemesanan_produk,
                        "status_ipemesanan_produk" => '6',
                        "tanggal_masuk_ipemesanan_produk" =>  $tanggal_masuk
                    );
        
                    $this->db->update_batch("t_ipemesanan_produk",$data_update_status,"kode_ipemesanan_produk");
                }
            }
        }else if($status_pemesanan_produk == 7){
            if($cek_retur_item->num_rows() > 0){
                echo 1;         
                $save  = array( 
                    'kode_pemesanan_produk'                => $kode_pemesanan_produk,
                    'status_pemesanan_produk'              => $status_pemesanan_produk
                );
                            
                $this->Mod_produk->update_pemesanan_produk($kode_pemesanan_produk, $save); 
            }elseif($cek_kirim_item->num_rows() > 0){
                echo "Pastikan item sudah diproses";
            }else{
                echo "Pastikan salah satu item diretur";
            }  
        }
    }

    function save_image(){
        $kode_pemesanan_produk = slug($this->input->post('kode_pemesanan_produk'));
		$config['upload_path']   = './assets/img/pemesanan_produk/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
        $config['max_size']	     = '3000';
        $config['max_width']     = '4000';
        $config['max_height']    = '3908';
		$config['file_name']     = $kode_pemesanan_produk; 

        $this->upload->initialize($config);

		if ( ! $this->upload->do_upload('file')){   
            $error = array('error' => $this->upload->display_errors());
		} else {
			$haha = $this->upload->data();
			$image = $haha['file_name'];

			$config['image_library'] = 'gd2';
			$config['source_image'] = './assets/img/pemesanan_produk/'.$image;
			$config['maintain_ratio'] = TRUE;
            $config['width'] = 500;

			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			echo $image;
		}
    }

    function delete_image(){
        $bukti_pby_pemesanan_produk = $this->input->post('bukti_pby_pemesanan_produk');
        unlink('assets/img/pemesanan_produk/'.$bukti_pby_pemesanan_produk);
        echo 1;
    }



}
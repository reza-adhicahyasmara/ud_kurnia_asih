<?php 
defined('BASEPATH') || exit('No direct script access allowed');

require APPPATH . '/libraries/BaseControllerBackend.php';

class Pemesanan_bahan_baku extends BaseControllerBackend {

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
            $this->global['pageTitle'] = "Pemesanan Bahan Baku";

            $data['bahan_baku_limit'] = $this->Mod_bahan_baku->get_all_bahan_baku();
            $data['data_pemesanan'] = $this->Mod_bahan_baku->get_all_pemesanan_bb();
            $data['supplier'] = $this->Mod_supplier->get_all_supplier();
            $this->loadViews("backend/admin/pemesanan_bahan_baku/body",$this->global,$data,"backend/admin/pemesanan_bahan_baku/footer");
        }  
        else{ 
            redirect('login');
        }  
    }

    function select_bahan_baku_supplier(){
		$id_supplier = $this->input->post('id_supplier');
        $data = $this->Mod_bahan_baku->get_bahan_baku_supplier($id_supplier)->result();
        echo json_encode($data);
    }

    function select_rekening_bank(){
		$id_supplier = $this->input->post('id_supplier');
        $data = $this->Mod_bank->get_rekening_sup($id_supplier)->result();
        echo json_encode($data);
    }

    function detail($kode_pemesanan_bb){
        $nik_karyawan = $this->session->userdata('ses_nik_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses');  

        if($nik_karyawan != null && $hak_akses == 'Admin'){
            $this->global['pageTitle'] = "Detail Pemesanan Bahan Baku";
            
            $data['data_detail'] = $this->Mod_bahan_baku->get_pemesanan_bb($kode_pemesanan_bb);

            $this->loadViews("backend/admin/pemesanan_bahan_baku/body_detail",$this->global,$data,"backend/admin/pemesanan_bahan_baku/footer_detail");
        }
        else{ 
            redirect('login');
        }  
    }

    function invoice($kode_pemesanan_bb){
        $nik_karyawan = $this->session->userdata('ses_nik_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses');  

        if($nik_karyawan != null && $hak_akses == 'Admin'){
            $this->global['pageTitle'] = "Invoice";
            
            $data['data_detail'] = $this->Mod_bahan_baku->get_pemesanan_bb($kode_pemesanan_bb);

            $this->loadViews("backend/admin/pemesanan_bahan_baku/body_invoice",$this->global,$data,"backend/admin/pemesanan_bahan_baku/footer_invoice");
        }
        else{ 
            redirect('login');
        }  

    }

    function load_data_item_pemesanan_bb(){
        $kode_pemesanan_bb = $this->input->post('kode_pemesanan_bb');
        $data['total_pby_pemesanan_bb'] = $this->input->post('total_pby_pemesanan_bb');
        $data['list_bahan_baku'] = $this->Mod_bahan_baku->get_item_pemesanan_bb($kode_pemesanan_bb);
        $this->load->view('backend/admin/pemesanan_bahan_baku/load_data_item_pemesanan_bb', $data);
    }

    function load_data_item_bb(){
        $data['tmp'] = $this->Mod_bahan_baku->get_all_item_pemesanan_bb();
        $this->load->view('backend/admin/pemesanan_bahan_baku/load_data_item_bb', $data);
    }

    function insert_item_pemesanan_bb(){
        $id_supplier = $this->input->post('id_supplier');
        $kode_bb = $this->input->post('kode_bb');
        $jumlah_ipemesanan_bb = (float)$this->input->post('jumlah_ipemesanan_bb');
        $harga_ipemesanan_bb = (float)$this->input->post('harga_ipemesanan_bb');
        $stok_gudang_sup_bb = (float)$this->input->post('stok_gudang_sup_bb');
        $subtotal_ipemesanan_bb = $jumlah_ipemesanan_bb * $harga_ipemesanan_bb;
        $status_ipemesanan_bb = 1;

        $cek_item1 = $this->Mod_bahan_baku->cek_item_pemesanan_bb($kode_bb);
        $cek_item2 = $this->Mod_bahan_baku->cek_item_pemesanan_bb_supplier($id_supplier);
        $cek_item3 = $this->Mod_bahan_baku->cek_item_doubel();
        

        if($id_supplier == ""){
            echo "Supplier tidak boleh kosong";
        }else if($cek_item1->num_rows() > 0){ 
            echo "Bahan baku sudah ada";
        }else if($harga_ipemesanan_bb == 0){
            echo "Harga tidak tercantum, konfirmasi terlebih dahulu kepada supplier";
        }else if($kode_bb == ""){
            echo "Bahan baku tidak boleh kosong";
        }else if($jumlah_ipemesanan_bb == 0){
            echo "Jumlah item tidak boleh kosong";
        }else if($jumlah_ipemesanan_bb > $stok_gudang_sup_bb){
            echo "Jumlah item melebihi stok gudang";
        }else{
            if($cek_item3->num_rows() > 0){//jika sudah ada data
                if($cek_item2->num_rows() > 0){ 
                    echo 1;         
                    $save  = array( 
                        'kode_bb'                   => $kode_bb,
                        'id_supplier'               => $id_supplier,
                        'jumlah_ipemesanan_bb'      => $jumlah_ipemesanan_bb,
                        'harga_ipemesanan_bb'       => $harga_ipemesanan_bb,
                        'subtotal_ipemesanan_bb'    => $subtotal_ipemesanan_bb,
                        'status_ipemesanan_bb'      => $status_ipemesanan_bb
                    );
                    
                    $this->Mod_bahan_baku->insert_item_pemesanan_bb("t_ipemesanan_bb", $save);  
                
                }else{
                    echo "Hanya satu supplier yang sama dalam satu pemesanan";
                }
            }else{ //jika data ksong
                echo 1;
                $save  = array( 
                    'kode_bb'                       => $kode_bb,
                    'id_supplier'                   => $id_supplier,
                    'jumlah_ipemesanan_bb'          => $jumlah_ipemesanan_bb,
                    'harga_ipemesanan_bb'           => $harga_ipemesanan_bb,
                    'subtotal_ipemesanan_bb'        => $subtotal_ipemesanan_bb,
                    'status_ipemesanan_bb'          => $status_ipemesanan_bb
                );
                
                $this->Mod_bahan_baku->insert_item_pemesanan_bb("t_ipemesanan_bb", $save);  
            }
        }
    }

    function delete_item_pemesanan_bb(){
        $kode_ipemesanan_bb = $this->input->post('kode_ipemesanan_bb');
        $this->Mod_bahan_baku->delete_item_pemesanan_bb($kode_ipemesanan_bb, 't_ipemesanan_bb');
    } 

    function insert_pemesanan_bb(){
        $id_supplier = $this->input->post('id_supplier');
        $kode_rekening = $this->input->post('kode_rekening');
        $tanggal_pemesanan_bb = date('Y-m-d H:m:s');
        $total_pby_pemesanan_bb = $this->input->post('total_pby_pemesanan_bb');
        $kode_pemesanan_bb = 'INV-'.date('YmdHms').'-'.$id_supplier;
        $status_pemesanan_bb = '1';
        $status_pby_pemesanan_bb = '1';

        $cek_item2 = $this->Mod_bahan_baku->cek_item_pemesanan_bb_supplier($id_supplier);
        if($kode_rekening == ""){
            echo "Kode bank tidak boleh kosong";
        }else{
            if($cek_item2->num_rows() > 0){ 
                echo 1;         
                $save  = array( 
                    'kode_pemesanan_bb'         => $kode_pemesanan_bb,
                    'id_supplier'               => $id_supplier,
                    'kode_rekening'             => $kode_rekening,
                    'tanggal_pemesanan_bb'      => $tanggal_pemesanan_bb,
                    'total_pby_pemesanan_bb'    => $total_pby_pemesanan_bb,
                    'status_pby_pemesanan_bb'   => $status_pby_pemesanan_bb,
                    'status_pemesanan_bb'       => $status_pemesanan_bb
                );
                            
                $this->Mod_bahan_baku->insert_pemesanan_bb("t_pemesanan_bb", $save);        
                
                $item = $this->Mod_bahan_baku->get_all_item_pemesanan_bb()->result();

                foreach($item as $row){
                    if($row->kode_pemesanan_bb == ""){
                        $kode_ipemesanan_bb = $row->kode_ipemesanan_bb;
                        
                        $data = array(
                            'kode_ipemesanan_bb'    => $kode_ipemesanan_bb,
                            'kode_pemesanan_bb'     => $kode_pemesanan_bb,
                            'status_ipemesanan_bb'  => '2'
                        );
                        
                        $this->Mod_bahan_baku->update_item_pemesanan_bb($kode_ipemesanan_bb, $data); 
                    }
                }
            }
            else {
                echo "Supplier tidak sesuai";
            }
        }
    }

    function update_pemesanan_bb(){
        $kode_pemesanan_bb = $this->input->post('kode_pemesanan_bb');
        $bukti_pby_pemesanan_bb = $this->input->post('bukti_pby_pemesanan_bb');
        $status_pemesanan_bb = $this->input->post('status_pemesanan_bb');
        $status_pby_pemesanan_bb = $this->input->post('status_pby_pemesanan_bb');

        echo 1;         
        $save  = array( 
            'kode_pemesanan_bb'         => $kode_pemesanan_bb,
            'bukti_pby_pemesanan_bb'    => $bukti_pby_pemesanan_bb,
            'status_pemesanan_bb'       => $status_pemesanan_bb,
            'status_pby_pemesanan_bb'   => $status_pby_pemesanan_bb
        );
                    
        $this->Mod_bahan_baku->update_pemesanan_bb($kode_pemesanan_bb, $save);        

    }


    function save_image(){
        $kode_pemesanan_bb = slug($this->input->post('kode_pemesanan_bb'));
		$config['upload_path']   = './assets/img/pemesanan_bb/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
        $config['max_size']	     = '3000';
        $config['max_width']     = '4000';
        $config['max_height']    = '3908';
		$config['file_name']     = $kode_pemesanan_bb; 

        $this->upload->initialize($config);

		if ( ! $this->upload->do_upload('file')){   
            $error = array('error' => $this->upload->display_errors());
		} else {
			$haha = $this->upload->data();
			$image = $haha['file_name'];

			$config['image_library'] = 'gd2';
			$config['source_image'] = './assets/img/pemesanan_bb/'.$image;
			$config['maintain_ratio'] = TRUE;
            $config['width'] = 500;

			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			echo $image;
		}
    }

    function deleteImage(){
        $bukti_pby_pemesanan_bb = $this->input->post('bukti_pby_pemesanan_bb');
        unlink('assets/img/pemesanan_bb/'.$bukti_pby_pemesanan_bb);
        echo 1;
    }



}
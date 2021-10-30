<?php 
defined('BASEPATH') || exit('No direct script access allowed');

require APPPATH . '/libraries/BaseControllerBackend.php';

class Retur_bahan_baku extends BaseControllerBackend {

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
            $this->global['pageTitle'] = "Data Retur Bahan Baku";

            $data['supplier'] = $this->Mod_supplier->get_all_supplier();
            $data['data_retur'] = $this->Mod_bahan_baku->get_all_retur_bb();
            $data['bahan_baku'] = $this->Mod_bahan_baku->get_all_bahan_baku();
            $this->loadViews("backend/gudang/retur_bahan_baku/body",$this->global,$data,"backend/gudang/retur_bahan_baku/footer");
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

    function detail($kode_retur_bb){
        $nik_karyawan = $this->session->userdata('ses_nik_karyawan');   
        $hak_akses = $this->session->userdata('ses_akses');  

        if($nik_karyawan != null && $hak_akses == 'Gudang'){
            $this->global['pageTitle'] = "Detail Pemesanan Toko";
            
            $data['data_detail'] = $this->Mod_bahan_baku->get_retur_bb($kode_retur_bb);
            $data['list_bahan_baku'] = $this->Mod_bahan_baku->get_item_retur_bb($kode_retur_bb);

            $this->loadViews("backend/gudang/retur_bahan_baku/body_detail",$this->global,$data,"backend/gudang/retur_bahan_baku/footer");
        }
        else{ 
            redirect('login');
        }   
    }

    function invoice($kode_retur_bb){
        $nik_karyawan = $this->session->userdata('ses_nik_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses');  

        if($nik_karyawan != null && $hak_akses == 'Gudang'){
            $this->global['pageTitle'] = "Invoice";
            
            $data['data_detail'] = $this->Mod_bahan_baku->get_retur_bb($kode_retur_bb);
            $data['list_bahan_baku'] = $this->Mod_bahan_baku->get_item_retur_bb($kode_retur_bb);

            $this->loadViews("backend/gudang/retur_bahan_baku/body_invoice",$this->global,$data,"backend/gudang/retur_bahan_baku/footer_invoice");
        }
        else{ 
            redirect('login');
        }  
    }

    function load_data_item_retur_bb(){
        $data['tmp'] = $this->Mod_bahan_baku->get_all_item_retur_bb();
        $this->load->view('backend/gudang/retur_bahan_baku/load_data_item_retur_bb', $data);
    }

    
    function insert_item_retur_bb(){
        $id_supplier =  $this->input->post('id_supplier');
        $kode_bb = $this->input->post('kode_bb');
        $jumlah_iretur_bb = $this->input->post('jumlah_iretur_bb');
        $keterangan_iretur_bb = $this->input->post('keterangan_iretur_bb');
        $gambar_iretur_bb = $this->input->post('gambar_iretur_bb');
        $status_iretur_bb = 1;

        $cek_item1 = $this->Mod_bahan_baku->cek_item_retur_bb($kode_bb);
        $cek_item2 = $this->Mod_bahan_baku->cek_item_retur_bb_supplier($id_supplier);
        $cek_item3 = $this->Mod_bahan_baku->cek_item_doubel();
        $cek_item4 = $this->Mod_bahan_baku->cek_stok($kode_bb, $jumlah_iretur_bb);

        if($id_supplier == ""){
            echo "Supplier tidak boleh kosong";
        }else if($cek_item1->num_rows() > 0){ 
            echo "Produk sudah ada";
        }else if($kode_bb == ""){
            echo "Produk tidak boleh kosong";
        }else if($jumlah_iretur_bb == ""){
            echo "Qty tidak boleh kosong";
        }else if($gambar_iretur_bb == ""){
            echo "Gambar tidak boleh kosong";
        }else if($keterangan_iretur_bb == ""){
            echo "Keterangan tidak boleh kosong";
        }else{
            if($cek_item4->num_rows() > 0){
                if($cek_item3->num_rows() > 0){//jika sudah ada data
                    if($cek_item2->num_rows() > 0){ 
                        echo 1;
                        $save  = array( 
                            'id_supplier'                   => $id_supplier,
                            'kode_bb'               => $kode_bb,
                            'jumlah_iretur_bb'             => $jumlah_iretur_bb,
                            'keterangan_iretur_bb'      => $keterangan_iretur_bb,
                            'gambar_iretur_bb'          => $gambar_iretur_bb,
                            'status_iretur_bb'          => $status_iretur_bb
                        );
                        $this->Mod_bahan_baku->insert_item_retur_bb("t_iretur_bb", $save); 

                        foreach($cek_item4->result() as $row){
                            $kode_bb = $row->kode_bb;
                            $stok_gudang_pab_bb = $row->stok_gudang_pab_bb;
                            $hasil = $stok_gudang_pab_bb - $jumlah_iretur_bb;

                            $save  = array( 
                                'kode_bb'           => $kode_bb,
                                'stok_gudang_pab_bb'    => $hasil
                            );
                            $this->Mod_bahan_baku->update_bahan_baku($kode_bb, $save);  
                        }

                    }else{
                        echo "Beda supplier";
                    }
                }else{ //jika data ksong
                    echo 1;
                    $save  = array( 
                        'id_supplier'                   => $id_supplier,
                        'kode_bb'               => $kode_bb,
                        'jumlah_iretur_bb'             => $jumlah_iretur_bb,
                        'keterangan_iretur_bb'      => $keterangan_iretur_bb,
                        'gambar_iretur_bb'          => $gambar_iretur_bb,
                        'status_iretur_bb'          => $status_iretur_bb
                    );
                    $this->Mod_bahan_baku->insert_item_retur_bb("t_iretur_bb", $save);  
                    
                    foreach($cek_item4->result() as $row){
                        $kode_bb = $row->kode_bb;
                        $stok_gudang_pab_bb = $row->stok_gudang_pab_bb;
                        $hasil = $stok_gudang_pab_bb - $jumlah_iretur_bb;

                        $save  = array( 
                            'kode_bb'           => $kode_bb,
                            'stok_gudang_pab_bb'    => $hasil
                        );
                        $this->Mod_bahan_baku->update_bahan_baku($kode_bb, $save);  
                    }
                }
            }else{
                echo "Stok kurang";
            }
        }
    }

    function delete_item_retur_bb(){
        $kode_iretur_bb = $this->input->post('kode_iretur_bb');
        $kode_bb = $this->input->post('kode_bb');
        $stok_gudang_pab_bb = $this->input->post('stok_gudang_pab_bb');
        $jumlah_iretur_bb = $this->input->post('jumlah_iretur_bb');
        $gambar_iretur_bb = $this->input->post('gambar_iretur_bb');

        unlink('assets/img/retur_bb/'.$gambar_iretur_bb);
        $this->Mod_bahan_baku->delete_item_retur_bb($kode_iretur_bb, 't_iretur_bb');

        $hasil = $stok_gudang_pab_bb + $jumlah_iretur_bb;

        $save  = array( 
            'kode_bb'          => $kode_bb,
            'stok_gudang_pab_bb'   => $hasil
        );
        $this->Mod_bahan_baku->update_bahan_baku($kode_bb, $save);  
    } 

    function insert_retur_bb(){
        $id_supplier = $this->input->post('id_supplier');
        $tanggal_retur_bb = date('Y-m-d H:m:s');
        $kode_retur_bb = 'RETBB-'.date('YmdHms').'-'.$id_supplier;
        $status_retur_bb = '1';

        $cek_item2 = $this->Mod_bahan_baku->cek_item_retur_bb_supplier($id_supplier);
        
        if($id_supplier == ""){
            echo "Supplier tidak boleh kosong";
        }else{
            if($cek_item2->num_rows() > 0){ 
                echo 1;         
                $save  = array( 
                    'kode_retur_bb'         => $kode_retur_bb,
                    'id_supplier'           => $id_supplier,
                    'tanggal_retur_bb'      => $tanggal_retur_bb,
                    'status_retur_bb'       => $status_retur_bb
                );
                            
                $this->Mod_bahan_baku->insert_retur_bb("t_retur_bb", $save);        
                
                $item = $this->Mod_bahan_baku->get_all_item_retur_bb()->result();

                foreach($item as $row){
                    if($row->kode_retur_bb == ""){
                        $kode_iretur_bb = $row->kode_iretur_bb;
                        
                        $data = array(
                            'kode_iretur_bb'   => $kode_iretur_bb,
                            'kode_retur_bb'        => $kode_retur_bb,
                            'status_iretur_bb' => '2'
                        );
                        
                        $this->Mod_bahan_baku->update_item_retur_bb($kode_iretur_bb, $data); 
                    }
                }
            }
            else {
                echo "Supplier tidak sesuai";
            }
        }
    }

    function update_retur_bb(){
        $kode_retur_bb = $this->input->post('kode_retur_bb');
        $status_retur_bb = $this->input->post('status_retur_bb');

        echo 1;         
        $save  = array( 
            'kode_retur_bb'     => $kode_retur_bb,
            'status_retur_bb'   => $status_retur_bb
        );
                    
        $this->Mod_bahan_baku->update_retur_bb($kode_retur_bb, $save);        

        $cek_item2 = $this->Mod_bahan_baku->get_item_retur_bb($kode_retur_bb);

        if($status_retur_bb == 3){
            foreach($cek_item2->result() as $row){
                $kode_bb = $row->kode_bb;
                $stok_gudang_pab_bb = $row->stok_gudang_pab_bb;
                $jumlah_iretur_bb = $row->jumlah_iretur_bb;
                $hasil = $stok_gudang_pab_bb + $jumlah_iretur_bb;

                $save  = array( 
                    'kode_bb'          => $kode_bb,
                    'stok_gudang_pab_bb'   => $hasil
                );
                $this->Mod_bahan_baku->update_bahan_baku($kode_bb, $save);  
            }
        }   
    }

       
    function save_image(){
        $nama_retur = slug($this->input->post('nama_retur'));
		$config['upload_path']   = './assets/img/retur_bb';
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
			$config['source_image'] = './assets/img/retur_bb'.$image;
			$config['maintain_ratio'] = TRUE;
            $config['width'] = 500;

			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			echo $image;
		}
    }

    function delete_image(){
        $gambar_iretur_bb = $this->input->post('gambar_iretur_bb');
        unlink('assets/img/retur_bb'.$gambar_iretur_bb);
        echo 1;
    }

}
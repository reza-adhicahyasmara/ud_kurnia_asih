<?php 
defined('BASEPATH') || exit('No direct script access allowed');

class Mod_bahan_baku extends CI_Model {

    //BAHAN BAKU
    function get_all_bahan_baku(){ 
        $this->db->select('t_bahan_baku.*, t_supplier.*, t_kategori.*, t_satuan.*, t_proposal.*');
        $this->db->join('t_supplier', 't_supplier.id_supplier = t_bahan_baku.id_supplier', 'inner');
        $this->db->join('t_kategori', 't_kategori.kode_kategori = t_bahan_baku.kode_kategori', 'inner');
        $this->db->join('t_satuan', 't_satuan.kode_satuan = t_bahan_baku.kode_satuan', 'inner');
        $this->db->join('t_proposal', 't_proposal.kode_proposal = t_bahan_baku.kode_proposal', 'left');
        $this->db->order_by('t_bahan_baku.nama_bb ASC');
        return $this->db->get('t_bahan_baku'); 
    }

    function get_bahan_baku($kode_bb){
        $this->db->select('t_bahan_baku.*, t_supplier.*, t_kategori.*, t_satuan.*');
        $this->db->join('t_supplier', 't_supplier.id_supplier = t_bahan_baku.id_supplier', 'inner');
        $this->db->join('t_kategori', 't_kategori.kode_kategori = t_bahan_baku.kode_kategori', 'inner');
        $this->db->join('t_satuan', 't_satuan.kode_satuan = t_bahan_baku.kode_satuan', 'inner');
        $this->db->where('kode_bb', $kode_bb);
        return $this->db->get('t_bahan_baku');
    }

    function get_bahan_baku_supplier($id_supplier){
        $this->db->select('t_bahan_baku.*, t_supplier.*, t_kategori.*, t_satuan.*');
        $this->db->join('t_supplier', 't_supplier.id_supplier = t_bahan_baku.id_supplier', 'inner');
        $this->db->join('t_kategori', 't_kategori.kode_kategori = t_bahan_baku.kode_kategori', 'inner');
        $this->db->join('t_satuan', 't_satuan.kode_satuan = t_bahan_baku.kode_satuan', 'inner');
        $this->db->where('t_bahan_baku.id_supplier', $id_supplier);
        return $this->db->get('t_bahan_baku');
    }

    function cek_bahan_baku($nama_bb){
        $this->db->where('nama_bb', $nama_bb);
        return $this->db->get('t_bahan_baku');
    }

    function cek_bahan_baku_penawaran($kode_proposal){
        $this->db->where('status_penawaran_bb', 'Penawaran');
        $this->db->where('kode_proposal', $kode_proposal);
        return $this->db->get('t_bahan_baku');
    }

    function insert_bahan_baku($tabel, $data){
        $insert = $this->db->insert($tabel, $data);
        return $insert;
    }

    function update_bahan_baku($kode_bb, $data){
        $this->db->where('kode_bb', $kode_bb);
		$this->db->update('t_bahan_baku', $data);
    }

    function delete_bahan_baku($kode, $tabel){
        $this->db->where('kode_bb', $kode);
        $this->db->delete($tabel);
    }

    function delete_all_bahan_baku($kode, $tabel){
        $this->db->where('kode_bb', $kode);
        $this->db->delete($tabel);
    }



    //KATEGORI
    function get_all_kategori(){ 
        $this->db->order_by('nama_kategori ASC');
        return $this->db->get('t_kategori'); 
    }

    function get_kategori($kode_kategori){
        $this->db->where('kode_kategori', $kode_kategori);
        return $this->db->get('t_kategori');
    }

    function cek_kategori($nama_kategori){
        $this->db->where('nama_kategori', $nama_kategori);
        return $this->db->get('t_kategori');
    }

    function insert_kategori($tabel, $data){
        $insert = $this->db->insert($tabel, $data);
        return $insert;
    }

    function update_kategori($kode_kategori, $data){
        $this->db->where('kode_kategori', $kode_kategori);
		$this->db->update('t_kategori', $data);
    }

    function delete_kategori($kode, $tabel){
        $this->db->where('kode_kategori', $kode);
        $this->db->delete($tabel);
    }



    //SATUAN
    function get_all_satuan(){ 
        $this->db->order_by('nama_satuan ASC');
        return $this->db->get('t_satuan'); 
    }

    function get_satuan($kode_satuan){
        $this->db->where('kode_satuan', $kode_satuan);
        return $this->db->get('t_satuan');
    }

    function cek_satuan($nama_satuan){
        $this->db->where('nama_satuan', $nama_satuan);
        return $this->db->get('t_satuan');
    }

    function insert_satuan($tabel, $data){
        $insert = $this->db->insert($tabel, $data);
        return $insert;
    }

    function update_satuan($kode_satuan, $data){
        $this->db->where('kode_satuan', $kode_satuan);
		$this->db->update('t_satuan', $data);
    }

    function delete_satuan($kode, $tabel){
        $this->db->where('kode_satuan', $kode);
        $this->db->delete($tabel);
    }

    

    //PENYESUAIAN STOK
    function get_all_penyesuaian_bb(){ 
        $this->db->select('t_penyesuaian_bb.*, t_bahan_baku.*, t_kategori.*, t_satuan.*');
        $this->db->join('t_bahan_baku', 't_bahan_baku.kode_bb = t_penyesuaian_bb.kode_bb', 'inner');
        $this->db->join('t_kategori', 't_kategori.kode_kategori = t_bahan_baku.kode_kategori', 'inner');
        $this->db->join('t_satuan', 't_satuan.kode_satuan = t_bahan_baku.kode_satuan', 'inner');
        $this->db->order_by('t_penyesuaian_bb.tanggal_penyesuaian_bb ASC');
        return $this->db->get('t_penyesuaian_bb'); 
    }

    function get_penyesuaian_bb($kode_penyesuaian_bb){
        $this->db->where('kode_penyesuaian_bb', $kode_penyesuaian_bb);
        return $this->db->get('t_penyesuaian_bb');
    }

    function insert_penyesuaian_bb($tabel, $data){
        $insert = $this->db->insert($tabel, $data);
        return $insert;
    }

    function update_penyesuaian_bb($kode_penyesuaian_bb, $data){
        $this->db->where('kode_penyesuaian_bb', $kode_penyesuaian_bb);
		$this->db->update('t_penyesuaian_bb', $data);
    }

    function delete_penyesuaian_bb($kode, $tabel){
        $this->db->where('kode_penyesuaian_bb', $kode);
        $this->db->delete($tabel);
    }



    //PEMESANAN BAHAN BAKU
    function get_all_pemesanan_bb(){ 
        $this->db->select('t_pemesanan_bb.*, t_supplier.*, t_rekening.*, t_bank.*');
        $this->db->join('t_supplier', 't_supplier.id_supplier = t_pemesanan_bb.id_supplier', 'left');
        $this->db->join('t_rekening', 't_rekening.kode_rekening = t_pemesanan_bb.kode_rekening', 'left');
        $this->db->join('t_bank', 't_bank.kode_bank = t_rekening.kode_bank', 'left');
        $this->db->order_by('t_pemesanan_bb.tanggal_pemesanan_bb ASC');
        return $this->db->get('t_pemesanan_bb'); 
    }

    function get_pemesanan_bb($kode_pemesanan_bb){
        $this->db->select('t_pemesanan_bb.*, t_supplier.*, t_rekening.*, t_bank.*');
        $this->db->join('t_supplier', 't_supplier.id_supplier = t_pemesanan_bb.id_supplier', 'left');
        $this->db->join('t_rekening', 't_rekening.kode_rekening = t_pemesanan_bb.kode_rekening', 'left');
        $this->db->join('t_bank', 't_bank.kode_bank = t_rekening.kode_bank', 'left');
        $this->db->where('kode_pemesanan_bb', $kode_pemesanan_bb);
        return $this->db->get('t_pemesanan_bb');
    }

    function get_pemesanan_bb_supplier($id_supplier){
        $this->db->select('t_pemesanan_bb.*, t_supplier.*, t_rekening.*, t_bank.*');
        $this->db->join('t_supplier', 't_supplier.id_supplier = t_pemesanan_bb.id_supplier', 'left');
        $this->db->join('t_rekening', 't_rekening.kode_rekening = t_pemesanan_bb.kode_rekening', 'left');
        $this->db->join('t_bank', 't_bank.kode_bank = t_rekening.kode_bank', 'left');
        $this->db->where('t_pemesanan_bb.id_supplier', $id_supplier);
        return $this->db->get('t_pemesanan_bb');
    }

    function insert_pemesanan_bb($tabel, $data){
        $insert = $this->db->insert($tabel, $data);
        return $insert;
    }

    function update_pemesanan_bb($kode_pemesanan_bb, $data){
        $this->db->where('kode_pemesanan_bb', $kode_pemesanan_bb);
		$this->db->update('t_pemesanan_bb', $data);
    }



    //PEMESANAN ITEM BAHAN BAKU
    function get_all_item_pemesanan_bb(){ 
        $this->db->select('t_ipemesanan_bb.*, t_bahan_baku.*, t_supplier.*, t_kategori.*, t_satuan.*');
        $this->db->join('t_bahan_baku', 't_bahan_baku.kode_bb = t_ipemesanan_bb.kode_bb', 'left');
        $this->db->join('t_supplier', 't_supplier.id_supplier = t_bahan_baku.id_supplier', 'left');
        $this->db->join('t_kategori', 't_kategori.kode_kategori = t_bahan_baku.kode_kategori', 'left');
        $this->db->join('t_satuan', 't_satuan.kode_satuan = t_bahan_baku.kode_satuan', 'left');
        $this->db->order_by('t_bahan_baku.nama_bb ASC');
        return $this->db->get('t_ipemesanan_bb'); 
    }

    function get_item_pemesanan_bb($kode_pemesanan_bb){ 
        $this->db->select('t_ipemesanan_bb.*, t_bahan_baku.*, t_supplier.*, t_kategori.*, t_satuan.*');
        $this->db->join('t_bahan_baku', 't_bahan_baku.kode_bb = t_ipemesanan_bb.kode_bb', 'left');
        $this->db->join('t_supplier', 't_supplier.id_supplier = t_bahan_baku.id_supplier', 'left');
        $this->db->join('t_kategori', 't_kategori.kode_kategori = t_bahan_baku.kode_kategori', 'left');
        $this->db->join('t_satuan', 't_satuan.kode_satuan = t_bahan_baku.kode_satuan', 'left');
        $this->db->where('t_ipemesanan_bb.kode_pemesanan_bb', $kode_pemesanan_bb);
        return $this->db->get('t_ipemesanan_bb'); 
    }

    function get_tanggal_kadaluwarsa($kode_pemesanan_bb){ 
        $this->db->where('kode_pemesanan_bb', $kode_pemesanan_bb);
        $this->db->where('tanggal_kadaluwarsa_ipemesanan_bb', null);
        return $this->db->get('t_ipemesanan_bb'); 
    }

    function cek_item_pemesanan_bb($kode_bb){
        $this->db->join('t_bahan_baku', 't_bahan_baku.kode_bb = t_ipemesanan_bb.kode_bb', 'left');
        $this->db->where('t_bahan_baku.kode_bb', $kode_bb);
        $this->db->where('t_ipemesanan_bb.status_ipemesanan_bb', '1');
        return $this->db->get('t_ipemesanan_bb');
    }

    function cek_item_pemesanan_bb_supplier($id_supplier){
        $this->db->join('t_bahan_baku', 't_bahan_baku.kode_bb = t_ipemesanan_bb.kode_bb', 'left');
        $this->db->where('t_bahan_baku.id_supplier', $id_supplier);
        $this->db->where('t_ipemesanan_bb.status_ipemesanan_bb', '1');
        return $this->db->get('t_ipemesanan_bb');
    }

    function cek_item_doubel(){ 
        $this->db->select('t_ipemesanan_bb.*, t_bahan_baku.*, t_supplier.*, t_kategori.*, t_satuan.*');
        $this->db->join('t_bahan_baku', 't_bahan_baku.kode_bb = t_ipemesanan_bb.kode_bb', 'left');
        $this->db->join('t_supplier', 't_supplier.id_supplier = t_bahan_baku.id_supplier', 'left');
        $this->db->join('t_kategori', 't_kategori.kode_kategori = t_bahan_baku.kode_kategori', 'left');
        $this->db->join('t_satuan', 't_satuan.kode_satuan = t_bahan_baku.kode_satuan', 'left');
        $this->db->where('t_ipemesanan_bb.status_ipemesanan_bb', '1');
        return $this->db->get('t_ipemesanan_bb'); 
    }

    function cek_item_retur($kode_pemesanan_bb){ 
        $this->db->where('kode_pemesanan_bb', $kode_pemesanan_bb);
        $this->db->where('status_ipemesanan_bb = 5');
        return $this->db->get('t_ipemesanan_bb'); 
    }

    function cek_item_kirim($kode_pemesanan_bb){ 
        $this->db->where('kode_pemesanan_bb', $kode_pemesanan_bb);
        $this->db->where('status_ipemesanan_bb = 3');
        return $this->db->get('t_ipemesanan_bb'); 
    }

    function insert_item_pemesanan_bb($tabel, $data){
        $insert = $this->db->insert($tabel, $data);
        return $insert;
    }

    function update_item_pemesanan_bb($kode_ipemesanan_bb, $data){
        $this->db->where('kode_ipemesanan_bb', $kode_ipemesanan_bb);
		$this->db->update('t_ipemesanan_bb', $data);
    }

    function delete_item_pemesanan_bb($kode, $tabel){
        $this->db->where('kode_ipemesanan_bb', $kode);
        $this->db->delete($tabel);
    }



    //RETUR BAHAN BAKU
    function get_all_retur_bb(){ 
        $this->db->select('t_retur_bb.*, t_supplier.*');
        $this->db->join('t_supplier', 't_supplier.id_supplier = t_retur_bb.id_supplier', 'left');
        $this->db->order_by('t_retur_bb.tanggal_retur_bb ASC');
        return $this->db->get('t_retur_bb'); 
    }

    function get_retur_bb($kode_retur_bb){
        $this->db->select('t_retur_bb.*, t_supplier.*');
        $this->db->join('t_supplier', 't_supplier.id_supplier = t_retur_bb.id_supplier', 'left');
        $this->db->where('kode_retur_bb', $kode_retur_bb);
        return $this->db->get('t_retur_bb');
    }

    function insert_retur_bb($tabel, $data){
        $insert = $this->db->insert($tabel, $data);
        return $insert;
    }

    function update_retur_bb($kode_retur_bb, $data){
        $this->db->where('kode_retur_bb', $kode_retur_bb);
		$this->db->update('t_retur_bb', $data);
    }



    //RETUR ITEM BAHAN BAKU
    function get_all_item_retur_bb(){ 
        $this->db->select('t_iretur_bb.*, t_bahan_baku.*, t_supplier.*, t_kategori.*, t_satuan.*');
        $this->db->join('t_bahan_baku', 't_bahan_baku.kode_bb = t_iretur_bb.kode_bb', 'left');
        $this->db->join('t_supplier', 't_supplier.id_supplier = t_bahan_baku.id_supplier', 'left');
        $this->db->join('t_kategori', 't_kategori.kode_kategori = t_bahan_baku.kode_kategori', 'left');
        $this->db->join('t_satuan', 't_satuan.kode_satuan = t_bahan_baku.kode_satuan', 'left');
        $this->db->order_by('t_bahan_baku.nama_bb ASC');
        return $this->db->get('t_iretur_bb'); 
    }
    
    function get_item_retur_bb($kode_retur_bb){ 
        $this->db->select('t_iretur_bb.*, t_bahan_baku.*, t_supplier.*, t_kategori.*, t_satuan.*');
        $this->db->join('t_bahan_baku', 't_bahan_baku.kode_bb = t_iretur_bb.kode_bb', 'left');
        $this->db->join('t_supplier', 't_supplier.id_supplier = t_bahan_baku.id_supplier', 'left');
        $this->db->join('t_kategori', 't_kategori.kode_kategori = t_bahan_baku.kode_kategori', 'left');
        $this->db->join('t_satuan', 't_satuan.kode_satuan = t_bahan_baku.kode_satuan', 'left');
        $this->db->where('t_iretur_bb.kode_retur_bb', $kode_retur_bb);
        return $this->db->get('t_iretur_bb'); 
    }

    function cek_item_retur_bb($kode_bb){
        $this->db->join('t_bahan_baku', 't_bahan_baku.kode_bb = t_iretur_bb.kode_bb', 'left');
        $this->db->where('t_bahan_baku.kode_bb', $kode_bb);
        $this->db->where('t_iretur_bb.status_iretur_bb', '1');
        return $this->db->get('t_iretur_bb');
    }

    function cek_item_retur_bb_supplier($id_supplier){
        $this->db->join('t_bahan_baku', 't_bahan_baku.kode_bb = t_iretur_bb.kode_bb', 'left');
        $this->db->where('t_bahan_baku.id_supplier', $id_supplier);
        $this->db->where('t_iretur_bb.status_iretur_bb', '1');
        return $this->db->get('t_iretur_bb');
    }

    function cek_item_retur_doubel(){ 
        $this->db->select('t_iretur_bb.*, t_bahan_baku.*, t_supplier.*, t_kategori.*, t_satuan.*');
        $this->db->join('t_bahan_baku', 't_bahan_baku.kode_bb = t_iretur_bb.kode_bb', 'left');
        $this->db->join('t_supplier', 't_supplier.id_supplier = t_bahan_baku.id_supplier', 'left');
        $this->db->join('t_kategori', 't_kategori.kode_kategori = t_bahan_baku.kode_kategori', 'left');
        $this->db->join('t_satuan', 't_satuan.kode_satuan = t_bahan_baku.kode_satuan', 'left');
        $this->db->where('t_iretur_bb.status_iretur_bb', '1');
        return $this->db->get('t_iretur_bb'); 
    }

    function cek_stok($kode_bb, $jumlah_iretur_bb){
        $this->db->where("stok_gudang_pab_bb >= '$jumlah_iretur_bb'");
        $this->db->where('kode_bb', $kode_bb);
        return $this->db->get('t_bahan_baku');
    }

    function cek_item_proses($kode_retur_bb){ 
        $this->db->where('kode_retur_bb', $kode_retur_bb);
        $this->db->where('status_iretur_bb = 2');
        return $this->db->get('t_iretur_bb'); 
    }

    function insert_item_retur_bb($tabel, $data){
        $insert = $this->db->insert($tabel, $data);
        return $insert;
    }

    function update_item_retur_bb($kode_iretur_bb, $data){
        $this->db->where('kode_iretur_bb', $kode_iretur_bb);
		$this->db->update('t_iretur_bb', $data);
    }

    function delete_item_retur_bb($kode, $tabel){
        $this->db->where('kode_iretur_bb', $kode);
        $this->db->delete($tabel);
    }


    //BAHAN BAKU KELUAR
    function get_all_bahan_baku_keluar(){ 
        $this->db->select('t_bb_keluar.*, t_bahan_baku.*, t_kategori.*, t_supplier.*, t_satuan.*');
        $this->db->join('t_bahan_baku', 't_bahan_baku.kode_bb = t_bb_keluar.kode_bb', 'inner');
        $this->db->join('t_supplier', 't_supplier.id_supplier = t_bahan_baku.id_supplier', 'inner');
        $this->db->join('t_kategori', 't_kategori.kode_kategori = t_bahan_baku.kode_kategori', 'inner');
        $this->db->join('t_satuan', 't_satuan.kode_satuan = t_bahan_baku.kode_satuan', 'inner');
        $this->db->order_by('t_bb_keluar.tanggal_bb_keluar ASC');
        return $this->db->get('t_bb_keluar'); 
    }

    function get_bahan_baku_keluar($kode_bb_keluar){
        $this->db->where('kode_bb_keluar', $kode_bb_keluar);
        return $this->db->get('t_bb_keluar');
    }

    function insert_bahan_baku_keluar($tabel, $data){
        $insert = $this->db->insert($tabel, $data);
        return $insert;
    }

    function update_bahan_baku_keluar($kode_bb_keluar, $data){
        $this->db->where('kode_bb_keluar', $kode_bb_keluar);
        $this->db->update('t_bb_keluar', $data);
    }

    function delete_bahan_baku_keluar($kode, $tabel){
        $this->db->where('kode_bb_keluar', $kode);
        $this->db->delete($tabel);
    }


    //PERULANGAN
    
    function getValueOfTable($tableName,$column,$where){
		$this->db->select($column);
		$this->db->from($tableName);
		
		foreach($where as $key => $value){
			$this->db->where($key,$value);
		}

		$query = $this->db->get()->row();
		return $query->$column;
	}


    //GRAFIK
    function grafik_masuk_bb($kode_bb){
        $this->db->select("SUM(jumlah_ipemesanan_bb) AS jumlah, MONTH(tanggal_masuk_ipemesanan_bb) AS bulan, YEAR(tanggal_masuk_ipemesanan_bb) AS tahun");
        $this->db->from('t_ipemesanan_bb');
        $this->db->where('kode_bb', $kode_bb);
        $this->db->where('status_ipemesanan_bb = 6');
        $this->db->group_by('bulan');
        return $this->db->get();
    }

    function grafik_keluar_bb($kode_bb){
        $this->db->select("SUM(jumlah_bb_keluar) AS jumlah, MONTH(tanggal_bb_keluar) AS bulan, YEAR(tanggal_bb_keluar) AS tahun");
        $this->db->from('t_bb_keluar');
        $this->db->where('kode_bb', $kode_bb);
        $this->db->group_by('bulan');
        return $this->db->get();
    }

    function grafik_retur_bb($kode_bb){
        $this->db->select("SUM(t_iretur_bb.jumlah_iretur_bb) AS jumlah, MONTH(t_retur_bb.tanggal_retur_bb) AS bulan, YEAR(t_retur_bb.tanggal_retur_bb) AS tahun");
        $this->db->from('t_iretur_bb');
        $this->db->join('t_retur_bb', 't_retur_bb.kode_retur_bb = t_iretur_bb.kode_retur_bb', 'left');
        $this->db->where('t_iretur_bb.kode_bb', $kode_bb);
        $this->db->group_by('bulan');
        return $this->db->get();
    }



    //LAPORAN BB
    function get_laporan_pemesanan($tanggal_awal, $tanggal_akhir, $status){ 
        $this->db->select('t_pemesanan_bb.*, t_supplier.*, t_rekening.*, t_bank.*');
        $this->db->join('t_supplier', 't_supplier.id_supplier = t_pemesanan_bb.id_supplier', 'left');
        $this->db->join('t_rekening', 't_rekening.kode_rekening = t_pemesanan_bb.kode_rekening', 'left');
        $this->db->join('t_bank', 't_bank.kode_bank = t_rekening.kode_bank', 'left');
        $this->db->where("t_pemesanan_bb.tanggal_pemesanan_bb BETWEEN '$tanggal_awal' AND '$tanggal_akhir'");
        $this->db->where("t_pemesanan_bb.status_pemesanan_bb IN($status)");
        $this->db->order_by('t_pemesanan_bb.tanggal_pemesanan_bb ASC');
        return $this->db->get('t_pemesanan_bb'); 
    }
    
    function get_laporan_masuk($tanggal_awal, $tanggal_akhir,){ 
        $this->db->select('t_pemesanan_bb.*, t_supplier.*, t_rekening.*, t_bank.*');
        $this->db->join('t_supplier', 't_supplier.id_supplier = t_pemesanan_bb.id_supplier', 'left');
        $this->db->join('t_rekening', 't_rekening.kode_rekening = t_pemesanan_bb.kode_rekening', 'left');
        $this->db->join('t_bank', 't_bank.kode_bank = t_rekening.kode_bank', 'left');
        $this->db->where("t_pemesanan_bb.tanggal_pemesanan_bb BETWEEN '$tanggal_awal' AND '$tanggal_akhir'");
        $this->db->where("t_pemesanan_bb.status_pemesanan_bb ", "5");
        $this->db->order_by('t_pemesanan_bb.tanggal_pemesanan_bb ASC');
        return $this->db->get('t_pemesanan_bb'); 
    }

    function get_laporan_keluar($tanggal_awal, $tanggal_akhir,){ 
        $this->db->select('t_bb_keluar.*, t_bahan_baku.*, t_kategori.*, t_supplier.*, t_satuan.*');
        $this->db->join('t_bahan_baku', 't_bahan_baku.kode_bb = t_bb_keluar.kode_bb', 'inner');
        $this->db->join('t_supplier', 't_supplier.id_supplier = t_bahan_baku.id_supplier', 'inner');
        $this->db->join('t_kategori', 't_kategori.kode_kategori = t_bahan_baku.kode_kategori', 'inner');
        $this->db->join('t_satuan', 't_satuan.kode_satuan = t_bahan_baku.kode_satuan', 'inner');
        $this->db->where("t_bb_keluar.tanggal_bb_keluar BETWEEN '$tanggal_awal' AND '$tanggal_akhir'");
        $this->db->order_by('t_bb_keluar.tanggal_bb_keluar ASC');
        return $this->db->get('t_bb_keluar'); 
    }

    function get_laporan_penyesuaian_stok($tanggal_awal, $tanggal_akhir,){ 
        $this->db->select('t_penyesuaian_bb.*, t_supplier.*, t_bahan_baku.*, t_kategori.*, t_satuan.*');
        $this->db->join('t_bahan_baku', 't_bahan_baku.kode_bb = t_bahan_baku.kode_bb', 'inner');
        $this->db->join('t_supplier', 't_supplier.id_supplier = t_bahan_baku.id_supplier', 'inner');
        $this->db->join('t_kategori', 't_kategori.kode_kategori = t_bahan_baku.kode_kategori', 'inner');
        $this->db->join('t_satuan', 't_satuan.kode_satuan = t_bahan_baku.kode_satuan', 'inner');
        $this->db->where("t_penyesuaian_bb.tanggal_penyesuaian_bb BETWEEN '$tanggal_awal' AND '$tanggal_akhir'");
        $this->db->order_by('t_penyesuaian_bb.tanggal_penyesuaian_bb ASC');
        return $this->db->get('t_penyesuaian_bb'); 
    }


    function get_laporan_retur($tanggal_awal, $tanggal_akhir, $status){ 
        $this->db->select('t_retur_bb.*, t_supplier.*');
        $this->db->join('t_supplier', 't_supplier.id_supplier = t_retur_bb.id_supplier', 'left');
        $this->db->where("t_retur_bb.tanggal_retur_bb BETWEEN '$tanggal_awal' AND '$tanggal_akhir'");
        $this->db->where("t_retur_bb.status_retur_bb IN($status)");
        $this->db->order_by('t_retur_bb.tanggal_retur_bb ASC');
        return $this->db->get('t_retur_bb'); 
    }


}
<?php 
defined('BASEPATH') || exit('No direct script access allowed');

class Mod_produk extends CI_Model {

    //PRODUK
    function get_all_produk(){ 
        $this->db->select('t_produk.*, t_kategori.*, t_satuan.*');
        $this->db->join('t_kategori', 't_kategori.kode_kategori = t_produk.kode_kategori', 'inner');
        $this->db->join('t_satuan', 't_satuan.kode_satuan = t_produk.kode_satuan', 'inner');
        $this->db->order_by('t_produk.nama_produk ASC');
        return $this->db->get('t_produk'); 
    }

    function get_produk($kode_produk){
        $this->db->select('t_produk.*, t_kategori.*, t_satuan.*');
        $this->db->join('t_kategori', 't_kategori.kode_kategori = t_produk.kode_kategori', 'inner');
        $this->db->join('t_satuan', 't_satuan.kode_satuan = t_produk.kode_satuan', 'inner');
        $this->db->where('kode_produk', $kode_produk);
        return $this->db->get('t_produk');
    }

    function cek_produk($nama_produk){
        $this->db->where('nama_produk', $nama_produk);
        return $this->db->get('t_produk');
    }

    function insert_produk($tabel, $data){
        $insert = $this->db->insert($tabel, $data);
        return $insert;
    }

    function update_produk($kode_produk, $data){
        $this->db->where('kode_produk', $kode_produk);
		$this->db->update('t_produk', $data);
    }

    function delete_produk($kode, $tabel){
        $this->db->where('kode_produk', $kode);
        $this->db->delete($tabel);
    }
    
    function get_gambar($kode_produk){
        $this->db->select('gambar_produk');
        $this->db->from('t_produk');
        $this->db->where('kode_produk', $kode_produk);
        return $this->db->get();
    }


    //PENYESUAIAN STOK
    function get_all_penyesuaian_produk(){ 
        $this->db->select('t_penyesuaian_produk.*, t_produk.*, t_kategori.*, t_satuan.*');
        $this->db->join('t_produk', 't_produk.kode_produk = t_penyesuaian_produk.kode_produk', 'inner');
        $this->db->join('t_kategori', 't_kategori.kode_kategori = t_produk.kode_kategori', 'inner');
        $this->db->join('t_satuan', 't_satuan.kode_satuan = t_produk.kode_satuan', 'inner');
        $this->db->order_by('t_penyesuaian_produk.tanggal_penyesuaian_produk ASC');
        return $this->db->get('t_penyesuaian_produk'); 
    }

    function get_penyesuaian_produk($kode_penyesuaian_produk){
        $this->db->where('kode_penyesuaian_produk', $kode_penyesuaian_produk);
        return $this->db->get('t_penyesuaian_produk');
    }

    function insert_penyesuaian_produk($tabel, $data){
        $insert = $this->db->insert($tabel, $data);
        return $insert;
    }

    function update_penyesuaian_produk($kode_penyesuaian_produk, $data){
        $this->db->where('kode_penyesuaian_produk', $kode_penyesuaian_produk);
        $this->db->update('t_penyesuaian_produk', $data);
    }

    function delete_penyesuaian_produk($kode, $tabel){
        $this->db->where('kode_penyesuaian_produk', $kode);
        $this->db->delete($tabel);
    }


     //PEMESANAN PRODUK
     function get_all_pemesanan_produk(){ 
        $this->db->select('t_pemesanan_produk.*, t_customer.*, t_rekening.*, t_bank.*');
        $this->db->join('t_customer', 't_customer.id_customer = t_pemesanan_produk.id_customer', 'left');
        $this->db->join('t_rekening', 't_rekening.kode_rekening = t_pemesanan_produk.kode_rekening', 'left');
        $this->db->join('t_bank', 't_bank.kode_bank = t_rekening.kode_bank', 'left');
        $this->db->order_by('t_pemesanan_produk.tanggal_pemesanan_produk ASC');
        return $this->db->get('t_pemesanan_produk'); 
    }

    function get_pemesanan_produk($kode_pemesanan_produk){
        $this->db->select('t_pemesanan_produk.*, t_customer.*, t_rekening.*, t_bank.*');
        $this->db->join('t_customer', 't_customer.id_customer = t_pemesanan_produk.id_customer', 'left');
        $this->db->join('t_rekening', 't_rekening.kode_rekening = t_pemesanan_produk.kode_rekening', 'left');
        $this->db->join('t_bank', 't_bank.kode_bank = t_rekening.kode_bank', 'left');
        $this->db->where('kode_pemesanan_produk', $kode_pemesanan_produk);
        return $this->db->get('t_pemesanan_produk');
    }

    function get_pemesanan_produk_customer($id_customer){
        $this->db->select('t_pemesanan_produk.*, t_customer.*, t_rekening.*, t_bank.*');
        $this->db->join('t_customer', 't_customer.id_customer = t_pemesanan_produk.id_customer', 'left');
        $this->db->join('t_rekening', 't_rekening.kode_rekening = t_pemesanan_produk.kode_rekening', 'left');
        $this->db->join('t_bank', 't_bank.kode_bank = t_rekening.kode_bank', 'left');
        $this->db->where('t_pemesanan_produk.id_customer', $id_customer);
        return $this->db->get('t_pemesanan_produk');
    }

    function insert_pemesanan_produk($tabel, $data){
        $insert = $this->db->insert($tabel, $data);
        return $insert;
    }

    function update_pemesanan_produk($kode_pemesanan_produk, $data){
        $this->db->where('kode_pemesanan_produk', $kode_pemesanan_produk);
		$this->db->update('t_pemesanan_produk', $data);
    }



    //PEMESANAN ITEM PRODUK
    function get_all_item_pemesanan_produk(){ 
        $this->db->select('t_ipemesanan_produk.*, t_produk.*, t_customer.*, t_kategori.*, t_satuan.*');
        $this->db->join('t_produk', 't_produk.kode_produk = t_ipemesanan_produk.kode_produk', 'left');
        $this->db->join('t_customer', 't_customer.id_customer = t_ipemesanan_produk.id_customer', 'left');
        $this->db->join('t_kategori', 't_kategori.kode_kategori = t_produk.kode_kategori', 'left');
        $this->db->join('t_satuan', 't_satuan.kode_satuan = t_produk.kode_satuan', 'left');
        $this->db->order_by('t_produk.nama_produk ASC');
        return $this->db->get('t_ipemesanan_produk'); 
    }

    function get_item_pemesanan_produk($kode_pemesanan_produk){ 
        $this->db->select('t_ipemesanan_produk.*, t_produk.*, t_customer.*, t_kategori.*, t_satuan.*');
        $this->db->join('t_produk', 't_produk.kode_produk = t_ipemesanan_produk.kode_produk', 'left');
        $this->db->join('t_customer', 't_customer.id_customer = t_ipemesanan_produk.id_customer', 'left');
        $this->db->join('t_kategori', 't_kategori.kode_kategori = t_produk.kode_kategori', 'left');
        $this->db->join('t_satuan', 't_satuan.kode_satuan = t_produk.kode_satuan', 'left');
        $this->db->where('t_ipemesanan_produk.kode_pemesanan_produk', $kode_pemesanan_produk);
        return $this->db->get('t_ipemesanan_produk'); 
    }

    function get_tanggal_kadaluwarsa($kode_pemesanan_produk){ 
        $this->db->where('kode_pemesanan_produk', $kode_pemesanan_produk);
        $this->db->where('tanggal_kadaluwarsa_ipemesanan_produk', null);
        return $this->db->get('t_ipemesanan_produk'); 
    }

    function cek_item_pemesanan_produk($kode_produk){
        $this->db->join('t_produk', 't_produk.kode_produk = t_ipemesanan_produk.kode_produk', 'left');
        $this->db->where('t_produk.kode_produk', $kode_produk);
        $this->db->where('t_ipemesanan_produk.status_ipemesanan_produk', '1');
        return $this->db->get('t_ipemesanan_produk');
    }

    function cek_item_pemesanan_produk_customer($id_customer){
        $this->db->join('t_produk', 't_produk.kode_produk = t_ipemesanan_produk.kode_produk', 'left');
        $this->db->where('t_ipemesanan_produk.id_customer', $id_customer);
        $this->db->where('t_ipemesanan_produk.status_ipemesanan_produk', '1');
        return $this->db->get('t_ipemesanan_produk');
    }

    function cek_item_retur($kode_pemesanan_produk){ 
        $this->db->where('kode_pemesanan_produk', $kode_pemesanan_produk);
        $this->db->where('status_ipemesanan_produk = 5');
        return $this->db->get('t_ipemesanan_produk'); 
    }

    function cek_item_kirim($kode_pemesanan_produk){ 
        $this->db->where('kode_pemesanan_produk', $kode_pemesanan_produk);
        $this->db->where('status_ipemesanan_produk = 3');
        return $this->db->get('t_ipemesanan_produk'); 
    }

    function insert_item_pemesanan_produk($tabel, $data){
        $insert = $this->db->insert($tabel, $data);
        return $insert;
    }

    function update_item_pemesanan_produk($kode_ipemesanan_produk, $data){
        $this->db->where('kode_ipemesanan_produk', $kode_ipemesanan_produk);
		$this->db->update('t_ipemesanan_produk', $data);
    }

    function delete_item_pemesanan_produk($kode, $tabel){
        $this->db->where('kode_ipemesanan_produk', $kode);
        $this->db->delete($tabel);
    }



    //RETUR PRODUK
    function get_all_retur_produk(){ 
        $this->db->select('t_retur_produk.*, t_customer.*');
        $this->db->join('t_customer', 't_customer.id_customer = t_retur_produk.id_customer', 'left');
        $this->db->order_by('t_retur_produk.tanggal_retur_produk ASC');
        return $this->db->get('t_retur_produk'); 
    }

    function get_retur_produk($kode_retur_produk){
        $this->db->select('t_retur_produk.*, t_customer.*');
        $this->db->join('t_customer', 't_customer.id_customer = t_retur_produk.id_customer', 'left');
        $this->db->where('kode_retur_produk', $kode_retur_produk);
        return $this->db->get('t_retur_produk');
    }

    function get_retur_produk_customer($id_customer){
        $this->db->select('t_retur_produk.*, t_customer.*');
        $this->db->join('t_customer', 't_customer.id_customer = t_retur_produk.id_customer', 'left');
        $this->db->where('t_customer.id_customer', $id_customer);
        return $this->db->get('t_retur_produk');
    }

    function insert_retur_produk($tabel, $data){
        $insert = $this->db->insert($tabel, $data);
        return $insert;
    }

    function update_retur_produk($kode_retur_produk, $data){
        $this->db->where('kode_retur_produk', $kode_retur_produk);
		$this->db->update('t_retur_produk', $data);
    }



    //RETUR ITEM PRODUK
    function get_all_item_retur_produk(){ 
        $this->db->select('t_iretur_produk.*, t_produk.*, t_kategori.*, t_satuan.*');
        $this->db->join('t_produk', 't_produk.kode_produk = t_iretur_produk.kode_produk', 'left');
        $this->db->join('t_kategori', 't_kategori.kode_kategori = t_produk.kode_kategori', 'left');
        $this->db->join('t_satuan', 't_satuan.kode_satuan = t_produk.kode_satuan', 'left');
        $this->db->order_by('t_produk.nama_produk ASC');
        return $this->db->get('t_iretur_produk'); 
    }
    
    function get_item_retur_produk($kode_retur_produk){ 
        $this->db->select('t_iretur_produk.*, t_produk.*, t_kategori.*, t_satuan.*');
        $this->db->join('t_produk', 't_produk.kode_produk = t_iretur_produk.kode_produk', 'left');
        $this->db->join('t_kategori', 't_kategori.kode_kategori = t_produk.kode_kategori', 'left');
        $this->db->join('t_satuan', 't_satuan.kode_satuan = t_produk.kode_satuan', 'left');
        $this->db->where('t_iretur_produk.kode_retur_produk', $kode_retur_produk);
        return $this->db->get('t_iretur_produk'); 
    }

    function cek_item_retur_produk($id_customer, $kode_produk){
        $this->db->where('id_customer', $id_customer);
        $this->db->where('kode_produk', $kode_produk);
        $this->db->where('status_iretur_produk = 1');
        return $this->db->get('t_iretur_produk');
    }

    function cek_item_retur_produk_customer($id_customer){
        $this->db->where('id_customer', $id_customer);
        $this->db->where('status_iretur_produk = 1');
        return $this->db->get('t_iretur_produk');
    }

    function cek_item_proses($kode_retur_produk){ 
        $this->db->where('kode_retur_produk', $kode_retur_produk);
        $this->db->where('status_iretur_produk = 2');
        return $this->db->get('t_iretur_produk'); 
    }

    function insert_item_retur_produk($tabel, $data){
        $insert = $this->db->insert($tabel, $data);
        return $insert;
    }

    function update_item_retur_produk($kode_iretur_produk, $data){
        $this->db->where('kode_iretur_produk', $kode_iretur_produk);
		$this->db->update('t_iretur_produk', $data);
    }

    function delete_item_retur_produk($kode, $tabel){
        $this->db->where('kode_iretur_produk', $kode);
        $this->db->delete($tabel);
    }

    //PRODUK MASUK
    function get_all_produk_masuk(){ 
        $this->db->select('t_produk_masuk.*, t_produk.*, t_kategori.*');
        $this->db->join('t_produk', 't_produk.kode_produk = t_produk_masuk.kode_produk', 'inner');
        $this->db->join('t_kategori', 't_kategori.kode_kategori = t_produk.kode_kategori', 'inner');
        $this->db->order_by('t_produk_masuk.tanggal_produk_masuk ASC');
        return $this->db->get('t_produk_masuk'); 
    }

    function get_produk_masuk($kode_produk_masuk){
        $this->db->where('kode_produk_masuk', $kode_produk_masuk);
        return $this->db->get('t_produk_masuk');
    }

    function insert_produk_masuk($tabel, $data){
        $insert = $this->db->insert($tabel, $data);
        return $insert;
    }

    function update_produk_masuk($kode_produk_masuk, $data){
        $this->db->where('kode_produk_masuk', $kode_produk_masuk);
        $this->db->update('t_produk_masuk', $data);
    }

    function delete_produk_masuk($kode, $tabel){
        $this->db->where('kode_produk_masuk', $kode);
        $this->db->delete($tabel);
    }


    //PRODUK KELUAR
    function get_all_produk_keluar(){ 
        $this->db->select('t_produk_keluar.*, t_produk.*, t_kategori.*');
        $this->db->join('t_produk', 't_produk.kode_produk = t_produk_keluar.kode_produk', 'inner');
        $this->db->join('t_kategori', 't_kategori.kode_kategori = t_produk.kode_kategori', 'inner');
        $this->db->order_by('t_produk_keluar.tanggal_produk_keluar ASC');
        return $this->db->get('t_produk_keluar'); 
    }

    function get_produk_keluar($kode_produk_keluar){
        $this->db->where('kode_produk_keluar', $kode_produk_keluar);
        return $this->db->get('t_produk_keluar');
    }

    function insert_produk_keluar($tabel, $data){
        $insert = $this->db->insert($tabel, $data);
        return $insert;
    }

    function update_produk_keluar($kode_produk_keluar, $data){
        $this->db->where('kode_produk_keluar', $kode_produk_keluar);
        $this->db->update('t_produk_keluar', $data);
    }

    function delete_produk_keluar($kode, $tabel){
        $this->db->where('kode_produk_keluar', $kode);
        $this->db->delete($tabel);
    }

    //GRAFIK
    function grafik_masuk_produk($kode_produk){
        $this->db->select("SUM(jumlah_produk_masuk) AS jumlah, MONTH(tanggal_produk_masuk) AS bulan, YEAR(tanggal_produk_masuk) AS tahun");
        $this->db->from('t_produk_masuk');
        $this->db->where('kode_produk', $kode_produk);
        $this->db->group_by('bulan');
        return $this->db->get();
    }

    function grafik_keluar_produk($kode_produk){
        $this->db->select("SUM(jumlah_ipemesanan_produk) AS jumlah, MONTH(tanggal_masuk_ipemesanan_produk) AS bulan, YEAR(tanggal_masuk_ipemesanan_produk) AS tahun");
        $this->db->from('t_ipemesanan_produk');
        $this->db->where('kode_produk', $kode_produk);
        $this->db->where('status_ipemesanan_produk = 6');
        $this->db->group_by('bulan');
        return $this->db->get();
    }

    function grafik_retur_produk($kode_produk){
        $this->db->select("SUM(t_iretur_produk.jumlah_iretur_produk) AS jumlah, MONTH(t_retur_produk.tanggal_retur_produk) AS bulan, YEAR(t_retur_produk.tanggal_retur_produk) AS tahun");
        $this->db->from('t_iretur_produk');
        $this->db->join('t_retur_produk', 't_retur_produk.kode_retur_produk = t_iretur_produk.kode_retur_produk', 'left');
        $this->db->where('t_iretur_produk.kode_produk', $kode_produk);
        $this->db->group_by('bulan');
        return $this->db->get();
    }

    //LAPORAN
    function get_laporan_pemesanan($tanggal_awal, $tanggal_akhir, $status){ 
        $this->db->select('t_pemesanan_produk.*, t_customer.*, t_rekening.*, t_bank.*');
        $this->db->join('t_customer', 't_customer.id_customer = t_pemesanan_produk.id_customer', 'left');
        $this->db->join('t_rekening', 't_rekening.kode_rekening = t_pemesanan_produk.kode_rekening', 'left');
        $this->db->join('t_bank', 't_bank.kode_bank = t_rekening.kode_bank', 'left');
        $this->db->where("t_pemesanan_produk.tanggal_pemesanan_produk BETWEEN '$tanggal_awal' AND '$tanggal_akhir'");
        $this->db->where("t_pemesanan_produk.status_pemesanan_produk IN($status)");
        $this->db->order_by('t_pemesanan_produk.tanggal_pemesanan_produk ASC');
        return $this->db->get('t_pemesanan_produk'); 
    }
    
    function get_laporan_masuk($tanggal_awal, $tanggal_akhir,){ 
        $this->db->select('t_pemesanan_produk.*, t_customer.*, t_rekening.*, t_bank.*');
        $this->db->join('t_customer', 't_customer.id_customer = t_pemesanan_produk.id_customer', 'left');
        $this->db->join('t_rekening', 't_rekening.kode_rekening = t_pemesanan_produk.kode_rekening', 'left');
        $this->db->join('t_bank', 't_bank.kode_bank = t_rekening.kode_bank', 'left');
        $this->db->where("t_pemesanan_produk.tanggal_pemesanan_produk BETWEEN '$tanggal_awal' AND '$tanggal_akhir'");
        $this->db->where("t_pemesanan_produk.status_pemesanan_produk ", "5");
        $this->db->order_by('t_pemesanan_produk.tanggal_pemesanan_produk ASC');
        return $this->db->get('t_pemesanan_produk'); 
    }
    
    function get_laporan_keluar($tanggal_awal, $tanggal_akhir){ 
        $this->db->select('t_produk_keluar.*, t_produk.*, t_kategori.*');
        $this->db->join('t_produk', 't_produk.kode_produk = t_produk_keluar.kode_produk', 'inner');
        $this->db->join('t_kategori', 't_kategori.kode_kategori = t_produk.kode_kategori', 'inner');
        $this->db->where("t_produk_keluar.tanggal_produk_keluar BETWEEN '$tanggal_awal' AND '$tanggal_akhir'");
        $this->db->order_by('t_produk_keluar.tanggal_produk_keluar ASC');
        return $this->db->get('t_produk_keluar'); 
    }
    
    function get_laporan_penyesuaian_stok($tanggal_awal, $tanggal_akhir){ 
        $this->db->select('t_penyesuaian_produk.*, t_produk.*, t_kategori.*');
        $this->db->join('t_produk', 't_produk.kode_produk = t_penyesuaian_produk.kode_produk', 'inner');
        $this->db->join('t_kategori', 't_kategori.kode_kategori = t_produk.kode_kategori', 'inner');
        $this->db->where("t_penyesuaian_produk.tanggal_penyesuaian_produk BETWEEN '$tanggal_awal' AND '$tanggal_akhir'");
        $this->db->order_by('t_penyesuaian_produk.tanggal_penyesuaian_produk ASC');
        return $this->db->get('t_penyesuaian_produk'); 
    }

    function get_laporan_retur($tanggal_awal, $tanggal_akhir){ 
        $this->db->select('t_retur_produk.*, t_produk.*, t_kategori.*');
        $this->db->join('t_produk', 't_produk.kode_produk = t_retur_produk.kode_produk', 'inner');
        $this->db->join('t_kategori', 't_kategori.kode_kategori = t_produk.kode_kategori', 'inner');
        $this->db->where("t_retur_produk.tanggal_retur_produk BETWEEN '$tanggal_awal' AND '$tanggal_akhir'");
        $this->db->order_by('t_retur_produk.tanggal_retur_produk ASC');
        return $this->db->get('t_retur_produk'); 
    }
}
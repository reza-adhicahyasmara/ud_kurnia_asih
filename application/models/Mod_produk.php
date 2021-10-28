<?php 
defined('BASEPATH') || exit('No direct script access allowed');

class Mod_produk extends CI_Model {

    //PRODUK
    function get_all_produk(){ 
        $this->db->select('t_produk.*, t_kategori.*');
        $this->db->join('t_kategori', 't_kategori.kode_kategori = t_produk.kode_kategori', 'inner');
        $this->db->order_by('t_produk.nama_produk ASC');
        return $this->db->get('t_produk'); 
    }

    function get_produk($kode_produk){
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
    function get_all_penyesuaian_stok_produk(){ 
        $this->db->select('t_penyesuaian_stok_produk.*, t_produk.*, t_kategori.*');
        $this->db->join('t_produk', 't_produk.kode_produk = t_penyesuaian_stok_produk.kode_produk', 'inner');
        $this->db->join('t_kategori', 't_kategori.kode_kategori = t_produk.kode_kategori', 'inner');
        $this->db->order_by('t_penyesuaian_stok_produk.tanggal_penyesuaian_stok_produk ASC');
        return $this->db->get('t_penyesuaian_stok_produk'); 
    }

    function get_penyesuaian_stok_produk($kode_penyesuaian_stok_produk){
        $this->db->where('kode_penyesuaian_stok_produk', $kode_penyesuaian_stok_produk);
        return $this->db->get('t_penyesuaian_stok_produk');
    }

    function insert_penyesuaian_stok_produk($tabel, $data){
        $insert = $this->db->insert($tabel, $data);
        return $insert;
    }

    function update_penyesuaian_stok_produk($kode_penyesuaian_stok_produk, $data){
        $this->db->where('kode_penyesuaian_stok_produk', $kode_penyesuaian_stok_produk);
        $this->db->update('t_penyesuaian_stok_produk', $data);
    }

    function delete_penyesuaian_stok_produk($kode, $tabel){
        $this->db->where('kode_penyesuaian_stok_produk', $kode);
        $this->db->delete($tabel);
    }


    //RETUR STOK
    function get_all_retur_produk(){ 
        $this->db->select('t_retur_produk.*, t_produk.*, t_kategori.*');
        $this->db->join('t_produk', 't_produk.kode_produk = t_retur_produk.kode_produk', 'inner');
        $this->db->join('t_kategori', 't_kategori.kode_kategori = t_produk.kode_kategori', 'inner');
        $this->db->order_by('t_retur_produk.tanggal_retur_produk ASC');
        return $this->db->get('t_retur_produk'); 
    }

    function get_retur_produk($kode_retur_produk){
        $this->db->where('kode_retur_produk', $kode_retur_produk);
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

    function delete_retur_produk($kode, $tabel){
        $this->db->where('kode_retur_produk', $kode);
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
        $this->db->select("SUM(jumlah_produk_keluar) AS jumlah, MONTH(tanggal_produk_keluar) AS bulan, YEAR(tanggal_produk_keluar) AS tahun");
        $this->db->from('t_produk_keluar');
        $this->db->where('kode_produk', $kode_produk);
        $this->db->group_by('bulan');
        return $this->db->get();
    }


    //LAPORAN
    function get_laporan_masuk($tanggal_awal, $tanggal_akhir){ 
        $this->db->select('t_produk_masuk.*, t_produk.*, t_kategori.*');
        $this->db->join('t_produk', 't_produk.kode_produk = t_produk_masuk.kode_produk', 'inner');
        $this->db->join('t_kategori', 't_kategori.kode_kategori = t_produk.kode_kategori', 'inner');
        $this->db->where("t_produk_masuk.tanggal_produk_masuk BETWEEN '$tanggal_awal' AND '$tanggal_akhir'");
        $this->db->order_by('t_produk_masuk.tanggal_produk_masuk ASC');
        return $this->db->get('t_produk_masuk'); 
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
        $this->db->select('t_penyesuaian_stok_produk.*, t_produk.*, t_kategori.*');
        $this->db->join('t_produk', 't_produk.kode_produk = t_penyesuaian_stok_produk.kode_produk', 'inner');
        $this->db->join('t_kategori', 't_kategori.kode_kategori = t_produk.kode_kategori', 'inner');
        $this->db->where("t_penyesuaian_stok_produk.tanggal_penyesuaian_stok_produk BETWEEN '$tanggal_awal' AND '$tanggal_akhir'");
        $this->db->order_by('t_penyesuaian_stok_produk.tanggal_penyesuaian_stok_produk ASC');
        return $this->db->get('t_penyesuaian_stok_produk'); 
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
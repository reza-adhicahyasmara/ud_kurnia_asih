<?php 
defined('BASEPATH') || exit('No direct script access allowed');

class Mod_bank extends CI_Model {

    // DATA BANK
    function get_all_bank(){ 
        $this->db->order_by('nama_bank ASC');
        return $this->db->get('t_bank'); 
    }

    function get_bank($kode_bank){
        $this->db->where('kode_bank', $kode_bank);
        $this->db->order_by('nama_bank ASC');
        return $this->db->get('t_bank');
    }

    function insert_bank($tabel, $data){
        $insert = $this->db->insert($tabel, $data);
        return $insert;
    }

    function update_bank($kode_bank, $data){
        $this->db->where('kode_bank', $kode_bank);
		$this->db->update('t_bank', $data);
    }

    function delete_bank($kode, $tabel){
        $this->db->where('kode_bank', $kode);
        $this->db->delete($tabel);
    } 
    

    // REKENING BANK
    function get_all_rekening(){ 
        $this->db->select('t_bank.*, t_rekening.*');
        $this->db->join('t_bank', 't_bank.kode_bank = t_rekening.kode_bank');
        $this->db->order_by('t_bank.nama_bank ASC');
        return $this->db->get('t_rekening'); 
    }

    function get_rekening($kode_rekening){
        $this->db->select('t_bank.*, t_rekening.*');
        $this->db->join('t_bank', 't_bank.kode_bank = t_rekening.kode_bank');
        $this->db->where('kode_rekening', $kode_rekening);
        $this->db->order_by('t_bank.nama_bank ASC');
        return $this->db->get('t_rekening');
    }
    
    function get_rekening_sup($id_supplier){
        $this->db->select('t_bank.*, t_rekening.*');
        $this->db->join('t_bank', 't_bank.kode_bank = t_rekening.kode_bank');
        $this->db->where('id_supplier', $id_supplier);
        $this->db->order_by('t_bank.nama_bank ASC');
        return $this->db->get('t_rekening');
    }

    function get_rekening_cus($id_customer){
        $this->db->select('t_bank.*, t_rekening.*');
        $this->db->join('t_bank', 't_bank.kode_bank = t_rekening.kode_bank');
        $this->db->where('id_customer', $id_customer);
        $this->db->order_by('t_bank.nama_bank ASC');
        return $this->db->get('t_rekening');
    }

    function get_rekening_p(){
        $this->db->select('t_bank.*, t_rekening.*');
        $this->db->join('t_bank', 't_bank.kode_bank = t_rekening.kode_bank');
        $this->db->where('id_customer', '');
        $this->db->order_by('t_bank.nama_bank ASC');
        return $this->db->get('t_rekening');
    }

    function insert_rekening($tabel, $data){
        $insert = $this->db->insert($tabel, $data);
        return $insert;
    }

    function update_rekening($kode_rekening, $data){
        $this->db->where('kode_rekening', $kode_rekening);
		$this->db->update('t_rekening', $data);
    }

    function delete_rekening($kode, $tabel){
        $this->db->where('kode_rekening', $kode);
        $this->db->delete($tabel);
    } 
}
<?php 
defined('BASEPATH') || exit('No direct script access allowed');

class Mod_supplier extends CI_Model {

    //SUPPLIER
    function get_all_supplier(){ 
        $this->db->order_by('nama_supplier ASC');
        return $this->db->get('t_supplier'); 
    }

    function get_supplier($id_supplier){
        $this->db->where('id_supplier', $id_supplier);
        $this->db->order_by('nama_supplier ASC');
        return $this->db->get('t_supplier');
    }
    
    function cek_user_supplier($username_supplier){
        $this->db->where('username_supplier', $username_supplier);
        return $this->db->get('t_supplier');
    }

    function insert_supplier($tabel, $data){
        $insert = $this->db->insert($tabel, $data);
        return $insert;
    }

    function update_supplier($id_supplier, $data){
        $this->db->where('id_supplier', $id_supplier);
		$this->db->update('t_supplier', $data);
    }

    function delete_supplier($kode, $tabel){
        $this->db->where('id_supplier', $kode);
        $this->db->delete($tabel);
    }

    function get_gambar($id_supplier){
        $this->db->select('foto_supplier');
        $this->db->from('t_supplier');
        $this->db->where('id_supplier', $id_supplier);
        return $this->db->get();
    }

    function auth_supplier($username, $password){
        $this->db->where('username_supplier', $username);
        $this->db->where('password_supplier', $password);
        return $this->db->get('t_supplier');
    }
}
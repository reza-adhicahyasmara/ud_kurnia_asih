<?php 
defined('BASEPATH') || exit('No direct script access allowed');

class Mod_Customer extends CI_Model {

    //CUSTOMER
    function get_all_customer(){ 
        $this->db->order_by('nama_customer ASC');
        return $this->db->get('t_customer'); 
    }

    function get_customer($id_customer){
        $this->db->where('id_customer', $id_customer);
        $this->db->order_by('nama_customer ASC');
        return $this->db->get('t_customer');
    }
    
    function cek_user_customer($username_customer){
        $this->db->where('username_customer', $username_customer);
        return $this->db->get('t_customer');
    }

    function insert_customer($tabel, $data){
        $insert = $this->db->insert($tabel, $data);
        return $insert;
    }

    function update_customer($id_customer, $data){
        $this->db->where('id_customer', $id_customer);
		$this->db->update('t_customer', $data);
    }

    function delete_customer($kode, $tabel){
        $this->db->where('id_customer', $kode);
        $this->db->delete($tabel);
    }

    function get_gambar($id_customer){
        $this->db->select('foto_customer');
        $this->db->from('t_customer');
        $this->db->where('id_customer', $id_customer);
        return $this->db->get();
    }

    function auth_customer($username, $password){
        $this->db->where('username_customer', $username);
        $this->db->where('password_customer', $password);
        return $this->db->get('t_customer');
    }
}
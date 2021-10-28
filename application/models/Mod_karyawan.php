<?php 
defined('BASEPATH') || exit('No direct script access allowed');

class Mod_karyawan extends CI_Model {

    function get_all_karyawan(){ 
        $this->db->order_by('nama_karyawan ASC');
        return $this->db->get('t_karyawan'); 
    }

    function get_karyawan($nik_karyawan){
        $this->db->where('nik_karyawan', $nik_karyawan);
        $this->db->order_by('nama_karyawan ASC');
        return $this->db->get('t_karyawan');
    }

    function get_karyawan_username($username_karyawan){
        $this->db->where('username_karyawan', $username_karyawan);
        return $this->db->get('t_karyawan');
    }

    function insert_karyawan($tabel, $data){
        $insert = $this->db->insert($tabel, $data);
        return $insert;
    }

    function update_karyawan($nik_karyawan, $data){
        $this->db->where('nik_karyawan', $nik_karyawan);
		$this->db->update('t_karyawan', $data);
    }

    function delete_karyawan($kode, $tabel){
        $this->db->where('nik_karyawan', $kode);
        $this->db->delete($tabel);
    }

    function get_gambar($nik_karyawan){
        $this->db->select('foto_karyawan');
        $this->db->from('t_karyawan');
        $this->db->where('nik_karyawan', $nik_karyawan);
        return $this->db->get();
    }

    function auth_karyawan($username, $password){
        $this->db->where('username_karyawan', $username);
        $this->db->where('password_karyawan', $password);
        return $this->db->get('t_karyawan');
    }

}
<?php 
defined('BASEPATH') || exit('No direct script access allowed');

class Mod_proposal extends CI_Model {

    function get_all_proposal_supplier(){ 
        $this->db->select('t_proposal.*, t_supplier.*');
        $this->db->join('t_supplier', 't_supplier.id_supplier = t_proposal.id', 'left');
        $this->db->order_by('t_proposal.tanggal_proposal ASC');
        return $this->db->get('t_proposal'); 
    }
    
    function get_proposal_supplier($id_supplier){ 
        $this->db->select('t_proposal.*, t_supplier.*');
        $this->db->join('t_supplier', 't_supplier.id_supplier = t_proposal.id', 'left');
        $this->db->where('t_proposal.id', $id_supplier);
        $this->db->order_by('t_proposal.tanggal_proposal ASC');
        return $this->db->get('t_proposal'); 
    }

    function get_proposal($kode_proposal){
        $this->db->where('kode_proposal', $kode_proposal);
        return $this->db->get('t_proposal');
    }

    function insert_proposal($tabel, $data){
        $insert = $this->db->insert($tabel, $data);
        return $insert;
    }

    function update_proposal($kode_proposal, $data){
        $this->db->where('kode_proposal', $kode_proposal);
		$this->db->update('t_proposal', $data);
    }

    function delete_proposal($kode, $tabel){
        $this->db->where('kode_proposal', $kode);
        $this->db->delete($tabel);
    }

}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role_model extends CI_Model {
    function hapus_data($where, $table){
        $this->db->where($where);
	    $this->db->delete($table);
    }
    function edit_data($where,$table){		
        return $this->db->get_where($table,$where);
    }
    function update_data($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
    }
    function edit_role_data($where,$table){		
        return $this->db->get_where($table,$where);
    }
    function update_role_data($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
    }
}
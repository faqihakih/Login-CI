<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model {
    public function getSubMenu(){
        $query = "SELECT user_sub_menu.* , user_menu.menu
        FROM user_sub_menu JOIN user_menu
        ON user_sub_menu.menu_id = user_menu.id";

        return $this->db->query($query)->result_array();
    }
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
    function edit_data_submenu($where,$table){		
        return $this->db->get_where($table,$where);
    }
    function update_data_submenu($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}
}
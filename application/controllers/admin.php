<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    public function __construct(){
        parent::__construct();
        is_logged_in();
    }
    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
        
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar',$data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }
    public function role(){

        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
        
        $data['role'] = $this->db->get('user_role')->result_array();
        
        $this->form_validation->set_rules('role','Role','required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header',$data);
            $this->load->view('templates/sidebar',$data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/footer');
        }else{
            $this->db->insert('user_role', ['role' => $this->input->post('role')]);
            $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
            New Role Added
            </div>');
            redirect('admin/role');
        }        
    }
    public function hapusRole($id){
        $this->load->model('Role_model','role');
        $where = array('id' => $id);
        $this->role->hapus_data($where, "user_role");
        $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
            Role has been deleted
            </div>');
        redirect('admin/role');
    }
    function editRole($id){
        $data['title'] = 'Edit Role';
        $data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
        
        $data['role'] = $this->db->get('user_role')->result_array();
        $this->load->model('Role_model','role');
        $where = array('id' => $id);
        $data['role'] = $this->role->edit_data($where,'user_role')->result();


        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar',$data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/v_editRole',$data);
        $this->load->view('templates/footer');
    }

    function update(){
        $this->load->model('Role_model','role');
        $id = $this->input->post('id');
        $role = $this->input->post('role');
    
        $data = array(
            'id' => $id,
            'role' => $role
        );
    
        $where = array(
            'id' => $id
        );
    
        $this->role->update_data($where,$data,'user_role');
        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
            Role has been Edited
            </div>');
        redirect('admin/role');
    }

    public function roleaccess($role_id){

        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
        
        $data['role'] = $this->db->get_where('user_role', [
            'id' => $role_id
        ])->row_array();

        $this->db->where('id !=', 1);

        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar',$data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
        
    }

    public function changeAccess(){
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Access Changed!</div>');
    }

    public function changeuserrole(){
        $data['title'] = 'Change User Role';
        $data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
        

        $data['role'] = $this->db->get('user')->result_array();
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar',$data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/change-role', $data);
        $this->load->view('templates/footer');
    }

    function editUserRole($id){
        $data['title'] = 'Edit User Role';
        $data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
        
        $data['role'] = $this->db->get('user')->result_array();
        $this->load->model('Role_model','role');
        $where = array('id' => $id);
        $data['role'] = $this->role->edit_role_data($where,'user')->result();


        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar',$data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/v_editUserRole',$data);
        $this->load->view('templates/footer');
    }

    function updateUserRole(){
        $this->load->model('Role_model','role');
        $id = $this->input->post('id');
        $role = $this->input->post('role_id');
    
        $data = array(
            'id' => $id,
            'role_id' => $role
        );
    
        $where = array(
            'id' => $id
        );
    
        $this->role->update_role_data($where,$data,'user');
        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
            Role has been Edited
            </div>');
        redirect('admin/changeuserrole');
    }
}
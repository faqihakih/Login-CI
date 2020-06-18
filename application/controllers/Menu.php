<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {
    public function __construct(){
        parent::__construct();
        is_logged_in();
    }
    public function index()
    {
        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
        
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('menu','Menu','required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header',$data);
            $this->load->view('templates/sidebar',$data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        }else{
            $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
            New Menu Added
            </div>');
            redirect('menu');
        }        
    }
    public function hapusMenu($id){
        $this->load->model('Menu_model','menu');
        $where = array('id' => $id);
        $this->menu->hapus_data($where, "user_menu");
        redirect('menu/');
    }
    function editMenu($id){
        $data['title'] = 'Edit Menu';
        $data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
        
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $this->load->model('Menu_model','menu');
        $where = array('id' => $id);
        $data['menu'] = $this->menu->edit_data($where,'user_menu')->result();


        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar',$data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/v_editMenu',$data);
        $this->load->view('templates/footer');
    }

    function update(){
        $this->load->model('Menu_model','menu');
        $id = $this->input->post('id');
        $menu = $this->input->post('menu');
    
        $data = array(
            'id' => $id,
            'menu' => $menu
        );
    
        $where = array(
            'id' => $id
        );
    
        $this->menu->update_data($where,$data,'user_menu');
        redirect('menu');
    }
    public function submenu()
    {
        $data['title'] = 'Submenu Management';
        $data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Menu_model','menu');
        $data['subMenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('title','Title','required');
        $this->form_validation->set_rules('menu_id','Menu','required');
        $this->form_validation->set_rules('url','Url','required');
        $this->form_validation->set_rules('icon','Icon','required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header',$data);
            $this->load->view('templates/sidebar',$data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        }else{
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
            New Submenu Added
            </div>');
            redirect('menu/submenu');
        }        
    }
    public function hapusSubmenu($id){
        $this->load->model('Menu_model','menu');
        $where = array('id' => $id);
        $this->menu->hapus_data($where, "user_sub_menu");
        redirect('menu/submenu');
    }
    function editSubmenu($id){
        $data['title'] = 'Edit Submenu';
        $data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
        
        $data['subMenu'] = $this->db->get('user_sub_menu')->result_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $this->load->model('Menu_model','menu');
        $where = array('id' => $id);
        $data['subMenu'] = $this->menu->edit_data_submenu($where,'user_sub_menu')->result();


        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar',$data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/v_editSubmenu',$data);
        $this->load->view('templates/footer');
    }

    function updateSubmenu(){
        $this->load->model('Menu_model','menu');
        $id = $this->input->post('id');
        $menu_id = $this->input->post('menu_id');
        $title = $this->input->post('title');
        $url = $this->input->post('url');
        $icon = $this->input->post('icon');
        $is_active = $this->input->post('is_active');
    
        $data = array(
            'id' => $id,
            'menu_id' => $menu_id,
            'title' => $title,
            'url' => $url,
            'icon' => $icon,
            'is_active' => $is_active,

        );
    
        $where = array(
            'id' => $id
        );
    
        $this->menu->update_data_submenu($where,$data,'user_sub_menu');
        redirect('menu/submenu');
    }
}
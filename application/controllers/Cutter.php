<?php

class Cutter extends CI_Controller
{

    // Редиректим если обратились по короткой ссылке
    public function uget($cut)
    {
        $this->load->model('cutter_model');
        $url = $this->cutter_model->get_url($cut);
        $data['add'] = $url['orig'];
        $this->load->view('uget', $data);
    }
    
    // Делаем новую укороченную ссылку
    public function unew()
    {
        if (isset($_POST['orig'])) {
        $this->load->model('cutter_model');
        $new_url = $this->cutter_model->create_url($_POST['orig']);
        $data['add'] = base_url().'index.php/cutter/uget/'.$new_url;
        $this->load->view('unew', $data);
        }
        else {
            $this->index();
        }
        
    }
    
    public function index()
    {
        $this->load->view('main');
    }
}
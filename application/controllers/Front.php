<?php

class Front extends CI_Controller{
    
    public function index(){
        $this->load->view("index.php");
    }
}
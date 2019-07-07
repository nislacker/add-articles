<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('articles_model');
    }

    public function index()
    {
		$this->load->view('form');
    }

    public function create_articles_from_DB()
    {
        $data['articles'] = $this->articles_model->get_articles();



        $this->load->view('create_articles', $data);
    }
}

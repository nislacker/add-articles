<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller
{
    public function index()
    {
		$this->load->view('form');
    }

    public function create_articles_from_DB()
    {
        $this->load->view('create_articles');
    }
}

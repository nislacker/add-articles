<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('articles_model');
        $this->load->database();
    }

    public function index()
    {
        $this->load->view('form');
        $this->load->view('templates/footer');
    }

    public function max_row_id($table_name)
    {
        $maxId = false;
        $row = $this->db->query("SELECT MAX(id) AS `maxId` FROM `$table_name`")->row();
        if ($row) {
            $maxId = $row->maxId;
        }
        return $maxId;
    }

    public function create_articles_from_DB()
    {
        if (isset($_POST['submit'])) {
            if (isset($_POST['start_index'])) {
                $start_index = $_POST['start_index'];

                $maxId = $this->max_row_id("articles");

                if ($start_index > $maxId) {
                    echo "Значение id-строки превышает существующее.";
                    die;
                }

                $this->articles_model->save_db_data_to_files($start_index);
            }
        }

        $data['articles'] = $this->articles_model->get_articles();
        $this->load->view('create_articles', $data);
        $this->load->view('templates/footer');
    }

    public function save_form_data_to_db()
    {
        $this->articles_model->save_form_data_to_db();
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
}

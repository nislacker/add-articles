<?php

class Articles_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_articles($file_name = false)
    {
        if ($file_name === false) {
            $query = $this->db->order_by('id', 'desc')->get('articles');
            return $query->result_array();
        }

        $query = $this->db->get_where('articles', array('file_name' => $file_name));
        return $query->row_array();
    }
}
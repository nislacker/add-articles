<?php

class Articles_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_articles($id = false)
    {
        if ($id === false) {
            $query = $this->db->order_by('id', 'desc')->get('articles');
            return $query->result_array();
        }

        $query = $this->db->get_where('articles', array('id' => $id));
        return $query->row_array();
    }

    public function save_form_data_to_db()
    {
        $filesTemplatesNames['ru'] = APPPATH . "/views/ru template.html";
        $filesTemplatesNames['ua'] = APPPATH . "/views/ua template.html";

        // if submit doesn't pressed yet
        if (!isset($_POST['submit'])) {
            die;
        }

        if (!isset($_POST['fileName']) || ($_POST['fileName'] == '')) {
            echo 'Введи "File name"';
            die;
        }

        if (!isset($_POST['title']) || ($_POST['title'] == '')) {
            echo 'Введи Title';
            die;
        }

        if (!isset($_POST['description']) || ($_POST['description'] == '')) {
            echo 'Введи Description';
            die;
        }

        if (!isset($_POST['h1']) || ($_POST['h1'] == '')) {
            echo 'Введи H1';
            die;
        }

        $fileName = trim($_POST['fileName']);
        $title = trim($_POST['title']);
        $description = trim($_POST['description']);
        $h1 = trim($_POST['h1']);
        $text = '';

        if (isset($_POST['text']) && ($_POST['text'] != '')) {
            $text = trim($_POST['text']);
        }

        $data = array(
            'file_name' => $fileName,
            'title' => $title,
            'description' => $description,
            'h1' => $h1,
            'text' => $text
        );

        $this->db->insert('articles', $data);
    }

    public function save_db_data_to_files($start_id = 1)
    {
        $filesTemplatesNames['ru'] = APPPATH . "/views/ru template.html";
        $filesTemplatesNames['ua'] = APPPATH . "/views/ua template.html";

        $filesTemplatesTexts['ru'] = file_get_contents($filesTemplatesNames['ru']);
        $filesTemplatesTexts['ua'] = file_get_contents($filesTemplatesNames['ua']);

        $articles = $this->db->query("SELECT `file_name`, `title`, `description`, `h1`, `text` FROM `articles` WHERE `id` >= $start_id")->result_array();

        foreach ($articles as $article) {

            $fileName = $article['file_name'];

            $filesNames['ru'] = APPPATH . "/views/ru/" . $fileName . ".html";
            $filesNames['ua'] = APPPATH . "/views/ua/" . $fileName . ".html";

            $filesTexts['ru'] = mb_convert_encoding($filesTemplatesTexts['ru'], 'utf-8', 'Windows-1251');
            $filesTexts['ua'] = mb_convert_encoding($filesTemplatesTexts['ua'], 'utf-8', 'Windows-1251');

            // START Replaces

            $filesTexts['ua'] = str_replace(array('{TITLE}', '{DESCRIPTION}', '{H1}', '{TEXT}'),
                array($article['title'], $article['description'], $article['h1']), $filesTexts['ua']);

            $filesTexts['ru'] = str_replace(array('{TITLE}', '{DESCRIPTION}', '{H1}', '{TEXT}'),
                array($article['title'], $article['description'], $article['h1']), $filesTexts['ru']);

            if (isset($article['text']) && ($article['text'] != '')) {
                $filesTexts['ru'] = str_replace('{TEXT}', $article['text'], $filesTexts['ru']);
                $filesTexts['ua'] = str_replace('{TEXT}', $article['text'], $filesTexts['ua']);
            }

            // END Replaces

            $filesTexts['ru'] = mb_convert_encoding($filesTexts['ru'], 'Windows-1251', 'utf-8');
            $filesTexts['ua'] = mb_convert_encoding($filesTexts['ua'], 'Windows-1251', 'utf-8');

            file_put_contents($filesNames['ru'], $filesTexts['ru']);
            file_put_contents($filesNames['ua'], $filesTexts['ua']);
        }

        echo <<<JAVASCRIPT
<script>
    alert('Files created!');
</script>
JAVASCRIPT;
    }
}
<?php

class Cutter_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    function rand_url()
    {
        $arr = array(
            'a','b','c','d','e','f','g','h','i','j','k','l',
            'm','n','o','p','r','s','t','u','v','w','x','y',
            'z','A','B','C','D','E','G','H','I','J','K','L',
            'M','N','O','P','R','S','T','U','V','W','X','Y',
            'Z','F','1','2','3','4','5','6','7','8','9','0');
        $url = '';
        for ($i = 0; $i < 6; $i ++) {
            $random = rand(0, count($arr) - 1);
            $url .= $arr[$random];
        }
        return $url;
    }

    public function get_url($cut)
    {
        if ($cut != FALSE) {
            $query = $this->db->get_where('urls', array(
                'cut' => $cut
            ));            
            return $query->row_array();
        } else {
            return FALSE;
        }
    }

    public function create_url($orig)
    {
        $url_real = htmlspecialchars($orig);
        do {
            $url_random = $this->rand_url();
            $q = $this->db->query("SELECT * FROM `urls` where `cut`='$url_random'");
        } while ($q->num_rows() > 0);
        $this->db->query("INSERT INTO `urls`(cut,orig) VALUES('$url_random','$url_real')");
        return $url_random;
    }
}
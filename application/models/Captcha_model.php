
<?php

class Captcha_model extends CI_Model
{
    function insert($data)
    {
        $this->db->insert('keys', $data);
    }

    function getdata()
    {
        return $this->db->get('tblcustomer')->result_array();
    }
}

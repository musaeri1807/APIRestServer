<?php

class Customer_model extends CI_Model
{
    public function getCustomer($id = null)
    {
        if ($id === null) {
            return $this->db->get('tblcustomer')->result_array();
        } else {
            return $this->db->get_where('tblcustomer', ['field_customer_id' => $id])->result_array();
        }
    }
    public function getusers($id=null){

        if ($id===null){

            return $this->db->get('tbluserlogin')->result_array();
            
        }else{
            return $this->db->get_where('tbluserlogin', ['field_user_id' => $id])->result_array();
        }
    }
}

<?php
class M_users extends CI_model
{
    public function getUsers($email, $password = NULL)
    {

        if ($password === NULL) {
            $SQL = "SELECT * FROM tbluserlogin WHERE field_email='{$email}'";
            $data = $this->db->Query($SQL);
            return $data->result_array();
        }else{
            $SQL = "SELECT * FROM tbluserlogin WHERE field_email='{$email}' AND Password='{$password}'";
            $data = $this->db->Query($SQL);
            return $data->result_array();

        }



        // $SQL="SELECT * FROM tbluserlogin";
        // $data=$this->db->Query($SQL);
        // return $data->result_array();

    }
}




// class M_users extends CI_Model
// {
//     public function getUsers($id = null)
//     {
//         if ($id === null) {
//             return $this->db->get('tbluserlogin')->result_array();
//         } else {
//             return $this->db->get_where('tbluserlogin', ['field_user_id' => $id])->result_array();
//         }
//     }

// }

<?php 

class M_branch extends CI_Model
{
    public function getBranch()
    {
        return $this->db->get('tblbranch');
        // $sql="SELECT *

            
        //      FROM tblbranch";            
        //     $data = $this->db->query($sql);
        //     return $data->result_array();
       
    }
}
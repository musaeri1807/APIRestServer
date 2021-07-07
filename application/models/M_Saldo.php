<?php

class M_Saldo extends CI_Model
{
    public function getSaldo($id = null)
    {
        if ($id===null) {
            return $this->db->get('tbltrxmutasisaldo',5)->result_array();
            // $sql="SELECT *FROM tbltrxmutasisaldo WHERE field_member_id='085799990456'";
            
            // $data = $this->db->query($sql);
            // return $data->result_array();
        }else{            
            //return $this->db->get_where('tbltrxmutasisaldo',['field_member_id'=>$id],'ORDER BY field_id_saldo DESC LIMIT 1')->result_array();
            $sql="SELECT field_id_saldo,
                         field_trx_id,
                         field_member_id,
                         field_no_referensi,
                         field_rekening

            
             FROM tbltrxmutasisaldo WHERE field_member_id='{$id}' ORDER BY field_id_saldo DESC LIMIT 1 ";            
            $data = $this->db->query($sql);
            return $data->result_array();

        }

    }
    
}
// $sql = " SELECT pegawai.id AS id, pegawai.nama AS pegawai, pegawai.telp AS telp, kota.nama AS kota, kelamin.nama AS kelamin, posisi.nama AS posisi FROM pegawai, kota, kelamin, posisi WHERE pegawai.id_kelamin = kelamin.id AND pegawai.id_posisi = posisi.id AND pegawai.id_kota = kota.id AND pegawai.id_posisi={$id}";



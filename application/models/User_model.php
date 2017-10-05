<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

   public function getdata($where)
   {      
      $this->db->select('*');
      $this->db->from('tb_user');
      if(!empty($where)){
        $this->db->where($where);      
      }

      $this->query = $this->db->get();
      $hsl=array();
      if($this->query->num_rows()>0)
      {
        foreach($this->query->result_array() as $row)
        {
           $hsl[]=$row;
        }
      }
      return $hsl; 
   }

   

   public function insertdata($data)
   {
     $tmp['id_wisuda']=date('YmdHis');;
     $tmp['nim']=$data['nim'];
     $tmp['ktp']=$data['ktp'];
     $tmp['nama']=$data['nama'];
     $tmp['tgl_lahir']=date('Y-m-d', strtotime($data['tgl']));
     $tmp['jk']=$data['jk'];
     $tmp['angkatan']=$data['ang'];
     $tmp['id_prodi']=$data['prodi'];
     $tmp['user_name']=$data['user'];
     $tmp['user_pass']=md5($data['pass']);
     $tmp['tgl_input']=date('Y-m-d H:i:s');
     $tmp['tgl_update']=date('Y-m-d H:i:s');

     $this->db->insert('tb_wisudawan',$tmp);

   }

   public function updatedata($data)
   {
     foreach ($data as $key => $value) {
       $this->db->set($key,$value);  
     }
     
     $this->db->where('id_wisuda',$data['id_wisuda']);
     $this->db->update('tb_wisudawan');
   }


   

}
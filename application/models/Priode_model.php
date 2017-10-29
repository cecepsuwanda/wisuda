<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Priode_model extends CI_Model {

   public function getdata($where)
   {      
      $this->db->select('*');
      $this->db->from('tb_priode');
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
     if($data['aktif']==1)
     {
       $this->db->set('aktif',0);
       $this->db->update('tb_priode'); 
     }
     $this->db->insert('tb_priode',$data);
   }

   public function updatedata($data)
   {
     if($data['aktif']==1)
     {
       $this->db->set('aktif',0);
       $this->db->update('tb_priode'); 
     }
     
     foreach ($data as $key => $value) {
       $this->db->set($key,$value);  
     }     
     
     $this->db->where('id',$data['id']);
     $this->db->update('tb_priode');
   }

   public function deletedata($id)
   {
     $this->db->where('id', $id);
     $this->db->delete('tb_priode');
   }

}
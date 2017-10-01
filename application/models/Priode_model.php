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

}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fakultas_model extends CI_Model {

   public function getdata($where)
   {      
      $this->db->select('*');
      $this->db->from('tb_fak');
      if(!empty($where)){
        $this->db->where($where);      
      }
        $this->db->order_by('urut_fak');
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
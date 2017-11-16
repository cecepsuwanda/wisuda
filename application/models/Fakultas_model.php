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

   private function build_tag_db($data)
   {
      $table=array();
      if(!empty($data))       
      {
          
          foreach ($data as $row) {
            $tmp=array();          
            $tmp[]=array($row['id_fak'],array());                   
            $tmp[]=array($row['nm_fak'],array());
            $tmp[]=array($row['urut_fak'],array());
            $tmp[]=array("<a onclick='' href='javascript:void(0);'>Edit</a><br>
                          <a onclick='' href='javascript:void(0);'>Delete</a>",array());                   
            $table[]=$tmp;          
         }
      }
      $tmp=array();
      $tmp[]=array('[Id]',array());
      $tmp[]=array('[Nama]',array());
      $tmp[]=array('[Urut]',array());
      $tmp[]=array("<a onclick='' href='javascript:void(0);'>Add</a><br>",array());
      $table[]=$tmp;
      return $table;
   }

   public function getsettingfak()
   {
      $data = $this->getdata('');
      $tmp = $this->build_tag_db($data); 
      return $tmp;
   }

}
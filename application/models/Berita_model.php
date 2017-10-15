<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Berita_model extends CI_Model {

   public function getdata($where)
   {      
      $this->db->select('*');
      $this->db->from('tb_berita');
      if(!empty($where)){
        $this->db->where($where);      
      }

      $this->db->order_by('tgl_post desc');

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
        $tmp['id_berita']=date('YmdHis');
        $tmp['isi_berita']=$data['isi_berita'];
        $tmp['tgl_post']= date('Y-m-d H:i:s');

        $this->db->insert('tb_berita',$tmp);

   }

   public function deletedata($data)
   {
       $this->db->where('id_berita', $data['id_berita']);
       $this->db->delete('tb_berita');

   }

   public function updatedata($data)
   {
     $this->db->set('isi_berita',$data['isi_berita']);  
     $this->db->set('tgl_post',date('Y-m-d H:i:s'));  
     $this->db->where('id_berita',$data['id_berita']);
     $this->db->update('tb_berita');
   }

 }
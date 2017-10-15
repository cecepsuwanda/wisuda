<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wisudawan_model extends CI_Model {

   public function getdata($where)
   {      
      $this->db->select('*');
      $this->db->from('tb_wisudawan');
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

   public function getwisudawan_jn_prodi($where)
   {      
      
      $this->db->select('nim,nama,fak_prodi,nm_prodi,kwitansi,ket');
      $this->db->from('tb_wisudawan a'); 
      $this->db->join('tb_prodi b', 'a.id_prodi=b.id_prodi');

      if(!empty($where)){
        $this->db->where($where);      
      }

      $this->db->order_by('a.tgl_update desc,a.tgl_input desc');

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

   public function getwisudawan_jn_prodi_admin($where)
   {      
      
      $this->db->select('photo,id_wisuda,nim,nama,tgl_byr,kwitansi,fak_prodi,nm_prodi,ket');
      $this->db->from('tb_wisudawan a'); 
      $this->db->join('tb_prodi b', 'a.id_prodi=b.id_prodi');

      if(!empty($where)){
        $this->db->where($where);      
      }

      $this->db->order_by('a.tgl_update desc,a.tgl_input desc,b.urut_prodi asc');

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

   public function rekapperprodi()
   {
      $this->db->select('a.id_prodi,nm_prodi,COUNT(*) as jml_calon,sum(if((kwitansi is not null)or(tgl_byr is not null),1,0)) as jml_layak,sum(if(ver=1,1,0)) as jml_ver');
      $this->db->from('tb_prodi a'); 
      $this->db->join('tb_wisudawan b', 'a.id_prodi=b.id_prodi');
      $this->db->group_by('a.id_prodi');
        
     
    if(!empty($where)){
        $this->db->where($where);      
      }

      $this->db->order_by('a.urut_prodi');

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
     $tmp['id_wisuda']=date('YmdHis');
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
     
     $this->db->set('tgl_update',date('Y-m-d H:i:s'));  
     $this->db->where('id_wisuda',$data['id_wisuda']);
     $this->db->update('tb_wisudawan');
   }


   public function jml($where)
   {
   	  $this->db->select('sum(if(ver=0,1,0)) as jml1,sum(if(ver=1,1,0)) as jml2,SUM(IF((kwitansi is not NULL) or (tgl_byr is not null),1,0)) AS jml3');
      $this->db->from('tb_wisudawan');

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
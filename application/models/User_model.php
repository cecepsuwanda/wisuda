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

   private function build_tag_db($data)
   {
      $table=array();
      if(!empty($data))       
      {
          $i=1;
          foreach ($data as $row) {
            $tmp=array();          
            $tmp[]=array($i++,array());                   
            $tmp[]=array($row['user_name'],array());
            $tmp[]=array("<a onclick='' href='javascript:void(0);'>Edit</a>".($row['user_name'] == 'admin' ? "":
                         "<br><a onclick='' href='javascript:void(0);'>Delete</a>"),array());                   
            $table[]=$tmp;          
         }
      }
      $tmp=array();
      $tmp[]=array('[No]',array());
      $tmp[]=array('[Admin Name]',array());
      $tmp[]=array("<a onclick='' href='javascript:void(0);'>Add</a><br>",array());
      $table[]=$tmp;
      return $table;
   }


   public function getsettinguser()
   {
      $data = $this->getdata('');
      $tmp = $this->build_tag_db($data); 
      return $tmp;
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
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_dashboard_model extends CI_Model {
   
   private $db;

   public function setdbvar($db)
   {
   	$this->db=$db;
   }
   

   private function build_tag_db($data)
   {
      $table='';
      if(!empty($data))      	
      {
         foreach ($data as $row) {
         	$table.='<tr>';
              foreach ($row as $value) {
              	$table.='<td>'.$value.'</td>';
              }
         	$table.='</tr>';
         }
      }

      return $table;
   }


   public function rekap_data()
   {
   	 $priode=$this->db['priode']->getdata('aktif=1');
     $tmp=$this->db['wisudawan']->jml('tgl_input between "'.$priode[0]['awal'].'" and "'.$priode[0]['akhir'].'"');
     $data['jml_calon']= is_null($tmp[0]['jml1']) ? 0 : $tmp[0]['jml1'];
     $data['jml_wisudawan']=is_null($tmp[0]['jml2']) ? 0 :$tmp[0]['jml2'];
     $tmp=$this->db['wisudawan']->getwisudawan_jn_prodi('ver=0 and tgl_input between "'.$priode[0]['awal'].'" and "'.$priode[0]['akhir'].'"');
     $data['data_calon']=$this->build_tag_db($tmp);
     $tmp=$this->db['wisudawan']->getwisudawan_jn_prodi('ver=1 and tgl_input between "'.$priode[0]['awal'].'" and "'.$priode[0]['akhir'].'"');
     $data['data_wisudawan']=$this->build_tag_db($tmp);
   	 return $data;
   }

   private function build_dropdown($data,$field,$pref='',$default='')
   {
       $option="<option value='' selected='selected' >$default</option>";
       if (!empty($data)) {
       	 foreach ($data as $row) {
       	 	$option.="<option value='".$row[$field[0]]."' >$pref".$row[$field[1]]."</option>";
       	 }
       }
       return $option;
   }

   private function angkatan()
   {
   	$curYear = date('Y')-3;

     $ang=array();
     for ($i=2008; $i <= $curYear ; $i++) { 
     	 $ang[]=array($i,$i);
     }
     return $ang;
   }
   
   public function buat_akun()
   {
   	$tmp=$this->db['fakultas']->getdata('');
    $data['drop_fak']=$this->build_dropdown($tmp,array('id_fak','nm_fak'),'Fakultas ','--- Pilih Fakultas ---');
    $tmp=$this->angkatan();
    $data['drop_ang']=$this->build_dropdown($tmp,array(0,1),'','--- Pilih Angkatan ---');
    $tmp=$this->db['priode']->getdata('aktif=1');
    $date = date('Y-m-d');
    $data['isbuka']= $date >= $tmp[0]['awal'] && $date <= $tmp[0]['akhir'];    
   	return $data;
   }

   public function save_akun($data)
   {
      $tmp=$this->db['wisudawan']->getdata("nim='$data[nim]'");
      if(!empty($tmp)){
        return "<div class='callout callout-danger'><h4>Pemberitahuan</h4><p>Calon Wisudawan dengan nim = $data[nim], sudah buat akun !!!</p> </div>"; 
      }else{
         $tmp=$this->db['wisudawan']->getdata("ktp='$data[ktp]'");
         if(!empty($tmp)){
             return "<div class='callout callout-danger'><h4>Pemberitahuan</h4><p>Calon Wisudawan dengan ktp/nik = $data[ktp], sudah buat akun !!!</p> </div>"; 
         }else{ 
             $tmp=$this->db['wisudawan']->getdata("user_name='$data[user]'");
             if(!empty($tmp)){
                return "<div class='callout callout-danger'><h4>Pemberitahuan</h4><p>Calon Wisudawan dengan username = $data[user], sudah buat akun !!!</p> </div>"; 
             }else{  
               $this->db['wisudawan']->insertdata($data);
               return "<div class='callout callout-info'><h4>Pemberitahuan</h4><p>Akun Calon Wisudawan dengan nim = $data[nim], berhasil di buat !!!</p> </div>"; 
             }  
         }
      }
   }

   public function get_prodi($fak)
   {
     $tmp=$this->db['prodi']->getdata("fak_prodi='$fak'");
     $data = $this->build_dropdown($tmp,array('id_prodi','nm_prodi'),'Prodi. ','--- Pilih Prodi ---');      
     return $data;
   }

}
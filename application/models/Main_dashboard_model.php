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
         $i=1;
         foreach ($data as $row) {
         	$table.='<tr>';
              foreach ($row as $key=>$value) {
                
                switch($key)
                {
                  case 'kwitansi' : $table.='<td>'.(is_null($value) ? ''  : 'Ada').'</td>'; break;
                  case 'nama' : $table.='<td>'.strtoupper($value).'</td>'; break;
                  case 'nim' : $table.='<td>'.$i++.'</td>'.'<td>'.$value.'</td>'; break; 
                  default : $table.='<td>'.$value.'</td>'; break;
                }                  
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
     $data['jml_layak']=is_null($tmp[0]['jml3']) ? 0 :$tmp[0]['jml3'];
     $tmp=$this->db['wisudawan']->getwisudawan_jn_prodi('ver=0 and tgl_input between "'.$priode[0]['awal'].'" and "'.$priode[0]['akhir'].'"');
     $data['data_calon']=$this->build_tag_db($tmp);
     $tmp=$this->db['wisudawan']->getwisudawan_jn_prodi('ver=1 and tgl_input between "'.$priode[0]['awal'].'" and "'.$priode[0]['akhir'].'"');
     $data['data_wisudawan']=$this->build_tag_db($tmp);
     $tmp=$this->db['berita']->getdata('');
    $data['timeline'] = $this->build_timeline($tmp);
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
   
   private function build_timeline($data)
   {
     $arr_timeline=array(); 
     if(!empty($data))
     {
      foreach ($data as $row) {
        $tgl = date("d M Y", strtotime($row['tgl_post']));
        $time = date("H:i:s", strtotime($row['tgl_post']));
        $arr_timeline[$tgl][] = array('id'=>$row['id_berita'],'waktu'=>$time,'msg'=>$row['isi_berita']);
      }
     }
    
    
    $timeline ='';

     if(!empty($arr_timeline))
     {
      foreach ($arr_timeline as $key=>$row) {
         $timeline .= '<li class="time-label"><span class="bg-red">'.$key.'</span></li>';
         
         foreach ($row as $value) {
                 $timeline .= '<li>
                                <i class="fa fa-user bg-aqua"></i>
                                <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> '.$value['waktu'].'</span>
                                <h3 class="timeline-header"><a href="#">Admin</a></h3>
                                <div class="timeline-body">'
                                .$value['msg'].
                                '</div>                                
                                </div></li>';        
         }           
 
      }
     }
     return $timeline;
   }


   public function baca_berita()
   {
      $tmp=$this->db['berita']->getdata('');
      $data['timeline'] = $this->build_timeline($tmp);
      return $data;
   }

}
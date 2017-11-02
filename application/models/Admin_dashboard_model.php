<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_dashboard_model extends CI_Model {

   private $db,$lib;


   public function setdbvar($db,$lib=array())
   {
   	$this->db=$db;
    $this->lib=$lib;
   }

   

  

   

   private function build_tag_db2($data)
   {
      $table=array();
      if(!empty($data))       
      {
          $i=1;
          foreach ($data as $row) {
          $tmp=array();
              foreach ($row as $key=>$value) {
                if($key!='id'){
                   $tmp[]=array($value,array());
                 }else{
                   $tmp[]=array($i++,array());
                 }  
              }
          $table[]=$tmp;          
         }
      }

      return $table;
   }

   private function build_tag_db3($data)
   {
      $table=array();
      if(!empty($data))       
      {
          $i=1;
          foreach ($data as $row) {
          $tmp=array();
              foreach ($row as $key=>$value) {
                if($key!='id'){
                  if($key=='id_wisuda'){
                     $temp=$this->db['wisudawan']->getdata("id_wisuda='$value'");
                     $tmp[]=array((isset($temp[0]['nim']) ? $temp[0]['nim'] : ''),array());
                     $tmp[]=array((isset($temp[0]['nama']) ? $temp[0]['nama'] : ''),array());
                  }else{
                     $tmp[]=array($value,array());
                  }                
                 }else{
                   $tmp[]=array($i++,array());
                 }  
              }
          $table[]=$tmp;
          
         }
      }

      return $table;
   }

   private function build_tag_db4($data)
   {
      
      $table=array();
      if(!empty($data))       
      {
          $i=1;
          foreach ($data as $row) {
              $temp=array();
              $temp[]=array($i,array());
              $ext = explode('.',basename($row));
              $tmp = explode('_',$ext[0]);
              $temp[]=array($tmp[1],array());
              $temp[]=array('<img src="'.base_url().'assets/photo/'.$row.'" style="width:50px;height:50px;"><br>'.$row,array());
              $tmp1 = $this->db['wisudawan']->getdata("id_wisuda='$tmp[1]'");
              if(!empty($tmp1)){
                if($tmp[0]=='temp'){
                   $txt='';
                   if (basename($tmp1[0]['photo'])==$row){
                      $txt.="Photo Terkoneksi Ke Akun";
                   }else{
                      $txt.="Photo di akun ".basename($tmp1[0]['photo']);
                      $txt.='<br><a href="javascript:deletephoto('."'$row'".')">Delete photo</a>';
                   } 
                   $txt.='<br>';
                   if(basename($tmp1[0]['kwitansi'])==$row){
                     $txt.="Kwitansi Terkoneksi Ke Akun";
                   }else{
                     $txt.="Kwitansi di akun ".basename($tmp1[0]['kwitansi']);
                     $txt.= '<br><a href="javascript:deletephoto('."'$row'".')">Delete photo</a>';    
                   }  
                   $temp[]=array($txt,array());    

                }else{
                  if($tmp[0]=='photo'){
                      $txt='';
                      if(basename($tmp1[0]['photo'])==$row){
                        $txt.="Photo Terkoneksi Ke Akun"; 
                      }else{
                        $txt.="Photo di akun ".basename($tmp1[0]['photo']).'<br>'; 
                        $txt.= '<a href="javascript:updatephoto('."'$tmp[1]'".","."'$row'".')">Update data</a>';
                      }  
                      $temp[]=array($txt,array());                      
                  }
                  if($tmp[0]=='kwitansi'){
                     $txt='';
                     if(basename($tmp1[0]['kwitansi'])==$row){
                       $txt.= "Kwitansi Terkoneksi Ke Akun";
                     }else{
                       $txt.= "Kwitansi di akun ".basename($tmp1[0]['kwitansi']).'<br>';
                       $txt.= '<a href="javascript:updatekwitansi('."'$tmp[1]'".","."'$row'".')">Update data</a>';
                     }
                      
                     $temp[]=array($txt,array());      
                  }
                }
                            
              }else{
                $temp[]=array('<a href="javascript:deletephoto('."'$row'".')">Delete photo</a>',array());
                
              }  
              $table[]=$temp;
            
          $i++;
         }
      }

      return $table;
   }

   private function build_tag_db5($data)
   {
      
      $table=array();
      if(!empty($data))       
      {         
          foreach ($data as $row) {
              $tmp=array();          
              foreach ($row as $key=>$value) {
                   if($key=='aktif'){
                     $tmp[]=array($value==1 ?'True':'False',array());                                
                   }else{
                       if(in_array($key, array('awal','akhir','wisuda')))
                       {
                         $tmp[]=array(date("d F Y", strtotime($value)),array());
                       }else{ 
                         $tmp[]=array($value,array());
                         }
                     }
                   
              }
              $tmp[]=array("<a onclick='priode(1,$row[id])' href='javascript:void(0);'>Edit</a><br>
                            <a onclick='deletepriode($row[id])' href='javascript:void(0);'>Delete</a>",array());              
          $table[]=$tmp;
         }      
      }
      $tmp=array();
      $tmp[]=array('[Id]',array());
      $tmp[]=array('[Awal]',array());
      $tmp[]=array('[Akhir]',array());
      $tmp[]=array('[Wisuda]',array());
      $tmp[]=array('[Aktif]',array());
      $tmp[]=array("<a onclick='priode(0)' href='javascript:void(0);'>Add</a><br>",array());
      $table[]=$tmp;

      return $table;
   }

   private function build_tag_db6($data)
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


   public function baca_log()
   {

     $tmp=$this->db['log_admin']->getdata('');
     $data['log_admin']=$this->build_tag_db2($tmp);
     $tmp=$this->db['log_wisudawan']->getdata('');
     $data['log_wisudawan']=$this->build_tag_db3($tmp);

     $file = directory_map('./assets/photo/');
     $data['photo']=$this->build_tag_db4($file);

     return $data;
   }

   public function rekap_data()
   {
     $priode=$this->db['priode']->priode_aktif();
     $this->db['wisudawan']->set_priode($priode);     
     $data=$this->db['wisudawan']->jml();     
     $data['rekap_prodi']=$this->db['wisudawan']->rekapperprodi();     
     return $data;
   }
   

   public function baca_berita()
   {
      
      $priode=$this->db['priode']->priode_aktif();
      $this->db['berita']->set_priode($priode);

      $data['timeline'] =$this->db['berita']->getdata('');
      return $data;
   }

   public function simpan_berita($berita)
   {
      $data['isi_berita']=$berita;
      $this->db['berita']->insertdata($data);
   }

   public function delete_berita($id_berita)
   {
      $data['id_berita']=$id_berita;
      $this->db['berita']->deletedata($data);
   }

   public function save_berita($data)
   {
      
      $this->db['berita']->updatedata($data);
   }

   public function edit_berita($id_berita)
   {
      $data = $this->db['berita']->getdata("id_berita='$id_berita'");
      $tmp='';
      if(!empty($data))
      {
        $tmp = '<div class="row">
                  <div class="col-md-12">
                   <div class="form-group">
                   <textarea id="berita_'.$id_berita.'" name="berita" class="form-control" rows="3" placeholder="Berita ...">'.$data[0]['isi_berita'].'</textarea>
                  </div>
                </div>                
              </div>';
      }

      return $tmp;
   }


   public function baca_data()
   {
     
     $priode=$this->db['priode']->priode_aktif();
     $this->db['wisudawan']->set_priode($priode);
     
     $data['data_calon']=$this->db['wisudawan']->getwisudawan_jn_prodi_admin(0);     
     $data['data_layak']=$this->db['wisudawan']->getwisudawan_jn_prodi_admin(0,1);     
     $data['data_wisudawan']=$this->db['wisudawan']->getwisudawan_jn_prodi_admin(1);
     
     return $data;

   }

   public function cetak_layak()
   {
    $priode=$this->db['priode']->getdata('aktif=1');
    $data=$this->db['wisudawan']->getwisudawan_jn_prodi_admin('ver=0 and tgl_input between "'.$priode[0]['awal'].'" and "'.$priode[0]['akhir'].'" and ((kwitansi is not null) or (tgl_byr is not null))');
    return $data;
   }

   public function baca_data_wisudawan($id_wisuda)
   {

     $tmp=$this->db['wisudawan']->getdata('id_wisuda="'.$id_wisuda.'"');
     
     $arr_ang=$this->angkatan($tmp[0]['angkatan']);     
     $data['drop_ang']=$this->build_dropdown($arr_ang,array(0,1),'','--- Pilih Angkatan ---');    
     $data['drop_ang']= "<option value='".$tmp[0]['angkatan']."' selected='selected' >".$tmp[0]['angkatan']."</option>".$data['drop_ang'];

     $tmp_prodi=$this->db['prodi']->getdata('id_prodi="'.$tmp[0]['id_prodi'].'"');     
     $tmp_fak=$this->db['fakultas']->getdata('id_fak="'.$tmp_prodi[0]['fak_prodi'].'"');

     $arr_fak=$this->db['fakultas']->getdata('id_fak<>"'.$tmp_prodi[0]['fak_prodi'].'"');
     $data['drop_fak']=$this->build_dropdown($arr_fak,array('id_fak','nm_fak'),'Fakultas ','--- Pilih Fakultas ---');
     $data['drop_fak']= "<option value='".$tmp_fak[0]['id_fak']."' selected='selected' >Fakultas ".$tmp_fak[0]['nm_fak']."</option>".$data['drop_fak'];

     $arr_prodi=$this->db['prodi']->getdata('fak_prodi ="'.$tmp_fak[0]['id_fak'].'" and id_prodi<>"'.$tmp[0]['id_prodi'].'"');
     $data['drop_prodi']=$this->build_dropdown($arr_prodi,array('id_prodi','nm_prodi'),'Prodi. ','--- Pilih Prodi ---');
     $data['drop_prodi']= "<option value='".$tmp_prodi[0]['id_prodi']."' selected='selected' >Prodi. ".$tmp_prodi[0]['nm_prodi']."</option>".$data['drop_prodi'];

     $data['ktp']=$tmp[0]['ktp'];
     $data['nama']=$tmp[0]['nama'];
     $data['jk']=$tmp[0]['jk'];
     $data['tmpt_lahir']=$tmp[0]['tmpt_lahir'];
     $data['tgl_lahir']=date("d-m-Y", strtotime($tmp[0]['tgl_lahir']));
     $data['alamat']=empty($tmp[0]['alamat']) ? '' : $tmp[0]['alamat'];
     $data['hp']=$tmp[0]['hp'];
     $data['photo']=$tmp[0]['photo'];
     $data['tgl_byr']= is_null($tmp[0]['tgl_byr'])  ? '' : date("d-m-Y", strtotime($tmp[0]['tgl_byr']));
     $data['kwitansi']=$tmp[0]['kwitansi'];

     $data['nim']=$tmp[0]['nim'];
     
     //$data['ipk']=$tmp[0]['ipk'];
     //$data['tgl_lls']= is_null($tmp[0]['tgl_lls'])  ? '' : date("d-m-Y", strtotime($tmp[0]['tgl_lls']));

     $data['jdl_skripsi']=$tmp[0]['jdl_skripsi'];

     $data['keterangan']=empty($tmp[0]['ket']) ? '' : $tmp[0]['ket'];
     $data['verifikasi']=$tmp[0]['ver'];



     return $data;
   }

   public function login($login,$un,$psw)
   {
     
     $data['msg']="";    

     if($login=='login')
     {
           
        $tmp=$this->db['user']->getdata('user_name="'.$un.'" and user_pass=md5("'.$psw.'")'); 
        
        if(empty($tmp))
        {
          $data['msg']="<div class='callout callout-danger'><h4>Pemberitahuan</h4><p>Username atau Password Keliru !!!</p> </div>";
        }else{
          $newdata = array(
               'user_name'  => $tmp[0]['user_name'],
               'lg_time' => date('Y-m-d H:i:s'),
               'logged_in' => TRUE
             );
             $this->session->set_userdata($newdata);
             $tmp=$this->db['log']->insertdata($newdata);     

        }

     }

     return $data;
   }

   public function logout($user_name,$lg_time)
   {
      $out_time = date('Y-m-d H:i:s');
      $tmp=$this->db['log']->updatedata(array('user_name'=>$user_name,'lg_time'=>$lg_time,'out_time'=>$out_time));
   }

   private function angkatan($angk)
   {
    $curYear = date('Y')-3;

     $ang=array();
     for ($i=2008; $i <= $curYear ; $i++) { 
       if($i!=$angk){
         $ang[]=array($i,$i);
       }

     }
     return $ang;
   }

   private function build_dropdown($data,$field,$pref='',$default='')
   {
       $option="<option value=''>$default</option>";
       if (!empty($data)) {
         foreach ($data as $row) {
          $option.="<option value='".$row[$field[0]]."' >$pref".$row[$field[1]]."</option>";
         }
       }
       return $option;
   }

   

   public function updatedatawisudawan($data)
   {
     $tmp=$this->db['wisudawan']->getdata("ktp='$data[ktp]' and id_wisuda<>'$data[id_wisuda]'");
         if(!empty($tmp)){
             return "<div class='callout callout-danger'><h4>Pemberitahuan</h4><p>Calon wisudawan dengan ktp/nik = $data[ktp], sudah ada !!!</p> </div>"; 
         }else{

             $tmp=$this->db['wisudawan']->getdata("nim='$data[nim]' and id_wisuda<>'$data[id_wisuda]'");
                if(!empty($tmp)){
                      return "<div class='callout callout-danger'><h4>Pemberitahuan</h4><p>Calon wisudawan dengan nim = $data[nim], sudah ada !!!</p> </div>"; 
                }else{
                

                       if(isset($data['photo'])){
                              if(file_exists('./assets/photo/'.basename($data['photo']))){
                                 $ext = explode('.',basename($data['photo']));
                                 rename('./assets/photo/'.basename($data['photo']),'./assets/photo/photo_'.$data['id_wisuda'].'.'.$ext[1]);
                                 $data['photo']=base_url().'assets/photo/photo_'.$data['id_wisuda'].'.'.$ext[1];
                             }else{
                               unset($data['photo']);
                             }
                           }

                           if(isset($data['kwitansi'])){
                              if(file_exists('./assets/photo/'.basename($data['kwitansi']))){
                                 $ext = explode('.',basename($data['kwitansi']));
                                 rename('./assets/photo/'.basename($data['kwitansi']),'./assets/photo/kwitansi_'.$data['id_wisuda'].'.'.$ext[1]);
                                 $data['kwitansi']=base_url().'assets/photo/kwitansi_'.$data['id_wisuda'].'.'.$ext[1];
                             }else{
                               unset($data['kwitansi']);
                             }
                           }

                      
                         $this->db['wisudawan']->updatedata($data);
                         return "<div class='callout callout-info'><h4>Pemberitahuan</h4><p>Calon Wisudawan dengan id wisuda = $data[id_wisuda], berhasil di update !!!</p> </div>"; 
                         
               }    
         }
   }

   public function updatephoto($id_wisuda,$photo)
   {
     $data['id_wisuda']=$id_wisuda;
     $data['photo']=base_url().'assets/photo/'.$photo;
     $this->db['wisudawan']->updatedata($data);
   }

   public function deletephoto($photo)
   {
     if(file_exists('./assets/photo/'.$photo)){
       unlink('./assets/photo/'.$photo);
     }
   }

   public function updatekwitansi($id_wisuda,$kwitansi)
   {
     $data['id_wisuda']=$id_wisuda;
     $data['kwitansi']=base_url().'assets/photo/'.$kwitansi;
     $this->db['wisudawan']->updatedata($data);
   }

   public function baca_setting()
   {
     $tmp = $this->db['priode']->getdata('');
     $data['data_priode']=$this->build_tag_db5($tmp);
     $tmp = $this->db['user']->getdata('');
     $data['data_admin']=$this->build_tag_db6($tmp);
     
     return $data;
   }

   public function baca_priode($id)
   {
     $tmp = $this->db['priode']->getdata('id='.$id);
     $data['wisuda']=date("d-m-Y", strtotime($tmp[0]['wisuda']));
     $data['daftar']=date("d-m-Y", strtotime($tmp[0]['awal'])).' - '.date("d-m-Y", strtotime($tmp[0]['akhir']));
     $data['aktif']=$tmp[0]['aktif'];
     $data['id']=$tmp[0]['id'];
     return $data;
   }

   public function insertdatapriode($data)
   {
      $data['wisuda'] = date('Y-m-d', strtotime($data['wisuda']));
      $tmp = explode('-',$data['daftar']);      
      $data['awal'] = date('Y-m-d', strtotime($tmp[0] .'-'. $tmp[1].'-'.$tmp[2])); 
      $data['akhir'] = date('Y-m-d', strtotime($tmp[3] .'-'. $tmp[4].'-'.$tmp[5]));  
      unset($data['daftar']);
      $this->db['priode']->insertdata($data);
      return "<div class='callout callout-info'><h4>Pemberitahuan</h4><p>Data Berhasil Disimpan !!!</p> </div>";      

   }

   public function updatedatapriode($data)
   {
      $data['wisuda'] = date('Y-m-d', strtotime($data['wisuda']));
      $tmp = explode('-',$data['daftar']);
      $data['awal'] = date('Y-m-d', strtotime($tmp[0] .'-'. $tmp[1].'-'.$tmp[2])); 
      $data['akhir'] = date('Y-m-d', strtotime($tmp[3] .'-'. $tmp[4].'-'.$tmp[5]));       
      unset($data['daftar']);
      $this->db['priode']->updatedata($data);
      return "<div class='callout callout-info'><h4>Pemberitahuan</h4><p>Data Berhasil Diupdate !!!</p> </div>";
   }

   

   public function deletedatapriode($id)
   {
     $this->db['priode']->deletedata($id);
   }

}
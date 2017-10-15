<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_dashboard_model extends CI_Model {

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
         $id_wisuda = '';
         foreach ($data as $row) {
          $table.='<tr>';
              foreach ($row as $key=>$value) {

                   switch ($key) {
                     case 'id_wisuda': $id_wisuda = '"'.$value.'"';break;
                     case 'nama'     : $table.='<td>'.strtoupper($value).'</td>';break;
                     case 'photo'    : $table.='<td><img src="'.$value.'" style="width:50px;height:50px;"></td>';break;
                     case 'kwitansi' : $table.='<td><img src="'.$value.'" style="width:50px;height:50px;"></td>';break;
                     default: $table.='<td>'.$value.'</td>'; break;
                   }                  
              
              }
              $table.="<td><a onclick='modal_show($id_wisuda)' href='javascript:void(0);'>Edit</a></td>";
          $table.='</tr>';
         }
      }

      return $table;
   }

   private function build_tag_db1($data)
   {
      $table='';
      if(!empty($data))       
      {
          $i=1;
          foreach ($data as $row) {
          $table.='<tr>';
              foreach ($row as $key=>$value) {
                if($key!='id_prodi'){
                   $table.='<td>'.$value.'</td>';
                 }else{
                   $table.='<td>'.$i.'</td>';
                 }  
              }
          $table.='</tr>';
          $i++;
         }
      }

      return $table;
   }

   private function build_tag_db2($data)
   {
      $table='';
      if(!empty($data))       
      {
          $i=1;
          foreach ($data as $row) {
          $table.='<tr>';
              foreach ($row as $key=>$value) {
                if($key!='id'){
                   $table.='<td>'.$value.'</td>';
                 }else{
                   $table.='<td>'.$i.'</td>';
                 }  
              }
          $table.='</tr>';
          $i++;
         }
      }

      return $table;
   }

   private function build_tag_db3($data)
   {
      $table='';
      if(!empty($data))       
      {
          $i=1;
          foreach ($data as $row) {
          $table.='<tr>';
              foreach ($row as $key=>$value) {
                if($key!='id'){
                  if($key=='id_wisuda'){
                     $tmp=$this->db['wisudawan']->getdata("id_wisuda='$value'");
                     $table.='<td>'.(isset($tmp[0]['nim']) ? $tmp[0]['nim'] : '').'</td>';
                     $table.='<td>'.(isset($tmp[0]['nama']) ? $tmp[0]['nama'] : '').'</td>';
                  }else{
                     $table.='<td>'.$value.'</td>';
                  }                
                 }else{
                   $table.='<td>'.$i.'</td>';
                 }  
              }
          $table.='</tr>';
          $i++;
         }
      }

      return $table;
   }

   private function build_tag_db4($data)
   {
      

      $table='';
      if(!empty($data))       
      {
          $i=1;
          foreach ($data as $row) {
              $table.='<tr>';
              $table.='<td>'.$i.'</td>';
              $ext = explode('.',basename($row));
              $tmp = explode('_',$ext[0]);
              $table.='<td>'.$tmp[1].'</td>';
              $table.='<td><img src="'.base_url().'assets/photo/'.$row.'" style="width:50px;height:50px;"><br>'.$row.'</td>'; 
              $tmp1 = $this->db['wisudawan']->getdata("id_wisuda='$tmp[1]'");
              if(!empty($tmp1)){
                if($tmp[0]=='temp'){
                   $table.='<td>';
                   if (basename($tmp1[0]['photo'])==$row){
                      $table.="Photo Terkoneksi Ke Akun";
                   }else{
                      $table.="Photo di akun ".basename($tmp1[0]['photo']);
                      $table.='<br><a href="javascript:deletephoto('."'$row'".')">Delete photo</a>';
                   } 
                   $table.='<br>';
                   if(basename($tmp1[0]['kwitansi'])==$row){
                     $table.="Kwitansi Terkoneksi Ke Akun";
                   }else{
                     $table.="Kwitansi di akun ".basename($tmp1[0]['kwitansi']);
                     $table.= '<br><a href="javascript:deletephoto('."'$row'".')">Delete photo</a>';    
                   }  
                   $table.='</td>';    

                }else{
                  if($tmp[0]=='photo'){
                      $table.='<td>';
                      if(basename($tmp1[0]['photo'])==$row){
                        $table.="Photo Terkoneksi Ke Akun"; 
                      }else{
                        $table.="Photo di akun ".basename($tmp1[0]['photo']).'<br>'; 
                        $table.= '<a href="javascript:updatephoto('."'$tmp[1]'".","."'$row'".')">Update data</a>';
                      }  
                      $table.='</td>';                     
                  }
                  if($tmp[0]=='kwitansi'){
                     $table.='<td>';
                     if(basename($tmp1[0]['kwitansi'])==$row){
                       $table.= "Kwitansi Terkoneksi Ke Akun";
                     }else{
                       $table.= "Kwitansi di akun ".basename($tmp1[0]['kwitansi']).'<br>';
                       $table.= '<a href="javascript:updatekwitansi('."'$tmp[1]'".","."'$row'".')">Update data</a>';
                     }
                     $table.='</td>'; 
                  }
                }
                            
              }else{
                $table.= '<td><a href="javascript:deletephoto('."'$row'".')">Delete photo</a></td>';
              }  
              $table.='</tr>';
            
          $i++;
         }
      }

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
     $priode=$this->db['priode']->getdata('aktif=1');
     $tmp=$this->db['wisudawan']->jml('tgl_input between "'.$priode[0]['awal'].'" and "'.$priode[0]['akhir'].'"');
     $data['jml_calon']= is_null($tmp[0]['jml1']) ? 0 : $tmp[0]['jml1'];
     $data['jml_wisudawan']=is_null($tmp[0]['jml2']) ? 0 :$tmp[0]['jml2'];
     $data['jml_layak']=is_null($tmp[0]['jml3']) ? 0 :$tmp[0]['jml3'];
     
     $tmp=$this->db['wisudawan']->rekapperprodi();
     $data['rekap_prodi']=$this->build_tag_db1($tmp);
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
                                <div class="timeline-body" id="msgbdy_'.$value['id'].'">'
                                .$value['msg'].
                                '</div>
                                <div class="timeline-footer">
                                <a class="btn btn-danger btn-xs" id="edit_'.$value['id'].'"  onclick="edit_berita('."'$value[id]'".')" href="javascript:void(0);">Edit</a>
                                <a class="btn btn-danger btn-xs"   onclick="delete_berita('."'$value[id]'".')" href="javascript:void(0);" >Delete</a>
                                <a class="btn btn-danger btn-xs" id="save_'.$value['id'].'"  onclick="save_berita('."'$value[id]'".')" href="javascript:void(0);" style="display: none;" >Save</a>

                                </div>
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
     $priode=$this->db['priode']->getdata('aktif=1');
     $tmp=$this->db['wisudawan']->getwisudawan_jn_prodi_admin('ver=0 and tgl_input between "'.$priode[0]['awal'].'" and "'.$priode[0]['akhir'].'" and ((kwitansi is null) and (tgl_byr is null))');
     $data['data_calon']=$this->build_tag_db($tmp);
     $tmp=$this->db['wisudawan']->getwisudawan_jn_prodi_admin('ver=0 and tgl_input between "'.$priode[0]['awal'].'" and "'.$priode[0]['akhir'].'" and ((kwitansi is not null) or (tgl_byr is not null))');
     $data['data_layak']=$this->build_tag_db($tmp);
     $tmp=$this->db['wisudawan']->getwisudawan_jn_prodi_admin('ver=1 and tgl_input between "'.$priode[0]['awal'].'" and "'.$priode[0]['akhir'].'"');
     $data['data_wisudawan']=$this->build_tag_db($tmp);
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

}
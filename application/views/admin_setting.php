<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$data['menu_idx']=$menu_idx;
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/datepicker/datepicker3.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/select2/select2.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/singleuploadimages/main.css">
<style type="text/css">

</style>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="<?php echo base_url();?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">Wisuda</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">Wisuda</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">          
        </ul>
      </div>

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">      
      <?php $this->load->view('side_bar_menu2',$data);  ?>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Setting        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Setting</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
       <?php 
                    
                    $header = array(array('Id','Awal Daftar','Akhir Daftar','Wisuda','Aktif','Aksi'));
                    $tbstat = array("id" => "priode",'width'=>'100%');
                    $isi_data = $data_priode;
                    $tbl = new mytable($tbstat,$header,$isi_data,'');
                    $content=array(array($tbl->display())); 

                    $row = array('jml'=>1);
                    $col = array('jml'=>1,'class'=>array('col-xs-12'));
                    $divrowcol = new div_row_col($row,$col,$content);
                    $body=$divrowcol->display();
                    
                    $box=array('class'=>'collapsed-box');
                    $header_box = array('class'=>'with-border','title'=>'Tanggal Pendaftaran Wisuda dan Tanggal Wisuda','tools'=>array(array('widget'=>'collapse','icon'=>'fa fa-plus'),array('widget'=>'remove','icon'=>'fa fa-times')));
                    $tempbox=new box($box,$header_box,$body); 
                    $content1=array(array($tempbox->display()));

                    $header = array(array('No','Admin Name','Aksi'));
                    $tbstat = array("id" => "admin",'width'=>'100%');
                    $isi_data = $data_admin;
                    $tbl = new mytable($tbstat,$header,$isi_data,'');
                    $content=array(array($tbl->display())); 

                    $row = array('jml'=>1);
                    $col = array('jml'=>1,'class'=>array('col-xs-12'));
                    $divrowcol = new div_row_col($row,$col,$content);
                    $body=$divrowcol->display();

                    $header_box['title']='Management Admin';                    
                    $tempbox=new box($box,$header_box,$body); 
                    $content1[]=array($tempbox->display());

                    
                    $header = array(array('Id','Nama','Urut','Aksi'));
                    $tbstat = array("id" => "fak",'width'=>'100%');
                    $isi_data = $data_fak;
                    $tbl = new mytable($tbstat,$header,$isi_data,'');
                    $content=array(array($tbl->display())); 

                    $row = array('jml'=>1);
                    $col = array('jml'=>1,'class'=>array('col-xs-12'));
                    $divrowcol = new div_row_col($row,$col,$content);
                    $body=$divrowcol->display();

                    $header_box['title']='Fakultas';                    
                    $tempbox=new box($box,$header_box,$body); 
                    $content1[]=array($tempbox->display());

                    $header = array(array('Id','Nama','Fakultas','Urut','Aksi'));
                    $tbstat = array("id" => "prodi",'width'=>'100%');
                    $isi_data = $data_prodi;
                    $tbl = new mytable($tbstat,$header,$isi_data,'');
                    $content=array(array($tbl->display())); 

                    $row = array('jml'=>1);
                    $col = array('jml'=>1,'class'=>array('col-xs-12'));
                    $divrowcol = new div_row_col($row,$col,$content);
                    $body=$divrowcol->display();

                    $header_box['title']='Program Studi';                    
                    $tempbox=new box($box,$header_box,$body); 
                    $content1[]=array($tempbox->display());

                    $row = array('jml'=>4);
                    $col = array('jml'=>1,'class'=>array('col-md-12'));
                    $divrowcol = new div_row_col($row,$col,$content1);
                    echo $divrowcol->display();                                  

       ?>  
              
              


  <div id="myModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
       <div id='modal'>
         
       </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 


    </section>
    <!-- /.content -->    
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; September 2017 by <a href="#">Cecep Suwanda</a>, Template by AdminLTE.</strong> All rights
    reserved.
  </footer>

  
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url();?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url();?>assets/plugins/select2/select2.full.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url();?>assets/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/dist/js/app.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url();?>assets/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- InputMask -->
<script src="<?php echo base_url();?>assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url();?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url();?>assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- jvectormap -->
<script src="<?php echo base_url();?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="<?php echo base_url();?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="<?php echo base_url();?>assets/plugins/chartjs/Chart.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) 
<script src="<?php echo base_url();?>assets/dist/js/pages/dashboard2.js"></script> --> 
<!-- AdminLTE for demo purposes 
<script src="<?php echo base_url();?>assets/dist/js/demo.js"></script> -->
<script src="<?php echo base_url();?>assets/plugins/singleuploadimages/jquery.singleuploadimage.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.js"></script> 
<script>
  
  $(function () {
    $("#priode").DataTable();
    $("#admin").DataTable();
    $("#fak").DataTable();
    $("#prodi").DataTable();
  });

// Get the image and insert it inside the modal - use its "alt" text as a caption



  function myajax(id,data1,url,fbefore=null,fafter=null) {

        if(fbefore != null){
            if(typeof fbefore==='function'){
               fbefore();
            }
        }
        
        $.ajax({
            "type" : "post",
            "url" : url,
            "cache" : false,
            "data" : data1,
            success : function (data) {
                if(id!=''){                  
                  $('#'+id).html(data);
                }
                
                if(fafter != null){
                    if(typeof fafter==='function'){
                       fafter(data1);
                    }
                }
            }
        });
     }

  function after(data)
  {
    
    $('#myModal').modal();
    $("#myModal").on("hidden.bs.modal", function () {
      window.location.href = "<?php echo site_url('Admin_dashboard/setting'); ?>";
     });

    $("[data-mask]").inputmask();


    //Date picker
    $('#datepicker').datepicker({
      format: 'dd-mm-yyyy',
      autoclose: true
    });

    $('#datepicker1').daterangepicker(
     {
      locale: {
           format: 'DD-MM-YYYY',
           cancelLabel: 'Clear'
        }
    }
      );

     $('#datepicker1').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
     });

     $('#datepicker1').on('cancel.daterangepicker', function(ev, picker) {
       $(this).val('');
    });

   
    $("#datapriode").submit(function(e) {

        //prevent Default functionality
        e.preventDefault();

            data = $("#datapriode").serialize();
            myajax('ketdatapriode',data,'<?php echo base_url();?>index.php/Admin_dashboard/savedatapriode');    
                
    });


  }

  function after2(data)
  {
    
    $('#myModal').modal();
    $("#myModal").on("hidden.bs.modal", function () {
      window.location.href = "<?php echo site_url('Admin_dashboard/setting'); ?>";
     });

    $("#admindata").validate();

    $("#admindata").submit(function(e) {

        //prevent Default functionality
        e.preventDefault();
        var isvalid = $("#admindata").valid();
        if (isvalid) {
            data = $("#admindata").serialize();
            myajax('ketadmindata',data,'<?php echo base_url();?>index.php/Admin_dashboard/saveuserdata');    
        }        
    });


  }

  function after3(data)
  {
    
    $('#myModal').modal();
    $("#myModal").on("hidden.bs.modal", function () {
      window.location.href = "<?php echo site_url('Admin_dashboard/setting'); ?>";
     });

    $("#fakdata").validate();

    $("#fakdata").submit(function(e) {

        //prevent Default functionality
        e.preventDefault();
        var isvalid = $("#fakdata").valid();
        if (isvalid) {
            data = $("#fakdata").serialize();
            myajax('ketfakdata',data,'<?php echo base_url();?>index.php/Admin_dashboard/savefakdata');    
        }        
    });


  }

  function after4(data)
  {
    
    $('#myModal').modal();
    $("#myModal").on("hidden.bs.modal", function () {
      window.location.href = "<?php echo site_url('Admin_dashboard/setting'); ?>";
     });

    $("#prodidata").validate();

    $(".select2").select2();

    $("#prodidata").submit(function(e) {

        //prevent Default functionality
        e.preventDefault();
        var isvalid = $("#prodidata").valid();
        if (isvalid) {
            data = $("#prodidata").serialize();
            myajax('ketprodidata',data,'<?php echo base_url();?>index.php/Admin_dashboard/saveprodidata');    
        }        
    });


  }


  function priode(isedit,id)
  {
    if(isedit==0){
     myajax('modal','',"<?php echo base_url();?>index.php/Admin_dashboard/add_priode_admin",null,after);
    }else{
     myajax('modal','id='+id,"<?php echo base_url();?>index.php/Admin_dashboard/edit_priode_admin",null,after); 
    }
    
  }

  function user(isedit,id)
  {
    if(isedit==0){
     myajax('modal','',"<?php echo base_url();?>index.php/Admin_dashboard/add_user_admin",null,after2);
    }else{
     myajax('modal','id='+id,"<?php echo base_url();?>index.php/Admin_dashboard/edit_user_admin",null,after2); 
    }
  }

  function fak(isedit,id)
  {
   if(isedit==0){
     myajax('modal','',"<?php echo base_url();?>index.php/Admin_dashboard/add_fak_admin",null,after3);
    }else{
     myajax('modal','id='+id,"<?php echo base_url();?>index.php/Admin_dashboard/edit_fak_admin",null,after3); 
    } 
  }

  function prodi(isedit,id)
  {
   if(isedit==0){
     myajax('modal','',"<?php echo base_url();?>index.php/Admin_dashboard/add_prodi_admin",null,after4);
    }else{
     myajax('modal','id='+id,"<?php echo base_url();?>index.php/Admin_dashboard/edit_prodi_admin",null,after4); 
    } 
  }

  function after1()
  {
    window.location.href = "<?php echo site_url('Admin_dashboard/setting'); ?>";
  }

  function deletepriode(id)
  {
    data = "id="+id;
    myajax('',data,'<?php echo base_url();?>index.php/Admin_dashboard/deletedatapriode',null,after1); 
  }
  
  function deleteuser(id)
  {
    data = "id="+id;
    myajax('',data,'<?php echo base_url();?>index.php/Admin_dashboard/deleteuserdata',null,after1); 
  }

  function deletefak(id)
  {
    data = "id="+id;
    myajax('',data,'<?php echo base_url();?>index.php/Admin_dashboard/deletefakdata',null,after1); 
  }

  function deleteprodi(id)
  {
    data = "id="+id;
    myajax('',data,'<?php echo base_url();?>index.php/Admin_dashboard/deleteprodidata',null,after1); 
  }
  
  
</script>
</body>
</html>

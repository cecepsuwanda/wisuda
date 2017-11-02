<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          <a href="<?php echo base_url();?>index.php/Admin_dashboard/index">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>            
          </a>          
        </li>
        <li class="active treeview">
          <a href="<?php echo base_url();?>index.php/Admin_dashboard/log">
            <i class="fa fa-edit"></i> <span>User Log dan Upload Photo</span>            
          </a>          
        </li>
        <li class="treeview">
          <a href="<?php echo base_url();?>index.php/Admin_dashboard/berita">
            <i class="fa fa-newspaper-o"></i> <span>Berita</span>            
          </a>          
        </li>
        <li class="treeview">
          <a href="<?php echo base_url();?>index.php/Admin_dashboard/data">
            <i class="fa fa-graduation-cap"></i> <span>Data Wisudawan</span>            
          </a>          
        </li>      
        <li class="treeview">
          <a href="<?php echo base_url();?>index.php/Admin_dashboard/setting">
            <i class="fa fa-gear"></i> <span>Setting</span>            
          </a>          
        </li>
        <li class="treeview">
          <a href="<?php echo base_url();?>index.php/Admin_dashboard/logout">
            <i class="fa fa-user"></i> <span>Logout Admin</span>            
          </a>          
        </li>      
      </ul>

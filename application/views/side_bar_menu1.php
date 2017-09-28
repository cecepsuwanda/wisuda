<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          <a href="<?php echo base_url();?>index.php/Wisudawan_dashboard/login">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>            
          </a>          
        </li>
        <li class="treeview">
          <a href="<?php echo base_url();?>index.php/Wisudawan_dashboard/data">
            <i class="fa fa-edit"></i> <span>Data Wisudawan</span>            
          </a>          
        </li>      
        <li class="treeview">
          <a href="<?php echo base_url();?>index.php/Main_dashboard">
            <i class="fa fa-graduation-cap"></i> <span>Logout Wisudawan</span>            
          </a>          
        </li>      
      </ul>

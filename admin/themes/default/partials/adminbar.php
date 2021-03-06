<?php 
//customers count
global $common;
$waiting_customers = 0;
$messages_waiting = 0;

//waiting users
$waiting_customers = $common->select('users', array('COUNT(id) as count'), "WHERE active='waiting'");
if( !empty($waiting_customers) ) $total_waiting = $waiting_customers[0]['count'];

?>
<!-- header logo: style can be found in header.less -->
<header class="header">
  <a class="logo" href="./index.php">
    <span class="purple">Okad</span><span class="green">Shop</span>
    <span id="shop_version"><?=_OS_VERSION_;?></span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
     <a class="navbar-btn sidebar-toggle" data-toggle="offcanvas" href="#" role="button"><span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></a>
    <div class="navbar-right">
      <ul class="nav navbar-nav">

        <span class="shop_or_blog">
          <input id="shop_or_blog" type="checkbox" data-toggle="toggle" data-size="small" data-on="Shop" data-off="Blog">
        </span>
        <?php execute_section_hooks( 'sec_admin_bar' ); ?>
        <li>
          <a href="?module=users">
            <i class="fa fa-users"></i>
            <span class="label label-danger"><?php echo $total_waiting; ?></span>
          </a>
        </li>
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-user"></i> <span><?=l("Welcome", "core");?> <?php echo get_admin('first_name') . " ". get_admin('last_name'); ?> <i class="caret"></i></span>
          </a>
          <ul class="dropdown-menu dropdown-custom dropdown-menu-right">
            <li class="dropdown-header text-center"><?=l("Quick links", "core");?></li>
            <li class="divider"></li>
            <li><a target="_blank" href="../"><i class="fa fa-home fa-fw pull-right"></i> <?=l("Go to my shop", "core");?></a></li>
            <li><a href="?module=users&action=edit&id=<?=get_admin('id');?>"><i class="fa fa-user fa-fw pull-right"></i> <?=l("Update my profile", "core");?></a></li>
            <li><a href="index.php?module=logout"><i class="fa fa-ban fa-fw pull-right"></i> <?=l("Logout", "core");?></a></li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>

<script>
$(document).ready(function(){
  $('#lang_list').change(function(){
   $(this).parent().submit();
  });
});
</script>

<!DOCTYPE html>
<html lang="en"> 
<head>
<meta charset="utf-8"> 
<meta name="description" content="">
<meta name="author" content="">
<meta content="width=device-width, initial-scale=1" name="viewport">
<title>Tentacle Admin - <?= $title?></title>
<!--

	_/_/_/_/_/                      _/                          _/           
	   _/      _/_/    _/_/_/    _/_/_/_/    _/_/_/    _/_/_/  _/    _/_/    
	  _/    _/_/_/_/  _/    _/    _/      _/    _/  _/        _/  _/_/_/_/   
	 _/    _/        _/    _/    _/      _/    _/  _/        _/  _/          
	_/      _/_/_/  _/    _/      _/_/    _/_/_/    _/_/_/  _/    _/_/_/     
	======================================================================-->                                                                 

	<link type="text/css" rel="stylesheet" href="<?= MINIFY ?>b=http/dev.tcms.me/tentacle/admin/css&amp;f=bootstrap-1.4.0.min.css,general.css,admin.css" />
<!--
	<script type="text/javascript" src="<?= MINIFY ?>b=http/dev.tcms.me/tentacle/admin/js&amp;f=jquery.min.js,jquery-ui-1.8.16.custom.min.js,modernizr-2.0.6.min.js,jquery.notice.js,jquery.inputtags.js,spin.min.js"></script>

	<link type="text/css" rel="stylesheet" href="<?=TENTACLE_CSS; ?>bootstrap-1.4.0.min.css">
	<link type="text/css" rel="stylesheet" href="<?=TENTACLE_CSS; ?>general.css">
	<link type="text/css" rel="stylesheet" href="<?=TENTACLE_CSS; ?>admin.css">
-->
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>jquery.min.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>jquery-ui-1.8.16.custom.min.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>modernizr-2.0.6.min.js"></script>
	
	<script type="text/javascript" src="<?= MINIFY ?>f=http/dev.tcms.me/tentacle/admin/js/jquery.notice.js"></script>
	<script type="text/javascript" src="<?= MINIFY ?>f=http/dev.tcms.me/tentacle/admin/js/jquery.inputtags.js"></script>

	<script type="text/javascript" src="<?=TENTACLE_JS; ?>bootstrap-tabs.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>bootstrap-alerts.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>bootstrap-dropdown.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>bootstrap-scrollspy.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>bootstrap-modal.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>bootstrap-twipsy.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>bootstrap-popover.js"></script>
	
	<!--<script type="text/javascript" src="<?=TENTACLE_JS; ?>spin.min.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>sisyphus.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>jquery.validate.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>application.js"></script>-->
	
	<script type="text/javascript" src="<?= MINIFY ?>f=http/dev.tcms.me/tentacle/admin/js/application.js"></script>
	
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<!-- Le fav and touch icons -->
	<link rel="shortcut icon" href="images/favicon.ico">
	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">

<meta name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<body id="admin-window" class="<?= route::controller().'_'. route::method();?>" lang="en">
	<header>
		<nav>
			<div class="topbar">
			  <div class="fill">
				<div class="container-full">
					<a class="brand" href="<?= BASE_URL ?>">
					  <?= get_option('blogname'); ?>
					</a>
				<ul class="nav" data-dropdown="dropdown">
					<li class="<? if (
				    CURRENT_PAGE == 'admin/dashboard') echo 'active'; ?>"><a href="<?= ADMIN ?>">Dashboard</a></li>
					<li class="dropdown" data-dropdown="dropdown"><a href="#" class="dropdown-toggle">Content</a>
					  <ul class="dropdown-menu">
						<li class="<? current_page('admin/content_add_page'); ?>"><a href="<?= ADMIN ?>content_add_page/">Write a new page</a></li>
				        <li class="<? current_page('admin/content_manage_pages'); ?>"><a href="<?= ADMIN ?>content_manage_pages/">Manage pages</a></li>
						<li class="divider"></li>
				        <li class="<? current_page('admin/content_add_post'); ?>"><a href="<?= ADMIN ?>content_add_post/">Write a new post</a></li>
				        <li class="<? current_page('admin/content_manage_posts'); ?>"><a href="<?= ADMIN ?>content_manage_posts/">Manage posts</a></li>
					

						<li class="divider"></li>
<?
						/*	        
						<li class="<? current_page('admin/content_manage_comments'); ?>"><a href="<?= ADMIN ?>content_manage_comments/">Manage comments</a></li>
						*/
?>
				        <li class="<? current_page('admin/content_manage_categories'); ?>"><a href="<?= ADMIN ?>content_manage_categories/">Manage categories</a></li>
<?
/*
						<li class="divider"></li>
						<li class="<? current_page('admin/media_manage'); ?>"><a href="<?= ADMIN ?>media_manage/">Manage media</a></li>
					    <li class="<? current_page('admin/media_downloads'); ?>"><a href="<?= ADMIN ?>media_downloads/">Media downloads</a></li>
						<li class="divider"></li>
						<li class="<? current_page('admin/media_manage'); ?>"><a href="<?= ADMIN ?>media_manage/">Manage Navigation</a></li>
*/
?>
					  </ul>
					</li>
					<li class="dropdown" data-dropdown="dropdown"><a href="#" class="dropdown-toggle">Snippets</a>
					  <ul class="dropdown-menu">
						<li class="<? current_page('admin/snippets_add'); ?>"><a href="<?= ADMIN ?>snippets_add/">Add a new snippet</a></li>
						<li class="<? current_page('admin/snippets_manage'); ?>"><a href="<?= ADMIN ?>snippets_manage/">Manage snippets</a></li>
					  </ul>
					</li>
					<li class="dropdown" data-dropdown="dropdown"><a href="#" class="dropdown-toggle">Users</a>
					  <ul class="dropdown-menu">
						<li class="<? current_page('admin/users_manage'); ?>"><a href="<?= ADMIN ?>users_manage/">Manage users</a></li>
						<li class="<? current_page('admin/users_add'); ?>"><a href="<?= ADMIN ?>users_add/">Add a new user</a></li>
						<li class="<? current_page('admin/users_profile'); ?>"><a href="<?= ADMIN ?>users_profile/">Your profile</a></li>
					  </ul>
					</li>
					<!--<li class="<? if ( CURRENT_PAGE == 'admin/addons_install' ) echo 'active'; ?> menu"><a href="<?= ADMIN ?>addons_install/" class="">Addon's</a></li>-->
					<li class="dropdown" data-dropdown="dropdown"><a href="#" class="dropdown-toggle">Settings</a>
					  <ul class="dropdown-menu">
						<li><a class="<? current_page('admin/settings_appearance'); ?>" href="<?= ADMIN ?>settings_appearance/">Appearance</a></li>
						<li class="<? current_page('admin/settings_general'); ?>"><a href="<?= ADMIN ?>settings_general/">General</a></li>
						<?
/*
						<li class="<? current_page('admin/settings_seo'); ?>"><a href="<?= ADMIN ?>settings_seo/">SEO</a></li>
						<li class="<? current_page('admin/settings_writing'); ?>"><a href="<?= ADMIN ?>settings_writing/">Writing</a></li>
						<li class="<? current_page('admin/settings_reading'); ?>"><a href="<?= ADMIN ?>settings_reading/">Reading</a></li>
						<li class="<? current_page('admin/settings_comments'); ?>"><a href="<?= ADMIN ?>settings_comments/">Comments</a></li>
						<li class="<? current_page('admin/settings_media'); ?>"><a href="<?= ADMIN ?>settings_media/">Media</a></li>
						<li class="<? current_page('admin/settings_privacy'); ?>"><a href="<?= ADMIN ?>settings_privacy/">Privacy</a></li>
						<li class="<? current_page('admin/settings_export'); ?>"><a href="<?= ADMIN ?>settings_templates/">Notification Templates</a></li>
						<li class="<? current_page('admin/settings_import'); ?>"><a href="<?= ADMIN ?>settings_import/">Import</a></li>
						<li class="<? current_page('admin/settings_export'); ?>"><a href="<?= ADMIN ?>settings_export/">Export</a></li>
*/
						?>
					  </ul>
					</li>
					<li class="<? if (
				    CURRENT_PAGE == 'admin/about_system_details') echo 'active'; ?>"><a href="<?= ADMIN ?>about_system_details/">About</a> </li>
				  </ul>
				<ul class="nav secondary-nav">
					<li class="dropdown" data-dropdown="dropdown" >
						<a href="#" class="dropdown-toggle">Help</a>
						<ul class="dropdown-menu">
							<li><a href="https://github.com/adampatterson/Tentacle/wiki" target="_blank">Knowledge Base</a></li>
							<li><a href="https://github.com/adampatterson/Tentacle/wiki/Reporting-a-bug" target="_blank">Submit an Issue</a></li>
						</ul>
					</li>
					<li> <a href="<?= ADMIN ?>logout/"><img src="<?= TENTACLE_URL.'/admin/images/log_out.png'; ?>" alt="Log Out" /></a> </li>
				</ul>
				<p class="pull-right">Welcome <a href="<?= ADMIN ?>users_profile/"><?= user_name(); ?></a></p>
				</div><!-- . container-full -->
			  </div><!-- .fill -->
			</div><!-- .topbar -->
		</nav>
	</header>
	<div id="body-wrapper">
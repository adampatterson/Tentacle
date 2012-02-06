<link type="text/css" rel="stylesheet" href="<?=TENTACLE_CSS; ?>bootstrap-1.4.0.min.css">
<link type="text/css" rel="stylesheet" href="<?=TENTACLE_CSS; ?>general.css">
<link type="text/css" rel="stylesheet" href="<?=TENTACLE_CSS; ?>admin.css">

<script type="text/javascript" src="<?=TENTACLE_JS; ?>jquery.min.js"></script>
<script type="text/javascript" src="<?=TENTACLE_JS; ?>bootstrap-dropdown.js"></script>

	<div class="topbar">
	  <div class="fill">
		<div class="container-full">
			<a class="brand" href="<?= BASE_URL ?>">
			  <?= get_option('blogname'); ?>
			</a>
		<ul class="nav" data-dropdown="dropdown">
			<li><a href="<?= ADMIN ?>">Dashboard</a></li>
			<li class="dropdown" data-dropdown="dropdown"><a href="#" class="dropdown-toggle">Content</a>
			  <ul class="dropdown-menu">
				<li><a href="<?= ADMIN ?>content_add_page/">Write a new page</a></li>
		        <li><a href="<?= ADMIN ?>content_manage_pages/">Manage pages</a></li>
				<li class="divider"></li>
		        <li><a href="<?= ADMIN ?>content_add_post/">Write a new post</a></li>
		        <li><a href="<?= ADMIN ?>content_manage_posts/">Manage posts</a></li>
				<li class="divider"></li>
		        <li><a href="<?= ADMIN ?>content_manage_categories/">Manage categories</a></li>
			  </ul>
			</li>
			<li class="dropdown" data-dropdown="dropdown"><a href="#" class="dropdown-toggle">Snippets</a>
			  <ul class="dropdown-menu">
				<li><a href="<?= ADMIN ?>snippets_add/">Add a new snippet</a></li>
				<li><a href="<?= ADMIN ?>snippets_manage/">Manage snippets</a></li>
			  </ul>
			</li>
			<li class="dropdown" data-dropdown="dropdown"><a href="#" class="dropdown-toggle">Users</a>
			  <ul class="dropdown-menu">
				<li><a href="<?= ADMIN ?>users_manage/">Manage users</a></li>
				<li><a href="<?= ADMIN ?>users_add/">Add a new user</a></li>
				<li><a href="<?= ADMIN ?>users_profile/">Your profile</a></li>
			  </ul>
			</li>
			<li class="dropdown" data-dropdown="dropdown"><a href="#" class="dropdown-toggle">Settings</a>
			  <ul class="dropdown-menu">
				<li><a class="<? current_page('admin/settings_appearance'); ?>" href="<?= ADMIN ?>settings_appearance/">Appearance</a></li>
				<li class="<? current_page('admin/settings_general'); ?>"><a href="<?= ADMIN ?>settings_general/">General</a></li>
			  </ul>
			</li>
			<li><a href="<?= ADMIN ?>about_system_details/">About</a> </li>
		  </ul>
		<ul class="nav secondary-nav">
			<li class="dropdown" data-dropdown="dropdown" >
				<a href="#" class="dropdown-toggle">Help</a>
				<ul class="dropdown-menu">
					<li><a href="https://github.com/adampatterson/Tentacle/wiki" target="_blank">Knowledge Base</a></li>
					<li><a href="https://github.com/adampatterson/Tentacle/wiki/Reporting-a-bug" target="_blank">Submit an Issue</a></li>
				</ul>
			</li>
			<li><a href="<?= ADMIN ?>logout/"><img src="<?= TENTACLE_URL.'/admin/images/log_out.png'; ?>" alt="Log Out" /></a> </li>
		</ul>
		<p class="pull-right">Welcome <a href="<?= ADMIN ?>users_profile/"><?= user_name(); ?></a></p>
		</div><!-- . container-full -->
	  </div><!-- .fill -->
	</div><!-- .topbar -->
<style type="text/css" media="screen">
	body {
      padding-top: 60px;
      padding-bottom: 40px;
    }
</style>
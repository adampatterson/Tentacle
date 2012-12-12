<div class="navbar navbar-fixed-top">
<? /* div class="navbar navbar-inverse navbar-fixed-top" */ ?>
  <div class="navbar-inner">
    <div class="container-fluid">
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
	  <a class="brand" href="<?= BASE_URL ?>"><?= get::option('blogname'); ?></a>
		
      <div class="nav-collapse">
		<ul class="nav">
			<li class="<? if (CURRENT_PAGE == 'admin/dashboard') echo 'active'; ?>"><a href="<?= ADMIN ?>">Dashboard</a></li>
			<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Content <b class="caret"></b></a>
			  <ul class="dropdown-menu">
				<li class="<? current_page('admin/content_add_page'); ?>"><a href="<?= ADMIN ?>content_add_page/">Write a new page</a></li>
		        <li class="<? current_page('admin/content_manage_pages'); ?>"><a href="<?= ADMIN ?>content_manage_pages/">Manage pages</a></li>
				<li class="divider"></li>
		        <li class="<? current_page('admin/content_add_post'); ?>"><a href="<?= ADMIN ?>content_add_post/">Write a new post</a></li>
		        <li class="<? current_page('admin/content_manage_posts'); ?>"><a href="<?= ADMIN ?>content_manage_posts/">Manage posts</a></li>
				<li class="divider"></li>
				<li class="<? current_page('admin/snippets_add'); ?>"><a href="<?= ADMIN ?>snippets_add/">Add a new snippet</a></li>
				<li class="<? current_page('admin/snippets_manage'); ?>"><a href="<?= ADMIN ?>snippets_manage/">Manage snippets</a></li>
				<li class="divider"></li>
	<?
				/*	        
				<li class="<? current_page('admin/content_manage_comments'); ?>"><a href="<?= ADMIN ?>content_manage_comments/">Manage comments</a></li>
				*/
	?>
		        <li class="<? current_page('admin/content_manage_categories'); ?>"><a href="<?= ADMIN ?>content_manage_categories/">Manage categories</a></li>

				<li class="divider"></li>
				<li class="<? current_page('admin/media_manage'); ?>"><a href="<?= ADMIN ?>media_manage/">Manage media</a></li>
	<?
	/*
			    <li class="<? current_page('admin/media_downloads'); ?>"><a href="<?= ADMIN ?>media_downloads/">Media downloads</a></li>
				<li class="divider"></li>
				<li class="<? current_page('admin/media_manage'); ?>"><a href="<?= ADMIN ?>media_manage/">Manage Navigation</a></li>
	*/
	?>
			  </ul>
			</li>
			<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Users <b class="caret"></b></a>
			  <ul class="dropdown-menu">
				<li class="<? current_page('admin/users_manage'); ?>"><a href="<?= ADMIN ?>users_manage/">Manage users</a></li>
				<li class="<? current_page('admin/users_add'); ?>"><a href="<?= ADMIN ?>users_add/">Add a new user</a></li>
				<li class="<? current_page('admin/users_profile'); ?>"><a href="<?= ADMIN ?>users_profile/">Your profile</a></li>
			  </ul>
			</li>
			<!--<li class="<? if ( CURRENT_PAGE == 'admin/addons_install' ) echo 'active'; ?> menu"><a href="<?= ADMIN ?>addons_install/" class="">Addon's</a></li>-->
			<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Settings <b class="caret"></b></a>
			  <ul class="dropdown-menu">
				<li class="<? current_page('admin/settings_general'); ?>"><a href="<?= ADMIN ?>settings_general/">General</a></li>
				<li class="<? current_page('admin/updates'); ?>"><a href="<?= ADMIN ?>updates/">Updates</a></li>
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
			<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Modules <b class="caret"></b></a>
				<ul class="dropdown-menu">
				<li><a class="<? current_page('admin/settings_modules'); ?>" href="<?= ADMIN ?>settings_modules/">Manage Modules</a></li>
				<li><a href="#">Add a new Module</a></li>
				<?
				    $modules = load::model('module');

                    $subnav = $modules->navigation();

					if ( $subnav != false):

                        echo '<li class="divider"></li>';

                        foreach ( $subnav as $sub_page ):
                            echo '<li><a href="'.ADMIN.'settings_modules/'.$sub_page['rout'].'">'.$sub_page['title'].'</a></li>';
                        endforeach;

				    endif; 
				?>
				</ul>
			</li>
			<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Themes <b class="caret"></b></a>
				<ul class="dropdown-menu">
				<li><a class="<? current_page('admin/settings_appearance'); ?>" href="<?= ADMIN ?>settings_appearance/">Manage Themes</a></li>
				<li><a href="#">Add a new Theme</a></li>
				<li class="divider"></li>
				<li><a href="#">Theme Settings</a></li>
				</ul>
			</li>
			<li class="<? if (
		    CURRENT_PAGE == 'admin/about_system_details') echo 'active'; ?>"><a href="<?= ADMIN ?>about_system_details/">About</a> </li>
		  </ul>
		<ul class="nav pull-right">
			<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-heart"></i> Help <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="https://github.com/adampatterson/Tentacle/wiki" target="_blank">Knowledge Base</a></li>
					<li><a href="https://github.com/adampatterson/Tentacle/wiki/Reporting-a-bug" target="_blank">Submit an Issue</a></li>
				</ul>
			</li>
			<li> <a href="<?= ADMIN ?>logout/"><i class="icon-off"></i></a></li>
		</ul>
		<p class="pull-right welcome">Welcome <a href="<?= ADMIN ?>users_profile/"><?= user_name(); ?></a></p>
      </div><!--/.nav-collapse -->
    </div>
  </div>
</div>
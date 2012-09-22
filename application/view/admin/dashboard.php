<? load::view('admin/templates/template-header', array('title' => 'Dashboard', 'assets' => array('application')));?>
<? load::view('admin/templates/template-sidebar');?>
<div id="wrap">
	<div class="full-content">
		<div id="post-body">
			<div class="one-full">
				<div class="title pad-right">
					<h1><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Welcome <strong><?= user_name();?></strong></h1>
						<? upgrade::check_core_version(); ?>
					<div class="span8 well">
						<h2>Tentacle News</h2>
						<? dashboard_feed("http://tentaclecms.com/blog/feed/"); ?>
					</div>
					<!-- <div class="span4 well">
							<h2>Content</h2>
							<ul>
								<li><strong>#</strong> Posts</li>
								<li><strong>#</strong> Pages</li>
								<li><strong>#</strong> Categories</li>
								<li><strong>#</strong> Tags</li>
							</ul>
						</div> -->
					<div class="span4 well">
						<h2>Quick Links</h2>
						<ul>
							<li><a href="<?= ADMIN ?>content_add_page/">Write a new page</a></li>
					        <li><a href="<?= ADMIN ?>content_manage_pages/">Manage pages</a></li>
					        <li><a href="<?= ADMIN ?>content_add_post/">Write a new post</a></li>
					        <li><a href="<?= ADMIN ?>content_manage_posts/">Manage posts</a></li>
					        <li><a href="<?= ADMIN ?>content_manage_categories/">Manage categories</a></li>
						</ul>
					</div>
				</div>
			</div><!-- .one-full -->
		</div><!-- .post-body -->
	</div><!-- .full-content -->
</div><!-- #wrap -->
<? load::view('admin/templates/template-footer', array( 'assets' => array( '' ) ) ); ?>
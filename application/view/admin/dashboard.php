<? load::view('admin/template-header', array('title' => 'Dashboard', 'assets' => 'application'));?>
<? load::view('admin/template-sidebar');?>
<div id="wrap">
	<div class="full-content">
		<div id="post-body">
			<div class="one-full">
				<div class="title pad-right">
					<h1><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Welcome <strong><?= user_name();?></strong></h1>
				<!--<div class="one-half">
						<h2>Content</h2>
						<ul>
							<li><strong>#</strong> Posts</li>
							<li><strong>#</strong> Pages</li>
							<li><strong>#</strong> Categories</li>
							<li><strong>#</strong> Tags</li>
						</ul>
					</div>
					<div class="one-half">
						<h2>Quick Links</h2>
						<ul>
							<li><a href="<?= ADMIN ?>content_add_page/">Write a new page</a></li>
					        <li><a href="<?= ADMIN ?>content_manage_pages/">Manage pages</a></li>
					        <li><a href="<?= ADMIN ?>content_add_post/">Write a new post</a></li>
					        <li><a href="<?= ADMIN ?>content_manage_posts/">Manage posts</a></li>
					        <li><a href="<?= ADMIN ?>content_manage_categories/">Manage categories</a></li>
						</ul>
					</div>-->
					<div class="row">
						<div class="well">
						<h2>Blog feed</h2>

							<div class="feed"></div>
							<ul>
								<?
								$blog_feed = file_get_contents('http://tentaclecms.com/blog/feed/?feed=json');
								$blog_feed = json_decode( $blog_feed );

								foreach ( $blog_feed as $blog ) { ?>
									<li>
										<h3><a href="<?= $blog->permalink ?>" target="_blank"><?= $blog->title ?></a></h3>
										<p><?= $blog->excerpt ?></p>
									</li>
								<? } ?>
								<!--
								<script type="text/javascript">
										$.getJSON("http://tentaclecms.com/blog/feed/?feed=json&jsonp=?",
								       function(data){
								               console.debug(data[1]);

											$.each(data.slice(0,4), function(i, item){
												$(".feed").append('<li><h3><a href="' + item.permalink + '">' + item.title + '</a></h3><p>' + item.excerpt +'</p></li>');
											});
								       });
								</script>
								-->
							</ul>
						</div>
					</div>
				</div>
			</div><!-- .one-full -->
		</div><!-- .post-body -->
	</div><!-- .full-content -->
</div><!-- #wrap -->
<? load::view('admin/template-footer');?> 
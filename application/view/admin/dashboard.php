<? load::view('admin/partials/template-header', array('title' => 'Dashboard', 'assets' => array('application')));?>

<div id="wrap">
	<div class="full-content">
		<div id="post-body">
			<div class="one-full">
				<div class="title pad-right">
					<h1><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Welcome <strong><?= user_name();?></strong></h1>
						<? upgrade::check_core_version(); ?>
					<div class="span8 well">
						<h2>Tentacle News</h2>
						<? //dashboard_feed(array( 'feed' => 'http://tentaclecms.com/blog/feed/' ) ); ?>
			
						<ul class="feed"></ul>

                        <script type="text/javascript">

                            $.getJSON("http://tentaclecms.com/api/feed/json/",
                                function(data){
                                    // console.log('tentacle')
                                    $.each(data, function(i, item){
                                        $(".feed").append('<li><h3><a href="' + item.url + '">' + item.title + '</a></h3><p>' + item.content +' <a href="' + item.url + '"> Read more  »</a></p></li>');
                                    });
                                })
                            .error(function() {
                                $(".feed").append('<li><p>error</p></li>');
                            });

                        </script>

					</div>
					<? /*<div class="span4 well">
							<h2>Content</h2>
							<ul>
								<li><strong>#</strong> Posts</li>
								<li><strong>#</strong> Pages</li>
								<li><strong>#</strong> Categories</li>
								<li><strong>#</strong> Tags</li>
							</ul>
						</div>*/ ?>
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
<? load::view('admin/partials/template-footer', array( 'assets' => array( '' ) ) ); ?>
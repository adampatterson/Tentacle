<? load::view('admin/partials/header', array('title' => 'Dashboard', 'assets' => array('application','flot')));?>

<div id="wrap">
	<div class="full-content">
		<div id="post-body">
			<div class="one-full">
				<div class="title pad-right">
					<h1><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Welcome <strong><?= user_name();?></strong></h1>
						<? upgrade::check_core_version(); ?>
                    </div>

                    <div class="row-fluid">
                        <div class="span4 well">
                            <h2>Recent Posts</h2>
                            <ul>
                            <?
                            $count = 1;
                            foreach (load::model('content')->get() as $post ): ?>
                                <li><a href="<?= ADMIN ?>content_update_post/<?= $post->id;?>"><?= $post->title;?></a></li>
                            <?
                                if ( $count == 10 )
                                    break;

                                $count++;
                            endforeach; ?>
                            </ul>
                        </div>

                        <div class="span4 well">
                            <h2>Tentacle News</h2>

                            <ul class="feed"></ul>

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

                            <h2>Recent Statistics</h2>
                            <div class="sparkLineStats">

                                <ul class="unstyled">

                                    <li><span class="page_view"></span>
                                        Pageviews:
                                        <span class="number"></span>
                                    </li>

                                    <li><span class="unique_page_view"></span>
                                        Unique Pageviews:
                                        <span class="number">{number}</span>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>

				</div>
			</div><!-- .one-full -->
		</div><!-- .post-body -->
	</div><!-- .full-content -->
</div><!-- #wrap -->
<? load::view('admin/partials/footer', array( 'assets' => array( '' ) ) ); ?>
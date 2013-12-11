<? load::view('admin/partials/header', array('title' => 'Dashboard', 'assets' => array('application','flot')));?>

<div id="wrap">
	<div class="full-content">
		<div id="post-body">
			<div class="row">
				<div class="title pad-right">
					<h1><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Welcome <strong><?= user_name();?></strong></h1>
						<? upgrade::check_core_version(); ?>
                    </div>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="well">
                                <h2>Recent Posts</h2>
                                <ul>
                                    <? $count = 1;
                                    foreach (load::model('content')->get() as $post ): ?>
                                        <li><a href="<?= ADMIN ?>content_update_post/<?= $post->id;?>"><?= $post->title;?></a></li>
                                    <? if ( $count == 10 )
                                            break;
                                        $count++;
                                    endforeach; ?>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="well">
                                <h2>Tentacle News</h2>

                                <ul class="feed"></ul>
                            </div>
                        </div>

                        <div class="col-md-4 ">
                            <div class="well">
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

                                        <li><col-md- class="page_view"></col-md->
                                            Pageviews:
                                            <col-md- class="number"></col-md->
                                        </li>

                                        <li><col-md- class="unique_page_view"></col-md->
                                            Unique Pageviews:
                                            <col-md- class="number">{number}</col-md->
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

				</div>
			</div><!-- .row -->
		</div><!-- .post-body -->
	</div><!-- .full-content -->
</div><!-- #wrap -->
<? load::view('admin/partials/footer', array( 'assets' => array( '' ) ) ); ?>
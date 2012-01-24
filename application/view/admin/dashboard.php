<? load::view('admin/template-header', array('title' => 'Dashboard', 'assets' => 'application'));?>
<? load::view('admin/template-sidebar');?>
<div id="wrap">
	<div class="full-content">
		<div id="post-body">
			<div class="one-full">
				<div class="title pad-right">
					<h1><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Welcome <strong><?= user_name();?></strong></h1>
					<h2>Content</h2>
					<ul>
						<li><strong>#</strong> Posts</li>
						<li><strong>#</strong> Pages</li>
						<li><strong>#</strong> Categories</li>
						<li><strong>#</strong> Tags</li>
					</ul>
					<h2>Comments</h2>
					<ul>
						<li><strong>#</strong> Comments</li>
						<li><strong>#</strong> Approved</li>
						<li><strong>#</strong> Pending</li>
						<li><strong>#</strong> Spam</li>
					</ul>
					
					<h2>Updates</h2>
					<ul>
						<li>System Updates</li>
						<li>Theme Updates</li>
						<li>Module Updates</li>
					</ul>
					<!--<span id="spin">You spin me rite round!</span>
						<div id="preview"></div>-->
				</div>
			</div><!-- .one-full -->
		</div><!-- .post-body -->
	</div><!-- .full-content -->
</div><!-- #wrap -->
<? load::view('admin/template-footer');?> 
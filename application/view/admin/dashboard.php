<? load::view('admin/template-header', array('title' => 'Dashboard', 'assets' => 'application'));?>
<? load::view('admin/template-sidebar');?>
<div id="wrap">
	<div class="full-content">
		<div id="post-body">
			<div class="one-full">
				<div class="title pad-right">
					<h1><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Dashboard</h1>
					<h2>Welcome <strong><?= $user_meta -> first_name;?> <?= $user_meta -> last_name;?></strong></h2>
				</div>
			</div><!-- .one-full -->
		</div><!-- .post-body -->
	</div><!-- .full-content -->
</div><!-- #wrap -->
<? load::view('admin/template-login-footer');?> 
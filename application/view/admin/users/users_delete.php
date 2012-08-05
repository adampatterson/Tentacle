<?	load::view('admin/template-header', array('title' => 'Add a new user', 'assets' => 'application'));?>
<?	load::view('admin/template-sidebar');?>
<div id="wrap">
	<div class="full-content">
		<div id="post-body">
			<div id="post-body-content">
				<div class="one-full">
					<h1><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Add a new user</h1>
					<div class="one-half">
						<form action="<?= BASE_URL ?>action/delete_user/<?= $id ?>" method="post">
							<fieldset>
								<p>
									You have chosen to delete <strong><?= $user_meta->display_name;?>:</strong>
								</p>
								<p>
									<label>
										<input type="hidden" value="" name="delete_user">
										<input id="delete_user" type="checkbox" value="delete" name="delete_user">
										Confirm </label>
								</p>
								
							</fieldset>
							<div class="actions">
								<input type="submit" value="Delete User" class="btn primary medium" />
								<a href="<?=ADMIN;?>users_manage/" class="red">Cancel</a>
							</div>
						</form>
					</div>
					<div class="one-half">
						&nbsp;
					</div>
				</div>
			</div><!-- .post-body-content -->
		</div><!-- #post-body -->
	</div><!-- .full-content -->
</div>
<!-- #wrap -->
<?load::view('admin/template-footer');?>
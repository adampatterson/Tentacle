<?	load::view('admin/partials/header', array('title' => 'Delete snippet','assets'=>'application')); ?>
<div id="wrap">
		<div id="post-body">
				<div class="one-full">
			     <h1 class='title'><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Delete snippet</h1>
					<div class="one-half">
						<div class="table">
							<form action="<?= BASE_URL ?>action/delete_snippet/<?= $id ?>" method="post">
								<fieldset>
									<p>You have chosen to delete <strong><?= $snippet->name; ?>:</strong></p>
									<p>
										<label>
										<input id="delete_user" type="checkbox" value="delete" name="delete_user">
										Confirm
										</label>
									</p>
									<input type="hidden" value="" name="delete_user">
								</fieldset>
								<div class="actions">
									<input type="submit" value="Delete User" class="btn btn-primary" />
								<a href="#" class="red">Cancel</a>
								</div>
							</form>
						</div>
					</div>
					<div class="one-half">
						<div class="table">
							&nbsp;
						</div>
					</div>
				</div>
				
		</div><!-- #post-body -->
</div>
<!-- #wrap -->
<?load::view('admin/partials/footer', array( 'assets' => array( '' ) ) ); ?>
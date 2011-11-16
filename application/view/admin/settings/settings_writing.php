<? load::view('admin/template-header', array('title' => 'Writing settings', 'assets' => 'application'));?>
<? load::view('admin/template-sidebar');?>
<div id="wrap">
	<form action="<?= BASE_URL ?>action/udpate_settings_post/" method="post" class="form-stacked">
		<input type="hidden" name="history" value="<?= CURRENT_PAGE ?>"/>
		<div class="one-full">
			<h1 class='title'><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Writing settings</h1>
			<div class="one-half">
				<fieldset>
					<h2>Formatting</h2>
					<hr />
					<div class="clearfix">
						<label for="default_category">Default Post Category</label>
						<div class="input">
							<select class="postform" id="default_category" name="default_category">
								<option value="21" class="level-0">Accessibility</option>
								<option value="22" class="level-0">Best Of</option>
								<option value="23" class="level-0">Biking</option>
								<option value="3" class="level-0">Books</option>
								<option selected="selected" value="1" class="level-0">Uncategorized</option>
								<option value="46" class="level-0">Usability</option>
								<option value="10" class="level-0">Web</option>
								<option value="47" class="level-0">Wordpress</option>
							</select>
						</div>
					</div>
				</fieldset>
			</div>
			<div class="one-full">
				<div class="actions">
					<input type="submit" value="Save Changes" class="btn primary medium" id="submit" name="submit">
				</div>
			</div>
		</div>
	</form>
</div>
<!-- #wrap -->
<? load::view('admin/template-footer');?>

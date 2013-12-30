<? load::view('admin/partials/header', array('title' => 'Writing settings', 'assets' => array('application')));?>

<div id="wrap">
	<form action="<?= BASE_URL ?>action/udpate_settings_post/" method="post" class="form-stacked">
		<input type="hidden" name="history" value="<?= CURRENT_PAGE ?>"/>
		<div class="row">
			<h1 class='title'><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Writing settings</h1>
			<div class="col-md-6">
				<fieldset>
					<h2>Formatting</h2>
					<hr />
					<div class="clearfix">
						<label for="default_category">Default Post Category</label>
						<div class="input">
							<select class="postform" id="default_category" name="default_category">
								<? foreach ($categories as $category): ?>
									<option id="category-<?= $category->id  ?>" value="<?= $category->id  ?>"> <?= $category->name  ?></option>
								<? endforeach;?>
							</select>
						</div>
					</div>
				</fieldset>
			</div>
			<div class="row">
				<div class="actions">
					<input type="submit" value="Save Changes" class="btn primary medium" id="submit" name="submit">
				</div>
			</div>
		</div>
	</form>
</div>
<!-- #wrap -->
<? load::view('admin/partials/footer', array( 'assets' => array( '' ) ) ); ?>

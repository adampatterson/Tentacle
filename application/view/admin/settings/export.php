<? load::view('admin/partials/header', array('title' => 'Export', 'assets' => array('application')));?>

<div id="wrap">
	<form action="<?= BASE_URL ?>action/udpate_settings_post/" method="post" class="form-stacked">
		<input type="hidden" name="history" value="<?= CURRENT_PAGE ?>"/>
		<div class="row">
			<h1 class='title'><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Export</h1>
			<div class="col-md-6">
				<p>
					When you click the button below Tentacle will create an XML file for you to save to your computer.
				</p>
				<p>
					Once you’ve saved the download file, you can use the Import function in another Tentacle installation to import this site.
				</p>
				<h2>Choose what to export</h2>
				<hr />
				<input type="hidden" value="true" name="download">
				<div class="clearfix">
					<div class="input">
						<ul class="inputs-list">
							<li>
								<label>
									<input type="radio" checked="checked" value="all" name="content">
									<span>All content</span> </label>
								<span class="help-block">This will contain all of your posts, pages, comments, custom data, snippets, navigation menus and users.</span>
							</li>
							<li>
								<input type="radio" value="posts" name="content">
								<span>Posts</span>
							</li>
							<li>
								<input type="radio" value="pages" name="content">
								<span>Pages</span>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="row">&nbsp;</div>
		</div>
		<div class="row">
			<div class="actions">
				<input type="submit" value="Save Changes" class="btn primary medium" id="submit" name="submit">
			</div>
		</div>
	</form>
</div><!-- #wrap -->
<? load::view('admin/partials/footer', array( 'assets' => array( '' ) ) ); ?>
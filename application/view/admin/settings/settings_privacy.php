<? load::view('admin/template-header', array('title' => 'Privacy settings', 'assets' => 'application'));?>
<? load::view('admin/template-sidebar');?>
<div id="wrap">
	<h1 class='title'><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Privacy settings</h1>
	<form action="<?= BASE_URL ?>action/udpate_settings_post/"  class="form-stacked">
		<input type="hidden" name="history" value="<?= CURRENT_PAGE ?>"/>
		<div class="one-half">
			<h2>Site Visibility</h2>
			<hr />
			<fieldset>
				<div class="clearfix">
					<div class="input">
						<ul class="inputs-list">
							<li>
								<label>
									<input type="radio" checked="checked" value="1" name="blog_public">
									<span>I would like my site to be visible to everyone, including search engines (like Google, Bing, Technorati) and archivers</span> </label>
							</li>
							<li>
								<label>
									<input type="radio" value="0" name="blog_public">
									<span>I would like to block search engines, but allow normal visitors</span> </label>
							</li>
						</ul>
					</div>
				</div>
			</fieldset>
			<h2>Maintenance Mode</h2>
			<hr />
			<fieldset>
				<div class="clearfix">
					<div class="input">
						<ul class="inputs-list">
							<li>
								<label>
									<input type="checkbox" value="1" name="blog_public">
									<span>I am performang maintenance on the site and want to display a message.</span> </label>
							</li>
						</ul>
					</div>
				</div>
			</fieldset>
		</div>
		<div class="one-half">
			&nbsp;
		</div>
		<div class="one-full">
			<div class="actions">
				<input type="submit" value="Save Changes" class="btn primary medium" id="submit" name="submit">
			</div>
		</div>
	</form>
</div><!-- #wrap -->
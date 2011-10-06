<? load::view('admin/template-header', array('title' => 'Media settings', 'assets' => 'application'));?>
<? load::view('admin/template-sidebar');?>
<div id="wrap">
	<h1 class='title'><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Media settings</h1>
	<form action="<?= BASE_URL ?>action/udpate_settings_post/" method="post" class="form-stacked">
		<input type="hidden" name="history" value="<?= CURRENT_PAGE ?>"/>
		<div class="one-full">
			<div class="one-half">
				<h2>Image sizes</h2>
				<hr />
				<p>
					The sizes listed below determine the maximum dimensions in pixels to use when inserting an image into the body of a post.
				</p>
				<fieldset>
					<div class="clearfix">
						<label>Thumbnail size</label>
						<div class="input">
							<div class="inline-inputs">
								<input type="text" class="small-text" value="290" name="image_thumb_size_w" id="thumbnail_size_w" />
								x
								<input type="text" class="small-text" value="290" name="image_thumb_size_h" id="thumbnail_size_h" />
							</div>
						</div>
						<div class="input">
							<ul class="inputs-list">
								<li>
									<label>
										<input type="hidden" value="0" name="thumbnail_crop">
										<input type="checkbox" value="1" name="thumbnail_crop">
										<span>Crop thumbnail to exact dimensions (normally thumbnails are proportional)</span> </label>
								</li>
							</ul>
						</div>
					</div>
					<div class="clearfix">
						<label>Medium size</label>
						<div class="input">
							<div class="inline-inputs">
								<input type="text" class="small-text" value="620" name="image_medium_size_w" id="medium_size_w" />
								x
								<input type="text" class="small-text" value="9999" name="image_medium_size_h" id="medium_size_h" />
							</div>
						</div>
					</div>
					<div class="clearfix">
						<label>Large size</label>
						<div class="input">
							<div class="inline-inputs">
								<input type="text" class="small-text" value="950" name="image_large_size_w">
								x
								<input type="text" class="small-text" value="9999" name="image_large_size_h">
							</div>
						</div>
					</div>
				</fieldset>
			</div>
			<div class="one-half">
				<h2>Uploading Files</h2>
				<hr />
				<div class="clearfix">
					<label for='upload_path'>Store uploads in this folder</label>
					<div class="input">
						<input type="text" class="regular-text code" value="tentacle/storage" name="upload_folder">
						<span class="help-block">Default is
							<code>
								tentacle/storage
							</code>
						</span>
					</div>
				</div>
				<div class="clearfix">
					<label for="upload_url_path">Full URL path to files</label>
					<div class="input">
						<input type="text" class="regular-text code" value="http://www.siteurl.com" name="upload_url">
						<span class="help-block">Configuring this is optional. By default, it should be blank.</span>
					</div>
					<div class="input">
						<ul class="inputs-list">
							<li>
								<label for="uploads_use_yearmonth_folders">
									<input type="hidden" value="0" name="upload_organize">
									<input type="checkbox" value="1" name="upload_organize">
									<span>Organize my uploads into month- and year-based folders</span>
								</label>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="one-full">
			<div class="actions">
				<input type="submit" value="Save Changes" class="btn primary medium" id="submit" name="submit">
			</div>
		</div>
	</form>
</div><!-- #wrap -->
<? load::view('admin/template-footer');?>
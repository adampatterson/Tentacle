<? load::view('admin/template-header', array('title' => 'Media settings', 'assets' => 'application'));?>
<? load::view('admin/template-sidebar');?>
<div id="wrap">
	<h1 class='title'><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Media settings</h1>
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
							<input type="text" class="small-text" value="290" name="thumbnail_size_w" id="thumbnail_size_w" />
							x
							<input type="text" class="small-text" value="290" name="thumbnail_size_h" id="thumbnail_size_h" />
						</div>
					</div>
					<div class="input">
						<ul class="inputs-list">
							<li>
								<label>
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
							<input type="text" class="small-text" value="620" name="medium_size_w" id="medium_size_w" />
							x
							<input type="text" class="small-text" value="9999" name="medium_size_h" id="medium_size_h" />
						</div>
					</div>
				</div>
				<div class="clearfix">
					<label>Large size</label>
					<div class="input">
						<div class="inline-inputs">
							<input type="text" class="small-text" value="950" name="large_size_w">
							x
							<input type="text" class="small-text" value="9999" name="large_size_h">
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
					<input type="text" class="regular-text code" value="" name="upload_path">
					<span class="help-block">Default is
						<code>
							wp-content/uploads
						</code></span>
				</div>
			</div>
			<div class="clearfix">
				<label for="upload_url_path">Full URL path to files</label>
				<div class="input">
					<input type="text" class="regular-text code" value="" name="upload_url_path">
					<span class="help-block">Configuring this is optional. By default, it should be blank.</span>
				</div>
				<div class="input">
					<ul class="inputs-list">
						<li>
							<label for="uploads_use_yearmonth_folders">
								<input type="checkbox" checked="checked" value="1" name="uploads_use_yearmonth_folders">
								<span>Organize my uploads into month- and year-based folders</span> </label>
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
</div><!-- #wrap -->
<? load::view('admin/template-footer');?>
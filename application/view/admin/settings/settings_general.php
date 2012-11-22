<? load::view('admin/partials/template-header', array('title' => 'General settings', 'assets' => array('application')));?>

<div id="wrap">
	<form action="<?= BASE_URL ?>action/udpate_settings_post/" method="post" class="form-stacked">
		<input type="hidden" name="history" value="<?= CURRENT_PAGE ?>"/>
		<div class="one-full">
			<h1 class='title'><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> General settings</h1>
			<div class="one-half">
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="blogname">Site Title</label>
						<div class="controls">
							<input type="text" value="<?= get::option('blogname'); ?>" name="blogname">
						</div>
					</div>
					
<? /*
					<div class="clearfix">
						<label for="custom_logo">Custom Logo</label>
						<div class="input">
							<input type="file" name="custom_logo">
						</div>
					</div>
					<div class="clearfix">
						<label for="custom_favicon">Custom Favicon</label>
						<div class="input">
							<input type="file" name="custom_favicon">
						</div>
					</div>
*/ ?>
					<div class="control-group">
						<label class="control-label" for="blogdescription">Tagline</label>
						<div class="controls">
							<input type="text" value="<?= get::option('blogdescription'); ?>" name="blogdescription">
							<p class="help-block">In a few words, explain what this site is about.</p>
						</div>
					</div>
					
<? /*
					<div class="clearfix">
						<label for="siteurl">Base (URL)</label>
						<div class="input">
							<input type="text" class="code" value="<?= get::option('siteurl'); ?>" name="siteurl">
						</div>
					</div>
*/ ?>
					<div class="control-group">
						<label class="control-label" for="admin_email">E-mail address</label>
						<div class="controls">
							<input type="text" value="<?= get::option('admin_email'); ?>" name="admin_email">
							<span class="help-block">This address is used for admin purposes, like new user notification.</span>
						</div>
					</div>
				</fieldset>
			</div>
			<div class="one-half">
				<fieldset>
					
					<div class="control-group">
						<label class="control-label" for="default_category">Default Post Category</label>
						<div class="controls">
							<select class="postform" id="default_category" name="default_category">
								<? foreach ($categories as $category): ?>
									<option id="category-<?= $category->id  ?>" value="<?= $category->id  ?>" <? selected( get::option('default_category'), $category->id  ); ?>> <?= $category->name  ?></option>
								<? endforeach;?>
							</select>
						</div>
					</div>
					
				</fieldset>
<? /*
				<fieldset>
					<div class="clearfix">
						<label>Membership</label>
						<div class="input">
							<ul class="inputs-list">
								<li>
									<label>
										<input type="hidden" value="0" name="users_can_register">
										<input type="checkbox" value="1" name="users_can_register">
										<span>Anyone can register</span> </label>
								</li>
							</ul>
						</div>
					</div>
					<div class="clearfix">
						<label for="default_role">New User Default Role</label>
						<div class="input">
							<select name="default_role">
								<option value="subscriber" selected="selected">Subscriber</option>
								<option value="administrator">Administrator</option>
								<option value="editor">Editor</option>
								<option value="author">Author</option>
								<option value="contributor">Contributor</option>
							</select>
						</div>
					</div>
					<div class="clearfix">
						<label for="timezone_string">Timezone</label>
						<div class="input">
							<select name="timezone_string">
								<? load::helper ('system-timezones'); ?>
							</select>
							<span class="help-block"><abbr title="Coordinated Universal Time"> UTC </abbr> time is
								<code>
									2011-04-04 4:58:48
								</code>
								<br>
								Choose a city in the same timezone as you.</span>
						</div>
					</div>
				</fieldset>
				<fieldset>
					<div class="clearfix">
						<label>Date Format</label>
						<div class="input">
							<ul class="inputs-list">
								<li>
									<label title="F j, Y">
										<input type="radio" checked="checked" value="F j, Y" name="date_format">
										<span>April 4, 2011</span> </label>
								</li>
								<li>
									<label title="Y/m/d">
										<input type="radio" value="Y/m/d" name="date_format">
										<span>2011/04/04</span> </label>
								</li>
								<li>
									<label title="m/d/Y">
										<input type="radio" value="m/d/Y" name="date_format">
										<span>04/04/2011</span> </label>
								</li>
								<li>
									<label title="d/m/Y">
										<input type="radio" value="d/m/Y" name="date_format">
										<span>04/04/2011</span> </label>
								</li>
							</ul>
						</div>
					</div>
				</fieldset>
				<fieldset>
					<div class="clearfix">
						<label>Time Format</label>
						<div class="input">
							<ul class="inputs-list">
								<li>
									<label title="g:i a">
										<input type="radio" checked="checked" value="g:i a" name="time_format">
										<span>4:58 am</span> </label>
								</li>
								<li>
									<label title="g:i A">
										<input type="radio" value="g:i A" name="time_format">
										<span>4:58 AM</span> </label>
								</li>
								<li>
									<label title="H:i">
										<input type="radio" value="H:i" name="time_format">
										<span>04:58</span> </label>
								</li>
							</ul>
						</div>
					</div>
					<div class="clearfix">
						<label for="start_of_week">Week Starts On</label>
						<div class="input">
							<select id="start_of_week" name="start_of_week">
								<option value="0">Sunday</option>
								<option selected="selected" value="1">Monday</option>
								<option value="2">Tuesday</option>
								<option value="3">Wednesday</option>
								<option value="4">Thursday</option>
								<option value="5">Friday</option>
								<option value="6">Saturday</option>
							</select>
						</div>
					</div>
				</fieldset>
*/ ?>
			</div>
		</div>
		<div class="one-full">
			<br />
			<h2>Image sizes</h2>
			<hr />
			<p>
				The sizes listed below determine the maximum dimensions in pixels to use when inserting an image into the body of a post.
			</p>
			<fieldset>
				<div class="control-group">
					<label>Thumbnail size</label>
					<div class="controls">
						<div class="inline-inputs">
							<input type="text" value="<?= get::option('image_thumb_size_w','150'); ?>" name="image_thumb_size_w" id="thumbnail_size_w" class='span2' />
							x
							<input type="text" value="<?= get::option('image_thumb_size_h','150'); ?>" name="image_thumb_size_h" id="thumbnail_size_h" class='span2' />
						</div>
					</div>
				</div>
<? /*
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
*/ ?>
				
				<div class="control-group">
					<label>Medium size</label>
					<div class="controls">
						<div class="inline-inputs">
							<input type="text" value="<?= get::option('image_medium_size_w','300'); ?>" name="image_medium_size_w" id="medium_size_w" class='span2' />
							x
							<input type="text" value="<?= get::option('image_medium_size_h','300'); ?>" name="image_medium_size_h" id="medium_size_h" class='span2' />
						</div>
					</div>
				</div>
				
				<div class="control-group">
					<label>Large size</label>
					<div class="controls">
						<div class="inline-inputs">
							<input type="text" value="<?= get::option('image_large_size_w','600'); ?>" name="image_large_size_w" class='span2' />
							x
							<input type="text" value="<?= get::option('image_large_size_h','600'); ?>" name="image_large_size_h" class='span2' />
						</div>
					</div>
				</div>
			</fieldset>
		</div>
		<div class="one-full">
			<div class="form-actions">
				<button class="btn btn-primary" type="submit">
					Save Changes
				</button>
			</div>
		</div>
	</form>
</div>
<!-- #wrap -->
<? load::view('admin/partials/template-footer', array( 'assets' => array( '' ) ) ); ?>

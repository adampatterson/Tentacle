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
                        <label class="control-label" for="blog_uri">Blog Path</label>
                        <div class="controls">
                            <select class="postform" id="blog_uri" name="blog_uri">
                                <? foreach ($pages as $page): ?>
                                    <option id="page-<?= $page['id']  ?>" value="<?= $page['slug'] ?>" <? selected( get::option('blog_uri'), $page['slug']  ); ?>> <?= $page['title'] ?></option>
                                <? endforeach;?>
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="page_limit">Posts per page</label>
                        <div class="controls">
                            <input type="text" value="<?= get::option('page_limit', 5); ?>" name="page_limit">
                            <p class="help-block">How many blog posts would you like to see on a page?</p>
                        </div>
                    </div>

                    <div class="control-group">
						<label class="control-label" for="admin_email">Site E-mail address</label>
						<div class="controls">
							<input type="text" value="<?= get::option('admin_email'); ?>" name="admin_email">
							<span class="help-block">This address is used for admin purposes, like new user notification.</span>
						</div>
					</div>

                    <div class="control-group">
                        <label class="control-label" for="admin_email">Site author name</label>
                        <div class="controls">
                            <input type="text" value="<?= get::option('admin_author'); ?>" name="admin_author">
                            <span class="help-block">This should be the site owners name, It will also show up in user emails.</span>
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

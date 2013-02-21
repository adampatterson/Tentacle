<? load::view('admin/partials/template-header', array('title' => 'SEO settings', 'assets' => array('application')));?>

<div id="wrap">
	<h1 class='title'><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> SEO settings</h1>
	<form action="<?= BASE_URL ?>action/udpate_settings_post/"  class="form-stacked" method="post">
		<input type="hidden" name="history" value="<?= CURRENT_PAGE ?>"/>
		<div class="one-full">

                <h2>Analytic Settings</h2>
                <div class="span8 well">
                    <p>Please enter your Google Analytics tracking code, If you do not have an account or tracking code for this site. Go to and <a href="http://www.google.com/analytics/">register</a></p>

                        <fieldset>

                            <div class="control-group">
                                <label class="control-label" for="blogname">Tracking Code</label>
                                <div class="controls">
                                    <input type="text" value="<?= get::option('seo_google_analytics', '') ?>" placeholder="UA-XXXXXX-XX" name="seo_google_analytics">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="blogname">Author Profile</label>
                                <div class="controls">
                                    <input type="text" value="<?= get::option('seo_author_profile', '') ?>" name="seo_author_profile">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="blogname">Google Webmaster Tools</label>
                                <div class="controls">
                                            <input type="text" value="<?= get::option('seo_google_webmaster', '') ?>" name="seo_google_webmaster">
                                    <span class="help-block">
                                        Enter your meta key "content" value to verify your blog with <a href="https://www.google.com/webmasters/tools/">Google Webmaster Tools</a>
                                    </span>
                                </div>
                            </div>


                        </fieldset>



                </div>
                <div class="span8 well">
                    <h2>Meta description</h2>
                    <textarea rows="5" cols="40" name="seo_meta_description" placeholder='Enter your meta description'><?= get::option('seo_meta_description'); ?></textarea>

		    </div>

		<div class="one-full">
			<div class="actions">
				<button class="btn btn-primary" type="submit">
					Save changes
				</button>
			</div>
		</div>
	</form>
</div>
<!-- #wrap -->
<? load::view('admin/partials/template-footer', array( 'assets' => array( '' ) ) ); ?>

<? load::view('admin/partials/header', array('title' => 'SEO settings', 'assets' => array('application')));?>

<div id="wrap">
	<h1 class='title'><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> SEO settings</h1>
	<form action="<?= BASE_URL ?>action/udpate_settings_post/" class="form-stacked" method="post" role="form">

		<input type="hidden" name="history" value="<?= CURRENT_PAGE ?>"/>

		<div class="row">

            <div class="col-md-6">
                <div class="well">
                <h2>Analytic Settings</h2>
                <p>Please enter your Google Analytics tracking code, If you do not have an account or tracking code for this site. Go to and <a href="http://www.google.com/analytics/">register</a></p>

                    <fieldset>

                        <div class="form-group">
                            <label for="blogname">Tracking Code</label>
                            <div class="controls">
                                <input type="text" class="form-control" value="<?= get::option('seo_google_analytics', '') ?>" placeholder="UA-XXXXXX-XX" name="seo_google_analytics">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="blogname">Author Profile</label>
                            <div class="controls">
                                <input type="text" class="form-control" value="<?= get::option('seo_author_profile', '') ?>" name="seo_author_profile">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="blogname">Google Webmaster Tools</label>
                            <div class="controls">
                                <input type="text" class="form-control" value="<?= get::option('seo_google_webmaster', '') ?>" name="seo_google_webmaster">
                                <span class="help-block">
                                    Enter your meta key "content" value to verify your blog with <a href="https://www.google.com/webmasters/tools/">Google Webmaster Tools</a>
                                </span>
                            </div>
                        </div>

                    </fieldset>
                </div>

                <div class="well">
                    <h2>Social Media Settings</h2>

                    <fieldset>

                        <div class="form-group">
                            <label for="blogname">Twitter </label>
                            <div class="controls">
                                <input type="text" class="form-control" value="<?= get::option('seo_social_twitter', '') ?>" placeholder="twitter" name="seo_social_twitter">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="blogname">Facebook </label>
                            <div class="controls">
                                <input type="text" class="form-control" value="<?= get::option('seo_social_facebook', '') ?>" placeholder="" name="seo_social_facebook">
                            </div>
                        </div>

                    </fieldset>

                </div>

            </div>
            <div class="col-md-6">
                <div class="well">
                    <h2>Generate <em>sitemap.xml</em></h2>
                    <a class="btn btn-lg btn-primary" href="<?= BASE_URL ?>action/generate_sitemap">Generate</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="well">
                    <h2>Meta description</h2>
                    <textarea rows="10"  name="seo_meta_description" class="form-control" placeholder='Enter your meta description'><?= get::option('seo_meta_description'); ?></textarea>

                    <h2>Custom tracking code ( header )</h2>
                    <textarea rows="10" name="seo_tracking_header" class="form-control" placeholder=''><?= get::option('seo_tracking_header'); ?></textarea>

                    <h2>Custom tracking code ( footer )</h2>
                    <textarea rows="10"  name="seo_tracking_footer" class="form-control" placeholder=''><?= get::option('seo_tracking_footer'); ?></textarea>
                </div>
            </div>
        </div>
        <div class="row">

			<div class="actions">
				<button class="btn btn-primary" type="submit">
					Save changes
				</button>
			</div>

		</div>
	</form>
</div>
<!-- #wrap -->
<? load::view('admin/partials/footer', array( 'assets' => array( '' ) ) ); ?>

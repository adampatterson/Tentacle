<? load::view('admin/templates/template-header', array('title' => 'Reading settings', 'assets' => array('application')));?>
<? load::view('admin/templates/template-sidebar');?>
<div id="wrap">
	<form action="<?= BASE_URL ?>action/udpate_settings_post/" method="post" class="form-stacked"> 
		<input type="hidden" name="history" value="<?= CURRENT_PAGE ?>"/>
		<div class="one-full">
			<h1 class='title'><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Reading Settings</h1>
			<div class="one-half">				
				<h2>Front page displays</h2>
				<hr />
				<fieldset>
					<div class="clearfix">
						<div class="input">
							<ul class="inputs-list">
								<li>
									<label>
										<input type="radio" class="tog" value="posts" name="show_on_front">
										<span>Your latest posts</span> </label>
								</li>
								<li>
									<label>
										<input type="radio" checked="checked" class="tog" value="page" name="show_on_front">
										<span>A <a href="edit.php?post_type=page">static page</a> (select below)</span> </label>
								</li>
							</ul>
						</div>
					</div>
					<div class="clearfix">
						<label for="page_on_front">Front page:</label>
						<div class="input">
							<select id="page_on_front" name="page_on_front">
								<option value="0">&mdash; Select &mdash;</option>
								<option value="2">About Me</option>
								<option value="6">Blog</option>
								<option value="2629">Get an Estimate</option>
								<option value="10">Get In Touch</option>
								<option selected="selected" value="4">Home</option>
								<option value="2423">Projects</option>
								<option value="2482">&nbsp;&nbsp;&nbsp;Addressbook</option>
								<option value="2544">&nbsp;&nbsp;&nbsp;PHP Collab v3</option>
								<option value="2483">&nbsp;&nbsp;&nbsp;Spoke Calculator</option>
								<option value="9">Resume</option>
								<option value="2528">Scripts</option>
								<option value="7">Services</option>
								<option value="8">Work</option>
								<option value="2730">&nbsp;&nbsp;&nbsp;Alldritt Homes</option>
								<option value="2657">&nbsp;&nbsp;&nbsp;Alley Kat Brewing</option>
								<option value="2649">&nbsp;&nbsp;&nbsp;Barr Estate Winery</option>
								<option value="2401">&nbsp;&nbsp;&nbsp;Britta</option>
								<option value="2409">&nbsp;&nbsp;&nbsp;Caritas Hospitals Foundation</option>
								<option value="2652">&nbsp;&nbsp;&nbsp;Champion Pet Foods</option>
								<option value="2410">&nbsp;&nbsp;&nbsp;Coalition on Prescription Drug Misuse</option>
								<option value="2660">&nbsp;&nbsp;&nbsp;Fairley Erker</option>
								<option value="2645">&nbsp;&nbsp;&nbsp;Guinness</option>
								<option value="2408">&nbsp;&nbsp;&nbsp;LearnAlberta.ca</option>
								<option value="2407">&nbsp;&nbsp;&nbsp;Leverage Controls</option>
								<option value="2404">&nbsp;&nbsp;&nbsp;PHP Collab 3.0</option>
								<option value="2406">&nbsp;&nbsp;&nbsp;Sassy Cakes</option>
								<option value="2471">&nbsp;&nbsp;&nbsp;SPT Drilling</option>
								<option value="2405">&nbsp;&nbsp;&nbsp;Valour Place</option>
								<option value="2443">&nbsp;&nbsp;&nbsp;Vision Creative Inc</option>
							</select>
						</div>
					</div>
					<div class="clearfix">
						<label for="page_for_posts">Posts page:</label>
						<div class="input">
							<select id="page_for_posts" name="page_for_posts">
								<option value="0">&mdash; Select &mdash;</option>
								<option value="2">About Me</option>
								<option selected="selected" value="6">Blog</option>
								<option value="2629">Get an Estimate</option>
								<option value="10">Get In Touch</option>
								<option value="4">Home</option>
								<option value="2423">Projects</option>
								<option value="2482">&nbsp;&nbsp;&nbsp;Addressbook</option>
								<option value="2544">&nbsp;&nbsp;&nbsp;PHP Collab v3</option>
								<option value="2483">&nbsp;&nbsp;&nbsp;Spoke Calculator</option>
								<option value="9">Resume</option>
								<option value="2528">Scripts</option>
								<option value="7">Services</option>
								<option value="8">Work</option>
								<option value="2730">&nbsp;&nbsp;&nbsp;Alldritt Homes</option>
								<option value="2657">&nbsp;&nbsp;&nbsp;Alley Kat Brewing</option>
								<option value="2649">&nbsp;&nbsp;&nbsp;Barr Estate Winery</option>
								<option value="2401">&nbsp;&nbsp;&nbsp;Britta</option>
								<option value="2409">&nbsp;&nbsp;&nbsp;Caritas Hospitals Foundation</option>
								<option value="2652">&nbsp;&nbsp;&nbsp;Champion Pet Foods</option>
								<option value="2410">&nbsp;&nbsp;&nbsp;Coalition on Prescription Drug Misuse</option>
								<option value="2660">&nbsp;&nbsp;&nbsp;Fairley Erker</option>
								<option value="2645">&nbsp;&nbsp;&nbsp;Guinness</option>
								<option value="2408">&nbsp;&nbsp;&nbsp;LearnAlberta.ca</option>
								<option value="2407">&nbsp;&nbsp;&nbsp;Leverage Controls</option>
								<option value="2404">&nbsp;&nbsp;&nbsp;PHP Collab 3.0</option>
								<option value="2406">&nbsp;&nbsp;&nbsp;Sassy Cakes</option>
								<option value="2471">&nbsp;&nbsp;&nbsp;SPT Drilling</option>
								<option value="2405">&nbsp;&nbsp;&nbsp;Valour Place</option>
								<option value="2443">&nbsp;&nbsp;&nbsp;Vision Creative Inc</option>
							</select>
						</div>
					</div>
				</fieldset>
				<fieldset>
					<div class="clearfix">
						<label for="posts_per_page"> Blog posts per page </label>
						<div class="input">
							<input type="text" class="mini" value="<?= get_option('posts_per_page'); ?>" id="posts_per_page" name="posts_per_page">
						</div>
					</div>
					<div class="clearfix">
						<label for="posts_per_rss"> Syndication items in feed </label>
						<div class="input">
							<input type="text" class="mini" value="<?= get_option('posts_per_rss'); ?>" id="posts_per_rss" name="posts_per_rss">
						</div>
					</div>
				</fieldset>
			</div>
			<div class="one-half">
				<h2>Feed settings</h2>
				<hr />
				<fieldset>
					<div class="clearfix">
						<label for="feed_url">Custom Feed URL</label>
						<div class="input">
							<input type="text" value="<?= get_option('feed_url'); ?>" id="feed_url" name="feed_url">
						</div>
					</div>
					<div class="clearfix">
						<label>For each article in a feed, show</label>
						<div class="input">
							<ul class="inputs-list">
								<li>
									<label>
										<input type="radio" checked="checked" value="0" name="rss_use_excerpt">
										<span>Full text</span> </label>
									<label>
								</li>
								<li>
									<label>
										<input type="radio" value="1" name="rss_use_excerpt">
										<span>Summary</span> </label>
								</li>
							</ul>
						</div>
					</div>
					<div class="clearfix">
						<label for="blog_charset"> Encoding for pages and feeds </label>
						<div class="input">
							<input type="text" value="<?= get_option('blog_charset'); ?>" id="blog_charset" name="blog_charset">
							<span class="help-block">The <a href="http://codex.wordpress.org/Glossary#Character_set">character encoding</a> of your site (UTF-8 is recommended, if you are adventurous there are some <a href="http://en.wikipedia.org/wiki/Character_set">other encodings</a>)</span>
						</div>
					</div>
				</fieldset>
			</div>
		</div>
		<div class="one-full">
			<div class="actions">
				<input type="submit" value="Save Changes" class="btn primary medium" id="submit" name="submit">
			</div>
		</div>
	</form>
</div>
<!-- #wrap -->
<? load::view('admin/templates/template-footer', array( 'assets' => array( '' ) ) ); ?>
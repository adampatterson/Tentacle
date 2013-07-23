	<footer>
		<hr />
		<div class="container">
			<div class="row bump">
				<div class="span3">
					<h4>Contact us</h4>
					<ul class="unstyled">
						<li class="lead"><a href="mailto:hello@tentaclecms.com" onclick="mixpanel.track('Content', { 'link': 'Email' });">hello@tentaclecms.com</a></li>
						<li class="lead"><a href="https://twitter.com/tentaclecms" class="twitter-follow-button" data-show-count="false">Follow @tentaclecms</a></li>
					
					<li class="lead"><iframe src="http://ghbtns.com/github-btn.html?user=adampatterson&repo=tentacle&type=watch&count=true"
					  allowtransparency="true" frameborder="0" scrolling="0" width="180px" height="20px"></iframe></li>
					<li class="lead"><iframe src="http://ghbtns.com/github-btn.html?user=adampatterson&repo=tentacle&type=fork&count=true"
					  allowtransparency="true" frameborder="0" scrolling="0" width="180px" height="20px"></iframe></li>
					<li class="lead"><iframe src="http://ghbtns.com/github-btn.html?user=adampatterson&type=follow&count=true"
					  allowtransparency="true" frameborder="0" scrolling="0" width="180px" height="20px"></iframe></li>
					</ul>
				</div>
			
				<div class="span3">
					<h4>Subscribe to our newsletter</h4>
					<p>Get the lowdown on announcements and cool new features.</p>
					<p class="lead"><a href="http://www.industrymailout.com/Industry/Subscribe.aspx?m=27205" target="_blank" onClick="_gaq.push(['_trackEvent', 'Footer', 'Link', 'Mailing List']); mixpanel.track('Content', { 'link': 'Mailing List' });" >Click here to subscribe</a></p>
				</div>
				
				<div class="span3">
					<h4>Report a Bug</h4>
					<p class="lead">If you found a bug in the CMS use the on GitHub to report it.</p>
					<p class="lead"><a href="https://github.com/adampatterson/Tentacle/issues" class="track" data-track="bar this" onClick="_gaq.push(['_trackEvent', 'Content', 'Button', 'Git Issue']); mixpanel.track('Content', { 'link': 'Git Issue' });">Submit an Issue</a></p>
				</div>
				<div class="span3">
					<h4>Contribute</h4>
					<p class="lead">Tentacle CMS is hosted on Github, Contributing is easy!</p>
					<p class="lead"><a href="https://github.com/adampatterson/Tentacle/issues" onClick="_gaq.push(['_trackEvent', 'Content', 'Button', 'Git Source']); mixpanel.track('Content', { 'link': 'Git Source' });">Contribute today!</a></p>
				</div>

			</div>
			<div class="row">
				<ul class="nav nav-pills span8">
					<?/* https://twitter.com/intent/tweet?original_referer=https%3A%2F%2Fwww.tentaclecms.com&text=I%20just%20downloaded%20Tentacle%20CMS,%20you%20should%20try%20it%20as%20well!%20Get%20it%20here:%20&tw_p=tweetbutton&url=http%3A%2F%2Fwww.tentaclecms.com */?>
					<li>
						<a href="https://twitter.com/#!/TentacleCMS" target="_blank"  onClick="_gaq.push(['_trackEvent', 'Navigation Link', 'Link', 'Twitter']); mixpanel.track('Footer Navigation', { 'link': 'Twitter' });">@TentacleCMS</a>
					</li>
					<li class="">
						<a href="http://try.tentaclecms.com" target="_blank" onClick="_gaq.push(['_trackEvent', 'Navigation Link', 'Link', 'Demo']); mixpanel.track('Footer Navigation', { 'link': 'Demo' });">Try it!</a>
					</li>
					<li class="">
						<a href="http://tentaclecms.com/blog/"  onClick="_gaq.push(['_trackEvent', 'Navigation Link', 'Link', 'Blog']); mixpanel.track('Footer Navigation', { 'link': 'Blog' });">Blog</a>
					</li>
					<li class="">
						<a href="http://tentaclecms.com/docs/"  onClick="_gaq.push(['_trackEvent', 'Navigation Link', 'Link', 'Documentation']); mixpanel.track('Footer Navigation', { 'link': 'Documentation' });">Documentation</a>
					</li>
					<li>
						<a href="http://community.tentaclecms.com/"  onClick="_gaq.push(['_trackEvent', 'Navigation Link', 'Link', 'Community']); mixpanel.track('Footer Navigation', { 'link': 'Community' });">Community</a>
					</li>
					<li class="">
						<a href="mailto:hello@tentaclecms.com" onClick="_gaq.push(['_trackEvent', 'Navigation Link', 'Link', 'Contact']); mixpanel.track('Footer Navigation', { 'link': 'Contact Us' });">Contact Us</a>
					</li>
				</ul>
				<ul class="nav nav-pills pull-right">
					<li>
						<a href="https://mixpanel.com/f/partner"><img src="//cdn.mxpnl.com/site_media/images/partner/badge_light.png" alt="Mobile Analytics" /></a>
					</li>
				</ul>
			</div>
			<div class="row bump">
				<div class="span8">&nbsp;</div>
			</div>
		</div> <!-- /container -->
	</footer>
 	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script src="<?= THEME ?>/assets/js/application.min.js"></script>

	<!--<a href="https://github.com/adampatterson/Tentacle/tree/beta-wip" class="visible-desktop"><img style="position: absolute; top: 60px; right: 0; border: 0;" src="https://s3.amazonaws.com/github/ribbons/forkme_right_green_007200.png" alt="Fork me on GitHub"></a>-->

	<script type="text/javascript" charset="utf-8">	
	
		//mixpanel.track_pageview("<?//= $track ?>");
		//mixpanel.identify('90876ughbjknl097896t86fvbjlkj');
		mixpanel.track_forms("#newsletter", "Newsletter submission");
		
		$(".track").click(function() {
		    // This sends us an event every time a user clicks the button
			var Link  = $(this).data('track');
		
			mixpanel.track(Link); 
		
			return false;
		});
	</script>

    <? render_footer( ); ?>
    </body>
</html>
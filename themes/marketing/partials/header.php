<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="utf-8">
	<title><?= get_option('blogname').' - '.$title ?></title>

	<? if (isset($download) && $download == true): ?>
		<meta content="0; URL=http://tentaclecms.com/blog/downloads/tentacle-beta" http-equiv="Refresh" />
	<? endif;?>

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<? theme::assets($assets); ?>
	<script type="text/javascript">

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-403336-24']);
	  _gaq.push(['_setDomainName', 'tentaclecms.com']);
	  _gaq.push(['_trackPageview']);

	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();

	</script>
</head>
<? $prettify = false ;?>
<body <?= body_class(); ?> <? if ($prettify)echo 'onLoad="NDOnLoad();prettyPrint();"' ?>>
	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container hidden-phone hidden-tablet">
				<ul class="nav">
					<li>
						<a href="<?= BASE_URL ?>" class="brand" ><img src="<?= PATH ?>/assets/img/tentacle.png" alt=""/></a>
					</li>
				</ul>
				<ul class="nav pull-right">
					<li>
						<a href="https://twitter.com/#!/TentacleCMS" target="_blank"  onClick="_gaq.push(['_trackEvent', 'Navigation Link', 'Link', 'Twitter']);">@TentacleCMS</a>
					</li>
					<li class="">
						<a href="http://try.tentaclecms.com" target="_blank" onClick="_gaq.push(['_trackEvent', 'Navigation Link', 'Link', 'Demo']);">Try it!</a>
					</li>
					<li class="">
						<a href="http://tentaclecms.com/blog/"  onClick="_gaq.push(['_trackEvent', 'Navigation Link', 'Link', 'Blog']);">Blog</a>
					</li>
					<li class="">
						<a href="http://tentaclecms.com/docs/"  onClick="_gaq.push(['_trackEvent', 'Navigation Link', 'Link', 'Documentation']);">Documentation</a>
					</li>
					<li>
						<a href="http://community.tentaclecms.com/"  onClick="_gaq.push(['_trackEvent', 'Navigation Link', 'Link', 'Community']);">Community</a>
					</li>
					<li class="">
						<a href="mailto:hello@tentaclecms.com" onClick="_gaq.push(['_trackEvent', 'Navigation Link', 'Link', 'Contact']);">Contact Us</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
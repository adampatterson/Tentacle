<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="utf-8">
	<title><?= get::option('blogname').' - '.$title ?></title>

	<? if (isset($download) && $download == true): ?>
		<meta content="0; URL=http://api.tentaclecms.com/get/download/" http-equiv="Refresh" />
	<? endif;?>

	<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
	<meta name="description" content="<?= get::option('blogdescription'); ?>">
    <meta name="author" content="Adam Patterson">

    <meta property="og:title" content="<?= get::option('blogname'); ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= BASE_URL.URI ?>">
    <meta property="og:image" content="<?= THEME ?>/assets/img/tentacle.png">
    <meta property="og:site_name" content="<?= get::option('blogname'); ?>">
    <meta property="og:description" content="<?= get::option('blogdescription'); ?>">

    <? render_meta( ); ?>
    <? render_canonical( ); ?>
    <? render_shortlink( ); ?>

    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-403336-32', 'tentaclecms.com');
      ga('send', 'pageview', {
          'anonymizeIp': true
      });

    </script>

    <script type="text/javascript">
      var base_theme      = '<?= THEME ?>';
      var base_url        = '<?= BASE_URL ?>';
    </script>

	<? theme::assets($assets);
      render_header( ); ?>
</head>
<? $prettify = false ;?>
<body <?= body_class(); ?> <? if ($prettify)echo 'onLoad="NDOnLoad();prettyPrint();"' ?>>
	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container hidden-phone hidden-tablet">
				<ul class="nav">
					<li>
						<a href="<?= BASE_URL ?>" class="brand" ><img src="<?= THEME ?>/assets/img/tentacle.png" alt=""/></a>
					</li>
				</ul>
				<ul class="nav pull-right">
					<li>
						<a href="https://twitter.com/#!/TentacleCMS" target="_blank"  onClick="ga('send', 'event', 'Navigation', 'Link', 'Twitter', 1);  mixpanel.track('Header Navigation', { 'link': 'Twitter' });">@TentacleCMS</a>
					</li>
					<li class="">
						<a href="http://try.tentaclecms.com" target="_blank" onClick="ga('send', 'event', 'Navigation', 'Link', 'Demo', 1);   mixpanel.track('Header Navigation', { 'link': 'Demo' });">Try it!</a>
					</li>
					<li class="">
						<a href="http://tentaclecms.com/blog/"  onClick="ga('send', 'event', 'Navigation', 'Link', 'Blog', 1);  mixpanel.track('Header Navigation', { 'link': 'Blog' });">Blog</a>
					</li>
					<li class="">
						<a href="http://tentaclecms.com/docs/"  onClick="ga('send', 'event', 'Navigation', 'Link', 'Documentation', 1);  mixpanel.track('Header Navigation', { 'link': 'Documentation' });">Documentation</a>
					</li>
					<li>
						<a href="http://community.tentaclecms.com/"  onClick="ga('send', 'event', 'Navigation', 'Link', 'Community', 1);   mixpanel.track('Header Navigation', { 'link': 'Community' });">Community</a>
					</li>
					<li class="">
						<a href="mailto:hello@tentaclecms.com" onClick="ga('send', 'event', 'Navigation', 'Link', 'Contact', 1);   mixpanel.track('Header Navigation', { 'link': 'Contact' });">Contact Us</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
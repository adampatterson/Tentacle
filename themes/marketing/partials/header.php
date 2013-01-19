<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="utf-8">
	<title><?= get::option('blogname').' - '.$title ?></title>

	<? if (isset($download) && $download == true): ?>
		<meta content="0; URL=http://api.tentaclecms.com/get/download/" http-equiv="Refresh" />
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
	<!-- start Mixpanel --><script type="text/javascript">(function(e,b){if(!b.__SV){var a,f,i,g;window.mixpanel=b;a=e.createElement("script");a.type="text/javascript";a.async=!0;a.src=("https:"===e.location.protocol?"https:":"http:")+'//cdn.mxpnl.com/libs/mixpanel-2.2.min.js';f=e.getElementsByTagName("script")[0];f.parentNode.insertBefore(a,f);b._i=[];b.init=function(a,e,d){function f(b,h){var a=h.split(".");2==a.length&&(b=b[a[0]],h=a[1]);b[h]=function(){b.push([h].concat(Array.prototype.slice.call(arguments,0)))}}var c=b;"undefined"!==
	typeof d?c=b[d]=[]:d="mixpanel";c.people=c.people||[];c.toString=function(b){var a="mixpanel";"mixpanel"!==d&&(a+="."+d);b||(a+=" (stub)");return a};c.people.toString=function(){return c.toString(1)+".people (stub)"};i="disable track track_pageview track_links track_forms register register_once alias unregister identify name_tag set_config people.set people.increment".split(" ");for(g=0;g<i.length;g++)f(c,i[g]);b._i.push([a,e,d])};b.__SV=1.2}})(document,window.mixpanel||[]);
	mixpanel.init("d66186500a988124d53252864e395e67");</script><!-- end Mixpanel -->
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
						<a href="https://twitter.com/#!/TentacleCMS" target="_blank"  onClick="_gaq.push(['_trackEvent', 'Navigation Link', 'Link', 'Twitter']);  mixpanel.track('Header Navigation', { 'link': 'Twitter' });">@TentacleCMS</a>
					</li>
					<li class="">
						<a href="http://try.tentaclecms.com" target="_blank" onClick="_gaq.push(['_trackEvent', 'Navigation Link', 'Link', 'Demo']);   mixpanel.track('Header Navigation', { 'link': 'Demo' });">Try it!</a>
					</li>
					<li class="">
						<a href="http://tentaclecms.com/blog/"  onClick="_gaq.push(['_trackEvent', 'Navigation Link', 'Link', 'Blog']);  mixpanel.track('Header Navigation', { 'link': 'Blog' });">Blog</a>
					</li>
					<!--<li class="">
						<a href="http://tentaclecms.com/docs/"  onClick="_gaq.push(['_trackEvent', 'Navigation Link', 'Link', 'Documentation']);   mixpanel.track('Header Navigation', { 'link': 'Documentation' });">Documentation</a>
					</li> -->
					<li>
						<a href="http://community.tentaclecms.com/"  onClick="_gaq.push(['_trackEvent', 'Navigation Link', 'Link', 'Community']);   mixpanel.track('Header Navigation', { 'link': 'Community' });">Community</a>
					</li>
					<li class="">
						<a href="mailto:hello@tentaclecms.com" onClick="_gaq.push(['_trackEvent', 'Navigation Link', 'Link', 'Contact']);   mixpanel.track('Header Navigation', { 'link': 'Contact' });">Contact Us</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
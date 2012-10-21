<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="utf-8">
	<title><?= get_option('blogname').' - '.$title ?></title>

	<? if (isset($download) && $download == true): /*?>
		<!-- <meta content="0; URL=http://tentaclecms.com/blog/downloads/tentacle-beta" http-equiv="Refresh" /> -->
	<? 
	*/
	endif;?>

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
			<div class="container visible-phone visible-tablet">
				<ul class="nav pull-left">
					<li>
						<a href="<?= BASE_URL ?>" class="brand"><img src="<?= PATH ?>/assets/img/tentacle.png" alt="" /></a>
					</li>
				</ul>
			</div>
			<div class="container hidden-phone hidden-tablet">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<ul class="nav">
					<li>
						<a href="<?= BASE_URL ?>" class="brand" ><img src="<?= PATH ?>/assets/img/tentacle.png" alt=""/></a>
					</li>
				</ul>
				<ul class="nav pull-right">
					<li>
						<a href="https://twitter.com/#!/TentacleCMS" target="_blank">@TentacleCMS</a>
					</li>
					<li class="">
						<a href="http://try.tentaclecms.com" target="_blank">Try it!</a>
					</li>
					<li class="">
						<a href="http://tentaclecms.com/blog/">Blog</a>
					</li>
					<li class="">
						<a href="http://tentaclecms.com/docs/">Documentation</a>
					</li>
					<li>
						<a href="http://community.tentaclecms.com/">Community</a>
					</li>
					<li class="">
						<a href="http://tentaclecms.com/blog/about-tentacle/">About</a>
					</li>
					<li class="">
						<a href="http://tentaclecms.com/blog/contact/">Contact</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
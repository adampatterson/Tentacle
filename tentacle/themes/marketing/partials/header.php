<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="utf-8">
	<title><?= get_option('blogname').' - '.$title ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<? theme::assets($assets); ?>
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
						<a href="https://twitter.com/#!/TentacleCMS">@TentacleCMS</a>
					</li>
					<li class="">
						<a href="http://demo.tentaclecms.com" target="_blank">Demo</a>
					</li>
					<li class="">
						<a href="http://tentaclecms.com/blog/">Blog</a>
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
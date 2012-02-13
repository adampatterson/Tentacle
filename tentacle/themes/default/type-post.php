<?
/*
Type: Post
*/
if( !defined( 'SCAFFOLD' ) ):
?>
<? //load_part('header',array('title'=>'Welcome to Tentacle','assets'=>'marketing')); ?>
<!DOCTYPE html>
<html lang="en"> 
<head>
<meta charset="utf-8"> 
<title>Post Type <?= $data->title; ?></title>
<meta name="description" content="">
<meta name="author" content="">
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<script type="text/javascript" src="<?=TENTACLE_JS; ?>jquery.min.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>bootstrap-dropdown.js"></script>
	<link type="text/css" rel="stylesheet" href="<?=TENTACLE_CSS; ?>bootstrap-1.4.0.min.css">
	<link type="text/css" rel="stylesheet" href="<?=TENTACLE_CSS; ?>general.css">
	<link type="text/css" rel="stylesheet" href="<?=TENTACLE_CSS; ?>admin.css">
	<link href="<?= PATH ?>/css/bootstrap.css" rel="stylesheet">
	<style type="text/css" media="screen">
		body {
		  padding-top: 60px;
		  padding-bottom: 40px;
		}
	</style>
  </head>

  <body>
	
	<div class="container-fluid">
		<div class="row-fluid">
		<div class="span3">
			<div class="well sidebar-nav">
				<? nav_menu(); ?>
				<li><a href="<?= BASE_URL?>blog/">Blog</a></li>
		  </div><!--/.well -->
		</div><!--/span-->
		<div class="span9">
		  <div class="hero-unit">
			<h1><?= $data->title; ?></h1>
			<?= stripslashes( $data->content ); ?>
		  </div>
		</div><!--/span-->
	  </div><!--/row-->
	<footer>
		<p><a href="http://tentaclecms.com"><img src="<?= PATH ?>/images/tentacle_logo_footer.png" alt="Tentacle" /></a></p>
	</footer>

	</div><!-- /container -->

	<? if(user::valid()) load::helper ('adminbar'); ?>	
	</body>
</html>

<? //load_part('footer'); ?> 
<? endif; ?>
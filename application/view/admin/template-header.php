<!DOCTYPE html>
<html lang="en"> 
<head>
<meta charset="utf-8"> 
<meta name="description" content="">
<meta name="author" content="">
<meta content="width=device-width, initial-scale=1" name="viewport">
<title>Tentacle Admin - <?= $title?></title>
<!--

	_/_/_/_/_/                      _/                          _/           
	   _/      _/_/    _/_/_/    _/_/_/_/    _/_/_/    _/_/_/  _/    _/_/    
	  _/    _/_/_/_/  _/    _/    _/      _/    _/  _/        _/  _/_/_/_/   
	 _/    _/        _/    _/    _/      _/    _/  _/        _/  _/          
	_/      _/_/_/  _/    _/      _/_/    _/_/_/    _/_/_/  _/    _/_/_/     
	======================================================================-->                                                                 

<!--
	<script type="text/javascript" src="<?= MINIFY ?>b=http/dev.tcms.me/tentacle/admin/js&amp;f=jquery.min.js,jquery-ui-1.8.16.custom.min.js,modernizr-2.0.6.min.js,jquery.notice.js,jquery.inputtags.js,spin.min.js"></script>
-->
	<link type="text/css" rel="stylesheet" href="<?=TENTACLE_CSS; ?>bootstrap-1.4.0.min.css">
	<link type="text/css" rel="stylesheet" href="<?=TENTACLE_CSS; ?>general.css">
	<link type="text/css" rel="stylesheet" href="<?=TENTACLE_CSS; ?>admin.css">

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>jquery-ui-1.8.16.custom.min.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>modernizr-2.0.6.min.js"></script>
	
	<script type="text/javascript" src="<?= TENTACLE_JS; ?>jquery.notice.js"></script>
	<script type="text/javascript" src="<?= TENTACLE_JS; ?>jquery.inputtags.js"></script>

	<script type="text/javascript" src="<?=TENTACLE_JS; ?>bootstrap-tabs.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>bootstrap-alerts.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>bootstrap-dropdown.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>bootstrap-scrollspy.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>bootstrap-modal.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>bootstrap-twipsy.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>bootstrap-popover.js"></script>
	
	<!--<script type="text/javascript" src="<?=TENTACLE_JS; ?>spin.min.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>sisyphus.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>jquery.validate.js"></script>-->
	
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<!-- fancyBox MODAL -->
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>fancyBox/source/jquery.fancybox.js?v=2.0.6"></script>
	<link rel="stylesheet" type="text/css" href="<?=TENTACLE_JS; ?>fancyBox/source/jquery.fancybox.css?v=2.0.6" media="screen" />

	<!-- Add Button helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="<?=TENTACLE_JS; ?>fancyBox/source/helpers/jquery.fancybox-buttons.css?v=1.0.2" />
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>fancyBox/source/helpers/jquery.fancybox-buttons.js?v=1.0.2"></script>

	<!-- Add Thumbnail helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="<?=TENTACLE_JS; ?>fancyBox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.2" />
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>fancyBox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.2"></script>

	<!-- Add Media helper (this is optional) -->
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>fancyBox/source/helpers/jquery.fancybox-media.js?v=1.0.0"></script>

	<script type="text/javascript" charset="utf-8">
		var base_url = "<?= BASE_URL ?>";
		var js_url = '<?= TENTACLE_JS ?>';
		var editor_path = '<?= PATH ?>/';
	</script>

	<link rel="shortcut icon" href="images/favicon.ico">
	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">

<meta name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<body id="admin-window" class="<?= route::controller().' '. route::method();?>" lang="en">
	<header>
		<nav>
			<? load::view( 'admin/template-navigation' );

			?>
		</nav>
	</header>
	<div id="body-wrapper">
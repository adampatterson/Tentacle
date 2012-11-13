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

	<link type="text/css" rel="stylesheet" href="<?=ADMIN_CSS; ?>application.css">
	<link type="text/css" rel="stylesheet" href="<?=ADMIN_CSS; ?>admin.css">

	<script type="text/javascript" src="<?= ADMIN_JS; ?>jquery.min.js"></script>
	<script type="text/javascript" src="<?= ADMIN_JS; ?>jquery-ui.min.js"></script>
	<script type="text/javascript" src="<?=ADMIN_JS; ?>modernizr.min.js"></script>
	<script type="text/javascript" src="<?= ADMIN_JS; ?>jquery.inputtags.js"></script>
	<script type="text/javascript" src="<?=ADMIN_JS; ?>notifications.js"></script>
	
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
<? if ( in_array('jupload', $assets ) ): ?>

	<!-- Bootstrap CSS fixes for IE6 -->
	<!--[if lt IE 7]><link rel="stylesheet" href="http://blueimp.github.com/cdn/css/bootstrap-ie6.min.css"><![endif]-->
	<!-- Bootstrap Image Gallery styles -->
	<link rel="stylesheet" href="http://blueimp.github.com/Bootstrap-Image-Gallery/css/bootstrap-image-gallery.min.css">
	<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
	<link rel="stylesheet" href="<?= ADMIN_CSS ?>/jquery.fileupload-ui.css">

<? endif; ?>
	
<?= notification() ?>

	<script type="text/javascript" charset="utf-8">
		var base_url = "<?= BASE_URL ?>";
		var js_url = '<?= ADMIN_JS ?>';
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
			<? load::view( 'admin/templates/template-navigation' ); ?>
		</nav>
	</header>
	<div id="body-wrapper">
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
	<link type="text/css" rel="stylesheet" href="<?=TENTACLE_CSS; ?>bootstrap.css">
	<link type="text/css" rel="stylesheet" href="<?=TENTACLE_CSS; ?>general.css">
	<link type="text/css" rel="stylesheet" href="<?=TENTACLE_CSS; ?>admin.css">
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>jquery-ui-1.8.16.custom.min.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>modernizr-2.0.6.min.js"></script>
	<script type="text/javascript" src="<?= TENTACLE_JS; ?>jquery.inputtags.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>bootstrap.2.1.min.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>notifications.js"></script>
	
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
<? if ( in_array('fancybox', $assets ) ): ?>
	<!-- fancyBox MODAL -->
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>fancyBox/source/jquery.fancybox.pack.js?v=2.0.6"></script>
	<link rel="stylesheet" type="text/css" href="<?=TENTACLE_JS; ?>fancyBox/source/jquery.fancybox.css?v=2.0.6" media="screen" />
	
	<script type="text/javascript">
		// FancyBox modal
		// ====================================
		$(".fancybox").fancybox({
		  fitToView: false,
		  afterLoad: function(){
		   this.width = $(this.element).data("width");
		   this.height = $(this.element).data("height");
		  }
		 }); // fancybox
	</script>	
<? endif; ?>

<? if ( in_array('jupload', $assets ) ): ?>

	<!-- Bootstrap CSS fixes for IE6 -->
	<!--[if lt IE 7]><link rel="stylesheet" href="http://blueimp.github.com/cdn/css/bootstrap-ie6.min.css"><![endif]-->
	<!-- Bootstrap Image Gallery styles -->
	<link rel="stylesheet" href="http://blueimp.github.com/Bootstrap-Image-Gallery/css/bootstrap-image-gallery.min.css">
	<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
	<link rel="stylesheet" href="<?= TENTACLE_CSS ?>/jquery.fileupload-ui.css">

<? endif; ?>
	
<?= notification() ?>

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
			<? load::view( 'admin/templates/template-navigation' ); ?>
		</nav>
	</header>
	<div id="body-wrapper">
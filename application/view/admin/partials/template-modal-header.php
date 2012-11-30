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

	<script type="text/javascript" src="<?=ADMIN_JS; ?>jquery.min.js"></script>
	<script type="text/javascript" src="<?=ADMIN_JS; ?>jquery-ui.min.js"></script>
	<script type="text/javascript" src="<?=ADMIN_JS; ?>modernizr.min.js"></script>
	<script type="text/javascript" src="<?=ADMIN_JS; ?>bootstrap.min.js"></script>
	
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<? if ( in_array('filedrop', $assets ) ): ?>
		<script type="text/javascript" src="<?=ADMIN_JS; ?>filedrop.js"></script>
	<? endif; ?>
	
	<script type="text/javascript" charset="utf-8">
		var base_url = "<?= BASE_URL ?>";
		var js_url = '<?= ADMIN_JS ?>';
		var editor_path = '<?= PATH ?>/';
		var cms_maxfiles = 3;
		var cms_maxfilesize = 5;
	</script>
	
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<body id="modal-window" class="<?= route::controller().' '. route::method();?>" lang="en">
	<div id="modal-wrapper">
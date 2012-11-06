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
	
	<? if ( in_array('jupload', $assets ) ): ?>

		<!-- Bootstrap CSS fixes for IE6 -->
		<!--[if lt IE 7]><link rel="stylesheet" href="http://blueimp.github.com/cdn/css/bootstrap-ie6.min.css"><![endif]-->
		<!-- Bootstrap Image Gallery styles -->
		<link rel="stylesheet" href="http://blueimp.github.com/Bootstrap-Image-Gallery/css/bootstrap-image-gallery.min.css">
		<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
		<link rel="stylesheet" href="<?= ADMIN_CSS ?>/jquery.fileupload-ui.css">

	<? endif; ?>
	
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<body id="modal-window" class="<?= route::controller().' '. route::method();?>" lang="en">
	<div id="modal-wrapper">
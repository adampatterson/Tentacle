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

	<link type="text/css" rel="stylesheet" href="<?=TENTACLE_CSS; ?>bootstrap-1.4.0.min.css">
	<link type="text/css" rel="stylesheet" href="<?=TENTACLE_CSS; ?>general.css">
	<link type="text/css" rel="stylesheet" href="<?=TENTACLE_CSS; ?>admin.css">

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>jquery-ui-1.8.16.custom.min.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>modernizr-2.0.6.min.js"></script>
	
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>bootstrap-tabs.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>bootstrap-alerts.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>bootstrap-dropdown.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>bootstrap-scrollspy.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>bootstrap-modal.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>bootstrap-twipsy.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>bootstrap-popover.js"></script>
	

	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<body id="admin-window" class="<?= route::controller().' '. route::method();?>" lang="en">
	<div id="body-wrapper">
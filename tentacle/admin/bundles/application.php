<? if (CONFIGURATION == 'deployment'): ?>
	<link href="<?=MINIFY; ?>f=tentacle/admin/css/screen_import.css" rel="stylesheet" type="text/css" />
	<link href="<?=MINIFY; ?>f=tentacle/admin/css/admin.css" rel="stylesheet" type="text/css" />
	<link href="<?=MINIFY; ?>f=tentacle/admin/css/general.css" rel="stylesheet" type="text/css" />
	<link href="<?=MINIFY; ?>f=tentacle/admin/css/buttons.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/jquery-ui.min.js"></script>
	<script type="text/javascript" src="<?=MINIFY; ?>f=tentacle/admin/js/tentacle-admin.js"></script>
	<!--[if lt IE 9]>
	<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
<? else: ?>
	<link href="<?=TENTACLE_CSS; ?>bootstrap-1.2.0.css" rel="stylesheet">
	<link media="screen" type="text/css" rel="stylesheet" href="<?=TENTACLE_JS; ?>markitup/skins/simple/style.css">
	<link media="screen" type="text/css" rel="stylesheet" href="<?=TENTACLE_JS; ?>markitup/sets/textile/style.css">
	<link type="text/css" rel="stylesheet" href="<?=TENTACLE_CSS; ?>admin.css">
	<link type="text/css" rel="stylesheet" href="<?=TENTACLE_CSS; ?>general.css">

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>markitup/jquery.markitup.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>jquery.inputtags.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>markitup/sets/textile/set.js"></script>
	<script src="<?=TENTACLE_JS; ?>bootstrap/application.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$(".markItUp").markItUp(mySettings);
		});
	</script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>jquery.validate.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>tentacle-admin.js"></script>
	<!--[if lt IE 9]>
	<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<!-- Le fav and touch icons -->
	<link rel="shortcut icon" href="images/favicon.ico">
	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
<? endif;?>
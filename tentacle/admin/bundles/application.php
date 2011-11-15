	<link href="<?=TENTACLE_CSS; ?>bootstrap-1.4.0.min.css" rel="stylesheet">
	<link media="screen" type="text/css" rel="stylesheet" href="<?=TENTACLE_JS; ?>markitup/skins/simple/style.css">
	<link media="screen" type="text/css" rel="stylesheet" href="<?=TENTACLE_JS; ?>markitup/sets/textile/style.css">
	<link type="text/css" rel="stylesheet" href="<?=TENTACLE_CSS; ?>general.css">
	<link type="text/css" rel="stylesheet" href="<?=TENTACLE_CSS; ?>admin.css">
<!--
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
	<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.0.6/modernizr.min.js"></script>
-->
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>jquery.min.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>modernizr-2.0.6.min.js"></script>
	
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>ckeditor/config.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>ckeditor/adapters/jquery.js"></script>
	
	<!--<script type="text/javascript" src="<?=TENTACLE_JS; ?>markitup/jquery.markitup.js"></script>-->
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>jquery.notice.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>jquery.inputtags.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>markitup/sets/textile/set.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>bootstrap-tabs.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>bootstrap-alerts.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>bootstrap-dropdown.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>bootstrap-scrollspy.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>bootstrap-modal.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>bootstrap-twipsy.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>bootstrap-popover.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>spin.min.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>sisyphus.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$(".markItUp").markItUp(mySettings);
		});
	</script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>jquery.validate.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>application.js"></script>
	<!-- <script type="text/javascript" charset="utf-8">
		$(document).ready(function(){
			$('#username').keyup(username_check);
		});
	</script> -->
	<!--[if lt IE 9]>
	<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<!-- Le fav and touch icons -->
	<link rel="shortcut icon" href="images/favicon.ico">
	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
<!--	
	<? //if (CONFIGURATION == 'deployment'): ?>
		<link href="<?=MINIFY; ?>f=tentacle/admin/css/24gs/screen_import.css" rel="stylesheet" type="text/css" />
	<? //else: ?>
		<link href="<?=BASE_URL; ?>tentacle/admin/css/24gs/screen_import.css" rel="stylesheet" type="text/css" />
	<? //endif;?>
	-->
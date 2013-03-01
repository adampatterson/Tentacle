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
    <? if(user_editor() == 'wysihtml5'): ?>
        <script src="<?=ADMIN_JS; ?>wysihtml5.js"></script>
        <link rel="stylesheet" type="text/css" href="<?=ADMIN_JS; ?>/bootstrap-wysihtml5/dist/bootstrap-wysihtml5.css"></link>
    <? endif; ?>

	<link type="text/css" rel="stylesheet" href="<?=ADMIN_CSS; ?>application.css">
	<link type="text/css" rel="stylesheet" href="<?=ADMIN_CSS; ?>admin.css">
	<link type="text/css" rel="stylesheet" href="<?=ADMIN_CSS; ?>reveal.css">

    <script type="text/javascript" src="<?=ADMIN_JS; ?>modernizr.min.js"></script>
	<script type="text/javascript" src="<?=ADMIN_JS; ?>jquery.min.js"></script>
	<script type="text/javascript" src="<?=ADMIN_JS; ?>jquery-ui.min.js"></script>

    <? if(user_editor() == 'wysiwyg'): ?>
        <script type="text/javascript" src="<?= ADMIN_JS; ?>raptor.min.js"></script>
    <? endif; ?>

    <script type="text/javascript" src="<?=ADMIN_JS; ?>jquery.reveal.js"></script>
	<script type="text/javascript" src="<?=ADMIN_JS; ?>jquery.inputtags.js"></script>
	<script type="text/javascript" src="<?=ADMIN_JS; ?>notifications.js"></script>

    <? if(user_editor() == 'wysiwyg'): ?>
        <script type="text/javascript" src="<?=ADMIN_JS; ?>bootstrap-dropdown.js"></script>
        <script type="text/javascript" src="<?=ADMIN_JS; ?>bootstrap-transition.js"></script>
        <script type="text/javascript" src="<?=ADMIN_JS; ?>bootstrap-collapse.js"></script>
        <script type="text/javascript" src="<?=ADMIN_JS; ?>bootstrap-tab.js"></script>
    <? endif; ?>

    <? if(user_editor() == 'wysihtml5'): ?>
        <script src="<?=ADMIN_JS; ?>bootstrap.min.js"></script>
        <script src="<?=ADMIN_JS; ?>/bootstrap-wysihtml5/dist/bootstrap-wysihtml5.js"></script>
    <? endif; ?>

    <? if ( in_array('flot', $assets)): ?>
        <script src="<?=ADMIN_JS;?>flot/jquery.flot.js"></script>
        <script src="<?=ADMIN_JS;?>flot/jquery.flot.pie.js"></script>
        <script src="<?=ADMIN_JS;?>flot/jquery.flot.stack.js"></script>
        <script src="<?=ADMIN_JS;?>flot/jquery.flot.resize.js"></script>
        <script src="<?=ADMIN_JS;?>jquery.sparklines.js"></script>
        <script type="text/javascript">
            <?
            $statistics = load::model('statistics');

            $count = $statistics->count_by_chunks(42);
            $unique = $statistics->count_by_unique_chunks(42);

            print_r($unique);

            ?>


            var page_views = [ <?
             foreach ( $count['chunks'] as $key => $value )
             {
                echo '['. $key .', '. $value .'],';
             }

             ?> ];

            var page_view_total = <?= $count['total'] ?>;

            var unique_views = [ <?
             foreach ( $unique['chunks'] as $key => $value )
             {
                echo '['. $key .', '. $value .'],';
             }

             ?> ];

            var unique_view_total = <?= $unique['total'] ?>;
         </script>

     <? endif; ?>

    <? if ( in_array('sortable', $assets ) ): ?>
        <script type="text/javascript" src="<?=ADMIN_JS; ?>jquery.nestable.js"></script>
        <link type="text/css" rel="stylesheet" href="<?=ADMIN_CSS; ?>sortable.css">
    <? endif; ?>

	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
    <? if ( in_array('filedrop', $assets ) ): ?>
        <script type="text/javascript" src="<?=ADMIN_JS; ?>filedrop.js"></script>
    <? endif; ?>
	
<?= notification() ?>

	<script type="text/javascript" charset="utf-8">
		var base_url = "<?= BASE_URL ?>";
		var js_url = '<?= ADMIN_JS ?>';
		var editor_path = '<?= THEME ?>/';
		var cms_maxfiles = 3;
		var cms_maxfilesize = 5;
	</script>

	<meta name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<body id="admin-window" class="<?= route::controller().' '. route::method();?>" lang="en">
	<header>
		<nav>
			<? load::view( 'admin/partials/template-navigation' ); ?>
		</nav>
	</header>
	<div id="body-wrapper">
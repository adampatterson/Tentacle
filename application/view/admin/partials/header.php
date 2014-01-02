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

    <script type="text/javascript" src="<?=ADMIN_JS; ?>modernizr.min.js"></script>
    <script type="text/javascript" src="<?=ADMIN_JS; ?>jquery.min.js"></script>
    <script type="text/javascript" src="<?=ADMIN_JS; ?>jquery.sortable.min.js"></script>
    <script type="text/javascript" src="<?=ADMIN_JS; ?>bootstrap.min.js"></script>
    <script type="text/javascript" src="<?=ADMIN_JS; ?>bootstrap-notify.js"></script>
    <script type="text/javascript" src="<?=ADMIN_JS; ?>jquery.reveal.js"></script>
    <script type="text/javascript" src="<?=ADMIN_JS; ?>jquery.inputtags.js"></script>

    <? if ( in_array('wysiwyg', $assets)): ?>
    <script type="text/javascript" src="<?=ADMIN_JS; ?>ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="<?=ADMIN_JS; ?>ckeditor/config.js"></script>
    <link rel="stylesheet" href="<?=ADMIN_JS ?>ckeditor/contents.css"/>
    <script type="text/javascript" src="<?=ADMIN_JS; ?>ckeditor/styles.js"></script>
    <link rel="stylesheet" href="<?=ADMIN_CSS; ?>codemirror.css">
    <? endif; ?>

    <link type="text/css" rel="stylesheet" href="<?=ADMIN_CSS; ?>admin.css">

    <? if ( in_array('flot', $assets)): ?>

    <script src="<?=ADMIN_JS;?>jquery.sparklines.js"></script>
    <script type="text/javascript">
        <?
        $statistics = load::model('statistics');

        $cache = new cache();

        if ( $cache->look_up('page_views_totals') == false && $cache->look_up('page_views') == false && $cache->look_up('unique_views_total') == false  && $cache->look_up('unique_views') == false ):

            $count = $statistics->count_by_chunks(42);
            $unique = $statistics->count_by_unique_chunks(42);

            $page_views_total = $count['total'];
            $page_views = '';
            foreach ( $count['chunks'] as $key => $value )
            {
                $page_views .= '['. $key .', '. $value .'],';
            }

            $unique_views_total = $unique['total'];
            $unique_views = '';
            foreach ( $unique['chunks'] as $key => $value )
            {
                $unique_views .= '['. $key .', '. $value .'],';
            }

            $cache_page_views_total         = $cache->set( 'page_views_totals', $page_views_total, '+2 hours' );
            $cache_page_views               = $cache->set( 'page_views', $page_views, '+2 hours' );
            $cache_unique_views_total       = $cache->set( 'unique_views_total', $unique_views_total, '+2 hours' );
            $cache_unique_views             = $cache->set( 'unique_views', $unique_views, '+2 hours' );
        else:
            $cache_page_views_total         = $cache->get( 'page_views_totals' );
            $cache_page_views               = $cache->get( 'page_views' );
            $cache_unique_views_total       = $cache->get( 'unique_views_total' );
            $cache_unique_views             = $cache->get( 'unique_views' );
        endif;
?>

        var page_views = [ <?= $cache_page_views ?> ];

        var page_view_total = <?= $cache_page_views_total ?>;

        var unique_views = [ <?= $cache_unique_views ?> ];

        var unique_view_total = <?= $cache_unique_views_total ?>;
     </script>

    <? endif; ?>
    <? if ( in_array('sortable', $assets ) ): ?>
        <script type="text/javascript" src="<?=ADMIN_JS; ?>jquery.nestable.js"></script>
    <? endif; ?>
<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
    <? if ( in_array('filedrop', $assets ) ): ?>
    <script type="text/javascript" src="<?=ADMIN_JS; ?>filedrop.js"></script>
    <? endif; ?>

	<script type="text/javascript" charset="utf-8">
		var base_url = "<?= BASE_URL ?>";
		var image_url = "<?= IMAGE_URL ?>";
		var js_url = '<?= ADMIN_JS ?>';
		var editor_path = '<?= THEME ?>/';
		var cms_maxfiles = 3;
		var cms_maxfilesize = 5;
	</script>

	<meta name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<body id="admin-window" class="<?= route::controller().' '. route::method();?>" lang="en">

    <div class='notifications top-right'></div>

	<header>
		<nav>
			<? load::view( 'admin/partials/navigation' ); ?>
		</nav>
	</header>
	<div id="body-wrapper">
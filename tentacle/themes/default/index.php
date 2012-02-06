<?
 /*
Name: Index Page
URI: http://tcms.me/
Description: This is the Tentacle default theme.
Author: Tentacle
Version: 1.0
License: GNU General Public License
License URI: license.txt
*/
if( !defined( 'SCAFFOLD' ) ):
?>
<? //load_part('header',array('title'=>'Welcome to Tentacle','assets'=>'marketing')); ?>
<!DOCTYPE html>
<html lang="en"> 
<head>
<meta charset="utf-8"> 
<title><?= $data->title; ?></title>
<meta name="description" content="">
<meta name="author" content="">
    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le styles -->
    <link href="<?= PATH ?>/css/bootstrap.css" rel="stylesheet">
  </head>

  <body>
	
	  <div class="container-fluid">
      <div class="row-fluid">
        <div class="span3">
          <div class="well sidebar-nav">
            <? nav_menu(); ?>
			<li><a href="<?= BASE_URL?>blog/">Blog</a></li>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span9">
          <div class="hero-unit">
            <h1><?= $data->title; ?></h1>
			<?= $data->content; ?>
          </div>
        </div><!--/span-->
      </div><!--/row-->
	<footer>
	    <p><a href="http://tentaclecms.com"><img src="<?= PATH ?>/images/tentacle_logo_footer.png" alt="Tentacle" /></a></p>
	  </footer>

	</div> <!-- /container -->

	<!-- Le javascript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->

	<!--
		<? clean_out($data); ?>
	 -->
	<? if(user::valid()) load::helper ('adminbar'); ?>	
	</body>
</html>

<? //load_part('footer'); ?> 
<? endif; ?>
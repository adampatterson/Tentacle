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
</head>
<body>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Bootstrap, from Twitter</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le styles -->
    <link href="<?= PATH ?>/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>

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
<?
foreach ($data as $post):
	$user_meta = $user->get_meta ( $post->author );
?>
<div>
	
	<h2 class="title"><a href="<?= ADMIN ?>content_update_post/<?= $post -> id;?>"><?= $post -> title;?></a></h2>
	<small>Posted in: 
		<?
		foreach( $relations = $category->get_relations( $post->id ) as $relation ): ?>
            	 <a href="#<?=$relation->slug ?>"><?= $relation->name ?></a>
        <? endforeach; ?>
	</small>
	<?= $post->content;?>
	<small>Created by: <?= $user_meta -> first_name;?> <?= $user_meta -> last_name;?></small>

<p><a href="<?= ADMIN ?>content_update_post/<?= $post->id;?>" class="btn small">Edit</a> <a href="<?= BASE_URL ?>action/trash_post/<?= $post -> id;?>" class="btn small danger">Trash</a></p>
</div>
<? endforeach;?>
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
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script src="<?=ADMIN_URL; ?>/js/bootstrap.js"></script>
<script src="<?= PATH ?>/js/application.js"></script>
<!--
<? clean_out($data); ?>
-->
</body>
</html>
<? //load_part('footer'); ?> 
<? endif; ?>
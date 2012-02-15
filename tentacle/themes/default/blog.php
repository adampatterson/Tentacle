<?
 /*
Name: Blog Page
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
<title>Blog</title>
<meta name="description" content="">
<meta name="author" content="">
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

	<script type="text/javascript" src="<?=TENTACLE_JS; ?>jquery.min.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>bootstrap-dropdown.js"></script>
	<link type="text/css" rel="stylesheet" href="<?=TENTACLE_CSS; ?>bootstrap-1.4.0.min.css">
	<link type="text/css" rel="stylesheet" href="<?=TENTACLE_CSS; ?>general.css">
	<link type="text/css" rel="stylesheet" href="<?=TENTACLE_CSS; ?>admin.css">
    <link href="<?= PATH ?>/css/bootstrap.css" rel="stylesheet">
	<style type="text/css" media="screen">
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
			<?foreach ($data as $post): $user_meta = $user->get_meta ( $post->author ); ?>
			<div class="hero-unit">

				<h2 class="title"><a href="<?= BASE_URL.$post->uri ?>"><?= $post->title?></a></h2>
				<small>Posted in: 
					<? foreach( $relations = $category->get_relations( $post->id ) as $relation ): ?>
			            	 <a href="#<?=$relation->slug ?>"><?= $relation->name ?></a>
			        <? endforeach; ?>
				</small>
				<?= stripcslashes( $post->content );?>
				<small>Created by: <?= $user_meta -> first_name;?> <?= $user_meta -> last_name;?></small>
				<? if(user::valid()): ?>
					<p><a href="<?= ADMIN ?>content_update_post/<?= $post->id;?>" class="btn small">Edit</a> <a href="<?= BASE_URL ?>action/trash_post/<?= $post -> id;?>" class="btn small danger">Trash</a></p>
				<? endif; ?>
			</div>
			<? endforeach;?>

        </div><!--/span-->
      </div><!--/row-->
	<footer>
	    <p><a href="http://tentaclecms.com"><img src="<?= PATH ?>/images/tentacle_logo_footer.png" alt="Tentacle" /></a></p>
	  </footer>

	</div> <!-- /container -->
	</body>
</html>

<? //load_part('footer'); ?> 
<? endif; ?>
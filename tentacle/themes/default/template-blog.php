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

if( !defined( 'SCAFFOLD' ) ):?>
<? load_part('header',array('title'=>'Blog','assets'=>'default')); ?>
<div class="row-fluid">
	<div class="span3">
		<div class="well sidebar-nav">
			<? load_part( 'sidebar' ); ?>
		</div><!--/.well -->
	</div><!--/span3-->
	<div class="span9">
		<?
	// Loop all of the blog posts.
foreach ($data as $post): $user_meta = $user->get_meta ( $post->author ); ?>
	<div class="hero-unit">
		<h2 class="title"><a href="<?= BASE_URL.$post->uri ?>"><?= $post->title?></a></h2>
		<?= render_content( $post->content ); ?>
		<small>Created by: <?= $user_meta -> first_name;?> <?= $user_meta -> last_name;?></small>
		<? 
		// If you are an admin user who is logged in 
		// then you can trash or edit posts.
		if(user::valid()): ?>
			<!--<p><a href="<?= ADMIN ?>content_update_post/<?= $post->id;?>" class="btn small">Edit</a> <a href="<?= BASE_URL ?>action/trash_post/<?= $post -> id;?>" class="btn small danger">Trash</a></p>-->
		<? endif; ?>
		<p><small>Posted in: 
			<? foreach( $category->get_relations( $post->id ) as $relation ): ?>
				 <a href="#<?=$relation->slug ?>"><?= $relation->name ?></a>
			<? endforeach; ?>
		</small></p>
		<p><small>Tags: 
			<? foreach( $relations = $tag->get_relations( $post->id ) as $relation ): ?>
				 <a href="#<?=$relation->slug ?>"><?= $relation->name ?></a>
			<? endforeach; ?>
		</small></p>
	</div><!-- /hero-unit -->
<? endforeach;?>
	</div><!--/span9-->
</div><!--/row-->
<? load_part('footer'); ?> 
<? endif; ?>
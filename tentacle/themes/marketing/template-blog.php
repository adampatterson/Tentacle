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
<? load_part('header',array('title'=>'Blog','assets'=>'marketing')); ?>
<div class="container bump-top">
		<?
	// Loop all of the blog posts.
	foreach ($data as $post): $user_meta = $user->get_meta ( $post->author ); ?>
		<div class="row bump">
			<div class="span12">

			<h2 class="title"><a href="<?= BASE_URL.$post->uri ?>"><?= $post->title?></a></h2>
			<?= render_content( $post->content ); ?>
			<small>Created by: <?= $user_meta -> first_name;?> <?= $user_meta -> last_name;?></small>

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
			</div><!--/span9-->
		</div><!--/row-->
	<? endforeach;?>

</div><!-- /container -->
<? load_part('footer'); ?> 
<? endif; ?>
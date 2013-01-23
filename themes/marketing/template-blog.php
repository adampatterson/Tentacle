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

theme::part('partials/header',array('title'=>'Blog','assets'=>'marketing')); ?>

    <div class="container bump-top">
		<?
	// Loop all of the blog posts.
	foreach ($posts as $post): $author_meta = $author->get_meta ( $post->author ); ?>
		<div class="row bump">
			<div class="span12">

			<h2 class="title"><a href="<? _e(BASE_URL.$post->uri) ?>"><? _e($post->title) ?></a></h2>
			
			<hr />
			
			<?= the_content( $post->content ); ?>
			<small>Created by: <? _e($author_meta->first_name.' '.$author_meta->last_name) ?></small>

			<p><small>Posted in: 
				<? foreach( $category->get_relations( $post->id ) as $relation ): ?>
					 <a href="#<?=$relation->slug ?>"><?_e($relation->name) ?></a>
				<? endforeach; ?>
			</small></p>
			<p><small>Tags: 
				<? foreach( $relations = $tag->get_relations( $post->id ) as $relation ): ?>
					 <a href="#<?=$relation->slug ?>"><?_e($relation->name) ?></a>
				<? endforeach; ?>
			</small></p>
			</div><!--/span9-->
		</div><!--/row-->
	<? endforeach;?>

</div><!-- /container -->
<? theme::part( 'partials/footer' ); ?>
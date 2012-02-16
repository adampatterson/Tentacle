<?
 /*
Name: Blog Page
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
			</div><!-- /hero-unit -->
		<? endforeach;?>
	</div><!--/span9-->
</div><!--/row-->
<? load_part('footer'); ?> 
<? endif; ?>
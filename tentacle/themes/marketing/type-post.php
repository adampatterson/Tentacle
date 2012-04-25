<?
/*
Type: Post
*/
if( !defined( 'SCAFFOLD' ) ):?>
<? load_part('header',array('title'=>$post->title,'assets'=>'marketing')); ?>
<div class="container">
	<div class="row">
		<div class="span12">
			<div class="hero-unit">
				<h1><?= $post->title; ?></h1>
				<hr />
				<?= render_content( $post->content ); ?>
			</div><!-- /hero-unit -->
		</div><!--/span9-->
	</div><!--/row-->
</div><!-- /container -->
<? load_part('footer'); ?> 
<? endif; ?>
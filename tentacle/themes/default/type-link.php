<?
/*
Type: Link
*/
if( !defined( 'SCAFFOLD' ) ):?>
<? load_part('header',array('title'=>$post->title,'assets'=>'default')); ?>
<div class="row-fluid">
	<div class="span3">
		<div class="well sidebar-nav">
			<? load_part( 'sidebar' ); ?>
		</div><!--/.well -->
	</div><!--/span3-->
	<div class="span9">
		<div class="hero-unit">
			<h1><?= $post->title; ?></h1>
			<?= render_content( $post->content ); ?>
		</div><!-- /hero-unit -->
	</div><!--/span9-->
</div><!--/row-->
<? load_part('footer'); ?> 
<? endif; ?>
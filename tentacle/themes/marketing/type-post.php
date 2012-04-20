<?
/*
Type: Post
*/
if( !defined( 'SCAFFOLD' ) ):?>
<? load_part('header',array('title'=>$data->title,'assets'=>'marketing')); ?>
<div class="container">
	<div class="row">
		<div class="span12">
			<div class="hero-unit">
				<h1><?= $data->title; ?></h1>
				<?= render_content( $data->content ); ?>
			</div><!-- /hero-unit -->
		</div><!--/span9-->
	</div><!--/row-->
</div><!-- /container -->
<? load_part('footer'); ?> 
<? endif; ?>
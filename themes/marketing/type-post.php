<?
/*
Type: Post
*/

theme::part('partials/header',array('title'=>$post->title,'assets'=>'marketing')); ?>

<div class="container">

	<div class="row">

		<div class="span12">

            <h1><?= $post->title; ?></h1>
            <hr />
            <?= the_content( $post->content ); ?>

		</div><!--/span9-->

	</div><!--/row-->

</div><!-- /container -->

<? theme::part( 'partials/footer' ); ?>
<?
/*
Type: Gallery
*/

theme::part('partials/header',array('title'=>$post->title,'assets'=>'default')); ?>

<div class="row">

    <? theme::part( 'partials/sidebar' ); ?>

    <div class="span9">

        <h1><?= $post->title; ?></h1>

        <?= the_content( $post->content ); ?>

        <?= render_content(); ?>

    </div><!-- /span9-->

</div><!-- /row-->

<? theme::part('partials/footer'); ?>
<?
/*
Type: Gallery
*/

theme::part('partials/header',array('title'=>$post->title,'assets'=>'default')); ?>

<div class="row">

    <div class="span9">

        <h1><?= $post->title; ?></h1>

        <?= the_content( $post->content ); ?>

        <?= render_content(); ?>

    </div><!-- /span9-->

    <? theme::part( 'partials/sidebar' ); ?>

</div><!-- /row-->

<? theme::part('partials/footer'); ?>
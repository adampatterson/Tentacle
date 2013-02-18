<?
 /*
Type: Music
*/

theme::part('partials/header',array('title'=>$post->title,'assets'=>'default')); ?>

    <div class="row">

        <div class="span3">

            <div class="well sidebar-nav">
                <? theme::part( 'partials/sidebar' ); ?>
            </div><!-- /well -->

        </div><!-- /span3-->

        <div class="span9">

            <h1><?= $post->title; ?></h1>

            <?= the_content( $post->content ); ?>

            <?= render_content(); ?>

        </div><!-- /span9-->

    </div><!-- /row-->

<? theme::part('partials/footer'); ?>
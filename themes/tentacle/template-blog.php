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

theme::part('partials/header',array('title'=>'Blog','assets'=>'default')); ?>

<div class="row-fluid">

    <div class="span3">

        <div class="well sidebar-nav">
            <? theme::part( 'partials/sidebar' ); ?>
        </div><!--/.well -->

    </div><!--/span3-->

    <div class="span9">

    <? foreach ($posts as $post):
        $author_meta = $author->get_meta( $post->author ); ?>

        <div class="hero-unit">
            <h1 class="title"><a href="<?= BASE_URL.$post->uri ?>"><?= $post->title?></a></h1>
            <?= the_content( $post->content ); ?>

            <p>
                <small>Created by: <?= $author_meta->first_name;?> <?= $author_meta ->last_name;?></small>
            <br />
                <small>Posted in:
                <? foreach( $category->get_relations( $post->id ) as $relation ): ?>
                     <a href="<?=BASE_URL?>category/<?=$relation->slug ?>"><?= $relation->name ?></a>
                <? endforeach; ?>
                </small>
            <br />
                <small>Posted on: <? date::show($post->date) ?></small>
            <br />
                <small>Tags:
                <? foreach( $relations = $tag->get_relations( $post->id ) as $relation ): ?>
                     <a href="<?=BASE_URL?>tag/<?=$relation->slug ?>"><?= $relation->name ?></a>
                <? endforeach; ?>
                </small>
            <br />
                <small>Post template: <?= $post->template; ?></small>
            </p>

            <?= render_content(); ?>

        </div><!-- /hero-unit -->

    <? endforeach; ?>

    <? paginate::pages(true); ?>

    </div><!--/span9-->

</div><!--/row-->

<? theme::part('partials/footer'); ?>
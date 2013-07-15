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

<div class="row">

    <div class="span9">

        <? foreach ($posts as $post):
            $author_meta = $author->get_meta( $post->author ); ?>
            <div class="post <?= $post->template; ?>">

                <div class="page-header">
                    <h2 class=""><a href="<?= BASE_URL.$post->uri ?>"><?= $post->title?></a></h2>
                </div>

                <p class="meta"><em>
                    Posted <time datetime="<? date::show($post->date) ?>" pubdate=""><? date::show($post->date) ?></time>
                    by <?= $author_meta->first_name;?> <?= $author_meta ->last_name;?> <span class="amp"></span>
                    in <? foreach( $category->get_relations( $post->id ) as $relation ): ?>
                        <a href="<?=BASE_URL?>category/<?=$relation->slug ?>"><?= $relation->name ?></a>
                    <? endforeach; ?>.</em></p>

                <?= the_content( $post->content ); ?>

                <p>
                    <small>Tags:
                    <? foreach( $relations = $tag->get_relations( $post->id ) as $relation ): ?>
                         <a href="<?=BASE_URL?>tag/<?=$relation->slug ?>" class="label"><?= $relation->name ?></a>
                    <? endforeach; ?>
                    </small>
                </p>

                <?= render_content(); ?>
            </div>
        <? endforeach; ?>

        <div class="pagination span9">
            <ul>
                <?

                paginate::first();
                paginate::previous();
                paginate::pages();
                paginate::next();
                paginate::last();

                ?>
            </ul>
        </div>

    </div><!--/span9-->

    <? theme::part( 'partials/sidebar' ); ?>

</div><!--/row-->

<? theme::part('partials/footer'); ?>
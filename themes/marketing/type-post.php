<?
/*
Type: Post
*/

theme::part('partials/header',array('title'=>$post->title,'assets'=>'marketing'));

$author_meta = $author->get_meta ( $post->author );

?>

<div class="container single-post bump-top">

	<div class="row">

        <div class="span12">
            <h1 class="title"><?= $post->title; ?></h1>
            <hr/>
        </div>

		<div class="span8 post">
            <?= the_content( $post->content ); ?>
            <?= render_content(); ?>
		</div><!--/span8-->

        <div class="span3 offset1">
            <small>Created by: <? _e($author_meta->first_name.' '.$author_meta->last_name) ?></small>

            <p><small>Posted in:
                    <? foreach( $category->get_relations( $post->id ) as $relation ): ?>
                        <a href="<?=BASE_URL?>category/<?=$relation->slug ?>"><?_e($relation->name) ?></a>
                    <? endforeach; ?>
                </small>
            </p>
        </div>

	</div><!--/row-->

</div><!-- /container -->

<? theme::part( 'partials/footer' ); ?>
<?
/*
Name: Profile
URI: http://tcms.me/
Description: This is the Tentacle default theme.
Author: Tentacle
Version: 1.0
License: GNU General Public License
License URI: license.txt
*/
/**
display: admin
name: text:Name:Full Name
options: options(Canada,United States, Mexico):Select a country
twitter: text:Twitter:Twitter username, without the @ symbol.
*/

theme::part('partials/header',array('title'=>$post->title, 'assets'=>'default'));?>

<div class="row">

    <div class="span9">

        <div class="page profile">
            <h1><?= $post->title; ?></h1>

            <h2><?= $post_meta->name ?></h2>
            <h3>From <?= $post_meta->country ?></h3>
            <?= the_content( $post->content ); ?>
            <p>Follow me <a href="http://www.twitter.com/<?= $post_meta->twitter ?>">@<?= $post_meta->twitter ?></a></p>
        </div><!-- /hero-unit -->

    </div><!-- /span9-->

    <? theme::part( 'partials/sidebar' ); ?>

</div><!-- /row-->

<? theme::part('partials/footer'); ?>
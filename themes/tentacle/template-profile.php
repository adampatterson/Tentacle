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
name:
  name: Name
  input: input
  type: text
  notes: Full Name
country:
  name: Country
  input: option
  notes: Option notes.
  options:
    - Canada
    - USA
    - UK
    - Japan
twitter:
  name: Twitter
  input: input
  type: text
  notes: Twitter username, without the @ symbol.
*/

theme::part('partials/header',array('title'=>$post->title, 'assets'=>'default'));?>

<div class="row-fluid">

    <div class="span3">
        <div class="well sidebar-nav">
            <? theme::part( 'partials/sidebar' ); ?>
        </div><!--/.well -->
    </div><!--/span3-->

    <div class="span9">

        <div class="hero-unit">
            <h1><?= $post->title; ?></h1>

            <h2><?= $post_meta->name ?></h2>
            <h3>From <?= $post_meta->country ?></h3>
            <?= the_content( $post->content ); ?>
            <p>Follow me <a href="http://www.twitter.com/<?= $post_meta->twitter ?>">@<?= $post_meta->twitter ?></a></p>
        </div><!-- /hero-unit -->

    </div><!-- /span9-->

</div><!-- /row-->

<? theme::part('partials/footer'); ?>
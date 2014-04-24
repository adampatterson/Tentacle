<?/*
Name: Work - Open
URI: http://adampatterson.ca
Description: This is the Tentacle default theme.
Author: Tentacle
Version: 1.0
License: GNU General Public License
License URI: license.txt
*/
/**
display: admin
description: textarea:Description
via: text:Via
via_title: text:Via Title
view: text:view
github_url: text:Github URL
download: text:Download
support: text:Support
 */

theme::part('partials/header', array('title'=>'') ) ?>

    <section class="content">
        <article>
            <div class="page-header">
                <h2><?= $post->title; ?></h2>
            </div>

            <div class="row">
                <div class="md-6 details">
                    <?= $post_meta->description ?>

                    <a href="<?= $post_meta->github_url ?>" class="btn btn-large btn-block btn-promo">View on Github</a>
                    <a href="<?= $post_meta->download ?>" class="btn btn-large btn-block btn-promo">Download</a>
                    <a href="<?= $post_meta->support ?>" class="btn btn-large btn-block btn-promo">Get Support</a>
                </div>
                <div class="md-6 content">

                    <?= the_content( $post->content ); ?>
                    <?= render_content(); ?>

                    <a href="/request-an-estimate" class="btn btn-large btn-block  btn-promo">Like what you see?</a>
                </div>
            </div>
        </article>

    </section><!-- .content -->

<? theme::part('partials/footer') ?>

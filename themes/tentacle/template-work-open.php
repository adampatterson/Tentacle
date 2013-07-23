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
description:
  name: Description
  type: multiline
github:
  name: Github URL
  type: text
download:
  name: Download
  type: text
support:
  name: Support
  type: text
 */

theme::part('partials/header', array('title'=>'') ) ?>

    <section class="content">
        <article>
            <div class="page-header">
                <h2>Tentacle CMS - Marketing site</h2>
            </div>

            <div class="row">
                <div class="span5">
                    <p class="lead">Tentacle is an OpenSource Content Management System.</p>
                    <p class="lead">It’s goal is to help web professionals and small businesses create fast and flexible websites with the user in mind. For more info, be sure to checkout out the official website
                        <a href="http://tentaclecms.com">tentaclecms.com</a>.</p>

                    <a href="#view" class="btn btn-large btn-block btn-promo">View on Github</a>
                    <a href="#download" class="btn btn-large btn-block btn-promo">Download</a>
                    <a href="#support" class="btn btn-large btn-block btn-promo">Get Support</a>
                </div>
                <div class="span7">
                    <p>
                        <img src="/content/tentacle-01.jpg" alt="" />
                    </p>

                    <p>
                        <img src="/content/tentacle-update-this.png" alt="" />
                    </p>

                    <a href="#estimate" class="btn btn-large btn-block  btn-promo">Like what you see?</a>
                </div>
            </div>
        </article>

    </section><!-- .content -->

<? theme::part('partials/footer') ?>
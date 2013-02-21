<?php
/**
name: Core
url: http://tentaclecms.com
version: 1.0
description: Tentacles core Plugin
author:
  name: Adam Patterson
  url: http://adampatterson.ca
 */


event::on('theme_header', 'analytics::tracking');
event::on('theme_header', 'analytics::author');
event::on('theme_header', 'analytics::webmaster');
event::on('plugin_navigation', 'analytics::settings_nav', 6);


/*
class: analytics
*/
class analytics{

    static function author(){
        if (get::option('seo_author_profile') != '' )
            echo '<link rel="author" href="'.get::option('seo_author_profile', '').'" />';
    }

    static function webmaster(){
        if (get::option('seo_google_webmaster') != '' )
            echo " <meta name='google-site-verification' content='".get::option('seo_google_webmaster', '')."'>";
    }


    static function tracking(){
        if (get::option('seo_google_analytics') != '' ) {
        echo "
<script type='text/javascript'>

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '".get::option('seo_google_analytics', '')."']);
  _gaq.push(['_setDomainName', '".$_SERVER['SERVER_NAME'] ."']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>";
        }
    }

}


/*
Shortcode
*/
event::on('shortcode', 'shortcode', 1);
logger::set('Shortcode', 'oEmbed');

function shortcode( $content )
{
    add_shortcode( 'embed', 'oembed_content' );
    add_shortcode( 'snippet', 'snippet' );

    if (function_exists('do_shortcode'))
        return do_shortcode( $content );
}


function snippet( $slug )
{
    $snippet = load::model( 'snippet' );
    $snippet_single = $snippet->get_slug( $slug[0] );

    return $snippet_single->content;
}


function oembed_content( $url )
{
    load::library('oembed');

    return oembed_cotnent( $url[0] );
}

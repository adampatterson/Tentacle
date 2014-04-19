<?php
/**
name: Source Code
url: http://adampatterson.ca/
version: 1.0
description: Social media sharing
author:
   name: Adam Patterson
   url: http://adampatterson.ca/
 */

event::on('shortcode', 'source::shortcode', 3);

class source {

    static function shortcode($tag='') {
        add_shortcode( 'sourcecode', 'sourcecode' );

        if (function_exists('do_shortcode'))
            return do_shortcode( $tag );
    }
}

function sourcecode ($tag, $content = null) {
    return '<pre data-pbcklang="'.$tag['language'].'" data-pbcktabsize="4" class="language-'.$tag['language'].'"><code class="language-'.$tag['language'].'">'.$content.'</code></pre>';
}
<?php
event::on('shortcode', 'source::shortcode', 3);

class source {

    static function shortcode($tag='') {
        add_shortcode( 'sourcecode', 'sourcecode' );

        if (function_exists('do_shortcode'))
            return do_shortcode( $tag );
    }
}

function sourcecode ($tag, $content = null) {
    return '<pre><code class="language-'.$tag['language'].'">'.$content.'</code></pre>';
}
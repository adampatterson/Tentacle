<?php
/**
name: Disqus Comments
url: http://adampatterson.ca/
version: 1.0
description: Social media sharing
author:
   name: Adam Patterson
   url: http://adampatterson.ca/
 */

event::on('plugin_navigation', 'disqus::settings_nav', 8);

class disqus {

    static function settings_nav() {
        $nav[] = array(
            'title'     => 'Disqus Sharing',
            'rout'      => 'disqus_settings',
            'uri'       => 'disqus/view'
        );

        return $nav;
    }

    static function comments ( $post ) { ?>
        <a href="<?= BASE_URL.$post->uri ?>#disqus_thread" data-disqus-identifier="<?= $post->id ?>" class="comment-link"></a>
        <script type="text/javascript">
            /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
            var disqus_shortname = '<?= get::option('disqus_account') ?>'; // required: replace example with your forum shortname

            /* * * DON'T EDIT BELOW THIS LINE * * */
            (function () {
                var s = document.createElement('script'); s.async = true;
                s.type = 'text/javascript';
                s.src = 'http://' + disqus_shortname + '.disqus.com/count.js';
                (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
            }());
        </script>
    <? }

    static function comments_form ( $id ) { ?>

        <div id="disqus_thread"></div>
        <script type="text/javascript">

        var disqus_shortname = '<?=get::option('disqus_account')?>';

        <? if (!empty($id)): ?>
            var disqus_identifier = '<?= $id ?>';
        <? endif ?>

        var disqus_url = '<?= BASE_URL.URI ?>';

        (function() {
var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
})();
</script>
    <? }
}
	<footer>
	    <p class="pull-left"><a href="http://tentaclecms.com"><img src="<?= THEME ?>/assets/img/tentacle_logo_footer.png" alt="Tentacle" /></a></p>

        <p class="pull-right">
            <ul class="unstyled pull-right">
                <li><a href="https://twitter.com/tentaclecms" class="twitter-follow-button" data-show-count="false">Follow @tentaclecms</a></li>
                <li><iframe src="http://ghbtns.com/github-btn.html?user=adampatterson&repo=tentacle&type=watch&count=true"
                             allowtransparency="true" frameborder="0" scrolling="0" width="100px" height="20px"></iframe></li>
                <li><iframe src="http://ghbtns.com/github-btn.html?user=adampatterson&repo=tentacle&type=fork&count=true"
                             allowtransparency="true" frameborder="0" scrolling="0" width="100px" height="20px"></iframe></li>
            </ul>


        </p>

	 </footer>
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
	</div> <!-- /container -->
	<? 
	// Load assets in the footer.
	theme::assets( $assets='' );
    render_footer( ); ?>
	</body>
</html>
</div><!-- #body-wrapper -->

<footer>

  <nav class="navbar navbar-default navbar-fixed-bottom " role="navigation">
    <!-- Brand anvd toggle get grouped for better mobile display -->
    <ul class="nav navbar-nav">
        <li><a href="https://github.com/adampatterson/Tentacle/wiki" target="_blank">Documentation</a></li>
        <li><a href="https://github.com/adampatterson/Tentacle/issues">Feedback</a></li>
        <li><a href="https://github.com/adampatterson/Tentacle/wiki/Credits">Credits</a></li>
        <li><p><? upgrade::check_core_version_footer(); ?></p></li>
      </ul>
      <p class="pull-right"><small>Thanks for creating with</small> <a href="http://tentaclecms.com"><img src="<?= ADMIN_URL.'/images/tentacle_logo_footer.png' ?>" alt="Tentacle CMS" /></a></p>
  </nav>

</footer>


<? if ( in_array('wysiwyg', $assets)): ?>
    <script type="text/javascript" src="<?=ADMIN_JS; ?>ckeditor.config.js"></script>
<? endif;

if( in_array('filedrop', $assets ) ): ?>
    <script src="<?=ADMIN_JS; ?>filedrop.config.js"></script>
<? endif; ?>

<script type="text/javascript" src="<?=ADMIN_JS; ?>application.min.js"></script>

<?= notification() ?>

<? //	#echo shell_exec('git status'); ?>
</body>
</html>

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
<? endif;?>

<? if( in_array('filedrop', $assets ) ): ?>
    <script src="<?=ADMIN_JS; ?>filedrop.config.js"></script>
<? endif; ?>

<script type="text/javascript" src="<?=ADMIN_JS; ?>application.min.js"></script>

<?= notification() ?>

<!-- begin olark code --><script data-cfasync="false" type='text/javascript'>/*{literal}<![CDATA[*/
    window.olark||(function(c){var f=window,d=document,l=f.location.protocol=="https:"?"https:":"http:",z=c.name,r="load";var nt=function(){f[z]=function(){(a.s=a.s||[]).push(arguments)};var a=f[z]._={},q=c.methods.length;while(q--){(function(n){f[z][n]=function(){f[z]("call",n,arguments)}})(c.methods[q])}a.l=c.loader;a.i=nt;a.p={0:+new Date};a.P=function(u){a.p[u]=new Date-a.p[0]};function s(){a.P(r);f[z](r)}f.addEventListener?f.addEventListener(r,s,false):f.attachEvent("on"+r,s);var ld=function(){function p(hd){hd="head";return["<",hd,"></",hd,"><",i,' onl' + 'oad="var d=',g,";d.getElementsByTagName('head')[0].",j,"(d.",h,"('script')).",k,"='",l,"//",a.l,"'",'"',"></",i,">"].join("")}var i="body",m=d[i];if(!m){return setTimeout(ld,100)}a.P(1);var j="appendChild",h="createElement",k="src",n=d[h]("div"),v=n[j](d[h](z)),b=d[h]("iframe"),g="document",e="domain",o;n.style.display="none";m.insertBefore(n,m.firstChild).id=z;b.frameBorder="0";b.id=z+"-loader";if(/MSIE[ ]+6/.test(navigator.userAgent)){b.src="javascript:false"}b.allowTransparency="true";v[j](b);try{b.contentWindow[g].open()}catch(w){c[e]=d[e];o="javascript:var d="+g+".open();d.domain='"+d.domain+"';";b[k]=o+"void(0);"}try{var t=b.contentWindow[g];t.write(p());t.close()}catch(x){b[k]=o+'d.write("'+p().replace(/"/g,String.fromCharCode(92)+'"')+'");d.close();'}a.P(2)};ld()};nt()})({loader: "static.olark.com/jsclient/loader0.js",name:"olark",methods:["configure","extend","declare","identify"]});
    /* custom configuration goes here (www.olark.com/documentation) */
    olark.identify('6479-579-10-4369');/*]]>{/literal}*/
    olark('api.visitor.updateFullName', {fullName: '<?= user_name(); ?>'});
</script><noscript><a href="https://www.olark.com/site/6479-579-10-4369/contact" title="Contact us" target="_blank">Questions? Feedback?</a> powered by <a href="http://www.olark.com?welcome" title="Olark live chat software">Olark live chat software</a></noscript>
<!-- end olark code -->

<? //	#echo shell_exec('git status'); ?>
</body>
</html>

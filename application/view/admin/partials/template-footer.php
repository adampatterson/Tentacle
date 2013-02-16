</div>
<!-- #body-wrapper -->
<? //render_debug(); ?>
<footer class="footer">
<div class="navbar-fixed-bottom">
	<div class="navbar-inner">
		<div class="navbar navbar-fixed-bottom" style="position: absolute;">
			<div class="navbar-inner">
				<div class="container" style="width: auto; padding: 0 20px;">
					<ul class="nav">
						<li><a href="https://github.com/adampatterson/Tentacle/wiki" target="_blank">Documentation</a></li>
						<li><a href="https://github.com/adampatterson/Tentacle/issues">Feedback</a></li>
						<li><a href="https://github.com/adampatterson/Tentacle/wiki/Credits">Credits</a></li>
						<li><p><? upgrade::check_core_version_footer(); ?></p></li>
					</ul>
					<ul class="nav pull-right">
						<li><p><small>Thanks for creating with<small> <a href="http://tentaclecms.com"><img src="<?= ADMIN_URL.'/images/tentacle_logo_footer.png' ?>" alt="Tentacle CMS" /></a></p></li>
					</ul>
				</div>
			</div>
		</div>	
	</div>
</div>
</footer>

<? if(user_editor() == 'wysiwyg'): ?>

    <script type="text/javascript" src="<?= ADMIN_JS; ?>raptor.min.js"></script>

    <link type="text/css" rel="stylesheet" href="<?= ADMIN_CSS; ?>jquery-ui.css">
    <link type="text/css" rel="stylesheet" href="<?= ADMIN_CSS; ?>raptor-theme.css">
	
	<style type="text/css" media="screen">
        .ui-widget-content  .ui-icon-media-modal {
            background-image: url(<?= ADMIN_IMG ?>editor/image.png);
        }
    </style>
	<script type="text/javascript">
        $(document).ready(function() {
            $('#myButton').click(function(e) {
                e.preventDefault();
                $('#myModal').reveal();
            });
        });
    </script>
    <script type="text/javascript" src="<?= ADMIN_JS; ?>raptor.config.js"></script>
<? endif; ?>

<? if(user_editor() == 'html'): ?>
	<link rel="stylesheet" href="<?=ADMIN_JS; ?>CodeMirror/lib/codemirror.css">
    <link rel="stylesheet" href="<?=ADMIN_CSS; ?>codemirror.css">
	<script src="<?=ADMIN_JS; ?>CodeMirror/lib/codemirror.js"></script>
	<script src="<?=ADMIN_JS; ?>CodeMirror/mode/xml/xml.js"></script>
	<script src="<?=ADMIN_JS; ?>CodeMirror/mode/css/css.js"></script>
	<script src="<?=ADMIN_JS; ?>CodeMirror/mode/javascript/javascript.js"></script>
	<script src="<?=ADMIN_JS; ?>CodeMirror/mode/clike/clike.js"></script>
	<script src="<?=ADMIN_JS; ?>CodeMirror/mode/php/php.js"></script>
	<script src="<?=ADMIN_JS; ?>CodeMirror/mode/htmlmixed/htmlmixed.js"></script>

    <script src="<?=ADMIN_JS; ?>codemirror.config.js"></script>

<? endif; ?>

<? if( in_array('filedrop', $assets ) ): ?>
    <script src="<?=ADMIN_JS; ?>filedrop.config.js"></script>
<? endif; ?>

	<script type="text/javascript" src="<?=ADMIN_JS; ?>application.js"></script>

	<!-- begin olark code --><script data-cfasync="false" type='text/javascript'>/*{literal}<![CDATA[*/
	window.olark||(function(c){var f=window,d=document,l=f.location.protocol=="https:"?"https:":"http:",z=c.name,r="load";var nt=function(){f[z]=function(){(a.s=a.s||[]).push(arguments)};var a=f[z]._={},q=c.methods.length;while(q--){(function(n){f[z][n]=function(){f[z]("call",n,arguments)}})(c.methods[q])}a.l=c.loader;a.i=nt;a.p={0:+new Date};a.P=function(u){a.p[u]=new Date-a.p[0]};function s(){a.P(r);f[z](r)}f.addEventListener?f.addEventListener(r,s,false):f.attachEvent("on"+r,s);var ld=function(){function p(hd){hd="head";return["<",hd,"></",hd,"><",i,' onl' + 'oad="var d=',g,";d.getElementsByTagName('head')[0].",j,"(d.",h,"('script')).",k,"='",l,"//",a.l,"'",'"',"></",i,">"].join("")}var i="body",m=d[i];if(!m){return setTimeout(ld,100)}a.P(1);var j="appendChild",h="createElement",k="src",n=d[h]("div"),v=n[j](d[h](z)),b=d[h]("iframe"),g="document",e="domain",o;n.style.display="none";m.insertBefore(n,m.firstChild).id=z;b.frameBorder="0";b.id=z+"-loader";if(/MSIE[ ]+6/.test(navigator.userAgent)){b.src="javascript:false"}b.allowTransparency="true";v[j](b);try{b.contentWindow[g].open()}catch(w){c[e]=d[e];o="javascript:var d="+g+".open();d.domain='"+d.domain+"';";b[k]=o+"void(0);"}try{var t=b.contentWindow[g];t.write(p());t.close()}catch(x){b[k]=o+'d.write("'+p().replace(/"/g,String.fromCharCode(92)+'"')+'");d.close();'}a.P(2)};ld()};nt()})({loader: "static.olark.com/jsclient/loader0.js",name:"olark",methods:["configure","extend","declare","identify"]});
	/* custom configuration goes here (www.olark.com/documentation) */
	olark.identify('6479-579-10-4369');/*]]>{/literal}*/</script><noscript><a href="https://www.olark.com/site/6479-579-10-4369/contact" title="Contact us" target="_blank">Questions? Feedback?</a> powered by <a href="http://www.olark.com?welcome" title="Olark live chat software">Olark live chat software</a></noscript>
	<!-- end olark code -->

<!-- 
<?
	echo shell_exec('git status'); 
?>
-->

</body>
</html>

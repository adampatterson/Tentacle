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
						<li><p><small>Thanks for creating with<small> <a href="http://tentaclecms.com"><img src="<?= TENTACLE_URL.'admin/images/tentacle_logo_footer.png' ?>" alt="Tentacle CMS" /></a></p></li>
					</ul>
				</div>
			</div>
		</div>	
	</div>
</div>
</footer>
	<script src="<?=TENTACLE_JS; ?>bootstrap.2.1.min.js"></script>
<? if(user_editor() == 'wysiwyg'): ?>
	<link rel="stylesheet" type="text/css" href="<?=TENTACLE_JS; ?>bootstrap-wysihtml5/bootstrap-wysihtml5.css"></link>
	<script src="<?=TENTACLE_JS; ?>bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
	<script src="<?=TENTACLE_JS; ?>bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<? else: ?>
	<link rel="stylesheet" href="<?=TENTACLE_JS; ?>CodeMirror/lib/codemirror.css">
	<script src="<?=TENTACLE_JS; ?>CodeMirror/lib/codemirror.js"></script>
	<script src="<?=TENTACLE_JS; ?>CodeMirror/mode/xml/xml.js"></script>
	<script src="<?=TENTACLE_JS; ?>CodeMirror/mode/css/css.js"></script>
	<script src="<?=TENTACLE_JS; ?>CodeMirror/mode/javascript/javascript.js"></script>
	<script src="<?=TENTACLE_JS; ?>CodeMirror/mode/clike/clike.js"></script>
	<script src="<?=TENTACLE_JS; ?>CodeMirror/mode/php/php.js"></script>
	<script src="<?=TENTACLE_JS; ?>CodeMirror/mode/htmlmixed/htmlmixed.js"></script>
	
	<script>
		var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
			lineNumbers: true,
			theme: "default",
			mode: "text/html",
			onCursorActivity: function() {
				editor.setLineClass(hlLine, null);
				hlLine = editor.setLineClass(editor.getCursor().line, "activeline");
			},
			onKeyEvent: function(cm, e) {
				// Hook into ctrl-space
			if (e.keyCode == 32 && (e.ctrlKey || e.metaKey) && !e.altKey) {
				e.stop();
				return CodeMirror.simpleHint(cm, CodeMirror.javascriptHint);
				}
			}
		});
		var hlLine = editor.setLineClass(0, "activeline");
		</script>
<? endif; ?>

<? if( in_array('jupload', $assets ) ): ?>
		
		<!-- The Templates plugin is included to render the upload/download listings -->
		<script src="http://blueimp.github.com/JavaScript-Templates/tmpl.min.js"></script>
		<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
		<script src="http://blueimp.github.com/JavaScript-Load-Image/load-image.min.js"></script>
		<!-- The Canvas to Blob plugin is included for image resizing functionality -->
		<script src="http://blueimp.github.com/JavaScript-Canvas-to-Blob/canvas-to-blob.min.js"></script>
		<!-- Bootstrap JS and Bootstrap Image Gallery are not required, but included for the demo -->
		<script src="http://blueimp.github.com/Bootstrap-Image-Gallery/js/bootstrap-image-gallery.min.js"></script>
		<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
		<script src="<?= TENTACLE_JS ?>jQuery-File-Upload/jquery.iframe-transport.js"></script>
		<!-- The basic File Upload plugin -->
		<script src="<?= TENTACLE_JS ?>jQuery-File-Upload/jquery.fileupload.js"></script>
		<!-- The File Upload image processing plugin -->
		<script src="<?= TENTACLE_JS ?>jQuery-File-Upload/jquery.fileupload-fp.js"></script>
		<!-- The File Upload user interface plugin -->
		<script src="<?= TENTACLE_JS ?>jQuery-File-Upload/jquery.fileupload-ui.js"></script>
		<!-- The localization script -->
		<script src="<?= TENTACLE_JS ?>jQuery-File-Upload/locale.js"></script>
		<!-- The main application script -->
		<script src="<?= TENTACLE_JS ?>jQuery-File-Upload/main.js"></script>
		<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE8+ -->
		<!--[if gte IE 8]><script src="<?= TENTACLE_JS ?>jQuery-File-Upload/js/cors/jquery.xdr-transport.js"></script><![endif]-->

<? endif; ?>

	<script type="text/javascript" src="<?=TENTACLE_JS; ?>application.js"></script>

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

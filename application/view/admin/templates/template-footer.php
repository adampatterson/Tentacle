</div>
<!-- #body-wrapper -->
<? //render_debug(); ?>
<div class="nav nav-pills navbar-fixed-bottom">
	<div class="container-full">
		<div class="one-half"><p><a href="https://github.com/adampatterson/Tentacle/wiki" target="_blank">Documentation</a> | <a href="https://github.com/adampatterson/Tentacle/issues" target="_blank">Feedback</a> | <a href="https://github.com/adampatterson/Tentacle/wiki/Credits" target="_blank">Credits</a> |  version <?= TENTACLE_VERSION; ?></p></div>
		<div class="one-half"><p class="pull-right"><span>Thanks for creating with</<span> <a href="http://tentaclecms.com"><img src="<?= TENTACLE_URL.'/admin/images/tentacle_logo_footer.png' ?>" alt="Tentacle CMS" /></a></p></div>
	</div>
</div>

<? if(user_editor() == 'wysiwyg'): ?>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>tiny_mce/jquery.tinymce.js"></script>
<? else: ?>
	<link rel="stylesheet" href="<?=TENTACLE_JS; ?>CodeMirror-2.22/lib/codemirror.css">
	<script src="<?=TENTACLE_JS; ?>CodeMirror-2.22/lib/codemirror.js"></script>
	<script src="<?=TENTACLE_JS; ?>CodeMirror-2.22/mode/xml/xml.js"></script>
	<script src="<?=TENTACLE_JS; ?>CodeMirror-2.22/mode/css/css.js"></script>
	<script src="<?=TENTACLE_JS; ?>CodeMirror-2.22/mode/javascript/javascript.js"></script>
	<script src="<?=TENTACLE_JS; ?>CodeMirror-2.22/mode/clike/clike.js"></script>
	<script src="<?=TENTACLE_JS; ?>CodeMirror-2.22/mode/php/php.js"></script>
	<script src="<?=TENTACLE_JS; ?>CodeMirror-2.22/mode/htmlmixed/htmlmixed.js"></script>
	
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

<!-- 
<?
	echo shell_exec('git status'); 
?>
-->
</body>
</html>

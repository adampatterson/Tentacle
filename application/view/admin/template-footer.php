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

	<script type="text/javascript" src="<?=TENTACLE_JS; ?>application.js"></script>

<!-- 
<?
	echo shell_exec('git status'); 
?>
-->
</body>
</html>

</div>

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

<!-- #body-wrapper -->
<? //render_debug(); ?>
<!-- 
<?
	echo shell_exec('git status'); 
?>
-->
</body>
</html>

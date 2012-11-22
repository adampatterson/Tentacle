<? load::view('admin/partials/template-header', array('title' => 'Manage media', 'assets' => array('application')));?>
<!-- Bootstrap CSS fixes for IE6 -->
<!--[if lt IE 7]><link rel="stylesheet" href="http://blueimp.github.com/cdn/css/bootstrap-ie6.min.css"><![endif]-->
<!-- Bootstrap Image Gallery styles -->
<link rel="stylesheet" href="http://blueimp.github.com/Bootstrap-Image-Gallery/css/bootstrap-image-gallery.min.css">
<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<link rel="stylesheet" href="<?= ADMIN_CSS ?>/jquery.fileupload-ui.css">
<!-- Shim to make HTML5 elements usable in older Internet Explorer versions -->
<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<div id="wrap">
	<div id="post-body">
		<div id="post-body-content">
			<div class="title">
				<h1 class='align-left'><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Manage media</h1>
			</div>
    			<!-- The file upload form used as target for the file upload widget -->    
			<!--<form id="fileupload" action="<?= ADMIN_JS ?>jQuery-File-Upload/server/php/" method="POST" enctype="multipart/form-data">-->
			<form id="fileupload" action="<?= BASE_URL ?>action/upload_media/" method="POST" enctype="multipart/form-data">
		        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
		        <div class="actions fileupload-buttonbar">
		            <!--<div class="span7">-->
					<div class="span8">
		                <!-- The fileinput-button span is used to style the file input field as button -->
		                <span class="btn btn-success primary fileinput-button">
		                    <span><i class="icon-plus icon-white"></i> Add files...</span>
		                    <input type="file" name="files[]" multiple>
		                </span>
		                <button type="submit" class="btn btn-primary success start">
		                    <i class="icon-upload icon-white"></i> Start upload
		                </button>
		                <button type="reset" class="btn btn-warning warning cancel">
		                    <i class="icon-ban-circle icon-white"></i> Cancel upload
		                </button>
		                <button type="button" class="btn btn-danger danger delete">
		                    <i class="icon-trash icon-white"></i> Delete
		                </button>
		                <input type="checkbox" class="toggle">
		            </div>
		            <div class="span5">
		                <!-- The global progress bar -->
		                <div class="progress progress-success progress-striped active fade">
		                    <div class="bar" style="width:0%;"></div>
		                </div>
		            </div>
		        </div>
		        <!-- The loading indicator is shown during image processing -->
		        <div class="fileupload-loading"></div>
		        <br>
		        <!-- The table listing the files available for upload/download -->
		        <table class="table table-striped"><tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery"></tbody></table>
		    </form>
		    <br>
			<!-- modal-gallery is the modal dialog used for the image gallery -->
			<div id="modal-gallery" class="modal modal-gallery hide fade">
			    <div class="modal-header">
			        <a class="close" data-dismiss="modal">&times;</a>
			        <h3 class="modal-title"></h3>
			    </div>
			    <div class="modal-body"><div class="modal-image"></div></div>
			    <div class="modal-footer">
			        <a class="btn btn-primary modal-next">Next <i class="icon-arrow-right icon-white"></i></a>
			        <a class="btn btn-info modal-prev"><i class="icon-arrow-left icon-white"></i> Previous</a>
			        <a class="btn btn-success modal-play modal-slideshow" data-slideshow="5000"><i class="icon-play icon-white"></i> Slideshow</a>
			        <a class="btn modal-download" target="_blank"><i class="icon-download"></i> Download</a>
			    </div>
			</div>
			
			<!-- The template to display files available for upload -->
			<script id="template-upload" type="text/x-tmpl">
			{% for (var i=0, file; file=o.files[i]; i++) { %}
			    <tr class="template-upload fade">
			        <td class="preview"><span class="fade"></span></td>
			        <td class="name">{%=file.name%}</td>
			        <td class="size">{%=o.formatFileSize(file.size)%}</td>
			        {% if (file.error) { %}
			            <td class="error" colspan="2"><span class="label label-important">{%=locale.fileupload.error%}</span> {%=locale.fileupload.errors[file.error] || file.error%}</td>
			        {% } else if (o.files.valid && !i) { %}
			            <td>
			                <div class="progress progress-success progress-striped active"><div class="bar" style="width:0%;"></div></div>
			            </td>
			            <td class="start">{% if (!o.options.autoUpload) { %}
			                <button class="btn btn-primary">
			                    <i class="icon-upload icon-white"></i> {%=locale.fileupload.start%}
			                </button>
			            {% } %}</td>
			        {% } else { %}
			            <td colspan="2"></td>
			        {% } %}
			        <td class="cancel">{% if (!i) { %}
			            <button class="btn btn-warning">
			                <i class="icon-ban-circle icon-white"></i> {%=locale.fileupload.cancel%}
			            </button>
			        {% } %}</td>
			    </tr>
			{% } %}
			</script>
			
			<!-- The Templates plugin is included to render the upload/download listings -->
			<script src="http://blueimp.github.com/JavaScript-Templates/tmpl.min.js"></script>
			<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
			<script src="http://blueimp.github.com/JavaScript-Load-Image/load-image.min.js"></script>
			<!-- The Canvas to Blob plugin is included for image resizing functionality -->
			<script src="http://blueimp.github.com/JavaScript-Canvas-to-Blob/canvas-to-blob.min.js"></script>
			<!-- Bootstrap JS and Bootstrap Image Gallery are not required, but included for the demo -->
			<script src="http://blueimp.github.com/cdn/js/bootstrap.min.js"></script>
			<script src="http://blueimp.github.com/Bootstrap-Image-Gallery/js/bootstrap-image-gallery.min.js"></script>
			<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
			<script src="<?= ADMIN_JS ?>jQuery-File-Upload/jquery.iframe-transport.js"></script>
			<!-- The basic File Upload plugin -->
			<script src="<?= ADMIN_JS ?>jQuery-File-Upload/jquery.fileupload.js"></script>
			<!-- The File Upload image processing plugin -->
			<script src="<?= ADMIN_JS ?>jQuery-File-Upload/jquery.fileupload-ip.js"></script>
			<!-- The File Upload user interface plugin -->
			<script src="<?= ADMIN_JS ?>jQuery-File-Upload/jquery.fileupload-ui.js"></script>
			<!-- The localization script -->
			<script src="<?= ADMIN_JS ?>jQuery-File-Upload/locale.js"></script>
			<!-- The main application script -->
			<script src="<?= ADMIN_JS ?>jQuery-File-Upload/main.js"></script>
			<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE8+ -->
			<!--[if gte IE 8]><script src="<?= ADMIN_JS ?>jQuery-File-Upload/js/cors/jquery.xdr-transport.js"></script><![endif]-->

		</div>
	</div>
</div>
<? load::view('admin/partials/template-footer', array( 'assets' => array( '' ) ) ); ?>
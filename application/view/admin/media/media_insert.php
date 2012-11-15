<? load::view('admin/templates/template-modal-header', array('title' => 'Insert media', 'assets'=> array('jupload') ) );?>

<script type="text/javascript">

	$(document).ready(function(){

		//$('#none').click(function( none) {
		//	$( none.target ).closest('#link_url').val('')
		//	$('#link_url').val('');
		//	return false;
		//});
		
		//$('#file').click(function() {	
		//	$('#link_url').val('http://placehold.it/200x200');
		//	return false;
		//});

		$('#insert').click(function() {

			var title				    = $('#title').val();
			var alt_text				= $('#alt_text').val();
			var caption				    = $('#caption').val();
			var link_url				= $('#link_url').val();
            var image_size              = $('.image_size:checked').val();

			if (!link_url) {
                var HtmlLink = '<img src="http://placehold.it/200x200" alt="' + alt_text + '" title="' + title + '"  />';
            } else {
                var HtmlLink = '<a href="' + link_url + '"><img src="http://placehold.it/200x200" alt="' + alt_text + '" title="' + title + '" /></a>';
            }

            var win = window.dialogArguments || opener || parent || top;
            win.send_to_editor(HtmlLink);

			return false;
		});
		
	});
</script>

<div class="span9">	

	<div class="tabbable">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#library" data-toggle="tab">From Library</a></li>
			<li><a href="#upload" data-toggle="tab">Upload</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="library">
				
				<div class="accordion" id="accordion">
					<? foreach ( $media as $image ): ?>
					<? $file_meta = explode('.', $image->name ); 

					//ChromePHP::log($file_meta);

					IMAGE_DIR.$file_meta[0].'_sq'.'.'.$file_meta[1];

					IMAGE_T;
					IMAGE_M;
					IMAGE_L;
					?>
					<div class="accordion-group">
						<div class="accordion-heading">
							<div class="row">
								<div class="span1">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion<?=$image->id ?>" href="#collapse<?=$image->id ?>">
										<img src="<?= IMAGE_URL.$file_meta[0].'_sq'.'.'.$file_meta[1]; ?>" class="thumbnail" width="30" height="30" />
									</a>
								</div>
								<div class="span4">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion<?=$image->id ?>" href="#collapse<?=$image->id ?>"><?=$image->title ?></a>
								</div>
							</div>
						</div>
						<div id="collapse<?=$image->id ?>" class="accordion-body collapse" style="height: 0px; ">
							<div class="accordion-inner">

								<div class="row">
									<div class="span3">
										<img src="<?= IMAGE_URL.$file_meta[0].'_sq'.'.'.$file_meta[1]; ?>" class="thumbnail"/>
									</div>
									<div class="span4 well">
										<dl class="dl-horizontal">
											<dt>File name:</dt>
											<dd><?=$image->name ?></dd>
											<dt>File type:</dt>
											<dd><?=$image->type ?></dd>
											<dt>Uploaded on:</dt>
											<dd>April 11, 2012</dd>
											<dt>Dimensions</dt>
											<dd>200 x 200</dd>
										</dl>
										<input type="hidden" name="file_name" value="<?=$image->name ?>" >
									</div>
								</div>
								<div class="row">
									<form action="<?= BASE_URL ?>action/update_media/<?= $image->id ?>" method="post" class="form-horizontal" name="<?= $image->slug ?>">
										<input type="hidden" name="history" value="<?= CURRENT_PAGE ?>"/>
										<fieldset>
											<h3>&nbsp;</h3>

											<div class="control-group">
												<label class="control-label" for="title">Title</label>
												<div class="controls">
													<input type="text" class="span5" id="title" name="title" value="<?=$image->title ?>">
												</div>
											</div>

											<div class="control-group">
												<label class="control-label" for="alt_text">Alternate Text</label>
												<div class="controls">
													<input type="text" class="span5" id="alt_text" name="alt_text" value="<?=$image->alt ?>" >
												</div>
											</div>

											<div class="control-group">
												<label class="control-label" for="caption">Caption</label>
												<div class="controls">
													<input type="text" class="span5" id="caption" name="caption" value="<?= $image->caption ?>">
												</div>
											</div>

											<div class="control-group">
												<label class="control-label" for="link_url">Link URL</label>
												<div class="controls">
													<div class="input-append">
														<input type="text" class="span3" id="link_url" name="link_url" value="<?= $image->link ?>" ><button class="btn" type="button" id="none">None</button><button class="btn" type="button" id="file">File</button>
										             </div>
												</div>
											</div>

											<div class="control-group">
												<label class="control-label">Size</label>
												<div class="controls">
													<label class="radio">
														<input type="radio" name="image_size" class="image_size" value="<?= get::option('image_thumb_size_w'); ?>" checked="" />
															Thumbnail ( <?= get::option('image_thumb_size_w').' x '.get::option('image_thumb_size_h'); ?> )
													</label>
													<label class="radio">
														<input type="radio" name="image_size" class="image_size" value="<?= get::option('image_medium_size_w'); ?>" />
														Medium ( <?= get::option('image_medium_size_w').' x '.get::option('image_medium_size_h'); ?> )
													</label>
													<label class="radio">
														<input type="radio" name="image_size" class="image_size" value="<?= get::option('image_large_size_w'); ?>" />
														Large ( <?= get::option('image_large_size_w').' x '.get::option('image_large_size_h'); ?> )
													</label>
													<label class="radio">
														<input type="radio" name="image_size" class="image_size" value="" />
														Full Size
													</label>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="actions">
												<a class="btn btn-primary" id="insert">Insert Image</a>
												<input type="submit" name="update" value="Update" id="update" class="btn btn-success">
												<!--<a class="btn primary" id="insert">Insert Image</a>-->
												<button class="btn btn-danger">Delete</button>
												<a class="btn" href="javascript:parent.jQuery.fancybox.close();">Cancel</a>
											</div>
										</fieldset>
									</form>
								</div>				

							</div>
						</div>
					</div><!-- /#collapse<?=$image->id ?> -->
					<? endforeach; ?>	
				</div>
				
			</div><!-- /#insert -->
			<div class="tab-pane" id="upload">
				
				<!-- The file upload form used as target for the file upload widget -->    
				<form id="fileupload" action="<?= BASE_URL ?>action/upload_media/" method="POST" enctype="multipart/form-data">
			        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
			        <div class="actions fileupload-buttonbar">
			                <!-- The fileinput-button span is used to style the file input field as button -->
			                <span class="btn btn-success primary fileinput-button">
			                    <span>Add files...</span>
			                    <input type="file" name="files[]" multiple>
			                </span>
			                <button type="submit" class="btn btn-primary success start">
			                    Start upload
			                </button>
			       
			                <!-- The global progress bar -->
			                <div class="progress progress-success progress-striped active fade">
			                    <div class="bar" style="width:0%;"></div>
			                </div>
			         
			        </div>
			        <!-- The loading indicator is shown during image processing -->
			        <div class="fileupload-loading"></div>
			        <br>
			        <!-- The table listing the files available for upload/download -->
			        <table class="table table-striped"><tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery"></tbody></table>
			    </form>
			    <br>
				<!-- The template to display files available for upload -->
				<script id="template-upload" type="text/x-tmpl">
				{% for (var i=0, file; file=o.files[i]; i++) { %}
				    <tr class="template-upload fade">
				        <td class="preview"><span class="fade"></span></td>
				        <td class="name"><span>{%=file.name%}</span></td>
				        <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
				        {% if (file.error) { %}
				            <td class="error" colspan="2"><span class="label label-important">{%=locale.fileupload.error%}</span> {%=locale.fileupload.errors[file.error] || file.error%}</td>
				        {% } else if (o.files.valid && !i) { %}
				            <td>
				                <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="bar" style="width:0%;"></div></div>
				            </td>
				            <td class="start">{% if (!o.options.autoUpload) { %}
				                <button class="btn btn-primary">
				                    <i class="icon-upload icon-white"></i>
				                    <span>{%=locale.fileupload.start%}</span>
				                </button>
				            {% } %}</td>
				        {% } else { %}
				            <td colspan="2"></td>
				        {% } %}
				        <td class="cancel">{% if (!i) { %}
				            <button class="btn btn-warning">
				                <i class="icon-ban-circle icon-white"></i>
				                <span>{%=locale.fileupload.cancel%}</span>
				            </button>
				        {% } %}</td>
				    </tr>
				{% } %}
				</script>
				<!-- The template to display files available for download -->
				<script id="template-download" type="text/x-tmpl">
				{% for (var i=0, file; file=o.files[i]; i++) { %}
				    <tr class="template-download fade">
				        {% if (file.error) { %}
				            <td></td>
				            <td class="name"><span>{%=file.name%}</span></td>
				            <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
				            <td class="error" colspan="2"><span class="label label-important">{%=locale.fileupload.error%}</span> {%=locale.fileupload.errors[file.error] || file.error%}</td>
				        {% } else { %}
				            <td class="preview">{% if (file.thumbnail_url) { %}
				                <a href="{%=file.url%}" title="{%=file.name%}" rel="gallery" download="{%=file.name%}"><img src="{%=file.thumbnail_url%}"></a>
				            {% } %}</td>
				            <td class="name">
				                <a href="{%=file.url%}" title="{%=file.name%}" rel="{%=file.thumbnail_url&&'gallery'%}" download="{%=file.name%}">{%=file.name%}</a>
				            </td>
				            <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
				            <td colspan="2"></td>
				        {% } %}
				        <td class="delete">
				            <button class="btn btn-danger" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}">
				                <i class="icon-trash icon-white"></i>
				                <span>{%=locale.fileupload.destroy%}</span>
				            </button>
				            <input type="checkbox" name="delete" value="1">
				        </td>
				    </tr>
				{% } %}
				</script>
				
			</div><!-- /#upload -->
		</div>
	</div>
	
</div>
<? load::view('admin/templates/template-modal-footer', array( 'assets'=> array('jupload') ) );?>
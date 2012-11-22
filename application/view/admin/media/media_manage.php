<? load::view('admin/partials/template-header', array('title' => 'Manage media', 'assets' => array('jupload') ) ); ?>
<div id="wrap">
	<div id="post-body">
		<div id="post-body-content">
			<div class="title">
				<h1 class='align-left'><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Manage media</h1>
			</div>
			
    		<!-- The file upload form used as target for the file upload widget -->    
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
			<div id="modal-gallery" class="modal modal-gallery hide fade" data-filter=":odd">
			    <div class="modal-header">
			        <a class="close" data-dismiss="modal">&times;</a>
			        <h3 class="modal-title"></h3>
			    </div>
			    <div class="modal-body"><div class="modal-image"></div></div>
			    <div class="modal-footer">
			        <a class="btn modal-download" target="_blank">
			            <i class="icon-download"></i>
			            <span>Download</span>
			        </a>
			        <a class="btn btn-success modal-play modal-slideshow" data-slideshow="5000">
			            <i class="icon-play icon-white"></i>
			            <span>Slideshow</span>
			        </a>
			        <a class="btn btn-info modal-prev">
			            <i class="icon-arrow-left icon-white"></i>
			            <span>Previous</span>
			        </a>
			        <a class="btn btn-primary modal-next">
			            <span>Next</span>
			            <i class="icon-arrow-right icon-white"></i>
			        </a>
			    </div>
			</div>
			
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
			
			<div class="accordion" id="accordion">
				<? foreach ( $media as $image ): ?>
				<? $file_meta = explode('.', $image->name ); 

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
												<input type="text" class="span5 post" data-image-id="<?= $image->id ?>" id="title" name="title" value="<?=$image->title ?>">
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="alt_text">Alternate Text</label>
											<div class="controls">
												<input type="text" class="span5 post" data-image-id="<?= $image->id ?>" id="alt_text" name="alt_text" value="<?=$image->alt ?>" >
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="caption">Caption</label>
											<div class="controls">
												<input type="text" class="span5 post" data-image-id="<?= $image->id ?>" id="caption" name="caption" value="<?= $image->caption ?>">
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="link_url">Link URL</label>
											<div class="controls">
												<div class="input-append">
													<input type="text" class="span3 post" data-image-id="<?= $image->id ?>" id="link_url" name="link_url" value="<?= $image->link ?>" ><button class="btn" type="button" id="none">None</button><button class="btn" type="button" id="file">File</button>
									             </div>
											</div>
										</div>

										<div class="control-group">
											<label class="control-label">Size</label>
											<div class="controls">
												<label class="radio">
													<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="" />
													Thumbnail ( <?= get::option('image_thumb_size_w').' x '.get::option('image_thumb_size_h'); ?> )
												</label>
												<label class="radio">
													<input type="radio" name="optionsRadios" id="optionsRadios2" value="option2" />
													Medium ( <?= get::option('image_medium_size_w').' x '.get::option('image_medium_size_h'); ?> )
												</label>
												<label class="radio">
													<input type="radio" name="optionsRadios" id="optionsRadios3" value="option3" />
													Large ( <?= get::option('image_large_size_w').' x '.get::option('image_large_size_h'); ?> )
												</label>
												<label class="radio">
													<input type="radio" name="optionsRadios" id="optionsRadios3" value="option3" />
													Full Size
												</label>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="actions">
											<!--<input type="submit" name="update" value="Update" id="update" class="btn btn-success">-->
											<button class="btn btn-danger">Delete</button>
										</div>
									</fieldset>
								</form>
							</div>				

						</div>
					</div>
				</div><!-- /#collapse<?=$image->id ?> -->
				<? endforeach; ?>	
			</div>
			
			
			<script type="text/javascript" charset="utf-8">

				$(document).ready(function(){
					$('.post').focusout(update_media);
				});

				function update_media() {	
					
					var input_name = $(this).attr("name");
					var image_id = $(this).data('image-id');
					var input_value = $(this).val();
					
					var jsonObject = [{id:image_id, name:input_name, input_value:input_value}];
					
					jQuery.ajax({
						type: "POST",
						url: "<?= BASE_URL ?>ajax/update_media",
						/*data: input_name+'='+ input_value,*/
						data: {students: JSON.stringify(jsonObject) },
						dataType: "json",
						cache: false,
						success: function(response){
							if(response == '1')
							{
								$('#username').css('border', '1px #C33 solid');	
								$('.user_tick').hide();
								$('.user_cross').fadeIn();
								$("#save").attr("disabled", "disabled");
							}
							else
							{
								$('#username').css('border', '1px #090 solid');
								$('.user_cross').hide();
								$('.user_tick').fadeIn();
								$("#save").removeAttr("disabled");
							}
						}
					});
				}
			</script>
			
		</div>
	</div>
</div>
<? load::view('admin/partials/template-footer', array( 'assets'=> array( 'jupload' ) ) );?>
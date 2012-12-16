<? load::view('admin/partials/template-modal-header', array('title' => 'Insert media', 'assets'=> array('filedrop') ) );?>
<!--
<script type="text/javascript">
	$(document).ready(function(){

		$('#insert').click(function() {

			var title				    = $('.title').val();
			var alt_text				= $('.alt_text').val();
			var caption				    = $('.caption').val();
			var link_url				= $('.link_url').val();

			var filename				= $('.filename').val();
			var filenextension			= $('.extension').val();
			
            var size		          	= $('.image_size:checked').val();
			
			if ( size != '' ) {
				var image_size			= '_'+size;
			} else {
				var image_size			= '';
			};

			var image_url				= '<?= IMAGE_URL ?>' + filename + image_size + '.' + filenextension;

			if (!link_url) {
                var HtmlLink = '<img src="'+ image_url +'" alt="' + alt_text + '" title="' + title + '"  />';
            } else {
                var HtmlLink = '<a href="' + link_url + '"><img src="'+ image_url +'" alt="' + alt_text + '" title="' + title + '" /></a>';
            }

			//console.log(image_url);

            var win = window.dialogArguments || opener || parent || top;
            win.send_to_editor(HtmlLink);

			return false;
		});
		
	});
</script>
-->
<div class="span9">	

	<div class="tabbable">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#library" data-toggle="tab">From Library</a></li>
			<li><a href="#upload" data-toggle="tab">Upload</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="library">
				
				<div class="accordion" id="accordion">
					<? foreach ( $media as $image ):
					
					$file_meta = string_to_parts($image->name); ?>
					<div class="accordion-group">
						<div class="accordion-heading">
							<div class="row">
								<div class="span1">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion<?=$image->id ?>" href="#collapse<?=$image->id ?>">
										<img src="<?= IMAGE_URL.$file_meta['file_name'].'_sq'.'.'.$file_meta['extension']; ?>" class="thumbnail" width="30" height="30" />
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
										<img src="<?= IMAGE_URL.$file_meta['file_name'].'_sq'.'.'.$file_meta['extension']; ?>" class="thumbnail"/>
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
									<form action="<?= BASE_URL ?>action/insert_media/<?= $image->id ?>" method="post" class="form-horizontal" name="<?= $image->slug.'_'.$image->id ?>">
										<input type="hidden" name="history"  value="<?= CURRENT_PAGE ?>"/>
										<input type="hidden" name="filename" class="filename" value="<?=$file_meta['file_name'] ?>" />
										<input type="hidden" name="extension" class="extension" value="<?=$file_meta['extension'] ?>" />
										
										<fieldset>
											<h3>&nbsp;</h3>

											<div class="control-group">
												<label class="control-label" for="title">Title</label>
												<div class="controls">
													<input type="text" class="span5 title" name="title" value="<?=$image->title ?>">
												</div>
											</div>

											<div class="control-group">
												<label class="control-label" for="alt_text">Alternate Text</label>
												<div class="controls">
													<input type="text" class="span5 alt_text" name="alt_text" value="<?=$image->alt ?>" >
												</div>
											</div>

											<div class="control-group">
												<label class="control-label" for="caption">Caption</label>
												<div class="controls">
													<input type="text" class="span5 caption" name="caption" value="<?= $image->caption ?>">
												</div>
											</div>

											<div class="control-group">
												<label class="control-label" for="link_url">Link URL</label>
												<div class="controls">
													<div class="input-append">
														<input type="text" class="span3 link_url" name="link_url" value="<?= $image->link ?>" ><button class="btn" type="button" id="none">None</button><button class="btn" type="button" id="file">File</button>
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
														<input type="radio" name="image_size" class="image_size" value="full" />
														Full Size
													</label>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="actions">
												<input type="submit" name="update" value="Insert Image" id="update" class="btn btn-primary">
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
				
				<div id="dropbox" class="well" style="height: 200px;">&nbsp;</div>
			    								
			</div><!-- /#upload -->
		</div>
	</div>
	
</div>
<? load::view('admin/partials/template-modal-footer', array( 'assets'=> array( 'filedrop' ) ) );?>
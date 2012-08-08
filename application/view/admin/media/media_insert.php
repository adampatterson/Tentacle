<? load::view('admin/templates/template-modal-header', array('title' => 'Insert media' ));?>

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

			var Title				= $('#title').val();
			var AltText				= $('#alt_text').val();
			var Caption				= $('#caption').val();
			var Link				= $('#link_url').val();
			
			if ( Link ) {
				var HtmlLink 		= '<a href="'+Link+'"><img src="http://placehold.it/200x200" alt="'+AltText+'" /></a>';
			} else {
				var HtmlLink 		= '<img src="http://placehold.it/200x200" alt="'+AltText+'" />';
			}

			console.log(HtmlLink);
			
			parent.top.tinyMCE.get('Content').execCommand('mceInsertContent',false, HtmlLink );
			parent.jQuery.fancybox.close();
			
			return false;
		});
		
	});
</script>
	
<div class="span8">	
	
	
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
					<div class="span33">
						<img src="<?= IMAGE_URL.$file_meta[0].'_sq'.'.'.$file_meta[1]; ?>" class="thumbnail"/>
					</div>
					<div class="span4">
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
										<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="" />
											Thumbnail ( <?= get_option('image_thumb_size_w').' x '.get_option('image_thumb_size_h'); ?> )
									</label>
									<label class="radio">
										<input type="radio" name="optionsRadios" id="optionsRadios2" value="option2" />
										Medium ( <?= get_option('image_medium_size_w').' x '.get_option('image_medium_size_h'); ?> )
									</label>
									<label class="radio">
										<input type="radio" name="optionsRadios" id="optionsRadios3" value="option3" />
										Large ( <?= get_option('image_large_size_w').' x '.get_option('image_large_size_h'); ?> )
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
	<? /* Sample style ?>
		<div class="accordion-group">
			<div class="accordion-heading">
				<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
					Collapsible Group Item #1
				</a>
			</div>
			<div id="collapseOne" class="accordion-body collapse" style="height: 0px; ">
				<div class="accordion-inner">
					<div class="row">
						<div class="span4">
							<img src="http://placehold.it/200x200" class="thumbnail"/>
						</div>
						<div class="span6">
							<dl class="dl-horizontal">
								<dt>File name:</dt>
								<dd>adam.jpg</dd>
								<dt>File type:</dt>
								<dd>image/jepg</dd>
								<dt>Uploaded on:</dt>
								<dd>April 11, 2012</dd>
								<dt>Dimensions</dt>
								<dd>200 x 200</dd>
							</dl>
							<input type="hidden" name="file_name" value="adam.jpg" >
							<input type="hidden" name="width" value="200" >
							<input type="hidden" name="height" value="250" >
						</div>
					</div>
					<div class="row">
						<form class="form-horizontal">
							<fieldset>
								<h3>&nbsp;</h3>
								<div class="clearfix">
									<label class="control-label" for="title">Title</label>
									<div class="input">
										<input type="text" class="input-xlarge span5" id="title" name="title" value="This is the title">
									</div>
								</div>
								<div class="clearfix">
									<label class="control-label" for="alt_text">Alternate Text</label>
									<div class="input">
										<input type="text" class="input-xlarge span5" id="alt_text" name="alt_text" value="This is an image" >
									</div>
								</div>
								<div class="clearfix">
									<label class="control-label" for="caption">Caption</label>
									<div class="input">
										<input type="text" class="input-xlarge span5" id="caption" name="caption" value="This is the caption">
									</div>
								</div>
								<div class="clearfix">
									<label class="control-label" for="link_url">Link URL</label>
									<div class="input">
										<input type="text" class="input-xlarge span5" id="link_url" name="link_url" value="http://placehold.it/350x150" >
										<div class="input-append">
							                <button class="btn" type="button" id="none">None</button> <button class="btn" type="button" id="file">File</button>
							             </div>
									</div>
								</div>
								<div class="clearfix">
									<label class="control-label">Size</label>
									<div class="input">
										<ul class="inputs-list">
											<li>
												<label>
													<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="" />
														Thumbnail ( <?= get_option('image_thumb_size_w').' x '.get_option('image_thumb_size_h'); ?> )
												</label>
											</li>
											<li>
												<label>
													<input type="radio" name="optionsRadios" id="optionsRadios2" value="option2" />
													Medium ( <?= get_option('image_medium_size_w').' x '.get_option('image_medium_size_h'); ?> )
												</label>
											</li>
											<li>
												<label>
													<input type="radio" name="optionsRadios" id="optionsRadios3" value="option3" />
													Large ( <?= get_option('image_large_size_w').' x '.get_option('image_large_size_h'); ?> )
												</label>
											</li>
											<li>
												<label>
													<input type="radio" name="optionsRadios" id="optionsRadios3" value="option3" />
													Full Size
												</label>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="actions">
									<a class="btn primary" id="insert">Insert Image</a>
									<!--<a class="btn primary" id="insert">Insert Image</a>-->
									<button class="btn danger">Delete</button>
									<a class="btn" href="javascript:parent.jQuery.fancybox.close();">Cancel</a>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>	
	<? */ ?>

</div>

<? /*
<div class="row">
	<div class="span4">
		<img src="http://placehold.it/200x200" class="thumbnail"/>
		<!--<br />	
		<button class="btn ">Edit Image</button>-->
	</div>
	<div class="span6">
		<dl class="dl-horizontal">
			<dt>File name:</dt>
			<dd>adam.jpg</dd>
			<dt>File type:</dt>
			<dd>image/jepg</dd>
			<dt>Uploaded on:</dt>
			<dd>April 11, 2012</dd>
			<dt>Dimensions</dt>
			<dd>200 x 200</dd>
		</dl>
		<input type="hidden" name="file_name" value="adam.jpg" >
		<input type="hidden" name="width" value="200" >
		<input type="hidden" name="height" value="250" >
	</div>
</div>
<div class="row">
	<form class="form-horizontal">
		<fieldset>
			<h3>&nbsp;</h3>
			<div class="clearfix">
				<label class="control-label" for="title">Title</label>
				<div class="input">
					<input type="text" class="input-xlarge span5" id="title" name="title" value="This is the title">
				</div>
			</div>
			<div class="clearfix">
				<label class="control-label" for="alt_text">Alternate Text</label>
				<div class="input">
					<input type="text" class="input-xlarge span5" id="alt_text" name="alt_text" value="This is an image" >
				</div>
			</div>
			<div class="clearfix">
				<label class="control-label" for="caption">Caption</label>
				<div class="input">
					<input type="text" class="input-xlarge span5" id="caption" name="caption" value="This is the caption">
				</div>
			</div>
			<div class="clearfix">
				<label class="control-label" for="link_url">Link URL</label>
				<div class="input">
					<input type="text" class="input-xlarge span5" id="link_url" name="link_url" value="http://placehold.it/350x150" >
					<div class="input-append">
		                <button class="btn" type="button" id="none">None</button> <button class="btn" type="button" id="file">File</button>
		             </div>
				</div>
			</div>
			<div class="clearfix">
				<label class="control-label">Alignment</label>
				<div class="input">
					<ul class="inputs-list">
						<li>
							<label>
								<input type="radio" name="alignment" id="optionsRadios1" value="option1" checked="">
									None
							</label>
						</li>
						<li>
							<label>
								<input type="radio" name="alignment" id="optionsRadios2" value="option2">
								Left
							</label>
						</li>
						<li>
							<label>
								<input type="radio" name="alignment" id="optionsRadios3" value="option3">
								Center
							</label>
						</li>
						<li>
							<label>
								<input type="radio" name="alignment" id="optionsRadios3" value="option3">
								Right
							</label>
						</li>
					</ul>
					</div>
				</div>
			<div class="clearfix">
				<label class="control-label">Size</label>
				<div class="input">
					<ul class="inputs-list">
						<li>
							<label>
								<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="" />
									Thumbnail ( <?= get_option('image_thumb_size_w').' x '.get_option('image_thumb_size_h'); ?> )
							</label>
						</li>
						<li>
							<label>
								<input type="radio" name="optionsRadios" id="optionsRadios2" value="option2" />
								Medium ( <?= get_option('image_medium_size_w').' x '.get_option('image_medium_size_h'); ?> )
							</label>
						</li>
						<li>
							<label>
								<input type="radio" name="optionsRadios" id="optionsRadios3" value="option3" />
								Large ( <?= get_option('image_large_size_w').' x '.get_option('image_large_size_h'); ?> )
							</label>
						</li>
						<li>
							<label>
								<input type="radio" name="optionsRadios" id="optionsRadios3" value="option3" />
								Full Size
							</label>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="actions">
				<!--<a href="javascript:;" onclick="tinyMCE.execCommand('mceInsertContent',false,'<img src=\'http://placehold.it/350x150\' />');">[ Insert Image ]</a>-->
				<!--<a class="btn primary" href="javascript:parent.top.tinyMCE.get('Content').execCommand('mceInsertContent',false,'<img src=\'http://placehold.it/350x150\' />');" onmouseup="parent.jQuery.fancybox.close();">Insert Image</a>-->
				<a class="btn primary" id="insert">Insert Image</a>
				<button class="btn danger">Delete</button>
				<a class="btn" href="javascript:parent.jQuery.fancybox.close();">Cancel</a>
			</div>
		</fieldset>
	</form>
</div>
*/?>
<? load::view('admin/templates/template-modal-footer');?>
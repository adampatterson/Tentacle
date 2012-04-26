<? load::view('admin/template-modal-header', array('title' => 'Insert media' ));?>

<div class="row">
	<div class="span4">
		<img src="http://placehold.it/200x200" />
		<br />	
		<button class="btn ">Edit Image</button>
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
			<h1>&nbsp;</h1>
			<div class="clearfix">
				<label class="control-label" for="title">Title</label>
				<div class="input">
					<input type="text" class="input-xlarge span5" id="title" name="title">
				</div>
			</div>
			<div class="clearfix">
				<label class="control-label" for="alt_text">Alternate Text</label>
				<div class="input">
					<input type="text" class="input-xlarge span5" id="alt_text" name="alt_text">
				</div>
			</div>
			<div class="clearfix">
				<label class="control-label" for="caption">Caption</label>
				<div class="input">
					<input type="text" class="input-xlarge span5" id="caption" name="caption">
				</div>
			</div>
			<div class="clearfix">
				<label class="control-label" for="link_utl">Link URL</label>
				<div class="input">
					<input type="text" class="input-xlarge span5" id="link_utl" name="link_utl">
				</div>
			</div>
			<div class="clearfix">
				<label class="control-label">Allignment</label>
				<div class="input">
					<ul class="inputs-list">
						<li>
							<label>
								<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
									None
							</label>
						</li>
						<li>
							<label>
								<input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
								Left
							</label>
						</li>
						<li>
							<label>
								<input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">
								Center
							</label>
						</li>
						<li>
							<label>
								<input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">
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
									Thumbnail (150 × 150)
							</label>
						</li>
						<li>
							<label>
								<input type="radio" name="optionsRadios" id="optionsRadios2" value="option2" />
								Medium (300 × 300)
							</label>
						</li>
						<li>
							<label>
								<input type="radio" name="optionsRadios" id="optionsRadios3" value="option3" />
								Large (584 × 584)
							</label>
						</li>
						<li>
							<label>
								<input type="radio" name="optionsRadios" id="optionsRadios3" value="option3" />
								Full Size (1060 × 1060)
							</label>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="actions">
				<!--<a href="javascript:;" onclick="tinyMCE.execCommand('mceInsertContent',false,'<img src=\'http://placehold.it/350x150\' />');">[ Insert Image ]</a>-->
				<a class="btn primary" href="javascript:parent.top.tinyMCE.get('Content').execCommand('mceInsertContent',false,'<img src=\'http://placehold.it/350x150\' />');" onmouseup="parent.jQuery.fancybox.close();">Insert Image</a>
				<button class="btn danger">Delete</button>
				<a class="btn" href="javascript:parent.jQuery.fancybox.close();">Cancel</a>
			</div>
		</fieldset>
	</form>
</div>
<? load::view('admin/template-modal-footer');?>
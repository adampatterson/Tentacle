<? $file_meta = string_to_parts($image->name); ?>
<? load::view('admin/partials/header', array('title' => 'Update '.$file_meta['file_name'], 'assets'=> array('') ) );?>
<div id="wrap">
	<div class="one-full">
		<h1 class='title'><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Update <?=$file_meta['file_name'] ?></h1>

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
					<dd>{April 11, 2012}</dd>
					<dt>Dimensions</dt>
					<dd>{200 x 200}</dd>
				</dl>
				<input type="hidden" name="file_name" value="<?=$image->name ?>" >
			</div>
		</div>
		<div class="row">
			<form action="<?= BASE_URL ?>action/update_media/<?= $image->id ?>" method="post" class="form-horizontal" name="<?= $image->slug ?>">
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

					<div class="row">
						<div class="actions">
							<input type="submit" name="update" value="Update" id="update" class="btn btn-success">
							<button class="btn btn-danger">Delete</button>
							<a class="btn" href="javascript:parent.jQuery.fancybox.close();">Cancel</a>
						</div>
					</div>
				</fieldset>
			</form>
		</div>		

	</div>
</div>
<? load::view('admin/partials/footer', array( 'assets'=> array('') ) );?>
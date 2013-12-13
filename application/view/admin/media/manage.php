<? load::view('admin/partials/header', array('title' => 'Manage media', 'assets' => array('filedrop') ) ); ?>
<div id="wrap">
	<div id="post-body">
		<div id="post-body-content">
			<div class="title">
				<h1 class='align-left'><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Manage media</h1>
			</div>

		    <div class="row">
	    		<div id="dropbox" class="well"><i class="icon-picture"></i></div>
		    </div>

			<div class="accordion" id="accordion">
				<? foreach ( $media as $image ): ?>
				<? $file_meta = explode('.', $image->name ); ?>
				<div class="accordion-group">
					<div class="accordion-heading">
						<div class="row">
							<div class="col-md-1">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion<?=$image->id ?>" href="#collapse<?=$image->id ?>">
									<img src="<?= IMAGE_URL.$file_meta[0].'_sq'.'.'.$file_meta[1]; ?>" class="thumbnail" width="30" height="30" />
								</a>
							</div>
							<div class="col-md-4">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion<?=$image->id ?>" href="#collapse<?=$image->id ?>"><?=$image->title ?></a>
							</div>
						</div>
					</div>
					<div id="collapse<?=$image->id ?>" class="accordion-body collapse" style="height: 0px; ">
						<div class="accordion-inner">

							<div class="row">
								<div class="col-md-3">
									<img src="<?= IMAGE_URL.$file_meta[0].'_sq'.'.'.$file_meta[1]; ?>" class="thumbnail"/>
								</div>
								<div class="col-md-4 well">
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
									<input type="hidden" name="history" value="<?= CURRENT_PAGE ?>"/>
									<fieldset>
										<h3>&nbsp;</h3>

										<div class="form-group">
											<label for="title">Title</label>
											<div class="controls">
												<input type="text" class="col-md-5 post" data-image-id="<?= $image->id ?>" id="title" name="title" value="<?=$image->title ?>">
											</div>
										</div>

										<div class="form-group">
											<label for="alt_text">Alternate Text</label>
											<div class="controls">
												<input type="text" class="col-md-5 post" data-image-id="<?= $image->id ?>" id="alt_text" name="alt_text" value="<?=$image->alt ?>" >
											</div>
										</div>

										<div class="form-group">
											<label for="caption">Caption</label>
											<div class="controls">
												<input type="text" class="col-md-5 post" data-image-id="<?= $image->id ?>" id="caption" name="caption" value="<?= $image->caption ?>">
											</div>
										</div>

									</div>
									<div class="row">
										<div class="actions">
											<input type="submit" name="update" value="Update" id="update" class="btn btn-success">
											<!--<button class="btn btn-danger">Delete</button>-->
										</div>
									</fieldset>
								</form>
							</div>

						</div>
					</div>
				</div><!-- /#collapse<?=$image->id ?> -->
				<? endforeach; ?>
			</div>

		</div>
	</div>
</div>
<? load::view('admin/partials/footer', array( 'assets'=> array( 'filedrop' ) ) );?>

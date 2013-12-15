<div class="col-md-12">

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
                                    <div class="col-md-1">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion<?=$image->id ?>" href="#collapse<?=$image->id ?>">
                                            <img src="<?= IMAGE_URL.$file_meta['file_name'].'_sq'.'.'.$file_meta['extension']; ?>" class="thumbnail" width="30" height="30" />
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
                                            <img src="<?= IMAGE_URL.$file_meta['file_name'].'_sq'.'.'.$file_meta['extension']; ?>" class="thumbnail"/>
                                        </div>
                                        <div class="col-md-9">
                                          <div class="well">
                                            <dl class="dl-horizontal">
                                                <dt>File name:</dt>
                                                <dd><?=$image->name ?></dd>
                                                <dt>File type:</dt>
                                                <dd><?=$image->type ?></dd>
<!--                                                <dt>Uploaded on:</dt>-->
<!--                                                <dd>April 11, 2012</dd>-->
<!--                                                <dt>Dimensions</dt>-->
<!--                                                <dd>200 x 200</dd>-->
                                            </dl>
                                            <input type="hidden" name="file_name" value="<?=$image->name ?>" >
                                          </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">

                                          <form class="form-horizontal" role="form">
                                            <fieldset>
                                              <div data-image-id="<?= $image->id ?>" class="form-horizontal">
                                                <input type="hidden" name="history"  value="<?= CURRENT_PAGE ?>"/>
                                                <input type="hidden" name="file_id" class="file_id" value="<?= $image->id ?>" />
                                                <input type="hidden" name="filename" class="filename" value="<?=$file_meta['file_name'] ?>" />
                                                <input type="hidden" name="extension" class="extension" value="<?=$file_meta['extension'] ?>" />

                                                <h3>&nbsp;</h3>

                                                <div class="form-group">
                                                  <label for="title">Title</label>
                                                  <input type="text" class="form-control title" name="title" value="<?=$image->title ?>">
                                                </div>

                                                <div class="form-group">
                                                  <label for="alt_text">Alternate Text</label>
                                                  <input type="text" class="form-control alt_text" name="alt_text" value="<?=$image->alt ?>" >
                                                </div>

                                                <div class="form-group">
                                                  <label for="caption">Caption</label>
                                                  <input type="text" class="form-control caption" name="caption" value="<?= $image->caption ?>">
                                                </div>

                                                <div class="form-group">
                                                  <label for="link_url">Link URL</label>
                                                  <input type="text" class="form-control link_url" name="link_url" value="<?= $image->link ?>" ><button class="btn" type="button" id="none">None</button><button class="btn" type="button" id="file">File</button>
                                                </div>

                                                <div class="form-group">
                                                  <label>Size</label>
                                                  <div class="controls">
                                                    <label class="radio">
                                                      <input type="radio" name="image_size" class="image_size" value="<?= get::option('image_thumb_size_w'); ?>" checked />
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

                                                <div class="actions">
                                                  <button class="insert_media btn btn-primary">Insert Image</button>
                                                  <!--<a class="btn primary" id="insert">Insert Image</a>-->
                                                  <button class="btn btn-danger">Delete</button>
                                                  <a class="btn close-reveal-modal">Cancel</a>
                                                </div>

                                              </div>
                                            </fieldset>
                                          </form>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div><!-- /#collapse<?=$image->id ?> -->

                    <? endforeach; ?>
                </div>

            </div><!-- /#insert -->

            <div class="tab-pane" id="upload">

                <div id="dropbox" class="well"><i class="icon-picture"></i></div>

            </div><!-- /#upload -->
        </div>
    </div>

</div>

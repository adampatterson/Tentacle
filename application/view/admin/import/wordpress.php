<? load::view('admin/partials/header', array('title' => 'Dashboard', 'assets' => array('application')));?>

    <div id="wrap">
        <div class="full-content">
            <div id="post-body">
                <div class="row">
                    <div class="title pad-right">
                        <h1><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Import Content from WordPress</h1>

                        <div class="span8 well">
                            <form action="<?= BASE_URL ?>action/import_wordpress/" method="post" enctype="multipart/form-data">
                                <p>Content imported will be added under the current logged in user ( <?= user_name() ?> )</p>
                                <p></p>
                                <div class="form-group">
                                    <label for="xml_file">Choose a WXR (.xml) file to upload, then click "Upload and Import". <br />It should be no larger than <?= ini_get('post_max_size') ?></label>
                                    <div class="controls">
                                        <input type="file" name="xml_file" value="" id="xml_file">
                                    </div>
                                </div>

                                <input type="hidden" name="history" required="required" value="<?= CURRENT_PAGE ?>"/>

                                <div class="form-actions">
                                    <!--<input type="button" value="Save and Close" class="button" />
                                    <input type="button" value="Save and Continure Editing" class="button" />-->
                                    <input type="submit" value="Upload and Import" class="btn btn-primary btn-large" />
                                </div>
                            </form>
                        </div>

                    </div>
                </div><!-- .row -->
            </div><!-- .post-body -->
        </div><!-- .full-content -->
    </div><!-- #wrap -->
<? load::view('admin/partials/footer', array( 'assets' => array( '' ) ) ); ?>
<div id="wrap">
    <div class="full-content">
        <div id="post-body">
            <div class="one-full">
                <div class="title pad-right">
                    <h1><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Disqus Settings</h1>
                    <div class="span8 well">
                        <?
                        if ( input::post('author_profile') )
                            set::option('author_profile', input::post('author_profile'));
                        ?>

                        <form action="<?= BASE_URL ?>action/udpate_settings_post/"  class="form-stacked" method="post">

                            <input type="hidden" name="history" value="admin/settings_plugins/disqus_settings">

                            <fieldset>

                                <div class="control-group">
                                    <div class="controls">
                                        <input type="text" id="disqus_account" value="<?= get::option('disqus_account') ?>" name="disqus_account" placeholder="Disqus shortname" />
                                    </div>
                                </div>

                            </fieldset>

                            <div class="form-actions">
                                <button class="btn btn-primary" type="submit">
                                    Save
                                </button>
                            </div>

                        </form>

                    </div>
                </div>
            </div><!-- .one-full -->
        </div><!-- .post-body -->
    </div><!-- .full-content -->
</div><!-- #wrap -->

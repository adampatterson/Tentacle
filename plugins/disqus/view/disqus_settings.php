<div id="wrap">
  <div class="full-content">
    <div id="post-body">
      <div class="one-full">
        <div class="title pad-right">
          <h1><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Disqus Settings</h1>
        </div>
        <div class="col-md-8 well">
          <form action="<?= BASE_URL ?>action/udpate_settings_post/" class="form-stacked" method="post" role="form">
            <input type="hidden" name="history" value="admin/settings_plugins/disqus_settings">
            <div class="form-group">
              <input class="form-control" type="text" id="disqus_account" value="<?= get::option('disqus_account') ?>" name="disqus_account" placeholder="Disqus shortname" />
            </div>
            <button class="btn btn-primary" type="submit">
                Save
            </button>
          </form>
        </div>
      </div><!-- .one-full -->
    </div><!-- .post-body -->
  </div><!-- .full-content -->
</div><!-- #wrap -->

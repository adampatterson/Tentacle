<? load::view('admin/partials/header', array('title' => 'SEO settings','assets'=>'application')); ?>

<div id="wrap">
  <div class="full-content">
    <div id="post-body">
      <div id="post-body-content">
          <h1 class='title'><img src="<?=ADMIN_URL; ?>images/icons/icon_pages_32.png" alt="" /> SEO settings</h1>
            <div class="table">
              <h2>404 Monitor</h2>
              <hr />
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <thead class="table-heading">
                  <tr>
                    <th>URL</th>
                    <th>Referers</th>
                    <th>Hits</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>http://www.adampatterson.ca/2009/01/print/print-03/</td>
                    <td ><img src="<?=ADMIN_URL; ?>images/icons/16_cursor.png" width="16" height="16" alt="Referers" /></td>
                    <td>12</td>
                  </tr>
                  <tr>
                    <td>http://www.adampatterson.ca/2009/01/print/print-04/</td>
                    <td ><img src="<?=ADMIN_URL; ?>images/icons/16_cursor.png" width="16" height="16" alt="Referers" /></td>
                    <td>12</td>
                  </tr>
                  <tr>
                    <td>http://www.adampatterson.ca/2009/01/print/print-01/</td>
                    <td ><img src="<?=ADMIN_URL; ?>images/icons/16_cursor.png" width="16" height="16" alt="Referers" /></td>
                    <td>12</td>
                  </tr>
                  <tr>
                    <td>http://www.adampatterson.ca/2009/01/black-and-white/2009040121050817_img_7488/</td>
                    <td ><img src="<?=ADMIN_URL; ?>images/icons/16_cursor.png" width="16" height="16" alt="Referers" /></td>
                    <td>12</td>
                  </tr>
                  <tr>
                    <td>http://www.adampatterson.ca/2009/01/black-and-white/2009040121045505_img_0441/</td>
                    <td ><img src="<?=ADMIN_URL; ?>images/icons/16_cursor.png" width="16" height="16" alt="Referers" /></td>
                    <td>12</td>
                  </tr>
                </tbody>
              </table>
        </div>
      </div>
      <!-- .post-body-content -->
    </div>
    <!-- #post-body -->
  </div>
  <!-- .full-content -->
</div>
<!-- #wrap -->
<? load::view('admin/partials/footer', array( 'assets' => array( '' ) ) ); ?>

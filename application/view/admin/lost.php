<? load::view('admin/template-login-header', array('title' => 'Lost Login','assets'=>'marketing')); ?>
  <div id="login-header"><a href="<?=BASE_URL; ?>">← Back to site name</a></div>
  <!-- #login-header -->
  <div id="login-logo"><a href="<?=BASE_URL; ?>"><img src="<?=BASE_URL; ?>tentacle/admin/images/tentacle_logo_large.png" width="238" height="85" alt="Tentacle" /></a></div>
  <!-- #login-logo -->
  <div id="login-wrapper">
    <div id="login-content">
      <form action="<?= BASE_URL ?>action/login/" method="post">
		<dl>
			<dt><label for='username'>Username</label></dt>
			<dd><input type='text' id='username' name='username' /></dd>
		</dl>

        <div class="login-row">
        	<div class="actions">
        		<input type="submit" value="Recover" class="button" />
        	</div>
        </div>
      </form>
    </div>
    <!-- #login-content -->
  </div>
  <!-- #login-content -->
<? load::view('admin/template-login-footer');
 ?>
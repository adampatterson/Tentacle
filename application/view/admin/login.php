<? load::view('admin/partials/login-header', array('title' => 'Login', 'assets' => 'marketing'));?>
<div id="login-header">
	<a href="<?=BASE_URL;?>">← Back to site name</a>
</div>

<div class="row">

  <div id="login-logo">
    <a href="<?=BASE_URL;?>"><img src="<?=ADMIN_URL;?>images/tentacle_logo_large.png" width="258" height="63" alt="Tentacle" /></a>
  </div>

  <div id="login-content">
    <form action="<?= BASE_URL ?>action/login/" method="post" role="form">
      <div class="form-group">
        <input type='text' id='username' class="form-control" name='username' placeholder='Username' />
      </div>
      <div class="form-group">
        <input type='password' id='password' class="form-control"  name='password' placeholder='Password' />
      </div>
      <div class="form-group">
        <a href="<?= BASE_URL ?>admin/lost/" class="pull-left forgot secondary">Lost password</a><input type="submit" value="Sign in" class="btn btn-primary pull-right" />
      </div>
      <? if($note = note::get('session')): ?>
      <input type='hidden' name='history' value="<?= $note['content'];?> " />
      <? endif;?>
    </form>

  </div>

</div>
<? load::view('admin/partials/login-footer');?>

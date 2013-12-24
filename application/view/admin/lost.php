<? load::view('admin/partials/login-header', array('title' => 'Recover your password','assets'=>'marketing')); ?>
<div id="login-header">
	<a href="<?=BASE_URL;?>">← Back to site name</a>
</div>
<?php if( $note = note::get('sent_message') ): ?>
	<div class="alert alert-success">
		<h3 class="<?= $note['type']; ?>"><?= $note['content'];?></h3>
	</div>
<?php endif; ?>
<div class="row">

  <div id="login-logo">
    <a href="<?=BASE_URL;?>"><img src="<?=ADMIN_URL;?>images/tentacle_logo_large.png" width="258" height="63" alt="Tentacle" /></a>
  </div>

  <div id="login-content">
    <form action="<?= BASE_URL ?>action/lost/" method="post">
      <div class="form-group">
          <input type='text' class="form-control input-lg" id='username' name='username' placeholder='Username or E-Mail' />
        </div>
      <div class="form-group">
          <input type="submit" value="Recover" class="btn btn-primary pull-right" />
      </div>
      <?php if($note = note::get('session')): ?>
        <input type='hidden' name='history' value="<?= $note['content'];?> " />
      <?php endif;?>
    </form>
  </div>

</div>
<? load::view('admin/partials/login-footer');?>

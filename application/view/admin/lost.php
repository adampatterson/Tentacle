<? load::view('admin/template-login-header', array('title' => 'Recover your password','assets'=>'marketing')); ?>
<div id="login-header">
	<a href="<?=BASE_URL;?>">← Back to site name</a>
</div>
<?php if( $note = note::get('sent_message') ): ?>
	<div class="alert alert-success">
		<h3 class="<?= $note['type']; ?>"><?= $note['content'];?></h3>
	</div>
<?php endif; ?>
<div id="login-content">
	<div id="login-logo">
		<a href="<?=BASE_URL;?>"><img src="<?=BASE_URL;?>tentacle/admin/images/tentacle_logo_large.png" width="258" height="63" alt="Tentacle" /></a>
	</div>
	<form action="<?= BASE_URL ?>action/lost/" method="post">
		<dl>
			<dd>
				<input type='text' id='username' name='username' placeholder='Username or E-Mail' />
			</dd>
			<dd>
				<input type="submit" value="Recover" class="btn btn-primary btn-large pull-right" />
			</dd>
		</dl>
		<?php if($note = note::get('session')): ?>
			<input type='hidden' name='history' value="<?= $note['content'];?> " />
		<?php endif;?>
	</form>
</div>
<!-- #login-content -->
</div> <!-- #login-content -->
<? load::view('admin/template-login-footer');?>
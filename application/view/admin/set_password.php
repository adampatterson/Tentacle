<? load::view('admin/partials/template-login-header', array('title' => 'Set your password','assets'=>'marketing')); ?>
<div id="login-header">
	<a href="<?=BASE_URL;?>">← Back to site name</a>
</div>
<div id="login-content">
	<div id="login-logo">
		<a href="<?=BASE_URL;?>"><img src="<?=ADMIN_URL;?>images/tentacle_logo_large.png" width="258" height="63" alt="Tentacle" /></a>
	</div>
	<form action="<?= BASE_URL ?>action/set_password/" method="post">
		<dl>
			<dd>
				<input type='text' id='password' name='password' placeholder='Password' />
			</dd>
			<dd>
				<input type="submit" value="Set your password" class="btn btn-primary btn-large pull-right" />
			</dd>
		</dl>
		<input type='hidden' name='hash' value="<?= $hash ?>" />
		<?php if($note = note::get('lost')): ?>
			<input type='hidden' name='history' value="<?= $note['content'];?> " />
		<?php endif;?>
	</form>
</div>
<!-- #login-content -->
</div> <!-- #login-content -->
<? load::view('admin/partials/template-login-footer');?>
<? load::view('admin/template-login-header', array('title' => 'Login', 'assets' => 'marketing'));?>
<div id="login-header">
	<a href="<?=BASE_URL;?>">← Back to site name</a>
</div>
<!-- #login-header -->
<div id="login-logo">
	<a href="<?=BASE_URL;?>"><img src="<?=BASE_URL;?>tentacle/admin/images/tentacle_logo_large.png" width="238" height="85" alt="Tentacle" /></a>
</div>
<!-- #login-logo -->
<div id="login-content">
	<form action="<?= BASE_URL ?>action/login/" method="post">
		<dl>
			<dd>
				<input type='text' id='username' name='username' placeholder='Username' />
			</dd>
			<dd>
				<input type='password' id='password' name='password' placeholder='Password' />
			</dd>
		</dl>
		<?php if($note = note::get('session')):
		?>
		<input type='hidden' name='history' value="<?= $note['content'];?> " />
		<?php endif;?>
		<div class="login-row">
			<div class="inline-inputs">
				<a href="<?= ADMIN ?>lost">Forgot password?</a>&nbsp;&nbsp;
				<input type="submit" value="Sign in" class="btn medium secondary" />
			</div>
		</div>
	</form>
</div>
<!-- #login-content -->
</div> <!-- #login-content -->
<? load::view('admin/template-login-footer');?>
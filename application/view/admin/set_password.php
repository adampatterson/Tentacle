<? load::view('admin/partials/login-header', array('title' => 'Set your password','assets'=>'marketing')); ?>
<div id="login-header">
	<a href="<?=BASE_URL;?>">← Back to site name</a>
</div>

<div class="row">
    <div id="login-logo">
        <a href="<?=BASE_URL;?>"><img src="<?=ADMIN_URL;?>images/tentacle_logo_large.png" width="258" height="63" alt="Tentacle" /></a>
    </div>

    <div id="login-content">
        <form action="<?= BASE_URL ?>action/set_password/" method="post" role="form">
            <div class="form-group">
                <input type='text' id='password' name='password' placeholder='Password'  class="form-control input-lg"/>
            </div>
            <div class="form-group">
                <input type="submit" value="Set your password" class="btn btn-primary btn-large pull-right" />
            </div>
            <div class="form-group">
                <input type='hidden' name='hash' value="<?= $hash ?>" />
            </div>
            <?php if($note = note::get('lost')): ?>
                <input type='hidden' name='history' value="<?= $note['content'];?> " />
            <?php endif;?>
        </form>
    </div>
</div>
<? load::view('admin/partials/login-footer');?>
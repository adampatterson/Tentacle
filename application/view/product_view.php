<? load::view('admin/template-login-header', array('title' => 'Welcome to Tentacle!', 'assets' => 'marketing'));?>
<div id="login-header">
	<a href="<?=BASE_URL;?>">← Back to site name</a>
</div>
<!-- #login-header -->
<div id="login-logo">
	<a href="<?=BASE_URL;?>"><img src="<?=BASE_URL;?>tentacle/admin/images/tentacle_logo_large.png" width="238" height="85" alt="Tentacle" /></a>
</div>
<!-- #login-logo -->
<div id="login-content">
	<p>Tentacle CMS helps web professionals and small businesses create fast and flexible websites.</p>
	<p><a href="http://www.adampatterson.ca/contact/" target="_blank">Contact for more info.</a></p>
</div>
<!-- #login-content -->
</div> <!-- #login-content -->
<? load::view('admin/template-login-footer');?>
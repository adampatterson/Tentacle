<?
 /*
Name: Index Page
URI: http://tcms.me/
Description: This is the Tentacle default theme.
Author: Tentacle
Version: 1.0
License: GNU General Public License
License URI: license.txt
*/

$data = array(
	'display' => 'admin'
);

if(!defined('SCAFFOLD')):
?>
<? load_part('header',array('title'=>'Welcome to Tentacle','assets'=>'marketing')); ?>
<div id="login-header">
	<a href="http://adampatterson.ca">by Adam Patterson</a>
</div>
<div id="login-content" class="marketing">
	<div id="login-logo">
		<a href="<?=BASE_URL;?>"><img src="<?=BASE_URL;?>tentacle/admin/images/tentacle_logo_large.png" width="258" height="63" alt="Tentacle" /></a>
	</div>
	<div id="login-content-message">
		<p><strong>Tentacle is an OpenSource Content Management System, and it's free to use!</strong></p>
		<p>Follow us on Twitter <a href="https://twitter.com/#!/TentacleCMS" class='' target="_blank">@TentacleCMS</a>, read the <a href='http://www.tentaclecms.com/blog/'>Blog</a>, and consider joining the mailing list.</p>
	</div>

	<form method="post" action="http://www.industrymailout.com/Industry/SubscribeRedirect.aspx" >
		<input type="hidden" name="mailinglistid" value="27205" />
		<input type="hidden" name="success" value="http://tentaclecms.com" />
		<input type="hidden" name="errorparm" value="error" />
		<dl>
			<dd><h2>Mailing list</h2></dd>
			<dd>
				<input type="text" name="givenname" placeholder="First Name"  maxlength="50" />
			</dd>
			<dd>
				<input type="text" name="familyname" placeholder="Last Name" maxlength="50" />
			</dd>
			<dd>
				<input type="text" name="email" maxlength="60" required="required" placeholder="Email" value="" class="email span4" />
			</dd>
			<dd>
				<input type="submit" value="Notify Me!" class="btn large primary" />
			</dd>
		</dl>
		<?php if($note = note::get('session')): ?>
			<input type='hidden' name='history' value="<?= $note['content'];?> " />
		<?php endif;?>
	</form>
</div>
  <!-- #login-content -->
<? load_part('footer'); 
endif;
?>
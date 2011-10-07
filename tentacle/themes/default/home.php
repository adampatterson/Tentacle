<?
 /*
Name: Home Page
URI: http://tcms.me/
Description: This is the Tentacle default theme.
Author: Tentacle
Version: 1.0
License: GNU General Public License
License URI: license.txt
*/
?>
<? load_part('header',array('title'=>'Welcome to Tentacle','assets'=>'marketing')); ?>
  <div id="login-header"><a href="http://www.adampatterson.ca" target="_blank">http://www.adampatterson.ca</a></div>
  <!-- #login-header -->
  <div id="login-logo"><img src="<?=ADMIN_URL; ?>/images/tentacle_logo_large.png" width="238" height="85" alt="Tentacle" /></div>
  <!-- #login-logo -->
  <div id="login-wrapper">
    <div id="login-content-message">
		<p><strong>Tentacle is an OpenSource Content Management System, it is free to use.</strong></p>
		<p>It's goal is to help web professionals and small businesses create fast and flexible websites.</p>
		<!--<h3>Feeling Generous?</h3>
		<p>Any contribution would be greatly appreciated!</p>-->
		<p><!--<a href="https://www.wepay.com/donate/151133" class='btn medium primary' target="_blank">Donate</a> or --><a href="http://www.adampatterson.ca/contact/" class='btn medium primary' target="_blank">Get in touch!</a></p>
		<!-- Begin MailChimp Signup Form -->
		<div id="mc_embed_signup">
		<form action="http://adampatterson.us1.list-manage2.com/subscribe/post?u=c21d0f4a99a90fdf9c412e45a&amp;id=8b21ce6336" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="form-stacked" target="_blank">
			<h2>Subscribe to our mailing list</h2>
		<div class="mc-field-group">
			<label for="mce-EMAIL">Email Address  <span class="asterisk">*</span>
		</label>
			<input type="email" value="" name="EMAIL" class="email" required="required" id="mce-EMAIL">
		<br /><br />
		<p><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="btn medium success"></p>
	</div>
		</form>
		</div>
		<!--End mc_embed_signup-->
</div>
    <!-- #login-content -->
  </div>
  <!-- #login-content -->
<? load_part('footer'); ?>
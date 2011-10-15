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

$data = array();

if(!defined('SCAFFOLD')):
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
		<!--<p><a href="https://www.wepay.com/donate/151133" class='btn medium primary' target="_blank">Donate</a> or <a href="http://www.adampatterson.ca/contact/" class='btn medium primary' target="_blank">Get in touch!</a></p>-->
		<form action="http://adampatterson.us1.list-manage2.com/subscribe/post?u=c21d0f4a99a90fdf9c412e45a&amp;id=8b21ce6336" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="form-stacked" target="_blank">
			<div class="mc-field-group">
				<input type="email" value="" name="EMAIL" class="email span4" required="required" placeholder="Subscribe to our mailing list" id="mce-EMAIL"> &nbsp;<input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="btn medium success">
			</div>
		</form>
	</div>
    <!-- #login-content -->
  </div>
  <!-- #login-content -->
<? load_part('footer'); 
endif;
?>
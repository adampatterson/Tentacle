<?
 /*
Template Name: Home Page
Template URI: http://tcms.me/
Description: This is the Tentacle default thgeme.
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
		<h3>Feeling Generous?</h3>
		<p>Any contribution would be greatly appreciated!</p>
		<a href="https://www.wepay.com/donate/151133" class='btn medium primary' target="_blank">Donate</a> <a href="http://www.adampatterson.ca/contact/" class='btn medium secondary' target="_blank">Get in touch!</a>
    </div>
    <!-- #login-content -->
  </div>
  <!-- #login-content -->
<? load_part('footer'); ?>
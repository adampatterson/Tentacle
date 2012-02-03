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
  <div id="login-header"><a href="http://www.adampatterson.ca" target="_blank">http://www.adampatterson.ca</a></div>
  <!-- #login-header -->
  <div id="login-logo"><img src="<?=ADMIN_URL; ?>/images/tentacle_logo_large.png" width="238" height="85" alt="Tentacle" /></div>
  <!-- #login-logo -->
  <div id="login-wrapper">
	<div id="login-content-message">
		<p><strong>Tentacle is an OpenSource Content Management System, and it's free to use!</strong></p>
		<p>Follow us on Twitter <a href="https://twitter.com/#!/TentacleCMS" class='' target="_blank">@TentacleCMS</a>, read the <a href='http://www.tentaclecms.com/blog/'>Blog</a>, and consider joining the mailing list.</p>

		<h3>Mailing list</h3>

		<form method="post" action="http://www.industrymailout.com/Industry/SubscribeRedirect.aspx" > 
		<input type="hidden" name="mailinglistid" value="27205" />
		<input type="hidden" name="success" value="http://tentaclecms.com" />
		<input type="hidden" name="errorparm" value="error" />
		<div class="mc-field-group">
			<input type="text" name="givenname" placeholder="First Name"  maxlength="50" />
		</div>
		<div class="mc-field-group">
			<input type="text" name="familyname" placeholder="Last Name" maxlength="50" />
		</div>
		<div class="mc-field-group">
			<input type="text" name="email" maxlength="60" required="required" placeholder="Email" value="" class="email span4" />
		</div>

		<div class="mc-field-group">
			<input type="submit" value="Notify Me!" class="btn medium primary" />
		</div>

		</form>
<!--
		<form action="http://adampatterson.us1.list-manage2.com/subscribe/post?u=c21d0f4a99a90fdf9c412e45a&amp;id=8b21ce6336" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="form-stacked" target="_blank">
			<div class="mc-field-group">
				<input type="email" value="" name="EMAIL" class="email span4" required="required" placeholder="Subscribe to our mailing list" id="mce-EMAIL"> &nbsp;<input type="submit" value="Notify Me" name="subscribe" id="mc-embedded-subscribe" class="btn medium primary">
			</div>
		</form>
-->
		<h3>Blog feed</h3>
		<div class="feed"></div>
		<ul>
			<script type="text/javascript">
					$.getJSON("http://tentaclecms.com/blog/feed/?feed=json&jsonp=?",
			       function(data){
			               console.debug(data[1]);

						$.each(data.slice(0,3), function(i, item){
							$(".feed").append('<li><a href="' + item.permalink + '">' + item.title + '</a></li>');
						});

			       });
			</script>
		</ul>

		<!--<p>Any contribution would be greatly appreciated!</p>

		<p><a href="https://www.wepay.com/donate/151133" class='btn medium primary' target="_blank">Donate</a></p>		
<p>The goal is to help web professionals and small businesses create fast and flexible websites.</p>-->

	</div>
    <!-- #login-content -->
  </div>
  <!-- #login-content -->
<? load_part('footer'); 
endif;
?>